@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('user.index') }}" class="btn btn-success btn-sm btn-round"><i class="material-icons">arrow_back</i> Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Edit User</h4>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ route('user.update', $user) }}" method="post">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="level_id">Level</label>
                            <select name="level_id" id="level_id" class="form-control">
                                <option disabled selected>--choose level--</option>
                                <option style="color: #000;" value="1" 
                                @if( $user->level_id == 1 )  
                                 selected
                                @endif>Admin</option>
                                <option style="color: #000;" value="2"
                                @if( $user->level_id == 2 )  
                                 selected
                                @endif>Operator</option>
                                <option style="color: #000;" value="3"
                                @if( $user->level_id == 3 )  
                                 selected
                                @endif>Employee</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-round btn-block">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
