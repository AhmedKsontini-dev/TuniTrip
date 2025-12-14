document.addEventListener('DOMContentLoaded', () => {
    // Intersection Observer pour animation au scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                // Délai progressif pour chaque carte
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, index * 150);
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observer toutes les cartes
    document.querySelectorAll('.car-card').forEach(card => {
        observer.observe(card);
    });
});
