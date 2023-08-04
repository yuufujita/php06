<?php
//共通に使う関数を記述
//XSS対応（ echoする場所で使用！それ以外はNG ）

//　IPA_情報処理推進機構、クロスサイトスクリプティング
function h($str){
return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}

//SQLエラー
function sql_error($stmt)
{
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('SQLError:' . $error[2]);
}

// ログインチェク処理 loginCheck()
function loginCheck(){
    if(!isset($_SESSION['chk_ssid'])||$_SESSION['chk_ssid']!==session_id()){
        exit('ログインしてください。<a class="btn btn-secondary" type="button" href="p81_login.php">ログイン</a></p>');
    }else{
        session_regenerate_id(true);
        $_SESSION['chk_ssid']=session_id();
    }
}

function star(){
    $star=['---選択---'=>'00','★★★★★'=>'05','★★★★☆'=>'04','★★★☆☆'=>'03','★★☆☆☆'=>'02','★☆☆☆☆'=>'01',];
    return $star;
}
function areaOption(){
    $areaOp=['---選択---'=>'00','北海道'=>'01','東北'=>'02','関東'=>'03','中部'=>'04','近畿'=>'05','四国'=>'06','中国'=>'07','九州'=>'08',];
    return $areaOp;
}
function aimOption(){
    $aimOp=['景色　'=>'01','温泉　'=>'02','おこもり　'=>'03','体験　'=>'04',];
    return $aimOp;
}
function costOption(){
    $costOp=['---選択---'=>'00','〜10,000'=>'01','10,001〜20,000'=>'02','20,001〜30,000'=>'03','30,001〜40,000'=>'04','40,001〜50,000'=>'05','50,001〜60,000'=>'06','60,001〜'=>'07',];
    return $costOp;
}
?>
