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
        Schema::create('breeds', function (Blueprint $table) {
            $table->bigIncrements('id',20);
            $table->unsignedBigInteger('sp_id')->nullable()->default(NULL);
            $table->string('name')->nullable()->default(NULL);
            $table->string('variations')->nullable()->default(NULL);
            $table->unsignedBigInteger('akc_group')->nullable()->default(NULL);
            $table->unsignedBigInteger('fci_group')->nullable()->default(NULL);
            $table->enum('cfa_group', ['Yes', 'No']);
            $table->string('club_id')->nullable()->default(NULL);
            $table->string('height_male')->nullable()->default(NULL);
            $table->string('weight_male')->nullable()->default(NULL);
            $table->string('height_female')->nullable()->default(NULL);
            $table->string('weight_female')->nullable()->default(NULL);
            $table->string('life_span')->nullable()->default(NULL);
            $table->unsignedBigInteger('country')->nullable()->default(NULL);
            $table->decimal('adapt', 10, 1)->nullable()->default(NULL);
            $table->decimal('friendly', 10, 1)->nullable()->default(NULL);
            $table->decimal('health_groom', 10, 1)->nullable()->default(NULL);
            $table->decimal('train', 10, 1)->nullable()->default(NULL);
            $table->decimal('physical', 10, 1)->nullable()->default(NULL);
            $table->longText('about')->nullable()->default(NULL);
            $table->longText('history')->nullable()->default(NULL);
            $table->longText('personality')->nullable()->default(NULL);
            $table->longText('health')->nullable()->default(NULL);
            $table->longText('care')->nullable()->default(NULL);
            $table->longText('feeding')->nullable()->default(NULL);
            $table->longText('grooming')->nullable()->default(NULL);
            $table->longText('child_pets')->nullable()->default(NULL);
            $table->string('profile_photo')->nullable()->default(NULL);
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breeds');
    }
};
