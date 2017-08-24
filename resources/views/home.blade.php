@extends('layouts.app')

@section('content')

    <dashboard :user='{!! json_encode(Auth::user()) !!}'></dashboard>

@endsection
