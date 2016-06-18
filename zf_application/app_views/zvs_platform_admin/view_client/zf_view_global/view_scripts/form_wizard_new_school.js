var NewSchoolFormWizard = function () {


    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }

            function format(state) {
                if (!state.id) return state.text; // optgroup
                return "<img class='flag' src='assets/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
            }

            $("#country_list").select2({
                placeholder: "Select",
                allowClear: true,
                formatResult: format,
                formatSelection: format,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            var form = $('#new_school_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    
                    
                    
                    //THESE RULES GOVERN THE VALIDATION OF SCHOOL REGISTRTAION FORM
                    
                    //School Code
                    schoolCode: {
                        maxlength: 100,
                        minlength: 5,
                        required: true
                    },
                    
                    //Registration Number
                    registrationNumber: {
                        maxlength: 100,
                        minlength: 5,
                        required: true
                    },
                    
                    //School Name
                    schoolName: {
                        maxlength: 45,
                        minlength: 2,
                        required: true
                    },
                    
                    //Year Established
                    dateOfEstablishment: {
                        required: true
                    },
                    
                    //School Email
                    schoolEmail: {
                        maxlength: 120,
                        minlength: 5,
                        email: true,
                        required: true
                    },
                    
                    //School Website
                    schoolWebsite: {
                        maxlength: 120,
                        minlength: 5,
                        url: true,
                        required: true
                    },
                    
                    //School School Phone Number
                    schoolPhoneNumber: {
                        maxlength: 25,
                        minlength: 5,
                        required: true
                    },
                    
                    //School Mobile Number
                    schoolMobileNumber: {
                        maxlength: 15,
                        minlength: 5,
                        required: true
                    },
                    
                    //School Box Address
                    schoolBoxAddress: {
                        maxlength: 60,
                        minlength: 2,
                        required: true
                    },
                    
                    //School Motto
                    schoolMotto: {
                        maxlength: 200,
                        minlength: 5,
                        required: true
                    },
                    
                    //School Level
                    schoolLevel: {
                        required: true
                    },
                    
                    //School Category
                    schoolCategory: {
                        required: true
                    },
                    
                    //School Gender
                    schoolGender: {
                        required: true
                    },
                    
                    //School Type
                    schoolType: {
                        required: true
                    },
                    
                    //School Country
                    schoolCountry: {
                        required: true
                    },
                    
                    //School Locality
                    schoolLocality: {
                        required: true
                    },
                    
                    
                    //THIS RULES GOVERN THE VALIDATION OF SCHOOL ADMINISTRATOR FORM.
                   
                    //Designation
                    designation: {
                        required: true
                    },
                    
                   //First Name
                    firstName: {
                        maxlength: 45,
                        minlength: 2,
                        required: true
                    },
                    
                    //Middle Name
                    middleName: {
                        maxlength: 45,
                        minlength: 0,
                        required: false
                    },
                    
                    //Last Name
                    lastName: {
                        maxlength: 45,
                        minlength: 2,
                        required: true
                    },
                    
                    //Id Number
                    idNumber: {
                        maxlength: 45,
                        minlength: 2,
                        required: true 
                    },
                    
                    //Mobile Number
                    mobileNumber: {
                        maxlength: 15,
                        minlength: 5,
                        required: true
                    },
                    
                    //Box Address
                    boxAddress: {
                        maxlength: 60,
                        minlength: 2,
                        required: true
                    },
                    
                    //Country
                    country: {
                        required: true
                    },
                    
                    //Locality
                    locality:{
                        required: true
                    },
                    
                    //Email
                    email: {
                        maxlength: 120,
                        minlength: 5,
                        email: true,
                        required: true
                    },
                    
                    //Password
                    password: {
                        maxlength: 30,
                        minlength: 5,
                        required: true
                    },
                    
                    //Confirm Password
                    password2: {
                        maxlength: 30,
                        minlength: 5,
                        required: true,
                        equalTo: "#password"
                    }
                
                },

                messages: { // custom messages for radio buttons and checkboxes
                    'gender': {
                        required: "Select at one option",
                        minlength: jQuery.format("Select at one option")
                    }
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "adminGender") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#adminGender_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success.hide();
                    error.show();
                    App.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    if (label.attr("for") == "adminGender") { // for checkboxes and radio buttons, no need to show OK icon
                        label
                            .closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid') // mark the current input as valid and display OK icon
                        .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    }
                },

                submitHandler: function (form) {
                    success.show();
                    error.hide();
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                    form.submit();
                }

            });
            

            var displayConfirm = function() {
                $('#confirmSetupInfo .form-control-static', form).each(function(){
                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    } else if ($(this).attr("data-display") == 'payment') {
                        var payment = [];
                        $('[name="payment[]"]').each(function(){
                            payment.push($(this).attr('data-title'));
                        });
                        $(this).html(payment.join("<br>"));
                    }
                });
            }

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#newSchoolRegistration')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#newSchoolRegistration')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#newSchoolRegistration').find('.button-previous').hide();
                } else {
                    $('#newSchoolRegistration').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#newSchoolRegistration').find('.button-next').hide();
                    $('#newSchoolRegistration').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#newSchoolRegistration').find('.button-next').show();
                    $('#newSchoolRegistration').find('.button-submit').hide();
                }
                App.scrollTo($('.page-title'));
            }

            // default form wizard
            $('#new_school_form').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }
                    handleTitle(tab, navigation, clickedIndex);
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    if (form.valid() == false) {
                        return false;
                    }

                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#newSchoolRegistration').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#new_school_form').find('.button-previous').hide();
            $('#new_school_form .button-submit').click(function () {
                
                //form.submit();
                
            }).hide();
        }

    };

}();