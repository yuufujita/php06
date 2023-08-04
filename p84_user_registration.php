<?php require'p00_header.php';?>
<?php require_once('p99_funcs.php')?>

<?php

//1. POSTデータ取得
$user_nm=$_POST['user_nm'];
$login_id=$_POST['login_id'];
$login_pw=$_POST['login_pw'];

//２.  DB接続（p00_header.phpに記載）

//４．データ登録SQL作成

//(1) SQL文を用意
$stmt = $pdo->prepare("INSERT INTO gs_user_table(user_id, user_nm, login_id, login_pw, kanri_flg)
 VALUES (NULL, :user_nm, :login_id, :login_pw, 0)");

//(2) バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR

$stmt->bindValue(':user_nm', $user_nm, PDO::PARAM_STR);
$stmt->bindValue(':login_id', $login_id, PDO::PARAM_STR);
$stmt->bindValue(':login_pw', $login_pw, PDO::PARAM_STR);

//５. 実行
$status = $stmt->execute();

//６．データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}else{

//７．登録が成功した場合の処理、p01_index.phpへリダイレクト
//header('Location:p01_index.php');
echo '<a href="p81_login.php">ログイン画面へ</a>';

}
?>

<?php require'p99_footer.php';?>