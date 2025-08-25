// Improved search functionality
function clearSearch() {
  window.location.href = window.location.pathname;
}

// Enhanced search with better term handling
let searchTimeout;
const searchInputs = document.querySelectorAll(
  "#searchInput, #mobileSearchInput"
);

searchInputs.forEach((input) => {
  input.addEventListener("input", function () {
    clearTimeout(searchTimeout);
    const query = this.value.trim();

    // Debounce search - wait 800ms after user stops typing
    searchTimeout = setTimeout(() => {
      if (query.length >= 2 || query.length === 0) {
        updateSearch(query);
      }
    }, 800);
  });

  // Submit on Enter key
  input.addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
      clearTimeout(searchTimeout);
      const query = this.value.trim();
      updateSearch(query);
    }
  });
});

// Function to update search
function updateSearch(query) {
  const url = new URL(window.location);
  if (query) {
    url.searchParams.set("search", query);
  } else {
    url.searchParams.delete("search");
  }
  window.location.href = url.toString();
}

// Sync search inputs (desktop and mobile)
searchInputs.forEach((input, index) => {
  input.addEventListener("input", function () {
    searchInputs.forEach((otherInput, otherIndex) => {
      if (index !== otherIndex) {
        otherInput.value = this.value;
      }
    });
  });
});

// Enhanced search term highlighting
function highlightSearchTerms() {
  const searchQuery = "<?php echo htmlspecialchars($search_query); ?>";
  if (!searchQuery) return;

  // Split search query into terms
  const searchTerms = searchQuery
    .toLowerCase()
    .split(" ")
    .filter((term) => term.length > 0);
  if (searchTerms.length === 0) return;

  const cards = document.querySelectorAll(".account-card");
  cards.forEach((card) => {
    const textElements = card.querySelectorAll("h3, span:not(.bg-gray-100)");
    textElements.forEach((element) => {
      let html = element.innerHTML;

      searchTerms.forEach((term) => {
        const regex = new RegExp(
          `(${term.replace(/[.*+?^${}()|[\]\\]/g, "\\$&")})`,
          "gi"
        );
        html = html.replace(
          regex,
          '<mark class="bg-yellow-200 px-1 rounded">$1</mark>'
        );
      });

      element.innerHTML = html;
    });
  });
}

// Search suggestions (optional enhancement)
function addSearchSuggestions() {
  const searchInputs = document.querySelectorAll(
    "#searchInput, #mobileSearchInput"
  );

  searchInputs.forEach((input) => {
    input.addEventListener("focus", function () {
      // You can add search suggestions here
      showSearchSuggestions(this);
    });
  });
}

function showSearchSuggestions(input) {
  // Example suggestions based on available data
  const suggestions = [
    "facebook cameroon",
    "instagram 1000 followers",
    "tiktok verified",
    "whatsapp business",
    "youtube monetized",
  ];

  // Implementation for showing suggestions would go here
}

// Call enhanced functions
document.addEventListener("DOMContentLoaded", function () {
  highlightSearchTerms();
  addSearchSuggestions();
});
