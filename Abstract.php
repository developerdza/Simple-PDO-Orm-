<?php 

class AbstractClass
{
    private function prepareParams(PDOStatement &$stm){
        foreach( static::$tableSchema as  $coulomName){
            $stm->bindValue(":{$coulomName}" , $this->$coulomName);
           //$ar .= (":{$coulomName}".' ,'. $this->$coulomName);
         }
    }
    public static function buildParamsNames(){
    $params = '';
        foreach(static::$tableSchema  as $coulomName)
        {
           $params .= $coulomName .'=:'.$coulomName.','; 
        }
    return trim($params , ', ');
    }
    public function create(){
        global $conn;

       $sql = 'INSERT INTO'.' '.static::$tableName.'  '.'SET'.'  '.self::buildParamsNames();
     // $sqll = 'INSERT INTO employees  SET  id=:id,name=:name,address=:address,salary=:salary,tax=:tax,';
    
        $stm = $conn->prepare($sql);
        $ar= '';
       // var_dump($this);
      $this->prepareParams($stm);
        //return $ar; 
        return $stm->execute();
        
    }

    public function update(){
        global $conn;

       $sql = 'UPDATE'.' '.static::$tableName.'  '.'SET'.'  '.self::buildParamsNames() .'  '.'WHERE '. static::$primarykey .'='.$this->{static::$primarykey};
     // $sqll = 'INSERT INTO employees  SET  id=:id,name=:name,address=:address,salary=:salary,tax=:tax,';
         
        $stm = $conn->prepare($sql);
        $this->prepareParams($stm);
        return $stm->execute();
        
    }

    public function delete(){
        global $conn;

       $sql = 'DELETE FROM'.' '.static::$tableName.'  '.'WHERE '. static::$primarykey .'='.$this->{static::$primarykey};
     // $sqll = 'INSERT INTO employees  SET  id=:id,name=:name,address=:address,salary=:salary,tax=:tax,';
         
        $stm = $conn->prepare($sql);
        $this->prepareParams($stm);
        return $stm->execute();
        
    }

    public static function getAll(){
        global $conn;

       $sql = 'SELECT * FROM'.' '.static::$tableName  ;
        
        $stm = $conn->prepare($sql);
       // $this->prepareParams($stm);
       if($stm->execute()){
        return  $stm->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE , get_called_class() , array_keys(static::$tableSchema));
       }
     }


    public static function getByPk($pk){
        global $conn;

       $sql = 'SELECT * FROM'.' '.static::$tableName .' WHERE ' . static::$primarykey .'='.$pk  ;
        
        $stm = $conn->prepare($sql);
       // $this->prepareParams($stm);
       if($stm->execute()){
         $objs = $stm->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE , get_called_class() , array_keys(static::$tableSchema));
         if(!empty($objs)){
            $Obj = array_shift($objs);
            return $Obj;
         }
         else{
             return 'No Found';
         }
       
      }
      else{
        return False;
    } 

   
}


    public function save(){
         if ($this->{static::$primarykey} == null){ $this->update();}
         else{$this->create();}
}
}