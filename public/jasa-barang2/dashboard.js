/* ==========================
   Smooth Scroll Navigation
========================== */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});

/* ==========================
   Navbar Shadow On Scroll
========================== */
window.addEventListener('scroll', () => {
    document.querySelector('.navbar').style.boxShadow =
        window.scrollY > 50 ? '0 2px 10px rgba(0,0,0,0.1)' : 'none';
});

/* ==========================
   CATEGORY SLIDER FIXED
========================== */

const categorySlider = document.querySelector('.category-slider');
const leftBtn = document.querySelector('.slide-btn.left');
const rightBtn = document.querySelector('.slide-btn.right');

let categoryCards = Array.from(document.querySelectorAll('.category-card'));

if (categorySlider && categoryCards.length > 0) {

    if (categoryCards.length === 1) {

        // Hide arrows if only 1 category
        leftBtn.style.display = "none";
        rightBtn.style.display = "none";
        console.warn("Kategori cuma 1 → slider disabled.");

    } else {

        // Prevent multiple cloning
        if (!categorySlider.dataset.cloned) {
            categorySlider.innerHTML += categorySlider.innerHTML; 
            categorySlider.dataset.cloned = "true";
            categoryCards = Array.from(document.querySelectorAll('.category-card'));
        }

        const cardWidth = 180;
        let index = categoryCards.length / 2;
        let sliding = false;

        categorySlider.style.transform = `translateX(-${index * cardWidth}px)`;
        categorySlider.style.transition = "transform .5s ease";

        function moveSlider(step) {
            if (sliding) return;
            sliding = true;

            index += step;
            categorySlider.style.transform = `translateX(-${index * cardWidth}px)`;
        }

        categorySlider.addEventListener("transitionend", () => {
            sliding = false;

            if (index >= categoryCards.length - 2) {
                index = categoryCards.length / 2;
                categorySlider.style.transition = "none";
                categorySlider.style.transform = `translateX(-${index * cardWidth}px)`;
                setTimeout(() => categorySlider.style.transition = "transform .5s ease");
            }

            if (index < 2) {
                index = categoryCards.length / 2 - 2;
                categorySlider.style.transition = "none";
                categorySlider.style.transform = `translateX(-${index * cardWidth}px)`;
                setTimeout(() => categorySlider.style.transition = "transform .5s ease");
            }
        });

        rightBtn.addEventListener('click', () => {
            moveSlider(1);
            restartAutoSlide();
        });

        leftBtn.addEventListener('click', () => {
            moveSlider(-1);
            restartAutoSlide();
        });

        let autoSlide = setInterval(() => moveSlider(1), 3000);

        function restartAutoSlide() {
            clearInterval(autoSlide);
            autoSlide = setInterval(() => moveSlider(1), 3000);
        }

    }
}

/* ==========================
   OFFER SLIDER FIXED
========================== */

const offerSlider = document.querySelector('.offer-slider');
const offerContainer = document.querySelector('.offer-slider-container');
const dots = document.querySelectorAll('.offer-dots .dot');

let currentOfferSlide = 0;

function showOffer(index) {
    if (!offerSlider) return;
    
    const width = offerContainer.offsetWidth;
    offerSlider.style.transform = `translateX(-${index * width}px)`;

    dots.forEach(dot => dot.classList.remove('active'));
    dots[index].classList.add('active');
}

dots.forEach((dot, i) => {
    dot.addEventListener('click', () => {
        currentOfferSlide = i;
        showOffer(i);
    });
});

// Auto slide
setInterval(() => {
    currentOfferSlide = (currentOfferSlide + 1) % dots.length;
    showOffer(currentOfferSlide);
}, 5000);

showOffer(currentOfferSlide);

/* ==========================
   DROPDOWN FIX
========================== */

const dropdown = document.querySelector('.dropdown');

if (dropdown) {
    dropdown.addEventListener('click', (e) => {
        e.preventDefault();
        dropdown.classList.toggle('active');
        e.stopPropagation();
    });

    window.addEventListener('click', () => dropdown.classList.remove('active'));
}
