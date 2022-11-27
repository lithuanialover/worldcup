<!-- アクセス制御 -->
<?php
require_once(ROOT_PATH . 'Controllers/PlayerController.php');#require_once("ファイルパス"); ファイルが既に読み込まれている場合は再読み込みしない
$player = new PlayerController();//インスタンス生成
$params = $player->view();//PlayerController.phpにある[PlayerController]クラスの function view(){}のメソッドを左記のように書く。よって、クラス内に記述されている関数を実行できる。
$goal_params = $player->goal();//PlayerController.phpにある[PlayerController]クラスの function goal(){}のメソッドを左記のように書く。よって、クラス内に記述されている関数を実行できる。

?>

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
            width: 50%;
            margin: 0 auto;
            margin-top: 50px;
        }
        table{
            display: block;
            margin: 0 auto;
            width: 50%;
            margin-bottom: 25px;
        }
        table th{
            background: #eee;
            padding:5px 5px 5px  20px ;
            width: 200px;
            text-align: start;
        }
        table td {
            background: #eee;
            padding: 5px;
            width: 400px;
        }
        table tr:nth-child(odd) th,
        table tr:nth-child(odd) td {
            background: #fff;
        }

        .btn-back{
            width: 50%;
            margin: 0 auto;
            margin-top: 50px;
        }
    </style>
    <h2>■選手詳細</h2>
    <table class="details-table">
        <?php $player = $params['player']?>
        <tr>
            <th>No</th>
            <td><?=$player['id'] ?></td>
        </tr>
        <tr>
            <th>背番号</th>
            <td><?=$player['uniform_num'] ?></td>
        </tr>
        <tr>
            <th>ポジション</th>
            <td><?=$player['position'] ?></td>
        </tr>
        <tr>
            <th>名前</th></th>
            <td><?=$player['name'] ?></td>
        </tr>
        <tr>
            <th>所属</th>
            <td><?=$player['club'] ?></td>
        </tr>
        <tr>
            <th>誕生日</th>
            <td><?=$player['birth'] ?></td>
        </tr>
        <tr>
            <th>身長</th>
            <td><?=$player['height'] ?>cm</td>
        </tr>
        <tr>
            <th>体重</th>
            <td><?=$player['weight'] ?>kg</td>
        </tr>
        <tr>
            <th>国</th>
            <td><?=$player['country'] ?></td>
        </tr>
        <tr>
            <th>
                <a href="">編集</a>
                <a href="">削除</a>
            </th>
            <td></td>
        </tr>
    </table>
    <h2>■得点履歴</h2>
    <table>
        <tr>
            <th>点数</th>
            <th>試合日時</th>
            <th>対戦相手</th>
            <th>ゴールタイム</th>
        </tr>
        <?php $i = 0; ?>
        <?php foreach($goal_params['goals'] as $goal):?>
        <tr>
            <td><?= $i+1?></td><!--得点-->
            <td><?=$goal['kickoff'] ?></td>
            <td><?=$goal['enemy'] ?></td>
            <td><?=$goal['goaltime'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p class="btn-back"><a href="/Players/index.php">トップへ戻る</a></p>
</html>
