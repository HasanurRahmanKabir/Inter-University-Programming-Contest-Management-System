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
        Schema::create('team_registration_infos', function (Blueprint $table) {

            //Team Info

            $table->bigIncrements('team_id');
            $table->string('team_name');
            $table->string('institute_name')->nullable();
            $table->string('password');

            //Coach Info

            $table->string('coach_name')->nullable();
            $table->string('coach_email')->unique();
            $table->string('coach_phone')->unique();
            $table->string('coach_photo')->nullable();
            $table->string('coach_t_shirt')->nullable();

            //Member 1 Info

            $table->string('mem_1_name');
            $table->string('mem_1_student_id')->unique();
            $table->string('mem_1_email')->unique();
            $table->string('mem_1_phone')->nullable();
            $table->string('mem_1_t_shirt')->nullable();
            $table->string('mem_1_photo')->nullable();

            //Member 2 Info

            $table->string('mem_2_name');
            $table->string('mem_2_student_id')->unique();
            $table->string('mem_2_email')->unique();
            $table->string('mem_2_phone')->nullable();
            $table->string('mem_2_t_shirt')->nullable();
            $table->string('mem_2_photo')->nullable();

            //Member 3 Info

            $table->string('mem_3_name');
            $table->string('mem_3_student_id')->unique();
            $table->string('mem_3_email')->unique();
            $table->string('mem_3_phone')->nullable();
            $table->string('mem_3_t_shirt')->nullable();
            $table->string('mem_3_photo')->nullable();
            $table->boolean('is_selected')->default(0);
            $table->boolean('is_paid')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_registration_infos');
    }
};
