<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<script src="jquery.js"></script>
	<script src="jquery.form.min.js"></script>
</head>
<body>
<div class="uk-container uk-container-center">

	<div class="pk-system-messages"></div>

	<h1 class="uk-h2 uk-text-center" style="margin-top:-100px;">文件上传</h1>
	<div class="pk-system-messages"></div>

	 <div class="container-main">
	  <h1>Ajax Image Uploader</h1>
	  <p>A simple tutorial to explain image uploading using jquery ajax and php</p>

	   <form id='myupload' action='new_upload.php' method='post' enctype='multipart/form-data'>
	    <label for="file">Filename:</label>
	   <input type="file" name="mypic" id="file"><br>
	   <input type="submit" name="upload" class="btn btn-success" value="upload">
	  </form>

	    <div class="progress">
	     <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
	      <span class="sr-only">0% Complete</span>
	   </div>
	   </div>
	  <div class="files"></div>
	  <div class="showimg"></div>
	 </div>
	   
	</div>
</body>
</html>
<script type="text/javascript">
$(function () {
   $("#myupload").ajaxForm({
     dataType:'json',
     beforeSend:function(){ 
         $(".progress").show();
     },
     uploadProgress:function(event,position,total,percentComplete){
         var percentVal = percentComplete + '%';
         $(".progress-bar").width(percentComplete + '%');
         $(".progress-bar").html(percentVal);
         $(".sr-only").html(percentComplete + '%');
     },
     success:function(data){
         $(".progress").hide();
        
         if(data.error == "empty_name"){
             alert("文件上传非法,上传失败!");
             exit();
         };
         if(data.error == "large"){
             alert("图片上传不能大于2M,上传失败!");
             exit();
         };
 /*alert(data.error);*/
         if(data.error == "format"){
             alert("图片格式错误,上传失败");
             //alert(data.type);
             exit();
         };
         //alert("上传成功!");
         //files.html("<b>"+data.name+"("+data.size+"k)</b> <span class='delimg' rel='"+data.pic+"'>删除</span>");
         $(".files").html("文件名: "+data.name+"<span class='delimg' rel='"+data.pic+"'>  del  </span>大小："+data.size);
         var img = "http://www.sandleft.com/test/input/upload/files/"+data.pic;
         $(".showimg").html("<img src='"+img+"'>");
         alert("上传成功!");
     },
     error:function(){
         alert("图片上传失败");
     }
        
   });
   // $(".progress").hide();
});
</script>