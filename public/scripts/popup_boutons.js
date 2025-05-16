const buttonsHover = document.querySelectorAll("[data-popup]");
const buttonsClick = document.querySelectorAll("[data-popup-click]");
const popups = document.querySelectorAll(".popup");

let activeHoverPopup = null;
let activeClickPopups = new Set();

function showPopup(popup, type) {
    if (!popup) return;

    popup.style.display = "flex";
    setTimeout(() => popup.classList.add("active"), 10);

    if (type === "hover") {
        activeHoverPopup = popup;
    } else {
        activeClickPopups.add(popup);
    }

    setTimeout(() => {
        document.addEventListener("click", closeOnClickOutside);
    }, 50);
}

function hidePopup(popup, type) {
    if (!popup) return;

    popup.classList.remove("active");
    setTimeout(() => {
        popup.style.display = "none";

        if (type === "hover" && activeHoverPopup === popup) {
            activeHoverPopup = null;
        } else if (type === "click") {
            activeClickPopups.delete(popup);
        }
    }, 300);
}

function closeAllPopups() {
    if (activeHoverPopup) hidePopup(activeHoverPopup, "hover");
    for (let popup of activeClickPopups) hidePopup(popup, "click");

    document.removeEventListener("click", closeOnClickOutside);
}

function togglePopup(popup) {
    if (activeHoverPopup === popup) {
        hidePopup(popup, "hover");
        return;
    }
    
    if (activeClickPopups.has(popup)) {
        hidePopup(popup, "click");
    } else {
        showPopup(popup, "click");
    }
}

function closeOnClickOutside(event) {
    const isClickInsideAnyPopup = [...activeClickPopups].some(popup => popup.contains(event.target)) ||
                                  (activeHoverPopup && activeHoverPopup.contains(event.target));

    const isClickOnButton = document.querySelector(`[data-popup="${activeHoverPopup?.id}"]`)?.contains(event.target) ||
                            [...document.querySelectorAll("[data-popup-click]")].some(button => 
                                activeClickPopups.has(document.getElementById(button.getAttribute("data-popup-click"))) && 
                                button.contains(event.target));

    if (!isClickInsideAnyPopup && !isClickOnButton) {
        closeAllPopups();
    }
}

let canCloseHoverPopup = false;
buttonsHover.forEach(button => {
    const popupId = button.getAttribute("data-popup");
    const popup = document.getElementById(popupId);

    if (popup) {
        button.addEventListener("mouseenter", () => {
            showPopup(popup, "hover");
            canCloseHoverPopup = false;  
            setTimeout(() => canCloseHoverPopup = true, 250);
        });

        button.addEventListener("click", (e) => {
            e.stopPropagation();
            if (activeHoverPopup === popup && canCloseHoverPopup) {
                hidePopup(popup, "hover");
            }
        });
    }
});

buttonsClick.forEach(button => {
    const popupId = button.getAttribute("data-popup-click");
    const popup = document.getElementById(popupId);

    if (popup) {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
            togglePopup(popup);
        });
    }
});


// Usage particulier : Permet d'ouvrir automatiquement la popup de connexion si besoin
window.addEventListener("DOMContentLoaded", () => {
    const params = new URLSearchParams(window.location.search);
    if (params.get("action") === "connection") {
        const popup = document.getElementById("popupConnect");
        if (popup) {
            showPopup(popup, "click");
        }
    }
});
