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

    public function model(array $row): ?LanguageLine
    {
        //remove the id from the row
        unset($row['id']);
        //set the text field to an empty array
        $row['text'] = [];

        //get the difference between the columns in the database and the columns in the excel file
        $fields = Schema::getColumnListing('language_lines');
        $textFields = array_diff(array_keys($row), $fields);

        //only get the text fields from the row
        $valuesToExtract = array_intersect_key($row, array_flip($textFields));
        //filter out empty values
        $filteredArray = array_filter($valuesToExtract, function ($value) {
            return ! blank($value);
        });
        //set the text field to the filtered array
        $row['text'] = $filteredArray;
        $row['updated_at'] = Carbon::now();
        //remove the text fields from the row
        $row = array_diff_key($row, array_flip($textFields));
        if (filled($row['group']) && filled($row['key'])) {
            return LanguageLine::updateOrCreate(['group' => $row['group'], 'key' => $row['key']], $row);
        }
    }
}
