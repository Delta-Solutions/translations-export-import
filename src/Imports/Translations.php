<?php

namespace DeltaSolutions\TranslationsExportImport\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Spatie\TranslationLoader\LanguageLine;

class Translations implements ToModel, WithProgressBar, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        unset($row['id']);
        $row['text'] = [];

        return LanguageLine::updateOrCreate(['group' => $row['group'], 'key' => $row['key']], $row);
    }
}
