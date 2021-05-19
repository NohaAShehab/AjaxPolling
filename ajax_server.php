<?php
header('Access-Control-Allow-Origin: *');
$file_name = 'document.txt';
if(isset($_GET['lastmod'])){
    $client_time = isset($_GET['lastmod']) ? $_GET['lastmod'] : 0;
    $server_time = filemtime($file_name);
    while($client_time >= $server_time){
        sleep(1);
        clearstatcache();
        $server_time = filemtime($file_name);
    }

    $response = array();
    $response['lastmod'] = $server_time;
    $response['msg'] = file_get_contents($file_name);
    echo json_encode($response);

}
?>
