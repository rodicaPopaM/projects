<?php
    require_once('./database/db-config.php');
    require_once('navbar.php');

    $result = "";

    if( !empty($_POST)) {
        //fetch table rows from mysql db
        $sql ="Select * from articles";
        $ret = $db->query($sql);

        //create an array
        $emparray = array();
        
        while($row = $ret->fetchArray(SQLITE3_ASSOC))
        {
            $emparray[] = $row;
        }

        $result = json_encode($emparray);
    }


?>

<div class="container">
	<h3 class="page-title"> Export articles</h3>
        <div>
            <p>Return in JSON format articles from database:</p>
            <form method="POST" action="export.php">
                <input type="submit" class="btn btn-success" value="Generate JSON file" name="submit">
            </form>
            <br><br>
            <span style="color: #00ff08; font-weight: bold;"><?php echo $result; ?></span>
        </div>
</div> 