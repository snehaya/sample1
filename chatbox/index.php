<?php
	//connection
	$conn = mysqli_connect('localhost', 'root', '', 'chatbox');
	$_SESSION['conn'] = $conn;
	
	if(!$conn){
		mysqli_connect_error();
	}
	
	$id = 'abc';
	function secure($conn, $data){
		$data = htmlspecialchars($data);
		$data = stripslashes($data);
		$data = mysqli_real_escape_string($conn, $data);
		return $data;
	}
	
	/*if(isset($_POST['msg'])){
		$msg = filter_var($_POST['msg'], FILTER_SANITIZE_STRING);
		$msg = secure($conn, $msg);
		
		$sql = sprintf("INSERT INTO `chat`(`from_id`,`message`) VALUES ('%s','%s')",$id, $msg);
		$sql = mysqli_query($conn, $sql);
		if($sql){
			echo 'done';
		}else{
			echo 'not done';
		}
	}*/
?>
<!DOCTYPE HTML>
<html>
	<head>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
		
	</head>
	<body class="container">
		<div class="h-100">
			<div class="position-relative overflow-y-auto" id="txt">
				
						
			</div>
			<div class="bg-dark w-75 position-absolute p-3 bottom-0">
				<form method="POST">
					<input type="text" placeholder="type here" id="msg" name="msg">
					<button type="button" onclick="sendMsg()">
						send message
					</button>
				</form>
			</div>
		</div>
		
		<script>
			function sendMsg() {
				var msg = document.getElementById("msg").value;
				var xmlhttp = new XMLHttpRequest();
					xmlhttp.onload = function() {
						var msg = document.getElementById("msg").value
						data = this.responseText;
						console.log(data);
						if(data){
							showMsg();
						}
					};
				xmlhttp.open("GET", "sendmsg.php?msg=" + msg, true);
				xmlhttp.send();
			}
			function showMsg() {
				 var id = "<?php echo $id ?>";
				var msg = document.getElementById("msg").value;
				var xmlhttp = new XMLHttpRequest();
					xmlhttp.onload = function() {
						//document.getElementById("txt").innerHTML = this.responseText;
						datas = this.responseText;
						console.log(datas);
						setTimeout(() => {
						 let divm = document.createElement('div');
								divm.id = 'content';
								divm.innerHTML = '<p class="float-end container p-1 m-3 bg-dark text-white w-50">${datas}</p>';
								document.body.appendChild(divm);
						}, "2000");
						if(datas == 'hello'){
							setTimeout(() => {
							 let div = document.createElement('div');
								div.id = 'content';
								div.innerHTML = '<p class="float-start container p-1 m-3 bg-dark text-white w-50">flag</p>';
								document.body.appendChild(div);
							}, "4000");
						}else{
							setTimeout(() => {
							 let div = document.createElement('div');
								div.id = 'content';
								div.innerHTML = '<p class="float-start bg-dark p-1	m-3 container text-white w-50">not found</p>';
								document.body.appendChild(div);
							}, "4000");
						}
						
					};
				xmlhttp.open("GET", "sendmsg.php?from_id=" + id, true);
				xmlhttp.send();
			}
			
			//setInterval(showMsg, 2000);
			
			
		</script>
	</body>
</html>