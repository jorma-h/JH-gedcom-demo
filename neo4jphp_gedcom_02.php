<?php

  require('vendor/autoload.php');

  $sukudb = new Everyman\Neo4j\Client('localhost', 7474);

  // Read file line by line
  $file_handle = fopen('gedcom_test1.ged', "r");

  echo "File opened";
  $ind = 1;

  while (!feof($file_handle)) {
    $line = fgets($file_handle);
    $a = explode(' ', $line, 3);
    $level = $a[0];
    $key = trim($a[1]);
    $arg = $arg0 = trim($a[2]);

    switch ($key)  {
      case "NAME":
        $person = $sukudb->makeNode();
        $person->setProperty('id', $ind++)
          ->setProperty('name', $arg0)
          ->save();

        $name = $sukudb->makeNode()
          ->setProperty('first_name', $arg0)
          ->save();

        $rel = $person->relateTo($name, 'HAVE NAME')->save();
        break;
      default;
    }
  } //while eof
  fclose($file_handler);
  echo $ind . "persons and their relationship were saved.";

?>
