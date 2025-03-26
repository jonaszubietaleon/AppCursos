document.addEventListener('DOMContentLoaded', function() {
    // Efecto de carga en el botón de login
    const loginForm = document.querySelector('form');
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            const btn = this.querySelector('.btn-login');
            if (btn) {
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Cargando...';
                btn.disabled = true;
            }
        });
    }
    
    // Recordar usuario con localStorage
    const rememberCheckbox = document.getElementById('remember');
    const usernameInput = document.getElementById('username');
    
    if (rememberCheckbox && usernameInput) {
        // Cargar datos guardados
        if (localStorage.getItem('rememberLogin') === 'true') {
            rememberCheckbox.checked = true;
            const savedUsername = localStorage.getItem('username');
            if (savedUsername) {
                usernameInput.value = savedUsername;
            }
        }
        
        // Guardar datos al cambiar
        rememberCheckbox.addEventListener('change', function() {
            localStorage.setItem('rememberLogin', this.checked);
            if (this.checked && usernameInput.value) {
                localStorage.setItem('username', usernameInput.value);
            } else {
                localStorage.removeItem('username');
            }
        });
    }
});