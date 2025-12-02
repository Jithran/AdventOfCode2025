<?php
include '../helper.php';
$input = inpread();

echo '<pre>';


echo devider(1);

$dail = 50;
$ans = 0;

foreach($input AS $val) {
	$dir = substr($val, 0,1);
	$turns = intval(substr($val, 1));
	
	//echo $dail . "\t\t";
	
	switch($dir){
		case 'R':
			$dail += $turns;
		break;
		case 'L':
			$dail -= $turns;
		break;
	}
	if($dail % 100 == 0) {
		$ans++;
	}
	//echo $dir . '-' .  "\t" .$turns . ' == ' . "\t" .  $dail.PHP_EOL;

}


echo $ans;


echo devider(2);


$dail = 50;
$ans = 0;
foreach($input AS $val) {
    $dir = substr($val, 0,1);
    $turns = intval(substr($val, 1));
    
    //echo 'Begin dail: ' . $dail . " - Turn " . $dir . $turns . "\r\n";

    // see the dail as a circle from 0 to 99, but count every time we cross 0
    switch($dir){
        case 'R':
            for($i = 0; $i < $turns; $i++) {
                $dail++;
                if($dail >= 100) {
                    $dail = 0;
                }
                //echo "\t".'Current dail: ' . $dail . " - Current ans: " . $ans . "\r\n";
                if($dail == 0) {
                    $ans++;
                }
            }
        break;
        case 'L':
            for($i = 0; $i < $turns; $i++) {
                $dail--;
                if($dail < 0) {
                    $dail = 99;
                }
                //echo "\t".'Current dail: ' . $dail . " - Current ans: " . $ans . "\r\n";
                if($dail == 0) {
                    $ans++;
                }
            }
        break;
    }

    //echo $ans . "\r\n";

}

echo 'Total times crossed 0: ' . $ans . PHP_EOL;
