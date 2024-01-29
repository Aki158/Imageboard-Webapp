<div class="container pb-2">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <h4 class="mx-3"><i class="fa-regular fa-paper-plane"></i> スレッドを作成する</h4>
            <form action="#" method="post" id="new-thread-form">
                <div class="custom-border bg-white">
                    <div class="mx-3 mt-3 mb-1 d-flex">
                        <p>タイトル&nbsp;&nbsp;</p>
                        <p id="title_count" class="text-secondary">0/50</p>
                    </div>
                    <div class="mx-3">
                        <input id="title" type="text" name="subject" maxlength="50" placeholder="タイトルを入力する(任意)" onkeyup="ShowLength('title_count', value, 50);">
                    </div>
                    <div class="mx-3 mt-3 mb-1 d-flex">
                        <p>コメント&nbsp;&nbsp;</p>
                        <p id="comment_count" class="text-secondary">0/400</p>
                    </div>
                    <div class="mx-3 mb-2">
                        <textarea id="new_thread_textarea" name="content" placeholder="コメントを入力する" minlength="1" maxlength="400" onkeyup="ShowLength('comment_count', value, 400);"></textarea>
                    </div>
                    <div class="mx-3 mb-3 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <button id="upload_file" type="button" onclick="imageSelect('upload_file_none')"><i class="fa-solid fa-image"></i></button>
                            <input type="file" id="upload_file_none" accept=".jpg, .jpeg, .png, .gif" name="file">
                            <p id="image_select_message" class="p-3"></p>
                        </div>
                        <div class="p-1">
                            <button type="submit" class="post-button">ポスト</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="Public/js/app_newThread.js"></script>
<script src="Public/js/app.js"></script>
