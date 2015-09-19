# PhpColor
## PHP color tooling
PhpColor is  a tiny, fast library for parsing and manipulating colors in PHP. It allows many form of inputs, while providing color conversions and other color utiliy functions.

## Installation
Simply add atailouloute/phpcolor to composer.json using dev-master.
```
composer require atailouloute/phpcolor dev-master
```

## Usage
### Simple colors
```php
$color = new Color('red');     // => #ff0000
$color = new Color('black');   // => #000000
$color = new Color('white');   // => #ffffff
```

### HEX colors
```php
$color = new Color('#aaaaaa'); // => #aaaaaa
$color = new Color('ababab');  // => #ababab
$color = new Color('ffb');     // => #ffffbb
$color = new Color('#ab9');    // => #aabb99
```

## Methods

### getBrightness
Return the brightness of the color.
```php
$color = new Color('white');
echo $color->getBrightness(); // 255

$color = new Color('black');
echo $color->getBrightness(); // 0
```

### getLuminance
Return the relative luminance of the color (from 0-1).
```php
$color = new Color('white');
echo $color->getLuminance(); // 1

$color = new Color('black');
echo $color->getLuminance(); // 0
```

### isLight
Return a boolean indicating whether the color's perceived brightness is light.
```php
$color = new Color('white');
$color->isLight(); // true

$color = new Color('black');
$color->isLight(); // false
```

### isDark
Return a boolean indicating whether the color's perceived brightness is dark.
```php
$color = new Color('white');
$color->isDark(); // false

$color = new Color('black');
$color->isDark(); // true
```

## String Representations

### toHex
```php
$color = new Color('red');
$color->toHex(); // ff0000
```

### toHexString
```php
$color = new Color('red');
$color->toHex(); // #ff0000
```