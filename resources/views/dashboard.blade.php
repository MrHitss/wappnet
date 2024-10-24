@extends('layout.app')

@section('content')
<div class="row">
    <div class="ms-3">
        <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
        <p class="mb-4">
        Check the analytics.
        </p>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                <div>
                    <p class="text-sm mb-0 text-capitalize">Contacts</p>
                    <h4 class="mb-0">{{ $contacts }}</h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                    <i class="material-symbols-rounded opacity-10">weekend</i>
                </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                <div>
                    <p class="text-sm mb-0 text-capitalize">Tags</p>
                    <h4 class="mb-0">{{ $tags }}</h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                    <i class="material-symbols-rounded opacity-10">weekend</i>
                </div>
                </div>
            </div>
            
        </div>
    </div>
    
</div>
@endsection