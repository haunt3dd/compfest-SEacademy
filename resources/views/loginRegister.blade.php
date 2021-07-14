<html>
    <head>
        <title>Login and Registration Form</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <style>
* {
    padding: 0;
    margin: 0;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
}

.hero {
    height: 100%;
    width: 100%;
    background-color: black;
    background-position: center;
    background-size: cover;
    position: absolute;
}

.form-box {
    width: 380px;
    height: 480px;
    position: relative;
    margin: 6% auto;
    background-color: #fff;
    padding: 5px;
    overflow: hidden;
}

.button-box {
    width: 220px;
    margin: 35px auto;
    position: relative;
    box-shadow: 0 0 20px 9px #ff61241f;
    border-radius: 30px;
}

.toggle-btn {
    padding: 10px 30px;
    cursor: pointer;
    background: transparent;
    border: 0;
    outline: none;
    position: relative;
}

#btn {
    top: 0;
    left: 0;
    position: absolute;
    width: 110px;
    height: 100%;
    background: linear-gradient(to right, #ff105f, #ffad06);
    border-radius: 30px;
    transition: .5s;
}

.input-group {
    top: 130px;
    position: absolute;
    width: 280px;
    transition: .5s;
}

.input-field {
    width: 100%;
    padding: 10px 0;
    margin: 5px 0;
    border-left: 0;
    border-top: 0;
    border-right: 0;
    border-bottom: 1px solid #999;
    outline: none;
    background: transparent;
}

.submit-btn {
    margin-top:5%;
    width: 85%;
    padding: 10px 30px;
    cursor: pointer;
    display: block;
    margin: auto;
    background: linear-gradient(to right, #ff105f, #ffad06);
    border: 0;
    outline: none;
    border-radius: 30px;
}

.submit-btn:hover {
    background: linear-gradient(to right, #ff9487, #ffdd16);
}

.check-box {
    margin: 30px 10px 30px 0;
}

span {
    color: #777;
    font-size: 12px;
    bottom: 63px;
    position: absolute;
}

#login {
    left: 50px;
}

#register {
    left: 450px
}

#user-error,
#pass-error {
    font-size: 12px;
    margin-top: 5px;
    width: 260px;
    color: #C62828;
    background: rgba(255, 0, 0, 0.1);
    text-align: center;
    padding: 5px 8px;
    border-radius: 3px;
    border: 1px solid;
    display: none;
}

#password{
    margin-bottom:5%;
}

.alert-message{
    color:red;
    font-size:12px;
    margin-top:80%;
    /* position: absolute; */
    text-align: center;
    transition: .5s;
}

    </style>

    <body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Sign In</button>
                <button type="button" class="toggle-btn" onclick="register()">Sign Up</button>
            </div>
            
            <form action="{{ route('loginUser') }}" id="login" class="input-group" method="POST" >
                @csrf
                <input type="text" autocomplete="off" class="input-field form-control" name="username" id="user" placeholder="Username">
                <div id="user-error">Please Fill up your Username</div>
                <input type="password" autocomplete="off" class="input-field form-control" name="password"  id="pwd" placeholder="Enter Password">
                <div id="pass-error">Please Fill up your Password</div>
                <input type="checkbox" class="check-box"><span>Remember Password</span>
                <button type="submit" class="submit-btn">Sign In</button>
            </form>

            @if(session('message'))

            <div class="alert-message">
            {{ session('message') }}
            </div>

            @endif

            <form action="{{ route('registerUser') }}" id="register" class="input-group" method="POST">
                @csrf
                <input type="text" class="input-field" name="first_name" placeholder="First Name" required>
                <input type="text" class="input-field" name="last_name" placeholder="Last Name" required>
                <input type="text" class="input-field" name="age" placeholder="Enter Age" required>
                <input type="email" class="input-field" name="email" placeholder="Email" required>
                <input type="text" class="input-field" name="username" placeholder="Username" required>
                <input type="password" class="input-field" name="password" placeholder="Enter Password" required>
                <button type="submit" class="submit-btn">Sign Up</button>
            </form>

        </div>
    </div>        

    </body>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>


    <script>
        var log =document.getElementById("login");
        var regis =document.getElementById("register");
        var button = document.getElementById("btn");

        function register(){
            log.style.left = "-400px";
            regis.style.left = "50px";
            button.style.left ="110px";
            $('.alert-message').remove();
        }

        function login(){
            log.style.left = "50px";
            regis.style.left = "450px";
            button.style.left ="0px";
            $('.alert-message').remove();
        }

        var user_id = document.getElementById("user"); 
        var user_password = document.getElementById("pwd"); 

        var id_error = document.getElementById("user-error");
        var pass_error = document.getElementById("pass-error");

        user_id.addEventListener('textInput', idVerify);
        user_password.addEventListener('textInput', passVerify);

        function validatedLogin(){
            if(user_id.value.length == 0){
                user_id.style.borderBottom = "1px solid red";
                id_error.style.display="block";
                
                id_error.textContent="id must be filled"
                user_id.focus();
                return false;
            }

            if(user_password.value.length == 0){
                user_password.style.borderBottom = "1px solid red";
                pass_error.style.display="block";
                pass_error.textContent="password must be filled"
                user_password.focus();
                return false;
            }

        }

        function idVerify(){
            if(user_id.value.length > -1){
                user_id.style.borderBottom = "1px solid #999";
                id_error.style.display="none";
                return true;
            }
        }
        function passVerify(){
            if(user_password.value.length > -1){
                user_password.style.borderBottom = "1px solid #999";
                pass_error.style.display="none";
                return true;
            }
        }

    </script>
</html>