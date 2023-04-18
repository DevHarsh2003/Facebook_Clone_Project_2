<?php
    if(isset($_POST['login'])){
        $con=mysqli_connect("localhost","root","");
        $db=mysqli_select_db($con,"facebook");
        $username=$_POST['username'];
        $password=$_POST['password'];
        if(!$con){
            echo "<script>alert ('Connection Failed');";
        }
        else{
            session_start();
            $_SESSION['user']=$username;
            $query="select * from user where username='$username'";
            $res=mysqli_query($con,$query);
            $c=0;
            while($row=mysqli_fetch_assoc($res)){
                if($row['username']==$username){
                    $c++;
                    if($row['password']==$password){
                        
                        header("location:Nhome.php");
                    }
                    else{
                        echo "<script>alert ('Password Or Username Invalid')</script>";
                    }
                }
            }
            if($c==0){
                echo "<script>alert ('No Account Found');
                window.location.href='Signup.php'</script>";
            }
        }
    }
?>



<html>
    <head>
        <title>Login Facebook</title>
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
                                <h4 align="center" >Login To Open Book</h4>
                                <table>
                                    <tr>
                                        <td>User Name:</td>
                                        <td><input type="text" placeholder="Please Enter The User Name" name="username"></td>
                                    </tr>
                                    <tr>
                                        <td>Password:</td>
                                        <td><input type="password" placeholder="Please Enter Your Password" name="password" ></td>
                                    </tr>
                                </table>
                                <button type="submit" name="login">Login</button><br><br>
                                Not Having Account?<a href="Signup.php">&nbsp;SignUp</a>

                            </form>
                        </center>
                    </div>
                    <div class="col col-md-3"></div>
                </div>
            </div>
        </div>
    </body>
</html>