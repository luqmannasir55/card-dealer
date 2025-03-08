<?php

namespace App\Http\Controllers;

use App\Models\Suit;
use App\Models\CardValue;

use Illuminate\Http\Request;
use Exception;
use PDOException;
use InvalidArgumentException;
use RuntimeException;
use Throwable;

class CardController extends Controller
{
    public function dealCards(Request $request)
    {
        try {
            $n = $request->input('n');
        
            // Validate input
            if (!is_numeric($n) || $n < 0) {
                throw new InvalidArgumentException("Input is invalid"); // Error: Invalid input
            }
        
            $n = (int) $n; // Convert to integer
        
            // Handle edge case: No players
            if ($n === 0) {
                throw new InvalidArgumentException("Input is zero"); // Error: Zero input
            }
        
            // Fetch suits and values from database
            try {
                $suits = Suit::pluck('suit')->toArray();
                $values = CardValue::pluck('value')->toArray();
            } catch (QueryException $e) {
                throw new QueryException("Database error: Unable to fetch suits and values"); //Error : SQL Error
            } catch (PDOException $e) {
                throw new PDOException("Database connection failed"); //Error : DB Connection Failure
            }

            // Ensure suits and values were fetched correctly
            if (empty($suits) || empty($values)) {
                throw new RuntimeException("Suits or values are missing in the database"); //Error : Missing DB values
            }

            $deck = [];
            
            //Generate deck
            foreach ($suits as $suit) {
                foreach ($values as $num => $val) {
                    $deck[] = "$suit-$val";
                }
            }

            // Ensure deck is properly formed
            if (count($deck) !== 52) {
                throw new RuntimeException("Deck formation error");
            }

            // Shuffle deck
            if (!shuffle($deck)) {
                throw new RuntimeException("Shuffle failed");
            }
        
            //shuffle($deck);

            //distribute to players
            $players = array_fill(0, $n, []);
        
            for ($i = 0; $i < count($deck); $i++) {
                if (!isset($players[$i % $n])) {
                    throw new Exception("Invalid player array index"); // Error: Invalid player array index
                }
                $players[$i % $n][] = $deck[$i];
            }
        
            // Format output (each deck separated by space, each row separated by comma)
            $result = array_map(fn($cards) => implode(' ', $cards), $players);
            return response(implode(', ', $result));
        
        } catch (QueryException $e) {
            return response("Irregularity occurred", 500);
        } catch (PDOException $e) {
            return response("Irregularity occurred", 500);
        } catch (InvalidArgumentException $e) {
            return response("Irregularity occurred", 400);
        } catch (RuntimeException $e) {
            return response("RuntimeException: " . $e->getMessage(), 500);
        } catch (Exception $e) {
            return response("Irregularity occurred", 500);
        } catch (Throwable $e) {
            return response("Irregularity occurred", 500);
        }       
    }
}
