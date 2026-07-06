<?php
//app/Repositories/PlayerNoteRepositoryInterface.php
namespace App\Repositories;

use App\Models\PlayerNote;
use Illuminate\Database\Eloquent\Collection;

interface PlayerNoteRepositoryInterface
{
    public function getNotesForPlayer(int $playerId): Collection;
    public function createNote(int $playerId, int $userId, string $content): PlayerNote;
}
