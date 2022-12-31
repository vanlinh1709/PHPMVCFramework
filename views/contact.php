<?php
/** @var $this \linhtv\phpmvc\View */
/** @var $this \linhtv\phpmvc\ContactForm */
$this->title = 'Contact us'
?>
<h1>Contact Us</h1>
<?php $form = \linhtv\phpmvc\form\Form::begin('', 'post')?>
<?php echo $form->field($model, 'subject')?>
<?php echo $form->field($model, 'email')?>
<?php echo new \linhtv\phpmvc\form\TextareaField($model, 'body') ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php \linhtv\phpmvc\form\Form::end()?>
