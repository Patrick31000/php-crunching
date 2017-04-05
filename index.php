
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

echo "Le dictionnaire compte ".count($dico)." mots.<br><hr>";



$mots = [];
foreach($dico as $mot){
if(strlen($mot)==15){
array_push($mots, $mot);
}
}
echo "Il y a ".(count($mots))." mots de plus de 15 lettres. <br><hr>";


$lettre = "w";
$liste = [];
foreach($dico as $mot){
    if(strpos($mot, $lettre)) {
    array_push($liste, $mot);
}
}
echo count($liste)." mots contiennent la lettre W.<br><hr>";

$letter = "q";
$list = [];
foreach($dico as $mot){
    if(substr($mot, -1) == $letter) {
    array_push($list, $mot);
    }
}
echo count($list)." mots finissent par la lettre Q.<br><hr>";

$string = file_get_contents("films.json", FILE_USE_INCLUDE_PATH);
$brut = json_decode($string, true);
$top = $brut["feed"]["entry"];

echo "Le top 10 des films est :<br>";
for ($i=1; $i<=10; $i++) {
echo ($i+1)." ".$top[$i]['im:name']['label']."<br><hr>";
}

for ($i=0; $i<count($top); $i++){
if ($top[$i]['im:name']['label']=="Gravity"){
    echo "Le classement du film Gravity est: ".($i+1)."ème.<br><hr>";
}
}
 
for ($i=0; $i<count($top); $i++){
if ($top[$i]['im:name']['label']=="The LEGO Movie"){
    echo "Les réalisateurs du film 'The LEGO movie' sont: ".$top[$i]['im:artist']['label']."<br><hr>";
}
}




echo "Réalisateur du film 'The Lago movie' (exception): ";
try{
for ($i=0; $i<count($top); $i++){
if ($top[$i]['im:name']['label']=="The LAGO Movie"){
    throw new Exception("<br>Les réalisateurs du film 'The LAGO movie' sont: ".$top[$i]['im:artist']['label']."<br><hr>");
}
}
throw new Exception("Ce film n'existe pas !<br><hr>");
} catch (Exception $e){
    echo $e->getMessage();
}


for ($i=0; $i<count($top); $i++){
if($top[$i]['im:releaseDate']['label'] < "2000-01-01"){
$before2000 = count($top[$i]);
}
}
echo "Il y a ".$before2000." films sortis avant 2000.<br><hr>";


echo "Films sortis avant 1946 (exception): ";
try{
for ($i=0; $i<count($top); $i++){
if($top[$i]['im:releaseDate']['label'] < "1946-01-01"){
$before2000 = count($top[$i]);
throw new Exception ( "Il y a ".$before2000." films sortis avant 2000.<br><hr>");
}

}throw new Exception("Il n'y a pas de films sortis avant 1946 !<br><hr>");
} catch (Exception $e){
    echo $e->getMessage();
}


echo "Film le plus vieux: <br>";
$array = [];
for ($i=0; $i<count($top); $i++){   
    array_push($array, $top[$i]['im:releaseDate']['label']);
   
}
try{
 $vieux = min($array);
for ($i=0; $i<count($top); $i++){
 if ($top[$i]['im:releaseDate']['label']==$vieux){
    $vieuxfilm = $top[$i]['im:name']['label'];
throw new Exception(" Le film le plus ancien est: ".$vieuxfilm."<br><hr>");

 }
}
 throw new Exception ("Il n'y a pas de films dans ton array !<br><hr>");
} catch (Exception $e){
    echo $e->getMessage();
}



echo "Film le plus vieux (exception): <br>";
$array = [];
for ($i=0; $i<count($top); $i++){   
    array_push($array, $top[$i]['im:releaseDate']['label']);
   
}
try{
 $vieux = min($array);
for ($i=0; $i<count($top); $i++){
 if ($topvide[$i]['im:releaseDate']['label']==$vieux){
    $vieuxfilm = $topvide[$i]['im:name']['label'];
throw new Exception(" Le film le plus ancien est: ".$vieuxfilm."<br><hr>");

 }
 $topvide=[];
}
 throw new Exception ("Il n'y a pas de films dans ton array !<br><hr>");
} catch (Exception $e){
    echo $e->getMessage();
}

echo "Film le plus récent: <br>";
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
 echo "Le film le plus récent est: ".$recentfilm."<br><hr>";


echo "Film le plus récent (exception): <br>";
 $array2 = [];
for ($i=0; $i<count($top); $i++){   
    array_push($array2, $top[$i]['im:releaseDate']['label']);
   
}
try{
 $recent = max($array2);
for ($i=0; $i<count($top); $i++){
 if ($topvide[$i]['im:releaseDate']['label']==$recent){
    $recentfilm = $topvide[$i]['im:name']['label'];
 throw new Excpetion("<br>Le film le plus récent est: ".$recentfilm."<br><hr>");
 }
  $topvide=[];
 }
 throw new Exception ("Il n'y a pas de film le plus récent<br><hr>");
 } catch (Exception $e){
     echo $e->getMessage();
 }

echo "Catégorie la plus représentée: <br>";
$array = [];
for ($i=0; $i<count($top); $i++){   
    array_push($array, $top[$i]['category']['attributes']['label']);
}
$represented = array_count_values($array);
$mostrepresented = array_search(max($represented), $represented);

echo "<br>La catégorie la plus représentée est: ".$mostrepresented."<br><hr>";



$array = [];
for ($i=0; $i<count($top); $i++){   
    array_push($array, $top[$i]['im:artist']['label']);
}
$realisators = array_count_values($array);
$mostrealisators = array_search(max($realisators), $realisators);

echo "<br>Le réalisateur le plus représenté est: ".$mostrealisators."<br><hr>";



$array3 = [];
for ($i=1; $i<=10; $i++) {
    array_push($array3,$top[$i]['im:price']['attributes']['amount']);
}
    echo "<br>Le coût d'achat des films du Top 10 est de: ".array_sum($array3)."$<br><hr>";



    $array4 = [];
for ($i=1; $i<=10; $i++) {
    array_push($array4,$top[$i]['im:rentalPrice']['attributes']['amount']);
}
    echo "<br>Le coût de location des films du Top 10 est de: ".array_sum($array4)."$<br><hr>";

$array5 = [];
for ($i=0; $i<count($top); $i++){   
    array_push($array5, substr($top[$i]['im:releaseDate']['label'], 5,2));
}
$views = array_count_values($array5);
$views2 = ksort($views);
$mostviews = array_search(max($views), $views);

echo "<br>Le mois ayant le plus de sorties au cinéma est: ".$mostviews."<br><hr>";


// $array6 = [];
// for ($i=1; $i<=10; $i++) {
//     array_push($array6,$top[$i]['im:price']['attributes']['amount']);
//     asort($array6, SORT_NUMERIC);
// print_r(array_slice($array6, 0, 10, true));
// }


// print_r($top);








echo '<pre>';
  print_r($top);
  echo '</pre>';

?>
<!--<script src="js/index.js"></script>-->
</body>

</html>


