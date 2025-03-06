<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProductImportController extends Controller
{
    public function create()
    {
        return view('contracts.import');
    }

    public function store(Request $request)
    {
        // Validate the file input
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);

        $the_file = $request->file('file');

        try {
            // Load the spreadsheet
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $row_limit = $sheet->getHighestDataRow();  // Get the highest row with data
            $column_limit = $sheet->getHighestDataColumn(); // Get the highest column with data
            $row_range = range(2, $row_limit); // Start from row 2 to skip headers

            // Loop through each row and get the data
            $data = [];
            foreach ($row_range as $row) {
                $data[] = [
                    'contract_number' => $sheet->getCell('A' . $row)->getValue(),
                    'contract_date'   => $sheet->getCell('B' . $row)->getValue(),
                    'contractor_name' => $sheet->getCell('C' . $row)->getValue(),
                    'project_value'   => $sheet->getCell('D' . $row)->getValue(),
                    'contract_value'  => $sheet->getCell('E' . $row)->getValue(),
                    'allocated_funds' => $sheet->getCell('F' . $row)->getValue(),
                    'paid_amount'     => $sheet->getCell('G' . $row)->getValue(),
                    'remaining_amount'=> $sheet->getCell('H' . $row)->getValue(),
                    'accredited_balance' => $sheet->getCell('I' . $row)->getValue(),
                    'advance_debt'    => $sheet->getCell('J' . $row)->getValue(),
                    'project_completion_estimate' => $sheet->getCell('K' . $row)->getValue(),
                    'estimated_funds_2025' => $sheet->getCell('L' . $row)->getValue(),
                    'work_type'       => $sheet->getCell('M' . $row)->getValue(),
                    'funding_source'  => $sheet->getCell('N' . $row)->getValue(),
                    'notes'           => $sheet->getCell('O' . $row)->getValue(),
                ];
            }

            // Insert the data into the Contract model
            Contract::insert($data);

        } catch (Exception $e) {
            // Handle any exceptions that occur
            return redirect()
                ->route('contracts.index')
                ->with('error', 'There was a problem uploading the data!');
        }

        return redirect()
            ->route('contracts.index')
            ->with('success', 'Contracts data has been imported!');
    }
}
