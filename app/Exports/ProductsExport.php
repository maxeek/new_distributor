<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ProductsExport implements FromView, ShouldAutoSize, WithColumnFormatting
{
    use Exportable;

    public function records($records)
    {
        $this->records = $records;

        return $this;
    }

    public function categories($categories) {
        $this->categories = $categories;

        return $this;
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
        ];
    }

    public function view(): View
    {
        return view('exports.products', [
            'records'=> $this->records,
            'categories'=> $this->categories
        ]);
    }
}
