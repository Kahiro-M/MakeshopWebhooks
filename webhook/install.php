<?php
function generateUUIDv4() {
    $data = random_bytes(16);
    // バージョンを設定 (4はUUIDv4を表す)
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // RFC 4122 バリアントを設定
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    // Converts json data into a PHP object 
    $data = json_decode($json, true);
    $app_id   = $data['app_id'];        //   アプリID
    $plan_id  = $data['plan_id'];       //   プランID
    $app_name = $data['app_name'];      //   アプリ名
    $shop_id  = $data['shop_id'];       //   ショップID
    $token    = $data['token'];         //   永続トークン
}else if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // GETのときはクエリパラメータでチェック
    $query_str = parse_url($_SERVER['REQUEST_URI'])['query'];
    parse_str($query_str, $queries);
    $app_id   = $queries['app_id'];        //   アプリID
    $plan_id  = $queries['plan_id'];       //   プランID
    $app_name = $queries['app_name'];      //   アプリ名
    $shop_id  = $queries['shop_id'];       //   ショップID
    $token    = $queries['token'];         //   永続トークン
}

date_default_timezone_set('Asia/Tokyo');
$nowStr = date('Ymd_His');
$dataStr = 'アプリID : '.$app_id."\n".'プランID : '.$plan_id."\n".'アプリ名 : '.$app_name."\n".'ショップID : '.$shop_id."\n".'永続トークン : '.$token."\n";
file_put_contents(__DIR__.'/install_'.$nowStr.'_'.generateUUIDv4().'.txt',$dataStr);

// var_dumpを全取得
ob_start();
var_dump('$_SERVER');
var_dump($_SERVER);
var_dump('$_POST');
var_dump($_POST);
$dump = ob_get_contents();
ob_end_clean();
file_put_contents(__DIR__.'/all_install_'.$nowStr.'_'.generateUUIDv4().'.txt',$dump);

?>
<p>アプリID : <?= $app_id ?></p>
<p>プランID : <?= $plan_id ?></p>
<p>アプリ名 : <?= $app_name ?></p>
<p>ショップID : <?= $shop_id ?></p>
<p>永続トークン : <?= $token ?></p>
