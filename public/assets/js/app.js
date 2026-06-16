/* ============================================
   SCROLL REVEAL — IntersectionObserver
   ============================================ */
(function () {
    const THRESHOLD = 0.15; // 15% of element must be visible to trigger

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                // Once revealed, stop observing — no need to re-trigger
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: THRESHOLD });

    // Observe all elements carrying a data-animate attribute
    function initScrollReveal() {
        document.querySelectorAll('[data-animate]').forEach(el => {
            observer.observe(el);
        });
    }

    // Also observe stat-cards, metric items, progress bars, and cards
    // that get .is-visible for their CSS animation hooks
    function initPassiveAnimations() {
        const passiveObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    passiveObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });

        document.querySelectorAll('.stat-card, .metric, .progress, .card').forEach(el => {
            passiveObserver.observe(el);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            initScrollReveal();
            initPassiveAnimations();
        });
    } else {
        initScrollReveal();
        initPassiveAnimations();
    }
})();

document.addEventListener('DOMContentLoaded', () => {
    const search = document.querySelector('[data-symptom-search]');
    const counter = document.querySelector('[data-selected-counter]');
    const cards = [...document.querySelectorAll('[data-symptom-card]')];
    const ranges = [...document.querySelectorAll('[data-cf-range]')];
    const form = document.querySelector('form.form-card');

    const cfLabels = {
        '0': 'Tidak dialami',
        '0.0': 'Tidak dialami',
        '0.2': 'Tidak tahu / Ragu',
        '0.4': 'Sedikit yakin',
        '0.6': 'Cukup yakin',
        '0.8': 'Yakin',
        '1.0': 'Sangat yakin',
        '1': 'Sangat yakin'
    };

    function updateCards() {
        let selectedCount = 0;
        
        ranges.forEach(range => {
            const card = range.closest('[data-symptom-card]');
            if (!card) return;
            
            const value = parseFloat(range.value || '0');
            const badge = card.querySelector('[data-cf-badge]');
            
            // Set dynamic text label for certainty level
            const valKey = value.toFixed(1);
            if (badge) {
                badge.textContent = cfLabels[valKey] || cfLabels[value.toString()] || 'Tidak dialami';
            }
            
            // Toggle primary selection state
            card.classList.toggle('is-selected', value > 0);
            
            // Clean up old certainty state classes
            card.classList.remove('is-selected-low', 'is-selected-medium', 'is-selected-high');
            
            // Apply gradient fill effect to the range input track
            const percent = value * 100;
            range.style.background = `linear-gradient(to right, var(--primary-2) ${percent}%, #e2e8f0 ${percent}%)`;
            
            if (value > 0) {
                selectedCount++;
                if (value <= 0.2) {
                    card.classList.add('is-selected-low');
                } else if (value <= 0.6) {
                    card.classList.add('is-selected-medium');
                } else {
                    card.classList.add('is-selected-high');
                }
            }
        });
        
        if (counter) {
            counter.textContent = `${selectedCount} gejala dipilih`;
        }
    }

    // Bind change/input events for the sliders
    ranges.forEach(range => {
        range.addEventListener('input', updateCards);
        range.addEventListener('change', updateCards);
    });
    
    // Initial run to capture default values
    updateCards();

    // Enable clicking the card body to toggle values (0.0 <-> 1.0)
    cards.forEach(card => {
        card.addEventListener('click', (e) => {
            // Prevent toggling if user clicks directly on the slider range thumb/input
            if (e.target.closest('[data-cf-range]')) return;
            
            const range = card.querySelector('[data-cf-range]');
            if (!range) return;
            
            const currentValue = parseFloat(range.value || '0');
            if (currentValue === 0) {
                range.value = "1.0"; // Toggle to full certainty
            } else {
                range.value = "0.0"; // Reset selection
            }
            
            // Dispatch input and change events to update visual status
            range.dispatchEvent(new Event('input'));
            range.dispatchEvent(new Event('change'));
        });
    });

    // Reset handler for the form to reset all sliders and counters
    if (form) {
        form.addEventListener('reset', () => {
            // Wait a tiny tick for form reset values to apply to inputs
            setTimeout(() => {
                updateCards();
            }, 50);
        });
    }

    // Handle search filter and category headings hiding
    if (search) {
        search.addEventListener('input', () => {
            const q = search.value.toLowerCase();
            const categories = document.querySelectorAll('.symptom-category');
            
            categories.forEach(cat => {
                const catCards = [...cat.querySelectorAll('[data-symptom-card]')];
                let visibleCount = 0;
                
                catCards.forEach(card => {
                    const text = card.textContent.toLowerCase();
                    const isMatch = text.includes(q);
                    card.style.display = isMatch ? '' : 'none';
                    if (isMatch) visibleCount++;
                });
                
                cat.style.display = visibleCount > 0 ? '' : 'none';
            });
        });
    }

    // Smooth scroll for category quick nav
    document.querySelectorAll('.category-nav-link').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href');
            const targetEl = document.querySelector(targetId);
            if (targetEl) {
                // Account for sticky navbar (approx 75px) + sticky category nav (approx 65px) + extra margin
                const offset = 160; 
                const bodyRect = document.body.getBoundingClientRect().top;
                const elementRect = targetEl.getBoundingClientRect().top;
                const elementPosition = elementRect - bodyRect;
                const offsetPosition = elementPosition - offset;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Confirmation dialog helper
    document.querySelectorAll('[data-confirm]').forEach(formEl => {
        formEl.addEventListener('submit', (e) => {
            const message = formEl.getAttribute('data-confirm') || 'Yakin ingin melanjutkan?';
            if (!confirm(message)) e.preventDefault();
        });
    });
});
