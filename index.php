<?php
error_reporting(E_ALL);
use Ridvanbaluyos\Mmda\MMDA as MMDA;

require_once __DIR__ . '/vendor/autoload.php';

$mmda = new MMDA();
var_dump($mmda->traffic());

