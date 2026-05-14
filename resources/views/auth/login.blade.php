<x-guest-layout>
<style>.dark-input{background:rgba(15,23,42,0.5);border:1px solid rgba(96,165,250,0.3);color:#e2e8f0;border-radius:0.75rem;padding:0.75rem 1rem;width:100%;font-size:0.875rem;outline:none;transition:all 0.2s;}.dark-input:focus{border-color:#60a5fa;box-shadow:0 0 0 3px rgba(96,165,250,0.15);}.dark-input::placeholder{color:#475569;}.dark-input:-webkit-autofill,.dark-input:-webkit-autofill:hover,.dark-input:-webkit-autofill:focus{-webkit-box-shadow:0 0 0 1000px rgba(15,23,42,0.9) inset !important;-webkit-text-fill-color:#e2e8f0 !important;border-color:rgba(96,165,250,0.3) !important;}</style>
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-white">Selamat Datang Kembali</h1>
        <p class="text-sm text-blue-300 mt-1">Masuk ke akun DecoLiving Anda</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-blue-200 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="dark-input"
                placeholder="nama@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-blue-200 mb-1">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="dark-input"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-blue-200">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-800 font-medium" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <button type="submit" class="w-full mt-6 px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-200 text-sm">
            Masuk
        </button>

        <p class="text-center text-sm text-blue-300 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-cyan-400 hover:text-cyan-300 font-semibold">Daftar sekarang</a>
        </p>
    </form>
</x-guest-layout>
