<?php

try {
$pdo = new PDO('mysql:host=neetla.be;dbname=train;charset=utf8','labeneko','',
array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
 exit('データベース接続失敗。'.$e->getMessage());
}

$prefectures = array();
$stmt = $pdo->query("SELECT * FROM prefecture");
while($prefecture = $stmt -> fetch(PDO::FETCH_ASSOC)) {
    $prefectures[$prefecture["id"]] = $prefecture["name"];
}
$pregpref = implode("|", $prefectures);
$prefectures = array_flip($prefectures);

$stmt = $pdo->query("SELECT * FROM companies WHERE is_jr = 1");
while($company = $stmt -> fetch(PDO::FETCH_ASSOC)) {
    echo $company["name"];
    $wikipediaPageString = $company["name"] . "の鉄道駅一覧_(電報略号順)";
    $wikipediaURL = "https://ja.wikipedia.org/wiki/" . urlencode($wikipediaPageString);
    $contents = file_get_contents($wikipediaURL);
    preg_match_all('/- <a href="([^"]+)"/', $contents, $matches);
    $stations = array();
    foreach($matches[1] as $stationURL) {
        $stationURL = "https://ja.wikipedia.org" . $stationURL;
        $stationContents = file_get_contents($stationURL);
        if(preg_match('/>([^<]+)<\/h1>/', $stationContents, $matches2)){
            if(isset($matches2[1])) {
                $stationName = $matches2[1];
                if(preg_match('/（(.*)えき/', $stationContents, $matches3)){
                    if(isset($matches3[1])) {
                        $stationNormalizeName = $matches3[1];
                        if(preg_match('/(' . $pregpref . ')/', $stationContents, $matches4)){
                            if(isset($matches4[1])) {
                                $pref = $matches4[1];
                                $ins = $pdo -> prepare("INSERT INTO stations_wiki (name, normalize_name, company_id, prefecture_id) VALUES (:name, :normalize_name, :company_id, :prefecture_id)");
                                $ins->bindParam(':name', $stationName, PDO::PARAM_STR);
                                $ins->bindParam(':normalize_name', $stationNormalizeName, PDO::PARAM_STR);
                                $ins->bindValue(':company_id', $company["id"], PDO::PARAM_INT);
                                $ins->bindValue(':prefecture_id', $prefectures[$pref], PDO::PARAM_INT);
                                $ins->execute();
                            }
                        }
                    }
                }
            }
        }
    }
}