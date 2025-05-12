const tete1 = document.getElementById('tete1');
const tete2 = document.getElementById('tete2');
const tete3 = document.getElementById('tete3');
const yeux1 = document.getElementById('yeux1');
const lines = document.getElementById('lines');
const hitbox = document.getElementById('hitbox');
const toggleHitbox = document.getElementById('toggleHitbox');
const glitchs = document.getElementById('glitchs');
const effetsBtn = document.getElementById("effet");
const imageContainer = document.getElementById("image-container");
const themeBtn = document.getElementById("theme");
const vitesseYeux = 0.1;

const effets = [
    { nom: "Effets", style: "", couleur: "" },
    { nom: "Hacker", style: "filter: contrast(1.6) hue-rotate(90deg);", couleur: "#008000" },
    { nom: "Sépia", style: "filter: sepia(1);", couleur: "#b8b894" },
    { nom: "Nuit", style: "filter: brightness(0.5) contrast(1.2);", couleur: "#3333cc" },
    { nom: "Couleur", style: "filter: brightness(0.1);", couleur: "#0066ff" }
];

let clignementInterval = null;
let indexEffet = 0;
let yeux = true;
let clique = false;
let perso = "Fuji";
let effetActuel = { nom: "Effets", style: "", couleur: "" };
let lienYeux, lienTete1, lienTete2, lienTete3;

function def_perso() {
    switch (perso) {
        case "Fuji":
        default:
            lienYeux = "./Fuji1_Yeux.png";
            lienTete1 = "./Fuji1.png";
            lienTete2 = "./Fuji2.png";
            lienTete3 = "./Fuji3.png";
            break;
    }
    yeux1.src = lienYeux;
    tete1.src = lienTete1;
    tete2.src = lienTete2;
    tete3.src = lienTete3;
}

function changerImage(srcImg, ancienne_img, nouvelle_img) {
    nouvelle_img.src = srcImg;
    nouvelle_img.style.opacity = 1;
    setTimeout(() => ancienne_img.style.opacity = 0, 100);
}

function clignement() {
    if (yeux) {
        yeux = false;
        setTimeout(() => yeux = true, 550);
    }
}

function sortie_souris() {
    if (clique) setTimeout(() => yeux = true, 2500);
    else yeux = true;
}

function clique_souris() {
    clique = true;
    setTimeout(() => clique = false, 2000);
}

function boutonHitbox() {
    hitbox.style.opacity = (hitbox.style.opacity === '0') ? '1' : '0';
    toggleHitbox.style.color = (hitbox.style.opacity === '1') ? 'red' : 'white';
}

function boutonGlitchs() {
    glitchs.style.color = (glitchs.style.color === 'purple') ? 'white' : 'purple';
    if (glitchs.style.color === 'purple') lines.classList.remove("lines");
    if (glitchs.style.color === 'white') lines.classList.add("lines");
}

function deplacementYeux(event) {
    const yeuxRect = yeux1.getBoundingClientRect();
    const centerX = yeuxRect.left + yeuxRect.width / 2;
    const centerY = yeuxRect.top + yeuxRect.height / 2;

    const deltaX = event.clientX - centerX;
    const deltaY = event.clientY - centerY;
    const angle = Math.atan2(deltaY, deltaX);

    const moveX = Math.cos(angle) * vitesseYeux * 90;
    const moveY = Math.sin(angle) * vitesseYeux * 90;

    yeux1.style.transform = `translate(${moveX}px, ${moveY}px)`;
}

function recursive() {
    if (!clique) {
        if (!yeux) {
            changerImage(lienTete2, tete1, tete2);
        } else {
            changerImage(lienTete1, tete2, tete1);
        }
        if (yeux && clignementInterval === null) {
            clignementInterval = setInterval(clignement, 10000);
        } else if (!yeux && clignementInterval !== null) {
            clearInterval(clignementInterval);
            clignementInterval = null;
        }
    } else {
        changerImage(lienTete3, tete2, tete1);
    }

    if (effetActuel.nom === "Couleur") {
        let hueValue = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--hue')) || 0;
        document.documentElement.style.setProperty("--perso-hue", hueValue);
    }
    setTimeout(recursive, 100);
}

function appliquerEffet() {
    effetActuel = effets[indexEffet];
    effetsBtn.innerHTML = `<span class="effet-transition">${effetActuel.nom}</span>`;

    if (effetActuel.nom === "Effets") {
        effetsBtn.style.background = ""; 
        effetsBtn.style.borderColor = "var(--button-border)";
        imageContainer.style.filter = ""; 
        document.documentElement.style.setProperty("--perso-hue", "0");
        tete1.style.filter = "";
        tete2.style.filter = "";
        tete3.style.filter = "";
        yeux1.style.filter = "";
    } else if (effetActuel.nom === "Couleur") {
        let hueValue = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--hue')) || 0;
        document.documentElement.style.setProperty("--perso-hue", hueValue);
        imageContainer.style.filter = `hue-rotate(${hueValue}deg)`;
        tete1.style.filter = `hue-rotate(${hueValue}deg)`;
        tete2.style.filter = `hue-rotate(${hueValue}deg)`;
        tete3.style.filter = `hue-rotate(${hueValue}deg)`;
        yeux1.style.filter = `hue-rotate(${hueValue}deg)`;
    
        effetsBtn.style.backgroundImage = `linear-gradient(145deg,rgb(0, 183, 255), ${lightenColor("#ff3300", 30)})`;
        effetsBtn.style.borderColor = "#ff8800";
    } else {
        effetsBtn.style.backgroundImage = `linear-gradient(145deg, ${effetActuel.couleur}, ${lightenColor(effetActuel.couleur, 30)})`;
        effetsBtn.style.borderColor = effetActuel.couleur;
        imageContainer.style.cssText = effetActuel.style;
    }
}

themeBtn.addEventListener("click", function () {
    let currentHue = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--hue')) || 0;
    currentHue = (currentHue + 30) % 360;
    document.documentElement.style.setProperty('--hue', currentHue);

    if (effetActuel.nom === "Couleur") {
        document.documentElement.style.setProperty("--perso-hue", currentHue);
        imageContainer.style.filter = `hue-rotate(${currentHue}deg)`;
        tete1.style.filter = `hue-rotate(${currentHue}deg)`;
        tete2.style.filter = `hue-rotate(${currentHue}deg)`;
        tete3.style.filter = `hue-rotate(${currentHue}deg)`;
        yeux1.style.filter = `hue-rotate(${currentHue}deg)`;
    }
});

function lightenColor(hex, percent) {
    let num = parseInt(hex.replace("#", ""), 16),
        r = Math.min((num >> 16) + percent, 255),
        g = Math.min(((num >> 8) & 0x00FF) + percent, 255),
        b = Math.min((num & 0x0000FF) + percent, 255);
    return `rgb(${r}, ${g}, ${b})`;
}

hitbox.addEventListener('mouseover', () => yeux = false);
hitbox.addEventListener('mouseout', sortie_souris);
hitbox.addEventListener("click", clique_souris);
toggleHitbox.addEventListener('click', boutonHitbox);
glitchs.addEventListener('click', boutonGlitchs);
document.addEventListener('mousemove', deplacementYeux);

effetsBtn.addEventListener("click", () => {
    indexEffet = (indexEffet + 1) % effets.length;
    appliquerEffet();
});

tete2.style.opacity = 0;
tete3.style.opacity = 0;
hitbox.style.opacity = 0;
def_perso();
appliquerEffet();
recursive();
