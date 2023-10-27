<?php

namespace DeltaSolutions\TranslationsExportImport\Commands;

use DeltaSolutions\TranslationsExportImport\TranslationsExportImport;
use Illuminate\Console\Command;

class TranslationsImportCommand extends Command
{
    public $signature = 'translations:import {--filename=}';

    public $description = 'Import a file to the language_lines table';

    public function handle(): int
    {
        $filename = $this->option('filename');

        (new TranslationsExportImport())->import($filename);

        return self::SUCCESS;
    }
}
