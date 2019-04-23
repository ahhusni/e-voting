<!-- php include "../header.php"; ?>  
php include "../newslinks.php"; ?> -->

<html>
<head>
  <title>Vote Import</title>
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
	
	   new net.ContentLoaderObj('http://localhost/e-voting/getdatadb.php?function=GETVOTEIMPORT',updateSpanVoteResult,null,'location=0&function=GETVOTEIMPORT');
	}
	
	function updateSpanVoteResult() {
	  //var oobj = eval ("("+this.req.responseText.replace('3h','h3')+")");
	  //alert(oobj.result.length);
	  //var oobj = eval ("("+this.req.responseText+")");
	  document.getElementById("vres").innerHTML=this.req.responseText;
	  //return;
	  //alert(this.req.responseText);
	  //var listobj = oobj.result;
	  //$i=0;
	  //var subjlist = listobj[$i].r0;
	  //document.getElementById("votelist").innerHTML = subjlist;
	  //for ($i = 0; $i < listobj.length; $i++) {
	  //   document.getElementById("votelist").innerHTML += "<option value='"+listobj[$i].r0+"' ><label>"+listobj[$i].r0+"</label></option>";
	  //}
	  //$tdir=listobj[0].r2;
	  //document.getElementById("vres").innerHTML = "";
	  /*for ($i = 0; $i < listobj.length; $i++) {
	      document.getElementById("vres").innerHTML += listobj[$i].r0;
		  document.getElementById("vres").innerHTML += " selection "+listobj[$i].r1;
		  document.getElementById("vres").innerHTML += " total "+listobj[$i].r2 +" voters";
		  document.getElementById("vres").innerHTML += "<br/>";
		  
	     
	  }*/
	  
	  //alert(document.getElementById("imglist"));
	  
	}
  </script>
 </head>

<body>

<div id="content">
  <h1>Vote Result</h1>
  <div id="vres">
  </div>
  
  
  

  
  
  
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