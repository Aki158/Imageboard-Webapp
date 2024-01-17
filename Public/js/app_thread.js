const repliesList = document.getElementById("replies_list");
const jumpBottom = document.getElementById('jumpBottom');
const inputFile = document.getElementById('reply_upload_file_none');
const body = document.body;
const replyLimit = 100;
var replyCount = 0;
var connStatus = false;
var replyUserFlag = false;
var conn;

// body要素のスタイルにpadding-bottomを追加
body.style.paddingBottom = '110px';

window.onload = connect;

window.addEventListener('resize', adjustWidth);

window.addEventListener('scroll', function() {
    // ページの最下層に到達したら、メッセージを非表示にする
    if (isAtBottom()) {
        jumpBottom.style.display = "none";
    }
});

window.addEventListener("load", (event) => {
    // フォームの幅を設定
    adjustWidth();

    replyCount = Object.keys(replies).length;

    // 返信数が上限(返信数:100)に到達した場合
    if(replyCount >= replyLimit){
        replyReachedLimit();
    }

    for (var i = 0; i < replyCount; i++) {
        renderList(i+1, replies[i], repliesList);
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('reply-form');

    form.addEventListener('submit', function (event) {
        // デフォルトのフォーム送信を防止します
        event.preventDefault();

        const uploadFile = document.getElementById('reply_upload_file_none');
        // FormDataオブジェクトを作成し、コンストラクタにフォームを渡してすべての入力値を取得します
        const formData = new FormData(form);
        formData.append('file', uploadFile.files[0]);

        // fetchリクエストを送信します
        fetch('../form/create/reply', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())  // レスポンスからJSONを解析します
            .then(data => {
                // サーバからのレスポンスデータを処理します
                if (data.status === 'success') {
                    // 成功メッセージを表示したり、リダイレクトしたり、コンソールにログを出力する可能性があります
                    console.log(data.message);

                    replyFormDataClear();
                    publish(data.message);
                } else if (data.status === 'error') {
                    // ユーザーにエラーメッセージを表示します
                    console.error(data.message);
                    alert(data.message);
                }
            })
            .catch((error) => {
                // ネットワークエラーかJSONの解析エラー
                console.error('Error:', error);
                alert('エラーが発生しました。もう一度試してください。'+error);
            });
    });
});

// 画像ボタンがクリックされたら、メッセージを変更する
inputFile.addEventListener('change', function() {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('reply_image_select_message').innerHTML = "<i class='fa-solid fa-check'></i>";
    };
    reader.readAsDataURL(inputFile.files[0]);
});

jumpBottom.addEventListener('click', function(e) {
    // デフォルトのアンカー動作を防止
    e.preventDefault();
    scrollToBottom();
    jumpBottom.style.display = "none";
});

// WebSocketに接続する
function connect(){
    // connStatusがtrueであれば、接続を切ります
    if (connStatus) {
        conn.close();
        connStatus = false;
    }

    conn = new ab.Session('ws://localhost:8080',
        function() {
            connStatus = true;

            conn.subscribe(threadId, function(topic, data) {
                var scrollStatus = isAtBottom();

                // dataはreplyに関係するデータです
                // 引数はそれぞれ、conn.publish(threadId, data);の引数に紐付いています
                // topic = threadId;
                // data = data;
                renderList(data.count, data, repliesList);
                replyCount = data.count;

                // replyしたユーザーだけ自動的にページの最下部にスクロールする
                if(replyUserFlag || scrollStatus){
                    setTimeout(scrollToBottom, 100);
                    replyUserFlag = false;
                }
                else{
                    // 「新しいメッセージがあります↓」と表示したい
                    jumpBottom.style.display = "block";
                }

                if(data.count >= replyLimit){
                    replyReachedLimit();
                }
            });
        },
        function() {
            console.warn('WebSocket connection closed');
        },
        {'skipSubprotocolCheck': true}
    );
}

// replyデータをページにレンダリングする
function renderList(index, reply, repliesList){
    repliesList.innerHTML += `
    <div class="custom-border-top">
        <div class="m-3">
            <p><i class="fa-regular fa-comment"></i> ${index}.  &nbsp;&nbsp; <i class="fa-regular fa-clock"></i> ${reply.created_at}</p>
        </div>
    `;

    // コメントが入力されている場合
    if(reply.content !== null) {
        repliesList.innerHTML += `
        <div class="m-3">
            <p>${reply.content}</p>
        </div>
        `;
    }

    // 画像がアップロードされている場合
    if(reply.image_path !== null) {
        repliesList.innerHTML += `
        <div class="m-3">
            <a href="../${reply.image_path}">
                <img src="../${reply.thumbnail_path}" alt="画像を表示できませんでした" class="rounded-image">
            </a>
        </div>
        `;
    }
}

// 返信数が上限(返信数:100)に到達した場合
function replyReachedLimit(){
    // 画面のトップにメッセージを表示する
    const lastMessage = document.getElementById("lastMessage");
    lastMessage.innerHTML = "スレッドの返信数が上限に到達しました。<br>これ以上返信はできません。";

    // 入力を禁止したいので、フォームを非表示に設定する
    const replyForm = document.getElementById("reply-form");
    replyForm.style.display = 'none';

    // フォーム用に確保していた領域をなくします
    body.style.paddingBottom = '0px';

    // ページの最下部にスクロールします
    scrollToBottom();
}

// ページの最下部にスクロールする
function scrollToBottom() {
    window.scrollTo(0, document.body.scrollHeight);
}

// dataを公開するために送信する
function publish(data){
    replyCount += 1;
    data.count = replyCount;
    replyUserFlag = true;

    if(replyCount >= replyLimit){
        replyReachedLimit();
    }
    conn.publish(threadId, data);
}

// ページの最下層にいるか確認する
function isAtBottom() {
    return window.innerHeight + window.scrollY >= document.body.offsetHeight;
}

// 次のデータ送信のために、フォームデータをクリアする
function replyFormDataClear(){
    document.getElementById('reply_comment_count').innerHTML = '0/400';
    document.getElementById('reply_textarea').value = '';
    document.getElementById('reply_upload_file_none').value = '';
    document.getElementById('reply_image_select_message').innerHTML = '';
}

function adjustWidth() {
    var parent = document.querySelector('.col-md-7'); // 親要素を選択
    var parentStyle = window.getComputedStyle(parent);
    var parentWidth = parent.offsetWidth;
    var parentPadding = parseFloat(parentStyle.paddingLeft) + parseFloat(parentStyle.paddingRight);

    var newWidth = parentWidth - parentPadding; // 親のパディングを差し引いた幅を計算
    document.querySelector('.fixed-reply-area').style.width = newWidth + 'px';
}
