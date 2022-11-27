-- 【Player.php】選手一覧表と選手詳細に所属の「国」を表示＜内部結合＞
-- Reference https://tech.pjin.jp/blog/2017/06/08/sql%e7%b7%b4%e7%bf%92%e5%95%8f%e9%a1%8c-%e5%95%8f58/
SELECT p.`id`, c.`name`, p.`uniform_num`, p.`position`, p.`name`, p.`club`, p.`birth`, p.`height`, p.`weight`
FROM players p JOIN countries c ON p.country_id = c.id

-- 【Goal.php】選手詳細に選手の「得点履歴」を表示してください。
-- • 表示項目は「点数（何点目か）」「試合日時」 「対戦相手」 「ゴールタイム」
-- • 表示順は「試合日時」昇順
-- Reference https://tech.pjin.jp/blog/2017/08/09/sql%E7%B7%B4%E7%BF%92%E5%95%8F%E9%A1%8C-%E5%95%8F65/
-- Reference https://tech.pjin.jp/blog/2017/07/10/sql%e7%b7%b4%e7%bf%92%e5%95%8f%e9%a1%8c-%e5%95%8f63/
-- 昇順　ORDER BY

-- ##golas tableのSQLページでsql文を作成する
SELECT p.kickoff AS kickoff,
                c.name AS enemy,
                g.goal_time AS goaltime
                FROM goals AS g
                LEFT OUTER JOIN pairings AS p ON g.pairing_id = p.id
                LEFT OUTER JOIN countries AS c ON p.enemy_country_id = c.id
WHERE g.player_id = :id ORDER BY kickoff
