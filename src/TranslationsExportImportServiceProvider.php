<?php

namespace DeltaSolutions\TranslationsExportImport;

use DeltaSolutions\TranslationsExportImport\Commands\TranslationsExportCommand;
use DeltaSolutions\TranslationsExportImport\Commands\TranslationsImportCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TranslationsExportImportServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('translations-export-import')
            ->hasCommand(TranslationsExportCommand::class)
            ->hasCommand(TranslationsImportCommand::class);
    }
}
