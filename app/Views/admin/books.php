<section class="card">
  <div class="card-header">
    <h2>Manage Books</h2>
    <p>Review catalog availability and metadata.</p>
  </div>
  <div class="hero-actions">
    <a class="btn primary" href="<?php echo url('/admin/books/create'); ?>">Add Book</a>
  </div>
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>Book ID</th>
          <th>Title</th>
          <th>Author</th>
          <th>Availability</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($books)): ?>
          <?php foreach ($books as $book): ?>
            <tr>
              <td><?php echo htmlspecialchars($book['Book_id'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td><?php echo htmlspecialchars($book['Name'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td><?php echo htmlspecialchars($book['Author'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td><?php echo htmlspecialchars($book['Availability'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td>
                <a class="link" href="<?php echo url('/admin/books/edit?id=' . urlencode($book['Book_id'])); ?>">Edit</a>
                <form method="post" action="<?php echo url('/admin/books/delete'); ?>" style="display:inline">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($book['Book_id'], ENT_QUOTES, 'UTF-8'); ?>">
                  <button class="link" type="submit">Delete</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5">No books found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</section>
