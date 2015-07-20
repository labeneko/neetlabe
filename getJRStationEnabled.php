<?php

try {
$pdo = new PDO('mysql:host=neetla.be;dbname=train;charset=utf8','labeneko','',
array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
 exit('データベース接続失敗。'.$e->getMessage());
}

$stmt = $pdo->query("SELECT * FROM stations WHERE enable_flag = 0 AND delete_flag = 0;");
while($station = $stmt -> fetch(PDO::FETCH_ASSOC)) {
    echo $station["name"];
    $eki2 = "東京";
    if($station["company_id"] == 2) {
        $eki2 = "札幌";
    }
    if($station["company_id"] == 3) {
        $eki2 = "名古屋";
    }
    if($station["company_id"] == 4) {
        $eki2 = "新大阪";
    }
    if($station["company_id"] == 5) {
        $eki2 = "高松";
    }
    if($station["company_id"] == 6) {
        $eki2 = "新八代";
    }
    $jorudanURL = "http://www.jorudan.co.jp/norikae/cgi/nori.cgi?Sok=%E6%B1%BA+%E5%AE%9A&eki1=" . urlencode($station["name"]) . "&eki2=" . urlencode($eki2) . "&eki3=&via_on=1&Dym=201507&Ddd=21&Dhh=0&Dmn1=3&Dmn2=2&Cway=3&Cfp=1&C7=1&C2=0&C3=0&C1=0&C4=0&C6=2&S.x=72&S.y=9&S=%E6%A4%9C%E7%B4%A2&Cmap1=&rf=nr&pg=1&eok1=&eok2=R-&eok3=&Csg=1";
    $contents = file_get_contents($jorudanURL);
    if(preg_match('/経路/', $contents)){
        $upd = $pdo -> prepare("UPDATE stations SET enable_flag = 1 WHERE id = :id");
        $upd->bindValue(':id', $station["id"], PDO::PARAM_INT);
        $upd->execute();
    }
    sleep(4);
}