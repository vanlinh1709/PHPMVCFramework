<h1>Register</h1>
<?php $form = \app\core\form\Form::begin('', 'post')?>
    <?php echo $form->field($registerModel, 'firstname')?>
    <?php echo $form->field($registerModel, 'lastname')?>
    <?php echo $form->field($registerModel, 'email')?>
    <?php echo $form->field($registerModel, 'password')->passwordField()?>
    <?php echo $form->field($registerModel, 'confirmPassword')->passwordField()?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php echo \app\core\form\Form::end()?>
