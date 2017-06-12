<script type="text/javascript">
    $(document).ready(function() {
    
        
        //This code checks on the currency input field
        $('#formattedNumberField').keyup(function(event) {

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