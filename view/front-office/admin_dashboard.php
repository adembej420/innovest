<?php
$pageTitle = "Admin Dashboard";
$additionalCss = ['css/admindashboard.css'];

// Get user statistics
$stmt = $pdo->prepare("SELECT COUNT(*) FROM user");
$stmt->execute();
$totalUsers = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE status = 'active'");
$stmt->execute();
$activeUsers = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE DATE(created_at) = CURDATE()");
$stmt->execute();
$newUsers = $stmt->fetchColumn();

// Get recent users
$stmt = $pdo->prepare("SELECT * FROM user ORDER BY created_at DESC LIMIT 5");
$stmt->execute();
$recentUsers = $stmt->fetchAll();

$recentUsersTable = '';
foreach ($recentUsers as $user) {
    $recentUsersTable .= '<tr>
        <td>' . $user['user_id'] . '</td>
        <td>' . htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) . '</td>
        <td>' . htmlspecialchars($user['email']) . '</td>
        <td><span class="badge bg-' . ($user['status'] === 'active' ? 'success' : 'warning') . '">' . ucfirst($user['status']) . '</span></td>
        <td>
            <a href="index.php?page=edit_user&id=' . $user['user_id'] . '" class="btn btn-sm btn-primary">Edit</a>
            <a href="index.php?page=delete_user&id=' . $user['user_id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a>
        </td>
    </tr>';
}

$content = '
<div class="dashboard-container">
    <div class="header">
        <h1>Admin Dashboard</h1>
        <p class="role-tag">Logged in as Administrator</p>
    </div>

    <!-- Search Bar -->
    <div class="search-container">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search users..." class="form-control">
            <div id="searchResults" class="search-results"></div>
        </div>
    </div>

    <div class="stats">
        <div class="stat-card">
            <h3>' . $totalUsers . '</h3>
            <p>Total Users</p>
        </div>
        <div class="stat-card">
            <h3>' . $activeUsers . '</h3>
            <p>Active Users</p>
        </div>
        <div class="stat-card">
            <h3>' . $newUsers . '</h3>
            <p>New Users Today</p>
        </div>
        <div class="stat-card">
            <h3>Online</h3>
            <p>System Status</p>
        </div>
    </div>

    <div class="card">
        <h2>Recent Users</h2>
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
        <a href="index.php?page=users" class="btn btn-primary">View All Users</a>
    </div>

    <div class="row">
        <div class="card" style="width: 48%; float: left; margin-right: 2%;">
            <h2>Quick Actions</h2>
            <div class="quick-actions">
                <a href="index.php?page=create_user" class="btn btn-primary">Create New User</a>
                <a href="index.php?page=manage_roles" class="btn btn-secondary">Manage User Roles</a>
                <a href="index.php?page=export_users" class="btn btn-success">Export Users</a>
            </div>
        </div>
        <div class="card" style="width: 48%; float: left;">
            <h2>System Information</h2>
            <div class="system-info">
                <div class="info-item">
                    <span>Database Status</span>
                    <span class="status-badge success">Online</span>
                </div>
                <div class="info-item">
                    <span>Server Load</span>
                    <span class="status-badge info">Normal</span>
                </div>
                <div class="info-item">
                    <span>Last Backup</span>
                    <span class="status-badge">' . date('Y-m-d H:i:s') . '</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("searchInput");
    const searchResults = document.getElementById("searchResults");
    
    searchInput.addEventListener("input", function() {
        const query = this.value.trim();
        if (query.length < 2) {
            searchResults.style.display = "none";
            return;
        }
        
        fetch("index.php?page=search&q=" + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    searchResults.innerHTML = data.map(user => 
                        "<div class=\"search-result-item\">" +
                        "<a href=\"index.php?page=edit_user&id=" + user.id + "\">" +
                        user.name + " (" + user.email + ")" +
                        "</a></div>"
                    ).join("");
                    searchResults.style.display = "block";
                } else {
                    searchResults.innerHTML = "<div class=\"no-results\">No users found</div>";
                    searchResults.style.display = "block";
                }
            })
            .catch(error => {
                searchResults.innerHTML = "<div class=\"search-error\">Error performing search</div>";
                searchResults.style.display = "block";
            });
    });
    
    document.addEventListener("click", function(e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.style.display = "none";
        }
    });
});
</script>';

// Set the layout to admin
$view = new \App\View\View();
$view->setLayout('admin');
$view->display('admin_dashboard.php', [
    'content' => $content,
    'pageTitle' => $pageTitle,
    'additionalCss' => $additionalCss
]);
?>
