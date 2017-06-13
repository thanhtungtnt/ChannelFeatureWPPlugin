-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2017 at 11:37 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `setvnow`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_tnt_channel`
--

CREATE TABLE `wp_tnt_channel` (
  `channel_id` int(11) NOT NULL,
  `channel_name` varchar(255) DEFAULT NULL,
  `channel_cat` int(11) DEFAULT '0',
  `channel_number` int(11) DEFAULT '0',
  `channel_image` int(11) DEFAULT '0',
  `channel_country` int(11) DEFAULT '0',
  `channel_language` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `wp_tnt_channel_cats`
--

CREATE TABLE `wp_tnt_channel_cats` (
  `chcat_id` int(11) NOT NULL,
  `chcat_name` varchar(255) NOT NULL,
  `chcat_parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_tnt_channel_cats`
--

INSERT INTO `wp_tnt_channel_cats` (`chcat_id`, `chcat_name`, `chcat_parent`) VALUES
(2, 'Sport', 0),
(3, 'Health', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_tnt_countries`
--

CREATE TABLE `wp_tnt_countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_tnt_countries`
--

INSERT INTO `wp_tnt_countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'ZR', 'Zaire'),
(244, 'ZM', 'Zambia'),
(245, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `wp_tnt_languages`
--

CREATE TABLE `wp_tnt_languages` (
  `id` int(11) NOT NULL,
  `language_code` varchar(10) NOT NULL,
  `language_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_tnt_languages`
--

INSERT INTO `wp_tnt_languages` (`id`, `language_code`, `language_name`) VALUES
(3, 'ab', 'Abkhaz'),
(4, 'aa', 'Afar'),
(5, 'af', 'Afrikaans'),
(6, 'ak', 'Akan'),
(7, 'sq', 'Albanian'),
(8, 'am', 'Amharic'),
(9, 'ar', 'Arabic'),
(10, 'an', 'Aragonese'),
(11, 'hy', 'Armenian'),
(12, 'as', 'Assamese'),
(13, 'av', 'Avaric'),
(14, 'ae', 'Avestan'),
(15, 'ay', 'Aymara'),
(16, 'az', 'Azerbaijani'),
(17, 'bm', 'Bambara'),
(18, 'ba', 'Bashkir'),
(19, 'eu', 'Basque'),
(20, 'be', 'Belarusian'),
(21, 'bn', 'Bengali'),
(22, 'bh', 'Bihari'),
(23, 'bi', 'Bislama'),
(24, 'bs', 'Bosnian'),
(25, 'br', 'Breton'),
(26, 'bg', 'Bulgarian'),
(27, 'my', 'Burmese'),
(28, 'ca', 'Catalan; Valencian'),
(29, 'ch', 'Chamorro'),
(30, 'ce', 'Chechen'),
(31, 'ny', 'Chichewa; Chewa; Nyanja'),
(32, 'zh', 'Chinese'),
(33, 'cv', 'Chuvash'),
(34, 'kw', 'Cornish'),
(35, 'co', 'Corsican'),
(36, 'cr', 'Cree'),
(37, 'hr', 'Croatian'),
(38, 'cs', 'Czech'),
(39, 'da', 'Danish'),
(40, 'dv', 'Divehi; Dhivehi; Maldivian;'),
(41, 'nl', 'Dutch'),
(42, 'en', 'English'),
(43, 'eo', 'Esperanto'),
(44, 'et', 'Estonian'),
(45, 'ee', 'Ewe'),
(46, 'fo', 'Faroese'),
(47, 'fj', 'Fijian'),
(48, 'fi', 'Finnish'),
(49, 'fr', 'French'),
(50, 'ff', 'Fula; Fulah; Pulaar; Pular'),
(51, 'gl', 'Galician'),
(52, 'ka', 'Georgian'),
(53, 'de', 'German'),
(54, 'el', 'Greek, Modern'),
(55, 'gn', 'Guaraní'),
(56, 'gu', 'Gujarati'),
(57, 'ht', 'Haitian; Haitian Creole'),
(58, 'ha', 'Hausa'),
(59, 'he', 'Hebrew (modern)'),
(60, 'hz', 'Herero'),
(61, 'hi', 'Hindi'),
(62, 'ho', 'Hiri Motu'),
(63, 'hu', 'Hungarian'),
(64, 'ia', 'Interlingua'),
(65, 'id', 'Indonesian'),
(66, 'ie', 'Interlingue'),
(67, 'ga', 'Irish'),
(68, 'ig', 'Igbo'),
(69, 'ik', 'Inupiaq'),
(70, 'io', 'Ido'),
(71, 'is', 'Icelandic'),
(72, 'it', 'Italian'),
(73, 'iu', 'Inuktitut'),
(74, 'ja', 'Japanese'),
(75, 'jv', 'Javanese'),
(76, 'kl', 'Kalaallisut, Greenlandic'),
(77, 'kn', 'Kannada'),
(78, 'kr', 'Kanuri'),
(79, 'ks', 'Kashmiri'),
(80, 'kk', 'Kazakh'),
(81, 'km', 'Khmer'),
(82, 'ki', 'Kikuyu, Gikuyu'),
(83, 'rw', 'Kinyarwanda'),
(84, 'ky', 'Kirghiz, Kyrgyz'),
(85, 'kv', 'Komi'),
(86, 'kg', 'Kongo'),
(87, 'ko', 'Korean'),
(88, 'ku', 'Kurdish'),
(89, 'kj', 'Kwanyama, Kuanyama'),
(90, 'la', 'Latin'),
(91, 'lb', 'Luxembourgish, Letzeburgesch'),
(92, 'lg', 'Luganda'),
(93, 'li', 'Limburgish, Limburgan, Limburger'),
(94, 'ln', 'Lingala'),
(95, 'lo', 'Lao'),
(96, 'lt', 'Lithuanian'),
(97, 'lu', 'Luba-Katanga'),
(98, 'lv', 'Latvian'),
(99, 'gv', 'Manx'),
(100, 'mk', 'Macedonian'),
(101, 'mg', 'Malagasy'),
(102, 'ms', 'Malay'),
(103, 'ml', 'Malayalam'),
(104, 'mt', 'Maltese'),
(105, 'mi', 'Māori'),
(106, 'mr', 'Marathi (Marāṭhī)'),
(107, 'mh', 'Marshallese'),
(108, 'mn', 'Mongolian'),
(109, 'na', 'Nauru'),
(110, 'nv', 'Navajo, Navaho'),
(111, 'nb', 'Norwegian Bokmål'),
(112, 'nd', 'North Ndebele'),
(113, 'ne', 'Nepali'),
(114, 'ng', 'Ndonga'),
(115, 'nn', 'Norwegian Nynorsk'),
(116, 'no', 'Norwegian'),
(117, 'ii', 'Nuosu'),
(118, 'nr', 'South Ndebele'),
(119, 'oc', 'Occitan'),
(120, 'oj', 'Ojibwe, Ojibwa'),
(121, 'cu', 'Old Church Slavonic'),
(122, 'om', 'Oromo'),
(123, 'or', 'Oriya'),
(124, 'os', 'Ossetian, Ossetic'),
(125, 'pa', 'Panjabi, Punjabi'),
(126, 'pi', 'Pāli'),
(127, 'fa', 'Persian'),
(128, 'pl', 'Polish'),
(129, 'ps', 'Pashto, Pushto'),
(130, 'pt', 'Portuguese'),
(131, 'qu', 'Quechua'),
(132, 'rm', 'Romansh'),
(133, 'rn', 'Kirundi'),
(134, 'ro', 'Romanian, Moldavian, Moldovan'),
(135, 'ru', 'Russian'),
(136, 'sa', 'Sanskrit (Saṁskṛta)'),
(137, 'sc', 'Sardinian'),
(138, 'sd', 'Sindhi'),
(139, 'se', 'Northern Sami'),
(140, 'sm', 'Samoan'),
(141, 'sg', 'Sango'),
(142, 'sr', 'Serbian'),
(143, 'gd', 'Scottish Gaelic; Gaelic'),
(144, 'sn', 'Shona'),
(145, 'si', 'Sinhala, Sinhalese'),
(146, 'sk', 'Slovak'),
(147, 'sl', 'Slovene'),
(148, 'so', 'Somali'),
(149, 'st', 'Southern Sotho'),
(150, 'es', 'Spanish; Castilian'),
(151, 'su', 'Sundanese'),
(152, 'sw', 'Swahili'),
(153, 'ss', 'Swati'),
(154, 'sv', 'Swedish'),
(155, 'ta', 'Tamil'),
(156, 'te', 'Telugu'),
(157, 'tg', 'Tajik'),
(158, 'th', 'Thai'),
(159, 'ti', 'Tigrinya'),
(160, 'bo', 'Tibetan Standard, Tibetan, Central'),
(161, 'tk', 'Turkmen'),
(162, 'tl', 'Tagalog'),
(163, 'tn', 'Tswana'),
(164, 'to', 'Tonga (Tonga Islands)'),
(165, 'tr', 'Turkish'),
(166, 'ts', 'Tsonga'),
(167, 'tt', 'Tatar'),
(168, 'tw', 'Twi'),
(169, 'ty', 'Tahitian'),
(170, 'ug', 'Uighur, Uyghur'),
(171, 'uk', 'Ukrainian'),
(172, 'ur', 'Urdu'),
(173, 'uz', 'Uzbek'),
(174, 've', 'Venda'),
(175, 'vi', 'Vietnamese'),
(176, 'vo', 'Volapük'),
(177, 'wa', 'Walloon'),
(178, 'cy', 'Welsh'),
(179, 'wo', 'Wolof'),
(180, 'fy', 'Western Frisian'),
(181, 'xh', 'Xhosa'),
(182, 'yi', 'Yiddish'),
(183, 'yo', 'Yoruba'),
(184, 'za', 'Zhuang, Chuang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_tnt_channel`
--
ALTER TABLE `wp_tnt_channel`
  ADD PRIMARY KEY (`channel_id`);

--
-- Indexes for table `wp_tnt_channel_cats`
--
ALTER TABLE `wp_tnt_channel_cats`
  ADD PRIMARY KEY (`chcat_id`);

--
-- Indexes for table `wp_tnt_countries`
--
ALTER TABLE `wp_tnt_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_tnt_languages`
--
ALTER TABLE `wp_tnt_languages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_tnt_channel`
--
ALTER TABLE `wp_tnt_channel`
  MODIFY `channel_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_tnt_channel_cats`
--
ALTER TABLE `wp_tnt_channel_cats`
  MODIFY `chcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `wp_tnt_countries`
--
ALTER TABLE `wp_tnt_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT for table `wp_tnt_languages`
--
ALTER TABLE `wp_tnt_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
