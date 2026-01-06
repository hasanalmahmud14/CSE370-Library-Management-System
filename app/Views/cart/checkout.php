<section class="card">
  <div class="card-header">
    <h2>Payment Details</h2>
    <p>Confirm your purchase and enter payment information.</p>
  </div>
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>Title</th>
          <th>Author</th>
          <th>Qty</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($items as $item): ?>
          <tr>
            <td><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($item['author'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($item['qty'], ENT_QUOTES, 'UTF-8'); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <form method="post" action="<?php echo url('/cart/purchase'); ?>" class="form">
    <?php echo csrf_field(); ?>
    <label>
      Cardholder Name
      <input type="text" name="card_name" required>
    </label>
    <label>
      Card Number
      <input type="text" name="card_number" required>
    </label>
    <label>
      Expiry Date
      <input type="text" name="expiry" placeholder="MM/YY" required>
    </label>
    <label>
      CVV
      <input type="password" name="cvv" required>
    </label>
    <button class="btn primary" type="submit">Pay Now</button>
  </form>
</section>
