<?php echo $this->render($templates . 'header.html',$this->mime,get_defined_vars(),0); ?>
<div class="categories_grid">
  <a href="./<?php echo $PARAMS['category_id']; ?>/new_contact">
  <div class="new_contact col-md-3 tile">
    <h3>New contact</h3>
  </div>
</a>
<?php foreach (($all_contacts?:[]) as $contact): ?>
  <a href="./<?php echo $contact['category_id']; ?>/contact/<?php echo $contact['id']; ?>">
    <div class="tile <?php echo $contact['name']; ?>_tile col-md-3">
        <h3><?php echo $contact['name']; ?></h3>
    </div>
  </a>
<?php endforeach; ?>
</div>
<?php echo $this->render($templates . 'footer.html',$this->mime,get_defined_vars(),0); ?>
