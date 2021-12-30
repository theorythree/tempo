<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('time_entries', function (Blueprint $table) {
          $table->id();
          $table->unsignedInteger('invoice_id')->nullable();
          $table->unsignedInteger('project_id');
          $table->unsignedInteger('time_sheet_id');
          $table->unsignedInteger('user_id');
          $table->integer('duration')->default(0)->nullable();
          $table->boolean('invoiced')->default(false);
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
        Schema::dropIfExists('time_entries');
    }
}
