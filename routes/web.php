<?php
// routes/web.php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\HomeComponent;
use App\Models\Player;

// Para Livewire full-page components, NO uses array syntax
Route::get('/', HomeComponent::class)->name('home_index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Aquí SÍ uso el modelo Player para route model binding
    Route::get('/players/{player}/notes', function (Player $player) {
        return view('players.notes', ['player' => $player]);
    })->name('player.notes');
});

require __DIR__.'/auth.php';