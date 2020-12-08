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
     * 冒泡排序 O(n^2) 稳定 Bubble Sort
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
     * 鸡尾酒排序 (小到大 大到小) 冒泡排序的改进
     */
    public static function cocktailSort($arr) {
        $len = count($arr);
        $left = 0;
        $right = $len - 1;

        while ($left < $right) {
            for ($i=$left; $i<$right; $i++) {
                if ($arr[$i] > $arr[$i+1]) {
                    $tmp = $arr[$i];
                    $arr[$i] = $arr[$i+1];
                    $arr[$i+1] = $tmp;
                }
            }
            $right--;
            for ($j=$right; $j>$left; $j--) {
                if ($arr[$j-1] > $arr[$j]) {
                    $tmp = $arr[$j];
                    $arr[$j] = $arr[$j-1];
                    $arr[$j-1] = $tmp;
                }
            }
            $left++;
        }
        return $arr;
    }

    /**
     * 快速排序 O(nlogn) 不稳定
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
     * 选择排序 O(n^2) 不稳定
     */
    public static function selectSort($arr) {
        $len = count($arr);
        for($i=0; $i<$len-1; $i++) {
            $min = $i;
            for ($j=$i+1; $j<$len; $j++) {
                if ($arr[$j] < $arr[$min]) {
                    $min = $j;
                }
            }
            if ($min!=$i) {
                $tmp = $arr[$i];
                $arr[$i] = $arr[$min];
                $arr[$min] = $tmp;
            }
        }
        return $arr;
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

    /**
     * 插入排序 O(n^2) 稳定
     */
    public static function insertSort($arr) {
        for ($i=0; $i<count($arr); $i++) {
            $val = $arr[$i];
            $j = $i-1;
            while ($j>=0 && $arr[$j] > $val) {
                $arr[$j+1] = $arr[$j];
                $j--;
            }
            $arr[$j+1] = $val;
        }
        return $arr;
    }

    /**
     * 希尔排序 O(n^2) 不稳定
     */
    public static function shellSort($arr) {
        $len = count($arr);
        $h = 0;
        while($h <= $len) {
            $h = 3 * $h + 1;
        }

        while ($h >= 1) {
            for ($i=$h; $i<$len; $i++) {
                $j = $i - $h;
                $tmp = $arr[$i];
                while ($j >= 0 && $arr[$j] > $tmp) {
                    $arr[$j+$h] = $arr[$j];
                    $j = $j-$h;
                }
                $arr[$j+$h] = $tmp;
            }
            $h = ($h - 1)/3;
        }
        return $arr;
    }

    /**
     * 归并排序 O(nlogn)
     */
    public static function merge(&$arr, $left, $mid, $right) {
        $len = $right - $left + 1;
        $tmp = [];
        $index = 0;
        $i = $left;
        $j = $mid + 1;
        while ($i <= $mid && $j <= $right) {
            $tmp[$index++] = $arr[$i] <= $arr[$j] ? $arr[$i++] : $arr[$j++];
        }
        while ($i <= $mid) {
            $tmp[$index++] = $arr[$i++];
        }
        while ($j<=$right) {
            $tmp[$index++] = $arr[$j++];
        }
        for ($k=0;$k<$len; $k++) {
            $arr[$left++] = $tmp[$k];
        }
    }

    public static function mergeSortRecursion(&$arr, $left, $right) {
        if ($left === $right) {
            return;
        }
        $mid = (int)(($left + $right) / 2);
        self::mergeSortRecursion($arr, $left, $mid);
        self::mergeSortRecursion($arr, $mid + 1, $right);
        self::merge($arr, $left, $mid, $right);
        return $arr;
    }

    public static function mergeSortIteration($arr, $len) {
        for ($i=1; $i<$len; $i *= 2) {
            $left = 0;
            while ($left + $i < $len) {
                $mid = $left + $i - 1;
                $right = $mid + $i < $len ? $mid + $i : $len - 1;
                self::merge($arr, $left, $mid, $right);
                $left = $right + 1;
            }
        }
        return $arr;
    }

    /**
     * 堆排序 O(nlogn)
     */
    public static function heapify(&$arr, $i, $len) {
        $leftChild = 2 * $i + 1;
        $rightChild = 2 * $i + 2;
        $max = $i;
        if ($leftChild < $len && $arr[$leftChild] > $arr[$max]) {
            $max = $leftChild;
        }
        if ($rightChild < $len && $arr[$rightChild] > $arr[$max]) {
            $max = $rightChild;
        }
        if ($max != $i) {
            $tmp = $arr[$i];
            $arr[$i] = $arr[$max];
            $arr[$max] = $tmp;
            self::heapify($arr, $max, $len);
        }
    }

    public static function buildHeap(&$arr, $len) {
        $heapSize = $len;
        for ($i=(int)($heapSize/2 -1); $i >= 0; $i--) {
            self::heapify($arr, $i, $heapSize);
        }
        return $heapSize;
    }

    public static function heapSort($arr) {
        $len = count($arr);
        $heapSize = self::buildHeap($arr, $len);
        while ($heapSize > 1) {
            --$heapSize;
            $tmp = $arr[0];
            $arr[0] = $arr[$heapSize];
            $arr[$heapSize] = $tmp;
            self::heapify($arr, 0, $heapSize);
        }
        return $arr;
    }

}

print_r(Algorithm::heapSort([1,3,6,7,9,2,4,8,5]));