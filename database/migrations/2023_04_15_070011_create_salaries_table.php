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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->unsigned();
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->bigInteger('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->string('date_of_joining');
            $table->string('employee_category',50);
            $table->string('gross_salary',20);
            $table->string('basic_fifty_percentage_of_gross',20);
            $table->string('house_rent_fifty_percentage_of_basic',20);
            $table->string('medical_fifteen_percentage_of_basic',20);
            $table->string('convenience_ten_percentage_of_basic',20);
            $table->string('food_fifteen_percentage_of_basic',20);
            $table->string('other_allow',20);
            $table->string('bank_name');
            $table->string('bank_account_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salaries');
    }
};
