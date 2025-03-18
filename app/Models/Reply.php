<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    // Bu sahələri mass-assignment (toplu əlavə) üçün açıq edirik
    protected $fillable = ['product_id', 'user_id', 'parent_id', 'content'];

    // Hər cavabın aid olduğu məhsulu çəkirik
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Cavabın valideynini (əgər varsa) çəkirik
    public function parent()
    {
        return $this->belongsTo(Reply::class, 'parent_id');
    }

    // Cavabı yazan istifadəçini çəkirik
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Alt cavabları (children replies) çəkirik
    public function children()
    {
        return $this->hasMany(Reply::class, 'parent_id');
    }
}
