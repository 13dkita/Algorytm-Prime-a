<html>
<body background = "backe.png">
 <style>

  body {
  font-size: x-large;
  padding-top: 60px;
  padding-left: 100px;
  color: black;
  }

</style>
<?php

   function multiexplode ($delimiters,$string) 
    {
	$ready = str_replace($delimiters, $delimiters[0], $string);
	$launch = explode($delimiters[0], $ready);
	return  $launch;
    }

    function minKey($key,$mstSet, $V)
    {

        $min = PHP_INT_MAX;
         $min_index = -1;

        for ($v = 0; $v < $V; $v++)
            if ($mstSet[$v] == False && $key[$v] < $min)
            {
                $min =$key[$v];
                $min_index = $v;
            }

        return $min_index;
    }

    function printMST($parent, $graph, $V)
    {
        echo("Edge \tWeight");
        echo("<br>");
        for ($i = 1; $i < $V; $i++)
        {
            echo($parent[$i]." - ".$i."\t".$graph[$i][$parent[$i]]);
            echo("<br>");
        }
            
    }

    function primMST($graph, $V)
    {
        for ($i = 0; $i < $V; $i++)
        {
            $key[$i] = PHP_INT_MAX;
            $mstSet[$i] = False;
        }
        $key[0] = 0;
        $parent[0] = -1;


        for ($count = 0; $count < $V - 1; $count++)
        {

            $u = minKey($key, $mstSet, $V);

            $mstSet[$u] = True;

            for ($v = 0; $v < $V; $v++)

                if ($graph[$u][$v] != 0 && $mstSet[$v] == False
                    && $graph[$u][$v] < $key[$v])
                {
                    $parent[$v] = $u;
                    $key[$v] = $graph[$u][$v];
                }
        }

       
        printMST($parent, $graph, $V);
    }
        $graf= array(
        array(0,5,6,4,0,0),
        array(5,0,1,2,0,0),
        array(6,1,0,2,5,3),
        array(4,2,2,0,0,4),
        array(0,0,5,0,0,4),
        array(0,0,3,4,4,0)
    );

  $x = $_POST['matrix'];
  $podz = multiexplode(array(","," ","\n","  "),$x);
  $st = sqrt(sizeof($podz));    
  echo "liczba wierzchołków oraz rozmiar macierzy to: ";
  echo($st);
  echo("<br>");
  $skunowatygraf420= array();
  $dodawator3000 = 0;
  echo("<br>");
  for ($x = 0; $x < $st; $x++)
  {
        $myArray = array();
	for ($v = 0+$dodawator3000; $v < $st+$dodawator3000; $v++)
	{
		array_push($myArray, $podz[$v]);
	}
	array_push($skunowatygraf420, $myArray);
	$dodawator3000 = $dodawator3000 + $st;
  }

  echo "macierz:";  
  echo("<br>");
  for ($z = 0; $z < $st; $z++)
  {
	   for ($q = 0; $q < $st; $q++)
	     {
		      echo($skunowatygraf420[$z][$q]); 
			echo "\n";
	     }
   echo("<br>");
  }
  echo("<br>");
   primMST($skunowatygraf420,$_POST['ilew']);

?>
</body>
</html>