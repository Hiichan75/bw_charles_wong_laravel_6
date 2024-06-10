import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            let valid = true;
            form.querySelectorAll('input, textarea, select').forEach(input => {
                if (!input.checkValidity()) {
                    valid = false;
                }
            });
            if (!valid) {
                event.preventDefault();
                alert('Please fill out all fields correctly.');
            }
        });
    });
});
