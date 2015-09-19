<?php

/**
 * Class Color.
 *
 * @author Ahmed Tailouloute <ahmed.tailouloute@gmail.com>
 */

namespace PhpColor;

class Color
{
    /**
     * @var string
     */
    protected $color;

    /**
     * @var array
     */
    protected $rgb;

    /**
     * @param $color string
     *
     * @throws InvalidColorFormatException
     */
    public function __construct($color)
    {
        $parsedColor = self::parseAndValidate($color);
        $this->color = $parsedColor['color'];
        $this->rgb   = self::hexToRgb($this->color);
    }

    /**
     * Return the brightness of the color
     *
     * @return float
     */
    public function getBrightness()
    {
        $rgb = $this->rgb;
        $r = $rgb['R'];
        $g = $rgb['G'];
        $b = $rgb['B'];

        return ($r * 299 + $g * 587 + $b * 114) / 1000;
    }

    /**
     * Return the relative luminance of the color.
     *
     * @return float
     */
    public function getLuminance()
    {
        $rgb = $this->rgb;
        $RsRGB = $rgb['R'] / 255;
        $GsRGB = $rgb['G'] / 255;
        $BsRGB = $rgb['B'] / 255;

        $R = ($RsRGB <= 0.03928) ? $RsRGB / 12.92 : pow((($RsRGB + 0.055) / 1.055), 2.4);
        $G = ($GsRGB <= 0.03928) ? $GsRGB / 12.92 : pow((($GsRGB + 0.055) / 1.055), 2.4);
        $B = ($BsRGB <= 0.03928) ? $BsRGB / 12.92 : pow((($BsRGB + 0.055) / 1.055), 2.4);

        return 0.2126 * $R + 0.7152 * $G + 0.0722 * $B;
    }

    /**
     * @return bool
     */
    public function isLight()
    {
        return $this->getBrightness() > 130;
    }

    /**
     * @return bool
     */
    public function isDark()
    {
        return !$this->isLight();
    }

    /**
     * @return string
     */
    public function toHex()
    {
        return $this->color;
    }

    /**
     * @return string
     */
    public function toHexString()
    {
        return '#'.$this->toHex();
    }

    /**
     * @return array
     */
    public function getRGBColor()
    {
        return self::hexToRgb($this->toHexString());
    }

    /**
     * @param $color string
     *
     * @return bool
     */
    public static function isValid($color)
    {
        return null !== self::parseAndValidate($color, false);
    }

    /**
     * @param $color
     * @param bool $throwException
     * @return array
     * @throws InvalidColorFormatException
     */
    public static function parseAndValidate($color, $throwException = true)
    {
        $color = strtolower($color);

        if (array_key_exists(strtolower($color), ColorConstants::$colors)) {
            return array('color' => substr(ColorConstants::$colors[$color], 1));
        }

        if (preg_match(ColorConstants::$color_pattern, $color)) {
            return array('color' => self::checkHex($color));
        }

        if($throwException) {
            throw new InvalidColorFormatException();
        }
    }

    /**
     * @param $color
     *
     * @return string
     */
    private static function checkHex($color)
    {
        if ($color[0] == '#') {
            $color = substr($color, 1);
        }
        if (3 === strlen($color)) {
            $color = $color[0].$color[0].$color[1].$color[1].$color[2].$color[2];
        }

        return $color;
    }

    /**
     * @param $color
     *
     * @return array
     *
     * @throws InvalidColorFormatException
     */
    public static function hexToRgb($color)
    {
        $color = self::checkHex($color);

        return array(
            'R' => hexdec($color[0].$color[1]),
            'G' => hexdec($color[2].$color[3]),
            'B' => hexdec($color[4].$color[5]),
        );
    }

    /**
     * @param $rgb
     * @param bool $returnObject
     *
     * @return Color|string
     */
    public static function rgbToHex($rgb, $returnObject = false)
    {
        $color = '#'.dechex($rgb['R']).dechex($rgb['G']).dechex($rgb['B']);
        return $returnObject ? new Color($color) : $color;
    }
}
