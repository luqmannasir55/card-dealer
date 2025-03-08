<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('card_suits', function (Blueprint $table) {
            $table->id();
            $table->string('suit', 1)->unique(); // S, H, D, C
            $table->timestamps();
        });

        Schema::create('card_values', function (Blueprint $table) {
            $table->id();
            $table->string('value', 2)->unique(); // A, 2-9, X, J, Q, K
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('card_suits');
        Schema::dropIfExists('card_values');
    }
};
