<?php

class Algorithm {

    /**
     * 字符串长整数相加 O(N)
     * @param string $s1 字符串1
     * @param string $s2 字符串2
     * @return string 相加的结果
     * @author Potato
     */
    public static function addBigInt($s1, $s2) {
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

    /**
     * 冒泡排序 O(n^2)
     * @param array $arr
     * @return array
     * @author Potato
     */
    public static function maoPaoSort($arr) {
        $len = count($arr);
        for ($i=0; $i<$len; $i++) {
            for ($j=0; $j<$len-$i-1; $j++) {
                if ($arr[$j] > $arr[$j+1]) {
                    $tmp = $arr[$j];
                    $arr[$j] = $arr[$j+1];
                    $arr[$j+1] = $tmp;
                }
            }
        }
        return $arr;
    }

    /**
     * 快速排序 O(n^2)
     * @param array $arr
     * @return array
     * @author Potato
     */
    public static function quickSort($arr) {
        $count = count($arr);
        if ($count < 2) {
            return $arr;
        }

        $aLeft = $aRight = [];
        $mid = $arr[0];
        for ($i=1; $i<$count; $i++) {
            if ($arr[$i] > $mid) {
                $aRight[] = $arr[$i];
            } else {
                $aLeft[] = $arr[$i];
            }
        }
        $aLeft = self::quickSort($aLeft);
        $aRight = self::quickSort($aRight);
        return array_merge($aLeft, [$mid], $aRight);
    }

    /**
     * 斐波那契数列 O(n^2)
     * @param int $n 第N位
     * @return int 值
     * @author Potato
     */
    public static function fibonq($n) {
        if ($n <= 0) {
            return 0;
        }
        if ($n <= 2) {
            return 1;
        }
        return self::fibonq($n-1) + self::fibonq($n-2);
    }

    /**
     * 斐波那契数列优化
     * @param int $n 第N位
     * @return int 值
     * @author Potato
     */
    public static function fibonq2($n, $a=1, $b=1) {
        if ($n <= 0) {
            return 0;
        }
        if ($n <= 1) {
            return $b;
        }
        return self::fibonq2($n-1, $b, $a+$b);
    }

    /**
     * 二分查找 O(logn)
     * @param array $arr 需要查找的有序数组数组
     * @param int $key
     * @return int key在数组中位置
     * @author Potato
     */
    public static function binarySearch($arr, $key) {
        $low = 1;
        $high = count($arr);

        while ($low <= $high) {
            $mid = intval(($low + $high) / 2);
            if ($key < $arr[$mid]) {
                $high = $mid - 1;
            } elseif ($key > $arr[$mid]) {
                $low = $mid + 1;
            } else {
                return $mid;
            }
        }

        return -1; // 不在数组
    }
}