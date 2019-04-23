

<html>
<head>
  <title>Submit Document</title>
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
	
	
	
	window.onload=function() {
	   //alert('load');
	   //new net.ContentLoaderObj('http://localhost/e-school/getdatadb.php?function=DOCCATGLIST',getCategoryList,null,'function=DOCCATGLIST');
	}
	
	
	
	
	 
    	 

  </script>
 </head>

<body>

<div id="content">
  <h1>Submit Document</h1>
  <p>Submit Document</p>
  <form action="submitdoc_res.php" enctype="multipart/form-data" method="POST" >
   
   
   
  <p>Category</p>
  <p><select id='catg' name='catg'></select></p>
  <p>Title</p>  
  <input type="text" name="title" id='title' >
  <input type="hidden" name="MAX_FILE_SIZE" value="51200">
  
  
  <p><strong>File to Upload:</strong> <input type="file" name="fileupload"></p>

  <p><input type="submit" value="upload!"></p>

 


  
  
  
  
  
  <span id=feeresult></span>
  
  
  
  
  
  
   </form>
   
   
  
 <!-- <blockquote>I should like to record my own love and my children's love of E. A.
 Wyke-Smith's "The Marvellous Land of Snergs," at any rate to the Snerg element in that
 tale, and of Gorbo, the gem of dunderheads, jewel of a companion in an escapade&#8230;(The
 story) was probably an unconscious source-book for the Hobbits&#8230;<p>J.R.R. Tolkien</p></blockquote>        -->
  
  <?php include "../footer.php"; ?> 
  
</div>


</body>


</html>