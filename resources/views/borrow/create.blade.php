@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('borrow.index') }}" class="btn btn-success btn-sm btn-round"><i class="material-icons">arrow_back</i> Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Borrow Something</h4>
                </div>
                <div class="card-body mt-3">
                    <form method="POST" action="{{ route('borrow.store') }}">
                        @csrf

                        <div class="form-group">
                            <label class="label-floating" for="borrow_date">Borrow Date</label>

                            <input type="date" name="borrow_date" id="borrow_date"
                                class="form-control">

                            @if ($errors->has('borrow_date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('borrow_date') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="label-floating" for="return_date">Return Date</label>

                            <input type="date" name="return_date" id="return_date"
                                class="form-control">

                            @if ($errors->has('return_date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('return_date') }}</strong>
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
