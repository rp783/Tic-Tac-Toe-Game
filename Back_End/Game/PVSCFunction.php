<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <div style="text-align: center;-moz-user-select: none; -webkit-user-select:none; -ms-user-select:none; user-select:none;" unselectable="on">
            <?php
            new Game();
            ?>
        </div>
    </body>
</html>

<?php
class Game {

    var $position;                       
    var $board        = '---------';     
    var $debug        = false;           
    var $valid_char   = ['x', 'o', '-']; 
    var $invalid_char;                   
    var $grid_size    = 3;               
    var $winning_line = [];              
    var $win_lines    = [];                 

    function __construct() {
        if (isset($_GET['size'])) {
            $this->grid_size = trim($_GET['size']);
            $this->board     = str_repeat('-', pow($this->grid_size, 2));
        }
        if (isset($_GET['board'])) {
            if (strlen(trim($_GET['board'])) == 0) {
                $this->board = str_repeat('-', pow($this->grid_size, 2));
            } else {
                $this->board = trim(strtolower($_GET['board']));
            }
        }

        $this->position = str_split($this->board); 
        if (isset($_GET['debug'])) {
            $this->debug = true; 
            echo 'Game is running in DEBUGGING Mode.  All Possible Winning Lines are displayed below, while the grid displays additional information.<br />';
        }
        $this->generate_win_lines();
        $this->game_check();
    }
    function generate_win_lines() {
        $this->win_lines = [];
        for ($a = 0; $a < $this->grid_size; $a++) {
            $horizontal = []; 
            $vertical   = [];
            for ($b = 0; $b < $this->grid_size; $b++) {
                $horizontal[] = $this->grid_size * $a + $b;
                $vertical[]   = $this->grid_size * $b + $a;
            }
            $this->win_lines['Horizontal']['Row ' . ($a + 1)]  = $horizontal;
            $this->win_lines['Vertical']['Column ' . ($a + 1)] = $vertical;
            $this->win_lines['Diagonal']['backslash'][]        = $this->grid_size * $a + $a;
            $this->win_lines['Diagonal']['forward slash'][]    = $this->grid_size * ($a + 1) - ($a + 1);
        }
        if ($this->debug) {
            echo '<br /><table border = "2" style=" border-collapse: collapse">';
            echo '<caption>All Winning Line Combinations</caption>';
            echo '<thead><tr>';
            foreach ($this->win_lines as $line_type => $lines) {
                echo '<th>' . $line_type . '</th>';
            }
            echo '</tr></thead>'; 
            echo '<tr>'; 
            foreach ($this->win_lines as $line_type) {
                echo '<td><div style="padding:8px;">';
                foreach ($line_type as $line => $pos) {
                    echo $line . ': [' . implode(',', $pos) . ']<br />';
                }
                echo '</div></td>';
            }
            echo '</tr>'; 
            echo '</table>'; 
        }
    }
    function game_check() {
        $this->invalid_char = array_diff($this->position, $this->valid_char);
        if ($this->grid_size % 2 == 0 || $this->grid_size < 3 || $this->grid_size > 15) {
            $this->game_message('invalid-size');
        } else if (count($this->invalid_char, COUNT_RECURSIVE) > 0) {
            $this->game_message('invalid-character');
        } else if (strlen($this->board) <> pow($this->grid_size, 2)) {
            $this->game_message('invalid-board');
        } else if ($this->board == str_repeat('-', pow($this->grid_size, 2))) {
            $this->game_play(true);
            $this->game_message('new-game');
        } else if (substr_count($this->board, 'x') - substr_count($this->board, 'o') > 1) {
            $this->game_play(false);
            $this->game_message('too-many-x');
        } else if (substr_count($this->board, 'o') - substr_count($this->board, 'x') > 0) {
            $this->game_play(false);
            $this->game_message('too-many-o');
        } else if ($this->win_check('x')) {
            $this->game_file("win");
            $this->game_play(false);
            $this->game_message('x-win');
        } else if ($this->win_check('o')) {
            $this->game_file("lose");
            $this->game_play(false);
            $this->game_message('o-win');
        } else if (stristr($this->board, '-') === FALSE) {
            $this->game_file("tie");
            $this->game_play(false);
            $this->game_message('tie-game');
        } else {
            $this->pick_move();
            if ($this->win_check('o')) {
                $this->game_file("lose");
                $this->game_play(false);
                $this->game_message('o-win');
            } else {
                $this->game_play(true);
                $this->game_message('ongoing-game');
            }
        }
    }
    function game_play($link) {
        echo '<br />';
        if ($this->grid_size > 3) {
            echo 'NOTE: This is an <strong>advanced ' . ($this->grid_size) . 'x' . ($this->grid_size) . '</strong> game board.<br />';
            echo 'To be considered a winner, you must <strong>claim an entire line</strong> - that is, <strong>' . $this->grid_size . '</strong> in a line to win.<br />';
            echo '<i>Diagonals are considered from corner to corner, crossing the middle box.</i><br /><br />';
        }
        echo '<font face = "courier" size = "5">';
        echo '<table cols = "' . ($this->debug ? $this->grid_size + 2 : $this->grid_size) . '" border = "1" style = "font-weight:bold; border-collapse: collapse">';
        if ($this->debug) {
            echo '<thead><tr><th></th>';
            for ($col = 1; $col <= $this->grid_size; $col++) {
                echo '<th style="padding: 5px;"> Column ' . $col . '</th>';
            }
            echo '<th></th></tr></thead>';
            echo '<tfoot><tr><th></th>';
            for ($col = 1; $col <= $this->grid_size; $col++) {
                echo '<th> Column ' . $col . '</th>';
            }
            echo '<th></th></tr></tfoot>';
        }
        echo '<tbody><tr>';
        $row = 1;
        if ($this->debug) {
            echo '<th style="padding: 5px;">Row ' . $row . '</th>';
        }
        for ($pos = 0; $pos < pow($this->grid_size, 2); $pos++) {
            if ($link) {
                echo $this->show_cell($pos);
            } else {
                echo '<td style="text-align:center;' . (in_array($pos, $this->winning_line[0]) ? ' background-color: #90EE90;' : ' opacity: 0.5;' ) . '"><div style="padding: 1em;">' . $this->position[$pos] . ($this->debug ? ('<br /><span style="font-size:66%;">' . $pos . ':(' . $row . ',' . (($pos % $this->grid_size) + 1) . ')</span>') : '') . '</div></td>';
            }
            if (($pos + 1) % $this->grid_size == 0) {
                if ($this->debug) {
                    echo '<th style="padding: 5px;">Row ' . $row++ . '</th>';
                }
                if (($pos + 1) != pow($this->grid_size, 2)) {
                    echo '</tr><tr>';
                    if ($this->debug) {
                        echo '<th style="padding: 5px;">Row ' . $row . '</th>';
                    }
                }
            }
        }
        echo '</tr></tbody>';
        echo '</table>';
        echo '</font>';
    }
    function show_cell($which) {
        $token = $this->position[$which];
        if ($token <> '-') {
            $player_board = str_split($this->board);  
            return '<td style="text-align:center;' . ($token != $player_board[$which] ? ' background-color: #FFA500;' : '' ) . '"><div style="padding: 1em;">' . $token . ($this->debug ? ('<br /><span style="font-size:66%;">' . $which . ':(' . ((int) ($which / $this->grid_size) + 1) . ',' . (($which % $this->grid_size) + 1) . ')</span>') : '') . '</div></td>';
        }
        $this->newposition= $this->position;               
        $this->newposition[$which]= 'x';                           
        $move= implode($this->newposition);   
        $link= '?size=' . $this->grid_size . '&board=' . $move . ($this->debug ? '&debug' : '');                     
        return '<td style="text-align:center;"><a href = "' . $link . '" style = "text-decoration: none;"><div style="padding: 1em;">-' . ($this->debug ? ('<br /><span style="font-size:66%;">' . $which . ':(' . ((int) ($which / $this->grid_size) + 1) . ',' . (($which % $this->grid_size) + 1) . ')</span>') : '') . '</div></a></td>';
    }
    function pick_move() {
        echo ($this->debug ? '<br />> The AI is making its move...<br />' : '');
        $ai_win_move = $this->win_check('o');
        if ($ai_win_move != -1) {
            $this->position[$ai_win_move] = 'o';
        } else {
            $player_win_move = $this->win_check('x');
            if ($player_win_move != -1) {
                $this->position[$player_win_move] = 'o';
            } else {
                $board = implode($this->position);
                $move  = round((pow($this->grid_size, 2) / 2), PHP_ROUND_HALF_ODD);
                while (substr($board, $move, 1) != '-') {
                    $move = rand(0, (pow($this->grid_size, 2) - 1));
                }
                $new_board = substr_replace($board, 'o', $move, 1);

                $this->position = str_split($new_board);
            }
        }
    }
    function win_check($token) {
        if ($this->debug && debug_backtrace()[1]['function'] == 'game_check') {
            echo '<br />> Check function called from Game for token ' . $token . '...<br />';
        }
        $this->winning_line = []; 
        foreach ($this->win_lines as $line_type => $lines) {
            foreach ($lines as $line_name => $line) {
                $this->winning_line[0] = $line; 
                $check_value           = 0;     
                $win_move              = 0;     
                foreach ($line as $pos) {
                    if ($this->debug && debug_backtrace()[1]['function'] == 'game_check') {
                        echo 'Checking for token ' . $token . ' in ' . $line_type . ' ' . $line_name . ' [' . implode(',', $line) . ']';
                    }
                    if ($this->position[$pos] != $token) {
                        if (debug_backtrace()[1]['function'] == 'game_check') {

                            if ($this->debug) {
                                echo ' - Position ' . $pos . '.  Result:  Not Found.  Skipping rest of ' . $line_name . '<br />';
                            }
                            break;
                        } else if (debug_backtrace()[1]['function'] == 'pick_move') {
                            $win_move = $pos;
                        }
                    } else {
                        if ($this->debug && debug_backtrace()[1]['function'] == 'game_check') {
                            echo ' - Position ' . $pos . '.  Result:  Found.<br />';
                        }
                        $check_value++;
                    }
                }

                if (debug_backtrace()[1]['function'] == 'pick_move') {
                    if ($check_value == ($this->grid_size - 1)) {
                        if ($this->position[$win_move] == '-') {
                            return $win_move;
                        }
                    }
                } else if (debug_backtrace()[1]['function'] == 'game_check') {
                    if ($check_value == $this->grid_size) {
                        if ($this->debug) {
                            echo 'We have a winner!<br />';
                        }
                        return true;
                    }
                }
            }
        }
        $this->winning_line = []; 
        if (debug_backtrace()[1]['function'] == 'game_check') {
            return false;
        } else if (debug_backtrace()[1]['function'] == 'pick_move') {
            return -1;
        } else {
            return null;
        }
    }
    function game_message($message) {
        $newGame = true; 
        switch ($message) {
            case 'invalid-size':
                echo 'Invalid Game Board Size.  The board must be an <strong>odd number</strong> starting at 3 and up to 15 (for performance reasons).<br />';
                echo 'Your proposed game board size was <strong>' . $this->grid_size . '</strong>.<br />';
                echo 'Either fix the game board size variable values in the URL or Start a new game by clicking on the button below.';
                break;
            case 'invalid-board':
                echo 'Invalid game board. As the game board size is set to ' . $this->grid_size . ' by ' . $this->grid_size . ', please ensure the variable "board" contains exactly ' . pow($this->grid_size, 2) . ' characters.<br />';
                echo 'There are currently <strong>' . strlen($this->board) . '</strong> characters on the game board.<br />';
                echo 'Either fix the game board variable values in the URL or Start a new game by clicking on the button below.';
                break;
            case 'invalid-character':
                echo 'Invalid character(s) found in the variable "board".  Valid characters are <strong>x</strong>, <strong>o</strong>, and <strong>-</strong> (dash).<br />';
                echo 'The invalid value(s) entered for the "board" variable are as follows: ' . implode(', ', $this->invalid_char) . '<br />';
                echo 'Either fix the game board variable values in the URL or Start a new game by clicking on the button below.';
                break;
                if ($this->grid_size > 3) {
                    echo '<a draggable="false" href="' . $_SERVER['PHP_SELF'] . '?size=' . ($this->grid_size - 2) . ($this->debug ? '&debug' : '') . '" style="display: inline-block; -webkit-appearance: button; -moz-appearance: button; appearance: button; text-decoration: none; color: initial; padding: 0.5em;">I can\'t take it - DECREASE the board size (to ' . ($this->grid_size - 2) . 'x' . ($this->grid_size - 2) . ')!' . ($this->debug ? ' - in DEBUG mode' : '') . '</a>';
                    echo '<br />';
                    echo '<a draggable="false" href="' . $_SERVER['PHP_SELF'] . ($this->debug ? '&debug' : '') . '" style="display: inline-block; -webkit-appearance: button; -moz-appearance: button; appearance: button; text-decoration: none; color: initial; padding: 0.5em;">Back to the basics - RESET to a normal 3x3 board!' . ($this->debug ? ' - in DEBUG mode' : '') . '</a>';
                    echo '<br />';
                }

                if (!$this->debug) {
                    $newGame = false; 
                }
                break;
            case 'too-many-x':
                echo 'ERROR DETECTED - There are too many Xs on the game board.  QUIT CHEATING!';
                break;
            case 'too-many-o':
                echo 'ERROR DETECTED - There are too many Os on the game board.<br />';
                echo 'Since my program logic does not allow me to cheat, you must have done something bad to the game board.';
                break;
            case 'x-win':
                echo '<strong>X is the winner of this game.  Congratulations.</strong>';
                break;
            case 'o-win':
                echo '<strong>O-AI is the winner of this game.  Care for a rematch?  You\'ll probably lose again...</strong>';
                break;
            case 'tie-game':
                echo '<strong>This game is TIED as there are no more moves left.  Nobody won, or lost.</strong>';
                break;
            default:
        }
        if ($newGame) {
            echo '<br /><br /><a draggable="false" href="' . $_SERVER['PHP_SELF'] . '?size=' . $this->grid_size . '" style="-webkit-appearance: button; -moz-appearance: button; appearance: button; text-decoration: none; color: initial; padding: 0.5em;">Click here to start a new game' . ($this->debug ? ' (no debug info)' : '') . '!</a>';

            if ($this->debug) {
                echo '<br /><br /><a draggable="false" href="' . $_SERVER['PHP_SELF'] . '?size=' . $this->grid_size . '&debug" style="-webkit-appearance: button; -moz-appearance: button; appearance: button; text-decoration: none; color: initial; padding: 0.5em;">Click here to start a new game with debugging info!</a>';
            }
        }
        $this->game_stats();
    }
    function game_file($stat) {
        $file_name = date('Ymd_His') . "-" . substr(microtime(TRUE), -4) . "." . $stat;
        $dir_name  = "stats/" . $this->grid_size . "/";
        if (!is_dir($dir_name)) {
            mkdir($dir_name, 0750, true);
        }
        $file = fopen($dir_name . $file_name, 'w');
        $txt  = microtime(TRUE) . "," . $_SERVER['REMOTE_ADDR'] . "," . $this->grid_size . "," . $this->board;
        fwrite($file, $txt);
        fclose($file);

        if ($this->debug) {
            echo "<br /><br /> Stat for this game written to file: " . $file_name;
        }
    }
    function game_stats() {
        $wins  = count(glob("stats/" . $this->grid_size . "/*.win"));
        $loses = count(glob("stats/" . $this->grid_size . "/*.lose"));
        $games = count(glob("stats/" . $this->grid_size . "/*.*"));

        echo "<br /><br /><br />";

        if ($games > 0) {
            $winP  = ((double) $wins / (double) $games) * 100;
            $loseP = ((double) $loses / (double) $games) * 100;
            echo "Total Player (X) Wins: <strong>" . $wins . "</strong><br />";
            echo "Total AI (O) Wins / Player Defeats: <strong>" . $loses . "</strong><br />";
        } 
    }

}

?>

#!/usr/bin/php
<?php
require_once('./rmq/path.inc');
require_once('./rmq/get_host_info.inc');
require_once('./rmq/rabbitMQLib.inc');

function queryDatabase($request)
{
	echo "check for hitting db function\n";
	$client = new rabbitMQClient("./rmq/localtoDB.ini", "testServer");
	echo "initializing RMQ client\n";
	$validate = $request;
	echo "sending retrieved message to db server unbothered\n";
	$response = $client->send_request($validate);
	echo "sending response back to client...\n" . var_dump($response);
	return $response;
}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['player']))
  {
    return "ERROR: No username provided";
  }
  switch ($request['function'])
  {
		case "select":
			return queryDatabase($request);
	}
	echo "couldn't get message";
	return "couldn't get message";
}
function checkconnection(){
			$server1 = new rabbitMQServer("./rmq/local.ini","testServer");
			echo "Server 1 Starting" . PHP_EOL;
			$server1->process_requests('requestProcessor');
		}
	

	
checkconnection();

?>



