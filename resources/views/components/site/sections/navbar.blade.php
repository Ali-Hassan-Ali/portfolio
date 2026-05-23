<nav class="fixed top-0 w-full z-50 bg-white/70 backdrop-blur-xl shadow-sm">
    <div class="flex flex-row justify-between items-center w-full px-8 py-4 max-w-8xl mx-auto">

        <div class="flex items-center gap-8">
            <a class="text-2xl font-black tracking-tighter text-primary" href="#">Digi Business</a>

            <div class="hidden md:flex gap-6 items-center">
                @foreach (\App\Models\Menu::header()->get() as $menu)
                    <a class="text-sm font-bold uppercase tracking-wider text-on-surface-variant/80 hover:text-primary transition-colors"
                        href="{{ $menu->link }}">{{ $menu->name }}</a>
                @endforeach
            </div>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('changeLanguage', app()->getLocale() === 'en' ? 'ar' : 'en') }}" class="text-on-surface-variant text-sm font-bold uppercase tracking-wider hover:text-primary transition-all">
                {{ app()->getLocale() == 'ar' ? trans('site.en') : trans('site.ar') }}
            </a>
            <button
                class="signature-gradient text-white px-6 py-2.5 rounded-xl font-bold text-sm tracking-wide shadow-lg shadow-primary/20 active:scale-95 transition-transform">
                Get Started
            </button>
        </div>

    </div>
</nav>
