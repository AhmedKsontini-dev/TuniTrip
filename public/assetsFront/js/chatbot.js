document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('chatbot-toggle-btn');
    const chatWindow = document.getElementById('chatbot-window');
    const chatBody = document.getElementById('chat-body');
    const closeBtn = document.getElementById('chat-close-btn');
    const toggleIcon = toggleBtn.querySelector('i');

    let isOpen = false;

    // Default to 'fr' if not set
    const locale = window.currentLocale || 'fr';

    // Hardcoded Knowledge Base with functional links
    const routes = window.chatbotRoutes || { cars: '#', excursions: '#', contact: '#', login: '#' };

    // Translations object
    const translations = {
        fr: {
            welcome: "Bonjour ! Bienvenue chez TuniTrip. Comment puis-je vous aider aujourd'hui ? 🌴",
            anythingElse: "Puis-je vous aider avec autre chose ?",
            knowledgeBase: [
                {
                    id: 1,
                    question: "🚗 Comment louer une voiture ?",
                    answer: `Pour louer une voiture, rendez-vous dans notre section dédiée. <br><br><a href="${routes.cars}" class="chat-link">Voir nos voitures</a>`
                },
                {
                    id: 2,
                    question: "✈️ Proposez-vous des transferts aéroport ?",
                    answer: `Oui ! Nous assurons des transferts. Vous pouvez réserver directement depuis la page d'accueil ou nous contacter. <br><br><a href="${routes.contact}" class="chat-link">Contactez-nous</a>`
                },
                {
                    id: 3,
                    question: "🌍 Quelles excursions proposez-vous ?",
                    answer: `Découvrez le désert, Sidi Bou Saïd et plus encore ! <br><br><a href="${routes.excursions}" class="chat-link">Voir les excursions</a>`
                },
                {
                    id: 4,
                    question: "💳 Quels sont les moyens de paiement ?",
                    answer: "Vous pouvez payer en ligne par carte bancaire ou en espèces à l'agence. Pour plus d'infos, contactez le support."
                },
                {
                    id: 5,
                    question: "📞 Comment contacter le support ?",
                    answer: `Notre équipe est dispo 24/7. <br><br><a href="${routes.contact}" class="chat-link">Page Contact</a>`
                }
            ]
        },
        en: {
            welcome: "Hello! Welcome to TuniTrip. How can I help you today? 🌴",
            anythingElse: "Can I help you with anything else?",
            knowledgeBase: [
                {
                    id: 1,
                    question: "🚗 How to rent a car?",
                    answer: `To rent a car, visit our dedicated section. <br><br><a href="${routes.cars}" class="chat-link">View our cars</a>`
                },
                {
                    id: 2,
                    question: "✈️ Do you offer airport transfers?",
                    answer: `Yes! We provide transfers. You can book directly from the home page or contact us. <br><br><a href="${routes.contact}" class="chat-link">Contact us</a>`
                },
                {
                    id: 3,
                    question: "🌍 What excursions do you offer?",
                    answer: `Discover the desert, Sidi Bou Said and more! <br><br><a href="${routes.excursions}" class="chat-link">View excursions</a>`
                },
                {
                    id: 4,
                    question: "💳 What are the payment methods?",
                    answer: "You can pay online by credit card or in cash at the agency. For more info, contact support."
                },
                {
                    id: 5,
                    question: "📞 How to contact support?",
                    answer: `Our team is available 24/7. <br><br><a href="${routes.contact}" class="chat-link">Contact Page</a>`
                }
            ]
        }
    };

    // Fallback to FR if language not found
    const currentLang = translations[locale] ? translations[locale] : translations['fr'];
    const knowledgeBase = currentLang.knowledgeBase;

    // Toggle Chat
    function toggleChat() {
        isOpen = !isOpen;
        if (isOpen) {
            chatWindow.style.display = 'flex';
            toggleIcon.classList.remove('fa-comments');
            toggleIcon.classList.add('fa-times');
            if (chatBody.children.length === 0) {
                initChat();
            }
        } else {
            chatWindow.style.display = 'none';
            toggleIcon.classList.remove('fa-times');
            toggleIcon.classList.add('fa-comments');
        }
    }

    toggleBtn.addEventListener('click', toggleChat);
    closeBtn.addEventListener('click', () => {
        isOpen = true; // will be flipped to false by toggleChat
        toggleChat();
    });

    // Initialize Chat
    function initChat() {
        addBotMessage(currentLang.welcome);
        showOptions();
    }

    // Add Message to Chat
    function addBotMessage(text) {
        const msgDiv = document.createElement('div');
        msgDiv.className = 'message bot-message';
        msgDiv.innerHTML = text;
        chatBody.appendChild(msgDiv);
        scrollToBottom();
    }

    function addUserMessage(text) {
        const msgDiv = document.createElement('div');
        msgDiv.className = 'message user-message';
        msgDiv.innerText = text;
        chatBody.appendChild(msgDiv);
        scrollToBottom();
    }

    // Show Questions
    function showOptions() {
        const optionsDiv = document.createElement('div');
        optionsDiv.className = 'chat-options';

        knowledgeBase.forEach(item => {
            const btn = document.createElement('button');
            btn.className = 'chat-option-btn';
            btn.innerText = item.question;
            btn.onclick = () => handleQuestionClick(item);
            optionsDiv.appendChild(btn);
        });

        const msgContainer = document.createElement('div');
        msgContainer.className = 'message bot-message';
        msgContainer.style.background = 'transparent';
        msgContainer.style.border = 'none';
        msgContainer.style.padding = '0';
        msgContainer.style.boxShadow = 'none';

        msgContainer.appendChild(optionsDiv);
        chatBody.appendChild(msgContainer);
        scrollToBottom();
    }

    // Handle Selection
    function handleQuestionClick(item) {
        addUserMessage(item.question);

        // Remove options (optional: or keep them for history)
        // Let's keep scrolling to keep history visible but maybe disable used buttons if we wanted deeply complex logic.
        // For simple chatbot, just append answer.

        setTimeout(() => {
            addBotMessage(item.answer);
            // Re-show options or "Anything else?" after a delay
            setTimeout(() => {
                addBotMessage(currentLang.anythingElse);
                showOptions();
            }, 1000);
        }, 500);
    }

    function scrollToBottom() {
        chatBody.scrollTop = chatBody.scrollHeight;
    }
});
