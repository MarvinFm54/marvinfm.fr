const body = document.body;
const storedTheme = localStorage.getItem("theme") || "lapis";
body.className = storedTheme;

function theme_select(theme) 
{
    if (popupThemes.classList.contains("active")) 
    {
        body.className = theme;
        localStorage.setItem("theme", theme);
        AOS.refresh();
    }
}
