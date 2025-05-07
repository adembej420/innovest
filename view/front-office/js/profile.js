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
    } else if (field === "name") {
        const firstNameInput = document.getElementById("firstNameInput");
        const lastNameInput = document.getElementById("lastNameInput");
        firstNameInput.value = firstNameInput.defaultValue;
        lastNameInput.value = lastNameInput.defaultValue;
    }
}

function validatePassword(password) {
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    return passwordRegex.test(password);
}

let selectedFile = null;

let currentPhotoUrl = null;

function previewProfilePhoto(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Validate file type
        if (!file.type.startsWith('image/')) {
            alert('Please select an image file');
            return;
        }
        
        // Validate file size (max 5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('File size should not exceed 5MB');
            return;
        }

        selectedFile = file;
        
        // Store current photo URL before preview
        currentPhotoUrl = document.getElementById('profilePreview').src;
        
        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profilePreview').src = e.target.result;
            document.getElementById('photoConfirmation').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}

function cancelProfilePhoto() {
    // Reset preview and hide confirmation buttons
    if (currentPhotoUrl) {
        document.getElementById('profilePreview').src = currentPhotoUrl;
    }
    document.getElementById('photoConfirmation').style.display = 'none';
    document.getElementById('profilePhotoInput').value = '';
    selectedFile = null;
}

function confirmProfilePhoto(event) {
    if (event) event.preventDefault();
    
    if (!selectedFile) {
        return;
    }
    
    const formData = new FormData();
    formData.append('profile_photo', selectedFile);
    formData.append('ajax', 'true');
    
    // Store the preview URL as the current URL
    currentPhotoUrl = document.getElementById('profilePreview').src;
    
    fetch('/gestion_userv2/gestion_user/public/index.php?page=update_profile', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.profile_photo) {
                const previewImg = document.getElementById('profilePreview');
                previewImg.src = data.profile_photo;
                currentPhotoUrl = data.profile_photo;
                document.getElementById('photoConfirmation').style.display = 'none';
                document.getElementById('profilePhotoInput').value = '';
                selectedFile = null;
            }
        } else {
            throw new Error(data.error || 'Failed to upload photo');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Revert to the previous photo if upload fails
        document.getElementById('profilePreview').src = currentPhotoUrl;
        document.getElementById('photoConfirmation').style.display = 'none';
        document.getElementById('profilePhotoInput').value = '';
        selectedFile = null;
    });
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
            
        case "name":
            const firstName = document.getElementById("firstNameInput").value.trim();
            const lastName = document.getElementById("lastNameInput").value.trim();
            data.first_name = firstName;
            data.last_name = lastName;
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
    
    // Send the update request as form data
    const formData = new FormData();
    if (field === 'name') {
        formData.append('first_name', data.first_name);
        formData.append('last_name', data.last_name);
    } else if (field === 'email') {
        formData.append('email', data.email);
    } else if (field === 'phone') {
        formData.append('phone', data.phone);
    } else if (field === 'password') {
        formData.append('current_password', data.current_password);
        formData.append('new_password', data.new_password);
        formData.append('confirm_password', data.confirm_password);
    }
    fetch('/gestion_userv2/gestion_user/public/index.php?page=update_profile', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.redirected) {
            window.location.href = response.url;
            return;
        }
        return response.text();
    })
    .then(result => {
        // Optionally parse result or reload page
        if (field === 'name') {
            const displayName = (document.getElementById('firstNameInput').value.trim() + ' ' + document.getElementById('lastNameInput').value.trim()).trim() || 'Not set';
            const nameSpan = document.querySelector('.profile-section span.text-muted');
            if (nameSpan) nameSpan.textContent = displayName;
            document.getElementById('firstNameInput').defaultValue = document.getElementById('firstNameInput').value.trim();
            document.getElementById('lastNameInput').defaultValue = document.getElementById('lastNameInput').value.trim();
        }
        editDiv.style.display = 'none';
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update profile. Please try again.');
    })
    .finally(() => {
        saveButton.textContent = originalText;
        saveButton.disabled = false;
    });
} 