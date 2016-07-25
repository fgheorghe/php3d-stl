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
 * Class STLVertex. Stores STL vertex data.
 * @package php3d\stl
 */
class STLVertex
{
    /**
     * @var array
     */
    private $coordinatesArray;

    /**
     * @return array
     */
    public function getCoordinatesArray(): array
    {
        return $this->coordinatesArray;
    }

    /**
     * @param array $coordinatesArray
     * @return STLVertex
     */
    public function setCoordinatesArray(array $coordinatesArray): STLVertex
    {
        $this->coordinatesArray = $coordinatesArray;
        return $this;
    }

    // Class should never be instantiated directly, as it emulates constructor overloading.
    private function __construct()
    {
    }

    /**
     * Class constructor from an STL vertex string.
     *
     * Example vertex string:
     * outerloop
     *  vertex -71.74323 47.70205 4.666243
     *  vertex -72.13071 47.70205 4.932664
     *  vertex -72.1506 47.2273 4.905148
     * endloop
     *
     * @param string $stlVertexString
     * @return STLVertex
     */
    public static function fromString(string $stlVertexString) : STLVertex
    {
        $class = new self();

        preg_match_all("/vertex +(\-*\d+\.*\d*e*\-*\+*\d*) +(\-*\d+\.*\d*e*\-*\+*\d*) +(\-*\d+\.*\d*e*\-*\+*\d*)/",
            $stlVertexString, $matches);

        $coordinates = array(
            array((float) $matches[1][0], (float) $matches[2][0], (float) $matches[3][0]),
            array((float) $matches[1][1], (float) $matches[2][1], (float) $matches[3][1]),
            array((float) $matches[1][2], (float) $matches[2][2], (float) $matches[3][2])
        );

        $class->setCoordinatesArray($coordinates);

        return $class;
    }

    /**
     * Class constructor from an STL vertex array.
     *
     * Example vertex array:
     *
     * array(
     *  array(
     *      -71.74323, 47.70205, 4.666243
     *  ),
     *  array(
     *      -72.13071, 47.70205, 4.932664
     *  ),
     *  array(
     *      -72.1506, 47.2273, 4.905148
     *  )
     * )
     *
     * @param array $stlVertexArray
     * @return STLVertex
     */
    public static function fromArray(array $stlVertexArray) : STLVertex
    {
        $class = new self();
        $class->setCoordinatesArray($stlVertexArray);
        return $class;
    }

    /**
     * Wrapper for getCoordinatesArray.
     *
     * @return array
     */
    public function toArray() : array
    {
        return $this->getCoordinatesArray();
    }

    /**
     * Returns a vertex outerloop.
     *
     * @return string
     */
    public function toString() : string
    {
        $coordinates = $this->getCoordinatesArray();
        $string = "outerloop\n";
        foreach ($coordinates as $coordinate) {
            $string .= "    vertex " . implode(" ", $coordinate) . "\n";
        }
        $string .= "endloop";

        return $string;
    }
}