<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - DecoLiving</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background:linear-gradient(135deg,#0f172a 0%,#1e1b4b 30%,#0c1a3d 60%,#0f2855 100%); min-height:100vh; }
        .orb { position:fixed; border-radius:50%; filter:blur(80px); pointer-events:none; z-index:0; }
        .orb-1 { width:500px; height:500px; background:rgba(37,99,235,0.12); top:-100px; right:-100px; }
        .orb-2 { width:400px; height:400px; background:rgba(6,182,212,0.08); bottom:200px; left:-100px; }
        .glass { background:rgba(30,58,138,0.3); backdrop-filter:blur(16px); border:1px solid rgba(96,165,250,0.2); border-radius:1.25rem; }
        .dark-input { background:rgba(15,23,42,0.5); border:1px solid rgba(96,165,250,0.3); color:#e2e8f0; border-radius:0.75rem; padding:0.75rem 1rem; width:100%; font-size:0.875rem; outline:none; transition:all 0.2s; }
        .dark-input:focus { border-color:#60a5fa; box-shadow:0 0 0 3px rgba(96,165,250,0.15); }
        .dark-input::placeholder { color:#475569; }
        .dark-input:-webkit-autofill,
        .dark-input:-webkit-autofill:hover,
        .dark-input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 1000px rgba(15,23,42,0.9) inset !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            border-color: rgba(96,165,250,0.3) !important;
        }
        .btn-primary { background:linear-gradient(135deg,#2563eb,#0ea5e9); color:white; font-weight:700; border-radius:0.75rem; padding:0.875rem 1rem; width:100%; transition:all 0.3s; box-shadow:0 4px 24px rgba(37,99,235,0.4); }
        .btn-primary:hover { opacity:0.9; transform:translateY(-1px); }
        ::-webkit-scrollbar{width:6px} ::-webkit-scrollbar-track{background:#0f172a} ::-webkit-scrollbar-thumb{background:linear-gradient(#3b82f6,#0ea5e9);border-radius:3px}
    </style>
</head>
<body class="flex items-center justify-center min-h-screen relative">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="w-full max-w-md px-4 relative z-10">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-2 mb-4">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#2563eb,#0ea5e9)">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                </div>
                <span class="text-2xl font-bold text-white">DecoLiving</span>
            </div>
            <h1 class="text-3xl font-extrabold text-white mb-1">Admin Portal</h1>
            <p class="text-blue-300 text-sm">Masuk ke panel administrasi</p>
        </div>

        <div class="glass p-8">
            @if(session('error'))
                <div class="mb-5 px-4 py-3 rounded-xl text-sm flex items-center gap-2 text-red-300" style="background:rgba(239,68,68,0.15);border:1px solid rgba(239,68,68,0.3)">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-blue-200 mb-2">Email Admin</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="dark-input" placeholder="admin@decoliving.id">
                    @error('email')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-7">
                    <label for="password" class="block text-sm font-medium text-blue-200 mb-2">Password</label>
                    <input id="password" type="password" name="password" required
                           class="dark-input" placeholder="••••••••">
                    @error('password')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-primary">
                    Masuk sebagai Admin
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="/" class="text-blue-400 hover:text-cyan-400 text-sm transition">← Kembali ke Homepage</a>
            </div>
        </div>

        <p class="text-center text-blue-500/50 text-xs mt-6">&copy; 2026 DecoLiving Indonesia. Admin Access Only.</p>
    </div>
</body>
</html>