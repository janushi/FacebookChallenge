<?php
require_once './config.php';

$permissions = ['user_photos'];
$accessToken =  $_SESSION['access_token'];

//$authUrl = getAuthorizationUrl("", "");
if (isset($accessToken))
{
    $fb = new Facebook\Facebook([
        'app_id' => '306077460151348',
        'app_secret' => '0207a49b23ca52f50545b41d57cb6ec3',
        'default_graph_version' => 'v2.2',
        'default_access_token' => isset($_SESSION['facebook_access_token']) ? $_SESSION['facebook_access_token']  : '262bf7031a2f1cd1610e780eb2a6f21e'
    ]);
    $response = $fb->get('/me?fields=albums', $accessToken);
    $user = $response->getGraphuser();
    ?>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="css/album.css" rel="stylesheet">
        <style>
            body {
                margin: 0;
                font-family: 'Catamaran', sans-serif;
                font-size: 1rem;
                background: #c9d1c9;

                min-height: 97.8vh;
                text-align: center;
            }
            .download{
                background-color: green;
                border:none;
                color:white;
                padding: 10px 25px;
                font-size: 15px;
                border-radius: 8px;
                display: inline-block;
                -webkit-transition-duration: 0.4s;
                transition-duration: 0.4s;
            }
            .download:hover{
                background-color: white;
                color:limegreen;
            }
            .move{
                background-color: #fc3;
                border:none;
                color:white;
                padding:10px 25px;
                font-size:15px;
                border-radius:8px;
                display:inline-block;
                -webkit-transition-duration: 0.4s;
                transition-duration: 0.4s;
            }
            .move:hover{
                background-color: white;
                color:#fc3;
            }
            .logout{
                background-color: #bd2130;
                border:none;
                color:white;
                padding:10px 25px;
                font-size:15px;
                border-radius:8px;
                display:inline-block;
                -webkit-transition-duration: 0.4s;
                transition-duration: 0.4s;
            }


            .bg-light {
                background-color: transparent !important;

        </style>
        <script>
            function SelectedAlbumDownload(){
                var array = [];
                var selectedAlbums="";
                var chbx = document.querySelectorAll('input[type=checkbox]:checked');
                for (var i = 0; i < chbx.length; i++)
                {
                    if(chbx[i].checked==true)
                    {
                        selectedAlbums=selectedAlbums+"/"+chbx[i].value;
                    }
                }
                window.location="download-selected-album.php?albumid="+selectedAlbums;
            }
            function AllAlbumDownload()
            {
                var array=[];
                var allAlbums="";
                var chbx=document.querySelectorAll('input[type=checkbox]');
                for(var i=0;i<chbx.length;i++)
                {
                    allAlbums=allAlbums+"/"+chbx[i].value;
                }
                window.location="download-all-album.php?albumid="+allAlbums;
            }

            }
            function setCookie(cname,cvalue,exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays*24*60*60*1000));
                var exprs = "exprs=" + d.toGMTString();
                document.cookie = cname + "=" + cvalue + ";" + exprs + ";path=/";
            }
            function getCookie(cname) {
                var name = cname + "=";
                var decodedCookie = decodeURIComponent(document.cookie);
                var ca = decodedCookie.split(';');
                for(var i = 0; i <ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }
            function nameChange(n){
                var elem = document.getElementById("button"+n);
                var cookie=getCookie("move");
                <?php
                if(!isset($_GET['code'])){
                ?>
                window.location="<?php echo $authUrl;?>";
                setCookie("move",cookie,30);
                <?php }
                else
                {
                ?>
                window.location="file-upload.php?code=<?php echo $_GET['code']; ?>";
                <?php } ?>
            }
        </script>
    </head>
    <body>
    <header>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container d-flex justify-content-between">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <b>My Albums</b>
                </a>
            </div>
        </div>
    </header>
    <main role="main">
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <?php
                    try{
                        for($i=0;$i<count($user['albums']);$i++)
                        {
                            $re = $fb->get('/'.$user['albums'][$i]['id'].'/photos?limit=100',$accessToken);
                            $graphEdge  = $re->getGraphEdge();
                            $_SESSION['album_id']=$user['albums'][$i]['id'];
                            if(count($graphEdge)>0)
                            {
                                $response=$fb->get('/'.$graphEdge[$i]['id'].'/?fields=images',$accessToken);
                                $result=$response->getGraphNode();
                                $link=$result['images'][0];
                                ?>
                                <div class="col-md-4">
                                <div class="card mb-4 shadow-sm">
                                <a href="<?php echo 'album-pictures.php?albumid='.$user['albums'][$i]['id'];?>">
                                    <img class="card-img-top" src="<?php echo $link['source'];?>" style="height:30%;" alt="Card image cap">
                                </a>
                                <?php
                            }
                            ?>
                            <div class="card-body">
                                <p class="card-text">
                                    <a href="<?php echo 'album-pictures.php?albumid='.$user['albums'][$i]['id'];?>"><?php echo $user['albums'][$i]['name']?></a>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="downloadAlbum.php?albumid=<?php echo $user['albums'][$i]['id'];?>">
                                           <button type="button" class="btn btn-sm btn-outline-primary">Download</button>
                                        </a>
                                    </div>
                                    <small class="text-muted"><input type="checkbox" id="checkbox" value="<?php echo $user['albums'][$i]['id']; ?>"></small>
                                </div>
                            </div>
                            </div>
                            </div>
                            <?php
                        }
                    }catch(Facebook\Exceptions\FacebookSDKException $e)
                    {
                        echo "SDK Exception: ".$e->getMessage();
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>


    <br>
    <table>
        <tr>
            <input type="hidden" name="albumid" value="<?php echo $user['albums'][$i]['id']?>">
            <button class="download" onclick="AllAlbumDownload()">Download All Albums&nbsp;&nbsp</button>
            &nbsp;&nbsp;&nbsp;

            <input type="hidden" name="albumid" value="<?php echo $user['albums'][$i]['id']?>">
            <button class="download" onclick="SelectedAlbumDownload()">Download Selected Albums&nbsp;&nbsp;</button>
            &nbsp;&nbsp;&nbsp;

           &nbsp;&nbsp;&nbsp;

        </tr>
    </table>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
    </html>
    <?php
}
?>
