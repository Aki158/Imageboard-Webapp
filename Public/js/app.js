// 文字数をカウントする
function ShowLength(id, str, maxLen) {
    document.getElementById(id).innerHTML = str.length + "/" + maxLen;
}

// 画像ボタンがクリックされたら、コンピュータからファイルを選択させる
function imageSelect(id) {
    document.getElementById(id).click();
}

function postData(postType, postId, idTitle, idContent, idUploadFile) {
    const title = idTitle === 'title' ? document.getElementById(idTitle).value : null;
    const content = document.getElementById(idContent).value;
    const uploadFile = document.getElementById(idUploadFile);
    const formData = new FormData();
    formData.append('postType', postType);
    formData.append('postId', postId);
    formData.append('subject', title);
    formData.append('content', content);
    formData.append('file', uploadFile.files[0]);
    const url = (postType === 'reply' ? '../' : '') + 'form/create/post';

    // fetchリクエストを送信します
    fetch(url, {
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

                inputDataClear(postType);
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

function inputDataClear(postType){
    if(postType === 'thread'){
        document.getElementById('title_count').innerHTML = '0/50';
        document.getElementById('title').value = '';
        document.getElementById('comment_count').innerHTML = '0/400';
        document.getElementById('new_thread_textarea').value = '';
        document.getElementById('upload_file_none').value = '';
        document.getElementById('image_select_message').innerHTML = 'ファイルを選択して下さい';
    }
    else if(postType === 'reply'){
        document.getElementById('reply_comment_count').innerHTML = '0/400';
        document.getElementById('reply_textarea').value = '';
        document.getElementById('reply_upload_file_none').value = '';
        document.getElementById('reply_image_select_message').innerHTML = '';
    }
}