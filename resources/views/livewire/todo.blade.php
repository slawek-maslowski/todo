<div>
    <div>
        @if($success)
            <span class="block mb-4 text-green-500">Notatka dodana.</span>
        @endif
    </div>
    <div class="text-center pb-2">Dodaj coś do listy</div>
    <form class="flex border-solid border-gray-100 border-b-2 pb-4" method="POST" wire:submit.prevent="save">
        <x-text-input wire:model="todo" id="todo" class="w-full mr-2"/>
        @error('todo')
        <span class="mt-2 text-sm text-red-600">{{ $message }}</span>
        @enderror
        <x-primary-button>
            Dodaj
        </x-primary-button>
    </form>
    <br>

    @foreach($todos as $todo)
        <div class="flex mt-5 py-4 justify-center justify-between">
            <div>
                <input id="green-checkbox" wire:click="mark({{ $todo->id }})" @if($todo->completed) checked
                       @endif type="checkbox"
                       class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            </div>
            <div>
                @if($edit==$todo->id)
                    <x-text-input wire:model="edited" id="todo" class="w-full mr-2"/>
                    @error('edited')
                    <span class="mt-2 text-sm text-red-600">{{ $message }}</span>
                    @enderror
                @else
                    {{ $todo->todo }}
                @endif
            </div>
            <div>
                @if($edit==$todo->id)
                    <x-secondary-button wire:click="update({{ $todo->id }})">
                        Zmień
                    </x-secondary-button>
                    <x-danger-button wire:click=" cancel">
                        Anuluj
                    </x-danger-button>
                @else
                    <x-secondary-button wire:click="editId({{ $todo->id }})">
                        Edytuj
                    </x-secondary-button>
                    <x-danger-button wire:click="delete({{ $todo->id }})">
                        Usuń
                    </x-danger-button>
                @endif
            </div>
        </div>
    @endforeach


    <div class="mt-5">
        <div>
            {{ $todos->links() }}
        </div>
    </div>
</div>
