
@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="col-md-12">@include('../flash-messages')</div>
                <div class="card">
                    <div class="card-header">Brewery Detail</div>
                    <div class="card-body">
                        <p>Brewery name: {{$brewery->brewery_name}}</p>
                        <p>Brewery description: {{$brewery->brewery_description}}</p>
                        <p>Brewery zipcode: {{$brewery->brewery_zipcode}}</p>
                        <p>Brewery town: {{$brewery->brewery_town}}</p>
                        <p>Brewery subtown: {{$brewery->brewery_subtown}}</p>
                        <p>Brewery province: {{$brewery->brewery_province}}</p>
                        <p>Brewery country: {{$brewery->brewery_country}}</p>
                        <p>Created at: {{ $brewery->created_at->format('d-m-Y \a\t h:i:s') }}</p>
                        <p>Updated at: {{ $brewery->updated_at->format('d-m-Y \a\t h:i:s') }}</p>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Brewery Photos</div>
                    <div class="card-body">
                        <div class="row gutters-sm">
                            {{--@foreach($brewery->images as $image)
                                <div class="col-sm-6">
                                <label class="imagecheck mb-6">
                                    <figure class="imagecheck-figure">
                                    <img src="{{ asset('images/' . $image->filename) }}" >
                                    </figure>
                                </label>
                                </div>
                            @endforeach
                            --}}
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>
@endsection
