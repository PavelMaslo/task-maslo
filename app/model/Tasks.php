<?php
namespace app\model;

use PDO;
use PDOException;

class Tasks
{
    public static function getTasks($filter)
    {
        $sort = '';
        $route = '';
        if (isset($filter['page']))
            $page = $filter['page'];
        if (isset($filter['limit']))
            $limit = $filter['limit'];
        if (isset($filter['sort'])) {
            $sort = ' ORDER BY  ' . $filter['sort'][0] . ' ';
            if (isset($filter['sort'][1])) {
                $route = $filter['sort'][1];
            } else {
                $route = 'ASC';
            }
        }

        try {
            $conn = DB::Connect();
            $b = $conn->prepare("SELECT * FROM tasks $sort $route
                          LIMIT :page, :limit");
            $b->bindValue(":page", ($page - 1) * $limit, PDO::PARAM_INT);
            $b->bindValue(":limit", $limit, PDO::PARAM_INT);
            $b->execute();
            return $b->fetchAll();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }

    }

    public static function countTask()
    {
        try {
            $conn = DB::Connect();
            $result = $conn->query('SELECT count(id) FROM `tasks`')->fetch();

            return $result["count(id)"];
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }

    }

    public static function saveTask($data)
    {
        try {
            $conn = DB::Connect();
            $sql = "INSERT INTO tasks (name, email, body) VALUES (:name, :email, :body)";
            $stmt = $conn->prepare($sql);

            return $stmt->execute($data);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }

    }

    public static function updateTask($data)
    {
        if (Tasks::getTaskById($data[':id'])) {
            try {
                $pdo = DB::Connect();
                $sql = "UPDATE tasks SET name=:name, email=:email, body=:body , status=:status, changed=:changed WHERE id=:id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($data);
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
        }
    }

    public static function getTaskById($id)
    {
        try {
            $pdo = DB::Connect();
            $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id=?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }

    }
}