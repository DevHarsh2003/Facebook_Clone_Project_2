<?php
    if(isset($_POST['signup'])){
        $con=mysqli_connect("localhost","root","");
        $db=mysqli_select_db($con,"facebook");
        if(!$con){
            echo "<script>alert ('Connection Failed');</script>";
        }
        else{
            session_start();
            $name=$_POST['name'];
            $email=$_POST['email'];
            $username=$_POST['username'];
            $password=$_POST['password'];
            $query="insert into user (name,email,username,password) values ('$name','$email','$username','$password')";
            $res=mysqli_query($con,$query);
            if($res){
                echo "<script>alert ('Registration Is Successful');
                window.location.href='Login.php';
                </script>";
            }
            else{
                echo "<script>alert ('Registration Is UnSuccessful');
                window.location.href='Signup.php';
                </script>";
            }

        }
    }
?>


<html>
    <head>
        <title>SignUp Facebook</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    </head>

    <style>
        body{
            overflow-y: hidden;
            overflow-x: hidden;
        }
        div.background{
            background: url(Image/LoBack.jpg) no-repeat;
            background-position: center;
            background-size: cover;
            height: 41.1rem;
            backdrop-filter: sepia(90%);
            
           
        }
        #main{
            background-color: lightgrey;
            border-radius: 1.2rem;
            padding: 3rem;
            margin-top: 9rem;
            font-family: Trirong;
            opacity: 1;
        }
        table {
            margin: 1rem;
        }
        td{
            padding: 0.7rem;
        }
        input{
            width:13rem;
            border: 0.1rem solid black;
            border-radius: 0.2rem;
        }
        button{
            background-color: rgb(42, 155, 8);
            padding: 0.4rem;
            padding-left: 1.5rem;
            padding-right: 1.5rem;  
            border-radius: 0.4rem;
            border: 0rem;
            font-size: 1.2rem;
        }
    </style>

    <body>
        <div class="background">
            <div class="container">
                <div class="row"> 
                    <div class="col col-md-3"></div>
                    <div class="col col-md-6" id="main">
                        <center> 
                            <form action="" method="post">
                                <h4 align="center" >Signup To Use The Book</h4>
                                <table>
                                    <tr>
                                        <td>Name:</td>
                                        <td><input type="text" placeholder="Please Enter The Name" name="name" required></td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td><input type="email" placeholder="Please Enter Email" name="email" required></td>
                                    </tr>
                                    <tr>
                                        <td>User Name:</td>
                                        <td><input type="text" placeholder="Please Enter The User Name" name="username" required></td>
                                    </tr>
                                    <tr>
                                        <td>Password:</td>
                                        <td><input type="password" placeholder="Please Enter Your Password" name="password" required ></td>
                                    </tr>
                                </table>
                                <button type="submit" name="signup">SignUp</button>
                                <br><br>
                                Already Have An Account?<a href="Login.php">&nbsp;Login</a>
                            </form>
                        </center>
                    </div>
                    <div class="col col-md-3"></div>
                </div>
            </div>
        </div>
    </body>
</html>