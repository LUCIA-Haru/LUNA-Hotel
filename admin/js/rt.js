let add_roomtype_form = document.getElementById("add_roomtype_form");

add_roomtype_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_roomtype();
});

function add_roomtype() {
  let data = new FormData();
  data.append("add_roomtype", "");
  data.append("RTName", add_roomtype_form.elements["roomtype_name"].value);
  data.append("Adult", add_roomtype_form.elements["adult"].value);
  data.append("Children", add_roomtype_form.elements["children"].value);
  data.append("Area", add_roomtype_form.elements["area"].value);
  data.append("From_Floor", add_roomtype_form.elements["from"].value);
  data.append("To_Floor", add_roomtype_form.elements["to"].value);
  data.append("Quantity", add_roomtype_form.elements["quantity"].value);
  data.append("Price-Per-Night", add_roomtype_form.elements["price"].value);
  data.append("Description", add_roomtype_form.elements["desc"].value);

  let features = [];
  add_roomtype_form.elements["features"].forEach((el) => {
    if (el.checked === true) {
      features.push(el.value);
    }
  });
  data.append("Features", JSON.stringify(features));

  let amenities = [];
  add_roomtype_form.elements["amenities"].forEach((el) => {
    if (el.checked === true) {
      amenities.push(el.value);
    }
  });
  data.append("Amenities", JSON.stringify(amenities));

  // Set up the request
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/rt_crud.php", true);

  xhar.onload = function () {
    var myModal = document.getElementById("add-roomtypes");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText.trim() === "1") {
      alert("success", "new room type is added!");
      add_roomtype_form.reset();
      get_all_roomtype();
    } else {
      alert("error", "Fail to add data!");
    }
  };
  xhar.send(data);
}

function get_all_roomtype() {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/rt_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    document.getElementById("roomtype_data").innerHTML = this.responseText;
  };
  xhar.send("get_all_roomtype");
}
let edit_roomtype_form = document.getElementById("edit_roomtype_form");

function edit_rt_details(RTID) {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/rt_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    //console.log(JSON.parse(this.responseText)); //to look data like roomtype_data.Adult
    let data = JSON.parse(this.responseText);
    edit_roomtype_form.elements["roomtype_name"].value =
      data.roomtype_data.RTName;
    edit_roomtype_form.elements["RTID"].value = data.roomtype_data.RTID;
    edit_roomtype_form.elements["adult"].value = data.roomtype_data.Adult;
    edit_roomtype_form.elements["children"].value = data.roomtype_data.Children;
    edit_roomtype_form.elements["price"].value =
      data.roomtype_data.PricePerNight;
    edit_roomtype_form.elements["area"].value = data.roomtype_data.Area;
    edit_roomtype_form.elements["from"].value = data.roomtype_data.From_Floor;
    edit_roomtype_form.elements["to"].value = data.roomtype_data.To_Floor;
    edit_roomtype_form.elements["quantity"].value =
      data.roomtype_data.RTQuantity;
    edit_roomtype_form.elements["desc"].value =
      data.roomtype_data.RTDescription;

    edit_roomtype_form.elements["features"].forEach((el) => {
      if (data.features.includes(Number(el.value))) {
        el.checked = true;
      }
    });

    edit_roomtype_form.elements["amenities"].forEach((el) => {
      if (data.amenities.includes(Number(el.value))) {
        el.checked = true;
      }
    });
  };
  xhar.send("get_roomtype=" + RTID);
}
edit_roomtype_form.addEventListener("submit", function (e) {
  e.preventDefault();
  submit_edit_roomtype();
});

function submit_edit_roomtype() {
  let data = new FormData();
  data.append("edit_roomtype", "");
  data.append("RTID", edit_roomtype_form.elements["RTID"].value);
  data.append("RTName", edit_roomtype_form.elements["roomtype_name"].value);
  data.append("Adult", edit_roomtype_form.elements["adult"].value);
  data.append("Children", edit_roomtype_form.elements["children"].value);
  data.append("Area", edit_roomtype_form.elements["area"].value);
  data.append("From_Floor", edit_roomtype_form.elements["from"].value);
  data.append("To_Floor", edit_roomtype_form.elements["to"].value);
  data.append("Quantity", edit_roomtype_form.elements["quantity"].value);
  data.append("Price-Per-Night", edit_roomtype_form.elements["price"].value);
  data.append("Description", edit_roomtype_form.elements["desc"].value);

  let features = [];
  edit_roomtype_form.elements["features"].forEach((el) => {
    if (el.checked === true) {
      features.push(el.value);
    }
  });
  data.append("Features", JSON.stringify(features));

  let amenities = [];
  edit_roomtype_form.elements["amenities"].forEach((el) => {
    if (el.checked === true) {
      amenities.push(el.value);
    }
  });
  data.append("Amenities", JSON.stringify(amenities));

  // Set up the request
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/rt_crud.php", true);

  xhar.onload = function () {
    var myModal = document.getElementById("edit-roomtype");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText.trim() == "1") {
      alert("success", "Data are Updated");
      add_roomtype_form.reset();
      get_all_roomtype();
    } else {
      alert("error", "Fail to update data!");
    }
  };
  xhar.send(data);
}

// Imaged
let add_image_form = document.getElementById("add_image_form");

add_image_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_RTimg();
});

function add_RTimg() {
  let data = new FormData();
  data.append("add_RTimg", "");
  data.append("RTImages", add_image_form.elements["rtImg"].files[0]);
  data.append("RTID", add_image_form.elements["RTID"].value);

  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/rt_crud.php", true);

  xhar.onload = function () {
    if (this.responseText == "invalid_img") {
      alert("error", "Only JPG and PNG  images are allowed!", "image-alert");
    } else if (this.responseText == "invalid_size") {
      alert("error", "Images should be less than 2MB!", "image-alert");
    } else if (this.responseText == "upload_failed") {
      alert("error", "Images upload failed.Server Down", "image-alert");
    } else {
      alert("success", "New Image added", "image-alert");
      get_RTimg(
        add_image_form.elements["RTID"].value,
        document.querySelector("#rt-images .modal-title").innerText
      );

      add_image_form.reset();
    }
  };
  xhar.send(data);
}
function get_RTimg(RTID, RTName) {
  document.querySelector("#rt-images .modal-title").innerText = RTName;
  add_image_form.elements["RTID"].value = RTID;
  add_image_form.elements["rtImg"].value = "";

  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/rt_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    document.getElementById("rt-image-data").innerHTML = this.responseText;
  };
  xhar.send("get_RTimg=" + RTID);
}

function rem_RTimage(ImgID, RTID) {
  let data = new FormData();
  data.append("rem_RTimage", "");
  data.append("ImgID", ImgID);
  data.append("RTID", RTID);

  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/rt_crud.php", true);

  xhar.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Deleted Image!", "image-alert");
      get_RTimg(
        RTID,
        document.querySelector("#rt-images .modal-title").innerText
      );
    } else {
      alert("error", "Failed to delete!", "image-alert");
    }
  };
  xhar.send(data);
}
function active_img(ImgID, RTID) {
  let data = new FormData();
  data.append("active_img", "");
  data.append("ImgID", ImgID);
  data.append("RTID", RTID);

  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/rt_crud.php", true);

  xhar.onload = function () {
    if (this.responseText.trim() === "1") {
      alert("success", "Image Thumbnail Changed!", "image-alert");
      get_RTimg(
        RTID,
        document.querySelector("#rt-images .modal-title").innerText
      );
    } else {
      alert("error", "Failed to changed!", "image-alert");
    }
  };
  xhar.send(data);
}
function remove_rt(RTID) {
  if (confirm("Are you sure to remove this roomtype?")) {
    let data = new FormData();
    data.append("remove_rt", "");
    data.append("RTID", RTID);

    let xhar = new XMLHttpRequest();
    xhar.open("POST", "ajax/rt_crud.php", true);

    xhar.onload = function () {
      if (this.responseText.trim() == "1") {
        alert("success", "Removed Roomtype!");
        get_all_roomtype();
      } else {
        alert("error", "Failed to remove roomtype!");
      }
    };
    xhar.send(data);
  }
}

// togglestatus
function toggleStatus(ID, val) {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/rt_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Room Type Status has been updated");
      get_all_roomtype();
    } else {
      alert("error", "Cannot Update");
    }
  };
  xhar.send("toggleStatus=" + ID + "&value=" + val);
}

document.addEventListener("DOMContentLoaded", function () {
  get_all_roomtype();
  get_RTimg();
});
