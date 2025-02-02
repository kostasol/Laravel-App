<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Create Client') }}
       </h2>
   </x-slot>

   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 text-gray-900">
                   <form method="POST" action="{{ route('clients.store') }}" class="space-y-6">
                       @csrf

                       <div>
                           <x-input-label for="name" :value="__('Name')" />
                           <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                           <x-input-error class="mt-2" :messages="$errors->get('name')" />
                       </div>

                       <div>
                           <x-input-label for="surname" :value="__('Surname')" />
                           <x-text-input id="surname" name="surname" type="text" class="mt-1 block w-full" :value="old('surname')" required />
                           <x-input-error class="mt-2" :messages="$errors->get('surname')" />
                       </div>

                       <div class="flex items-center gap-4">
                           <x-primary-button>{{ __('Create') }}</x-primary-button>
                           <a href="{{ route('clients.index') }}" class="text-gray-600">Cancel</a>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
</x-app-layout>