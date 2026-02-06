const sidebar = document.getElementById("sidebar");
const overlay = document.getElementById("overlay");
const toggleBtn = document.getElementById("sidebarToggle");

function toggleSidebar() {
  sidebar.classList.toggle("active");
  overlay.classList.toggle("active");
}

toggleBtn.addEventListener("click", toggleSidebar);
overlay.addEventListener("click", toggleSidebar);
