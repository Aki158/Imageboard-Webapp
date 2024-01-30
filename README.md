# Imageboard-Webapp
🗣️スレッドを通じて匿名でチャットができるWebアプリケーション

## 🏠URL
https://pixathread.aki158-website.blog/

## ✨デモ
### スレッドの作成
![スレッドの作成](https://github.com/Aki158/Imageboard-Webapp/assets/119317071/0eb37a95-378e-40b9-88d8-504fe4cc5a86)

### スレッドと返信の表示
![スレッドと返信の表示](https://github.com/Aki158/Imageboard-Webapp/assets/119317071/916f2869-9e01-4aa4-bed2-29515396a1c6)

### スレッドへの返信
![スレッドへの返信](https://github.com/Aki158/Imageboard-Webapp/assets/119317071/94d6d1d7-8c4a-4442-9596-57a315c78919)

## 📝説明
このサービスは、スレッドを通じて匿名でチャットができるWebアプリケーションです。

スレッドの作成とスレッド内でのチャットは、このアプリケーションにアクセスしたユーザーなら気軽に誰でも利用することができます。

このアプリケーションでは、下記のような状況を想定して作成しました。

- 特定のコミュニティや話題について匿名で自由に意見交換をしたい
- スレッドの画像について共有して情報交換や問題の解決、ディスカッションを行いたい

基本的な機能として、スレッドの作成/スレッドへの返信/スレッドと返信の表示ができます。

レスポンシブデザイン(ユーザーが使用するデバイスの画面サイズに応じて表示を最適化するデザイン)に対応しておりますので、

スマホやパソコン、ディスプレイなど様々なデバイスから利用できるようになっています。

### 注意事項

アプリケーションを利用する際は、下記の注意事項を確認してください。

項目に違反するとメッセージを表示するようにしていますが、把握しておくことでより快適に利用できます。

#### スレッドの作成

| 項目 | 内容 |
| ------- | ------- |
| 任意入力 | タイトル |
| 必須入力 | コメント/画像 |
| タイトルの最大文字数 | 50文字まで |
| コメントの最大文字数 | 400文字まで |
| アップロードできるファイルの拡張子 | `*.gif`<br>`*.png`<br>`*.jpeg` |
| 1度にアップロードできるファイル数 | 1ファイル |
| 1度にアップロードできるファイルの最大サイズ | 5MBまで |

#### スレッドと返信の表示

| 項目 | 内容 |
| ------- | ------- |
| スレッドの表示 | 100件まで(新しい順) |
| 返信の表示 | 5件まで(古い順) |

#### スレッドへの返信

| 項目 | 内容 |
| ------- | ------- |
| 入力 | コメントまたは画像どちらかの入力は必須 |
| コメントの最大文字数 | 400文字まで |
| アップロードできるファイルの拡張子 | `*.gif`<br>`*.png`<br>`*.jpeg` |
| 1度にアップロードできるファイル数 | 1ファイル |
| 1度にアップロードできるファイルの最大サイズ | 5MBまで |
| 返信数の上限 | 100件まで |
| 返信の表示 | リアルタイム(ポストボタンクリック後すぐに反映される) |
| 返信可能時間 | ページにアクセスまたはユーザーが返信してから10分間<br>(新たに返信があれば、0秒にリセットされます) |

## 🚀使用方法
### スレッドの作成
1. [URL](#URL)にアクセスする
2. ヘッダー(ページ上部)のスレッド ボタンをクリックする
3. タイトルを入力する(任意)
4. コメントを入力する(必須)
5. 画像 ボタンをクリックして、アップロードするファイルを選択する(必須)
6. ポスト ボタンをクリックする
7. 「ポストできました」と表示されることを確認する

### スレッドと返信の表示
1. [URL](#URL)にアクセスする または ヘッダー(ページ上部)のホーム ボタンをクリックする
2. ページをスクロールしてスレッドと返信の内容を見る
3. スレッドへの返信またはすべての返信を見たい場合は、 返信する or もっと見る... ボタンをクリックしてスレッドページに移動する

### スレッドへの返信
1. 「スレッドと返信の表示」の手順を実施してスレッドページに移動する
2. スレッドと返信を見て話題について理解する
3. コメントを入力する
4. 画像 ボタンをクリックして、アップロードするファイルを選択する
5. ポスト ボタンをクリックする
6. 返信した内容がスレッドに表示されることを確認する

## 🙋使用例
イメージは[デモ](#デモ)を参考にしてください。

### スレッドの作成
1. [URL](#URL)にアクセスする
2. ヘッダー(ページ上部)のスレッド ボタンをクリックする
3. タイトルに`雑談部屋`と入力する
4. コメントに`ここで匿名で会話できます！`と入力する
5. 画像 ボタンをクリックして、アップロードするファイル`test1.3mb.png`を選択する
6. ポスト ボタンをクリックする
7. 「ポストできました」と表示されることを確認する

### スレッドと返信の表示
1. [URL](#URL)にアクセスする
2. ページをスクロールしてスレッドと返信の内容を見る
3. 「スレッド:雑談部屋」に返信したいので 返信する or もっと見る... ボタンをクリックしてスレッドページに移動する

### スレッドへの返信
1. 「スレッドと返信の表示」の手順を実施してスレッドページに移動する
2. スレッドと返信を見て話題について理解する
3. コメントに`はじめまして！`と入力する
4. 画像 ボタンをクリックして、アップロードするファイルを選択する<br>今回は、コメントだけで返信したいので選択しない
5. ポスト ボタンをクリックする
6. 返信した内容がスレッドに表示されることを確認する

## 💾使用技術
<table>
<tr>
  <th>カテゴリ</th>
  <th>技術スタック</th>
</tr>
<tr>
  <td rowspan=5>フロントエンド</td>
  <td>HTML</td>
</tr>
<tr>
  <td>CSS</td>
</tr>
<tr>
  <td>JavaScript</td>
</tr>
<tr>
  <td>ライブラリ : autobahn-js</td>
</tr>
<tr>
  <td>フレームワーク : Bootstrap</td>
</tr>
<tr>
  <td rowspan=3>バックエンド</td>
  <td>PHP</td>
</tr>
<tr>
  <td>ライブラリ : FakerPHP</td>
</tr>
<tr>
  <td>ライブラリ : Ratchet-PHP WebSockets</td>
</tr>
<tr>
  <td rowspan=4>インフラ</td>
  <td>Amazon EC2</td>
</tr>
<tr>
  <td>Nginx</td>
</tr>
<tr>
  <td>Ubuntu</td>
</tr>
<tr>
  <td>VirtualBox</td>
</tr>
<tr>
  <td>データベース</td>
  <td>MySQL</td>
</tr>
<tr>
  <td rowspan=2>デザイン</td>
  <td>Figma</td>
</tr>
<tr>
  <td>Draw.io(vscode)</td>
</tr>
<tr>
  <td rowspan=5>その他</td>
  <td>Git</td>
</tr>
<tr>
  <td>Github</td>
</tr>
<tr>
  <td>SSL/TLS証明書取得、更新、暗号化 : Certbot</td>
</tr>
<tr>
  <td>デーモン(常駐プログラム) : Supervisor</td>
</tr>
<tr>
  <td>画像処理 : ImageMagick</td>
</tr>
</table>

## 🗄️ER図
ER図の説明は、[自己参照型のERテーブル](#自己参照型のERテーブル)を確認ください。

![ER](https://github.com/Aki158/Imageboard-Webapp/assets/119317071/f383251e-2455-4bf9-9c9b-3a88c2a0aee2)

## 👀機能一覧
### ヘッダー

| 機能 | 内容 |
| ------- | ------- |
| スレッド | ボタンをクリックすると、スレッド作成ページに遷移します。 |
| ホーム | ボタンをクリックすると、ホームページに遷移します。 |

### スレッド作成ページ

| 機能 | 内容 |
| ------- | ------- |
| タイトル | タイトルを任意で入力できます。<br>タイトルは、50文字以内におさめてください。<br>入力文字数は、リアルタイムでカウントされるため、現在の入力文字数をすぐに確認できます。<br>(入力フォーム上の`0/50`の数字は、`現在の入力文字数/入力文字数の上限`を表しています) |
| コメント | コメントは1~400文字で入力が必要です。<br>入力文字数は、リアルタイムでカウントされるため、現在の入力文字数をすぐに確認できます。<br>(入力フォーム上の`0/400`の数字は、`現在の入力文字数/入力文字数の上限`を表しています)<br>また、コメントを未入力の状態でポストボタンをクリックすると、スレッドの作成が出来ず、アラートが表示されます。 |
| 画像 | ボタンをクリックして、アップロードするファイルの選択が必要です。<br>ファイルは、gif/png/jpegのいづれかから選択してください。<br>それ以外のファイルを選択しても、アップロードすることはできません。 |
| ポスト | タイトル(任意)/コメント/画像を設定した後にクリックしてください。<br>設定した情報をもとに、スレッドを作成します。<br>スレッドの作成に成功した場合は、「ポストできました!」と表示されます。<br>失敗した場合は、アラートを表示しますので、入力を見直してください。 |
| アラート | `ポスト`ボタンをクリックした後に、入力情報(タイトル(任意)/コメント/画像)をデータベースに登録する処理を行います。<br>処理の結果をアラートとして表示します。 |

### ホームページ

| 機能 | 内容 |
| ------- | ------- |
| スレッドの表示 | スレッドをリストとして新しい順に最大100件まで表示します。 |
| 返信の表示 | スレッド内で既にチャットが行われている場合は、古い順に最大5件まで表示します。 |

### スレッドページ

| 機能 | 内容 |
| ------- | ------- |
| コメント | コメントは1~400文字で入力が必要です。<br>入力文字数は、リアルタイムでカウントされるため、現在の入力文字数をすぐに確認できます。<br>(入力フォーム上の`0/400`の数字は、`現在の入力文字数/入力文字数の上限`を表しています)<br>また、コメントを未入力かつ画像を未選択の状態でポストボタンをクリックすると、スレッドの作成が出来ず、アラートが表示されます。 |
| 画像 | ボタンをクリックして、アップロードするファイルの選択が必要です。<br>ファイルは、gif/png/jpegのいづれかから選択してください。<br>それ以外のファイルを選択しても、アップロードすることはできません。 |
| ポスト | コメント/画像を設定した後にクリックしてください。<br>設定した情報をもとに、スレッドへ返信します。<br>返信に成功した場合は、ページの一番下に返信が追加されます。<br>失敗した場合は、アラートを表示しますので、入力を見直してください。 |
| 返信可能時間 | ページにアクセスまたはユーザーが返信してから10分間返信できます。<br>この10分間は、新たに返信があれば、0秒にリセットされます。 |
| アラート | `ポスト`ボタンをクリックした後に、入力情報(コメント/画像)をデータベースに登録する処理を行います。<br>処理の結果をアラートとして表示します。 |

### 画像

| 機能 | 内容 |
| ------- | ------- |
| 画像の保存 | アップロードされたすべての画像はサーバ側のストレージフォルダーに保存されます。<br>画像ファイル名は、PHPのhash関数を利用しています。<br>すべての画像は、画像の保存時にサムネイルバージョンを作成します。<br>サムネイルの作成には、ImageMagickを使用して画像ファイルを300x300 ピクセルの画像に変換してThumbnailsフォルダに保存しています。<br>これは、ホームページやスレッドページのプレビューで使用されます。<br>ImageMagickを使用している処理を確認したい場合は、[サムネイルバージョンへの画像変換処理](https://github.com/Aki158/Imageboard-Webapp/blob/d8341da5eb31839775d325bb253c70c9a70b450d/Helpers/ValidationHelper.php#L89-L96)から確認することができます。 |
| 画像の表示 | ホームページやスレッドページで表示される画像をクリックすると、フルバージョンの画像を表示します。 |

## 📜作成の経緯
下記項目の理解を深めるために作成しました。
- データアクセス層
- WebSocket通信

## ⭐️こだわった点
### DAOを使用したデータ層へのアクセス



### 自己参照型のERテーブル

チャットをスレッド毎に管理するために自己参照型のERテーブルを採用しました。

この自己参照という関係は、１対Ｎの参照関係のバリエーションで1つのテーブルでスレッドと返信のデータを管理することができます。

スレッド名:雑談部屋を例に説明します。

下記表は、データベースに登録された雑談部屋に関係するデータを整形したものです。

スレッドと返信どちらの情報か区別するのにreply_to_idを使用しています。

雑談部屋は、post_id = 3であり、このスレッド内で返信をすると、reply_to_id = 3(雑談部屋のpost_id)というように代入します。

こうすることで、雑談部屋に関係する返信ということがわかります。

![image](https://github.com/Aki158/Imageboard-Webapp/assets/119317071/386e88ac-5ad7-4ba0-b9f3-4aac06435503)

スレッドページでは、このデータを下記のようにユーザーが見やすい形で表示しています。

![image](https://github.com/Aki158/Imageboard-Webapp/assets/119317071/9464e13f-47f1-4dd8-968b-d39bf1b307d7)

### データベースシーダーによるテストの効率化

ホームページとスレッドページでのスレッドと返信の表示をテストする場合、期待している表示になっているか確認する必要があります。

例えば、ホームページには、最大100件のスレッドが新しい順で表示されます。

手動でテストを行う場合は、スレッド作成ページからスレッドを100件分作成する必要があり、準備するだけで時間がかかります。

この準備にかかる時間を効率化するために、初期ダミーデータをコマンドで簡単に作成できるデータベースシーダーを作成しました。

ダミーデータには、PHPのfakerライブラリと[ダミー画像](https://github.com/Aki158/Imageboard-Webapp/blob/main/Dummies/dummyImage.png)を使用します。

データベースシーダーを利用する際は、ターミナルを起動し、以下のコマンドを実行することで、必要なダミーデータを生成できます。

このコマンドが実行されると、スレッドと返信(1つのスレッド)をそれぞれ101件行ったのと同等の偽データがデータベースに登録されます。

```
php console seed
```

seedコマンドの実行が完了した後は、下記項目を確認するだけで表示に関わるテストは完了できます。

- データベースに偽データが登録されていること
- Imagesフォルダにダミー画像がコピーされていること
- Thumbnailsフォルダにダミー画像のサムネイルバージョンがコピーされていること
- ホームページとスレッドページを確認し期待している表示になっていること

seedコマンドに関係する主要なファイルは、下記から確認することができます。

- [Seed.php](https://github.com/Aki158/Imageboard-Webapp/blob/main/Commands/Programs/Seed.php)
- [PostSeeder1_Thread.php](https://github.com/Aki158/Imageboard-Webapp/blob/main/Database/Seeds/PostSeeder1_Thread.php)
- [PostSeeder2_Reply.php](https://github.com/Aki158/Imageboard-Webapp/blob/main/Database/Seeds/PostSeeder2_Reply.php)

### WebSocketでのリアルタイム通信

スレッドページでは、リアルタイムでユーザー同士が匿名でのチャットをすることができます。

この機能は、主にPHPのRatchetライブラリを利用して実現させています。

Ratchetライブラリは、WebSocketを介してクライアントとサーバー間のリアルタイム双方向アプリケーションを作成するためのライブラリです。

WebSocketとは、Webにおいて双方向通信を低コストで行うための仕組みのことです。

WebSocketに関係するファイルは、下記から確認することができます。

- [app_thread.js](https://github.com/Aki158/Imageboard-Webapp/blob/main/Public/js/app_thread.js)
- [autobahn.js](https://github.com/Aki158/Imageboard-Webapp/blob/main/Public/js/autobahn.js)
- [chat-server.php](https://github.com/Aki158/Imageboard-Webapp/blob/main/chat-server.php)
- [Pusher.php](https://github.com/Aki158/Imageboard-Webapp/blob/main/WebSocket/Pusher.php)

#### WebSocket通信の確立から切断までの流れ

WebSocket通信の基本的な流れは、下記シーケンス図の通りです。

スレッドページへユーザーがアクセスすると、クライアントとWebSocket間でWebSocket Connection の確立を行います。

通信が確立されると、WebSocketを利用できるようになり、ユーザー同士でのチャットが可能になります。

また、多数のユーザーからアクセスされたりユーザーがページを開いたまま放置された場合、WebSocketサーバは同時に接続された状態になるため負荷がかかります。

そのため、スレッドでの返信可能時間を10分と設定しています。

返信可能時間が終わると、WebSocket Connection closed　となり、リアルタイムでのチャットができなくなります。

ページを更新すると、WebSocket Connection の確立が再度行われるため、利用が可能になります。

![image](https://github.com/Aki158/Imageboard-Webapp/assets/119317071/777c043e-9a99-4978-860e-5165eecc5775)

#### WebSocketデータのやりとり

スレッドページでユーザーがポストボタンをクリックしてからの処理について例をもとに説明します。

前提条件として、クライアント1,2,3が同じスレッドページにアクセスしチャットすることとします。

クライアント1がポストボタンをクリックして返信した場合、下記のような順番に処理されます。

![image](https://github.com/Aki158/Imageboard-Webapp/assets/119317071/4684a753-4b93-426f-b2da-812505bd4351)

1. リクエスト(クライアント1→サーバ)<br>fetchを使用して、入力フォームのデータをサーバへ送信します。<br>サーバは、入力データをチェックし問題なければ、データベースへデータを登録します。
2. レスポンス(サーバ→クライアント1)<br>クライアントへ処理が完了したことを通知します。<br>この時、クライアント2,3と共有したいデータも一緒に送信されます。
3. リクエスト(クライアント1→WebSocketサーバ)<br>取得したデータをWebSocketサーバへ送信します。
4. レスポンス(WebSocketサーバ→各クライアント)<br>スレッドページを利用している全てのユーザーへクライアント1が送信したデータを共有します。<br>共有されたデータをもとにクライアントは、JavaScriptでページに反映させます。

#### WebSocketサーバの常時稼働

WebSocketサーバは、loalhost:8080を使用しています。

これは、アプリケーションのプロセスとは別で起動させておく必要があるためSupervisorを利用しました。

Supervisorは、他のプロセスを起動し、それらが実行され続けるようにするデーモン(常駐プログラム)です。

何らかの理由で長時間稼働しているRatchetアプリケーションが停止した場合、Supervisorデーモンがすぐに起動し直すように動いてくれます。

Supervisorは、[chat-server.php](https://github.com/Aki158/Imageboard-Webapp/blob/main/chat-server.php)
を実行することで、loalhost:8080をWebSocketサーバとして稼働させています。

## 📮今後の実装したいもの
- [ ] 編集機能
- [ ] 削除機能

## 📑参考文献
### 公式ドキュメント
- [Bootstrap](https://getbootstrap.jp/)
- [PHPマニュアル](https://www.php.net/manual/ja/index.php#index)
- [MySQL](https://dev.mysql.com/doc/refman/8.0/en/innodb-online-ddl-operations.html)

### 参考にしたサイト
- [fontawesome](https://fontawesome.com/)
- [Webサービスにおけるファイルアップロード機能の仕様パターンとセキュリティ観点](https://blog.flatt.tech/entry/file_upload_security#%E5%AF%BE%E7%AD%962-%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E5%90%8D%E3%81%AE%E3%83%81%E3%82%A7%E3%83%83%E3%82%AF)
- [よくある MIME タイプ](https://developer.mozilla.org/ja/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Common_types)
- [サーバーのphp.iniによるアップロードファイルの最大容量の確認と容量制限の変更](https://www.php-factory.net/trivia/05.php)
- [【php】ファイルアップロード時のエラーコードとエラーメッセージ](https://www.softel.co.jp/blogs/tech/archives/1824)
- [ファイルサイズ変更のLinuxコマンド](https://qiita.com/yamada_yoshiki/items/b7cea46daa7b72ceb898)
