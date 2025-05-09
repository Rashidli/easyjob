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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('vacancy_name');
            $table->string('slug');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_logo')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->text('job_responsibilities');
            $table->text('requirements');
            $table->text('working_conditions');
            $table->string('application_method');
            $table->decimal('salary', 10, 2)->nullable();
            $table->boolean('is_negotiable')->default(false); // is_razılaşma
            $table->boolean('is_active')->default(false);
            $table->boolean('is_premium')->default(false);
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraint
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
