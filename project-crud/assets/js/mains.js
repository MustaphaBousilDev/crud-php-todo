// Get DOM Elements
const modal = document.querySelector('#my-modal');
const modalBtn = document.querySelector('#modal-btn');
const closeBtn = document.querySelector('.close');

// Events
//modalBtn.addEventListener('click', openModal);
closeBtn.addEventListener('click', closeModal);
window.addEventListener('click', outsideClick);

// Open


const darkTheme='active'
const selectedTheme=localStorage.getItem('selected-theme')
const getCurrentTheme=()=>modal.classList.contains(darkTheme) ? 'active' : 'h'
let d=getCurrentTheme();
console.log(d)
if(selectedTheme){
    //if the validation is fulfilled , we ask what the issue was to know if we activated or deactivated the dark
    modal.classList[selectedTheme==='active' ? 'add' : 'remove'](darkTheme)
}
modalBtn.addEventListener('click',()=>{
    //Add or remove the dark / icon theme
    modal.classList.toggle(darkTheme)
    modal.classList.add(d)
    //we save the theme and the current icon that the user chose
    localStorage.setItem('selected-theme',getCurrentTheme())
})

function openModal() {
  modal.classList.add('active')
}

// Close
function closeModal() {
  modal.classList.remove('active');
}

// Close If Outside Click
function outsideClick(e) {
  if (e.target == modal) {
    modal.style.display = 'none';
  }
}
