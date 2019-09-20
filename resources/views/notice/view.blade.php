@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center font-muli">View Notice Details</h1>
            <div class="card">
                <div class="card-header text-center">{{ $dat->title }}</div>

                <div class="card-body">
                    {{ $dat->body }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
