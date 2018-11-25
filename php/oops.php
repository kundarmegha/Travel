<?php
class Bar
{
public function test() {
$this->testPrivate();
$this->testPublic();
}

public function testPublic() {
echo "Bar::testPublic\n";
}

private function testPrivate() {
echo "Bar::testPrivate\n";
}
}

class Foo extends Bar
{
public function testPublic() {
echo "Foo::testPublic\n";
}

private function testPrivate() {
echo "Foo::testPrivate\n";
}
}

$myFoo = new Foo();
$myFoo->test(); // Bar::testPrivate
// Foo::testPublic
?>