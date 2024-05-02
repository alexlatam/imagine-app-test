# Project for the technical interview of the company Imagine Apps

This repository contains the project for the technical interview of the company Imagine Apps.

## Project description
This project contains the functionality to calculate the difference between two colors in hexadecimal format.
The goal is return a value between 0 and 1, where 1 means that the colors are the same,
and 0 means that the colors are completely different.

## How to run the project

Run composer install
```bash
composer install
```

In the index.php file you can change the colors to calculate the difference between them.
```php
$color1 = 'FF0000';
$color2 = '00FF00';
```

Run the project
```bash
php index.php
```

## Another way to run the project

Change for another branch
```bash
git checkout feature/lab-format
```

and run the same steps as above.

NOTE:
This branch contains the same functionality as the master branch, but is using the LAB space [another color concept].
And the code is using another structure. Using Value Object, Exceptions, Service or Use Case.
