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
 * @covers STLFacetNormal
 */
class STLFacetNormalTest extends \PHPUnit_Framework_TestCase
{
    private $stlFacetNormalString = <<<EOT
facet normal 0.5651193 -0.07131607 0.8219211
outerloop
    vertex -71.74323 47.70205 4.666243
    vertex -72.13071 47.70205 4.932664
    vertex -72.1506 47.2273 4.905148
endloop
endfacet
EOT;

    private $stlFacetNormalArray = array(
        "coordinates" => array(0.5651193, -0.07131607, 0.8219211),
        "vertex" => array(
            array(
                -71.74323, 47.70205, 4.666243
            ),
            array(
                -72.13071, 47.70205, 4.932664
            ),
            array(
                -72.1506, 47.2273, 4.905148
            )
        )
    );

    /**
     * @expectedException     \Error
     */
    public function testDefaultClassConstructorIsPrivate()
    {
        new STLFacetNormal();
    }

    public function testStringConstructorReturnsSelf()
    {
        $this->assertEquals(
            'php3d\stl\STLFacetNormal',
            get_class(STLFacetNormal::fromString($this->stlFacetNormalString))
        );
    }

    public function testArrayConstructorReturnsSelf()
    {
        $this->assertEquals(
            'php3d\stl\STLFacetNormal',
            get_class(STLFacetNormal::fromArray($this->stlFacetNormalArray))
        );
    }

    public function testCoordinatesAreExtractedFromStringSetAndReturned()
    {
        $this->assertEquals(
            $this->stlFacetNormalArray["coordinates"],
            STLFacetNormal::fromString($this->stlFacetNormalString)->getCoordinatesArray()
        );
    }

    public function testVertexIsExtractedFromStringSetAndReturned()
    {
        $this->assertEquals(
            STLVertex::fromArray(array(
                array(
                    -71.74323, 47.70205, 4.666243
                ),
                array(
                    -72.13071, 47.70205, 4.932664
                ),
                array(
                    -72.1506, 47.2273, 4.905148
                )
            )),
            STLFacetNormal::fromString($this->stlFacetNormalString)->getVertex()
        );
    }

    public function testCoordinatesAreExtractedFromArraySetAndReturned()
    {
        $this->assertEquals(
            $this->stlFacetNormalArray["coordinates"],
            STLFacetNormal::fromArray($this->stlFacetNormalArray)->getCoordinatesArray()
        );
    }

    public function testVertexIsExtractedFromArraySetAndReturned()
    {
        $this->assertEquals(
            STLVertex::fromArray(array(
                array(
                    -71.74323, 47.70205, 4.666243
                ),
                array(
                    -72.13071, 47.70205, 4.932664
                ),
                array(
                    -72.1506, 47.2273, 4.905148
                )
            )),
            STLFacetNormal::fromArray($this->stlFacetNormalArray)->getVertex()
        );
    }

    public function testFacetNormalIsConvertedToArray()
    {
        $this->assertEquals(
            $this->stlFacetNormalArray,
            STLFacetNormal::fromString($this->stlFacetNormalString)->toArray()
        );
    }

    public function testFacetNormalIsConvertedToString()
    {
        $this->assertEquals(
            $this->stlFacetNormalString,
            STLFacetNormal::fromArray($this->stlFacetNormalArray)->toString()
        );
    }
}