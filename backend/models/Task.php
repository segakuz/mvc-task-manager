<?php

class Task
{
    //Items per page for pagination
    const SHOW_BY_DEFAULT = 3;

    /**
     * Returns all tasks
     */
    public function getAllTasks()
    {
        $query = "SELECT * FROM tasks";
        $tasks = DatabaseHandler::GetAll($query);
        return $tasks;
    }

    /**
     * Returns tasks for given page
     */
    public function getPageTasks($page, $sortBy, $order)
    {
        $limit = self::SHOW_BY_DEFAULT;
        $offset = ($page-1) * $limit;
        $query = "SELECT * FROM tasks ORDER BY {$sortBy} {$order} LIMIT {$limit} OFFSET {$offset}";
        $pageTasks = DatabaseHandler::GetAll($query);
        return $pageTasks;
    }

    /**
     * Returns tasks count
     */
    public function getTasksCount() {
        $query = "SELECT count(id) AS count FROM tasks";
        $result = DatabaseHandler::GetOne($query);
        return $result;
    }

    /**
     * Returns task by id
     */
    public function getTaskById($id)
    {
        $id = intval($id);
        $query = "SELECT * FROM tasks WHERE id = :id";
        $result = DatabaseHandler::GetRow($query, ['id' => $id]);
        return $result;
    }

    /**
     * Updates task
     */
    public function updateTask($id, $text, $status, $modified)
    {
        $subQuery = "";
        if($modified === 1)
        {
            $subQuery = ", is_modified = 1";
        }
        $query = "UPDATE tasks SET text = :text, status = :status" . $subQuery . " WHERE id = :id";
        $result = DatabaseHandler::Execute($query, ['text' => $text, 'status' => $status, 'id' => $id]);
        return true;
    }

    /**
     * Adds task to db table
     */
    public function write($name, $email, $text)
    {
        $query = "INSERT INTO tasks (user_name, email, text) VALUES( :name, :email, :text)";
        $result = DatabaseHandler::Execute($query, ['name' => $name, 'email' => $email, 'text' => $text]);
        return true;
    }
}
