# php3d-stl #

[![Build Status](https://travis-ci.org/fgheorghe/php3d-stl.svg?branch=master)](https://travis-ci.org/fgheorghe/php3d-stl)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/fgheorghe/php3d-stl/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/fgheorghe/php3d-stl/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/fgheorghe/php3d-stl/badges/build.png?b=master)](https://scrutinizer-ci.com/g/fgheorghe/php3d-stl/build-status/master)

## Synopsis

This library provides PHP 7 functionality for reading and writing from and to 3D objects stored in STereoLithography (STL) files,
useful for manipulating 3D objects for 3D Printing.

## Set-up

Add this to your composer.json file:

```javascript
  [...]
  "require": {
      [...]
      "php3d/stl": "1.*"
  }
```

Then run composer:

```bash
composer.phar install
```

## Examples

Read an STL file:

```PHP
use php3d\stl\STL;
use php3d\stl\STLFacetNormal;

$stl = STL::fromString(file_get_contents("/path/to/file.stl"));
```

Add a new facet:

```PHP
$stl->addFacetNormal(STLFacetNormal::fromArray(array(
    "coordinates" => array( 1, 2, 3), // Facet normal coordinates.
    "vertex" => array(
        array(
            3, 4, 5
        ),
        array(
            3, 4, 5
        ),
        array(
            3, 4, 5
        )
    )
)));
```

Write back to file:

```PHP
file_put_contents("/path/to/file.stl", $stl->toString());
```