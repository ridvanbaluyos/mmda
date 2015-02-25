RidvanBaluyos/MMDA
=======
An MMDA Traffic Navigator package for PHP
> Traffic Data downloaded from: [MMDA-TV5 Metro Manila Traffic Navigator](http://mmdatraffic.interaksyon.com/)


[![Latest Stable Version](https://poser.pugx.org/ridvanbaluyos/mmda/v/stable.svg)](https://packagist.org/packages/ridvanbaluyos/mmda) [![Total Downloads](https://poser.pugx.org/ridvanbaluyos/mmda/downloads.svg)](https://packagist.org/packages/ridvanbaluyos/mmda) [![Latest Unstable Version](https://poser.pugx.org/ridvanbaluyos/mmda/v/unstable.svg)](https://packagist.org/packages/ridvanbaluyos/mmda) [![License](https://poser.pugx.org/ridvanbaluyos/mmda/license.svg)](https://packagist.org/packages/ridvanbaluyos/mmda)

## Table of contents ##
- [Installation](#installation)
- [Usage](#usage)
- [Credits](#special-thanks-to)

### Installation ##


```bash
composer install
```

or

```bash
composer update
```

### Usage ##
```PHP
<?php
// require the autoloader created upon composer install/update
require_once __DIR__ . '/vendor/autoload.php';

// namespace
use RidvanBaluyos\MMDA;

// to get highway/segment traffic
$highway = new MMDA\Highway(new MMDA\Traffic);
$highway->get_traffic('C5', 'AURORA_BOULEVARD');

// to get list of highways
$highway->get_list();

// to get all traffic data
$traffic = new MMDA\Traffic;
$traffic->load_traffic_data();

?>
```

### Running PHPSpec ##
```bash
./bin/phpspec --ansi run
```


## Special thanks to:
* [Rem Cruz](https://github.com/remerico/) and his [Pebble MMDA App](https://github.com/remerico/pebble-mmda)
* [MMDA for iOS](https://itunes.apple.com/ph/app/mmda-for-ios/id464656389?mt=8) by Giro AppSolutions
* [MMDA for Android™](https://play.google.com/store/apps/details?id=edu.up.ittc.mmda&hl=en) by UP ITDC
