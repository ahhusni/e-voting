
<html>
<head>
  <title>Upload Document</title>
  <meta http-equiv="Content-type" content="text/html;
 charset=iso-8859-1" />
  <meta http-equiv="Content-Language" content="en-us" />
  <link href="../styles1.css" rel="stylesheet" type="text/css" />
  <script language="JavaScript" type="text/javascript" src="../net.js" />
  <script type='text/javascript'>
    
  </script>

  <script type='text/javascript'>
     function MessageBoxResult() {
            var oobj = eval ("("+this.req.responseText.replace('3h','h3')+")");
			alert(oobj.result[0]);
			}
	 

	 
	 window.onload=function() {
	   //alert('load');
	   
	}
	
	
	
	
	 
    	 

  </script>
 </head>

<body>

<div id="content">
  <h1>Submit Vote result</h1>
  <p>Submit Vote result</p>
 
 <?php

 $file_dir = "path/upload_directory";

if (isset($_POST["title"])) {
  $title = htmlspecialchars($_POST["title"]);
} else {
  $title = '';
}

if (isset($_POST["catg"])) {
  $catg = htmlspecialchars($_POST["catg"]);
} else {
  $catg = '';
}

//echo "#catg#".$catg;
//echo "#title#".$title;


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "evoting";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


 foreach($_FILES as $file_name => $file_array) {

     echo "path: ".$file_array['tmp_name']."<br>\n";

     echo "name: ".$file_array['name']."<br>\n";

     echo "type: ".$file_array['type']."<br>\n";

     echo "size: ".$file_array['size']."<br>\n";
	 $filename=$file_array['tmp_name'];
	 
	 $fp = fopen($filename, "r") or die("Couldn't open $filename");

 while (!feof($fp)) {

     $line = fgets($fp, 1024);
	 $text_array = explode(";",$line);
	 if ($text_array[0]!='' && $text_array[1] !='' && $text_array[2]!='') {
	 $sql = "INSERT INTO VOTERES (vid,dirname,selection) values ('".$text_array[0]."','".$text_array[1]."','".$text_array[2]."')";
     $result = $conn->query($sql);
	 }

     echo "$line<br>";

 }





     if (is_uploaded_file($file_array['tmp_name'])) {

         move_uploaded_file($file_array['tmp_name'],

            "$file_dir/$file_array[name]") or die ("Couldn't copy");

         echo "file was moved!<br><br>";
		 //echo "<script type='text/javascript'>";
		 //echo "new net.ContentLoaderObj('http://localhost/e-school/submitdata.php?function=STOREDOC',MessageBoxResult,null,'function=STOREDOC&param1=".$catg."&param3=".$file_dir."/".$file_array[name]."&param2=".$title."' )";
		 //echo "alert('aaaaaa')";
		 echo "</script>";
		 

    }

 }

 ?>

   
   
  
 
  
</div>


</body>


</html>