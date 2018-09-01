<?php
    require_once "config.php";

    try{
        $accessToken = $helper->getAccessToken();
        }
    catch (\Facebook\Exceptions\FacebookResponseException $e)
    {
        echo "Response Exception:" . $e->getMessage();
        exit();
    }
    catch (\Facebook\Exception\FacebookSDKException $e)
    {
        echo "SDK Exception:" . $e->getMessage();
        exit();
    }
    if(!$accessToken)
    {
        header('Location: login.php');
       // header(string : 'Location: login.php');
        exit();
    }

    $oAuth2client = $FB->getOAuth2Client();
    if(!$accessToken->isLongLived())
        $accessToken = $oAuth2client->getLongLivedAccessToken($accessToken);

    $response = $FB->get("/me?fields=id,first_name,email,picture", $accessToken);
    $userData = $response->getGraphNode()->asArray();
    //echo "<pre>";
    //var_dump($userData);
    $_SESSION['userData']=$userData;
    $_SESSION['access_token'] = (string) $accessToken;
    header('Location: index.php');
    exit();


?>