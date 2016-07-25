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
 * Class STL. Provides functionality for parsing STL files.
 * @package php3d\stl
 */
class STL
{
    /**
     * @var string
     */
    private $solidName;

    /**
     * @var array
     */
    private $facets = array();

    /**
     * @return string
     */
    public function getSolidName(): string
    {
        return $this->solidName;
    }

    /**
     * @param string $solidName
     * @return STL
     */
    public function setSolidName(string $solidName): STL
    {
        $this->solidName = $solidName;
        return $this;
    }

    // Class should never be instantiated directly, as it emulates constructor overloading.
    private function __construct()
    {
    }

    /**
     * Class constructor from an STL string.
     *
     * @param string $stlFileContentString
     * @return STL
     */
    public static function fromString(string $stlFileContentString) : STL
    {
        $class = new self();

        // Extract name.
        $lines = explode("\n", $stlFileContentString);
        preg_match("/solid (.+)/", $lines[0], $matches);
        $class->setSolidName($matches[1]);

        // Extract facets.
        foreach ($lines as $line) {
            if (preg_match("/facet normal (.+)/", $line)) {
                // Get this line and the following, making a block of facets.
                $string = next($lines) . "\n";
                $string .= next($lines) . "\n";
                $string .= next($lines) . "\n";
                $string .= next($lines) . "\n";
                $string .= next($lines) . "\n";
                $string .= next($lines) . "\n";
                $string .= next($lines) . "\n";
                $class->addFacetNormal(STLFacetNormal::fromString($string));
            }
        }

        return $class;
    }

    /**
     * Class constructor from an STL array.
     *
     * @param array $stlFileArray
     * @return STL
     */
    public static function fromArray(array $stlFileArray) : STL
    {
        $class = new self();

        $class->setSolidName($stlFileArray["name"]);
        foreach ($stlFileArray["facets"] as $facet) {
            $class->addFacetNormal(STLFacetNormal::fromArray($facet));
        }

        return $class;
    }

    /**
     * Adds a new facet normal object.
     *
     * @param STLFacetNormal $facetNormal
     * @return STL
     */
    public function addFacetNormal(STLFacetNormal $facetNormal) : STL
    {
        $this->facets[] = $facetNormal;
        return $this;
    }

    /**
     * Returns the number of facets in this STL object.
     *
     * @return int
     */
    public function getFacetNormalCount() : int
    {
        return count($this->facets);
    }

    /**
     * Returns facet normal object at position.
     *
     * @param int $position
     * @return STLFacetNormal
     */
    public function getFacetNormal(int $position) : STLFacetNormal
    {
        return $this->facets[$position];
    }

    /**
     * Sets a facet normal at a given position.
     *
     * @param int $position
     * @param STLFacetNormal $facetNormal
     * @return STL
     */
    public function setFacetNormal(int $position, STLFacetNormal $facetNormal) : STL
    {
        $this->facets[$position] = $facetNormal;
        return $this;
    }

    public function deleteFacetNormal(int $position) : STL
    {
        $facets = $this->facets;
        unset($facets[$position]);
        $this->facets = array_values($facets);
        return $this;
    }
}