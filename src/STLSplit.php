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
 * Class STLSplit. Extracts separate 3D objects as STL objects.
 * @package php3d\stl
 */
class STLSplit {
    /**
     * @var STL
     */
    private $stl;

    /**
     * @return STL
     */
    public function getStl(): STL
    {
        return $this->stl;
    }

    /**
     * @param STL $stl
     * @return STLSplit
     */
    private function setStl(STL $stl): STLSplit
    {
        $this->stl = $stl;
        return $this;
    }

    /**
     * STLSplit constructor.
     * @param STL $stl
     */
    public function __construct(STL $stl)
    {
        $this->setStl($stl);
    }

    /**
     * Splits an STL object and returns the new 3D objects in an array of STL files.
     *
     * @return array
     */
    public function split() : array
    {
        $stlArray = $this->getStl()->toArray();
        $facets = $stlArray["facets"];

        $objArray = array();
        $vertex = $facets[0];
        unset($facets[0]);

        $current = 0;
        $objArray[$current] = array($vertex);
        while (count($facets) != 0) {
            $this->findNeighbour(
                $vertex,
                $objArray[$current],
                $facets
            );
            $vertex = array_pop($facets);
            $current++;
            if ($vertex) {
                $objArray[$current] = array($vertex);
            }
        }

        $stlObjects = array();
        foreach ($objArray as $key => $object) {
            $stlObjects[] = STL::fromArray(array(
                "name" => $this->getStl()->getSolidName() . $key,
                "facets" => $object
            ));
        }

        return $stlObjects;
    }

    /**
     * Finds the neighbouring facets of a facet.
     *
     * @param array $facet
     * @param array $object
     * @param array $facets
     */
    private function findNeighbour(array $facet, array &$object, array &$facets)
    {
        foreach ($facets as $key => $_facet) {
            for ($i = 0; $i < 3; $i++) {
                if (in_array($_facet["vertex"][$i], $facet["vertex"])) {
                    unset($facets[$key]);
                    $object[] = $_facet;
                    $this->findNeighbour(
                        $_facet,
                        $object,
                        $facets
                    );
                }
                continue 2;
            }
        }
    }
}
