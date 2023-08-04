<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Carless travel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/style.css?<?php echo date('YmdHis');?>" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="img/png" href="img/favicon.png" />
</head>

<body>
<div id="home">
    <header class="page-header wrapper">
        <div class="logo-area">
            <a href="p03_select.php">
                <img class="logo" src="img/logo.jpg" alt="Carlesstravelホーム"/>
            </a>
        </div>
        <div class="space-area"></div>
        <nav>
            <ul class="main-nav">
                <li><a href="p81_login.php">ログイン</a></li>
                <li><a href="p83_logout.php">ログアウト</a></li>
            </ul>
        </nav>
    </header>
</div>

<div class="wrapper">
    <article>
        <div id="main06">
            <div class="main-content">
                <h1 class="main-title">Let's Enjoy!</h1>
                <p>経験者に質問しよう</p>
            </div>
        </div>
        <div id="stay" class="contents">
            <br>
            <div class="flex justify-center space-x-8">
                <div><?= $photo ?></div>
                <div class ="w-1/2 text-left"><?= $detail01 ?></div>
            </div>
            <div class="flex justify-center space-x-8">
                <div class ="block max-w-lg p-6 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 text-left">
                    <ul id="arrayList"></ul></div>
                <div class ="block max-w-lg p-6 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 text-left">
                    <?= $detail03 ?></div>
            </div>
        </div>
    </article>
</div>

<?php 
// GETデータ取得
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
?>

<div class="flex justify-center space-x-8">
    <div class="my-8 w-2/5 h-72 overflow-auto bg-gray-100">
        <div class="select-container">
            <form method="post" action="p23_control.php" enctype="multipart/form-data">
                <div class="select-item"><input type="hidden" name="id" value="<?= h($id)?>"></div>
                <div class="select-item"><div class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <label>質問<input type="text" name="user_chat"></label></div></div>
                <div class="select-item text-white bg-fuchsia-400 hover:bg-fuchsia-500 focus:ring-4 focus:ring-fuchsia-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-fuchsia-600 dark:hover:bg-fuchsia-700 focus:outline-none dark:focus:ring-fuchsia-800">
                    <input type="submit" value="送信"></div>
            </form>
        </div>
        <?= $question ?>
    </div>
    <div class="my-8 w-2/5 h-72 overflow-auto bg-gray-100">
        <div class="select-container">
            <form method="post" action="p23_control.php" enctype="multipart/form-data">
                <div class="select-item"><input type="hidden" name="id" value="<?= h($id)?>"></div>
                <div class="select-item"><div class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <label>ちょい合流<input type="text" name="together_chat"></label></div></div>
                <div class="select-item text-white bg-fuchsia-400 hover:bg-fuchsia-500 focus:ring-4 focus:ring-fuchsia-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-fuchsia-600 dark:hover:bg-fuchsia-700 focus:outline-none dark:focus:ring-fuchsia-800">
                    <input type="submit" value="送信"></div>
            </form>
        </div>
        <?= $together ?>
    </div>
</div>

<div class="select-container">
    <div class="select-item font-medium text-blue-600 dark:text-blue-500 hover:underline"><a href="p03_select.php">みんなの投稿一覧へ</a></div>
</div>

<br>
<br>
<br>
<br>

<?php
var_dump(get_chat_detail_02($pdo));
?>

<script>
// 配列の定義
var arrayData =  <?php echo get_chat_detail_02($pdo); ?>;
console.log(arrayData);

function displayArrayAsList(arr){
    var listElement = document.getElementById("arrayList");
    for (var i = 0; i < arr.length; i++) {
        var listItem = document.createElement("li");
        listItem.textContent = arrayData[i][0] + " - " + arrayData[i][1];
        listElement.appendChild(listItem);
    }
}
// ページロード時に配列をリスト表示する
window.onload = function() {
    displayArrayAsList(arrayData);
};
</script>

<footer>
    <div class="wrapper">
        <p>
            <small>&copy;2023 Y F</small>
        </p>
    </div>
</footer>

</body>

</html>

<!--
    var arrayData02 = [["8:00","くつろぎの宿　結び家発 https://www.biei-hokkaido.jp/ja/hotel/musubiya-biei/"],["8:21","JR美瑛駅"],["9:01","JR富良野駅"],["10:15","JR富良野発_バスツアー／ふらのバス https://www.optbookmark.jp/plans/3331"],["16:45","JR美瑛駅着_バスツアー／ふらのバス"],["17:44","ふらのバス美瑛駅"],["18:00","ふらのバス旭川空港駅"],["18:15","フードコートでらーめん山頭火とビール https://www.aapb.co.jp/portfolio/santouka/"],["19:30","旭川空港発"],["21:15","羽田空港着"],["21:48","京急羽田空港第１・第２ターミナル発"],["22:03","京急川崎着"],["22:20","JR川崎発"],["22:41","JR武蔵溝ノ口駅着"]];
    var arrayData02 = <?php echo json_encode(get_chat_detail_02($pdo)); ?>;
    var arrayData02 = <?php echo json_encode(get_chat_detail_02($pdo), JSON_UNESCAPED_UNICODE); ?>;
    var arrayData02 = <?php echo json_encode(get_chat_detail_02($pdo), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
    var arrayData02 = <?php echo json_encode(json_decode(get_chat_detail_02($pdo)), JSON_UNESCAPED_UNICODE); ?>; //null
    var arrayData02 = <?php echo html_entity_decode(json_encode(get_chat_detail_02($pdo)), ENT_QUOTES, 'UTF-8'); ?>; //unexpected number
    var arrayData02 = <?php echo htmlspecialchars_decode(json_encode(get_chat_detail_02($pdo), JSON_UNESCAPED_UNICODE)); ?>; //unexpected number
    var arrayData02 = <?php echo $json_data; ?>;
-->