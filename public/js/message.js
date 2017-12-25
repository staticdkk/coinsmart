
$('#box-message > .box-content').scroll(function () {
	var top = $(this).scrollTop();
	if(top == 0){
		getOldMessage();
	}
})

function scrollToBottom(argument) {
	var bottom = $('#box-message > .box-content')[0].scrollHeight;
	$('#box-message > .box-content').scrollTop(bottom);
}

$('#icon-message a i').click(function () {
	$('#box-message').css('display', 'block');
	updateCurrentId();
	scrollToBottom();
})
$('#box-message > .box-title > i').click(function (){
	$('#box-message').css('display', 'none');
})
$('#box-message > .box-input').mouseover(function () {
	updateCurrentId();
})

// seen 
var checkToUpdateCurrentId = false;
function updateCurrentId() {
	if(checkToUpdateCurrentId && $('#icon-message > p').text() != '0'){
		// console.log('updateCurrentId');
		checkToUpdateCurrentId = false;
		var current_id = '0' + $('#box-message > .box-content > p:last-child').attr('id');
		current_id = parseInt(current_id);

		$.ajax({
			url : 'updateCurrentId',
			type : 'post',
			data : {
				current_id : current_id
			},
			dataType : 'json',
			success : function (result) {
				$('#icon-message > p').text('0').css('display', 'none');
			}
		}).always(function() {
			checkToUpdateCurrentId = true;
		})
	}
}

function sendText(event, ele) {
	var text = $(ele).val();
	while(/  /.test(text)){
		text = text.replace(/  /i, ' ');
	}
	if(text == " ") text = '';
	$(ele).val(text);

	var x = event.which || event.keyCode;
	if(x == 13){
		var text = $(ele).val();
		text = text.substr(0, text.length-1);
		$(ele).val("");
		if(text != ''){
			var data = {type : 'text', message : text};
			send(data);
		}
	}
}

function sendIcon(className) {
	var data = {type : 'icon', message : className};
	send(data);
}
function sendImage(ele) {
	if(typeof $(ele)[0].files[0] == 'undefined')
		return false;
	var fileName = $(ele)[0].files[0].name;
	var size = $(ele)[0].files[0].size;

	if(!/(.jpg|.png|.jpeg|.JPG|.PNG|.JPEG)$/.test(fileName)){
		alert('Only allow to send photos');
	} else if(size/(1024*1024) > 6){ // accept a photo less than 6MB
		alert('Max size = 6MB');
	} else {
		var formData = new FormData($(ele).parent()[0]);
		send(formData);
	}
}

// set up request
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});
var checkToSendMessage = true;
// send message
function send(data) {
	if(checkToSendMessage){
		checkToSendMessage = false;

		var setup = {
			url : "addNewMessage",
			type : "post",
			dataType : "json",
			success : function(result){
				console.log(result);
				if(!result){
					alert("Can not send your message. \nPlease try again!");
				}
			},
			error : function() {
				alert("Can not send your message. \nPlease try again!");
			}
		};
		if(data instanceof FormData){
			setup.data = data;
			setup.processData = false;  // tell jQuery not to process the data
			setup.contentType = false;  // tell jQuery not to set contentType
		} else {
			setup.data = {data : JSON.stringify(data),exchange: $('meta[name="exchange"]').attr('content')};
		}
		
		$.ajax(setup).always(function () {
			checkToSendMessage = true;
		});	
	} 
}

var getMessage = false;
function getOldMessage() {
	var firstId = '0' + $('#box-message > .box-content > p:first-child').attr('id');
	firstId = parseInt(firstId);

	$.ajax({
		url : "getOldMessage",
		type : "post",
		data : {
			firstId : firstId-1,
			exchange: $('meta[name="exchange"]').attr('content')
		},
		dataType : "json",
		success : function(result){
			$('#box-message > .box-content').prepend(result);
			checkToUpdateCurrentId = true;
			getMessage = true;
		},
		error : function() {
			console.log("failed to get old messages");
		}
	});
}
getOldMessage();

var inter = setInterval(function() {
	if(getMessage){
		getNewMessage();
		clearInterval(inter);
	}
}, 1000);

function getNewMessage() {
	console.log('get new message');
	var current_id = '0' + $('#box-message > .box-content > p:last-child').attr('id');
	current_id = parseInt(current_id);

	$.ajax({
		url : "getNewMessage",
		type : "post",
		data : {
			current_id : current_id,
			timeout : 30,
			exchange: $('meta[name="exchange"]').attr('content')
		},
		dataType : "json",
		success : function(result){
			if(result.data != ''){
				$('#box-message > .box-content').append(result.data);
				if(result.qty > 0){
					var x = parseInt($('#icon-message > p').text());
					$('#icon-message > p').text(x + result.qty + '').css('display', 'block');
				} else {
					// console.log('scroll to bottom');
					scrollToBottom();
				}	
			}
		},
		error : function() {
			console.log('failed to get new message');
		},
		timeout : 35000
	}).always(function () {
		getNewMessage();
	});
}


// change status from free to busy or busy to free
var checkToChangeStatus = true;
function changeStatus(ele) {
	if(checkToChangeStatus){
		checkToChangeStatus = false;
		$.ajax({
			url : 'changeStatus',
			type : 'post',
			success : function(result) {
				if(result == 1){
					$(ele).addClass('free');
				} else {
					$(ele).removeClass('free');
				}
			}
		}).always(function(){
			setTimeout(function(){
				checkToChangeStatus = true;
			}, 2000);
		})	
	}
}



