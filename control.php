<?

// zjisti, zda-li už někdo vyhrál				
function is_winner($sumO, $sumX)
{
	if ($sumO == WL)
	{
		return SO;
	}
	if ($sumX == WL)
	{
		return SX;		
	}
	return FALSE;
}
// spustí kontrolu
function control()
{
	$arena = $_SESSION['arena'];
		
	// kontrola horizontálního směru				
	for ($y=0; $y < SIZE; $y++)
		for ($x=0, $sumO=$sumX=0; $x < SIZE; $x++)
		{
			if ($arena[$x][$y] == SO)
			{
				$sumO++;
				$sumX = 0;
			}
			elseif ($arena[$x][$y] == SX)
			{
				$sumX++;
				$sumO = 0;
			}
			else
				$sumO = $sumX = 0;
						
			// pokud je zjištěn výtěz, přestaň kontrolovat
			if (is_winner($sumO, $sumX) == SO)
				return SO;	
			elseif (is_winner($sumO, $sumX) == SX)
				return SX;	
		}
		
		// kontorla vertikálního směru
	for ($x=0; $x < SIZE; $x++)
		for ($y=0, $sumO=$sumX=0; $y < SIZE; $y++)
		{
			if ($arena[$x][$y] == SO)
			{
				$sumO++;
				$sumX = 0;
			}
			elseif ($arena[$x][$y] == SX)
			{
				$sumX++;
				$sumO = 0;
			}
			else
				$sumO = $sumX = 0;
							
			// pokud je zjištěn výtez, přestaň kontrolovat
			if (is_winner($sumO, $sumX) == SO)
				return SO;	
			elseif (is_winner($sumO, $sumX) == SX)
				return SX;	
	}
	
	// kontorla šikmo z leva do prava směrem dolů	
	// 1. trujúhelník
	for ($Y=0; $Y < SIZE; $Y++)
		for ($y=$Y, $x=$sumO=$sumX=0; $y < SIZE; $x++, $y++)
		{
			if ($arena[$x][$y] == SO)
			{
				$sumO++;
				$sumX = 0;
			}
			elseif ($arena[$x][$y] == SX)
			{
				$sumX++;
				$sumO = 0;
			}
			else
				$sumO = $sumX = 0;
							
			// pokud je zjištěn výtez, přestaň kontrolovat
			if (is_winner($sumO, $sumX) == SO)
				return SO;	
			elseif (is_winner($sumO, $sumX) == SX)
				return SX;	
		}
	// 2. trojúhelník
	for ($X=1; $X < SIZE; $X++)
		for ($x=$X, $y=$sumO=$sumX=0; $x < SIZE; $x++, $y++)
		{
			if ($arena[$x][$y] == SO)
			{
				$sumO++;
				$sumX = 0;
			}
			elseif ($arena[$x][$y] == SX)
			{
				$sumX++;
				$sumO = 0;
			}
			else
				$sumO = $sumX = 0;
							
			// pokud je zjištěn výtez, přestaň kontrolovat
			if (is_winner($sumO, $sumX) == SO)
				return SO;	
			elseif (is_winner($sumO, $sumX) == SX)
				return SX;	
		}
	
	// kontrola sikmo z prava do leva směrem dolů
	// 1. trojúhelník
	for ($X=SIZE-1; $X >= 0; $X--)
		for ($x=$X, $y=$sumO=$sumX=0; $y < SIZE; $x--, $y++)
		{
			if ($arena[$x][$y] == SO)
			{
				$sumO++;
				$sumX = 0;
			}
			elseif ($arena[$x][$y] == SX)
			{
				$sumX++;
				$sumO = 0;
			}
			else
				$sumO = $sumX = 0;
							
			// pokud je zjištěn výtez, přestaň kontrolovat
			if (is_winner($sumO, $sumX) == SO)
				return SO;	
			elseif (is_winner($sumO, $sumX) == SX)
				return SX;	
		}
	// 2. trojúhelník
	for ($Y=1; $Y < SIZE; $Y++)
		for ($y=$Y, $x=SIZE-1, $sumO=$sumX=0; $y < SIZE; $x--, $y++)
		{
			if ($arena[$x][$y] == SO)
			{
				$sumO++;
				$sumX = 0;
			}
			elseif ($arena[$x][$y] == SX)
			{
				$sumX++;
				$sumO = 0;
			}
			else
				$sumO = $sumX = 0;
						
			// pokud je zjištěn výtez, přestaň kontrolovat
			if (is_winner($sumO, $sumX) == SO)
				return SO;	
			elseif (is_winner($sumO, $sumX) == SX)
				return SX;	
		}
		
		
	// kontrola volného pole
	for ($y=$sum=0; $y < SIZE; $y++)
		for ($x=0; $x < SIZE; $x++)
			if ($arena[$x][$y] == SN) $sum++;
	if ($sum == 0)
		return 'F';
	
	return FALSE;
}
?>
