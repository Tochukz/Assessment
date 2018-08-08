<?php
namespace Database\Seeders;

use PDO;

class UserSeeder extends Seeder
{
    public function seedUsersTable()
    {    
        $inputArray = ['firstname'=>'Mummy', 'lastname'=>'Nwachukwu']; 
        $this->seedTable('users', $inputArray);
    }
    
}