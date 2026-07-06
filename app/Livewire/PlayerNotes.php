<?php
//app/Livewire/PlayerNotes.php
namespace App\Livewire;

use Livewire\Component;
use App\Repositories\PlayerNoteRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Player;

class PlayerNotes extends Component
{
    public Player $player;
    public string $content = '';
    public Collection $notes;

    public function mount(Player $player): void
    {
        $this->player = $player;
        $this->loadNotes();
    }

    public function loadNotes(): void
    {
        $repository = app(PlayerNoteRepositoryInterface::class);
        $this->notes = $repository->getNotesForPlayer($this->player->id);
    }

    public function saveNote(): void
    {
        $this->validate([
            'content' => 'required|string|max:1000',
        ]);

        $repository = app(PlayerNoteRepositoryInterface::class);
        $repository->createNote(
            $this->player->id,
            auth()->id(),
            $this->content
        );

        $this->content = '';
        $this->loadNotes();

        session()->flash('message', 'Note created successfully.');
    }

    public function render()
    {
        return view('livewire.player-notes.player-notes');
    }
}