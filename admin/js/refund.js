function get_reservations(search = "") {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/refund_fetch.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    document.getElementById("Reservations_data").innerHTML = this.responseText;
  };
  xhar.send("get_reservations&search=" + search);
}

function refund_reservation(id) {
  if (confirm("Refund for  this reservation?")) {
    let data = new FormData();
    data.append("ReservationID", id);
    data.append("refund_reservation", "");

    let xhar = new XMLHttpRequest();
    xhar.open("POST", "ajax/refund_fetch.php", true);

    xhar.onload = function () {
      if (this.responseText == 1) {
        alert("success", "Reservation is refunded!");
        get_reservations();
      } else {
        alert("error", "Failed to refund reservation!");
      }
    };
    xhar.send(data);
  }
}

document.addEventListener("DOMContentLoaded", function () {
  get_reservations();
});
