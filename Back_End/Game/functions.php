<?php

session_start();
error_reporting(E_ERROR | E_PARSE);

function registerPlayers($playerX="", $playerO="") {
    $_SESSION['PLAYER_X_NAME'] = $playerX;
    $_SESSION['PLAYER_O_NAME'] = $playerO;
    setTurn('x');
    resetBoard();
    resetWins();
}

function resetBoard() {
    resetPlaysCount();

    for ( $i = 1; $i <= 9; $i++ ) {
        unset($_SESSION['CELL_' . $i]);
    }
}

function resetWins() {
    $_SESSION['PLAYER_X_WINS'] = 0;
    $_SESSION['PLAYER_O_WINS'] = 0;
}

function playsCount() {
    return $_SESSION['PLAYS'] ? $_SESSION['PLAYS'] : 0;
}

function addPlaysCount() {
    if (! $_SESSION['PLAYS']) {
        $_SESSION['PLAYS'] = 0;
    }

    $_SESSION['PLAYS']++;
}

function resetPlaysCount() {
    $_SESSION['PLAYS'] = 0;
}

function playerName($player='x') {
    return $_SESSION['PLAYER_' . strtoupper($player) . '_NAME'];

}

function playersRegistered() {
    return $_SESSION['PLAYER_X_NAME'] && $_SESSION['PLAYER_O_NAME'];
}

function setTurn($turn='x') {
    $_SESSION['TURN'] = $turn;
}

function getTurn() {
    return $_SESSION['TURN'] ? $_SESSION['TURN'] : 'x';
}

function markWin($player='x') {
    $_SESSION['PLAYER_' . strtoupper($player) . '_WINS']++;
}

function switchTurn() {
    switch (getTurn()) {
        case 'x':
            setTurn('o');
            break;
        default:
            setTurn('x');
            break;
    }
}

function currentPlayer() {
    return playerName(getTurn());
}

function play($cell='') {
    if (getCell($cell)) {
        return false;
    }

    $_SESSION['CELL_' . $cell] = getTurn();
    addPlaysCount();
    $win = playerPlayWin($cell);

    if (! $win) {
        switchTurn();
    }
    else {
        markWin(getTurn());
        resetBoard();
    }

    return $win;
}

function getCell($cell='') {
    return $_SESSION['CELL_' . $cell];
}

function playerPlayWin($cell=1) {
    if (playsCount() < 3) {
        return false;
    }

    $column = $cell % 3;
    if (! $column) {
        $column = 3;
    }

    $row = ceil($cell / 3);

    $player = getTurn();

    return isVerticalWin($column, $player) || isHorizontalWin($row, $player) || isDiagonalWin($player);
}

function isVerticalWin($column=1, $turn='x') {
    return getCell($column) == $turn &&
        getCell($column + 3) == $turn &&
        getCell($column + 6) == $turn;
}

function isHorizontalWin($row=1, $turn='x') {
    return getCell($row) == $turn &&
        getCell($row + 1) == $turn &&
        getCell($row + 2) == $turn;
}

function isDiagonalWin($turn='x') {
    $win = getCell(1) == $turn &&
        getCell(9) == $turn;

    if (! $win) {
        $win = getCell(3) == $turn &&
            getCell(7) == $turn;
    }

    return $win && getCell(5) == $turn;
}

function score($player='x') {
    $score = $_SESSION['PLAYER_' . strtoupper($player) . '_WINS'];
    return $score ? $score : 0;
}
#!/usr/bin/php
?>

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
  if(!isset($request['function2']))
  {
    return "ERROR: No username provided";
  }
  switch ($request['type'])
  {
		case "select2":
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

