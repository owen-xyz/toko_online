@extends('backend.v_layouts.app')
@section('content')
<!-- contentAwal -->
<h3> {{$judul}} </h3>
<a href="{{ route('backend.user.create') }}">
    <button type="button">Tambah</button>
</a>
<table border="1" width="80%">
    <tr>
        <th>No</th>
        <th>Email</th>
        <th>Nama</th>
        <th>Role</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    @foreach ($index as $row)
        <tr>
            <td> {{ $loop->iteration }} </td>
            <td> {{$row->nama}} </td>
            <td> {{$row->email}} </td>
            <td> {{$row->role}} </td>
            <td> {{$row->status}} </td>
            <td>
                <a href="{{ route('backend.user.edit', $row->id) }}">
                    <button type="button">Ubah</button>
                </a>
                <form action="{{ route('backend.user.destroy', $row->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
<!-- contentAkhir -->
@endsection