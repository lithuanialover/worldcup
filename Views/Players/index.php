<!-- アクセス制御 -->
<?php
require_once(ROOT_PATH . 'Controllers/PlayerController.php');#require_once("ファイルパス"); ファイルが既に読み込まれている場合は再読み込みしない

$player = new PlayerController();//インスタンス生成
$params = $player->index();//PlayerController.phpにある[PlayerController]クラスの function index(){}のメソッドを左記のように書く。よって、クラス内に記述されている関数を実行できる。
if(isset($_POST['deleteId'])){
    $player->delete();
    // header('Location: index.php');
    // exit();
}
?>

<!-- view -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>オブジェクト指向-選手一覧</title>
        <link rel="stylesheet" type="text.css" href="/css/base.css">
        <link rel="stylesheet" type="text.css" href="/css/style.css">
    </head>
    <style>
        h2{
            width: 70%;
            margin: 0 auto;
            margin-top: 50px;
        }
        table{
            display: block;
            margin: 0 auto;
            width: 70%;
        }
        table tr{
            width: 100%;
        }
        table th{
            padding: 10px;
        }
        table td {
            background: #eee;
            padding: 10px;

        }
        table tr:nth-child(odd) td {
            background: #fff;
            padding: 10px;
        }

        .paging{
            text-align: center;
        }
        .paging a{
            padding: 5px;
        }
    </style>
    <body>
        <h2>選手一覧</h2>
        <table class="player-table">
            <tr style="background-color: #ddd;">
                <th>No</th>
                <th>背番号</th>
                <th>ポジション</th>
                <th>名前</th>
                <th>所属</th>
                <th>誕生日</th>
                <th>身長</th>
                <th>体重</th>
                <th>国</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach($params['players'] as $player): ?>
            <tr>
                <td><?=$player['id'] ?></td>
                <td><?=$player['uniform_num'] ?></td>
                <td><?=$player['position'] ?></td>
                <td><?=$player['name'] ?></td>
                <td><?=$player['club'] ?></td>
                <td><?=$player['birth'] ?></td>
                <td><?=$player['height'] ?>cm</td>
                <td><?=$player['weight'] ?>kg</td>
                <td><?=$player['country'] ?></td>
                <td><a href="/Players/view.php?id=<?= $player['id'] ?>">詳細</a></td>
                <td><a href="<?= $player['id'] ?>">編集</a></td>
                <!-- <td><input type="button" value="削除" id="delete"></td> -->
                <td>
                    <form action="index.php" method="POST">
                        <button class="input" type="submit" onclick="return confirm('削除しますか？')">削除</button>
                        <input type="hidden" name='deleteId' value="<?= $player['id'] ?>">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <div class="paging">
        <?php
        for($i=0;$i<=$params['pages'];$i++){
            if(isset($_GET['page']) && $_GET['page'] == $i){
                echo $i+1;
            } else {
                echo "<a href='?page=".$i."'>".($i+1)."</a>";
            }
        }
        ?>
    </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
    </script>
</html>