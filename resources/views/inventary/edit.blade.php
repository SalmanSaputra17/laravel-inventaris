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
                    <h4 class="card-title">Edit Inventary</h4>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ route('inventary.update', $inventary) }}" method="post">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label for="name">Inventary Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $inventary->name }}">
                        </div>
                        <div class="form-group">
                            <label for="type_id">Type</label>
                            <select name="type_id" id="type_id" class="form-control">
                                @foreach($types as $row)
                                <option value="{{ $row->id }}"
                                @if($row->id == $inventary->type_id)
                                    selected
                                @endif>{{ $row->type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="room_id">Room</label>
                            <select name="room_id" id="room_id" class="form-control">
                                @foreach($rooms as $row)
                                <option value="{{ $row->id }}"
                                @if($row->id == $inventary->room_id)
                                    selected
                                @endif>{{ $row->room_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="register_date">Register Date</label>
                            <input type="date" class="form-control" name="register_date" value="{{ $inventary->register_date }}">
                        </div>
                        <div class="form-group">
                            <label for="explanation">Explanation</label>
                            <textarea name="explanation" id="explanation" class="form-control" rows="5">{{ $inventary->explanation }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-round btn-block">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
