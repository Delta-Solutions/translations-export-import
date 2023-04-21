<?php

namespace DeltaSolutions\TranslationsExportImport;

use DeltaSolutions\TranslationsExportImport\Imports\Translations;
use Maatwebsite\Excel\Facades\Excel;

class TranslationsExportImport
{
    public function export($fileName, $disk = null): bool
    {
        return Excel::store(new \DeltaSolutions\TranslationsExportImport\Exports\Translations(), $fileName ?? 'language_lines.xlsx', $disk, \Maatwebsite\Excel\Excel::XLSX);
    }

    public function import($filename, $disk = null): \Maatwebsite\Excel\Excel
    {
        return Excel::import(new Translations(), $filename ?? 'language_lines.xlsx', $disk);
    }
}
