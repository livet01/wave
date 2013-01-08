
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($style) ) {
    $style = (array)$style;
}
$id = isset($style['sty_id']) ? $style['sty_id'] : '';
?>
<div class="admin-box">
    <h3>Style</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('style_sty_couleur') ? 'error' : ''; ?>">
            <?php echo form_label('couleur du style de musique'. lang('bf_form_label_required'), 'style_sty_couleur', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="style_sty_couleur" type="text" name="style_sty_couleur" maxlength="15" value="<?php echo set_value('style_sty_couleur', isset($style['style_sty_couleur']) ? $style['style_sty_couleur'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('style_sty_couleur'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('style_sty_libelle') ? 'error' : ''; ?>">
            <?php echo form_label('libelle du style de musique'. lang('bf_form_label_required'), 'style_sty_libelle', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="style_sty_libelle" type="text" name="style_sty_libelle" maxlength="45" value="<?php echo set_value('style_sty_libelle', isset($style['style_sty_libelle']) ? $style['style_sty_libelle'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('style_sty_libelle'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Create Style" />
            or <?php echo anchor(SITE_AREA .'/content/style', lang('style_cancel'), 'class="btn btn-warning"'); ?>
            
        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
