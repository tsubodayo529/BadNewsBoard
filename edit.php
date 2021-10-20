<?php

//確認処理

$id = $_GET["id"];
session_start();
include("funcs.php");
sch();



$pdo = db_conn();



$stmt = $pdo->prepare("SELECT * FROM main_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();



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
    <title>Bad News 編集</title>
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


<header class="title bg-primary mx-auto text-center py-4 text-light my-4 font-weight-bold">
        <h1>Bad News を編集する</h1>
        <div type="button" class="btn btn-light" style="position:absolute; top:60px; left:200px;">
            <a href="main.php" class="alert-link">データ一覧へ</a>
        </div>
</header>


<!-- 編集画面 -->
<div class="text-center">
    <form method="POST" action="update.php" class="my-5">
        
        <p>タイトル</p>
        <input type="text" name="title" value="<?=$row['title']?>" class="my-1 w-25"></div>
        <div class="text-center">
            <textArea name="naiyou" rows="4" cols="40" class="my-3 w-50"><?=$row["naiyou"]?></textArea>
        </div>
        <input type="hidden" name="id" value="<?=$row["id"]?>">
        <p class="text-center">投稿日 : <?=$row["indate"]?></p>
        <div class="text-center">
            <input type="submit" value="変更" class="btn btn-primary">
        </div>
    </form>
</div>



<script src="js/bootstrap.min.js"></script>

</body>
</html>
