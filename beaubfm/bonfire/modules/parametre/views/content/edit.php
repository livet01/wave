<div class="row-fluid">
	<div class="span8 offset2">
		<div class="alert alert-info fade in">
		  <a data-dismiss="alert" class="close">&times;</a>
			<h4 class="alert-heading">Pour rajouter une option, ajouter un point-virgule et écrire l'option sans ajouter d'espaces.</h4>
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
if( isset($parametre) ) {
    $parametre = (array)$parametre;
}
$id = isset($parametre['param_id']) ? $parametre['param_id'] : '';
?>
<div class="admin-box">
    <h3>Paramètre</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
    	<div class="control-group <?php echo form_error('parametre_param_libelle') ? 'error' : ''; ?>">   
    		<?php echo form_label('Libelle du Paramètre', 'parametre_param_libelle', array('class' => "control-label") ); ?>
            <div class='controls'>
        		<input id="parametre_param_libelle" readonly="readonly"" type="text" name="parametre_param_libelle" maxlength="100" value="<?php echo set_value('param_libelle', isset($parametre['param_libelle']) ? $parametre['param_libelle'] : ''); ?>"  />
        		<span class="help-inline"><?php echo form_error('parametre_param_libelle'); ?></span>
      		</div>
      	</div>
    	<div class="control-group <?php echo form_error('parametre_param_valeur') ? 'error' : ''; ?>">        	
            <?php echo form_label('Valeur du Paramètre', 'parametre_param_valeur', array('class' => "control-label") ); ?>
            <div class='controls'>
        		<input id="parametre_param_valeur" type="text" name="parametre_param_valeur" maxlength="100" value="<?php echo set_value('param_valeur', isset($parametre['param_valeur']) ? $parametre['param_valeur'] : ''); ?>"  />
      			<span class="help-inline"><?php echo form_error('parametre_param_valeur'); ?></span>
      		</div>
        </div>
        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Editer le Paramètre" />
            ou <?php echo anchor(SITE_AREA .'/content/parametre', lang('parametre_cancel'), 'class="btn btn-warning"'); ?>
        </div>
    </fieldset>
    <?php echo form_close(); ?>
</div>
