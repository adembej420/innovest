<?php
// Start output buffering
ob_start();
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Admin Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <!-- Search Box -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-search me-1"></i>
            Search Users
        </div>
        <div class="card-body">
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control" placeholder="Search for users...">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
            <div id="searchResults" class="search-results mt-2" style="display: none;"></div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h2 class="display-4"><?php echo $totalUsers; ?></h2>
                    <p>Total Users</p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="index.php?page=users">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h2 class="display-4"><?php echo $activeUsers; ?></h2>
                    <p>Active Users</p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="index.php?page=users&status=active">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h2 class="display-4"><?php echo $newUsers; ?></h2>
                    <p>New Users Today</p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="index.php?page=users&filter=new">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    <h2 class="display-4"><i class="fas fa-check-circle"></i></h2>
                    <p>System Status</p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Users Table -->
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Recent Users
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
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
                            <?php
                            if (isset($recentUsers) && is_array($recentUsers)) {
                                foreach ($recentUsers as $user) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($user['user_id']) . '</td>';
                                    echo '<td>' . htmlspecialchars($user['username']) . '</td>';
                                    echo '<td>' . htmlspecialchars($user['email']) . '</td>';
                                    echo '<td><span class="badge bg-' . ($user['status'] === 'active' ? 'success' : 'warning') . '">' . htmlspecialchars($user['status']) . '</span></td>';
                                    echo '<td>';
                                    echo '<a href="index.php?page=edit_user&id=' . urlencode($user['user_id']) . '" class="btn btn-sm btn-primary">Edit</a> ';
                                    echo '<a href="index.php?page=delete_user&id=' . urlencode($user['user_id']) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this user?\');">Delete</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5">No users found</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="index.php?page=users" class="btn btn-primary">
                        <i class="fas fa-users me-1"></i> View All Users
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions and System Info -->
        <div class="col-xl-4">
            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-bolt me-1"></i>
                    Quick Actions
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="index.php?page=add_user" class="btn btn-primary">
                            <i class="fas fa-user-plus me-1"></i> Create New User
                        </a>
                        <a href="index.php?page=manage_roles" class="btn btn-secondary">
                            <i class="fas fa-users-cog me-1"></i> Manage User Roles
                        </a>
                        <a href="index.php?page=export_users" class="btn btn-success">
                            <i class="fas fa-file-export me-1"></i> Export Users
                        </a>
                        <a href="index.php?page=users" class="btn btn-info">
                            <i class="fas fa-users me-1"></i> View All Users
                        </a>
                    </div>
                </div>
            </div>

            <!-- System Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-server me-1"></i>
                    System Information
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Database Status
                            <span class="badge bg-success rounded-pill">Online</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Server Load
                            <span class="badge bg-info rounded-pill">Normal</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Last Backup
                            <span class="badge bg-secondary rounded-pill"><?php echo date('Y-m-d H:i'); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    let searchTimeout;

    if (searchInput && searchResults) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();

            if (query.length < 2) {
                searchResults.innerHTML = '';
                searchResults.style.display = 'none';
                return;
            }

            searchTimeout = setTimeout(() => {
                // Simulate search results (in a real app, this would be an AJAX call)
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
            }, 300);
        });

        // Close search results when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.style.display = 'none';
            }
        });
    }
});
</script>

<?php
// Store the content in a variable
$content = ob_get_clean();

// Include the layout file which will use the $content variable
include __DIR__ . '/layout.php';
?>

