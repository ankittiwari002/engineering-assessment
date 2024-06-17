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
        Schema::create('successful_emails', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->mediumInteger('affiliate_id');
            $table->text('envelope');
            $table->string('from', 255);
            $table->text('subject');
            $table->string('dkim',255)->default(NULL);
            $table->string('SPF',255)->default(NULL);
            $table->float('spam_score')->default(NULL);
            $table->longText('email');
            $table->longText('raw_text');
            $table->string('sender_ip',50)->default(NULL);
            $table->text('to');
            $table->timestamps();
            $table->index('affiliate_id', 'affiliate_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('successful_emails');
    }
};
