@extends('backend.v_layouts.app')
@section('content')
<!-- contentAwal -->
<div class="row">
    <div class="col-12">
        <a href="{{ route('backend.produk.create') }}">
            <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i>
                Tambah</button>
        </a>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"> {{$judul}} </h5>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($index as $row)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td> {{ $row->kategori->nama_kategori }} </td>
                                <td>
                                    @if ($row->status ==1)
                                    <span class="badge badge-success"></i>
                                        Publis</span>
                                    @elseif($row->status ==0)
                                    <span class="badge badge-secondary"></i>
                                        Blok</span>
                                    @endif
                                </td>
                                <td> {{ $row->nama_produk }} </td>
                                <td> Rp. {{ number_format($row->harga, 0, ',', '.') }}
                                </td>
                                <td> {{ $row->stok }} </td>
                                <td>
                                    <a href="{{ route('backend.produk.edit', $row->id) }}"
                                        title="Ubah Data">
                                        <button type="button" class="btn btn-cyan btn-sm"><i class="far fa-edit"></i> Ubah</button>
                                    </a>
                                    <a href="{{ route('backend.produk.show', $row->id) }}"
                                        title="Ubah Data">
                                        <button type="button" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i> Gambar</button>
                                    </a>
                                    <form method="POST" action="{{route('backend.produk.destroy', $row->id) }}" style="display: inline-block;">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-smshow_confirm" data-konf-delete="{{ $row->nama }}" title='Hapus Data'>
                                            <i class="fas fa-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contentAkhir -->
@endsection