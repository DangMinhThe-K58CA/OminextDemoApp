<style type="text/css">
	p {
		font-weight:bold;
		color:#990000;
		font-size:110%;
	}
</style>
@extends('layouts.adminMaster')

@section('header')
	@parent
@endsection

@section('leftNav')
	@parent
@endsection

@section('content')
<div class="col-sm-10 col-sm-offset-0">
	<div class="container table">
	  	<table class="table">
			<p style="color:#800000;font-size:175%;">Danh sách độc giả</p>
		    <thead>
		     	<tr>
		     		<th>
						<p>Id</p>
					</th>
					<th>
						<p>Họ và tên</p>
					</th>
					<th>
						<p>Địa chỉ Email</p>
					</th>
					<th>
						<p>Giới tính</p>
					</th>
					<th>
						<p>Ngày sinh</p>
					</th>
					<th>
						<p>Số điện thoại</p>
					</th>
					<th>
						<p>Quyền hạn</p>
					</th>
			    </tr>
		    </thead>
		    <tbody>
		    	@foreach ($viewers as $viewer)
			  	<tr>
			  		<td>
			  			<a>{{ $viewer->id }}</a>
			  		</td>
			  		<td>
			  			<a>{{ $viewer->name }}</a>
			  		</td>
			  		<td>
			  			<a>{{ $viewer->email }}</a>
			  		</td>
			  		<td>
			  			<a>{{ $viewer->gender }}</a>
			  		</td>
			  		<td>
			  			<a>{{ $viewer->dateOfBirth }}</a>
			  		</td>
			  		<td>
			  			<a>{{ $viewer->phone }}</a>
			  		</td>
			  		<td>
			  			<div class="dropdown">
		                    <a id="dLabel" role="button" data-toggle="dropdown" class="btn" data-target="#" href="/page.html" style="font-size:120%;">Độc giả<span class="caret"></span>
		                    </a>
		                    
		                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
		                        <li><a href="#" onclick="changeRole('{{$viewer->id}}', 1);">Cộng tác viên</a></li>
		                        <li class="divider"></li>
		                    </ul>
		                </div>
			  		</td>
			  	</tr>
		    	@endforeach
		    </tbody>
	  		
	  	</table>
	  	{!! $viewers->render() !!}
	</div>
</div>
@endsection

@section('footer')
	@parent
@endsection
