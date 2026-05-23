@if (setting('about')->status)
    
@php
    $aboutHighlights = setting('about')->getValue('highlights') ?? [];
    $highlight0 = $aboutHighlights[0] ?? null;
    $highlight1 = $aboutHighlights[1] ?? null;
@endphp

<section class="py-24 bg-surface-container-low/30">
    <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 md:grid-cols-12 gap-16 items-center">

        {{-- Image Column --}}
        <div class="md:col-span-5 relative">
            <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                <img class="w-full h-[500px] object-cover"
                    src="{{ asset('storage/' . setting('about')->image_path) }}"
                    alt="{{ trans('site.about') }}" />
            </div>
            <div class="absolute -bottom-8 -right-8 glass-card p-6 rounded-2xl border border-white/50 shadow-xl max-w-60">
                <p class="text-primary font-black text-4xl mb-1">@setting('about', 'stat_number')</p>
                <p class="text-on-surface-variant text-sm font-semibold uppercase tracking-wider leading-tight">
                    @setting('about', 'stat_label')
                </p>
            </div>
        </div>

        {{-- Text Column --}}
        <div class="md:col-span-7">
            <h4 class="text-secondary font-bold text-sm uppercase tracking-[0.2em] mb-4">@setting('about', 'badge')</h4>

            <h2 class="text-primary font-montserrat font-black text-4xl md:text-5xl leading-tight mb-8">
                @setting('about', 'title')
            </h2>

            <p class="text-on-surface-variant text-lg leading-relaxed mb-8">
                @setting('about', 'description')
            </p>

            @if($highlight0 || $highlight1)
                <div class="grid grid-cols-2 gap-8 mb-10">
                    @if($highlight0)
                        <div class="border-l-4 border-secondary pl-4">
                            <h5 class="font-bold text-primary mb-1">{{ $highlight0->title }}</h5>
                            <p class="text-sm text-on-surface-variant">{{ $highlight0->description }}</p>
                        </div>
                    @endif
                    @if($highlight1)
                        <div class="border-l-4 border-primary pl-4">
                            <h5 class="font-bold text-primary mb-1">{{ $highlight1->title }}</h5>
                            <p class="text-sm text-on-surface-variant">{{ $highlight1->description }}</p>
                        </div>
                    @endif
                </div>
            @endif

            <a class="text-primary font-bold flex items-center gap-2 hover:gap-4 transition-all" href="#">
                @setting('about', 'learn_more')
                <span class="material-symbols-outlined">{{ app()->isLocale('ar') ? 'arrow_back' : 'arrow_forward' }}</span>
            </a>
        </div>

    </div>
</section>

@endif