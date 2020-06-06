$(document).ready(function() {

    var current = 1, current_step, next_step, steps;

    steps = $("fieldset").length;
    
    $(".next").click(function(){
        current_step = $(this).parent();
        next_step = $(this).parent().next();
        next_step.show();
        current_step.hide();
        setProgressBar(++current);
    });
    
    $(".previous").click(function() {
        current_step = $(this).parent();
        next_step = $(this).parent().prev();
        next_step.show();
        current_step.hide();
        setProgressBar(--current);
    });
    
    setProgressBar(current);
    
    // Change progress bar action
    function setProgressBar(curStep) {
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
            .css("width",percent+"%")
            .html(percent+"%");
    }

    $("#loan-application").submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: 'api/loan/insert.php',
            dataType: 'json',
            contentType: 'application/json',
            type: 'POST',
            data: JSON.stringify($(this).serializeJSON()),
            processData: false
        }).done(function(data) {
            console.log(data.message);
            $(".container").empty().load("thank-you.php").hide().fadeIn("fast");
        }).fail(function(data) {
            console.log($.parseJSON(JSON.stringify(data.responseJSON)));
            $('#alert-message').removeClass('hide').html(data.responseJSON.message);
        });
        console.log(JSON.stringify($(this).serializeJSON()));
    });

    $('#ssn').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        var newVal = '';
        if (val.length > 4) {
            this.value = val;
        }
        if((val.length > 3) && (val.length < 6)) {
            newVal += val.substr(0, 3) + '-';
            val = val.substr(3);
        }
        if (val.length > 5) {
            newVal += val.substr(0, 3) + '-';
            newVal += val.substr(3, 2) + '-';
            val = val.substr(5);
        }
        newVal += val;
        this.value = newVal.substring(0, 11);
    });

    $('#phone').on('input', function() {
        var number = $(this).val().replace(/[^\d]/g, '')
        if (number.length == 7) {
            number = number.replace(/(\d{3})(\d{4})/, "$1-$2");
        } else if (number.length == 10) {
            number = number.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
        }
        $(this).val(number)
    });

    $(".only-numeric").bind("keypress", function (e) {
        var keyCode = e.which ? e.which : e.keyCode
        if (!(keyCode >= 48 && keyCode <= 57)) {
            $(".error").css("display", "inline");
            return false;
        } else {
            $(".error").css("display", "none");
        }
    });
});