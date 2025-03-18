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
        'product_see_type',
        'product_see_users',
        'emi_form_2',
        'inspection_form_2',
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
        'estimated_funds_2025' => 'decimal:2',
         'product_see_users' => 'array'  // JSON formatında saxlanacaq
    ];




    public function setProductSeeUsersAttribute($value)
    {
        if (is_array($value) && count($value) == 1) {
            $this->attributes['product_see_users'] = (int) reset($value); // Tək element varsa integer saxla
        } else {
            $this->attributes['product_see_users'] = json_encode(array_map('intval', (array) $value)); // Çox element varsa JSON saxla
        }
    }

    /**
     * ✅ Get Product See Users Attribute (Getter)
     * - Əgər bazada integer kimi saxlanılıbsa, integer kimi qaytarır.
     * - Əgər JSON formatındadırsa, array kimi qaytarır.
     */
    public function getProductSeeUsersAttribute($value)
    {
        if (is_numeric($value)) {
            return (int) $value; // Tək ədəd varsa integer qaytar
        }
        return json_decode($value, true) ?? []; // JSON formatındadırsa, array kimi qaytar
    }

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

    public function replies()
    {
        return $this->hasMany(Reply::class);
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
