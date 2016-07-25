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
 * Class STLFacetNormal. Stores facet normal data.
 * @package php3d\stl
 */
class STLFacetNormal
{
    /**
     * @var array
     */
    private $coordinatesArray;

    /**
     * @var STLVertex
     */
    private $vertex;

    /**
     * @return STLVertex
     */
    public function getVertex(): STLVertex
    {
        return $this->vertex;
    }

    /**
     * @param STLVertex $vertex
     * @return STLFacetNormal
     */
    public function setVertex(STLVertex $vertex): STLFacetNormal
    {
        $this->vertex = $vertex;
        return $this;
    }

    /**
     * @return array
     */
    public function getCoordinatesArray(): array
    {
        return $this->coordinatesArray;
    }

    /**
     * @param array $coordinatesArray
     * @return STLFacetNormal
     */
    public function setCoordinatesArray(array $coordinatesArray): STLFacetNormal
    {
        $this->coordinatesArray = $coordinatesArray;
        return $this;
    }

    // Class should never be instantiated directly, as it emulates constructor overloading.
    private function __construct()
    {
    }

    /**
     * Class constructor from an STL facet normal string.
     *
     * Example facet normal string:
     *
     * facet normal 0.5651193 -0.07131607 0.8219211
     *  outerloop
     *   vertex -71.74323 47.70205 4.666243
     *   vertex -72.13071 47.70205 4.932664
     *   vertex -72.1506 47.2273 4.905148
     *  endloop
     * endfacet
     *
     * @param string $stlFacetNormalString
     * @return STLFacetNormal
     */
    public static function fromString(string $stlFacetNormalString) : STLFacetNormal
    {
        $class = new self();

        preg_match("/facet normal +(\-*\d+\.*\d*e*\-*\+*\d*) +(\-*\d+\.*\d*e*\-*\+*\d*) +(\-*\d+\.*\d*e*\-*\+*\d*)/",
            $stlFacetNormalString, $matches);
        $class->setCoordinatesArray(array((float)$matches[1], (float)$matches[2], (float)$matches[3]));

        $lines = explode("\n", $stlFacetNormalString);
        $vertex = "";
        for ($i = 1; $i < count($lines) - 1; $i++) {
            $vertex .= $lines[$i];
        }
        $class->setVertex(STLVertex::fromString($vertex));

        return $class;
    }

    /**
     * Class constructor from an STL facet normal array.
     *
     * Example facet normal array:
     * array(
     *         "coordinates" => array(0.5651193, -0.07131607, 0.8219211),
     *              "vertex" => array(
     *                  array(
     *                      -71.74323, 47.70205, 4.666243
     *                  ),
     *                  array(
     *                      -72.13071, 47.70205, 4.932664
     *                  ),
     *                  array(
     *                      -72.1506, 47.2273, 4.905148
     *                  )
     *          )
     * )
     *
     * @param array $stlFacetNormalArray
     * @return STLFacetNormal
     */
    public static function fromArray(array $stlFacetNormalArray) : STLFacetNormal
    {
        $class = new self();
        $class->setCoordinatesArray($stlFacetNormalArray["coordinates"]);
        $class->setVertex(STLVertex::fromArray($stlFacetNormalArray["vertex"]));
        return $class;
    }

    /**
     * Returns facet normal as array.
     *
     * @return array
     */
    public function toArray() : array
    {
        return array(
            "coordinates" => $this->getCoordinatesArray(),
            "vertex" => $this->getVertex()->toArray()
        );
    }

    /**
     * Returns facet as string.
     *
     * @return string
     */
    public function toString() : string
    {
        $string = "facet normal " . implode(" ", $this->getCoordinatesArray()) . "\n";
        $string .= $this->getVertex()->toString() . "\n";
        $string .= "endfacet";
        return $string;
    }
}