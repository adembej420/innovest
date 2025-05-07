// Sélection des éléments du DOM
const loginForm = document.getElementById('loginForm');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const emailError = document.getElementById('emailError');
const passwordError = document.getElementById('passwordError');

// Expressions régulières pour la validation
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;

// Fonction de validation en temps réel
const setupRealTimeValidation = () => {
  emailInput.addEventListener('input', validateEmail);
  passwordInput.addEventListener('input', validatePassword);
};

// Validation de l'email
const validateEmail = () => {
  const email = emailInput.value.trim();
  
  if (!email) {
    emailError.textContent = '';
    return false;
  }

  if (!emailRegex.test(email)) {
    emailError.textContent = 'Veuillez entrer une adresse email valide';
    return false;
  }

  emailError.textContent = '';
  return true;
};

// Validation du mot de passe
const validatePassword = () => {
  const password = passwordInput.value.trim();
  
  if (!password) {
    passwordError.textContent = '';
    return false;
  }

  if (password.length < 6) {
    passwordError.textContent = 'Le mot de passe doit contenir au moins 6 caractères';
    return false;
  }

  /* Optionnel : validation forte
  if (!passwordRegex.test(password)) {
    passwordError.textContent = 'Le mot de passe doit contenir une majuscule, une minuscule et un chiffre';
    return false;
  }
  */

  passwordError.textContent = '';
  return true;
};

// Soumission du formulaire
const handleSubmit = (e) => {
  e.preventDefault();
  
  const isEmailValid = validateEmail();
  const isPasswordValid = validatePassword();

  if (isEmailValid && isPasswordValid) {
    // Envoyer les données au serveur
    const formData = {
      email: emailInput.value.trim(),
      password: passwordInput.value.trim()
    };

    console.log('Données à envoyer:', formData);
    
    // Exemple avec fetch API
    fetch('votre-endpoint-api', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
      console.log('Réponse du serveur:', data);
      // Redirection ou traitement de la réponse
    })
    .catch(error => {
      console.error('Erreur:', error);
    });
  }
};

// Initialisation
const init = () => {
  if (loginForm) {
    setupRealTimeValidation();
    loginForm.addEventListener('submit', handleSubmit);
  }
};

// Démarrer l'application
document.addEventListener('DOMContentLoaded', init);