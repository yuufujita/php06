<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('p99_funcs.php');
session_start();
loginCheck();
$costOp=costOption();

require_once('p21_model.php');
$pdo = db_connect();
$photo = get_chat_photo($pdo);
$detail01 = get_chat_detail_01($pdo);
$detail02 = get_chat_detail_02($pdo);
$detail03 = get_chat_detail_03($pdo);
$question = get_chat_question($pdo);
$together = get_chat_together($pdo);
//$chat = get_chat($pdo);

require_once('p22_view.php');

/*
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    post_chat_question($pdo);
}
*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['user_chat'])) {
        post_chat_question($pdo);
    } elseif (isset($_POST['together_chat'])) {
        post_chat_together($pdo);
}
}

?>