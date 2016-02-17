<div id="delete_account" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<div id="delete" class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Suppression du Compte</h4>
			</div>
			<div class="modal-body">
				<?php
				$form = new Form_View('delete_account', array(), true);
				$form->hidden('id', $user->ID());
				$form->input('pwd', '', 'Mot de passe:', 'password');
				$form->checkbox('confirm', 'Êtes vous bien sûr de vouloir supprimer votre compte?');
				$form->label('Attention, cette action est irreversible!');
				$form->submit('Supprimer');
				$form->done();
				?>
			</div>
		</div>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-body">
		<ul class="nav nav-tabs">
			<li><a data-toggle="tab" href="#tab_profil">Profil</a></li>
			<li><a data-toggle="tab" href="#tab_setting">Parametre</a></li>
			<li><a data-toggle="tab" href="#tab_security">Sécurité</a></li>
		</ul>


		<div class="tab-content">
			<div id="tab_profil" class="tab-pane fade in active">
				<?php
				$country_list = array('' => 'Sélectionnez votre pays', 'AF'=>'Afghanistan','ZA'=>'Afrique du Sud','AL'=>'Albanie','DZ'=>'Algérie','DE'=>'Allemagne','AD'=>'Andorre','AO'=>'Angola','AI'=>'Anguilla','AQ'=>'Antarctique','AG'=>'Antigua-et-Barbuda','SA'=>'Arabie saoudite','AR'=>'Argentine','AM'=>'Arménie','AW'=>'Aruba','AU'=>'Australie','AT'=>'Autriche','AZ'=>'Azerbaïdjan','BS'=>'Bahamas','BH'=>'Bahreïn','BD'=>'Bangladesh','BB'=>'Barbade','BY'=>'Bélarus','BE'=>'Belgique','BZ'=>'Belize','BJ'=>'Bénin','BM'=>'Bermudes','BT'=>'Bhoutan','BO'=>'Bolivie','BA'=>'Bosnie-Herzégovine','BW'=>'Botswana','BR'=>'Brésil','BN'=>'Brunéi Darussalam','BG'=>'Bulgarie','BF'=>'Burkina Faso','BI'=>'Burundi','KH'=>'Cambodge','CM'=>'Cameroun','CA'=>'Canada','CV'=>'Cap-Vert','EA'=>'Ceuta et Melilla','CL'=>'Chili','CN'=>'Chine','CY'=>'Chypre','CO'=>'Colombie','KM'=>'Comores','CG'=>'Congo-Brazzaville','CD'=>'Congo-Kinshasa','KP'=>'Corée du Nord','KR'=>'Corée du Sud','CR'=>'Costa Rica','CI'=>'Côte d’Ivoire','HR'=>'Croatie','CU'=>'Cuba','CW'=>'Curaçao','DK'=>'Danemark','DG'=>'Diego Garcia','DJ'=>'Djibouti','DM'=>'Dominique','EG'=>'Égypte','AE'=>'Émirats arabes unis','EC'=>'Équateur','ER'=>'Érythrée','ES'=>'Espagne','EE'=>'Estonie','VA'=>'État de la Cité du Vatican','US'=>'États-Unis','ET'=>'Éthiopie','FJ'=>'Fidji','FI'=>'Finlande','FR'=>'France','GA'=>'Gabon','GM'=>'Gambie','GE'=>'Géorgie','GS'=>'Géorgie du Sud et les îles Sandwich du Sud','GH'=>'Ghana','GI'=>'Gibraltar','GR'=>'Grèce','GD'=>'Grenade','GL'=>'Groenland','GP'=>'Guadeloupe','GU'=>'Guam','GT'=>'Guatemala','GG'=>'Guernesey','GN'=>'Guinée','GQ'=>'Guinée équatoriale','GW'=>'Guinée-Bissau','GY'=>'Guyana','GF'=>'Guyane française','HT'=>'Haïti','HN'=>'Honduras','HU'=>'Hongrie','CX'=>'Île Christmas','AC'=>'Île de l’Ascension','IM'=>'Île de Man','NF'=>'Île Norfolk','AX'=>'Îles Åland','KY'=>'Îles Caïmans','IC'=>'Îles Canaries','CC'=>'Îles Cocos (Keeling)','CK'=>'Îles Cook','FO'=>'Îles Féroé','FK'=>'Îles Malouines','MP'=>'Îles Mariannes du Nord','MH'=>'Îles Marshall','UM'=>'Îles mineures éloignées des États-Unis','SB'=>'Îles Salomon','TC'=>'Îles Turques-et-Caïques','VG'=>'Îles Vierges britanniques','VI'=>'Îles Vierges des États-Unis','IN'=>'Inde','ID'=>'Indonésie','IQ'=>'Irak','IR'=>'Iran','IE'=>'Irlande','IS'=>'Islande','IL'=>'Israël','IT'=>'Italie','JM'=>'Jamaïque','JP'=>'Japon','JE'=>'Jersey','JO'=>'Jordanie','KZ'=>'Kazakhstan','KE'=>'Kenya','KG'=>'Kirghizistan','KI'=>'Kiribati','XK'=>'Kosovo','KW'=>'Koweït','RE'=>'La Réunion','LA'=>'Laos','LS'=>'Lesotho','LV'=>'Lettonie','LB'=>'Liban','LR'=>'Libéria','LY'=>'Libye','LI'=>'Liechtenstein','LT'=>'Lituanie','LU'=>'Luxembourg','MK'=>'Macédoine','MG'=>'Madagascar','MY'=>'Malaisie','MW'=>'Malawi','MV'=>'Maldives','ML'=>'Mali','MT'=>'Malte','MA'=>'Maroc','MQ'=>'Martinique','MU'=>'Maurice','MR'=>'Mauritanie','YT'=>'Mayotte','MX'=>'Mexique','FM'=>'Micronésie','MD'=>'Moldavie','MC'=>'Monaco','MN'=>'Mongolie','ME'=>'Monténégro','MS'=>'Montserrat','MZ'=>'Mozambique','MM'=>'Myanmar','NA'=>'Namibie','NR'=>'Nauru','NP'=>'Népal','NI'=>'Nicaragua','NE'=>'Niger','NG'=>'Nigéria','NU'=>'Niue','NO'=>'Norvège','NC'=>'Nouvelle-Calédonie','NZ'=>'Nouvelle-Zélande','OM'=>'Oman','UG'=>'Ouganda','UZ'=>'Ouzbékistan','PK'=>'Pakistan','PW'=>'Palaos','PA'=>'Panama','PG'=>'Papouasie-Nouvelle-Guinée','PY'=>'Paraguay','NL'=>'Pays-Bas','BQ'=>'Pays-Bas caribéens','PE'=>'Pérou','PH'=>'Philippines','PN'=>'Pitcairn','PL'=>'Pologne','PF'=>'Polynésie française','PR'=>'Porto Rico','PT'=>'Portugal','QA'=>'Qatar','HK'=>'R.A.S. chinoise de Hong Kong','MO'=>'R.A.S. chinoise de Macao','CF'=>'République centrafricaine','DO'=>'République dominicaine','CZ'=>'République tchèque','RO'=>'Roumanie','GB'=>'Royaume-Uni','RU'=>'Russie','RW'=>'Rwanda','EH'=>'Sahara occidental','BL'=>'Saint-Barthélemy','KN'=>'Saint-Christophe-et-Niévès','SM'=>'Saint-Marin','MF'=>'Saint-Martin (France)','SX'=>'Saint-Martin (Pays-Bas)','PM'=>'Saint-Pierre-et-Miquelon','VC'=>'Saint-Vincent-et-les Grenadines','SH'=>'Sainte-Hélène','LC'=>'Sainte-Lucie','SV'=>'Salvador','WS'=>'Samoa','AS'=>'Samoa américaines','ST'=>'Sao Tomé-et-Principe','SN'=>'Sénégal','RS'=>'Serbie','SC'=>'Seychelles','SL'=>'Sierra Leone','SG'=>'Singapour','SK'=>'Slovaquie','SI'=>'Slovénie','SO'=>'Somalie','SD'=>'Soudan','SS'=>'Soudan du Sud','LK'=>'Sri Lanka','SE'=>'Suède','CH'=>'Suisse','SR'=>'Suriname','SJ'=>'Svalbard et Jan Mayen','SZ'=>'Swaziland','SY'=>'Syrie','TJ'=>'Tadjikistan','TW'=>'Taïwan','TZ'=>'Tanzanie','TD'=>'Tchad','TF'=>'Terres australes françaises','IO'=>'Territoire britannique de l’océan Indien','PS'=>'Territoires palestiniens','TH'=>'Thaïlande','TL'=>'Timor oriental','TG'=>'Togo','TK'=>'Tokelau','TO'=>'Tonga','TT'=>'Trinité-et-Tobago','TA'=>'Tristan da Cunha','TN'=>'Tunisie','TM'=>'Turkménistan','TR'=>'Turquie','TV'=>'Tuvalu','UA'=>'Ukraine','UY'=>'Uruguay','VU'=>'Vanuatu','VE'=>'Venezuela','VN'=>'Vietnam','WF'=>'Wallis-et-Futuna','YE'=>'Yémen','ZM'=>'Zambie','ZW'=>'Zimbabwe');
				$data = array(
					'username' => $user->Username(),
					'country' => $user->Country(),
					'birtdate' => $user->Birtdate()
				);
				//ssdccxxsdf - Julie

				$form = new Form_View('edit_profil', $data, true);
				$form->horizontal();
				$form->label('Profil', 3);
				$form->input('username', '', 'Nom', 'text');
				$form->select('country', $country_list, 'Pays');
				$form->input('birtdate', '', 'Date de naissence', 'datetime');
				$form->submit('Envoyer');
				$form->done();
				?>
				<hr>
				<?php
				$form = new Form_View('change_pwd', array(), true);
				$form->horizontal();
				$form->label('Changement de mot de passe', 3);
				$form->input('pwd', '', 'Mot de passe', 'password');
				$form->input('new_pwd', '', 'Nouveau mot de passe', 'password');
				$form->input('new_pwd_conf', '', 'Confirmez le mot de passe', 'password');
				$form->submit('Envoyer');
				$form->done();
				?>
			</div>
			<div id="tab_setting" class="tab-pane fade">
				<?php
				$language_list = array('FR' => 'Français', 'EN' => 'English');
				$style_list = array('default' => 'Défaut');
				
				$form = new Form_View('user_setting', $data, true);
				$form->horizontal();
				$form->label('Parametre', 3);
				$form->select('language', $language_list, 'Langage');
				$form->select('style', $style_list, 'Style du site');
				$form->submit('Envoyer');
				$form->done();
				?>
			</div>
			<div id="tab_security" class="tab-pane fade">
				<div class="row">
					<div class="col-sm-offset-2 col-sm-10">
						<div style="margin-bottom:25px;">
							<h3>Sécurité</h3>
						</div>

						<div style="margin-bottom:25px;">
							<h4>Condition d'utilisateur</h4>
							<p>aa</p>
						</div>

						<div style="margin-bottom:25px;">
							<h4>Suppression du compte</h4>
							<p>Cette action est irreversible. Soyez sur de vous avant de suprémer votre comptre, car vous ne pouriez plus le récupérer après!</p>
							<button type="button" class="btn btn-danger btn-block" onclick="$('#delete_account').modal()">Suppression du compte</button>
						</div>
					</div>
				</div>
			</div> 
		</div>
	</div>
</div>