<?php

namespace DeltaSolutions\TranslationsExportImport\Commands;

use DeltaSolutions\TranslationsExportImport\TranslationsExportImport;
use Illuminate\Console\Command;

class TranslationsExportCommand extends Command
{
    public $signature = 'translations:export {--filename=}';

    public $description = 'Export the translations table';

    public function handle(): int
    {
        $filename = $this->option('filename');

        (new TranslationsExportImport())->export($filename);

        return self::SUCCESS;
    }
}
