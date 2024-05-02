<?php
// include the composer file
require __DIR__ . '/vendor/autoload.php';

use ImagineApp\Services\ColorsService;

// define two colors
$color1 = "#40BF77";
$color2 = "#C32B81";

// create a new instance of the ColorsService
$colorService = new ColorsService();

// calculate the difference between the two colors
echo $colorService->colorDifference($color1, $color2);
echo "\n";