<form 
    class="md:w-1/2 space-y-5" 
    wire:submit.prevent="editVacancy"
>
    <div>
        <x-input-label for="title" :value="__('Título vacante')" />

        <x-text-input 
            id="title" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="title" 
            :value="old('title')" 
        />

        @error('title')
            <livewire:show-alert :message="$message" />            
        @enderror
    </div>

    <div>
        <x-input-label for="company" :value="__('Empresa')" />

        <x-text-input 
            id="company" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="company" 
            :value="old('company')" 
        />

        @error('company')
            <livewire:show-alert :message="$message" />            
        @enderror
    </div>

    <div>
        <x-input-label for="category" :value="__('Categoría')" />

        <select 
            id="category" 
            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
            wire:model="category" 
        >
        <option value="">-- Seleccione --</option>
        @foreach ($categories as $category)
            <option 
                value="{{ $category->id }}" 
            >
                {{ $category->category }}
            </option>
        @endforeach
        </select>

        @error('category')
            <livewire:show-alert :message="$message" />            
        @enderror
    </div>

    <div>
        <x-input-label for="last_day" :value="__('Ultimo día para postular')" />

        <x-text-input 
            id="last_day" 
            class="block mt-1 w-full" 
            type="date" 
            wire:model="last_day" 
            :value="old('last_day')" 
        />

        @error('last_day')
            <livewire:show-alert :message="$message" />            
        @enderror
    </div>
    
    <div>
        <x-input-label for="description" :value="__('Descripción de la oferta ')" />

        <textarea 
            wire:model="description" 
            id="description" 
            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
        ></textarea>

        @error('description')
            <livewire:show-alert :message="$message" />            
        @enderror
    </div>

    <div>
        <x-input-label for="image" :value="__('Imagen')" />

        <x-text-input 
            id="image" 
            class="block mt-1 w-full" 
            type="file" 
            wire:model="new_image" 
            accept="image/*"
        />


        <div class="my-5 w-80">
            @if( $new_image )
            <x-input-label :value="__('Nueva imagen')" />
            <img src="{{ $new_image->temporaryUrl() }}" />
            @elseif( $image )
            <x-input-label :value="__('Imagen actual')" />
            <img src="{{ asset('storage/vacancy/'.$image) }}" />                
            @endif
        </div>
        
        @error('new_image')
            <livewire:show-alert :message="$message" />            
        @enderror
    </div>

    <x-primary-button class="w-full justify-center">
        {{ __('Guardar cambios') }}
    </x-primary-button>

</form>