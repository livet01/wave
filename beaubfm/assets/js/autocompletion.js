function ac_return(field, item){
	// on met en place l'expression r�guli�re
	var regex = new RegExp('[345]', 'i');
	// on l'applique au contenu
	var nomimage = regex.exec($(item).innerHTML);
	//on r�cup�re l'id
	id = nomimage[0].replace('', '');
	// et on l'affecte au champ cach�
	$(field.name+'_id').value = id;
	// log
	$(field.name+'_log').innerHTML = '<br/><img src="personne/'+id+'.png" /> - '+$F(field.name)+'<br/>';
}