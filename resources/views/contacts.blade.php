@extends('layout.app')

@section('content')
<div class="row">
    <div class="ms-3">
        <h3 class="mb-0 h4 font-weight-bolder">Contacts</h3>
    </div>
    @livewire('contact-list')
</div>
@endsection