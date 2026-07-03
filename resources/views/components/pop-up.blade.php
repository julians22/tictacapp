<x-modal model="openPopUp">
    <div class="flex items-center justify-center w-full h-full p-4">
        <div @class([
            'relative',
            'slider-outer-shadow rounded-4xl bg-card-blue p-2 md:p-3' => db_config('pop-up.enable_container'),
        ])>
            <div @class([
                'relative bg-white rounded-3xl',
                'slider-inner-shadow p-2 md:p-3' => db_config('pop-up.enable_container'),
            ])>
                @if (db_config('pop-up.image'))
                    @if (db_config('pop-up.url'))
                        <a href="{{ db_config('pop-up.url') }}" target="_blank">
                    @endif
                    <img
                        src="{{ asset('storage/' . db_config('pop-up.image')) }}"
                        alt=""
                        class="block mx-auto w-auto h-auto max-w-[90vw] md:max-w-[80vw] lg:max-w-[900px] max-h-[75vh] md:max-h-[85vh] object-contain rounded-xl"
                    >
                    @if (db_config('pop-up.url'))
                        </a>
                    @endif
                @endif
            </div>
            <button
                type="button"
                @click="openPopUp = false"
                class="absolute -top-4 -right-4 md:-top-6 md:-right-6 z-50"
            >
                <img
                    src="{{ asset('img/close-icon.png') }}"
                    class="w-10 h-10 md:w-14 md:h-14"
                    alt="Close"
                >
            </button>
        </div>
    </div>
</x-modal>