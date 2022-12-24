<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purcheses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained();
          
            $table->decimal('weight');
            $table->decimal('rate',20,2);
            $table->decimal('total',20,2);
            $table->string('fy');
            $table->softDeletes();
            $table->date('created_at');
            $table->string('status')->nullable();
            $table->foreignId('user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purcheses');
    }
};
