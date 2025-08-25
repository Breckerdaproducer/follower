document.addEventListener("DOMContentLoaded", function () {
  const filterButtons = document.querySelectorAll(".filter-btn");
  const dropdownMenus = document.querySelectorAll(".dropdown-menu");

  // Toggle dropdown on button click
  filterButtons.forEach((button, index) => {
    button.addEventListener("click", function (e) {
      e.stopPropagation();

      // Close all other dropdowns
      dropdownMenus.forEach((menu, menuIndex) => {
        if (menuIndex !== index) {
          menu.classList.add("hidden");
        }
      });

      // Calculate position for the dropdown
      const rect = button.getBoundingClientRect();
      const dropdown = dropdownMenus[index];

      // Position dropdown below the button
      dropdown.style.top = `${rect.bottom + 8}px`;
      dropdown.style.left = `${rect.left}px`;

      // Check if dropdown would go off screen and adjust
      const dropdownRect = dropdown.getBoundingClientRect();
      const viewportWidth = window.innerWidth;

      if (rect.left + dropdown.offsetWidth > viewportWidth) {
        dropdown.style.left = `${viewportWidth - dropdown.offsetWidth - 16}px`;
      }

      // Toggle current dropdown
      dropdown.classList.toggle("hidden");
    });
  });

  // Close dropdowns when clicking outside
  document.addEventListener("click", function () {
    dropdownMenus.forEach((menu) => {
      menu.classList.add("hidden");
    });
  });

  // Prevent dropdown from closing when clicking inside it
  dropdownMenus.forEach((menu) => {
    menu.addEventListener("click", function (e) {
      e.stopPropagation();
    });
  });

  // Handle scroll repositioning
  window.addEventListener("scroll", function () {
    dropdownMenus.forEach((menu) => {
      if (!menu.classList.contains("hidden")) {
        menu.classList.add("hidden");
      }
    });
  });

  // Handle window resize
  window.addEventListener("resize", function () {
    dropdownMenus.forEach((menu) => {
      menu.classList.add("hidden");
    });
  });
});

// Filter functionality

// Card interactions
document.addEventListener("DOMContentLoaded", function () {
  const cards = document.querySelectorAll(".card");

  cards.forEach((card) => {
    card.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-4px)";
    });

    card.addEventListener("mouseleave", function () {
      this.style.transform = "translateY(0)";
    });
  });
});

// Form handling
document.addEventListener(
  "submit",
  (event) => {
    event.preventDefault();
  },
  true
);

// Toggle dropdown functionality
const profileButton = document.getElementById("profileButton");
const profileDropdown = document.getElementById("profileDropdown");
const dropdownArrow = document.getElementById("dropdownArrow");

let isDropdownOpen = false;

function toggleDropdown() {
  isDropdownOpen = !isDropdownOpen;

  if (isDropdownOpen) {
    profileDropdown.classList.remove("opacity-0", "invisible", "translate-y-1");
    profileDropdown.classList.add("opacity-100", "visible", "translate-y-0");
    dropdownArrow.style.transform = "rotate(180deg)";
  } else {
    profileDropdown.classList.add("opacity-0", "invisible", "translate-y-1");
    profileDropdown.classList.remove("opacity-100", "visible", "translate-y-0");
    dropdownArrow.style.transform = "rotate(0deg)";
  }
}

// Toggle dropdown when profile button is clicked
profileButton.addEventListener("click", function (e) {
  e.stopPropagation();
  toggleDropdown();
});

// Close dropdown when clicking outside
document.addEventListener("click", function (e) {
  if (
    !profileButton.contains(e.target) &&
    !profileDropdown.contains(e.target)
  ) {
    if (isDropdownOpen) {
      toggleDropdown();
    }
  }
});

// Close dropdown when pressing Escape key
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape" && isDropdownOpen) {
    toggleDropdown();
  }
});

// Prevent dropdown from closing when clicking inside it
profileDropdown.addEventListener("click", function (e) {
  e.stopPropagation();
});
