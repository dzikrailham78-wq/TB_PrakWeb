<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 p-10">
                <div class="mb-8">
                    <h2 class="text-2xl font-black text-gray-800 tracking-tight flex items-center gap-3">
                        <span class="bg-yellow-500 text-white p-2 rounded-2xl shadow-lg shadow-yellow-200">✏️</span>
                        EDIT ARTIKEL
                    </h2>
                    <p class="text-gray-400 mt-2 font-medium italic">Perbarui informasi artikel, konten, dan kategori penelitian.</p>
                </div>

                <form action="{{ route('articles.update', $article->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-xs font-black uppercase text-gray-400 mb-2 tracking-widest">Judul Artikel</label>
                            <input type="text" name="title" value="{{ old('title', $article->title) }}" required
                                class="w-full border-gray-100 rounded-2xl bg-gray-50 focus:ring-blue-500 focus:border-blue-500 p-4 font-bold text-gray-700">
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase text-gray-400 mb-2 tracking-widest">Kategori Penelitian</label>
                            <select name="category" required
                                class="w-full border-gray-100 rounded-2xl bg-gray-50 focus:ring-blue-500 focus:border-blue-500 p-4 font-bold text-gray-700">
                                @php
                                    $categories = ['Penelitian', 'Teknologi', 'Pendidikan', 'Lainnya'];
                                @endphp
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ $article->category == $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase text-gray-400 mb-2 tracking-widest">Isi Konten</label>
                            <textarea name="content" rows="8" required
                                class="w-full border-gray-100 rounded-2xl bg-gray-50 focus:ring-blue-500 focus:border-blue-500 p-4 text-gray-600 leading-relaxed">{{ old('content', $article->content) }}</textarea>
                        </div>
                    </div>

                    <div class="flex gap-4 mt-10">
                        <button type="submit" class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-black shadow-lg shadow-blue-200 hover:bg-blue-700 transition uppercase tracking-widest">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('articles.list') }}" class="bg-gray-100 text-gray-600 px-10 py-4 rounded-2xl font-black hover:bg-gray-200 transition uppercase tracking-widest text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>