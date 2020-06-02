<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div class="jumbotron text-center">
    <h1>Task Manager</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h3 class="card-title text-center">Sign In</h3>
            <?
                if(isset($msg)){
                    echo '<div class="alert alert-warning" role="alert">'.$msg.' </div>';
                }
            ?>

        <form id="login" method="post">
            <div class="form-label-group">
                <input type="text" id="inputName" name="username" class="form-control"
                       placeholder="User name"
                       required
                       autofocus>
                <label for="inputName">User name</label>
            </div>

            <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control"
                       placeholder="Password"
                       required>
                <label for="inputPassword">Password</label>
            </div>

            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in
            </button>

        </form>
    </div>
    </div>
</div>

</body>

</html>