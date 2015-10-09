# Base Convert [2..64]
PHP's built in `base_convert` function supports bases ranging from 2 to 36. This library expands that range to 2 to 64.

## Status 
[![Build Status](https://travis-ci.org/ArtBIT/base_convert.svg?branch=master)](https://travis-ci.org/ArtBIT/base_convert)

# Usage
Convert a number 100 from decimal to hexadecimal:
```php
echo lib_math_base_convert(100, 10, 16); 
// echoes '64'
```
...and back:
```php
echo lib_math_base_convert(64, 16, 10); 
// echoes '100'
```

## Custom alphabets
Instead of integer bases, you can pass in the alphabet string to use for conversion (since integer bases are converted to alphabet strings anyways).

Here we convert from base 10 to alphabet 'customizable'
```php
echo lib_math_base_convert(1234567890, 10, 'customizable');
// echoes 'slmmmmcui'
```

Here we convert from alphabet 'customizable' to alphabet 'isogram'
```php
echo lib_math_base_convert('slmmmmcui', 'customizable', 'isogram');
// echoes 'rorsirrioig'
```

And back to base 10
```php
echo lib_math_base_convert('rorsirrioig', 'isogram', 10);
// echoes '1234567890'
```
# License

MIT
