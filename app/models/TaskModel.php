<?php

class TaskModel extends Model
{

    protected $_table = 'todo';

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
}