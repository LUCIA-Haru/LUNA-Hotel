function get_reservations(search = "") {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/new_r_fetch.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    document.getElementById("New_Reservations_data").innerHTML =
      this.responseText;
  };
  xhar.send("get_reservations&search=" + search);
}

let assign_room_form = document.getElementById("assign_room_form");
function assign_room(id, RTID) {
  assign_room_form.elements["ReservationID"].value = id;
  assign_room_form.elements["RTID"].value = RTID;
  getRoomNumbers(RTID);
}
function getRoomNumbers(RTID) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/new_r_fetch.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    let roomNumbers = JSON.parse(this.responseText);
    let roomNumbersHTML = "";
    roomNumbers.forEach(function (room) {
      roomNumbersHTML += `<div class='col-12 mb-3'>
                <label>
                    <input type='radio' name='room_no' value='${room.RoomID}' class='form-check-input shadow-none' data-room-number='${room.RoomNumber}'> Room No - 
                    ${room.RoomNumber}  <span class='text-secondary'>[Floor ${room.FloorNo}]</span> 
                </label>   
            </div>`;
    });

    document.getElementById("room_numbers_container").innerHTML =
      roomNumbersHTML;
  };

  xhr.send("RTID=" + RTID);
}

assign_room_form.addEventListener("submit", function (e) {
  e.preventDefault();

  let data = new FormData();
  data.append("assign_room", "");

  // Get the value of the selected room number
  let selectedRoomNumber = assign_room_form
    .querySelector('input[name="room_no"]:checked')
    .getAttribute("data-room-number");
  data.append("room_no", selectedRoomNumber);

  data.append(
    "ReservationID",
    assign_room_form.elements["ReservationID"].value
  );
  data.append("RTID", assign_room_form.elements["RTID"].value);

  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/new_r_fetch.php", true);

  xhar.onload = function () {
    var myModal = document.getElementById("assign_room");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText.trim() == 1) {
      alert("success", "Room Assigned Successfully");
      assign_room_form.reset();
      get_reservations();
    } else {
      alert("error", "Failed to assign room");
    }
  };

  xhar.send(data);
});

function cancel_reservation(id) {
  if (confirm("Are you sure to cancel this reservation?")) {
    let data = new FormData();
    data.append("ReservationID", id);
    data.append("cancel_reservation", "");

    let xhar = new XMLHttpRequest();
    xhar.open("POST", "ajax/new_r_fetch.php", true);

    xhar.onload = function () {
      if (this.responseText == 1) {
        alert("success", "Reservation Cancelled!");
        get_reservations();
      } else {
        alert("error", "Failed to cancel reservation!");
      }
    };
    xhar.send(data);
  }
}

document.addEventListener("DOMContentLoaded", function () {
  get_reservations();
});
