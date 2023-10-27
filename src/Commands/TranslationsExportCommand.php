<?php

namespace DeltaSolutions\TranslationsExportImport\Commands;

use DeltaSolutions\TranslationsExportImport\TranslationsExportImport;
use Illuminate\Console\Command;
use function Laravel\Prompts\select;

class TranslationsExportCommand extends Command
{
    public $signature = 'translations:export {--filename=} {--type=}';

    public $description = 'Export the translations table';

    public function handle(): int
    {
        $filename = $this->option('filename');

        (new TranslationsExportImport())->export($filename,type:$this->getType());

        return self::SUCCESS;
    }

    private function getType(): string
    {
        $type = $this->option('type');
        if (!filled($type)) {
            $type = select(
                'What filetype do you want?',
                default: 'xlsx',
                options:['xlsx', 'csv'],
            );
        }
        return $type;
    }
}
