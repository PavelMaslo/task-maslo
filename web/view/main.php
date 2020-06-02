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
    <style>
        .inline-block {
            display: inline-block;
        }
    </style>
    <script type="text/javascript" src="/web/js/main.js"></script>

    <!--    <script src="js/login.js"></script>-->
</head>

<body>
<div class="jumbotron text-center">
    <h1>Task Manager</h1>
</div>

<div class="container">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalScrollable">
        Add task
    </button>
    <?php if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] == true) {
        ?>
        <form action="/login" method="post" class="inline-block">
            <input type="hidden" name="logout" value="true"/>
            <button class="btn btn-primary">Logout</button>
        </form>
        <?php
    } else {
        ?>
        <a href="/login" class="btn btn-primary">Login</a>
        <?
    }
    ?>


    <div class="alert alert-success msg" role="alert" style="display: none"></div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col" class="col-sm-1">#</th>
            <th scope="col" class="col-sm-2"><a
                        href="?sort=<?php echo ($sort == 'name') ? 'name-desc' : 'name' ?>">Name</a></th>
            <th scope="col" class="col-sm-2"><a href="?sort=<?php echo ($sort == 'email') ? 'email-desc' : 'email' ?>">Email</a>
            </th>
            <th scope="col" class="col-sm-4">Body</th>
            <th scope="col" class="col-sm-1"><a
                        href="?sort=<?php echo ($sort == 'status') ? 'status-desc' : 'status' ?>">Status</a></th>
            <th scope="col" class="col-sm-1">changed</th>
            <th scope="col" class="col-sm-1"></th>
            <?php
            if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] == true) {
                echo '<th scope="col" class="col-sm-1"></th>';
            }
            ?>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($tasks as $task) {
            echo '<tr>';
            echo '<th scope="row">' . $task["id"] . '</th>';
            echo '<td>' . $task["name"] . '</td>';
            echo '<td>' . $task["email"] . '</td>';
            echo '<td>' . htmlspecialchars ( $task["body"] ) . '</td>';
            echo '<td>';
            echo ($task["status"] == 0) ? '<div class="label label-info glyphicon glyphicon-unchecked make-done" data-id="' . $task["id"] . '"
                                            > </div>' : '<span class="label label-info glyphicon glyphicon-ok"> </span> <br/>';
            echo '</td>';
            echo '<td>';
            echo ($task["changed"] == 1) ? '   <span class="label label-warning">Updated</span>':'';
            echo '</td>';
            echo '<td>';
            if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] == true) {
                echo '<a href="/task/update?id=';
                echo $task["id"];
                echo '" class="btn btn-primary" >UPDATE</a>';
            }
            echo '</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
    <div class="text-center">
        <ul class="pagination">
            <?php
            for ($i = 1; $all_pages >= $i; $i++) {
                $href = '?page=' . $i;
                if (!empty($sort)) {
                    $href .= '&sort=' . $sort;
                }
                echo '<li><a href="' . $href . '" data-original-title="" title="">' . $i . '</a></li>';
            }
            ?>
        </ul>
    </div>

    <!-- Modal -->
    <div class="modal fade " id="modalScrollable" tabindex="-1" role="dialog"
         aria-labelledby="modalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="exampleModalScrollableTitle">Add new Task</h3>
                </div>
                <div class="modal-body">
                    <form method="post" action="/task/add" class="TaskForm">
                        <div class="alert alert-danger form-exeption" role="alert">
                        </div>

                        <div class="form-group">
                            <label for="input-name">Name</label>
                            <input type="text" name="name" class="form-control" id="input-name"
                                   placeholder="Вася Пупкин">
                        </div>
                        <div class="form-group">
                            <label for="input-email">Email address</label>
                            <input type="email" name="email" class="form-control" id="input-email"
                                   placeholder="name@example.com">
                        </div>
                        <div class="form-group">
                            <label for="input-body">Task description</label>
                            <textarea name="body" class="form-control" id="input-body" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <div class="btn btn-primary add-task">Add Task</div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</body>

</html>