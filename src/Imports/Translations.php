<?php

namespace DeltaSolutions\TranslationsExportImport\Imports;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
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

        $fields = Schema::getColumnListing('language_lines');
        $textFields = array_diff(array_keys($row), $fields);
        $valuesToExtract = array_intersect_key($row, array_flip($textFields));
        $filteredArray = array_filter($valuesToExtract, function ($value) {
            return ! blank($value);
        });
        $row['text'] = $filteredArray;
        $row['updated_at'] = Carbon::now();
        $row = array_diff_key($row, array_flip($textFields));

        return LanguageLine::updateOrCreate(['group' => $row['group'], 'key' => $row['key']], $row);
    }
}
