document.addEventListener("DOMContentLoaded", () => {
    // Only handle remove/toggle logic
    document.addEventListener("click", async (e) => {
        const btn = e.target.closest(".favorite-btn");
        if (!btn) return;

        e.preventDefault();
        const excursionId = btn.dataset.excursionId;
        const cardCol = btn.closest(".col-lg-4");

        // Confirm removal for better UX? Or just do it. Let's just do it smoothly.
        if (!confirm("Voulez-vous retirer cette excursion de vos favoris ?"))
            return;

        try {
            const response = await fetch(`/favori/toggle/${excursionId}`, {
                method: "POST",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "Content-Type": "application/json",
                },
            });

            const data = await response.json();
            if (data.success) {
                // If it was removed (favori: false), remove the card
                if (!data.favori) {
                    // Animate removal
                    cardCol.style.transition = "all 0.5s ease";
                    cardCol.style.opacity = "0";
                    cardCol.style.transform = "scale(0.8)";
                    setTimeout(() => {
                        cardCol.remove();
                        // If no cards left, show empty state (optional reload or dom manipulation)
                        if (
                            document.querySelectorAll(".col-lg-4").length === 0
                        ) {
                            location.reload();
                        }
                    }, 500);
                }
            } else if (data.message) {
                alert(data.message);
            }
        } catch (err) {
            console.error(err);
            alert(
                "Une erreur est survenue lors de la mise à jour des favoris."
            );
        }
    });
});
