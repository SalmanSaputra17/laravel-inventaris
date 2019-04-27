@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('supply.index') }}" class="btn btn-success btn-sm btn-round"><i class="material-icons">arrow_back</i> Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Input Supplies</h4>
                </div>
                <div class="card-body mt-3">
                    <form method="POST" action="{{ route('supply.store') }}">
                        @csrf

                        <div class="form-group">
                            <label class="bmd-label-floating" for="inventary_id">Inventary</label>

                            <select name="inventary_id" id="inventary_id" class="form-control">
                                <option disabled selected>--choose inventary--</option>
                                @foreach($inventaries as $row)
                                <option style="color: #000;" value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('inventary_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('inventary_id') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="bmd-label-floating" for="mount">Mount</label>
                            <input type="number" name="mount" id="mount" class="form-control">

                            @if ($errors->has('mount'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('mount') }}</strong>
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
