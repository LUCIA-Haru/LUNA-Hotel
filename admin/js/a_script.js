// alert
function alert(type, msg, position = "body") {
  let bs_class = type == "success" ? "alert-success" : "alert-danger";

  let element = document.createElement("div");
  element.innerHTML = `
    <div class="alert ${bs_class} alert-dismissible fade show" id="cus_alert" role="alert">
      <strong class="me-3">${msg}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  `;
  if (position == "body") {
    document.body.append(element);
    element.classList.add("custom-alert");
  } else {
    document.getElementById(position).appendChild(element);
  }
  setTimeout(remAlert, 5000);
}

function remAlert() {
  document.getElementsByClassName("alert")[0].remove();
}

// navbar link active
function setActive() {
  let adminlinks = document.querySelectorAll(".adminlinks .link");

  for (let i = 0; i < adminlinks.length; i++) {
    let href = adminlinks[i].getAttribute("href");
    let file_name = href.split("/").pop();

    // If the current URL contains the file name, mark the link as active
    if (document.location.href.indexOf(file_name) >= 0) {
      adminlinks[i].classList.add("nav-active");

      // If the link has a parent collapse, show it
      let parentCollapse = adminlinks[i].closest(".collapse");
      if (parentCollapse) {
        parentCollapse.classList.add("show");
      }
    }
  }
}

// Show Pass
function togglePassword() {
  const togglePassword = document.querySelectorAll(".toggle-pass");

  togglePassword.forEach(function (password) {
    password.addEventListener("click", function () {
      const targetId = this.dataset.target;
      const target = document.getElementById(targetId);

      if (target.type === "password") {
        target.type = "text";
        this.classList.remove("bi-eye-slash");
        this.classList.add("bi-eye");
      } else {
        target.type = "password";
        this.classList.remove("bi-eye");
        this.classList.add("bi-eye-slash");
      }
    });
  });
}

document.addEventListener("DOMContentLoaded", () => {
  setActive();
  togglePassword();
});
