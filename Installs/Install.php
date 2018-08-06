<?php
namespace Installs;
use PDO;
use PDOException;

/**
 * This Class will run only once and that is duing the installation of the project.
 */
class Install
{
    /**
     * @var database connection
     */
    protected $connection;


    /**
     * The databse connection created duing class insttatiation.
     * @return void
     */
    public function __construct()
    {
       $cred = getDbCredentials();
       $dbhost = $cred['dbhost']; 
       $dbuser = $cred['dbuser'];
       $dbname = $cred['dbname'];
       $dbpass = $cred['dbpass'];         
       $conn = null;
       try{
           $conn = new PDO("mysql:host=$dbhost; dbname=$dbname", $dbuser, $dbpass);
           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       }catch(PDOException $ex){
          echo "Connection failed: ".$ex->getMessage();
       }
       
       $this->connection = $conn;
    }  
    
    /**
     * Creation of the users table.
     * @return boolean
     */
    public function createUsersTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS users (
          id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          firstname VARCHAR(30),
          lastname VARCHAR(30)
        )";
     
        $this->execQuery($query);
        return true;
    }

    /**
     * Creation of the assessment_scores table
     * @return boolean
     */
    public function createAssessmentScoresTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS assessment_scores (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_id INT(4) UNSIGNED,          
            score INT(4),
            created_date DATETIME,
            FOREIGN KEY(user_id) REFERENCES users(id)
        )";
        
        $this->execQuery($query);
        return true;
    }

    /**
     * Creation of the assessment_questions table.
     * 
     * @return boolean
     */
    public function createAssessmentQuestionsTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS assessment_questions(
           id INT(2) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
           question VARCHAR(150) NOT NULL,
           options VARCHAR(255) NOT NULL
        )";
        $this->execQuery($query);
        return true;
    }

    /**
     * Runs a given query.
     * 
     * @param string $query
     * @return void;
     */
    public function execQuery(string $query)
    {
        try{
            $this->connection->exec($query);
        }catch(\PDOExeption $ex){
            echo $ex->getMessage();
        }
       
    }
   
    /**
     * Delete created tables.
     * @return void
     */
    public function rollBackTables($tableNames)
    {     
        foreach($tableNames as $tableName){
            echo "dropping $tableName ... \n";
            $query = "DROP TABLE $tableName";
            $this->execQuery($query);
            echo $tableName." dropped.\n";
        }
        exit;
    }
    
    /**
     * Free the connection resource.
     */
    public function __destruct()
    {
        $this->connection = null;
    }

}