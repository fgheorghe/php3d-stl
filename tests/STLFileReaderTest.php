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
 * @covers STLFileReader
 */
class STLFileReaderTest extends \PHPUnit_Framework_TestCase
{
    private $stlFileString = <<<EOT
EOT;

    /**
     * @expectedException     \Error
     */
    public function testDefaultClassConstructorIsPrivate() {
        new STLFileReader();
    }

    public function testStringConstructorReturnsSelf() {
        $this->assertEquals(
            'php3d\stl\STLFileReader',
            get_class(STLFileReader::fromString($this->stlFileString))
        );
    }
}
