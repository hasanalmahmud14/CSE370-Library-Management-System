<section class="card">
  <div class="card-header">
    <h2>Available Books</h2>
    <p>Select a title to add to your cart.</p>
  </div>
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
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
              <td><?php echo htmlspecialchars($book['Name'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td><?php echo htmlspecialchars($book['Author'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td><?php echo htmlspecialchars($book['Availability'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td>
                <form method="post" action="<?php echo url('/cart/add'); ?>">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['Book_id'], ENT_QUOTES, 'UTF-8'); ?>">
                  <button class="link" type="submit">Add to Cart</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="4">No books available.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</section>
