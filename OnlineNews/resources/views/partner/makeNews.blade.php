@extends('layouts.partnerMaster')

@section('header')
	@parent
@endsection

@section('leftNav')
	@parent
@endsection


@section('content')
	<div class="col-sm-12">
	  <script src="/templateEditor/ckeditor/ckeditor.js"></script>
	  	<form method="POST" action="/saveNewsContent">
	  		{{ csrf_field() }}
	  		<textarea id="editor1" class="ckeditor" name = "editor"></textarea>
	  		<br/>
	  		<button type = "submit" class="btn btn-primary">Hoàn tất</button>
	  		<input type = "button" class="btn btn-danger" value="Hủy"/>
  		</form>
		  <script type="text/javascript">  
		      CKEDITOR.replace( 'editor1' );
		  </script>
	</div>
@endsection