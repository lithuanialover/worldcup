<?php
require_once(ROOT_PATH . 'Models/Db.php');

class Goal extends Db {//Dbが親クラス

    public function __construct($dbh = null){
        parent::__construct($dbh);//親クラスのコンストラクトを呼び出す
    }

    public function findGoal($id = 0 ):Array{
        $sql = 'SELECT p.kickoff AS kickoff,
                c.name AS enemy,
                g.goal_time AS goaltime
                FROM goals AS g
                LEFT OUTER JOIN pairings AS p ON g.pairing_id = p.id
                LEFT OUTER JOIN countries AS c ON p.enemy_country_id = c.id';
        $sql .= ' WHERE g.player_id = :id ORDER BY kickoff';

		$sth = $this->dbh->prepare($sql);
		$sth->bindParam(':id', $id, PDO::PARAM_INT);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);//fetchAll:全てのデータを抽出
		return $result;
    }
}

?>