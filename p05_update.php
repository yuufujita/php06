<?php require'p00_header.php';?>
<?php require_once('p99_funcs.php')?>

<?php
session_start();
loginCheck();

//1. POSTデータ取得
$s_access=$_POST['s_access'];
$s_datetime=$_POST['s_datetime'];
$recommend_memo=$_POST['recommend_memo'];
$stay_nm=$_POST['stay_nm'];
$stay_url=$_POST['stay_url'];
$stay_memo=$_POST['stay_memo'];
$star=$_POST['star'];
$area=$_POST['area'];
$aim=$_POST['aim'];
$cost=$_POST['cost'];
$id = $_POST['id'];

// implode関数により、カンマ区切りの文字列に変換する
if (isset($_POST['aim']) && is_array($_POST['aim'])) {
    $selectedAim = $_POST['aim'];
    $aimString = implode(',', $selectedAim); // 配列をカンマ区切りの文字列に変換
  }

//geocording.jp APIから緯度・経度を取得する
$url = "https://www.geocoding.jp/api/?q=" . $stay_nm;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($res);
$lat = $xml->coordinate->lat;
$lon = $xml->coordinate->lng;

// UPDATE テーブル名 SET カラム1 = 1に保存したいもの、カラム2 = 2に保存したいもの,,,, WHERE 条件 id = 送られてきたid
$stmt = $pdo->prepare('UPDATE gs_bm_table
SET 
s_access = :s_access,
s_datetime = :s_datetime,
recommend_memo = :recommend_memo,
stay_nm = :stay_nm,
stay_url = :stay_url,
stay_memo = :stay_memo,
star = :star,
area = :area,
aim = :aim,
cost = :cost,
lat = :lat,
lon = :lon,
date = sysdate(),
user_id = :user_id,
user_nm = :user_nm
WHERE id = :id;');

$stmt->bindValue(':s_access', $s_access, PDO::PARAM_STR);
$stmt->bindValue(':s_datetime', $s_datetime, PDO::PARAM_STR);
$stmt->bindValue(':recommend_memo', $recommend_memo, PDO::PARAM_STR);
$stmt->bindValue(':stay_nm', $stay_nm, PDO::PARAM_STR);
$stmt->bindValue(':stay_url', $stay_url, PDO::PARAM_STR);
$stmt->bindValue(':stay_memo', $stay_memo, PDO::PARAM_STR);
$stmt->bindValue(':star', $star, PDO::PARAM_STR);
$stmt->bindValue(':area', $area, PDO::PARAM_STR);
$stmt->bindValue(':aim', $aimString, PDO::PARAM_STR);
$stmt->bindValue(':cost', $cost, PDO::PARAM_STR);
$stmt->bindValue(':lat', $lat, PDO::PARAM_STR);
$stmt->bindValue(':lon', $lon, PDO::PARAM_STR);
$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_STR);
$stmt->bindValue(':user_nm', $_SESSION['user_nm'], PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute(); //実行

if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    header('Location: p03_select.php');
    exit();
}