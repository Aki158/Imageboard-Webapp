const threadBody = document.getElementById("thread_body");
const repliesList = document.getElementById("replies_list");
const jumpBottom = document.getElementById('jumpBottom');
const inputFile = document.getElementById('reply_upload_file_none');
const form = document.getElementById('reply-form');
const body = document.body;
const replyLimit = 100;
const threadId = posts.thread.post_id+"";
const replyLimitMessage = "このスレッドは、返信数が上限に到達しました。\nこれ以上返信はできません。";
const timer = setInterval(countUp, 1000);
const timeoutCount = 599;
var countSecond = 0;
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
    replyCount = Object.keys(posts.replies).length;

    adjustWidth();
    replyFormDataClear();
    renderThreadList(replyCount, posts.thread, threadBody);

    // 返信数が上限(返信数:100)に到達した場合
    if(replyCount >= replyLimit){
        replyReachedLimit(replyLimitMessage);
    }
    else{
        form.style.display = "block";
    }

    for (var i = 0; i < replyCount; i++) {
        renderReplyList(i+1, posts.replies[i], repliesList);
    }

    form.addEventListener('submit', function (event) {
        // デフォルトのフォーム送信を防止します
        event.preventDefault();

        // FormDataオブジェクトを作成し、コンストラクタにフォームを渡してすべての入力値を取得します
        const formData = new FormData(form);

        // fetchリクエストを送信します
        fetch('../form/create/reply', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())  // レスポンスからJSONを解析します
            .then(data => {
                // サーバからのレスポンスデータを処理します
                if (data.status === 'success') {
                    replyFormDataClear();
                    publish(data.message);
                } else if (data.status === 'error') {
                    console.error('Error:\n'+data.message);
                    alert(data.message);
                }
            })
            .catch((error) => {
                // ネットワークエラーかJSONの解析エラー
                console.error('Error:\n'+error);
                alert('エラーが発生しました。\nもう一度試してください。\n'+error);
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
    // connStatusがtrueであれば、WebSocket接続を切ります
    if (connStatus) {
        conn.close();
        connStatus = false;
    }

    // 新しいWebSocketセッションを作成します
    // ab.Session コンストラクタは、WebSocketサーバーのURLと、接続成功時、失敗時に実行するコールバック関数を引数に取ります
    // ローカル環境用
    // conn = new ab.Session('ws://localhost:8080',
    // 本番環境用
    conn = new ab.Session('wss://pixathread.aki158-website.blog/thread/*:8080',
        function() {
            connStatus = true;

            // WebSocketの接続成功時に特定のトピックを購読し、メッセージが到着した際に処理を行います
            conn.subscribe(threadId, function(topic, data) {
                var scrollStatus = isAtBottom();
                countSecond = 0;

                // dataはreplyに関係するデータです
                // 引数はそれぞれ、conn.publish(threadId, data);の引数に紐付いています
                replyCount = data.count;
                renderThreadList(replyCount, posts.thread, threadBody);
                renderReplyList(data.count, data, repliesList);

                if(data.count >= replyLimit){
                    replyReachedLimit(replyLimitMessage);
                }

                // replyしたユーザーだけ自動的にページの最下部にスクロールする
                if(replyUserFlag || scrollStatus){
                    setTimeout(scrollToBottom, 300);
                    replyUserFlag = false;
                }
                else{
                    // 「新しいメッセージがあります↓」と表示する
                    jumpBottom.style.display = "block";
                }
            });
        },
        function() {
            console.warn('WebSocket connection closed');
            
            // 返信数が上限(返信数:100)未満でタイムアウトによりWebSocketの接続が切れた場合は、メッセージを表示し入力フォームを非表示にします
            if(replyCount < replyLimit && countSecond >= timeoutCount){
                const connectionClosedMessage = 'ユーザーからの返信がしばらくなかったため、接続が切れました。\n返信する場合は、ページを更新してからポストしてください。';
                replyReachedLimit(connectionClosedMessage);
            }
        },
        {'skipSubprotocolCheck': true}
    );
}

function renderThreadList(replyCount, thread, threadBody){
    threadBody.innerHTML = `
    <div class="m-3">
        <p><i class="fa-regular fa-comments"></i> ${replyCount} &nbsp;&nbsp; <i class="fa-regular fa-clock"></i> ${thread.created_at}</p>
    </div>
    <div class="m-3">
        <h5>${thread.subject}</h5>
    </div>
    <div class="m-3">
        <p>${thread.content}</p>
    </div>
    <div class="m-3">
        <a href="../${thread.image_path}">
        <img src="../${thread.thumbnail_path}" alt="画像を表示できませんでした" class="rounded-image">
        </a>
    </div>
    `;
}

// replyデータをページにレンダリングする
function renderReplyList(index, reply, repliesList){
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

function replyReachedLimit(message){
    // 入力を禁止したいので、フォームを非表示に設定する
    const replyForm = document.getElementById("reply-form");
    replyForm.style.display = 'none';

    // フォーム用に確保していた領域をなくします
    body.style.paddingBottom = '0px';

    // アラートを表示する
    alert(message);
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

    // 指定されたトピック(threadId)にメッセージ(data)を送信します
    // 具体的には、WebSocket(WebSocket/Pusher.phpのPusherクラスonPublish関数)に送信され、メッセージ(data)をトピックの購読者にブロードキャストします
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

// フォームの幅を設定
function adjustWidth() {
    var parent = document.querySelector('.col-md-7'); // 親要素を選択
    var parentStyle = window.getComputedStyle(parent);
    var parentWidth = parent.offsetWidth;
    var parentPadding = parseFloat(parentStyle.paddingLeft) + parseFloat(parentStyle.paddingRight);

    var newWidth = parentWidth - parentPadding; // 親のパディングを差し引いた幅を計算
    document.querySelector('.fixed-reply-area').style.width = newWidth + 'px';
}

// 1秒ごとにカウントアップする関数
function countUp() {
    countSecond++;
}
