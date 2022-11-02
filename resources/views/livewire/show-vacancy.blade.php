<div class="p-10">
    <div class="mb-5">
        <h3 class="font-bold text-3xl text-gray-800 my-3">
            {{ $vacancy->title}}
        </h3>    

        <div class="md:grid md:grid-cols-2 bg-gray-50 p-4 my-10 shadow-smshadow-sm sm:rounded-lg">
            <p class="font-bold text-sm uppercase text-gray-800 my-3">
                Empresa:
                <span class="normal-case font-normal">{{ $vacancy->company }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">
                Último día para postular:
                <span class="normal-case font-normal">
                    {{ $vacancy->last_day->toFormattedDateString() }}
                </span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">
                Categoría:
                <span class="normal-case font-normal">
                    {{ $vacancy->category->category }}
                </span>
            </p>
        </div>
    </div>

    <div class="md:grid md:grid-cols-6 gap-4">
        @isset( $vacancy->image )
        <div class="md:col-span-2">
            <img src="{{ asset('storage/vacancy/'.$vacancy->image) }}" alt="{{ $vacancy->title }}">                
        </div>
        @endisset

        <div class="md:col-span-4">
            <h2 class="text-2xl font-bold mb-5">Descripcion del puesto</h2>
            <p>{!! $vacancy->description !!}</p>
        </div>
    </div>

    @guest
    <div class="mt-5 bg-gray-50 border border-dashed p-5 text-center">
        <p>
            ¿Deseas postular a esta vacante? <a href="{{ route('register') }}" class="font-bold text-indigo-600">Regístrate para poder postular</a>
        </p>
    </div>        
    @endguest

    @cannot('create', App\Models\Vacancy::class)
        <livewire:apply-vacancy :vacancy="$vacancy" />
    @endcan

</div>