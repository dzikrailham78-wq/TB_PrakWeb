<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-4">
        
        <div class="mb-10">
            <h2 class="text-3xl font-black text-gray-800 tracking-tight">RINGKASAN SISTEM</h2>
            <p class="text-gray-400 font-medium italic">Selamat datang kembali, {{ auth()->user()->name }}.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 group hover:shadow-xl transition-all">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Artikel</p>
                <p class="text-5xl font-black text-blue-600 mt-2">{{\App\Models\Article::count() }}</p>
            </div>

            @if(auth()->user()->role == 'admin')
                <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 group hover:shadow-xl transition-all">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Like</p>
                    <p class="text-5xl font-black text-red-500 mt-2">{{\App\Models\Like::count() }}</p>
                </div>

                <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 group hover:shadow-xl transition-all">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Komentar</p>
                    <p class="text-5xl font-black text-gray-800 mt-2">{{\App\Models\Comment::count() }}</p>
                </div>

                <div class="bg-gradient-to-br from-blue-600 to-blue-800 p-8 rounded-[40px] shadow-lg text-white">
                    <p class="text-[10px] font-bold uppercase opacity-70 tracking-widest">Pengguna Aktif</p>
                    <p class="text-5xl font-black mt-2">{{\App\Models\User::count() }}</p>
                </div>
            @endif
        </div>

        <div class="mb-8">
            <h3 class="text-xl font-black text-gray-800 tracking-tight flex items-center gap-2">
                <span class="w-2 h-8 bg-blue-600 rounded-full"></span>
                DISTRIBUSI KATEGORI
            </h3>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-12">
            @php
                $categories = ['Penelitian', 'Teknologi', 'Pendidikan', 'Lainnya'];
            @endphp

            @foreach($categories as $cat)
                <div class="bg-gray-50 p-6 rounded-[30px] border border-gray-100 text-center hover:bg-white transition-all">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">{{ $cat }}</p>
                    <p class="text-3xl font-black text-gray-700">
                        {{\App\Models\Article::where('category', $cat)->count() }}
                    </p>
                    <p class="text-[10px] text-gray-400 font-bold italic mt-1">Dokumen</p>
                </div>
            @endforeach
        </div>

        @if(auth()->user()->role != 'admin')
        <div class="bg-blue-50 p-10 rounded-[50px] text-center border-2 border-dashed border-blue-100">
             <a href="{{ route('articles.list') }}" class="inline-block bg-blue-600 text-white px-10 py-4 rounded-2xl font-black shadow-lg hover:bg-blue-700 transition uppercase tracking-widest">
                BUKA ARSIP ARTIKEL 📖
            </a>
        </div>
        @endif
    </div>
</x-app-layout>