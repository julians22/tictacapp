<?php

use App\Models\Activity;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::tictack', ['bg' => "before:bg-[url('../assets/bg/tictactivity-bg-island.png')]"])] class extends Component
{
    use WithPagination;

    #[Url('category', except: 'all')]
    public string $selectedCategory = 'all';

    public function mount()
    {
        seo()
            ->title(__('seo.event.title'), false)
            ->description(__('seo.event.description'));
    }

    #[Computed()]
    public function activities()
    {
        return Activity::with('category')
            ->when($this->selectedCategory !== 'all', function ($query) {
                return $query->whereRelation('category', 'slug', '=', $this->selectedCategory);
            })
            ->paginate(8);
    }

    #[Computed()]
    public function categories()
    {
        return Activity::all()->pluck('category')->unique();
    }

    public function handleCategoryChange(?string $slug = null)
    {
        if ($this->selectedCategory === 'all' && ($slug === 'all' || ! $slug)) {
            $this->skipRender();

            return;
        }

        if ($slug) {
            if ($slug === $this->selectedCategory) {
                $this->skipRender();
            } else {
                $this->selectedCategory = $slug;
            }
        } else {
            $this->selectedCategory = 'all';
        }

        $this->dispatch('content-changed');

        $this->resetPage();
    }
};
?>

<div class="mx-auto px-4 max-w-384">
    @push('plugin-scripts')
    @vite(['resources/js/slider.js', 'resources/js/gsap.js'])
    @endpush
    <div class="max-md:hidden top-[7%] left-[1%] z-0 absolute w-[13vw]">
        <div class="relative w-full h-full">
            <img class="absolute w-auto h-auto cloud" data-direction="right" data-speed="1"
                src="{{ asset('img/cloud.png') }}" alt="" style="width: 290px; height: auto;">
        </div>
    </div>

    <div class="flex flex-wrap justify-between gap-4 clamp-[mb,12,28]">
        <x-breadcrumb :links="[['label' => 'Tictactivity', 'url' => route('tictactivity.index')]]" />

        <div class="flex flex-wrap items-center text-white clamp-[gap,2,4]" wire:transition>

            <x-button :selected="$selectedCategory === 'all'" wire:click="handleCategoryChange">{{__("global.all")}}</x-button>

            @foreach ($this->categories as $category)
            <x-button :selected="$category->slug === $selectedCategory"
                wire:click="handleCategoryChange('{{ $category->slug }}')">{{ $category->name }}</x-button>
            @endforeach

        </div>
    </div>

    <x-slider.slider id="activitySlider" :items="$this->activities" routeName="tictactivity" />

    {{ $this->activities->links() }}

</div>

<script>
    let activitySlider;

    const initSlider = () => {
        activitySlider = new window.Swiper("#activitySlider", {
            slidesPerView: 1,
            spaceBetween: 20,
            breakpoints: {
                // when window width is >= 320px
                425: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                // when window width is >= 480px
                720: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
            scrollbar: {
                el: ".swiper-scrollbar",
                draggable: true,
                snapOnRelease: true,
            },
        });

    }

    initSlider();

    Livewire.hook('morphed', ({
        el,
        component
    }) => {
        activitySlider.destroy();

        initSlider();
        if (document.querySelector('.swiper-slide')) {
            window.gsap.fromTo(".swiper-slide", {
                right: "20px",
                opacity: 0,
            }, {
                opacity: 1,
                right: "0px",
                ease: "back.out(1.7)",
                stagger: 0.1 // 0.1 seconds between when each ".box" element starts animating

            });
        }
    });
</script>
