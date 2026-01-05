<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Arsip Artikel</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #E2E8F0; border-radius: 10px; }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased" x-data="{ sidebarOpen: true }">
    <div class="relative min-h-screen md:flex">
        
        <aside 
            x-show="sidebarOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed inset-y-0 left-0 z-30 w-72 bg-white shadow-2xl md:relative md:translate-x-0 border-r border-gray-100 flex flex-col"
            x-cloak>
            
            <div class="p-6 text-xl font-black text-blue-600 italic tracking-tighter border-b flex justify-between items-center">
                <span>ARSIP ARTIKEL</span>
                <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-red-500">✕</button>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-3 overflow-y-auto custom-scrollbar">
                <p class="text-[10px] font-black text-gray-400 uppercase mb-4 px-4 tracking-widest">Menu Utama</p>
                
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl text-sm font-bold {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'text-gray-600 hover:bg-blue-50' }} transition">
                    📊 <span>Ringkasan Statistik</span>
                </a>

                @if(auth()->user()->role == 'admin')
                <a href="{{ route('articles.create') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl text-sm font-bold {{ request()->routeIs('articles.create') ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'text-gray-600 hover:bg-blue-50' }} transition">
                    📥 <span>Upload Artikel Baru</span>
                </a>
                @endif

                <a href="{{ route('articles.list') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl text-sm font-bold {{ request()->routeIs('articles.list') ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'text-gray-600 hover:bg-blue-50' }} transition">
                    📖 <span>Lihat Semua Artikel</span>
                </a>
            </nav>

            <div class="p-4 border-t border-gray-100 bg-white">
                <div class="flex items-center gap-3 px-3 mb-4">
                    <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-black text-xs">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-xs font-black text-gray-800 truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-gray-400 font-bold uppercase">{{ auth()->user()->role }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 px-3 text-xs font-bold text-red-400 hover:bg-red-50 rounded-xl transition flex items-center gap-2">
                        <span>🚪</span> Keluar Akun
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            <header class="bg-white border-b border-gray-100 py-4 px-6 flex justify-between items-center z-10">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-lg bg-gray-50 text-gray-500 hover:bg-blue-50 hover:text-blue-600 transition shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                    </button>
                    <h1 class="text-sm font-black text-gray-400 uppercase tracking-widest hidden md:block">Dashboard Sistem</h1>
                </div>
                
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-[10px] font-black text-gray-400 leading-none">SERVER STATUS</p>
                        <p class="text-[10px] font-black text-green-500">ONLINE</p>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6 md:p-10 bg-gray-50 custom-scrollbar">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Artikel?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-[30px]',
                    confirmButton: 'rounded-xl px-6 py-3 font-bold',
                    cancelButton: 'rounded-xl px-6 py-3 font-bold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
</body>
</html>