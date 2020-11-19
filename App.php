<?php namespace App;
class testClass{
    function hello($args){
        echo "<strong> hello {$args} from parent class </strong> <br> ";
    }

    function __toString()
    {
        return 'parentClass';
    }
}

class MagicClass 
{ 
    public $a = 1;

    function __construct(testClass $parent)
    {
        $this -> parent = $parent;
        echo '<strong> constructed </strong> <br> ';
    }
    
    function __destruct()
    {
        echo '<strong> distructed </strong> <br> ';
    }

    function __get($name) 
    {
        echo "<strong> get </strong> $name  => {$this->$name} <br> ";
        return $this->$name;
    }

    function __set($name, $value) 
    {
        $this->$name = $value;
        echo "$name <strong> set </strong> $value <br>  ";
    }

    function __isset($name) {
        echo "<strong> isset </strong>'{$name}' checked if exist <br> ";
        return isset($this -> $name);
    }
      
    function __unset($name)  
    {  
        echo "'{$name}' <strong> unsetted  </strong><br> ";
        unset($this->$name);  
    }  

    function __toString()  
    {  
        echo " <strong> __toString() </strong>returns {$this-> a} <br> ";
        return strval($this-> a);  
    }

    function __sleep()  
    {  
        echo "<strong> sleep </strong> <br> ";
        return array('a', 'parent');  
    }  

    function __wakeUp()
    {
        // unserialize() проверяет наличие метода с магическим именем __wakeup()
        echo "<strong> wakeUp </strong>  <br> ";
        $this -> a = 1;
    }

    function __call($methodName, $args = null) 
    {
        if(method_exists($this->parent, $methodName))  
        {
            echo "{$methodName} <strong> called </strong> with {$args} <br>";
            $this->parent -> $methodName($args);
        }
    }

    function __clone()
    {
        echo " <strong> cloned </strong> <br> ";
    }

    function __invoke($parent)  
    {   
        echo " <strong> INVOKING </strong> <br>";
        $parent->hello($this);  
        echo " <strong> INVOKING </strong> <br><br>";
    }

    function __set_state($properties)
    {
        //Этот статический метод вызывается для тех классов,
        //      которые экспортируются функцией var_export() начиная с PHP 5.1.0.
        // Единственный параметр этого метода является массив, 
        //      содержащий экспортируемые свойства в виде array('property' => value, ...).
        $obj = new MagicClass(new testClass());
        $obj->a = $properties['a'];
        $obj->parent = $properties['parent'];
        return $obj;
    }

    function __debugInfo()
    {
        echo "<strong> debugInfo </strong> <br>";
        return ['hoho' => 'haha', "info" => 'get some info about obj'];
    }

}

$parent = new testClass();
$test = new MagicClass($parent);
$test ->gege = 'gegeg';
$test -> __set('a', 3);
$test ->a = 2; // не вызывает __set 
$test-> __get('a');
// echo 'a = '. $test-> __get('a') . '<br>';
$test -> __isset('a');
$test -> __unset('gege');
// var_dump($test-> __isset('gege'));
$test -> __toString();
$test -> __sleep(); 
// var_dump($test-> __sleep());
$test -> __wakeUp(); // прим: восстановить соединение
$test -> __call('hello', 'world');
$test1 = clone $test;
// var_dump($test1);
$test -> __invoke($parent);
$test -> __debugInfo();
var_dump($test);

// var_dump($test);