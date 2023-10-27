<?php

namespace DeltaSolutions\TranslationsExportImport;

use DeltaSolutions\TranslationsExportImport\Imports\Translations;
use Maatwebsite\Excel\Facades\Excel;

class TranslationsExportImport
{
    public function export($fileName, $disk = null, $type = 'xlsx'): bool
    {
        $writer = ($type == 'xlsx' ? \Maatwebsite\Excel\Excel::XLSX : \Maatwebsite\Excel\Excel::CSV);

        return Excel::store(new \DeltaSolutions\TranslationsExportImport\Exports\Translations(), $fileName ?? 'language_lines.'.$type, $disk, $writer);
    }

    public function import($filename, $disk = null): \Maatwebsite\Excel\Excel
    {
        //check if the file exists, if not, check if the csv file exists else take excel

        if (blank($filename) || ! file_exists(storage_path('app/'.$filename))) {
            if (file_exists(storage_path('app/language_lines.csv'))) {
                $filename = 'language_lines.csv';
            } else {
                $filename = 'language_lines.xlsx';
            }
        }

        return Excel::import(new Translations(), $filename, $disk);
    }
}
