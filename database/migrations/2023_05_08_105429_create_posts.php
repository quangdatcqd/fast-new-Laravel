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
            $table->string("title");
            $table->string("description");
            $table->tinyInteger("hide");
            $table->integer("sort");
            $table->string("slug");
            $table->text("content");
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("restrict");

            $table->unsignedBigInteger('category_id')->nullable();
            // KHông được phép xoá category khi có các bài đăng nằm trong danh ;mục
            $table->foreign("category_id")->references("id")->on("categories")->onDelete("restrict");
            $table->integer("views");
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
        Schema::dropIfExists('posts');
    }
};
