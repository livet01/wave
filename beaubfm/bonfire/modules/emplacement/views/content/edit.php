
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
        <input id="emplacement_rad_id" type="text" name="emplacement_rad_id" maxlength="6" value="<?php echo set_value('emplacement_rad_id', isset($emplacement['rad_id']) ? $emplacement['rad_id'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('emplacement_rad_id'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('emplacement_emp_plus') ? 'error' : ''; ?>">
            <?php echo form_label('Emission Spéciale : 1,<br/>En Attente : 2,<br/>Sinon : 0'. lang('bf_form_label_required'), 'emplacement_emp_plus', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="emplacement_emp_plus" type="text" name="emplacement_emp_plus" maxlength="1" value="<?php echo set_value('emplacement_emp_plus', isset($emplacement['emp_plus']) ? $emplacement['emp_plus'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('emplacement_emp_plus'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('emplacement_emp_mail') ? 'error' : ''; ?>">
            <?php echo form_label('Email de l\'Emplacement', 'emplacement_emp_mail', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="emplacement_emp_mail" type="text" name="emplacement_emp_mail"  value="<?php echo set_value('emplacement_emp_mail', isset($emplacement['emp_mail']) ? $emplacement['emp_mail'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('emplacement_emp_mail'); ?></span>
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
