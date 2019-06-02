
@extends('layouts.backend')

@section('content')

<div class="container">
    @include('../flash-messages')
    <div class="row row-cards">
        <div class="col-12  ">

            <div class="card">
                <div class="card-header">
                    <h3 class="h3 m-0 text-gray">Manual: how to use this website</h3>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12"></div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Getting Started</h3>
                                </div>
                                <div class="card-body">
                                    1) Create a collection<br>
                                    2) Create some tags<br>
                                    3) Create some breweries<br>
                                    4) Create some categories
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



