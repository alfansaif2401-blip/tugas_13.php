<?php
class fruit{
    public $name;
    public $color;
    public function __construct($name, $color){
        $this->name = $name;
        $this->color = $color;
    }
    public function intro(){
        echo "The fruit is {$this->name} and the color is {$this->color}.";
    }
}

class mango extends fruit{
    public function message(){
        echo "Am I a fruit or a mango?";
    }
}
$mango = new mango("Mango", "Yellow");
$mango->message();
$mango->intro();
?>