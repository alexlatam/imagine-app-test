<?php
declare(strict_types=1);

namespace ImagineApp\Services;

use ImagineApp\ValueObjects\Color;

/**
 * This class is responsible for calculating the difference between two colors.
 * This class could be a use case[Application Service] in a real-world application.
 * This class could be injected into a controller or another service.
 */
final class ColorsService {

    /**
     * As a best practice, we should inject the dependencies into the constructor.
     * In this case, we are injecting the ColorRepository dependency for store the result.
     */
    # public gifunction __construct(private readonly ColorRepository $colorRepository) {}

    public function colorDifference(Color $color1, Color $color2): float|int
    {
        $complementaryColor = $color1->calculateComplementaryColor();

        list($l1, $a1, $b1) = $complementaryColor->hexToLab();
        list($l2, $a2, $b2) = $color2->hexToLab();

        // calculate the Euclidean distance between the two colors
        $distance = sqrt(pow($l2 - $l1, 2) + pow($a2 - $a1, 2) + pow($b2 - $b1, 2));

        // normalize the distance to a score between 0 and 1
        $max_distance = sqrt(pow(100, 2) + pow(128, 2) + pow(128, 2));
        return 1 - ($distance / $max_distance);
    }
}