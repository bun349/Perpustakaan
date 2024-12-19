document.addEventListener("DOMContentLoaded", function () {
    const searchBar = document.getElementById('searchBar');
    const books = document.getElementsByClassName('book');
    const noResultsMessage = document.getElementById('noResultsMessage');

    // Add an event listener to the search bar
    searchBar.addEventListener('keyup', function () {
        const query = searchBar.value.toLowerCase();
        let visibleCount = 0; // Track the number of visible books

        // Loop through all book items and hide those whose titles don't match the query
        for (let i = 0; i < books.length; i++) {
            let book = books[i];
            let title = book.querySelector('h4').innerText.toLowerCase();

            if (title.includes(query)) {
                book.style.display = ''; // Show the book
                visibleCount++; // Increment visible book count
            } else {
                book.style.display = 'none'; // Hide the book
            }
        }

        // If no books are visible, show the "No books found" message
        noResultsMessage.style.display = visibleCount === 0 ? 'block' : 'none';
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const username = document.getElementById("username");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm_password");

    form.addEventListener("submit", (e) => {
        const errors = [];

        // Validate username
        if (username.value.trim() === "") {
            errors.push("Username harus diisi.");
        }

        // Validate email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email.value)) {
            errors.push("Format email tidak valid.");
        }

        // Validate password
        if (password.value.length < 6) {
            errors.push("Password harus minimal 6 karakter.");
        }

        // Validate confirm password
        if (password.value !== confirmPassword.value) {
            errors.push("Konfirmasi password tidak cocok.");
        }

        // Display errors or allow form submission
        if (errors.length > 0) {
            e.preventDefault();
            alert(errors.join("\n")); // Display errors in an alert
        }
    });
});
