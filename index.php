
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>title</title>

	<!--<link rel="stylesheet" type="text/css" href="css/style.css">-->
</head>


<body>
<?php
$string = file_get_contents("dictionnaire.txt", FILE_USE_INCLUDE_PATH);
$dico = explode("\n", $string);

echo "Le dictionnaire compte ".count($dico)." mots.<br>";

$mots = [];
foreach($dico as $mot){
if(strlen($mot)==15){
array_push($mots, $mot);
}
}
echo "Il y a ".(count($mots))." mots de plus de 15 lettres. <br>";


$lettre = "w";
$liste = [];
foreach($dico as $mot){
    if(strpos($mot, $lettre)) {
    array_push($liste, $mot);
}
}
echo count($liste)." mots contiennent la lettre W.<br>";

$letter = "q";
$list = [];
foreach($dico as $mot){
    if(substr($mot, -1) == $letter) {
    array_push($list, $mot);
    }
}
echo count($list)." mots finissent par la lettre Q.<br><br>";

$string = file_get_contents("films.json", FILE_USE_INCLUDE_PATH);
$brut = json_decode($string, true);
$top = $brut["feed"]["entry"];

echo "Le top 10 des films est :<br>";
for ($i=1; $i<=10; $i++) {
echo ($i+1)." ".$top[$i]['im:name']['label']."<br>";
}

for ($i=0; $i<count($top); $i++){
if ($top[$i]['im:name']['label']=="Gravity"){
    echo "<br>Le classement du film Gravity est: ".($i+1)."ème.<br>";
}
}
 
for ($i=0; $i<count($top); $i++){
if ($top[$i]['im:name']['label']=="The LEGO Movie"){
    echo "<br>Les réalisateurs du film 'The LEGO movie' sont: ".$top[$i]['im:artist']['label']."<br>";
}
}

for ($i=0; $i<count($top); $i++){
if($top[$i]['im:releaseDate']['label'] < "2000-01-01"){
$before2000 = count($top[$i]);
}
}
echo "<br>Il y a ".$before2000." films sortis avant 2000.<br>";



$array = [];
for ($i=0; $i<count($top); $i++){   
    array_push($array, $top[$i]['im:releaseDate']['label']);
   
}
 $vieux = min($array);
for ($i=0; $i<count($top); $i++){
 if ($top[$i]['im:releaseDate']['label']==$vieux){
    $vieuxfilm = $top[$i]['im:name']['label'];

 }
}
 echo "<br>Le film le plus ancien est: ".$vieuxfilm."<br>";


 $array2 = [];
for ($i=0; $i<count($top); $i++){   
    array_push($array2, $top[$i]['im:releaseDate']['label']);
   
}
 $recent = max($array2);
for ($i=0; $i<count($top); $i++){
 if ($top[$i]['im:releaseDate']['label']==$recent){
    $recentfilm = $top[$i]['im:name']['label'];

 }
}
 echo "<br>Le film le plus récent est: ".$recentfilm."<br>";

$array = [];
for ($i=0; $i<count($top); $i++){   
    array_push($array, $top[$i]['category']['attributes']['label']);
}
$represented = array_count_values($array);
$mostrepresented = array_search(max($represented), $represented);

echo "<br>La catégorie la plus représentée est: ".$mostrepresented."<br>";


$array = [];
for ($i=0; $i<count($top); $i++){   
    array_push($array, $top[$i]['im:artist']['label']);
}
$realisators = array_count_values($array);
$mostrealisators = array_search(max($realisators), $realisators);

echo "<br>Le réalisateur le plus représenté est: ".$mostrealisators."<br>";



$array3 = [];
for ($i=1; $i<=10; $i++) {
    array_push($array3,$top[$i]['im:price']['attributes']['amount']);
}
    echo "<br>Le coût d'achat des films du Top 10 est de: ".array_sum($array3)."$<br>";



    $array4 = [];
for ($i=1; $i<=10; $i++) {
    array_push($array4,$top[$i]['im:rentalPrice']['attributes']['amount']);
}
    echo "<br>Le coût de location des films du Top 10 est de: ".array_sum($array4)."$<br>";

$array5 = [];
for ($i=0; $i<count($top); $i++){   
    array_push($array5, substr($top[$i]['im:releaseDate']['label'], 5,2));
}
$views = array_count_values($array5);
$views2 = ksort($views);
$mostviews = array_search(max($views), $views);

echo "<br>Le mois ayant le plus de sorties au cinéma est: ".$mostviews."<br>";


$array6 = [];
for ($i=1; $i<=10; $i++) {
    array_push($array6,$top[$i]['im:price']['attributes']['amount']);
    asort($array6, SORT_NUMERIC);
print_r(array_slice($array6, 0, 10, true));
}


// print_r($top);








echo '<pre>';
  print_r($top);
  echo '</pre>';

?>
<!--<script src="js/index.js"></script>-->
</body>

</html>


