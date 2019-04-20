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
/*
if (isset($_POST["school"])) {
  $school = htmlspecialchars($_POST["school"]);
} else {
  $school = '';
}
*/
$school = $_SESSION['schoolid'];
// 
if (isset($_POST["dataname"])) {
  $dataname = htmlspecialchars($_POST["dataname"]);
} else {
  $dataname = '';
}
$datanames  = explode(',', $dataname);


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
if ($function=='SUBMITVOTE') {
 $sess = session_id();
 echo $param1;
 $sql = "INSERT INTO VOTERES (dirname,selection) values ('".$param1."','".$param2."')";
 $result = $conn->query($sql);
 //echo $sess;
 //return;
 //$_SESSION['schoolid'] = $sess;
 //$aschools = explode('|',$param2);
 //$sid = getValueSql($conn,"SELECT ID FROM SCHOOLS WHERE NAME='".$aschools[0]."'");
 //if ($sid=='') 
 // echo "{\"result\":[\"done, schoolid = ".$_SESSION['schoolid']."\"]}";
 //else {
  //$_SESSION['schoolid'] = $sid;
 // $sql = "DELETE FROM SESS WHERE SES='".$sess."'";
 // $result = $conn->query($sql);
 // $sql = "INSERT INTO SESS(SES,SCHOOLID,TIMES) VALUES ('".$sess."','".$sid."',CURRENT_TIMESTAMP)";	
 // $result = $conn->query($sql);
 // $schoolid = getValueSql($conn,"SELECT SCHOOLID FROM SESS WHERE SES='".$sess."'");
  echo "{\"result\":[\"".$param2.",".$sess." param = ".$param1."\"]}";
  
}
else if ($function=='STUDENTREG')
{
    $sess = session_id();
	$school = getValueSql($conn,"SELECT SCHOOLID FROM SESS WHERE SES='".$sess."'");
	$sql = "INSERT INTO STUDENTS(SCHOOLID,ID,ADDRESS,NAME) VALUES (".$school.",(SELECT MAX(ID)+1 FROM STUDENTS aa),'".$param1."','".$param2."')";	
    $result = $conn->query($sql);
	
	$result = $conn->query("commit");
	$result = $conn->query("select max(id) from students where SCHOOLID=".$school." AND name='".$param2."'");
	$newid='';
	if ($result->num_rows > 0) {
	  while($row = $result->fetch_row()) {
	     $newid=$row[0];
	  }
	}
	//echo "{\"result\":[\"done student id ".$_SESSION['schoolid']."#".$newid."\"]}";
	echo "{\"result\":[\"done student id ".$newid."\"]}";
}
if ($function=='STUDENTABSENT') {
    if ($param2=='IN') {
       $sql = "INSERT INTO ABSENTS (SCHOOLID,STUDENTID,TIME_IN,ABSENT,SYLABUSID) VALUES (".$school.",".$param1.",current_timestamp,0,".$param3.")";	
	   $result = $conn->query($sql);	
	   $result = $conn->query("commit");
	   //echo "{\"result\":[\"done\"]}";
	   echo "{\"result\":[\"done ".getValueSql($conn,"SELECT 1 FROM STUDENTS WHERE ID=".$param1)."\"]}";
	  } else if ($param2=='OUT') {
	   if (getValueSql($conn,"SELECT 1 FROM ABSENTS WHERE SCHOOLID=".$school." AND STUDENTID=".$param1. " AND date_format(current_timestamp, '%Y%d%c')= date_format(absdate, '%Y%d%c')")=='1') {
         $sql = "UPDATE ABSENTS SET TIME_OUT=current_timestamp where SCHOOLID=".$school." AND STUDENTID=".$param1;	
	     $result = $conn->query($sql);
	     $result = $conn->query("commit");
	     echo "{\"result\":[\"done ".getValueSql($conn,"SELECT CURRENT_TIMESTAMP")."\"]}";
	   } else {
	     echo "{\"result\":[\"error\"]}";
	    }
	  }
    //$result = $conn->query($sql);
} 
if ($function=='BOOKREG') {
	$sql = "INSERT INTO LBOOKS (SCHOOLID,ISBN,REGDATE,TITLE,AUTHOR,CATEGORY) VALUES (".$school.",".$param1.",current_timestamp,'".$param2."','".$param3."','".$param4."')";
    $result = $conn->query($sql);	
	$result = $conn->query("commit");	
	echo "{\"result\":[\"book registered id ".getValueSql($conn,"SELECT MAX(BOOKID) FROM LBOOKS WHERE SCHOOLID=".$school." AND TITLE='".$param2."'")."\"]}";
}
if ($function=='BOOKBORROW') {
	$sql = "INSERT INTO LBORROW (SCHOOLID,BOOKID,DTBORROW,BORROWID) VALUES (".$school.",".$param1.",current_timestamp,'".$param2."')";
    $result = $conn->query($sql);	
	$result = $conn->query("commit");	
	echo "{\"result\":[\"successful \"]}";
}
if ($function=='SYLABUSREG') {
    
	$sql = "INSERT INTO SYLABUS (SCHOOLID,NAME,TEACHER,DSC,CREATEBY,PROSTUID) VALUES (".$school.",'".$param2."','".$param3."','".$param4."','".$param5."',".$param1.")";
    $result = $conn->query($sql);	
	$result = $conn->query("commit");	
	//echo "{\"result\":[\"successful \"]}";
	echo "{\"result\":[\"done, sylabus registration id = ".getValueSql($conn,"SELECT MAX(ID) FROM SYLABUS WHERE SCHOOLID=".$school." AND NAME='".$param2."' AND TEACHER='".$param3."'")."\"]}";
}
if ($function=='PAYFEE') {
    $sql = "INSERT INTO PAYS (SCHOOLID,STUDENTID,DATE,BILL,RECIVE,DSCR) VALUES (".$school.",'".$param1."',current_timestamp,'','".$param3."','".$param2."')";
    $result = $conn->query($sql);	
	$result = $conn->query("commit");	
	//echo "{\"result\":[\"successful \"]}";
	echo "{\"result\":[\"done, pay seq = ".getValueSql($conn,"SELECT MAX(TRACENO) FROM PAYS WHERE SCHOOLID=".$school." AND STUDENTID='".$param1."'")."\"]}";
}

if ($function=='STOREDOC') {
    $sql = "INSERT INTO DOCRECORD (SCHOOLID,DOCCATG,DOCNAME,LOCATION) VALUES (".$school.",'".$param1."','".$param2."','".$param3."')";
    $result = $conn->query($sql);	
	$result = $conn->query("commit");	
	//echo "{\"result\":[\"successful \"]}";
	echo "{\"result\":[\"done, doc seq = ".getValueSql($conn,"SELECT MAX(DOCID) FROM DOCRECORD WHERE SCHOOLID=".$school."")."\"]}";
}

if ($function=='SCHOOLREG') {
    $maxid = getValueSql($conn,"SELECT MAX(ID)+1 FROM SCHOOLS" );
	if ($maxid=='') {
	  $school='1';
      $sql = "INSERT INTO SCHOOLS (ID,NAME,ADDRESS) VALUES (".$school.",'".$param1."','".$param2."')";
	} else
      $sql = "INSERT INTO SCHOOLS (ID,NAME,ADDRESS) VALUES (".$school.",'".$param1."','".$param2."')";	
    $result = $conn->query($sql);	
	$result = $conn->query("commit");	
    echo "{\"result\":[\"done, doc seq = ".$maxid."\"]}";
}


$conn->close();
?>

