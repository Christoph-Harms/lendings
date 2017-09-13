@extends('layouts.app')

@section('content')

    <dashboard :user='{!! json_encode($user) !!}'></dashboard>

@endsection
