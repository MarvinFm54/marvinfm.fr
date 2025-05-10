function switchList() {
	const box = document.getElementById("content");
	const icon = document.getElementById("switchIconList");
	const cours = document.getElementById("cours");
            
	if (box.style.columnWidth === "unset") {
		box.style. columnWidth = "320px";
		icon.className = "fa-solid fa-list";
	} else {
		box.style. columnWidth = "unset";
		icon.className = "fa-solid fa-th-large";
	}
}

document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("toggle-mode");

    if (localStorage.getItem("dark-mode") === "enabled") {
        document.body.classList.add("dark-mode");
        toggleButton.innerHTML = "<i class='fa-solid fa-sun'></i>";
    } else {
        toggleButton.innerHTML = "<i class='fa-solid fa-moon'></i>";
    }

    toggleButton.addEventListener("click", function () {
        document.body.classList.toggle("dark-mode");
        if (document.body.classList.contains("dark-mode")) {
            localStorage.setItem("dark-mode", "enabled");
            toggleButton.innerHTML = "<i class='fa-solid fa-sun'></i>";
        } else {
            localStorage.setItem("dark-mode", "disabled");
            toggleButton.innerHTML = "<i class='fa-solid fa-moon'></i>";
        }
    });
});
