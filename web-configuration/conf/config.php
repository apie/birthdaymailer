<?php


class MyDB extends SQLite3 {
  function __construct() {
     $this->open('birthday.db');
  }
}

$db = new MyDB();
if(!$db) {
  die($db->lastErrorMsg());
}

?>
