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
                    <a href="{{ route('type.create') }}" class="btn btn-success btn-round btn-sm pull-right">Add Inventary Type</a>
                    <h4 class="card-title mt-2">Types List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>Name</td>
                                    <td>Information</td>
                                    <td colspan="2">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach($types as $row)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $row->type_name }}</td>
                                    <td>{{ $row->explanation }}</td>
                                    <td>
                                        <form action="{{ route('type.edit', $row) }}" method="get">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm btn-block">Edit</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('type.destroy', $row) }}" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-sm btn-block"
                                                onclick="return confirm('Apakah yakin ingin menghapus data ?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
