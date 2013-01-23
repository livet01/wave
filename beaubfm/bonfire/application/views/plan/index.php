<div class="page-header">
	<h1>Plan du Site</h1>
</div>
<?php if ($this->auth->has_permission('Site.Signin.Allow')) : ?>
<div class="page-header">
	<h2>Gestion discographique</h2>
</div>
<ul>
	<li>
		<h3>Wave</h3>
		<p>
			Accueil de l'application.
		</p>
	</li>
	<?php if ($this->auth->has_permission('Wave.Recherche.Disque')) : ?>
	<li>
		<h3>Rechercher</h3>
		<p>
			Permet d'effectuer des recherches multi-critères sur les disques (titre/artiste/label) et de visualiser l'intégralité des informations concernant un disque.
		</p>
	</li>
	<?php endif; ?>
	<?php if ($this->auth->has_permission('Wave.Ajouter.Disque')) : ?>
	<li>
		<h3>Ajouter un disque</h3>
		<p>
			Permet d'ajouter un disque à la base de données.
		</p>
	</li>
	<?php endif; ?>
	<?php if ($this->auth->has_permission('Wave.Importer.Disque')) : ?>
	<li>
		<h3>Importer</h3>
		<p>
			Permet d'importer un fichier CSV ou XLS contenant des disques. L'import peut être effectué depuis un fichier provenant de cette application ou bien d'un fichier provenant de l'application GCstar.
		</p>
	</li>
	<?php endif; ?>
	<?php if ($this->auth->has_permission('Wave.Importer.Disque')) : ?>
	<li>
		<h3>Disques incorrects</h3>
		<p>
			Ce menu apparaît lorsque lors d'un import, certains disques ont été analysés comme contenant des erreurs ou possédant des champs manquants. Tous les membres pourront modifier les erreurs des imports des autres membres.
		</p>
	</li>
	<?php endif; ?>
</ul>
<?php endif; ?>
<?php if ($this->auth->has_permission('Site.Content.View')) : ?>
<div class="page-header"></div>
<div class="page-header">
	<h2>Panneau d'administration</h2>
</div>
<ul>
	<?php if ($this->auth->has_permission('Site.Content.View')) : ?>
	<li>
		<h3>Contenu</h3>
		<p>
			Permet de gérer les données possibles pour les disques.
		</p>
		<ul>
			<?php if ($this->auth->has_permission('Emplacement.Content.View')) : ?>
			<li>
				<h4>Emplacement</h4>
				<p>
					Permet de gérer les emplacements possibles pour les disques dans toute l'application.
				</p>
			</li>
			<?php endif; ?>
			<?php if ($this->auth->has_permission('Parametre.Content.View')) : ?>
			<li>
				<h4>Paramètre</h4>
				<p>
					Permet de gérer les paramètres possibles pour les disques dans toute l'application.
				</p>
			</li>
			<?php endif; ?>
			<?php if ($this->auth->has_permission('Style.Content.View')) : ?>
			<li>
				<h4>Style</h4>
				<p>
					Permet de gérer les styles possibles pour les disques dans toute l'application.
				</p>
			</li>
			<?php endif; ?>
		</ul>
	</li>
	<?php endif; ?>
	<?php if ($this->auth->has_permission('Site.Reports.View')) : ?>
	<li>
		<h3>Rapports</h3>
		<p>
			Permet de visualiser les rapports de l'application.
		</p>
		<?php if ($this->auth->has_permission('Bonfire.Activities.View')) : ?>
		<ul>
			<li>
				<h4>Activités</h4>
				<p>
					Permet de visualiser et de gérer les rapports d'activités des utilisateurs et des modules.
				</p>
			</li>
		</ul>
		<?php endif; ?>
	</li>
	<?php endif; ?>
	<?php if ($this->auth->has_permission('Site.Settings.View')) : ?>
	<li>
		<h3>Paramètres</h3>
		<p>
			Permet de gérer les paramètres des modules de l'application.
		</p>
		<ul>
			<?php if ($this->auth->has_permission('Bonfire.Users.View')) : ?>
			<li>
				<h4>Utilisateurs</h4>
				<p>
					Permet de gérer les utilisateurs.
				</p>
			</li>
			<?php endif; ?>
			<?php if ($this->auth->has_permission('Bonfire.Emailer.View')) : ?>
			<li>
				<h4>Email</h4>
				<p>
					Permet de gérer les paramètres des emails.
				</p>
			</li>
			<?php endif; ?>
			<?php if ($this->auth->has_permission('Bonfire.Roles.View')) : ?>
			<li>
				<h4>Rôles</h4>
				<p>
					Permet de gérer les rôles, et de gérer leurs permissions.
				</p>
			</li>
			<?php endif; ?>
			<?php if ($this->auth->has_permission('Bonfire.Settings.View')) : ?>
			<li>
				<h4>Paramètres</h4>
				<p>
					Permet de gérer les paramètres globaux de l'application.
				</p>
			</li>
			<?php endif; ?>
		</ul>
	</li>
	<?php endif; ?>
	<?php if ($this->auth->has_permission('Site.Developer.View')) : ?>
	<li>
		<h3>Développeur</h3>
		<p>
			Permet de gérer l'application.
		</p>
		<ul>
			<?php if ($this->auth->has_permission('Bonfire.Database.View')) : ?>
			<li>
				<h4>Base de données</h4>
				<p>
					Permet de gérer les sauvegardes de la base de données et d'en restaurer un état antérieur.
				</p>
			</li>
			<?php endif; ?>
			<?php if ($this->auth->has_permission('Bonfire.Sysinfo.View')) : ?>
			<li>
				<h4>Information Système</h4>
				<p>
					Permet de visualiser les informations du système.
				</p>
			</li>
			<?php endif; ?>
			<?php if ($this->auth->has_permission('Bonfire.Logs.View')) : ?>
			<li>
				<h4>Journaux</h4>
				<p>
					Permet de gérer les journaux d'activités de l'application.
				</p>
			</li>
			<?php endif; ?>
		</ul>
	</li>
	<?php endif; ?>
</ul>
<?php endif; ?>