<?php
    require('class/db.php');

    $db = new LogDB();
    $result = $db->query("SELECT * FROM `sessions` ORDER BY `starttime` desc limit 20");
?>
<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!-- tabulator CSS -->
    <link href="https://unpkg.com/tabulator-tables@4.1.4/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.1.4/dist/js/tabulator.min.js"></script>
    <title>sessions</title>
    <style type="text/css">
        h2 {padding-top:20px; padding-left:10px;}
        p {padding-bottom:1rem; padding-left:10px;}
    </style>
  </head>
  <body>
      <!-- navbar -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">cowrie</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/">ホーム <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/upload_file.html">データベース登録</a>
            </li>
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                データベース一覧
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="auth.php">auth</a>
                <a class="dropdown-item" href="clients.php">clients</a>
                <a class="dropdown-item" href="downloads.php">downloads</a>
                <a class="dropdown-item" href="input.php">input</a>
                <a class="dropdown-item" href="ipforwards.php">ipforwards</a>
                <a class="dropdown-item" href="ipforwardsdata.php">ipforwardsdata</a>
                <a class="dropdown-item" href="keyfingerprints.php">keyfingerprints</a>
                <a class="dropdown-item" href="params.php">params</a>
                <a class="dropdown-item" href="sensors.php">sensors</a>
                <a class="dropdown-item active" href="sessions.php">sessions</a>
                <a class="dropdown-item" href="ttylog.php">ttylog</a>
              </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  グラフ一覧
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="/graph/sum.php">合計ログ数</a>
                  <a class="dropdown-item" href="/graph/username.php">ログインユーザー集計</a>
                  <a class="dropdown-item" href="/graph/password.php">パスワード集計</a>
                  <a class="dropdown-item" href="/date.php">国別IPアドレス</a>
                </div>
            </li>
          </ul>
        </div>
      </nav>
      <h2>sessions</h2>
      <p>sessionsテーブルから最新20件を取得します</p>
    <!-- show database -->
    <div id="example-table"></div>
    <script type="text/javascript">
    var json = JSON.parse('<?php echo addslashes($result); ?>');
    var tableData = json['result'];
    var dataTable = new Tabulator("#example-table", {
        data:tableData,
        layout:"fitColumns",
        columns:[
            {title:"ID", field:"id"},
            {title:"STARTTIME", field:"starttime"},
            {title:"ENDTIME", field:"endtime"},
            {title:"SENSOR", field:"sensor"},
            {title:"IP", field:"ip"},
            {title:"TERMSIZE", field:"termsize"},
            {title:"CLIENT", field:"client"}
        ],
    })
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
