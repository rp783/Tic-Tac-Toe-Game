<?php session_start(); 
require_once("./nav2.php");


?>

   <body> 
    <div class="center">
      <div class="centerbuttom">
     <a href="./local.php">  
       <button class="button-29">Play Local</button>  
       <br /></a>
     <a href="./PlayerVsCom/Player VS Computer.php">  
     <button class="button-29">Play Computer</button>  
     <br /></a>
     <a href="./local.php">  
     <button class="button-29">Play Online</button>  
     <br /></a>
    </div>
    </body> 
</div>
  <div class="welcome" >
    <h1>Welcome <?php echo $Username ?> to Tic-Tac-Toe</h1> 
    <h2> Please Select a Mode </h2>   
</html>


<?php
require_once "./footer.php";
