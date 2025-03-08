<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Suit;
use App\Models\CardValue;

class SuitValueSeeder extends Seeder {
    public function run() {
        // Insert Suits
        $suits = ['S', 'H', 'D', 'C'];
        foreach ($suits as $suit) {
            Suit::create(['suit' => $suit]);
        }

        // Insert Values
        $values = ['A', '2', '3', '4', '5', '6', '7', '8', '9', 'X', 'J', 'Q', 'K'];
        foreach ($values as $value) {
            CardValue::create(['value' => $value]);
        }
    }
}

