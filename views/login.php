<?php ?>
<h1>Login</h1>
<?php $form =  \linhtv\phpmvc\form\Form::begin('','post')?>

<?php echo $form->field($model, 'email')?>
<?php echo $form->field($model, 'password')->passwordField()?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php echo \linhtv\phpmvc\form\Form::end()?>