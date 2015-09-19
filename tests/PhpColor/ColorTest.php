<?php

namespace PhpColor;

class ColorTest extends \PHPUnit_Framework_TestCase
{
    public function testColorFormat()
    {
        //Valid colors
        $this->assertTrue(Color::isValid('aaaaaa'));
        $this->assertTrue(Color::isValid('#ffffff'));
        $this->assertTrue(Color::isValid('#aaa'));
        $this->assertTrue(Color::isValid('fff'));
        $this->assertTrue(Color::isValid('red'));

        //Invalid colors
        $this->assertNotEquals(true, Color::isValid('aaaaa'));
        $this->assertNotEquals(true, Color::isValid('#fffffg'));
        $this->assertNotEquals(true, Color::isValid('#aaaaaaa'));
        $this->assertNotEquals(true, Color::isValid('ffff'));
    }

    public function testGetColor()
    {
        $this->assertEquals('#aaaaaa', (new Color('aaaaaa'))->toHexString());
        $this->assertEquals('#ffffff', (new Color('fff'))->toHexString());
        $this->assertEquals('#11ffaa', (new Color('#1fa'))->toHexString());
    }

    public function testHexToRGBColor()
    {
        $color = new Color('#0AFABB');
        $rgb = $color->getRGBColor();
        $this->assertEquals(10, $rgb['R']);
        $this->assertEquals(250, $rgb['G']);
        $this->assertEquals(187, $rgb['B']);
    }

    public function testRGBtoHex()
    {
        $this->assertEquals('#9358cb', Color::rgbToHex(['R' => 147, 'G' => 88, 'B' => 203]));
    }

    public function testLuminance()
    {
        $color = new Color('#7755aa');
        $luminance = $color->getLuminance();
        $this->assertEquals(0.133212, round($luminance, 6));
    }
}
