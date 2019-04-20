<!-- php include "../header.php"; ?>  
php include "../newslinks.php"; ?> -->

<html>
<head>
  <title>Client Vote Page</title>
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
	 function SubmitResult() {
	     alert(this.req.responseText.replace('3h','h3'));
	     //var oobj = eval ("("+this.req.responseText.replace('3h','h3')+")");
		 //alert(oobj.result[0]);
		 //document.getElementById("newidspan").innerHTML = oobj.result[0];
	 }		
	window.onload=function() {
	
	   new net.ContentLoaderObj('http://localhost/e-voting/getdatadb.php?function=GETLIST',updateSpanVoteList,null,'location=0&function=GETLIST');
	}
	
	function updateSpanVoteList() {
	  var oobj = eval ("("+this.req.responseText.replace('3h','h3')+")");
	  //alert(oobj.result.length);
	  var listobj = oobj.result;
	  $i=0;
	  var subjlist = listobj[$i].r0;
	  //document.getElementById("votelist").innerHTML = subjlist;
	  //for ($i = 0; $i < listobj.length; $i++) {
	  //   document.getElementById("votelist").innerHTML += "<option value='"+listobj[$i].r0+"' ><label>"+listobj[$i].r0+"</label></option>";
	  //}
	  $tdir=listobj[0].r2;
	  document.getElementById("imglist").innerHTML += $tdir;	
	  for ($i = 0; $i < listobj.length; $i++) {
	     if ($tdir!=listobj[$i].r2) {
		   $tdir=listobj[$i].r2;
		   document.getElementById("imglist").innerHTML += "<br/><br/><br/><br/><br/>";
		   document.getElementById("imglist").innerHTML += $tdir;	
		 }
	     //document.getElementById("imglist").innerHTML += "<p><img src='http://localhost/e-voting/candidates/"+listobj[$i].r2+"/"+listobj[$i].r1+".png' alt='School Logo' width='100' onclick=\"alert('aaa')\" /></p>";
		 //document.getElementById("imglist").innerHTML += "<p><img src='http://localhost/e-voting/candidates/"+listobj[$i].r2+"/"+listobj[$i].r1+".png' alt='School Logo' width='100' onclick=\"new net.ContentLoaderObj(\"http://localhost/e-voting/submitdata.php?function=SUBMITVOTE\",NewIdResult,null,\"function=SUBMITVOTE&param1="+listobj[$i].r2+"&param2="+listobj[$i].r0+"\"); return false\" /></p>";
		 document.getElementById("imglist").innerHTML += "<p><img src='http://localhost/e-voting/candidates/"+listobj[$i].r2+"/"+listobj[$i].r1+".png' alt='School Logo' width='100' onclick=\"new net.ContentLoaderObj('http://localhost/e-voting/submitdata.php?function=SUBMITVOTE',SubmitResult,null,'function=SUBMITVOTE&param1="+listobj[$i].r2+"&param2="+listobj[$i].r0+"');return false;\" /></p>";
	  }
	  
	  //alert(document.getElementById("imglist"));
	  
	}
  </script>
 </head>

<body>

<div id="content">
  <h1>Vote Entry</h1>
  <form action="votesubm.php" method="POST">
  <p>Id (optional)</p> 
  <p><input type='text' name='clientvote_id' /></p>
  
  <!-- <input type="checkbox" name="favcolors[]" value="Red|sfds|sdfs"/>Red|sfds|sdfs</input> -->
  

  <!--<p><select id='votelist' name="votelist[]" multiple><option value='aaa' >aaa</option><option value='aab' >aab</option></select></p> -->
  <div id="imglist">
  
  </div>
  
  

  
  
  
  <!--<p><input type='Submit' value='Send' onclick=" new net.ContentLoaderObj('http://localhost/e-schools/submitdata.php?function=SCHOOLREG',NewIdResult,null,'function=SCHOOLREG&param1='+this.form.schoolreg_name.value +'&param2='+this.form.prostu.value); return false alert(this.form.prostu.options[1].selected);alert(this.form.prostu.options[this.form.prostu.selectedIndex].value) "/></p> -->
  </br>
  </br>
  </br>
  </br>
  </br>
  
  
  
  <!-- <p><input type='Submit' value='Send' onclick="
    var strProstu='';
	alert(this.form.votelist.options.length);
    for (var i=0;i<this.form.votelist.options.length;i++) {
	  if (this.form.votelist.options[i].selected)
        strProstu += this.form.votelist.options[i].value + '|'; 	  
	}
	new net.ContentLoaderObj('http://localhost/e-voting/submitdata.php?function=SUBMITVOTE',NewIdResult,null,'function=SUBMITVOTE&param1='+this.form.clientvote_id.value +'&param2='+strProstu); return false
	
	   "/></p> -->

   </form>
   <span id=newidspan></span>
   
  
 <!-- <blockquote>I should like to record my own love and my children's love of E. A.
 Wyke-Smith's "The Marvellous Land of Snergs," at any rate to the Snerg element in that
 tale, and of Gorbo, the gem of dunderheads, jewel of a companion in an escapade&#8230;(The
 story) was probably an unconscious source-book for the Hobbits&#8230;<p>J.R.R. Tolkien</p></blockquote>        -->
  
  <!-- php include "../footer.php"; ?>  -->
  
</div>


</body>


</html>
