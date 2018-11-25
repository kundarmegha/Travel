<?php
class A
{
protected $gk;
function __construct($var)
{
$this->gk=$var;
echo $this->gk;
}
}
class B extends A
{
 var $b;
 function __construct()
 {
$this->b = parent::$gk;
echo $this->b;
}
}
class C extends B
{
var $c;
var $d;
function __construct()
{
    $this->c = A::$gk;
$this->d = parent::$b;
echo $this->b;
}
}
$obj = new A(10);
$obj = new B();
$obj = new C();

?>