<script src= "/libs/jquery/jquery-2.0.2.min.js"></script>
@if (! Auth::check())
<button onclick="window.location.href = '/login'">Login</button>
<button onclick="window.location.href = '/register'">Register</button>
@else
<p>{{Auth::user()->name}}</p>
<button onclick = "logout();">Logout</button>
<br/>
<br/>
<form action="fileentry/add" method="post" enctype="multipart/form-data">
    <input type="file" name="filefield">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="submit">
</form>
<br/>
<br/>
@endif

<h1> Pictures list</h1>
<?php
$i = 0;
?>
@if (sizeof($imgsDataList) == 0)
	<p>Empty list !!!</p>
@endif
@foreach ($imgsDataList as $imgData)
<input type="button" value="Delete" onclick = 'deleteImage("{{$imgsNameList[$i]}}");'>
<br/>
<img src= "data:image/jpeg;base64,{{$imgData}}" />
<br/>
<?php
$i++;
?>
@endforeach
<script type="text/javascript">
	function logout() {
		$.ajax({
				url: '/logout',
				type: 'GET',
				success: function (data) {
					if (data != 0) {
						window.location.href = "/show";
					}
					else {
						alert("Error occured !!");
					}
				}
			});
	}
	function deleteImage(imgName) {
		var conf = confirm("Are you sure ?");
		if (conf) {
			$.ajax({
				url: '/deleteImage',
				type: 'GET',
				data: {imgName: imgName},
				success: function (data) {
					if (data != 0) {
						alert("ok deleted !!!");
						window.location.href = "/show";
					}
					else {
						alert("Error occured !!");
					}
				}
			});
		}
		else {
			return null;
		}
	}
</script>