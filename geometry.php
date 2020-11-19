<?php

class Point{
    public $X;
    public $Y;
    function __construct($x, $y){
        $this -> X = $x;
        $this -> Y = $y;
    }
    
    function ChangeX($newX){
        return new Point($newX, $this -> Y);
    }

    function ChangeY($newY){
        return new Point($this -> X, $newY);
    }
}

class Vector{
    public $X;
    public $Y;
    function __construct($x, $y){
        $this -> X = $x;
        $this -> Y = $y;
    } 

    function GetLenght(){
        return sqrt($this -> X* $this -> X + $this -> Y * $this ->  Y);
    }

    function IsZero(){
        return $this -> X == 0 and $this -> Y ==0;
    }

    function PerpendicularWith(Vector $vector2 ){
        return $this -> X * $vector2 -> X + $this -> Y * $vector2 -> Y == 0;
    }
}