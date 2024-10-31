<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('send_promotions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
        $table->foreignId('promotion_id')->constrained('promotions')->onDelete('cascade');
        $table->timestamp('send_date')->nullable();
        $table->string('status', 20)->default('pending');
        $table->timestamps();
    });
}

};
