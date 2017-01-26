<script type="text/javascript">
    $(document).ready(function() {
    
        $('#excessPaymentCheckBox').click(function(){
            
            if($('#excessPaymentCheckBox').prop('checked')) {
                
                $('.amountPaidLabel, .amountPaidRow, .paymentErrorDiv').hide();
                $('.newPaymentAmount').remove();
                $('.paymentAmountDiv').append('<div class="excessPaymentAmount"><input type="hidden" name="paymentAmount" class="form-control" value="0"></div>');
                
            } else {
                
                $('.excessPaymentAmount').remove();
                $('.amountPaidLabel, .amountPaidRow, .paymentErrorDiv').show();
                $('.paymentAmountDiv').append('<div class="newPaymentAmount"><input type="text" name="paymentAmount" id="formattedNumberField2" class="form-control" placeholder="2500, 30000, 45000" value=""></div>');
                
            }

        });
        
        
        //This code checks on the currency input field
        $('#formattedNumberField1, #formattedNumberField2').keyup(function(event) {

            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40){
             event.preventDefault();
            }

            $(this).val(function(index, value) {
                value = value.replace(/,/g,'');
                    return numberWithCommas(value);
            });
        });

        //This code appends the decimal delimiter
        function numberWithCommas(x) {
            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }
        
        
          
    });
</script> 