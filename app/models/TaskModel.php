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
}