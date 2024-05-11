let booking_form = document.getElementById("booking_form");
let info_loader = document.getElementById("info_loader");
let book_info = document.getElementById("book_info");

function check_availability() {
  let checkin_val = booking_form.elements["checkin-confirm"].value;
  let checkout_val = booking_form.elements["checkout-confirm"].value;
  let arrival = booking_form.elements["arrival"].value;
  let extrabedCheckbox = document.getElementById("extrabed");
  let specialRequestTextarea = document.getElementById("request");
  let adult = document.getElementById("adultInput");
  let children = document.getElementById("childrenInput");

  booking_form.elements["next_step"].setAttribute("disabled", true);

  if (arrival != "" && checkin_val != "" && checkout_val != "" && adult != "") {
    book_info.classList.add("d-none");
    book_info.classList.replace("text-dark", "text-danger");
    info_loader.classList.remove("d-none");

    let data = new FormData();

    data.append("check_availability", "");
    data.append("check_in", checkin_val);
    data.append("check_out", checkout_val);
    data.append("arrival", arrival);
    data.append("adult", booking_form.elements["adult-confirm"].value);
    data.append("children", booking_form.elements["children-confirm"].value);

    // Check if the "Extra Bed" checkbox is checked

    if (extrabedCheckbox.checked) {
      // Append the value indicating that an extra bed is requested
      data.append("special_request", "Extra bed requested.");
    }

    // Append the value of the textarea (special request)

    let specialRequestValue = specialRequestTextarea.value.trim(); // Trim whitespace
    if (specialRequestValue !== "") {
      // Append the value from the textarea if it's not empty
      let existingSpecialRequest = data.get("special_request") || ""; // Get existing value
      if (existingSpecialRequest !== "") {
        // If special_request already contains a value, append a separator
        existingSpecialRequest += " "; // Add separator
      }
      // Append the value from the textarea
      data.set("special_request", existingSpecialRequest + specialRequestValue);
    }

    let xhar = new XMLHttpRequest();
    xhar.open("POST", "ajax/reservation_details.php", true);

    xhar.onload = function () {
      let data = JSON.parse(this.responseText);
      if (data.status == "check_in_out_equal") {
        book_info.innerText = "You cannot check-out on the same day!";
      } else if (data.status == "check_out_earlier") {
        book_info.innerText = "Check-Out date is earlier than Check-In date!";
      } else if (data.status == "check_in_earlier") {
        book_info.innerText = "Check-In date is earlier than Today date!";
      } else if (data.status == "unavailable") {
        book_info.innerText = "Room not available for this Check-In date!";
      } else {
        book_info.innerHTML = "No. of Days:" + data.days;
        book_info.classList.replace("text-danger", "text-dark");
        booking_form.elements["next_step"].removeAttribute("disabled");
      }
      book_info.classList.remove("d-none");
      info_loader.classList.add("d-none");
    };
    xhar.send(data);
  }
}
