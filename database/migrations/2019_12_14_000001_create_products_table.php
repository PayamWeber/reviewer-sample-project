<?php

use App\Models\Enums\ProductReviewableType;
use App\Models\Provider;
use App\Models\User;
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
            $table->foreignIdFor(Provider::class, 'provider_id');
            $table->foreignIdFor(User::class, 'creator_id');
            $table->string('title');
            $table->unsignedInteger('price')->default(0);
            $table->unsignedTinyInteger('vote')->default(0);
            $table->boolean('active')->default(true);
            $table->enum('reviewable_type', ProductReviewableType::caseValues())->default(ProductReviewableType::REVIEWABLE_TO_ALL);
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
