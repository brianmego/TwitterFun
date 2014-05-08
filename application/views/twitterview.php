<html>
<head>
    <meta charset="utf8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/application/third_party/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="/application/third_party/js/jquery.min.js"></script>
    <script type="text/javascript" src="/application/third_party/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/application/js/main.js"></script>
    <title><?php echo $title; ?></title>

</head>
<body role="document"
<div class="container" role="main">
    <div class="jumbotron">
        <h1><?php echo $heading; ?></h1>
    </div>
    <br>
    <br>
    <p>
        <input type="text" class="input" name="username" id="username">
        <label>Twitter handle</label>
        <br>
        <input type="password" name="password">
        <label>Password</label>
        <br>
        <button type="button" class="btn btn-primary" name="submit" id="submit">Submit</button>
    </p>
</div>
</body>
</html>