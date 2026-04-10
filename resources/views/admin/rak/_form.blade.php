<div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="nama_rak">Nama Rak</label>
    <div class="col-sm-10">
        <div class="input-group input-group-merge">
            <input type="text" name="nama_rak" id="nama_rak"class="form-control @error('nama_rak') is-invalid @enderror" placeholder="Contoh: Rak A1, Rak Sains, dll" value="{{ old('nama_rak', $rak->nama_rak ?? '') }}" />
        </div>
        @error('nama_rak')
            <div class="text-danger mt-1" style="font-size: 0.85rem;">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="lokasi">Lokasi / Detail</label>
    <div class="col-sm-10">
        <div class="input-group input-group-merge">
            <textarea name="lokasi" id="lokasi"class="form-control @error('lokasi') is-invalid @enderror" placeholder="Masukkan detail lokasi rak (misal: Lantai 1, Pojok Kanan)"rows="3">{{ old('lokasi', $rak->lokasi ?? '') }}</textarea>
        </div>
        @error('lokasi')
            <div class="text-danger mt-1" style="font-size: 0.85rem;">{{ $message }}</div>
        @enderror
    </div>
</div>