document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("contactForm");
    const flashContainer = document.getElementById("contactFlashContainer");

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
                showFlash(data.message, "success");
                form.reset();
            } else {
                showFlash(data.message, "error");
            }
        } catch (error) {
            showFlash("❌ Une erreur est survenue. Veuillez réessayer.", "error");
            console.error(error);
        }
    });

    function showFlash(message, type) {
        // Supprimer ancien message
        flashContainer.innerHTML = "";

        const flash = document.createElement("div");
        flash.className = `popup-message ${type === "success" ? "alert-success" : "alert-danger"}`;
        flash.textContent = message;

        flashContainer.appendChild(flash);

        // ⏱️ disparaît après 3 secondes
        setTimeout(() => {
            flash.classList.add("fade-out");

            // suppression après l’animation
            setTimeout(() => {
                flash.remove();
            }, 500);

        }, 3000);
    }

});
