@extends('admin.layout.app')

@section('title', 'Edit Agenda - Admin Desa Cimeong')
@section('header-title', 'Edit Agenda Kegiatan')

@section('content')
<div class="card bg-white dark:bg-zink-700 border border-slate-200 dark:border-zink-500 rounded-xl p-5 shadow-sm">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5 pb-4 border-b border-slate-100 dark:border-zink-600">
        <div>
            <h5 class="text-base font-semibold text-slate-800 dark:text-zink-50 mb-0.5">Edit Agenda Desa</h5>
            <p class="text-xs text-slate-500 dark:text-zink-300">Perbarui rincian kegiatan</p>
        </div>
        <a href="{{ route('admin.agenda.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg border border-slate-200 dark:border-zink-500 text-slate-600 dark:text-zink-200 hover:bg-slate-50 dark:hover:bg-zink-600 self-start sm:self-auto">
            <i data-lucide="arrow-left" class="size-4"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.agenda.update', $agenda->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
            <div class="lg:col-span-8 space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Judul Kegiatan Agenda <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('judul', $agenda->judul) }}" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Deskripsi / Detail Acara</label>
                    <textarea name="deskripsi" rows="6" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500">{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Lokasi Pelaksanaan <span class="text-red-500">*</span></label>
                    <input type="text" name="lokasi" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('lokasi', $agenda->lokasi) }}" required>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="bg-slate-50 dark:bg-zink-600/50 rounded-xl p-4 border border-slate-100 dark:border-zink-500 space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Tanggal Mulai <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_mulai" class="w-full text-xs px-3.5 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('tanggal_mulai', $agenda->tanggal_mulai ? $agenda->tanggal_mulai->format('Y-m-d') : '') }}" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="w-full text-xs px-3.5 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('tanggal_selesai', $agenda->tanggal_selesai ? $agenda->tanggal_selesai->format('Y-m-d') : '') }}">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Status Kegiatan <span class="text-red-500">*</span></label>
                        <select name="status" class="w-full text-xs px-3.5 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" required>
                            <option value="akan" {{ old('status', $agenda->status) == 'akan' ? 'selected' : '' }}>Akan Datang</option>
                            <option value="terlaksana" {{ old('status', $agenda->status) == 'terlaksana' ? 'selected' : '' }}>Terlaksana</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Foto Banner</label>
                        @if($agenda->gambar)
                            <div class="mb-2 rounded-lg overflow-hidden max-h-32 border border-slate-200 dark:border-zink-500">
                                <img src="{{ Str::startsWith($agenda->gambar, 'http') ? $agenda->gambar : asset('storage/' . $agenda->gambar) }}" class="w-full h-28 object-cover" alt="Preview">
                            </div>
                        @endif
                        <div class="relative">
                            <input type="file" name="gambar" id="gambar-agenda-edit" class="hidden" accept="image/*" onchange="updateFileName(this, 'gambar-agenda-edit-label')">
                            <label for="gambar-agenda-edit" class="flex items-center justify-center w-full px-3 py-2.5 text-xs border-2 border-dashed rounded-lg cursor-pointer border-slate-300 dark:border-zink-500 hover:border-custom-500 dark:hover:border-custom-500 bg-white dark:bg-zink-700 hover:bg-slate-50 dark:hover:bg-zink-600 transition-all">
                                <div class="text-center">
                                    <i data-lucide="image-plus" class="inline-block size-4 text-slate-400 dark:text-zink-300 mb-0.5"></i>
                                    <p class="text-slate-600 dark:text-zink-200 text-[11px]" id="gambar-agenda-edit-label">Ganti gambar (opsional)</p>
                                </div>
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="w-full flex items-center justify-center gap-1.5 px-4 py-2.5 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition-colors shadow-sm mt-2">
                        <i data-lucide="check" class="size-4"></i> Perbarui Agenda
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function updateFileName(input, labelId) {
    const label = document.getElementById(labelId);
    if (input.files && input.files[0]) {
        label.textContent = input.files[0].name;
    } else {
        label.textContent = 'Ganti gambar (opsional)';
    }
}
</script>
@endsection
