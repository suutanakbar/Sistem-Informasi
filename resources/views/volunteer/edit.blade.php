<x-layouts.pemda title="Edit Volunteer - {{ $volunteer->nama }}">
    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <a href="{{ route('volunteer.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-blue-700 mb-4 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Daftar Volunteer
                </a>
                <h1 class="text-3xl font-black text-gray-900" style="font-family:'Playfair Display',serif;">Edit Data Volunteer</h1>
                <p class="mt-2 text-sm text-gray-600">{{ $volunteer->agenda->nama_agenda ?? 'N/A' }}</p>
            </div>

            <div class="border border-gray-200 rounded-sm overflow-hidden hover:shadow-md transition-shadow">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-bold text-gray-900">Form Edit Volunteer</h2>
                </div>
                
                <div class="p-6">
                    @if(session('error'))
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-sm">
                        {{ session('error') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('volunteer.update', $volunteer) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-4">
                            <div>
                                <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama', $volunteer->nama) }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Masukkan nama lengkap">
                                @error('nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $volunteer->email) }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="contoh@email.com">
                                @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="no_hp" class="block text-sm font-semibold text-gray-700 mb-2">Nomor HP</label>
                                <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $volunteer->no_hp) }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Masukkan nomor HP">
                                @error('no_hp')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="alasan" class="block text-sm font-semibold text-gray-700 mb-2">Alasan Bergabung</label>
                                <textarea name="alasan" id="alasan" rows="4"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Ceritakan mengapa Anda ingin menjadi volunteer...">{{ old('alasan', $volunteer->alasan) }}</textarea>
                                @error('alasan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center gap-4 pt-4">
                                <button type="submit" 
                                    class="bg-blue-700 text-white px-6 py-3 rounded-sm font-semibold hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                                    Simpan Perubahan
                                </button>
                                <a href="{{ route('volunteer.index') }}" 
                                    class="bg-gray-200 text-gray-700 px-6 py-3 rounded-sm font-semibold hover:bg-gray-300 transition">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.pemda>