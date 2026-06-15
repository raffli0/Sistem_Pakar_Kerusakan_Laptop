document.addEventListener('DOMContentLoaded', () => {
    const search = document.querySelector('[data-symptom-search]');
    const counter = document.querySelector('[data-selected-counter]');
    const cards = [...document.querySelectorAll('[data-symptom-card]')];
    const selects = [...document.querySelectorAll('[data-cf-select]')];

    function updateCards() {
        let selected = 0;
        selects.forEach(select => {
            const card = select.closest('[data-symptom-card]');
            const value = parseFloat(select.value || '0');
            card.classList.toggle('is-selected', value > 0);
            if (value > 0) selected++;
        });
        if (counter) counter.textContent = `${selected} gejala dipilih`;
    }

    selects.forEach(select => select.addEventListener('change', updateCards));
    updateCards();

    if (search) {
        search.addEventListener('input', () => {
            const q = search.value.toLowerCase();
            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(q) ? '' : 'none';
            });
        });
    }

    document.querySelectorAll('[data-confirm]').forEach(form => {
        form.addEventListener('submit', (e) => {
            const message = form.getAttribute('data-confirm') || 'Yakin ingin melanjutkan?';
            if (!confirm(message)) e.preventDefault();
        });
    });
});
