<?php echo $this->render($templates . 'header.html',$this->mime,get_defined_vars(),0); ?>
<?php if ($GET['success']==1): ?>
<p>
  SUCCESS
</p>
<?php endif; ?>
<?php echo $this->render($templates . 'dataForm.html',$this->mime,get_defined_vars(),0); ?>
<?php echo $this->render($templates . 'footer.html',$this->mime,get_defined_vars(),0); ?>
