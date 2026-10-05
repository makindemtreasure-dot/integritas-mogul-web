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
        Schema::create('capital_records', function (Blueprint $table) {
            $table->id();
            $table->string('shareholder_name');
            $table->string('share_class');
            $table->unsignedInteger('allocated_shares');
            $table->decimal('total_investment', 12, 2);
            $table->boolean('is_public')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capital_records');
    }
};
