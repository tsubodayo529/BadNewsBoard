<?php

//バッドニュース登録処理

session_start();
include("funcs.php");
sch();

$title = $_POST["title"];
$naiyou= $_POST["naiyou"];
$uname = $_SESSION["uname"];
$uid = $_SESSION["uid"];
$upw = $_SESSION["upw"];

//DB接続
$pdo = db_conn();


//データ登録SQL作成
$sql = "INSERT INTO main_table(uname,uid,upw,title,naiyou,indate)VALUES(:uname, :uid, :upw, :title, :naiyou, sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':uname', $uname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':uid', $uid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':upw', $upw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //sqlと変数が合体したあとなので、ここで初めて実行される

//データ登録処理後
if($status==false){
  sql_error();
}else{
  redirect("main.php");
}
?>
