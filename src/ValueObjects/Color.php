<?php
declare(strict_types=1);

namespace ImagineApp\ValueObjects;

use ImagineApp\Exceptions\InvalidHexColorFormat;
use ImagineApp\Exceptions\InvalidRgbColorFormat;

final readonly class Color
{
    private function __construct(private string $color) {}

    public static function fromHexColor(string $color): self
    {
        if (!preg_match('/^#[a-f0-9]{6}$/i', $color)) {
            throw new InvalidHexColorFormat('Invalid hexadecimal color format');
        }

        return new self($color);
    }

    public static function fromRgbColor(array $color): self
    {
        if (count($color) !== 3) {
            throw new InvalidRgbColorFormat('Invalid RGB color format');
        }

        $r = $color[0];
        $g = $color[1];
        $b = $color[2];

        if ($r < 0 || $r > 255 || $g < 0 || $g > 255 || $b < 0 || $b > 255) {
            throw new InvalidRgbColorFormat('Invalid RGB color format');
        }

        return new self(sprintf('#%02x%02x%02x', $r, $g, $b));
    }

    public function getHexColor(): string
    {
        return $this->color;
    }

    public function getRgbColor(): array
    {
        $hexColor = trim($this->color, '#');
        return sscanf($hexColor, "%2x%2x%2x");
    }

    public function __toString(): string
    {
        return $this->color;
    }

    public function calculateComplementaryColor(): Color {
        // convert hex color to RGB
        list($r, $g, $b) = $this->getRgbColor();

        // Calculate the complementary color
        $compR = 255 - $r;
        $compG = 255 - $g;
        $compB = 255 - $b;

        return Color::fromRgbColor([$compR, $compG, $compB]);
    }

    public function hexToLab(): array {
        list($r, $g, $b) = $this->getRgbColor();

        $r /= 255.0;
        $g /= 255.0;
        $b /= 255.0;

        $r = ($r > 0.04045) ? pow((($r + 0.055) / 1.055), 2.4) : ($r / 12.92);
        $g = ($g > 0.04045) ? pow((($g + 0.055) / 1.055), 2.4) : ($g / 12.92);
        $b = ($b > 0.04045) ? pow((($b + 0.055) / 1.055), 2.4) : ($b / 12.92);

        $r *= 100.0;
        $g *= 100.0;
        $b *= 100.0;

        // Convertir a espacio de color XYZ [Matriz de conversión de RGB a XYZ] [M]
        $x = $r * 0.4124564 + $g * 0.3575761 + $b * 0.1804375;
        $y = $r * 0.2126729 + $g * 0.7151522 + $b * 0.0721750;
        $z = $r * 0.0193339 + $g * 0.1191920 + $b * 0.9503041;

        // Convertir a espacio de color LAB
        $x /= 95.047;
        $y /= 100.000;
        $z /= 108.883;

        $x = ($x > 0.008856) ? pow($x, 1/3) : (7.787 * $x + 16/116);
        $y = ($y > 0.008856) ? pow($y, 1/3) : (7.787 * $y + 16/116);
        $z = ($z > 0.008856) ? pow($z, 1/3) : (7.787 * $z + 16/116);

        // transform to LAB space from XYZ
        // https://es.wikipedia.org/wiki/Espacio_de_color_Lab#Conversiones_XYZ_a_CIE_L*a*b*_(CIELAB)_y_viceversa
        $l = (116 * $y) - 16;
        $a = 500 * ($x - $y);
        $b = 200 * ($y - $z);

        return [$l, $a, $b];
    }

}