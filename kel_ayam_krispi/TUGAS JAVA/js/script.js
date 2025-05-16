document.getElementById("form").addEventListener("submit", function (event) {
    event.preventDefault();

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const address = document.getElementById("address").value.trim();
    const form = document.getElementById("body");

    if (!name || !email || !phone || !address) {
        alert("Semua data harus diisi!");
        return;
    }

    alert("Hello " + name);
    // Ubah background form
    form.style.backgroundColor = "#93cbef"; // warna hijau muda (success)
    form.style.transition = "background-color 0.5s ease";
});

document.getElementById("intro").addEventListener("click", function () {
    alert("Ini adalah demo DOM");
});

document.getElementById("sayHello").addEventListener("click", function () {
    alert("Halo! Terima kasih telah mencoba demo ini.");
});


