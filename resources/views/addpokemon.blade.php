<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import new pokemon') }}
        </h2>
    </x-slot>

    <div class="container-fluid d-flex flex-column">
        @if(session()->get('message'))
          <div class="alert alert-danger my-2">
            {{ session()->get('message') }}
          </div>
        @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="border-b border-gray-200">
                    <form method="POST" action="{{ route('import') }}">
                        @csrf
                        <!-- Pokemon id or name -->
                            <div>
                                <x-label for="pokemon" :value="__('Enter pokemon name or id')"/>
                                <x-input id="pokemon" class="block mt-1 w-full" type="text" name="name"
                                         :value="old('name')" required autofocus/>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-3">
                                    {{ __('Import') }}
                                </x-button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>