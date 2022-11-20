<?php
    require_once('./database/db-config.php');
    require_once('navbar.php');

    $csvArray = array();
    $row = 1;
    if (isset($_POST["csv"])) {

        if (($handle = fopen($_POST["csv"], "r")) !== FALSE) {
        
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $num = count($data);
                
                for ($c=0; $c < $num; $c++) {
                    $csvArray[$row-1][$c] = $data[$c];
                }
                $row++;
            }
            fclose($handle);
        }

        $sqlArray = array();
        $numCsv = count($csvArray);

        for($i=0; $i < $numCsv ; $i++) {

            $sqlArray[$i] ='insert into articles(id,name,writer,date,content,category_id) values('.$csvArray[$i][0].',"'.$csvArray[$i][1].'","'.$csvArray[$i][2].'","'.$csvArray[$i][3].'","'.$csvArray[$i][4].'",'.$csvArray[$i][5].')';
        }

        for($i=0; $i < $numCsv ; $i++) {
            $ret = $db->exec($sqlArray[$i]);
            
            if(!$ret) {
                $message = $db->lastErrorMsg();
            } else {
                $message = "Import $numCsv articles successfully!";
            }
        } 
    }
    
?>

<div class="container">
	<h3 class="page-title"> Import articles from CSV file:</h3>
        <div>
            <form method="POST" action="import.php">
                <label for="myfile">Select a CSV file:</label>
                <input type="file" id="csv" name="csv" accept=".csv"><br><br>
                <input type="submit" class="btn btn-success" value="Import CSV file">
                <br><br>
                <span style="color: #00ff08; font-weight: bold;"><?php echo $message; ?></span>  
            </form>
        </div>
</div>    