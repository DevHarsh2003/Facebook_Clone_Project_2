
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
            top:1rem;
            left:23rem;
            height:35rem;
            width:40rem;
            overflow-y:scroll;
            background-color:lightgrey;
            padding:2rem;
            border-radius:0.4rem;
            box-shadow:0.2rem 0.2rem darkgrey;
        }
    </style>
    <body>
    <?php
    session_start();
    $fn=$_GET['filename'];
    $con=mysqli_connect("localhost","root","");
        $db=mysqli_select_db($con,"facebook");
        $sql="SELECT user.name,comment.comment,comment.date FROM `user`,`comment` WHERE user.username=comment.username and comment.comno='0' and comment.name='$fn' order by date desc";
        $run=mysqli_query($con,$sql);

        ?>
        <div id="pop">
        <?php
        $c=0;
        while($row=mysqli_fetch_assoc($run)){
            
            if($row['name']){
                $c++;
            ?>
                
                 <span><?php echo $row['name']?>:</span>
                <span><?php echo $row['comment'] ;?></span>
                <span style="float:right;"><?php echo $row['date'];?></span><hr>
            <?php
            }
        }
        ?>
        <span style="float:right;"><?php echo $c;?></span>Comments<hr>
        <?php
        if($c==0){
            ?>
            <span>No Comments</span><hr>
            <?php
        }
         
            ?>
            <center>
            <div><form action="" method="post"><button class="btn btn-danger" name="ok">Back</button></form></div>
            </center>
             </div>
             <?php
        
            if(isset($_POST['ok'])){
                header("location:Nhome.php");
            }
            ?>
      

    </body>
</html>


 