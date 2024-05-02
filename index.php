<?php
// include the composer file
require __DIR__ . '/vendor/autoload.php';

use ImagineApp\Services\ColorsService;
use ImagineApp\ValueObjects\Color;

try {
    // define two colors
    $color1 = Color::fromHexColor("#40BF77");
    $color2 = Color::fromHexColor("#40BF77");

    // create a new instance of the ColorsService
    $colorService = new ColorsService();

    // calculate the difference between the two colors
    echo $colorService->colorDifference($color1, $color2);
    echo "\n";
}catch (Exception $e) {
    echo $e->getMessage();
    echo "\n";
}

