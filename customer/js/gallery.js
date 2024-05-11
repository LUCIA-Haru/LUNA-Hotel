document.addEventListener("DOMContentLoaded", () => {
  initbanner();

  const counterElement = document.querySelector(".counter p");

  // Update scroll percentage function
  function updateScrollPercentage() {
    const docHeight =
      document.documentElement.scrollHeight - window.innerHeight;
    const scrollPosition = window.scrollY;
    const scrolledPercentage = Math.round((scrollPosition / docHeight) * 100);
    counterElement.textContent = `${scrolledPercentage}%`;
  }

  window.addEventListener("scroll", updateScrollPercentage);

  initgallery();
});

function initgallery() {
  gsap.registerPlugin(ScrollTrigger);
  const bgColor = [
    "hsl(39.87, 73.08%, 59.22%)",
    "hsl(196, 10%, 77%)",
    "hsl(189.23, 5.35%, 47.65%)",
    "hsl(46, 100%, 85%)",
    "hsl(201.18, 22.67%, 14.71%)",
    "hsla(208, 12%, 75%, 0.768)",
    "hsl(0, 3.57%, 32.94%)",
    "hsl(36.92, 41.94%, 93.92%)",
  ];

  const bgColorElement = document.querySelector(".gallery-bg-color");

  gsap.utils.toArray("#gallery .gallery-item").forEach((item, index) => {
    let img = item.querySelector(".gallery-item img");

    gsap.fromTo(
      img,
      {
        clipPath: "polygon(0% 0%, 100% 0%, 100% 0%, 0% 0%)",
      },
      {
        clipPath: "polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)",
        ease: "power1.Out",
        duration: 7,
        scrollTrigger: {
          trigger: item,
          start: "center bottom",
          end: "bottom top",
          toggleActions: "play none none none",
          onEnter: () => updateBackground(bgColor[index], bgColorElement),
          onEnterBack: () => updateBackground(bgColor[index], bgColorElement),
        },
      }
    );
  });
  function updateBackground(color, element) {
    gsap.to(element, {
      background: `linear-gradient(0deg, ${color} 0%, rgba(252, 176, 68, 0) 100%)`,
      duration: 4,
      ease: "power1.out",
    });
  }
}

// banner
function initbanner() {
  gsap.registerPlugin(ScrollTrigger);

  // GSAP animation for scaling the image
  gsap.to(".gallery-hero-img", {
    scale: 1,
    width: "70%",
    zIndex: 1,
    scrollTrigger: {
      trigger: ".gallery-img-wrapper",
      start: "top center",
      end: "bottom center",
      scrub: 3,
      onUpdate: (self) => {
        const zIndexValue = self.progress < 0.5 ? 1 : -1; // Invert the z-index values
        gsap.set(".h-1, .h-2, .h-3", { zIndex: zIndexValue }); // Set z-index for all h1 elements
      },
    },
  });

  // GSAP animation for moving the text
  gsap.to(".h-1", {
    x: "30%", // Move h1 tag to the right by 50% of its width (start behind the image)
    ease: "none",
    zIndex: 2,
    scrollTrigger: {
      trigger: ".gallery-img-wrapper",
      start: "top center",
      end: "bottom center",
      scrub: 2,
    },
  });

  gsap.to(".h-2", {
    x: "-50%", // Move h1 tag to the left by 50% of its width (start behind the image)
    ease: "none",
    zIndex: 2,
    scrollTrigger: {
      trigger: ".gallery-img-wrapper",
      start: "top center",
      end: "bottom center",
      scrub: 2,
    },
  });

  gsap.to(".h-3", {
    y: "50%", // Move h1 tag upwards by 50% of its height (start behind the image)
    ease: "none",
    zIndex: 2, // Disable easing
    scrollTrigger: {
      trigger: ".gallery-img-wrapper",
      start: "top center",
      end: "bottom center",
      scrub: 2,
    },
  });
}
