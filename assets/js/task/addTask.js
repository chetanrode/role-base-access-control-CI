/**
 * Created by dhananjay.rode on 2/14/2019.
 */
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

    var addSiteForm = $("#addTask");

    var validator = addSiteForm.validate({

        rules:{
            taskName :{ required : true },
            assignTo : { required : true},
            siteId :{ required : true},
            deviceId : { required : true},
            description : { required : true},
        },
        messages:{
            taskName :{ required : "This field is required"},
            assignTo : { required : "This field is required"},
            siteId : {required: "This field is required"},
            deviceId : { required : "This field is required"},
            description : { required : "This field is required"},
        }
    });
});
