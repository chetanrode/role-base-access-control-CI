/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Kishor Mali
 */

$(document).ready(function(){
	
	var addDeviceForm = $("#addDevice");
	
	var validator = addDeviceForm.validate({

		rules:{
			deviceType :{ required : true,selected : true },
			deviceName : { required : true},
			stock : { required : true}
		},
		messages:{
			deviceType :{ required : "This field is required",selected : "Please select atleast one option"},
			deviceName : { required : "This field is required"},
			stock : {required: "This field is required"}
		}
	});
});
