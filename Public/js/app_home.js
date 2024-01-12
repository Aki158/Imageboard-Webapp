// const $posts = {
//     "threads":[
//         {
//             "count":7,
//             "subject":"\u30d5\u30ea\u30fc\u30c8\u30fc\u30af1",
//             "content":"\u306a\u3093\u3067\u3082<br \/>\r\n\u6c17\u8efd\u306b\u5165\u529b<br \/>\r\nOK!",
//             "image_path":"Images\/2024\/01\/11\/im_7871b3cf33826af4a631166cd6198dad.png",
//             "thumbnail_path":"Thumbnails\/2024\/01\/11\/th_7871b3cf33826af4a631166cd6198dad.png",
//             "url":"http:\/\/localhost:8000\/thread\/ff609373e1894efec87dde0cfa6727e163a016a7",
//             "created_at":"2024-01-11 20:12:52"
//         },
//         {
//             "count":0,
//             "subject":"\u30d5\u30ea\u30fc\u30c8\u30fc\u30af2",
//             "content":"\u96d1\u8ac7\u90e8\u5c4b<br \/>\r\n\u3067\u3059\u3002<br \/>\r\n\u30b3\u30e1\u30f3\u30c8\u3069\u3057\u3069\u3057\u304a\u5f85\u3061\u3057\u3066\u304a\u308a\u307e\u3059\u30fc\uff01",
//             "image_path":"Images\/2024\/01\/11\/im_f00bd25271aa546cb58f60391d843a6b.png",
//             "thumbnail_path":"Thumbnails\/2024\/01\/11\/th_f00bd25271aa546cb58f60391d843a6b.png",
//             "url":"http:\/\/localhost:8000\/thread\/8680fa34282309b37a16a88716fb5ed141c06eaf",
//             "created_at":"2024-01-11 20:14:26"
//         }
//     ],
//     "replies":[
//         [
//             {
//                 "content":"\u4eca\u65e5\u4f55\u3057\u307e\u3057\u305f\u30fc\uff1f",
//                 "image_path":null,
//                 "thumbnail_path":null,
//                 "created_at":"2024-01-11 20:15:15"
//             }
//         ],
//         [
//             {
//                 "content":"\u3053\u306e\u30b5\u30fc\u30d3\u30b9\u306e\u958b\u767a\u3084\u3063\u3066\u307e\u3057\u305f\u306d\u3002",
//                 "image_path":null,
//                 "thumbnail_path":null,
//                 "created_at":"2024-01-11 20:15:37"
//             }
//         ],
//         [{"content":"","image_path":"Images\/2024\/01\/11\/im_2b51787c98f1c8b1e247f6967a2d6ee6.png","thumbnail_path":"Thumbnails\/2024\/01\/11\/th_2b51787c98f1c8b1e247f6967a2d6ee6.png","created_at":"2024-01-11 20:15:46"}],[{"content":"\u306f\u3048\u30fc","image_path":"Images\/2024\/01\/11\/im_2502b848d638c50aa18b3196f9fb2f8e.png","thumbnail_path":"Thumbnails\/2024\/01\/11\/th_2502b848d638c50aa18b3196f9fb2f8e.png","created_at":"2024-01-11 20:16:03"}],[{"content":"\u305d\u306e\u753b\u50cf\u3044\u3044\u306d\u301c<br \/>\r\n\u3069\u3046\u3084\u3063\u3066\u4f5c\u3063\u305f\u3093\uff1f","image_path":null,"thumbnail_path":null,"created_at":"2024-01-11 20:18:01"}]]};

window.addEventListener("load", (event) => {
    const len = Object.keys(posts).length;

    for (var i = 0; i < len; i++) {
        if(posts.threads[i] !== null){
            renderpostList(posts.threads[i], posts.replies[i], document.getElementById("home_posts_list"));
        }
    }
});

function renderpostList(thread, replies, postsList){
    const containerDiv = document.createElement("div");
    const rowDiv = document.createElement("div");
    const colDiv = document.createElement("div");
    const threadDiv = document.createElement("div");
    const threadOuterDiv = document.createElement("div");
    const threadInnerDiv1 = document.createElement("div");
    const threadInnerDiv2 = document.createElement("div");
    const threadInnerDiv3 = document.createElement("div");
    const repliesDiv = document.createElement("div");
    const threadInnerDiv4 = document.createElement("div");
    const linkOuterDiv = document.createElement("div");
    const linkInnerDiv = document.createElement("div");
    const link = document.createElement("a");
    
    const threadHeader = document.createElement("p");
    const subject = document.createElement("h5");
    const content = document.createElement("p");
    const a = document.createElement("a");
    const img = document.createElement("img");

    containerDiv.classList.add("container","my-3");
    rowDiv.classList.add("row","justify-content-center");
    colDiv.classList.add("col-md-7");
    threadDiv.classList.add("custom-border","bg-white");
    threadInnerDiv1.classList.add("m-3");
    threadInnerDiv2.classList.add("m-3");
    threadInnerDiv3.classList.add("m-3");
    threadInnerDiv4.classList.add("m-3");
    linkOuterDiv.classList.add("custom-border-top");
    linkInnerDiv.classList.add("m-3","text-center");

    threadHeader.innerHTML = "<i class='fa-regular fa-comments'></i>  " + thread.count + ".  &nbsp;&nbsp; <i class='fa-regular fa-clock'></i> " + thread.created_at;
    threadInnerDiv1.append(threadHeader);
    threadOuterDiv.append(threadInnerDiv1);

    subject.innerHTML = thread.subject;
    threadInnerDiv2.append(subject);
    threadOuterDiv.append(threadInnerDiv2);

    content.innerHTML = thread.content;
    threadInnerDiv3.append(content);
    threadOuterDiv.append(threadInnerDiv3);
    
    a.href = "../" + thread.image_path;
    img.src = "../" + thread.thumbnail_path;
    img.alt = "画像を表示できませんでした";
    img.classList.add("rounded-image");
    a.append(img);
    threadInnerDiv4.append(a);
    threadOuterDiv.append(threadInnerDiv4);
    threadDiv.append(threadOuterDiv);

    if(replies){
        for (var i = 0; i < Object.keys(replies).length; i++) {
            renderReplyList(i, replies[i], repliesDiv);
        }
    }

    threadDiv.append(repliesDiv);

    link.href = thread.url;
    link.innerHTML = "返信する or もっと見る...";

    linkInnerDiv.append(link);
    linkOuterDiv.append(linkInnerDiv);
    threadDiv.append(linkOuterDiv);

    colDiv.append(threadDiv);
    rowDiv.append(colDiv);
    containerDiv.append(rowDiv);
    postsList.append(containerDiv);
}

function renderReplyList(index, replies, repliesList){
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
    replyHeader.innerHTML = "<i class='fa-regular fa-comment'></i> " + (index + 1) + ".  &nbsp;&nbsp; <i class='fa-regular fa-clock'></i> " + replies.created_at;
    innerDiv1.append(replyHeader);
    outerDiv.append(innerDiv1);

    // コメントが入力されている場合
    if(replies.content !== null) {
        innerDiv2.classList.add("m-3");
        content.innerHTML = replies.content;
        innerDiv2.append(content);
        outerDiv.append(innerDiv2);
    }

    // 画像がアップロードされている場合
    if(replies.image_path !== null) {
        innerDiv3.classList.add("m-3");
        a.href = "../" + replies.image_path;
        img.src = "../" + replies.thumbnail_path;
        img.alt = "画像を表示できませんでした";
        img.classList.add("rounded-image");
        a.append(img);
        innerDiv3.append(a);
        outerDiv.append(innerDiv3);
    }
    repliesList.append(outerDiv);
}