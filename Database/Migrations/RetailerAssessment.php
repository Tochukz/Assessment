<?php
namespace Database\Migrations;

class RetailerAssessment extends Migration
{

    /**
     * Creation of the shop_assessments table
     * @return boolean
     */
    public function createRetailerAssessmentsTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS retailer_assessments (
            id INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            question_no INT(2) NOT NULL,
            place VARCHAR(20) NOT NULL,
            competency VARCHAR(100), 
            min_requirement INT(1),
            assessment TEXT,  
            created_date DATETIME            
        )";
        //FOREIGN KEY(user_id) REFERENCES users(id)
        $this->execQuery($query);
        return true;
    }

    /**
     * Creation of the shop_retailers table.
     * 
     * @return boolean
     */
    public function createShopRetailersTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS shop_retailers(
           id INT(2) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
           site_name VARCHAR(40) NOT NULL,
           result TEXT,
           score INT(3),
           created_date DATETIME
        )";
        $this->execQuery($query);
        return true;
    }
}