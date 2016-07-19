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
	  	<form method="POST" action="" class="smart-form" novalidate="novalidate" id="newsMakingForm">
	  		{{ csrf_field() }}
	  		<section>
	  			<label class="label">Tiêu đề</label>
				<label class="input"> <i class="icon-append fa fa-edit"></i>
					<input type="text" name="newsTitle" id="newsTitle" placeholder="Tiêu đề tin...">
					<b class="tooltip tooltip-bottom-right">Tiêu đề tin</b> </label>
			</section>
			<section>
				<label class="label">Danh mục</label>
				<label class="select">
					<select name="category" id="cateId">
						<option value="1">Thể thao</option>
						<option value="2">Y tế</option>
						<option value="3">Giáo dục</option>
						<option value="4">Xe và đời sống</option>
						<option value="5">Ẩm thực</option>
						<option value="6">Thời trang</option>
						<option value="7">An ninh xã hội</option>
						<option value="8">Tin thế giới</option>
						<option value="9">Tài chính - chứng khoán</option>
						<option value="10">Pháp luật và đời sống</option>
						<option value="11">Việc tử tế</option>
						<option value="12">Tin giới trẻ</option>
					</select> <i></i> </label>
			</section>
			<section>
				<label class="label">Mô tả</label>
				<label class="textarea"> <i class="icon-append fa fa-edit"></i>
					<textarea rows="4" name="shortDescription" placeholder="Mô tả ngắn..." id = "shortDescription"></textarea>
				</label>
			</section>

			<section>
				<label class="label">Nội dung</label>
				<label class="textarea">
		  			<textarea id="editor1" class="ckeditor" name = "newsContent"></textarea>
		  		</label>
		  		<br/>
		  	</section>
		  	<footer>
		  		<input type = "button" class="btn btn-danger" value="Hủy" onclick = "cancelMakingNews();"/>
		  		<input type = "submit" class="btn btn-primary" onclick="completeAddingNews();" value = "Hoàn tất" id = "submitBtn">
	  		</footer>
  		</form>
		  <script type="text/javascript">  
		      CKEDITOR.replace( 'editor1' );
		      	$('#submitBtn').click(function (event) {
		      		event.preventDefault();
		      	});
				//
				function CKupdate(){
				    for ( instance in CKEDITOR.instances )
				        CKEDITOR.instances[instance].updateElement();
				}
				function completeAddingNews() {
					//
					      var formValidate = $("#newsMakingForm");
					      formValidate.validate({
					        // Rules for form validation
					        rules : {
					        newsTitle : {
					          required : true,
					          minlength: 5,
					          maxlength: 200,
					        },
					        shortDescription : {
					          required : true,
					          minlength: 5,
					          maxlength: 1000,
					        },
					        newsContent : {
					        	required: true,
					        	minlength: 5,
					        	maxlength: 10000,
					        },
					      },

					      // Messages for form validation
					      messages : {
					        newsTitle : {
					          required: 'Vui lòng nhập tiêu đề !',
					          minlength : 'Tiêu đề chứa ít nhất 5 kí tự !',
					          maxlength : 'Tiêu đề chứa không quá 200 kí tự !'
					        },
					        shortDescription : {
					          required: 'Vui lòng nhập mô tả !',
					          minlength : 'Mô tả chứa ít nhất 5 kí tự !',
					          maxlength : 'Mô tả chứa không quá 1000 kí tự !'
					        },
					        newsContent : {
					          required: 'Vui lòng nhập mô tả !',
					          minlength : 'Nội dung chứa ít nhất 5 kí tự !',
					          maxlength : 'Nội dung chứa không quá 10000 kí tự !'
					        },
					      },

					        // Do not change code below
					        errorPlacement : function(error, element) {
					          error.insertAfter(element.parent());

					        },
					        invalidHandler: function(event, formValidate) {
					        	// alert(formValidate.numberOfInvalids());
					        	return null;
					        },

					    });
					      
					//
					if (formValidate.valid()) {
						var token, title, cateId,description, content;
			            token = $('input[name=_token]').val();
			            title = $('#newsTitle').val();
			            cateId = $('#cateId').children(":selected").attr('value');
			            description = $('#shortDescription').val();
			            for ( instance in CKEDITOR.instances ) {
				        	CKEDITOR.instances[instance].updateElement();
			            }
			            content = CKEDITOR.instances.editor1.getData();
			            $.ajax({
			                url: '/saveNewsContent',
			                data: {_token: token, newsTitle: title, cateId: cateId, shortDescription: description, content: content},
			                type: 'POST',
			                success: function (data) {
			                   if (data == "1") {
			                   		alert('Tin đã đăng thành công !');
			                   		window.location.href = "/showNewsListOfPartner";
			                   }
			                   else {
			                   	alert(data);
			                   }
			                }
			            });
				    }
				}
		            
			    //
			    function cancelMakingNews() {
			      	CKEDITOR.instances.editor1.setData('');
			      	$('#newsTitle').val("");
			      	$('#shortDescription').val("");
			      }
		      	// 
		      
		  </script>
	</div>
@endsection