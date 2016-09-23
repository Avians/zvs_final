var NewStudentFormWizard = function () {


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

            var form = $(' #new_student_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: true, // do not focus the last invalid input
                
                rules: {
                    
                    
                    
                //THESE RULES GOVERN THE VALIDATION OF STUDENT REGISTRTAION FORM
                
                //STUDENT DETAILS
                    
                    //Student First Name
                    studentFirstName: {
                        maxlength: 60,
                        minlength: 2,
                        required: true
                    },
                    
                    //Student Middle Name
                    studentMiddleName: {
                        maxlength: 60,
                        minlength: 2,
                        required: true
                    },
                    
                    //Student Last Name
                    studentLastName: {
                        maxlength: 60,
                        minlength: 2,
                        required: true
                    },
                    
                    //Student Gender
                    studentGender: {
                        required: true
                    },
                    
                    //Student Date of Birth
                    studentDateOfBirth: {
                        required: true
                    },
                    
                    //Student Religion
                    studentReligion: {
                        required: true
                    },
                    
                    //Student Country
                    studentCountry: {
                        required: true
                    },
                    
                    //Student Locality
                    studentLocality: {
                        required: true
                    },
                    
                    //Student Box Address
                    studentBoxAddress: {
                        maxlength: 60
                    },
                    
                    //Student Phone Number
                    studentPhoneNumber: {
                        maxlength: 60
                    },
                    
                    //Student Official Language
                    studentLanguage: {
                        required: true
                    },
                    
                    
                //GUARDIAN DETAILS
                    
                    //Guardian Designation
                    guardianDesignation:{
                        required: true
                    },
                    
                    //Guardian First Name
                    guardianFirstName:{
                        maxlength: 60,
                        minlength: 2,
                        required: true
                    },
                    
                    //Guardian Middle Name
                    guardianMiddleName:{
                        maxlength: 60,
                        minlength: 1,
                        required: false
                    },
                    
                    //Guardian Last Name
                    guardianLastName:{
                        maxlength: 60,
                        minlength: 2,
                        required: true
                    },
                    
                    //Guardian Gender
                    guardianGender:{
                        required: true
                    },
                    
                    //Guardian Date of Birth
                    guardianDateOfBirth:{
                        required: false
                    },
                    
                    //Guardian Religion
                    guardianReligion:{
                        required: false
                    },
                    
                    //Guardian Country
                    guardianCountry:{
                        required: true
                    },
                    
                    //Guardian Locality
                    guardianLocality:{
                        required: true
                    },
                    
                    //Guardian Box Address
                    guardianBoxAddress:{
                        maxlength: 60,
                        minlength: 5,
                        required: false
                    },
                    
                    //Guardian Phone Number
                    guardianPhoneNumber:{
                        maxlength: 30,
                        minlength: 5,
                        required: true
                    },
                    
                    //Guardian Relation
                    guardianRelation:{
                        required: true
                    },
                    
                    //Guardian Occupation
                    guardianOccupation:{
                        maxlength: 120,
                        minlength: 5,
                        required: false
                    },
                    
                    //Guardian Language
                    guardianLanguage:{
                        required: true
                    },
                
                
                
                //MEDICAL DETAILS
                
                    //Is Student Blood Group
                    isStudentBloodGroup: {
                        required: true
                    },
                
                    //Student Blood Group
                    studentBloodGroup: {
                         required: false
                    },
                
                    //Is Student Disable
                    isStudentDisable: {
                        required: true
                    },
                
                    //Student Disability
                    studentDisability: {
                        maxlength: 500,
                        minlength: 5,
                        required: false
                    },
                
                    //Is Student Medicated
                    isStudentMedicated: {
                        required: true
                    },
                
                    //Student Medication
                    studentMedication: {
                        maxlength: 500,
                        minlength: 5,
                        required: false
                    },
                
                    //Is Student Allergic
                    isStudentAllergic: {
                        required: true
                    },
                
                    //Student Allergic
                    studentAllergic: {
                        maxlength: 500,
                        minlength: 5,
                        required: false
                    },
                
                    //Is Student Treatment
                    isStudentTreatment: {
                        required: true
                    },
                
                    //Student Treatment
                    studentTreatment: {
                        maxlength: 500,
                        minlength: 5,
                        required: false
                    },
                
                    //Is Student Physician
                    isStudentPhysician: {
                        required: true
                    },
                
                    //Physician Designation
                    physicianDesignation: {
                        required: false
                    },
                
                    //Physician First Name
                    physicianFirstName: {
                        maxlength: 60,
                        minlength: 2,
                        required: false
                    },
                
                    //Physician Last Name
                    physicianLastName: {
                        maxlength: 60,
                        minlength: 2,
                        required: false
                    },
                
                    //First Physician Mobile Number
                    firstPhysicianMobileNumber: {
                        maxlength: 30,
                        minlength: 5,
                        required: false
                    },
                
                    //Second Physician Mobile Number
                    secondPhysicianMobileNumber: {
                        maxlength: 30,
                        minlength: 5,
                        required: false
                    },
                
                    //Physician Email Address
                    physicianEmailAddress: {
                        maxlength: 60,
                        minlength: 5,
                        email:true,
                        required: false
                    },
                
                    //Physician Box Address
                    physicianBoxAddress: {
                        maxlength: 60,
                        minlength: 5,
                        required: false
                    },
                
                    //Physician Country
                    physicianCountry: {
                        required: false
                    },
                
                    //Physician Lacality
                    physicianLocality: {
                        required: false
                    },
                
                    //Is Student Hospital
                    isStudentHospital: {
                        required: true
                    },
                
                    //Hospital Name
                    hospitalName: {
                        maxlength: 60,
                        minlength: 5,
                        required: false
                    },
                
                    //First Hospital Mobile Number
                    firstHospitalMobileNumber: {
                        maxlength: 30,
                        minlength: 5,
                        required: false
                    },
                
                    //Second Hospital Mobile Number
                    secondHospitalMobileNumber: {
                        maxlength: 30,
                        minlength: 5,
                        required: false
                    },
                
                    //Hospital Email Address
                    hospitalEmailAddress: {
                        maxlength: 60,
                        minlength: 5,
                        email:true,
                        required: false
                    },
                
                    //Hospital Box Address
                    hospitalBoxAddress: {
                        maxlength: 60,
                        minlength: 5,
                        required: false
                    },
                
                    //Hospital Country
                    hospitalCountry: {
                        required: false
                    },
                
                    //Hospital Lacality
                    hospitalLocality: {
                        required: false
                    },
                
                
                
                //CLASS DETAILS
                
                    //Student Class Code
                    studentClassCode: {
                        required: true
                    },
                
                    
                    //Student Stream Code 
                    studentStreamCode: {
                        required: true
                    },
                    
                    
                    //Student Year Of Study
                    studentYearOfStudy: {
                        required: true
                    },
                
                    
                    //Student Admission Number
                    studentAdmissionNumber: {
                        maxlength: 30,
                        minlength: 2,
                        required: true
                    },
                
                
                //STUDENT LOGIN DETAILS
                
                    //Student Email Address
                    studentEmailAddress: {
                        maxlength: 60,
                        minlength: 5,
                        email:true,
                        required: true
                    },
                
                    //Student School Role 
                    studentSchoolRole: {
                        required: true
                    },
                    
                    //Student Password
                    studentPassword: {
                        maxlength: 30,
                        minlength: 5,
                        required: true
                    },
                    
                    //Student Password2
                    studentPassword2: {
                        maxlength: 30,
                        minlength: 5,
                        required: true,
                        equalTo: "#studentPassword"
                    },
                
                
                //GUARDIAN LOGIN DETAILS
                
                    //Guardian Email Address
                    guardianEmailAddress: {
                        maxlength: 60,
                        minlength: 5,
                        email:true,
                        required: true
                    },
                
                    //Guardian School Role 
                    guardianSchoolRole: {
                        required: true
                    },
                    
                    //Guardian Password
                    guardianPassword: {
                        maxlength: 30,
                        minlength: 5,
                        required: true
                    },
                    
                    //Guardian Password2
                    guardianPassword2: {
                        maxlength: 30,
                        minlength: 5,
                        required: true,
                        equalTo: "#guardianPassword"
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
                $('#confirmNewStudentInfo .form-control-static', form).each(function(){
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
                $('.step-title', $(' #newStudent')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $(' #newStudent')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $(' #newStudent').find('.button-previous').hide();
                } else {
                    $(' #newStudent').find('.button-previous').show();
                }

                if (current >= total) {
                    $(' #newStudent').find('.button-next').hide();
                    $(' #newStudent').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $(' #newStudent').find('.button-next').show();
                    $(' #newStudent').find('.button-submit').hide();
                }
                App.scrollTo($('.page-title'));
            }

            // default form wizard
            $(' #new_student_form').bootstrapWizard({
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
                    $(' #newStudent').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $(' #new_student_form').find('.button-previous').hide();
            $(' #new_student_form .button-submit').click(function () {
                
                //form.submit();
                
            }).hide();
        }

    };

}();