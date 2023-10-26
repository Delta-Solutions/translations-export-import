<?php

namespace DeltaSolutions\TranslationsExportImport\Commands;

use DeltaSolutions\TranslationsExportImport\TranslationsExportImport;
use Illuminate\Console\Command;
use function Laravel\Prompts\select;

class TranslationsExportCommand extends Command
{
    public $signature = 'translations:export {--filename=}';

    public $description = 'Export the translations table';

    public function handle(): int
    {
        $filename = $this->option('filename');

        $type = select(
            'What filetype do you want?',
            ['xlsx', 'csv'],
        );
        if($type == 'csv'){
            (new TranslationsExportImport())->csv($filename);
        }else{
            (new TranslationsExportImport())->export($filename);
        }


        return self::SUCCESS;
    }
}
