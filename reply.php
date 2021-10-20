<?php

//リプライ記入画面

$id = $_GET["id"];
session_start();
include("funcs.php");
sch();


//DB接続
$pdo = db_conn();


//データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM main_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示

if($status==false) {
  sql_error($stmt);
}else{
  $row = $stmt->fetch();
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title><?=$row["uname"]?>さんのばだニュース</title>
    <style>
    body {
        padding:5px
    }
    .title{
        width:80%; height:100px;
    }
    .container{
        height:180px;
    }
    * {box-sizing: border-box;}
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> 
</head>
<body>

<!-- Head[Start] -->
    <header class="title bg-primary mx-auto text-center py-4 text-light my-4 font-weight-bold">
        <h1><?=$row["uname"]?>さんのBad News</h1>
        <div type="button" id="main" class="btn btn-light" style="position:absolute; top:60px; left:200px;">
            <a href="main.php" class="alert-link">データ一覧へ</a>
        </div>
    </header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="border my-3 w-75 mx-auto py-3 px-4 rounded-sm text-center text-break">
    <h2><?=$row["title"]?></h2>
    <h4><?=$row["naiyou"]?></h4>
    <p class="text-right"><?=$row["indate"]?></p>
</div>


<p class="text-center h3 my-5">Good NewsにChange!</p>

<div class="mx-auto my-0 text-center">
    <form method="POST" action="rinsert.php">
        <textArea name="rnaiyou" rows="10" cols="40"></textArea>            
        <input type="hidden" name="id_edited" value="<?=$row["id"]?>">
        <div class="mt-3"><input type="submit" value="送信" class="btn btn-primary"></div>
    </form>
</div>






<!-- Main[End] -->

<script src="js/bootstrap.min.js"></script>
<script>
$("#main").on("click", function(){
    window.location.href = "main.php";
})
</script>
</body>
</html>