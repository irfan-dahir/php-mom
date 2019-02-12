<?php


require_once __DIR__ . '/vendor/autoload.php';


$foo = new class {
    public $yeet;
    private $beet;
};

$schema = new MOM\Schema();
$schema->abc = "xyz";

var_dump($schema);

$schema->add($foo);

var_dump($schema);
