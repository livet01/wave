
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($parametre) ) {
    $parametre = (array)$parametre;
}
$id = isset($parametre['param_id']) ? $parametre['param_id'] : '';
?>
<div class="admin-box">
    <h3>Parametre</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('parametre_param_libelle') ? 'error' : ''; ?>">
            <?php echo form_label('libelle du parametre', 'parametre_param_libelle', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="parametre_param_libelle" type="text" name="parametre_param_libelle" maxlength="100" value="<?php echo set_value('parametre_param_libelle', isset($parametre['parametre_param_libelle']) ? $parametre['parametre_param_libelle'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('parametre_param_libelle'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('parametre_param_valeur') ? 'error' : ''; ?>">
            <?php echo form_label('valeur du parametre', 'parametre_param_valeur', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="parametre_param_valeur" type="text" name="parametre_param_valeur" maxlength="100" value="<?php echo set_value('parametre_param_valeur', isset($parametre['parametre_param_valeur']) ? $parametre['parametre_param_valeur'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('parametre_param_valeur'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Create Parametre" />
            or <?php echo anchor(SITE_AREA .'/developer/parametre', lang('parametre_cancel'), 'class="btn btn-warning"'); ?>
            
        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
