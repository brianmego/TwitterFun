<html>
<head>
    <meta charset="utf8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/application/third_party/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="/application/third_party/js/jquery.min.js"></script>
    <script type="text/javascript" src="/application/third_party/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/application/js/main.js"></script>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2Mz-ovZqQAUTNwEShqOfm_65DF9fZStc&sensor=false">
    </script>
    <title><?php echo $title; ?></title>

</head>
<body role="document">
    <div class="container" role="main">
        <div class="jumbotron">
            <h1><?php echo $heading; ?></h1>
        </div>
        <br>
        <div class="row">

                <?php if ($authenticated): ?>
                    <form method="post">
                        <h3>Authenticated with Twitter as <?php echo $screen_name; ?></h3>
                        <input type="submit" class="btn btn-primary" name="unauthenticate" id="unauthenticate" value="Unauthenticate" />
                        <input type="button" class="btn btn-primary" name="getFriends" id="getFriends" value="Get Twitter Friends" />
                        <input type="button" class="btn btn-primary" name="getTimeline" id="getTimeline" value="Get Timeline" />
                    </form>
                <?php else: ?>
                    <form method="post">
                        <input type="submit" class="btn btn-primary" name="reauthenticate" id="reauthenticate" value="Reauthenticate" />
                    </form>
                <?php endif; ?>
            
        </div>
        <div class="row">
            <div id="map-canvas" style="width:100%; height:100%"/>
        </div>
    </div>
</body>
</html>