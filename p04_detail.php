<?php require'p00_header.php';?>
<?php require_once('p99_funcs.php')?>

<?php
session_start();
loginCheck();
$star=star();
$areaOp=areaOption();
$aimOp=aimOption();
$costOp=costOption();

$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id = :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //PARAM_INTなので注意
$status = $stmt->execute(); //実行

$result = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    $result = $stmt->fetch();
}
?>

<!-- method, action, 各inputのnameを確認してください。  -->
<div class="container">
    <div class="main container-fluid">
        <div class="row bg-light text-dark py-5">
            <div class="col-md-8 offset-md-2">
                <form method="post" action="p05_update.php" enctype="multipart/form-data">
                    <div class="form-control"><label class="form-label">旅の開始駅：<input type="text" name="s_access" value="<?= $result['s_access']?>"></label></div>
                    <div class="form-control"><label class="form-label">旅の開始時刻：<input type="datetime-local" name="s_datetime" value="<?= $result['s_datetime']?>"></label></div>
                    <div class="form-control"><label class="form-label">My best shot：<input type="file" name="image01"><?= $result['image01']?></label></div>
                    <div class="form-control"><label class="form-label">旅程：<textArea name="recommend_memo" rows="6" cols="40"><?= $result['recommend_memo']?></textArea></label></div>
                    <div class="form-control"><label class="form-label">My best stay：<input type="file" name="image02"><?= $result['image02']?></label></div>
                    <div class="form-control"><label class="form-label">宿泊先：<input type="text" name="stay_nm" value="<?= $result['stay_nm']?>"></label></div>
                    <div class="form-control"><label class="form-label">宿泊先URL：<input type="text" name="stay_url" value="<?= $result['stay_url']?>"></label></div>
                    <div class="form-control"><label class="form-label">皆さんへのメモ：<textArea name="stay_memo" rows="6" cols="40"><?= $result['stay_memo']?></textArea></label></div>
                    <div class="form-control">オススメ度：<select name="star">
                        <?php foreach($star as $key=>$value){$selected = ($value === $result['star']) ? 'selected' : ''; // 初期値のオプションを選択状態にする
                            echo '<option value="', $value, '" ', $selected, '>', $key, '</option>';}?></select></div>
                    <div class="form-control">エリア：<select name="area">
                        <?php foreach($areaOp as $key=>$value){$selected = ($value === $result['area']) ? 'selected' : ''; // 初期値のオプションを選択状態にする
                            echo '<option value="', $value, '" ', $selected, '>', $key, '</option>';}?></select></div>
                    <div class="form-control"><label>目的：
                        <?php foreach ($aimOp as $key => $value) {
                            $selectedAim = explode(',', $result['aim']); // カンマ区切りの文字列を配列に変換
                            $checked = (in_array($value, $selectedAim)) ? 'checked' : ''; // 初期選択されたオプションに checked 属性を追加
                            echo '<input type="checkbox" name="aim[]" value="', $value, '" ', $checked, '>', $key;} ?></label></div>
                    <div class="form-control">予算：<select name="cost">
                        <?php foreach($costOp as $key=>$value){$selected = ($value === $result['cost']) ? 'selected' : ''; // 初期値のオプションを選択状態にする
                            echo '<option value="', $value, '" ', $selected, '>', $key, '</option>';}?></select>円</div>
                    <input type="hidden" name="id" value="<?= $result['id']?>">
                    <div class="select-item"><input type="submit" value="更新"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="select-container">
    <div class="select-item"><a href="p03_select.php">みんなの投稿一覧へ</a></div>
</div>

<?php require'p99_footer.php';?>