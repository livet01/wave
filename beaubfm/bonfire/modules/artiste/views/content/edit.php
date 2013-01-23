
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Merci de corriger les erreurs suivantes :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($artiste) ) {
    $artiste = (array)$artiste;
}
$id = isset($artiste['art_id']) ? $artiste['art_id'] : '';
?>
<div class="admin-box">
    <h3>Artiste</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('artiste_art_nom') ? 'error' : ''; ?>">
            <?php echo form_label('Nom de l\'artiste'. lang('bf_form_label_required'), 'artiste_art_nom', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="artiste_art_nom" type="text" name="artiste_art_nom" maxlength="150" value="<?php echo set_value('artiste_art_nom', isset($artiste['art_nom']) ? $artiste['art_nom'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('artiste_art_nom'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('artiste_rad_id') ? 'error' : ''; ?>">
            <?php echo form_label('Identifiant Radio*', 'artiste_rad_id', array('class' => "control-label") ); ?>
            <div class='controls'>
        <label class="radio">
        <input type="radio" name="artiste_rad_id" value="1" <?php echo (set_value('artiste_rad_id', isset($artiste['rad_id']) ? $artiste['rad_id'] : '') == 1) ? "checked" : ''; ?>> Beaub'FM
        <span class="help-inline"><?php echo form_error('artiste_rad_id'); ?></span>
        </label>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('artiste_edit_heading'); ?>" />
            or <?php echo anchor(SITE_AREA .'/content/artiste', lang('artiste_cancel'), 'class="btn btn-warning"'); ?>
            

    <?php if ($this->auth->has_permission('Artiste.Content.Delete')) : ?>

            or <button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php echo lang('artiste_delete_confirm'); ?>')">
            <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('artiste_delete_record'); ?>
            </button>

    <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
