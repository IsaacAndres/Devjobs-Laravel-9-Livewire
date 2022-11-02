<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @forelse ($vacancies as $vacancy)
        <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
            <div class="space-y-3">
                <a 
                    href="{{ route('vacancy.show', ['vacancy' => $vacancy->id]) }}" 
                    class="text-xl font-bold"
                >
                    {{ $vacancy->title }}
                </a>
                <p class="text-sm text-gray-600 font-bold">{{ $vacancy->company }}</p>
                <p class="text-sm text-gray-500">
                    Último día para postular: {{ $vacancy->last_day->format('d/m/Y') }}
                </p>
            </div>
    
            <div class="flex flex-col items-stretch text-center gap-3 mt-5 md:mt-0">
                <a 
                    href="{{ route('candidates.index', $vacancy->id) }}"
                    class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase"
                >{{ $vacancy->candidates->count() }} Postulantes</a>
    
                <a 
                    href="{{ route('vacancy.edit', $vacancy->id) }}"
                    class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase"
                >Editar</a>
    
                <button 
                    wire:click="$emit('showAlert', {{ $vacancy->id }})"
                    class="bg-red-700 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase"
                >Eliminar</button>
            </div>
        </div>        
        @empty
        <p class="p-3 text-center text-sm text-gray-600">
            No hay vacantes para mostrar
        </p>        
        @endforelse
    </div>
    
    <div class="mt-10">
        {{ $vacancies->links() }}
    </div>

    @push('scripts')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        Livewire.on('showAlert', vacancyId => {
            Swal.fire({
                title: '¿Borrar vacante?',
                text: "Una vacante borrada no se puede recuperar.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Borrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteVacancy', vacancyId)
                    Swal.fire(
                    'Borrado',
                    'La vacante se borró correctamente.',
                    'success'
                    )
                }
            })
        })
        </script>
    @endpush
</div>