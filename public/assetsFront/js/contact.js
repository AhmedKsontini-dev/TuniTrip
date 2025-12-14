
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("contactForm");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        try {
            const response = await fetch(form.action, {
                method: "POST",
                body: formData,
                headers: { "X-Requested-With": "XMLHttpRequest" }
            });

            const data = await response.json();

            if (data.success) {
                showPopupMessage(data.message, "success");
                form.reset();
            } else {
                // 🔴 Message d’erreur général
                showPopupMessage(data.message, "error");

                // 🧾 Afficher les erreurs détaillées (si tu veux)
                if (data.errors) {
                    console.warn("Détails des erreurs :", data.errors);
                }
            }
        } catch (error) {
            showPopupMessage("❌ Une erreur est survenue. Veuillez réessayer.", "error");
            console.error("Erreur d’envoi :", error);
        }
    });

    function showPopupMessage(message, type = "success") {
        const msg = document.createElement("div");
        msg.className = `alert ${type === "success" ? "alert-success" : "alert-danger"} fw-semibold popup-message`;
        msg.innerHTML = message;

        document.querySelector(".contact_form_section").appendChild(msg);

        setTimeout(() => {
            msg.classList.add("fade-out");
            setTimeout(() => msg.remove(), 500);
        }, 5000);
    }
});
