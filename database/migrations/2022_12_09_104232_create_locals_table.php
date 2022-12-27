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
        Schema::create('locals', function (Blueprint $table) {
            $table->id();
            $table->string('remark');
            $table->decimal('weight',20,3);
            $table->decimal('rate', 20, 3);
            $table->decimal('total', 20, 3);
            $table->foreignId('user_id')->constrained();
            $table->string('fy');
            $table->string('credit');
            $table->softDeletes();
            $table->date('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locals');
    }
};
