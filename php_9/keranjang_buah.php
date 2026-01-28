<?php
  // tangkap request class_fruit
  require_once 'class_fruit.php';

  // create instan objek fruit : $apple and $banana
  $apple = new fruit();
  $banana = new fruit();

  // call member class
  $apple->set_name('apple');
  $apple->set_color('red');
  $banana->set_name('banana');
  $banana->set_color('yellow');

echo 'Nama Buah '.$apple->get_name().' Warnanya '.$apple->get_color();
echo '<br/>Nama Buah '.$banana->get_name().' Warnanya '.$banana->get_color();
?>