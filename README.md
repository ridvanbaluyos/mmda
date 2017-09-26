ridvanbaluyos/mmda
=======
An MMDA Traffic Navigator package for PHP
> Traffic Data downloaded from: [MMDA-TV5 Metro Manila Traffic Navigator](http://mmdatraffic.interaksyon.com/)
<br/><br/>

[![Actively Maintained](https://maintained.tech/badge.svg)](https://maintained.tech/)
[![Latest Stable Version](https://poser.pugx.org/ridvanbaluyos/mmda/v/stable)](https://packagist.org/packages/ridvanbaluyos/mmda) [![Total Downloads](https://poser.pugx.org/ridvanbaluyos/mmda/downloads)](https://packagist.org/packages/ridvanbaluyos/mmda) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/0ce7e7c86bf0405c9497dafc28f14a96)](https://www.codacy.com/app/ridvanbaluyos/mmda?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=ridvanbaluyos/mmda&amp;utm_campaign=Badge_Grade) [![License](https://poser.pugx.org/ridvanbaluyos/mmda/license)](https://packagist.org/packages/ridvanbaluyos/mmda)

## Table of contents ##
- [Installation](#installation)
- [Usage](#usage)
    - [Traffic Data](#getting-traffic-data)
    - [Highways](#getting-major-highways)
    - [Segments](#getting-highway-segments)
- [Credits](#special-thanks-to)

### Installation ##
Open your `composer.json` file and add the following to the `require` key:

    "ridvanbaluyos/mmda": "1.0.2"

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
// parameter should be a valid highway (see getting major highways)
$mmda->segments('EDSA');
```

## Special thanks to:
* [Rem Cruz](https://github.com/remerico/) and his [Pebble MMDA App](https://github.com/remerico/pebble-mmda)
* [MMDA for iOS](https://itunes.apple.com/ph/app/mmda-for-ios/id464656389?mt=8) by Giro AppSolutions
* [MMDA for Android™](https://play.google.com/store/apps/details?id=edu.up.ittc.mmda&hl=en) by UP ITDC
