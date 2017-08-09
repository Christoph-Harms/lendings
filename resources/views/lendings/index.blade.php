@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($lendings as $lending)
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Lent on {{ $lending->created_at }}</div>
                        <div class="panel-body">{{ $lending->item->name }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
