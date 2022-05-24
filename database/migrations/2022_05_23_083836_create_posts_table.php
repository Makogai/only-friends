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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('text')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();

            // Relationships
            $table->foreignId('post_id')->nullable()->constrained('posts');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('post_type_id')->nullable()->constrained('post_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
