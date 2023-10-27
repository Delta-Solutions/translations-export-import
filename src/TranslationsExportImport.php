<?php

namespace DeltaSolutions\TranslationsExportImport;

use DeltaSolutions\TranslationsExportImport\Imports\Translations;
use Maatwebsite\Excel\Facades\Excel;

class TranslationsExportImport
{
    public function export($fileName, $disk = null, $type = 'xlsx'): bool
    {
        $writer= ($type == "xlsx" ? \Maatwebsite\Excel\Excel::XLSX : \Maatwebsite\Excel\Excel::CSV);

        return Excel::store(new \DeltaSolutions\TranslationsExportImport\Exports\Translations(), $fileName ?? 'language_lines.'.$type, $disk, $writer);
    }

    public function import($filename, $disk = null): \Maatwebsite\Excel\Excel
    {
        return Excel::import(new Translations(), $filename ?? 'language_lines.xlsx', $disk);
    }
}
