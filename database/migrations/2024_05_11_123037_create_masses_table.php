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
        Schema::create('masses', function (Blueprint $table) {
            $table->id();
            

            $table->string('mass_intention');
            $table->longText('details');
            $table->datetime('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->text('location');
            $table->enum('status', ['pending','confirmed','cancelled'])->default('pending');
            $table->enum('is_delete',['not_deleted','deleted']);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masses');
    }
};
