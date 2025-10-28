// Menu mobile
const hamburger = document.querySelector('.hamburger');
const navMenu = document.querySelector('.nav-menu');

if (hamburger && navMenu) {
    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('active');
        navMenu.classList.toggle('active');
    });

    // Fermer le menu mobile quand on clique sur un lien
    document.querySelectorAll('.nav-link').forEach(n => n.addEventListener('click', () => {
        hamburger.classList.remove('active');
        navMenu.classList.remove('active');
    }));
}

// Scroll fluide pour les liens d'ancrage
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Animation au scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observer les cartes de service
const serviceCards = document.querySelectorAll('.service-card');
if (serviceCards.length > 0) {
    serviceCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
}

// Gestion du formulaire de contact
const contactForm = document.querySelector('.contact-form');
if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Récupérer les données du formulaire
        const name = this.querySelector('input[type="text"]').value;
        const email = this.querySelector('input[type="email"]').value;
        const message = this.querySelector('textarea').value;
        
        // Validation simple
        if (name && email && message) {
            // Simuler l'envoi
            alert('Merci pour votre message ! Nous vous répondrons bientôt.');
            this.reset();
        } else {
            alert('Veuillez remplir tous les champs.');
        }
    });
}

// Gestion du pop-up utilisateur
const userModal = document.getElementById('userModal');
const modalForm = document.getElementById('userModalForm');
const modalCloseButton = document.querySelector('.modal-close');
const modalCancelButton = document.getElementById('modalCancel');

const showUserModal = () => {
    if (!userModal) return;

    // Pré-remplir le formulaire si des données sont stockées en sessionStorage
    const storedData = sessionStorage.getItem('userModalData');
    if (storedData) {
        try {
            const { prenom, nom, email, notes } = JSON.parse(storedData);
            if (modalForm) {
                modalForm.prenom.value = prenom || '';
                modalForm.nom.value = nom || '';
                modalForm.email.value = email || '';
                modalForm.notes.value = notes || '';
            }
        } catch (error) {
            console.error('Erreur lors du chargement des données du pop-up :', error);
        }
    } else if (modalForm) {
        modalForm.reset();
    }

    userModal.classList.add('show');
};

const hideUserModal = () => {
    if (!userModal) return;
    userModal.classList.remove('show');
};

if (userModal) {
    showUserModal();
}

document.addEventListener('DOMContentLoaded', () => {
    if (userModal) {
        showUserModal();
    }
});

if (modalCloseButton) {
    modalCloseButton.addEventListener('click', hideUserModal);
}

if (modalCancelButton) {
    modalCancelButton.addEventListener('click', hideUserModal);
}

if (modalForm) {
    modalForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const formData = new FormData(modalForm);
        const dataToStore = {
            prenom: formData.get('prenom'),
            nom: formData.get('nom'),
            email: formData.get('email'),
            notes: formData.get('notes')
        };
        sessionStorage.setItem('userModalData', JSON.stringify(dataToStore));
        hideUserModal();
    });
}

// Effet de parallaxe léger sur le hero
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector('.hero');
    if (hero) {
        hero.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});

// Animation du bouton CTA
const ctaButton = document.querySelector('.cta-button');
if (ctaButton) {
    ctaButton.addEventListener('click', () => {
        const servicesSection = document.querySelector('#services');
        if (servicesSection) {
            servicesSection.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
}

// Changement de style du header au scroll
window.addEventListener('scroll', () => {
    const header = document.querySelector('.header');
    if (!header) return;

    if (window.scrollY > 100) {
        header.style.background = 'rgba(255, 255, 255, 0.98)';
        header.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.15)';
    } else {
        header.style.background = 'rgba(255, 255, 255, 0.95)';
        header.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
    }
});