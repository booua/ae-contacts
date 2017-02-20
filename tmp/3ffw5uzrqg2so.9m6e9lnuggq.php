<?php echo $this->render($templates . 'header.html',$this->mime,get_defined_vars(),0); ?>
<div class="categories_grid">
    <div class="row">
      <a href="./category/new_category">
        <div class="tile col-md-3 create_new">
          <h3>create New</h3>
        </div>
      </a>
        <?php foreach (($all_categories?:[]) as $category): ?>
          <a href="./category/<?php echo $category['id']; ?>">
            <div class="tile <?php echo $category['name']; ?>_tile col-md-3">
                <h3><?php echo $category['name']; ?></h3>
            </div>
          </a>
        <?php endforeach; ?>
    </div>
</div>
<?php echo $this->render($templates . 'footer.html',$this->mime,get_defined_vars(),0); ?>
