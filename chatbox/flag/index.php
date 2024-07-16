<?php
	//connection
	require("../function.php");
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		
	</head>
	<body class="container">

		
		<script>
			
			
			

		function showprompt(){
			const name = prompt("Enter your Secrete Key");
			/*BugBase*/
			var xmlhttp = new XMLHttpRequest();
				xmlhttp.onload = function() {
					datas = this.responseText;
					alert(datas);	
				};
				xmlhttp.open("GET", "../flag.php?nickname=" + name, true);
				xmlhttp.send();
		}
		//prompt call
		showprompt();
			
			
		</script>
	</body>
</html>