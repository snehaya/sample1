<?php
	//connection
	require("function.php");
	//to store ip address
	$id = $_SERVER['REMOTE_ADDR'];
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css" integrity="sha512-MqL4+Io386IOPMKKyplKII0pVW5e+kb+PI/I3N87G3fHIfrgNNsRpzIXEi+0MQC0sR9xZNqZqCYVcC61fL5+Vg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
			body{
				 background-image: url('chat.jpg');
				background-repeat:no-repeat;
				background-size:cover;
			}
			.chatbox {
			  width: 50%;
			  margin:auto;
			  height: 605px;
			  border: 1px solid #ccc;
			  display: flex;
			  flex-direction: column;
			 
			}

			#txt {
			  flex-grow: 1;
			  overflow-y: auto;
			}

			#msg {
			  margin-bottom: 10px;
			}

			.message {
			  margin: 10px 0;
			}

			.message.outgoing {
			  float:right;
			  width:75%;
			}

			.message.incoming {
				float:left;
			  width:75%;
			}

			.message p {
			  margin: 5px;
			  padding: 10px;
			  border-radius: 10px;
			}

			.message.outgoing p {
			  background-color: black;
			   float:right;
			   width:75%;
			   color:white;
			}
			
			.message.flag p {
			  background-color: black;
			  color:white;
			   float:left;
			   width:90%;
			}

			.message.incoming p {
			  background-color: #f8f8f8;
			   float:left;
			   width:100%;
			}
			#message-container {
			  position: absolute;
			  height: 100%;
			  width:100%;
			  background-color:rgba(0, 0, 0, 0.5);
			  overflow: hidden;
			  left:0%;
			}

			#message-dots {
			  position: absolute;
			  top: 50%;
			  width: 2%;
			  left:50%;
			  height: 2px;
			  background-image: linear-gradient(to right, white 25%, transparent 25%, transparent 75%, white 75%, white),
								 linear-gradient(to right, white 25%, transparent 25%, transparent 75%, white 75%, white);
			
			  animation: sending-animation 2s ease-in-out infinite;
			}
			 #message-dots.sending {
					animation: sending-animation 2s ease-in-out infinite;
				}

				@keyframes sending-animation {
					0% {
						background-position: 0 100%;
					}

					100% {
						background-position: 200px 100%; /* Adjust distance as needed */
					}
				}


			#message {
			  position: absolute;
			  bottom: 0;
			  left: 0;
			  padding: 5px;
			  height: 20px;
			  line-height: 20px;
			  text-align: center;
			}
			@media only screen and (max-width:800px){
				.chatbox {
					width: 90%;
					 height:700px;
				}
				.message.outgoing p {
					width:100%;
					font-size:9px;
				}
				
				.message.incoming p {
					width:100%;
					font-size:9px;
				}
			}
		</style>
	</head>
	<body class="container">
		<!-- loading animation -->
		<div id="message-container" style="display:none;">
			<div id="message-dots"></div>
		</div>
		<!-- chatbox div -->
		<div id="chatbox" class="shadow chatbox"> 
			<div id="txt">
				
			</div>
			<div class="d-flex m-2" style="height:40px;">
				<!-- input and send msg button -->
				<input type="text" placeholder="type here" id="msg" name="msg" class="form-control me-2 h-100">
				<button type="button" onclick="sendMsg()" id="btn" class="btn btn-light">
				  <i class="ri-send-plane-2-fill text-dark"></i>
				</button>
			</div>
		</div>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		
		<script>
		//function to send message
			function sendMsg() {
				var msg = document.getElementById("msg").value;
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onload = function() {
					var msg = document.getElementById("msg").value;
					if(msg.length != 0){
						data = this.responseText;
						//function call
						showMsg();
						showMsgchat();
					}else{
						alert("kindly enter some text...!!!");
					}
				};
				xmlhttp.open("GET", "sendmsg.php?msg=" + msg, true);
				xmlhttp.send();
			}
			//to show my chats
			function showMsg() {
				var id = "<?php echo $id ?>";
				var msg = document.getElementById("msg").value;
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onload = function() {
					datas = this.responseText;
					
					let message = document.createElement('div');
					message.classList.add('message');
					
					message.classList.add('outgoing');
					
					
					let p = document.createElement('p');
					p.textContent = datas;
					message.appendChild(p);
					document.getElementById("txt").appendChild(message);
					document.getElementById("txt").scrollTop = document.getElementById("txt").scrollHeight;
				};
				xmlhttp.open("GET", "sendmsg.php?from_id=" + id, true);
				xmlhttp.send();
			}
			
			//to show reply
			function showMsgchat() {
				var id = "<?php echo $id ?>";
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onload = function() {
					datas = this.responseText;
					
					if(datas){
						
						setTimeout(() => {
							let message = document.createElement('div');
							message.classList.add('message');
							
							message.classList.add('incoming');
							
							
							let p = document.createElement('p');
							p.textContent = datas;
							message.appendChild(p);
							document.getElementById("txt").appendChild(message);
							document.getElementById("txt").scrollTop = document.getElementById("txt").scrollHeight;
						}, 2000);
						setTimeout(function() {
				document.getElementById("message-container").style.display = "none";
				}, 1000);
					
					}
				};
				xmlhttp.open("GET", "sendmsg.php?to_id=" + id, true);
				xmlhttp.send();
			}
			
			//loading animation
			function startSendingAnimation() {
				$('#message-dots').addClass('sending');
				setTimeout(function () {
					$('#message-dots').removeClass('sending');
				}, 2000); // Change duration to match your animation duration
			}

			  // re-trigger the animation when the message is clicked
			  $('#btn').on('click', function() {
					startSendingAnimation();
					
					document.getElementById("message-container").style.display = "block";
					document.getElementById("msg").value = " ";
					
			  });
			  
			   // re-trigger the animation when the message is clicked
			$('#btn').on('keypress', function(event) {
				if (event.which === 13) { // 13 is the enter key code
					startSendingAnimation();
					document.getElementById("message-container").style.display = "block";
					document.getElementById("msg").value = " ";
				}
			});
			  
			  
		

//setInterval(showMsg, 2000);

	showMsg();
	showMsgchat();
	
		</script>
	</body>
</html>