<?php

//メイン画面

session_start();
include("funcs.php");

sch();

$pdo = db_conn();

$stmt = $pdo->prepare("SELECT * FROM main_table ORDER BY indate DESC");
$status = $stmt->execute();

//３．データ表示
$view=""; //作成したHTML文字を入れる変数
if($status==false) {
  sql_error($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<div class="post_box border my-3 w-75 mx-auto py-3 px-4 rounded-sm text-center text-break" id="'.$res["id"].'">';
    $view .= '<a class="h2 text-dark" href="view.php?id='.$res["id"].'">';
    $view .= $res["title"];
    $view .= "</a>";
    $view .= '<p class="text-right">';
    $view .= $res["uname"];
    $view .= "  :  ";
    $view .= $res["indate"];
    $view .= "</p>";
    $view .= "</div>";
  }
}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>タイムライン</title>
    <style>
    body {
        padding:5px;
    }
    .title{
        width:80%; height:100px;
    }
    .container{
        height:180px;
    }
   
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

</head>

<body>
  <header class="title bg-primary mx-auto text-center py-4 text-light my-4 font-weight-bold">
    <h1>みんなのBad News</h1>
    <div type="button" id="logout" class="btn btn-light" style="position:absolute; top:60px; left:200px;">
        <a href="logout.php" class="alert-link">ログアウト</a>
    </div>
  </header>
    <p class="text-center h5"><?=$_SESSION["uname"]?>さん  こんにちは</p>

    <div class="border-top border-secondary border-bottom py-3 w-75 mx-auto" id="1"><?=$view?></div>
   
    <div type="button" id="post" class="btn btn-light" style="position:absolute; top:60px; left:350px;">
        <a href="post.php" class="alert-link">新規投稿</a>
    </div>
    

    <div class="search_wrap" style="position:absolute; top:60px; right:200px;">
      <form action="search.php" method="POST">
        <input type="text" name="search" class="search_box">
        <input type="submit" value="検索" class="search_btn">
      </form>
    </div>

    


<!-- bootstrap install -->
<script src="js/bootstrap.min.js"></script>


<script>
    $(".post_box").on("click", function(){
        let a = $(this).attr('id');
        window.location.href = "view.php?id="+a;
    })

    $("#logout").on("click", function(){
        window.location.href = "login.php";
    })

    $("#post").on("click", function(){
        window.location.href = "post.php";
    })

</script>

</body>
</html>