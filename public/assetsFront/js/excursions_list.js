document.addEventListener('DOMContentLoaded', () => {
    // Slider Logic
    const slider = document.getElementById("prixSlider");
    const output = document.getElementById("prixValue");
    
    if(slider && output) {
        slider.oninput = function () {
            output.textContent = this.value;
        }
    }

    // Favorites Logic
    // We assume document.body.dataset.userLoggedIn is set in the template
    const isLoggedIn = document.body.dataset.userLoggedIn === 'true';

    // Utilisation de delegation pour tous les boutons favorites (y compris chargés dynamiquement)
    document.addEventListener('click', async (e) => {
        const btn = e.target.closest('.favorite-btn');

        if (!btn) return; // Si ce n'est pas un bouton favorite, ignorer

        const excursionId = btn.dataset.excursionId;
        const icon = btn.querySelector('i');

        // Si non connecté → ouvrir le modal login
        if (!isLoggedIn) {
            e.preventDefault();
            e.stopPropagation();
            $('#loginModal').modal('show');
            return false;
        }

        // Si connecté → exécuter la requête AJAX pour toggler le favoris
        try {
            const response = await fetch(`/favori/toggle/${excursionId}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                }
            });

            const data = await response.json();

            if (data.success) {
                if (data.favori) {
                    icon.classList.remove('far');
                    icon.classList.add('fas', 'text-warning');
                } else {
                    icon.classList.remove('fas', 'text-warning');
                    icon.classList.add('far');
                }
            } else if (data.message) {
                alert(data.message);
            }
        } catch (err) {
            console.error(err);
            alert("Une erreur est survenue.");
        }
    });
});
