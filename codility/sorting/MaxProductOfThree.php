<?php

/*
A non-empty array A consisting of N integers is given. The product of triplet (P, Q, R) equates to A[P] * A[Q] * A[R] (0 ≤ P < Q < R < N).

For example, array A such that:

  A[0] = -3
  A[1] = 1
  A[2] = 2
  A[3] = -2
  A[4] = 5
  A[5] = 6
contains the following example triplets:

(0, 1, 2), product is −3 * 1 * 2 = −6
(1, 2, 4), product is 1 * 2 * 5 = 10
(2, 4, 5), product is 2 * 5 * 6 = 60
Your goal is to find the maximal product of any triplet.

Write a function:

function solution($A);

that, given a non-empty array A, returns the value of the maximal product of any triplet.

For example, given array A such that:

  A[0] = -3
  A[1] = 1
  A[2] = 2
  A[3] = -2
  A[4] = 5
  A[5] = 6
the function should return 60, as the product of triplet (2, 4, 5) is maximal.

Write an efficient algorithm for the following assumptions:

N is an integer within the range [3..100,000];
each element of array A is an integer within the range [−1,000..1,000].
*/

function solution($A) {
    $c = count($A);
    sort($A);
    if ($A[$c - 1] < 0) {
        // tüm sayılar < 0
        $result = $A[$c - 1] * $A[$c - 2] * $A[$c - 3];
    }
    else if ($A[$c - 2] < 0) {
        // sondan ikinci ve üçüncü sayı < 0
        $result1 = $A[0] * $A[1] * $A[$c - 1];
        $result2 = $A[$c - 1] * $A[$c - 2] * $A[$c - 3];
        $result = max($result1, $result2);
    }
    else if ($A[$c - 3] < 0) {
        // sadece sondan üçüncü sayı < 0
        $result = $A[0] * $A[1] * $A[$c - 1];
    }
    else {
        $result1 = $A[0] * $A[1] * $A[$c - 1];
        $result2 = $A[$c - 1] * $A[$c - 2] * $A[$c - 3];
        $result = max($result1, $result2);
    }

    return $result;
}
