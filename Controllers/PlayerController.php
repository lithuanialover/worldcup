<?php
require_once(ROOT_PATH . 'Models/Player.php');
require_once(ROOT_PATH . 'Models/Goal.php');

class PlayerController{
    private $request; //リクエストパラメーター(GET,POST)

    private $Player; //Playerモデル
    private $Goal; //Goalモデル

    public function __construct()
    {
        // リクエストパラメーターの取得
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;

        //モデルオブジェクトの生成
        $this->Player = new Player();

        // 別モデルと連携(Playerモデル×Goalモデル)。Db.phpにメソッド「function get_db_handler」がある
        $dbh = $this->Player->get_db_handler();
        $this->Goal = new Goal($dbh);//インスタンス作成
    }

    // index.php-----------------------------------------------------------------------------------------------------------------------------------------------------
    #index.php表示(データ一覧) #ページネーション
    public function index(){
        $page = 0;//pagination用。初期表示用にページ番号は0で宣言
        if(isset($this->request['get']['page'])){//pagination用
            $page = $this->request['get']['page'];//$pageを代入する
        }

        $players = $this->Player->findAll($page);//Player.phpのPlayerクラスの中のfindAllを呼び出す //リクエストパラメーターからページ番号を取得 & $pageは、2行上のやつ。findAllを呼び出す引数として渡す
        $players_count = $this->Player->countAll();//Player.phpのPlayerクラスのcountAllメソッドを呼び出す
        // 配列
        $params = [
            'players' => $players, //DB[worldcup2014]のtables[players]のこと
            'pages' =>$players_count /20 //上記の$players_count
        ];

        // 返り値を配列にセットしてViewに返す
        return $params;
    }

    #削除
    public function delete() {
        if(!empty($this->request['post']['deleteId'])) {
            $this->Player->delFlg($this->request['post']['deleteId']);
        }
        /**
         * 現状
         * 「削除」押すと、del=flgの値が「0➩1」に変更
         * しかし、非表示に変わらない
        */

    }

    // view.php------------------------------------------------------------------------------------------------------------------------------------
    #view.php表示(idごとのデータ：選手情報)
    public function view(){
        if(empty($this->request['get']['id'])){
            echo '指定のパラメーターが不正です。このページを表示できません。';
            exit;
        }

        // 選手詳細
        $player = $this->Player->findById($this->request['get']['id']);

        // 配列に格納
        $params = [
            'player' => $player //選手履歴
        ];
        return $params;
    }

    #view.php表示(idごとのデータ：得点履歴)
    public function goal(){
        if(empty($this->request['get']['id'])){
            echo '指定のパラメーターが不正です。このページを表示できません。';
            exit;
        }

        // 得点履歴
        $goal = $this->Goal->findGoal($this->request['get']['id']);

        // 配列に格納
        $goal_params = [
            'goals' => $goal //得点履歴
        ];
        return $goal_params;
    }
}