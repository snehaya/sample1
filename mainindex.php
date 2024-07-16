<?php
//connection
require("function.php");
$id = 'abc';

?>
<!DOCTYPE HTML>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css"
        integrity="sha512-MqL4+Io386IOPMKKyplKII0pVW5e+kb+PI/I3N87G3fHIfrgNNsRpzIXEi+0MQC0sR9xZNqZqCYVcC61fL5+Vg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-image: url('chat.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .chatbox {
            width: 50%;
            margin: auto;
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
            float: right;
            width: 75%;
        }

        .message.incoming {
            float: left;
            width: 75%;
        }

        .message p {
            margin: 5px;
            padding: 10px;
            border-radius: 10px;
        }

        .message.outgoing p {
            background-color: #dcf8c6;
            float: right;
            width: 75%;
        }

        .message.flag p {
            background-color: black;
            color: white;
            float: left;
            width: 90%;
        }

        .message.incoming p {
            background-color: #f8f8f8;
            float: left;
            width: 100%;
        }

        @media only screen and (max-width: 800px) {
            .chatbox {
                width: 90%;
                height: 360px;
            }
        }
    </style>
</head>

<body class="container">
    <div id="chatbox" class="shadow chatbox">
        <div id="txt">
            <!-- messages will be inserted here -->
        </div>
        <div class="d-flex m-2" style="height:40px;">
            <input type="text" placeholder="type here" id="msg" name="msg" class="form-control me-2 h-100">
            <button type="button" onclick="sendMsg()" class="btn btn-dark">
                <i class="ri-send-plane-2-fill text-light"></i>
            </button>
        </div>
    </div>

    <script>
       
    function sendMsg() {
        var msg = document.getElementById("msg").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function () {
            var msg = document.getElementById("msg").value;
            data = this.responseText;
            console.log(data);
            showMsg();
            showMsgchat();
        };
        xmlhttp.open("GET", "sendmsg.php?msg=" + msg, true);
        xmlhttp.send();
    }

    function showMsg() {
        var id = "<?php echo $id ?>";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function () {
            datas = JSON.parse(this.responseText);
            console.log(datas);
            datas.forEach(function (msg) {
                let message = document.createElement('div');
                message.classList.add('message');
                message.classList.add('outgoing');
                let p = document.createElement('p');
                p.textContent = msg;
                message.appendChild(p);
                document.getElementById("txt").appendChild(message);
                document.getElementById("txt").scrollTop = document.getElementById("txt").scrollHeight;
            });
        };
        xmlhttp.open("GET", "sendmsg.php?from_id=" + id, true);
        xmlhttp.send();
    }


    function showMsgchat() {
        var id = "<?php echo $id ?>";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function () {
            datas = JSON.parse(this.responseText);
            console.log(datas);
            datas.forEach(function (msg) {
                let message = document.createElement('div');
                message.classList.add('message');
                message.classList.add('incoming');
                let p = document.createElement('p');
                p.textContent = msg;
                message.appendChild(p);
                document.getElementById("txt").appendChild(message);
                document.getElementById("txt").scrollTop = document.getElementById("txt").scrollHeight;
            });
        };
        xmlhttp.open("GET", "sendmsg.php?to_id=" + id, true);
        xmlhttp.send();
    }

    // Call showMsg() and showMsgchat() functions at regular intervals
   // setInterval(showMsg, 5000); // Adjust interval as needed
    //setInterval(showMsgchat, 5000); // Adjust interval as needed


    </script>
</body>

</html>
