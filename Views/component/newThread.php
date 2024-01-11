<div class="container pb-2">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <h4 class="mx-3"><i class="fa-regular fa-paper-plane"></i> スレッドを作成する</h4>
            <div class="custom-border bg-white">
                <div class="mx-3 mt-3 mb-1 d-flex">
                    <p>タイトル&nbsp;&nbsp;</p>
                    <p id="title_count" class="text-secondary">0/50</p>
                </div>
                <div class="mx-3">
                    <input id="title" type="text" name="name" size="30" maxlength="50" placeholder="入力して下さい(任意)" onkeyup="ShowLength('title_count', value, 50);">
                </div>
                <div class="mx-3 mt-3 mb-1 d-flex">
                    <p>コメント&nbsp;&nbsp;</p>
                    <p id="comment_count" class="text-secondary">0/400</p>
                </div>
                <div class="mx-3 mb-2">
                    <textarea id="new_thread_textarea" name="message" placeholder="入力してください" minlength="1" maxlength="400" onkeyup="ShowLength('comment_count', value, 400);"></textarea>
                </div>
                <div class="mx-3 d-flex">
                    <button id="upload_file" onclick="imageSelect('upload_file_none')"><i class="fa-solid fa-image"></i> 画像</button>
                    <input type="file" id="upload_file_none" accept=".jpg, .jpeg, .png, .gif">
                    <p id="image_select_message" class="p-3"> ファイルを選択してください</p>
                </div>
                <div class="mx-3 mt-2 mb-4">
                    <button class="post-button" onclick="postData('thread', 0, 'title', 'new_thread_textarea', 'upload_file_none')">ポストする</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../../Public/js/app_newThread.js"></script>
<script src="../../Public/js/app.js"></script>
