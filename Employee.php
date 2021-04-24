<?php 
require_once('Abstract.php');
class EmployeeClass extends AbstractClass
{
    public $id,$name,$address,$salary,$tax ;
    public static $tableName ='employees';
    public static $primarykey ='id';
    public static $tableSchema = array(
        'id',
        'name',
        'address',
        'salary',
        'tax'
    );
    public function __construct($id,$name,$address,$salary,$tax){
         $this->id =$id;
         $this->name = $name;
         $this->address = $address;
         $this->salary = $salary;
         $this->tax = $tax;
    }
    
    public function _get($props){
        return $props;
    }

    public function getTableName(){
        return self::$tableName;
    } 

   public function setName($name){
      return  $this->name = $name;
    }
}
