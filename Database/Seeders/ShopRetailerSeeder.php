<?php
namespace Database\Seeders;

use PDO;

class ShopRetailerSeeder extends Seeder
{
    public function seedUsersTable()
    {    
        $records = [
            ['site_name'=>'Festac West', 'result'=>'', 'score'=>'', 'created_date'=>date('Y-m-d H:i:s')],
            ['site_name'=>'Apapa East', 'result'=>'', 'score'=>'', 'created_date'=>date('Y-m-d H:i:s')],
            ['site_name'=>'Amuwo North', 'result'=>'', 'score'=>'', 'created_date'=>date('Y-m-d H:i:s')],
            ['site_name'=>'Ojota entral', 'result'=>'', 'score'=>'', 'created_date'=>date('Y-m-d H:i:s')],
            ['site_name'=>'Ebutemeta inside', 'result'=>'', 'score'=>'', 'created_date'=>date('Y-m-d H:i:s')],
        ];
        foreach($records as $record){
            $this->seedTable('shop_retailers', $record);
        }
        
    }
    
}