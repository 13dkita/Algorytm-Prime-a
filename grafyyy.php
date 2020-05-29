<html>
<body background = "backe.png">
 <style>

  body {
  font-size: x-large;
  padding-top: 60px;
  padding-left: 100px;
  color: black;
  }

  #container {
   width: 50%;
   height: 300px;
   margin-top: 20px;
   float: left;
 }

 #output {
   width:20%;
   float:left;
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
        echo("Krawędzi \t Wagi");
        echo("<br>");
        for ($i = 1; $i < $V; $i++)
        {
            echo($parent[$i]." - ".$i." ".$graph[$i][$parent[$i]]);
            echo("<br>");
        }

    }

    function getWeights($parent, $graph, $V)
    {
      $weights[0] = -1;
      for ($i=1; $i < $V; $i++) {
        $weights[$i] = (int)$graph[$i][$parent[$i]];
      }
      return $weights;
    }

    function writeArray($arr)
    {
      for ($i=0; $i < sizeof($arr); $i++) {
        echo $arr[$i];
        echo("\t");
      }
      echo "<br>";
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
        return $parent;
    }
        $graf= array(
        array(0,5,6,4,0,0),
        array(5,0,1,2,0,0),
        array(6,1,0,2,5,3),
        array(4,2,2,0,0,4),
        array(0,0,5,0,0,4),
        array(0,0,3,4,4,0)
    );

  //pobieranie macierzy 
  $x = $_POST['matrix'];

  //zabezpieczenia 
  //przed wprowadzeniem przecinka na poczatku macierzy
  
  if($x[strlen($x)-1]==',')
	{exit("źle podana macierz - na końcu macierzy musi być liczba nie przecinek");}

  //przed wprowadzeniem przecinka na koncu macierzy
  if($x[0]==',')
	{exit("źle podana macierz - na początku macierzy musi być liczba nie przecinek");} 

  //przed wprowadzeniem przecinka po enterze i entera po przecinku( przecinek nie może
  //stać na końcu ani na początku wiersza.
  for($it = 0; $it < strlen($x) - 1;$it++)
  {
	if(ord($x[$it])==44 && ord($x[$it+1])==13)
	{exit("źle podana macierz - przecinek na końcu wiersza musi zostać usunięty");}

	if(ord($x[$it])==10 && ord($x[$it+1])==44)
	{exit("źle podana macierz - przecinek na początku wiersza musi zostać usunięty");}

  }



  //funkcja dzieli stringa tak aby zostały same cyferki 
  $podz = multiexplode(array(","," ","\n","  "),$x);
  
  //pierwiastkuje ilość wyrazów w macierzy i dostaje jej szerkoość i długość
  $st = sqrt(sizeof($podz));
  echo "<div id='output'>";
  echo "liczba wierzchołków oraz rozmiar macierzy to: ";
  echo($st);
  echo("<br>");

  $skunowatygraf420= array();
  $dodawator3000 = 0;

  echo("<br>");

  //dodawanie wyrazów do macierzy 
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

  //wypisywanie macierzy (można usunąć)
  for ($z = 0; $z < $st; $z++)
  {
	   for ($q = 0; $q < $st; $q++)
	     {
		      echo($skunowatygraf420[$z][$q]);
			echo "\n";
	     }
          echo("<br>");
  }

  // zabezpieczenie przed wprowadzeniem macierzy ze złymi liczbami
  for ($z = 0; $z < $st; $z++)
  {
	 for ($q = 0; $q < $st; $q++)
	 {
		if((float)$skunowatygraf420[$z][$q]!=(float)$skunowatygraf420[$q][$z])
	   	{
			exit("Twoja macierz nie jest macierzą sąsiedztwa grafu nieskierowanego spójnego");
		}

	 }
  }


  echo("<br>");
  $parent =  primMST($skunowatygraf420,$_POST['ilew']);
  echo "</div>";
  $weights = getWeights($parent, $skunowatygraf420, $_POST['ilew']);
  $V = $_POST['ilew'];


?>

<div id="container"></div>
<script src="./build/sigma.min.js"></script>
<script src="./build/plugins/sigma.parsers.json.min.js"></script>
<script src="./build/plugins/sigma.renderers.edgeLabels.min.js"></script>
<script src="./build/plugins/sigma.layout.forceAtlas2.min.js"></script>
<script>

var s = new sigma(
  {
    renderer: {
      container: document.getElementById('container'),
      type: 'canvas'
    },
    settings: {
      defaultNodeColor: '#ec5148',
      drawLabels: true
    }
  }
  );



function randomInt(min, max) {
	return min + Math.floor((max - min) * Math.random());
}

function addNodesFromArray(arr){
  for (let index = 0; index < arr.length; index++) {
    var newNode = {id: "n"+index, label: "" + index, x: randomInt(0, arr.length), y: randomInt(0, arr.length), size: 3}
    s.graph.addNode(newNode)
  }
}

function addConnections(arr, weight){
  for (let index = 1; index < arr.length; index++) {
    var newConnection = {id: "e"+index, label: ""+weight[index], source: "n"+index, target: "n"+arr[index]}
    s.graph.addEdge(newConnection)
  }
}

var tmpParent = <?php echo json_encode($parent); ?>;
var tmpWeight = <?php echo json_encode($weights); ?>;
var howManyNodes = <?php echo $V ?>;

var arr = [];
var weight = [];

for (let index = 0; index < howManyNodes; index++) {
  arr.push(tmpParent[index]);
}

for (let index = 0; index < howManyNodes; index++) {
  weight.push(tmpWeight[index])
}
console.log(arr);
console.log(tmpWeight);

addNodesFromArray(arr);
addConnections(arr,weight);
s.startForceAtlas2();
s.refresh();
setTimeout(function () {
s.stopForceAtlas2()
}, 100);
</script>

</body>
</html>
