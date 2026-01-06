<section class="card">
  <div class="card-header">
    <h2><?php echo htmlspecialchars($title ?? 'Book', ENT_QUOTES, 'UTF-8'); ?></h2>
    <p>Provide the book details below.</p>
  </div>
  <form method="post" action="<?php echo $action; ?>" class="form">
    <?php echo csrf_field(); ?>
    <label>
      Book ID
      <input type="text" name="Book_id" required value="<?php echo htmlspecialchars($book['Book_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    </label>
    <label>
      Title
      <input type="text" name="Name" required value="<?php echo htmlspecialchars($book['Name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    </label>
    <label>
      Author
      <input type="text" name="Author" required value="<?php echo htmlspecialchars($book['Author'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    </label>
    <label>
      Availability
      <input type="text" name="Availability" value="<?php echo htmlspecialchars($book['Availability'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    </label>
    <label>
      Quantity
      <input type="text" name="Quantity" value="<?php echo htmlspecialchars($book['Quantity'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    </label>
    <label>
      Rent
      <input type="text" name="Rent" value="<?php echo htmlspecialchars($book['Rent'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    </label>
    <label>
      Price
      <input type="text" name="Price" value="<?php echo htmlspecialchars($book['Price'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    </label>
    <label>
      Branch
      <input type="text" name="Branch" value="<?php echo htmlspecialchars($book['Branch'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    </label>
    <label>
      Edition
      <input type="text" name="Edition" value="<?php echo htmlspecialchars($book['Edition'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    </label>
    <label>
      Publisher
      <input type="text" name="Publisher" value="<?php echo htmlspecialchars($book['Publisher'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    </label>
    <label>
      Details
      <input type="text" name="Details" value="<?php echo htmlspecialchars($book['Details'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    </label>
    <button class="btn primary" type="submit"><?php echo htmlspecialchars($submitLabel ?? 'Save', ENT_QUOTES, 'UTF-8'); ?></button>
  </form>
</section>
