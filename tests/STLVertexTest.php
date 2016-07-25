<?php
/*
 * This file is part of the STL package.
 *
 * (c) Grosan Flaviu Gheorghe <fgheorghe@grosan.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace php3d\stl;

/**
 * @covers STLVertex
 */
class STLVertexTest extends \PHPUnit_Framework_TestCase
{
    private $stlVertexString = <<<EOT
outerloop
    vertex -71.74323 47.70205 4.666243
    vertex -72.13071 47.70205 4.932664
    vertex -72.1506 47.2273 4.905148
endloop
EOT;

    private $stlVertexArray = array(
        array(
            -71.74323, 47.70205, 4.666243
        ),
        array(
            -72.13071, 47.70205, 4.932664
        ),
        array(
            -72.1506, 47.2273, 4.905148
        )
    );

    /**
     * @expectedException     \Error
     */
    public function testDefaultClassConstructorIsPrivate()
    {
        new STLVertex();
    }

    public function testStringConstructorReturnsSelf()
    {
        $this->assertEquals(
            'php3d\stl\STLVertex',
            get_class(STLVertex::fromString($this->stlVertexString))
        );
    }

    public function testArrayConstructorReturnsSelf()
    {
        $this->assertEquals(
            'php3d\stl\STLVertex',
            get_class(STLVertex::fromArray($this->stlVertexArray))
        );
    }

    public function testVertexCoordinatesArrayIsExtractedFromStringSetAndReturned()
    {
        $this->assertEquals(
            $this->stlVertexArray,
            STLVertex::fromString($this->stlVertexString)->getCoordinatesArray()
        );
    }

    public function testVertexCoordinatesArrayIsExtractedFromArraySetAndReturned()
    {
        $this->assertEquals(
            $this->stlVertexArray,
            STLVertex::fromArray($this->stlVertexArray)->getCoordinatesArray()
        );

        $this->assertEquals(
            $this->stlVertexArray,
            STLVertex::fromArray($this->stlVertexArray)->toArray()
        );
    }

    public function testVertexStringIsConstructed() {
        $this->assertEquals(
            $this->stlVertexString,
            STLVertex::fromArray($this->stlVertexArray)->toString()
        );
    }
}