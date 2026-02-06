<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contest_infos', function (Blueprint $table) {
            $table->bigIncrements('contest_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('contest_start_date')->nullable();
            $table->date('contest_end_date')->nullable();
            $table->date('registration_start_date')->nullable();
            $table->date('registration_end_date')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contest_infos');
    }
};
