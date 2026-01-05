<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <div class="mb-8">
            <h2 class="text-3xl font-black text-gray-800 tracking-tight">UPLOAD ARTIKEL</h2>
            <p class="text-gray-400 font-medium italic">Silakan isi detail dokumen di bawah ini.</p>
        </div>

        <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 overflow-hidden relative">
            <div class="p-8 md:p-12">
                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase mb-2">Judul Artikel</label>
                        <input type="text" name="title" placeholder="Masukkan judul..." class="w-full bg-gray-50 border-none rounded-2xl p-4 shadow-sm focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase mb-2">Isi / Deskripsi</label>
                        <textarea name="content" rows="6" placeholder="Tulis deskripsi..." class="w-full bg-gray-50 border-none rounded-2xl p-4 shadow-sm focus:ring-2 focus:ring-blue-500" required></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Kategori Artikel</label>
                        <select name="category" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-gray-800 focus:ring-2 focus:ring-blue-500 shadow-sm" required>
                            <option value="" disabled selected>Pilih Kategori...</option>
                            <option value="Penelitian">Penelitian</option>
                            <option value="Teknologi">Teknologi</option>
                            <option value="Pendidikan">Pendidikan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase mb-2">File Dokumen</label>
                        <input type="file" name="file" class="block w-full text-sm text-gray-500" required>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl font-black shadow-lg hover:bg-blue-700 transition uppercase tracking-widest">
                        Publish Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>