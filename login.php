<?php
    require_once "config.php";

    if(isset($session['access_token'])) {
        header('Location:login.php');
        exit();
    }

    $redirectURL="https://localhost/FacebookLogin/fb-callback.php";
    $permissions=['email'];
    $loginURL=$helper->getLoginUrl($redirectURL, $permissions);
?>

<!DOCTYPE html>
<html lang="UTF-8">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0,maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Log In</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>

<body>


<div class="container" style="margin-top:100px">
    <div class="row justify-content-center">
    <div class="col-md-6 col-md-offset-3" align="center">
        <form>
            <input name="email" placeholder="Email" class="form-control"><br>
            <input name="password" placeholder="Password" type="password" class="form-control"><br>
            <input type="button" onclick="window.location = '<?php echo $loginURL ?> ';" value="Log In With Facebook" class="btn btn-primary"><br>
            </form>
    </div>
    </div>
</div>
</body>
</html>
