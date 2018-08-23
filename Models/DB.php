<?php
namespace Models;

class DB extends Model
{
    /**
     * Creates an instances of a model with a given table t backup th model.
     *
     * @return \Models\Model
     */
    public static function table(string $tableName)
    {
        $model = new DB();
        $model->table = $tableName;
        return $model;
    }
        
}