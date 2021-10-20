<?php

//新規ユーザー登録処理

$uid = $_POST["uid"];
$upw = $_POST["upw"];
$uname = $_POST["uname"];

include("funcs.php");




//DB接続します
$pdo = db_conn();

//データ登録SQL作成
$sql = "INSERT INTO log_table(uid,upw,uname,indate)VALUES(:uid, :upw, :uname, sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':uid', $uid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':upw', $upw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':uname', $uname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //sqlと変数が合体したあとなので、ここで初めて実行される

//データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("login.php");
};

?>
