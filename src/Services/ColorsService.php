<?php

namespace ImagineApp\Services;

final class ColorsService {
    private function hexToRgb(string $hexColor): array {
        $hexColor = trim($hexColor, '#');
        return sscanf($hexColor, "%2x%2x%2x");
    }

    private function rgbToHex($r, $g, $b): string {
        $hex = "#";
        $hex .= str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($b), 2, "0", STR_PAD_LEFT);
        return $hex;
    }

    private function calculateComplementaryColor(string $hexColor): string {
        // convert hex color to RGB
        list($r, $g, $b) = $this->hexToRgb($hexColor);

        // Calculate the complementary color
        $compR = 255 - $r;
        $compG = 255 - $g;
        $compB = 255 - $b;

        return $this->rgbToHex($compR, $compG, $compB);
    }

    public function colorDifference(string $color1, string $color2): float|int
    {
        // get complementary color of color1
        $compColor = $this->calculateComplementaryColor($color1);

        // convert hex color to RGB
        list($r1, $g1, $b1) = $this->hexToRgb($compColor);
        list($r2, $g2, $b2) = $this->hexToRgb($color2);

        // calculate the difference between the two colors in RGB space
        $diffR = abs($r1 - $r2);
        $diffG = abs($g1 - $g2);
        $diffB = abs($b1 - $b2);

        // calculate the average difference
        return 1 - (($diffR + $diffG + $diffB) / 3) / 100;
    }
}