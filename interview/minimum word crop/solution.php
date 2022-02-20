<?php

function solution($A, $B, $K) {
    $first = null;
    for ($i = $A; $i <= $B; $i++) {
        if ($i % $K == 0) {
            $first = $i;
            break;
        }
    }

    $last = null;
    for ($i = $B; $i >= $A; $i--) {
        if ($i % $K == 0) {
            $last = $i;
            break;
        }
    }


    if ($first == $last) {
        return 1;
    }

    $count = (($last - $first) / $K) + 1;
    
    return $count;
}