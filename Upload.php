<?php 
    session_start();
    if(isset($_SESSION['user'])){
    $link="http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
?>
<html>
    <head>
        <title>Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
        <script src="https://kit.fontawesome.com/de38eb546a.js" crossorigin="anonymous"></script>
    </head>
    <style>
        #bar1{
            font-family:Trirong;
            background-color:white;
            margin:0.3rem;
            padding:0.3rem;
            font-size:1rem;
        }
        a{
            color:black;
            text-decoration:none;
        }
        body{
            background-color:white;
            overflow-y: hidden;
            overflow-x: hidden;
        }
        #bar{
            font-family:Trirong;
            background-color:white;
            margin-bottom:0.5rem;
            padding:0.5rem;
            border-radius:0.6rem;
            font-size:0.8rem;
            box-shadow:0.3rem 0.4rem #888888;
            margin-left:0.7rem;
            width:14.3rem;
        }
        #button{
            float:right;
        }
        #left{
            float: left;
            border-top:0.1rem solid black;
            width:12.5rem;
            height:25rem;
        }
        #mid{
            
            display: inline-block;
            float: inline-start;
            border:0.1rem solid black;
            width:56rem;
            margin-left:0.1rem;
            height:40rem;
            overflow-y:scroll;
            scroll-behavior: smooth;
            font-size:1rem;
        }
        #right{
            float: right;
            display: inline-block;
            width:16.5rem;
            border:0.1rem solid black;
            padding:0.4rem;
            height:40rem;
            overflow-y:scroll;
            scroll-behavior: smooth;
            overflow-x:hidden;
        }
        #top{
            height: 5rem;
        }
        #main{
            position:absolute;
            top:15rem;
            left:27rem;
            font-family:Trirong;
        }
        #ta{
            border-radius:0.4rem;
            box-shadow:0.2rem 0.2rem gray;
            border:0.1rem solid black;
        }
        
    </style>

    <body>
        <div id="top">
            <center>
                <img src="Image/Facebook Landscape.png" alt="Facebook" height="76rem">
            </center>
             
        </div>

        <div class="container" id="left">
            <div class="row" id="bar1">
                <div class="col col-sm-12"><a href="Nhome.php" target="self"><i class="fa-solid fa-house  fa-sm"></i>&nbsp;Home</a></div>
            </div>  
            <div class="row" id="bar1">
                <div class="col col-sm-12"> <a href="Profile.php"><i class="fa-solid fa-user fa-sm"></i>&nbsp;Profile</a></div>
            </div>
            <div class="row" id="bar1">
                <div class="col col-sm-12"><a href="Upload.php"><i class="fa-solid fa-upload fa-sm"></i>&nbsp;Upload</a></div>
            </div>
            <div class="row" id="bar1">
                <div class="col col-sm-12"><a href="Logout.php"><i class="fa-solid fa-right-from-bracket fa-sm"></i>&nbsp;Logout</a></div>
            </div>
            
        </div>

        <div id="mid">
            <center>
            <div id="main">
            <form method='post' enctype="multipart/form-data" ><i class="fa-solid fa-file-arrow-up fa-bounce fa-2xl"></i><br><br>
             <input class="form-control" type="file" name='file' accept='.jpg' multiple required >
                 
                <br><br>Your Comment:
                <div id="comment">
                    <textarea name="com" id="ta" cols="50" rows="4" required></textarea>
                </div><br>
                <button type="submit" class="btn btn-primary" name='upload'>Upload</button>
            </form>
                <?php
                $n=1;
                if(isset($_POST['upload'])){                  
                    $u=$_SESSION['user'];
                    $f=$_FILES['file']['tmp_name'];
                    $com=$_POST['com'];
                     $cn=1;
                    while(true){
                        $s=strval($n);
                        if(file_exists("upload/$u$s.jpg")){
                            $n=$n+1;
                        }
                        else{
                            if(move_uploaded_file($f,"upload/$u$s.jpg"))
                            {
                                
                                date_default_timezone_set('Asia/Calcutta');
                                $date=date('d/m/Y h:i:s a', time());
                                $con=mysqli_connect("localhost","root","");
                                $db=mysqli_select_db($con,"facebook");
                                $sql="insert into comment (username,name,comment,comno,date) values ('$u','$u$s','$com','$cn','$date')";
                                $run=mysqli_query($con,$sql);
                                if($run){
                                    echo "<script> alert('Picture Uploaded');window.location.href='Upload.php';</script>";
                                    break;
                                }
                            }
                            
                             
                        }
                    }
                }
                ?>
             
            </div>
            </center>
        </div>

        <div class="container" id="right"> 
            <center>
                <h5 style="font-family:Almendra SC;">People</h5><hr>
            </center>
            <?php 
        
                if(isset($_SESSION['user'])){
                    $presuser=$_SESSION['user'];
                    $con=mysqli_connect("localhost","root","");
                    $db=mysqli_select_db($con,"facebook");
                    if(!$con){
                        echo "<script>alert ('Connection Failed');</script>";
                    }
                    else{
                        $query="select username from user where username!='$presuser'";
                        $res=mysqli_query($con,$query);
                        while($row=mysqli_fetch_assoc($res)){
                            if($row['username']!=$_SESSION['user']){
                                ?>
                                <div class="row">
                                <div class="col col-md-12" id="bar">
                                    <span><?php echo $row['username'];?></span>
                                    <?php
                            }
                            ?>
                                    <div id="button">
                                    <?php
                                    $c=0;
                                    $n=0;
                                        $query2="select distinct x,y from follow";
                                        $res2=mysqli_query($con,$query2);
                                        while($row2=mysqli_fetch_assoc($res2)){

                                            if(($row2['x']==$_SESSION['user']) && ($row2['y']==$row['username'])){
                                                $c++;
                                            ?>
                                        
                                            <a type="button" id="btn" href="<?php echo("follow.php?x=".$_SESSION['user']."&y=".$row['username']."&continue=".$link); ?>" name="follow" class="btn btn-primary <?php  if(($row2['x']==$_SESSION['user']) && ($row2['y']==$row['username'])){echo "disabled";}else{echo "active";} ?>" style="font-size:0.7rem;">Follow</a>
                                            <a type="button" id="btn" href="<?php echo("unfollow.php?x=".$_SESSION['user']."&y=".$row['username']."&continue=".$link); ?>" class="btn btn-secondary <?php  if(($row2['x']==$_SESSION['user']) && ($row2['y']==$row['username'])){echo "active";}else{echo "disabled";} ?>" style="font-size:0.7rem;">Unfollow</a>
                                    
                                            
                                        <?php
                                        }
                                    }
                                    if($c==0){
                                        ?>
                                        
                                            <a type="button" id="btn" href="<?php echo("follow.php?x=".$_SESSION['user']."&y=".$row['username']."&continue=".$link); ?>" onClick="windows.location.href='Upload.php'"  name="cfollow" class="btn btn-primary" style="font-size:0.7rem;" active>Follow</a>
                                            <a type="button" id="btn" href="<?php echo("unfollow.php?x=".$_SESSION['user']."&y=".$row['username']."&continue=".$link); ?>" class="btn btn-secondary disabled "style="font-size:0.7rem;" >Unfollow</a>
                                        
                                           
                                        <?php
                                    }
                                        ?>
                                    </div>
                                </div>
                                </div>
                            <?php
                            }
                                 
                        }
                        
                    }
                
    }
    else{
        header("location:Login.php");
        session_destroy();
    }
            ?>
        </div>
       

    </body>
   
</html>