<?php
    session_start();
        if(isset($session['access_token'])) {
            header('Location:login.php');
            exit();
        }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0,maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>

<body>
<div class="container" style="margin-top:100px">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <img src="<?php echo $_SESSION['userData']['picture']['url']?>">
        </div>
        <div class="col-md-9 ">
            <table class="table table-hover table-bordered">
                <tbody>
                    <tr>
                        <td>ID</td>
                       <td><?php echo $_SESSION['userData']['id']?></td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td><?php echo $_SESSION['userData']['first_name']?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $_SESSION['userData']['email']?></td>
                    </tr>
                </tbody>

            </table>

        </div>
    </div>
</div>
</body>

</html>