<html>
<head>
    <meta charset="utf8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/application/third_party/css/bootstrap.min.css" rel="stylesheet">
    <link href="/application/third_party/css/cover.css" rel="stylesheet">
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style id="holderjs-style" type="text/css"></style>
    <title><?php echo $title; ?></title>
</head>
<body>
    <div class="site-wrapper">
        <div class="site-wrapper-inner">
            <div class="cover-container" style="height:80%">
                <div class="masthead clearfix">
                    <div class="inner">
                        <div>
                            <?php if ($authenticated): ?>
                                <h3 class="masthead-brand">Welcome: <?php echo $screen_name; ?></h3>
                                <ul class="nav masthead-nav">
                                    <li>
                                        <form method="post">
                                            <input type="submit" class="btn btn-primary" name="unauthenticate" id="unauthenticate" value="Unauthenticate" />
                                        </form>
                                    </li>
                                    <li>
                                        <input type="button" class="btn btn-primary" name="plotTweets" id="plotTweets" value="Plot Tweets" />
                                    </li>
                                </ul>

                            <?php else: ?>
                                <form method="post">
                                    <input type="submit" class="btn btn-primary" name="reauthenticate" id="reauthenticate" value="Authenticate" />
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="inner cover" style="width:100%; height:100%">
                    <?php if ($authenticated): ?>
                        <div id="map-canvas" style="width:100%; height:100%"></div>
                    <?php else: ?>
                        <h1 class="cover-heading">Twitter and Google Are Plotting</h1>
                        <p class="lead">
                            Or Rather, they'd like to. Authenticate with your twitter credentials and you can help them!
                        </p>
                    <?php endif; ?>
                </div>
                <div class="mastfoot">
                    <div class="inner">
                      <p><a href="https://www.linkedin.com/profile/view?id=44966641&trk=nav_responsive_tab_profile">Brian Mego</a> dev test.</p>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <script type="text/javascript" src="/application/third_party/js/jquery.min.js"></script>
  <script type="text/javascript" src="/application/third_party/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/application/js/main.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2Mz-ovZqQAUTNwEShqOfm_65DF9fZStc&sensor=false"></script>
</body>
</html>