<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Todo extends Component
{
    #[Validate('required|min:5')]
    public string $todo = '';

    public bool $success = false;

    public function render(): View
    {
        return view('livewire.todo');
    }

    public function save(): void
    {
        $this->validate();
        \App\Models\Todo::create([
            'user_id' => auth()->id(),
            'todo' => $this->todo,
        ]);

        $this->success = true;
        $this->reset('todo');
    }
}
