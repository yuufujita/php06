<?php require'p00_header.php';?>
<?php require_once('p99_funcs.php')?>

<style>
td{
    cursor: move;
}
</style>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<?php
session_start();
loginCheck();

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_user_table;');
$status = $stmt->execute();

//３．データ表示
$user = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $user .= '<tr>';
    $user .= '<td>'.$result['user_id'].'</td>';
    $user .= '<td>'.$result['user_nm'].'</td>';
    $user .= '</tr>';
    }
}
?>

<form action="./" method="post" id="order_form">
    <table>
        <thead>
            <tr>
                <th>user_id</th>
                <th>user_nm</th>
            </tr>
        </thead>
        <tbody id="sort-table">
            <?= $user?>
        </tbody>
    </table>
    <input type="hidden" name="order" class="order" value="">
    <input type="submit" value="順番を変更" onClick="return sortCheck();" class="btn btn-success text-white bg-fuchsia-400 hover:bg-fuchsia-500 focus:ring-4 focus:ring-fuchsia-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-fuchsia-600 dark:hover:bg-fuchsia-700 focus:outline-none dark:focus:ring-fuchsia-800">
</form>

<script>
    //Sortable
    let table = document.getElementById('sort-table');
    Sortable.create(table);
</script>

<br>
<br>

<!--ボタン配置--> 
<div>
    <button onclick="add()">行追加</button>
    <button onclick="del()">行削除</button>
</div>

<!--table作成とヘッダーだけ先に-->
<table id="tbl" name="schedule" border="1" style="border-collapse:collapse;">
<tr>
    <th>時刻</th>
    <th>詳細</th>
</tr>
</table>

<script>
function add() {
    // テーブルの参照を取得
    var table = document.getElementById("tbl");
    
    // 新しい行を作成
    var newRow = table.insertRow();
    
    // セルを作成して行に追加
    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);
    
    // input 要素を作成してセルに追加
    var timeInput = document.createElement("input");
    timeInput.type = "text";
    cell1.appendChild(timeInput);
    
    var detailInput = document.createElement("input");
    detailInput.type = "text";
    cell2.appendChild(detailInput);
}

function del() {
    // テーブルの参照を取得
    var table = document.getElementById("tbl");

    // テーブルの行数を取得
    var rowCount = table.rows.length;

    // 最低1行は残るように行を削除
    if (rowCount > 1) {
        table.deleteRow(rowCount - 1);
    }
}
</script>

<br>
<br>

<h2>配列のリスト表示</h2>
<ul id="arrayList01"></ul>

<script>
// 配列の定義
var arrayData01 = [["8:00","くつろぎの宿　結び家発 https://www.biei-hokkaido.jp/ja/hotel/musubiya-biei/"],["8:21","JR美瑛駅"],["9:01","JR富良野駅"],["10:15","JR富良野発_バスツアー／ふらのバス https://www.optbookmark.jp/plans/3331"],["16:45","JR美瑛駅着_バスツアー／ふらのバス"],["17:44","ふらのバス美瑛駅"],["18:00","ふらのバス旭川空港駅"],["18:15","フードコートでらーめん山頭火とビール https://www.aapb.co.jp/portfolio/santouka/"],["19:30","旭川空港発"],["21:15","羽田空港着"],["21:48","京急羽田空港第１・第２ターミナル発"],["22:03","京急川崎着"],["22:20","JR川崎発"],["22:41","JR武蔵溝ノ口駅着"]];
console.log(arrayData01,'145行目');
// 配列をリストに表示する関数
function displayArrayAsList(arr) {
    var listElement = document.getElementById("arrayList01");
    for (var i = 0; i < arr.length; i++) {
        var listItem = document.createElement("li");
        listItem.textContent = arr[i][0] + " - " + arr[i][1];
        listElement.appendChild(listItem);
    }
}

// ページロード時に配列をリスト表示する
window.onload = function() {
    displayArrayAsList(arrayData01);
};

</script>

<?php
function get_chat_detail($pdo)
{
    //２．データ登録SQL作成
    $stmt = $pdo->prepare('SELECT * FROM gs_bm_table;');
    $status = $stmt->execute();
    
    //３．データ表示
    $detail = '';
    if ($status === false) {
        $error = $stmt->errorInfo();
        exit('SQLError:' . print_r($error, true));
    } else {
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $detail = $result['schedule'];
        }
        return $detail;
    }
}

$detail = get_chat_detail($pdo);
var_dump(get_chat_detail($pdo));
?>

<div class ="block max-w-lg p-6 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 text-left">
<?= $detail ?>
</div>

<h2>配列のリスト表示</h2>
<ul id="arrayList"></ul>

<script>
// 配列の定義
var arrayData =  <?php echo get_chat_detail($pdo); ?>;
console.log(arrayData);
// 配列をリストに表示する関数
function displayArrayAsList(arr) {
    var listElement = document.getElementById("arrayList");
    for (var i = 0; i < arr.length; i++) {
        var listItem = document.createElement("li");
        listItem.textContent = arr[i][0] + " - " + arr[i][1];
        listElement.appendChild(listItem);
    }
}

// ページロード時に配列をリスト表示する
window.onload = function() {
    displayArrayAsList(arrayData);
};

</script>

<?php require'p99_footer.php';?>