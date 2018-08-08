<?php
namespace Database\Migrations;

class RetailerAssessment extends Migration
{

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
}