<?php

function idx(array $array, $key, $default = null)
{
    // isset() is a micro-optimization - it is fast but fails for null values.
    if (isset($array[$key])) {
        return $array[$key];
    }
    // Comparing $default is also a micro-optimization.
    if ($default === null || array_key_exists($key, $array)) {
        return null;
    }
    return $default;
}

function startsWith($haystack, $needle)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}
