<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            background-color: #f5dec4;
        }
        .container{
            background-color: #f5dec4;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .main {
            width: 80%;
            height: 80%;
            background: rgba(255, 255, 255, 0.894);
            border-radius: 10px;
            
            
        }
        .main .content{
            display: flex;
        }
        .main .card{
            width: 50%;
            margin-top: 20px;
            margin-left: 50px;
            
            /* background: red; */
        }
        .main .card .form{
            /* background: blueviolet; */
            box-shadow: 0px 0px 0px black;
            width: 70%;
            margin: 0px auto;

        }
        .main .card form{
            display: flex;
            flex-direction: column;
            
            /* width: 80%; */
        }
        .card form input{
            padding: 5px 5px;
            border: none;
            background: #f5dec4;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .main .anime{
            width: 50%;
            text-align: end;
        }
        .main .anime img{
            width: 90%;
           border-radius: 0px 10px 0px 0px;
           
        }
        #btn{
            width: 30%;
            margin: 0px auto;
            padding: 10px;
            font-family: sans-serif;
            cursor: pointer;
            color: white;
            background-color: #bd8d54;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main" style="position: relative;">
            <div class="content">
            <div class="card">
                <div class="form">
                <form action="login_handler.php" method="post">
                <a href="index.php"> <img src="logo.png" alt="logo" style="width: 50%;margin: 0px auto;"></a>
                            <h1 style="text-align: center;">Sign In</h1>
                            Username: <input type="text" name="username" placeholder="Enter username" required>
                            Password: <input type="password" name="password" placeholder="Enter password" required>
                            <input type="submit" name="login" value="Login" id="btn">
                            <p style="text-align: center;">Didn't have an account?<a href="account.html">Sign up</a></p>

                        </form>
            </div>
            </div>
            <div class="anime"><img src="signupimg.png" alt=""></div>
        </div>
        <p style="position: absolute;bottom: 26px;color: #f5dec4;">_______________________________________________________________________________________________________________________</p>
        </div>
    </div>
</body>
</html>