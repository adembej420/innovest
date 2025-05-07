document.addEventListener('DOMContentLoaded', function() {
    // Profile photo preview in update profile modal
    const profilePhotoInput = document.getElementById('profilePhoto');
    const profilePhotoPreview = document.getElementById('profilePhotoPreview');

    if (profilePhotoInput && profilePhotoPreview) {
        profilePhotoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePhotoPreview.src = e.target.result;
                    profilePhotoPreview.style.display = 'block';

                    // Also update the sidebar profile photo if it exists
                    const sidebarPhoto = document.querySelector('.profile-sidebar .profile-photo img');
                    if (sidebarPhoto) {
                        sidebarPhoto.src = e.target.result;
                    }

                    // Also update the photo preview in the update photo modal
                    const photoPreview = document.getElementById('photoPreview');
                    if (photoPreview) {
                        photoPreview.src = e.target.result;
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Profile photo preview in dedicated photo modal
    const profilePhotoUpload = document.getElementById('profilePhotoUpload');
    const photoPreview = document.getElementById('photoPreview');

    if (profilePhotoUpload && photoPreview) {
        profilePhotoUpload.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    photoPreview.src = e.target.result;

                    // Also update the main profile photo if it exists
                    const mainPhoto = document.getElementById('profilePhotoPreview');
                    if (mainPhoto) {
                        mainPhoto.src = e.target.result;
                    }

                    // Also update the sidebar profile photo if it exists
                    const sidebarPhoto = document.getElementById('sidebarProfilePhoto');
                    if (sidebarPhoto) {
                        sidebarPhoto.src = e.target.result;
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Sidebar navigation active state
    const sidebarLinks = document.querySelectorAll('.sidebar-nav a');
    if (sidebarLinks.length > 0) {
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Remove active class from all links
                sidebarLinks.forEach(l => l.classList.remove('active'));

                // Add active class to clicked link
                this.classList.add('active');
            });
        });
    }

    // User status toggle
    const statusIndicator = document.querySelector('.status-indicator');
    const statusText = document.querySelector('.status-text');

    if (statusIndicator && statusText) {
        statusIndicator.addEventListener('click', function() {
            if (this.classList.contains('status-online')) {
                this.classList.remove('status-online');
                this.classList.add('status-away');
                statusText.textContent = 'Away';
            } else if (this.classList.contains('status-away')) {
                this.classList.remove('status-away');
                this.classList.add('status-offline');
                statusText.textContent = 'Offline';
            } else {
                this.classList.remove('status-offline');
                this.classList.add('status-online');
                statusText.textContent = 'Online';
            }
        });
    }

    // Form validation
    const updateProfileForm = document.getElementById('updateProfileForm');
    if (updateProfileForm) {
        updateProfileForm.addEventListener('submit', function(e) {
            let isValid = true;

            // Validate first name
            const firstName = document.getElementById('firstName');
            if (firstName && firstName.value.trim() === '') {
                showError(firstName, 'First name is required');
                isValid = false;
            } else if (firstName) {
                clearError(firstName);
            }

            // Validate last name
            const lastName = document.getElementById('lastName');
            if (lastName && lastName.value.trim() === '') {
                showError(lastName, 'Last name is required');
                isValid = false;
            } else if (lastName) {
                clearError(lastName);
            }

            // Validate phone (optional validation for format)
            const phone = document.getElementById('phone');
            if (phone && phone.value.trim() !== '') {
                const phoneRegex = /^\+?[0-9\s\-\(\)]{8,20}$/;
                if (!phoneRegex.test(phone.value.trim())) {
                    showError(phone, 'Please enter a valid phone number');
                    isValid = false;
                } else {
                    clearError(phone);
                }
            } else if (phone) {
                clearError(phone);
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    // Password change form validation
    const changePasswordForm = document.getElementById('changePasswordForm');
    if (changePasswordForm) {
        changePasswordForm.addEventListener('submit', function(e) {
            let isValid = true;

            // Validate current password
            const currentPassword = document.getElementById('currentPassword');
            if (currentPassword && currentPassword.value.trim() === '') {
                showError(currentPassword, 'Current password is required');
                isValid = false;
            } else if (currentPassword) {
                clearError(currentPassword);
            }

            // Validate new password
            const newPassword = document.getElementById('newPassword');
            if (newPassword && newPassword.value.trim() === '') {
                showError(newPassword, 'New password is required');
                isValid = false;
            } else if (newPassword && newPassword.value.trim().length < 6) {
                showError(newPassword, 'Password must be at least 6 characters');
                isValid = false;
            } else if (newPassword) {
                clearError(newPassword);
            }

            // Validate confirm password
            const confirmPassword = document.getElementById('confirmPassword');
            if (confirmPassword && confirmPassword.value.trim() === '') {
                showError(confirmPassword, 'Please confirm your password');
                isValid = false;
            } else if (confirmPassword && newPassword && confirmPassword.value.trim() !== newPassword.value.trim()) {
                showError(confirmPassword, 'Passwords do not match');
                isValid = false;
            } else if (confirmPassword) {
                clearError(confirmPassword);
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    // Tab switching
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    if (tabButtons.length > 0 && tabContents.length > 0) {
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Add active class to clicked button
                this.classList.add('active');

                // Show corresponding content
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });
    }

    // Helper functions
    function showError(input, message) {
        const formGroup = input.closest('.form-group');
        const errorElement = formGroup.querySelector('.invalid-feedback');

        input.classList.add('is-invalid');
        if (errorElement) {
            errorElement.textContent = message;
        }
    }

    function clearError(input) {
        input.classList.remove('is-invalid');
        const formGroup = input.closest('.form-group');
        const errorElement = formGroup.querySelector('.invalid-feedback');

        if (errorElement) {
            errorElement.textContent = '';
        }
    }

    // Animation for profile sections
    const profileSections = document.querySelectorAll('.profile-section');
    if (profileSections.length > 0) {
        profileSections.forEach((section, index) => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';

            setTimeout(() => {
                section.style.transition = 'all 0.5s ease';
                section.style.opacity = '1';
                section.style.transform = 'translateY(0)';
            }, 100 * (index + 1));
        });
    }
});
