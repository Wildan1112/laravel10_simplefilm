@extends('be.layouts.app')
@section('pageTitle', 'Dashboard')
@section('content')
    <h1>Hello, {{ Auth::user()->name }}</h1>
@endsection
