<?php
//database/seeders/PlayerSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Player;

class PlayerSeeder extends Seeder
{
    public function run(): void
    {
        Player::create([
            'name' => 'Player One',
            'email' => 'player1@test.com'
        ]);

        Player::create([
            'name' => 'Player Two',
            'email' => 'player2@test.com'
        ]);
    }
}