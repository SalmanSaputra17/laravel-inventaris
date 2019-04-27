@extends('layouts.main')

@section('content')
<div class="container-fluid">
    @if(Auth::check() && Auth::user()->level_id == 1)
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">subject</i>
                  </div>
                  <p class="card-category">Inventary Types</p>
                  <h3 class="card-title">{{ $types }}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">list</i>
                    <a href="{{ route('type.index') }}" class="warning-link">See inventary type...</a>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">meeting_room</i>
                  </div>
                  <p class="card-category">Inventary Rooms</p>
                  <h3 class="card-title">{{ $rooms }}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-info">list</i>
                    <a href="{{ route('room.index') }}" class="info-link">See inventary room...</a>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">add_box</i>
                  </div>
                  <p class="card-category">Supplies</p>
                  <h3 class="card-title">{{ $supplies }}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-success">list</i>
                    <a href="{{ route('supply.index') }}" class="success-link">See inventary supply...</a>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">person</i>
                  </div>
                  <p class="card-category">Users</p>
                  <h3 class="card-title">{{ $users }}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-danger">list</i>
                    <a href="{{ route('user.index') }}" class="danger-link">See users...</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">web_asset</i>
                    </div>
                    <p class="card-category">Inventaries</p>
                    <h3 class="card-title">{{ $invenCount }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-danger">list</i>
                        <a href="{{ route('inventary.index') }}" class="danger-link">See Inventaries...</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <p class="card-category">Borrows</p>
                  <h3 class="card-title">{{ $borrows }}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-success">list</i>
                    <a href="{{ route('borrow.index') }}" class="success-link">See borrows data...</a>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">book</i>
                  </div>
                  <p class="card-category">Reports</p>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-info">list</i>
                    <a href="{{ route('report.index') }}" class="info-link">Print Reports...</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
    @elseif(Auth::check() && Auth::user()->level_id == 2)
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <p class="card-category">Borrows</p>
                  <h3 class="card-title">{{ $borrows }}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-success">list</i>
                    <a href="{{ route('borrow.index') }}" class="success-link">See borrows data...</a>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">warning</i>
                  </div>
                  <p class="card-category">Broken</p>
                  <h3 class="card-title">{{ $brokens }}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">list</i>
                    <a href="{{ route('broken.index') }}" class="warning-link">See brokens data...</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">WELCOME</h4>
            </div>
            <div class="card-body mt-3 mb-3">
                <h5 class="text-primary">Hai {{ auth()->user()->name }}, you are logged in...</h5>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
