<html>
<body>
<form method='post' enctype="multipart/form-data" >
    <input type="file" name='file' accept='.jpg' multiple required >
    <div class="s" > 
    <input type="submit" value='upload' name='upload'   >
    </div>
</form>

</body>
<style>
    body{
        background-image:linear-gradient(30deg,red,blue);
    }
    </style>
</html>
<?php
$n=1;
if(isset($_POST['upload'])){
    session_start();
    $u=$_SESSION['user'];
    $f=$_FILES['file']['tmp_name'];
    
    while(true){
        $s=strval($n);
    if(file_exists("upload/$u$s.jpg")){
        echo "<img src='upload/$u$s.jpg' width='200' height='200' >";
        $n=$n+1;
    }
    else{
    if(move_uploaded_file($f,"upload/$u$s.jpg"))
    {
        echo "uploaded";
       break;
    }
    
    }
}
}
?>