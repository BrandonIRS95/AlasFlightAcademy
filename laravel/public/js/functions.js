var postid = 0;

$(".edit-post").click(function(e){
	$('#edit-post-modal').modal();
	var content = $(e.target.closest('.post').children[0]);

	postid = $(e.target.closest('.post')).attr("data-postid");
	console.log(postid + ' postid');

	$("#post-body").val(content.text());
});

$("#modal-save").click(function(){

	console.log(postid + ' postid123');

	$.ajax({
		method: 'post',
		url: url,
		data: {body: $("#post-body").val(), id: postid, _token: token }
	}).done(function(msg){
		console.log(msg['new_body']);
		console.log(msg['status']);
	});
});