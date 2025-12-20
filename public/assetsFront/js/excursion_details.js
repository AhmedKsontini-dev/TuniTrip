// ===============================
// EXCURSION DETAILS - CLEAN VERSION
// ===============================

(() => {
    "use strict";

    // -------------------------------
    // Helpers
    // -------------------------------
    const qs = (s, p = document) => p.querySelector(s);
    const qsa = (s, p = document) => [...p.querySelectorAll(s)];

    // -------------------------------
    // Leaflet Map
    // -------------------------------
    function initMap() {
        const mapEl = qs('#map');
        if (!mapEl || typeof L === 'undefined') return;

        const map = L.map('map').setView([34, 9], 7);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);

        const markers = [];

        qsa('.etape-box').forEach((box, index) => {
            const { lat, lng } = box.dataset;
            if (!lat || !lng) return;

            const icon = L.divIcon({
                className: 'step-marker',
                html: `<span>${index + 1}</span>`,
                iconSize: [28, 28],
                iconAnchor: [14, 28]
            });

            const marker = L.marker([lat, lng], { icon }).addTo(map);
            markers.push(marker);

            box.addEventListener('click', () => map.setView([lat, lng], 12));
        });

        if (markers.length) {
            const group = new L.featureGroup(markers);
            map.fitBounds(group.getBounds(), { padding: [40, 40] });
        }

        window.recenterMap = () => {
            if (!markers.length) return;
            const group = new L.featureGroup(markers);
            map.fitBounds(group.getBounds(), { padding: [50, 50] });
        };

    }

    // -------------------------------
    // Travelers Counter
    // -------------------------------
    function initTravelers() {
        function updateText() {
            const types = ['adult', 'young', 'child', 'baby'];
            let total = 0;
            types.forEach(t => total += +qs(`#${t}-count`).textContent);
            const badge = qs('#traveler-total-badge');
            if (badge) badge.textContent = total;
        }

        window.updateTravelerCount = (type, delta) => {
            const el = qs(`#${type}-count`);
            let val = Math.max(0, +el.textContent + delta);
            if (type === 'adult') val = Math.max(1, val);
            el.textContent = val;
            updateText();
        };
    }

    // -------------------------------
    // Gallery Modal
    // -------------------------------
    function initGallery() {
        const images = qsa('.zoomable-image');
        if (!images.length) return;

        let index = 0;
        const modalEl = qs('#imageModal');
        const modalImg = qs('#modalImage');
        const modal = new bootstrap.Modal(modalEl);

        const show = () => modalImg.src = images[index].src;

        images.forEach(img => img.addEventListener('click', () => {
            index = +img.dataset.index;
            show();
            modal.show();
        }));

        qs('#prevImage')?.addEventListener('click', () => {
            index = (index - 1 + images.length) % images.length;
            show();
        });

        qs('#nextImage')?.addEventListener('click', () => {
            index = (index + 1) % images.length;
            show();
        });
    }

    // -------------------------------
    // FAQ Accordion
    // -------------------------------
    function initFAQ() {
        qsa('.faq-question').forEach(btn => {
            btn.addEventListener('click', () => {
                const item = btn.parentElement;
                item.classList.toggle('active');
            });
        });
    }

    // -------------------------------
    // Favorites
    // -------------------------------
    function initFavorites() {
        document.addEventListener('click', async e => {
            const btn = e.target.closest('.favorite-btn');
            if (!btn) return;

            if (!window.APP?.isLoggedIn) {
                new bootstrap.Modal(qs('#loginModal')).show();
                return;
            }

            const icon = btn.querySelector('i');
            const res = await fetch(`/favori/toggle/${btn.dataset.excursionId}`, { method: 'POST' });
            const data = await res.json();

            icon.classList.toggle('fas', data.favori);
            icon.classList.toggle('far', !data.favori);
        });
    }

    // -------------------------------
    // Init All
    // -------------------------------
    document.addEventListener('DOMContentLoaded', () => {
        initMap();
        initTravelers();
        initGallery();
        initFAQ();
        initFavorites();
        initAvisModal();
        initReservationConfirmation();
    });

})();


function initAvisModal() {
    const btn = document.getElementById('btnAvis');
    const modalEl = document.getElementById('modalAvis');

    if (!btn || !modalEl) return;

    const modal = new bootstrap.Modal(modalEl);

    btn.addEventListener('click', () => {
        if (window.APP?.isLoggedIn) {
            modal.show();
        } else {
            window.location.href = window.APP.loginUrl;
        }
    });
}

function initReservationConfirmation() {
    if (!window.APP?.showReservationConfirmation) return;

    const modalEl = document.getElementById('reservationConfirmation');
    if (!modalEl) return;

    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

document.querySelectorAll(".exc-nav-link").forEach(link => {
    link.addEventListener("click", (e) => {
        e.preventDefault(); // باش مانعملش default jump

        const targetSelector = link.getAttribute("data-target");
        const target = document.querySelector(targetSelector);
        if (!target) return;

        // نجيب موقع top و نخصم 100px باش ما يكونش header يغطّي
        const offset = target.getBoundingClientRect().top + window.scrollY - 100;

        window.scrollTo({
            top: offset,
            behavior: "smooth"
        });

        // تفعيل الـ active class
        document.querySelectorAll(".exc-nav-link").forEach(l => l.classList.remove("active"));
        link.classList.add("active");
    });
});


// إضافة تأثير hover على كل étape
document.querySelectorAll('.etape-box').forEach(box => {
    box.addEventListener('mouseenter', function () {
        this.style.backgroundColor = '#f8f9fa';
        this.style.borderRadius = '8px';
        this.style.marginLeft = '-10px';
        this.style.paddingLeft = '100px';
        this.style.transition = 'all 0.2s ease';
    });

    box.addEventListener('mouseleave', function () {
        this.style.backgroundColor = 'transparent';
        this.style.marginLeft = '0';
        this.style.paddingLeft = '90px';
    });
});


document.querySelectorAll('.itinerary-step-trip').forEach(step => {
    const showLink = step.querySelector('.toggle-details:not(.mt-2)');
    const hideLink = step.querySelector('.toggle-details.mt-2');
    const detailsDiv = step.querySelector('.details-content');

    if(!showLink || !hideLink || !detailsDiv) return;

    showLink.addEventListener('click', e => {
        e.preventDefault();
        detailsDiv.style.display = "block";
        showLink.style.display = "none";
        hideLink.style.display = "inline-block";
    });

    hideLink.addEventListener('click', e => {
        e.preventDefault();
        detailsDiv.style.display = "none";
        hideLink.style.display = "none";
        showLink.style.display = "inline-block";
    });
});
