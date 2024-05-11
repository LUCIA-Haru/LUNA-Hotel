let add_room_form = document.getElementById("add_room_form");
add_room_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_room();
});

function add_room() {
  let data = new FormData();
  data.append("add_room", "");
  data.append("RoomNumber", add_room_form.elements["room_no"].value);
  data.append("FloorNo", add_room_form.elements["floor_no"].value);
  data.append("RT", add_room_form.elements["rt"].value);

  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/rooms_crud.php", true);

  xhar.onload = function () {
    var myModal = document.getElementById("add-rooms");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();
    if (this.responseText == 1) {
      alert("success", "New Room added");
      add_room_form.reset();
      get_rooms();
    } else {
      alert("error", "Failed to add rooms!");
    }
  };
  xhar.send(data);
}
function get_rooms() {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/rooms_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    document.getElementById("rooms_data").innerHTML = this.responseText;
  };
  xhar.send("get_rooms");
}
function rem_rooms(val) {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/rooms_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  // When the request is done, parse the results and update the page
  xhar.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Rooms Removed");
      get_rooms();
    } else if (this.responseText == "roomtype_added") {
      alert("error", "room is added!");
    } else {
      alert("error", "Sever Down!");
    }
  };
  xhar.send("rem_rooms=" + val);
}

// togglestatus
function room_toggleStatus(ID, val) {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/rooms_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Room Status has been updated");
      get_rooms();
    } else {
      alert("error", "Cannot Update");
    }
  };
  xhar.send("room_toggleStatus=" + ID + "&value=" + val);
}

// edit position
let edit_room_form = document.getElementById("edit_room_form");

function edit_rooms(RoomId) {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/rooms_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    let data = JSON.parse(this.responseText);
    edit_room_form.elements["room_no"].value = data.edit_rooms_data.RoomNumber;
    edit_room_form.elements["floor_no"].value = data.edit_rooms_data.FloorNo;
    edit_room_form.elements["rt_name"].value = data.edit_rooms_data.RTID;
    document.getElementById("edit_rooms_id").value = RoomId;
  };
  xhar.send("get_edit_rooms=" + RoomId);
}

edit_room_form.addEventListener("submit", function (e) {
  e.preventDefault();
  submit_edit_rooms();
});

function submit_edit_rooms() {
  let data = new FormData();

  data.append("edit_rooms", "");
  data.append("roomno", edit_room_form.elements["room_no"].value);
  data.append("floorno", edit_room_form.elements["floor_no"].value);
  data.append("rt", edit_room_form.elements["rt_name"].value);
  data.append("roomid", edit_room_form.elements["edit_rooms_id"].value);

  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/rooms_crud.php", true);

  xhar.onload = function () {
    var myModal = document.getElementById("edit-rooms");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText.trim() === "1") {
      alert("success", "Rooms Data Updated");
      edit_room_form.reset();
      get_rooms();
    } else {
      alert("error", "No data changed");
    }
  };

  xhar.send(data);
}

// Function Calls

document.addEventListener("DOMContentLoaded", function () {
  get_rooms();
});
