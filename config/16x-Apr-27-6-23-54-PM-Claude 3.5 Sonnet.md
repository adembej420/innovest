User:
You are tasked to implement a feature. Instructions are as follows:

when i click view profile this pops out 
Not Found
The requested URL was not found on this server.

Apache/2.4.58 (Win64) OpenSSL/3.1.3 PHP/8.2.12 Server at localhost Port 443 


and when i click profile this pops out 

Warning: include(C:\xampp\htdocs\gestion_userv2\gestion_user\view\front-office/../layout.php): Failed to open stream: No such file or directory in C:\xampp\htdocs\gestion_userv2\gestion_user\view\front-office\profile.php on line 32

Warning: include(): Failed opening 'C:\xampp\htdocs\gestion_userv2\gestion_user\view\front-office/../layout.php' for inclusion (include_path='C:\xampp\php\PEAR') in C:\xampp\htdocs\gestion_userv2\gestion_user\view\front-office\profile.php on line 32

Instructions for the output format:
- Output code without descriptions, unless it is important.
- Minimize prose, comments and empty lines.
- Only show the relevant code that needs to be modified. Use comments to represent the parts that are not modified.
- Make it easy to copy and paste.
- Consider other possibilities to achieve the result, do not be limited by the prompt.

assets\css\add_user.css
```css
body {
    font-family: "Poppins", sans-serif;
    background-color: #f6f9ff;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 40px auto;
    background: #fff;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(65, 84, 241, 0.15);
}

h2 {
    color: #012970;
    text-align: center;
    margin-bottom: 1.5rem;
}

label {
    font-weight: bold;
    color: #444;
}

input, select {
    width: 100%;
    padding: 0.8rem;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 8px;
}

button {
    padding: 1rem 2rem;
    background-color: #4154f1;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

button:hover {
    background-color: #2937cc;
}

a {
    color: #6c757d;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

.success-message, .error-message {
    text-align: center;
    padding: 1rem;
    margin-bottom: 1.5rem;
    border-radius: 8px;
}

.success-message {
    background-color: #eafaf1;
    color: #2ecc71;
}

.error-message {
    background-color: #fdecea;
    color: #e74c3c;
}
```

assets\css\admindashboard.css
```css
body {
    font-family: 'Inter', sans-serif;
    margin: 0;
    background: #f5f7fa;
    color: #333;
  }
  
  .navbar {
    background-color: #2c3e50;
    padding: 1rem;
  }
  
  .navbar-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #fff;
  }
  
  .nav-links {
    list-style: none;
    display: flex;
    gap: 1rem;
  }
  
  .nav-links a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
  }
  
  .logout-btn {
    background: #e74c3c;
    padding: 0.4rem 1rem;
    border-radius: 4px;
    font-weight: 600;
  }
  
  .container {
    padding: 2rem;
  }
  
  .header h1 {
    font-size: 1.8rem;
    margin-bottom: 1rem;
  }
  
  .role-tag {
    font-size: 0.9rem;
    color: #888;
  }
  
  .stats {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
  }
  
  .stat-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    padding: 1.5rem;
    flex: 1;
    text-align: center;
  }
  
  .stat-card h3 {
    margin-bottom: 0.5rem;
  }
  
  .card {
    background: white;
    border-radius: 10px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
  }
  
  th, td {
    padding: 0.75rem;
    border-bottom: 1px solid #eee;
    text-align: left;
  }
  
  th {
    background-color: #f0f0f0;
  }
  
  .btn {
    display: inline-block;
    margin-right: 1rem;
    margin-top: 1rem;
    padding: 0.5rem 1rem;
    background: #3498db;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-weight: 600;
  }
  
  .btn:hover {
    background: #2980b9;
  }
  
```

assets\css\auth.css
```css
body {
    font-family: "Poppins", sans-serif;
    background-color: #f6f9ff;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.auth-container {
    background: #fff;
    padding: 2.5rem;
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(65, 84, 241, 0.15);
    width: 100%;
    max-width: 460px;
}

h2 {
    color: #012970;
    text-align: center;
    margin-bottom: 2rem;
    font-weight: 600;
    font-size: 1.8rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

label {
    display: block;
    margin-bottom: 0.5rem;
    color: #012970;
    font-weight: 500;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #d6d6d6;
    border-radius: 8px;
    font-size: 1rem;
    background-color: #f8f9fa;
    transition: border-color 0.3s, box-shadow 0.3s;
}

input:focus {
    border-color: #4154f1;
    outline: none;
    box-shadow: 0 0 5px rgba(65, 84, 241, 0.2);
}

.message {
    padding: 0.75rem;
    border-radius: 6px;
    margin-bottom: 1.5rem;
    text-align: center;
}

.error-message {
    color: #e74c3c;
    background-color: #fdecea;
}

.success-message {
    color: #27ae60;
    background-color: #e8f5e9;
}

button[type="submit"] {
    width: 100%;
    padding: 0.75rem;
    background-color: #4154f1;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 0.5rem;
}

button[type="submit"]:hover {
    background-color: #2937cc;
}

.auth-link {
    text-align: center;
    margin-top: 1.5rem;
    font-size: 0.95rem;
    color: #6c757d;
}

.auth-link a {
    color: #4154f1;
    text-decoration: none;
    font-weight: 500;
}

.auth-link a:hover {
    text-decoration: underline;
}

.required-field::after {
    content: " *";
    color: #e74c3c;
}
```

assets\css\login.css
```css
/* Google Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: "Poppins", sans-serif;
    background: linear-gradient(to right, #e0ecff, #f6f9ff);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Container */
.login-container {
    background: #fff;
    padding: 3rem 2.5rem;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(65, 84, 241, 0.1);
    width: 100%;
    max-width: 420px;
    transition: transform 0.3s ease;
    animation: fadeIn 0.6s ease-out;
}

.login-container:hover {
    transform: translateY(-4px);
}

/* Title */
h2 {
    color: #012970;
    text-align: center;
    margin-bottom: 2rem;
    font-weight: 600;
    font-size: 1.8rem;
}

/* Form Group */
.form-group {
    margin-bottom: 1.5rem;
}

label {
    display: block;
    margin-bottom: 0.5rem;
    color: #012970;
    font-weight: 500;
}

/* Inputs */
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 0.8rem;
    border: 1px solid #dcdcdc;
    border-radius: 10px;
    font-size: 1rem;
    background-color: #fff;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
    transition: border-color 0.3s, box-shadow 0.3s;
}

input:focus {
    border-color: #4154f1;
    outline: none;
    box-shadow: 0 0 6px rgba(65, 84, 241, 0.2);
}

/* Error Message */
.error-message {
    color: #e74c3c;
    background-color: #fdecea;
    padding: 0.75rem;
    border-radius: 6px;
    margin-bottom: 1.5rem;
    text-align: center;
    font-size: 0.95rem;
}

/* Button */
button[type="submit"] {
    width: 100%;
    padding: 0.8rem;
    background: linear-gradient(to right, #4154f1, #596aff);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 1.05rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s ease;
}

button[type="submit"]:hover {
    background: linear-gradient(to right, #2e3dc1, #4a5bed);
}

/* Register Link */
.register-link {
    text-align: center;
    margin-top: 1.5rem;
    font-size: 0.95rem;
    color: #6c757d;
}

.register-link a {
    color: #4154f1;
    text-decoration: none;
    font-weight: 500;
}

.register-link a:hover {
    text-decoration: underline;
}

/* Fade-in animation */
@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Login Page Styles */
.section {
    padding: 100px 0;
    background: #f8f9fa;
    min-height: 100vh;
    display: flex;
    align-items: center;
}

.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.card-body {
    border-radius: 10px;
    padding: 2rem;
}

.input-group-text {
    background-color: #f8f9fa;
    border-right: none;
    color: #6c757d;
}

.form-control {
    border-left: none;
    padding: 0.75rem 1rem;
}

.form-control:focus {
    box-shadow: none;
    border-color: #ced4da;
}

.btn-primary {
    padding: 0.75rem 1.5rem;
    border-radius: 5px;
    font-weight: 500;
}

.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

a {
    color: #0d6efd;
    text-decoration: none;
    transition: color 0.2s ease;
}

a:hover {
    color: #0a58ca;
}

.card-title {
    font-size: 1.75rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.text-muted {
    font-size: 0.9rem;
}

.input-group {
    margin-bottom: 1rem;
}

.form-label {
    font-weight: 500;
    margin-bottom: 0.5rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .section {
        padding: 50px 0;
    }
    
    .card-body {
        padding: 1.5rem;
    }
}

/* Responsive Design */
@media (max-width: 480px) {
    .login-container {
        padding: 2rem 1.5rem;
        margin: 1rem;
    }
    
    h2 {
        font-size: 1.5rem;
    }
    
    input[type="email"],
    input[type="password"] {
        padding: 0.7rem;
    }
    
    button[type="submit"] {
        padding: 0.7rem;
    }
}
```

assets\css\main.css
```css
/**
* Template Name: FlexStart
* Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
* Updated: Nov 01 2024 with Bootstrap v5.3.3
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

/*--------------------------------------------------------------
# Font & Color Variables
# Help: https://bootstrapmade.com/color-system/
--------------------------------------------------------------*/
/* Fonts */
:root {
  --default-font: "Roboto",  system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  --heading-font: "Nunito",  sans-serif;
  --nav-font: "Poppins",  sans-serif;
}

/* Global Colors - The following color variables are used throughout the website. Updating them here will change the color scheme of the entire website */
:root { 
  --background-color: #ffffff; /* Background color for the entire website, including individual sections */
  --default-color: #444444; /* Default color used for the majority of the text content across the entire website */
  --heading-color: #012970; /* Color for headings, subheadings and title throughout the website */
  --accent-color: #4154f1; /* Accent color that represents your brand on the website. It's used for buttons, links, and other elements that need to stand out */
  --surface-color: #ffffff; /* The surface color is used as a background of boxed elements within sections, such as cards, icon boxes, or other elements that require a visual separation from the global background. */
  --contrast-color: #ffffff; /* Contrast color for text, ensuring readability against backgrounds of accent, heading, or default colors. */
}

/* Nav Menu Colors - The following color variables are used specifically for the navigation menu. They are separate from the global colors to allow for more customization options */
:root {
  --nav-color: #012970;  /* The default color of the main navmenu links */
  --nav-hover-color: #4154f1; /* Applied to main navmenu links when they are hovered over or active */
  --nav-mobile-background-color: #ffffff; /* Used as the background color for mobile navigation menu */
  --nav-dropdown-background-color: #ffffff; /* Used as the background color for dropdown items that appear when hovering over primary navigation items */
  --nav-dropdown-color: #212529; /* Used for navigation links of the dropdown items in the navigation menu. */
  --nav-dropdown-hover-color: #4154f1; /* Similar to --nav-hover-color, this color is applied to dropdown navigation links when they are hovered over. */
}

/* Color Presets - These classes override global colors when applied to any section or element, providing reuse of the sam color scheme. */

.light-background {
  --background-color: #f9f9f9;
  --surface-color: #ffffff;
}

.dark-background {
  --background-color: #060606;
  --default-color: #ffffff;
  --heading-color: #ffffff;
  --surface-color: #252525;
  --contrast-color: #ffffff;
}

/* Smooth scroll */
:root {
  scroll-behavior: smooth;
}

/*--------------------------------------------------------------
# General Styling & Shared Classes
--------------------------------------------------------------*/
body {
  color: var(--default-color);
  background-color: var(--background-color);
  font-family: var(--default-font);
}

a {
  color: var(--accent-color);
  text-decoration: none;
  transition: 0.3s;
}

a:hover {
  color: color-mix(in srgb, var(--accent-color), transparent 25%);
  text-decoration: none;
}

h1,
h2,
h3,
h4,
h5,
h6 {
  color: var(--heading-color);
  font-family: var(--heading-font);
}

/* PHP Email Form Messages
------------------------------*/
.php-email-form .error-message {
  display: none;
  background: #df1529;
  color: #ffffff;
  text-align: left;
  padding: 15px;
  margin-bottom: 24px;
  font-weight: 600;
}

.php-email-form .sent-message {
  display: none;
  color: #ffffff;
  background: #059652;
  text-align: center;
  padding: 15px;
  margin-bottom: 24px;
  font-weight: 600;
}

.php-email-form .loading {
  display: none;
  background: var(--surface-color);
  text-align: center;
  padding: 15px;
  margin-bottom: 24px;
}

.php-email-form .loading:before {
  content: "";
  display: inline-block;
  border-radius: 50%;
  width: 24px;
  height: 24px;
  margin: 0 10px -6px 0;
  border: 3px solid var(--accent-color);
  border-top-color: var(--surface-color);
  animation: php-email-form-loading 1s linear infinite;
}

@keyframes php-email-form-loading {
  0% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(360deg);
  }
}

/*--------------------------------------------------------------
# Global Header
--------------------------------------------------------------*/
.header {
  color: var(--default-color);
  background-color: var(--background-color);
  padding: 20px 0;
  transition: all 0.5s;
  z-index: 997;
}

.header .logo {
  line-height: 1;
}

.header .logo img {
  max-height: 36px;
  margin-right: 8px;
}

.header .logo h1 {
  font-size: 30px;
  margin: 0;
  font-weight: 700;
  color: var(--heading-color);
}

.header .btn-getstarted,
.header .btn-getstarted:focus {
  color: var(--contrast-color);
  background: var(--accent-color);
  font-size: 15px;
  padding: 8px 25px;
  margin: 0 0 0 30px;
  border-radius: 4px;
  transition: 0.3s;
  font-weight: 500;
}

.header .btn-getstarted:hover,
.header .btn-getstarted:focus:hover {
  color: var(--contrast-color);
  background: color-mix(in srgb, var(--accent-color), transparent 15%);
}

@media (max-width: 1200px) {
  .header .logo {
    order: 1;
  }

  .header .btn-getstarted {
    order: 2;
    margin: 0 15px 0 0;
    padding: 6px 15px;
  }

  .header .navmenu {
    order: 3;
  }
}

.scrolled .header {
  box-shadow: 0px 0 18px rgba(0, 0, 0, 0.1);
}

/* Index Page Header
------------------------------*/
.index-page .header {
  --background-color: rgba(255, 255, 255, 0);
}

/* Index Page Header on Scroll
------------------------------*/
.index-page.scrolled .header {
  --background-color: #ffffff;
}

/*--------------------------------------------------------------
# Navigation Menu
--------------------------------------------------------------*/
/* Navmenu - Desktop */
@media (min-width: 1200px) {
  .navmenu {
    padding: 0;
  }

  .navmenu ul {
    margin: 0;
    padding: 0;
    display: flex;
    list-style: none;
    align-items: center;
  }

  .navmenu li {
    position: relative;
  }

  .navmenu a,
  .navmenu a:focus {
    color: var(--nav-color);
    padding: 18px 12px;
    font-size: 15px;
    font-family: var(--nav-font);
    font-weight: 500;
    display: flex;
    align-items: center;
    justify-content: space-between;
    white-space: nowrap;
    transition: 0.3s;
  }

  .navmenu a i,
  .navmenu a:focus i {
    font-size: 12px;
    line-height: 0;
    margin-left: 5px;
    transition: 0.3s;
  }

  .navmenu li:last-child a {
    padding-right: 0;
  }

  .navmenu li:hover>a,
  .navmenu .active,
  .navmenu .active:focus {
    color: var(--nav-hover-color);
  }

  .navmenu .dropdown ul {
    margin: 0;
    padding: 10px 0;
    background: var(--nav-dropdown-background-color);
    display: block;
    position: absolute;
    visibility: hidden;
    left: 14px;
    top: 130%;
    opacity: 0;
    transition: 0.3s;
    border-radius: 4px;
    z-index: 99;
    box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
  }

  .navmenu .dropdown ul li {
    min-width: 200px;
  }

  .navmenu .dropdown ul a {
    padding: 10px 20px;
    font-size: 15px;
    text-transform: none;
    color: var(--nav-dropdown-color);
  }

  .navmenu .dropdown ul a i {
    font-size: 12px;
  }

  .navmenu .dropdown ul a:hover,
  .navmenu .dropdown ul .active:hover,
  .navmenu .dropdown ul li:hover>a {
    color: var(--nav-dropdown-hover-color);
  }

  .navmenu .dropdown:hover>ul {
    opacity: 1;
    top: 100%;
    visibility: visible;
  }

  .navmenu .dropdown .dropdown ul {
    top: 0;
    left: -90%;
    visibility: hidden;
  }

  .navmenu .dropdown .dropdown:hover>ul {
    opacity: 1;
    top: 0;
    left: -100%;
    visibility: visible;
  }
}

/* Navmenu - Mobile */
@media (max-width: 1199px) {
  .mobile-nav-toggle {
    color: var(--nav-color);
    font-size: 28px;
    line-height: 0;
    margin-right: 10px;
    cursor: pointer;
    transition: color 0.3s;
  }

  .navmenu {
    padding: 0;
    z-index: 9997;
  }

  .navmenu ul {
    display: none;
    list-style: none;
    position: absolute;
    inset: 60px 20px 20px 20px;
    padding: 10px 0;
    margin: 0;
    border-radius: 6px;
    background-color: var(--nav-mobile-background-color);
    overflow-y: auto;
    transition: 0.3s;
    z-index: 9998;
    box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
  }

  .navmenu a,
  .navmenu a:focus {
    color: var(--nav-dropdown-color);
    padding: 10px 20px;
    font-family: var(--nav-font);
    font-size: 17px;
    font-weight: 500;
    display: flex;
    align-items: center;
    justify-content: space-between;
    white-space: nowrap;
    transition: 0.3s;
  }

  .navmenu a i,
  .navmenu a:focus i {
    font-size: 12px;
    line-height: 0;
    margin-left: 5px;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: 0.3s;
    background-color: color-mix(in srgb, var(--accent-color), transparent 90%);
  }

  .navmenu a i:hover,
  .navmenu a:focus i:hover {
    background-color: var(--accent-color);
    color: var(--contrast-color);
  }

  .navmenu a:hover,
  .navmenu .active,
  .navmenu .active:focus {
    color: var(--nav-dropdown-hover-color);
  }

  .navmenu .active i,
  .navmenu .active:focus i {
    background-color: var(--accent-color);
    color: var(--contrast-color);
    transform: rotate(180deg);
  }

  .navmenu .dropdown ul {
    position: static;
    display: none;
    z-index: 99;
    padding: 10px 0;
    margin: 10px 20px;
    background-color: var(--nav-dropdown-background-color);
    border: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
    box-shadow: none;
    transition: all 0.5s ease-in-out;
  }

  .navmenu .dropdown ul ul {
    background-color: rgba(33, 37, 41, 0.1);
  }

  .navmenu .dropdown>.dropdown-active {
    display: block;
    background-color: rgba(33, 37, 41, 0.03);
  }

  .mobile-nav-active {
    overflow: hidden;
  }

  .mobile-nav-active .mobile-nav-toggle {
    color: #fff;
    position: absolute;
    font-size: 32px;
    top: 15px;
    right: 15px;
    margin-right: 0;
    z-index: 9999;
  }

  .mobile-nav-active .navmenu {
    position: fixed;
    overflow: hidden;
    inset: 0;
    background: rgba(33, 37, 41, 0.8);
    transition: 0.3s;
  }

  .mobile-nav-active .navmenu>ul {
    display: block;
  }
}

/* Listing Dropdown - Desktop */
@media (min-width: 1200px) {
  .navmenu .listing-dropdown {
    position: static;
  }

  .navmenu .listing-dropdown ul {
    margin: 0;
    padding: 10px;
    background: var(--nav-dropdown-background-color);
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    position: absolute;
    top: 130%;
    left: 0;
    right: 0;
    visibility: hidden;
    opacity: 0;
    display: flex;
    transition: 0.3s;
    border-radius: 4px;
    z-index: 99;
  }

  .navmenu .listing-dropdown ul li {
    flex: 1;
  }

  .navmenu .listing-dropdown ul li a,
  .navmenu .listing-dropdown ul li:hover>a {
    padding: 10px 20px;
    font-size: 15px;
    color: var(--nav-dropdown-color);
    background-color: var(--nav-dropdown-background-color);
  }

  .navmenu .listing-dropdown ul li a:hover,
  .navmenu .listing-dropdown ul li .active,
  .navmenu .listing-dropdown ul li .active:hover {
    color: var(--nav-dropdown-hover-color);
    background-color: var(--nav-dropdown-background-color);
  }

  .navmenu .listing-dropdown:hover>ul {
    opacity: 1;
    top: 100%;
    visibility: visible;
  }
}

/* Listing Dropdown - Mobile */
@media (max-width: 1199px) {
  .navmenu .listing-dropdown ul {
    position: static;
    display: none;
    z-index: 99;
    padding: 10px 0;
    margin: 10px 20px;
    background-color: var(--nav-dropdown-background-color);
    border: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
    box-shadow: none;
    transition: all 0.5s ease-in-out;
  }

  .navmenu .listing-dropdown ul ul {
    background-color: rgba(33, 37, 41, 0.1);
  }

  .navmenu .listing-dropdown>.dropdown-active {
    display: block;
    background-color: rgba(33, 37, 41, 0.03);
  }
}

/*--------------------------------------------------------------
# Global Footer
--------------------------------------------------------------*/
.footer {
  color: var(--default-color);
  background-color: var(--background-color);
  font-size: 14px;
  padding-bottom: 50px;
  position: relative;
}

.footer .footer-newsletter {
  background-color: color-mix(in srgb, var(--accent-color), transparent 97%);
  border-top: 1px solid color-mix(in srgb, var(--accent-color), transparent 85%);
  border-bottom: 1px solid color-mix(in srgb, var(--accent-color), transparent 85%);
  padding: 50px 0;
}

.footer .footer-newsletter h4 {
  font-size: 24px;
}

.footer .footer-newsletter .newsletter-form {
  margin-top: 30px;
  margin-bottom: 15px;
  padding: 6px 8px;
  position: relative;
  background-color: color-mix(in srgb, var(--background-color), transparent 50%);
  border: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
  box-shadow: 0px 2px 25px rgba(0, 0, 0, 0.1);
  display: flex;
  transition: 0.3s;
  border-radius: 4px;
}

.footer .footer-newsletter .newsletter-form:focus-within {
  border-color: var(--accent-color);
}

.footer .footer-newsletter .newsletter-form input[type=email] {
  border: 0;
  padding: 4px;
  width: 100%;
  background-color: color-mix(in srgb, var(--background-color), transparent 50%);
  color: var(--default-color);
}

.footer .footer-newsletter .newsletter-form input[type=email]:focus-visible {
  outline: none;
}

.footer .footer-newsletter .newsletter-form input[type=submit] {
  border: 0;
  font-size: 16px;
  padding: 0 20px;
  margin: -7px -8px -7px 0;
  background: var(--accent-color);
  color: var(--contrast-color);
  transition: 0.3s;
  border-radius: 0 4px 4px 0;
}

.footer .footer-newsletter .newsletter-form input[type=submit]:hover {
  background: color-mix(in srgb, var(--accent-color), transparent 20%);
}

.footer .footer-top {
  padding-top: 50px;
}

.footer .social-links a {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border-radius: 4px;
  background-color: color-mix(in srgb, var(--accent-color), transparent 97%);
  border: 1px solid color-mix(in srgb, var(--accent-color), transparent 85%);
  font-size: 16px;
  color: var(--accent-color);
  margin-right: 10px;
  transition: 0.3s;
}

.footer .social-links a:hover {
  color: var(--contrast-color);
  background-color: var(--accent-color);
}

.footer h4 {
  font-size: 16px;
  font-weight: bold;
  position: relative;
  padding-bottom: 12px;
}

.footer .footer-links {
  margin-bottom: 30px;
}

.footer .footer-links ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer .footer-links ul i {
  margin-right: 3px;
  font-size: 12px;
  line-height: 0;
  color: var(--accent-color);
}

.footer .footer-links ul li {
  padding: 10px 0;
  display: flex;
  align-items: center;
}

.footer .footer-links ul li:first-child {
  padding-top: 0;
}

.footer .footer-links ul a {
  display: inline-block;
  color: color-mix(in srgb, var(--default-color), transparent 20%);
  line-height: 1;
}

.footer .footer-links ul a:hover {
  color: var(--accent-color);
}

.footer .footer-about a {
  color: var(--heading-color);
  font-size: 24px;
  font-weight: 600;
  font-family: var(--heading-font);
}

.footer .footer-contact p {
  margin-bottom: 5px;
}

.footer .copyright {
  padding-top: 25px;
  padding-bottom: 25px;
  border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
}

.footer .copyright p {
  margin-bottom: 0;
}

.footer .credits {
  margin-top: 6px;
  font-size: 13px;
}

/*--------------------------------------------------------------
# Scroll Top Button
--------------------------------------------------------------*/
.scroll-top {
  position: fixed;
  visibility: hidden;
  opacity: 0;
  right: 15px;
  bottom: 15px;
  z-index: 99999;
  background-color: var(--accent-color);
  width: 40px;
  height: 40px;
  border-radius: 4px;
  transition: all 0.4s;
}

.scroll-top i {
  font-size: 24px;
  color: var(--contrast-color);
  line-height: 0;
}

.scroll-top:hover {
  background-color: color-mix(in srgb, var(--accent-color), transparent 20%);
  color: var(--contrast-color);
}

.scroll-top.active {
  visibility: visible;
  opacity: 1;
}

/*--------------------------------------------------------------
# Disable aos animation delay on mobile devices
--------------------------------------------------------------*/
@media screen and (max-width: 768px) {
  [data-aos-delay] {
    transition-delay: 0 !important;
  }
}

/*--------------------------------------------------------------
# Global Page Titles & Breadcrumbs
--------------------------------------------------------------*/
.page-title {
  color: var(--default-color);
  background-color: var(--background-color);
  position: relative;
}

.page-title .heading {
  padding: 80px 0;
  border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
}

.page-title .heading h1 {
  font-size: 38px;
  font-weight: 700;
}

.page-title nav {
  background-color: color-mix(in srgb, var(--default-color), transparent 95%);
  padding: 20px 0;
}

.page-title nav ol {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  margin: 0;
  font-size: 16px;
  font-weight: 600;
}

.page-title nav ol li+li {
  padding-left: 10px;
}

.page-title nav ol li+li::before {
  content: "/";
  display: inline-block;
  padding-right: 10px;
  color: color-mix(in srgb, var(--default-color), transparent 70%);
}

/*--------------------------------------------------------------
# Global Sections
--------------------------------------------------------------*/
section,
.section {
  color: var(--default-color);
  background-color: var(--background-color);
  padding: 60px 0;
  scroll-margin-top: 98px;
  overflow: clip;
}

@media (max-width: 1199px) {

  section,
  .section {
    scroll-margin-top: 56px;
  }
}

/*--------------------------------------------------------------
# Global Section Titles
--------------------------------------------------------------*/
.section-title {
  text-align: center;
  padding-bottom: 60px;
  position: relative;
}

.section-title h2 {
  font-size: 13px;
  letter-spacing: 1px;
  font-weight: 700;
  padding: 8px 20px;
  margin: 0;
  background: color-mix(in srgb, var(--accent-color), transparent 90%);
  color: var(--accent-color);
  display: inline-block;
  text-transform: uppercase;
  border-radius: 50px;
  font-family: var(--default-font);
}

.section-title p {
  color: var(--heading-color);
  margin: 10px 0 0 0;
  font-size: 32px;
  font-weight: 700;
  font-family: var(--heading-font);
}

.section-title p .description-title {
  color: var(--accent-color);
}

/*--------------------------------------------------------------
# Hero Section
--------------------------------------------------------------*/
.hero {
  width: 100%;
  min-height: 100vh;
  position: relative;
  padding: 80px 0 60px 0;
  display: flex;
  align-items: center;
  background: url(../img/hero-bg.png) top center no-repeat;
  background-size: cover;
}

.hero h1 {
  margin: 0;
  font-size: 48px;
  font-weight: 700;
  line-height: 56px;
}

.hero p {
  color: color-mix(in srgb, var(--default-color), transparent 30%);
  margin: 5px 0 30px 0;
  font-size: 20px;
  font-weight: 400;
}

.hero .btn-get-started {
  color: var(--contrast-color);
  background: var(--accent-color);
  font-family: var(--heading-font);
  font-weight: 500;
  font-size: 16px;
  letter-spacing: 1px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 12px 40px;
  border-radius: 4px;
  transition: 0.5s;
  box-shadow: 0 8px 28px rgba(0, 0, 0, 0.1);
}

.hero .btn-get-started i {
  margin-left: 5px;
  font-size: 18px;
  transition: 0.3s;
}

.hero .btn-get-started:hover {
  color: var(--contrast-color);
  background: color-mix(in srgb, var(--accent-color), transparent 15%);
  box-shadow: 0 8px 28px rgba(0, 0, 0, 0.1);
}

.hero .btn-get-started:hover i {
  transform: translateX(5px);
}

.hero .btn-watch-video {
  font-size: 16px;
  transition: 0.5s;
  color: var(--default-color);
  font-weight: 600;
}

.hero .btn-watch-video i {
  color: var(--accent-color);
  font-size: 32px;
  transition: 0.3s;
  line-height: 0;
  margin-right: 8px;
}

.hero .btn-watch-video:hover {
  color: var(--accent-color);
}

.hero .btn-watch-video:hover i {
  color: color-mix(in srgb, var(--accent-color), transparent 15%);
}

.hero .animated {
  animation: up-down 2s ease-in-out infinite alternate-reverse both;
}

@media (max-width: 640px) {
  .hero h1 {
    font-size: 28px;
    line-height: 36px;
  }

  .hero p {
    font-size: 18px;
    line-height: 24px;
    margin-bottom: 30px;
  }
}

@keyframes up-down {
  0% {
    transform: translateY(10px);
  }

  100% {
    transform: translateY(-10px);
  }
}

/*--------------------------------------------------------------
# About Section
--------------------------------------------------------------*/
.about .content {
  background-color: color-mix(in srgb, var(--accent-color), transparent 95%);
  padding: 40px;
}

.about .content h3 {
  font-size: 14px;
  font-weight: 700;
  color: var(--accent-color);
  text-transform: uppercase;
}

.about .content h2 {
  font-size: 24px;
  font-weight: 700;
}

.about .content p {
  margin: 15px 0 30px 0;
  line-height: 24px;
}

.about .content .btn-read-more {
  color: var(--contrast-color);
  background: var(--accent-color);
  line-height: 0;
  padding: 15px 40px;
  border-radius: 4px;
  transition: 0.5s;
  box-shadow: 0px 5px 25px rgba(0, 0, 0, 0.1);
}

.about .content .btn-read-more span {
  font-family: var(--default-font);
  font-weight: 600;
  font-size: 16px;
  letter-spacing: 1px;
}

.about .content .btn-read-more i {
  margin-left: 5px;
  font-size: 18px;
  transition: 0.3s;
}

.about .content .btn-read-more:hover i {
  transform: translateX(5px);
}

/*--------------------------------------------------------------
# Values Section
--------------------------------------------------------------*/
.values .card {
  background-color: var(--surface-color);
  color: var(--default-color);
  padding: 30px;
  box-shadow: 0px 0 10px rgba(0, 0, 0, 0.1);
  text-align: center;
  transition: 0.3s;
  height: 100%;
  border: 0;
}

.values .card img {
  padding: 30px 50px;
  transition: 0.5s;
  transform: scale(1.1);
}

.values .card h3 {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 18px;
}

.values .card:hover {
  box-shadow: 0px 0 30px rgba(0, 0, 0, 0.1);
}

.values .card:hover img {
  transform: scale(1);
}

/*--------------------------------------------------------------
# Stats Section
--------------------------------------------------------------*/
.stats .stats-item {
  background-color: var(--surface-color);
  box-shadow: 0px 0 30px rgba(0, 0, 0, 0.1);
  padding: 30px;
}

.stats .stats-item i {
  color: var(--accent-color);
  font-size: 42px;
  line-height: 0;
  margin-right: 20px;
}

.stats .stats-item span {
  color: var(--heading-color);
  font-size: 36px;
  display: block;
  font-weight: 600;
}

.stats .stats-item p {
  padding: 0;
  margin: 0;
  font-family: var(--heading-font);
  font-size: 16px;
}

/*--------------------------------------------------------------
# Features Section
--------------------------------------------------------------*/
.features .feature-box {
  padding: 24px 20px;
  box-shadow: 0px 0 30px rgba(0, 0, 0, 0.1);
  transition: 0.3s;
  height: 100%;
}

.features .feature-box h3 {
  font-size: 18px;
  font-weight: 700;
  margin: 0;
}

.features .feature-box i {
  background: color-mix(in srgb, var(--accent-color), transparent 92%);
  color: var(--accent-color);
  line-height: 0;
  padding: 4px;
  margin-right: 10px;
  font-size: 24px;
  border-radius: 3px;
  transition: 0.3s;
}

.features .feature-box:hover i {
  background: var(--accent-color);
  color: var(--contrast-color);
}

/*--------------------------------------------------------------
# Alt Features Section
--------------------------------------------------------------*/
.alt-features .icon-box {
  display: flex;
}

.alt-features .icon-box h4 {
  font-size: 20px;
  font-weight: 700;
  margin: 0 0 10px 0;
}

.alt-features .icon-box i {
  font-size: 44px;
  line-height: 44px;
  color: var(--accent-color);
  margin-right: 15px;
}

.alt-features .icon-box p {
  font-size: 15px;
  color: color-mix(in srgb, var(--default-color), transparent 30%);
  margin-bottom: 0;
}

/*--------------------------------------------------------------
# Services Section
--------------------------------------------------------------*/
.services .service-item {
  background-color: var(--surface-color);
  box-shadow: 0px 0 30px rgba(0, 0, 0, 0.1);
  height: 100%;
  padding: 60px 30px;
  text-align: center;
  transition: 0.3s;
  border-radius: 5px;
}

.services .service-item .icon {
  font-size: 36px;
  padding: 20px 20px;
  border-radius: 4px;
  position: relative;
  margin-bottom: 25px;
  display: inline-block;
  line-height: 0;
  transition: 0.3s;
}

.services .service-item h3 {
  font-size: 24px;
  font-weight: 700;
}

.services .service-item .read-more {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  font-size: 16px;
  padding: 8px 20px;
}

.services .service-item .read-more i {
  line-height: 0;
  margin-left: 5px;
  font-size: 18px;
}

.services .service-item.item-cyan {
  border-bottom: 3px solid #0dcaf0;
}

.services .service-item.item-cyan .icon {
  color: #0dcaf0;
  background: rgba(13, 202, 240, 0.1);
}

.services .service-item.item-cyan .read-more {
  color: #0dcaf0;
}

.services .service-item.item-cyan:hover {
  background: #0dcaf0;
}

.services .service-item.item-orange {
  border-bottom: 3px solid #fd7e14;
}

.services .service-item.item-orange .icon {
  color: #fd7e14;
  background: rgba(253, 126, 20, 0.1);
}

.services .service-item.item-orange .read-more {
  color: #fd7e14;
}

.services .service-item.item-orange:hover {
  background: #fd7e14;
}

.services .service-item.item-teal {
  border-bottom: 3px solid #20c997;
}

.services .service-item.item-teal .icon {
  color: #20c997;
  background: rgba(32, 201, 151, 0.1);
}

.services .service-item.item-teal .read-more {
  color: #20c997;
}

.services .service-item.item-teal:hover {
  background: #20c997;
}

.services .service-item.item-red {
  border-bottom: 3px solid #df1529;
}

.services .service-item.item-red .icon {
  color: #df1529;
  background: rgba(223, 21, 4, 0.1);
}

.services .service-item.item-red .read-more {
  color: #df1529;
}

.services .service-item.item-red:hover {
  background: #df1529;
}

.services .service-item.item-indigo {
  border-bottom: 3px solid #6610f2;
}

.services .service-item.item-indigo .icon {
  color: #6610f2;
  background: rgba(102, 16, 242, 0.1);
}

.services .service-item.item-indigo .read-more {
  color: #6610f2;
}

.services .service-item.item-indigo:hover {
  background: #6610f2;
}

.services .service-item.item-pink {
  border-bottom: 3px solid #f3268c;
}

.services .service-item.item-pink .icon {
  color: #f3268c;
  background: rgba(243, 38, 140, 0.1);
}

.services .service-item.item-pink .read-more {
  color: #f3268c;
}

.services .service-item.item-pink:hover {
  background: #f3268c;
}

.services .service-item:hover h3,
.services .service-item:hover p,
.services .service-item:hover .read-more {
  color: #fff;
}

.services .service-item:hover .icon {
  background: #fff;
}

/*--------------------------------------------------------------
# Pricing Section
--------------------------------------------------------------*/
.pricing .pricing-tem {
  background-color: var(--surface-color);
  box-shadow: 0px 0 30px rgba(0, 0, 0, 0.1);
  padding: 40px 20px;
  text-align: center;
  border-radius: 4px;
  position: relative;
  overflow: hidden;
  transition: 0.3s;
  height: 100%;
}

@media (min-width: 1200px) {
  .pricing .pricing-tem:hover {
    transform: scale(1.1);
    box-shadow: 0px 0 30px rgba(0, 0, 0, 0.1);
  }
}

.pricing h3 {
  font-weight: 700;
  font-size: 18px;
  margin-bottom: 15px;
}

.pricing .price {
  font-size: 36px;
  color: var(--heading-color);
  font-weight: 600;
  font-family: var(--heading-font);
}

.pricing .price sup {
  font-size: 20px;
  top: -15px;
  left: -3px;
}

.pricing .price span {
  color: color-mix(in srgb, var(--default-color), transparent 50%);
  font-size: 16px;
  font-weight: 300;
}

.pricing .icon {
  padding: 20px 0;
}

.pricing .icon i {
  font-size: 48px;
}

.pricing ul {
  padding: 0;
  list-style: none;
  color: var(--default-color);
  text-align: center;
  line-height: 26px;
  font-size: 16px;
  margin-bottom: 25px;
}

.pricing ul li {
  padding-bottom: 10px;
}

.pricing ul .na {
  color: color-mix(in srgb, var(--default-color), transparent 70%);
  text-decoration: line-through;
}

.pricing .btn-buy {
  display: inline-block;
  padding: 8px 40px 10px 40px;
  border-radius: 50px;
  color: var(--accent-color);
  transition: none;
  font-size: 16px;
  font-weight: 400;
  font-family: var(--heading-font);
  font-weight: 600;
  transition: 0.3s;
  border: 1px solid var(--accent-color);
}

.pricing .btn-buy:hover {
  background: var(--accent-color);
  color: var(--contrast-color);
}

.pricing .featured {
  width: 200px;
  position: absolute;
  top: 18px;
  right: -68px;
  transform: rotate(45deg);
  z-index: 1;
  font-size: 14px;
  padding: 1px 0 3px 0;
  background: var(--accent-color);
  color: var(--contrast-color);
}

/*--------------------------------------------------------------
# Faq Section
--------------------------------------------------------------*/
.faq .faq-container .faq-item {
  position: relative;
  padding: 20px 0;
  border-bottom: 1px solid color-mix(in srgb, var(--default-color), transparent 85%);
  overflow: hidden;
}

.faq .faq-container .faq-item:last-child {
  margin-bottom: 0;
}

.faq .faq-container .faq-item h3 {
  font-weight: 600;
  font-size: 16px;
  line-height: 24px;
  margin: 0 30px 0 0;
  transition: 0.3s;
  cursor: pointer;
  display: flex;
  align-items: center;
}

.faq .faq-container .faq-item h3 .num {
  color: var(--accent-color);
  padding-right: 5px;
}

.faq .faq-container .faq-item h3:hover {
  color: var(--accent-color);
}

.faq .faq-container .faq-item .faq-content {
  display: grid;
  grid-template-rows: 0fr;
  transition: 0.3s ease-in-out;
  visibility: hidden;
  opacity: 0;
}

.faq .faq-container .faq-item .faq-content p {
  margin-bottom: 0;
  overflow: hidden;
}

.faq .faq-container .faq-item .faq-toggle {
  position: absolute;
  top: 20px;
  right: 20px;
  font-size: 16px;
  line-height: 0;
  transition: 0.3s;
  cursor: pointer;
}

.faq .faq-container .faq-item .faq-toggle:hover {
  color: var(--accent-color);
}

.faq .faq-container .faq-active h3 {
  color: var(--accent-color);
}

.faq .faq-container .faq-active .faq-content {
  grid-template-rows: 1fr;
  visibility: visible;
  opacity: 1;
  padding-top: 10px;
}

.faq .faq-container .faq-active .faq-toggle {
  transform: rotate(90deg);
  color: var(--accent-color);
}

/*--------------------------------------------------------------
# Portfolio Section
--------------------------------------------------------------*/
.portfolio .portfolio-filters {
  padding: 0;
  margin: 0 auto 20px auto;
  list-style: none;
  text-align: center;
}

.portfolio .portfolio-filters li {
  cursor: pointer;
  display: inline-block;
  padding: 0;
  font-size: 18px;
  font-weight: 500;
  margin: 0 10px;
  line-height: 1;
  margin-bottom: 5px;
  transition: all 0.3s ease-in-out;
}

.portfolio .portfolio-filters li:hover,
.portfolio .portfolio-filters li.filter-active {
  color: var(--accent-color);
}

.portfolio .portfolio-filters li:first-child {
  margin-left: 0;
}

.portfolio .portfolio-filters li:last-child {
  margin-right: 0;
}

@media (max-width: 575px) {
  .portfolio .portfolio-filters li {
    font-size: 14px;
    margin: 0 5px;
  }
}

.portfolio .portfolio-content {
  position: relative;
  overflow: hidden;
}

.portfolio .portfolio-content img {
  transition: 0.3s;
}

.portfolio .portfolio-content .portfolio-info {
  opacity: 0;
  position: absolute;
  inset: 0;
  z-index: 3;
  transition: all ease-in-out 0.3s;
  background: rgba(0, 0, 0, 0.6);
  padding: 15px;
}

.portfolio .portfolio-content .portfolio-info h4 {
  font-size: 14px;
  padding: 5px 10px;
  font-weight: 400;
  color: #ffffff;
  display: inline-block;
  background-color: var(--accent-color);
}

.portfolio .portfolio-content .portfolio-info p {
  position: absolute;
  bottom: 10px;
  text-align: center;
  display: inline-block;
  left: 0;
  right: 0;
  font-size: 16px;
  font-weight: 600;
  color: rgba(255, 255, 255, 0.8);
}

.portfolio .portfolio-content .portfolio-info .preview-link,
.portfolio .portfolio-content .portfolio-info .details-link {
  position: absolute;
  left: calc(50% - 40px);
  font-size: 26px;
  top: calc(50% - 14px);
  color: #fff;
  transition: 0.3s;
  line-height: 1.2;
}

.portfolio .portfolio-content .portfolio-info .preview-link:hover,
.portfolio .portfolio-content .portfolio-info .details-link:hover {
  color: var(--accent-color);
}

.portfolio .portfolio-content .portfolio-info .details-link {
  left: 50%;
  font-size: 34px;
  line-height: 0;
}

.portfolio .portfolio-content:hover .portfolio-info {
  opacity: 1;
}

.portfolio .portfolio-content:hover img {
  transform: scale(1.1);
}

/*--------------------------------------------------------------
# Testimonials Section
--------------------------------------------------------------*/
.testimonials .testimonial-item {
  background-color: var(--surface-color);
  box-shadow: 0px 0 20px rgba(0, 0, 0, 0.1);
  box-sizing: content-box;
  padding: 30px;
  margin: 40px 30px;
  min-height: 320px;
  display: flex;
  flex-direction: column;
  text-align: center;
  transition: 0.3s;
}

.testimonials .testimonial-item .stars {
  margin-bottom: 15px;
}

.testimonials .testimonial-item .stars i {
  color: #ffc107;
  margin: 0 1px;
}

.testimonials .testimonial-item .testimonial-img {
  width: 90px;
  border-radius: 50%;
  border: 4px solid var(--background-color);
  margin: 0 auto;
}

.testimonials .testimonial-item h3 {
  font-size: 18px;
  font-weight: bold;
  margin: 10px 0 5px 0;
}

.testimonials .testimonial-item h4 {
  font-size: 14px;
  color: color-mix(in srgb, var(--default-color), transparent 40%);
  margin: 0;
}

.testimonials .testimonial-item p {
  font-style: italic;
  margin: 0 auto 15px auto;
}

.testimonials .swiper-wrapper {
  height: auto;
}

.testimonials .swiper-pagination {
  margin-top: 20px;
  position: relative;
}

.testimonials .swiper-pagination .swiper-pagination-bullet {
  width: 12px;
  height: 12px;
  background-color: color-mix(in srgb, var(--default-color), transparent 85%);
  opacity: 1;
}

.testimonials .swiper-pagination .swiper-pagination-bullet-active {
  background-color: var(--accent-color);
}

.testimonials .swiper-slide {
  opacity: 0.3;
}

@media (max-width: 1199px) {
  .testimonials .swiper-slide-active {
    opacity: 1;
  }

  .testimonials .swiper-pagination {
    margin-top: 0;
  }

  .testimonials .testimonial-item {
    margin: 40px 20px;
  }
}

@media (min-width: 1200px) {
  .testimonials .swiper-slide-next {
    opacity: 1;
    transform: scale(1.12);
  }
}

/*--------------------------------------------------------------
# Team Section
--------------------------------------------------------------*/
.team .team-member {
  box-shadow: 0px 0 30px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  text-align: center;
  border-radius: 5px;
  transition: 0.3s;
}

.team .team-member .member-img {
  position: relative;
  overflow: hidden;
}

.team .team-member .member-img:after {
  position: absolute;
  content: "";
  left: -1px;
  right: -1px;
  bottom: -1px;
  height: 100%;
  background-color: var(--surface-color);
  -webkit-mask: url("../img/team-shape.svg") no-repeat center bottom;
  mask: url("../img/team-shape.svg") no-repeat center bottom;
  -webkit-mask-size: contain;
  mask-size: contain;
  z-index: 1;
}

.team .team-member .social {
  position: absolute;
  right: -100%;
  top: 30px;
  opacity: 0;
  border-radius: 4px;
  transition: 0.5s;
  background: color-mix(in srgb, var(--background-color), transparent 60%);
  z-index: 2;
}

.team .team-member .social a {
  transition: color 0.3s;
  color: color-mix(in srgb, var(--default-color), transparent 50%);
  margin: 15px 12px;
  display: block;
  line-height: 0;
  text-align: center;
}

.team .team-member .social a:hover {
  color: var(--default-color);
}

.team .team-member .social i {
  font-size: 18px;
}

.team .team-member .member-info {
  padding: 10px 15px 20px 15px;
}

.team .team-member .member-info h4 {
  font-weight: 700;
  margin-bottom: 5px;
  font-size: 20px;
}

.team .team-member .member-info span {
  display: block;
  font-size: 14px;
  font-weight: 400;
  color: color-mix(in srgb, var(--default-color), transparent 50%);
}

.team .team-member .member-info p {
  font-style: italic;
  font-size: 14px;
  padding-top: 15px;
  line-height: 26px;
  color: color-mix(in srgb, var(--default-color), transparent 30%);
}

.team .team-member:hover {
  transform: scale(1.08);
  box-shadow: 0px 0 30px rgba(0, 0, 0, 0.1);
}

.team .team-member:hover .social {
  right: 8px;
  opacity: 1;
}

/*--------------------------------------------------------------
# Clients Section
--------------------------------------------------------------*/
.clients .swiper-slide img {
  transition: 0.3s;
  opacity: 0.5;
}

.clients .swiper-slide img:hover {
  opacity: 1;
}

.clients .swiper-wrapper {
  height: auto;
}

.clients .swiper-pagination {
  margin-top: 20px;
  position: relative;
}

.clients .swiper-pagination .swiper-pagination-bullet {
  width: 12px;
  height: 12px;
  opacity: 1;
  background-color: color-mix(in srgb, var(--default-color), transparent 80%);
}

.clients .swiper-pagination .swiper-pagination-bullet-active {
  background-color: var(--accent-color);
}

/*--------------------------------------------------------------
# Recent Posts Section
--------------------------------------------------------------*/
.recent-posts .post-item {
  background-color: var(--surface-color);
  box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.1);
  transition: 0.3s;
}

.recent-posts .post-item .post-img img {
  transition: 0.5s;
}

.recent-posts .post-item .post-date {
  position: absolute;
  right: 0;
  bottom: 0;
  background-color: var(--accent-color);
  color: var(--contrast-color);
  text-transform: uppercase;
  font-size: 13px;
  padding: 6px 12px;
  font-weight: 500;
}

.recent-posts .post-item .post-content {
  padding: 30px;
}

.recent-posts .post-item .post-title {
  color: var(--heading-color);
  font-size: 20px;
  font-weight: 700;
  transition: 0.3s;
  margin-bottom: 15px;
}

.recent-posts .post-item .meta i {
  font-size: 16px;
  color: var(--accent-color);
}

.recent-posts .post-item .meta span {
  font-size: 15px;
  color: color-mix(in srgb, var(--default-color), transparent 50%);
}

.recent-posts .post-item hr {
  color: color-mix(in srgb, var(--default-color), transparent 80%);
  margin: 20px 0;
}

.recent-posts .post-item .readmore {
  display: flex;
  align-items: center;
  font-weight: 600;
  line-height: 1;
  transition: 0.3s;
  color: color-mix(in srgb, var(--default-color), transparent 40%);
}

.recent-posts .post-item .readmore i {
  line-height: 0;
  margin-left: 6px;
  font-size: 16px;
}

.recent-posts .post-item:hover .post-title,
.recent-posts .post-item:hover .readmore {
  color: var(--accent-color);
}

.recent-posts .post-item:hover .post-img img {
  transform: scale(1.1);
}

/*--------------------------------------------------------------
# Contact Section
--------------------------------------------------------------*/
.contact .info-item {
  background: color-mix(in srgb, var(--default-color), transparent 96%);
  padding: 30px;
}

.contact .info-item i {
  font-size: 38px;
  line-height: 0;
  color: var(--accent-color);
}

.contact .info-item h3 {
  font-size: 20px;
  font-weight: 700;
  margin: 20px 0 10px 0;
}

.contact .info-item p {
  padding: 0;
  line-height: 24px;
  font-size: 14px;
  margin-bottom: 0;
}

.contact .php-email-form {
  background: color-mix(in srgb, var(--default-color), transparent 96%);
  padding: 30px;
  height: 100%;
}

.contact .php-email-form input[type=text],
.contact .php-email-form input[type=email],
.contact .php-email-form textarea {
  font-size: 14px;
  padding: 10px 15px;
  box-shadow: none;
  border-radius: 0;
  color: var(--default-color);
  background-color: color-mix(in srgb, var(--background-color), transparent 50%);
  border-color: color-mix(in srgb, var(--default-color), transparent 80%);
}

.contact .php-email-form input[type=text]:focus,
.contact .php-email-form input[type=email]:focus,
.contact .php-email-form textarea:focus {
  border-color: var(--accent-color);
}

.contact .php-email-form input[type=text]::placeholder,
.contact .php-email-form input[type=email]::placeholder,
.contact .php-email-form textarea::placeholder {
  color: color-mix(in srgb, var(--default-color), transparent 70%);
}

.contact .php-email-form button[type=submit] {
  background: var(--accent-color);
  color: var(--contrast-color);
  border: 0;
  padding: 10px 30px;
  transition: 0.4s;
  border-radius: 4px;
}

.contact .php-email-form button[type=submit]:hover {
  background: color-mix(in srgb, var(--accent-color), transparent 20%);
}

/*--------------------------------------------------------------
# Portfolio Details Section
--------------------------------------------------------------*/
.portfolio-details .portfolio-details-slider img {
  width: 100%;
}

.portfolio-details .portfolio-details-slider .swiper-pagination {
  margin-top: 20px;
  position: relative;
}

.portfolio-details .portfolio-details-slider .swiper-pagination .swiper-pagination-bullet {
  width: 12px;
  height: 12px;
  background-color: color-mix(in srgb, var(--default-color), transparent 85%);
  opacity: 1;
}

.portfolio-details .portfolio-details-slider .swiper-pagination .swiper-pagination-bullet-active {
  background-color: var(--accent-color);
}

.portfolio-details .portfolio-info {
  background-color: var(--surface-color);
  padding: 30px;
  box-shadow: 0px 0 30px rgba(0, 0, 0, 0.1);
}

.portfolio-details .portfolio-info h3 {
  font-size: 22px;
  font-weight: 700;
  margin-bottom: 20px;
  padding-bottom: 20px;
  border-bottom: 1px solid color-mix(in srgb, var(--default-color), transparent 85%);
}

.portfolio-details .portfolio-info ul {
  list-style: none;
  padding: 0;
  font-size: 15px;
}

.portfolio-details .portfolio-info ul li+li {
  margin-top: 10px;
}

.portfolio-details .portfolio-description {
  padding-top: 30px;
}

.portfolio-details .portfolio-description h2 {
  font-size: 26px;
  font-weight: 700;
  margin-bottom: 20px;
}

.portfolio-details .portfolio-description p {
  padding: 0;
  color: color-mix(in srgb, var(--default-color), transparent 30%);
}

/*--------------------------------------------------------------
# Service Details Section
--------------------------------------------------------------*/
.service-details .service-box {
  background-color: var(--surface-color);
  padding: 20px;
  box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.1);
}

.service-details .service-box+.service-box {
  margin-top: 30px;
}

.service-details .service-box h4 {
  font-size: 20px;
  font-weight: 700;
  border-bottom: 2px solid color-mix(in srgb, var(--default-color), transparent 92%);
  padding-bottom: 15px;
  margin-bottom: 15px;
}

.service-details .services-list {
  background-color: var(--surface-color);
}

.service-details .services-list a {
  color: color-mix(in srgb, var(--default-color), transparent 20%);
  background-color: color-mix(in srgb, var(--default-color), transparent 96%);
  display: flex;
  align-items: center;
  padding: 12px 15px;
  margin-top: 15px;
  transition: 0.3s;
}

.service-details .services-list a:first-child {
  margin-top: 0;
}

.service-details .services-list a i {
  font-size: 16px;
  margin-right: 8px;
  color: var(--accent-color);
}

.service-details .services-list a.active {
  color: var(--contrast-color);
  background-color: var(--accent-color);
}

.service-details .services-list a.active i {
  color: var(--contrast-color);
}

.service-details .services-list a:hover {
  background-color: color-mix(in srgb, var(--accent-color), transparent 95%);
  color: var(--accent-color);
}

.service-details .download-catalog a {
  color: var(--default-color);
  display: flex;
  align-items: center;
  padding: 10px 0;
  transition: 0.3s;
  border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
}

.service-details .download-catalog a:first-child {
  border-top: 0;
  padding-top: 0;
}

.service-details .download-catalog a:last-child {
  padding-bottom: 0;
}

.service-details .download-catalog a i {
  font-size: 24px;
  margin-right: 8px;
  color: var(--accent-color);
}

.service-details .download-catalog a:hover {
  color: var(--accent-color);
}

.service-details .help-box {
  background-color: var(--accent-color);
  color: var(--contrast-color);
  margin-top: 30px;
  padding: 30px 15px;
}

.service-details .help-box .help-icon {
  font-size: 48px;
}

.service-details .help-box h4,
.service-details .help-box a {
  color: var(--contrast-color);
}

.service-details .services-img {
  margin-bottom: 20px;
}

.service-details h3 {
  font-size: 26px;
  font-weight: 700;
}

.service-details p {
  font-size: 15px;
}

.service-details ul {
  list-style: none;
  padding: 0;
  font-size: 15px;
}

.service-details ul li {
  padding: 5px 0;
  display: flex;
  align-items: center;
}

.service-details ul i {
  font-size: 20px;
  margin-right: 8px;
  color: var(--accent-color);
}

/*--------------------------------------------------------------
# Starter Section Section
--------------------------------------------------------------*/
.starter-section {
  /* Add your styles here */
}

/*--------------------------------------------------------------
# Blog Posts Section
--------------------------------------------------------------*/
.blog-posts article {
  background-color: var(--surface-color);
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
  padding: 30px;
  height: 100%;
}

.blog-posts .post-img {
  max-height: 440px;
  margin: -30px -30px 0 -30px;
  overflow: hidden;
}

.blog-posts .title {
  font-size: 24px;
  font-weight: 700;
  padding: 0;
  margin: 30px 0;
}

.blog-posts .title a {
  color: var(--heading-color);
  transition: 0.3s;
}

.blog-posts .title a:hover {
  color: var(--accent-color);
}

.blog-posts .meta-top {
  margin-top: 20px;
  color: color-mix(in srgb, var(--default-color), transparent 40%);
}

.blog-posts .meta-top ul {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  align-items: center;
  padding: 0;
  margin: 0;
}

.blog-posts .meta-top ul li+li {
  padding-left: 20px;
}

.blog-posts .meta-top i {
  font-size: 16px;
  margin-right: 8px;
  line-height: 0;
  color: color-mix(in srgb, var(--default-color), transparent 20%);
}

.blog-posts .meta-top a {
  color: color-mix(in srgb, var(--default-color), transparent 40%);
  font-size: 14px;
  display: inline-block;
  line-height: 1;
}

.blog-posts .content {
  margin-top: 20px;
}

.blog-posts .content .read-more {
  text-align: right;
}

.blog-posts .content .read-more a {
  background: var(--accent-color);
  color: var(--contrast-color);
  display: inline-block;
  padding: 8px 30px;
  transition: 0.3s;
  font-size: 14px;
  border-radius: 4px;
}

.blog-posts .content .read-more a:hover {
  background: color-mix(in srgb, var(--accent-color), transparent 20%);
}

/*--------------------------------------------------------------
# Blog Pagination Section
--------------------------------------------------------------*/
.blog-pagination {
  padding-top: 0;
  color: color-mix(in srgb, var(--default-color), transparent 40%);
}

.blog-pagination ul {
  display: flex;
  padding: 0;
  margin: 0;
  list-style: none;
}

.blog-pagination li {
  margin: 0 5px;
  transition: 0.3s;
}

.blog-pagination li a {
  color: color-mix(in srgb, var(--default-color), transparent 40%);
  padding: 7px 16px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.blog-pagination li a.active,
.blog-pagination li a:hover {
  background: var(--accent-color);
  color: var(--contrast-color);
}

.blog-pagination li a.active a,
.blog-pagination li a:hover a {
  color: var(--contrast-color);
}

/*--------------------------------------------------------------
# Blog Details Section
--------------------------------------------------------------*/
.blog-details {
  padding-bottom: 30px;
}

.blog-details .article {
  background-color: var(--surface-color);
  padding: 30px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.blog-details .post-img {
  margin: -30px -30px 20px -30px;
  overflow: hidden;
}

.blog-details .title {
  color: var(--heading-color);
  font-size: 28px;
  font-weight: 700;
  padding: 0;
  margin: 30px 0;
}

.blog-details .content {
  margin-top: 20px;
}

.blog-details .content h3 {
  font-size: 22px;
  margin-top: 30px;
  font-weight: bold;
}

.blog-details .content blockquote {
  overflow: hidden;
  background-color: color-mix(in srgb, var(--default-color), transparent 95%);
  padding: 60px;
  position: relative;
  text-align: center;
  margin: 20px 0;
}

.blog-details .content blockquote p {
  color: var(--default-color);
  line-height: 1.6;
  margin-bottom: 0;
  font-style: italic;
  font-weight: 500;
  font-size: 22px;
}

.blog-details .content blockquote:after {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  width: 3px;
  background-color: var(--accent-color);
  margin-top: 20px;
  margin-bottom: 20px;
}

.blog-details .meta-top {
  margin-top: 20px;
  color: color-mix(in srgb, var(--default-color), transparent 40%);
}

.blog-details .meta-top ul {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  align-items: center;
  padding: 0;
  margin: 0;
}

.blog-details .meta-top ul li+li {
  padding-left: 20px;
}

.blog-details .meta-top i {
  font-size: 16px;
  margin-right: 8px;
  line-height: 0;
  color: color-mix(in srgb, var(--default-color), transparent 40%);
}

.blog-details .meta-top a {
  color: color-mix(in srgb, var(--default-color), transparent 40%);
  font-size: 14px;
  display: inline-block;
  line-height: 1;
}

.blog-details .meta-bottom {
  padding-top: 10px;
  border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
}

.blog-details .meta-bottom i {
  color: color-mix(in srgb, var(--default-color), transparent 40%);
  display: inline;
}

.blog-details .meta-bottom a {
  color: color-mix(in srgb, var(--default-color), transparent 40%);
  transition: 0.3s;
}

.blog-details .meta-bottom a:hover {
  color: var(--accent-color);
}

.blog-details .meta-bottom .cats {
  list-style: none;
  display: inline;
  padding: 0 20px 0 0;
  font-size: 14px;
}

.blog-details .meta-bottom .cats li {
  display: inline-block;
}

.blog-details .meta-bottom .tags {
  list-style: none;
  display: inline;
  padding: 0;
  font-size: 14px;
}

.blog-details .meta-bottom .tags li {
  display: inline-block;
}

.blog-details .meta-bottom .tags li+li::before {
  padding-right: 6px;
  color: var(--default-color);
  content: ",";
}

.blog-details .meta-bottom .share {
  font-size: 16px;
}

.blog-details .meta-bottom .share i {
  padding-left: 5px;
}

/*--------------------------------------------------------------
# Blog Author Section
--------------------------------------------------------------*/
.blog-author {
  padding: 10px 0 40px 0;
}

.blog-author .author-container {
  background-color: var(--surface-color);
  padding: 20px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.blog-author img {
  max-width: 120px;
  margin-right: 20px;
}

.blog-author h4 {
  font-weight: 600;
  font-size: 20px;
  margin-bottom: 0px;
  padding: 0;
  color: color-mix(in srgb, var(--default-color), transparent 20%);
}

.blog-author .social-links {
  margin: 0 10px 10px 0;
}

.blog-author .social-links a {
  color: color-mix(in srgb, var(--default-color), transparent 60%);
  margin-right: 5px;
}

.blog-author p {
  font-style: italic;
  color: color-mix(in srgb, var(--default-color), transparent 30%);
  margin-bottom: 0;
}

/*--------------------------------------------------------------
# Blog Comments Section
--------------------------------------------------------------*/
.blog-comments {
  padding: 10px 0;
}

.blog-comments .comments-count {
  font-weight: bold;
}

.blog-comments .comment {
  margin-top: 30px;
  position: relative;
}

.blog-comments .comment .comment-img {
  margin-right: 14px;
}

.blog-comments .comment .comment-img img {
  width: 60px;
}

.blog-comments .comment h5 {
  font-size: 16px;
  margin-bottom: 2px;
}

.blog-comments .comment h5 a {
  font-weight: bold;
  color: var(--default-color);
  transition: 0.3s;
}

.blog-comments .comment h5 a:hover {
  color: var(--accent-color);
}

.blog-comments .comment h5 .reply {
  padding-left: 10px;
  color: color-mix(in srgb, var(--default-color), transparent 20%);
}

.blog-comments .comment h5 .reply i {
  font-size: 20px;
}

.blog-comments .comment time {
  display: block;
  font-size: 14px;
  color: color-mix(in srgb, var(--default-color), transparent 40%);
  margin-bottom: 5px;
}

.blog-comments .comment.comment-reply {
  padding-left: 40px;
}

/*--------------------------------------------------------------
# Comment Form Section
--------------------------------------------------------------*/
.comment-form {
  padding-top: 10px;
}

.comment-form form {
  background-color: var(--surface-color);
  margin-top: 30px;
  padding: 30px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.comment-form form h4 {
  font-weight: bold;
  font-size: 22px;
}

.comment-form form p {
  font-size: 14px;
}

.comment-form form input {
  background-color: var(--surface-color);
  color: var(--default-color);
  border: 1px solid color-mix(in srgb, var(--default-color), transparent 70%);
  font-size: 14px;
  border-radius: 4px;
  padding: 10px 10px;
}

.comment-form form input:focus {
  color: var(--default-color);
  background-color: var(--surface-color);
  box-shadow: none;
  border-color: var(--accent-color);
}

.comment-form form input::placeholder {
  color: color-mix(in srgb, var(--default-color), transparent 50%);
}

.comment-form form textarea {
  background-color: var(--surface-color);
  color: var(--default-color);
  border: 1px solid color-mix(in srgb, var(--default-color), transparent 70%);
  border-radius: 4px;
  padding: 10px 10px;
  font-size: 14px;
  height: 120px;
}

.comment-form form textarea:focus {
  color: var(--default-color);
  box-shadow: none;
  border-color: var(--accent-color);
  background-color: var(--surface-color);
}

.comment-form form textarea::placeholder {
  color: color-mix(in srgb, var(--default-color), transparent 50%);
}

.comment-form form .form-group {
  margin-bottom: 25px;
}

.comment-form form .btn-primary {
  border-radius: 4px;
  padding: 10px 20px;
  border: 0;
  background-color: var(--accent-color);
  color: var(--contrast-color);
}

.comment-form form .btn-primary:hover {
  color: var(--contrast-color);
  background-color: color-mix(in srgb, var(--accent-color), transparent 20%);
}

/*--------------------------------------------------------------
# Widgets
--------------------------------------------------------------*/
.widgets-container {
  background-color: var(--surface-color);
  padding: 30px;
  margin: 60px 0 30px 0;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.widget-title {
  color: var(--heading-color);
  font-size: 20px;
  font-weight: 700;
  padding: 0;
  margin: 0 0 20px 0;
}

.widget-item {
  margin-bottom: 40px;
}

.widget-item:last-child {
  margin-bottom: 0;
}

.search-widget form {
  background: var(--background-color);
  border: 1px solid color-mix(in srgb, var(--default-color), transparent 70%);
  padding: 3px 10px;
  position: relative;
  transition: 0.3s;
}

.search-widget form input[type=text] {
  border: 0;
  padding: 4px;
  border-radius: 4px;
  width: calc(100% - 40px);
  background-color: var(--background-color);
  color: var(--default-color);
}

.search-widget form input[type=text]:focus {
  outline: none;
}

.search-widget form button {
  background: var(--accent-color);
  color: var(--contrast-color);
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  border: 0;
  font-size: 16px;
  padding: 0 15px;
  margin: -1px;
  transition: 0.3s;
  border-radius: 0 4px 4px 0;
  line-height: 0;
}

.search-widget form button i {
  line-height: 0;
}

.search-widget form button:hover {
  background: color-mix(in srgb, var(--accent-color), transparent 20%);
}

.search-widget form:is(:focus-within) {
  border-color: var(--accent-color);
}

.categories-widget ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.categories-widget ul li {
  padding-bottom: 10px;
}

.categories-widget ul li:last-child {
  padding-bottom: 0;
}

.categories-widget ul a {
  color: color-mix(in srgb, var(--default-color), transparent 20%);
  transition: 0.3s;
}

.categories-widget ul a:hover {
  color: var(--accent-color);
}

.categories-widget ul a span {
  padding-left: 5px;
  color: color-mix(in srgb, var(--default-color), transparent 50%);
  font-size: 14px;
}

.recent-posts-widget .post-item {
  display: flex;
  margin-bottom: 15px;
}

.recent-posts-widget .post-item:last-child {
  margin-bottom: 0;
}

.recent-posts-widget .post-item img {
  width: 80px;
  margin-right: 15px;
}

.recent-posts-widget .post-item h4 {
  font-size: 15px;
  font-weight: bold;
  margin-bottom: 5px;
}

.recent-posts-widget .post-item h4 a {
  color: var(--default-color);
  transition: 0.3s;
}

.recent-posts-widget .post-item h4 a:hover {
  color: var(--accent-color);
}

.recent-posts-widget .post-item time {
  display: block;
  font-style: italic;
  font-size: 14px;
  color: color-mix(in srgb, var(--default-color), transparent 50%);
}

.tags-widget {
  margin-bottom: -10px;
}

.tags-widget ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.tags-widget ul li {
  display: inline-block;
}

.tags-widget ul a {
  color: color-mix(in srgb, var(--default-color), transparent 30%);
  font-size: 14px;
  padding: 6px 14px;
  margin: 0 6px 8px 0;
  border: 1px solid color-mix(in srgb, var(--default-color), transparent 60%);
  display: inline-block;
  transition: 0.3s;
}

.tags-widget ul a:hover {
  background: var(--accent-color);
  color: var(--contrast-color);
  border: 1px solid var(--accent-color);
}

.tags-widget ul a span {
  padding-left: 5px;
  color: color-mix(in srgb, var(--default-color), transparent 60%);
  font-size: 14px;
}
```

assets\css\profile.css
```css
body {
    font-family: "Poppins", sans-serif;
    background-color: #f6f9ff;
    margin: 0;
    padding: 0;
  }
  
  .profile-container {
    max-width: 800px;
    margin: 40px auto;
    background: #fff;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(65, 84, 241, 0.15);
  }
  
  h1 {
    color: #012970;
    text-align: center;
    font-size: 2rem;
    margin-bottom: 1.5rem;
  }
  
  .success-message,
  .error-message {
    text-align: center;
    padding: 1rem;
    margin-bottom: 1.5rem;
    border-radius: 8px;
    font-size: 0.95rem;
  }
  
  .success-message {
    color: #2ecc71;
    background-color: #eafaf1;
  }
  
  .error-message {
    color: #e74c3c;
    background-color: #fdecea;
  }
  
  .profile-card {
    border-top: 3px solid #4154f1;
    padding-top: 1rem;
  }
  
  .profile-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
  }
  
  .profile-header h2 {
    color: #012970;
    font-size: 1.5rem;
    font-weight: 600;
  }
  
  .role-badge {
    background-color: #4154f1;
    color: #fff;
    padding: 6px 12px;
    font-size: 0.85rem;
    border-radius: 20px;
    text-transform: capitalize;
  }
  
  .profile-photo {
    display: flex;
    justify-content: center;
    margin-bottom: 1.5rem;
  }
  
  .profile-photo img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 3px solid #4154f1;
    object-fit: cover;
    background-color: #fff;
  }
  
  .profile-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.2rem 2rem;
    margin-bottom: 2rem;
  }
  
  .detail-row {
    display: flex;
    flex-direction: column;
  }
  
  .detail-row label {
    font-weight: 500;
    color: #012970;
    margin-bottom: 0.3rem;
  }
  
  .detail-row span {
    color: #444;
    font-size: 0.95rem;
  }
  
  .profile-actions {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 1rem;
  }
  
  .button,
  .btn {
    padding: 0.7rem 1.2rem;
    border-radius: 8px;
    font-size: 0.95rem;
    text-decoration: none;
    font-weight: 500;
    transition: background-color 0.3s ease;
    cursor: pointer;
  }
  
  .button {
    background-color: #4154f1;
    color: #fff;
    border: none;
  }
  
  .button:hover {
    background-color: #2937cc;
  }
  
  .btn.btn-secondary {
    background-color: #6c757d;
    color: white;
  }
  
  .btn.btn-secondary:hover {
    background-color: #5a6268;
  }
  
  /* Responsive layout */
  @media (max-width: 600px) {
    .profile-details {
      grid-template-columns: 1fr;
    }
  }
  
```

assets\css\register.css
```css
body {
    font-family: "Poppins", sans-serif;
    background-color: #f6f9ff;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
  }
  
  .register-container {
    background: #fff;
    padding: 2.5rem;
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(65, 84, 241, 0.15);
    width: 100%;
    max-width: 450px;
    box-sizing: border-box;
  }
  
  h2 {
    color: #012970;
    text-align: center;
    margin-bottom: 2rem;
    font-weight: 600;
    font-size: 1.8rem;
  }
  
  .form-group {
    margin-bottom: 1.5rem;
  }
  
  label {
    display: block;
    margin-bottom: 0.5rem;
    color: #012970;
    font-weight: 500;
  }
  
  label span {
    color: red;
  }
  
  input[type="text"],
  input[type="email"],
  input[type="password"] {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #d6d6d6;
    border-radius: 8px;
    font-size: 1rem;
    background-color: #f8f9fa;
    transition: border-color 0.3s, box-shadow 0.3s;
    box-sizing: border-box;
  }
  
  input:focus {
    border-color: #4154f1;
    outline: none;
    box-shadow: 0 0 5px rgba(65, 84, 241, 0.2);
  }
  
  button[type="submit"] {
    width: 100%;
    padding: 0.75rem;
    background-color: #4154f1;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  button[type="submit"]:hover {
    background-color: #2937cc;
  }
  
  .auth-link {
    text-align: center;
    margin-top: 1.5rem;
    font-size: 0.95rem;
    color: #6c757d;
  }
  
  .auth-link a {
    color: #4154f1;
    text-decoration: none;
    font-weight: 500;
  }
  
  .auth-link a:hover {
    text-decoration: underline;
  }
  
  .success-message,
  .error-message {
    margin-bottom: 1rem;
    padding: 0.75rem;
    border-radius: 6px;
    font-size: 0.95rem;
    text-align: center;
    display: none; /* Enable this in PHP with JS or backend if needed */
  }
  
  .success-message {
    color: #2ecc71;
    background-color: #eafaf1;
  }
  
  .error-message {
    color: #e74c3c;
    background-color: #fdecea;
  }
  
```

assets\css\style.css
```css
/* Custom Styles */
body {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    font-family: "Open Sans", sans-serif;
    color: #444444;
}

.container {
    flex: 1;
}

/* Form Styles */
.form-container {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

/* Card Styles */
.card {
    transition: transform 0.2s;
    margin-bottom: 20px;
}

.card:hover {
    transform: translateY(-5px);
}

/* Table Styles */
.table-responsive {
    margin-top: 20px;
}

/* Button Styles */
.btn-custom {
    padding: 8px 20px;
    border-radius: 4px;
}

/* Profile Styles */
.profile-image {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
}

/* Dashboard Styles */
.dashboard-card {
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .form-container {
        padding: 15px;
    }
    
    .profile-image {
        width: 100px;
        height: 100px;
    }
}

/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/
a {
    color: #4154f1;
    text-decoration: none;
}

a:hover {
    color: #717ff5;
    text-decoration: none;
}

h1, h2, h3, h4, h5, h6 {
    font-family: "Nunito", sans-serif;
}

/*--------------------------------------------------------------
# Main
--------------------------------------------------------------*/
#main {
    margin-top: 60px;
    padding: 20px 30px;
    transition: all 0.3s;
}

@media (max-width: 1199px) {
    #main {
        padding: 20px;
    }
}

/*--------------------------------------------------------------
# Header
--------------------------------------------------------------*/
.header {
    transition: all 0.5s;
    z-index: 997;
    padding: 20px 0;
}

.header.header-scrolled {
    background: #fff;
    box-shadow: 0px 2px 20px rgba(1, 41, 112, 0.1);
    padding: 15px 0;
}

.header .logo {
    line-height: 0;
}

.header .logo img {
    max-height: 40px;
    margin-right: 6px;
}

.header .logo span {
    font-size: 30px;
    font-weight: 700;
    letter-spacing: 1px;
    color: #012970;
    font-family: "Nunito", sans-serif;
    margin-top: 3px;
}

/*--------------------------------------------------------------
# Navigation Menu
--------------------------------------------------------------*/
.navbar {
    padding: 0;
}

.navbar ul {
    margin: 0;
    padding: 0;
    display: flex;
    list-style: none;
    align-items: center;
}

.navbar li {
    position: relative;
}

.navbar a, .navbar a:focus {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 0 10px 30px;
    font-family: "Nunito", sans-serif;
    font-size: 16px;
    font-weight: 700;
    color: #013289;
    white-space: nowrap;
    transition: 0.3s;
}

.navbar a i, .navbar a:focus i {
    font-size: 12px;
    line-height: 0;
    margin-left: 5px;
}

.navbar a:hover, .navbar .active, .navbar .active:focus, .navbar li:hover > a {
    color: #4154f1;
}

/*--------------------------------------------------------------
# Footer
--------------------------------------------------------------*/
.footer {
    background: #f6f9ff;
    padding: 0 0 30px 0;
    font-size: 14px;
}

.footer .footer-top {
    background: white;
    padding: 60px 0 30px 0;
}

.footer .footer-top .footer-info {
    margin-bottom: 30px;
}

.footer .footer-top .footer-info .logo {
    line-height: 0;
    margin-bottom: 15px;
}

.footer .footer-top .footer-info .logo span {
    font-size: 30px;
    font-weight: 700;
    letter-spacing: 1px;
    color: #012970;
    font-family: "Nunito", sans-serif;
    margin-top: 3px;
}

.footer .footer-top .footer-info p {
    font-size: 14px;
    line-height: 24px;
    margin-bottom: 0;
    font-family: "Nunito", sans-serif;
}

.footer .copyright {
    text-align: center;
    padding-top: 30px;
    color: #012970;
}

/*--------------------------------------------------------------
# Back to top button
--------------------------------------------------------------*/
.back-to-top {
    position: fixed;
    visibility: hidden;
    opacity: 0;
    right: 15px;
    bottom: 15px;
    z-index: 99999;
    background: #4154f1;
    width: 40px;
    height: 40px;
    border-radius: 4px;
    transition: all 0.4s;
}

.back-to-top i {
    font-size: 24px;
    color: #fff;
    line-height: 0;
}

.back-to-top:hover {
    background: #6776f4;
    color: #fff;
}

.back-to-top.active {
    visibility: visible;
    opacity: 1;
}

/*--------------------------------------------------------------
# Alert Styles
--------------------------------------------------------------*/
.alert {
    border: none;
    border-radius: 4px;
    padding: 15px;
    margin-bottom: 20px;
}

.alert-success {
    background-color: #d1e7dd;
    color: #0f5132;
}

.alert-danger {
    background-color: #f8d7da;
    color: #842029;
}

.alert-warning {
    background-color: #fff3cd;
    color: #664d03;
}

.alert-info {
    background-color: #cff4fc;
    color: #055160;
} 
```

assets\css\update_profile.css
```css
/* Reset & base */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: "Poppins", sans-serif;
  background-color: #f6f9ff;
  color: #444;
}

/* Container */
.container {
  width: 90%;
  max-width: 900px;
  margin: 3rem auto;
  background: #fff;
  padding: 2rem;
  border-radius: 12px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

/* Header */
h1 {
  text-align: center;
  color: #012970;
  margin-bottom: 1.5rem;
  font-size: 2rem;
}

/* Form */
form {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

label {
  font-size: 1rem;
  font-weight: 500;
  color: #012970;
}

input[type="text"],
input[type="email"],
input[type="date"],
input[type="file"] {
  width: 100%;
  padding: 1rem;
  font-size: 1rem;
  border: 1px solid #d6d6d6;
  border-radius: 8px;
  background-color: #f8f9fa;
  transition: border-color 0.3s, box-shadow 0.3s;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="date"]:focus {
  border-color: #4154f1;
  box-shadow: 0 0 5px rgba(65, 84, 241, 0.2);
  outline: none;
}

/* Button */
button[type="submit"] {
  background-color: #4154f1;
  color: white;
  padding: 0.75rem;
  border: none;
  border-radius: 8px;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
  background-color: #2937cc;
}

/* Back to Dashboard */
.btn-secondary {
  display: inline-block;
  margin-top: 2rem;
  background-color: #6c757d;
  color: white;
  padding: 0.75rem 1.5rem;
  text-decoration: none;
  border-radius: 8px;
  font-weight: 600;
  transition: background-color 0.3s ease;
}

.btn-secondary:hover {
  background-color: #5a636d;
}

/* Success & Error Messages */
.error-message,
.success-message {
  padding: 1rem;
  border-radius: 8px;
  margin-bottom: 2rem;
  text-align: center;
}

.error-message {
  background-color: #f8d7da;
  color: #721c24;
}

.success-message {
  background-color: #d4edda;
  color: #155724;
}

/* Responsive */
@media (max-width: 768px) {
  .container {
    padding: 1.5rem;
  }

  h1 {
    font-size: 1.8rem;
  }

  button[type="submit"] {
    font-size: 1rem;
  }
}
```

assets\css\userdashboard.css
```css
/* Reset & base */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: "Poppins", sans-serif;
  background-color: #f6f9ff;
  color: #444;
}

/* Navbar */
.navbar {
  background-color: #4154f1;
  padding: 1rem 0;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.navbar .container {
  width: 90%;
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.logo a {
  color: #fff;
  font-size: 1.5rem;
  font-weight: 600;
  text-decoration: none;
}

.nav-links {
  list-style: none;
  display: flex;
  gap: 1.5rem;
}

.nav-links a {
  color: #fff;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s ease;
}

.nav-links a:hover {
  color: #cfd3ff;
}

/* Main dashboard */
.dashboard {
  width: 90%;
  max-width: 1000px;
  margin: 2rem auto;
  background: #fff;
  padding: 2rem;
  border-radius: 12px;
  box-shadow: 0 0 15px rgba(65, 84, 241, 0.1);
}

.profile-section {
  text-align: center;
}

.profile-section h1 {
  font-size: 2rem;
  color: #012970;
  margin-bottom: 1rem;
}

.profile-photo-container {
  margin: 1.5rem 0;
}

.profile-photo {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid #4154f1;
  background-color: #fff;
}

.user-details p {
  font-size: 1rem;
  margin: 0.5rem 0;
}

.actions {
  margin-top: 1.5rem;
}

.actions .btn {
  background-color: #4154f1;
  color: #fff;
  padding: 0.7rem 1.2rem;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 500;
  transition: background-color 0.3s ease;
}

.actions .btn:hover {
  background-color: #2937cc;
}

/* Responsive */
@media (max-width: 768px) {
  .nav-links {
    flex-direction: column;
    gap: 1rem;
  }

  .dashboard {
    padding: 1.5rem;
  }
}
```

assets\js\login.js
```js
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
```

assets\js\main.js
```js
/**
* Template Name: FlexStart
* Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
* Updated: Nov 01 2024 with Bootstrap v5.3.3
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

(function() {
  "use strict";

  /**
   * Apply .scrolled class to the body as the page is scrolled down
   */
  function toggleScrolled() {
    const selectBody = document.querySelector('body');
    const selectHeader = document.querySelector('#header');
    if (!selectHeader.classList.contains('scroll-up-sticky') && !selectHeader.classList.contains('sticky-top') && !selectHeader.classList.contains('fixed-top')) return;
    window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
  }

  document.addEventListener('scroll', toggleScrolled);
  window.addEventListener('load', toggleScrolled);

  /**
   * Mobile nav toggle
   */
  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

  function mobileNavToogle() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    mobileNavToggleBtn.classList.toggle('bi-list');
    mobileNavToggleBtn.classList.toggle('bi-x');
  }
  if (mobileNavToggleBtn) {
    mobileNavToggleBtn.addEventListener('click', mobileNavToogle);
  }

  /**
   * Hide mobile nav on same-page/hash links
   */
  document.querySelectorAll('#navmenu a').forEach(navmenu => {
    navmenu.addEventListener('click', () => {
      if (document.querySelector('.mobile-nav-active')) {
        mobileNavToogle();
      }
    });

  });

  /**
   * Toggle mobile nav dropdowns
   */
  document.querySelectorAll('.navmenu .toggle-dropdown').forEach(navmenu => {
    navmenu.addEventListener('click', function(e) {
      e.preventDefault();
      this.parentNode.classList.toggle('active');
      this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
      e.stopImmediatePropagation();
    });
  });

  /**
   * Scroll top button
   */
  let scrollTop = document.querySelector('.scroll-top');

  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
    }
  }
  scrollTop.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  window.addEventListener('load', toggleScrollTop);
  document.addEventListener('scroll', toggleScrollTop);

  /**
   * Animation on scroll function and init
   */
  function aosInit() {
    AOS.init({
      duration: 600,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  }
  window.addEventListener('load', aosInit);

  /**
   * Initiate glightbox
   */
  const glightbox = GLightbox({
    selector: '.glightbox'
  });

  /**
   * Initiate Pure Counter
   */
  new PureCounter();

  /**
   * Frequently Asked Questions Toggle
   */
  document.querySelectorAll('.faq-item h3, .faq-item .faq-toggle').forEach((faqItem) => {
    faqItem.addEventListener('click', () => {
      faqItem.parentNode.classList.toggle('faq-active');
    });
  });

  /**
   * Init isotope layout and filters
   */
  document.querySelectorAll('.isotope-layout').forEach(function(isotopeItem) {
    let layout = isotopeItem.getAttribute('data-layout') ?? 'masonry';
    let filter = isotopeItem.getAttribute('data-default-filter') ?? '*';
    let sort = isotopeItem.getAttribute('data-sort') ?? 'original-order';

    let initIsotope;
    imagesLoaded(isotopeItem.querySelector('.isotope-container'), function() {
      initIsotope = new Isotope(isotopeItem.querySelector('.isotope-container'), {
        itemSelector: '.isotope-item',
        layoutMode: layout,
        filter: filter,
        sortBy: sort
      });
    });

    isotopeItem.querySelectorAll('.isotope-filters li').forEach(function(filters) {
      filters.addEventListener('click', function() {
        isotopeItem.querySelector('.isotope-filters .filter-active').classList.remove('filter-active');
        this.classList.add('filter-active');
        initIsotope.arrange({
          filter: this.getAttribute('data-filter')
        });
        if (typeof aosInit === 'function') {
          aosInit();
        }
      }, false);
    });

  });

  /**
   * Init swiper sliders
   */
  function initSwiper() {
    document.querySelectorAll(".init-swiper").forEach(function(swiperElement) {
      let config = JSON.parse(
        swiperElement.querySelector(".swiper-config").innerHTML.trim()
      );

      if (swiperElement.classList.contains("swiper-tab")) {
        initSwiperWithCustomPagination(swiperElement, config);
      } else {
        new Swiper(swiperElement, config);
      }
    });
  }

  window.addEventListener("load", initSwiper);

  /**
   * Correct scrolling position upon page load for URLs containing hash links.
   */
  window.addEventListener('load', function(e) {
    if (window.location.hash) {
      if (document.querySelector(window.location.hash)) {
        setTimeout(() => {
          let section = document.querySelector(window.location.hash);
          let scrollMarginTop = getComputedStyle(section).scrollMarginTop;
          window.scrollTo({
            top: section.offsetTop - parseInt(scrollMarginTop),
            behavior: 'smooth'
          });
        }, 100);
      }
    }
  });

  /**
   * Navmenu Scrollspy
   */
  let navmenulinks = document.querySelectorAll('.navmenu a');

  function navmenuScrollspy() {
    navmenulinks.forEach(navmenulink => {
      if (!navmenulink.hash) return;
      let section = document.querySelector(navmenulink.hash);
      if (!section) return;
      let position = window.scrollY + 200;
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        document.querySelectorAll('.navmenu a.active').forEach(link => link.classList.remove('active'));
        navmenulink.classList.add('active');
      } else {
        navmenulink.classList.remove('active');
      }
    })
  }
  window.addEventListener('load', navmenuScrollspy);
  document.addEventListener('scroll', navmenuScrollspy);

})();
```

config\auth.php
```php
<?php
// Authentication configuration
return [
    // Session settings
    'session' => [
        'timeout' => 3600, // 1 hour inactivity timeout
        'name' => 'secure_session',
        'cookie_params' => [
            'lifetime' => 0,
            'path' => '/',
            'domain' => '',
            'secure' => true, // Enable in production (HTTPS)
            'httponly' => true,
            'samesite' => 'Strict'
        ]
    ],
    
    // Password requirements
    'password' => [
        'min_length' => 8,
        'require_numbers' => true,
        'require_special_chars' => true
    ],
    
    // Admin protection
    'admin' => [
        'ip_whitelist' => [], // Add trusted IPs if needed
        '2fa_required' => false // Enable for production
    ]
];
```

config\db.php
```php
<?php
// db.php


$host = 'localhost';          // Database host
$dbname = 'gestion_user';     // Database name
$username = 'root';           // MySQL username (default is 'root' for XAMPP)
$password = '';               // MySQL password (empty by default on XAMPP)
$charset = 'utf8mb4';         // Charset for DB connection

// Create DSN for PDO
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

// Set PDO options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // Fetch as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                   // Use native prepared statements
];

try {
    // Create PDO instance
    global $pdo;
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    error_log('Database Connection Error: ' . $e->getMessage());
    // Avoid displaying DB errors to users
    exit('A database error occurred. Please try again later.');
}

// Optional: Load auth config if available
$authConfigPath = __DIR__ . '/auth.php';
if (file_exists($authConfigPath)) {
    $authConfig = require $authConfigPath;
    $config = array_merge($config ?? [], $authConfig);
}
?>
```

config\schema.sql
```sql
-- Drop the table if it exists
DROP TABLE IF EXISTS `user`;

-- Create the user table
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `profile_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci; 
```

controller\.env
```env

```

controller\delete_user.php
```php
// delete_user.php

<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Prepare the delete query
$stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
$stmt->execute([$user_id]);

// Logout after deletion
session_unset();
session_destroy();

echo "Your account has been deleted.";
echo "<a href='index.php'>Go to Login Page</a>";
?>
```

controller\logout.php
```php
// logout.php

<?php
session_start();
session_unset();
session_destroy();
header('Location: index.php');
exit;
?>
```

controller\UserController.php
```php
<?php

class UserController {
    private $pdo;
    private $template_dir;

    public function __construct($pdo, $template_dir = null) {
        $this->pdo = $pdo;
        $this->template_dir = $template_dir ?? __DIR__ . '/front-office/';
    }

    public function login($email, $password) {
        $email = trim($email);
        $password = trim($password);
    
        if (empty($email) || empty($password)) {
            $_SESSION['error_message'] = "Please enter email and password!";
            header('Location: index.php?page=login');
            exit;
        }
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_message'] = "Invalid email format!";
            header('Location: index.php?page=login');
            exit;
        }
    
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
    
        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['error_message'] = "Invalid email or password!";
            header('Location: index.php?page=login');
            exit;
        }
    
        // Update user status to 'active' upon successful login
        $stmt = $this->pdo->prepare("UPDATE user SET status = 'active' WHERE user_id = ?");
        $stmt->execute([$user['user_id']]);
    
        // Set session variables
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
    
        // Redirect based on user role
        if ($user['role'] === 'admin') {
            header('Location: index.php?page=admin_dashboard');
        } else {
            header('Location: index.php?page=userdashboard');
        }
        exit;
    }    
    
    
    public function register($username, $email, $password, $first_name = '', $last_name = '', $role = 'user') {
        if (empty($username) || empty($email) || empty($password)) {
            $_SESSION['error_message'] = "All fields are required!";
            header("Location: index.php?page=register");
            exit;
        }
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_message'] = "Invalid email format!";
            header("Location: index.php?page=register");
            exit;
        }
    
        if (strlen($password) < 6) {
            $_SESSION['error_message'] = "Password must be at least 6 characters!";
            header("Location: index.php?page=register");
            exit;
        }
    
        $stmt = $this->pdo->prepare("SELECT email FROM user WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $_SESSION['error_message'] = "Email already registered!";
            header("Location: index.php?page=register");
            exit;
        }
    
        if ($role === 'admin' && (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin')) {
            $role = 'user';
        }
    
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO user (username, email, password, first_name, last_name, role) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$username, $email, $hashedPassword, $first_name, $last_name, $role]);
    
            // Fetch the newly created user
            $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
    
            if ($user) {
                // Set session variables
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
    
                // Update user status to 'active'
                $stmt = $this->pdo->prepare("UPDATE user SET status = 'active' WHERE user_id = ?");
                $stmt->execute([$user['user_id']]);
    
                // Redirect based on user role
                if ($user['role'] === 'admin') {
                    header('Location: index.php?page=admin_dashboard');
                } else {
                    header('Location: index.php?page=userdashboard');
                }
                exit;
            } else {
                $_SESSION['error_message'] = "Registration failed. Please try again.";
                header("Location: index.php?page=register");
                exit;
            }
        } catch (PDOException $e) {
            error_log("Registration failed: " . $e->getMessage());
            $_SESSION['error_message'] = "Registration failed. Please try again.";
            header("Location: index.php?page=register");
            exit;
        }
    }
    

    public function adminDashboard() {
        if ($_SESSION['role'] !== 'admin') {
            header('Location: index.php?page=login');
            exit;
        }

        $totalUsers = $this->pdo->query("SELECT COUNT(*) FROM user")->fetchColumn();
        $activeUsers = $totalUsers;
        $newUsers = $totalUsers;

        $users = $this->pdo->query("SELECT * FROM user ORDER BY user_id DESC")->fetchAll();
        include __DIR__ . '/../view/admindashboard.php';
    }

    public function userDashboard() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
            header("Location: index.php?page=login");
            exit;
        }

        $userData = [
            'username' => $_SESSION['username'],
            'email' => $_SESSION['email']
        ];

        include __DIR__ . '/../view/front-office/dashboard.php';
    }

    public function createUser($data) {
        if ($_SESSION['role'] !== 'admin') {
            return ['error' => 'Permission denied'];
        }

        $stmt = $this->pdo->prepare("
            INSERT INTO user (username, email, password, role) 
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['username'],
            $data['email'],
            password_hash($data['password'], PASSWORD_BCRYPT),
            $data['role'] ?? 'user'
        ]);

        return ['success' => 'User created'];
    }

    public function getUsers($filters = []) {
        $where = [];
        $params = [];

        if (!empty($filters['role'])) {
            $where[] = "role = ?";
            $params[] = $filters['role'];
        }

        $sql = "SELECT user_id, username, email, role FROM user";
        if ($where) {
            $sql .= " WHERE " . implode(' AND ', $where);
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function updateUser($id, $data) {
        $allowed = ['username', 'email', 'role'];
        $set = [];
        $params = [];

        foreach ($data as $key => $val) {
            if (in_array($key, $allowed)) {
                $set[] = "$key = ?";
                $params[] = $val;
            }
        }

        if (empty($set)) return false;

        $params[] = $id;
        $stmt = $this->pdo->prepare("UPDATE user SET " . implode(', ', $set) . " WHERE user_id = ?");
        return $stmt->execute($params);
    }
    public function profile() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit;
        }
    
        // Fetch user details for the profile page
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();
    
        if (!$user) {
            header("Location: index.php?page=login");
            exit;
        }
    
        // Create a view instance
        $view = new View($this->template_dir);
    
        // Prepare view data
        $view_data = [
            'username' => $user['username'],
            'email' => $user['email'],
            'phone' => $user['phone'] ?? 'Not set',
            'created_at' => $user['created_at'] ? date("F Y", strtotime($user['created_at'])) : 'Not available',
            'profile_photo' => $user['profile_photo'] ?? '',
            'error_message' => $_SESSION['error_message'] ?? '',
            'success_message' => $_SESSION['success_message'] ?? ''
        ];
    
        // Clear session messages
        unset($_SESSION['error_message']);
        unset($_SESSION['success_message']);
    
        // Display the profile template
        $view->display('profile.php', $view_data);
    }
    

    public function deleteUserAction($id) {
        // Check if the user is trying to delete their own account
        if ($_SESSION['user_id'] == $id) {
            throw new Exception("You cannot delete your own account.");
        }
    
        try {
            // Call the deleteUser method to delete the user from the database
            $this->deleteUser($id);
            // After deleting, redirect to the admin dashboard
            header('Location: index.php?page=admindashboard');
            exit;
        } catch (Exception $e) {
            // If there's an error, display it
            echo $e->getMessage();
        }
    }
    
    public function deleteUser($id) {
        // Prepare the DELETE query
        $stmt = $this->pdo->prepare("DELETE FROM user WHERE user_id = ?");
        return $stmt->execute([$id]);
    }
    

    

    private function verifyPassword(string $inputPassword, string $hashedPassword): bool {
        return password_verify($inputPassword, $hashedPassword);
    }

    public function changePassword() {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error_message'] = "You must be logged in to change your password.";
            header("Location: index.php?page=login");
            exit;
        }

        // Handle form submission (POST request)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $current_password = $_POST['current_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            // Fetch the current password from the database
            $stmt = $this->pdo->prepare("SELECT password FROM user WHERE user_id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $user = $stmt->fetch();

            // Check if the current password matches the one in the database
            if (!password_verify($current_password, $user['password'])) {
                $_SESSION['error_message'] = "Current password is incorrect.";
            }
            // Check if the new passwords match
            elseif ($new_password !== $confirm_password) {
                $_SESSION['error_message'] = "New passwords do not match.";
            } 
            // Check if the new password meets your criteria (you can customize this)
            elseif (strlen($new_password) < 6) {
                $_SESSION['error_message'] = "New password must be at least 6 characters long.";
            } 
            else {
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the password in the database
                $stmt = $this->pdo->prepare("UPDATE user SET password = ? WHERE user_id = ?");
                $stmt->execute([$hashed_password, $_SESSION['user_id']]);

                // Set a success message and redirect to the change password page
                $_SESSION['success_message'] = "Password changed successfully!";
                header("Location: index.php?page=change_password");
                exit;
            }
        }

        // If it's a GET request, render the change password page with any error/success messages
        $view = new View(__DIR__ . '/../view/front-office/');
        $view->display('change_password.html', [
            'error_message' => $_SESSION['error_message'] ?? '',
            'success_message' => $_SESSION['success_message'] ?? ''
        ]);

        // Clear messages after displaying
        unset($_SESSION['error_message'], $_SESSION['success_message']);
    }
    public function logout() {
        // Update user status to 'inactive' when they log out
        if (isset($_SESSION['user_id'])) {
            $stmt = $this->pdo->prepare("UPDATE user SET status = 'inactive' WHERE user_id = ?");
            $stmt->execute([$_SESSION['user_id']]);
        }
    
        // Clear session data
        session_unset();
        session_destroy();
    
        // Redirect to login page
        header('Location: index.php?page=login');
        exit;
    }
    public function addUser() {
        // 1. Verify admin privileges and session
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['error_message'] = "Access denied: Admin privileges required";
            header("Location: index.php?page=login");
            exit;
        }
    
        // 2. Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // CSRF protection
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['error_message'] = "Invalid CSRF token";
                header("Location: index.php?page=add_user");
                exit;
            }
    
            // Sanitize inputs
            $username = trim(htmlspecialchars($_POST['username']));
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $role = in_array($_POST['role'], ['user', 'admin']) ? $_POST['role'] : 'user';
    
            // Validate inputs
            $errors = [];
            if (empty($username) || strlen($username) < 3) {
                $errors[] = "Username must be at least 3 characters";
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format";
            }
            if (strlen($password) < 6) {
                $errors[] = "Password must be at least 6 characters";
            }
    
            if (!empty($errors)) {
                $_SESSION['error_message'] = implode("<br>", $errors);
                header("Location: index.php?page=add_user");
                exit;
            }
    
            // Check for existing email
            $stmt = $this->pdo->prepare("SELECT user_id FROM user WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $_SESSION['error_message'] = "Email already registered";
                header("Location: index.php?page=add_user");
                exit;
            }
    
            // Insert into database
            try {
                $stmt = $this->pdo->prepare("
                    INSERT INTO user (username, email, password, role, created_at) 
                    VALUES (?, ?, ?, ?, NOW())
                ");
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $stmt->execute([$username, $email, $hashedPassword, $role]);
    
                $_SESSION['success_message'] = "User added successfully!";
                header("Location: index.php?page=admindashboard");
                exit;
            } catch (PDOException $e) {
                error_log("User creation failed: " . $e->getMessage());
                $_SESSION['error_message'] = "Database error. Please try again.";
                header("Location: index.php?page=add_user");
                exit;
            }
        }
    
        // 3. Generate CSRF token and render form for GET requests
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        include __DIR__ . '/../view/front-office/add_user.html';
    }
    public function exportUsers() {
        require_once __DIR__ . '/../config/db.php';
        global $pdo;
    
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=users.csv');
    
        $stmt = $pdo->query("SELECT username, email, role FROM user");
        $users = $stmt->fetchAll();
    
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Username', 'Email', 'Role']); // headers
    
        foreach ($users as $user) {
            fputcsv($output, [$user['username'], $user['email'], $user['role']]);
        }
    
        fclose($output);
        exit;
    }
    public function editUser() {
        require_once __DIR__ . '/../config/db.php';
        global $pdo;
    
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "User ID is missing.";
            return;
        }
    
        // Fetch user by ID
        $stmt = $pdo->prepare("SELECT * FROM user WHERE user_id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();
    
        if (!$user) {
            echo "User not found.";
            return;
        }
    
        // If form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $role = $_POST['role'];
    
            $stmt = $pdo->prepare("UPDATE user SET username = ?, email = ?, role = ? WHERE user_id = ?");
            $stmt->execute([$username, $email, $role, $id]);
    
            header('Location: index.php?page=admindashboard');
            exit;
        }
    
        include __DIR__ . '/../view/front-office/edit_user.html';
    }
   // controller/UserController.php

public function showAdminDashboard() {
    // Assuming $pdo is your database connection
    // Check if the logged-in user is an admin
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: index.php?page=login");
        exit;
    }

    // Fetch all users from the database
    $stmt = $this->pdo->prepare("SELECT * FROM user");
    $stmt->execute();
    $users = $stmt->fetchAll();

    $userRows = ''; // Initialize the variable to store the table rows

    // Loop through each user and create a table row
    foreach ($users as $user) {
        $userRows .= '
        <tr>
            <td>' . htmlspecialchars($user['user_id']) . '</td>
            <td>' . htmlspecialchars($user['username']) . '</td>
            <td>' . htmlspecialchars($user['email']) . '</td>
            <td>' . htmlspecialchars($user['role']) . '</td>
            <td>
                <a href="index.php?page=edit_user&id=' . $user['user_id'] . '" class="btn btn-primary">Edit</a>
                <a href="index.php?page=delete_user&id=' . $user['user_id'] . '" class="btn btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a>
            </td>
        </tr>';
    }

    // Load the HTML template for the admin dashboard
    $html = file_get_contents(__DIR__ . '/../view/admin_dashboard.html'); // Adjust path as needed

    // Replace the placeholder with the actual user rows
    $html = str_replace('{{user_rows}}', $userRows, $html);

    // Output the final HTML
    echo $html;
}

    
    
}
```

core\Router.php
```php
<?php
class Router {
    private $routes = [];
    
    /**
     * Register a route
     * 
     * @param string $page Route name
     * @param callable $callback Function to call when this route is matched
     */
    public function register($page, $callback) {
        $this->routes[$page] = $callback;
    }
    
    /**
     * Dispatch the request to the appropriate route handler
     * 
     * @param string $page Route name to dispatch
     * @return mixed Result of the route handler
     */
    public function dispatch($page) {
        if (isset($this->routes[$page])) {
            return call_user_func($this->routes[$page]);
        } else {
            // Default route or 404
            header("HTTP/1.0 404 Not Found");
            echo "Page not found";
            exit;
        }
    }
}
?>
```

middleware\auth_admin.php
```php
<?php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['error'] = "Admin access required";
    header("Location: index.php?page=login");
    exit;
}
```

model\UserModel.php
```php
<?php
class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Register new user
    public function register($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $hashedPassword]);
    }

    // Get user by email (for login)
    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    // Update user profile
    public function updateUser($id, $username, $email) {
        // Change 'name' to 'username' for consistency
        $stmt = $this->pdo->prepare("UPDATE user SET username = ?, email = ? WHERE id = ?");
        return $stmt->execute([$username, $email, $id]);
    }

    // Delete a user
    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM user WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Get all users (for dashboard, maybe admin only)
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM user");
        return $stmt->fetchAll();
    }

    // Get user by ID
    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
```

public\index.php
```php
<?php
session_start();

// Include necessary files
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controller/UserController.php';
require_once __DIR__ . '/../view/View.php'; // Templating helper

// Instantiate the controller and view
$controller = new UserController($pdo);
$view = new View(__DIR__ . '/../view/front-office/');

// Get the requested page
$page = $_GET['page'] ?? 'login';
$page = basename($page); // Prevent path traversal (ensures safety)

// Handle delete_user action
if ($page == 'delete_user') {
    // Check if the 'id' parameter is set in the URL
    $id = $_GET['id'] ?? null;
    if ($id) {
        // Call the deleteUserAction method from the controller to delete the user
        $controller->deleteUserAction($id);
    } else {
        echo "User ID is missing.";
    }
} else {

switch ($page) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password']);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error_message'] = 'Invalid email format.';
                header('Location: index.php?page=login');
                exit;
            }

            $controller->login($email, $password);
        } else {
            $view_data = ['error_message' => ''];

            if (isset($_SESSION['error_message'])) {
                $view_data['error_message'] = '<div class="error-message">' .
                    htmlspecialchars($_SESSION['error_message']) .
                    '</div>';
                unset($_SESSION['error_message']);
            }

            $view->display('login.php', $view_data);
        }
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Get and sanitize form data
                $username = htmlspecialchars(trim($_POST['username'] ?? ''));
                $first_name = htmlspecialchars(trim($_POST['first_name'] ?? ''));
                $last_name = htmlspecialchars(trim($_POST['last_name'] ?? ''));
                $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
                $password = trim($_POST['password'] ?? '');
                $confirm_password = trim($_POST['confirm_password'] ?? '');
                $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
                $dob = htmlspecialchars(trim($_POST['dob'] ?? ''));
                $terms = isset($_POST['terms']) ? true : false;

                // Validate required fields
                if (empty($username) || empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
                    $view_data = [
                        'error_message' => '<div class="alert alert-danger">All required fields must be filled.</div>',
                        'success_message' => ''
                    ];
                    $view->display('register.php', $view_data);
                    exit;
                }

                // Validate email format
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $view_data = [
                        'error_message' => '<div class="alert alert-danger">Invalid email format.</div>',
                        'success_message' => ''
                    ];
                    $view->display('register.php', $view_data);
                    exit;
                }

                // Validate password
                if ($password !== $confirm_password) {
                    $view_data = [
                        'error_message' => '<div class="alert alert-danger">Passwords do not match.</div>',
                        'success_message' => ''
                    ];
                    $view->display('register.php', $view_data);
                    exit;
                }

                if (strlen($password) < 6) {
                    $view_data = [
                        'error_message' => '<div class="alert alert-danger">Password must be at least 6 characters long.</div>',
                        'success_message' => ''
                    ];
                    $view->display('register.php', $view_data);
                    exit;
                }

                // Validate terms acceptance
                if (!$terms) {
                    $view_data = [
                        'error_message' => '<div class="alert alert-danger">You must agree to the terms and conditions.</div>',
                        'success_message' => ''
                    ];
                    $view->display('register.php', $view_data);
                    exit;
                }

                // Check if email already exists
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->fetchColumn() > 0) {
                    $view_data = [
                        'error_message' => '<div class="alert alert-danger">Email already exists.</div>',
                        'success_message' => ''
                    ];
                    $view->display('register.php', $view_data);
                    exit;
                }

                // Check if username already exists
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE username = ?");
                $stmt->execute([$username]);
                if ($stmt->fetchColumn() > 0) {
                    $view_data = [
                        'error_message' => '<div class="alert alert-danger">Username already exists.</div>',
                        'success_message' => ''
                    ];
                    $view->display('register.php', $view_data);
                    exit;
                }

                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insert the new user
                $stmt = $pdo->prepare("INSERT INTO user (username, first_name, last_name, email, password, phone, dob, role, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, 'user', 'active', NOW())");
                
                // Execute the statement and check for errors
                if ($stmt->execute([$username, $first_name, $last_name, $email, $hashed_password, $phone, $dob])) {
                    $view_data = [
                        'error_message' => '',
                        'success_message' => '<div class="alert alert-success">Registration successful! Please login.</div>'
                    ];
                    $view->display('login.php', $view_data);
                    exit;
                } else {
                    throw new PDOException("Failed to execute insert statement");
                }
            } catch (PDOException $e) {
                // Log the error for debugging
                error_log("Registration Error: " . $e->getMessage());
                error_log("SQL State: " . $e->getCode());
                error_log("Error Info: " . print_r($stmt->errorInfo(), true));
                
                $view_data = [
                    'error_message' => '<div class="alert alert-danger">Registration failed. Please try again. Error: ' . $e->getMessage() . '</div>',
                    'success_message' => ''
                ];
                $view->display('register.php', $view_data);
                exit;
            }
        } else {
            $view_data = [
                'error_message' => '',
                'success_message' => ''
            ];
            $view->display('register.php', $view_data);
        }
        break;

    case 'admindashboard':
        if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
            $controller->adminDashboard();
        } else {
            header("Location: index.php?page=login");
            exit;
        }
        break;

    case 'userdashboard':
        if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'user') {
            $controller->userDashboard();
        } else {
            header("Location: index.php?page=login");
            exit;
        }
        break;

    case 'update_role':
        $controller->updateUserRole();
        break;

    case 'logout':
        $controller->logout();
        break;

    // Future pages you'll add — example
    case 'profile':
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit;
        }
    
        // Fetch user data
        $stmt = $pdo->prepare("SELECT * FROM user WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();
    
        if (!$user) {
            $_SESSION['error_message'] = "User not found.";
            header("Location: index.php?page=login");
            exit;
        }
    
        // Prepare view data
        $view_data = [
            'username' => htmlspecialchars($user['username']),
            'email' => htmlspecialchars($user['email']),
            'role' => htmlspecialchars($user['role']),
            'first_name' => htmlspecialchars($user['first_name']),
            'last_name' => htmlspecialchars($user['last_name']),
            'dob' => htmlspecialchars($user['dob'] ?? ''),
            'profile_photo' => htmlspecialchars($user['profile_photo'] ?? ''),
            'error_message' => '',
            'success_message' => ''
        ];
    
        if (isset($_SESSION['error_message'])) {
            $view_data['error_message'] = '<div class="message error-message">' .
                                         htmlspecialchars($_SESSION['error_message']) . '</div>';
            unset($_SESSION['error_message']);
        }
    
        if (isset($_SESSION['success_message'])) {
            $view_data['success_message'] = '<div class="message success-message">' .
                                           htmlspecialchars($_SESSION['success_message']) . '</div>';
            unset($_SESSION['success_message']);
        }
    
        // Render profile view
        $view->display('profile.php', $view_data);
        break;
    
    
        // Fetch user data
        $stmt = $pdo->prepare("SELECT * FROM user WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();
    
        if (!$user) {
            $_SESSION['error_message'] = "User not found.";
            header("Location: index.php?page=login");
            exit;
        }
    
        // Prepare view data
        $view_data = [
            'username' => htmlspecialchars($user['username']),
            'email' => htmlspecialchars($user['email']),
            'role' => htmlspecialchars($user['role']),
            'first_name' => htmlspecialchars($user['first_name']),
            'last_name' => htmlspecialchars($user['last_name']),
            'dob' => htmlspecialchars($user['dob'] ?? ''),
            'profile_photo' => htmlspecialchars($user['profile_photo'] ?? ''),
            'error_message' => '',
            'success_message' => ''
        ];
    
        if (isset($_SESSION['error_message'])) {
            $view_data['error_message'] = '<div class="message error-message">' .
                                         htmlspecialchars($_SESSION['error_message']) . '</div>';
            unset($_SESSION['error_message']);
        }
    
        if (isset($_SESSION['success_message'])) {
            $view_data['success_message'] = '<div class="message success-message">' .
                                           htmlspecialchars($_SESSION['success_message']) . '</div>';
            unset($_SESSION['success_message']);
        }
    
        // Render profile view
        $view->display('profile.php', $view_data);
        break;

        case 'add_user':
            $controller->addUser();
            break;
        case 'export_users':
            $controller->exportUsers();
            break;
            case 'edit_user':
                if (!isset($_GET['id'])) {
                    header('Location: index.php?page=admin_dashboard');
                    exit;
                }

                $userId = (int)$_GET['id'];

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    try {
                        $username = htmlspecialchars(trim($_POST['username'] ?? ''));
                        $first_name = htmlspecialchars(trim($_POST['first_name'] ?? ''));
                        $last_name = htmlspecialchars(trim($_POST['last_name'] ?? ''));
                        $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
                        $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
                        $dob = htmlspecialchars(trim($_POST['dob'] ?? ''));
                        $role = htmlspecialchars(trim($_POST['role'] ?? 'user'));
                        $status = htmlspecialchars(trim($_POST['status'] ?? 'active'));

                        // Validate required fields
                        if (empty($username) || empty($first_name) || empty($last_name) || empty($email)) {
                            throw new Exception('All required fields must be filled.');
                        }

                        // Validate email
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            throw new Exception('Invalid email format.');
                        }

                        // Check if email exists for other users
                        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE email = ? AND user_id != ?");
                        $stmt->execute([$email, $userId]);
                        if ($stmt->fetchColumn() > 0) {
                            throw new Exception('Email already exists.');
                        }

                        // Check if username exists for other users
                        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE username = ? AND user_id != ?");
                        $stmt->execute([$username, $userId]);
                        if ($stmt->fetchColumn() > 0) {
                            throw new Exception('Username already exists.');
                        }

                        // Update user
                        $stmt = $pdo->prepare("UPDATE user SET username = ?, first_name = ?, last_name = ?, email = ?, phone = ?, dob = ?, role = ?, status = ? WHERE user_id = ?");
                        $stmt->execute([$username, $first_name, $last_name, $email, $phone, $dob, $role, $status, $userId]);

                        $_SESSION['success_message'] = 'User updated successfully.';
                    } catch (Exception $e) {
                        $_SESSION['error_message'] = $e->getMessage();
                        header('Location: index.php?page=edit_user&id=' . $userId);
                    }
                } else {
                    // Fetch user data
                    $stmt = $pdo->prepare("SELECT * FROM user WHERE user_id = ?");
                    $stmt->execute([$userId]);
                    $user = $stmt->fetch();

                    if (!$user) {
                        $_SESSION['error_message'] = 'User not found.';
                        header('Location: index.php?page=admin_dashboard');
                        exit;
                    }

                    $view_data = ['user' => $user];
                    $view->display('edit_user.php', $view_data);
                }
                break;
            case 'delete_user':
                if (!isset($_GET['id'])) {
                    header('Location: index.php?page=admin_dashboard');
                    exit;
                }

                $userId = (int)$_GET['id'];

                try {
                    // Check if user exists
                    $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE user_id = ?");
                    $stmt->execute([$userId]);
                    if ($stmt->fetchColumn() == 0) {
                        throw new Exception('User not found.');
                    }

                    // Delete user
                    $stmt = $pdo->prepare("DELETE FROM user WHERE user_id = ?");
                    $stmt->execute([$userId]);

                    $_SESSION['success_message'] = 'User deleted successfully.';
                } catch (Exception $e) {
                    $_SESSION['error_message'] = $e->getMessage();
                }

                header('Location: index.php?page=admin_dashboard');
                exit;
                break;
            case 'update_profile':
                if (!isset($_SESSION['user_id'])) {
                    header("Location: index.php?page=login");
                    exit;
                }
            
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Get current user data
                    $stmt = $pdo->prepare("SELECT * FROM user WHERE user_id = ?");
                    $stmt->execute([$_SESSION['user_id']]);
                    $currentUser = $stmt->fetch();

                    // Sanitize and validate input
                    $username = htmlspecialchars(trim($_POST['username'] ?? $currentUser['username']));
                    $first_name = htmlspecialchars(trim($_POST['first_name'] ?? $currentUser['first_name']));
                    $last_name = htmlspecialchars(trim($_POST['last_name'] ?? $currentUser['last_name']));
                    $email = filter_var(trim($_POST['email'] ?? $currentUser['email']), FILTER_SANITIZE_EMAIL);
                    $phone = htmlspecialchars(trim($_POST['phone'] ?? $currentUser['phone']));
                    $dob = htmlspecialchars(trim($_POST['dob'] ?? $currentUser['dob']));

                    // Validate required fields
                    if (empty($username) || empty($first_name) || empty($last_name) || empty($email)) {
                        $_SESSION['error_message'] = 'All required fields must be filled.';
                        header('Location: index.php?page=update_profile');
                        exit;
                    }

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $_SESSION['error_message'] = 'Invalid email format.';
                        header('Location: index.php?page=update_profile');
                        exit;
                    }

                    // Check if email is being changed and if it already exists
                    if ($email !== $currentUser['email']) {
                        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE email = ? AND user_id != ?");
                        $stmt->execute([$email, $_SESSION['user_id']]);
                        if ($stmt->fetchColumn() > 0) {
                            $_SESSION['error_message'] = 'Email already exists.';
                            header('Location: index.php?page=update_profile');
                            exit;
                        }
                    }

                    // Check if username is being changed and if it already exists
                    if ($username !== $currentUser['username']) {
                        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE username = ? AND user_id != ?");
                        $stmt->execute([$username, $_SESSION['user_id']]);
                        if ($stmt->fetchColumn() > 0) {
                            $_SESSION['error_message'] = 'Username already exists.';
                            header('Location: index.php?page=update_profile');
                            exit;
                        }
                    }

                    // Handle profile photo upload if provided
                    $profile_photo = $currentUser['profile_photo'];
                    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
                        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                        $file_type = $_FILES['profile_photo']['type'];
                        
                        if (in_array($file_type, $allowed_types)) {
                            $upload_dir = __DIR__ . '/../uploads/';
                            if (!file_exists($upload_dir)) {
                                mkdir($upload_dir, 0777, true);
                            }
                            
                            $file_extension = pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION);
                            $new_filename = uniqid() . '.' . $file_extension;
                            $upload_path = $upload_dir . $new_filename;
                            
                            if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $upload_path)) {
                                // Delete old profile photo if exists
                                if ($currentUser['profile_photo'] && file_exists($upload_dir . $currentUser['profile_photo'])) {
                                    unlink($upload_dir . $currentUser['profile_photo']);
                                }
                                $profile_photo = $new_filename;
                            }
                        }
                    }

                    // Update user profile
                    try {
                        $stmt = $pdo->prepare("UPDATE user SET username = ?, first_name = ?, last_name = ?, email = ?, phone = ?, dob = ?, profile_photo = ? WHERE user_id = ?");
                        $stmt->execute([$username, $first_name, $last_name, $email, $phone, $dob, $profile_photo, $_SESSION['user_id']]);
                        
                        // Update session variables
                        $_SESSION['username'] = $username;
                        $_SESSION['email'] = $email;
                        
                        $_SESSION['success_message'] = 'Profile updated successfully!';
                        header('Location: index.php?page=profile');
                        exit;
                    } catch (PDOException $e) {
                        $_SESSION['error_message'] = 'Failed to update profile. Please try again.';
                        header('Location: index.php?page=update_profile');
                        exit;
                    }
                } else {
                    // Fetch current user data for the form
                    $stmt = $pdo->prepare("SELECT * FROM user WHERE user_id = ?");
                    $stmt->execute([$_SESSION['user_id']]);
                    $user = $stmt->fetch();

                    if (!$user) {
                        $_SESSION['error_message'] = 'User not found.';
                        header('Location: index.php?page=login');
                        exit;
                    }

                    $view_data = [
                        'user' => $user,
                        'error_message' => '',
                        'success_message' => ''
                    ];

                    if (isset($_SESSION['error_message'])) {
                        $view_data['error_message'] = '<div class="message error-message">' .
                            htmlspecialchars($_SESSION['error_message']) . '</div>';
                        unset($_SESSION['error_message']);
                    }

                    if (isset($_SESSION['success_message'])) {
                        $view_data['success_message'] = '<div class="message success-message">' .
                            htmlspecialchars($_SESSION['success_message']) . '</div>';
                        unset($_SESSION['success_message']);
                    }

                    $view->display('update_profile.php', $view_data);
                }
                break;
            
            
        case 'change_password':
            if (!isset($_SESSION['user_id'])) {
                header("Location: index.php?page=login");
                exit;
            }
        
            // Fetch current user data
            $stmt = $pdo->prepare("SELECT * FROM user WHERE user_id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $user = $stmt->fetch();
        
            if (!$user) {
                $_SESSION['error_message'] = "User not found.";
                header("Location: index.php?page=login");
                exit;
            }
        
            // Handle password change form submission
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $current_password = trim($_POST['current_password']);
                $new_password = trim($_POST['new_password']);
                $confirm_password = trim($_POST['confirm_password']);
        
                // Validate current password
                if (!password_verify($current_password, $user['password'])) {
                    $_SESSION['error_message'] = 'Current password is incorrect.';
                    header("Location: index.php?page=change_password");
                    exit;
                }
        
                // Validate new password and confirm match
                if ($new_password !== $confirm_password) {
                    $_SESSION['error_message'] = 'New passwords do not match.';
                    header("Location: index.php?page=change_password");
                    exit;
                }
        
                // Hash new password and update in the database
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        
                $stmt = $pdo->prepare("UPDATE user SET password = ? WHERE user_id = ?");
                $stmt->execute([$hashed_password, $_SESSION['user_id']]);
        
                $_SESSION['success_message'] = "Password updated successfully!";
                header("Location: index.php?page=profile");
                exit;
            }
        
            // Prepare view data
            $view_data = [
                'error_message' => '',
                'success_message' => ''
            ];
        
            if (isset($_SESSION['error_message'])) {
                $view_data['error_message'] = '<div class="message error-message">' .
                                              htmlspecialchars($_SESSION['error_message']) . '</div>';
                unset($_SESSION['error_message']);
            }
        
            if (isset($_SESSION['success_message'])) {
                $view_data['success_message'] = '<div class="message success-message">' .
                                                htmlspecialchars($_SESSION['success_message']) . '</div>';
                unset($_SESSION['success_message']);
            }
        
            // Render change password page
            $view->display('change_password.php', $view_data);
            break;
            case 'admin_dashboard':
                $controller->showAdminDashboard();
                break;

    case 'create_user':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $username = htmlspecialchars(trim($_POST['username'] ?? ''));
                $first_name = htmlspecialchars(trim($_POST['first_name'] ?? ''));
                $last_name = htmlspecialchars(trim($_POST['last_name'] ?? ''));
                $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
                $password = trim($_POST['password'] ?? '');
                $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
                $dob = htmlspecialchars(trim($_POST['dob'] ?? ''));
                $role = htmlspecialchars(trim($_POST['role'] ?? 'user'));
                $status = htmlspecialchars(trim($_POST['status'] ?? 'active'));

                // Validate required fields
                if (empty($username) || empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
                    throw new Exception('All required fields must be filled.');
                }

                // Validate email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception('Invalid email format.');
                }

                // Check if email exists
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->fetchColumn() > 0) {
                    throw new Exception('Email already exists.');
                }

                // Check if username exists
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE username = ?");
                $stmt->execute([$username]);
                if ($stmt->fetchColumn() > 0) {
                    throw new Exception('Username already exists.');
                }

                // Hash password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insert user
                $stmt = $pdo->prepare("INSERT INTO user (username, first_name, last_name, email, password, phone, dob, role, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$username, $first_name, $last_name, $email, $hashed_password, $phone, $dob, $role, $status]);

                $_SESSION['success_message'] = 'User created successfully.';
                header('Location: index.php?page=admin_dashboard');
                exit;
            } catch (Exception $e) {
                $_SESSION['error_message'] = $e->getMessage();
                header('Location: index.php?page=create_user');
                exit;
            }
        } else {
            $view->display('create_user.php');
        }
        break;

    case 'users':
        // Fetch all users
        $stmt = $pdo->prepare("SELECT * FROM user ORDER BY created_at DESC");
        $stmt->execute();
        $users = $stmt->fetchAll();

        $view_data = ['users' => $users];
        $view->display('users.php', $view_data);
        break;

    default:
        http_response_code(404);
        include __DIR__ . '/../view/404.php';
        break;
}

}
```

view\back-office\admin_create_user.php
```php
<!-- admin_create_user.php -->
<form method="post" action="index.php?page=register">
    <input type="text" name="username" required>
    <input type="email" name="email" required>
    <input type="password" name="password" required minlength="6">
    
    <!-- Only show role selector for admins -->
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <select name="role">
            <option value="user">Regular User</option>
            <option value="admin">Administrator</option>
        </select>
    <?php endif; ?>
    
    <button type="submit">Create User</button>
</form>
```

view\back-office\admin_dashboard.php
```php
<?php
$pageTitle = "Admin Dashboard";

// Fetch stats
$stmtActiveUsers = $pdo->prepare("SELECT COUNT(*) FROM user WHERE status = 'active'");
$stmtActiveUsers->execute();
$activeUsers = $stmtActiveUsers->fetchColumn();

$stmtAllUsers = $pdo->prepare("SELECT COUNT(*) FROM user");
$stmtAllUsers->execute();
$totalUsers = $stmtAllUsers->fetchColumn();

$stmtNewUsers = $pdo->prepare("SELECT COUNT(*) FROM user WHERE created_at >= NOW() - INTERVAL 1 DAY");
$stmtNewUsers->execute();
$newUsers = $stmtNewUsers->fetchColumn();

// Fetch recent users
$stmtRecentUsers = $pdo->prepare("SELECT * FROM user ORDER BY created_at DESC LIMIT 5");
$stmtRecentUsers->execute();
$recentUsers = $stmtRecentUsers->fetchAll();

// Generate recent users table HTML
$recentUsersTable = '';
foreach ($recentUsers as $user) {
    $recentUsersTable .= '
    <tr>
        <td>' . htmlspecialchars($user['user_id']) . '</td>
        <td>' . htmlspecialchars($user['username']) . '</td>
        <td>' . htmlspecialchars($user['email']) . '</td>
        <td><span class="badge bg-' . ($user['status'] == 'active' ? 'success' : 'warning') . '">' . htmlspecialchars($user['status']) . '</span></td>
        <td>
            <a href="/gestion_userv2/gestion_user/public/index.php?page=edit_user&id=' . $user['user_id'] . '" class="btn btn-sm btn-primary">Edit</a>
            <a href="/gestion_userv2/gestion_user/public/index.php?page=delete_user&id=' . $user['user_id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</a>
        </td>
    </tr>';
}

$content = '
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Admin Dashboard</h5>
                        <div class="row mt-4">
                            <div class="col-lg-3 col-md-6">
                                <div class="card info-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Users</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-people"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>' . $totalUsers . '</h6>
                                                <span class="text-success small pt-1 fw-bold">Users</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="card info-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Active Users</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-person-check"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>' . $activeUsers . '</h6>
                                                <span class="text-success small pt-1 fw-bold">Active</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="card info-card">
                                    <div class="card-body">
                                        <h5 class="card-title">New Users Today</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-person-plus"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>' . $newUsers . '</h6>
                                                <span class="text-success small pt-1 fw-bold">Today</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="card info-card">
                                    <div class="card-body">
                                        <h5 class="card-title">System Status</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-check-circle"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>Online</h6>
                                                <span class="text-success small pt-1 fw-bold">Running</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Recent Users</h5>
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    ' . $recentUsersTable . '
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-end mt-3">
                                            <a href="/gestion_userv2/gestion_user/public/index.php?page=users" class="btn btn-primary">View All Users</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Quick Actions</h5>
                                        <div class="d-grid gap-2">
                                            <a href="/gestion_userv2/gestion_user/public/index.php?page=create_user" class="btn btn-primary">Create New User</a>
                                            <a href="/gestion_userv2/gestion_user/public/index.php?page=manage_roles" class="btn btn-secondary">Manage User Roles</a>
                                            <a href="/gestion_userv2/gestion_user/public/index.php?page=export_users" class="btn btn-success">Export Users</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">System Information</h5>
                                        <div class="list-group">
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                Database Status
                                                <span class="badge bg-success rounded-pill">Online</span>
                                            </div>
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                Server Load
                                                <span class="badge bg-info rounded-pill">Normal</span>
                                            </div>
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                Last Backup
                                                <span class="badge bg-secondary rounded-pill">' . date('Y-m-d H:i:s') . '</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
';
include 'layout.php';
?> 
```

view\front-office\change_password.html
```html
<?php include 'layout.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Change Password</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($error_message) && !empty($error_message)): ?>
                        <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    
                    <?php if (isset($success_message) && !empty($success_message)): ?>
                        <div class="alert alert-success"><?php echo $success_message; ?></div>
                    <?php endif; ?>

                    <form method="POST" action="index.php?page=change_password">
                        <div class="form-group mb-3">
                            <label for="current_password">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="confirm_password">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?> 
```

view\front-office\css\profile.css
```css
.profile-picture {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 1rem;
}

.profile-card {
    margin-bottom: 2rem;
}

.profile-section {
    margin-bottom: 1.5rem;
}

.edit-form {
    margin-top: 1rem;
}

.form-label {
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.text-muted {
    color: #6c757d;
}

.btn-edit {
    margin-left: 0.5rem;
}

.alert {
    margin-top: 1rem;
} 
```

view\front-office\dashboard.php
```php
<?php
$pageTitle = "Dashboard";
$userName = isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'User';
$content = '
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Welcome, ' . $userName . '!</h5>
                        <div class="row mt-4">
                            <div class="col-lg-4 col-md-6">
                                <div class="card info-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Profile Information</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-person"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>View Profile</h6>
                                                <a href="/profile" class="btn btn-primary btn-sm">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="card info-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Account Settings</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-gear"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>Manage Account</h6>
                                                <a href="/settings" class="btn btn-primary btn-sm">Settings</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="card info-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Change Password</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-shield-lock"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>Security</h6>
                                                <a href="/change-password" class="btn btn-primary btn-sm">Update</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Recent Activity</h5>
                                        <div class="activity">
                                            <!-- Activity items will be dynamically added here -->
                                            <div class="activity-item d-flex">
                                                <div class="activite-label">32 min</div>
                                                <i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>
                                                <div class="activity-content">
                                                    Last login: ' . date("F j, Y, g:i a") . '
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
';
include 'layout.php';
?> 
```

view\front-office\js\profile.js
```js
function toggleEdit(field) {
    const editDiv = document.getElementById(field + "Edit");
    editDiv.style.display = editDiv.style.display === "none" ? "block" : "none";
}

function cancelEdit(field) {
    document.getElementById(field + "Edit").style.display = "none";
    if (field === "password") {
        document.getElementById("currentPassword").value = "";
        document.getElementById("newPassword").value = "";
        document.getElementById("confirmPassword").value = "";
    }
}

function validatePassword(password) {
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    return passwordRegex.test(password);
}

function saveEdit(field) {
    const editDiv = document.getElementById(field + "Edit");
    let data = {};
    
    switch(field) {
        case "email":
            const email = document.getElementById("emailInput").value.trim();
            if (!email) {
                alert("Email cannot be empty");
                return;
            }
            data.email = email;
            break;
            
        case "phone":
            const phone = document.getElementById("phoneInput").value.trim();
            if (!phone) {
                alert("Phone number cannot be empty");
                return;
            }
            data.phone = phone;
            break;
            
        case "password":
            const currentPassword = document.getElementById("currentPassword").value;
            const newPassword = document.getElementById("newPassword").value;
            const confirmPassword = document.getElementById("confirmPassword").value;
            
            if (!currentPassword || !newPassword || !confirmPassword) {
                alert("All password fields are required");
                return;
            }
            
            if (!validatePassword(newPassword)) {
                alert("Password must be at least 8 characters long and contain at least one number and one letter");
                return;
            }
            
            if (newPassword !== confirmPassword) {
                alert("New passwords do not match");
                return;
            }
            
            data.current_password = currentPassword;
            data.new_password = newPassword;
            data.confirm_password = confirmPassword;
            break;
    }
    
    const saveButton = editDiv.querySelector("button.btn-primary");
    const originalText = saveButton.textContent;
    saveButton.textContent = 'Saving...';
    saveButton.disabled = true;
    
    const endpoint = field === 'password' ? 'change_password' : 'update_profile';
    fetch('/gestion_userv2/gestion_user/public/index.php?page=' + endpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(() => {
        window.location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while saving changes. Please try again.');
    })
    .finally(() => {
        saveButton.textContent = originalText;
        saveButton.disabled = false;
    });
} 
```

view\front-office\layout.php
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'User Management System'; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Base URL for assets -->
    <?php
    $baseUrl = '/gestion_userv2/gestion_user/';
    ?>

    <!-- Favicons -->
    <link href="<?php echo $baseUrl; ?>assets/img/favicon.png" rel="icon">
    <link href="<?php echo $baseUrl; ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo $baseUrl; ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo $baseUrl; ?>assets/css/style.css" rel="stylesheet">

    <?php if (isset($additionalCss)): ?>
        <?php foreach ($additionalCss as $css): ?>
            <link href="<?php echo $baseUrl . $css; ?>" rel="stylesheet">
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="<?php echo $baseUrl; ?>public/" class="logo d-flex align-items-center">
                <img src="<?php echo $baseUrl; ?>assets/img/logo.png" alt="">
                <span>User Management</span>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a class="nav-link scrollto" href="<?php echo $baseUrl; ?>public/index.php?page=profile">Profile</a></li>
                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                            <li><a class="nav-link scrollto" href="<?php echo $baseUrl; ?>public/index.php?page=admin_dashboard">Admin Dashboard</a></li>
                        <?php endif; ?>
                        <li><a class="nav-link scrollto" href="<?php echo $baseUrl; ?>public/index.php?page=logout">Logout</a></li>
                    <?php else: ?>
                        <li><a class="nav-link scrollto" href="<?php echo $baseUrl; ?>public/index.php?page=login">Login</a></li>
                        <li><a class="nav-link scrollto" href="<?php echo $baseUrl; ?>public/index.php?page=register">Register</a></li>
                    <?php endif; ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>

    <!-- ======= Main Content ======= -->
    <main id="main">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                <?php 
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php echo $content; ?>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-5 col-md-12 footer-info">
                        <a href="<?php echo $baseUrl; ?>public/" class="logo d-flex align-items-center">
                            <span>User Management</span>
                        </a>
                        <p>User Management System for efficient user administration and profile management.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>User Management</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?php echo $baseUrl; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $baseUrl; ?>assets/vendor/aos/aos.js"></script>
    <script src="<?php echo $baseUrl; ?>assets/vendor/php-email-form/validate.js"></script>
    <script src="<?php echo $baseUrl; ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?php echo $baseUrl; ?>assets/vendor/purecounter/purecounter.js"></script>
    <script src="<?php echo $baseUrl; ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?php echo $baseUrl; ?>assets/vendor/glightbox/js/glightbox.min.js"></script>

    <!-- Template Main JS File -->
    <script src="<?php echo $baseUrl; ?>assets/js/main.js"></script>

    <?php if (isset($additionalJs)): ?>
        <?php foreach ($additionalJs as $js): ?>
            <script src="<?php echo $baseUrl . $js; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html> 
```

view\front-office\login.php
```php
<?php
$pageTitle = "Login";
$additionalCss = [
    'assets/css/login.css'
];
$content = '
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Login to Your Account</h5>
                        ' . (isset($_SESSION['error_message']) ? '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error_message']) . '</div>' : '') . '
                        ' . (isset($_SESSION['success_message']) ? '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success_message']) . '</div>' : '') . '
                        <form id="loginForm" action="/gestion_userv2/gestion_user/public/index.php?page=login" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email">
                                <div class="invalid-feedback" id="emailError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <div class="invalid-feedback" id="passwordError"></div>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Login</button>
                                <a href="/gestion_userv2/gestion_user/public/index.php?page=register" class="btn btn-secondary ms-2">Register</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();
    let isValid = true;
    
    // Reset all error messages and remove invalid classes
    document.querySelectorAll(".invalid-feedback").forEach(el => el.textContent = "");
    document.querySelectorAll(".form-control").forEach(el => el.classList.remove("is-invalid"));
    
    // Email validation
    const email = document.getElementById("email").value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        document.getElementById("email").classList.add("is-invalid");
        document.getElementById("emailError").textContent = "Please enter a valid email address";
        isValid = false;
    }
    
    // Password validation
    const password = document.getElementById("password").value;
    if (password.length < 6) {
        document.getElementById("password").classList.add("is-invalid");
        document.getElementById("passwordError").textContent = "Password must be at least 6 characters long";
        isValid = false;
    }
    
    if (isValid) {
        this.submit();
    }
});
</script>
';
include 'layout.php';
?> 
```

view\front-office\profile.html
```html
<?php
// Include the layout template
include __DIR__ . '/../layout.php';
?>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <!-- Profile Header -->
                        <div class="text-center mb-4">
                            <img src="<?php echo $profilePicture; ?>" alt="Profile" class="profile-picture">
                            <h4 class="mb-0"><?php echo htmlspecialchars($userName); ?></h4>
                            <p class="text-muted">Member since <?php echo date('F Y', strtotime($createdAt)); ?></p>
                        </div>

                        <!-- Profile Content -->
                        <div class="row mb-4">
                            <!-- Account Overview -->
                            <div class="col-md-6">
                                <div class="card profile-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Account Overview</h5>
                                        
                                        <!-- Email Section -->
                                        <div class="profile-section">
                                            <label class="form-label">Email</label>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted"><?php echo htmlspecialchars($userEmail); ?></span>
                                                <button class="btn btn-sm btn-outline-primary" onclick="toggleEdit('email')">Edit</button>
                                            </div>
                                            <div id="emailEdit" class="edit-form" style="display: none;">
                                                <input type="email" class="form-control" id="emailInput" value="<?php echo htmlspecialchars($userEmail); ?>">
                                                <div class="mt-2">
                                                    <button class="btn btn-sm btn-primary" onclick="saveEdit('email')">Save</button>
                                                    <button class="btn btn-sm btn-secondary" onclick="cancelEdit('email')">Cancel</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Phone Section -->
                                        <div class="profile-section">
                                            <label class="form-label">Phone</label>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted"><?php echo htmlspecialchars($userPhone); ?></span>
                                                <button class="btn btn-sm btn-outline-primary" onclick="toggleEdit('phone')">Edit</button>
                                            </div>
                                            <div id="phoneEdit" class="edit-form" style="display: none;">
                                                <input type="tel" class="form-control" id="phoneInput" value="<?php echo htmlspecialchars($userPhone); ?>">
                                                <div class="mt-2">
                                                    <button class="btn btn-sm btn-primary" onclick="saveEdit('phone')">Save</button>
                                                    <button class="btn btn-sm btn-secondary" onclick="cancelEdit('phone')">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Security Section -->
                            <div class="col-md-6">
                                <div class="card profile-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Security</h5>
                                        
                                        <!-- Password Section -->
                                        <div class="profile-section">
                                            <label class="form-label">Password</label>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted">••••••••</span>
                                                <button class="btn btn-sm btn-outline-primary" onclick="toggleEdit('password')">Change</button>
                                            </div>
                                            <div id="passwordEdit" class="edit-form" style="display: none;">
                                                <div class="mb-2">
                                                    <label class="form-label">Current Password</label>
                                                    <input type="password" class="form-control" id="currentPassword">
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">New Password</label>
                                                    <input type="password" class="form-control" id="newPassword">
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">Confirm New Password</label>
                                                    <input type="password" class="form-control" id="confirmPassword">
                                                </div>
                                                <div class="mt-2">
                                                    <button class="btn btn-sm btn-primary" onclick="saveEdit('password')">Save</button>
                                                    <button class="btn btn-sm btn-secondary" onclick="cancelEdit('password')">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Back Button -->
                        <div class="text-center">
                            <a href="/gestion_userv2/gestion_user/public/index.php?page=<?php echo $_SESSION['role'] === 'admin' ? 'admin_dashboard' : 'userdashboard'; ?>" class="btn btn-secondary">Back to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Custom JS -->
<script src="/gestion_userv2/gestion_user/view/front-office/js/profile.js"></script> 
```

view\front-office\profile.php
```php
<?php
// Include database connection
require_once __DIR__ . '/../../config/db.php';

$pageTitle = "Profile";

// Use the data passed from the controller
$userName = $view_data['username'] ?? 'User';
$userEmail = $view_data['email'] ?? '';
$userPhone = $view_data['phone'] ?? 'Not set';
$createdAt = $view_data['created_at'] ?? 'Not available';

// Get profile picture path from the data or use default
$profilePicture = !empty($view_data['profile_photo']) 
    ? '/gestion_userv2/gestion_user/public/uploads/' . htmlspecialchars($view_data['profile_photo'])
    : '/gestion_userv2/gestion_user/public/assets/img/default-avatar.png';

// Add CSS and JS files to the page
$additionalCss = ['view/front-office/css/profile.css'];
$additionalJs = ['view/front-office/js/profile.js'];

// Start output buffering
ob_start();

// Include the HTML template
include 'profile.html';

// Get the buffered content
$content = ob_get_clean();

// Include the layout template
include __DIR__ . '/../layout.php';
?> 
```

view\front-office\register.php
```php
<?php
$pageTitle = "Register";
$content = '
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Create an Account</h5>
                        ' . (isset($_SESSION['error_message']) ? '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error_message']) . '</div>' : '') . '
                        ' . (isset($_SESSION['success_message']) ? '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success_message']) . '</div>' : '') . '
                        <form id="registerForm" action="/gestion_userv2/gestion_user/public/index.php?page=register" method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username">
                                    <div class="invalid-feedback" id="usernameError"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                    <div class="invalid-feedback" id="emailError"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name">
                                    <div class="invalid-feedback" id="firstNameError"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name">
                                    <div class="invalid-feedback" id="lastNameError"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <div class="invalid-feedback" id="passwordError"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                    <div class="invalid-feedback" id="confirmPasswordError"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                    <div class="invalid-feedback" id="phoneError"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob">
                                    <div class="invalid-feedback" id="dobError"></div>
                                </div>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="terms" name="terms">
                                <label class="form-check-label" for="terms">I agree to the terms and conditions</label>
                                <div class="invalid-feedback" id="termsError"></div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Register</button>
                                <a href="/gestion_userv2/gestion_user/public/index.php?page=login" class="btn btn-secondary ms-2">Back to Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
document.getElementById("registerForm").addEventListener("submit", function(event) {
    event.preventDefault();
    let isValid = true;
    
    // Reset all error messages and remove invalid classes
    document.querySelectorAll(".invalid-feedback").forEach(el => el.textContent = "");
    document.querySelectorAll(".form-control").forEach(el => el.classList.remove("is-invalid"));
    document.querySelectorAll(".form-check-input").forEach(el => el.classList.remove("is-invalid"));
    
    // Username validation
    const username = document.getElementById("username").value.trim();
    if (username.length < 3) {
        document.getElementById("username").classList.add("is-invalid");
        document.getElementById("usernameError").textContent = "Username must be at least 3 characters long";
        isValid = false;
    }
    
    // Email validation
    const email = document.getElementById("email").value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        document.getElementById("email").classList.add("is-invalid");
        document.getElementById("emailError").textContent = "Please enter a valid email address";
        isValid = false;
    }
    
    // First Name validation
    const firstName = document.getElementById("first_name").value.trim();
    if (firstName.length < 2) {
        document.getElementById("first_name").classList.add("is-invalid");
        document.getElementById("firstNameError").textContent = "First name is required";
        isValid = false;
    }
    
    // Last Name validation
    const lastName = document.getElementById("last_name").value.trim();
    if (lastName.length < 2) {
        document.getElementById("last_name").classList.add("is-invalid");
        document.getElementById("lastNameError").textContent = "Last name is required";
        isValid = false;
    }
    
    // Password validation
    const password = document.getElementById("password").value;
    if (password.length < 6) {
        document.getElementById("password").classList.add("is-invalid");
        document.getElementById("passwordError").textContent = "Password must be at least 6 characters long";
        isValid = false;
    }
    
    // Confirm Password validation
    const confirmPassword = document.getElementById("confirm_password").value;
    if (password !== confirmPassword) {
        document.getElementById("confirm_password").classList.add("is-invalid");
        document.getElementById("confirmPasswordError").textContent = "Passwords do not match";
        isValid = false;
    }
    
    // Phone validation
    const phone = document.getElementById("phone").value.trim();
    if (phone && !/^\+?[\d\s-]{10,}$/.test(phone)) {
        document.getElementById("phone").classList.add("is-invalid");
        document.getElementById("phoneError").textContent = "Please enter a valid phone number";
        isValid = false;
    }
    
    // Date of Birth validation
    const dob = document.getElementById("dob").value;
    if (dob) {
        const dobDate = new Date(dob);
        const today = new Date();
        if (dobDate >= today) {
            document.getElementById("dob").classList.add("is-invalid");
            document.getElementById("dobError").textContent = "Date of birth must be in the past";
            isValid = false;
        }
    }
    
    // Terms validation
    if (!document.getElementById("terms").checked) {
        document.getElementById("terms").classList.add("is-invalid");
        document.getElementById("termsError").textContent = "You must agree to the terms and conditions";
        isValid = false;
    }
    
    if (isValid) {
        this.submit();
    }
});
</script>
';
include 'layout.php';
?> 
```

Assistant:
Failed to send prompt via First Party API: Error: Invalid Anthropic API Key. Please enter a valid API Key in Settings.