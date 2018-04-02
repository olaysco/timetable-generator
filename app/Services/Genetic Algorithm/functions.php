<?php

/**
 * Determine whether a given set of numbers are
 * consecutive
 */
function areConsecutive($numbers) {
    sort($numbers);

    $min = $numbers[0];
    $max = $numbers[count($numbers) - 1];

    for ($i = $min; $i <= $max; $i++) {
        if (!in_array($i, $numbers)) {
            return false;
        }
    }

    return true;
}