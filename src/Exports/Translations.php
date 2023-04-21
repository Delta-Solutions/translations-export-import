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

    public function prepareRows($rows): Collection
    {
        $languageKeys = $this->getLanguageKeys();

        return collect($rows)->transform(function ($languageLine) use ($languageKeys) {
            $languageFields = json_decode($languageLine->text, true);
            $allLocale = array_fill_keys($languageKeys, '');
            return array_merge((array) $languageLine, array_merge($allLocale, $languageFields));
        });
    }

    public function headings(): array
    {
        $languageKeys = $this->getLanguageKeys();
        return array_merge(array_keys(LanguageLine::first()->toArray()), $languageKeys);
    }

    private function getLanguageKeys(): array
    {
        $distinctLanguages = DB::select('select distinct JSON_KEYS(text) as "languages" from language_lines');
        $languageKeys = [];
        foreach ($distinctLanguages as $languages) {
            $keys = explode(',', str_replace(['[', ']', '"', ' '], '', $languages->languages));
            $languageKeys = array_unique(array_merge($languageKeys, $keys));
        }
        return $languageKeys;
    }
}
