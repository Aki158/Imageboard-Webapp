<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="custom-border bg-white">
                <div id="thread_body"></div>
                <div id="replies_list"></div>
            </div>
            
            <form action="#" method="post" id="reply-form"  style="display:none;">
                <input type="hidden" name="postId" value="<?= $posts['thread']['post_id'] ?>" placeholder="ID">
                <div class="fixed-reply-area">
                    <p class="text-end"><a href="#" id="jumpBottom" style="display:none;"><i class="fa-solid fa-down-long"></i> &nbsp; 新しいメッセージがあります &nbsp;<i class="fa-solid fa-exclamation"></i> &nbsp;</a></p>
                    <div class="custom-border bg-white">
                        <div class="mx-3 mt-3 mb-1 d-flex">
                            <p>コメント&nbsp;&nbsp;</p>
                            <p id="reply_comment_count" class="text-secondary">0/400</p>
                        </div>
                        <div class="mx-3 my-1">
                            <textarea id="reply_textarea" name="content" placeholder="コメントを入力する" minlength="1" maxlength="400" onkeyup="ShowLength('reply_comment_count', value, 400);"></textarea>
                        </div>
                        <div class="mx-3 d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <button id="reply_upload_file" type="button" onclick="imageSelect('reply_upload_file_none')"><i class="fa-solid fa-image"></i></button>
                                <input type="file" id="reply_upload_file_none" accept=".jpg, .jpeg, .png, .gif" name="file">
                                <p id="reply_image_select_message" class="p-3"></p>
                            </div>
                            <div class="p-1">
                                <button type="submit" class="post-button">ポスト</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const posts = <?php echo json_encode($posts); ?>;
</script>
<script src="/Public/js/autobahn.js"></script>
<script src="/Public/js/app_thread.js"></script>
<script src="/Public/js/app.js"></script>
