// Admin Dashboard JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Add animation to cards
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('animate__animated', 'animate__fadeInUp');
    });
    
    // Handle search functionality
    const searchInput = document.getElementById('userSearch');
    const searchResults = document.getElementById('searchResults');
    
    if (searchInput && searchResults) {
        searchInput.addEventListener('keyup', function() {
            const query = this.value.trim();
            
            if (query.length < 2) {
                searchResults.style.display = 'none';
                return;
            }
            
            // In a real application, this would be an AJAX call to the server
            // For now, we'll just simulate some results
            const results = [
                { id: 1, name: 'John Doe', email: 'john@example.com' },
                { id: 2, name: 'Jane Smith', email: 'jane@example.com' },
                { id: 3, name: 'Bob Johnson', email: 'bob@example.com' }
            ].filter(user => 
                user.name.toLowerCase().includes(query.toLowerCase()) || 
                user.email.toLowerCase().includes(query.toLowerCase())
            );
            
            if (results.length > 0) {
                let html = '';
                results.forEach(user => {
                    html += `<div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">${user.name}</h5>
                            <a href="index.php?page=edit_user&id=${user.id}" class="btn btn-primary btn-sm">Edit</a>
                        </div>
                        <p class="mb-1">${user.email}</p>
                    </div>`;
                });
                searchResults.innerHTML = `<div class="list-group">${html}</div>`;
                searchResults.style.display = 'block';
            } else {
                searchResults.innerHTML = '<div class="alert alert-info">No users found</div>';
                searchResults.style.display = 'block';
            }
        });
        
        // Close search results when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.style.display = 'none';
            }
        });
    }
});
