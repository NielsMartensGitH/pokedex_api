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
        Schema::create('move_version_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('move_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('version_group_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('move_learn_method_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('level_learned_at');
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
        Schema::dropIfExists('move_version_groups');
    }
};
