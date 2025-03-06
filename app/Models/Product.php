<?php

namespace App\Models;

use App\Enums\TaxType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // $fillable array-də advance_debt, project_completion_estimate və estimated_funds_2025 sahələrini əlavə edirik
    public $fillable = [
        'name',
        'slug',
        'code',
        'quantity',
        'quantity_alert',
        'buying_price',
        'selling_price',
        'tax',
        'tax_type',
        'notes',
        'product_image',
        'category_id',
        'project_estimate_documents',
        'construction_permit',
        'unit_id',
        'remaining_amount',
        'supplier_id',
        'accredited_balance',
        'advance_debt',
        'project_completion_estimate',
        'estimated_funds_2025',
        'created_at',
        'updated_at'
    ];

    // $casts atributunda advance_debt, project_completion_estimate və estimated_funds_2025 sahələrini decimal olaraq təyin edirik
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'tax_type' => TaxType::class,
        'advance_debt' => 'decimal:2',
        'project_completion_estimate' => 'decimal:2',
        'estimated_funds_2025' => 'decimal:2'
    ];

    // Şəxsə görə 'slug' istifadə etmək üçün getRouteKeyName metodunu saxlayırıq

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
//    public function getSupplier()
//    {
//        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
//    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Product modeli ilə əlaqəli Category modeli üçün əlaqə


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Product modeli ilə əlaqəli Unit modeli üçün əlaqə
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    // Atributlar arasında qiymətləri çevirmək üçün (məsələn, qiymətləri bölmək və ya vurmaq) bu metodlar istifadə oluna bilər
//    protected function buyingPrice(): Attribute
//    {
//        return Attribute::make(
//            get: fn($value) => $value / 100,
//            set: fn($value) => $value * 100,
//        );
//    }

//    protected function sellingPrice(): Attribute
//    {
//        return Attribute::make(
//            get: fn($value) => $value / 100,
//            set: fn($value) => $value * 100,
//        );
//    }

    // Axtarış funksiyasını təyin edirik
    public function scopeSearch($query, $value): void
    {
        $query->where('name', 'like', "%{$value}%")
            ->orWhere('code', 'like', "%{$value}%");
    }

    // Project Estimate Documents atributunu yoxlayırıq (Yes/No formatında)
    public function getProjectEstimateDocuments(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? 'Yes' : 'No',
            set: fn($value) => $value === 'Yes',
        );
    }

    // Construction Permit atributunu yoxlayırıq (Yes/No formatında)
    public function getConstructionPermit(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? 'Yes' : 'No',
            set: fn($value) => $value === 'Yes',
        );
    }
}
