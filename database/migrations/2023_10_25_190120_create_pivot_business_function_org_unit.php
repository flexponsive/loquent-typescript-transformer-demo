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
        Schema::create('pivot_business_function_org_unit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_function_id');
            $table->unsignedBigInteger('org_unit_id');
            
            $table->timestamps();

            $table->foreign('business_function_id')->references('id')->on('business_functions');
            $table->foreign('org_unit_id')->references('id')->on('org_units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_business_function_org_unit');
    }
};
