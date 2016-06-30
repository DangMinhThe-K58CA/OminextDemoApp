<form action="fileentry/add" method="post" enctype="multipart/form-data">
    <input type="file" name="filefield">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="submit">
</form>