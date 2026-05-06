
document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.getElementById("search");

    if (searchInput) {
        let timeout;

        searchInput.addEventListener("keyup", function () {
            clearTimeout(timeout);

            timeout = setTimeout(() => {
                let value = this.value;

                const results = document.getElementById("results");

                // 👉 SHOW LOADING
                results.innerHTML = "<p class='loading'>Loading...</p>";

                fetch("../php/search_gigs.php?search=" + value)
                    .then(res => res.text())
                    .then(data => {
                        results.innerHTML = data;
                    })
                    .catch(() => {
                        results.innerHTML = "<div class='alert error'>Something went wrong. Try again </div>";
                    });

            }, 300);
        });
    }

    const gigForm = document.getElementById("gigForm");

    if (gigForm) {
        gigForm.addEventListener("submit", function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch("../php/create_gig.php", {
                method: "POST",
                body: formData
            })
                .then(res => res.text())
                .then(data => {
                    document.getElementById("gigForm").innerHTML =
                        "<p class='alert success'>Gig created successfully</p>";
                })
                .catch(err => console.log(err));
        });
    }

});