<!-- DB接続 -->
<?php
require_once(ROOT_PATH . '/database.php');

class Db{
    protected $dbh;//$dbh means database handle(データベースを操作するために使われるもの)

    public function __construct($dbh = null)
    {
        if(!$dbh){//接続情報が存在しない場合
            try{//接続成功
                $this->dbh = new PDO(//インスタンス化
                    'mysql:dbname='.DB_NAME.
                    ';host='.DB_HOST, DB_USER, DB_PASSWD
                );
            }catch(PDOException $e){//接続失敗
                echo "接続失敗:" . $e->getMessage() . "\n";
                exit();
            }
        }else{//接続情報が存在する場合
            $this->dbh = $dbh;
        }
    }

    /**
     * 複数モデルの仕様
     * ➩1コントローラーにて複数モデルを利用する
     */
    public function get_db_handler(){
        return $this->dbh;
    }
}