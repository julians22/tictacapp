@use('Filament\Forms\Components\RichEditor\RichContentRenderer')
@use('App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\YoutubeBlock')

<x-layouts.tictack class="before:bg-[url('../assets/bg/detail-bg-island.png')]">

    <div class="bg-white/95 mx-4 sm:mx-auto px-4 py-6 rounded-2xl max-w-6xl tictalks">
        <x-breadcrumb :links="[
            [
                'label' => $type,
                'url' => route(strtolower($type) . '.index'),
            ],
            [
                'label' => $article->title,
                'url' => route('tictalks.show', ['article' => $article->slug]),
            ],
        ]" />

        <section class="flex flex-col clamp-[gap,4,8] clamp-[my,4,8]">
            <h1 class="font-sans font-bold text-[#1e246f] clamp-[text,xl,3xl]">
                {{ $article->title }}
            </h1>

            <div class="relative">
                <img
                    class="rounded-lg w-full"
                    src="{{ $article->getFirstMediaUrl('thumbnail') }}"
                    alt="{{ $article->title }}"
                >

                @if ($article->category?->slug === 'tictac-bites')
                    <div class="absolute
                            top-0 right-0
                            translate-x-1/3 -translate-y-1/3
                            w-20 h-20 md:w-32 md:h-32
                            rounded-full bg-white
                            shadow-2xl
                            flex items-center justify-center
                            z-20">
                        <img
                            src="{{ asset('img/tictac-bites.png') }}"
                            alt="Tictac Bites"
                            class="w-[92%] h-[92%] object-contain"
                        >
                    </div>
                @endif
            </div>

            <div class="prose max-w-none [&_h2]:text-[1.3rem] md:[&_h2]:text-2xl">
                {{-- {!! RichContentRenderer::make($article->content)->customBlocks([YoutubeBlock::class])->toHtml() !!} --}}
                {!! $article->content !!}
                {{-- {!! $article->renderRichContent('content') !!} --}}
            </div>

            <div class="flex flex-wrap items-center gap-4">
                <p>Tags:</p>
                @foreach ($article->tags()->get() as $tag)
                    <div class="inline-block bg-card-shadow px-6 py-1 rounded-full w-fit text-white">
                        {{ $tag->name }}
                    </div>
                @endforeach
            </div>
        </section>

        <div>
            <h2 class="font-sans font-bold text-[#1e246f] text-center clamp-[text,xl,2xl] clamp-[mb,2,4] my">Cek
                Artikel Lainnya</h2>

            <div class="gap-4 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3">
                @foreach ($otherArticles as $item)
                    <x-slider.sliderItem :item="$item" :routeName="strtolower($type)" />
                @endforeach
            </div>

        </div>

    </div>
</x-layouts.tictack>
