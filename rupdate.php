<?php

//リプライ更新処理

$rnaiyou = $_POST["rnaiyou"];
$id = $_POST["id"];
$id_edited = $_POST["id_edited"];
include("funcs.php");


//DB接続
$pdo = db_conn();



//データ登録SQL作成
$sql = "UPDATE rep_table SET rnaiyou=:rnaiyou WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':rnaiyou', $rnaiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',     $id,     PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //sqlと変数が合体したあとなので、ここで初めて実行される

//データ登録処理後
if($status==false){
 sql_error($stmt);
  //index.phpへリダイレクト
}else{
  redirect('view.php?id='.$id_edited);
}
?>
