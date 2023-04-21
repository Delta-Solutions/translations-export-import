[![Latest Version on Packagist](https://img.shields.io/packagist/v/delta-solutions/translations-export-import.svg?style=flat-square)](https://packagist.org/packages/delta-solutions/translations)
[![Total Downloads](https://img.shields.io/packagist/dt/delta-solutions/translations-export-import.svg?style=flat-square)](https://packagist.org/packages/delta-solutions/translations)

# Translations export and import

This package provides two artisan commands to export and import language_lines from the spatie translations package table to Excel.

## Installation

You can install the package via composer:

```bash
composer require delta-solutions/translations-export-import
```

## Usage

### To export your translations run to language_lines.xlsx in your storage/app folder.

```bash
php artisan translations:export
```
or specify a filename (the file will be saved in the storage/app folder)

```bash
php artisan translations:export --filename=yourFileName.xlsx 
```

### To import your translations from language_lines.xlsx run

```bash
php artisan translations:import
```
or specify a filename to import (staring from storage/app)

```bash
php artisan translations:import --filename=yourFileName.xlsx 
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Andreas](https://github.com/Delta-Solutions)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
