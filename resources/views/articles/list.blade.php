<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h2 class="text-3xl font-black text-gray-800 tracking-tight flex items-center gap-3">
                    <span class="bg-blue-600 text-white p-2 rounded-2xl shadow-lg shadow-blue-200">📖</span>
                    SEMUA ARSIP ARTIKEL
                </h2>
                <p class="text-gray-400 mt-2 font-medium italic">Menampilkan seluruh daftar penelitian dan dokumen yang telah terbit.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($articles as $article)
                <div x-data="{ tab: '', replyTo: '' }" class="bg-white rounded-[40px] shadow-sm border border-gray-100 p-8 mb-6">
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="text-xl font-black text-gray-900 leading-tight">{{ $article->title }}</h3>
                        
                        <div class="flex gap-2">
                            <a href="{{ route('articles.download', $article->id) }}" class="bg-blue-50 text-blue-600 p-3 rounded-2xl">⬇️</a>
                            
                            @if(auth()->user()->role == 'admin')
                                <a href="{{ route('articles.edit', $article->id) }}" class="bg-yellow-50 text-yellow-600 p-3 rounded-2xl hover:bg-yellow-600 hover:text-white transition">
                                    ✏️
                                </a>

                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" 
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-50 text-red-600 p-3 rounded-2xl hover:bg-red-600 hover:text-white transition">🗑️</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    
                    <p class="text-gray-500 text-sm leading-relaxed mb-6 italic bg-gray-50 p-4 rounded-2xl border-l-4 border-blue-200">
                        {{ Str::limit($article->content, 150) }}
                    </p>

                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-[10px] font-black uppercase mb-4">
                        {{ $article->category }}
                    </span>

                    <div class="flex items-center gap-6 pt-4 border-t border-gray-50 mb-4">
                        @if(auth()->user()->role == 'user')
                            <form action="{{ route('like.toggle', $article->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="font-bold text-sm flex items-center gap-2 {{ $article->likes()->where('user_id', auth()->id())->exists() ? 'text-red-600' : 'text-red-400 opacity-70' }}">
                                    ❤️ {{ $article->likes->count() }} Likes
                                </button>
                            </form>
                            <button @click="tab = (tab === 'comments' ? '' : 'comments')" class="text-gray-400 font-bold text-sm flex items-center gap-2 hover:bg-gray-50 px-3 py-1 rounded-xl transition">
                                💬 {{ $article->comments->count() }} Komentar
                            </button>
                        @else
                            <button @click="tab = (tab === 'likes' ? '' : 'likes')" class="text-red-500 font-bold text-sm flex items-center gap-2 hover:bg-red-50 px-3 py-1 rounded-xl transition">
                                ❤️ {{ $article->likes->count() }} Likes
                            </button>
                            <button @click="tab = (tab === 'comments' ? '' : 'comments')" class="text-gray-400 font-bold text-sm flex items-center gap-2 hover:bg-gray-50 px-3 py-1 rounded-xl transition">
                                💬 {{ $article->comments->count() }} Komentar
                            </button>
                        @endif
                    </div>

                    @if(auth()->user()->role == 'admin')
                    <div x-show="tab === 'likes'" x-transition class="bg-red-50 rounded-3xl p-6 mt-4 border border-red-100 shadow-inner">
                        <h4 class="text-[10px] font-black text-red-800 uppercase mb-3">Daftar Penyuka</h4>
                        <div class="flex flex-wrap gap-2">
                            @forelse($article->likes as $like)
                                <span class="text-[10px] bg-white px-3 py-1.5 rounded-lg border border-red-100 font-bold text-gray-700 shadow-sm">
                                    {{ $like->user->name }}
                                </span>
                            @empty
                                <span class="text-[9px] text-gray-400 italic">Belum ada like.</span>
                            @endforelse
                        </div>
                    </div>
                    @endif

                    <div x-show="tab === 'comments'" x-transition class="bg-gray-50 rounded-3xl p-6 mt-4 border border-blue-50 shadow-inner">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-[10px] font-black text-blue-800 uppercase">Manajemen Komentar</h4>
                            <button @click="tab = ''; replyTo = ''" class="text-gray-400 text-xs">Tutup ×</button>
                        </div>

                        <div class="space-y-4 mb-6">
                            @forelse($article->comments as $comment)
                                <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm">
                                    <div class="flex justify-between items-center mb-1">
                                        <p class="text-[10px] font-bold text-blue-600">{{ $comment->user->name }}</p>
                                        @if(auth()->user()->role == 'admin')
                                            <button @click="replyTo = 'Balas ke {{ $comment->user->name }}: '" class="text-[10px] text-gray-400 hover:text-blue-600 font-bold uppercase">BALAS</button>
                                        @endif
                                    </div>
                                    <p class="text-xs text-gray-600">{{ $comment->body }}</p>
                                </div>
                            @empty
                                <p class="text-[9px] text-gray-400 italic text-center">Belum ada komentar.</p>
                            @endforelse
                        </div>

                        <form action="{{ route('comment.store', $article->id) }}" method="POST">
                            @csrf
                            <div class="flex gap-2 p-2 bg-white rounded-2xl border border-gray-200 shadow-sm">
                                <input type="text" name="body" x-model="replyTo" placeholder="Tulis komentar..." required
                                    class="flex-1 border-none bg-transparent text-sm px-2 focus:ring-0">
                                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-xl text-xs font-black uppercase hover:bg-blue-700 transition">
                                    {{ auth()->user()->role == 'admin' ? 'Kirim Balasan' : 'Kirim' }}
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>