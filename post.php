<?php

//新規投稿画面

session_start();
include("funcs.php");
sch();
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>新規投稿</title>
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
        <h1>Bad News を投稿する</h1>
        <div type="button" id="main" class="btn btn-light" style="position:absolute; top:60px; left:200px;">
            <a href="main.php" class="alert-link">データ一覧へ</a>
        </div>
</header>



<p class="text-center h5"><?=$_SESSION["uname"]?>さん  こんにちは</p>

<!-- 投稿画面 -->
<div class="text-center">
    <form method="POST" action="insert.php" class="my-5">
    
        <input type="text" name="title" placeholder="タイトル" class="my-3 w-25">
        <div class="textarea">
            <textArea name="naiyou" rows="10" cols="40" class="my-3 w-50"></textArea>
        </div>
        <input type="submit" value="タイムラインに投稿" class="btn btn-primary">
    </form>
</div>
<!-- 投稿画面 -->


<!-- javascript -->
<script src="js/bootstrap.min.js"></script>

<script>
$("#main").on("click", function(){
    window.location.href = "main.php";
})
</script>

</body>
</html>
