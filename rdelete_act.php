<?php

//リプライ削除確認処理

session_start();
include("funcs.php");
$id = $_POST["id"];
$suid = $_SESSION["uid"];
$supw = $_SESSION["upw"];
$suname = $_SESSION["uname"];

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "SELECT * FROM rep_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //sqlと変数が合体したあとなので、ここで初めて実行される

//４．データ登録処理後
if($status==false){
  sql_error();
}

$val = $stmt->fetch();

if ($val["id"] != "" && $suid == $val["ruid"] && $supw == $val["rupw"]){
    header('Location: rdelete.php?id='.$val["id"]);
    
   
}else{
    echo "投稿者本人しか削除はできません。";
}
exit();
?>
