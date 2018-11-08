@extends('sistema.base.base')

@section('errors')
	@component('components.body_row')
		@include('sistema.base.errors')
	@endcomponent
@endsection

@section('header')
	@include('sistema.base.header')
@endsection

@section('swal')
	@include('sistema.base.swal')
@endsection