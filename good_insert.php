<?php

//いいね！登録処理

session_start();
include("funcs.php");
sch();
$id = $_POST["id"];
$id_rep = $_POST["id_rep"];
$guname = $_SESSION["uname"];
$guid = $_SESSION["uid"];
$gupw = $_SESSION["upw"];

//DB接続
$pdo = db_conn();


$stmt3 = $pdo->prepare("SELECT * FROM good_table WHERE id_rep = :id_rep AND guid = :guid AND gupw = :gupw");
    $stmt3->bindValue(':id_rep', $id_rep, PDO::PARAM_INT);
    $stmt3->bindValue(':guid', $guid, PDO::PARAM_STR);
    $stmt3->bindValue(':gupw', $gupw, PDO::PARAM_STR);
    $status3 = $stmt3->execute();



    if($status3==false) {
        sql_error($stmt3);
    }else {
    $res = $stmt3->fetch();
    if($res != []){
    $chc = "done";}
    
    }


//データ登録SQL作成
if($chc != "done"){
$sql = "INSERT INTO good_table(id_rep,guname,guid,gupw)VALUES(:id_rep, :guname, :guid, :gupw)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id_rep', $id_rep, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':guname', $guname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':guid', $guid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':gupw', $gupw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //sqlと変数が合体したあとなので、ここで初めて実行される

//データ登録処理後
if($status==false){
  sql_error();
}else{
  redirect("view.php?id=".$id);
}
}
else{
    redirect("view.php?id=".$id);

}
?>
