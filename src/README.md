#アプリケーション名
お問い合わせフォーム（確認テスト）

##環境構築

Dockerビルド
1.git clone リンク
2.docker-compose up -d --build

*MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。

Laravel環境構築

1.docker-compose exec php bash
2.composer install
3.env.exampleファイルから.envを作成し、環境変数を変更
4.php artisan key:generate
5.php artisan migrate
6.php artisan db:seed

##使用技術（実行環境）

・PHP 7.4.9
・Laravel 8
・MySQL 8.0.26

##ER図

srcフォルダのdiagrams.netフォルダのindex.drawio.pngを確認願います。

##URL

開発環境:http://localhost/
phpMyAdmin:http://localhost:8080/

##注意事項
・ログイン時、ユーザー登録時にそれぞれ管理画面、ログイン画面に遷移せず、お問い合わせフォームに飛ぶことがあると思います。
その時は、手動でlocalhost/adminで管理画面に遷移してください。
・たまにstorageフォルダのframeworkフォルダ内のファイルを指すエラーが起きることがありますが、指定されたファイルを消すか、sudo chmod -R 777 src/*コマンドを打つと解決できると思います。
