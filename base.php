<?php

function addBigInt($s1, $s2) {
    $a1 = array_reverse(str_split($s1));
    $a2 = array_reverse(str_split($s2));
    $a3 = [];
    $len1 = count($a1);
    $len2 = count($a2);

    if ($len1 < $len2) { // 使a1是长的
        $tmp = $a1;
        $a1 = $a2;
        $a2 = $tmp;
        $len1 = $len2;
    }

    for ($i=0;$i<$len1;$i++) {
        $sum = (int)$a1[$i] + (int)$a2[$i] + (int)$a3[$i];
        if ($sum >= 10) {
            $a3[$i] = $sum - 10;
            $a3[$i+1] = 1;
        } else {
            $a3[$i] = $sum;
        }
    }

    $a3 = array_reverse($a3);
    $s3 = implode('', $a3);
    return $s3;
}