<?php
   class MyDB extends SQLite3 {
      function __construct() {
         $this->open('./database/article_database.db');
      }
   }
   $db = new MyDB();
   if(!$db) {
      echo $db->lastErrorMsg();
   } 
?>