<div>
    <div>
        @if($success)
            <span class="block mb-4 text-green-500">Notatka dodana.</span>
        @endif
    </div>
    <form class="flex" method="POST" wire:submit.prevent="save">
        <x-text-input wire:model="todo" id="todo" class="w-full mr-2"/>
        @error('todo')
        <span class="mt-2 text-sm text-red-600">{{ $message }}</span>
        @enderror
        <x-primary-button>
            Add
        </x-primary-button>
    </form>
    <br>


    {{-- First todo --}}
    <div class="flex mt-5 py-4 justify-center justify-between">
        <div>
            <input id="green-checkbox" type="checkbox"
                   class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

        </div>
        <div>
            todo
        </div>

        <div>
            <x-secondary-button>
                Edit
            </x-secondary-button>
            <x-danger-button>
                Delete
            </x-danger-button>
        </div>

    </div>


    <div class="mt-5">
        <div>

        </div>
    </div>
</div>
