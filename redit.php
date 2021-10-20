<?php

//リプライ編集処理

$id = $_GET["id"]; //この$idはreplyのid
session_start();
include("funcs.php");
sch();


//DB接続します
$pdo = db_conn();


//データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM rep_table WHERE id = :id");
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
        <h1>編集</h1>
        <div type="button" id="main" class="btn btn-light" style="position:absolute; top:60px; left:200px;">
            <a href="main.php" class="alert-link">データ一覧へ</a>
        </div>
</header>



<div class="text-center">
    <form method="POST" action="rupdate.php" class="text_wrap">
        
        <div class="text-center">
            <textArea name="rnaiyou" rows="4" cols="40" class="mt-5 mb-3 w-50"><?=$row["rnaiyou"]?></textArea>
        
        <input type="hidden" name="id" value="<?=$row["id"]?>">
        <input type="hidden" name="id_edited" value="<?=$row["id_edited"]?>">
        <p class="text">投稿日 : <?=$row["rindate"]?></p>
        <input type="submit" value="変更" class="btn btn-primary">
        </div>
    </form>
</div>


<!-- Main[End] -->
<script>
$("#main").on("click", function(){
    window.location.href = "main.php";
})
</script>

</body>
</html>
