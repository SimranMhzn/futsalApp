@extends('layouts.app')

@section('content')
<h1>Welcome, {{ auth()->user()->name }}</h1>
<p>This is your futsal dashboard.</p>
@endsection
