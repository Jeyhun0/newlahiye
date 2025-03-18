<?php

namespace App\Livewire\Tables;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProductTable extends Component
{
    use WithPagination;

    public $perPage = 10;

    public $search = '';

    public $sortField = 'id';

    public $sortAsc = false;

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;

        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {
        $userId=Auth::id();
        $products = Product::where("product_see_type", 0)
            ->orWhere(function($query) use ($userId) {
                $query->where("product_see_type", 1)
                    ->whereJsonContains("product_see_users", $userId);  // Burada JSON içərisində istifadəçi ID-ni yoxlayaq
            })
            ->with(['category', 'unit'])
            ->search($this->search)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
        return view('livewire.tables.product-table', [
            'products' => $products
            ]);
    }
}
