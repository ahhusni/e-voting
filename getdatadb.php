<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "evoting";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if (isset($_GET["q"])) {
  $city = htmlspecialchars($_GET["q"]);
} else {
  $city = '';
}
if (isset($_POST["function"])) {
  $function = htmlspecialchars($_POST["function"]);
} else {
  $function = '';
}
/**/
$id = $_SESSION['id'];

// PROSTUDYLIST
/*if (isset($_POST["id"])) {
  $school = htmlspecialchars($_POST["school"]);
} else {
  $school = '';
}*/

// 
if (isset($_POST["dataname"])) {
  $dataname = htmlspecialchars($_POST["dataname"]);
} else {
  $dataname = '';
}
$datanames  = explode(',', $dataname);

function getValueSql($conn,$s) {
  $result = $conn->query($s);
  $ret='';
  if ($result->num_rows > 0) {
	  while($row = $result->fetch_row()) {
	     $ret= $row[0];
	  }
	}
	return $ret;
}

if (isset($_POST["param1"])) {
  $param1 = htmlspecialchars($_POST["param1"]);
} else {
  $param1 = '';
}
if (isset($_POST["param2"])) {
  $param2 = htmlspecialchars($_POST["param2"]);
} else {
  $param2 = '';
}
if (isset($_POST["param3"])) {
  $param3 = htmlspecialchars($_POST["param3"]);
} else {
  $param3 = '';
}
if (isset($_POST["param4"])) {
  $param4 = htmlspecialchars($_POST["param4"]);
} else {
  $param4 = '';
}
 if ($function=='GETLIST') {
 $sql = "SELECT ID,NAME,DIRECTORY,REG FROM CANDIDATE ORDER BY DIRECTORY";
 //echo "aaaa";
 //return;
 /*$dirname = "candidate/.";
 $dh = opendir($dirname) or die("couldn't open directory");
  
 while (!(($file = readdir($dh)) === false)) {
      if (is_dir("$dirname/$file")) {
             echo "(D) ";
			 $fname=$dirname;
			 $fname+="aa";
			 $dh2 = opendir(fname) or die("couldn't open directory");
			 while (!(($file2 = readdir($dh2)) === false)) {
			 }
       }
       echo "$file<br>";
  }
  closedir($dh);
  return;*/
  
  
 } else if ($function=='GETSESSION') {
  //$sql = "SELECT NAME FROM SCHOOLS ";
  $sesss = $_SESSION['schoolid'];
  echo $sesss;
  return;
 }
 else if ($function=='GETVOTERESULT') {
 
   $sql = "SELECT DIRNAME,SELECTION,COUNT(*) FROM VOTERES GROUP BY DIRNAME,SELECTION";
 } else if ($function=='PAYHISTORY_BYSTUDENTID') {
   $sql = "SELECT DATE,TRACENO,DSCR,BILL,RECIVE FROM PAYS WHERE SCHOOLID=".$school." AND STUDENTID=".$param1." ORDER BY DATE DESC ";
   
   } else if($function=='DOCCATGLIST') {
   $sql = "SELECT DSC,ID FROM DOCCATG WHERE SCHOOLID=".$school." AND enable=1 ORDER BY ID ASC ";
} else if ($function=='FINDDOC') {
   $sql = "SELECT T1.DOCID,T2.DSC,T1.DOCNAME,T1.LOCATION,T1.DATEREG FROM (SELECT DOCID,DOCNAME,LOCATION,DATEREG FROM DOCRECORD WHERE SCHOOLID=".$school.") T1 LEFT OUTER JOIN (SELECT ID,DSC FROM DOCCATG WHERE SCHOOLID=".$school." AND ENABLE=1) T2 ON (T1.DOCCATG=T2.ID) WHERE INSTR(T1.DOCNAME,'".$param1."')>0"; 
} else if ($function=='ROSTER_CLASS_BY_PROSTU') {
  $sql = "SELECT T2.NAME,T2.CLASSID FROM (SELECT DISTINCT(CLASSID) DC FROM ROSTERS WHERE SCHOOLID=".$school." AND PROSTUID=".$param1.") T1 LEFT OUTER JOIN (SELECT CLASSID,NAME FROM CLASSES) T2 ON T1.DC=T2.CLASSID ";
  }
else if ($function=='PROSTUDYLIST') {
 $sess = session_id();
 $school = getValueSql($conn,"SELECT SCHOOLID FROM SESS WHERE SES='".$sess."'");
 //echo $school;
//return; 
	if ($school<>'0') {
	 //echo $school;
	 //return;
	  $sql = "SELECT NAME FROM PROGRAMS WHERE SCHOOLID=".$school;
	}  else {
	  $sql = "SELECT DISTINCT(NAME) FROM PROGRAMS";
	}
} else if ($function=='ROSTERLIST') {
  //echo $param2;
  $sql = "SELECT T1.STARTTIME,T1.ENDTIME,T2.NAME FROM (SELECT SYLABUSID,STARTTIME,ENDTIME,ROSTERNAME,ROOM FROM ROSTERS WHERE SCHOOLID=".$school." AND PROSTUID=".$param1." AND CLASSID='".$param2."') T1 LEFT OUTER JOIN (SELECT NAME,TEACHER,DSC,ID FROM SYLABUS WHERE SCHOOLID=".$school." AND) T2 ON T1.SYLABUSID=T2.ID";
  echo $sql;	
} else if ($function=='STUDENTINFOBYID') {
 $sql = "SELECT ADDRESS,NAME FROM STUDENTS WHERE SCHOOLID=".$school." AND ID=".$param1;
} else if ($function=='SYLABUS') {
 $sql = "SELECT NAME,ID FROM SYLABUS WHERE SCHOOLID=".$school." ";
 } else if ($function=='BOOKCATEGORY') {
   $sql = "SELECT CATEGORY,PREFIX FROM LBOOKCATG WHERE SCHOOLID=".$school." ";
 } else if ($function=='BOOKCHECKBYISBN') {
   $sql = "SELECT 'exist', COUNT(*) A1 FROM LBOOKS WHERE SCHOOLID=".$school." AND ISBN='".$param1."' ";
 } else if ($function=='BOOKSEARCH') {
   $sql = "SELECT BOOKID, ISBN, REGDATE,TITLE,AUTHOR,REMARK,CATEGORY FROM LBOOKS WHERE SCHOOLID=".$school." AND INSTR(ISBN,'".$param1."')>0 AND INSTR(TITLE,'".$param2."')>0 AND INSTR(AUTHOR,'".$param3."')>0 ";
 } else if ($function=='BOOKINFOBYID') {
   $sql = "SELECT ISBN,REGDATE,TITLE,AUTHOR,REMARK,CATEGORY FROM LBOOKS WHERE SCHOOLID=".$school." AND BOOKID='".$param1."' ";
 } else
   $sql = "SELECT CURRENT_TIMESTAMP aa, current_timestamp bb, '' cc";
   
$result = $conn->query($sql);
	
if ($result->num_rows > 0) {
	//
    
	echo "{\"result\":[";
        $is1first = true;
        while($row = $result->fetch_row()) {
		if ($is1first) {
          echo "{";
		  $is1first = false;
		} else {
		  echo ",{";
		}
        $isfirst=true;
		$k=0;
        foreach ($row as $value) {
           if ($isfirst) {
             //echo "\"".$value."\"";
			 echo "\"r".$k."\":\"".$value."\"";
             $isfirst=false;
           }
           else
            echo ",\"r".$k."\":\"".$value."\"";
		   $k++;		
        }
        echo "}";
        


        
        //while($row = $result->fetchRow( )) {
        //        for ($i=0; $i<$row.length; $i++) 
	//	  echo "{id: " . $row[$i]. "<br>";
	}
	echo "]";
        echo "}";
		
	
		
} else {
	echo "EMPTY";
}


//echo "{\"coord\":{\"lon\":95,\"lat\":6},\"weather\":[{\"id\":500,\"main\":\"Rain\",\"description\":\"light rain\",\"icon\":\"10d\"}],\"base\":\"stations\",\"main\"://{\"temp\":601.262,\"pressure\":1021.36,\"humidity\":100,\"temp_min\":301.262,\"temp_max\":301.262,\"sea_level\":1021.62,\"grnd_level\":1021.36},\"wind\":{\"speed//\":5.71,\"deg\":176.507},\"rain\":{\"3h\":0.17},\"clouds\":{\"all\":76},\"dt\":1501994161,\"sys\":{\"message\":0.0165,\"country\":\"ID\",\"sunrise\":1501976112,//\"sunset\":1502020589},\"id\":1214026,\"name\":\"".$city."\",\"cod\":200}";




$conn->close();
?>

