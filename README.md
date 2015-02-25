ridvanbaluyos/mmda
=======
An MMDA Traffic Navigator package for PHP
> Traffic Data downloaded from: [MMDA-TV5 Metro Manila Traffic Navigator](http://mmdatraffic.interaksyon.com/)

## Table of contents ##
- [Installation](#installation)
- [Usage](#usage)
    - [Traffic Data](#getting-traffic-data)
    - [Highways](#getting-major-highways)
    - [Segments](#getting-highway-segments)
- [Credits](#special-thanks-to)

### Installation ##
Open your `composer.json` file and add the following to the `require` key:

    "ridvanbaluyos/chikka": "v0.1"

---

After adding the key, run composer update from the command line to install the package

```bash
composer install
```

or

```bash
composer update
```

### Usage ##
```php
<?php
// require the autoloader created upon composer install/update
require_once __DIR__ . '/vendor/autoload.php';

// namespace
use Ridvanbaluyos\Mmda\MMDA as MMDA;

// instantiate the MMDA object
$mmda = new MMDA();

?>
```

#### Getting Traffic Data
```php
$mmda->traffic();
```

#### Getting Major Highways
```php
$mmda->highways();
```

#### Getting Highway Segments
```php
$mmda->segments('EDSA'); // parameter should be a valid highway (see getting major highways)
```

## Special thanks to:
* [Rem Cruz](https://github.com/remerico/) and his [Pebble MMDA App](https://github.com/remerico/pebble-mmda)
