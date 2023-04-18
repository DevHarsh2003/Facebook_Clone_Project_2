<?php 
   session_start();

   if(isset($_SESSION['user'])){
   $link="http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
    if(isset($_POST['post'])){
        $uc=$_POST['ucom'];
        $fn=$_POST['filename'];
        $u=$_SESSION['user'];
        $c="0";
        date_default_timezone_set('Asia/Calcutta');
        $date=date('d/m/Y h:i:s a', time());
        $con=mysqli_connect("localhost","root","");
        $db=mysqli_select_db($con,"facebook");
        $sql="insert into comment (username,name,comment,comno,date) values ('$u','$fn','$uc','$c','$date')";
        $run=mysqli_query($con,$sql);
        if($run){
            echo "<script> alert('Comment Posted');window.location.href='Nhome.php';</script>";
            
        }
    }
    if(isset($_POST['vcom'])){
        $con=mysqli_connect("localhost","root","");
        $db=mysqli_select_db($con,"facebook");
        $fn=$_POST['filename'];
        $u=$_SESSION['user'];
        header("location:comment.php?username=".$u."&filename=".$fn);
    } 
    if(isset($_POST['vlike'])){
        $con=mysqli_connect("localhost","root","");
        $db=mysqli_select_db($con,"facebook");
        $fn=$_POST['filename'];
        $u=$_SESSION['user'];
        header("location:likes.php?username=".$u."&filename=".$fn);
    } 

    if(isset($_POST['like'])){
        $con=mysqli_connect("localhost","root","");
        $db=mysqli_select_db($con,"facebook");
        $c="1";
        $n=0;
        $fn=$_POST['filename'];
        $u=$_SESSION['user'];
        $sql="select * from likes";
        $run=mysqli_query($con,$sql);
        while($row=mysqli_fetch_assoc($run)){
            if($u==$row['username'] && $fn==$row['name']){
                $n++;
                echo "<script> alert('Already Liked');window.location.href='Nhome.php';</script>";
            }
        }
        if($n==0){
            $sql1="insert into likes (username,name,likes) values ('$u','$fn','$c')";
                $run1=mysqli_query($con,$sql1);
        }
    }
    if(isset($_POST['dislike'])){
        $con=mysqli_connect("localhost","root","");
        $db=mysqli_select_db($con,"facebook");
        $fn=$_POST['filename'];
        $u=$_SESSION['user'];
        $sql="delete from likes where username='$u' and name='$fn'";
            $run=mysqli_query($con,$sql);
            
    }
                                       
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
            height:34.08rem;
            overflow-y:scroll;
            overflow-x:hidden;
            scroll-behavior: smooth;
            font-size:1rem;
        }
        #right{
            float: right;
            display: inline-block;
            width:16.5rem;
            border:0.1rem solid black;
            padding:0.4rem;
            height:35rem;
            overflow-y:scroll;
            scroll-behavior: smooth;
            overflow-x:hidden;
        }
        #top{
            height: 5rem;
            

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
                <div class="row">
                <center>
                <div class="col col-md-11" >
                <?php 
                            $con=mysqli_connect("localhost","root","");
                            $db=mysqli_select_db($con,"facebook");
                            $sql="select * from follow where x='$_SESSION[user]'";
                            $out=mysqli_query($con,$sql);
                            while($row=mysqli_fetch_assoc($out)){
                                $p=$row['y'];
                                $u=$_SESSION['user'];
                                $n=1;
                                $path = "upload/";

                                if ($handle = opendir($path)) {
                                    while (false !== ($file = readdir($handle))) {
                                        if ('.' === $file) continue;
                                        if ('..' === $file) continue;
                                        if($file=="$p$n.jpg"){
                                            $fe= $p.$n;
                                            $n++;
                                            ?>                                            
                                            <div class="card bg-light" style="margin-top:2rem;margin-bottom:1rem;border:0rem hidden;border-radius:0.1rem;">
                                            <div class="card-header" style="text-align:left;background-color:lightgrey"><i class="fa-solid fa-user fa-sm"></i>&nbsp;<?php echo $p; ?></div>
                                            <div class="card-body"><?php echo "<img src='upload/$fe.jpg' width='500' height='300' >"; ?>
                                            <p class="card-text"><?php 
                                                $sql1="select user.name,comment.comment,comment.date from `user`,`comment` where comment.username=user.username and comment.name='$fe' and comment.comno='1'";
                                                 $out1=mysqli_query($con,$sql1);
                                                 while($r1=mysqli_fetch_assoc($out1)){
                                                    echo "<span style='font-size:0.8rem;'><b>$r1[name]</b>&nbsp;&nbsp;</span>";
                                                    echo "<span style='font-size:1rem;'><i>&ldquo;$r1[comment]&rdquo;</i></span>";
                                                    echo "<span style='margin-left:1rem;font-size:0.7rem;'>-$r1[date]-</span>";
                                                 }
                                               
                                               
                                           ?>
                                            &nbsp;&nbsp;</p>
                                            </div><hr>
                                           
                                            <div class="card-text" style="text-align:left;">
                                             <span> 
                                                <div class="row"> 
                                                <form action="" method="post" style="width:9rem;margin-right:0rem;margin-left:2rem;">
                                                <input type='text' id='file' name="filename" value=<?php echo $fe;?>  hidden>
                                                <button class="btn btn-primary" name="vcom" style="font-size:0.7rem;">View Comments</button>
                                                </span>
                                                </form>

                                                <form action="" method="post" style="width:6.8rem;margin-right:-4rem;margin-left:2rem;">
                                                <input type='text' id='file' name="filename" value=<?php echo $fe;?>  hidden>
                                                <span ><button class="btn btn-primary" name="vlike" style="font-size:0.7rem;">View Likes</button></span>
                                                </form>

                                                <form action="" method="post" style="width:4rem;margin-right:-2rem;margin-left:7rem;">
                                                <span >
                                                    <input type='text' id='file' name="filename" value=<?php echo $fe;?>  hidden>
                                                    <button name="like" class="btn btn-primary" style="font-size:0.9rem;"><i class="fa-solid fa-thumbs-up"><?php    
                                                $sql2="select sum(likes) from likes where name='$fe'";
                                                 $out2=mysqli_query($con,$sql2);
                                                 while($r2=mysqli_fetch_array($out2)){
                                                    if($r2[0]>0){
                                                    echo "<span style='font-size:0.8rem;'><b>&nbsp;&nbsp;$r2[0]</b>&nbsp;&nbsp;</span>";
                                                    }
                                                    else{
                                                        echo "<span style='font-size:0.8rem;'><b>&nbsp;&nbsp;0</b>&nbsp;&nbsp;</span>";
                                                    }
                                                 }
                                                 ?></i></button></span>
                                                </form>
                                                
                                                 <form action="" method="post" style="width:4rem;margin-right:-9rem;margin-left:2rem;">
                                                <span >
                                                    <input type='text' id='file' name="filename" value=<?php echo $fe;?>  hidden>
                                                    <button name="dislike" class="btn btn-primary" style="font-size:0.9rem;"><i class="fa-solid fa-thumbs-down"></i></button></span>
                                                </form>


                                                <form action="" method="post" style="width:18rem;margin-left:11rem;">
                                                <span >
                                                <input type='text' id='file' name="filename" value=<?php echo $fe;?>  hidden>
                                                <input id="ucom" name="ucom" style="border-radius:0.4rem; box-shadow:0.1rem 0.1rem gray; border:0.1rem solid black" type="textfield" required>
                                                &nbsp;
                                                <button type="submit" name="post" class="btn btn-primary" style="font-size:0.9rem;">
                                                <i class="fa-solid fa-comment">
                                                 </i></button></span>
                                                </form>
                                                </span>  
                                            </div>
                                            
                                        </div>
                                        </div>
                                        <?php
                                        }
                                        
                                    }
                                    closedir($handle);
                                }
                             
                            }
                        ?>
                        
                  </div>         
                
                </center>
                </div>      
                 
            </center>
        </div>

        <div class="container" id="right"> 
            <center>
                <h5 style="font-family:Almendra SC;">People</h5><hr>
            </center>
            <?php 
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
                                        
                                            <a type="button" id="btn" href="<?php echo("follow.php?x=".$_SESSION['user']."&y=".$row['username']."&continue=".$link); ?>" onClick=location.href='Upload.php'  name="cfollow" class="btn btn-primary" style="font-size:0.7rem;" active>Follow</a>
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
                    else{
                        header("location:Login.php");
                        session_destroy();
                    }
                    
                 
            ?>
            
        </div>
            <script>
                
            </script>
    </body>
   
</html>