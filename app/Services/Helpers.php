<?php

namespace App\Services;

class Helpers
{

    /**
     * Generate a random string
     *
     * @param int $length Length of string
     * @return string Generated string
     */
    public static function generateRandomString($length = 6)
    {
        return bin2hex(openssl_random_pseudo_bytes($length));
    }
}