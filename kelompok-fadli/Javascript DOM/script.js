document.getElementById("greetForm").addEventListener("submit", function (e) {
  e.preventDefault();
  const name = document.getElementById("nameInput").value.trim();

  if (name) {
    const greeting = getTimeBasedGreeting();
    const message = `${greeting}, ${name}! Senang bertemu denganmu 😊`;
    document.getElementById("greetingMessage").textContent = message;
  } else {
    document.getElementById("greetingMessage").textContent = '';
  }
});

function getTimeBasedGreeting() {
  const hour = new Date().getHours();
  if (hour >= 5 && hour < 11) return "Selamat pagi";
  if (hour >= 11 && hour < 15) return "Selamat siang";
  if (hour >= 15 && hour < 18) return "Selamat sore";
  return "Selamat malam";
}
