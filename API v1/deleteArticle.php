<?php 
header('Refresh:0;url=listArticle.php');

//Include Database
require_once('./database/db-config.php');

$id = $_GET['id'];

//Delete Article 
$sql ="delete from articles where id=$id ";
   $ret = $db->exec($sql);
   if(!$ret) {
      $errorMessage = $db->lastErrorMsg();
   } else {
      $deleteSuccess = "Article record deleted successfully!\n";
   }
?>   

   


