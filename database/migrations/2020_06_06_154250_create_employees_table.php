<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->string('full_name', 100);
            $table->string('role', 100);
            $table->date('employment_date');
            $table->enum('staff_type', ['contract', 'full time', 'part time']);
            $table->enum('status', ['probation', 'sacked', 'dismissed', 'worker']);
            $table->enum('salary_currency', ['NGN', 'USD'])->default('NGN');
            $table->decimal('salary', 12, 2);
            $table->timestamps();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
