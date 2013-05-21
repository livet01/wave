
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Merci de corriger les erreurs suivantes :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($emplacement) ) {
    $emplacement = (array)$emplacement;
}
$id = isset($emplacement['emp_id']) ? $emplacement['emp_id'] : '';
?>
<div class="admin-box">
    <h3>Emplacement</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('emplacement_emp_libelle') ? 'error' : ''; ?>">
            <?php echo form_label('Libelle de l\'Emplacement'. lang('bf_form_label_required'), 'emplacement_emp_libelle', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="emplacement_emp_libelle" type="text" name="emplacement_emp_libelle" maxlength="45" value="<?php echo set_value('emplacement_emp_libelle', isset($emplacement['emp_libelle']) ? $emplacement['emp_libelle'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('emplacement_emp_libelle'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('emplacement_rad_id') ? 'error' : ''; ?>">
            <?php echo form_label('Identifiant Radio'. lang('bf_form_label_required'), 'emplacement_rad_id', array('class' => "control-label") ); ?>
            <div class='controls'>
       	<label class="radio">
            	  <input type="radio" name="emplacement_rad_id" value="1" <?php echo (set_value('emplacement_rad_id', isset($emplacement['rad_id']) ? $emplacement['rad_id'] : '') == 1) ? "checked" : ''; ?>> Beaub'FM
            </label>	<span class="help-inline"><?php echo form_error('emplacement_rad_id'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('emplacement_emp_plus') ? 'error' : ''; ?>">
            <?php echo form_label('Type d\'emplacement'. lang('bf_form_label_required'), 'emplacement_emp_plus', array('class' => "control-label") ); ?>
            <div class='controls'>
            <label class="radio">
            	  <input type="radio" name="emplacement_emp_plus" value="0" <?php echo (set_value('emplacement_emp_plus', isset($emplacement['emp_plus']) ? $emplacement['emp_plus'] : '') == 0) ? "checked" : ''; ?>> Par défaut
            </label>
            <label class="radio">
            	  <input type="radio" name="emplacement_emp_plus" value="1" <?php echo (set_value('emplacement_emp_plus', isset($emplacement['emp_plus']) ? $emplacement['emp_plus'] : '') == 1) ? "checked" : ''; ?>> Coché si l'emplacement correspond à une émission bénévole (les disques seront dans les résultats public) (1 emplacement possible).
            </label>
            <label class="radio">
            	  <input type="radio" name="emplacement_emp_plus" value="2" <?php echo (set_value('emplacement_emp_plus', isset($emplacement['emp_plus']) ? $emplacement['emp_plus'] : '') == 2) ? "checked" : ''; ?>> Coché si l'emplacement correspond aux disques sans style (en attente de classification) (1 emplacement possible).
            </label>
            <label class="radio">
            	  <input type="radio" name="emplacement_emp_plus" value="3" <?php echo (set_value('emplacement_emp_plus', isset($emplacement['emp_plus']) ? $emplacement['emp_plus'] : '') == 3) ? "checked" : ''; ?>> Coché si l'emplacement peut être afficher dans les résultats public (plusieurs emplacements possibles).
            </label>
        <span class="help-inline"><?php echo form_error('emplacement_emp_plus'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('emplacement_emp_mail') ? 'error' : ''; ?>">
            <?php echo form_label('Email de l\'Emplacement', 'emplacement_emp_mail', array('class' => "control-label") ); ?>
            <div class='controls row'>
            	<div class="span3">
            <textarea style="width: 260px;" rows="10" cols="40" id="emplacement_emp_mail" name="emplacement_emp_mail"><?php echo set_value('emplacement_emp_mail', isset($emplacement['emp_mail']) ? $emplacement['emp_mail'] : ''); ?></textarea>
        <span class="help-inline"><?php echo (form_error('emplacement_emp_mail')=='' ? "Du code HTML peut être insérer dans le mail. Par exemple : ".htmlspecialchars("<br>")." pour faire un retour à la ligne." : form_error('emplacement_emp_mail')); ?></span>
        </div>
        <div class="span6"><h2>Liste des balises</h2><ul>
        		 	<li><code>%titre%</code> : Affiche le titre du disque</li>
        		 	<li><code>%artiste%</code> : Affiche l'artiste du disque</li>
        		 	<li><code>%diffuseur%</code> : Affiche le titre du disque</li>
        		 	<li><code>%style%</code> : Affiche le style du disque</li>
        		 	<li><code>%emplacement%</code> : Affiche l'emplacement du disque</li>
        		 	<li><code>%d_ajout%</code> : Affiche la date d'ajout du disque</li>
        		 	<li><code>%e_par%</code> : Affiche le nom du membre qui a écouté le disque</li>
        		 	<li><code>%emb%</code> : Affiche le nom de l'emission bénévole du disque</li>
        		 	</ul></div>
      	
        	</div>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Editer l'Emplacement" />
            ou <?php echo anchor(SITE_AREA .'/content/emplacement', lang('emplacement_cancel'), 'class="btn btn-warning"'); ?>
            

    <?php if ($this->auth->has_permission('Emplacement.Content.Delete')) : ?>

            ou <button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php echo lang('emplacement_delete_confirm'); ?>')">
            <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('emplacement_delete_record'); ?>
            </button>

    <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
