<section class="py-20 px-8">
    <div class="max-w-7xl mx-auto signature-gradient rounded-[3rem] p-12 md:p-24 text-center relative overflow-hidden">

        {{-- Decorative Blobs --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl -mr-48 -mt-48"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-secondary/10 rounded-full blur-3xl -ml-48 -mb-48"></div>

        <h2 class="relative z-10 text-white font-montserrat font-black text-4xl md:text-6xl mb-8">
            @setting('cta', 'title')
        </h2>

        <p class="relative z-10 text-white/70 text-xl md:text-2xl max-w-2xl mx-auto mb-12">
            @setting('cta', 'description')
        </p>

        <div class="relative z-10 flex flex-wrap justify-center gap-6">
            <button class="bg-secondary text-white px-12 py-5 rounded-2xl font-bold text-xl shadow-2xl shadow-secondary/20 hover:scale-105 active:scale-95 transition-all">
                @setting('cta', 'btn_primary')
            </button>
            <button class="bg-white/10 backdrop-blur-md text-white border border-white/20 px-12 py-5 rounded-2xl font-bold text-xl hover:bg-white/20 transition-all">
                @setting('cta', 'btn_secondary')
            </button>
        </div>

    </div>
</section>
