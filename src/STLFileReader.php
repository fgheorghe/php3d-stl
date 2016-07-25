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
 * Class STLFileReader. Provides functionality for parsing STL files.
 * @package php3d\stl
 */
class STLFileReader
{
    private function __construct() {}

    public static function fromString(string $stlFileContentString) : STLFileReader {
        return new self();
    }
}