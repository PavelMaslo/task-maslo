<?php

namespace app\controllers;

use app\model\Tasks;

class TasksController
{

    function updateTask()
    {
        if ($_SESSION["authenticated"] == 'true') {
            if (isset($_GET['id'])) {
                $task = Tasks::getTaskById($_GET['id']);
            } elseif (isset($_POST['id'])) {
                $task = Tasks::getTaskById($_POST['id']);
            }
            if ($_POST) {

                foreach ($task as $key => $value) {
                    $data[':' . $key] = $value;
                }

//            $data[':id'] = $task['id'];
                if (isset($_POST['name'])) {
                    $data[':name'] = $_POST['name'];
                }
                if (isset($_POST['email'])) {
                    $data[':email'] = $_POST['email'];
                }
                if (isset($_POST['body'])) {
                    $data[':body'] = $_POST['body'];
                    if ($task['body'] != $_POST['body']) {
                        $data[':changed'] = 1;
                    }
                }
                $aut = $_SESSION["authenticated"];
                if (isset($_POST['status'])) {
                    $data[':status'] = $_POST['status'];
                }


                Tasks::updateTask($data);
//            header("Location: /");
            }
            include('web/view/task.php');
        } else {
            header("Location: /");
        }
    }

    function findTask()
    {
        $sort = '';
        $filter = array();
        $filter['page'] = 1;
        $filter['limit'] = 3;
        $current_page = 1;
        if (isset($_GET['page'])) {
            $filter['page'] = max(1, $_GET['page']);
            $current_page = $_GET['page'];
        }
        if (isset($_GET['sort'])) {
            $filter['sort'] = explode('-', $_GET['sort']);
            $sort = $_GET['sort'];
        }

        $all_pages = ceil(Tasks::countTask() / $filter['limit']);
        $tasks = Tasks::getTasks($filter);

        include('web/view/main.php');

    }

    function addTask()
    {
        if (!empty($_POST)) {
            $task = [];
            $task[':name'] = $_POST['name'];
            $task[':email'] = $_POST['email'];
            $task[':body'] = $_POST['body'];
            $result = Tasks::saveTask($task);
            echo Tasks;
            if ($result) {
                $msg = 'Your task was added';
            }

        }
    }
}