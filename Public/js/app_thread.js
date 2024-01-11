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

    // if(len >= 100){}

    for (var i = 0; i < len; i++) {
        renderList(i,replies,document.getElementById("replies_list"));
    }
});

function renderList(index, replies, repliesList){
    const outerDiv = document.createElement("div");
    const innerDiv1 = document.createElement("div");
    const innerDiv2 = document.createElement("div");
    const innerDiv3 = document.createElement("div");
    const replyHeader = document.createElement("p");
    const content = document.createElement("p");
    const a = document.createElement("a");
    const img = document.createElement("img");

    outerDiv.classList.add("custom-border-top");
    innerDiv1.classList.add("m-3");
    replyHeader.innerHTML = "<i class='fa-regular fa-comment'></i> " + (index + 1) + ".  &nbsp;&nbsp; <i class='fa-regular fa-clock'></i> " + replies[index].created_at;
    innerDiv1.append(replyHeader);
    outerDiv.append(innerDiv1);

    // コメントが入力されている場合
    if(replies[index].content !== null) {
        innerDiv2.classList.add("m-3");
        content.innerHTML = replies[index].content;
        innerDiv2.append(content);
        outerDiv.append(innerDiv2);
    }

    // 画像がアップロードされている場合
    if(replies[index].image_path !== null) {
        innerDiv3.classList.add("m-3");
        a.href = "../" + replies[index].image_path;
        img.src = "../" + replies[index].thumbnail_path;
        img.alt = "画像を表示できませんでした";
        img.classList.add("rounded-image");
        a.append(img);
        innerDiv3.append(a);
        outerDiv.append(innerDiv3);
    }
    repliesList.append(outerDiv);
}