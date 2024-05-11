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
  let navbar = document.getElementById("nav-bar");
  let a_tags = document.getElementsByTagName("a");

  for (let i = 0; i < a_tags.length; i++) {
    //to get page e.g rooms.php (document.location.href)
    let file = a_tags[i].href.split("/").pop();
    //jz rooms (remove . and then take first )
    let file_name = file.split(".")[0];

    //if active page name is active then return the index or return -1
    if (document.location.href.indexOf(file_name) >= 0) {
      a_tags[i].classList.add("nav-active");
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
// Function to handle increment and decrement
function handleIncrementDecrement() {
  let adultInput = document.getElementById("adultInput");
  let childrenInput = document.getElementById("childrenInput");
  let incrementDecrementBtns = document.querySelectorAll(
    ".incrementBtn, .decrementBtn"
  );

  incrementDecrementBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      let input = this.parentElement.querySelector("input");
      let currentValue = parseInt(input.value);
      let maxValue = parseInt(input.getAttribute("max"));

      if (this.classList.contains("incrementBtn")) {
        if (currentValue < maxValue) {
          input.value = currentValue + 1;
        }
      } else if (this.classList.contains("decrementBtn") && currentValue > 0) {
        input.value = currentValue - 1;
      }
      if (parseInt(adultInput.value) > 0 || parseInt(childrenInput.value) > 0) {
        chk_avail_btn.classList.remove("d-none");
      } else {
        chk_avail_btn.classList.add("d-none");
      }
      guests_filter();
    });
  });
}

// Gsap
// header
function initheader() {
  const showAnim = gsap
    .from(".header", {
      yPercent: -100,
      paused: true,
      duration: 0.2,
    })
    .progress(1);

  ScrollTrigger.create({
    start: "top top",
    end: 99999,
    onUpdate: (self) => {
      self.direction === -1 ? showAnim.play() : showAnim.reverse();
    },
  });
}

// mobile nav
function initMobilenav() {
  const open = document.querySelector(".nav-container");
  const close = document.querySelector(".nav-close");
  const mobileNav = document.querySelector(".mobile-nav");
  const navLinks = document.querySelectorAll(".mobile-nav .nav-item a"); // Select only the nav links

  var tl = gsap.timeline({ defaults: { duration: 0.5, ease: "expo.inOut" } });

  open.addEventListener("click", () => {
    if (tl.reversed()) {
      tl.play();
      document.body.style.overflow = "hidden"; // Prevent scrolling
    } else {
      tl.to(".mobile-nav", { right: 0 })
        .to(".mobile-nav", { height: "100vh" }) // Set height to full screen
        .to(".nav-close", { opacity: 1, pointerEvents: "all" }, "-=0.4")
        .to(".mobile-nav .logo", { opacity: 1 })
        .to(
          navLinks, // Target only the nav links
          { opacity: 1, pointerEvents: "all", stagger: 0.2 }, // Make nav links visible and interactive
          "-=0.4"
        );

      document.body.style.overflow = "hidden"; // Prevent scrolling
    }
  });

  close.addEventListener("click", () => {
    tl.reverse();
    document.body.style.overflowY = "auto"; // Re-enable scrolling
  });

  // Animate links on hover
  navLinks.forEach((link) => {
    link.addEventListener("mouseenter", () => {
      gsap.to(link, { scale: 1.1 });
    });
    link.addEventListener("mouseleave", () => {
      gsap.to(link, { scale: 1 });
    });
  });
}

// function growshrink() {
//   function grow() {
//     const growTl = gsap.timeline({
//       scrollTrigger: {
//         trigger: ".grow",
//         scrub: 1.5,
//         start: "top center",
//         end: "+=400",
//         ease: "power1.out",
//       },
//     });
//     growTl.to(".grow", {
//       duration: 1,
//       scale: 1,
//     });
//     growTl.to(".grow-tagline", {
//       duration: 0.4,
//       delay: -0.7,
//       opacity: 1,
//       y: 0,
//     });
//   }

//   function shrink() {
//     const shrinkTl = gsap.timeline({
//       scrollTrigger: {
//         trigger: ".shrink",
//         scrub: 1.5,
//         start: "top center",
//         end: "+=400",
//         ease: "power1.in",
//       },
//     });

//     shrinkTl.to(".shrink", {
//       duration: 2,
//       scale: 0.8,
//       filter: "blur(0px)",
//     });
//     shrinkTl.to(".shrink-tagline", {
//       duration: 0.4,
//       delay: -0.7,
//       opacity: 1,
//       y: 0,
//       ease: "power2.out",
//     });
//   }

//   // Refresh ScrollTriggers when needed
//   ScrollTrigger.refresh();

//   // Call the grow and shrink functions
//   grow();
//   shrink();
// }

function growshrink() {
  function grow(element, tagline) {
    element.forEach((el, index) => {
      const growTl = gsap.timeline({
        scrollTrigger: {
          trigger: el,
          scrub: 1.8,
          start: "top center",
          end: "+=400",
          ease: "power1.out",
        },
      });
      growTl.to(el, {
        duration: 2,
        scale: 1,
      });
      growTl.to(tagline[index], {
        duration: 0.4,
        delay: -0.7,
        opacity: 1,
        y: 0,
      });
    });
  }

  function shrink(element, tagline) {
    element.forEach((el, index) => {
      const shrinkTl = gsap.timeline({
        scrollTrigger: {
          trigger: el,
          scrub: 1.8,
          start: "top center",
          end: "+=400",
          ease: "power1.in",
        },
      });

      shrinkTl.to(el, {
        duration: 2,
        scale: 0.8,
        filter: "blur(0px)",
      });
      shrinkTl.to(tagline[index], {
        duration: 0.4,
        delay: -0.7,
        opacity: 1,
        y: 0,
        ease: "power2.out",
      });
    });
  }
  function shrink2(element) {
    element.forEach((el) => {
      const shrinkTl = gsap.timeline({
        scrollTrigger: {
          trigger: el,
          scrub: 2.2,
          start: "top center",
          end: "+=300",
          ease: "power1.in",
        },
      });

      shrinkTl.to(el, {
        duration: 2,
        scale: 1,
        filter: "blur(0px)",
      });
    });
  }

  // Get all elements with the specified classes
  const growElements = document.querySelectorAll(".grow");
  const growTaglines = document.querySelectorAll(".grow-tagline");
  const shrinkElements = document.querySelectorAll(".shrink");
  const shrink2Elements = document.querySelectorAll(".shrink2");
  const shrinkTaglines = document.querySelectorAll(".shrink-tagline");

  // Refresh ScrollTriggers when needed
  ScrollTrigger.refresh();

  // Call the grow and shrink functions with specific elements
  grow(growElements, growTaglines);
  shrink(shrinkElements, shrinkTaglines);
  shrink2(shrink2Elements);
}

function fadeIn() {
  const fadeElements = document.querySelectorAll(".fade-in");

  fadeElements.forEach((el) => {
    gsap.from(el, {
      duration: 1,
      opacity: 0,
      y: 30,
      ease: "power2.out",
      scrollTrigger: {
        trigger: el,
        start: "top bottom-=100",
        toggleActions: "play none none reverse",
      },
    });
  });
}

function textreveal() {
  // Check if the screen width is greater than 490px
  if (window.innerWidth > 490) {
    gsap.registerPlugin(ScrollTrigger);

    // Select text container elements
    const textContainers = document.querySelectorAll(".reveal-type");

    // Loop through text containers
    textContainers.forEach((container) => {
      const words = container.textContent.trim().split(" "); // Split text into words
      container.innerHTML = ""; // Clear the container's content

      words.forEach((word, i) => {
        // Create a span for each word
        const wordSpan = document.createElement("span");
        wordSpan.style.whiteSpace = "pre"; // Preserve spaces between words
        container.appendChild(wordSpan); // Append word span to text container

        // Split each word into characters
        const chars = word.split("");
        chars.forEach((char, j) => {
          // Create a span for each character
          const span = document.createElement("span");
          span.textContent = char; // Set the character as text content of the span
          wordSpan.appendChild(span); // Append character span to word span

          // Animate text color using GSAP
          gsap.fromTo(
            span,
            { color: container.dataset.bgColor }, // Initial color
            {
              color: container.dataset.fgColor, // Target color
              duration: 0.3,
              delay: i * 0.02 + j * 0.01, // Delay animation for stagger effect within words
              scrollTrigger: {
                trigger: container,
                start: "top 80%",
                end: "top 20%",
                scrub: 2,
                markers: false,
                toggleActions: "play play reverse reverse",
              },
            }
          );
        });

        // Add space after each word (except for the last one)
        if (i < words.length - 1) {
          const space = document.createTextNode(" ");
          container.appendChild(space);
        }
      });

      // Hide dots and read more button after looping through all words
      // const dots = container.querySelector(".dots");
      // const readMoreButton = container.querySelector(".readmore");
      // if (dots && readMoreButton) {
      //   dots.style.display = "none";
      //   readMoreButton.style.display = "none";
      // }
    });
  }
}

function animateMouseDown() {
  const mouseDownElements = document.querySelectorAll(".mouse-down");

  // Iterate over each element and apply the animation
  mouseDownElements.forEach((element) => {
    const tl = gsap.timeline({ repeat: -1, yoyo: true });

    // Define the animation
    tl.to(element, {
      y: 10, // Move down by 10 pixels
      duration: 0.5, // Animation duration
      ease: "power1.inOut", // Easing function
    });
  });
}

/*=============== SHOW SCROLL UP ===============*/
function initShowScrollUp() {
  const scrollUp = () => {
    const scrollUpElement = document.getElementById("scroll-up");
    // When the scroll is higher than 350 viewport height, add the show-scroll class to the a tag with the scrollup class
    if (window.scrollY >= 350) {
      scrollUpElement.classList.add("show-scroll");
    } else {
      scrollUpElement.classList.remove("show-scroll");
    }
  };
  window.addEventListener("scroll", scrollUp);
}

/*=============== chatbot ===============*/
function initChatbot() {
  let chatbot_reservation = document.getElementById("chatbot_reservation");
  let chatbot_e_M = document.getElementById("chatbot_e_M");
  let chatbot_d_c = document.getElementById("chatbot_d_c");
  let chatbot_facilities = document.getElementById("chatbot_facilities");
  let chatbot_gallery = document.getElementById("chatbot_gallery");
  let chatbot_contact = document.getElementById("chatbot_contact");
  let chatbot_toggler = document.getElementById("chatbot_toggler");
  let chatbot_wrapper = document.getElementById("chatbot_wrapper");
  let chatbotCloseBtn = document.querySelector(".chatbotCloseBtn");

  chatbot_reservation.addEventListener("click", function () {
    handleButtonClick("Reservation");
  });
  chatbot_e_M.addEventListener("click", function () {
    handleButtonClick("Events & Meeting");
  });
  chatbot_facilities.addEventListener("click", function () {
    console.log("Dining & Cafe button clicked");
    handleButtonClick("Facilities");
  });
  chatbot_gallery.addEventListener("click", function () {
    handleButtonClick("Gallery");
  });
  chatbot_d_c.addEventListener("click", function () {
    handleButtonClick("Dining & Cafe");
  });
  chatbot_contact.addEventListener("click", function () {
    handleButtonClick("Contact");
  });
  chatbot_toggler.addEventListener("click", () => {
    chatbot_wrapper.classList.toggle("show-chatbot");
  });
  chatbotCloseBtn.addEventListener("click", () => {
    chatbot_wrapper.classList.remove("show-chatbot");
  });

  function handleButtonClick(buttonText) {
    // Add the selected option as an outgoing message
    addChatMessage(buttonText, "outgoing");

    // Show "..." indicating that the bot is typing
    addChatMessage("...", "incoming");

    let response;
    switch (buttonText) {
      case "Reservation":
        response =
          "To reserve a room, firstly, choose the date and numbers of guests as you desire in the search box and then click 'Search' button which will lead to Rooms page where you can choose the rooms as desire. After clicking 'Book' Button , you will lead to reservation details place where you can place 'Special Request' and then you can proceed to another page, Confirm Reservation page where you can complete the reservation process by making payment. 😊";
        break;
      case "Events & Meeting":
        response =
          "What kind of event or meeting are you planning? For more details of our Events & Meeting  services, please visit our Events & Meeting Page and contact our Admin. 😊";
        break;
      case "Dining & Cafe":
        response =
          "Would you like to see our menu, please visit our Restaurant & Cafe Page?For more details, please contact our admin. 😊";
        break;
      case "Facilities":
        response =
          "Our Facilities services include Pool, Spa , Billiards and GYM.You can visit our Facilities Page.For more details, please contact our admin. 😊";
        break;
      case "Gallery":
        response =
          "Take a look at our gallery for a visual tour which have been in our hotel.😊";
        break;
      case "Contact":
        response =
          "You can contact us at luna1majestic@gmail.com or call us at (+95)0936852177.😊";
        break;
      default:
        response = "How can I assist you?";
    }

    // Add a delay before showing the response
    setTimeout(function () {
      // Remove the "..." message
      document.querySelector(".chatbox").lastChild.remove();
      // Add the response to the chatbox as an incoming message
      addChatMessage(response, "incoming");
    }, 1000); // Adjust the delay time as needed (in milliseconds)
  }

  // Function to add chat messages to the chatbox
  function addChatMessage(message, type) {
    var chatbox = document.querySelector(".chatbox");
    var chatItem = document.createElement("li");
    chatItem.classList.add("chat", type);
    var iconClass = type === "incoming" ? "bi bi-robot" : "";
    chatItem.innerHTML = `
        <i class="${iconClass}"></i>
        <p class="chat_text">${message}</p>
    `;
    chatbox.appendChild(chatItem);
    chatbox.scrollTo(0, chatbox.scrollHeight);
  }
}
// cookies
function initcookies() {
  const cookieBox = document.querySelector(".cookie_wrapper");
  const acceptBtn = document.querySelector(".cookiebtn");

  acceptBtn.onclick = () => {
    // Set the cookie to expire in one month
    const expirationDate = new Date();
    expirationDate.setMonth(expirationDate.getMonth() + 1);
    document.cookie = "CookieBy=LUNA; expires=" + expirationDate.toUTCString();

    // Hide the cookie box
    cookieBox.classList.add("hide");
  };

  // Check if the cookie is already set when the page loads
  let checkCookie = document.cookie.indexOf("CookieBy=LUNA");
  if (checkCookie !== -1) {
    cookieBox.classList.add("hide");
  }
}

// readmore
function initReadmore() {
  // Check if the screen width is less than 490px
  if (window.innerWidth < 490) {
    const allButtons = document.querySelectorAll(".readmore");

    // Add click event listener to each button
    allButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const displayInfo = button.closest(".display__info");
        const dots = displayInfo.querySelector(".dots");
        const moreText = displayInfo.querySelector(".more");
        const btnText = button;

        if (dots.style.display === "none" || dots.style.display === "") {
          dots.style.display = "inline";
          btnText.innerHTML = "Read more";
          moreText.style.display = "none";
        } else {
          dots.style.display = "none";
          btnText.innerHTML = "Read less";
          moreText.style.display = "inline";
        }
      });
    });
  } else {
    // Call removeDotsAndReadMore function to hide dots and readmore buttons
    removeDotsAndReadMore();
  }
}

// Function to remove dots and readmore buttons
function removeDotsAndReadMore() {
  const allDisplayInfos = document.querySelectorAll(".display__info");
  allDisplayInfos.forEach((displayInfo) => {
    const dots = displayInfo.querySelector(".dots");
    const readMoreButton = displayInfo.querySelector(".readmore");

    if (dots && readMoreButton) {
      dots.remove();
      readMoreButton.remove();
    }
  });
}

// Gsap slide in from left
function animateFrom(elem, direction) {
  direction = direction || 1;
  var x = 0,
    y = direction * -100;
  if (elem.classList.contains("gs_reveal_fromLeft")) {
    x = -100;
    y = 0;
  } else if (elem.classList.contains("gs_reveal_fromRight")) {
    x = 100;
    y = 0;
  } else if (elem.classList.contains("gs_reveal_bottom")) {
    y = 100;
  }
  elem.style.transform = "translate(" + x + "px, " + y + "px)";
  elem.style.opacity = "0";
  gsap.fromTo(
    elem,
    { x: x, y: y, autoAlpha: 0 },
    {
      duration: 1.25,
      x: 0,
      y: 0,
      autoAlpha: 1,
      ease: "expo",
      overwrite: "auto",
    }
  );
}

function hide(elem) {
  gsap.set(elem, { autoAlpha: 0 });
}

function initrevealLeftRight() {
  gsap.registerPlugin(ScrollTrigger);

  gsap.utils.toArray(".gs_reveal").forEach(function (elem) {
    hide(elem); // assure that the element is hidden when scrolled into view

    ScrollTrigger.create({
      trigger: elem,
      markers: false,
      scrub: true,
      onEnter: function () {
        animateFrom(elem);
      },
      onEnterBack: function () {
        animateFrom(elem, -1);
      },
      onLeave: function () {
        hide(elem);
      }, // assure that the element is hidden when scrolled into view
    });
  });
}
// Function to debounce a function execution
function debounce(func, timeout = 300) {
  let timer;
  return (...args) => {
    clearTimeout(timer);
    timer = setTimeout(() => {
      func.apply(this, args);
    }, timeout);
  };
}
//  Function to refresh ScrollTrigger instances
function refreshScrollTriggers() {
  ScrollTrigger.getAll().forEach((trigger) => {
    trigger.refresh(); // Refresh all ScrollTrigger instances
  });
}

// Initialize reveal animations and refresh ScrollTrigger instances
function initAndRefresh() {
  initrevealLeftRight();
  initReadmore();
  refreshScrollTriggers();
}

// smoothscroll
function initSmoothScroll() {
  let isScrolling = false;

  const debounceScroll = debounce(() => {
    isScrolling = false;
  }, 100);

  const sections = document.querySelectorAll("section");

  sections.forEach((section, index) => {
    section.addEventListener("click", (event) => {
      if (!isScrolling && event.target.tagName === "SECTION") {
        isScrolling = true;
        gsap.to(window, {
          scrollTo: {
            y: index * window.innerHeight,
            autoKill: false,
          },
          duration: 0.8,
          ease: "power2.inOut",
        });
        debounceScroll();
      }
    });
  });
}

function debounce(func, delay) {
  let timeout;
  return function () {
    const context = this;
    const args = arguments;
    clearTimeout(timeout);
    timeout = setTimeout(() => func.apply(context, args), delay);
  };
}

// function initzoom() {
//   gsap.registerPlugin(ScrollTrigger);

//   const panels = gsap.utils.toArray(".panel");
//   let tl = gsap.timeline({ paused: true });
//   tl.to(".zoom-text", {
//     scale: 100,
//     xPercent: -300,
//     transformOrigin: "50% 50%",
//   }).to(".zoom-text", { scale: "+=30", xPercent: "-=110" });

//   panels.forEach((panel) => {
//     ScrollTrigger.create({
//       trigger: panel,
//       start: "top top",
//       end: "90% 30%",
//       scrub: 1,
//       pin: true,

//       animation: tl.play(),
//     });
//   });
// }

document.addEventListener("DOMContentLoaded", () => {
  initcookies();
  initSmoothScroll();
  initheader();
  initMobilenav();
  setActive();
  animateMouseDown();
  initShowScrollUp();
  initChatbot();
  initReadmore();
  textreveal();
  growshrink();
  fadeIn();
  initrevealLeftRight();
  initAndRefresh();
  togglePassword();
  handleIncrementDecrement();

  // Call other functions after a slight delay to avoid heavy processing during initial load
  setTimeout(() => {
    // initzoom();
  }, 200);

  window.addEventListener(
    "resize",
    debounce(() => {
      initAndRefresh();
    }, 300)
  );
});
