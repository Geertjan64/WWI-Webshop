$(document).ready(function() {
    $('.search-box input[type="search"]').on("keyup input", function () {
        /* Get input value on change */
        let inputVal = $(this).val();
        let resultDropdown = $(this).siblings(".result");
        if (inputVal.length) {
            $.get("../Pages/surgestions.php", {term: inputVal}).done(function (data) {
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else {
            resultDropdown.empty();
        }
    });

    // Set search input value on click of result item
    $(document).on("click", ".result p", function () {
        $(this).parents(".search-box").find('input[type="search"]').val($(this).text());
        $(this).parent(".result").empty();
        document.myform.submit();
        // window.location.replace("product_info.php?item=");
    });
});

