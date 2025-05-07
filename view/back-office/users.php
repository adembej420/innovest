<?php
// Start output buffering
ob_start();
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">User Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php?page=admin_dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Users</li>
    </ol>
    
    <?php if (isset($error_message) && !empty($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error_message; ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($success_message) && !empty($success_message)): ?>
        <div class="alert alert-success" role="alert">
            <i class="fas fa-check-circle me-2"></i><?php echo $success_message; ?>
        </div>
    <?php endif; ?>
    
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-users me-1"></i>
                All Users
            </div>
            <div>
                <a href="index.php?page=add_user" class="btn btn-primary btn-sm">
                    <i class="fas fa-user-plus me-1"></i> Add New User
                </a>
                <a href="index.php?page=export_users" class="btn btn-success btn-sm ms-2">
                    <i class="fas fa-file-export me-1"></i> Export to CSV
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="usersTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($users) && is_array($users) && count($users) > 0): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo $user['role'] === 'admin' ? 'danger' : 'primary'; ?>">
                                            <?php echo ucfirst(htmlspecialchars($user['role'])); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?php echo $user['status'] === 'active' ? 'success' : 'warning'; ?>">
                                            <?php echo ucfirst(htmlspecialchars($user['status'])); ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="index.php?page=edit_user&id=<?php echo $user['user_id']; ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <?php if ($user['user_id'] != $_SESSION['user_id']): ?>
                                                <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $user['user_id']; ?>, '<?php echo htmlspecialchars($user['username']); ?>')" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            <?php else: ?>
                                                <button class="btn btn-secondary btn-sm" disabled title="Cannot delete your own account">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No users found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize DataTable
    if (typeof $.fn.DataTable !== 'undefined') {
        $('#usersTable').DataTable({
            responsive: true,
            order: [[0, 'desc']]
        });
    }
    
    // Add filter buttons
    const filterButtons = `
        <div class="mb-3">
            <button class="btn btn-outline-primary btn-sm filter-btn" data-filter="all">All</button>
            <button class="btn btn-outline-success btn-sm filter-btn" data-filter="active">Active</button>
            <button class="btn btn-outline-warning btn-sm filter-btn" data-filter="inactive">Inactive</button>
            <button class="btn btn-outline-danger btn-sm filter-btn" data-filter="admin">Admins</button>
            <button class="btn btn-outline-info btn-sm filter-btn" data-filter="user">Regular Users</button>
        </div>
    `;
    
    $('.card-header').after(filterButtons);
    
    // Filter functionality
    $('.filter-btn').on('click', function() {
        const filter = $(this).data('filter');
        let filterFunction;
        
        // Remove active class from all buttons
        $('.filter-btn').removeClass('active');
        // Add active class to clicked button
        $(this).addClass('active');
        
        if (filter === 'all') {
            filterFunction = function() { return true; };
        } else if (filter === 'active') {
            filterFunction = function(data) { return data[4].includes('Active'); };
        } else if (filter === 'inactive') {
            filterFunction = function(data) { return data[4].includes('Inactive'); };
        } else if (filter === 'admin') {
            filterFunction = function(data) { return data[3].includes('Admin'); };
        } else if (filter === 'user') {
            filterFunction = function(data) { return data[3].includes('User'); };
        }
        
        if (typeof $.fn.DataTable !== 'undefined') {
            const table = $('#usersTable').DataTable();
            
            // Apply filter
            $.fn.dataTable.ext.search.pop();
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                return filterFunction(data);
            });
            
            table.draw();
        } else {
            // Fallback for when DataTables is not available
            const rows = document.querySelectorAll('#usersTable tbody tr');
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                if (cells.length > 0) {
                    const statusCell = cells[4].textContent.trim();
                    const roleCell = cells[3].textContent.trim();
                    
                    let showRow = false;
                    if (filter === 'all') {
                        showRow = true;
                    } else if (filter === 'active' && statusCell.includes('Active')) {
                        showRow = true;
                    } else if (filter === 'inactive' && statusCell.includes('Inactive')) {
                        showRow = true;
                    } else if (filter === 'admin' && roleCell.includes('Admin')) {
                        showRow = true;
                    } else if (filter === 'user' && roleCell.includes('User')) {
                        showRow = true;
                    }
                    
                    row.style.display = showRow ? '' : 'none';
                }
            });
        }
    });
});

function confirmDelete(userId, username) {
    if (confirm(`Are you sure you want to delete user "${username}" (ID: ${userId})?`)) {
        window.location.href = `index.php?page=delete_user&id=${userId}`;
    }
}
</script>

<?php
// Store the content in a variable
$content = ob_get_clean();

// Include the layout file which will use the $content variable
include __DIR__ . '/layout.php';
?>
