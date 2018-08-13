<?php
namespace Database\Migrations;

class RetailerAssessment extends Migration
{

    /**
     * Creation of the shop_assessments table
     * @return boolean
     */
    public function createShopAssessmentsTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS shop_assessments (
            id INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
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
     * Creation of the assessment_questions table.
     * 
     * @return boolean
     */
    // public function createAssessmentQuestionsTable()
    // {
    //     $query = "CREATE TABLE IF NOT EXISTS assessment_questions(
    //        id INT(2) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    //        question VARCHAR(150) NOT NULL,
    //        options VARCHAR(255) NOT NULL
    //     )";
    //     $this->execQuery($query);
    //     return true;
    // }
}