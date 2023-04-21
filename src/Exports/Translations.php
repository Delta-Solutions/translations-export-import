<?php

namespace DeltaSolutions\TranslationsExportImport\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Spatie\TranslationLoader\LanguageLine;

class Translations implements FromCollection, WithHeadings
{
    public function collection(): Collection
    {
        return DB::table('language_lines')->get();
    }

    public function prepareRows($rows)
    {
        $allLocale = array_flip($this->languageKeys());
        $allLocale = array_fill_keys(array_keys($allLocale), '');

        return collect($rows)->transform(function ($languageLine) use (&$allLocale) {
            $languageFields = json_decode($languageLine->text, true);
            return array_merge((array) $languageLine, array_merge($allLocale, $languageFields));
        });


    }

    public function headings(): array
    {
        return array_merge(array_keys(LanguageLine::first()->toArray()), $this->languageKeys());

    }

    public function languageKeys(): array
    {
        $distinctLanguagesFromDatabase = collect(DB::select('select distinct JSON_KEYS(text) as "languages" from language_lines'));
        $languageKeys = [];
        $distinctLanguagesFromDatabase->each(function ($languages) use (&$languageKeys) {
            $keys = explode(',', str_replace(['[', ']', '"', ' '], '', $languages->languages));
            $languageKeys = array_unique(array_merge($languageKeys, $keys));
        });

        return $languageKeys;
    }
}
