<?php
require "./nav.php";
?>

<form method="post" action="./tic-tac-toe/registerPlayer.php">
    
    <div class="center">
    <div class="welcome">
        <h1>Start playing Tic Tac Toe!</h1>
        <h2>Please fill in your names</h2>
        

        <div class="player-name">
            <label for="player-x">First player (X)</label>
            <input type="text" id="player-x" name="player-x" required />
        </div>

        <div class="player-name">
            <label for="player-o">Second player (O)</label>
            <input type="text" id="player-o" name="player-o" required />
        </div>

        <button class="button-29" role="submit">Submit</button>
</div>
    </div>
</form>

<?php
require_once "./footer.php";

