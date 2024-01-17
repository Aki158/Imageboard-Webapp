document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('new-thread-form');

    form.addEventListener('submit', function (event) {
        // デフォルトのフォーム送信を防止します
        event.preventDefault();

        // FormDataオブジェクトを作成し、コンストラクタにフォームを渡してすべての入力値を取得します
        const formData = new FormData(form);

        // fetchリクエストを送信します
        fetch('/form/create/thread', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())  // レスポンスからJSONを解析します
            .then(data => {
                // サーバからのレスポンスデータを処理します
                if (data.status === 'success') {
                    // 成功メッセージを表示したり、リダイレクトしたり、コンソールにログを出力する可能性があります
                    alert('ポストできました!');
                    threadFormDataClear();
                } else if (data.status === 'error') {
                    // ユーザーにエラーメッセージを表示します
                    console.error(data.message);
                    alert(data.message);
                }
            })
            .catch((error) => {
                // ネットワークエラーかJSONの解析エラー
                console.error('Error:', error);
                alert('エラーが発生しました。\nもう一度試してください。\n'+error);
            });
    });
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

function threadFormDataClear(){
    document.getElementById('title_count').innerHTML = '0/50';
    document.getElementById('title').value = '';
    document.getElementById('comment_count').innerHTML = '0/400';
    document.getElementById('new_thread_textarea').value = '';
    document.getElementById('upload_file_none').value = '';
    document.getElementById('image_select_message').innerHTML = 'ファイルを選択して下さい';
}
