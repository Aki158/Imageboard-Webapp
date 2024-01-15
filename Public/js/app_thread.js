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

function replyFormDataClear(){
    document.getElementById('reply_comment_count').innerHTML = '0/400';
    document.getElementById('reply_textarea').value = '';
    document.getElementById('reply_upload_file_none').value = '';
    document.getElementById('reply_image_select_message').innerHTML = '';
}

// body要素のスタイルにpadding-bottomを追加
const body = document.body;
body.style.paddingBottom = '230px';

// 画像ボタンがクリックされたら、メッセージを変更する
const inputFile = document.getElementById('reply_upload_file_none');
inputFile.addEventListener('change', function() {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('reply_image_select_message').innerHTML = "<i class='fa-solid fa-check'></i>";
    };
    reader.readAsDataURL(inputFile.files[0]);
});

window.addEventListener("load", (event) => {
    const len = Object.keys(replies).length;
    const repliesList = document.getElementById("replies_list");
    for (var i = 0; i < len; i++) {
        renderList(i,replies,repliesList);
    }
});

function renderList(index, replies, repliesList){
    repliesList.innerHTML += `
    <div class="custom-border-top">
        <div class="m-3">
            <p><i class="fa-regular fa-comment"></i> ${index + 1}.  &nbsp;&nbsp; <i class="fa-regular fa-clock"></i> ${replies[index].created_at}</p>
        </div>
    `;

    // コメントが入力されている場合
    if(replies[index].content !== null) {
        repliesList.innerHTML += `
        <div class="m-3">
            <p>${replies[index].content}</p>
        </div>
        `;
    }

    // 画像がアップロードされている場合
    if(replies[index].image_path !== null) {
        repliesList.innerHTML += `
        <div class="m-3">
            <a href="../${replies[index].image_path}">
                <img src="../${replies[index].thumbnail_path}" alt="画像を表示できませんでした" class="rounded-image">
            </a>
        </div>
        `;
    }
}