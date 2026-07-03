@props([
    'home' => route('home'),
    'links' => [], // [['label' => '', 'url' => '']]
])

<nav
    class="bg-tictac-primary-blue-light shadow px-6 py-3 border-white rounded-full w-max"
    {{ $attributes->merge(['class' => 'inline-flex']) }} aria-label="Breadcrumb">
    <ol class="flex items-center gap-2" role="list">
        <li>
            <div>
                @php
                    $homePageName = __('title.home')
                @endphp
                <a class="breadcrumb-link"
                    title="Back to Home"
                    href="{{ $home }}">
                    {{ $homePageName }}
                </a>
            </div>
        </li>

        @foreach ($links as $link)
            <li>
                <div class="flex items-center">
                    <svg class="size-5 text-white shrink-0" data-slot="icon" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                            clip-rule="evenodd" />
                    </svg>

                   <a class="breadcrumb-link {{ $loop->last ? 'current' : '' }} 
                        max-w-[90px] md:max-w-none truncate"
                        title="{{ $link['label'] }}"
                        href="{{ $link['url'] ?? '#' }}"
                        @if ($loop->last)
                            aria-current="page"
                            onclick="return false;"
                        @endif
                    >
                        {{ $link['label'] }}
                    </a>
                </div>
            </li>
        @endforeach
    </ol>
</nav>
