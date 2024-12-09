@extends('backend.v_layouts.app')
@section('content')
<!-- contentAwal -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $judul }}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="kategori_id" class="form-control 
                                @error('kategori_id') is-invalid @enderror" disabled>
                                    <option value="" selected> - Pilih Kategori - </option>
                                    @foreach ($kategori as $row)
                                    <option value="{{ $row->id }}" {{ old('kategori_id',$show->kategori_id) == $row->id ? 'selected' : '' }}>
                                        {{ $row->nama_kategori }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                <span class="invalid-feedback alert-danger" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" name="nama_produk" value="{{old('nama_produk', $show->nama_produk) }}" class="form-control @error('nama_produk') is-invalid @enderror" placeholder="Masukkan Nama Produk" disabled>
                                @error('nama_produk')
                                <span class="invalid-feedback alert-danger" role="alert">
                                    {{ $message }}

                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Detail</label>
                                <textarea name="detail" class="form-control
                                
                                @endsection
<script>
document.addEventListener('DOMContentLoaded', function() {
const fotoContainer = document.getElementById('foto-container');
const addFotoButton = document.querySelector('.add-foto');
addFotoButton.addEventListener('click', function() {
const fotoRow = document.createElement('div');
fotoRow.classList.add('form-group', 'row');
fotoRow.innerHTML = `
<form action="{{ route('backend.foto_produk.store') }}" method="post"
enctype="multipart/form-data">
@csrf
<div class="col-md-12">
<input type="hidden" name="produk_id" value="{{ $show->id }}">
<input type="file" name="foto_produk[]" class="form-control
@error('foto_produk') is-invalid @enderror">
<button type="submit" class="btn btn-success">Simpan</button>
</div>
</form>
`;
fotoContainer.appendChild(fotoRow);
});
});
</script>@error('detail') is-invalid @enderror" id="ckeditor" disabled>{{ old('detail', $show->detail) }}</textarea>
                                @error('detail')
                                <span class="invalid-feedback alert-danger" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Foto Utama</label> <br>
                                <img src="{{ asset('storage/img-produk/' . $show->foto) }}"
                                    class="foto-preview" width="100%">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Foto Tambahan</label>
                            <div id="foto-container">
                                <div class="row">
                                    @foreach($show->gambar as $gambar)
                                    <div class="col-md-8">
                                        <img src="{{ asset('storage/img-produk/' . $gambar->foto) }}" width="100%">
                                    </div>
                                    <div class="col-md-4">
                                        <form action="{{route('backend.foto_produk.destroy', $gambar->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                    @endforeach
                                </div>
                                <br>
                            </div>
                            <button type="button" class="btn btn-primary add-foto mt-2">Tambah Foto</button>
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="card-body">
                        <a href="{{ route('backend.produk.index') }}">
                            <button type="button" class="btn btn-secondary">Kembali</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contentAkhir -->
 @endsection
<script>
document.addEventListener('DOMContentLoaded', function() {
const fotoContainer = document.getElementById('foto-container');
const addFotoButton = document.querySelector('.add-foto');
addFotoButton.addEventListener('click', function() {
const fotoRow = document.createElement('div');
fotoRow.classList.add('form-group', 'row');
fotoRow.innerHTML = `
<form action="{{ route('backend.foto_produk.store') }}" method="post"
enctype="multipart/form-data">
@csrf
<div class="col-md-12">
<input type="hidden" name="produk_id" value="{{ $show->id }}">
<input type="file" name="foto_produk[]" class="form-control
@error('foto_produk') is-invalid @enderror">
<button type="submit" class="btn btn-success">Simpan</button>
</div>
</form>
`;
fotoContainer.appendChild(fotoRow);
});
});
</script>