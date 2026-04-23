{{-- Kode Buku & Judul --}}
<div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="judul">Judul Buku</label>
    <div class="col-sm-10">
        <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-book"></i></span>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                name="judul" id="judul" placeholder="Masukkan Judul Buku" 
                value="{{ old('judul', $buku->judul ?? '') }}" required />
        </div>
        @error('judul') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
</div>

{{-- Pengarang --}}
<div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="pengarang">Pengarang</label>
    <div class="col-sm-10">
        <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-user"></i></span>
            <input type="text" class="form-control @error('pengarang') is-invalid @enderror" 
                name="pengarang" id="pengarang" placeholder="Nama Pengarang" 
                value="{{ old('pengarang', $buku->pengarang ?? '') }}" required />
        </div>
        @error('pengarang') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
</div>

{{-- Penerbit --}}
<div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="penerbit">Penerbit</label>
    <div class="col-sm-10">
        <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-buildings"></i></span>
            <input type="text" class="form-control @error('penerbit') is-invalid @enderror" 
                name="penerbit" id="penerbit" placeholder="Nama Penerbit" 
                value="{{ old('penerbit', $buku->penerbit ?? '') }}" required />
        </div>
        @error('penerbit') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
</div>

{{-- Tahun & Stok --}}
<div class="row">
    <div class="col-md-6">
        <div class="row mb-3">
            <label class="col-sm-4 col-form-label" for="tahun">Tahun</label>
            <div class="col-sm-8">
                <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                    <input type="number" class="form-control @error('tahun') is-invalid @enderror" 
                        name="tahun" id="tahun" placeholder="YYYY" 
                        value="{{ old('tahun', $buku->tahun ?? '') }}" required />
                </div>
                @error('tahun') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row mb-3">
            <label class="col-sm-4 col-form-label" for="stok">Stok</label>
            <div class="col-sm-8">
                <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-archive"></i></span>
                    <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                        name="stok" id="stok" placeholder="0" 
                        value="{{ old('stok', $buku->stok ?? 0) }}" required />
                </div>
                @error('stok') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>
</div>

{{-- Sinopsis --}}
<div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="sinopsis">Sinopsis</label>
    <div class="col-sm-10">
        <textarea class="form-control @error('sinopsis') is-invalid @enderror" 
            name="sinopsis" id="sinopsis" rows="3" 
            placeholder="Ringkasan buku...">{{ old('sinopsis', $buku->sinopsis ?? '') }}</textarea>
        @error('sinopsis') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
</div>

{{-- Kategori & Rak --}}
<div class="row mb-3">
    <label class="col-sm-2 col-form-label">Kategori & Rak</label>
    <div class="col-sm-5">
        <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
            <option value="">Pilih Kategori</option>
            @foreach($kategoris as $item)
                <option value="{{ $item->id }}" {{ old('kategori_id', $buku->kategori_id ?? '') == $item->id ? 'selected' : '' }}>
                    {{ $item->nama_kategori }}
                </option>
            @endforeach
        </select>
        @error('kategori_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="col-sm-5">
        <select name="rak_id" class="form-select @error('rak_id') is-invalid @enderror" required>
            <option value="">Pilih Rak</option>
            @foreach($raks as $item)
                <option value="{{ $item->id }}" {{ old('rak_id', $buku->rak_id ?? '') == $item->id ? 'selected' : '' }}>
                    {{ $item->nama_rak }}
                </option>
            @endforeach
        </select>
        @error('rak_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
</div>

{{-- Foto Sampul --}}
<div class="row mb-4">
    <label class="col-sm-2 col-form-label">Foto Sampul</label>
    <div class="col-sm-10">
        <input type="file" name="foto" id="upload" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
        <div class="mt-2">
            @php
                $preview = isset($buku->foto) ? asset('storage/'.$buku->foto) : asset('assets/img/elements/buku.jpg');
            @endphp
            <img src="{{ $preview }}" alt="Preview" class="d-block rounded" height="100" id="uploadedAvatar" />
        </div>
        @error('foto') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
</div>