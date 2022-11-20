<?php
   require_once('./database/db-config.php');
   require_once('navbar.php');
?>
<div class="container">
	<h3 class="page-title">List articles
      <a href="addArticle.php" class="btn btn-success float-right">
      	Add articles
      </a>
	</h3>

  <!-- Table --->
   <table class="table table-bordered table-striped">
   	<tr>
   		<th>ID</th>
   		<th>Name</th>
   		<th>Writer</th>
   		<th>Date</th>
		<th>Content</th>
		<th>Category</th>

   	</tr>
<?php

$sql ="Select * from articles";

   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC)) 
   {
      ?>
        <tr>
	   		<td><?=$row['id'];?></td>
	   		<td><?=$row['name'];?></td>
	   		<td><?=$row['writer'];?></td>
			<td><?=$row['date'];?></td>
			<td><?=$row['content'];?></td>
			<td><?=$row['category_id'];?></td>
			<td>
	   			<a href="deleteArticle.php?id=<?=$row['id'];?>" class="btn btn-danger">
	   				Delete
	   			</a>
	   		</td>
	   	</tr>
      <?php
   }
?>
   </table>
</div>	
</body>
</html>