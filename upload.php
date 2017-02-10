<?php

$ser="localhost";
$user="root";
$pass="";
$db="multiupload";  // Change this value to your Database name
$con=new MySQLi($ser,$user,$pass,$db);

if(isset($_POST['submit'])){
    if(count($_FILES['upload']['name']) > 0){
        //Loop through each file
        for($i=0; $i<count($_FILES['upload']['name']); $i++) {
          //Get the temp image path
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

            //Make sure we have a image path
            if($tmpFilePath != ""){
            
                //save the imagename
                $shortname = $_FILES['upload']['name'][$i];

               //save the url and the image
              //  $filePath = "uploaded/" . date('d-m-Y-H-i-s').'-'.$_FILES['upload']['name'][$i];  // Use this line to rename images

$filePath = "uploaded/".$_FILES['upload']['name'][$i];

                //Upload the image into the temp directory
                if(move_uploaded_file($tmpFilePath, $filePath)) {

					//$files[] = $filePath;  //use $filePath for the relative url to the image i.e. /uploaded/image-name.png
                	  $files[] = $shortname;   //use $shortname for imagename i.e. image-name.png

                }
				
		
              }
        }
    }

    //Images uploaded successfully
    echo "<h1>Uploaded Successfully:</h1>";  
	  
    if(is_array($files)){
        echo "<ul>";
		$i=1;
        foreach($files as $file){
            echo "<li>$file</li>";
	
					switch ($i) {
					case 1:
					   $a=$file;
						break;
					case 2:
						$b=$file;
						break;
					case 3:
					   $c=$file;
					   break;
					}
		$i++;
		 }
        echo "</ul>";

		$ins="insert into images(image1,image2,image3) values('$a','$b','$c')"; //Insernt into table "Images" where image1, image2, image3 are column names
		$ex=$con->query($ins);  
		
        }
	
	}
?>

<form method="post" enctype="multipart/form-data" >

    <div>
        <label for='upload'>Add Images:</label>
        <input id='upload' name="upload[]" type="file" multiple="multiple" />
    </div>

    <p><input type="submit" name="submit" value="Submit"></p>

</form>

<!--  Code written by Madhav -->
