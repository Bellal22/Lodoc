<?php
session()->regenerate();
if(Session('id')!=null){
    return redirect('/Admin/users');
}else{
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>LoDoc</title>
</head>
<body>

<link href={{asset(("css/login.css"))}} rel="stylesheet">

<div id="login">
    <img src={{asset("storage/logo.png")}} id="img">
    <form method="POST" action="{{ url('log') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{--<input type="hidden" name="_token" value="{{ csrf_field() }}">--}}
            <label ><h4>E-mail</h4><br>
                <input type="email" id="user_login" class="input" name="mail" size="20" placeholder="user@host.com" autocomplete="off" required autofocus></label>


            <label ><h4>Password</h4><br>
                <input type="password" id="user_pass" class="input" name="password" size="20" required ></label>

        <label >
            <input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember Me</label>

            <button type="submit"  class="button button-primary ">Login</button>

    </form>

</div>
</body>
</html>
<?php
}
?>