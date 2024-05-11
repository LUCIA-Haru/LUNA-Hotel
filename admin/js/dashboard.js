function reservation_analytic(period = 1) {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/dashboard_fetch.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    let data = JSON.parse(this.responseText);

    document.getElementById("total_reservations").textContent =
      data.total_reservations;
    document.getElementById("all_total").textContent = "$" + data.all_total;

    document.getElementById("cancelled_reservations").textContent =
      data.Cancelled_Reservations;
    document.getElementById("refund_amount").textContent =
      "$" + data.Refund_Amount;

    document.getElementById("checkout_reservations").textContent =
      data.Checkout_Reservations;
    document.getElementById("checkout_amount").textContent =
      "$" + data.Checkout_amount;

    document.getElementById("confirm_reservations").textContent =
      data.Confirm_Reservations;
    document.getElementById("confirm_amount").textContent =
      "$" + data.confirm_amount;

    document.getElementById("active_reservations").textContent =
      data.Active_Reservations;
    document.getElementById("active_amount").textContent =
      "$" + data.active_amount;
  };
  xhar.send("reservation_analytic&period=" + period);
}
function customer_analytic(period = 1) {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/dashboard_fetch.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    let data = JSON.parse(this.responseText);

    document.getElementById("newreg").textContent = data.count;
  };
  xhar.send("customer_analytic&period=" + period);
}
document.addEventListener("DOMContentLoaded", function () {
  reservation_analytic();
  customer_analytic();
});
