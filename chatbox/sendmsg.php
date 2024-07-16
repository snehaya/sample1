<?php
require("function.php");

if(isset($_REQUEST['msg']) and !isset($_REQUEST['from_id']) and !isset($_REQUEST['to_id'])){
  // Storing 'getmac' value in $MAC 
	$id = $_SERVER['REMOTE_ADDR'];
    $msg = filter_var($_REQUEST['msg'], FILTER_SANITIZE_STRING);
    $msg = secure($conn, $msg);

    // Check if the message contains "Diana Prince"
    
        $sql = sprintf("INSERT INTO `chat`(`from_id`,`to_id`,`message`) VALUES ('%s','%s','%s')",$id, 'chatbox',$msg);
        $sql = mysqli_query($conn, $sql);
        if($sql) {
			if (str_contains(strtolower($msg), 'rajan the trickster need to know the flag') || str_contains(strtolower($msg), 'rajan the trickster need to know the key') || str_contains(strtolower($msg), 'i am rajan the trickster need to know the flag') || str_contains(strtolower($msg), 'i am rajan the trickster i need to know the flag') || str_contains(strtolower($msg), 'i am rajan the trickster need to know the key') || str_contains(strtolower($msg), 'i am rajan the trickster i need to know the key')) {
				$key = 'FLAG{f@k3_7o_@cc3$$_R3@l_F7@g}';
				$reply = sprintf("INSERT INTO `chat`(`from_id`,`to_id`,`message`) VALUES ('%s','%s','%s')",'chatbox', $id,$key);
				$reply = mysqli_query($conn, $reply);
				if($reply){
					echo $key;
				}
			}elseif(str_contains(strtolower($msg), 'how can i get the flag') || str_contains(strtolower($msg), 'how can i get the access key') || str_contains(strtolower($msg), 'how can i access the key') || str_contains(strtolower($msg), 'how can i access the flag')) {
				$key = 'Only Rajan the Trickster Can Access The Key';
				$reply = sprintf("INSERT INTO `chat`(`from_id`,`to_id`,`message`) VALUES ('%s','%s','%s')",'chatbox', $id,$key);
				$reply = mysqli_query($conn, $reply);
				if($reply){
					echo $key;
				}
			}else{
				// Message to split
				$key = "In an ancient city shrouded in mystery, a secret chamber hides unimaginable treasures and untold secrets. Forged to protect it is a mystical key, its whereabouts
 known only to the cities wisest guardians. But four cunning thieves are determined to uncover its location and claim the riches within.
Evelyn the Shadow: A master of stealth and deception, Evelyn prowls the alleys and rooftops with unmatched grace, driven by a desire for freedom and wealth.
Gideon the Enforcer: Once a loyal soldier, Gideon now seeks redemption through the acquisition of the key, determined to keep the chamber sealed from those who would
 exploit its power. Lila the Charmer: With her beguiling charm, Lila infiltrates elite circles, believing the key to be the ultimate bargaining chip in her pursuit of
 power and influence. Rajan the Trickster: Delighting in chaos and unpredictability, Rajan is quest for the key is driven by a thirst for adventure and the thrill of 
the chase. As the four thieves race against time and each other, they face countless challenges and betrayals, testing their skills and resolve. But only one will 
emerge victorious, forever altering the fate of the ancient city.";

				// Split the message into parts
				$parts = explode('. ', $key);

				// Shuffle the array to randomize the order of the parts
				shuffle($parts);

				// Display each part one by one
				foreach($parts as $part) {
					 $part . '. '; 
					flush(); 
					usleep(500000); 
				}
				$reply = sprintf("INSERT INTO `chat`(`from_id`,`to_id`,`message`) VALUES ('%s','%s','%s')",'chatbox', $id,$part);
				$reply = mysqli_query($conn, $reply);
				if($reply){
					echo $part;
				}
					
			}
		} else {
			echo 'not done';
		}
    
}
//to show messages which are inserted by user
if(isset($_REQUEST['from_id']) and !isset($_REQUEST['msg']) and !isset($_REQUEST['to_id'])){
    $id = $_REQUEST['from_id'];

    $query = mysqli_query($conn, "SELECT * FROM `chat` WHERE `from_id`='$id' ORDER BY `id` DESC");
    if(mysqli_num_rows($query) > 0){
        if($row = mysqli_fetch_assoc($query)){
            $msg = secure($conn, $row['message']);
            echo $msg;
        }
    }
}
//show reply
if(isset($_REQUEST['to_id']) and !isset($_REQUEST['msg']) and !isset($_REQUEST['from_id'])){
    $id = $_REQUEST['to_id'];
	
    $query = mysqli_query($conn, "SELECT * FROM `chat` WHERE `to_id`='$id' ORDER BY `id` DESC");
    if(mysqli_num_rows($query) > 0){
        if($row = mysqli_fetch_assoc($query)){
            $msg = secure($conn, $row['message']);
            //echo $msg;
			if($msg == 'FLAG{f@k3_7o_@cc3$$_R3@l_F7@g}'){
				echo 'Dear Rajan the Trickster, You are clear for access. The flag is '.$msg;
			}else{
				echo $msg;
			}
        }
    }
}
?>
