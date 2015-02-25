ridvanbaluyos/mmda
=======
An MMDA Traffic Navigator package for PHP
> Traffic Data downloaded from: [MMDA-TV5 Metro Manila Traffic Navigator](http://mmdatraffic.interaksyon.com/)
<br/>
[![Latest Stable Version](https://poser.pugx.org/ridvanbaluyos/mmda/v/stable.svg)](https://packagist.org/packages/ridvanbaluyos/mmda) [![Total Downloads](https://poser.pugx.org/ridvanbaluyos/mmda/downloads.svg)](https://packagist.org/packages/ridvanbaluyos/mmda) [![Latest Unstable Version](https://poser.pugx.org/ridvanbaluyos/mmda/v/unstable.svg)](https://packagist.org/packages/ridvanbaluyos/mmda) [![License](https://poser.pugx.org/ridvanbaluyos/mmda/license.svg)](https://packagist.org/packages/ridvanbaluyos/mmda)
<br/>
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
* [MMDA for iOS](https://itunes.apple.com/ph/app/mmda-for-ios/id464656389?mt=8) by Giro AppSolutions
* [MMDA for Android™](https://play.google.com/store/apps/details?id=edu.up.ittc.mmda&hl=en) by UP ITDC
