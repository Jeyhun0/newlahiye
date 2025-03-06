<?php

namespace App\Exports\Products\Multisheet;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class ProductSheet2Export implements FromView, ShouldAutoSize, WithEvents, WithTitle
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('products.exports.multi.index2', [
            'items' => $this->data
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Mətnin sətirdən-sətirə keçməsi
                $sheet->getStyle('A1:Z1000')->getAlignment()->setWrapText(true);

                // İlk 3 sətiri sabitlə
                $sheet->freezePane('A4');

                // Sütunların avtomatik ölçülməsi
                // foreach (range('A', 'Z') as $column) {
                //     $sheet->getColumnDimension($column)->setAutoSize(true);
                // }
            },
        ];
    }

    public function title(): string
    {
        return '22.11.2024t'; // Burada istədiyiniz adı yazın
    }
}
