// 文字数をカウントする
function ShowLength(id, str, maxLen) {
    document.getElementById(id).innerHTML = str.length + "/" + maxLen;
}

// 画像ボタンがクリックされたら、コンピュータからファイルを選択させる
function imageSelect(id) {
    document.getElementById(id).click();
}
