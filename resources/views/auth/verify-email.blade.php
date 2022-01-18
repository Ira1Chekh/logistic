<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img width="100" src="{{asset('images/truck.png')}}" alt="truck logo">
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            Дякуємо за реєстрацію! Перш ніж почати, чи могли б ви підтвердити свою адресу електронної пошти, натиснувши посилання, яке ми щойно надіслали вам? Якщо ви не отримали електронного листа, ми з радістю надішлемо вам інший.
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                Нове посилання для підтвердження було надіслано на адресу електронної пошти, яку ви вказали під час реєстрації.
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        Відправити лист з підтвердженням
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Вийти
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
