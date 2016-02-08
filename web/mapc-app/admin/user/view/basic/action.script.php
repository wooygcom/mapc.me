<script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.1.20/require.min.js"></script>
<script>
    requirejs(["https://code.jquery.com/jquery-2.1.4.min.js", "//code.jquery.com/ui/1.11.4/jquery-ui.js"], function() {

        $( document ).ready(function() {

            $('.detail_mileage').hide();

            $('#detail_widk').change(function() {
                if($('#detail_widk').val() == 'reserve') {
                    $('.detail_mileage').hide();
                    $('.detail_reserve').show();
                } else {
                    $('.detail_mileage').show();
                    $('.detail_reserve').hide();
                }
            });

            $( "#date_reserve_widk" ).datepicker({
                "dateFormat" : "yy-mm-dd"
            });

            $("#messageBox_diwq").delay(5000).fadeOut('slow');

        });

    });
</script>
