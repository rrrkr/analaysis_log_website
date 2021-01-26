# analaysis_log_website

オープンソースのハニーポット「cowrie」で収集したアクセスログ情報を分析してまとめたwebサイトです。

収集期間半年

```
./
- index.html          // ホームページ
- upload_file.html    // データベースにログを登録
- sort_log.sh         // ログを種類ごとにディレクトリに振り分けするスクリプト
- date.php            // 日にちごとの接続を地図上にプロット

db/                   // ログ情報をデータベースで管理、表として表示
- auth.php            // セッション接続時してきたユーザ
- clients.php         // クライアントのバージョン
- downloads.php       // セッション中のダウンロード記録
- input.php           // 操作記録
- ipforwards.php      // 接続元IP,port
- ipforwardsdata.php  // 接続元IP,portの詳細
- keyfingerprints.php // フィンガープリント
- params.php          // 接続元コンピュータ
- sensors.php         // 接続元IP
- sessions.php        // セッション記録
- ttylog              // ttylog
- class/
----- db.php          // データベースのクラス

graph/                // グラフとして表示
- password.php        // 上位接続パスワード
- sum.php             // 上位接続数
- username.php        // 上位接続ユーザ

```
