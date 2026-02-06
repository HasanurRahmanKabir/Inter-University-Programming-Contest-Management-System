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
        Schema::create('payment_infos', function (Blueprint $table) {
            $table->bigIncrements('payment_id');
            $table->string('team_name')->nullable()->constrained('team_registration_infos')->nullOnDelete();
            $table->string('platform')->nullable();
            $table->double('amount')->nullable();
            $table->string('transaction_id')->nullable();
            $table->boolean('payment_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_infos');
    }
};
