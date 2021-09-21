$(function () {

    /** Town selector */
    $("#country_id").on("change", function (e) {
        var country_id = e.target.value;

        $.get(
            "/country/get-country-towns?country_id=" + country_id,
            function (data) {
                console.log(data);
                $("#city_id").empty();
                $("#city_id").append(
                    '<option value="" disable="true" selected="true">Select city</option>'
                );

                $.each(data, function (index, cityObj) {
                    $("#city_id").append(
                        '<option value="' +
                        cityObj.c_city_id +
                        '">' +
                        cityObj.city_name +
                        "</option>"
                    );
                });
            }
        );
    });


    /** Ethnicity selector */
    $("#country_id").on("change", function (e) {
        var country_id = e.target.value;

        $.get(
            "/country/get-country-ethnicities?country_id=" + country_id,
            function (data) {
                console.log(data);
                $("#ethnicity_id").empty();
                $("#ethnicity_id").append(
                    '<option value="" disable="true" selected="true">Select ethnicity</option>'
                );

                $.each(data, function (index, ethObj) {
                    $("#ethnicity_id").append(
                        '<option value="' +
                        ethObj.ethnicity_id +
                        '">' +
                        ethObj.ethnicity +
                        "</option>"
                    );
                });
            }
        );
    });

    /** ADD NEW SUBSCRIPTION */

    /** Sub Pkg Amount Selector */
    $("#sub_pkg_id").on("change", function (e) {
        var sub_pkg_id = e.target.value;

        $.get(
            "/subscription/get-sub-price?sub_pkg_id=" + sub_pkg_id,
            function (data) {
                document.getElementById("sub_amount").value = data['sub_pkg_amount'];

                /** Display the correct expected amnt to be paid on sub pkg change */
                var sub_duration = Number($("#sub_duration").val());
                var sub_pkg_amount = Number($("#sub_amount").val());
                var paid_amount = sub_pkg_amount * sub_duration;
                var balance = paid_amount - paid_amount;

                document.getElementById("paid_amount").value = paid_amount;
                document.getElementById("balance").value = balance;
            }
        );
    });

    /** Get sub end date on sub addition - keyup on duration */
    $(function () {
        $("#sub_duration").keyup(function () {
            var sb_sd = $("#sub_start_date").val();
            var sub_duration = Number($("#sub_duration").val());

            var sb_sd = sb_sd.split("-")
            var sb_sd = new Date(sb_sd.toString());
            sb_sd.setMonth(sb_sd.getMonth() + sub_duration);
            sb_sd = moment(sb_sd).format('YYYY-MM-DD');

            document.getElementById("sub_end_date").value = sb_sd;

        });
    });

      /** Get sub end date on sub addition - keyup on sub pkg start date */
      $(function () {
        $("#sub_start_date").keyup(function () {
            var sb_sd = $("#sub_start_date").val();
            var sub_duration = Number($("#sub_duration").val());

            var sb_sd = sb_sd.split("-")
            var sb_sd = new Date(sb_sd.toString());
            sb_sd.setMonth(sb_sd.getMonth() + sub_duration);
            sb_sd = moment(sb_sd).format('YYYY-MM-DD');

            document.getElementById("sub_end_date").value = sb_sd;

        });
    });

    /** Calculate the expected payment amount on sub duration on sub addition */
    $(function () {
        $("#sub_duration").keyup(function () {
            var sub_duration = Number($("#sub_duration").val());
            var sub_pkg_amount = Number($("#sub_amount").val());
            var paid_amount = sub_pkg_amount * sub_duration;
            var balance = paid_amount - paid_amount;

            document.getElementById("paid_amount").value = paid_amount;
            document.getElementById("balance").value = balance;
        });
    });

    /** RENEW SUBSCRIPTION */
      /** Calculate the expected payment amount on sub duration on sub renewal */
      $(function () {
        $("#sub_duration1").keyup(function () {
            var sub_duration = Number($("#sub_duration1").val());
            var sub_pkg_amount = Number($("#sub_amount1").val());
            var paid_amount = sub_pkg_amount * sub_duration;
            var balance = paid_amount - paid_amount;

            document.getElementById("paid_amount1").value = paid_amount;
            document.getElementById("balance1").value = balance;
        });
    });

       /** Get sub end date on sub renewal */
       $(function () {
        $("#sub_duration1").keyup(function () {
            alert*("WTF");
            var sub_duration = Number($("#sub_duration1").val());
            var sb_sd = $("#sub_start_date1").val();

            var sb_sd = sb_sd.split("-")
            var sb_sd = new Date(sb_sd.toString());
            sb_sd.setMonth(sb_sd.getMonth() + sub_duration);
            sb_sd = moment(sb_sd).format('YYYY-MM-DD');

            document.getElementById("sub_end_date1").value = sb_sd;

        });
    });
});
