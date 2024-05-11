function get_customers() {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/customers_fetch.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    document.getElementById("Customers_data").innerHTML = this.responseText;
  };
  xhar.send("get_customers");
}

function remove_customer(CustomerID) {
  if (confirm("Are you sure to remove this customer?")) {
    let data = new FormData();
    data.append("remove_customer", "");
    data.append("CustomerID", CustomerID);

    let xhar = new XMLHttpRequest();
    xhar.open("POST", "ajax/customers_fetch.php", true);

    xhar.onload = function () {
      if (this.responseText == 1) {
        alert("success", "Removed customer!");
        get_customers();
      } else {
        alert("error", "Failed to remove customer!");
      }
    };
    xhar.send(data);
  }
}

// togglestatus
function customer_toggleStatus(ID, val) {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/customers_fetch.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Customer Status has been updated");
      get_customers();
    } else {
      alert("error", "Cannot Update");
    }
  };
  xhar.send("customer_toggleStatus=" + ID + "&value=" + val);
}

function search_customer(username) {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/customers_fetch.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    document.getElementById("Customers_data").innerHTML = this.responseText;
  };
  xhar.send("search_customer&username=" + username);
}

document.addEventListener("DOMContentLoaded", function () {
  get_customers();
});
