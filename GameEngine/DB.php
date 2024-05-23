<?php
include_once("Lib/Mutex/Mutex.php");
use NinjaMutex\Mutex;
include_once("Lib/Mutex/Lock/FlockLock.php");
use NinjaMutex\Lock\FlockLock;
include_once("common.php");

class DB
{
    # @object, The PDO object
    private $pdo;
    # @object, PDO statement object
    private $sQuery;
	private $dbLock;
	private $succes = false;
    # @bool ,  Connected to the database
    private $bConnected = false;
    # @array, The parameters of the SQL query
    private $parameters;

	protected $host;
	protected $user;
	protected $password;
	protected $db_name;
	
	protected $hasActiveTransaction = false;
       /**
    *   Default Constructor
    *
    *    1. Instantiate Log class.
    *    2. Connect to database.
    *    3. Creates the parameter array.
    */
        public function __construct()
        {
           // $this->Connect();
            $this->parameters = array();
			
			$this->host = SQL_SERVER;
			$this->user = SQL_USER;
			$this->password = SQL_PASS;
			$this->db_name = SQL_DB;
        }
		
		public function __destruct(){
			$this->PerformClose();
		}

       /**
    *    This method makes connection to the database.
    *
    *    1. Reads the database settings from a ini file.
    *    2. Puts  the ini content into the settings array.
    *    3. Tries to connect to the database.
    *    4. If connection failed, exception is displayed and a log file gets created.
    */
        public function Connect()
        {
			//$this->Connect(SQL_DB,SQL_SERVER,SQL_USER,SQL_PASS);
            if($this->pdo == null){
		      	$this->PerformConnect($this->db_name,$this->host,$this->user,$this->password);
            }
        } 
		public function NewConnect($sgl_db,$sql_server,$sql_user,$sql_pass){
			$this->host = $sql_server;
			$this->user = $sql_user;
			$this->password = $sql_pass;
			$this->db_name = $sgl_db;
			$this->PerformConnect($this->db_name,$this->host,$this->user,$this->password);
		}
		
		public function PerformConnect($sgl_db,$sql_server,$sql_user,$sql_pass)
        {
			try {
                $dsn = 'mysql:dbname='.$sgl_db.';host='.$sql_server;
                # Read settings from INI file
                $this->pdo = new PDO($dsn, $sql_user, $sql_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET sql_mode=""'));
                $this->pdo->exec('SET NAMES utf8');
                # We can now log any exceptions on Fatal error.
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                # Disable emulation of prepared statements, use REAL prepared statements instead.
                $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                # Connection succeeded, set the boolean to true.
                $this->bConnected = true;
			}
			catch(PDOException $e)
            {
				$this->bConnected = false;
				error_log("PerformConnect -".$e->getMessage());				
			}

        }
		
		public function PerformClose(){
			$this->pdo = null;
		}
		
       /**
    *    Every method which needs to execute a SQL query uses this method.
    *
    *    1. If not connected, connect to the database.
    *    2. Prepare Query.
    *    3. Parameterize Query.
    *    4. Execute Query.
    *    5. On exception : Write Exception into the log + SQL query.
    *    6. Reset the Parameters.
    */
        private function Init($query,$parameters = "",$retry=0)
        {
			$this->succes = false;
			# Connect to database
			if(!$this->bConnected) { $this->Connect(); }	
			try {
                # Prepare query
                $this->sQuery = $this->pdo->prepare($query);

                # Add parameters to the parameter array
                $this->bindMore($parameters);

                # Bind parameters
                if(!empty($this->parameters)) {
                    foreach($this->parameters as $param)
                    {
                        $parameters = explode("\x7F",$param);
                        $this->sQuery->bindParam($parameters[0],$parameters[1]);
                    }
                }
				#Execute SQL
  
                $this->succes     = $this->sQuery->execute();

            }
            catch(PDOException $e)
            {
				addToLog("db","Faulty query: ".$query);
				addToLog("db",$e->getMessage());
				addToLog("db",$e->getTraceAsString ());
				if(($e->getCode() == 1213 || $e->getCode() == 40001) && $retry <=3){
					/*
					//retry
					error_log("DEADLOCK - Retrying");
					addToLog("db","DEADLOCK - Retrying");
					$this->Init($query,$parameters,$retry++);*/
					if($this->hasActiveTransaction){
						try{$this->pdo->rollback();}catch(PDOException $e){error_log("Unable to rollback");};
					}
					addToLog("db","DEADLOCK - Retrying");
					$this->Init($query,$parameters,$retry++);
				}else if(($e->getCode() == 1213 || $e->getCode() == 40001) && $retry >3){
					throw new PDOException("DATABASE IS LOCKED");
				}
				//error_log("Init - ".$e->getMessage());
            }
			
			if($this->sQuery == null && $retry<2){
				$this->Init($query,$parameters,$retry++);
			}
			
            # Reset the parameters
            $this->parameters = array();
        }
		
		public function isSucces(){
			return $this->succes;
		}

       /**
    *    @void
    *
    *    Add the parameter to the parameter array
    *    @param string $para
    *    @param string $value
    */
        public function bind($para, $value)
        {
            $this->parameters[sizeof($this->parameters)] = ":" . $para . "\x7F" . $value;

        }
		
		public function testAndReconnect(){
			if(!$this->pdo)return;
			try {		
				$this->pdo->prepare("Select 1");
				return;
			} catch (PDOException $e) {
                $this->PerformClose();
				$this->Connect();
			}
		}
		
       /**
    *    @void
    *
    *    Add more parameters to the parameter array
    *    @param array $parray
    */
        public function bindMore($parray)
        {

            if(empty($this->parameters) && is_array($parray)) {
                $columns = array_keys($parray);
                foreach($columns as $column)    {
                    $this->bind($column, $parray[$column]);
                }
            }

        }
    /**
    *   If the SQL query  contains a SELECT statement it returns an array containing all of the result set row
    *    If the SQL statement is a DELETE, INSERT, or UPDATE statement it returns the number of affected rows
    *
    *       @param  string $query
    *    @param  array  $params
    *    @param  int    $fetchmode
    *    @return mixed
    */
        public function query($query,$params = null,$fetchmode = PDO::FETCH_ASSOC)
        {
            $query = trim($query);

            $this->Init($query,$params);
                                                                                                                                    //->lastInsertId
            if (stripos($query, 'SELECT') === 0){

                return $this->sQuery->fetchAll($fetchmode);
            }
            else{

                return NULL;
            }
        }

    public function starttransaction($type=""){
		$this->testAndReconnect();
        if($type!=""){
			$this->dbLock = new Mutex($type,new FlockLock(dirname(__FILE__)));
			if (!$this->dbLock->acquireLock(1000)) {		
				error_log("Starttransaction - "."DATABASE IS LOCKED");
				throw new PDOException("DATABASE IS LOCKED");
			}
		}else{
			$this->pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,0);
			$this->hasActiveTransaction = $this->pdo->beginTransaction();	
			//error_log("Transaction status:".(($this->hasActiveTransaction)?"true":"false"));
		}		
    }
    public function commitq($type=""){
		if($type!=""){			
			if ($this->dbLock) {				
				$this->dbLock->releaseLock($type);
			}
		}else{
			try{
				if($this->hasActiveTransaction){
					$this->pdo->commit();
				}else{
					error_log("No transaction -> no commit needed");
				}
			}catch(PDOException $e){
				addToLog("db",$e->getMessage());
				addToLog("db",$e->getTraceAsString ());
				
				if($e->getMessage() != "There is no active transaction"){
					error_log("Commit - ".$e->getMessage());
					$this->pdo->rollback();
				}else{
					//no transaction do nothing?
				}
				throw $e;
			}finally{				
				$this->pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,1);
				$this->hasActiveTransaction = false;
			}
		}
		$this->pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,1);
    }
	
	public function rollBackq(){
		if($this->hasActiveTransaction){
			$this->pdo->rollBack();
		}
	}
	

       /**
    *    Returns an array which represents a column from the result set
    *
    *    @param  string $query
    *    @param  array  $params
    *    @return array
    */
        public function column($query,$params = null)
        {
            $this->Init($query,$params);
            $Columns = $this->sQuery->fetchAll(PDO::FETCH_NUM);

            $column = null;

            foreach($Columns as $cells) {
                $column[] = $cells[0];
            }

            return $column;

        }
       /**
    *    Returns an array which represents a row from the result set
    *
    *    @param  string $query
    *    @param  array  $params
    *       @param  int    $fetchmode
    *    @return array
    */
        public function row($query,$params = null,$fetchmode = PDO::FETCH_ASSOC)
        {
            $this->Init($query,$params);
            return $this->sQuery->fetch($fetchmode);
        }
       /**
    *    Returns the value of one single field/column
    *
    *    @param  string $query
    *    @param  array  $params
    *    @return string
    */
        public function single($query,$params = null)
        {
            $this->Init($query,$params);
            return $this->sQuery->fetchColumn();
        }
        /**
        * grab the last insterted query id
        *
        */
        public function get_last_id(){
         return $this->pdo->lastInsertId();
        }
       /**
    * Writes the log and returns the exception
    *
    * @param  string $message
    * @param  string $sql
    * @return string
    */
    private function ExceptionLog($message , $sql = "")
    {
        $exception  = 'Unhandled Exception. <br />';
        $exception .= $message;
        $exception .= "<br /> DEATH FOR YOU.";

        if(!empty($sql)) {
            # Add the Raw SQL to the Log
            $exception .= "\r\nRaw SQL : "  . $sql;
        }

        return $exception;
    }
	
	function importSqlFile($sqlFile, $tablePrefix = null, $InFilePath = null)
	{
		try {
			
			// Enable LOAD LOCAL INFILE
			$this->pdo->setAttribute(PDO::MYSQL_ATTR_LOCAL_INFILE, true);
			
			$errorDetect = false;
			
			// Temporary variable, used to store current query
			$tmpLine = '';
			
			// Read in entire file
			$lines = file($sqlFile);
			
			// Loop through each line
			foreach ($lines as $line) {
				// Skip it if it's a comment
				if (substr($line, 0, 2) == '--' || trim($line) == '') {
					continue;
				}
				
				// Read & replace prefix
				$line = str_replace(['<<prefix>>', '<<InFilePath>>'], [$tablePrefix, $InFilePath], $line);
				
				// Add this line to the current segment
				$tmpLine .= $line;
				
				// If it has a semicolon at the end, it's the end of the query
				if (substr(trim($line), -1, 1) == ';') {
					try {
						// Perform the Query
						$this->pdo->exec($tmpLine);
					} catch (PDOException $e) {
						echo "<br><pre>Error performing Query: '<strong>" . $tmpLine . "</strong>': " . $e->getMessage() . "</pre>\n";
						$errorDetect = true;
					}
					
					// Reset temp variable to empty
					$tmpLine = '';
				}
			}
			
			// Check if error is detected
			if ($errorDetect) {
				return false;
			}
			
		} catch (Exception $e) {
			echo "<br><pre>Exception => " . $e->getMessage() . "</pre>\n";
			return false;
		}
		
		return true;
	}
}
