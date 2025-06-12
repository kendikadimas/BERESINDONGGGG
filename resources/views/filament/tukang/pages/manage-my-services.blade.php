<x-filament-panels::page>
    <div class="mt-8">
        <h2 class="text-2xl font-bold tracking-tight">Layanan Anda</h2>

        @if($this->myServices->isNotEmpty())
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mt-6">
                @foreach($this->myServices as $service)
                    <div class="bg-amber-500 text-gray-900 font-semibold p-4 rounded-lg text-center shadow">
                        {{-- Anda bisa menambahkan ikon di sini nanti --}}
                        <span>{{ $service->name }}</span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="mt-4 text-gray-500">Anda belum menawarkan layanan apapun.</p>
        @endif
    </div>
</x-filament-panels::page>