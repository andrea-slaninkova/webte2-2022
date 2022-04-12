<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<?php
// Read the JSON file
$json = file_get_contents('./storage/restaurant3.json');

// Decode the JSON file
$json_data = json_decode($json,true);
//var_dump($json_data['data']);

$jedla3 = $json_data['data'];
if($jedla3){
    $interval = date_diff( DateTime::createFromFormat( 'U', $json_data['timestamp'] ), new DateTime());
    $timeDifference = (new DateTime())->getTimestamp() - $json_data['timestamp'];
// printing result in days format
    // echo $interval->format('%r%h:%i:%s');
    // echo "<br>";
    // echo  $timeDifference;
}else{
    $timeDifference = 0;
}




if($timeDifference > 800 or $timeDifference == 0) {
    $ch = curl_init();

// set url
    curl_setopt($ch, CURLOPT_URL, "www.freefood.sk/menu/");

//return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
    $output = curl_exec($ch);

// close curl resource to free up system resources
    curl_close($ch);

    $dom = new DOMDocument();

    @$dom->loadHTML($output);
    $dom->preserveWhiteSpace = false;

    $xpath = new DOMXPath($dom);
    $menucka = $xpath->query("//ul[contains(@class, 'daily-offer')]");
    $count = $menucka->length;

    echo $count;

//$zoznamy = $dom->getElementsByTagName('ul');

    $fyzika = $menucka[1];

    $jedla3 = [];
    $indexDen = 0;
    $index = 0;
    foreach($fyzika->childNodes as $den){

        if($den->nodeType == 1){

            $datum = explode(',', $den->firstChild->textContent);
            // echo $datum[0] . "--" . $datum[1];

            array_push($jedla3, ["date" => $datum[1], "day" => $datum[0], "menu" => []]);
            // var_dump($index,$jedla3);
            foreach($den->lastChild->childNodes as $jedlo){
                //echo $jedlo->textContent;
                array_push($jedla3[$index]["menu"], $jedlo->textContent);
                echo "<br>";
            }
            echo "<br><br>";
            $index++;
        }
    }

    $data = ["timestamp" => (new DateTime())->getTimestamp(), "data" => $jedla3];



    $fp = fopen('./storage/restaurant3.json', 'w');
    fwrite($fp, json_encode($data));
    fclose($fp);
}

//echo "<pre>";
//var_dump($foods);
//echo "</pre>";




//// Display data
//print_r($json_data);