<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id');
            $table->string('title')->nullable();
            $table->string('slogan')->nullable();
            $table->double('price', 15, 2);
            $table->double('discount_rate', 15, 2);
            $table->double('discount_amount', 15, 2);
            $table->string('currency');
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->dateTime('cancelled_at')->nullable();
            $table->boolean('is_cancelled')->nullable()->default(0);
            $table->boolean('is_deleted')->nullable()->default(0);
            $table->boolean('is_active')->nullable()->default(0);
            $table->boolean('is_published')->nullable()->default(0);
            $table->dateTime('booking_start_ts')->nullable();
            $table->dateTime('booking_end_ts')->nullable();
            $table->dateTime('marketing_start_ts')->nullable();
            $table->dateTime('marketing_end_ts')->nullable();
            $table->dateTime('audience_start_ts')->nullable();
            $table->dateTime('audience_end_ts')->nullable();
            $table->boolean('is_public')->nullable()->default(1);
            $table->boolean('is_closed_group')->nullable()->default(0);
            $table->integer('audience_type')->nullable();
            $table->boolean('allow_prebook')->nullable();
            $table->integer('status')->default(1);
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
