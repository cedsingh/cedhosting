var productData;
$(function () {
  $(".hosting-page .us-button").click(function () {
    productData = $(this).data("product");
    $("#totalPrice").html(productData["price"][0]);
    console.log(productData);
  });
  $(".modal").on("click", ".btn-primary", function () {
    cartHandler(
      "add",
      productData["id"],
      productData["name"],
      productData["price"][$("#planType").val()]
    );
  });

  $("#planType").change(function () {
    $("#totalPrice").html(productData["price"][$(this).val()]);
  });
  if ($("span").is("#cartValue")) {
    cartHandler("get");
  }
  $(".category-table").on("click", ".btn-danger", function () {
    console.log("It works");
    let c = confirm("Are you sure you want to delete?");
    if (c) {
      window.location.href = "admin/category/delete/" + $(this).data("id");
    }
  });

  //PayPal integration
  if (typeof paypal !== "undefined") {
    paypal
      .Buttons({
        style: {
          layout: "vertical",
          color: "blue",
          shape: "rect",
          label: "paypal",
        },
        createOrder: function (data, actions) {
          // This function sets up the details of the transaction, including the amount and line item details.
          return actions.order.create({
            purchase_units: [
              {
                amount: {
                  value: $("#totalPrice").text(),
                },
              },
            ],
          });
        },
        onApprove: function (data, actions) {
          // This function captures the funds from the transaction.
          return actions.order.capture().then(function (details) {
            // This function shows a transaction success message to your buyer.
            alert("Transaction completed by " + details.payer.name.given_name);
          });
        },
      })
      .render("#paypal-button-container");
  }
});

/* Registration function*/

// Validation functions
function validateSignup(formId) {
  let formEl = "#" + formId;
  let msg = "";
  let isValid = true;
  if ($(formEl + " [name='name']").val() == "") {
    msg += "Name is required<br>";
    isValid = false;
  } else if (!validateName($(formEl + " [name='name']").val())) {
    msg += "Name can only contain alphanumerics and one space<br>";
    isValid = false;
  }

  if ($(formEl + " [name='email']").val() == "") {
    msg += "Email is required<br>";
    isValid = false;
  } else if (!validateEmail($(formEl + " [name='email']").val())) {
    msg += "Email is not valid<br>";
    isValid = false;
  }

  if ($(formEl + " [name='mobile']").val() == "") {
    msg += "Phone number is required.<br>";
    isValid = false;
  } else if (!validateMobile($(formEl + " [name='mobile']").val())) {
    msg += "Phone number is not valid<br>";
    isValid = false;
  }
  if ($(formEl + " [name='security_ans']").val() == "") {
    msg += "Answer is required.<br>";
    isValid = false;
  } else if (!validateAnswer($(formEl + " [name='security_ans']").val())) {
    msg += "Answer can contain olny alphanumerics and no spaces<br>";
    isValid = false;
  }
  if (
    $(formEl + " [name='password']").val() !==
    $(formEl + " [name='confirm_password']").val()
  ) {
    $msg += "Passwords didn't match<br>";
    isValid = false;
  }
  $(formEl + " .alert").html(msg);
  if (!isValid) $(formEl + " .alert").show();
  return isValid;
}

function validateEmail(value) {
  if (value.indexOf(" ") > -1) {
    return false;
  } else if (value.match(/\./g).length == 2) {
    let dot1 = value.indexOf(".");
    if (dot1 + 1 == value.indexOf(".", dot1 + 1)) {
      return false;
    }
  } else if (value.match(/\./g).length > 2) {
    return false;
  } else {
    let isValid = false;
    for (let i = 0; i < value.length; i++) {
      let ascii = value.charCodeAt(i);
      if (
        (ascii >= 65 && ascii <= 90) ||
        (ascii >= 97 && ascii <= 122) ||
        ascii == 64 ||
        ascii == 46
      ) {
        isValid = true;
      } else {
        return false;
      }
    }
    return isValid;
  }
  return true;
}

function validateName(value) {
  if (value.match(/\s/g).length > 1) {
    return false;
  } else {
    let isValid = false;
    for (let i = 0; i < value.length; i++) {
      let ascii = value.charCodeAt(i);
      if (
        (ascii >= 65 && ascii <= 97) ||
        (ascii >= 97 && ascii <= 122) ||
        ascii == 32
      ) {
        isValid = true;
      } else {
        return false;
      }
    }
    return isValid;
  }
}

function validateMobile(value) {
  if (value.indexOf("0") == 0 && value.length > 11) {
    return false;
  } else if (value.length > 10) {
    return false;
  } else if (value.match("0").length == 2) {
    let zero = value.indexOf("0");
    if (zero == 0 && value.indexOf("0", 1) == 1) {
      return false;
    }
  } else {
    for (let i = 0; i < value.length - 1; i++) {
      if (value.charAt(i) !== value.charAt(i + 1)) {
        return true;
      }
    }
  }
  return true;
}

function validateAnswer(value) {
  let isValid = true;
  for (let i = 0; i < value.length; i++) {
    let ascii = value.charCodeAt(i);
    if ((ascii >= 65 && ascii <= 97) || (ascii >= 97 && ascii <= 122)) {
      isValid = true;
    } else {
      return false;
    }
    return isValid;
  }
}

function verifyOtp(type = "email") {
  $("#" + type + "Button").prop("disabled", true);
  $.ajax({
    url: "rest/verify",
    method: "post",
    dataType: "json",
    data: {
      [type + "Otp"]: $(".verify [name=" + type + "Otp]").val(),
      email: $("#emailId").val(),
    },
    error: (e) => console.log(e),
    success: function (res) {
      if (res["verified"] == 11 || res["verified"] == 10) {
        $("#" + type + "Otp").html("VERIFIED");
      } else if (res["verified"] == 2) {
        $(".verify").html(`
          <h1>Verified successfully</h1>
        `);
        window.location.href = "index.php?action=login";
      }
    },
  });
}

/** OTP confirmation functions */

/*Cart Functions*/

//Add to cart

function cartHandler(
  action = "add",
  productId = 0,
  productName = "",
  price = 0
) {
  let data;
  if (action == "add") {
    data = {
      id: productId,
      name: productName,
      price: price,
      qty: 1,
    };
  }
  $.ajax({
    url: "rest/cart/" + action,
    method: "post",
    dataType: "json",
    data: data,
    error: (e) => console.log(e),
    success: (res) => {
      if (res["cart"]) {
        $("#exampleModal").modal("hide");
        $("#cartValue").html(res["count"]);
      }
    },
  });
}

/** Paypal Integrattion */
function payWithPayPal() {}
