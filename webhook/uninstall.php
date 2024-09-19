<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    // Converts json data into a PHP object 
    $data = json_decode($json, true);
    $app_id   = $data['app_id'];        //   アプリID
    $app_name = $data['app_name'];      //   アプリ名
    $shop_id  = $data['shop_id'];       //   ショップID
}else if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // GETのときはクエリパラメータでチェック
    $query_str = parse_url($_SERVER['REQUEST_URI'])['query'];
    parse_str($query_str, $queries);
    $app_id   = $queries['app_id'];        //   アプリID
    $app_name = $queries['app_name'];      //   アプリ名
    $shop_id  = $queries['shop_id'];       //   ショップID
}

date_default_timezone_set('Asia/Tokyo');
$nowStr = date('Ymd_His');
$dataStr = 'アプリID : '.$app_id."\n".'プランID : '.$plan_id."\n".'アプリ名 : '.$app_name."\n".'ショップID : '.$shop_id."\n".'永続トークン : '.$token."\n";
file_put_contents(__DIR__.'/uninstall_'.$nowStr.'.txt',$dataStr);

?>
<p>アプリID : <?= $app_id ?></p>
<p>アプリ名 : <?= $app_name ?></p>
<p>ショップID : <?= $shop_id ?></p>

