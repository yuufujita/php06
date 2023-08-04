<?php require'p00_header.php';?>
<?php require_once('p99_funcs.php')?>

<?php
session_start();
loginCheck();
$star=star();
$areaOp=areaOption();
$aimOp=aimOption();
$costOp=costOption();
?>

<!-- Main[Start] -->

<div class="container">
    <div class="main container-fluid">
        <div class="row bg-light text-dark py-5">
            <div class="col-md-8 offset-md-2">
                <form method="post" action="p02_insert.php" enctype="multipart/form-data">
                    <div class="form-control"><label>旅の開始駅：<input type="text" name="s_access"></label></div>
                    <div class="form-control"><label>旅の開始時刻：<input type="datetime-local" name="s_datetime"></label></div>
                    <div class="form-control"><label>My best shot：<input type="file" name="image01"></label></div>
                    <div class="form-control"><label>旅程：<textArea name="recommend_memo"></textArea></label></div>
                    <div class="form-control">
                        <table id="tbl" border="1" style="border-collapse:collapse;">
                        <tr>
                            <th>時刻</th>
                            <th>詳細</th>
                        </tr></table>
                        <a class="btn btn-primary" href="#" onclick="add()">行追加</a>
                        <a class="btn btn-primary" href="#" onclick="del()">行削除</a>
                    </div>
                    <div class="form-control"><label>My best stay：<input type="file" name="image02"></label></div>
                    <div class="form-control"><label>宿泊先：<input type="text" name="stay_nm"></label></div>
                    <div class="form-control"><label>宿泊先URL：<input type="text" name="stay_url"></label></div>
                    <div class="form-control"><label>皆さんへのメモ：<textArea name="stay_memo"></textArea></label></div>
                    <div class="form-control">オススメ度：<select name="star"><?php foreach($star as $key=>$value){echo '<option value="',$value,'">'.$key.'</option>';}?></select></div>
                    <div class="form-control">エリア：<select name="area"><?php foreach($areaOp as $key=>$value){echo '<option value="',$value,'">'.$key.'</option>';}?></select></div>
                    <div class="form-control"><label>目的：<?php foreach ($aimOp as $key => $value) { ?><input type="checkbox" name="aim[]" value="<?php echo $value; ?>"><?php echo $key; ?><?php } ?></label></div>
                    <div class="form-control">予算：<select name="cost"><?php foreach($costOp as $key=>$value){echo '<option value="',$value,'">'.$key.'</option>';}?></select>円</div>
                    <div class="select-item"><input type="submit" value="送信"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="select-container">
    <div class="select-item"><a href="p03_select.php">みんなの投稿一覧へ</a></div>
</div>
<!-- Main[End] -->

<script>
var scheduleArray = [];

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
    timeInput.name = "schedule[][time]"; // name属性を設定
    cell1.appendChild(timeInput);
    
    var detailInput = document.createElement("input");
    detailInput.type = "text";
    detailInput.name = "schedule[][detail]"; // name属性を設定
    cell2.appendChild(detailInput);
    
    // 時刻データと詳細データを配列に追加
    scheduleArray.push([timeInput.value, detailInput.value]);

    // 入力フィールドの値を取得してから配列に追加するよう修正
    timeInput.addEventListener("change", function() { 
        var rowIndex = this.parentNode.parentNode.rowIndex - 1;
        scheduleArray[rowIndex][0] = this.value;
        console.log(scheduleArray);
    });

    detailInput.addEventListener("change", function() { 
        var rowIndex = this.parentNode.parentNode.rowIndex - 1;
        scheduleArray[rowIndex][1] = this.value;
        console.log(scheduleArray);
    });

    console.log("テスト");
    console.log(scheduleArray); // scheduleArrayの内容をコンソールに表示
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
    // 削除された行のデータを配列からも削除
    scheduleArray.pop();
}
// フォームが送信される際にscheduleArrayのデータをフォームに設定
window.onload = function() {
    document.querySelector("form").addEventListener("submit", function() {
        var hiddenInput = document.createElement("input");
        hiddenInput.type = "hidden";
        hiddenInput.name = "schedule";
        hiddenInput.value = JSON.stringify(scheduleArray);
        this.appendChild(hiddenInput);
    });
};
</script>

<?php require'p99_footer.php';?>
