window.addEventListener("load", (event) => {
    const len = Object.keys(posts.threads).length;
    const postsList = document.getElementById("home_posts_list");
    
    for (var i = 0; i < len; i++) {
        if(posts.threads[i] !== null){
            renderpostList(posts.threads[i], posts.replies[i], postsList);
        }
    }
});

function renderpostList(thread, replies, postsList){
    var message = '';

    // スレッドに返信がある場合
    if(replies){
        for (var i = 0; i < Object.keys(replies).length; i++) {
            message += renderReplyList(i, replies[i]);
        }
    }

    postsList.innerHTML += `
    <div class="container my-3">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="custom-border bg-white">
                    <div>
                        <div class="m-3">
                            <p><i class="fa-regular fa-comments"></i> ${thread.count} &nbsp;&nbsp; <i class="fa-regular fa-clock"></i> ${thread.created_at}</p>
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
                    </div>
                    ${message}
                    <div class="custom-border-top">
                        <div class="m-3 text-center">
                            <a href="${thread.url}">返信する or もっと見る...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `;
}

function renderReplyList(index, replies){
    var message = `
    <div class="custom-border-top">
        <div class="m-3">
            <p><i class="fa-regular fa-comment"></i> ${index + 1}.  &nbsp;&nbsp; <i class="fa-regular fa-clock"></i> ${replies.created_at}</p>
        </div>
    `

    // コメントが入力されている場合
    if(replies.content !== null) {
        message += `
        <div class="m-3">
            <p>${replies.content}</p>
        </div>
        `;
    }

    // 画像がアップロードされている場合
    if(replies.image_path !== null) {
        message += `
        <div class="m-3">
            <a href="../${replies.image_path}">
                <img src="../${replies.thumbnail_path}" alt="画像を表示できませんでした" class="rounded-image">
            </a>
        </div>
        `;
    }
    return message + `</div>`;
}
