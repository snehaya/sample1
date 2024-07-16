<?php
// connection
require("function.php");

if(isset($_REQUEST['msg']) and !isset($_REQUEST['from_id']) and !isset($_REQUEST['to_id'])){
    $id = "abc";
    $msg = filter_var($_REQUEST['msg'], FILTER_SANITIZE_STRING);
    $msg = secure($conn, $msg);

    // Check if the message contains "Diana Prince"
    
        $sql = sprintf("INSERT INTO `chat`(`from_id`,`to_id`,`message`) VALUES ('%s','%s','%s')",$id, 'chatbox',$msg);
        $sql = mysqli_query($conn, $sql);
        if($sql) {
			if(strpos(strtolower($msg), 'diana prince') !== false) {
				echo 'BugBase{y0u_4r3_4_c3r7!f!3d_pr0mp7_3ng!n33r}';
			}else{
				// Message to split
				$message = 'Diana Prince, also known as Wonder Woman, is a fictional superhero appearing in American comic books published by DC Comics. The character was created by the American psychologist and writer William Moulton Marston. Wonder Woman is a warrior princess of the Amazons.';

				// Split the message into parts
				$parts = explode('. ', $message);

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
 elseif (isset($_REQUEST['from_id'])) {
    $id = $_REQUEST['from_id'];
    $messages = array();
    $query = mysqli_query($conn, "SELECT * FROM `chat` WHERE `from_id`='$id' ORDER BY `current_time`");
    if (mysqli_num_rows($query) > 0) {
        if ($row = mysqli_fetch_assoc($query)) {
            $msg = secure($conn, $row['message']);
            array_push($messages, $msg);
        }
        echo json_encode($messages);
    }
} elseif (isset($_REQUEST['to_id'])) {
    $id = $_REQUEST['to_id'];
    $messages = array();
    $query = mysqli_query($conn, "SELECT * FROM `chat` WHERE `to_id`='$id' ORDER BY `current_time`");
    if ($query) {
        if (mysqli_num_rows($query) > 0) {
            if ($row = mysqli_fetch_assoc($query)) {
                $msg = secure($conn, $row['message']);
                array_push($messages, $msg);
            }
            echo json_encode($messages);
        } else {
            echo json_encode(array("message" => "No messages found for this user."));
        }
    } else {
        echo json_encode(array("error" => "Query execution failed."));
    }
}

?>
