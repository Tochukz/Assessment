<?php
namespace Database\Migrations;

class User extends Migration
{
    
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
}