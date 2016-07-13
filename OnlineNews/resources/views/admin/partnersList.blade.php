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
				<p style="color:#800000;font-size:175%;">Danh sách cộng tác viên</p>
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
		    	@foreach ($partners as $partner)
			  	<tr>
			  		<td>
			  			<a>{{ $partner->id }}</a>
			  		</td>
			  		<td>
			  			<a>{{ $partner->name }}</a>
			  		</td>
			  		<td>
			  			<a>{{ $partner->email }}</a>
			  		</td>
			  		<td>
			  			<a>{{ $partner->gender }}</a>
			  		</td>
			  		<td>
			  			<a>{{ $partner->dateOfBirth }}</a>
			  		</td>
			  		<td>
			  			<a>{{ $partner->phone }}</a>
			  		</td>
			  		<td>
			  			<div class="dropdown">
		                    <a id="dLabel" role="button" data-toggle="dropdown" class="btn" data-target="#" href="/page.html" style="font-size:120%;">Cộng tác viên <span class="caret"></span>
		                    </a>
		                    
		                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
		                        <li><a href="#" onclick="changeRole('{{$partner->id}}', 2);">Quản trị viên</a></li>
		                        <li><a href="#" onclick="changeRole('{{$partner->id}}', 1);">Độc giả</a></li>
		                        <li class="divider"></li>
		                    </ul>
		                </div>
			  		</td>
			  	</tr>
		    	@endforeach
		    </tbody>
	  		
	  	</table>
	  	{!! $partners->render() !!}
	</div>
</div>
@endsection

@section('footer')
	@parent
@endsection
