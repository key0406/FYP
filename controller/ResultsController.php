<?php
require_once("sql.php");

// Get language parameter, default to 'en'
if (!empty($_GET['lang'])) {
    $lang = $_GET['lang'];
} else {
    $lang = 'en';
}
$path = '../lang_result/' . $lang . '.json';
$file = fopen($path, "r");
$json = fread($file, filesize($path));
$tls = json_decode($json, true);

// DB接続
$sql = connectdb();
if (!$sql) {
    exit("DB接続失敗");
}

// 最新のデータを取得
$query = "SELECT p1, p2, p3, p4, f1, f2, f3, f4, q1, q2, q3, q4 FROM survey ORDER BY id DESC LIMIT 1";
$stmt = $sql->query($query);
$latest_entry = $stmt->fetch(PDO::FETCH_ASSOC);

// データが存在する場合の計算
if ($latest_entry) {
    // Pain Section
    $total_pain = $latest_entry['p1'] + $latest_entry['p2'] + $latest_entry['p3'] + $latest_entry['p4'];
    $KOOS_pain = 100 - ($total_pain / (4 * 4)) * 100; // Scale to 100

    // Function Section
    $total_func = $latest_entry['f1'] + $latest_entry['f2'] + $latest_entry['f3'] + $latest_entry['f4'];
    $KOOS_func = 100 - ($total_func / (4 * 4)) * 100; // Scale to 100

    // Quality of Life Section
    $total_qol = $latest_entry['q1'] + $latest_entry['q2'] + $latest_entry['q3'] + $latest_entry['q4'];
    $KOOS_qol = 100 - ($total_qol / (4 * 4)) * 100; // Scale to 100

    // Overall KOOS Score (average of all sections)
    $total_score = number_format(($KOOS_pain + $KOOS_func + $KOOS_qol) / 3, 3);

    // Redirect to the results page and pass the lang parameter along with the scores
    header("Location: results.php?lang=$lang&total_pain=$KOOS_pain&total_func=$KOOS_func&total_qol=$KOOS_qol&total_score=$total_score");
    exit;
} else {
    // データが見つからない場合
    exit('データが見つかりません。');
}
?>
