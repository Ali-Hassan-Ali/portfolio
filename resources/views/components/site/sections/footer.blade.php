<footer class="bg-white pt-16 pb-8 border-t border-outline-variant/10">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-12 px-8 md:px-16 max-w-7xl mx-auto text-right">

        {{-- Brand --}}
        <div class="text-start">
            <span class="text-xl font-bold text-primary mb-4 block">@setting('general', 'name')</span>
            <p class="text-on-surface-variant/80 text-sm leading-relaxed mb-6">
                @setting('general', 'about')
            </p>
            <div class="flex gap-4">
                <span class="material-symbols-outlined text-primary hover:text-secondary cursor-pointer">public</span>
                <span class="material-symbols-outlined text-primary hover:text-secondary cursor-pointer">mail</span>
            </div>
        </div>

        {{-- Footer Groups --}}
        @foreach (\App\Models\Menu::footer()->with('children')->get() as $group)
            <div>
                <h4 class="font-bold text-primary mb-6">{{ $group->name }}</h4>
                <ul class="space-y-4">
                    @foreach ($group->children as $child)
                        <li>
                            <a class="text-on-surface-variant/80 hover:text-primary transition-colors text-sm"
                                href="{{ $child->link }}">{{ $child->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach

    </div>

    <div class="mt-16 pt-8 border-t border-outline-variant/5 text-center px-8">
        <p class="text-on-surface-variant/60 text-xs">
            © {{ now()->year }} @setting('general', 'name'). @setting('general', 'copyright')
        </p>
    </div>
</footer>
