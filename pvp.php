<? include('control.php'); // vlož funkce pro kontrolu výhry ?>
<html>
	<head>
		<title>gomoku</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="main">
			<div id="arena">
				<?
				session_start();
				//session_register('arena');
				//session_register('player');					
				
				define('SIZE', 15);
				define('SN', 's');
				define('SO', 'o');
				define('SX', 'x');
				define('WL', 5);
				
				function show($arena)
				{
					for ($y=0; $y < SIZE; $y++)
					{
						for ($x=0; $x < SIZE; $x++)
							{
								if ($arena[$x][$y] == SO)
									echo '<img src="img/o.png">';
								elseif ($arena[$x][$y] == SX)
									echo '<img src="img/x.png">';
								else
									echo '<a href="?'.$SID.'&x='.$x.'&y='.$y.'"><img src="img/ .png"></a>';
							}
					}
				}
				
				if (isset ($_GET['game']) && $_GET['game'] == 0) // pokud je nová hra
				{
					$_SESSION['arena'] = Array();
					$_SESSION['player'] = Array();
				}
				
				if (!isset ($_SESSION['arena']) || $_SESSION['arena'] == Array()) // pokud aréna není nastavena
				{
					for ($y=0; $y < SIZE; $y++) // vymaže arénu
						for ($x=0; $x < SIZE; $x++)
							$arena[$x][$y] = SN;
							
					$_SESSION['arena'] = $arena;
					$_SESSION['player'] = SO;
				}
				else
				{
					$arena = $_SESSION['arena'];
					$x = $_GET['x'];
					$y = $_GET['y'];
					
					if ($arena[$x][$y] == SN)
					{
						($_SESSION['player'] == SO) ? $arena[$x][$y] = SX : $arena[$x][$y] = SO;
					
						$_SESSION['player'] = $arena[$x][$y];
						$_SESSION['arena'] = $arena;
					}
				}
				
				show($arena);
				
			?>
			</div>
			<div id="txt">
				<br><br>
				<a href="pvp.php?game=0"><div id="new_game"></div></a>
				<br>
				<a href="cimo.php?game=0"><div id="cimo"></div></a>
				<br>				
				<?				
				$score = control();
				if ($score == SO)
					echo '<img src="img/winner_o.png" alt="winner is o">';
				elseif ($score == SX)
					echo '<img src="img/winner_x.png" alt="winner is x">';
				elseif ($score == 'F')
					echo '<img src="img/full.png" alt="all boxes are full">';
				?>
			</div>
		</div>
	</body>
</html>
