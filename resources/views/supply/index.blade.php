@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('inventary.index') }}" class="btn btn-success btn-sm btn-round"><i class="material-icons">arrow_back</i> Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <a href="{{ route('supply.create') }}" class="btn btn-success btn-round btn-sm pull-right">Add
                        Supply</a>
                    <h4 class="card-title mt-2">Supplies List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>Name</td>
                                    <td>Register Date</td>
                                    <td>Mount</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach($supplies as $row)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->register_date }}</td>
                                    <td>{{ $row->mount }}</td>
                                    <td>
                                        <form action="{{ route('supply.destroy', $row->id) }}" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-sm btn-block"
                                                onclick="return confirm('Apakah yakin ingin menghapus data ?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php $i++;?>
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
