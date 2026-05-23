@php
    $pillars  = setting('why_us')->getValue('pillars') ?? [];
    $features = setting('why_us')->getValue('features') ?? [];
@endphp

<section class="py-24 relative overflow-hidden bg-white">
    <div class="max-w-7xl mx-auto px-8">
        <div class="flex flex-col lg:flex-row gap-20">

            {{-- Left: Pillars --}}
            <div class="lg:w-1/3">
                <h2 class="text-primary font-montserrat font-black text-4xl md:text-5xl mb-8">
                    @setting('why_us', 'title')
                </h2>
                <p class="text-on-surface-variant text-lg mb-12">
                    @setting('why_us', 'description')
                </p>

                <div class="space-y-6">
                    @if(isset($pillars[0]))
                        <div class="p-6 bg-surface-container-low/50 rounded-2xl shadow-sm border-l-8 border-primary">
                            <h4 class="font-bold text-primary text-xl mb-2">{{ $pillars[0]->title }}</h4>
                            <p class="text-on-surface-variant">{{ $pillars[0]->description }}</p>
                        </div>
                    @endif
                    @if(isset($pillars[1]))
                        <div class="p-6 bg-surface-container-low/50 rounded-2xl shadow-sm border-l-8 border-secondary">
                            <h4 class="font-bold text-primary text-xl mb-2">{{ $pillars[1]->title }}</h4>
                            <p class="text-on-surface-variant">{{ $pillars[1]->description }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right: Feature Cards --}}
            <div class="lg:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-8 pt-12">

                @foreach ($features as $index => $feature)
                    <div class="relative group {{ $index === 1 ? 'mt-8 md:mt-16' : '' }}">
                        <div class="absolute inset-0 {{ $index === 0 ? 'bg-primary rotate-3' : 'bg-secondary -rotate-3' }} rounded-4xl group-hover:rotate-0 transition-transform duration-500"></div>
                        <div class="relative bg-white p-10 rounded-4xl h-full shadow-xl border border-outline-variant/10">
                            <h3 class="font-black text-5xl {{ $index === 0 ? 'text-primary' : 'text-secondary' }} mb-4 opacity-20">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </h3>
                            <h4 class="font-bold text-2xl text-primary mb-4">{{ $feature->title }}</h4>
                            <p class="text-on-surface-variant">{{ $feature->description }}</p>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
</section>
