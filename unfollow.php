<html>
    <head>
    <title>Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
        <script src="https://kit.fontawesome.com/de38eb546a.js" crossorigin="anonymous"></script>
    </head>
    <style>
        #pop{
            position:absolute;
            top:15rem;
            left:34rem;
            background-color:lightgrey;
            padding:2rem;
            border-radius:0.4rem;
            box-shadow:0.2rem 0.2rem darkgrey;
        }
    </style>
        <body>
        <?php  
        session_start();
        if(isset($_SESSION['user'])){
            $s=$_GET['x'];
            $u=$_GET['y'];
            $con=mysqli_connect("localhost","root","");
            $db=mysqli_select_db($con,"facebook");
            $query="delete from follow where x='$s' and y='$u'";
            $res=mysqli_query($con,$query);
            if($res){
                ?>
                <center>
                <div id="pop" onmouseover="f(this)" onmouseout="f(this)">
                    <center>
                    
                        <span>You Just Unfollowed <?php echo($u);?></span>
                        <div ><form action="" method="post"><button class="btn btn-success" name="ok">OK</button></form></div>
                        
                    </center>
                </div>
                </center>
                <?php
            }
                if(isset($_POST['ok'])){
                    header("location:".$_GET['continue']);
                }
            }

        ?>
        <script>

     
          
            function f1(x){
                x.style.height = "8.6rem";
                x.style.width = "22rem";
                
            }
            function f2(x) {
                x.style.height = "7.8rem";
                x.style.width = "19rem";
            }
        
        </script>
        </body>

</html>


 