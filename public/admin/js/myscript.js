$(document).ready(function(){
	$('#dataTables-example').DataTable({
	        responsive: true
	});
});

//Hiệu ứng thông báo thành công, thất bại
$('.alert').delay(5000).slideUp();

//Hỏi trước khi xóa
function xacnhanxoa(smg){
	if(window.confirm(smg))
		return true;
	return false;
}

//Thêm button chọn Image
$(document).ready(function(){
	//alert(1111111);
	$('#addImages').click(function(){
		$("#insert").append('<div class="form-group"><input type="file" name="fProductDetail[]" /></div>');
	});
});

//Xóa Image
$(document).ready(function(){
	$('a#del_img_demo').on('click', function(){
		var url = 'http://localhost/framework/project_laravel/admin/product/delImg/';
		var _token = $("form[name='editproduct']").find("input[name='_token']").val();
		var idHinh = $(this).parent().find('img').attr('idHinh');//id image của table product_image
		var img = $(this).parent().find('img').attr('src');//đường dẫn tới image đó
		var rid = $(this).parent().find('img').attr('id');//tên của image để xóa( hinh1, hinh2, ...)
		
		$.ajax({
			url: url + idHinh,
			type: 'GET',//ở route là get thì đây cũng phải get
			cache: false,
			data: {'_token':_token, 'idHinh':idHinh, 'urlHinh': img},
			success:function(data){
				if(data == "Oke"){
					$("#"+rid).remove();
					alert('Success! Delete Image');
				}
				else{
					alert("Error! :D");
				}
			}
		});
	});
});