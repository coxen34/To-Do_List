<?php

/**
 * Un modelo base para manejar las conexiones de la base de datos.
 */
class Model
{
	protected $_dbh = null;
	protected $_table = "";
	
	public function __construct()
	{
		// analiza el archivo de configuración
		$settings = parse_ini_file(ROOT_PATH . '/config/settings.ini', true);
		
		// inicia la conexión a la base de datos
		$this->_dbh = new PDO(
			sprintf(
				"%s:host=%s;dbname=%s",
				$settings['database']['driver'],
				$settings['database']['host'],
				$settings['database']['dbname']
			),
			$settings['database']['user'],
			$settings['database']['password'],
			array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
		);
		
		$this->init();
	}
	
	public function init()
	{
		
	}
	
	/**
	 * Establece la tabla de base de datos que utiliza el modelo
	 * @param string $table la tabla que está usando el modelo
	 */
	protected function _setTable($table)
	{
		$this->_table = $table;
	}
	
	public function fetchOne($id)
	{
		$sql = 'select * from ' . $this->_table;
		$sql .= ' where id = ?';
		
		$statement = $this->_dbh->prepare($sql);
		$statement->execute(array($id));
		
		return $statement->fetch(PDO::FETCH_OBJ);
	}
	
	/**
	 * Guarda los datos actuales en la base de datos. Si se proporciona una clave llamada "id",
	 * se emitirá una actualización.
	 * @param array $data los datos a guardar
	 * @return int la identificación bajo la cual se guardaron los datos
	 */
	public function save($data = array())
	{
		$sql = '';
		
		$values = array();
		
		if (array_key_exists('id', $data)) {
			$sql = 'update ' . $this->_table . ' set ';
			
			$first = true;
			foreach($data as $key => $value) {
				if ($key != 'id') {
					$sql .= ($first == false ? ',' : '') . ' ' . $key . ' = ?';
					
					$values[] = $value;
					
					$first = false;
				}
			}
			
			// agrega la identificación también
			$values[] = $data['id'];
			
			$sql .= ' where id = ?';// . $data['id'];
			
			$statement = $this->_dbh->prepare($sql);
			return $statement->execute($values);
		}
		else {
			$keys = array_keys($data);
			
			$sql = 'insert into ' . $this->_table . '(';
			$sql .= implode(',', $keys);
			$sql .= ')';
			$sql .= ' values (';
			
			$dataValues = array_values($data);
			$first = true;
			foreach($dataValues as $value) {
				$sql .= ($first == false ? ',?' : '?');
				
				$values[] = $value;
				
				$first = false;
			}
			
			$sql .= ')';
			
			$statement = $this->_dbh->prepare($sql);
			if ($statement->execute($values)) {
				return $this->_dbh->lastInsertId();
			}
		}
		
		return false;
	}
	
	/**
	 * Elimina una sola entrada
	 * @param int $id la identificación de la entrada a eliminar
	 * @return boolean verdad si todo salió bien, de lo contrario false.
	 */
	public function delete($id)
	{
		$statement = $this->_dbh->prepare("delete from " . $this->_table . " where id = ?");
		return $statement->execute(array($id));
	}
}
