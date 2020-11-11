-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 23, 2020 at 03:31 PM
-- Server version: 10.3.23-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acebalio_gos`
--
CREATE DATABASE IF NOT EXISTS `order-lbh` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `order-lbh`;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` int(11) NOT NULL,
  `propertyid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `email`, `name`, `phone`, `country`, `propertyid`) VALUES
(3, 'wina@3md.co.id', 'Aldo', '0818189926', 96, 1),
(4, 'arisdh@outlook.com', 'Aris', '08170070617', 100, 1),
(5, 'ray@gmail', 'Ray', '082144474680', 3, 1),
(6, 'maria_wina@yahoo.com', 'Wina', '0818189926', 100, 1),
(7, 'ray@gmail.com', 'Ray Singal', '082144474680', 3, 1),
(8, 'hendire.socoval@icloud.com', 'hendj', '085383034400', 5, 1),
(9, 'hendire@3md.co.com', 'Hendire', '0818189926', 102, 1),
(10, 'aris', 'Aris', '08170070616', 58, 1),
(11, 'hendire.socoval@gmail.com', 'Homemade Kimchi', '085383034400', 1, 1),
(12, 'raysingal@gmail.com', 'Ray', '08213638890', 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `categoryid` int(200) NOT NULL,
  `descriptions` text NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `disc` double NOT NULL DEFAULT 0,
  `halal` tinyint(1) NOT NULL DEFAULT 1,
  `chefrecomend` tinyint(1) NOT NULL DEFAULT 1,
  `special` tinyint(1) NOT NULL DEFAULT 1,
  `favourite` tinyint(1) NOT NULL DEFAULT 1,
  `image` varchar(255) NOT NULL,
  `outletid` int(11) NOT NULL,
  `propertyid` int(11) NOT NULL,
  `userfirst` int(11) NOT NULL,
  `userlast` int(11) NOT NULL,
  `datefirst` datetime NOT NULL,
  `datelast` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `active`, `code`, `name`, `categoryid`, `descriptions`, `price`, `disc`, `halal`, `chefrecomend`, `special`, `favourite`, `image`, `outletid`, `propertyid`, `userfirst`, `userlast`, `datefirst`, `datelast`) VALUES
(10, 0, 'S001', 'Soupe du jour', 11, 'Please ask you server for the daily selection', 65000, 0, 0, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/food-menu-white.png', 1, 1, 13, 13, '2020-09-13 02:24:56', '2020-09-14 06:35:24'),
(11, 0, 'SL001', 'Balinese Green Urab-Urab', 5, 'Organic Greens, Vegetabbles Herbs, Coconut Bacon, Aromatic Balinese Dressing', 75000, 0, 0, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/salads.png', 1, 1, 13, 13, '2020-09-13 02:26:27', '2020-09-18 12:16:23'),
(12, 0, 'SL002', 'Kale Avocado Tartare', 5, 'Cucumber, Pineapple, Fresh Coriander and Shallots', 80000, 0, 0, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/salads.png', 1, 1, 13, 13, '2020-09-13 02:27:16', '2020-09-18 12:15:15'),
(13, 0, 'SL003', 'Asian Tomato Caprese', 5, 'Cashew Tofu, Asian Vinaigrette, Basil, Herb Oil', 80000, 0, 0, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/salads.png', 1, 1, 13, 13, '2020-09-13 02:28:03', '2020-09-18 12:15:51'),
(14, 0, 'A003', 'Fivelements Superfood Salad', 5, 'Organic Greens, Vegetables Herbs, Avocado, Tamarillo, Ginger-Cacao Cashews, and Noni &amp; Spirulina Chips', 80000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/food-menu-white.png', 1, 1, 13, 13, '2020-09-13 02:28:42', '2020-09-18 12:19:53'),
(15, 0, 'A001', 'Chickpea and Cassava Flatbread', 5, 'Raw Carrot Hummus, Sauteed Mushroom, Pickled Carrot, and Herbs with Ginger Torch Sambal', 80000, 1, 0, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/Appetiser%20Chickpea%20and%20Casava%20Flatbread%20WhatsApp%20Image%202020-09-15%20at%201-02-57%20AM.jpg', 1, 1, 13, 13, '2020-09-13 02:29:37', '2020-09-18 12:18:16'),
(16, 0, 'A002', 'Southeast Asian Style Tacos', 5, 'Young Jackfruit Carnitas, &lt;br&gt;Avocado, &lt;br&gt;Ginger Torch Sambal, Coconut Sour Cream, &lt;br&gt;and Pickled Cabbage', 90000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/food-menu-white.png', 1, 1, 13, 1, '2020-09-13 02:30:14', '2020-09-21 11:07:18'),
(18, 0, 'MC002', 'Spicy Avocado Nori Roll', 4, 'Jicama Rice and Lapsang Smoked Tempeh Served with Sesame Chili Sauce, Teriyaki Sauce, and Pickled Vegetable on the Side ', 100000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/food-menu-white.png', 1, 1, 13, 13, '2020-09-13 02:31:57', '2020-09-18 12:32:18'),
(21, 0, 'MC002', 'Curry Laksa', 4, 'Young Coconut Noodle, Smoked Tempeh, Asian Greens, Edamame, Sprouts, Shiitake,&quot;and Herbs ', 105000, 0, 0, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/Main%20Course%20Kari%20Laksa%20WhatsApp%20Image%202020-09-15%20at%201-02-53%20AM%20-%20Copy.jpg', 1, 1, 13, 13, '2020-09-13 02:34:22', '2020-09-18 12:28:26'),
(23, 0, 'MC003', 'Shiitake Beetroot Burger', 4, 'Caramelized Onion, Kimchi Mayonnaise, Umami Ketchup, Pickles, Jicama Slaw, and Sweet potato Chips ', 125000, 0, 0, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/Maincourse%20Siitake%20Beetroot%20Burger%20WhatsApp%20Image%202020-09-15%20at%201-02-54%20AM%20(1).jpg', 1, 1, 13, 13, '2020-09-13 02:35:54', '2020-09-18 12:30:03'),
(26, 0, 'SD001-', 'Mushroom Stir Fry', 13, 'Mushroom Stir Fry', 60000, 0, 0, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/side-dishes.png', 1, 1, 13, 13, '2020-09-13 02:40:03', '2020-09-14 07:53:41'),
(28, 0, 'SD003-', 'Baked Sweet Potato', 13, 'Baked Sweet Potato', 60000, 0, 0, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/side-dishes.png', 1, 1, 13, 13, '2020-09-13 02:41:32', '2020-09-14 07:37:29'),
(29, 0, 'SD002', 'Organic Red Rice', 13, 'Organic Red Rice', 65000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/side-dishes.png', 1, 1, 13, 13, '2020-09-13 02:42:09', '2020-09-14 07:56:42'),
(30, 0, 'SD003', 'Homemade Kimchi', 13, 'Homemade Kimchi', 65000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/side-dishes.png', 1, 1, 13, 13, '2020-09-13 02:42:56', '2020-09-14 07:57:15'),
(31, 0, 'SD006', 'Sweet Potato Chips', 13, 'Sweet Potato Chips', 60000, 0, 0, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/side-dishes.png', 1, 1, 13, 13, '2020-09-13 02:43:19', '2020-09-13 02:43:19'),
(32, 0, 'B001', 'Pure Tropical Juice', 9, 'Watermelon, Papaya, Pinapple, Tangerine, Mango, Banana,', 80000, 0, 0, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-14 09:59:17', '2020-09-16 12:10:54'),
(35, 0, 'S002', 'Miso Soup', 11, 'Soft Tofu, Wakame, Watercress', 65000, 0, 0, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-14 06:36:47', '2020-09-14 06:37:10'),
(36, 0, 'S003', 'Mushroom Coconut', 11, 'Mushrooms, Lemongrass &amp;amp; Kaffir Lime, Fresh Herb, Sesame Rice Cracker.', 70000, 0, 0, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-14 06:38:30', '2020-09-14 06:39:34'),
(37, 0, 'PS 003', 'Scented Nuts', 10, 'A Selection of 3 Spiced Secented Nuts', 55000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 1, 13, 13, '2020-09-14 07:39:27', '2020-09-18 12:33:51'),
(38, 0, 'SD001', 'Garlic Greens Stir Fry', 13, 'Garlic Greens Stir Fry', 65000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/side-dishes.png', 1, 1, 13, 13, '2020-09-14 07:55:46', '2020-09-14 07:55:46'),
(39, 0, 'D001', 'Coconut Cashew Ice Cream', 6, 'Please ask your server for our daily flavours', 40000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 1, 13, 13, '2020-09-14 08:00:36', '2020-09-18 12:26:01'),
(40, 0, 'D002', 'Raw Chocolate and Truffles, Pandan Ginger Tea', 6, 'Choice of Signature Fivelements Raw Chocolates\r\nServed with Our Ginger Tea &quot;Please ask your server for our flavours selection&quot;', 50000, 0, 1, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-14 08:03:36', '2020-09-18 12:25:03'),
(41, 0, 'D003', 'Trio of Seasonal Sorbet with Tropical Fruits', 6, 'Served with Tea or Coffee &quot;Please ask your server for our daily flavours', 90000, 0, 1, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-14 08:05:56', '2020-09-18 12:27:34'),
(42, 0, 'D004', 'Mocha Semifreddo', 6, 'Dark Chocolate Mousse, Chocolate Ring, Cacao Soil, Cardamom Vanilla Ice Cream, and Dark Honey\r\nServe with Tea or Coffe', 90000, 0, 1, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-14 08:10:56', '2020-09-18 12:23:22'),
(43, 0, 'D005', 'Coconut Lime Cheese Cake', 6, 'Ginger Torch Sorbet, Dragon Fruit, and Local Flowers\r\nServed with Tea or Coffe', 90000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 1, 13, 13, '2020-09-14 08:12:49', '2020-09-18 12:21:59'),
(44, 0, 'SD004', '2 Side Dishes Selection', 13, 'Choose 2 Our Side Dishes for 15% Additional Discount :\r\nGarlic Green Stir Fry\r\nor\r\nOrganic Red Rice\r\nor\r\nHome Made Kimchi', 130000, 1, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/side-dishes.png', 1, 1, 13, 13, '2020-09-14 08:26:17', '2020-09-15 12:53:12'),
(45, 0, 'SM001', '3-Course', 17, 'Design Your Own 3-Course Set Menu by selecting :\r\n-A Starter from Appetizer/ Soup/ Side Dish Menu\r\n-A Main Course from Our Dining Menu\r\n-A Dessert from Our Dessert Menu\r\n\r\nor\r\n\r\nEnjoy Our Chef Creation for Your 3- Course Set Menu\r\n\r\n\r\n&amp;Auml;ccompanied by Rejuvenating &amp;quot;Elixirs&amp;quot;', 400000, 0, 1, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-14 08:43:41', '2020-09-18 01:20:57'),
(46, 0, 'SM002', '5- Course', 17, 'Design Your Own 5-Course Set Menu by selecting:\r\n-Two Starter (s) from Appetizer / Soup / Side Dish Menu\r\n-A Main Course from Our Dining Menu\r\n-Two Dessert(s) from Our Dessert Menu\r\n\r\nor\r\n\r\nEnjoy Our Chef Creation for Your 5-Course Set Menu\r\n\r\nAccompanied by Rejuvenating &quot;&Euml;lixirs&quot;', 550000, 0, 1, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-14 08:44:38', '2020-09-18 12:41:55'),
(47, 0, 'SM003', '7- Course', 17, 'Enjoy Our Chef Creation for Your 7-Course Set Menu Accompanied by Rejuvenating &quot;Elixirs&quot;', 650000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 1, 13, 13, '2020-09-14 08:47:08', '2020-09-18 12:43:11'),
(48, 0, 'BM001', 'Breakfast Set', 1, 'Our epicurean plant-based breakfast set is free of gluten and dairy ingredients, with noted exceptions.\r\n\r\nPlease inform your server for any food allergies.   \r\n\r\n\r\nFloating breakfast is available upon request, kindly contact our Sakti Dining Room service staff for further assistance.', 190000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/Menu%20Only%20Breakfast%20Scan.jpg', 1, 1, 13, 1, '2020-09-14 08:56:59', '2020-09-21 11:09:11'),
(49, 0, 'TH001', 'Teja', 21, 'FIVE ELEMENTS SIGNATURE BLENDS\r\n(Cinnamon, Ginger, Pepper, Clove)', 45000, 0, 1, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-15 12:09:38', '2020-09-15 12:09:38'),
(50, 0, 'TH002', 'Akasa', 21, 'FIVELEMENTS SIGNATURE BLENDS\r\n(Chamomile, Vanilla, Cardamom)', 45000, 0, 1, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-15 12:12:20', '2020-09-15 12:12:20'),
(51, 0, 'TH003', 'Apah', 21, 'FIVELEMENTS SIGNATURE BLENDS\r\n(Roseila, Coriander, Sencha)', 45000, 0, 1, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-15 12:12:54', '2020-09-15 12:12:54'),
(52, 0, 'TH004', 'Bayu', 21, 'FIVELEMENTS SIGNATURE BLENDS\r\n(White tea, Cardamom, Spearmint', 45000, 0, 1, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-15 12:13:42', '2020-09-15 12:13:42'),
(53, 0, 'TH005', 'Javanese Agung', 21, 'FIVELEMENTS SIGNATURE BLENDS\r\n(One of Indonesia&#039;s finest quality teas, a medium-bodied Black Tea with spicy notes)', 45000, 0, 1, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-15 12:15:13', '2020-09-15 12:15:13'),
(54, 0, 'TH006', 'Lapsang Souchong', 21, 'BLACK TEA\r\n(A Smoky Chineese Tea cured over pine fires)', 45000, 0, 1, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-15 12:16:19', '2020-09-15 12:16:19'),
(55, 0, 'TH007', 'Earl Grey', 21, 'BLACK TEA\r\n(Classic Black Tea with oil of Beramot Lending intens Citrus flavor', 45000, 0, 1, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-15 12:17:51', '2020-09-15 12:17:51'),
(56, 0, 'TH008', 'Ginger Black', 21, 'BLACK TEA\r\n\r\nIndonesian Home-grown blend of Black Tea and dried Ginger Root', 45000, 0, 1, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-15 12:19:27', '2020-09-15 12:19:27'),
(57, 0, 'TH009', 'Matcha', 21, 'GREEN TEA\r\n(Fine Japanese ceremonial grade Matcha, rich in Antioxindants)', 45000, 0, 1, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-15 12:34:02', '2020-09-15 12:34:02'),
(58, 0, 'TH10', 'Sencha Dewata', 21, 'A Locally produced, full-flavoted streamed Green Tea with a fresh Vegetal character', 45000, 0, 1, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-15 12:36:24', '2020-09-15 12:36:24'),
(59, 0, 'TH010', 'Jasmine', 21, 'GREEN TEA\r\n(Classic, floral scented tea, good for weight management)', 45000, 0, 1, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-15 12:38:00', '2020-09-15 12:38:00'),
(60, 0, 'TH011', 'Ginger Green', 21, 'GREEN TEA\r\n(Blend of Green Tea with local ginger root, strengthens the immune system', 45000, 0, 1, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-15 12:39:58', '2020-09-15 12:39:58'),
(61, 0, 'W001', 'Sparkling Wine', 22, 'Two Islands Sparkling Chardonnay 2018, Two Island Reserve Pinot Noir Chardonnay 2014', 460000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Wine/Sparkling.jpg', 1, 1, 13, 13, '2020-09-16 12:10:34', '2020-09-18 12:49:45'),
(62, 0, 'W002', 'White Wine', 22, 'Two Islands Sauvignon Blanc 2019, Villa Maria Private Bin Sauvignon, Black Cottage Pinot Gris 2018, Beringer Chardonnay 2017, G7 The 7th Generation Chardonnay', 420000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Wine/4%20WHITE%20-%20Two%20Silands%20Sauvignon%20Blanc%202019.jpg', 1, 1, 13, 13, '2020-09-16 12:14:22', '2020-09-18 12:49:08'),
(63, 0, 'W003', 'Red Wine', 22, 'Bodega Norton Barrel Select Malbec, Two Islands Pinot Noir 2019, M A N Bosstok Pinotega 2018, D&amp;quot;Arenberg Stump Jump Grenache, Gnarly Head Merlot 2016', 600000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Wine/9%20RED%20-%20Bodega%20Norton%20Barrel%20Select%20Malbec%202019.jpg', 1, 1, 13, 13, '2020-09-16 12:16:50', '2020-09-18 12:46:59'),
(64, 0, 'W004', 'Dessert Wine', 22, 'Edeltron Golden Semilon 2015', 700000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Wine/14%20DESSERT%20-%20Elderton%20Golden%20Semillon%202015.jpg', 1, 1, 13, 13, '2020-09-16 12:17:34', '2020-09-18 12:53:17'),
(65, 0, 'W005', 'Beer, Cider, Mineral Water', 22, 'Prost Larger, Albens Original Fuji Apple Cider, Aqua Reflection Sparkling Water (750ml), Aqua Reflection Sparkling Water (380ml), Aqua Reflection Still Water (380ml)', 50000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Wine.jpg', 1, 1, 13, 13, '2020-09-16 12:19:56', '2020-09-18 12:53:13'),
(66, 0, 'PS002', 'Hummus Flatbread', 10, 'Almond Coriander Flatbread, Carrot Cashew Hummus, Wild Herbs, and Flowers', 65000, 0, 1, 1, 1, 1, '', 1, 1, 13, 13, '2020-09-17 12:50:55', '2020-09-18 12:33:14'),
(67, 0, 'AM001', 'Appetizer', 5, 'Balinese Green Urab-Urab, Kale Avocado Tartare, Asian Tomato Caprese, Fivelements Superfood Salad, Chickpea and Cassava Flatbread, Southeast Asian Style Tacos.', 80000, 0, 0, 0, 0, 0, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Appetizer.jpg', 1, 1, 13, 1, '2020-09-17 09:23:56', '2020-09-17 10:01:38'),
(68, 0, 'PS001', 'Plates to Share', 26, 'Scented Nuts, Hummus Flatbread, ', 55000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/Plate%20To%20Share.jpg', 1, 1, 13, 13, '2020-09-17 09:32:13', '2020-09-18 12:59:07'),
(69, 0, 'AM003', 'Soup', 26, 'Soupe du jour, Miso Soup, Mushroom Coconut', 65000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Soup.jpg', 1, 1, 13, 13, '2020-09-17 09:36:32', '2020-09-17 09:36:32'),
(70, 0, 'AM004', 'Main Course', 26, 'Spicy Avocado Nori Roll, Curry Laksa, Shiitake Beetroot Burger', 100000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Main%20Course.jpg', 1, 1, 13, 13, '2020-09-17 09:40:56', '2020-09-17 09:40:56'),
(71, 0, 'AM005', 'Side Dish', 26, 'Mushroom Stir Fry, Baked Sweet Potato, Organic Red Rice, Homemade Kimchi, Sweet Potato Chips, Garlic Greens Stir Fry, 2 Side Dishes Selection', 65000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Side%20Dish.jpg', 1, 1, 13, 13, '2020-09-17 09:52:43', '2020-09-17 09:52:43'),
(72, 0, 'W006', 'Rose Wine', 22, 'Villa Maria Private Bin Rose 2018', 560000, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Wine/3%20ROSE%20-%20Villa%20Maria%20Private%20Bin%20Rose%202018.jpg', 1, 1, 13, 13, '2020-09-18 01:01:02', '2020-09-18 01:01:02'),
(73, 0, 'HK001', 'Extra Towel', 19, '', 0, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 4, 1, 13, 13, '2020-09-18 01:40:52', '2020-09-18 01:40:52'),
(74, 0, 'HK002', 'Extra Pillow', 19, '', 0, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 4, 1, 13, 13, '2020-09-18 01:41:33', '2020-09-18 01:41:33'),
(75, 0, 'HK003', 'Ironing Board', 19, '', 0, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 4, 1, 13, 13, '2020-09-18 01:42:59', '2020-09-18 01:42:59'),
(76, 0, 'HK004', 'Other', 19, '', 0, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 4, 1, 13, 13, '2020-09-18 01:43:21', '2020-09-18 01:43:21'),
(77, 0, 'DW002', 'Refill Water Jug', 15, '', 0, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 4, 1, 13, 13, '2020-09-18 01:44:58', '2020-09-18 01:44:58'),
(78, 0, 'DK002', 'Request Bottled Water', 15, '', 0, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 4, 1, 13, 13, '2020-09-18 01:45:44', '2020-09-18 01:45:44'),
(79, 0, 'PH001', 'Tooth Brush', 18, '', 0, 0, 1, 1, 1, 1, '', 4, 1, 13, 13, '2020-09-18 01:47:45', '2020-09-18 01:47:45'),
(80, 0, 'PH002', 'Tooth Paste', 18, '', 0, 0, 1, 1, 1, 1, '', 4, 1, 13, 13, '2020-09-18 01:48:12', '2020-09-18 01:49:05'),
(81, 0, 'PH003', 'Shaver &amp; Foam', 18, '', 0, 0, 1, 1, 1, 1, '', 4, 1, 13, 13, '2020-09-18 01:48:50', '2020-09-18 01:48:50'),
(82, 0, 'L001', 'Laundry Pick Up', 23, '', 0, 0, 1, 1, 1, 1, '', 4, 1, 13, 13, '2020-09-18 01:49:47', '2020-09-18 01:49:47'),
(83, 0, 'L002', 'Dry Clean Pick Up', 23, '', 0, 0, 1, 1, 1, 1, '', 4, 1, 13, 13, '2020-09-18 01:50:15', '2020-09-18 01:50:15'),
(84, 0, 'L003', 'Ironing Services', 23, '', 0, 0, 1, 1, 1, 1, '', 4, 1, 13, 13, '2020-09-18 01:50:42', '2020-09-18 01:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `menu_cat`
--

CREATE TABLE `menu_cat` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `sub_of` int(11) DEFAULT 0,
  `master` tinyint(1) NOT NULL DEFAULT 0,
  `outletid` int(11) NOT NULL,
  `fb` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `propertyid` int(11) NOT NULL,
  `userfirst` int(11) NOT NULL,
  `userlast` int(11) NOT NULL,
  `datefirst` datetime NOT NULL,
  `datelast` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_cat`
--

INSERT INTO `menu_cat` (`id`, `active`, `code`, `name`, `sub_of`, `master`, `outletid`, `fb`, `image`, `propertyid`, `userfirst`, `userlast`, `datefirst`, `datelast`) VALUES
(1, 0, '010.000', 'Breakfast Menu', 0, 0, 1, 1, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Breakfast.jpg', 1, 1, 1, '2020-09-12 01:02:06', '2020-09-23 10:40:42'),
(4, 1, '0', 'Main Course', 0, 0, 1, 1, 'http://gos.pps.co.id/uploads/user/Maincourse%20Siitake%20Beetroot%20Burger%20WhatsApp%20Image%202020-09-15%20at%201-02-54%20AM%20(1).jpg', 1, 1, 13, '2020-09-12 01:03:56', '2020-09-17 09:41:12'),
(5, 1, '0', 'Appetizer', 0, 0, 1, 1, 'http://gos.pps.co.id/uploads/user/Appetiser%20Chickpea%20and%20Casava%20Flatbread%20WhatsApp%20Image%202020-09-15%20at%201-02-57%20AM.jpg', 1, 1, 13, '2020-09-12 01:04:12', '2020-09-17 09:24:47'),
(6, 0, '040.00', 'Dessert', 0, 0, 1, 1, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Dessert.jpg', 1, 1, 1, '2020-09-12 01:04:22', '2020-09-23 10:41:14'),
(9, 1, '0', 'Beverages', 0, 0, 1, 2, 'http://gos.pps.co.id/uploads/user/IMG_6746.jpg', 1, 1, 1, '2020-09-12 01:11:32', '2020-09-12 12:17:11'),
(10, 1, '0', 'Plate to Share', 0, 0, 1, 1, 'http://gos.pps.co.id/uploads/user/SDR-Menu%20tanpa%20Gambar.jpg', 1, 13, 13, '2020-09-13 02:18:52', '2020-09-17 09:32:57'),
(11, 1, '0', 'Soup', 0, 0, 1, 1, 'http://gos.pps.co.id/uploads/user/SDR-Menu%20tanpa%20Gambar.jpg', 1, 13, 13, '2020-09-13 02:22:54', '2020-09-17 09:38:31'),
(12, 1, '0', 'Salads', 0, 0, 1, 1, 'http://gos.pps.co.id/uploads/user/Salad.jpg', 1, 13, 13, '2020-09-13 02:25:39', '2020-09-16 04:20:05'),
(13, 1, '0', 'Side Dishes', 0, 0, 1, 1, 'http://gos.pps.co.id/uploads/user/Sidesidish%20dengan%20discount.jpg', 1, 13, 13, '2020-09-13 02:38:52', '2020-09-17 09:54:00'),
(15, 0, '2', 'Drinking Water', 0, 0, 4, 4, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 13, 13, '2020-09-13 09:37:59', '2020-09-18 01:46:54'),
(17, 0, '030.000', 'Set Menu', 0, 0, 1, 1, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Set%20Menu.jpg', 1, 13, 1, '2020-09-14 08:15:54', '2020-09-23 10:41:03'),
(18, 0, '3', 'Personal Hygiene', 0, 0, 4, 4, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 1, 13, '2020-09-14 10:02:04', '2020-09-17 08:27:06'),
(19, 0, '1', 'House Keeping', 0, 0, 4, 4, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 1, 13, '2020-09-14 10:02:22', '2020-09-18 01:46:37'),
(20, 0, '5', 'Flowers', 0, 0, 4, 4, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 1, 13, '2020-09-14 10:03:11', '2020-09-17 08:28:07'),
(21, 0, '050.000', 'Teas & Herbal Blend', 0, 0, 1, 2, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Tea%20and%20Herbal%20Blends.jpg', 1, 13, 1, '2020-09-15 12:04:51', '2020-09-23 10:41:32'),
(22, 0, '060.000', 'Wine', 0, 0, 1, 2, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Wine.jpg', 1, 13, 1, '2020-09-15 09:49:41', '2020-09-23 10:41:43'),
(23, 0, '4', 'Dry Cleaning / Laundry / Ironing', 0, 0, 4, 4, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 13, 13, '2020-09-17 08:23:55', '2020-09-18 01:47:07'),
(24, 0, '6', 'Baby Bed', 0, 0, 4, 4, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 13, 13, '2020-09-17 08:24:26', '2020-09-18 01:46:46'),
(25, 0, '7', 'Baby Sitting', 0, 0, 4, 1, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 13, 13, '2020-09-17 08:30:22', '2020-09-17 08:30:22'),
(26, 0, '020.000', 'All-Day Menu', 0, 0, 1, 1, 'http://gos.pps.co.id/uploads/user/Capture.jpg', 1, 13, 1, '2020-09-17 09:19:41', '2020-09-23 10:40:52'),
(27, 0, '8', 'Airport', 0, 0, 4, 4, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 13, 13, '2020-09-18 01:52:24', '2020-09-18 01:52:24'),
(28, 0, '9', 'Water Healing Pool', 0, 0, 4, 4, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 13, 13, '2020-09-18 01:52:53', '2020-09-18 01:52:53'),
(29, 0, '10', 'Wake Up Calls', 0, 0, 4, 4, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 13, 13, '2020-09-18 01:53:20', '2020-09-18 01:53:20'),
(30, 0, '11', 'Doctor and Nurse', 0, 0, 4, 4, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 13, 13, '2020-09-18 01:53:51', '2020-09-18 01:53:51'),
(31, 0, '7', 'Ubud Shuttle Service', 0, 0, 4, 4, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 13, 13, '2020-09-18 01:54:13', '2020-09-18 01:54:58'),
(32, 0, '6', 'Healing and Wellness Center', 0, 0, 4, 1, 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 13, 13, '2020-09-18 01:54:40', '2020-09-18 01:54:51'),
(33, 0, '060.010', 'Red Wine', 22, 0, 1, 2, '', 1, 1, 1, '2020-09-23 10:49:23', '2020-09-23 10:51:09');

-- --------------------------------------------------------

--
-- Table structure for table `menu_disc`
--

CREATE TABLE `menu_disc` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `disc` int(11) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_stop` time DEFAULT NULL,
  `allday` tinyint(1) NOT NULL DEFAULT 0,
  `sun` tinyint(1) NOT NULL DEFAULT 0,
  `mon` tinyint(1) NOT NULL DEFAULT 0,
  `tue` tinyint(1) NOT NULL DEFAULT 0,
  `wed` tinyint(1) NOT NULL DEFAULT 0,
  `thu` tinyint(1) NOT NULL DEFAULT 0,
  `fri` tinyint(1) NOT NULL DEFAULT 0,
  `sat` tinyint(1) NOT NULL DEFAULT 0,
  `outletid` int(11) NOT NULL,
  `propertyid` int(11) NOT NULL,
  `userfirst` int(11) NOT NULL,
  `userlast` int(11) NOT NULL,
  `datefirst` datetime NOT NULL,
  `datelast` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_disc`
--

INSERT INTO `menu_disc` (`id`, `active`, `code`, `name`, `disc`, `date_start`, `date_end`, `time_start`, `time_stop`, `allday`, `sun`, `mon`, `tue`, `wed`, `thu`, `fri`, `sat`, `outletid`, `propertyid`, `userfirst`, `userlast`, `datefirst`, `datelast`) VALUES
(1, 0, '10', '10', 10, '2020-09-19', '2020-12-31', '09:00:00', '23:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 1, '0000-00-00 00:00:00', '2020-09-19 09:33:30');

-- --------------------------------------------------------

--
-- Table structure for table `menu_images`
--

CREATE TABLE `menu_images` (
  `id` bigint(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `menuid` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_images`
--

INSERT INTO `menu_images` (`id`, `active`, `menuid`, `position`, `image`) VALUES
(2, 0, 5, 2, 'http://gos.pps.co.id/uploads/user/daftar-ulang-upload.jpg'),
(3, 0, 12, 1, 'http://gos.pps.co.id/uploads/user/KK.jpg'),
(4, 0, 15, 1, 'http://gos.pps.co.id/uploads/user/Cumi-Panggang-dengan-Sambal-Cumi-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` varchar(255) NOT NULL,
  `line` int(11) NOT NULL,
  `menuid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `disc` double NOT NULL,
  `total` double NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `line`, `menuid`, `qty`, `price`, `disc`, `total`, `note`) VALUES
('0120090001', 1, 4, 1, 30000, 0, 0, ''),
('0120090001', 2, 3, 1, 25000, 0, 0, ''),
('0120090002', 1, 20, 1, 95000, 0, 0, ''),
('0120090003', 1, 8, 1, 70000, 0, 0, ''),
('0120090003', 2, 15, 1, 75000, 0, 0, ''),
('0120090004', 1, 8, 1, 70000, 0, 0, ''),
('0120090004', 2, 19, 1, 95000, 0, 0, ''),
('0120090004', 3, 28, 1, 60000, 0, 0, ''),
('0120090004', 4, 9, 1, 65000, 0, 0, ''),
('0120090006', 1, 15, 1, 75000, 0, 0, ''),
('0120090007', 1, 15, 1, 75000, 0, 0, ''),
('0120090008', 1, 15, 1, 75000, 0, 0, ''),
('0120090009', 1, 33, 1, 80, 0, 0, ''),
('0120090010', 1, 15, 1, 75000, 0, 0, ''),
('0120090011', 1, 15, 1, 75000, 0, 0, ''),
('0120090012', 1, 15, 1, 75000, 0, 0, ''),
('0120090013', 1, 21, 1, 100000, 0, 0, ''),
('0120090014', 1, 15, 1, 75000, 0, 0, ''),
('0120090015', 1, 15, 1, 80000, 0, 0, ''),
('0120090015', 2, 48, 1, 190000, 0, 0, ''),
('0120090016', 1, 21, 1, 105000, 0, 0, ''),
('0120090017', 1, 16, 5, 90000, 0, 0, ''),
('0120090018', 1, 15, 2, 80000, 0, 0, 'Minta tambah infuise water'),
('0120090018', 2, 39, 1, 40000, 0, 0, ''),
('0120090019', 1, 15, 1, 80000, 0, 0, ''),
('0120090019', 2, 41, 1, 90000, 0, 0, ''),
('0120090020', 1, 15, 1, 80000, 0, 0, ''),
('0120090021', 1, 23, 1, 125000, 0, 0, ''),
('0120090022', 1, 43, 1, 90000, 0, 0, ''),
('0120090023', 1, 43, 1, 90000, 0, 0, ''),
('0320090024', 1, 63, 1, 600000, 0, 0, ''),
('0320090025', 1, 70, 3, 100000, 0, 0, ''),
('0320090025', 2, 48, 1, 190000, 0, 0, ''),
('0320090026', 1, 70, 1, 100000, 0, 0, ''),
('0320090027', 1, 68, 1, 55000, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail_item`
--

CREATE TABLE `order_detail_item` (
  `order_id` varchar(255) NOT NULL,
  `detail_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `sub_menu_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail_item`
--

INSERT INTO `order_detail_item` (`order_id`, `detail_id`, `menu_id`, `sub_menu_id`, `item_id`, `price`) VALUES
('0120090031', 2, 15, 1, 9, 12500),
('0120090031', 2, 15, 10, 5, 200),
('0120090032', 1, 15, 1, 1, 16000),
('0120090032', 1, 15, 10, 5, 200),
('0120090033', 1, 15, 1, 1, 16000),
('0120090033', 1, 15, 10, 5, 200),
('0120090034', 1, 15, 1, 1, 16000),
('0120090034', 1, 15, 10, 5, 200);

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `id` varchar(255) NOT NULL,
  `orderdate` datetime NOT NULL,
  `table_num` varchar(255) DEFAULT NULL,
  `pax` int(11) NOT NULL,
  `guestid` bigint(20) NOT NULL,
  `roomno` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `subtotal` double NOT NULL,
  `disc` double NOT NULL,
  `tax` double NOT NULL,
  `service` double NOT NULL,
  `total` double NOT NULL,
  `payment` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `waitress` int(11) NOT NULL,
  `outletid` int(11) NOT NULL,
  `propertyid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`id`, `orderdate`, `table_num`, `pax`, `guestid`, `roomno`, `note`, `subtotal`, `disc`, `tax`, `service`, `total`, `payment`, `status`, `waitress`, `outletid`, `propertyid`) VALUES
('0120090001', '2020-09-12 12:56:24', '01', 2, 1, '201', '', 55000, 0, 10, 11, 66550, 1, 2, 0, 1, 1),
('0120090002', '2020-09-13 22:38:33', '01', 2, 2, '201', '', 95000, 0, 10, 11, 114950, 1, 2, 0, 1, 1),
('0120090003', '2020-09-14 00:13:02', '01', 2, 3, 'Adah', '', 145000, 0, 10, 11, 175450, 2, 2, 0, 1, 1),
('0120090004', '2020-09-14 08:16:30', '01', 2, 4, 'Apah', '', 290000, 0, 10, 11, 350900, 2, 1, 0, 1, 1),
('0120090005', '2020-09-14 08:17:14', '01', 2, 4, 'Apah', '', 0, 0, 10, 11, 0, 2, 2, 0, 1, 1),
('0120090006', '2020-09-14 13:48:52', '01', 1, 5, '', '', 75000, 0, 10, 11, 90750, 1, 2, 0, 1, 1),
('0120090007', '2020-09-14 13:48:54', '01', 2, 6, '300', '', 75000, 0, 10, 11, 90750, 1, 2, 0, 1, 1),
('0120090008', '2020-09-14 13:49:18', '01', 1, 5, '', '', 75000, 0, 10, 11, 90750, 1, 2, 0, 1, 1),
('0120090009', '2020-09-14 13:50:03', '01', 1, 5, '', '', 80, 0, 10, 11, 96.8, 1, 1, 0, 1, 1),
('0120090010', '2020-09-14 13:50:41', '01', 1, 7, '201', '', 75000, 0, 10, 11, 90750, 1, 1, 0, 1, 1),
('0120090011', '2020-09-14 13:51:24', '01', 1, 7, '201', '', 75000, 0, 10, 11, 90750, 1, 2, 0, 1, 1),
('0120090012', '2020-09-14 13:52:08', '01', 1, 7, '', '', 75000, 0, 10, 11, 90750, 1, 1, 0, 1, 1),
('0120090013', '2020-09-14 13:52:36', '01', 1, 7, '2', '', 100000, 0, 10, 11, 121000, 2, 2, 0, 1, 1),
('0120090014', '2020-09-14 13:53:20', '01', 1, 8, '01', '', 75000, 0, 10, 11, 90750, 2, 1, 0, 1, 1),
('0120090015', '2020-09-15 08:52:57', '5', 3, 3, '', '', 270000, 0, 10, 11, 326700, 1, 1, 0, 1, 1),
('0120090016', '2020-09-15 09:55:39', '3', 3, 6, 'Anu', '', 105000, 0, 10, 11, 127050, 1, 1, 0, 1, 1),
('0120090017', '2020-09-15 10:23:43', '3', 5, 3, 'Hillview', '5 tacos, minta piring kosong 1', 450000, 0, 10, 11, 544500, 2, 1, 0, 1, 1),
('0120090018', '2020-09-15 14:07:35', '5', 5, 9, 'Adah', '', 200000, 0, 10, 11, 242000, 2, 1, 0, 1, 1),
('0120090019', '2020-09-15 22:39:51', '3', 2, 10, '', 'Charge to room 125', 170000, 0, 10, 11, 205700, 3, 1, 0, 1, 1),
('0120090020', '2020-09-16 19:47:09', '3', 9, 11, '90', 'iii', 80000, 0, 10, 11, 96800, 1, 1, 0, 1, 1),
('0120090021', '2020-09-16 19:50:22', '3', 7, 11, '', '', 125000, 0, 10, 11, 151250, 3, 2, 0, 1, 1),
('0120090022', '2020-09-16 19:51:43', '3', 7, 11, '', '', 90000, 0, 10, 11, 108900, 3, 0, 0, 1, 1),
('0120090023', '2020-09-16 19:51:58', '3', 7, 11, '', '', 90000, 0, 10, 11, 108900, 3, 0, 0, 1, 1),
('0320090024', '2020-09-18 12:34:14', '01', 2, 12, '', '', 600000, 0, 10, 11, 726000, 1, 0, 0, 1, 1),
('0320090025', '2020-09-22 12:34:59', '01', 2, 3, '300', '', 490000, 0, 10, 11, 592900, 3, 1, 0, 1, 1),
('0320090026', '2020-09-22 16:25:39', '01', 2, 3, '300', '', 100000, 0, 10, 11, 121000, 3, 0, 0, 1, 1),
('0320090027', '2020-09-23 12:25:13', '01', 2, 3, '', '', 55000, 0, 10, 11, 66550, 1, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

CREATE TABLE `outlet` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `opentime` time NOT NULL,
  `closetime` time NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `propertyid` int(11) NOT NULL,
  `userfirst` int(11) NOT NULL,
  `userlast` int(11) NOT NULL,
  `datefirst` datetime NOT NULL,
  `datelast` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`id`, `active`, `code`, `name`, `opentime`, `closetime`, `image`, `propertyid`, `userfirst`, `userlast`, `datefirst`, `datelast`) VALUES
(-1, 0, '999', 'Hotel Directory', '00:00:00', '00:00:00', 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 1, 1, '2020-09-14 09:25:17', '2020-09-18 07:42:01'),
(1, 0, '03', 'Sakti Dining Room', '07:00:00', '21:30:00', 'http://gos.pps.co.id/uploads/user/Breakfast%20Menu%20WhatsApp%20Image%202020-09-15%20at%201-02-51%20AM%20-%20Copy.jpg', 1, 1, 13, '2020-09-12 01:00:59', '2020-09-18 01:33:11'),
(4, 0, '02', 'Hotel Service', '08:00:00', '20:00:21', 'http://gos.pps.co.id/uploads/user/fivelements.jpg', 1, 13, 1, '2020-09-13 09:37:01', '2020-09-17 09:21:35'),
(5, 1, '777', 'Room Order', '00:00:00', '00:00:00', 'http://gos.pps.co.id/uploads/user/soup.jpg', 1, 1, 1, '2020-09-14 09:23:55', '2020-09-18 07:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descriptions` text NOT NULL,
  `topimage` varchar(255) NOT NULL,
  `link` varchar(500) NOT NULL,
  `link_to_url` varchar(255) DEFAULT NULL,
  `propertyid` int(11) NOT NULL,
  `userfirst` int(11) NOT NULL,
  `userlast` int(11) NOT NULL,
  `datefirst` datetime NOT NULL,
  `datelast` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `active`, `title`, `descriptions`, `topimage`, `link`, `link_to_url`, `propertyid`, `userfirst`, `userlast`, `datefirst`, `datelast`) VALUES
(-2, 0, 'Welcome Message', '<h1>Welcome to Fivelements Retreat Bali</h1>\r\n\r\n<p>Nestled on the banks of the Ayung River, Fivelements Retreat Bali is an award-winning eco-conscious wellness retreat deeply rooted in the ancient traditions of Bali, making it a peaceful sanctuary to embrace authentic Balinese Healing, Plant-based Cuisine and Sacred Arts.</p>\r\n', '', '', NULL, 1, 1, 1, '2020-09-14 02:59:00', '2020-09-14 04:14:34'),
(-1, 0, 'Room Directory', '<h2 style=\"text-align:center\"><strong>HOTEL DIRECTORY</strong></h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>We are delighted to welcome you to Fivelements Retreat Bali. This hotel directory gives you a thorough insight about all our facilities and services avaiable. If you have an additional question or request please contact one of our team members. We wish you a pleasant and enjoyable stay!</p>\r\n\r\n<p><strong>USEFUL TELEPHONES</strong></p>\r\n\r\n<p>Reception&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Dial 0&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;24 hour Service</p>\r\n\r\n<p>Room Service&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Dial 300&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;07;00 - 22;00 ( last order at&nbsp; 21:30 )</p>\r\n\r\n<p>Healing &amp; Wellness Center&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Dial 200&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;08:00 - 21;00 ( last booking at 19:00 )</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>EVENING SERVICE</strong></p>\r\n\r\n<p>Every evening a room maid will pass to empty your garbage bins, turn on beside light, draw the curtain and change the towels if needed. However if you wish to not be disturbed please plase the provided &quot;do not disturb&quot;sign outside your door</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>ELECTRIC KETTLE</strong></p>\r\n\r\n<p>These is an electric kettle at your disposal. Please use it only to heat water and not any other liquid</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>NON-SMOKING</strong></p>\r\n\r\n<p>As a healing destination retreat, Fivelements Retreat Bali maintains a peaceful atmosphere integrated with nature. To this regard, we support a smoke-free environment</p>\r\n', '', '', NULL, 1, 1, 1, '2020-09-13 07:04:33', '2020-09-19 09:29:47'),
(7, 0, 'percobaan', '<p>percobaan qwer</p>\r\n', '', 'percobaan', 'fdgdgfdgd1234', 1, 1, 1, '2020-09-14 10:33:08', '2020-09-14 11:26:04');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(2) NOT NULL,
  `method` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `method`) VALUES
(1, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `userfirst` int(11) NOT NULL,
  `userlast` int(11) NOT NULL,
  `datefirst` datetime NOT NULL,
  `datelast` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `code`, `name`, `address`, `phone`, `email`, `userfirst`, `userlast`, `datefirst`, `datelast`) VALUES
(1, '01', 'Fivelements Retreat', 'Banjar Baturning, Mambal, Bali', '+62 361 469 206', 'contact@fivelements.org', 1, 1, '0000-00-00 00:00:00', '2020-09-12 01:00:34');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`name`, `value`) VALUES
('default_outlet', '1'),
('default_property', '1'),
('multi_property', '0'),
('service', '11'),
('tax', '10');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id` int(11) NOT NULL,
  `menuid` bigint(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `position` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `userfirst` int(11) NOT NULL,
  `userlast` int(11) NOT NULL,
  `datefirst` datetime NOT NULL,
  `datelast` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_menu`
--

INSERT INTO `sub_menu` (`id`, `menuid`, `active`, `position`, `name`, `userfirst`, `userlast`, `datefirst`, `datelast`) VALUES
(12, 15, 0, 1, 'sub menu test', 1, 1, '2020-09-23 10:57:18', '2020-09-23 10:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu_item`
--

CREATE TABLE `sub_menu_item` (
  `id` bigint(20) NOT NULL,
  `submenuid` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `position` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `userfirst` int(11) NOT NULL,
  `userlast` int(11) NOT NULL,
  `datefirst` datetime NOT NULL,
  `datelast` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_menu_item`
--

INSERT INTO `sub_menu_item` (`id`, `submenuid`, `active`, `position`, `name`, `price`, `userfirst`, `userlast`, `datefirst`, `datelast`) VALUES
(11, 12, 0, 1, 'sub menu item test', 200, 1, 1, '2020-09-23 10:57:35', '2020-09-23 10:57:35');

-- --------------------------------------------------------

--
-- Table structure for table `usergroups`
--

CREATE TABLE `usergroups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `propertyid` int(11) DEFAULT NULL,
  `userfirst` int(11) DEFAULT NULL,
  `userlast` int(11) DEFAULT NULL,
  `datefirst` datetime DEFAULT NULL,
  `datelast` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usergroups`
--

INSERT INTO `usergroups` (`id`, `name`, `propertyid`, `userfirst`, `userlast`, `datefirst`, `datelast`) VALUES
(1, 'Root Admin', 1, 0, 1, '0000-00-00 00:00:00', '2019-10-25 08:05:38'),
(2, 'Property Admin', 1, 1, 1, '2019-10-25 08:12:59', '2019-10-25 08:12:59'),
(14, 'User', 1, 1, 1, '2019-10-25 08:07:02', '2019-10-25 08:07:02'),
(15, 'waitress', 1, 1, 1, '2020-08-12 11:49:02', '2020-08-12 11:49:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `groupid` int(11) NOT NULL,
  `propertyid` int(11) NOT NULL,
  `userfirst` int(11) NOT NULL,
  `userlast` int(11) NOT NULL,
  `datefirst` datetime NOT NULL,
  `datelast` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `name`, `password`, `groupid`, `propertyid`, `userfirst`, `userlast`, `datefirst`, `datelast`) VALUES
(1, 'admin', 'Administrator', 'MasterKey', 1, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'giller', 'Andy Giller123', '', 2, 1, 1, 1, '0000-00-00 00:00:00', '2019-11-01 09:00:22'),
(12, 'giller', 'Andy Giller', '123', 2, 46, 1, 1, '2019-10-25 09:02:56', '2019-10-25 09:02:56'),
(13, 'gueadmin', 'Admin', '14045', 14, 1, 1, 1, '2019-10-27 10:43:01', '2019-11-01 09:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `whatson`
--

CREATE TABLE `whatson` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `position` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL,
  `page_link` int(11) DEFAULT NULL,
  `short_desc` text DEFAULT NULL,
  `descriptions` text DEFAULT NULL,
  `topimage` varchar(255) DEFAULT NULL,
  `showonhome` tinyint(1) NOT NULL DEFAULT 0,
  `homeimage` varchar(255) DEFAULT NULL,
  `link` varchar(500) NOT NULL,
  `link_to_url` varchar(255) DEFAULT NULL,
  `propertyid` int(11) NOT NULL,
  `userfirst` int(11) NOT NULL,
  `userlast` int(11) NOT NULL,
  `datefirst` datetime NOT NULL,
  `datelast` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `whatson`
--

INSERT INTO `whatson` (`id`, `active`, `position`, `title`, `page_link`, `short_desc`, `descriptions`, `topimage`, `showonhome`, `homeimage`, `link`, `link_to_url`, `propertyid`, `userfirst`, `userlast`, `datefirst`, `datelast`) VALUES
(1, 0, 3, 'The Executive Performance Retreat', -2, 'vxvxvcv  abd\r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                        ', '', '', 0, 'http://gos.pps.co.id/uploads/user/whatson/Performance-Wellness-Retreat-4-1024x683.jpg', '', 'https://fivelementsbali.com/wellness-retreats/executive-performance-and-boutique-group-retreats/executive-performance-retreat/', 1, 1, 1, '2020-09-14 02:42:46', '2020-09-18 12:41:49'),
(2, 0, 2, 'Signature Fivelements Retreat Panca Mahabhuta', -1, '                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                        ', '', '', 0, 'http://gos.pps.co.id/uploads/user/whatson/signature-fivelements-retreats.jpg', 'http://gos.pps.co.id/uploads/user/room-directory/FE-room-dir.pdf', 'Signature Fivelements Retreat Panca Mahabhuta', 1, 1, 13, '2020-09-14 02:56:50', '2020-09-15 09:51:12'),
(13, 0, 1, 'Book Direct and Receive Special Benefits', 0, '                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                        ', '', '', 0, 'http://gos.pps.co.id/uploads/user/whatson/Water-Garden-Pool-Suite-1-1-1536x1024.jpg', 'book-direct-and-receive-special-benefits11', 'https://bit.ly/3gaOahN', 1, 1, 1, '2020-09-14 08:07:24', '2020-09-18 12:41:43'),
(16, 0, 4, 'Our New Normal Compliance', -1, ' \r\n                                                        ', NULL, '', 0, 'http://gos.pps.co.id/uploads/user/whatson/signature-fivelements-retreats.jpg', '', 'http://gos.pps.co.id/uploads/user/Notification%20Letter%20-%20Signed.pdf', 1, 1, 1, '2020-09-19 07:36:16', '2020-09-19 09:28:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `propertyid` (`propertyid`);

--
-- Indexes for table `menu_cat`
--
ALTER TABLE `menu_cat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roomno` (`name`);

--
-- Indexes for table `menu_disc`
--
ALTER TABLE `menu_disc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_images`
--
ALTER TABLE `menu_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`,`line`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `propertyid` (`propertyid`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `link` (`link`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_menu_item`
--
ALTER TABLE `sub_menu_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usergroups`
--
ALTER TABLE `usergroups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `propertyid` (`propertyid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `propertyid` (`propertyid`);

--
-- Indexes for table `whatson`
--
ALTER TABLE `whatson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `link` (`link`),
  ADD KEY `title` (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `menu_cat`
--
ALTER TABLE `menu_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `menu_disc`
--
ALTER TABLE `menu_disc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_images`
--
ALTER TABLE `menu_images`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `outlet`
--
ALTER TABLE `outlet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sub_menu_item`
--
ALTER TABLE `sub_menu_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `usergroups`
--
ALTER TABLE `usergroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `whatson`
--
ALTER TABLE `whatson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
