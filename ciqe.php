<?	
	// funkce na zobrazení hodnocení
	function body($points)
	{
		echo '<br>';
		echo '<table border="1">';
		for ($y=0; $y < SIZE; $y++)
		{
			echo '<tr>';
			for ($x=0; $x < SIZE; $x++)
				echo '<td>'.$points[$x][$y].'&nbsp;&nbsp;</td>';
			echo '</tr>';
		}
		echo '</table>';
		echo '<br>';
	}	
	
	
	
	// hodnotící funkce pro cima
	function pc($x, $y, $arena, $points, $sc, $sr, $cimo, $rival)
	{
		if     ($arena[$x][$y] == $sc)
		{
			$cimo++;
			$rival = 0;
		}
		elseif ($arena[$x][$y] == $sr)
		{
			$rival++;
			$cimo = 0;
		}
		elseif ($arena[$x][$y] == SN)
		{
			if ($cimo >= $rival)
			{
				if     ($cimo == 0) $points[$x][$y] += 0;
				elseif ($cimo == 1) $points[$x][$y] += 10;
				elseif ($cimo == 2) $points[$x][$y] += 20;
				elseif ($cimo == 3) $points[$x][$y] += 50;
				elseif ($cimo == 4) $points[$x][$y] += 1000;
			}
			else
			{
				if     ($rival == 0) $points[$x][$y] += 0;
				elseif ($rival == 1) $points[$x][$y] += 5;
				elseif ($rival == 2) $points[$x][$y] += 10;
				elseif ($rival == 3) $points[$x][$y] += 40;
				elseif ($rival == 4) $points[$x][$y] += 500;
			}
			$cimo = $rival = 0;
		}
				
		$pc_out['points'] = $points;
		$pc_out['rival'] = $rival;
		$pc_out['cimo'] = $cimo;
				
		return $pc_out;		
	}
	
	
	// hlavní funkce spouští cima
	function cimo($sc, $arena)
	{
		$cimo = $rival = 0;
		// vynuluj body
		for ($y=0; $y < SIZE; $y++)
			for ($x=0; $x < SIZE; $x++)
				$points[$x][$y] = 0;		
		
		// urči symbol pro soupeře				
		($sc == SX) ? $sr = SO : $sr = SX;

		
// hodnoccení políček
		// horizontílní směr z leva do prava
		for ($y=0; $y < SIZE; $y++)
			for ($x=$cimo=$rival=0; $x < SIZE; $x++)
			{
				$pc_out = pc($x, $y, $arena, $points, $sc, $sr, $cimo, $rival);
				$points = $pc_out['points'];
				$rival  = $pc_out['rival'];
				$cimo   = $pc_out['cimo'];
			}
			
		// horizontální směr z prava do leva
		for ($y=0; $y < SIZE; $y++)
			for ($x=SIZE-1, $cimo=$rival=0; $x >= 0; $x--)
			{
				$pc_out = pc($x, $y, $arena, $points, $sc, $sr, $cimo, $rival);
				$points = $pc_out['points'];
				$rival  = $pc_out['rival'];
				$cimo   = $pc_out['cimo'];
			}
			
		// vertikální směr z hora dolů
		for ($x=0; $x < SIZE; $x++)
			for ($y=$cimo=$rival=0; $y < SIZE; $y++)
			{
				$pc_out = pc($x, $y, $arena, $points, $sc, $sr, $cimo, $rival);
				$points = $pc_out['points'];
				$rival  = $pc_out['rival'];
				$cimo   = $pc_out['cimo'];
			}
			
		// vertikální směr z dola nahoru
		for ($x=0; $x < SIZE; $x++)
			for ($y=SIZE-1, $cimo=$rival=0; $y >= 0; $y--)
			{
				$pc_out = pc($x, $y, $arena, $points, $sc, $sr, $cimo, $rival);
				$points = $pc_out['points'];
				$rival  = $pc_out['rival'];
				$cimo   = $pc_out['cimo'];
			}
			
		// z leva do prava směrem dolů
		// 1. trojúhelník
		for ($Y=0; $Y < SIZE; $Y++)
			for ($y=$Y, $x=$cimo=$rival=0; $y < SIZE; $x++, $y++)
			{
				$pc_out = pc($x, $y, $arena, $points, $sc, $sr, $cimo, $rival);
				$points = $pc_out['points'];
				$rival  = $pc_out['rival'];
				$cimo   = $pc_out['cimo'];
			}
		// 2. trojúhelník
		for ($X=1; $X < SIZE; $X++)
			for ($x=$X, $y=$cimo=$rival=0; $x < SIZE; $x++, $y++)
			{
				$pc_out = pc($x, $y, $arena, $points, $sc, $sr, $cimo, $rival);
				$points = $pc_out['points'];
				$rival  = $pc_out['rival'];
				$cimo   = $pc_out['cimo'];
			}
			
		// zleva do prava směrem nahoru
		// 1. trojúhelník
		for ($X=SIZE-1; $X >= 0; $X--)
			for ($x=$X, $y=SIZE-1, $cimo=$rival=0; $y >= 0; $x--, $y--)
			{
				$pc_out = pc($x, $y, $arena, $points, $sc, $sr, $cimo, $rival);
				$points = $pc_out['points'];
				$rival  = $pc_out['rival'];
				$cimo   = $pc_out['cimo'];
			}			
		// 2. troujúhelník
		for ($Y=SIZE-1; $Y >= 0; $Y--)
			for ($y=$Y, $x=SIZE-1, $cimo=$rival=0; $y >= 0; $x--, $y--)
			{
				$pc_out = pc($x, $y, $arena, $points, $sc, $sr, $cimo, $rival);
				$points = $pc_out['points'];
				$rival  = $pc_out['rival'];
				$cimo   = $pc_out['cimo'];
			}
		
		// z prava do leva směrem dolů
		// 1. trojúhelník
		for ($X=SIZE-1; $X >= 0; $X--)
			for ($x=$X, $y=$cimo=$rival=0; $x >=0; $x--, $y++)
			{
				$pc_out = pc($x, $y, $arena, $points, $sc, $sr, $cimo, $rival);
				$points = $pc_out['points'];
				$rival  = $pc_out['rival'];
				$cimo   = $pc_out['cimo'];
			}
		// 2. trojúhelník
		for ($Y=1; $Y < SIZE; $Y++)
			for ($y=$Y, $x=SIZE-1, $cimo=$rival=0; $y < SIZE; $x--, $y++)
			{
				$pc_out = pc($x, $y, $arena, $points, $sc, $sr, $cimo, $rival);
				$points = $pc_out['points'];
				$rival  = $pc_out['rival'];
				$cimo   = $pc_out['cimo'];
			}
		// zprava do leva smrem nahoru
		// 1. troujúhelník
		for ($Y=SIZE-1; $Y >= 0; $Y--)
			for ($y=$Y, $x=$cimo=$rival=0; $y >= 0; $x++, $y--)
			{
				$pc_out = pc($x, $y, $arena, $points, $sc, $sr, $cimo, $rival);
				$points = $pc_out['points'];
				$rival  = $pc_out['rival'];
				$cimo   = $pc_out['cimo'];
			}	
		// 2. troujúhelník
		for ($X=0; $X < SIZE; $X++)
			for ($x=$X, $y=SIZE-1, $cimo=$rival=0; $x < SIZE; $x++, $y--)
			{
				$pc_out = pc($x, $y, $arena, $points, $sc, $sr, $cimo, $rival);
				$points = $pc_out['points'];
				$rival  = $pc_out['rival'];
				$cimo   = $pc_out['cimo'];
			}
			
		//body($points);
		
		// najdi políčko s nejlepším hodnocením
		for ($y=$X=$Y=$MAX=0; $y < SIZE; $y++)
			for ($x=0; $x < SIZE; $x++)
				if ($points[$x][$y] > $MAX)
				{
					$MAX = $points[$x][$y];
					$X = $x;
					$Y = $y;
				}
		$out['x'] = $X;
		$out['y'] = $Y;
		
		return $out;
	}
?>
