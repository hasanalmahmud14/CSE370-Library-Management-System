<section class="card">
  <div class="card-header">
    <h2>Your Cart</h2>
    <p>Review your selected titles before checkout.</p>
  </div>
  <?php if (!empty($items)): ?>
    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Qty</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $item): ?>
            <tr>
              <td><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td><?php echo htmlspecialchars($item['author'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td><?php echo htmlspecialchars($item['qty'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td>
                <form method="post" action="<?php echo url('/cart/remove'); ?>">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8'); ?>">
                  <button class="link" type="submit">Remove</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="hero-actions">
      <a class="btn primary" href="<?php echo url('/cart/checkout'); ?>">Buy Now</a>
    </div>
  <?php else: ?>
    <p>Your cart is empty. Browse books to add your first title.</p>
  <?php endif; ?>
</section>
