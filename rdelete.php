<?php

//リプライ削除処理

$id = $_GET["id"];

include("funcs.php");

//DB接続
$pdo1 = db_conn();


//データ登録SQL作成
$sql1 = "SELECT * FROM rep_table WHERE id=:id";
$stmt1 = $pdo1->prepare($sql1);
$stmt1->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status1 = $stmt1->execute(); //sqlと変数が合体したあとなので、ここで初めて実行される


if($status1==false){
 sql_error($stmt1);
}else{
  $r = $stmt1->fetch();
}

$pdo = db_conn();

$sql = "DELETE FROM rep_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  
$status = $stmt->execute(); 

//データ登録処理後
if($status==false){
 sql_error();
}else{
  redirect('view.php?id='.$r["id_edited"]);
}
?>