# Base Convert [2..64]
[![Build Status](https://travis-ci.org/ArtBIT/base_convert.svg?branch=master)](https://travis-ci.org/ArtBIT/base_convert) [![GitHub license](https://img.shields.io/github/license/ArtBIT/base_convert.svg)](https://github.com/ArtBIT/base_convert) [![GitHub stars](https://img.shields.io/github/stars/ArtBIT/base_convert.svg)](https://github.com/ArtBIT/base_convert)  [![awesomeness](https://img.shields.io/badge/awesomeness-maximum-red.svg)](https://github.com/ArtBIT/base_convert)

PHP's built in `base_convert` function supports bases ranging from 2 to 36. This library expands that range to 2 to 64.

# Usage
Convert a number 100 from decimal to hexadecimal:
```php
echo math\base_convert(100, 10, 16); 
// echoes '64'
```
...and back:
```php
echo math\base_convert(64, 16, 10); 
// echoes '100'
```

## Custom alphabets
Instead of integer bases, you can pass in the alphabet string to use for conversion (since integer bases are converted to alphabet strings anyways, i.e. hexadecimal alphabet is simply "0123456789abcdef").

Here we convert from base 10 to alphabet 'customizable'
```php
echo math\base_convert(1234567890, 10, 'customizable');
// echoes 'slmmmmcui'
```

Here we convert from alphabet 'customizable' to alphabet 'isogram'
```php
echo math\base_convert('slmmmmcui', 'customizable', 'isogram');
// echoes 'rorsirrioig'
```

And from alphabet 'isogram' back to base 10
```php
echo math\base_convert('rorsirrioig', 'isogram', 10);
// echoes '1234567890'
```
*NOTE:* All alphabets must be [isograms](https://en.wikipedia.org/wiki/Isogram)

# License

[MIT](/ArtBIT/base_convert/blob/master/LICENSE.md)
