<x-layouts.admin title="Tambah Admin" headerTitle="Tambah Admin Baru">
    <div class="max-w-2xl">
        <div class="rounded-lg border border-zinc-200 bg-white p-6">
            <form method="POST" action="{{ route('admin.store') }}">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-zinc-700">Nama</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                            class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-zinc-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-zinc-700">Password</label>
                        <input type="password" name="password" id="password" required
                            class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-zinc-700">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="peran" class="block text-sm font-medium text-zinc-700">Peran</label>
                        <select name="peran" id="peran" required
                            class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Pilih Peran</option>
                            <option value="admin" {{ old('peran') === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="pemda" {{ old('peran') === 'pemda' ? 'selected' : '' }}>Pemda</option>
                            <option value="pengurus_ormada" {{ old('peran') === 'pengurus_ormada' ? 'selected' : '' }}>Pengurus Ormada</option>
                        </select>
                        @error('peran')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-4">
                    <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                        Simpan
                    </button>
                    <a href="{{ route('admin.index') }}" class="rounded-md border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>