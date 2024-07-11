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
        Schema::create('operator_work_transaction', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('submitted_by',65);
            $table->date('submitted_when');
            $table->string('site_code',15);
            $table->string('activity',191);
            $table->string('uom',15);
            $table->integer('block');
            $table->string('task',15);
            $table->date('start');
            $table->date('end');
            $table->string('mesin_id',15);
            $table->integer('fuel');
            $table->string('check_by',65)->nullable();
            $table->date('check_when')->nullable();
            $table->string('verified_by',65)->nullable();
            $table->date('verified_when')->nullable();
            $table->string('duty',30);
            $table->longText('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operator_work_transaction');
    }
};
