<?php
    require('db/class/db.php');

    $db = new LogDB();
    $result = $db->query("SELECT * FROM `date`");
    $result_2 = $result;


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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
    <title>合計ログ数</title>
    <style type="text/css">
        h2 {padding-top:20px; padding-left:10px;}
        p {padding-bottom:1rem; padding-left:10px;}
        .graph{padding-bottom:30px;}
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
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                データベース一覧
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="/db/auth.php">auth</a>
                <a class="dropdown-item" href="/db/clients.php">clients</a>
                <a class="dropdown-item" href="/db/downloads.php">downloads</a>
                <a class="dropdown-item" href="/db/input.php">input</a>
                <a class="dropdown-item" href="/db/ipforwards.php">ipforwards</a>
                <a class="dropdown-item" href="/db/ipforwardsdata.php">ipforwardsdata</a>
                <a class="dropdown-item" href="/db/keyfingerprints.php">keyfingerprints</a>
                <a class="dropdown-item" href="/db/params.php">params</a>
                <a class="dropdown-item" href="/db/sensors.php">sensors</a>
                <a class="dropdown-item" href="/db/sessions.php">sessions</a>
                <a class="dropdown-item" href="/db/ttylog.php">ttylog</a>
              </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  グラフ一覧
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="/graph/sum.php">合計ログ数</a>
                  <a class="dropdown-item" href="/graph/username.php">ログインユーザー集計</a>
                  <a class="dropdown-item" href="/graph/password.php">パスワード集計</a>
                  <a class="dropdown-item active" href="date.php">国別IPアドレス</a>
                </div>
            </li>
          </ul>
        </div>
      </nav>
      <h2>現在までのアクセス数</h2>
      <p>地図にプロットしたい日にちをドロップボックスリストから選択してください</p>


     <div class="dropdown">
         <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             日にち
         </button>
         <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <form  method=”get”>
                 <?php
                 $ans_result = json_decode($result_2);
                 for($i = 0;$i < $ans_result->{'count'};$i++){
                     $date_result = $ans_result->{'result'};
                     print("<button class=\"dropdown-item\" type=\"submit\" name=\"date\" formaction=\"ip.php\" value=\"".$date_result[$i]->{'dateId'}."\">". $date_result[$i]->{'dateId'}."</button>");
                 }
             ?>
         </form>
         </div>
     </div>
    <!-- show database -->
    <div id="example-table"></div>
    <script type="text/javascript">
    var json = JSON.parse('<?php echo addslashes($result); ?>');
    var tableData = json['result'];
    var dataTable = new Tabulator("#example-table", {
        data:tableData,
        layout:"fitColumns",
        columns:[
            {title:"DATEID", field:"dateId"},
            {title:"SUM", field:"sum"},
        ],
    })
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
