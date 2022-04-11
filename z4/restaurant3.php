<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<?php
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, "https://www.nasehospoda.sk/denne-menu");

//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$output = curl_exec($ch);

// close curl resource to free up system resources
curl_close($ch);

$dom = new DOMDocument();

@$dom->loadHTML($output);
$dom->preserveWhiteSpace = false;
$tables = $dom->getElementsByTagName('table');


$rows = $tables->item(0)->getElementsByTagName('tr');

echo "<pre>";
var_dump($rows->item(0));
echo "</pre>";
/*


$index = 0;
$dayCount = 0;

$foods = [];
$foodCount = $rows->item(0)->getElementsByTagName('th')->item(0)->getAttribute('rowspan');

foreach ($rows as $row) {

if($row->getElementsByTagName('th')->item(0)){
$foodCount = $row->getElementsByTagName('th')->item(0)->getAttribute('rowspan');

$day = trim($rows->item($index)->getElementsByTagName('th')->item(0)->getElementsByTagName('strong')->item(0)->nodeValue);

$th = $rows->item($index)->getElementsByTagName('th')->item(0);

foreach($th->childNodes as $node)
if(!($node instanceof \DomText))
$node->parentNode->removeChild($node);

$date = trim($rows->item($index)->getElementsByTagName('th')->item(0)->nodeValue);


array_push($foods, ["date" => $date, "day" => $day, "menu" => []]);

for($i = $index; $i <  $index + intval($foodCount); $i++)
{
if($foods[$dayCount])
array_push($foods[$dayCount]["menu"], trim($rows->item($i)->getElementsByTagName('td')->item(1)->nodeValue));
}
$index += intval($foodCount);
$dayCount++;
}

}

$data = ["timestamp" => (new DateTime())->getTimestamp(), "data" => $foods];



$fp = fopen('./storage/restaurant1.json', 'w');
fwrite($fp, json_encode($data));
fclose($fp);


echo "<pre>";
var_dump($foods);
echo "</pre>";
*/