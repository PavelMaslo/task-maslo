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
    <script src="/web/js/main.js"></script>
</head>

<body>
<div class="jumbotron text-center">
    <h1>Task Manager</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h3 class="card-title text-center">Updete Task</h3>

            <form method="post" action="/task/update?id=<?php echo $_GET['id']?>" class="TaskForm">
                <div class="alert alert-danger form-exeption" role="alert"  >
                </div>
                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" name="name" class="form-control" id="input-name"
                           placeholder="Вася Пупкин" value="<?echo $task['name']?>">
                </div>
                <div class="form-group">
                    <label for="inputEmail">Email address</label>
                    <input type="email" name="email" class="form-control" id="input-email"
                           placeholder="name@example.com" value="<?echo $task['email']?>">
                </div>
                <div class="form-group">
                    <label for="inputBody">Task description</label>
                    <textarea name="body" class="form-control" id="input-body" rows="3"> <?echo $task['body']?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <div class="btn btn-primary add-task"> Save</div>
                </div>
            </form>
    </div>
</div>
</div>

</body>

</html>