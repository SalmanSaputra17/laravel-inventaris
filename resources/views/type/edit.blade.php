@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('type.index') }}" class="btn btn-success btn-sm btn-round"><i class="material-icons">arrow_back</i> Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Edit Type</h4>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ route('type.update', $type) }}" method="post">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label for="type_name">Type Name</label>
                            <input type="text" class="form-control" name="type_name" value="{{ $type->type_name }}">
                        </div>
                        <div class="form-group">
                            <label for="explanation">Explanation</label>
                            <textarea name="explanation" id="explanation" class="form-control" rows="5">{{ $type->explanation }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-round btn-block">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
