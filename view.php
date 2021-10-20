<?php

$id = $_GET["id"];
session_start();
include("funcs.php");
sch();

$guname = $_SESSION["uname"];
$guid = $_SESSION["uid"];
$gupw = $_SESSION["upw"];
$pdo = db_conn();



//バッドニュース読み込み
$stmt = $pdo->prepare("SELECT * FROM main_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false) {
  sql_error($stmt);
}else{
  $row = $stmt->fetch();
}



// リプライの読み込み
$stmt2 = $pdo->prepare("SELECT * FROM rep_table WHERE id_edited = :id ORDER BY rindate DESC");
$stmt2->bindValue(':id', $id, PDO::PARAM_INT);
$status2 = $stmt2->execute();



if($status2==false) {
    sql_error($stmt2);
}else{
  
}
 $view = "";
while( $row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
    
    $id_rep = $row2["id"];


    // 各リプライ毎にいいね数の読み込み
    $stmt3 = $pdo->prepare("SELECT * FROM good_table WHERE id_rep = :id_rep");
    $stmt3->bindValue(':id_rep', $id_rep, PDO::PARAM_INT);
    $status3 = $stmt3->execute();

    if($status3==false) {
        sql_error($stmt3);
    }else{
    $view3 = "";
    $array3 = [];
   
    while( $row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
        $array3[] = $row3["id"]; 
    }
}
    $gnum = count($array3);
    

//表示に関する部分
    $view .= "<div class='border my-3 w-50 p-3 px-4 rounded-sm shadow p-3 mb-5 ml-auto' style='margin-right:200px'>";
    $view .= "<h4>";
    $view .= $row2["rnaiyou"];
    $view .= "</h4>";
    $view .= "<p class='text-right'>";
    $view .= $row2["runame"];
    $view .= "  :  ";
    $view .= $row2["rindate"];
    $view .= "</p><div class='d-flex justify-content-around'>";
    $view .= '<form method="POST" action="redit_act.php">
            <input type="hidden" name="id" value="'.$row2["id"].'">
            <input type="submit" value="更新" class="btn btn-primary">
        </form>';
    $view .= '<form method="POST" action="rdelete_act.php">
            <input type="hidden" name="id" value="'.$row2["id"].'">
            <input type="submit" value="削除" class="btn btn-warning">
        </form>';
    $view .= '<form method="POST" action="good_insert.php">
            <input type="hidden" name="id" value="'.$id.'">
            <input type="hidden" name="id_rep" value="'.$row2["id"].'">
            <input type="submit" value="いいね！ '.$gnum.' " class="btn btn-primary">
        </form>';

    $view .= "</div></div>";

  
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


    <header class="title bg-primary mx-auto text-center py-4 text-light my-4 font-weight-bold">
        <h1><?=$row["uname"]?>さんのBad News</h1>
        <div type="button" id="main" class="btn btn-light" style="position:absolute; top:60px; left:200px;">
            <a href="main.php" class="alert-link" >データ一覧へ</a>
        </div>
        <div type="button" id="good" class="btn btn-light" style="position:absolute; top:60px; right:200px;">
            <a href="reply.php?id=<?=$id?>" class="alert-link">Good Newsにする</a>
        </div>
    </header>



<p class="text-center h5"><?=$_SESSION["uname"]?>さん  こんにちは</p>


<div class="border my-3 w-75 mx-auto py-3 px-4 rounded-sm text-center text-break">
    <h2><?=$row["title"]?></h2>
    <h4><?=$row["naiyou"]?></h4>
    <p class="text-right"><?=$row["indate"]?></p>

    <div class="d-flex justify-content-around">  
            <form method="POST" action="edit_act.php">
                <input type="hidden" name="id" value="<?=$row["id"]?>">
                <input type="submit" value="更新" class="btn btn-primary">
            </form>
       
            <form method="POST" action="delete_act.php">
                <input type="hidden" name="id" value="<?=$row["id"]?>">
                <input type="submit" value="削除" class="btn btn-warning text-dark">
            </form>
    </div>
</div>




<p class="text-center h3 my-5">みんながGood Newsにしてくれるよ！</p>


<?=$view?>


<br>






<!-- Main[End] -->


<!-- bootstrap install -->
<script src="js/bootstrap.min.js"></script>

<script>
$("#main").on("click", function(){
    window.location.href = "main.php";
})

$("#good").on("click", function(){
    window.location.href = "reply.php?id=<?=$id?>";
})

</script>

</body>
</html>