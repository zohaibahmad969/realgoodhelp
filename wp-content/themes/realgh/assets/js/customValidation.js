$(document).ready(function(){

    var wizard_1 = $("#registerPopUpForm").validate({
        rules: {
          fname: "required",
          title: "required",
          country: "required",
          dob: {date: true, required: true },
          phone:  { required: true, number: true, minlength: 10, maxlength: 10},
          email: { required: true, email: true }
        }
      });

    $('#step-1-btn').click(function(event){
        event.preventDefault();
        validator.form();
    })

});