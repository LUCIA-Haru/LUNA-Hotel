function get_reservations(search = "", page = 1) {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/r_records_fetch.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    let data = JSON.parse(this.responseText);
    if (data.table_data) {
      document.getElementById("Reservations_data").innerHTML = data.table_data;
    } else {
      document.getElementById("Reservations_data").innerHTML = "No Data Found";
    }

    document.getElementById("table-pagination").innerHTML = data.pagination;
  };
  xhar.send("get_reservations&search=" + search + "&page=" + page);
}
function change_page(page) {
  get_reservations(document.getElementById("search_input").value, page);
}

function download(id) {
  window.location.href = "generate_pdf.php?gen_pdf&id=" + id;
}

document.addEventListener("DOMContentLoaded", function () {
  get_reservations();
});
