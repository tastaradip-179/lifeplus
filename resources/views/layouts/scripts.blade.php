<script>
    //Create a bank account
    jQuery(document).ready(function($){
    $("#btn-create-account").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
             current_balance: jQuery('#initialAmount').val(),
        };
        var type = "POST";
        var ajaxurl = "http://127.0.0.1:8000/api/bank_accounts";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                window.location.href = "http://127.0.0.1:8000/api/bank_accounts";
                console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
    });
</script>

<script>
    //Deposit
    jQuery(document).ready(function($){
    $("#btn-deposit").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            amount: jQuery('#depositAmount').val(),
            bank_account_id: jQuery('#bankAccountId').val(),
            type: jQuery('#type').val(),
        };
        var type = "POST";
        var ajaxurl = "http://127.0.0.1:8000/api/transactions";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                window.location.href = "http://127.0.0.1:8000/api/home/";
                console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
    });
</script>

<script>
    //Withdraw
    jQuery(document).ready(function($){
    $("#btn-withdraw").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            amount: jQuery('#withdrawAmount').val(),
            bank_account_id: jQuery('#bankAccountId').val(),
            type: jQuery('#type').val(),
        };
        var type = "POST";
        var ajaxurl = "http://127.0.0.1:8000/api/transactions";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                window.location.href = "http://127.0.0.1:8000/api/home/";
                console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
    });
</script>