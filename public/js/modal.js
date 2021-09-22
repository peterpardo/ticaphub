const modalBtn = document.getElementById("modal-btn");
const modal = document.getElementById("modal-overlay");
const closeBtn = document.querySelector(".close-btn");

modalBtn.addEventListener("click", function (e) {
    e.preventDefault();
    modal.classList.remove("hidden");
    modal.classList.add("flex");
});

closeBtn.addEventListener("click", function (e) {
    e.preventDefault();
    modal.classList.add("hidden");
    modal.classList.remove("flex");
});

