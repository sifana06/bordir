@extends('dashboard.layouts.app')
@section('title', 'Laporan Transaksi')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        @if ($message = Session::get('message'))
        <div class="alert alert-warning alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        @if ($message = ($error ?? false))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <div class="box box-info">
            <div class="box-header with-border">
                <div class="box-title">
                    <h4 style="margin-top: 0px; margin-bottom: 0px;">Laporan Users</h4>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(!($error ?? false))
                <a href="{{route('dashboard.cetakUser')}}" class="btn btn-primary bg-red btn-sm" target="_blank">Cetak
                    Users</a>
                @endif
                <table id="transaksi-table" class="table table-bordered table-striped" style="width:100%!important;">
                    <thead>
                        <tr>
                            <th width="10">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Verifikasi Email</th>
                            <th width="150">Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $tr => $user)
                        <tr>
                            <th width="10">{{$loop->iteration}}</th>
                            <th>{{$user->name}}</th>
                            <th>{{$user->email}}</th>
                            <th>{{$user->phone}}</th>
                            <th>{{$user->role}}</th>
                            <th>{{$user->email_verified_at == null ? 'Belum diverfied':'Sudah diverfied'}}</th>
                            <th>{{$user->created_at}}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/.col (right) -->
    @endsection

    @push('header')
    <link rel="stylesheet" href="/assets/material/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    @endpush

    @push('footer')
    <script src="/assets/material/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/material/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    @endpush