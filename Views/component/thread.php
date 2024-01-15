<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <!-- <p>スレッドの返信数が上限に到達しました!</p>
            <p>これ以上返信はできません。</p> -->
            <div class="custom-border bg-white">
                <div>
                    <div class="m-3">
                        <p><i class="fa-regular fa-comments"></i> <?= count($posts['replies']) ?> &nbsp;&nbsp; <i class="fa-regular fa-clock"></i> <?= $posts['thread']->getTimeStamp()->getCreatedAt() ?></p>
                    </div>
                    <div class="m-3">
                        <h5><?= htmlspecialchars($posts['thread']->getSubject()) ?></h5>
                    </div>
                    <div class="m-3">
                        <p><?= nl2br(htmlspecialchars($posts['thread']->getContent()))?></p>
                    </div>
                    <div class="m-3">
                        <a href="../<?= $posts['thread']->getImagePath() ?>">
                            <img src="../<?= $posts['thread']->getThumbnailPath() ?>" alt="画像は表示できませんでした" class="rounded-image">
                        </a>
                    </div>
                </div>
                
                <div id="replies_list"></div>
            </div>

            <form action="#" method="post" id="reply-form">
                <?php if ($posts['thread']->getPostId() !== null): ?>
                    <input type="hidden" name="postId" value="<?= $posts['thread']->getPostId() ?>" placeholder="ID"><br>
                <?php endif; ?>
                <div class="custom-border bg-white fixed-reply-area">
                    <div class="mx-3 mt-3 mb-1 d-flex">
                        <p>コメント&nbsp;&nbsp;</p>
                        <p id="reply_comment_count" class="text-secondary">0/400</p>
                    </div>
                    <div class="mx-3 my-1">
                        <textarea id="reply_textarea" name="content" placeholder="コメントを入力してください" minlength="1" maxlength="400" onkeyup="ShowLength('reply_comment_count', value, 400);"></textarea>
                    </div>
                    <div class="mx-3 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <button id="reply_upload_file" type="button" onclick="imageSelect('reply_upload_file_none')"><i class="fa-solid fa-image"></i> 画像</button>
                            <input type="file" id="reply_upload_file_none" accept=".jpg, .jpeg, .png, .gif">
                            <p id="reply_image_select_message" class="p-3"></p>
                        </div>
                        <div class="p-1">
                            <button type="submit" class="post-button">ポストする</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const replies = <?php echo json_encode($posts['replies']); ?>;
</script>
<script src="../Public/js/app_thread.js"></script>
<script src="../Public/js/app.js"></script>
