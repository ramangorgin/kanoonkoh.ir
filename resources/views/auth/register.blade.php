<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- نام -->
        <div>
            <x-input-label for="first_name" value="نام"/>
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" required autofocus />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2"/>
        </div>

        <!-- نام خانوادگی -->
        <div class="mt-4">
            <x-input-label for="last_name" value="نام خانوادگی"/>
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" required />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2"/>
        </div>

        <!-- ایمیل -->
        <div class="mt-4">
            <x-input-label for="email" value="ایمیل"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- رمز عبور -->
        <div class="mt-4">
            <x-input-label for="password" value="رمز عبور"/>
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- تایید رمز عبور -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="تایید رمز عبور"/>
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                ثبت‌نام
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
