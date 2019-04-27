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
                    <h4 class="card-title">Input Types</h4>
                </div>
                <div class="card-body mt-3">
                    <form method="POST" action="{{ route('type.store') }}">
                        @csrf

                        <div class="form-group">
                            <label class="bmd-label-floating" for="type_name">Type Name</label>

                            <input type="text" name="type_name" id="type_name"
                                class="form-control">

                            @if ($errors->has('type_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('type_name') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="bmd-label-floating" for="explanation">Explanation</label>

                            <textarea name="explanation" id="explanation" class="form-control" rows="5"></textarea>

                            @if ($errors->has('explanation'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('explanation') }}</strong>
                            </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success btn-round btn-block">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
