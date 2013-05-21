
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Merci de corriger les erreurs suivantes :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($emission_benevole) ) {
    $emission_benevole = (array)$emission_benevole;
}
$id = isset($emission_benevole['emb_id']) ? $emission_benevole['emb_id'] : '';
?>
<div class="admin-box">
    <h3>Emission Bénévole</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('emission_benevole_emb_libelle') ? 'error' : ''; ?>">
            <?php echo form_label('Nom de l\'emmision bénévole'. lang('bf_form_label_required'), 'emission_benevole_emb_libelle', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="emission_benevole_emb_libelle" type="text" name="emission_benevole_emb_libelle" maxlength="150" value="<?php echo set_value('emission_benevole_emb_libelle', isset($emission_benevole['emb_libelle']) ? $emission_benevole['emb_libelle'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('emission_benevole_emb_libelle'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('emission_benevole_rad_id') ? 'error' : ''; ?>">
            <?php echo form_label('Identifiant Radio'. lang('bf_form_label_required'), 'emission_benevole_rad_id', array('class' => "control-label") ); ?>
        <div class='controls'>
           <label class="radio">
        <input type="radio" name="emission_benevole_rad_id" value="1" <?php echo (set_value('emission_benevole_rad_id', isset($emission_benevole['rad_id']) ? $emission_benevole['rad_id'] : '') == 1) ? "checked" : ''; ?>> Beaub'FM
        <span class="help-inline"><?php echo form_error('emission_benevole_rad_id'); ?></span>
        </label>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('emission_benevole_edit_heading'); ?>" />
            ou <?php echo anchor(SITE_AREA .'/content/emission_benevole', lang('emission_benevole_cancel'), 'class="btn btn-warning"'); ?>
            

    <?php if ($this->auth->has_permission('Emission_Benevole.Content.Delete')) : ?>

            or <button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php echo lang('emission_benevole_delete_confirm'); ?>')">
            <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('emission_benevole_delete_record'); ?>
            </button>

    <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
