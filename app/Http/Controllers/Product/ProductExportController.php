<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Unit;
use Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class ProductExportController extends Controller
{
    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function create()
    {
        // Verilənlər bazasından məlumatların alınması
        $products = Product::all()->sortBy('product_name');
        $units = Unit::all()->sortBy('unit_name');
        $customers = Customer::all()->sortBy('customer_name');

        // Məhsul məlumatları üçün başlıqlar
        $product_array[] = array(
            'Obyektin adı', 'Category Id', 'Unit Id', 'Product Code', 'Stock',
            'Buying Price', 'Selling Price', 'Product Image', 'Quantity Alert',
            'Advance Debt', 'Project Completion Estimate', 'Estimated Funds 2025',
            'Customer Name', 'Unit Name' // Yeni əlavə edilən sütunlar
        );

        // Məhsul məlumatları ilə birgə müştəri və vahid məlumatlarını əlavə etmək
        foreach ($products as $product) {
            // Müştəri adı və vahid adını alırıq
            $customer_name = optional($product->customer)->name ?? 'No Customer';  // Müştəri adı (null yoxlaması ilə)
            $unit_name = optional($product->unit)->unit_name ?? 'No Unit';  // Vahid adı (null yoxlaması ilə)

            // Hər məhsul üçün məlumatları birləşdiririk
            $product_array[] = array(
                $product->name, // Məhsul adı
                $product->category_id, // Kateqoriya id
                $product->unit_id, // Vahid id
                $product->code, // Məhsul kodu
                $product->quantity, // Səbət
                $product->buying_price, // Alış qiyməti
                $product->selling_price, // Satış qiyməti
                $product->product_image, // Məhsul şəkli
                $product->quantity_alert, // Miqdar xəbərdarlığı
                $product->advance_debt, // Avans borcu
                $product->project_completion_estimate, // Layihənin tamamlanma təxmini
                $product->estimated_funds_2025, // 2025-ci il üçün təxmini fondlar
                $customer_name, // Müştərinin adı
                $unit_name,

            );
        }

        // Store metoduna məlumatları göndəririk
        $this->store($product_array);
    }

    public function store($products)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();

            // Məhsul məlumatlarının əlavə edilməsi (bir səhifəyə)
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($products, NULL, 'A1');
            $spreadSheet->getActiveSheet()->setTitle('Products');

            // Excel faylını saxlamaq
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="products.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }
}
