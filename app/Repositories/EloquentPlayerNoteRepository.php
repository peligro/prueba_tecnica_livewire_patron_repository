<?php
//app/Repositories/EloquentPlayerNoteRepository.php
namespace App\Repositories;

use App\Models\PlayerNote;
use Illuminate\Database\Eloquent\Collection;

class EloquentPlayerNoteRepository implements PlayerNoteRepositoryInterface
{
    public function getNotesForPlayer(int $playerId): Collection
    {
        return PlayerNote::with('user')
            ->where('player_id', $playerId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function createNote(int $playerId, int $userId, string $content): PlayerNote
    {
        return PlayerNote::create([
            'player_id' => $playerId,
            'user_id' => $userId,
            'content' => $content,
        ]);
    }
}
