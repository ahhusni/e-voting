<!-- php include "../header.php"; ?>  
php include "../newslinks.php"; ?> -->

<html>
<head>
  <title>Voter</title>
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
	
	   new net.ContentLoaderObj('http://localhost/e-voting/getdatadb.php?function=GETENTRYV',updateSpanVoterEntry,null,'location=0&function=GETENTRYV');
	}
	
	function UploadPResult() {
	  alert(this.req.responseText);
	}
	
	function SubmitVoteResult() {
	  alert(this.req.responseText);
	}
	
	var varobj='';
	function updateSpanVoterEntry() {
	  var oobj = eval ("("+this.req.responseText.replace('3h','h3')+")");
	  alert(this.req.responseText);
	  listobj = oobj.result;
	  $i=0;
	  var listobj = oobj.result;
	  var subjlist = listobj[$i].r0;
	  //document.getElementById("votelist").innerHTML = subjlist;
	  //for ($i = 0; $i < listobj.length; $i++) {
	  //   document.getElementById("votelist").innerHTML += "<option value='"+listobj[$i].r0+"' ><label>"+listobj[$i].r0+"</label></option>";
	  //}
	  $tdir=listobj[0].r2;
	  document.getElementById("vres").innerHTML = "";
	  for ($i = 0; $i < listobj.length; $i++) {
	      if (listobj[$i].r0=='')
		    continue;
	      document.getElementById("vres").innerHTML += "<p>"+listobj[$i].r0+"</p>";
		  varobj += listobj[$i].r0+";";
	      document.getElementById("vres").innerHTML += "<p><input type='text' name='"+listobj[$i].r0+"' value='' /></p>";
		  //document.getElementById("vres").innerHTML += " : "+listobj[$i].r1;
		  //document.getElementById("vres").innerHTML += " total "+listobj[$i].r2 +" voters";
		  //document.getElementById("vres").innerHTML += "<br/>";
		  
	     
	  }
	  
	  //alert(document.getElementById("imglist"));
	  
	}
  </script>
 </head>

<body>

<div id="content">
  <h1> </h1>
  <form action="submitnewvoter_res.php" enctype="multipart/form-data" method="POST">
  <p>Id</p> 
  <p><input type='text' name='voter_id' /></p>
  
  <p><input type='Button' value='Save' onclick="
    var strId=this.form.voter_id;
	//alert(this.form['voter_id'].value);
	//alert(this.form.voter_id.value);
	var ssubmit='';
	var sss = varobj.split(';');
	$i=0;
	for ($i = 0; $i < sss.length; $i++) {
	  //alert(sss[$i]);
	  if (sss[$i].length==0)
	    continue;
	  ssubmit+=sss[$i]+'=';
	  ssubmit+=this.form[sss[$i]].value;
	  ssubmit+='&';
	  //alert(this.form[sss[$i]].value);
	  //alert(this.form.sss[$i].value);
	  //
	}
	alert(ssubmit);
	
	
	
    
	new net.ContentLoaderObj('http://localhost/e-voting/submitdata.php?function=SUBMITVOTER',SubmitVoteResult,null,'function=SUBMITVOTER&param1='+this.form.voter_id.value +'&'+ssubmit); return false;
	
	   "/></p> 
	   <input type="hidden" name="MAX_FILE_SIZE" value="51200">
  
  
  
  
  
  
  
  <div id="vres">
  </div>
  
  <p><strong>Photo:</strong> <input type="file" name="fileupload"></p>

  <p><input type="submit" value="upload!"></p>
  
  <!-- <p><input type='Button' value='Pho' onclick="
    var strId=this.form.voter_id;
	alert(this.form.voter_id.value);
    
	new net.ContentLoaderObj('http://localhost/e-voting/serverside/submitnewvoter_res.php?function=GETVOTER',UploadPResult,null,'function=GETVOTER&param1='+this.form.voter_id.value +'&param2='); return false;
	
	   "/></p> -->

 


  
  
  
  
  
  <span id=feeresult></span>
  
  
  

  
  
  
  <!--<p><input type='Submit' value='Send' onclick=" new net.ContentLoaderObj('http://localhost/e-schools/submitdata.php?function=SCHOOLREG',NewIdResult,null,'function=SCHOOLREG&param1='+this.form.schoolreg_name.value +'&param2='+this.form.prostu.value); return false alert(this.form.prostu.options[1].selected);alert(this.form.prostu.options[this.form.prostu.selectedIndex].value) "/></p> -->
  </br>
  </br>
  </br>
  </br>
  </br>
  
  
  
  

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