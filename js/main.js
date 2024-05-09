$(document).bind("contextmenu", function (e) {
  e.preventDefault();
});

$(document).keydown(function (e) {
  if (e.which === 123) {
    return false;
  }
  if (e.ctrlKey && e.shiftKey && e.keyCode == "I".charCodeAt(0)) {
    return false;
  }
  if (e.ctrlKey && e.shiftKey && e.keyCode == "C".charCodeAt(0)) {
    return false;
  }
  if (e.ctrlKey && e.shiftKey && e.keyCode == "J".charCodeAt(0)) {
    return false;
  }
  if (e.ctrlKey && e.keyCode == "U".charCodeAt(0)) {
    return false;
  }
});

$("#search").on("keyup", function () {
  var value = $("#search").val().toLowerCase();
  $(".myTable tr").filter(function () {
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
  });
});

//Validation code
var value = $("#password").val();

$.validator.addMethod("checklower", function (value) {
  return /[a-z]/.test(value);
});
$.validator.addMethod("checkupper", function (value) {
  return /[A-Z]/.test(value);
});
$.validator.addMethod("checkdigit", function (value) {
  return /[0-9]/.test(value);
});
$.validator.addMethod("notEqual", function (value, element, param) {
  return this.optional(element) || value != $(param).val();
});

$(function () {
  $("form[name='registrationForm']").validate({
    rules: {
      phone: "required",
      phone: {
        required: true,
        minlength: 10,
        maxlength: 10,
        number: true,
      },
      emergency_contact_no: {
        required: true,
        minlength: 10,
        maxlength: 10,
        number: true,
        notEqual: "#phone",
      },
      password: {
        minlength: 6,
        maxlength: 30,
        required: true,
        checklower: true,
        checkupper: true,
        checkdigit: true,
      },
      cpassword: {
        required: true,
        equalTo: "#password",
      },
    },

    messages: {
      phone: {
        required: "Please provide a phone number",
        minlength: "Phone number must be min 10 digits long",
        maxlength: "Phone number must not be more than 10 digits long",
      },
      emergency_contact_no: {
        required: "Please provide a Emergency Contact number",
        minlength: "Emergency Contact number must be min 10 digits long",
        maxlength:
          "Emergency Contact number must not be more than 10 digits long",
        notEqual: "Emergency Contact No should not be same as phone Number",
      },
      password: {
        checklower: "Need atleast 1 lowercase alphabet",
        checkupper: "Need atleast 1 uppercase alphabet",
        checkdigit: "Need atleast 1 digit",
      },
      cpassword: {
        required: "This field is required.",
        equalTo: "Confirm Password should be same as password",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });
});
//end

function googleTranslateElementInit() {
  new google.translate.TranslateElement(
    {
      pageLanguage: "en",
      includedLanguages: "en,hi,mr,gu",
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
    },
    "google_translate_element"
  );
}

$(document).on("click", "#typingTestReportSearch", function () {
  var department_id = $("#department_id").val();
  var gross_speed = $("#gross_speed").val();
  var net_speed = $("#net_speed").val();
  var accuracy = $("#accuracy").val();
  var gross_speed_condition = $("#gross_speed_condition").val();
  var net_speed_condition = $("#net_speed_condition").val();
  var accuracy_condition = $("#accuracy_condition").val();

  window.open(
    "getTypingTestPrint.php?department_id=" +
      department_id +
      "&gross_speed=" +
      gross_speed +
      "&net_speed=" +
      net_speed +
      "&accuracy=" +
      accuracy +
      "&gross_speed_condition=" +
      gross_speed_condition +
      "&net_speed_condition=" +
      net_speed_condition +
      "&accuracy_condition=" +
      accuracy_condition,
    "_blank"
  );
});

$(document).on("change", "#select_field", function () {
  var select_field = $("#select_field").val();
  var selectd_field_type = $("#select_field").find(":selected").attr("data-id");
  if (selectd_field_type == "dropdown") {
    $("#select_value").removeClass("d-none");
    $("#input_value").addClass("d-none");
    $("#betweenDate").addClass("d-none");

    $.ajax({
      url: "get-dropdown-values.php",
      method: "POST",
      data: { select_field: select_field },
      error: (err) => console.log(err),
      success: function (resp) {
        $("#select_value").html(resp);
      },
    });
  } else if (selectd_field_type == "date") {
    $("#select_value").addClass("d-none");
    $("#betweenDate").addClass("d-none");
    $("#input_value").removeClass("d-none");
    $("#input_value").attr("type", "date");
  } else {
    $("#select_value").addClass("d-none");
    $("#betweenDate").addClass("d-none");
    $("#input_value").removeClass("d-none");
    $("#input_value").attr("type", "text");
  }
});

$(document).on("change", "#select_field_second", function () {
  var select_field = $("#select_field_second").val();
  var selectd_field_type = $("#select_field_second")
    .find(":selected")
    .attr("data-id");
  if (selectd_field_type == "dropdown") {
    $("#select_value_second").removeClass("d-none");
    $("#input_value_second").addClass("d-none");
    $("#betweenDateSecond").addClass("d-none");

    $.ajax({
      url: "get-dropdown-values.php",
      method: "POST",
      data: { select_field: select_field },
      error: (err) => console.log(err),
      success: function (resp) {
        $("#select_value_second").html(resp);
      },
    });
  } else if (selectd_field_type == "date") {
    $("#select_value_second").addClass("d-none");
    $("#betweenDateSecond").addClass("d-none");
    $("#input_value_second").removeClass("d-none");
    $("#input_value_second").attr("type", "date");
  } else {
    $("#select_value_second").addClass("d-none");
    $("#betweenDateSecond").addClass("d-none");
    $("#input_value_second").removeClass("d-none");
    $("#input_value_second").attr("type", "text");
  }
});

$(document).on("change", "#condition", function () {
  var condition = $("#condition").val();
  var selectd_field_type = $("#select_field").find(":selected").attr("data-id");

  if (selectd_field_type == "date" && condition == "BETWEEN") {
    $("#betweenDate").removeClass("d-none");
    $("#select_value").addClass("d-none");
    $("#input_value").addClass("d-none");
  } else if (
    selectd_field_type == "date" &&
    (condition != "=''" || condition != "!=''")
  ) {
    $("#select_value").addClass("d-none");
    $("#betweenDate").addClass("d-none");
    $("#input_value").removeClass("d-none");
    $("#input_value").attr("type", "date");
  } else if (condition == "=''") {
    $("#select_value").addClass("d-none");
    $("#betweenDate").addClass("d-none");
    $("#input_value").addClass("d-none");
  } else if (condition == "!=''") {
    $("#select_value").addClass("d-none");
    $("#betweenDate").addClass("d-none");
    $("#input_value").addClass("d-none");
  } else {
    $("#select_value").addClass("d-none");
    $("#betweenDate").addClass("d-none");
    $("#input_value").removeClass("d-none");
  }
});

$(document).on("change", "#condition_second", function () {
  var condition = $("#condition_second").val();
  var selectd_field_type = $("#select_field_second")
    .find(":selected")
    .attr("data-id");

  if (selectd_field_type == "date" && condition == "BETWEEN") {
    $("#betweenDateSecond").removeClass("d-none");
    $("#select_value_second").addClass("d-none");
    $("#input_value_second").addClass("d-none");
  } else if (
    selectd_field_type == "date" &&
    (condition != "=''" || condition != "!=''")
  ) {
    $("#select_value_second").addClass("d-none");
    $("#betweenDateSecond").addClass("d-none");
    $("#input_value_second").removeClass("d-none");
    $("#input_value_second").attr("type", "date");
  } else if (condition == "=''") {
    $("#select_value_second").addClass("d-none");
    $("#betweenDateSecond").addClass("d-none");
    $("#input_value_second").addClass("d-none");
  } else if (condition == "!=''") {
    $("#select_value_second").addClass("d-none");
    $("#betweenDateSecond").addClass("d-none");
    $("#input_value_second").addClass("d-none");
  } else {
    $("#select_value_second").addClass("d-none");
    $("#betweenDateSecond").addClass("d-none");
    $("#input_value_second").removeClass("d-none");
  }
});

$(document).on("click", "#stockItemReportSearch", function () {
  var select_field = $("#select_field").val();
  var condition = $("#condition").val();
  var input_value;
  var selectd_field_type = $("#select_field").find(":selected").attr("data-id");
  var from_date;
  var to_date;
  var table_name = $("#table_name").val();

  var andOrConditon = $("#andOrConditon").val();

  var query;
  var secondQuery;

  if (andOrConditon == "AND" || andOrConditon == "OR") {
    var select_field_second = $("#select_field_second").val();
    var selectd_field_type_second = $("#select_field_second")
      .find(":selected")
      .attr("data-id");
    var condition_second = $("#condition_second").val();
    var input_value_second;
    var from_date_second;
    var to_date_second;

    if (selectd_field_type_second == "dropdown") {
      input_value_second = $("#select_value_second").val();
    } else if (
      selectd_field_type_second == "date" &&
      condition_second == "BETWEEN"
    ) {
      from_date_second = $("#from_date_second").val();
      to_date_second = $("#to_date_second").val();
    } else {
      input_value_second = $("#input_value_second").val();
    }

    if (condition_second == "=''") {
      secondQuery =
        "" +
        andOrConditon +
        " " +
        select_field_second +
        " = '' OR " +
        select_field_second +
        " IS NULL";
    } else if (condition_second == "!=''") {
      secondQuery = "" + andOrConditon + " " + select_field_second + " != '' ";
    } else if (condition_second == "BETWEEN") {
      secondQuery =
        "" +
        andOrConditon +
        " " +
        select_field_second +
        " BETWEEN '" +
        from_date_second +
        "' AND '" +
        to_date_second +
        "'";
    } else {
      secondQuery =
        "" +
        andOrConditon +
        " " +
        select_field_second +
        " " +
        condition_second +
        " '" +
        input_value_second +
        "'";
    }
  } else {
    secondQuery = "";
  }

  if (selectd_field_type == "dropdown") {
    input_value = $("#select_value").val();
  } else if (selectd_field_type == "date" && condition == "BETWEEN") {
    from_date = $("#from_date").val();
    to_date = $("#to_date").val();
  } else {
    input_value = $("#input_value").val();
  }

  if (condition == "=''") {
    query =
      "SELECT * FROM `" +
      table_name +
      "` WHERE " +
      select_field +
      " = '' OR " +
      select_field +
      " IS NULL";
  } else if (condition == "!=''") {
    query =
      "SELECT * FROM `" + table_name + "` WHERE " + select_field + " != '' ";
  } else if (condition == "BETWEEN") {
    query =
      "SELECT * FROM `" +
      table_name +
      "` WHERE " +
      select_field +
      " BETWEEN '" +
      from_date +
      "' AND '" +
      to_date +
      "'";
  } else {
    query =
      "SELECT * FROM `" +
      table_name +
      "` WHERE " +
      select_field +
      " " +
      condition +
      " '" +
      input_value +
      "'";
  }

  query = "" + query + " " + secondQuery + ";";
  window.open(
    "get-stock-item-report.php?query=" + query + "&table=" + table_name,
    "_blank"
  );
});

$(document).on("change", "#andOrConditon", function () {
  var andOrvalue = $("#andOrConditon").val();
  if (andOrvalue == "") {
    $(".andOrField").addClass("d-none");
  } else {
    $(".andOrField").removeClass("d-none");
  }
});
