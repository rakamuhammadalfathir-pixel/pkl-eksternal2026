<div class="row">
    <div class="mb-3 col-md-6">
        <label class="form-label" for="name">Nama Lengkap</label>
        <input class="form-control @error('name') is-invalid @enderror" 
               type="text" name="name" id="name"
               value="{{ old('name', $anggota->user->name ?? '') }}" 
               {{ $readonly ? 'readonly' : '' }} />
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label" for="email">E-mail</label>
        <input class="form-control @error('email') is-invalid @enderror" 
               type="email" name="email" id="email"
               value="{{ old('email', $anggota->user->email ?? '') }}" 
               {{ $readonly ? 'readonly' : '' }} />
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label" for="telepon">Nomor Telepon</label>
        <input class="form-control @error('telepon') is-invalid @enderror" 
               type="text" name="telepon" id="telepon"
               value="{{ old('telepon', $anggota->user->telepon ?? '') }}" 
               {{ $readonly ? 'readonly' : '' }} />
        @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label" for="role">Role</label>
        <input class="form-control" type="text" 
               value="{{ $anggota->user->role ?? 'Anggota' }}" readonly />
    </div>

    <div class="mb-3 col-md-12">
        <label class="form-label" for="alamat">Alamat</label>
        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                  name="alamat" id="alamat" rows="3" 
                  {{ $readonly ? 'readonly' : '' }}>{{ old('alamat', $anggota->user->alamat ?? '') }}</textarea>
        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>