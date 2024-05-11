document.addEventListener("DOMContentLoaded", () => {
  initslider();
  initroomSwiper();
  // cardstack();
});

// prelaoder
function Preloader(ref) {
  const boxRef = document.createElement("div");
  const box2Ref = document.createElement("div");
  const textRef = document.createElement("p");

  boxRef.classList.add("box");
  textRef.textContent = "LUNA";

  const preloader = document.createElement("div");
  preloader.classList.add("preloader");
  preloader.appendChild(boxRef);
  boxRef.appendChild(textRef);
  const boxClip = document.createElement("div");
  const boxClip2 = document.createElement("div");
  boxClip.classList.add("box-clip");
  boxClip2.classList.add("box-clip2");
  boxRef.appendChild(boxClip);
  boxRef.appendChild(boxClip2);

  const tl = gsap.timeline({ repeat: -1, repeatDelay: 0.2 });
  tl.to(textRef, { opacity: 0, duration: 1 }, "o")
    .to(
      boxClip,
      {
        clipPath: "polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)",
        duration: 0.2,
      },
      "o"
    )
    .to(boxClip, {
      clipPath: "polygon(0% 0%, 0% 0%, 0% 100%, 0% 100%)",
      duration: 0.2,
    })
    .to(textRef, { opacity: 1, duration: 0.4 }, "n")
    .to(
      boxClip2,
      {
        clipPath: "polygon(100% 0%, 0% 0%, 0% 100%, 100% 100%)",
        duration: 0.2,
      },
      "n"
    )
    .to(
      boxClip2,
      {
        clipPath: "polygon(100% 0%, 100% 0%, 100% 100%, 100% 100%)",
        duration: 0.4,
      },
      "m"
    );

  ref.appendChild(preloader);
}
// slider banner
function initslider() {
  const slides = [
    {
      id: "1",
      title: "welcome to luna",
      slideNumber: "1",
      text: "Discover nature.",
      image: "../assets/img/carousel/c1.jpg",
    },
    {
      id: "2",
      title: "Experience the Extraordinary ",
      slideNumber: "2",
      text: "Unravel the Magic of LUNA",
      image: "../assets/img/carousel/c2.jpg",
    },
    {
      id: "3",
      title: "modern convenience and design",
      slideNumber: "3",
      text: "Go big or go home.",
      image: "../assets/img/carousel/c3.jpg",
    },
    {
      id: "4",
      title: "Escape to Luxury",
      slideNumber: "4",
      text: "Transform your space.",
      image: "../assets/img/carousel/c4.jpg",
    },
    {
      id: "5",
      title: "Unravel the Magic of LUNA",
      slideNumber: "5",
      text: "Life is an adventure.",
      image: "../assets/img/carousel/c5.jpg",
    },
    {
      id: "6",
      title: "Where Every Moment is Memorable",
      slideNumber: "6",
      text: "The sky is the limit.",
      image: "../assets/img/carousel/c6.jpg",
    },
  ];

  const sliderContainer = document.getElementById("slider-container");
  const titleWrap = document.querySelector(".title-wrap");
  const numberWrap = document.querySelector(".number-wrap");
  Preloader(document.getElementById("preloader"));

  function loadSlide(index) {
    const { title, slideNumber, image } = slides[index];
    titleWrap.textContent = title;
    numberWrap.textContent = slideNumber;
    sliderContainer.style.backgroundImage = `url(${image})`;
  }

  let currentIndex = 0;

  function showNextSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    loadSlide(currentIndex);
  }

  function expandSlide() {
    gsap.to(".slide-info", { height: "100%", duration: 0.5 });
  }

  function collapseSlide() {
    gsap.to(".slide-info", { height: "50%", duration: 0.5 });
  }

  const tl = gsap.timeline();

  // Animation for slide-title-container (from left)
  tl.fromTo(
    ".slide-title-container",
    { x: "-200%", opacity: 0 },
    { x: "0%", opacity: 1, duration: 0.8 },
    "start+=1.32"
  );

  // Animation for slide-info-container (from bottom)
  tl.fromTo(
    ".slide-number-container",
    { y: "100%", opacity: 0 },
    { y: "0%", opacity: 1, duration: 0.8 },
    "start+=1.32"
  );

  // Delayed animation after preloader finishes
  tl.to(
    "#preloader",
    {
      y: "-100%",
      duration: 2.5,
      onComplete: () => {
        document.getElementById("preloader").style.display = "none";
      },
    },
    "start+=2.6"
  );

  tl.to(".slide-info-container", { opacity: 0.8 }, "start+=2.7")
    .to(
      ".slide-info-box",
      { "clip-path": "polygon(0% 100%, 100% 100%, 100% 0%, 0% 0%)" },
      "start+=2.7"
    )
    .to(".slide-info-box a, .slide-info-box h4", { opacity: 1 }, "start+=2.7")
    .add(() => {
      expandSlide();
    });

  const slidingState = { sliding: false };

  const animateSlide = (index) => {
    const img = document.querySelector(".index_slide img");
    const imageUrl = slides[index].image;

    const tl = gsap.timeline({
      onComplete: () => {
        slidingState.sliding = false;
        currentIndex = index;
        collapseSlide();
      },
    });

    // Animation for slide number to fade out
    tl.to(".slide-number", { opacity: 0, duration: 0.8 });

    img.src = imageUrl;

    // Animation for slide title to clip in
    tl.to(".slide-title", {
      "clip-path": "polygon(0% 0%, 0% 100%, 100% 100%, 100% 0%)",
      duration: 0.64,
    });

    // Animation for slide title container to slide in from the left
    tl.fromTo(
      ".slide-title-container",
      { x: "-200%", opacity: 0 },
      { x: "0%", opacity: 1, duration: 0.5 },
      "<" // Trigger this animation at the same time as the previous one
    );

    // Animation for slide number container to slide in from the bottom
    tl.fromTo(
      ".slide-number-container",
      { y: "100%", opacity: 0 },
      { y: "0%", opacity: 1, duration: 0.5 },
      "<" // Trigger this animation at the same time as the previous one
    );

    // Fade in animation for slide info
    tl.to(".slide-info", { opacity: 0, duration: 0.32 }, "<");
    tl.to(".slide-info", { opacity: 1, duration: 0.32 }, "<+0.32");

    // Reset clip-path for slide title
    tl.to(".slide-title", { "clip-path": "none", duration: 0.32 }, "<");

    const animateInfinite = () => {
      gsap.fromTo(
        ".slide-info-text",
        { y: "-100%", opacity: 0 },
        {
          y: 0,
          opacity: 1,
          duration: 4.5,
          ease: "power4.out",
          delay: 0.5,
          onComplete: animateInfinite,
        }
      );
    };

    // Start the infinite animation
    animateInfinite();
  };

  const autoplayInterval = setInterval(() => {
    if (!slidingState.sliding) {
      slidingState.sliding = true;
      const nextIndex = (currentIndex + 1) % slides.length;
      currentIndex = nextIndex;
      loadSlide(nextIndex);
      animateSlide(nextIndex);
    }
  }, 5000);
}
// mini-room swipper
function initroomSwiper() {
  const sliderItems = document.querySelectorAll(".slider__item");
  const btnNext = document.querySelector(".slider__arrows--right");
  const btnPrev = document.querySelector(".slider__arrows--left");

  // Slider
  const Slider = {
    currentItem: 0,

    init: () => {
      Slider.in(Slider.currentItem);
    },

    in: (index) => {
      const item = sliderItems[index];
      const texts = item.querySelectorAll("p");
      const timeline = new TimelineMax();

      TweenMax.set(item, { scale: 0.9 });
      TweenMax.set(item, { left: "-100vw" });

      timeline
        .to(item, 0.5, { left: 0, delay: 1 })
        .to(item, 0.5, { scale: 1 })
        .staggerFrom(
          texts,
          0.5,
          { y: 300, autoAlpha: 0, ease: Back.easeOut },
          0.2
        );
    },

    out: (index, nextIndex) => {
      const item = sliderItems[index];
      const texts = item.querySelectorAll("p");
      const timeline = new TimelineMax();
      timeline
        .staggerTo(
          texts,
          0.5,
          { y: 300, autoAlpha: 0, ease: Back.easeIn },
          "-0.5"
        )
        .to(item, 0.5, { scale: 0.9 })
        .to(item, 0.5, { left: "100vw" })
        .call(Slider.in, [nextIndex], this, "-=1.5")
        .set(texts, { clearProps: "all" });
    },

    next: () => {
      const next =
        Slider.currentItem !== sliderItems.length - 1
          ? Slider.currentItem + 1
          : 0;
      Slider.out(Slider.currentItem, next);
      Slider.currentItem = next;
    },

    prev: () => {
      const prev =
        Slider.currentItem > 0
          ? Slider.currentItem - 1
          : sliderItems.length - 1;
      Slider.out(Slider.currentItem, prev);
      Slider.currentItem = prev;
    },
  };

  // Events
  btnNext.addEventListener("click", Slider.next);
  btnPrev.addEventListener("click", Slider.prev);

  Slider.init();
}

// function cardstack() {
//   const cards = document.querySelectorAll(".dining-card");
//   cards.forEach(function (card, index) {
//     card.style.zIndex = index + 1;
//   });
// }
