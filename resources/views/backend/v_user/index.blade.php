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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Basic Datatable</h5>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                WEB PROGRAMMING II 80
                                <td>$320,800</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contentAkhir -->
@endsection