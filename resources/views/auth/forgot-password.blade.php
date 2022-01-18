<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img width="100" src="{{asset('images/truck.png')}}" alt="truck logo">
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            Забули свій пароль? Без проблем. Просто повідомте нам свою адресу електронної пошти, і ми надішлемо вам електронною поштою посилання для скидання пароля, за яким ви зможете вибрати новий.
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" value="Електронна пошта" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    Посилання для скидання пароля електронною поштою
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
