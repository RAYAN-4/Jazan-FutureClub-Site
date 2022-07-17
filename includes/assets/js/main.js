
// SIDEBAR FUNCTIONALITY 
const sidebarMobileBtn = document.querySelector('#sidebar__mobile');
const sidebarMobile = document.querySelector('.main--sidebar__div');
 
sidebarMobileBtn.addEventListener('click' , () => {
    sidebarMobile.classList.toggle('active')
} )


// MENU NAVBNAR FUNCITONSALITY
const sideNavBtn = document.querySelector('#toggle_dropdown_navbar');
const closeSideNavBtn = document.querySelector('#close_sidebar');
const navArea = document.querySelector('#nav_area_dropdown');
 if (sideNavBtn !== null) {
    sideNavBtn.addEventListener('click' , () => {
   
        navArea.classList.toggle('active')
    })
 }


closeSideNavBtn.addEventListener('click' , () => {
   
    sidebarMobile.classList.toggle('active')
})