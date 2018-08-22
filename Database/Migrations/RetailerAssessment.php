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
            id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            question_no INT(2) NOT NULL,
            shop_or_forecourt ENUM('shop','forecourt'),
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
     * Creation of the retailer_score_data table
     * @return boolean
     */
    public function createRetailerScoreDataTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS retailer_score_data(
           id INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
           id_site INT(11) NOT NULL,
           shop_or_forecourt ENUM('shop','forecourt'),
           result TEXT,         
           created_date DATETIME,
           modified_date DATETIME
        )";
        $this->execQuery($query);
        return true;
    }
    

}