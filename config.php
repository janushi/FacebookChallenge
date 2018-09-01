<?php
    session_start();
    require_once "Facebook/autoload.php";


    $FB = new\Facebook\Facebook([
        'app_id' => '306077460151348',
        'app_secret' => '0207a49b23ca52f50545b41d57cb6ec3',
        'default_graph_version'=>'v2.10'
    ]);

    $helper= $FB->getRedirectLoginHelper();
?>