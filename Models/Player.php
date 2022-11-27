<?php
require_once(ROOT_PATH . 'Models/Db.php');

class Player extends Db {//Dbが親クラス
    // private $table = 'players';//【共通エラー①】プロパティを使うとエラーがでる

    public function __construct($dbh = null){
        parent::__construct($dbh);//親クラスのコンストラクトを呼び出す
    }

    /**
     * Viewファイル：index.php
     * playersテーブルからすべてのデータを取得
     *
     * @param integer $page ページ番号
     * @return Array $result 全選手データ
     *
     */
    public function findAll($page = 0):Array{
        // $sql = 'SELECT * FROM players';//テーブルからデータ取得用のSQL文(国名なし)
        $sql = 'SELECT p.`id`, c.`name`AS country, p.`uniform_num`, p.`position`, p.`name`, p.`club`, p.`birth`, p.`height`, p.`weight` 
        FROM players p JOIN countries c ON p.country_id = c.id';//国名あり
        // $sql = 'SELECT * FROM'.$this->table; //【共通エラー①】プロパティを使うとエラーがでる
        $sql .= ' LIMIT 20 OFFSET '.(20 * $page);//ページネーション用
        $sth = $this->dbh->prepare($sql);//$sth means Statement handle
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);//SQLの結果を全て一度に受け取る　//FETCH_ASSOC;
        return $result;
    }

    /**
     * Viewファイル：index.php
     * 
     * playersテーブルから全データ数を取得
     * 
     * @return Int $count 全選手の件数
     * 
     */

    public function countAll():Int{//Int = 数字
        $sql = 'SELECT count(*) as count FROM players';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $count = $sth->fetchColumn();
        return $count;
    }

    /**
     * Viewファイル：view.php
     * 
     * playersテーブルから指定idのデータを取得
     *
     * @param integer $id 選手のID
     * @return Array $result 指定の選手のデータ
     *
     */
    public function findById($id = 0):Array{
        // $sql = 'SELECT * FROM players';//テーブルからデータ取得用のSQL文(国名なし)
        $sql = 'SELECT p.`id`, c.`name`AS country, p.`uniform_num`, p.`position`, p.`name`, p.`club`, p.`birth`, p.`height`, p.`weight` 
        FROM players p JOIN countries c ON p.country_id = c.id';//国名あり
        $sql .= ' WHERE p.id= :id'; //p.idのpを忘れるとエラーでた
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 倫理削除
     * カラム名：del_flg
     * 0➩表示
     * 1➩非表示
     */

    public function delFlg($id = 0){
        $sql = 'UPDATE players SET del_flg = 1 WHERE id = :id';
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();
    }
}

?>