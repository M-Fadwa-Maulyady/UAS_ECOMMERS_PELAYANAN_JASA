// Smooth scroll effect for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetElement = document.querySelector(this.getAttribute('href'));
        if (targetElement) {
            targetElement.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Navbar shadow on scroll
window.addEventListener('scroll', () => {
    const nav = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        nav.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
    } else {
        nav.style.boxShadow = 'none';
    }
});
// ===================================
// === SMOOTH SLIDER KATEGORI (CATEGORY) ===
// ===================================

const categorySlider = document.querySelector('.category-slider');
let cards = Array.from(document.querySelectorAll('.category-card'));

if (!categorySlider || cards.length === 0) {
    console.warn("Category slider not ready — no cards found.");
} else {

    const leftBtn = document.querySelector('.slide-btn.left');
    const rightBtn = document.querySelector('.slide-btn.right');

    const cardWidth = 170;
    let visibleCards = Math.min(cards.length, 3);
    let currentIndex = visibleCards;

    let isTransitioning = false;

    // clone untuk infinite loop
    const firstClones = cards.slice(0, visibleCards).map(c => c.cloneNode(true));
    const lastClones = cards.slice(-visibleCards).map(c => c.cloneNode(true));

    firstClones.forEach(clone => categorySlider.appendChild(clone));
    lastClones.forEach(clone => categorySlider.prepend(clone));

    cards = Array.from(document.querySelectorAll('.category-card'));

    // posisi awal
    categorySlider.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
    categorySlider.style.transition = "transform 0.5s ease";

    function updateCategorySlide() {
        if (isTransitioning) return;
        isTransitioning = true;

        categorySlider.style.transition = "transform 0.5s ease";
        categorySlider.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
    }

    // reset loop
    categorySlider.addEventListener('transitionend', () => {
        isTransitioning = false;

        if (currentIndex >= cards.length - visibleCards) {
            currentIndex = visibleCards;
            categorySlider.style.transition = "none";
            categorySlider.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
        }

        if (currentIndex < visibleCards) {
            currentIndex = cards.length - visibleCards * 2;
            categorySlider.style.transition = "none";
            categorySlider.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
        }
    });

    // tombol next / prev
    rightBtn.addEventListener('click', () => {
        currentIndex++;
        updateCategorySlide();
    });

    leftBtn.addEventListener('click', () => {
        currentIndex--;
        updateCategorySlide();
    });

}


// --- NEXT & PREV HANDLERS ---
function nextCategorySlide() {
    if (isTransitioning) return;
    currentIndex++;
    updateCategorySlide();
}

function prevCategorySlide() {
    if (isTransitioning) return;
    currentIndex--;
    updateCategorySlide();
}

// Tombol panah
rightBtn.addEventListener('click', () => {
    nextCategorySlide();
    restartAutoSlide();
});

leftBtn.addEventListener('click', () => {
    prevCategorySlide();
    restartAutoSlide();
});

// --- AUTO SLIDE ---
function startAutoSlide() {
    autoSlide = setInterval(() => {
        nextCategorySlide();
    }, 3000);
}

function stopAutoSlide() {
    clearInterval(autoSlide);
}

function restartAutoSlide() {
    stopAutoSlide();
    startAutoSlide();
}

startAutoSlide();

// ===================================
// === SLIDER PENAWARAN KHUSUS (OFFER) - FIXED === 
// ===================================

// **FIXED: Ganti nama variabel dari 'slider' menjadi 'offerSlider'**
const offerSlider = document.querySelector('.offer-slider'); 
const offerContainer = document.querySelector('.offer-slider-container');
const dots = document.querySelectorAll('.offer-dots .dot');
let currentOfferSlide = 0;
const totalOfferSlides = dots.length; // 2 slide

function showOfferSlide(index) {
    if (!offerSlider || !offerContainer) return; 

    // Hitung lebar geser: diasumsikan lebar 1 slide = lebar container yang menampung 3 kartu
    const slideUnit = offerContainer.offsetWidth; 
    
    // Geser elemen offerSlider
    offerSlider.style.transform = `translateX(-${index * slideUnit}px)`;
    
    // Update dots
    dots.forEach(dot => dot.classList.remove('active'));
    dots[index].classList.add('active');
}

// Event Listener untuk Dots
dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
        currentOfferSlide = index;
        showOfferSlide(currentOfferSlide);
    });
});

// Auto slide setiap 5 detik
setInterval(() => {
    // Pindah ke slide berikutnya (0 ke 1, atau 1 kembali ke 0)
    currentOfferSlide = (currentOfferSlide + 1) % totalOfferSlides;
    showOfferSlide(currentOfferSlide);
}, 5000);

// Set posisi awal saat halaman dimuat
showOfferSlide(currentOfferSlide);

// ===================================
// === DROPDOWN NAVIGASI ===
// ===================================

const dropdownToggle = document.querySelector('.dropdown');

if (dropdownToggle) {
    dropdownToggle.addEventListener('click', (e) => {
        // Mencegah navigasi ke services-section saat dropdown diklik
        e.preventDefault(); 
        
        // Toggle class 'active' pada li.dropdown
        dropdownToggle.classList.toggle('active');
        
        // Menghentikan event click menyebar ke window (agar tidak langsung tertutup)
        e.stopPropagation();
    });
}

// Menutup dropdown ketika klik di luar area
window.addEventListener('click', () => {
    if (dropdownToggle && dropdownToggle.classList.contains('active')) {
        dropdownToggle.classList.remove('active');
    }
});