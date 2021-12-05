<style>
.container {
    border: 2px solid black;
background-color: white;
border-radius: 10px;
padding: 10px;
margin: 10px 0;
color: black;
max-width: max-content;
margin-left: auto;
margin-right: 0;
}

.darck{
    background-color: white;
    margin-left: 0; 
    margin-right: auto;
}
.darker {
    border-color: #ccc;
    background-color: #ddd;
}

.container::after {
    content: "";
    clear: both;
    display: table;
}

.container img {
    float: left;
    max-width: 60px;
    width: 100%;
    margin-right: 20px;
    border-radius: 50%;
}

.container img.right {
    float: right;
    margin-left: 20px;
    margin-right:0;
}

.time-right {
    float: right;
    color: #000000;
}

.time-left {
    float: left;
    color: #999;
}

.perenos {
    margin: auto;
padding: initial;
word-break: break-all;
}

</style>
    @foreach ($messages as $message)
    @if(Illuminate\Support\Facades\Auth::user()->email === $message->Email)
    <li  class="container">
    @else
    <li  class="container darck">
    @endif
    <div class="perenos">{{ $message->Sms}}</div>
    <span class="time-right">{{ $message->Email  }}  {{$message->Data}}</span>
     </li>
    @endforeach

