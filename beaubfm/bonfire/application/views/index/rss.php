<?php 
echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
?>
<rss version="2.0"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="http://purl.org/rss/1.0/modules/content/">

    <channel>
    
    <title>BeaubFM - Flux RSS</title>

    <link><?php echo site_url('index/rss'); ?></link>
    <description>Derniers titres de Beaub'fm</description>
    <dc:language>fr</dc:language>
    <dc:creator>Wave - Gestion de discographie</dc:creator>

    <dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>

    <?php if(isset($resultat)) {
    	 for($i=0;$i<50;$i++): 
    		$ligne = $resultat[$i]; ?>
        <item>

          <title><?php echo xml_convert($ligne['dis_libelle']); ?></title>
          <description><![CDATA[Le titre <strong><?php echo $ligne['dis_libelle']; ?></strong> a été ajouté. <br>Son artiste : <?php echo $ligne['art_nom']; ?><br>Son diffuseur : <?php echo $ligne['per_nom']; ?>]]></description>
          <link><?php echo site_url('home'); ?></link>
        </item>

        
    <?php endfor; } ?>
    
    </channel></rss> 

