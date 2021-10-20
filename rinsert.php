<?php

//リプライ登録処理

session_start();
include("funcs.php");
sch();


$rnaiyou= $_POST["rnaiyou"];
$runame = $_SESSION["uname"];
$ruid = $_SESSION["uid"];
$rupw = $_SESSION["upw"];
$id_edited = $_POST["id_edited"]; //リプライされた内容のid

//2. DB接続します
$pdo = db_conn();


//３．データ登録SQL作成
$sql = "INSERT INTO rep_table(id_edited,runame,ruid,rupw,rnaiyou,rindate)VALUES(:id_edited, :runame, :ruid, :rupw,  :rnaiyou, sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id_edited', $id_edited, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':runame', $runame, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':ruid', $ruid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':rupw', $rupw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':rnaiyou', $rnaiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //sqlと変数が合体したあとなので、ここで初めて実行される

//４．データ登録処理後
if($status==false){
  sql_error();
}else{
  redirect("view.php?id=".$id_edited);
}
?>
