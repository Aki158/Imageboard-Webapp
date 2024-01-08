// 画像ボタンがクリックされたら、コンピュータからファイルを選択させる
document.getElementById("upload_file").addEventListener("click", () => {
    document.getElementById("upload_file_none").click();
});

// 画像ボタンがクリックされたら、メッセージを変更する
const inputFile = document.getElementById('upload_file_none');
inputFile.addEventListener('change', function() {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('image_select_message').innerHTML = "<i class='fa-solid fa-check'></i> ファイルが選択されました";
    };
    reader.readAsDataURL(inputFile.files[0]);
});

// 文字数をカウントする
function ShowLength(id, str, maxLen) {
    document.getElementById(id).innerHTML = str.length + "/" + maxLen;
}

function postData() {
    const title = document.getElementById('title').value;
    const content = document.getElementById('new_thread_textarea').value;
    const uploadFile = document.getElementById('upload_file_none');
    const formData = new FormData();
    formData.append('subject', title);
    formData.append('content', content);
    formData.append('file', uploadFile.files[0]);

    // fetchリクエストを送信します
    fetch('form/create/post', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())  // レスポンスからJSONを解析します
        .then(data => {
            // サーバからのレスポンスデータを処理します
            if (data.status === 'success') {
                // 成功メッセージを表示したり、リダイレクトしたり、コンソールにログを出力する可能性があります
                console.log(data.message);
                alert('ポストできました!');
                // if (!formData.has('id')) form.reset();
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
}
