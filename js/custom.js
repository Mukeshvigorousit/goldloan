
$(document).ajaxStart(function() {
    $('.loader-fix').removeClass('d-none').addClass('d-flex');
})
$(document).ajaxStop(function() {
    $('.loader-fix').addClass('d-none').removeClass('d-flex');
});


function ajax_crud(table_name,table_data,where='')
{

	alert(where);

}

function sendAjaxFrm(rurl, rdata){
	var  returndata = "";

	console.log(rdata)
	$.ajax({
		url : rurl,
		type:'POST',
		data: rdata,
		processData	: 	false,
		contentType	: 	false,
		async		: 	false,
		success:function(res){	
			// res = $.parseJSON(res)		
			returndata = res;
			//$('[data-toggle="tooltip"]').tooltip();
		},
		complete: function() {
	        //$(this).data('requestRunning', false);
	    },
		 statusCode: {
		        500: function() {
		        	showMessage('danger', "Something went wrong on server")				          
		        },
		        404:function(){
		        	showMessage('danger', "Invalid Request")				          				        	
		        }				       
		      }

	})

	return returndata;
}


function sendAjax(rurl, rdata){	
	var  returndata = "";

	$.ajax({
		url : rurl,
		type:'POST',
		data: rdata,		
		async		: 	false,		
		success:function(res){	
			res = $.parseJSON(res)		
			returndata = res;
		},
		complete: function() {
	       // $(this).data('requestRunning', false);
	    },
		 statusCode: {
		        500: function() {
		            notify('danger', "Something went wrong on server")				          
		        },
		        404:function(){
		             notify('danger', "Invalid Request")				          				        	
		        }				       
		      }

	})

	return returndata;
}

function sendAjaxByGet(rurl,rdata){	
	var  returndata = "";
	$.ajax({
		url : rurl,
		type: 'GET',
		data: rdata,		
		async		: 	false,
		
		success:function(res){	
			
			res = $.parseJSON(res)		
			returndata = res;
		},
		complete: function() {
	       
	    },
		 statusCode: {
		        500: function() {
		        	notify('danger', "Something went wrong on server")				          
		        },
		        404:function(){
		        	notify('danger', "Invalid Request")				          				        	
		        }				       
		      }

	})

	return returndata;
}

  function addForm(objName,rurl,durl,modalName, thisObj){	
 	//console.log(ok);
		var formdata = new FormData(thisObj);
		var res = sendAjaxFrm(rurl, formdata);
		var status = res.status;
		var msg = res.msg;
				
		if(status.toLowerCase() == 'ok'){			
			$(modalName).find('form').trigger('reset');
			$(modalName).find('form').find('.form-group').each(function(){
				if ($(this).hasClass('is-filled')){
					$(this).removeClass('is-filled');
				}

				$(this).removeClass('is-filled');
				$(this).removeClass('has-success');
				if ($(this).find('img').length) {
					var html = '<span class="upload-IMg pointer" ><i class="fa fa-camera fa-2x" data-toggle="tooltip" style="vertical-align: middle;"></i> <b>Upload Image</b></span>';
					$(this).find('.flex-wrap').html(html);
				}
			});
			$(modalName).modal('hide');
			showMessage('success', msg);
			initTable(src, dest, durl, data);
		}else{

			$(modalName).modal('hide');
			showMessage('danger', msg);
		}
	}


function generateTemplate(data, src, destination){		
        var source   = document.getElementById(src).innerHTML;
        var template = Handlebars.compile(source);
        var generatedTemplate = template(data);       
        var rowContainer = document.getElementById(destination);    
        rowContainer.innerHTML = generatedTemplate;
}


function initTable(src, dest, url, data){
	var res = sendAjax(url, data);

	var maxPage = res.result.pages;
	$('#max-page').text(maxPage);
	$('#current-page').text(res.result.page);

    if (parseInt(res.result.showing_upto) <= parseInt(res.result.showing_from)) {
    	res.result.showing_from = res.result.showing_upto;
    }

	generateTemplate(res, src, dest);	
	generateTemplate(res, 'fromTo', 'fromToContainer');	
	generateTemplate(res, 'totalResult', 'totalResultContainer');	
	generateTemplate(res, 'pageCountTemp', 'pageCountContainer');	
	
	
    if(res.result.page == 1){
		$('.btn-prev').addClass('d-none');
	}else{
		$('.btn-prev').removeClass('d-none');
	}

	if(res.result.count == res.result.showing_upto){	 	
	   $('.btn-next').addClass('d-none');  
	}else{	    
	    $('.btn-next').removeClass('d-none')        
	}

	$('[data-toggle="tooltip"]').tooltip();
}

$('.per-page').on('change',function(){
	var perPage = $(this).val();	
	$('#num-page').text(perPage);
	var src = $(this).attr('temp-src');
	var query = $('.search-form').find('input').val();
	var dest = $(this).attr('temp-dest');
	var url = $(this).attr('temp-url');
	
	$('#current-page').text(1);
	data.limit = perPage;
	data.page = 1;
	data.query = query;
	initTable(src, dest, url, data);
})

$('.search-form').on('submit',function(e){
	e.preventDefault();
	var query = $(this).find('input').val();	
	var perPage = $('#num-page').text();
	var src = $(this).attr('temp-src');
	var dest = $(this).attr('temp-dest');
	var url = $(this).attr('temp-url');
	
	$('#current-page').text(1);
	data.limit = perPage;
	data.page = 1;
	data.query = query;
	initTable(src, dest, url, data);
})

$('.search-form input').on('keyup',function(e){
	var query = $(this).val();	
	
	if (query == '') {
		var perPage = $('#num-page').text();
		var src = $(this).parents('.search-form').attr('temp-src');
		var dest = $(this).parents('.search-form').attr('temp-dest');
		var url = $(this).parents('.search-form').attr('temp-url');
		$('#current-page').text(1);
		data.limit = perPage;
		data.page = 1;
		data.query = query;
		initTable(src, dest, url, data);	
	}
	
})

$('body').find('.btn-next').on('click',function(){		
	var perPage = $('#num-page').text();	
	var query = $('.search-form').find('input').val();			
	var src = $(this).attr('temp-src');
	var dest = $(this).attr('temp-dest');
	var url = $(this).attr('temp-url');		
	var currentPage = $('#current-page').text();
	var maxPage = $('#max-page').text();	
	var page = parseInt(currentPage)+1;	 
	$('#current-page').text(page);
	data.limit = perPage;
	data.page = page;
	data.query = query;
	initTable(src, dest, url, data);
});


$('body').find('.btn-prev').on('click',function(){	
	var perPage = $('#num-page').text();			
	var src = $(this).attr('temp-src');
	var query = $('.search-form').find('input').val();
	var dest = $(this).attr('temp-dest');
	var url = $(this).attr('temp-url');		
	var currentPage = $('#current-page').text();
	var page = currentPage == 1 ? 1 : parseInt(currentPage)-1;	
	$('#current-page').text(page);
	//var data = {'limit':perPage, 'page':page}	
	data.limit 	= perPage;
	data.page 	= page;
	data.query 	= query;
	initTable(src, dest, url, data);
});


/*Handlebars.registerHelper("inc", function(value, options){
    return parseInt(value) + 1;
});
*/
/*Handlebars.registerHelper("incCount", function(index,page,limit){
	return parseInt((page-1)*limit) + (index+1);
});*/
	
  //delete table row
  $('body').on('click','.delete-btn',function(){
      var id        = $(this).attr('id');
      var key       = $(this).attr('key');
      var id_key    = $(this).attr('id_key');
      var res     	= sendAjax('delete',{id:id,key:key,id_key:id_key});
      if (res.status == 'ok') {
      	initTable(src, dest, url, data);
      	showMessage('success',res.msgs);
      }else{
      	showMessage('danger',res.msgs);
      }
      $(this).parents('.modal').modal('hide');
   });

    //some attr put on modal delete btn
  $('body').on('click','.delete-row',function(){
      var id        = $(this).attr('id');
      var key       = $(this).attr('key');
      var id_key    = $(this).attr('id_key');
      $('body').find('#deleteModal .delete-btn').attr({
      	id 	: id,
      	key : key,
      	id_key : id_key
      });
   });






function confirmBoxActiveInactiveWithData(controller,title,getdata,buttonClass,type,msg){
	$.confirm({
		    title: title,
		    content: msg,
		    animation: 'scaleY',
            closeAnimation: 'scaleY',
            animateFromElement: false,
            theme: 'modern', // 'material', 'bootstrap'
		    type: type,
		    closeIcon: true,
		    buttons: {
		    	OK : {
			            btnClass: 'btn-'+buttonClass,
			            action: function(){
			            	var dataToReturn	=	 sendAjax(controller,getdata);
			            	if (dataToReturn.status=='OK'){
								initTable(src, dest, url, data);
								showMessage('success', dataToReturn.msg);
							}else{
								showMessage('danger', dataToReturn.msg);
							}
			            }
			        },
		        Cancel: function () {
		          
		        },
		        
		    }
		});
}

function _deleteAjax(controller,id){	
	$.ajax({
			url 	    : 	controller,
			method 	    : 	'POST',
			data 		: 	{'id':id},
			cache		: 	false,
			success 	: 	function(response){
				
				var responseObj = $.parseJSON(response);
				
					dataToReturn = responseObj;
				if (dataToReturn.status=='OK'){
					initTable(src, dest, url, data);
					showMessage('success', dataToReturn.msg);
				}else{
					showMessage('danger', dataToReturn.msg);
				}

			}	

		});

}

//peview page start
function goBack() {
  window.history.back();
}
//peview page end


//remove value in array start
  function arrayRemove(arr, value) {

     return arr.filter(function(ele){
         return ele != value;
     });

  }
//remove value in array end

function confirmBoxForPartyTab(controller,id,title,buttonClass,type){
	var isReturn  = false;
	$.confirm({
		    title: title,
		    content: 'Are you sure '+title+' this entry !',
		    animation: 'scaleY',
            closeAnimation: 'scaleY',
            animateFromElement: false,
            theme: 'modern', // 'material', 'bootstrap'
		    type: type,
		    closeIcon: true,
		    buttons: {
		    	OK : {
			            btnClass: 'btn-'+buttonClass,
			            action: function(){
			              	return  true;
			            }
			        },
		        Cancel: function () {
		          return  false;
		        },
		        
		    }
		});

}

function _deleteAjaxByPartyTab(controller,id){
	var isreturn	 = true;
	$.ajax({
			url 	    : 	controller,
			method 	    : 	'POST',
			data 		: 	{'id':id},
			cache		: 	false,
			async		: 	false,
			success 	: 	function(response){				
				var responseObj = $.parseJSON(response);				
					dataToReturn = responseObj;
				if (dataToReturn.status=='OK'){
					isreturn = true;
					showMessage('success', dataToReturn.msg);
				}else{
					isreturn = false;
					showMessage('danger', dataToReturn.msg);
				}

			}	

		});
	return isreturn ;

}

       function check_password($password)
         {
            var password=$password;
            sendData = {
                "password":password 
            }
            data = sendAjax('ajax/check_password.php',sendData)
            return data
         }