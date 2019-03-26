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
	
	var addSiteForm = $("#addSite");
	
	var validator = addSiteForm.validate({

		rules:{
			address :{ required : true },
			city : { required : true},
			district : { required : true},
			state :{ required : true},
			pincode : { required : true,digits : true},
			contact : { required : true}
		},
		messages:{
			address :{ required : "This field is required"},
			city : { required : "This field is required"},
			district : {required: "This field is required"},
			state : { required : "This field is required"},
			pincode : { required : "This field is required", digits : "Please enter numbers only"  },
			contact : { required : "This field is required"}
		}
	});
});
