<?php

use Image\PerceptualHash;
use Image\PerceptualHash\Algorithm\DifferenceHash;

class DifferenceHashTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->path_inuo1 = __DIR__ . '/images/inuo1.jpg';
        $this->path_inuo2 = __DIR__ . '/images/inuo2.jpg';
        $this->hex_inuo1 = '4c58d4dcc9ed6c49';
        $this->hex_inuo2 = '5978ac96d0555949';
        $this->bin_inuo1 = '0100110001011000110101001101110011001001111011010110110001001001';
        $this->bin_inuo2 = '0101100101111000101011001001011011010000010101010101100101001001';
    }

    public function testCalculateBinaryHash()
    {
        $algorithm = new DifferenceHash;
        $ph = new PerceptualHash($this->path_inuo1, $algorithm);
        $bin = $ph->bin();

        $this->assertEquals(64, strlen($bin));
        $this->assertEquals($this->bin_inuo1, $bin);
    }

    public function testCalculateHexHash()
    {
        $algorithm = new DifferenceHash;
        $ph = new PerceptualHash($this->path_inuo1, $algorithm);
        $hex = $ph->hex();

        $this->assertEquals(16, strlen($hex));
        $this->assertEquals($this->hex_inuo1, $hex);
    }

    public function testCompareDifferentImages()
    {
        $algorithm = new DifferenceHash;
        $ph = new PerceptualHash($this->path_inuo1, $algorithm);
        $diff = $ph->compare($this->path_inuo2);

        $this->assertEquals(22, $diff);
    }

    public function testCompareSameImages()
    {
        $algorithm = new DifferenceHash;
        $ph = new PerceptualHash($this->path_inuo1, $algorithm);
        $diff = $ph->compare($this->path_inuo1);

        $this->assertEquals(0, $diff);
    }
}
