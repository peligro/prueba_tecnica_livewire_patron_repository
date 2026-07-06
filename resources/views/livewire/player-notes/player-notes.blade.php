<div>
    {{-- resources/views/livewire/player-notes/player-notes.blade.php --}}
    <h2>Notes for {{ $player->name }}</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @can('create player note')
        <form wire:submit="saveNote" class="mb-4">
            <div class="mb-3">
                <label for="content" class="form-label">Add Note</label>
                <textarea 
                    wire:model="content" 
                    class="form-control @error('content') is-invalid @enderror" 
                    id="content" 
                    rows="3"
                    maxlength="1000"
                ></textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    @endcan

    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Author</th>
                <th>Content</th>
            </tr>
        </thead>
        <tbody>
            @forelse($notes as $note)
                <tr>
                    <td>{{ $note->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $note->user->name }}</td>
                    <td>{{ $note->content }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No notes yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>