<?php
    //Include Database
    require_once('./database/db-config.php');
    require_once('navbar.php');

    $nameErr = $writerErr = $contentErr = $categoryErr = $successMessage = "";
    $name = $writer = $content = "";
    $category = array();
    $categoryOpt = array();
    $errorCase = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
            $errorCase = true;
        } else {
            $name = test_input($_POST["name"]);
        }
        
        if (empty($_POST["writer"])) {
            $writerErr = "Writer is required";
            $errorCase = true;
        } else {
            $writer = test_input($_POST["writer"]);
        }

        if (empty($_POST["content"])) {
            $contentErr = "Content is required";
            $errorCase = true;
        } else {
            $content = test_input($_POST["content"]);
        }

        if (empty($_POST["category"])) {
            $categoryErr = "Category is required";
            $errorCase = true;
        } else {
            $categoryArray = $_POST["category"];
            $num = count($categoryArray);

            for($i=0; $i < $num; $i++) {
                $category[$i] = $categoryArray[$i];
            }
        }

        //need to improve to store all the values 
        if(isset($category)) {
            if(in_array('World', $category)) {
                $categoryOpt = 1;
            } elseif (in_array('Astronomy/Astrology', $category)) {
                $categoryOpt = 2;
            } else {
                $categoryOpt = 3;
            }
            
        }  
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if($errorCase === false && !empty($name) && !empty($writer)&& !empty($content)) {
        $sql ="insert into articles(name,writer,content,category_id)
        values(\"$name\",\"$writer\",\"$content\",$categoryOpt)";


    $ret = $db->exec($sql);
    if(!$ret) {
        $successMessage = $db->lastErrorMsg();
        } else {
            $name = $writer = $content = "";
            $successMessage = "Article record created successfully! \n";
        }
    }
?>

<div class="container">
    <br><br>
	<h3 class="page-title"> Add article &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
       <a href="listArticle.php" class="btn btn-success">
      	  List articles
       </a>
    </h3>
    <br>
    <div>
        <span style="color: #00ff08; font-weight: bold;"><?php echo $successMessage;?></span>
        <br><br>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table>
            <tr>
                <td>
                    Name:
                    <span class="error">*</span>
                </td>
                <td>            
                    <input type="text" name="name" size="50" value="<?php echo $name;?>">
                </td>
                <td>            
                    <span class="error">* <?php echo $nameErr;?></span>
                </td>
            </tr>
            <tr>
                <td>
                    Writer:
                    <span class="error">*</span>
                </td>
                <td>
                    <input type="text" name="writer" size="50" value="<?php echo $writer;?>">
                </td>
                <td>
                    <span class="error">* <?php echo $writerErr;?></span>
                </td>
            </tr>
            <tr>
                <td>
                    Content:
                    <span class="error">*</span>
                </td>
                <td>
                    <textarea name="content" rows="8" cols="50" placeholder="Insert text here..."><?php echo $content;?></textarea>
                </td>
                <td>
                    <span class="error">* <?php echo $contentErr;?></span>
                </td>
            </tr>
            <tr>
                <td>
                    Date:
                </td>
                <td>
                <input type="date" name="date" value="2022-11-21" min="2021-01-01" max="2024-12-31">
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    Category:
                    <span class="error">*</span>
                </td>
                <td>
                    <input type="checkbox" name="category[]" id="1" value="World">
                    <label for="world">World</label>
                    <input type="checkbox" name="category[]" id="2" value="Astronomy/Astrology">
                    <label for="astronomy">Astronomy/Astrology</label>
                    <input type="checkbox" name="category[]" id="3" value="Weather">
                    <label for="weather">Weather</label>
                </td>
                <td>
                    <span class="error"><?php echo '* '.$categoryErr;?></span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <span class="error">*</span> required field
                    <br><br>
                    <button type="submit" name="submit" value="submit" class="btn btn-success">Add Article</button>
                </td> 
                <td>
                </td>   
            <tr>    
            </table>
            
        </form>
    </div>
</div>    
