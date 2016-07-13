@extends('layouts.adminMaster')

@section('header')
	@parent
@endsection

@section('leftNav')
	@parent
@endsection


@section('content')
	<!-- <div class="col-sm-10">
	  <script src="/templateEditor/ckeditor/ckeditor.js"></script>
	  	<form method="POST" action="/saveNewsContent">
	  		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  		<textarea id="editor1" class="ckeditor" name = "editor"></textarea>
	  		<button type = "submit">Ok</button>
  		</form>
		  <script type="text/javascript">  
		      CKEDITOR.replace( 'editor1' );
		  </script>
	</div> -->
@endsection