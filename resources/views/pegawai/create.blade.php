@extends('base')
@section('title','Tambah Pegawai')
@section('menupegawai', 'underline decoration-4 underline-offset-7')
@section('content')

<section class="p-4 bg-white rounded-lg min-h-[50vh]">
    <h1 class="text-3xl font-bold text-[#C0392B] mb-6 text-center">
        Tambah Pegawai
    </h1>

    <div class="mx-auto max-w-xl">
        <form action="{{ route('pegawai.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" required
                    class="w-full rounded-md border px-3 py-2 text-sm focus:ring focus:ring-red-200">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required
                    class="w-full rounded-md border px-3 py-2 text-sm focus:ring focus:ring-red-200">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" required
                    class="w-full rounded-md border px-3 py-2 text-sm">
                    <option value="">-- Pilih Gender --</option>
                    <option value="male">Laki-laki</option>
                    <option value="female">Perempuan</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Pekerjaan</label>
                <select name="pekerjaan_id" required
                    class="w-full rounded-md border px-3 py-2 text-sm">
                    <option value="">-- Pilih Pekerjaan --</option>
                    @foreach($pekerjaan as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Status</label>
                <select name="is_active"
                    class="w-full rounded-md border px-3 py-2 text-sm">
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div>

            <div class="mb-4">
                <div class="g-recaptcha"
                    data-sitekey="6LeQHS4sAAAAAD3c43-vbkcBvT2tabb94PKVUF1S">
                </div>

                @error('g-recaptcha-response')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex justify-end gap-2 pt-4">
                <a href="{{ route('pegawai.index') }}"
                    class="rounded-md border px-4 py-2 text-sm hover:bg-gray-100">
                    Batal
                </a>
                <button type="submit"
                    class="rounded-md bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</section>

@endsection

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
