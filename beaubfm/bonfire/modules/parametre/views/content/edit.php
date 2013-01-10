
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Merci de corriger les erreurs suivantes :</h4>
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
        <div class="control-group <?php echo form_error('parametre_param_valeur') ? 'error' : ''; ?>">
            <?php echo form_label('Valeur du Parametre', 'parametre_param_valeur', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="parametre_param_valeur" type="text" name="parametre_param_valeur" maxlength="100" value="<?php echo set_value('param_valeur', isset($parametre['param_valeur']) ? $parametre['param_valeur'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('parametre_param_valeur'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Editer le Parametre" />
            ou <?php echo anchor(SITE_AREA .'/content/parametre', lang('parametre_cancel'), 'class="btn btn-warning"'); ?>
            

    <?php if ($this->auth->has_permission('Parametre.Content.Delete')) : ?>

            ou <button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php echo lang('parametre_delete_confirm'); ?>')">
            <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('parametre_delete_record'); ?>
            </button>

    <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
