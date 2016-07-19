<style type="text/css">
	p.headerTable {
		font-weight:bold;
		color:#990000;
		font-size:110%;
	}
	a {
		font-size:80%;
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
<div class="col-sm-12 col-sm-offset-0">
	<div class="container table">
		<br/>
	  	<table class="table">
				<p style="color:#800000;font-size:175%;">Danh sách bài đăng</p>
		    <thead>
		     	<tr>
		     		<th>
						<p class="headerTable">Id</p>
					</th>
					<th>
						<p class="headerTable">Tiêu đề</p>
					</th>
					<th>
						<p class="headerTable">Tác giả</p>
					</th>
					<th>
						<p class="headerTable">Danh mục</p>
					</th>
					<th>
						<p class="headerTable">Mô tả</p>
					</th>
					<th>
						<p class="headerTable">Ngày đăng</p>
					</th>
					<th>
						<p class="headerTable">Trạng thái</p>
					</th>
			    </tr>
		    </thead>
		    <tbody>
		    	@foreach ($newssList as $news)
			  	<tr>
			  		<td>
			  			<a>{{ $news->id }}</a>
			  		</td>
			  		<td>
			  			<a>{{ $news->title }}</a>
			  		</td>
			  		<td>
			  			<a>{{ $news->name }}</a>
			  		</td>
			  		<td>
			  			<a>{{ $news->cateName }}</a>
			  		</td>
			  		<td>
			  			<a>{{ $news->shortDescription }}</a>
			  		</td>
			  		<td>
			  			<a>{{ $news->created_at }}</a>
			  		</td>
			  		<td>
		              	<div class="dropdown">
		                    <a id="dLabel" data-toggle="dropdown" class="btn" data-target="#" href="/page.html" style="font-size:120%;">
		                    	@if ($news->active == 0)
		                    		{{ "Chưa đăng"}}
		                    	@else
		                    		{{ "Đã đăng"}}
		                    	@endif
		                    	<span class="caret"></span>
		                    </a>
		                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
		                        <li><a href="#" class="business" onclick="changeActive('{{$news->id}}', '{{$news->active}}');">
		                        	@if ($news->active == 0)
			                    		{{ "Hiển thị"}}
			                    	@else
			                    		{{ "Hủy đăng"}}
			                    	@endif
		                        </a></li>
		                        <li class="divider"></li>
		                    </ul>
		                </div>
			  		</td>
			  	</tr>
			  	<tr>
			  		<td colspan="7" align="center">
			  			<a href="javascript:void(0);" class="showContentButton" id = "show{{$news->id}}" onclick = "showContent(this, {{$news->id}});"><i class="fa fa-arrows-v" style="font-size:14px;color:#476b6b;"></i> Hiển thị nội dung</a>
			  			<input type="hidden" value = "<?php echo htmlspecialchars($news->content, ENT_QUOTES);?>" id = "contentText{{$news->id}}"/>

			  			
			  		</td>
			  		
			  	</tr>
			  	<tr>
			  		<td colspan="2"></td>
			  		<td colspan="5">
			  			<div class="col-sm-10" id= "content{{$news->id}}">
			  				
			  			</div>
			  			
			  		</td>
			  		<!-- <td colspan="1"></td> -->
			  	</tr>
			  	<tr>
			  		<td colspan="7" align="center">
			  			<a class = "hidden" class="hideContentButton" href="javascript:void(0);" newsId = "{{$news->id}}" id = "hide{{$news->id}}" onclick = "hideContent(this);"><i class="fa fa-arrows-v" style="font-size:14px;color:#476b6b;"></i> Thu gọn nội dung</a>
			  		</td>
			  	</tr>
		    	@endforeach
		    </tbody>
	  	</table>
	  	{!! $newssList->render() !!}
	</div>
	<script type="text/javascript">
		$(document).ready(function () {
			$('.hideContentButton').addClass("hidden");
		});
		function showContent(object, newsId, newsContent) {
			// alert($('#contentText' + newsId).attr('value'));
			$('#content' + newsId).html($('#contentText' + newsId).attr('value'));
			$('#show' + newsId).addClass("hidden");
			$('#hide' + newsId).removeClass("hidden");
			// $(object).html("<i class='fa fa-arrows-v' style='font-size:14px;color:#476b6b;'></i> Thu gọn nội dung");
			// $(object).attr("onclick","hideContent(this);");
		}
		function hideContent(object) {
			var newsId = $(object).attr('newsId');
			$('#content' + newsId).html("");
			$('#show' + newsId).removeClass("hidden");
			$('#hide' + newsId).addClass("hidden");

		}
		function changeActive(newsId, newsActive) {
			var cnf,newActive;
			if (newsActive == 0) {
				newActive = 1;
				cnf = confirm('Hiển thị tin lên trang chủ ?');
			}
			else {
				newActive = 0;
				cnf = confirm('Xóa tin trên trang chủ ?');
			}
			if (cnf) {
				$.ajax({
					url: 'changeNewsActive',
					type: 'GET',
					data: {newsId: newsId, newsActive: newActive},
					success: function (data) {
						if (data == 1) {
							window.location.reload();
						}
						else {
							alert('Xảy ra lỗi ! Vui lòng thao tác lại.');
							return null;
						}
					}
				});
			}
			else {
				return null;
			}
		}
	</script>
</div>
@endsection

@section('footer')
	@parent
@endsection
