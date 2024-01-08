<?php

namespace Models;

use Models\Interfaces\Model;
use Models\Traits\GenericModel;

class Post implements Model {
    use GenericModel;

    // php 8のコンストラクタのプロパティプロモーションは、インスタンス変数を自動的に設定します。
    public function __construct(
        private ?int $post_id = null,
        private ?int $reply_to_id = null,
        private ?string $subject = null,
        private ?string $content = null,
        private ?string $image_path = null,
        private ?string $thumbnail_path = null,
        private ?string $url = null,
        private ?DataTimeStamp $timeStamp = null,
    ) {}

    public function getPostId(): ?int {
        return $this->post_id;
    }

    public function setPostId(int $post_id): void {
        $this->post_id = $post_id;
    }

    public function getReplyToId(): ?int {
        return $this->reply_to_id;
    }

    public function setReplyToId(int $reply_to_id): void {
        $this->reply_to_id = $reply_to_id;
    }

    public function getSubject(): ?string {
        return $this->subject;
    }

    public function setSubject(string $subject): void {
        $this->subject = $subject;
    }

    public function getContent(): ?string {
        return $this->content;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function getImagePath(): ?string {
        return $this->image_path;
    }

    public function setImagePath(string $image_path): void {
        $this->image_path = $image_path;
    }

    public function getThumbnailPath(): ?string {
        return $this->thumbnail_path;
    }

    public function setThumbnailPath(string $thumbnail_path): void {
        $this->thumbnail_path = $thumbnail_path;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function setUrl(string $url): void {
        $this->url = $url;
    }

    public function getTimeStamp(): ?DataTimeStamp
    {
        return $this->timeStamp;
    }

    public function setTimeStamp(DataTimeStamp $timeStamp): void
    {
        $this->timeStamp = $timeStamp;
    }
}