-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 30 Mars 2016 à 17:17
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `story_hub`
--

-- --------------------------------------------------------

--
-- Structure de la table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `table` varchar(32) NOT NULL,
  `id` varchar(32) NOT NULL,
  `fr` text NOT NULL,
  `en` text NOT NULL,
  PRIMARY KEY (`table`,`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `resources`
--

INSERT INTO `resources` (`table`, `id`, `fr`, `en`) VALUES
('categories', 'AC', 'Action', ''),
('categories', 'AV', 'Aventure', ''),
('categories', 'HR', 'Horreur', ''),
('categories', 'OT', 'Autre', ''),
('categories', 'SF', 'Sci-Fi', ''),
('countries', 'AC', 'Île de l’Ascension', ''),
('countries', 'AD', 'Andorre', ''),
('countries', 'AE', 'Émirats arabes unis', ''),
('countries', 'AF', 'Afghanistan', ''),
('countries', 'AG', 'Antigua-et-Barbuda', ''),
('countries', 'AI', 'Anguilla', ''),
('countries', 'AL', 'Albanie', ''),
('countries', 'AM', 'Arménie', ''),
('countries', 'AO', 'Angola', ''),
('countries', 'AQ', 'Antarctique', ''),
('countries', 'AR', 'Argentine', ''),
('countries', 'AS', 'Samoa américaines', ''),
('countries', 'AT', 'Autriche', ''),
('countries', 'AU', 'Australie', ''),
('countries', 'AW', 'Aruba', ''),
('countries', 'AX', 'Îles Åland', ''),
('countries', 'AZ', 'Azerbaïdjan', ''),
('countries', 'BA', 'Bosnie-Herzégovine', ''),
('countries', 'BB', 'Barbade', ''),
('countries', 'BD', 'Bangladesh', ''),
('countries', 'BE', 'Belgique', ''),
('countries', 'BF', 'Burkina Faso', ''),
('countries', 'BG', 'Bulgarie', ''),
('countries', 'BH', 'Bahreïn', ''),
('countries', 'BI', 'Burundi', ''),
('countries', 'BJ', 'Bénin', ''),
('countries', 'BL', 'Saint-Barthélemy', ''),
('countries', 'BM', 'Bermudes', ''),
('countries', 'BN', 'Brunéi Darussalam', ''),
('countries', 'BO', 'Bolivie', ''),
('countries', 'BQ', 'Pays-Bas caribéens', ''),
('countries', 'BR', 'Brésil', ''),
('countries', 'BS', 'Bahamas', ''),
('countries', 'BT', 'Bhoutan', ''),
('countries', 'BW', 'Botswana', ''),
('countries', 'BY', 'Bélarus', ''),
('countries', 'BZ', 'Belize', ''),
('countries', 'CA', 'Canada', ''),
('countries', 'CC', 'Îles Cocos (Keeling)', ''),
('countries', 'CD', 'Congo-Kinshasa', ''),
('countries', 'CF', 'République centrafricaine', ''),
('countries', 'CG', 'Congo-Brazzaville', ''),
('countries', 'CH', 'Suisse', ''),
('countries', 'CI', 'Côte d’Ivoire', ''),
('countries', 'CK', 'Îles Cook', ''),
('countries', 'CL', 'Chili', ''),
('countries', 'CM', 'Cameroun', ''),
('countries', 'CN', 'Chine', ''),
('countries', 'CO', 'Colombie', ''),
('countries', 'CR', 'Costa Rica', ''),
('countries', 'CU', 'Cuba', ''),
('countries', 'CV', 'Cap-Vert', ''),
('countries', 'CW', 'Curaçao', ''),
('countries', 'CX', 'Île Christmas', ''),
('countries', 'CY', 'Chypre', ''),
('countries', 'CZ', 'République tchèque', ''),
('countries', 'DE', 'Allemagne', ''),
('countries', 'DG', 'Diego Garcia', ''),
('countries', 'DJ', 'Djibouti', ''),
('countries', 'DK', 'Danemark', ''),
('countries', 'DM', 'Dominique', ''),
('countries', 'DO', 'République dominicaine', ''),
('countries', 'DZ', 'Algérie', ''),
('countries', 'EA', 'Ceuta et Melilla', ''),
('countries', 'EC', 'Équateur', ''),
('countries', 'EE', 'Estonie', ''),
('countries', 'EG', 'Égypte', ''),
('countries', 'EH', 'Sahara occidental', ''),
('countries', 'ER', 'Érythrée', ''),
('countries', 'ES', 'Espagne', ''),
('countries', 'ET', 'Éthiopie', ''),
('countries', 'FI', 'Finlande', ''),
('countries', 'FJ', 'Fidji', ''),
('countries', 'FK', 'Îles Malouines', ''),
('countries', 'FM', 'Micronésie', ''),
('countries', 'FO', 'Îles Féroé', ''),
('countries', 'FR', 'France', ''),
('countries', 'GA', 'Gabon', ''),
('countries', 'GB', 'Royaume-Uni', ''),
('countries', 'GD', 'Grenade', ''),
('countries', 'GE', 'Géorgie', ''),
('countries', 'GF', 'Guyane française', ''),
('countries', 'GG', 'Guernesey', ''),
('countries', 'GH', 'Ghana', ''),
('countries', 'GI', 'Gibraltar', ''),
('countries', 'GL', 'Groenland', ''),
('countries', 'GM', 'Gambie', ''),
('countries', 'GN', 'Guinée', ''),
('countries', 'GP', 'Guadeloupe', ''),
('countries', 'GQ', 'Guinée équatoriale', ''),
('countries', 'GR', 'Grèce', ''),
('countries', 'GS', 'Géorgie du Sud et les îles Sandwich du Sud', ''),
('countries', 'GT', 'Guatemala', ''),
('countries', 'GU', 'Guam', ''),
('countries', 'GW', 'Guinée-Bissau', ''),
('countries', 'GY', 'Guyana', ''),
('countries', 'HK', 'R.A.S. chinoise de Hong Kong', ''),
('countries', 'HN', 'Honduras', ''),
('countries', 'HR', 'Croatie', ''),
('countries', 'HT', 'Haïti', ''),
('countries', 'HU', 'Hongrie', ''),
('countries', 'IC', 'Îles Canaries', ''),
('countries', 'ID', 'Indonésie', ''),
('countries', 'IE', 'Irlande', ''),
('countries', 'IL', 'Israël', ''),
('countries', 'IM', 'Île de Man', ''),
('countries', 'IN', 'Inde', ''),
('countries', 'IO', 'Territoire britannique de l’océan Indien', ''),
('countries', 'IQ', 'Irak', ''),
('countries', 'IR', 'Iran', ''),
('countries', 'IS', 'Islande', ''),
('countries', 'IT', 'Italie', ''),
('countries', 'JE', 'Jersey', ''),
('countries', 'JM', 'Jamaïque', ''),
('countries', 'JO', 'Jordanie', ''),
('countries', 'JP', 'Japon', ''),
('countries', 'KE', 'Kenya', ''),
('countries', 'KG', 'Kirghizistan', ''),
('countries', 'KH', 'Cambodge', ''),
('countries', 'KI', 'Kiribati', ''),
('countries', 'KM', 'Comores', ''),
('countries', 'KN', 'Saint-Christophe-et-Niévès', ''),
('countries', 'KP', 'Corée du Nord', ''),
('countries', 'KR', 'Corée du Sud', ''),
('countries', 'KW', 'Koweït', ''),
('countries', 'KY', 'Îles Caïmans', ''),
('countries', 'KZ', 'Kazakhstan', ''),
('countries', 'LA', 'Laos', ''),
('countries', 'LB', 'Liban', ''),
('countries', 'LC', 'Sainte-Lucie', ''),
('countries', 'LI', 'Liechtenstein', ''),
('countries', 'LK', 'Sri Lanka', ''),
('countries', 'LR', 'Libéria', ''),
('countries', 'LS', 'Lesotho', ''),
('countries', 'LT', 'Lituanie', ''),
('countries', 'LU', 'Luxembourg', ''),
('countries', 'LV', 'Lettonie', ''),
('countries', 'LY', 'Libye', ''),
('countries', 'MA', 'Maroc', ''),
('countries', 'MC', 'Monaco', ''),
('countries', 'MD', 'Moldavie', ''),
('countries', 'ME', 'Monténégro', ''),
('countries', 'MF', 'Saint-Martin (France)', ''),
('countries', 'MG', 'Madagascar', ''),
('countries', 'MH', 'Îles Marshall', ''),
('countries', 'MK', 'Macédoine', ''),
('countries', 'ML', 'Mali', ''),
('countries', 'MM', 'Myanmar', ''),
('countries', 'MN', 'Mongolie', ''),
('countries', 'MO', 'R.A.S. chinoise de Macao', ''),
('countries', 'MP', 'Îles Mariannes du Nord', ''),
('countries', 'MQ', 'Martinique', ''),
('countries', 'MR', 'Mauritanie', ''),
('countries', 'MS', 'Montserrat', ''),
('countries', 'MT', 'Malte', ''),
('countries', 'MU', 'Maurice', ''),
('countries', 'MV', 'Maldives', ''),
('countries', 'MW', 'Malawi', ''),
('countries', 'MX', 'Mexique', ''),
('countries', 'MY', 'Malaisie', ''),
('countries', 'MZ', 'Mozambique', ''),
('countries', 'NA', 'Namibie', ''),
('countries', 'NC', 'Nouvelle-Calédonie', ''),
('countries', 'NE', 'Niger', ''),
('countries', 'NF', 'Île Norfolk', ''),
('countries', 'NG', 'Nigéria', ''),
('countries', 'NI', 'Nicaragua', ''),
('countries', 'NL', 'Pays-Bas', ''),
('countries', 'NO', 'Norvège', ''),
('countries', 'NP', 'Népal', ''),
('countries', 'NR', 'Nauru', ''),
('countries', 'NU', 'Niue', ''),
('countries', 'NZ', 'Nouvelle-Zélande', ''),
('countries', 'OM', 'Oman', ''),
('countries', 'PA', 'Panama', ''),
('countries', 'PE', 'Pérou', ''),
('countries', 'PF', 'Polynésie française', ''),
('countries', 'PG', 'Papouasie-Nouvelle-Guinée', ''),
('countries', 'PH', 'Philippines', ''),
('countries', 'PK', 'Pakistan', ''),
('countries', 'PL', 'Pologne', ''),
('countries', 'PM', 'Saint-Pierre-et-Miquelon', ''),
('countries', 'PN', 'Pitcairn', ''),
('countries', 'PR', 'Porto Rico', ''),
('countries', 'PS', 'Territoires palestiniens', ''),
('countries', 'PT', 'Portugal', ''),
('countries', 'PW', 'Palaos', ''),
('countries', 'PY', 'Paraguay', ''),
('countries', 'QA', 'Qatar', ''),
('countries', 'RE', 'La Réunion', ''),
('countries', 'RO', 'Roumanie', ''),
('countries', 'RS', 'Serbie', ''),
('countries', 'RU', 'Russie', ''),
('countries', 'RW', 'Rwanda', ''),
('countries', 'SA', 'Arabie saoudite', ''),
('countries', 'SB', 'Îles Salomon', ''),
('countries', 'SC', 'Seychelles', ''),
('countries', 'SD', 'Soudan', ''),
('countries', 'SE', 'Suède', ''),
('countries', 'SG', 'Singapour', ''),
('countries', 'SH', 'Sainte-Hélène', ''),
('countries', 'SI', 'Slovénie', ''),
('countries', 'SJ', 'Svalbard et Jan Mayen', ''),
('countries', 'SK', 'Slovaquie', ''),
('countries', 'SL', 'Sierra Leone', ''),
('countries', 'SM', 'Saint-Marin', ''),
('countries', 'SN', 'Sénégal', ''),
('countries', 'SO', 'Somalie', ''),
('countries', 'SR', 'Suriname', ''),
('countries', 'SS', 'Soudan du Sud', ''),
('countries', 'ST', 'Sao Tomé-et-Principe', ''),
('countries', 'SV', 'Salvador', ''),
('countries', 'SX', 'Saint-Martin (Pays-Bas)', ''),
('countries', 'SY', 'Syrie', ''),
('countries', 'SZ', 'Swaziland', ''),
('countries', 'TA', 'Tristan da Cunha', ''),
('countries', 'TC', 'Îles Turques-et-Caïques', ''),
('countries', 'TD', 'Tchad', ''),
('countries', 'TF', 'Terres australes françaises', ''),
('countries', 'TG', 'Togo', ''),
('countries', 'TH', 'Thaïlande', ''),
('countries', 'TJ', 'Tadjikistan', ''),
('countries', 'TK', 'Tokelau', ''),
('countries', 'TL', 'Timor oriental', ''),
('countries', 'TM', 'Turkménistan', ''),
('countries', 'TN', 'Tunisie', ''),
('countries', 'TO', 'Tonga', ''),
('countries', 'TR', 'Turquie', ''),
('countries', 'TT', 'Trinité-et-Tobago', ''),
('countries', 'TV', 'Tuvalu', ''),
('countries', 'TW', 'Taïwan', ''),
('countries', 'TZ', 'Tanzanie', ''),
('countries', 'UA', 'Ukraine', ''),
('countries', 'UG', 'Ouganda', ''),
('countries', 'UM', 'Îles mineures éloignées des États-Unis', ''),
('countries', 'US', 'États-Unis', ''),
('countries', 'UY', 'Uruguay', ''),
('countries', 'UZ', 'Ouzbékistan', ''),
('countries', 'VA', 'État de la Cité du Vatican', ''),
('countries', 'VC', 'Saint-Vincent-et-les Grenadines', ''),
('countries', 'VE', 'Venezuela', ''),
('countries', 'VG', 'Îles Vierges britanniques', ''),
('countries', 'VI', 'Îles Vierges des États-Unis', ''),
('countries', 'VN', 'Vietnam', ''),
('countries', 'VU', 'Vanuatu', ''),
('countries', 'WF', 'Wallis-et-Futuna', ''),
('countries', 'WS', 'Samoa', ''),
('countries', 'XK', 'Kosovo', ''),
('countries', 'YE', 'Yémen', ''),
('countries', 'YT', 'Mayotte', ''),
('countries', 'ZA', 'Afrique du Sud', ''),
('countries', 'ZM', 'Zambie', ''),
('countries', 'ZW', 'Zimbabwe', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
