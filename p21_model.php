<?php

function db_connect()
{
try {
    $db_name = 'gs_db'; //データベース名
    $db_id   = 'root'; //アカウント名
    $db_pw   = ''; //パスワード：MAMPは'root'
    $db_host = 'localhost'; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
    return $pdo;
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}
}

function get_chat_photo($pdo)
{
    //２．データ登録SQL作成
    $stmt = $pdo->prepare('SELECT * FROM gs_bm_table;');
    $status = $stmt->execute();
    
    //３．データ表示
    $photo = '';
    if ($status === false) {
        $error = $stmt->errorInfo();
        exit('SQLError:' . print_r($error, true));
    } else {
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (isset($_GET['id']) && $result['id'] == $_GET['id']) {
                $photo .= '<img src="' . h($result['image01']) . '" alt="一押し写真" class="h-48 mx-auto"><br>';
            }
        }
        return $photo;
    }
}

function get_chat_detail_01($pdo)
{
    //２．データ登録SQL作成
    $stmt = $pdo->prepare('SELECT * FROM gs_bm_table;');
    $status = $stmt->execute();
    
    //３．データ表示
    $detail01 = '';
    if ($status === false) {
        $error = $stmt->errorInfo();
        exit('SQLError:' . print_r($error, true));
    } else {
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (isset($_GET['id']) && $result['id'] == $_GET['id']) {
                $detail01 .= '更新日付：'.h($result['date']);
                $detail01 .= '<br>旅の開始日付：'.h($result['s_datetime']);
                $detail01 .= '<br>旅の開始駅：'.h($result['s_access']);
                $detail01 .= '<br>宿泊先：'.h($result['stay_nm']);
                $detail01 .= '<br>宿泊先URL：'.'<a class ="font-medium text-blue-600 dark:text-blue-500 hover:underline href="'.h($result['stay_url']).'">'.h($result['stay_url']).'</a>';
                //$detail01 .= '<br>予算：'.h($result['cost']);
            }
        }
        return $detail01;
    }
}

function get_chat_detail_02($pdo)
{
    //２．データ登録SQL作成
    $stmt = $pdo->prepare('SELECT * FROM gs_bm_table;');
    $status = $stmt->execute();
    
    //３．データ表示
    $detail02 = '';
    if ($status === false) {
        $error = $stmt->errorInfo();
        exit('SQLError:' . print_r($error, true));
    } else {
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (isset($_GET['id']) && $result['id'] == $_GET['id']) {
                //$detail02 .= h($result['schedule']);
                $detail02 .= $result['schedule'];
            }
        }
        return $detail02;
    }
}

function get_chat_detail_03($pdo)
{
    //２．データ登録SQL作成
    $stmt = $pdo->prepare('SELECT * FROM gs_bm_table;');
    $status = $stmt->execute();
    
    //３．データ表示
    $detail03 = '';
    if ($status === false) {
        $error = $stmt->errorInfo();
        exit('SQLError:' . print_r($error, true));
    } else {
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (isset($_GET['id']) && $result['id'] == $_GET['id']) {
                $detail03 .= 'メモ：'.h($result['stay_memo']);
            }
        }
        return $detail03;
    }
}

function get_chat_question($pdo)
{
    //２．データ登録SQL作成
    $stmt = $pdo->prepare('SELECT * FROM gs_chat_table;');
    $status = $stmt->execute();
    
    //３．データ表示
    $question = '';
    if ($status === false) {
        $error = $stmt->errorInfo();
        exit('SQLError:' . print_r($error, true));
    } else {
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (isset($_GET['id']) && $result['id'] == $_GET['id']) {
                if($result['user_id'] == $_SESSION['user_id']){
                    $question .= '<div class="flex"><div class="w-4/5 mb-3 p-2 rounded-lg bg-fuchsia-100">';
                }else{
                    $question .= '<div class="flex flex-row-reverse"><div class="w-4/5 mb-3 p-2 rounded-lg bg-fuchsia-100 ">';
                }
                $question .= '投稿日付：'.h($result['date']).'<br>投稿者：'.h($result['user_nm']).'<br>'.h($result['user_chat']).'<br></div></div>';
            }
        }
        return $question;
    }
}

function get_chat_together($pdo)
{
    //２．データ登録SQL作成
    $stmt = $pdo->prepare('SELECT * FROM gs_together_table;');
    $status = $stmt->execute();
    
    //３．データ表示
    $together = '';
    if ($status === false) {
        $error = $stmt->errorInfo();
        exit('SQLError:' . print_r($error, true));
    } else {
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (isset($_GET['id']) && $result['id'] == $_GET['id']) {
                if($result['user_id'] == $_SESSION['user_id']){
                    $together .= '<div class="flex"><div class="w-4/5 mb-3 p-2 rounded-lg bg-fuchsia-100">';
                }else{
                    $together .= '<div class="flex flex-row-reverse"><div class="w-4/5 mb-3 p-2 rounded-lg bg-fuchsia-100 ">';
                }
                $together .= '投稿日付：'.h($result['date']).'<br>投稿者：'.h($result['user_nm']).'<br>'.h($result['together_chat']).'<br></div></div>';
            }
        }
        return $together;
    }
}

function post_chat_question($pdo)
{
    // POSTデータ取得
    $id = $_POST['id'];
    $user_chat = $_POST['user_chat'];

    // データ登録SQL作成
    $stmt = $pdo->prepare("INSERT INTO gs_chat_table(chat_id, id, user_id, user_nm, user_chat, date)
    VALUES (NULL, :id, :user_id, :user_nm, :user_chat, sysdate())");
    
    //バインド変数を用意、Integer 数値の場合 PDO::PARAM_INT、String文字列の場合 PDO::PARAM_STR
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->bindValue(':user_nm', $_SESSION['user_nm'], PDO::PARAM_STR);
    $stmt->bindValue(':user_chat', $user_chat, PDO::PARAM_STR);
    
    //実行
    $status = $stmt->execute();
    
    //データ登録処理後
    if($status === false){
        //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
        $error = $stmt->errorInfo();
        exit('ErrorMessage:'.$error[2]);
    }else{
        //登録が成功した場合の処理、p23_control.phpへリダイレクト
        //header('Location:p23_control.php');
        header("Location:p23_control.php?id=$id");
    }
}

function post_chat_together($pdo)
{
    // POSTデータ取得
    $id = $_POST['id'];
    $together_chat = $_POST['together_chat'];

    // データ登録SQL作成
    $stmt = $pdo->prepare("INSERT INTO gs_together_table(together_id, id, user_id, user_nm, together_chat, date)
    VALUES (NULL, :id, :user_id, :user_nm, :together_chat, sysdate())");
    
    //バインド変数を用意、Integer 数値の場合 PDO::PARAM_INT、String文字列の場合 PDO::PARAM_STR
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->bindValue(':user_nm', $_SESSION['user_nm'], PDO::PARAM_STR);
    $stmt->bindValue(':together_chat', $together_chat, PDO::PARAM_STR);
    
    //実行
    $status = $stmt->execute();
    
    //データ登録処理後
    if($status === false){
        //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
        $error = $stmt->errorInfo();
        exit('ErrorMessage:'.$error[2]);
    }else{
        //登録が成功した場合の処理、p23_control.phpへリダイレクト
        //header('Location:p23_control.php');
        header("Location:p23_control.php?id=$id");
    }
}

/*
ここから未使用
class Chat {
    // プロパティ
    public $date;
    public $user_nm;
    public $user_chat;


    public function __construct($date,$user_nm,$user_chat) {
        $this->date = $date;
        $this->user_nm = $user_nm;
        $this->user_chat = $user_chat;
    }

    // メソッド
    public function chatTable() {
        echo '<br>投稿日付：'. $this->date . '<br>投稿者：' . $this->user_nm . '<br>'. $this->user_chat. '<br>';
        $data = array(
            'date' => $this->date,
            'user_nm' => $this->user_nm,
            'user_chat' => $this->user_chat
        );
        return $data;
    }
}

function get_chat($pdo)
{
    // クエリの実行とデータの処理
    $stmt = $pdo->prepare('SELECT * FROM gs_chat_table;');
    $status = $stmt->execute();
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if (isset($_GET['id']) && $result['id'] == $_GET['id']) {
            $chat = new Chat(h($result['date']),h($result['user_nm']),h($result['user_chat']));
            $chat->chatTable();
        }
    }
    return $chat;
}
ここまで未使用
*/

?>