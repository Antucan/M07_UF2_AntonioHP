@extends('layout.master')
@section('header')
    @parent
@endsection

@section('content')
<h1>{{ $title }}</h1>
<div align="center">
    <h3>{{ $count }}</h3>
</div>
@endsection

@section('footer')
    @parent
@endsection