<?php

namespace App\Livewire;

use App\Models\User;
use Auth;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class Todo extends Component
{
    use WithPagination;

    #[Validate('required|min:5')]
    public string $todo = ''; // zmienna z formularza dodawania

    public bool $success = false;

    public int $edit; // id edytowanej pozycji

    #[Validate('required|min:5')]
    public string $edited; // edytowana tresc

    public function render(): View
    {
        $todos = auth()->user()->todos()->latest()->paginate(3);

        return view('livewire.todo', compact('todos'));
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

    public function editId($edit): void
    {
        $this->edit = $edit;
        $this->edited = auth()->user()->todos()->find($edit)->todo;
    }

    public function cancel()
    {
        $this->reset('edit');
    }

    public function delete($edit)
    {
        $todo = auth()->user()->todos()->find($edit);
        $todo->delete();
    }

    public function mark($edit)
    {
        $todo = auth()->user()->todos()->find($edit);
        return ($todo->completed) ? $todo->update(['completed' => false]) : $todo->update(['completed' => true]);
    }

    public function update($edit)
    {
        $this->validateOnly('edited');
        $todo = auth()->user()->todos()->find($edit);
        $todo->update(['todo' => $this->edited]);
        $this->reset('edit');
    }
}
