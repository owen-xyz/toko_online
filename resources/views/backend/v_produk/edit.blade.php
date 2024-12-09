@extends('backend.v_layouts.app')
@section('content')
<!-- contentAwal -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('backend.produk.update', $edit->id) }}"
                    method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title"> {{$judul}} </h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Foto</label>
                                    {{-- view image --}}
                                    @if ($edit->foto)
                                    <img src="{{ asset('storage/img-produk/' . $edit->foto)}}" class="foto-preview" width="100%">
                                    <p></p>
                                    @else
                                    <img src="{{ asset('storage/img-produk/img-default.jpg') }}" class="foto-preview" width="100%">
                                    <p></p>
                                    @endif
                                    {{-- file foto --}}
                                    <input type="file" name="foto" class="form-control
                                    @error('foto') is-invalid @enderror" onchange="previewFoto()">
                                    @error('foto')
                                    <div class="invalid-feedback alert-danger">{{ $message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Status</label>
                                    
                                    <select name="status" class="form-control
                                    @error('status') is-invalid @enderror">
                                        <option value="" {{ old('status', $edit->status) =='' ? 'selected' : '' }}> -
                                            Pilih Status -</option>
                                        <option value="1" {{ old('status', $edit->status)== '1' ? 'selected' : '' }}>
                                            Public</option>
                                        <option value="0" {{ old('status', $edit->status)== '0' ? 'selected' : '' }}>
                                            Blok</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback alert-danger"
                                        role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="kategori_id" class="form-control
                                    @error('kategori_id') is-invalid @enderror">
                                        <option value="" selected> - Pilih Katagori -
                                        </option>
                                        @foreach ($kategori as $row)
                                        @if (old('kategori_id', $edit->kategori_id) == $row->id)
                                        <option value="{{ $row->id }}" selected> {{ $row->nama_kategori }} </option>
                                        @else
                                        <option value="{{ $row->id }}"> {{ $row->nama_type}} </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                    <span class="invalid-feedback alert-danger"
                                        role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <input type="text" name="nama_produk" value="{{old('nama_produk',$edit->nama_produk) }}" class="form-control @error('nama_produk') is-invalid @enderror" placeholder="Masukkan Nama Prod">
                                    @error('nama_produk')
                                    <span class="invalid-feedback alert-danger"
                                        role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Detail</label><br>
                                    <textarea name="detail" class="form-control
                                    @error('detail') is-invalid @enderror" id="ckeditor">{{ old('detail',$edit->detail)}}</textarea>
                                    @error('detail')
                                    <span class="invalid-feedback alert-danger"
                                        role="alert">
                                        WEB PROGRAMMING II 161
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" onkeypress="return hanyaAngka(event)" name="harga" value="{{ old('harga',$edit->harga) }}" class="form-control
                                    @error('harga') is-invalid @enderror" placeholder="Masukkan Harga Produk">
                                    @error('harga')
                                    <span class="invalid-feedback alert-danger"
                                        role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Berat</label>
                                    <input type="text" onkeypress="return hanyaAngka(event)" name="berat" value="{{ old('berat', $edit->berat) }}" class="form-control @error('berat') is-invalid @enderror" placeholder="Masukkan Berat Produk">
                                    @error('berat')
                                    <span class="invalid-feedback alert-danger"
                                        role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="text" onkeypress="return hanyaAngka(event)" name="stok" value="{{ old('stok',$edit->stok) }}" class="form-control
                                    @error('stok') is-invalid @enderror" placeholder="Masukkan Stok Produk">
                                    @error('stok')
                                    <span class="invalid-feedback alert-danger"
                                        role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Perbaharui</button>
                            <a href="{{ route('backend.produk.index') }}">
                                <button type="button" class="btn btn-secondary">Kembali</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- contentAkhir -->
@endsection