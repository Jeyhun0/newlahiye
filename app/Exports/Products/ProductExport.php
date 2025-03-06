<?php

namespace App\Exports\Products;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Exports\Products\Multisheet\ProductSheet1Export;
use App\Exports\Products\Multisheet\ProductSheet2Export;
use App\Exports\Products\Multisheet\ProductSheet3Export;

class ProductExport implements WithMultipleSheets
{
    use Exportable;
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function sheets(): array
    {
        return [
            new ProductSheet1Export($this->data['sheet1']),
            new ProductSheet2Export($this->data['sheet2']),
            new ProductSheet3Export($this->data['sheet3']),
        ];
    }
}
