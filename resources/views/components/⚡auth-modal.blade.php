<?php

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    #[Locked]
    public $isLoginForm = false;

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public function login(): void
    {
        $baseRule = [
            'password' => ['required', 'string', Rules\Password::defaults()],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:190'],
        ];

        $this->validate($baseRule);

        $this->ensureIsNotRateLimited();

        $user = $this->validateCredentials();

        Auth::login($user, $this->remember ?? false);

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        redirect()->intended(route('home', absolute: false));
    }

    public function register(): void
    {
        $baseRule = [
            'name' => ['required', 'string', 'max:190'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:190', 'unique:'.User::class],
        ];

        $validated = $this->validate($baseRule);

        $user = User::create($validated);

        Auth::login($user);

        Session::regenerate();

        redirect(route('home', absolute: false));
    }

    /**
     * Validate the user's credentials.
     */
    protected function validateCredentials(): User
    {
        $credentials = ['email' => $this->email];

        $user = Auth::getProvider()->retrieveByCredentials([...$credentials, 'password' => $this->password]);

        if (! $user || ! Auth::getProvider()->validateCredentials($user, ['password' => $this->password])) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        return $user;
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }

    public function toggleForm()
    {
        $this->resetExcept(['isLoginForm']);
        $this->resetErrorBag();

        $this->isLoginForm = ! $this->isLoginForm;
    }

    /**
     * Validate the given reCAPTCHA token.
     * currently not used
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateRecaptcha(string $token): void
    {
        // validate Google reCaptcha.
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $token,
            'remoteip' => request()->ip(),
        ]);
        $throw = fn ($message) => throw ValidationException::withMessages(['recaptcha' => $message]);
        if (! $response->successful() || ! $response->json('success')) {
            $throw($response->json(['error-codes'])[0] ?? 'An error occurred.');
        }
        // if response was score based (the higher the score, the more trustworthy the request)
        if ($response->json('score') < 0.6) {
            $throw('We were unable to verify that you\'re not a robot. Please try again.');
        }
    }
};
?>

<div class="relative bg-card-blue slider-outer-shadow mb-10 rounded-4xl w-[90vw] md:w-[60vw] max-w-4xl clamp-[p,2,3]">
    <form wire:submit="{{ $isLoginForm ? 'login' : 'register' }}">
        <div class="relative bg-white slider-inner-shadow rounded-3xl overflow-hidden clamp-[p,4,8]">
            <div class='gap-4 grid grid-cols-1 md:grid-cols-[1fr_auto_1fr] text-tictac-primary-blue'>
                <div class="flex flex-col gap-4 font">
                    <p class="w-full font-sans font-bold text-2xl text-center">
                        {{ $isLoginForm ? 'Login' : __('auth.register_title') }}
                    </p>
                    @if ($isLoginForm)
                    <x-login-form />
                    @else
                    <x-register-form />
                    @endif
                    <p class="w-full text-center cursor-pointer" wire:click='toggleForm'>
                        {{ $isLoginForm ? __('auth.no_account_yet') : __('auth.have_account')  }}
                    </p>

                    <div class="text-center text-xs mt-2 text-gray-500">
                        <a href="{{ route('terms') }}" 
                            class="cursor-pointer underline"
                        >
                            {{ __('auth.Terms_Conditions') }}
                        </a> 
                        |
                        <a href="{{ route('privacy') }}" 
                            class="cursor-pointer underline"
                        >
                            {{ __('auth.privacy_policy') }}
                        </a>
                    </div>
                </div>

                <div class="inline-block self-stretch bg-tictac-primary-blue w-full md:w-0.5 h-full min-h-0.5 md:min-h-[1em]"></div>

                <div class="flex flex-col clamp-[gap,2,4]">
                    <p class="font-sans font-bold text-2xl text-center">{{__('auth.login_with')}}</p>
                    <div class="flex flex-col gap-2 bg-gray-100 p-4 rounded-lg">
                        {{-- <a href="{{ route('login.auth', ['provider' => 'facebook']) }}">
                        <x-facebook-login-button />
                        </a> --}}

                        {{-- <a href="{{ route('login.auth', ['provider' => 'google']) }}">
                            <x-google-login-button />
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>

        <button
            class="block -bottom-4 left-1/2 absolute bg-card-blue slider-outer-shadow rounded-full min-w-fit overflow-clip font-super-comic text-center -translate-x-1/2 cursor-pointer clamp-[p,2,3]"
            type="submit">
            <span class="block relative bg-tictac-secondary-yellow slider-inner-shadow rounded-full overflow-clip">
                <span class="block px-3 py-1 size-full font-winky-sans font-bold text-tictac-primary-blue clamp-[text,xs,xl]">Submit</span>
            </span>
        </button>
    </form>

    <div x-on:click="openAuth = false" class="absolute cursor-pointer clamp-[right,-2,-4] clamp-[top,-2,-4]">
        <img class="clamp-[size,9,14]" src="{{asset('img/close-icon.png')}}">
    </div>

</div>
