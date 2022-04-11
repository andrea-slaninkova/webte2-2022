
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<?php
// Read the JSON file
$json = file_get_contents('./storage/restaurant2.json');

// Decode the JSON file
$json_data = json_decode($json,true);
var_dump($json_data['data']);

$jedla = $json_data['data'];
if($jedla){
    $interval = date_diff( DateTime::createFromFormat( 'U', $json_data['timestamp'] ), new DateTime());
    $timeDifference = (new DateTime())->getTimestamp() - $json_data['timestamp'];
// printing result in days format
    echo $interval->format('%r%h:%i:%s');
    echo "<br>";
    echo  $timeDifference;
}else{
    $timeDifference = 0;
}




if($timeDifference > 800 or $timeDifference == 0) {
    $ch = curl_init();

// set url
    curl_setopt($ch, CURLOPT_URL, "http://eatandmeet.sk/tyzdenne-menu");

//return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
    $output = curl_exec($ch);

// close curl resource to free up system resources
    curl_close($ch);

    $dom = new DOMDocument();

    @$dom->loadHTML($output);
    $dom->preserveWhiteSpace = false;

    $parseNodes = ["day-1", "day-2", "day-3", "day-4", "day-5", "day-6", "day-7"];

    $jedla = [
        ["date"  => date( 'd.m.Y', strtotime( 'monday this week' ) ), "day" => "Pondelok", "menu" => []],
        ["date"  => date( 'd.m.Y', strtotime( 'tuesday this week' ) ), "day" => "Utorok", "menu" => []],
        ["date"  => date( 'd.m.Y', strtotime( 'wednesday this week' ) ), "day" => "Streda", "menu" => []],
        ["date"  => date( 'd.m.Y', strtotime( 'thursday this week' ) ), "day" => "Štvrtok", "menu" => []],
        ["date"  => date( 'd.m.Y', strtotime( 'friday this week' ) ), "day" => "Piatok", "menu" => []],
        ["date"  => date( 'd.m.Y', strtotime( 'saturday this week' ) ), "day" => "Sobota", "menu" => []],
        ["date"  => date( 'd.m.Y', strtotime( 'sunday this week' ) ), "day" => "Nedeľa", "menu" => []],
    ];

    foreach ($parseNodes as $index => $nodeId) {

        $node = $dom->getElementById($nodeId);

        foreach ($node->childNodes as $menuItem)
        {
            if($menuItem && $menuItem->childNodes->item(1) && $menuItem->childNodes->item(1)->childNodes->item(3)){
                $nazov = trim($menuItem->childNodes->item(1)->childNodes->item(3)->childNodes->item(1)->childNodes->item(1)->nodeValue);
                $cena = trim($menuItem->childNodes->item(1)->childNodes->item(3)->childNodes->item(1)->childNodes->item(3)->nodeValue);
                $popis = trim($menuItem->childNodes->item(1)->childNodes->item(3)->childNodes->item(3)->nodeValue);
                array_push($jedla[$index]["menu"], "$nazov ($popis): $cena");
            }
        }
    }

    $data = ["timestamp" => (new DateTime())->getTimestamp(), "data" => $jedla];



    $fp = fopen('./storage/restaurant2.json', 'w');
    fwrite($fp, json_encode($data));
    fclose($fp);

}


echo "<pre>";
var_dump($jedla);
echo "</pre>";