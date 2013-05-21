<div class="row-fluid">
	<div class="span8 offset2">
		<div class="alert alert-info fade in">
		  <a data-dismiss="alert" class="close">&times;</a>
			<h4 class="alert-heading">La couleur du style peut s'écrire de trois façons :</h4>
			<ul>
				<li>En anglais directement.</li>
				<li>En rgb (par exemple pour du noir écrire : rgb(0,0,0))</li>
				<li>En hexadecimal (par exemple pour du blanc écrire : #FFFFFF)</li>
			</ul>
			<h4>Une bonne écriture permettra l'affichage de la couleur dans tout le site.</h4>
			<?php if (isset($password_hints) ) echo $password_hints; ?>
		</div>
	</div>
</div>
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Merci de corriger les erreurs suivantes :</h4>
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
            <?php echo form_label('Couleur du Style'. lang('bf_form_label_required'), 'style_sty_couleur', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="style_sty_couleur" type="text" name="style_sty_couleur" maxlength="16" value="<?php echo set_value('style_sty_couleur', isset($style['style_sty_couleur']) ? $style['style_sty_couleur'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('style_sty_couleur'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('style_sty_libelle') ? 'error' : ''; ?>">
            <?php echo form_label('Libelle du Style'. lang('bf_form_label_required'), 'style_sty_libelle', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="style_sty_libelle" type="text" name="style_sty_libelle" maxlength="45" value="<?php echo set_value('style_sty_libelle', isset($style['style_sty_libelle']) ? $style['style_sty_libelle'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('style_sty_libelle'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Créer un Style" />
            ou <?php echo anchor(SITE_AREA .'/content/style', lang('style_cancel'), 'class="btn btn-warning"'); ?>
            
        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
