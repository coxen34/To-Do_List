<?php

class TaskModel extends Model
{

    protected $_table = 'todo';
    protected $sql;

    public function getAllTasks()
    {
        // SQL query
        $sql = 'select * from ' . $this->_table;
        $statement = $this->_dbh->prepare($sql);
        $statement->execute();

        // store all returned rows in array of stdClass objects
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        // Convert stdClass objects to associative arrays
        $tasks = json_decode(json_encode($result), true);

        return $tasks;
    }

    //________________DELETE TASK_______________
    public function deleteTask($taskId)
    {
        try {
            // Utiliza una consulta SQL para eliminar la tarea por ID
            //_table valor columna 'id' coincida con el valor proporcionado en :taskId.
            $sql = 'DELETE FROM ' . $this->_table . ' WHERE id = :taskId';
            //  Esto es importante para evitar problemas de seguridad como la inyección de SQL.?? X MIRAR
            $statement = $this->_dbh->prepare($sql);
            // PARA VINCULAR LOS VALORES
            $statement->bindParam(':taskId', $taskId);
            // ALMACENO EN: 'success' EL RESULTADO DE LA EJECUCION
            $success = $statement->execute();

            if ($success) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            $_SESSION['error_message'] = 'Database error: ' . $e->getMessage();
            return false;
        }
    }

    //________________CREATE TASK_______________
    public function createTask($newTask)
    {

        $result = $this->save($newTask);

    }
    
    public function getTaskById($taskId)
    {
        try {
            // SQL query to fetch a task by ID
            $sql = 'SELECT * FROM ' . $this->_table . ' WHERE id = :taskId';
            $statement = $this->_dbh->prepare($sql);
            $statement->bindParam(':taskId', $taskId);
            $statement->execute();

            // Fetch the task as an associative array
            $task = $statement->fetch(PDO::FETCH_ASSOC);

            return $task;

        } catch (PDOException $e) {
            $_SESSION['error_message'] = 'Database error: ' . $e->getMessage();
            return false;

        }

    }

    public function updateTask($taskId, $updatedTaskData)
    {
        try {
            // SQL query to update a task by ID
            $sql = 'UPDATE ' . $this->_table . ' SET 
                    task_description = :taskDescription,
                    author = :author,
                    starting_date = :startingDate,
                    end_date = :endDate,
                    status = :status,
                    WHERE id = :taskId';
            
            // Prepare the SQL statement
            $statement = $this->_dbh->prepare($sql);
            
            // Bind the task ID
            $statement->bindParam(':taskId', $taskId);

            // Bind the updated task data
            $statement->bindParam(':taskDescription', $updatedTaskData['task_description']);
            $statement->bindParam(':author', $updatedTaskData['author']);
            $statement->bindParam(':startingDate', $updatedTaskData['starting_date']);
            $statement->bindParam(':endDate', $updatedTaskData['end_date']);
            $statement->bindParam(':status', $updatedTaskData['status']);
            
            // Execute the update query
            $success = $statement->execute();

            return $success;
        } catch (PDOException $e) {
            $_SESSION['error_message'] = 'Database error: ' . $e->getMessage();
            return false;
        }
    }
    public function getPendingTasks()
{
        $sql = 'SELECT * FROM ' . $this->_table . ' WHERE status = "pending"';
        $statement = $this->_dbh->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_OBJ);
}
public function getOngoingTasks()
{
        $sql = 'SELECT * FROM ' . $this->_table . ' WHERE status = "ongoing"';
        $statement = $this->_dbh->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_OBJ);
}

}