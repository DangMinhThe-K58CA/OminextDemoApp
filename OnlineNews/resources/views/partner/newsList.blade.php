@extends('layouts.partnerMaster')

@section('header')
	@parent
@endsection

@section('leftNav')
	@parent
@endsection


@section('content')
	<div>
		<h1>Xin chào !!! {{Auth::user()->name . '.----------> newss list'}}</h1>
	</div>
@endsection