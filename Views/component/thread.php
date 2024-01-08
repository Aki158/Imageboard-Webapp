<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <p>スレッドの返信数が上限に到達しました!</p>
            <p>これ以上返信はできません。</p>
            <div class="custom-border bg-white">
                <div>
                    <div class="m-3">
                        <p><i class="fa-regular fa-comments"></i> 100 &nbsp;&nbsp; <i class="fa-regular fa-clock"></i> 2024/1/5 23:01:15</p>
                    </div>
                    <div class="m-3">
                        <h5>しりとりしたい!</h5>
                    </div>
                    <div class="m-3">
                        <p>誰かしりとりしませんか~?<br>僕から、はじめますね。<br>参加できる人は返信ください。<br>「しりとり」</p>
                    </div>
                    <div class="m-3">
                        <img src="../output_300x300.png" alt="" class="rounded-image">
                    </div>
                </div>
                
                <div class="custom-border-top">
                    <div class="m-3">
                        <p><i class="fa-regular fa-comment"></i> 1.  &nbsp;&nbsp; <i class="fa-regular fa-clock"></i> 2024/1/5 23:06:15</p>
                    </div>
                    <div class="m-3">
                        <p>りんご〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜</p>
                    </div>
                </div>

                <div class="custom-border-top">
                    <div class="m-3">
                        <p><i class="fa-regular fa-comment"></i> 2. &nbsp;&nbsp; <i class="fa-regular fa-clock"></i> 2024/1/5 23:15:15</p>
                    </div>
                    <div class="m-3">
                        <p>ごりら</p>
                    </div>
                </div>

                <div class="custom-border-top">
                    <div class="m-3">
                        <p><i class="fa-regular fa-comment"></i> 3. &nbsp;&nbsp; <i class="fa-regular fa-clock"></i> 2024/1/5 23:24:15</p>
                    </div>
                    <div class="m-3">
                        <p>らくだ</p>
                    </div>
                    
                <div class="custom-border-top">
                    <div class="m-3">
                        <p><i class="fa-regular fa-comment"></i> 4. &nbsp;&nbsp; <i class="fa-regular fa-clock"></i> 2024/1/5 23:29:32</p>
                    </div>
                    <div class="m-3">
                        <p>だちょう</p>
                    </div>
                </div>

                <div class="custom-border-top">
                    <div class="m-3">
                        <p><i class="fa-regular fa-comment"></i> 5. &nbsp;&nbsp;  <i class="fa-regular fa-clock"></i> 2024/1/6 2:06:15</p>
                    </div>
                    <div class="m-3">
                        <p>うし</p>
                    </div>
                </div>

                <div class="custom-border-top">
                    <div class="m-3">
                        <p><i class="fa-regular fa-comment"></i> 6. &nbsp;&nbsp;  <i class="fa-regular fa-clock"></i> 2024/1/7 2:06:15</p>
                    </div>
                    <div class="m-3">
                        <p>しまうま</p>
                    </div>
                </div>
            </div>

            <div class="custom-border bg-white fixed-reply-area">
                <div class="mx-3 my-1">
                    <textarea id="reply_textarea" name="message" placeholder="コメントを入力してください" minlength="1" maxlength="400"></textarea>
                </div>
                <div class="mx-3 d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <button id="upload_file_reply"><i class="fa-solid fa-image"></i> 画像</button>
                        <input type="file" id="upload_file_none" accept=".jpg, .jpeg, .png, .gif">
                        <p class="p-3"><i class="fa-solid fa-check"></i></p>
                    </div>
                    <div class="p-1">
                        <button id="post_button" onclick="postData()">返信する</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../Public/js/app_thread.js"></script>
