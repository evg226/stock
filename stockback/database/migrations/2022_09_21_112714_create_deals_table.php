<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Deal;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('note')->nullable();
            $table->text('additional_files')->nullable();
            $table->enum('status',Deal::STATUSES);
            $table->timestamps();

            $table->foreignId('ad_id')
                ->references('id')
                ->on('ads');
            $table->foreignId('user_id')
                ->references('id')
                ->on('users');

            $table->index(['ad_id']);
            $table->index(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deals');
    }
};
