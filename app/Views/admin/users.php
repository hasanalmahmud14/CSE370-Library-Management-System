<section class="card">
  <div class="card-header">
    <h2>Manage Users</h2>
    <p>Review registered users and their status.</p>
  </div>
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>User ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>User Type</th>
          <th>Book ID</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($users)): ?>
          <?php foreach ($users as $user): ?>
            <tr>
              <td><?php echo htmlspecialchars($user['User_ID'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td><?php echo htmlspecialchars($user['Name'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td><?php echo htmlspecialchars($user['Email'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td><?php echo htmlspecialchars($user['U_type'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
              <td><?php echo htmlspecialchars($user['Book_Id'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5">No users found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</section>
