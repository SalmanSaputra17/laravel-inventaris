@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('home') }}" class="btn btn-success btn-sm btn-round"><i class="material-icons">arrow_back</i> Back to dashboard</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title mt-2">Reports List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="{{ route('report.generate', 'all') }}" target="_blank">Laporan semua peminjaman</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{ route('report.generate', 'today') }}" target="_blank">Laporan peminjaman hari ini</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{ route('report.generate', 'broken') }}" target="_blank">Laporan barang rusak</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
