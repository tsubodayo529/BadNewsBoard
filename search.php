<?php 

$search = $_POST["search"];

session_start();
include("funcs.php");
sch();

$pdo = db_conn();

$stmt = $pdo->prepare("SELECT * FROM main_table WHERE title LIKE '%".$search."%' OR naiyou LIKE '%".$search."%' OR uname LIKE '%".$search."%' ORDER BY indate DESC");
$status = $stmt->execute();
$view = "";

//３．データ表示
$table=""; //作成したHTML文字を入れる変数
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);

}else{
 
    while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<div class="post_box border my-3 w-75 mx-auto py-3 px-4 rounded-sm" id="'.$res["id"].'"><div class="text-center text-break">';
    $view .= '<a class="h2 text-dark" href="view.php?id='.$res["id"].'">';
    $view .= $res["title"];
    $view .= "</div></a>";
    $view .= '<p class="text-right">';
    $view .= $res["uname"];
    $view .= "  :  ";
    $view .= $res["indate"];
    $view .= "</p>";
    $view .= "</div>";

}

};

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>ログイン画面</title>
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
<head/>

<body>

    <header class="title bg-primary mx-auto text-center py-4 text-light my-4 font-weight-bold">
        <h1>検索結果</h1>
        <div type="button" id="main" class="btn btn-light" style="position:absolute; top:60px; left:200px;">
            <a href="main.php" class="alert-link">データ一覧へ</a>
        </div>
    </header>
    <p class="text-center h5"><?=$_SESSION["uname"]?>さん  こんにちは</p>

    <div class="border-top border-secondary border-bottom py-3 w-75 mx-auto"><?=$view?></div>


<script src="js/bootstrap.min.js"></script>

<script>
    $(".post_box").on("click", function(){
        let a = $(this).attr('id');
        window.location.href = "view.php?id="+a;
    })

</script>

<script>
$("#main").on("click", function(){
    window.location.href = "main.php";
})
</script>

</body>
</html>