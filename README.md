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
このアプリケーションは、スレッドを通じて匿名でチャットができるWebアプリケーションです。

[URL](#URL)にアクセスしたユーザーなら気軽に誰でも利用することができます。

このアプリケーションでは、下記のような状況を想定して作成しました。

- 特定のコミュニティや話題について匿名で自由に意見交換をしたい
- スレッドの画像について共有して情報交換や問題の解決、ディスカッションを行いたい

基本的な機能として、スレッドの作成/スレッドへの返信/スレッドと返信の表示ができます。

レスポンシブデザイン(ユーザーが使用するデバイスの画面サイズに応じて表示を最適化するデザイン)に対応しておりますので、スマホやパソコン、ディスプレイなど様々なデバイスから利用できるようになっています。

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
| 返信の表示 | リアルタイム<br>(ポストボタンをクリックすると、返信が共有される) |
| 返信可能時間 | ページにアクセスまたはユーザーが返信してから10分間<br>(新たに返信があれば、0秒にリセットされる)<br>返信可能時間終了後に返信したい場合は、ページの更新が必要 |

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
1. 「スレッドと返信の表示」の手順を実施してからスレッドページに移動する
2. スレッドと返信を見て話題について理解する
3. コメントを入力する
4. 画像 ボタンをクリックして、アップロードするファイルを選択する
5. ポスト ボタンをクリックする
6. 返信した内容がスレッドに表示されることを確認する

## 🙋使用例
イメージは[デモ](#デモ)を参考にしてください。

また、使用する前に[注意事項](#注意事項)を確認してください。

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
1. 「スレッドと返信の表示」の手順を実施してからスレッドページに移動する
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
ER図の説明は、[自己参照型のERテーブル](#自己参照型のERテーブル)を確認してください。

![ER](https://github.com/Aki158/Imageboard-Webapp/assets/119317071/f383251e-2455-4bf9-9c9b-3a88c2a0aee2)

## 👀機能一覧
### ヘッダー

![image](https://github.com/Aki158/Imageboard-Webapp/assets/119317071/4792b55a-f8e3-4fed-94e5-c5641b9c7602)

| 機能 | 内容 |
| ------- | ------- |
| スレッド | ボタンをクリックすると、スレッド作成ページに遷移します。 |
| ホーム | ボタンをクリックすると、ホームページに遷移します。 |

### スレッド作成ページ

![image](https://github.com/Aki158/Imageboard-Webapp/assets/119317071/dc86008e-6d1f-470f-a268-665a4c2d6dbc)

| 機能 | 内容 |
| ------- | ------- |
| タイトル | タイトルを任意で入力できます。<br>タイトルは、50文字以内におさめてください。<br>入力文字数は、リアルタイムでカウントされるため、現在の入力文字数をすぐに確認できます。<br>(入力フォーム上の`0/50`の数字は、`現在の入力文字数/入力文字数の上限`を表しています) |
| コメント | コメントは1~400文字で入力が必要です。<br>入力文字数は、リアルタイムでカウントされるため、現在の入力文字数をすぐに確認できます。<br>(入力フォーム上の`0/400`の数字は、`現在の入力文字数/入力文字数の上限`を表しています)<br>また、コメントを未入力の状態でポストボタンをクリックした場合は、スレッドの作成はできません。 |
| 画像 | ボタンをクリックして、アップロードするファイルの選択が必要です。<br>ファイルは、gif/png/jpegのいづれかから選択してください。<br>それ以外のファイルを選択しても、アップロードすることはできません。 |
| ポスト | タイトル(任意)/コメント/画像を設定した後にクリックしてください。<br>設定した情報をもとに、スレッドを作成します。<br>スレッドの作成に成功した場合は、「ポストできました!」というアラートが表示されます。<br>失敗した場合は、入力を見直すようにアラートを表示します。 |
| アラート | `ポスト`ボタンをクリックした後に、入力情報(タイトル(任意)/コメント/画像)をデータベースに登録する処理を行います。<br>処理の結果をアラートとして表示します。<br>アラートには下記のような表示パターンがあります。<br>■ポスト成功時<br>・「ポストできました!」と表示<br>■失敗時<br>・タイトル(任意)/コメント/画像すべてが未入力時<br>・コメント/画像の片方のみ入力時<br>・5MBを超える画像を選択している場合<br>・画像にメディアファイル(png/gif/jpeg)以外を選択している場合<br>・画像の保存ができない時<br>・その他(プログラムが原因によるエラー発生時) |

### ホームページ

![image](https://github.com/Aki158/Imageboard-Webapp/assets/119317071/197723de-7089-457b-82c2-fc6fbb84f179)

| 機能 | 内容 |
| ------- | ------- |
| スレッドの表示 | スレッドをリストとして新しい順に最大100件まで表示します。 |
| 返信の表示 | スレッド内で既にチャットが行われている場合は、古い順に最大5件まで表示します。 |
| 返信する or もっと見る... | クリックすると、スレッドページに遷移します。 |

### スレッドページ

![image](https://github.com/Aki158/Imageboard-Webapp/assets/119317071/e1dcb0e9-0933-4248-9cac-e660adcc4b87)

| 機能 | 内容 |
| ------- | ------- |
| コメント | コメントは1~400文字で入力が必要です。<br>入力文字数は、リアルタイムでカウントされるため、現在の入力文字数をすぐに確認できます。<br>(入力フォーム上の`0/400`の数字は、`現在の入力文字数/入力文字数の上限`を表しています)<br>また、コメントを未入力の状態でポストボタンをクリックした場合は、スレッドの作成はできません。 |
| 画像 | ボタンをクリックして、アップロードするファイルの選択が必要です。<br>ファイルは、gif/png/jpegのいづれかから選択してください。<br>それ以外のファイルを選択しても、アップロードすることはできません。 |
| ポスト | コメント/画像を設定した後にクリックしてください。<br>設定した情報をもとに、スレッドへ返信します。<br>返信に成功した場合は、ページの一番下に返信が追加されます。<br>失敗した場合は、入力を見直すようにアラートを表示します。 |
| 新しいメッセージがあります | ページの一番下までスクロールしていない状態で他のユーザーが返信すると、表示されます。<br>クリックすると、ページの一番下までスクロールされ返信を見ることができます。 |
| 返信可能時間 | ページにアクセスまたはユーザーが返信してから10分間返信できます。<br>この10分間は、新たに返信があれば、0秒にリセットされます。 |
| アラート | `ポスト`ボタンをクリックした後に、入力情報(タイトル(任意)/コメント/画像)をデータベースに登録する処理を行います。<br>処理の結果をアラートとして表示します。<br>アラートには下記のような表示パターンがあります。<br>■ポスト成功時<br>・「ポストできました!」と表示<br>■失敗時<br>・タイトル(任意)/コメント/画像すべてが未入力時<br>・コメント/画像の片方のみ入力時<br>・5MBを超える画像を選択している場合<br>・画像にメディアファイル(png/gif/jpeg)以外を選択している場合<br>・画像の保存ができない時<br>・その他(プログラムが原因によるエラー発生時)<br>■その他<br>・返信可能時間終了後 |

### 画像

| 機能 | 内容 |
| ------- | ------- |
| 画像の保存 | アップロードされたすべての画像はサーバ側のストレージフォルダーに保存されます。<br>画像ファイル名には、PHPのhash関数を利用しています。<br>すべての画像は、画像の保存時にサムネイルバージョンを作成します。<br>サムネイルの作成には、ImageMagickを使用して画像ファイルを300x300 ピクセルの画像に変換してThumbnailsフォルダに保存しています。<br>これは、ホームページやスレッドページのプレビューで使用されます。<br>ImageMagickを使用している処理は、[サムネイルバージョンへの画像変換処理](https://github.com/Aki158/Imageboard-Webapp/blob/d8341da5eb31839775d325bb253c70c9a70b450d/Helpers/ValidationHelper.php#L89-L96)から確認することができます。 |
| 画像の表示 | ホームページやスレッドページで表示される画像をクリックすると、フルバージョンの画像を表示します。 |

## 📜作成の経緯
下記項目の理解を深めるために作成しました。
- データアクセス層
- ERテーブル(自己参照型)
- データベースシーダーを利用したテスト
- WebSocket

## ⭐️こだわった点
### DAOを使用したデータ層へのアクセス

関心の分離と可読性のために下記のプロジェクトでは、DatabaseHelperを使用していました。

その理由は、コントローラがデータのクエリ、アクセス、または低レベルの手続きを行うことに関心を持つべきではないためです。

- [Text-Snippet-Sharing-ServiceのDatabaseHelper.php](https://github.com/Aki158/Text-Snippet-Sharing-Service/blob/main/Helpers/DatabaseHelper.php)
- [Online-Image-Hosting-ServiceのDatabaseHelper.php](https://github.com/Aki158/Online-Image-Hosting-Service/blob/main/Helpers/DatabaseHelper.php)

コントローラが関心を持っているのは、特定のIDに基づいたデータを取得するというビジネスロジックのみです。

コントローラは、データの取得と設定をデータアクセス層に委ねることができます。

データアクセス層は、ビジネスロジックを扱うアプリケーション層（[routes.php](https://github.com/Aki158/Imageboard-Webapp/blob/main/Routing/routes.php)下のコントローラなど）とデータ層（MySQLのようなSQL RDBMSなど）の間の橋渡しをします。

このデータアクセス層をデータアクセスオブジェクト(DAO)クラスとして定義します。

これを利用することにより、ビジネスロジックのコードに影響を与えることなく、データ層との連携を担うコードの多くを容易に交換することができます。

例えば、今回は、データ層にMySQLを使用していますが、MongoDBのような他のDBに交換することもできます。

DAOに関係するファイルは、下記から確認することができます。

- [PostDAO.php(DAOインターフェース)](https://github.com/Aki158/Imageboard-Webapp/blob/main/Database/DataAccess/Interfaces/PostDAO.php)
- [PostDAOImpl.php(DAOインターフェースの実装)](https://github.com/Aki158/Imageboard-Webapp/blob/main/Database/DataAccess/Implementations/PostDAOImpl.php)

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

seedコマンドの実行が完了した後は、下記項目を確認するだけで表示に関わるテストを完了させることができます。

- データベースに偽データが登録されていること
- Imagesフォルダにダミー画像がコピーされていること
- Thumbnailsフォルダにダミー画像のサムネイルバージョンがコピーされていること
- ホームページとスレッドページを確認し期待している表示になっていること

seedコマンドに関係するファイルは、下記から確認することができます。

- [Seed.php](https://github.com/Aki158/Imageboard-Webapp/blob/main/Commands/Programs/Seed.php)
- [PostSeeder1_Thread.php](https://github.com/Aki158/Imageboard-Webapp/blob/main/Database/Seeds/PostSeeder1_Thread.php)
- [PostSeeder2_Reply.php](https://github.com/Aki158/Imageboard-Webapp/blob/main/Database/Seeds/PostSeeder2_Reply.php)

また、[テスト用のissue](https://github.com/Aki158/Imageboard-Webapp/issues/4)を作成しローカル環境と本番環境で期待通りの動作をすることを確認しています。

### WebSocketでのリアルタイム通信

スレッドページでは、リアルタイムでユーザー同士が匿名でのチャットを楽しむことができます。

この機能は、PHPのRatchetライブラリを利用して実現させています。

Ratchetライブラリは、WebSocketを介してクライアントとサーバー間のリアルタイム双方向アプリケーションを作成するためのライブラリです。

WebSocketとは、Webにおいて双方向通信を低コストで行うための仕組みのことです。

WebSocketに関係するファイルは、下記から確認することができます。

- [app_thread.js](https://github.com/Aki158/Imageboard-Webapp/blob/main/Public/js/app_thread.js)
- [autobahn.js](https://github.com/Aki158/Imageboard-Webapp/blob/main/Public/js/autobahn.js)
- [chat-server.php](https://github.com/Aki158/Imageboard-Webapp/blob/main/chat-server.php)
- [Pusher.php](https://github.com/Aki158/Imageboard-Webapp/blob/main/WebSocket/Pusher.php)

#### WebSocket通信の確立から切断までの流れ

WebSocket通信の基本的な流れは、下記シーケンス図の通りです。

スレッドページへユーザーがアクセスすると、クライアントとWebSocketサーバ間でWebSocket Connection の確立を行います。

通信が確立されると、WebSocketを利用できるようになり、ユーザー同士でのチャットが可能になります。

また、多数のユーザーからアクセスされたりユーザーがページを開いたまま放置された場合、WebSocketサーバは同時に接続された状態になるため負荷がかかります。

そのため、スレッドでの返信可能時間を10分と設定しています。

返信可能時間が終わると、WebSocket Connection closed　となり、リアルタイムでのチャットができなくなります。

ページを更新すると、WebSocket Connection の確立が再度行われるため、利用が可能になります。

![image](https://github.com/Aki158/Imageboard-Webapp/assets/119317071/777c043e-9a99-4978-860e-5165eecc5775)

#### WebSocketデータのやりとり

スレッドページでユーザーがポストボタンをクリックしてからの処理について例をもとに説明します。

前提条件として、クライアント1,2,3がそれぞれ同じスレッドページにアクセスしチャットすることとします。

クライアント1がポストボタンをクリックして返信した場合、下記のような順番で処理されます。

![image](https://github.com/Aki158/Imageboard-Webapp/assets/119317071/4684a753-4b93-426f-b2da-812505bd4351)

1. リクエスト(クライアント1→サーバ)<br>fetchを使用して、入力フォームのデータをサーバへ送信します。<br>サーバは、入力データをチェックし問題なければ、データベースへデータを登録します。
2. レスポンス(サーバ→クライアント1)<br>クライアントへ処理が完了したことを通知します。<br>この時、クライアント2,3と共有したいデータも一緒に送信されます。
3. リクエスト(クライアント1→WebSocketサーバ)<br>取得したデータをWebSocketサーバへ送信します。
4. レスポンス(WebSocketサーバ→各クライアント)<br>スレッドページを利用している全てのユーザーへクライアント1が送信したデータを共有します。<br>共有されたデータをもとにクライアントは、JavaScriptでスレッドページにデータを反映させます。

#### WebSocketサーバの常時稼働

WebSocketサーバは、アプリケーションのプロセスとは別で起動させておく必要があるためSupervisorを利用しました。

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
- [Ratchet](http://socketo.me/)
- [Ratchetのリポジトリ](https://github.com/ratchetphp/Ratchet)
- [autobahn-jsのリポジトリ](https://github.com/crossbario/autobahn-js)
- [fontawesome](https://fontawesome.com/)

### 参考にしたサイト
#### ファイルアップロード
- [Webサービスにおけるファイルアップロード機能の仕様パターンとセキュリティ観点](https://blog.flatt.tech/entry/file_upload_security#%E5%AF%BE%E7%AD%962-%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E5%90%8D%E3%81%AE%E3%83%81%E3%82%A7%E3%83%83%E3%82%AF)
- [よくある MIME タイプ](https://developer.mozilla.org/ja/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Common_types)
- [サーバーのphp.iniによるアップロードファイルの最大容量の確認と容量制限の変更](https://www.php-factory.net/trivia/05.php)
- [【php】ファイルアップロード時のエラーコードとエラーメッセージ](https://www.softel.co.jp/blogs/tech/archives/1824)

#### FakerPHP
- [FakerPHP非公式リファレンス for v1.23.0](https://fwhy.github.io/faker-docs/)

#### Ratchet
- [PHPとJavaScriptで擬似リアルタイムチャットを作る](https://iritec.jp/web_service/6632/)
- [Rafael Capoani](https://www.youtube.com/@RafaelCapoani)
- [RafaelCapoのリポジトリ:chat_ratchet_with_rooms](https://github.com/RafaelCapo/chat_ratchet_with_rooms)

#### WebSocket
- [WebSocketについて調べてみた。](https://qiita.com/south37/items/6f92d4268fe676347160)
- [今さら聞けないWebSocketとは](https://qiita.com/chihiro/items/9d280704c6eff8603389)
- [NginxのリバースプロキシでWebソケットを通す際の設定](https://qiita.com/YuukiMiyoshi/items/d56d99be7fb8f69a751b)
- [Nginxを用いたWebSocketサーバのReverseProxy構成及びSSL/TLS接続](https://uorat.hatenablog.com/entry/2016/09/19/203939)
- [nginxをWebSocketのリバースプロキシとして使う](https://sweep3092.hatenablog.com/entry/2014/11/17/101654)

#### CSS
- [【保存版】CSSでボタンを作る方法を徹底解説！コピペで使えるサンプルコードあり。](https://pg-log.com/css-button/)

#### その他
- [HTTPステータスコード](https://kaede.jp/2018/09/15225925/)
- [426エラー（Upgrade Required）とは？意味をわかりやすく解説](https://find-a.jp/seotimes/glossary/426error/#:~:text=426%E3%82%A8%E3%83%A9%E3%83%BC%EF%BC%88Upgrade%20Required%EF%BC%89%E3%81%A8%E3%81%AF%E3%80%81HTTP%E3%82%B9%E3%83%86%E3%83%BC%E3%82%BF%E3%82%B9%E3%82%B3%E3%83%BC%E3%83%89,%E3%83%A1%E3%83%83%E3%82%BB%E3%83%BC%E3%82%B8%E3%82%92%E4%BC%9D%E3%81%88%E3%82%8B%E3%82%82%E3%81%AE%E3%81%A7%E3%81%99%E3%80%82)
