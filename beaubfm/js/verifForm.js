function surligne(champ, erreur)
{
   if(erreur)
      champ.style.backgroundColor = "#EB9E9E";
   else
      champ.style.backgroundColor = "#ACCEA6";
}

function verifTitre(champ)
{
   if(champ.value.length < 2 || champ.value.length > 25)
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}
function verifArtiste(champ)
{
   if(champ.value.length < 2 || champ.value.length > 25)
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}
function verifEmBen(champ)
{
   if(champ.value.length < 2 || champ.value.length > 25)
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}
function verifEcoutePar(champ)
{
   if(champ.value.length < 2 || champ.value.length > 25)
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}
function verifDiffuseur(champ)
{
   if(champ.value.length < 2 || champ.value.length > 25)
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}


function verifMail(champ)
{
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(!regex.test(champ.value))
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

function verifForm(f)
{
   var titreOk = verifTitre(f.titre);
   var mailOk = verifMail(f.email);
   var artisteOk = verifArtiste(f.artiste);
   var emBenevoleOk = verifEmBen(f.emBev);
   var ecouteParOk = verifEcoutePar(f.listenBy);
   var diffuseurOk = verifDiffuseur(f.diffuseur);
   
   if(titreOk && mailOk && artisteOk && emBenevoleOk && ecouteParOk && diffuseurOk)
      return true;
   else
   {
      alert("Veuillez remplir correctement tous les champs");
      return false;
   }
}

function submitform()
{
    document.forms["fiche"].submit();
}
