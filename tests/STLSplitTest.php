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
 * @covers STLSplitTest
 */
class STLSplitTest extends \PHPUnit_Framework_TestCase
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
facet normal 0.5664103 -0.02379302 0.8237799
outerloop
    vertex 0 0 0
    vertex 1 1 1
    vertex 2 2 2
endloop
endfacet
endsolid
EOT;

    /**
     * @var string
     */
    private $firstStlObject = <<<EOT
solid test0
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
     * @var string
     */
    private $secondStlObject = <<<EOT
solid test1
facet normal 0.5664103 -0.02379302 0.8237799
outerloop
    vertex 0 0 0
    vertex 1 1 1
    vertex 2 2 2
endloop
endfacet
endsolid
EOT;

    public function testStlFileIsSplitInTwo()
    {
        $stl = STL::fromString($this->stlFileString);

        $split = (new \php3d\stl\STLSplit($stl))->split();

        $this->assertEquals(
            2,
            count($split)
        );

        $this->assertEquals(
            $this->firstStlObject,
            $split[0]->toString()
        );

        $this->assertEquals(
            $this->secondStlObject,
            $split[1]->toString()
        );
    }
}