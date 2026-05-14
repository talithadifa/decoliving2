@extends('layouts.app')

@section('content')
<style>
.glass-card{background:rgba(30,58,138,0.25);backdrop-filter:blur(12px);border:1px solid rgba(96,165,250,0.2);border-radius:1rem;}
.glass-input{background:rgba(15,23,42,0.4);border:1px solid rgba(96,165,250,0.25);color:#e2e8f0;border-radius:0.75rem;padding:0.75rem 1rem;width:100%;font-size:0.875rem;}
.glass-input:focus{outline:none;border-color:#60a5fa;box-shadow:0 0 0 3px rgba(96,165,250,0.15);}
.glass-input::placeholder{color:#475569;}
.glass-field{background:rgba(15,23,42,0.4);border:1px solid rgba(96,165,250,0.15);border-radius:0.75rem;padding:0.75rem 1rem;display:flex;align-items:center;gap:0.75rem;}
.btn-blue{background:linear-gradient(135deg,#2563eb,#0ea5e9);color:white;font-weight:600;}
.btn-ghost{background:rgba(30,58,138,0.3);color:#93c5fd;font-weight:600;}
</style>
<h1 class="text-2xl font-bold text-white mb-8">Profil Saya</h1>

@if(session('success'))
    <div class="bg-blue-900/20 border border-blue-700/30 text-cyan-300 px-4 py-3 rounded-xl mb-6 text-sm flex items-center gap-2">
        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Left: Profile Card --}}
    <div class="lg:col-span-1 space-y-4">
        {{-- Avatar & Info --}}
        <div class="glass-card p-8 text-center">
            <div class="relative inline-block mb-5">
                <div class="w-28 h-28 rounded-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white text-4xl font-bold shadow-lg shadow-primary-200">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            </div>
            <h2 class="text-xl font-bold text-white">{{ $user->name }}</h2>
            <p class="text-sm text-blue-300 mt-1">{{ $user->email }}</p>

            <div class="flex justify-center gap-8 mt-6 pt-6 border-t border-blue-700/40">
                <div class="text-center">
                    <p class="text-2xl font-extrabold text-white">{{ $orderCount }}</p>
                    <p class="text-xs text-blue-400 uppercase tracking-wider mt-0.5">Pesanan</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-extrabold text-white">0</p>
                    <p class="text-xs text-blue-400 uppercase tracking-wider mt-0.5">Ulasan</p>
                </div>
            </div>
        </div>

        {{-- Sidebar Menu --}}
        <div class="glass-card overflow-hidden">
            <a href="{{ route('profile.index') }}" class="flex items-center justify-between px-5 py-4 text-sm font-medium text-cyan-400 border-l-4 border-cyan-400" style="background:rgba(6,182,212,0.1)">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Data Pribadi
                </div>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            <a href="{{ route('orders.tracking') }}" class="flex items-center justify-between px-5 py-4 text-sm font-medium text-blue-300 hover:text-white hover:bg-blue-800/30 transition border-l-4 border-transparent">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Pesanan Saya
                </div>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>

    {{-- Right: Profile Form --}}
    <div class="lg:col-span-2">
        <div class="glass-card p-8">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-bold text-white">Data Pribadi</h3>
                <button type="button" onclick="toggleEdit()" id="editBtn" class="flex items-center gap-2 text-primary-500 hover:text-primary-700 text-sm font-semibold transition cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    Edit Profil
                </button>
            </div>

            {{-- Display Mode --}}
            <div id="displayMode">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-xs text-blue-400 uppercase tracking-wider font-semibold mb-2">Nama Lengkap</p>
                        <div class="glass-field">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <span class="text-white font-medium">{{ $user->name }}</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-blue-400 uppercase tracking-wider font-semibold mb-2">Nomor Telepon</p>
                        <div class="glass-field">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span class="text-white font-medium">{{ $user->phone ?? 'Belum diisi' }}</span>
                        </div>
                    </div>
                </div>
                <div>
                        <p class="text-xs text-blue-400 uppercase tracking-wider font-semibold mb-2">Alamat Pengiriman</p>
                        <div class="glass-field" style="align-items:flex-start;min-height:80px">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span class="text-white font-medium">{{ $user->address ?? 'Belum diisi' }}</span>
                    </div>
                </div>
            </div>

            {{-- Edit Mode --}}
            <form method="POST" action="{{ route('profile.update') }}" id="editMode" class="hidden">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="text-xs text-blue-400 uppercase tracking-wider font-semibold mb-2 block">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $user->name }}" required class="glass-input">
                        @error('name')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="text-xs text-blue-400 uppercase tracking-wider font-semibold mb-2 block">Nomor Telepon</label>
                        <input type="text" name="phone" value="{{ $user->phone }}" placeholder="+62 812 3456 789" class="glass-input">
                    </div>
                </div>
                <div class="mb-6">
                    <label class="text-xs text-blue-400 uppercase tracking-wider font-semibold mb-2 block">Alamat Pengiriman</label>
                    <textarea name="address" rows="3" placeholder="Masukkan alamat lengkap Anda" class="glass-input resize-none">{{ $user->address }}</textarea>
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="px-8 py-3 btn-blue rounded-xl text-sm">Simpan Perubahan</button>
                    <button type="button" onclick="toggleEdit()" class="px-8 py-3 btn-ghost rounded-xl text-sm">Batal</button>
                </div>
            </form>
        </div>

        {{-- Email Info --}}
        <div class="glass-card p-8 mt-6">
            <h3 class="text-xl font-bold text-white mb-6">Keamanan Akun</h3>
            <div>
                <p class="text-xs text-blue-400 uppercase tracking-wider font-semibold mb-2">Email</p>
                <div class="glass-field">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span class="text-white font-medium">{{ $user->email }}</span>
                    <span class="ml-auto text-xs font-semibold px-3 py-1 rounded-full" style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3)">Terverifikasi</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleEdit() {
    const display = document.getElementById('displayMode');
    const edit = document.getElementById('editMode');
    const btn = document.getElementById('editBtn');
    display.classList.toggle('hidden');
    edit.classList.toggle('hidden');
    btn.classList.toggle('hidden');
}
</script>
@endsection
