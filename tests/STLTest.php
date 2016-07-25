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
 * @covers STL
 */
class STLTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $stlFileString = <<<EOT
solid test
facet normal 0.5651193 -0.07131607 0.8219211
outerloop
    vertex -71.74323 47.70205 4.666243
    vertex -72.13071 47.70205 4.932664
    vertex -72.1506 47.2273 4.905148
endloop
endfacet
facet normal 0.5651276 -0.0713266 0.8219144
outerloop
    vertex -72.1506 47.2273 4.905148
    vertex -71.7618 47.2273 4.637817
    vertex -71.74323 47.70205 4.666243
endloop
endfacet
facet normal 0.5664103 -0.02379302 0.8237799
outerloop
    vertex -71.7618 47.2273 4.637817
    vertex -72.1506 47.2273 4.905148
    vertex -72.15724 46.75148 4.895968
endloop
endfacet
endsolid
EOT;

    /**
     * @var array
     */
    private $stlFileArray = array(
        "name" => "test",
        "facets" => array(
            array(
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
            ),
            array(
                "coordinates" => array(0.5651276, -0.0713266, 0.8219144),
                "vertex" => array(
                    array(
                        -72.1506, 47.2273, 4.905148
                    ),
                    array(
                        -71.7618, 47.2273, 4.637817
                    ),
                    array(
                        -71.74323, 47.70205, 4.666243
                    )
                )
            ),
            array(
                "coordinates" => array(0.5664103, -0.02379302, 0.8237799),
                "vertex" => array(
                    array(
                        -71.7618, 47.2273, 4.637817
                    ),
                    array(
                        -72.1506, 47.2273, 4.905148
                    ),
                    array(
                        -72.15724, 46.75148, 4.895968
                    )
                )
            )
        )
    );

    /**
     * @var array
     */
    private $stlFacetNormal = array(
        "coordinates" => array(0.5664103, -0.02379302, 0.8237799),
        "vertex" => array(
            array(
                -71.7618, 47.2273, 4.637817
            ),
            array(
                -72.1506, 47.2273, 4.905148
            ),
            array(
                -72.15724, 46.75148, 4.895968
            )
        )
    );

    /**
     * @var string
     */
    private $solidName = "test";

    /**
     * @expectedException     \Error
     */
    public function testDefaultClassConstructorIsPrivate()
    {
        new STL();
    }

    public function testStringConstructorReturnsSelf()
    {
        $this->assertEquals(
            'php3d\stl\STL',
            get_class(STL::fromString($this->stlFileString))
        );
    }

    public function testArrayConstructorReturnsSelf()
    {
        $this->assertEquals(
            'php3d\stl\STL',
            get_class(STL::fromArray($this->stlFileArray))
        );
    }

    public function testNameIsExtractedFromStringSetAndReturned()
    {
        $this->assertEquals(
            $this->solidName,
            STL::fromString($this->stlFileString)->getSolidName()
        );
    }

    public function testNameIsExtractedFromArraySetAndReturned()
    {
        $this->assertEquals(
            $this->solidName,
            STL::fromArray($this->stlFileArray)->getSolidName()
        );
    }

    public function testFacetNormalsAreExtractedFromArraySetAndReturned()
    {
        $stl = STL::fromArray($this->stlFileArray);

        $this->assertEquals(3, $stl->getFacetNormalCount());

        for ($i = 0; $i < 3; $i++) {
            $this->assertEquals(
                $this->stlFileArray["facets"][$i],
                $stl->getFacetNormal($i)->toArray()
            );
        }
    }

    public function testFacetNormalsAreExtractedFromStringSetAndReturned()
    {
        $stl = STL::fromString($this->stlFileString);

        $this->assertEquals(3, $stl->getFacetNormalCount());

        for ($i = 0; $i < 3; $i++) {
            $this->assertEquals(
                $this->stlFileArray["facets"][$i],
                $stl->getFacetNormal($i)->toArray()
            );
        }
    }

    public function testOverrideFacetNormal()
    {
        $stl = STL::fromArray($this->stlFileArray);

        $facetNormal = STLFacetNormal::fromArray($this->stlFacetNormal);
        $this->assertEquals(
            'php3d\stl\STL',
            get_class($stl->setFacetNormal(1, STLFacetNormal::fromArray($this->stlFacetNormal)))
        );

        $this->assertEquals(
            $facetNormal,
            $stl->getFacetNormal(1)
        );
    }

    public function testDeleteFacetNormal()
    {
        $stl = STL::fromArray($this->stlFileArray);
        $this->assertEquals(
            'php3d\stl\STL',
            get_class($stl->deleteFacetNormal(1))
        );
        $this->assertEquals(2, $stl->getFacetNormalCount());
    }

    public function testSTLIsConvertedToArray()
    {
        $this->assertEquals(
            $this->stlFileArray,
            STL::fromString($this->stlFileString)->toArray()
        );
    }

    public function testSTLIsConvertedToString()
    {
        $this->assertEquals(
            $this->stlFileString,
            STL::fromArray($this->stlFileArray)->toString()
        );
    }
}
