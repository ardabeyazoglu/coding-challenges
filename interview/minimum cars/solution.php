<?php

function test($P, $S, $expected) {
	$cars = [];
	foreach ($S as $key => $seats) {
		$cars[$key] = [
			"seats" => $seats,
			"people" => $P[$key]
		];
	}
	usort($cars, function($a, $b){
		return $b["seats"] - $a["seats"];
	});
	
	$lastIndex = 0;
	$totalEmpty = 0;
	
	foreach ($cars as $k => $c) {
		$people = $c["people"];
		$emptySeats = $c["seats"] - $c["people"];
		
		if ($totalEmpty > 0) {
			for ($i=$lastIndex; $i<$k; $i++) {
				$prevCar = $cars[$i];
				$prevEmptySeats = $prevCar["seats"] - $prevCar["people"];
				
				if ($people == 0) {
					$lastIndex = $i;
					$totalEmpty += $emptySeats;
					break;
				}
				
				if ($prevEmptySeats > 0) {
                    $move = min($prevEmptySeats, $people);
					$cars[$i]["people"] += $move;
					$people -= $move;
				} else {
					$lastIndex = $i;
				}
			}
			
			$cars[$k]["people"] = $people;
		}
		
		$totalEmpty += $emptySeats;
	}
	
	$result = 0;
	foreach ($cars as $c) {
		if ($c["people"] > 0) {
			$result++;
		}
	}
	
	$args = func_get_args();
	array_pop($args);
	echo "testing " . json_encode($args) . " : ";
	if ($result == $expected) {
		echo "success!" . PHP_EOL;
	} else {
		echo "failed! must be $expected, found $result" . PHP_EOL;
	}
}

test([1,4,1], [1,5,1], 2);
test([4,4,2,4], [5,5,2,5], 3);
test([2,3,4,2], [2,5,7,2], 2);