function runAnimations() {}
runAnimations();

document.addEventListener("DOMContentLoaded", () => {
  // Select the big image
  const bigImage = document.querySelector(".property-house-0535 img");

  // Select all the small gallery images
  const galleryImages = document.querySelectorAll(".gallery-0536 img");

  // Add a click event to each small image
  galleryImages.forEach((smallImage) => {
    smallImage.addEventListener("click", () => {
      // Update the big image src to match the clicked image src
      bigImage.src = smallImage.src;
      // Optional: Add an animation or highlight to the big image
      bigImage.classList.add("fade-in");
      setTimeout(() => bigImage.classList.remove("fade-in"), 500);
    });
  });
});

/*document.addEventListener("DOMContentLoaded", () => {
    // Select all the slide groups
    const slides = document.querySelectorAll(".group-9-0699, .group-9-0734, .group-9-0769, .group-9-0804");
  
    let currentSlide = 0;
    const totalSlides = slides.length;
  
    // Function to slide to the next slide
    function slideNext() {
      // Reset the position of all slides
      slides.forEach((slide, index) => {
        slide.style.transition = "transform 1s ease-in-out";  // Ensure smooth transition
        // Move the slides based on the current slide index
        slide.style.transform = `translateX(${(index - currentSlide) * 10}%)`;
      });
      
      // Move to the next slide
      currentSlide = (currentSlide + 1) % totalSlides;
    }
  
    // Initially, position all slides relative to the first one
    slides.forEach((slide, index) => {
      slide.style.transition = "none";  // Disable transition initially for setting up the positions
      slide.style.transform = `translateX(${(index - currentSlide) * 10}%)`;
    });
  
    // Call the slideNext function every 3 seconds
    setInterval(slideNext, 3000);  // Slides change every 3 seconds
  });
*/