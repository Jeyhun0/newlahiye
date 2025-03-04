<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Məlumat sahələri
            $table->string('name');
            $table->string('slug');
            $table->string('code')->unique()->nullable(); // Burada nullable() əlavə etdik
            $table->decimal('quantity', 20, 2)->nullable(); // Böyük ədədlər üçün decimal tipi
            $table->decimal('buying_price', 20, 2)->nullable()->comment('Buying Price'); // Qiymət sahəsi
            $table->decimal('selling_price', 20, 2)->nullable()->comment('Selling Price'); // Qiymət sahəsi
            $table->decimal('quantity_alert', 20, 2)->nullable(); // Çatışmazlıq xəbərdarlığı

            // Yeni əlavə olunan sahələr
            $table->decimal('advance_debt', 20, 2)->nullable(); // Advance Debt
            $table->decimal('project_completion_estimate', 20, 2)->nullable(); // Project Completion Estimate
            $table->decimal('estimated_funds_2025', 20, 2)->nullable(); // Estimated Funds for 2025

            // Boolean tipləri
            $table->boolean('project_estimate_documents')->default(false); // Project Estimate Documents
            $table->boolean('construction_permit')->default(false); // Construction Permit

            // Digər sahələr
            $table->integer('tax')->nullable();
            $table->tinyInteger('tax_type')->nullable();
            $table->text('notes')->nullable();

            // Şəkil
            $table->string('product_image')->nullable();

            // Xarici açar
            $table->foreignIdFor(\App\Models\Category::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignIdFor(\App\Models\Unit::class)->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

