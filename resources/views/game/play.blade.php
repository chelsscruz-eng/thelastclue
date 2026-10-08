@extends('layouts.game')

@section('content')

<div class="container mt-5">

    <h1>{{ $case->title }}</h1>

    <h3>{{ $scenario->name }}</h3>

    <p>{{ $scenario->description }}</p>

</div>

@endsection