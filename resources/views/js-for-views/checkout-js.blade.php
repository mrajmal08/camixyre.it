<script>
    var chosenCurrency = @json($currencyCode);

    $( document ).ready(function() {
        var userState = "{{ old('state') }}";
        loadStates(userState);

        var emailAddress = @json($email);
        setEmailInputField(emailAddress);
    });

    $("#country").change(function() {
        loadStates("");
    });

    function setEmailInputField(userEmail)
    {
        $("#email_address").val(userEmail);
        $("#email_address").prop("readonly", false);
    }

    function checkRadioBtn(parentButton)
    {
        var childRadioButton = $(parentButton).find(".form-check-input");
        $($(childRadioButton)[0]).prop("checked", true);
    }

    function checkTermsAcceptance()
    {
        if( $("#terms_checkbox").prop("checked") == false )
        {
            showErrorAndScrollUp("The terms and conditions and the privacy policy must be accepted before payment.");
            return false;
        }

        return true;
    }

    $("#validationErrorAlert").hide();

    function showErrorAndScrollUp(errorText)
    {
        $("#paymentErrorAlert").hide();
        $("#validationErrorText").html(errorText);
        $("#validationErrorAlert").show();
        resetFieldsAfterPayFail();
        window.scrollTo(0, 0);
    }

    function appendBasicData(emptyForm)
    {
        emptyForm.append("_token", "{{ csrf_token() }}");
        emptyForm.append("total", $('#total').attr("data-total"));
        emptyForm.append("first_name", $('#first_name').val());
        emptyForm.append("last_name", $('#last_name').val());
        emptyForm.append("email_address", $('#email_address').val());
        emptyForm.append("phone", $('#phone').val());
        emptyForm.append("street", $('#street').val());
        emptyForm.append("apartment", $('#apartment').val());
        emptyForm.append("city", $('#city').val());
        emptyForm.append("country", $('#country').val());
        emptyForm.append("state", $('#state').val());
        emptyForm.append("zip", $('#zip').val());
        emptyForm.append("currency", "{{$currencyCode}}");
    }

    function appendPaymentData(completeFormData, gatewayKey)
    {
        var inputNames = ["first_name", "last_name", "email_address", "phone", "street", "apartment",
                          "city", "country", "state", "zip", "total"];

        inputNames.forEach(function(item) {
            $("#" + item + gatewayKey).val(completeFormData.get(item));
        });
    }

    function changeFieldsAfterPayStart()
    {
        $("#validationErrorAlert").hide();
        $("#validationErrorText").html("");
        $("#paymentErrorAlert").hide();
        $("#payStartSpinner").show();

        $("#total").prop("disabled", true);

        $("#first_name").prop("disabled", true);
        $("#last_name").prop("disabled", true);
        $("#email_address").prop("disabled", true);
        $("#phone").prop("disabled", true);
        $("#street").prop("disabled", true);
        $("#apartment").prop("disabled", true);
        $("#city").prop("disabled", true);
        $("#country").prop("disabled", true);
        $("#state").prop("disabled", true);
        $("#zip").prop("disabled", true);

        $("#terms_checkbox").prop("disabled", true);

        if( $("#btPayStartBtn").length )
        {
            $("#btPayStartBtn").prop("disabled", true);
        }

        if( $("#payStartBtnStripe").length )
        {
            $("#payStartBtnStripe").prop("disabled", true);
        }
    }

    function resetFieldsAfterPayFail()
    {
        $("#payStartSpinner").hide();

        $("#total").prop("disabled", false);

        $("#first_name").prop("disabled", false);
        $("#last_name").prop("disabled", false);
        $("#email_address").prop("disabled", false);
        $("#phone").prop("disabled", false);
        $("#street").prop("disabled", false);
        $("#apartment").prop("disabled", false);
        $("#city").prop("disabled", false);
        $("#country").prop("disabled", false);
        $("#state").prop("disabled", false);
        $("#zip").prop("disabled", false);

        $("#terms_checkbox").prop("disabled", false);

        if( $("#btPayStartBtn").length )
        {
            $("#btPayStartBtn").prop("disabled", false);
        }

        if( $("#payStartBtnStripe").length )
        {
            $("#payStartBtnStripe").prop("disabled", false);
        }
    }

    function beautifyJson(passedStr)
    {
        passedStr = passedStr.replace(/{/g, "");
        passedStr = passedStr.replace(/}/g, "");
        passedStr = passedStr.replace(/\[/g, "");
        passedStr = passedStr.replace(/]/g, "");
        passedStr = passedStr.replace(/,/g, "");
        passedStr = passedStr.replace(/"/g, "");
        passedStr = passedStr.replace(/:/g, ": ");
        passedStr = passedStr.replace(/\./g, ".</br>");

        return passedStr;
    }

    function loadStates(currentState)
    {
        var stateSelect = $('#state');
        stateSelect.empty();

        var countryVal = $('#country').val();
        var allCountries = @json($countries);
        var i = 0;
        var allCountriesLength = allCountries.length;
        var countryIndex = 0;
        for(i = 0; i < allCountriesLength; i++)
        {
            if(allCountries[i].code == countryVal)
            {
                countryIndex = i;
                break;
            }
        }

        var statesLength = allCountries[countryIndex].states_in_order.length;
        for(i = 0; i < statesLength; i++)
        {
            if(allCountries[countryIndex].states_in_order[i].state_code == currentState)
            {
                stateSelect.append('<option value="' + allCountries[countryIndex].states_in_order[i].state_code + '" selected>' + allCountries[countryIndex].states_in_order[i].state_name + '</option>');
            }
            else
            {
                stateSelect.append('<option value="' + allCountries[countryIndex].states_in_order[i].state_code + '">' + allCountries[countryIndex].states_in_order[i].state_name + '</option>');
            }
        }
    }

    // Place Order COD / Bank Transfer
    function placeOrder(type)
    {
        if( $("#terms_checkbox").prop("checked") == false )
        {
            showErrorAndScrollUp("The terms and conditions and the privacy policy must be accepted before payment.");
            return false;

        } else {

            // Get Data
            let firstName     = $('#first_name').val();
            let lastName      = $('#last_name').val();
            let emailAddress  = $('#email_address').val();
            let phone         = $('#phone').val();
            let street        = $('#street').val();
            let apartment     = $('#apartment').val();
            let city          = $('#city').val();
            let country       = $('#country').val();
            let state         = $('#state').val();
            let zip           = $('#zip').val();
            let paymentMethod = type;

            checkTermsAcceptance();

            // Insert Data
            $('.first_name_paylater').val(firstName);
            $('.last_name_paylater').val(lastName);
            $('.email_address_paylater').val(emailAddress);
            $('.phone_paylater').val(phone);
            $('.street_paylater').val(street);
            $('.apartment_paylater').val(apartment);
            $('.city_paylater').val(city);
            $('.country_paylater').val(country);
            $('.state_paylater').val(state);
            $('.zip_paylater').val(zip);
            $('.payment_method').val(paymentMethod);

            // Submit Order
            if (type == "Bank Transfer") {
                $('#payment-form-bank-transfer').submit();
            } else if (type == "COD") {
                $('#payment-form-cod').submit();
            }

        }
    }
</script>
