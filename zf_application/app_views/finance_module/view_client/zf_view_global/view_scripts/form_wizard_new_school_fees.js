var CollectSchoolFeesFormWizard = function () {


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

            var form = $('#collectFees_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    
                    
                    
                    //THESE RULES GOVERN THE VALIDATION OF FEE ITEM SETUP FORM
                    
                    //THESE RULES GOVERN THE VALIDATION OF FEE ITEM SETUP FORM
                    
                    //Payment Schedule Year
                    paymentScheduleYear: {
                        required: true  
                    },
                    
                    //Payment Schedule Name
                    paymentScheduleName: {
                        required: true
                    },
                    
                    //Payment Source
                    paymentSource: {
                        required: true
                    },
                    
                    //Payment Amount
                    paymentAmount: {
                        maxlength: 10,
                        minlength: 1,
                        number: true,
                        required: true
                    }
                
                },

                messages: { // custom messages for radio buttons and checkboxes
                    'paymentSource': {
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
                $('#confirmCollectFeesInfo .form-control-static', form).each(function(){
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
                    }
                });
            }

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#collectFees')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#collectFees')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#collectFees').find('.button-previous').hide();
                } else {
                    $('#collectFees').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#collectFees').find('.button-next').hide();
                    $('#collectFees').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#collectFees').find('.button-next').show();
                    $('#collectFees').find('.button-submit').hide();
                }
                App.scrollTo($('.page-title'));
            }

            // default form wizard
            $('#collectFees_form').bootstrapWizard({
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
                    $('#collectFees').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#collectFees_form').find('.button-previous').hide();
            $('#collectFees_form .button-submit').click(function () {
                
                //form.submit();
                
            }).hide();
        }

    };

}();