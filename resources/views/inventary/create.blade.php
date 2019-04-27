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
                    <h4 class="card-title">Input Inventaries</h4>
                </div>
                <div class="card-body mt-3">
                    <form method="POST" action="{{ route('inventary.store') }}">
                        @csrf

                        <div class="form-group">
                            <label class="bmd-label-floating" for="name">Inventary Name</label>

                            <input type="text" name="name" id="name" class="form-control">

                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
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

                        <div class="form-group">
                            <label class="label-floating" for="type_id">Type</label>

                            <select name="type_id" id="type_id" class="form-control">
                                <option disabled selected>--choose type--</option>
                                @foreach($types as $row)
                                <option style="color: #000;" value="{{ $row->id }}">{{ $row->type_name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('type_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('type_id') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="label-floating" for="room_id">Room</label>

                            <select name="room_id" id="room_id" class="form-control">
                                <option disabled selected>--choose room--</option>
                                @foreach($rooms as $row)
                                <option style="color: #000;" value="{{ $row->id }}">{{ $row->room_name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('room_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('room_id') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="label-floating" for="register_date">Register Date</label>

                            <input type="date" name="register_date" id="register_date" class="form-control">

                            @if ($errors->has('register_date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('register_date') }}</strong>
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
