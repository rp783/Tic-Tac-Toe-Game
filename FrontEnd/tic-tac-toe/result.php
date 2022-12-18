<?php
require_once "./header.php";




if (! playersRegistered()) {
    header("location: index.php");
}
resetBoard();
?>


<table class="wrapper" cellpadding="0" cellspacing="0">
    <tr>
        <td>

            <div class="welcome">

                <h1>
                    <?php
                   
                    if ($_GET['player']) {
                      $p =  score('x');
                        echo currentPlayer() . " won! ";
                        $oi = $_GET['player'];
                        echo "$oi";
                        $result = currentPlayer();
                        
                    }
                    

                   
                    else {
                        echo "It's a tie!";
                        
                    }
                
               
                    ?>
                    
                </h1>
                        </b>
                    

                <div class="player-name">
                    <?php echo playerName('x')?>' score: <b><?php echo $p = score('x')?></b>
                   
                </div>
   

                <div class="player-name">
                    
                    <?php echo playerName('o')?>' score: <b><?php echo score('o'); $o =score('o') ?></b>
                </div>

                
                <a href="play.php"> <button class="button-29">Play Again </button> </a><br />

                <a href="../Index.php"> <button class="button-29"> Home </button>  </a>    
</a>
            </div>

        </td>
    </tr>
                                                                
    </table>
</body>
</html>
<?php
require_once('../rmq/path.inc');
require_once('../rmq/get_host_info.inc');
require_once('../rmq/rabbitMQLib.php');
if($_GET['player']){
$client = new rabbitMQClient("../rmq/localscore.ini", "testServer");
$request = array('type' => 'score','HighScore'=> $p, 'UserName'=> $result);
$response = $client->send_request($request);
}


?>