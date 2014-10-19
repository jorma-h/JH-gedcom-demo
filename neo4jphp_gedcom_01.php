<?php

require('vendor/autoload.php');

$sukudb = new Everyman\Neo4j\Client('localhost', 7474);

$person1 = $sukudb->makeNode();
$person1->setProperty('id', '1')
   ->setProperty('name', 'Matti Virtanen')
   ->save();

$name1 = $sukudb->makeNode()
   ->setProperty('surname', 'Virtanen')
   ->setProperty('first_name', 'Matti')
   ->save();

$rel1 = $person1->relateTo($name1, 'HAVE NAME')->save();


$person2 = $sukudb->makeNode();
$person2->setProperty('id', '2')
   ->setProperty('name', 'Maija Nieminen')
   ->save();

$name2 = $sukudb->makeNode()
   ->setProperty('surname', 'Nieminen')
   ->setProperty('first_name', 'Maija')
   ->save();

$rel2 = $person2->relateTo($name2, 'HAVE NAME')->save();

$rel3 = $person1->relateTo($person2, 'MARRIED')->save();

?>
