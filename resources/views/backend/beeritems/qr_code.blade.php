
@extends('layouts.backend')

@section('content')

<div class="container">
    @include('../flash-messages')
    <div class="row row-cards">
        <div class="col-12  ">
            <form method="post" action="{{ route('beeritems.store') }}" enctype="multipart/form-data">
                    @csrf
            <div class="card">
                <div class="card-header">
                    <h3 class="h3 m-0 text-gray">QR code page</h3>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12"></div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        This page will be added later
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection



