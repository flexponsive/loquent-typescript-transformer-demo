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
        //
        Schema::table('users', function(Blueprint $table) {
            $table->string('role')->nullable();
            $table->bigInteger('bigint_without_cast')->nullable();
            $table->json('names_of_siblings')->nullable(); // array
            $table->string('secret_question')->nullable(); // AsStringable::class
            $table->tinyInteger('is_active')->default(1); // boolean
            $table->date('cohort_month')->nullable(); // immutable_date:Y-m-01
            $table->decimal('signup_fee', 8, 2)->nullable(); // decimal:8.2
            $table->double('rand_double')->nullable(); // double
            $table->text('secret_answer')->nullable(); // encrypted
            $table->float('rand_float')->nullable();; // float
            // hashed already included for password
            $table->json('options')->nullable();; // object
            $table->unsignedInteger('login_count')->nullable(); // integer
            // real is really unclear
            // string is the default
            $table->timestamp('last_login_ts')->nullable();

            $table->unsignedBigInteger('org_unit_id')->nullable();
            $table->foreign('org_unit_id')->references('id')->on('org_units');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
