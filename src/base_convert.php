<?php
    
namespace math;

/**
 * Convert the number from one base to another.
 * PHP's `base_convert` only supports 2..36, and we need moar.
 * This library supports bases ranging from 2 to 64.
 *
 * @example
 * Convert a number 100 from decimal to hexadecimal:
 *   `echo lib_math_base_convert(100, 10, 16); // echoes '64'`
 * ...and back:
 *   `echo lib_math_base_convert(64, 16, 10); // echoes '100'`
 *
 * Instead of integer bases, you can pass in the alphabet string to use for 
 * conversion (since integer bases are expanded to alphabet strings anyways).
 *
 * Here we convert from base 10 to alphabet 'customizable'
 *   `echo lib_math_base_convert(1234567890, 10, 'customizable'); `
 *   // echoes 'slmmmmcui'
 *
 * Here we convert from alphabet 'customizable' to alphabet 'isogram'
 *   `echo lib_math_base_convert('slmmmmcui', 'customizable', 'isogram');`
 *   // echoes 'rorsirrioig'
 *
 * And back to base 10
 *   `echo lib_math_base_convert('rorsirrioig', 'isogram', 10);`
 *   // echoes '1234567890'
 * 
 * @param mixed $value
 * @param mixed $from_base int or isogram
 * @param mixed $to_base int or isogram
 */
function base_convert($value, $from_base, $to_base) {
    if (is_integer($from_base)) {
        if ($from_base < 37) {
            $value = strtoupper($value);
        }
        $from_base = get_alphabet_for_base($from_base);
    }
    if (is_integer($to_base)) {
        $to_base = get_alphabet_for_base($to_base);
    }
    return base_convert_alphabets($value, $from_base, $to_base);
}

function get_alphabet_for_base($base) {
    return substr('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@_', 0, (int)$base);
}

/**
 * Convert a decimal value to a value in base 2..64
 * (PHP base_convert only supports 2..36)
 *
 * @param integer value to convert
 * @param string a string of characters used as a base for $value
 * @param string a string of characters used as a resulting base
 */
function base_convert_alphabets($value, $from_alphabet, $to_alphabet) {
    if ($from_alphabet == $to_alphabet) {
        return $value;
    }

    $base10_alphabet = '0123456789';

    // from non base10 to base10
    if ($to_alphabet == $base10_alphabet) {
        $digits = str_split($value, 1);
        $from_base_chars = str_split($from_alphabet, 1);
        $from_len = strlen($from_alphabet);
        $value_len = strlen($value);
        $result = 0;
        for ($i = 1; $i <= $value_len; $i++) {
            $result = bcadd($result, bcmul(array_search($digits[$i-1], $from_base_chars), bcpow($from_len, $value_len-$i)));
        }
        return $result;
    }

    // convert value to base10
    if ($from_alphabet == $base10_alphabet) {
        $base10_value = $value;
    } else {
        $base10_value = base_convert_alphabets($value, $from_alphabet, $base10_alphabet);
    }

    $to_base_chars = str_split($to_alphabet, 1);
    if ($base10_value < strlen($to_alphabet)) {
        return $to_base_chars[$base10_value];
    }

    $to_len = strlen($to_alphabet);
    $result = '';
    while ($base10_value != '0') {
        $result = $to_base_chars[bcmod($base10_value, $to_len)] . $result;
        $base10_value = bcdiv($base10_value, $to_len, 0);
    }

    return $result;
}
