@extends('_layout')

@section('page-title')
	Documentation & Demos
@endsection

@section('content')
	
	<div class="markdown">
		{!! $readme !!}
	</div>

@endsection
