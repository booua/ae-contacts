<?php echo $this->render($templates . 'header.html',$this->mime,get_defined_vars(),0); ?>
<?php echo var_dump($single_contact); ?>

<div class="">

</div>
<!-- <?php foreach (($all_contacts?:[]) as $contact): ?>
  <a href="./<?php echo $contact['category_id']; ?>/contact/<?php echo $contact['id']; ?>">
    <div class="tile <?php echo $contact['name']; ?>_tile col-md-3">
        <h3><?php echo $contact['name']; ?></h3>
    </div>
  </a>
<?php endforeach; ?> -->

<?php echo $this->render($templates . 'footer.html',$this->mime,get_defined_vars(),0); ?>
