<?php
//ログイン処理
session_start();
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];

include("funcs.php");


//DB接続
$pdo = db_conn();


//データ登録SQL作成
$sql = "SELECT * FROM log_table WHERE uid=:lid AND upw=:lpw";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);  
$status = $stmt->execute();

//データ登録処理後
if($status==false){
    sql_error($stmt);
}

$val = $stmt->fetch();

if ($val["id"] != ""){
    $_SESSION["chk_ssid"] = session_id();
    $_SESSION["uname"] = $val["uname"];
    $_SESSION["uid"] = $val["uid"];
    $_SESSION["upw"] = $val["upw"];
    redirect("main.php");
}else{
    redirect("login.php");
}
?>
