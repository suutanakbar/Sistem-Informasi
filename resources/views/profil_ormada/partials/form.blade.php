@php($profilOrmada = $profilOrmada ?? null)

<div class="grid gap-5 md:grid-cols-2">
    <label class="block">
        <span class="text-sm font-medium text-zinc-700">Nama universitas</span>
        <input name="nama_universitas" value="{{ old('nama_universitas', $profilOrmada?->nama_universitas) }}" required class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
    </label>
    <label class="block">
        <span class="text-sm font-medium text-zinc-700">Total mahasiswa universitas</span>
        <input type="number" min="0" name="total_mahasiswa_univ" value="{{ old('total_mahasiswa_univ', $profilOrmada?->total_mahasiswa_univ ?? 0) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
    </label>
    <label class="block md:col-span-2">
        <span class="text-sm font-medium text-zinc-700">Alamat universitas</span>
        <input name="alamat_universitas" value="{{ old('alamat_universitas', $profilOrmada?->alamat_universitas) }}" required class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
    </label>
    <label class="block md:col-span-2">
        <span class="text-sm font-medium text-zinc-700">Logo</span>
        <input type="file" name="logo" accept="image/*" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
    </label>
    <label class="block md:col-span-2">
        <span class="text-sm font-medium text-zinc-700">Deskripsi</span>
        <textarea name="deskripsi" rows="5" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">{{ old('deskripsi', $profilOrmada?->deskripsi) }}</textarea>
    </label>
</div>

<div class="mt-6 flex justify-end">
    <button class="rounded-md bg-zinc-950 px-4 py-2 text-sm font-medium text-white hover:bg-zinc-800">Simpan</button>
</div>
