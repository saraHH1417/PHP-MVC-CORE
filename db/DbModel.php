<?php

namespace app\core\db;

use app\core\Application;
use app\core\Model;

abstract class DbModel extends Model
{
    abstract public static function tableName(): string;
    abstract public function attributes(): array;
    abstract public static function primaryKey(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr" , $attributes);
        $statement = self::pdoPrepare("INSERT INTO 
                                                $tableName (". implode(',' , $attributes) .")
                                            VALUES
                                                (". implode(',' , $params).")");
        foreach ($attributes as $attribute)
        {
            $statement->bindParam(":$attribute" , $this->{$attribute});
        }

        $statement->execute();
        return true;
    }

    public static function pdoPrepare($query) {

        return Application::$app->db->pdo->prepare($query);
    }

    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND" , array_map(fn($attr) => "$attr= :$attr" , $attributes ));

        $query = "SELECT * FROM $tableName WHERE $sql";

        $statement = self::pdoPrepare($query);
        foreach ($where as $key => $value)
        {
            $statement->bindParam(":$key" , $value);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);

    }
}