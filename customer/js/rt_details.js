function fetchRoomDetails() {
  let rtdetails = document.querySelectorAll(".rt-detail");
  rtdetails.forEach(function (link) {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      // get the room id
      let rid = this.getAttribute("data-roomid");

      let xhr = new XMLHttpRequest();

      xhr.open("POST", "ajax/fetch_rt.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var myModal = document.getElementById("rt_details");
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            let roomData = JSON.parse(xhr.responseText);
            // title
            document.getElementById(
              "rt-Title"
            ).innerHTML = `${roomData.RTName} Details`;
            // img
            let imgCarousel = "";
            for (let i = 0; i < roomData.images.length; i++) {
              const RTimg = roomData.images[i];
              const isActive = i === 0 ? "active" : "";

              imgCarousel += `
                  <div class="carousel-item ${isActive}">
                        <img src="${RTimg}" class="d-block w-100 rounded" alt="Room Type Image">
                   </div>
                  `;
            }

            //   feature
            let features_data = roomData.features
              .map(
                (feature) =>
                  `<span class='badge rounded-pill custom-pill text-dark text-wrap me-2'>${feature}</span>`
              )
              .join("");

            //   Amenities
            let amenities_data = roomData.amenities
              .map(
                (amenities) =>
                  `<span class='badge rounded-pill custom-pill text-dark text-wrap me-2'>${amenities}</span>`
              )
              .join("");

            // body

            document.getElementById("rt-body").innerHTML = `
            <!-- Carousel -->
               <div id="rt_img_carousel" class="carousel  carousel-fade w-60 h-50" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        ${imgCarousel}
                        
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#rt_img_carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#rt_img_carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>     
            <!-- Carousel End-->

            

            <div class="accordion" id="rt_accordian">
                
                <!-- Information -->

                <div class="accordion-item mt-3">
                    <h2 class="accordion-header">
                    <button class="accordion-button text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        Room Information
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-6">
                                    <p class="rt-details-input"><span class="rt-details-label">Area:</span>
                                    ${roomData.Area}.sq.ft</p>
                                    <p class="rt-details-input"><span class="rt-details-label">Adult(MAX):</span>
                                    ${roomData.Adult} person</p>
                                    <p class="rt-details-input"><span class="rt-details-label">Price Per Night:</span> $ <b>${roomData.PricePerNight}</b>
                                    </p>
                                    
                                </div>
                                <div class="col-6">
                                    <p class="rt-details-input"><span class="rt-details-label">Location:</span>
                                    ${roomData.From_Floor}F~${roomData.To_Floor}F</p>
                                    <p class="rt-details-input"><span class="rt-details-label">Children(MAX):</span>
                                    ${roomData.Children} person</p>
                                </div>
                                <div class="col-12">
                                    <h5 class="rt-details-title">Description</h5>
                                    <p>${roomData.RTDescription}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

                    <!-- Amenities & Features -->
            
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        Amenities & Features
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <h6 class="rt-details-title">Features</h6>
                        ${features_data}
                        <br>
                        <br>
                        <h6 class="rt-details-title">Amenities</h6>
                        ${amenities_data}

                    </div>
                    </div>
                </div>

                <!-- Extra -->

                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        Extra Information
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <p class="extra-text">Extra bed is available for <span class="price">$50 </span><b>(including VAT and service charge)</b> per person without breakfast.</p> <br>

                            <p class="extra-text"><i class="bi bi-exclamation-diamond-fill"></i> All rates are subject to a 10% service charge and a 5% tax.</p>
                        </div>
                    </div>
                </div>
                </div>
            

            
            `;

            let myCarousel = new bootstrap.Carousel(
              document.getElementById("rt_img_carousel"),
              {
                interval: 3000, // Same as the data-bs-interval attribute
              }
            );
            // Start carousel autoplay when modal is shown
            myModal.addEventListener("shown.bs.modal", function () {
              myCarousel.cycle();
            });
          } else {
            console.error("Request Failed", xhr.status);
          }
        }
      };
      xhr.send("rid=" + rid);
    });
  });
}

let checkin = document.getElementById("checkIn");
let checkout = document.getElementById("checkOut");
let adult = document.getElementById("adultInput");
let children = document.getElementById("childrenInput");
let chk_avail_btn = document.getElementById("chk_avail_btn");
let chk_filter_btn = document.getElementById("chk_filter_btn");
let rooms_list = document.getElementById("rooms_list");

function fetch_room_filter() {
  let chk_avail = JSON.stringify({
    checkin: checkin.value,
    checkout: checkout.value,
  });
  let guests = JSON.stringify({
    adult: adult.value,
    children: children.value,
  });

  let feature_list = { Features: [] };
  let amenities_list = { Amenities: [] };

  let get_feature = document.querySelectorAll("[name = feature]:checked");
  let get_amenities = document.querySelectorAll("[name = amenities]:checked");

  if (get_feature.length > 0) {
    get_feature.forEach((feature) => {
      feature_list.Features.push(feature.value);
    });
  }
  if (get_amenities.length > 0) {
    get_amenities.forEach((amenity) => {
      amenities_list.Amenities.push(amenity.value);
    });
  }
  if (get_feature.length > 0 || get_amenities.length > 0) {
    chk_filter_btn.classList.remove("d-none");
  } else {
    chk_filter_btn.classList.add("d-none");
  }

  let feature_list_json = JSON.stringify(feature_list);
  let amenities_list_json = JSON.stringify(amenities_list);

  let xhr = new XMLHttpRequest();
  xhr.open(
    "POST",
    "ajax/fetch_rt.php?fetch_rooms&chk_avail=" +
      chk_avail +
      "&guests=" +
      guests +
      "&feature_list=" +
      feature_list_json +
      "&amenities_list=" +
      amenities_list_json,
    true
  );

  xhr.onprogress = function () {
    rooms_list.innerHTML = `
    <div class="spinner-border text-info mb-3 d-block" id="loader" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>`;
  };

  xhr.onload = function () {
    rooms_list.innerHTML = this.responseText;
    fetchRoomDetails();
  };
  xhr.send();
}

function chk_avail_filter() {
  if ((checkin.value != "") & (checkout.value != "")) {
    fetch_room_filter();
    chk_avail_btn.classList.remove("d-none");
  }
}
function chk_avail_clear() {
  checkin.value = "";
  checkout.value = "";
  adult.value = "1";
  children.value = "0";
  chk_avail_btn.classList.add("d-none");
  fetch_room_filter();
}
function chk_filter_clear() {
  let get_feature = document.querySelectorAll("[name = feature]:checked");
  let get_amenities = document.querySelectorAll("[name = amenities]:checked");

  get_feature.forEach((feature) => {
    feature.checked = false;
  });
  get_amenities.forEach((amenity) => {
    amenity.checked = false;
  });
  chk_filter_btn.classList.add("d-none");
  fetch_room_filter();
}

document
  .getElementById("chk_filter_btn")
  .addEventListener("click", function () {
    chk_filter_clear();
  });
function guests_filter() {
  if (parseInt(adult.value) > 0 || parseInt(children.value) > 0) {
    fetch_room_filter();
  }
}

// update search data

document.addEventListener("DOMContentLoaded", function () {
  fetch_room_filter();
});
