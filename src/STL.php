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
        $firstLine = explode("\n", $stlFileContentString);
        preg_match("/solid (.+)/", $firstLine[0], $matches);
        $class->setSolidName($matches[1]);

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
        return new self();
    }
}