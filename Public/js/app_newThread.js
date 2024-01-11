// 画像ボタンがクリックされたら、メッセージを変更する
const inputFile = document.getElementById('upload_file_none');
inputFile.addEventListener('change', function() {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('image_select_message').innerHTML = "<i class='fa-solid fa-check'></i> ファイルが選択されました";
    };
    reader.readAsDataURL(inputFile.files[0]);
});
