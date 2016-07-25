## Synopsis

This library provides functionality for reading 3D objects stored in STereoLithography (STL) files.

### Set-up

Add this to your composer.json file:

```javascript
  [...]
  "require": {
      [...]
      "php-amqplib/php-amqplib": "2.6.*"
  }
```

Then run composer:

```bash
composer.phar install
```

## Examples

Read an STL file:

```PHP
STL::fromString(file_get_contents("/path/to/file.stl"));
```

Add a new facet:

```PHP
STL::addFacetNormal(STLFacetNormal::fromArray(array(
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
file_put_contents("/path/to/file.stl", STL::toString());
```