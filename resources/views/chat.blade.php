<style>
    * {
  box-sizing: border-box;
}

body {
  background-color: white;
}

.chat_window {
  position: absolute;
  width: calc(100% - 20px);
  max-width: 700px;
  height: 640px;
  border-radius: 10px;
  background-color: white;
  left: 50%;
  top: 50%;
  transform: translateX(-50%) translateY(-50%);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
  background-color:white;
  overflow: hidden;
  border: 2px solid black;
}

.top_menu {
  background-color: white;
width: 0%;
padding: 5px 300px 5px 30px;
box-shadow: 0 1px 30px rgba(0, 0, 0, 0.1);
border: 2px solid black;
position: fixed;
right: 3%;
border-radius: 10px;
}

.top_menu .buttons .button {
  color: black;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 19px;
border: 0.1px solid lavender;
}

.top_menu .title {
  text-align: right;
  color: black;
  font-size: 20px;
}

.messages {
  position: relative;
  list-style: none;
  padding: 20px 10px 0 10px;
  margin: 0;
  height: 570px;
  overflow: scroll;
  background-color: white;
}
.messages .message {
  clear: both;
  overflow: hidden;
  margin-bottom: 20px;
  transition: all 0.5s linear;
  opacity: 0;
}
.messages .message.left .avatar {
  background-color: #f5886e;
  float: left;
}
.messages .message.left .text_wrapper {
  background-color: #ffe6cb;
  margin-left: 20px;
}
.messages .message.left .text_wrapper::after, .messages .message.left .text_wrapper::before {
  right: 100%;
  border-right-color: #ffe6cb;
}
.messages .message.left .text {
  color: #c48843;
}
.messages .message.right .avatar {
  background-color: #fdbf68;
  float: right;
}
.messages .message.right .text_wrapper {
  background-color: #c7eafc;
  margin-right: 20px;
  float: right;
}
.messages .message.right .text_wrapper::after, .messages .message.right .text_wrapper::before {
  left: 100%;
  border-left-color: #c7eafc;
}
.messages .message.right .text {
  color: #45829b;
}
.messages .message.appeared {
  opacity: 1;
}
.messages .message .avatar {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  display: inline-block;
}
.messages .message .text_wrapper {
  display: inline-block;
  padding: 20px;
  border-radius: 6px;
  width: calc(100% - 85px);
  min-width: 100px;
  position: relative;
}
.messages .message .text_wrapper::after, .messages .message .text_wrapper:before {
  top: 18px;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
}
.messages .message .text_wrapper::after {
  border-width: 13px;
  margin-top: 0px;
}
.messages .message .text_wrapper::before {
  border-width: 15px;
  margin-top: -2px;
}
.messages .message .text_wrapper .text {
  font-size: 18px;
  font-weight: 300;
}
.bottom_wrapper {
  position: relative;
  width: 100%;
  background-color: whitesmoke;
  padding: 16px 20px;
  position: absolute;
  bottom: 0;
}
.bottom_wrapper .message_input_wrapper {
  display: inline-block;
  height: 50px;
  border-radius: 25px;
  border: 2px solid black;
  width: calc(100% - 160px);
  position: relative;
  padding: 0 20px;
}
.bottom_wrapper .message_input_wrapper .message_input {
  border: none;
  height: 100%;
  box-sizing: border-box;
  width: calc(100% - 40px);
  position: absolute;
  outline-width: 0;
  color: black;
  background-color: whitesmoke;
}

::placeholder {
  color: #fff;
  opacity: 1;
}

.bottom_wrapper .send_message {
  width: 140px;
  height: 50px;
  display: inline-block;
  border-radius: 50px;
  background-color: white;
  border: 2px solid black;
  color: inherit;
  cursor: pointer;
  transition: all 0.2s linear;
  text-align: center;
  float: right;
}

.bottom_wrapper .send_message:hover {
  color: #a3d063;
  background-color: #fff;
}

.bottom_wrapper .send_message .text {
  font-size: 18px;
  font-weight: 300;
  display: inline-block;
  line-height: 48px;
}

.message_template {
  display: none;
}

::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  background: #386d81;
}

::-webkit-scrollbar-thumb {
  background: #c7eafc;
}

::-webkit-scrollbar-thumb:hover {
  background: #386d81;
}

</style>

<body style="background-color: whitesmoke;">
<div class="top_menu">
    <div class="buttons">
    <a href="/logout"><div class="button">Выход</div></a>
        </div>
        <div class="title"><?=Illuminate\Support\Facades\Auth::user()->email?></div>
    </div>

    
<div class="chat_window">
    <ul id="table" class="messages">
   
    </ul>
    <form action="/" id="form">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <div class="bottom_wrapper clearfix">
        <div class="message_input_wrapper">
            <input id="text" name="message_text" class="message_input" placeholder="" />
        </div>
        <button type="submit" class="send_message"><div >
            <div class="icon"></div>
            <div class="text">Отправить</div>
        </div></button>
    </div>
</div>
<div class="message_template">
    <li class="message">
        <div class="avatar"></div>
        <div class="text_wrapper">
            <div class="text"></div>
        </div>
    </li>
</div>
</form>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    let elem
    function loadFromServer() {
        $.get( "/message", function( data ) {
            elem.html( data )
        });
    }
    $(document).ajaxError(function(event,xhr,options,exc) {
        alert("something went wrong")
    })
    function refreshTicker() {
        loadFromServer()
    }
    $( document ).ready(function() {
        elem = $( "#table" )
        setInterval(loadFromServer, 1000)
        loadFromServer();
    });
 

    $( "#form" ).submit(function( event ) {
 
    event.preventDefault();
     
   $.post( "/", $( "#form" ).serialize() );

    document.getElementById("text").value = "";
    refreshTicker()
     
    });
    

</script>
 
