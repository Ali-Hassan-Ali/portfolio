@if (setting('hero')->status)
    <section class="relative min-h-[921px] flex items-center overflow-hidden px-8">

        {{-- Background Image --}}
        <div class="absolute inset-0 z-0">
            <img class="w-full h-full object-cover opacity-15"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAJLGjfgNR9-MvNy57dmEj38mJ8MhtCMUzT0bZThUPn-xKmA7FL_kH_ylCvBqPEJGMpQqPbH1AGYmgX6pEqNOIrcgewPx5afvf9xY7ZyDPYxneeY-ZYj_KqngFYUU0JEv8RwhNLA14AckTVTqG-aE2FNLFe2GE4T4TlGq6gTBHng6UKNG3yDziphE8bQ7swJlZd-tixwzr2uHNXNsgoOr_8OEec1YtgSDoQwZfd3CArdTTFpxHYIvB6h0RNmiaxl6op0B7VU6_-IzM"
                alt="Modern corporate office interior" />
            <div class="hero-gradient-overlay absolute inset-0"></div>
        </div>

        @php
            $heroFeatures = setting('hero')->getValue('features') ?? [];
            $feature0 = $heroFeatures[0] ?? null;
            $feature1 = $heroFeatures[1] ?? null;
            $feature2 = $heroFeatures[2] ?? null;
        @endphp

        <div class="relative z-10 max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            {{-- Left: Text Content --}}
            <div>
                <span class="inline-block bg-secondary/10 text-secondary font-bold text-xs uppercase tracking-widest px-3 py-1 rounded-full mb-6">
                    @setting('hero', 'badge')
                </span>

                <h1 class="text-primary font-montserrat font-black text-5xl md:text-7xl leading-tight tracking-tighter mb-8">
                    @setting('hero', 'title')
                </h1>

                <p class="text-on-surface-variant text-xl md:text-2xl max-w-xl leading-relaxed mb-10">
                    @setting('hero', 'sub_title')
                </p>

                <div class="flex flex-wrap gap-4">
                    <button
                        class="signature-gradient text-white px-10 py-4 rounded-xl font-bold text-lg shadow-xl shadow-primary/20 flex items-center gap-2 group">
                        {{ trans('site.hero.start_journey') }}
                        <span class="material-symbols-outlined group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform">
                            {{ app()->isLocale('ar') ? 'arrow_back' : 'arrow_forward' }}
                        </span>
                    </button>
                    <button class="bg-surface-container-highest/50 backdrop-blur-md text-primary border border-outline-variant/20 px-10 py-4 rounded-xl font-bold text-lg hover:bg-surface-container-highest transition-all">
                        {{ trans('site.hero.view_cases') }}
                    </button>
                </div>
            </div>

            {{-- Right: Feature Cards --}}
            <div class="hidden lg:block relative">
                <div class="glass-card p-8 rounded-[2rem] border border-white/40 shadow-2xl relative z-20">
                    <div class="grid grid-cols-2 gap-4">

                        {{-- Feature 1: white card --}}
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-outline-variant/5">
                            <span dir="ltr" class="material-symbols-outlined text-secondary text-4xl mb-4">{{ $feature0?->icon ?? 'rocket_launch' }}</span>
                            <h3 class="font-bold text-primary text-lg mb-2">{{ $feature0?->title ?? '' }}</h3>
                            <p class="text-sm text-on-surface-variant">{{ $feature0?->description ?? '' }}</p>
                        </div>

                        {{-- Feature 2: dark primary card --}}
                        <div class="bg-primary p-6 rounded-2xl shadow-sm text-white">
                            <span dir="ltr" class="material-symbols-outlined text-secondary-fixed-dim text-4xl mb-4">{{ $feature1?->icon ?? 'bar_chart' }}</span>
                            <h3 class="font-bold text-lg mb-2">{{ $feature1?->title ?? '' }}</h3>
                            <p class="text-sm opacity-80">{{ $feature1?->description ?? '' }}</p>
                        </div>

                        {{-- Feature 3: orange full-width card --}}
                    <div class="col-span-2 vibrant-orange-accent p-6 rounded-2xl shadow-sm text-white">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="font-bold text-xl mb-1 text-white">{{ $feature2?->title ?? '' }}</h3>
                                <p class="text-sm opacity-90 text-white/90">{{ $feature2?->description ?? '' }}</p>
                            </div>
                            <span dir="ltr" class="material-symbols-outlined text-5xl text-white" style="font-variation-settings: 'FILL' 1;">{{ $feature2?->icon ?? 'star' }}</span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Decorative Blobs --}}
            <div class="absolute -top-12 -right-12 w-64 h-64 bg-secondary/10 rounded-full blur-3xl -z-10"></div>
            <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-primary/10 rounded-full blur-3xl -z-10"></div>

        </div>

    </div>

</section>
@endif
