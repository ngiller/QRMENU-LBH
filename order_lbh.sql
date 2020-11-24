-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 24, 2020 at 02:59 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `order_lbh`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` varchar(50) NOT NULL,
  `employeeid` int(11) NOT NULL,
  `roomno` int(11) NOT NULL,
  `datein` datetime NOT NULL,
  `dateout` datetime NOT NULL,
  `comment` text NOT NULL,
  `propertyid` int(11) NOT NULL,
  `userfirst` int(11) NOT NULL,
  `userlast` int(11) NOT NULL,
  `datefirst` datetime NOT NULL,
  `datelast` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `activity_images`
--

CREATE TABLE `activity_images` (
  `id` int(11) NOT NULL,
  `line` int(11) NOT NULL,
  `images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_images`
--

INSERT INTO `activity_images` (`id`, `line`, `images`) VALUES
(1, 1, '1.jpg'),
(1, 2, '2.jpg');

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
-- Table structure for table `decl_answer_detail`
--

CREATE TABLE `decl_answer_detail` (
  `id` varchar(255) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `decl_answer_detail`
--

INSERT INTO `decl_answer_detail` (`id`, `question_id`, `answer`) VALUES
('012020101013', 0, ''),
('012020101013', 1, '0'),
('012020101013', 2, '1'),
('012020101013', 3, '0'),
('012020101013', 4, '1'),
('012020101013', 5, '0'),
('012020101013', 6, 'testing only bnmbnb'),
('012020101013', 7, '1'),
('012020101013', 8, 'testing only 123 tyrtere'),
('012020101018', 0, ''),
('012020101018', 1, '1'),
('012020101018', 2, '0'),
('012020101018', 3, '1'),
('012020101018', 4, '0'),
('012020101018', 5, '1'),
('012020101018', 6, ''),
('012020101018', 7, '0'),
('012020101018', 8, 'rrrewr erwerewr ewrwerewr'),
('012020101118', 0, ''),
('012020101118', 1, '1'),
('012020101118', 2, '1'),
('012020101118', 3, '1'),
('012020101118', 4, '1'),
('012020101118', 5, '1'),
('012020101118', 6, ''),
('012020101118', 7, '1'),
('012020101118', 8, ''),
('012020101219', 0, ''),
('012020101219', 1, '1'),
('012020101219', 2, '1'),
('012020101219', 3, '1'),
('012020101219', 4, '1'),
('012020101219', 5, '1'),
('012020101219', 6, ''),
('012020101219', 7, '1'),
('012020101219', 8, ''),
('012020102219', 0, ''),
('012020102219', 1, '0'),
('012020102219', 2, '1'),
('012020102219', 3, '0'),
('012020102219', 4, '1'),
('012020102219', 5, '1'),
('012020102219', 6, 'yes'),
('012020102219', 7, '1'),
('012020102219', 8, 'yes'),
('012020102220', 0, 'yes'),
('012020102220', 1, '1'),
('012020102220', 2, '0'),
('012020102220', 3, '1'),
('012020102220', 4, '1'),
('012020102220', 5, '0'),
('012020102220', 6, 'no'),
('012020102220', 7, '0'),
('012020102220', 8, '');

-- --------------------------------------------------------

--
-- Table structure for table `decl_answer_master`
--

CREATE TABLE `decl_answer_master` (
  `id` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `guest_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `decl_answer_master`
--

INSERT INTO `decl_answer_master` (`id`, `date`, `guest_id`, `property_id`) VALUES
('012020101013', '2020-10-10 07:10:11', 13, 1),
('012020101018', '2020-10-10 10:10:11', 18, 1),
('012020101118', '2020-10-11 04:10:44', 18, 1),
('012020101219', '2020-10-12 13:10:00', 19, 1),
('012020102219', '2020-10-22 09:10:43', 19, 1),
('012020102220', '2020-10-22 09:10:53', 20, 1);

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
  `register_date` datetime DEFAULT NULL,
  `propertyid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `email`, `name`, `phone`, `country`, `register_date`, `propertyid`) VALUES
(3, 'wina@3md.co.id', 'Aldo', '0818189926', 96, NULL, 1),
(4, 'arisdh@outlook.com', 'Aris', '08170070617', 100, NULL, 1),
(5, 'ray@gmail', 'Ray', '082144474680', 3, NULL, 1),
(6, 'maria_wina@yahoo.com', 'Wina', '0818189926', 100, NULL, 1),
(7, 'ray@gmail.com', 'Ray Singal', '082144474680', 3, NULL, 1),
(8, 'hendire.socoval@icloud.com', 'hendj', '085383034400', 5, NULL, 1),
(9, 'hendire@3md.co.com', 'Hendire', '0818189926', 102, NULL, 1),
(10, 'aris', 'Aris', '08170070616', 58, NULL, 1),
(11, 'hendire.socoval@gmail.com', 'Homemade Kimchi', '085383034400', 1, NULL, 1),
(12, 'raysingal@gmail.com', 'Ray', '08213638890', 100, NULL, 1),
(13, 'ngiller@gmail.com', 'Andy Giller', '081237112626', 100, NULL, 1),
(14, 'iwan@test.com', 'iwan subagio', '4423434', 13, NULL, 1),
(15, 'testing@testing.co.id', 'testing only', 'tgttttrt', 13, NULL, 1),
(18, 'andy@pps.co.id', 'Giller Mahendra', '081238440461', 100, '2020-10-10 16:10:50', 1),
(19, 'amgiller@yahoo.com', 'giller', '081237112626', 100, '2020-10-12 19:10:49', 1),
(20, 'andy@3md.co.id', 'Mahendra', '081237112626', 0, '2020-10-22 15:10:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `categoryid` int(200) NOT NULL,
  `descriptions` text NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `limited_stock` tinyint(1) NOT NULL DEFAULT '1',
  `stock` int(11) NOT NULL DEFAULT '0',
  `min_order` int(11) NOT NULL DEFAULT '1',
  `disc` double NOT NULL DEFAULT '0',
  `order_other_outlet` tinyint(1) NOT NULL DEFAULT '0',
  `halal` tinyint(1) NOT NULL DEFAULT '1',
  `chefrecomend` tinyint(1) NOT NULL DEFAULT '1',
  `special` tinyint(1) NOT NULL DEFAULT '1',
  `favourite` tinyint(1) NOT NULL DEFAULT '1',
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

INSERT INTO `menu` (`id`, `active`, `code`, `name`, `categoryid`, `descriptions`, `price`, `limited_stock`, `stock`, `min_order`, `disc`, `order_other_outlet`, `halal`, `chefrecomend`, `special`, `favourite`, `image`, `outletid`, `propertyid`, `userfirst`, `userlast`, `datefirst`, `datelast`) VALUES
(15, 0, 'A001', 'Gado gado', 5, 'Assorted cooked vegetable with peanut sauce', 50000, 1, 0, 1, 0, 1, 1, 1, 1, 1, '', 1, 1, 13, 1, '2020-09-13 02:29:37', '2020-11-09 08:07:14'),
(16, 0, 'A002', 'Caesar Salad | Insalata Cesara', 5, 'Traditional caesar salad served\r\nwith crispy bacon or beef bacon, garlic croutons\r\nand our own caesar dressing\r\nwith grilled tarragon chicken breast\r\nwith grilled prawns', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 1, 1, 13, 1, '2020-09-13 02:30:14', '2020-11-09 08:10:15'),
(32, 0, 'BSD001', 'Tonic water', 36, '', 20000, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 1, 1, 13, 1, '2020-09-14 09:59:17', '2020-11-09 08:24:03'),
(48, 0, 'BM001', 'Legian Breakfast', 1, 'Freshly Squeezed Fruit Juice\r\nOrange, watermelon, cucumber mint or carrot and apple\r\nPilihan Jus segar orange, semangka, timun,wortel, Jahe dnn apel\r\n\r\nA Seasonal Fresh Tropical Fruits Platter\r\nPlease ask our team for available selection\r\nAneka buah-buahan tropls segar sesuai musim, mohon tanyakan pada team kami untuk pilihan yang tersedla\r\n\r\nSelection of Home Made Bakeries\r\nCroissant, danish pastries, muffin, rolls and toast bread, served with preserves, honey and butter\r\nRoti/  buatan   sondirl   : Croissant,   danish,.  muffin,  roti  prancis, rotl  tawar atau  gandum   dlsajikan  dengan  mentega  prancis  dan madu\r\n\r\nFarmed Eggs Prepared Your Way\r\nOmmelete, fried eggs, poached eggs with mushroom, tomato, capsicum, onions, mix Asian herbs, emmenthal cheese.  Pork or beef bacon, spring onion, served with beef or chicken sausage and potato\r\n\r\nTelur  selera   Anda  :  telur   dadar,   telur   mata   sapl,   telur   rebus. telur    dadar   bilt$ll    atau   dcngan   tH!rbllgai  macam   pilihan, tumis   Jamur,  tomot,   paprika,  bawang   bombal,   Cctmpuran rempah&bull;rempah    osian,    keju    emmenthal,    disajikan   dengan\r\nbabi asap atau sapi, sosis ayam, sosis sapi dan kcntang\r\n\r\n\r\n\r\nFreshly Brewed Coffee or Tea\r\nKopi atau teh yang baru di seduh\r\n', 145000, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 1, 1, 13, 1, '2020-09-14 08:56:59', '2020-11-09 07:51:20'),
(69, 0, 'S001', 'Soto Ayam Madura', 11, 'Chicken soup flavored spring roll with bamboo shoots, chicken, shrimps, sweet &amp;amp; sour sauce', 60000, 1, 0, 1, 0, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Soup.jpg', 1, 1, 13, 1, '2020-09-17 09:36:32', '2020-11-09 08:17:45'),
(70, 0, 'MC001', 'Sate Campur dengan saus kacang', 4, 'Assorted satay with peanut sauced\r\nBeef, chicken, fish skewer with spice peanut sauce', 125000, 1, 0, 1, 0, 0, 1, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Main%20Course.jpg', 1, 1, 13, 1, '2020-09-17 09:40:56', '2020-11-09 08:19:42'),
(73, 0, 'HK001', 'Extra Towel', 19, '', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 4, 1, 13, 13, '2020-09-18 01:40:52', '2020-09-18 01:40:52'),
(74, 0, 'HK002', 'Extra Pillow', 19, '', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 4, 1, 13, 13, '2020-09-18 01:41:33', '2020-09-18 01:41:33'),
(75, 0, 'HK003', 'Ironing Board', 19, '', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 4, 1, 13, 13, '2020-09-18 01:42:59', '2020-09-18 01:42:59'),
(76, 0, 'HK004', 'Other', 19, '', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 4, 1, 13, 13, '2020-09-18 01:43:21', '2020-09-18 01:43:21'),
(77, 0, 'DW002', 'Refill Water Jug', 15, '', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 4, 1, 13, 13, '2020-09-18 01:44:58', '2020-09-18 01:44:58'),
(78, 0, 'DK002', 'Request Bottled Water', 15, '', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 4, 1, 13, 13, '2020-09-18 01:45:44', '2020-09-18 01:45:44'),
(79, 0, 'PH001', 'Tooth Brush', 18, '', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 4, 1, 13, 13, '2020-09-18 01:47:45', '2020-09-18 01:47:45'),
(80, 0, 'PH002', 'Tooth Paste', 18, '', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 4, 1, 13, 13, '2020-09-18 01:48:12', '2020-09-18 01:49:05'),
(81, 0, 'PH003', 'Shaver &amp; Foam', 18, '', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 4, 1, 13, 13, '2020-09-18 01:48:50', '2020-09-18 01:48:50'),
(82, 0, 'L001', 'Laundry Pick Up', 23, '', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 4, 1, 13, 13, '2020-09-18 01:49:47', '2020-09-18 01:49:47'),
(83, 0, 'L002', 'Dry Clean Pick Up', 23, '', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 4, 1, 13, 13, '2020-09-18 01:50:15', '2020-09-18 01:50:15'),
(84, 0, 'L003', 'Ironing Services', 23, '', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 4, 1, 13, 13, '2020-09-18 01:50:42', '2020-09-18 01:50:42'),
(85, 0, '01', 'menu percobaan 01', 34, '', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, 'http://order.lbh/uploads//user/Ketan-Kukus-dengan-Buah-Mangga-5.jpg', 6, 1, 1, 1, '2020-10-14 04:01:59', '2020-10-14 04:08:00'),
(86, 0, '02', 'menu percobaan 02', 34, 'kjdkjd kjlksjdlksadjl', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, 'http://order.lbh/uploads//user/Clam-dan-Gurita-Base-Sune-Cekuh-1.jpg', 6, 1, 1, 1, '2020-10-14 04:02:32', '2020-10-14 04:07:52'),
(87, 0, '03', 'menu 02 percobaan 01', 35, '', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 6, 1, 1, 1, '2020-10-14 04:08:28', '2020-10-14 04:17:07'),
(88, 0, '04', 'menu 4 percobaan 2', 35, 'ddfdsfdsf', 0, 1, 0, 1, 0, 1, 1, 1, 1, 1, '', 6, 1, 1, 1, '2020-10-14 04:20:06', '2020-10-14 04:20:06'),
(89, 0, '05', 'menu 05', 35, 'dsasdsd', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 6, 1, 1, 1, '2020-10-14 04:25:58', '2020-10-14 04:26:12'),
(90, 0, 'BM002', 'Asian Breakfast', 1, '', 145000, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 1, 1, 1, 1, '2020-11-09 07:59:19', '2020-11-09 07:59:19'),
(91, 0, 'BM010', 'Cereal', 1, 'Corn flakes, rice krispies, oatmeal porridge\r\nServe with hot or cold milk', 25000, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 1, 1, 1, 1, '2020-11-09 08:00:33', '2020-11-09 08:01:03'),
(92, 0, 'BSD002', 'Soda water', 36, '', 25000, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 1, 1, 1, 1, '2020-11-09 08:23:15', '2020-11-09 08:23:15'),
(93, 0, 'BSD003', 'Coca cola', 36, '', 25000, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 1, 1, 1, 1, '2020-11-09 08:23:42', '2020-11-09 08:23:42'),
(94, 0, 'DS001', 'Pisang Nenas goreng dengan ice cream', 6, 'Deep fried banana with ice cream', 50000, 1, 0, 1, 0, 0, 1, 1, 1, 1, '', 1, 1, 1, 1, '2020-11-09 08:29:52', '2020-11-09 08:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `menu_cat`
--

CREATE TABLE `menu_cat` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `sub_of` int(11) DEFAULT '0',
  `master` tinyint(1) NOT NULL DEFAULT '0',
  `outletid` int(11) NOT NULL,
  `fb` int(11) NOT NULL,
  `order_other_outlet` tinyint(1) NOT NULL DEFAULT '0',
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

INSERT INTO `menu_cat` (`id`, `active`, `code`, `name`, `sub_of`, `master`, `outletid`, `fb`, `order_other_outlet`, `image`, `propertyid`, `userfirst`, `userlast`, `datefirst`, `datelast`) VALUES
(1, 0, '010', 'Breakfast Pleasure', 0, 0, 1, 1, 0, 'http://order.lbh/uploads//01/breakfast.jpg', 1, 1, 1, '2020-09-12 01:02:06', '2020-11-09 05:38:09'),
(4, 0, '040', 'Main Course', 0, 0, 1, 1, 0, 'http://order.lbh/uploads//01/main-course.jpg', 1, 1, 1, '2020-09-12 01:03:56', '2020-11-09 05:38:42'),
(5, 0, '020', 'Appetizer', 0, 0, 1, 1, 0, 'http://order.lbh/uploads//01/appetizer.jpg', 1, 1, 1, '2020-09-12 01:04:12', '2020-11-09 05:38:18'),
(6, 0, '050', 'Dessert', 0, 0, 1, 1, 0, 'http://order.lbh/uploads//01/desert.jpg', 1, 1, 1, '2020-09-12 01:04:22', '2020-11-09 05:38:54'),
(9, 0, '060', 'Beverages', 0, 0, 1, 2, 0, 'http://order.lbh/uploads//01/beverage.jpg', 1, 1, 1, '2020-09-12 01:11:32', '2020-11-09 05:39:12'),
(10, 1, '0', 'Plate to Share', 0, 0, 1, 1, 0, 'http://gos.pps.co.id/uploads/user/SDR-Menu%20tanpa%20Gambar.jpg', 1, 13, 13, '2020-09-13 02:18:52', '2020-09-17 09:32:57'),
(11, 0, '030', 'Soup', 0, 0, 1, 1, 0, 'http://order.lbh/uploads//01/soup.jpg', 1, 13, 1, '2020-09-13 02:22:54', '2020-11-09 05:38:28'),
(12, 1, '0', 'Salads', 0, 0, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/Salad.jpg', 1, 13, 1, '2020-09-13 02:25:39', '2020-10-13 03:45:49'),
(13, 1, '0', 'Side Dishes', 0, 0, 1, 1, 0, 'http://gos.pps.co.id/uploads/user/Sidesidish%20dengan%20discount.jpg', 1, 13, 13, '2020-09-13 02:38:52', '2020-09-17 09:54:00'),
(15, 0, '2', 'Drinking Water', 0, 0, 4, 4, 0, 'http://order.lbh/uploads/01/lbh.jpg', 1, 13, 13, '2020-09-13 09:37:59', '2020-09-18 01:46:54'),
(17, 1, '030.000', 'Set Menu', 0, 0, 1, 1, 1, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Set%20Menu.jpg', 1, 13, 1, '2020-09-14 08:15:54', '2020-11-09 05:22:32'),
(18, 1, '3', 'Personal Hygiene', 0, 0, 4, 4, 0, 'http://order.lbh/uploads/01/lbh.jpg', 1, 1, 1, '2020-09-14 10:02:04', '2020-11-12 07:04:37'),
(19, 0, '1', 'House Keeping', 0, 0, 4, 4, 0, 'http://order.lbh/uploads/01/lbh.jpg', 1, 1, 13, '2020-09-14 10:02:22', '2020-09-18 01:46:37'),
(20, 1, '5', 'Flowers', 0, 0, 4, 4, 1, 'http://order.lbh/uploads/01/lbh.jpg', 1, 1, 1, '2020-09-14 10:03:11', '2020-11-12 07:05:03'),
(21, 1, '050.000', 'Teas & Herbal Blend', 0, 0, 1, 2, 0, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Tea%20and%20Herbal%20Blends.jpg', 1, 13, 1, '2020-09-15 12:04:51', '2020-11-09 05:22:46'),
(22, 1, '060.000', 'Wine', 0, 0, 1, 2, 0, 'http://gos.pps.co.id/uploads/user/SDR%20Item/Wine.jpg', 1, 13, 1, '2020-09-15 09:49:41', '2020-11-09 05:22:53'),
(23, 0, '4', 'Dry Cleaning / Laundry / Ironing', 0, 0, 4, 4, 0, 'http://order.lbh/uploads/01/lbh.jpg', 1, 13, 13, '2020-09-17 08:23:55', '2020-09-18 01:47:07'),
(24, 0, '6', 'Baby Bed', 0, 0, 4, 4, 0, 'http://order.lbh/uploads/01/lbh.jpg', 1, 13, 13, '2020-09-17 08:24:26', '2020-09-18 01:46:46'),
(25, 1, '7', 'Baby Sitting', 0, 0, 4, 1, 0, 'http://order.lbh/uploads/01/lbh.jpg', 1, 13, 1, '2020-09-17 08:30:22', '2020-11-12 07:05:27'),
(26, 1, '020.000', 'All-Day Menu', 0, 0, 1, 1, 0, 'http://gos.pps.co.id/uploads/user/Capture.jpg', 1, 13, 1, '2020-09-17 09:19:41', '2020-11-09 05:22:23'),
(27, 0, '8', 'Airport', 0, 0, 4, 4, 0, 'http://order.lbh/uploads/01/lbh.jpg', 1, 13, 13, '2020-09-18 01:52:24', '2020-09-18 01:52:24'),
(28, 1, '9', 'Water Healing Pool', 0, 0, 4, 4, 0, 'http://order.lbh/uploads/01/lbh.jpg', 1, 13, 1, '2020-09-18 01:52:53', '2020-11-12 07:05:35'),
(29, 1, '10', 'Wake Up Calls', 0, 0, 4, 4, 0, 'http://order.lbh/uploads/01/lbh.jpg', 1, 13, 1, '2020-09-18 01:53:20', '2020-11-12 07:10:36'),
(30, 1, '11', 'Doctor and Nurse', 0, 0, 4, 4, 0, 'http://order.lbh/uploads/01/lbh.jpg', 1, 13, 1, '2020-09-18 01:53:51', '2020-11-12 07:04:28'),
(31, 1, '7', 'Ubud Shuttle Service', 0, 0, 4, 4, 0, 'http://order.lbh/uploads/01/lbh.jpg', 1, 13, 1, '2020-09-18 01:54:13', '2020-11-12 07:05:19'),
(32, 1, '6', 'Healing and Wellness Center', 0, 0, 4, 1, 0, 'http://order.lbh/uploads/01/lbh.jpg', 1, 13, 1, '2020-09-18 01:54:40', '2020-11-12 07:05:11'),
(33, 1, '060.010', 'Red Wine', 0, 0, 1, 2, 0, 'http://order.lbh/uploads/user/outlet/beverages.jpg', 1, 1, 1, '2020-09-23 10:49:23', '2020-11-09 05:22:58'),
(34, 0, '01', 'Percobaan 01', 0, 1, 6, 1, 0, 'http://order.lbh/uploads//user/Salmon-Steak-Baked-in-pastry-Dough-5.jpg', 1, 1, 1, '2020-10-14 04:00:48', '2020-10-14 04:00:48'),
(35, 0, '02', 'percobaan 02 ', 0, 1, 6, 1, 0, 'http://order.lbh/uploads//user/Pangsit-Lobster-4.jpg', 1, 1, 1, '2020-10-14 04:01:24', '2020-10-14 04:01:24'),
(36, 0, '060.010', 'Soft Drinks', 9, 1, 1, 2, 0, '', 1, 1, 1, '2020-11-09 08:20:47', '2020-11-09 08:20:47'),
(37, 0, '060.020', 'Mineral Water', 9, 1, 1, 1, 0, '', 1, 1, 1, '2020-11-09 08:21:11', '2020-11-09 08:21:11');

-- --------------------------------------------------------

--
-- Table structure for table `menu_disc`
--

CREATE TABLE `menu_disc` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `disc` int(11) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_stop` time DEFAULT NULL,
  `allday` tinyint(1) NOT NULL DEFAULT '0',
  `sun` tinyint(1) NOT NULL DEFAULT '0',
  `mon` tinyint(1) NOT NULL DEFAULT '0',
  `tue` tinyint(1) NOT NULL DEFAULT '0',
  `wed` tinyint(1) NOT NULL DEFAULT '0',
  `thu` tinyint(1) NOT NULL DEFAULT '0',
  `fri` tinyint(1) NOT NULL DEFAULT '0',
  `sat` tinyint(1) NOT NULL DEFAULT '0',
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
(1, 0, '10', '10', 10, '2020-09-19', '2020-12-31', '09:00:00', '22:00:00', 1, 0, 1, 1, 1, 1, 1, 0, 1, 1, 0, 1, '0000-00-00 00:00:00', '2020-10-04 01:21:21'),
(2, 0, 'D20', 'disc 20 %', 20, '2020-10-01', '2020-10-31', '00:00:00', '00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, '2020-09-30 07:46:03', '2020-09-30 07:46:03');

-- --------------------------------------------------------

--
-- Table structure for table `menu_images`
--

CREATE TABLE `menu_images` (
  `id` bigint(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
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
('010220100001', 1, 73, 1, 0, 0, 0, ''),
('010220100002', 1, 73, 1, 0, 0, 0, ''),
('010220100003', 1, 73, 1, 0, 0, 0, ''),
('010220100004', 1, 78, 1, 0, 0, 0, ''),
('010220100005', 1, 76, 1, 0, 0, 0, 'testing'),
('010220100006', 1, 73, 1, 0, 0, 0, ''),
('010220100007', 1, 74, 1, 0, 0, 0, ''),
('010220100007', 2, 75, 1, 0, 0, 0, ''),
('010220100008', 1, 75, 1, 0, 0, 0, ''),
('010220100009', 1, 11, 1, 75000, 0, 0, 'TEST PINDAH OUTLET SAAT CHECKOUT'),
('010220100010', 1, 73, 1, 0, 0, 0, ''),
('010320090001', 1, 40, 1, 50000, 0, 0, ''),
('010320090002', 1, 23, 1, 125000, 0, 0, ''),
('010320090003', 1, 46, 1, 550000, 0, 0, ''),
('010320090004', 1, 23, 1, 125000, 0, 0, ''),
('010320100005', 1, 48, 1, 190000, 0, 0, ''),
('010320100005', 2, 48, 1, 190000, 0, 0, ''),
('010320100006', 1, 48, 1, 190000, 0, 0, ''),
('010320100006', 2, 48, 1, 190000, 0, 0, ''),
('010320100007', 1, 48, 1, 190000, 0, 0, ''),
('010320100007', 2, 48, 1, 190000, 0, 0, ''),
('010320100008', 1, 12, 1, 80000, 0, 0, ''),
('010320100009', 1, 18, 1, 100000, 0, 0, ''),
('010320100010', 1, 21, 1, 150000, 0, 0, ''),
('010320100011', 1, 23, 1, 125000, 0, 0, ''),
('010320100012', 1, 48, 1, 190000, 0, 0, ''),
('010320100013', 1, 70, 1, 100000, 0, 0, ''),
('010320100014', 1, 41, 1, 90000, 0, 0, ''),
('010320100015', 1, 49, 1, 45000, 0, 0, ''),
('010320100016', 1, 11, 1, 75000, 0, 0, ''),
('010320100017', 1, 12, 1, 80000, 0, 0, ''),
('010320100018', 1, 14, 1, 80000, 0, 0, ''),
('010320100019', 1, 68, 1, 55000, 0, 0, ''),
('010320100020', 1, 14, 1, 80000, 0, 0, ''),
('010320100021', 1, 67, 1, 80000, 0, 0, ''),
('010320100022', 1, 42, 1, 90000, 0, 0, ''),
('010320100023', 1, 67, 1, 80000, 0, 0, ''),
('010320100024', 1, 11, 1, 75000, 0, 0, ''),
('010320100024', 2, 12, 1, 80000, 0, 0, ''),
('010320100025', 1, 12, 1, 80000, 0, 0, ''),
('010320100026', 1, 46, 1, 550000, 0, 0, ''),
('010320100027', 1, 12, 1, 80000, 0, 0, ''),
('010320100028', 1, 12, 1, 80000, 0, 0, ''),
('010320100029', 1, 72, 1, 560000, 0, 0, ''),
('010320100029', 2, 11, 1, 75000, 0, 0, ''),
('010320100031', 1, 40, 1, 50000, 0, 0, ''),
('010320100032', 1, 41, 1, 90000, 0, 0, ''),
('010320100033', 1, 23, 1, 125000, 0, 0, ''),
('010320100033', 2, 40, 1, 50000, 0, 0, ''),
('010320100033', 3, 56, 1, 45000, 0, 0, ''),
('010320100034', 1, 18, 1, 100000, 0, 0, ''),
('010320100035', 1, 18, 1, 100000, 0, 0, ''),
('010320100036', 1, 15, 1, 72200, 0, 0, ''),
('010320100037', 1, 16, 1, 90000, 0, 0, ''),
('010320100038', 1, 67, 1, 80000, 0, 0, ''),
('010320100039', 1, 13, 1, 80000, 0, 0, ''),
('010320100040', 1, 14, 1, 80000, 0, 0, ''),
('010320100041', 1, 39, 1, 40000, 0, 0, ''),
('010320100042', 1, 67, 1, 80000, 0, 0, ''),
('010320100043', 1, 16, 1, 90000, 0, 0, ''),
('010320110044', 1, 23, 1, 125000, 0, 0, ''),
('010320110045', 1, 48, 1, 190000, 0, 0, ''),
('010320110046', 1, 94, 1, 50000, 0, 0, ''),
('010320110047', 1, 32, 1, 20000, 0, 0, ''),
('010320110047', 2, 15, 1, 50000, 0, 0, ''),
('010320110048', 1, 48, 1, 145000, 0, 0, ''),
('010320110048', 2, 16, 1, 55000, 0, 0, '');

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
('010320100005', 1, 48, 14, 15, 0),
('010320100005', 2, 48, 14, 16, 0),
('010320100006', 1, 48, 14, 15, 0),
('010320100006', 2, 48, 14, 16, 0),
('010320100007', 1, 48, 14, 15, 0),
('010320100007', 2, 48, 14, 16, 0),
('010320100010', 1, 21, 13, 12, 45000),
('010320100012', 1, 48, 14, 15, 0),
('010320100036', 1, 15, 12, 11, 200),
('010320110045', 1, 48, 14, 15, 0),
('010320110048', 1, 48, 14, 15, 0),
('010320110048', 2, 16, 15, 18, 55000);

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
  `note` text,
  `subtotal` double NOT NULL,
  `disc` double NOT NULL,
  `tax` double NOT NULL,
  `service` double NOT NULL,
  `total` double NOT NULL,
  `payment` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `waitress` int(11) NOT NULL,
  `outletid` int(11) NOT NULL,
  `propertyid` int(11) NOT NULL,
  `print` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`id`, `orderdate`, `table_num`, `pax`, `guestid`, `roomno`, `note`, `subtotal`, `disc`, `tax`, `service`, `total`, `payment`, `status`, `waitress`, `outletid`, `propertyid`, `print`) VALUES
('010220100001', '2020-10-11 22:57:35', '', 0, 18, '', '', 0, 0, 11, 10, 0, 0, 2, 0, 4, 1, 1),
('010220100002', '2020-10-12 19:13:31', '', 0, 19, '', '', 0, 0, 11, 10, 0, 0, 0, 0, 4, 1, 1),
('010220100003', '2020-10-12 19:23:06', '104', 0, 19, '', '', 0, 0, 11, 10, 0, 0, 0, 0, 4, 1, 1),
('010220100004', '2020-10-12 19:23:36', '104', 0, 19, '', '', 0, 0, 11, 10, 0, 0, 2, 0, 4, 1, 1),
('010220100005', '2020-10-12 19:27:41', '104', 0, 19, '', '', 0, 0, 11, 10, 0, 0, 2, 0, 4, 1, 1),
('010220100006', '2020-10-12 22:46:15', '104', 0, 19, '', '', 0, 0, 11, 10, 0, 0, 0, 0, 4, 1, 1),
('010220100007', '2020-10-12 22:54:43', '104', 0, 19, '', '', 0, 0, 11, 10, 0, 0, 2, 0, 4, 1, 1),
('010220100008', '2020-10-12 23:11:05', '104', 0, 19, '', '', 0, 0, 11, 10, 0, 0, 0, 0, 4, 1, 1),
('010220100009', '2020-10-12 23:39:20', '104', 0, 19, '', '', 75000, 0, 11, 10, 90750, 1, 2, 0, 4, 1, 1),
('010220100010', '2020-10-12 23:46:03', '104', 0, 19, '', '', 0, 0, 11, 10, 0, 0, 2, 0, 4, 1, 1),
('010320090001', '2020-09-30 12:58:19', '01', 0, 13, '', '', 50000, 0, 11, 10, 60500, 1, 1, 0, 1, 1, 0),
('010320090002', '2020-09-30 14:50:37', '01', 0, 13, '', '', 125000, 0, 11, 10, 151250, 3, 2, 0, 1, 1, 0),
('010320090003', '2020-09-30 14:58:22', '01', 0, 13, '', '', 550000, 0, 11, 10, 665500, 3, 2, 0, 1, 1, 0),
('010320090004', '2020-09-30 14:59:16', '01', 0, 13, '', '', 125000, 0, 11, 10, 151250, 3, 0, 0, 1, 1, 0),
('010320100005', '2020-10-01 08:26:50', '01', 0, 13, '', '', 380000, 0, 11, 10, 459800, 1, 0, 0, 1, 1, 0),
('010320100006', '2020-10-01 08:58:08', '01', 0, 13, '', '', 380000, 0, 11, 10, 459800, 1, 0, 0, 1, 1, 0),
('010320100007', '2020-10-01 12:19:34', '01', 0, 13, '', '', 380000, 0, 11, 10, 459800, 1, 0, 0, 1, 1, 0),
('010320100008', '2020-10-02 02:08:00', '01', 0, 13, '', '', 80000, 0, 11, 10, 96800, 1, 2, 0, 1, 1, 1),
('010320100009', '2020-10-02 02:08:50', '01', 0, 13, '', '', 100000, 0, 11, 10, 121000, 1, 2, 0, 1, 1, 1),
('010320100010', '2020-10-02 02:11:38', '01', 0, 13, '', '', 150000, 0, 11, 10, 181500, 1, 2, 0, 1, 1, 1),
('010320100011', '2020-10-02 02:12:39', '01', 0, 13, '', '', 125000, 0, 11, 10, 151250, 1, 2, 0, 1, 1, 1),
('010320100012', '2020-10-02 02:14:55', '01', 0, 13, '', '', 190000, 0, 11, 10, 229900, 3, 2, 0, 1, 1, 1),
('010320100013', '2020-10-02 02:36:15', '01', 0, 13, '', '', 100000, 0, 11, 10, 121000, 3, 2, 0, 1, 1, 1),
('010320100014', '2020-10-02 02:52:10', '01', 0, 13, '', '', 90000, 0, 11, 10, 108900, 3, 2, 0, 1, 1, 1),
('010320100015', '2020-10-02 02:53:56', '01', 0, 13, '', '', 45000, 0, 11, 10, 54450, 3, 2, 0, 1, 1, 1),
('010320100016', '2020-10-02 17:44:15', '01', 0, 13, '', '', 75000, 0, 11, 10, 90750, 1, 0, 0, 1, 1, 1),
('010320100017', '2020-10-02 17:47:30', '01', 0, 13, '', '', 80000, 0, 11, 10, 96800, 1, 0, 0, 1, 1, 1),
('010320100018', '2020-10-02 17:49:12', '01', 0, 13, '', '', 80000, 0, 11, 10, 96800, 1, 0, 0, 1, 1, 1),
('010320100019', '2020-10-02 17:50:21', '01', 0, 13, '', '', 55000, 0, 11, 10, 66550, 1, 0, 0, 1, 1, 1),
('010320100020', '2020-10-02 17:53:19', '01', 0, 13, '', '', 80000, 0, 11, 10, 96800, 1, 0, 0, 1, 1, 1),
('010320100021', '2020-10-02 17:55:14', '01', 0, 13, '', '', 80000, 0, 11, 10, 96800, 3, 0, 0, 1, 1, 1),
('010320100022', '2020-10-02 18:07:07', '01', 0, 13, '', '', 90000, 0, 11, 10, 108900, 1, 0, 0, 1, 1, 1),
('010320100023', '2020-10-03 02:32:50', '01', 0, 13, '', '', 80000, 0, 11, 10, 96800, 1, 2, 0, 1, 1, 1),
('010320100024', '2020-10-03 10:34:38', '01', 0, 13, '', '', 155000, 0, 11, 10, 187550, 1, 0, 0, 1, 1, 1),
('010320100025', '2020-10-04 11:36:21', '05', 0, 13, '', '', 80000, 0, 11, 10, 96800, 1, 2, 0, 1, 1, 1),
('010320100026', '2020-10-04 12:12:30', '05', 0, 13, '', '', 550000, 0, 11, 10, 665500, 1, 2, 0, 1, 1, 1),
('010320100027', '2020-10-04 18:20:26', '05', 0, 13, '', '', 80000, 0, 11, 10, 96800, 1, 2, 0, 1, 1, 1),
('010320100028', '2020-10-04 19:34:00', '05', 0, 13, '', '', 80000, 0, 11, 10, 96800, 1, 2, 0, 1, 1, 1),
('010320100029', '2020-10-04 22:38:14', '05', 0, 13, '', '', 635000, 0, 11, 10, 768350, 1, 0, 0, 1, 1, 1),
('010320100030', '2020-10-04 22:38:21', '05', 0, 13, '', '', 0, 0, 11, 10, 0, 1, 2, 0, 1, 1, 1),
('010320100031', '2020-10-08 17:15:00', '05', 0, 13, '', '', 50000, 0, 11, 10, 60500, 1, 0, 0, 1, 1, 1),
('010320100032', '2020-10-08 17:20:42', '05', 0, 13, '', '', 90000, 0, 11, 10, 108900, 1, 0, 0, 1, 1, 1),
('010320100033', '2020-10-08 17:22:54', '05', 0, 13, '', '', 220000, 0, 11, 10, 266200, 1, 0, 0, 1, 1, 1),
('010320100034', '2020-10-12 19:14:08', '', 0, 19, '', '', 100000, 0, 11, 10, 121000, 1, 2, 0, 1, 1, 1),
('010320100035', '2020-10-12 19:24:07', '104', 0, 19, '', '', 100000, 0, 11, 10, 121000, 1, 2, 0, 1, 1, 1),
('010320100036', '2020-10-12 23:27:59', '104', 0, 19, '', '', 72200, 0, 11, 10, 87362, 1, 0, 0, 1, 1, 1),
('010320100037', '2020-10-12 23:33:46', '104', 0, 19, '', '', 90000, 0, 11, 10, 108900, 1, 0, 0, 1, 1, 1),
('010320100038', '2020-10-12 23:48:37', '104', 0, 19, '', '', 80000, 0, 11, 10, 96800, 1, 0, 0, 1, 1, 1),
('010320100039', '2020-10-12 23:52:45', '104', 0, 19, '', '', 80000, 0, 11, 10, 96800, 1, 0, 0, 1, 1, 1),
('010320100040', '2020-10-13 00:01:03', '05', 0, 13, '', '', 80000, 0, 11, 10, 96800, 3, 2, 0, 1, 1, 1),
('010320100041', '2020-10-13 00:02:56', '104', 0, 13, '', '', 40000, 0, 11, 10, 48400, 3, 0, 0, 1, 1, 1),
('010320100042', '2020-10-13 00:03:46', '05', 0, 13, '', '', 80000, 0, 11, 10, 96800, 3, 2, 0, 1, 1, 1),
('010320100043', '2020-10-13 21:11:06', '104', 0, 13, '', '', 90000, 0, 11, 10, 108900, 1, 0, 0, 1, 1, 1),
('010320110044', '2020-11-09 11:33:52', '05', 0, 13, '', '', 125000, 0, 11, 10, 151250, 1, 1, 0, 1, 1, 1),
('010320110045', '2020-11-09 14:39:17', '05', 0, 13, '', '', 190000, 0, 11, 10, 229900, 1, 2, 0, 1, 1, 1),
('010320110046', '2020-11-09 16:11:55', '05', 0, 13, '', '', 50000, 0, 10, 11, 60500, 1, 1, 0, 1, 1, 1),
('010320110047', '2020-11-10 09:35:50', '05', 0, 13, '', '', 70000, 0, 10, 11, 84700, 1, 1, 0, 1, 1, 1),
('010320110048', '2020-11-11 14:54:34', '05', 0, 13, '', '', 200000, 0, 10, 11, 242000, 1, 1, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_print`
--

CREATE TABLE `order_print` (
  `order_id` varchar(255) NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_print`
--

INSERT INTO `order_print` (`order_id`, `outlet_id`, `property_id`) VALUES
('010220100001', 4, 1),
('010220100002', 4, 1),
('010220100003', 4, 1),
('010220100004', 4, 1),
('010220100005', 4, 1),
('010220100006', 4, 1),
('010220100007', 4, 1),
('010220100008', 4, 1),
('010220100009', 4, 1),
('010220100010', 4, 1),
('010320100034', 1, 1),
('010320100035', 1, 1),
('010320100036', 1, 1),
('010320100037', 1, 1),
('010320100038', 1, 1),
('010320100039', 1, 1),
('010320100040', 1, 1),
('010320100041', 1, 1),
('010320100042', 1, 1),
('010320100043', 1, 1),
('010320110044', 1, 1),
('010320110045', 1, 1),
('010320110046', 1, 1),
('010320110047', 1, 1),
('010320110048', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

CREATE TABLE `outlet` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `opentime` time NOT NULL DEFAULT '00:00:00',
  `closetime` time NOT NULL DEFAULT '00:00:00',
  `guest_timeout` int(11) NOT NULL DEFAULT '0',
  `orderable` tinyint(1) NOT NULL DEFAULT '0',
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

INSERT INTO `outlet` (`id`, `active`, `code`, `name`, `opentime`, `closetime`, `guest_timeout`, `orderable`, `image`, `propertyid`, `userfirst`, `userlast`, `datefirst`, `datelast`) VALUES
(-1, 0, '999', 'Hotel Directory', '00:00:00', '00:00:00', 0, 0, 'http://order.lbh/uploads/01/directory.jpg', 1, 1, 1, '2020-09-14 09:25:17', '2020-11-12 05:17:37'),
(1, 0, '03', 'Lais Restaurant', '00:00:00', '00:00:00', 0, 0, 'http://order.lbh/uploads/01/desert.jpg', 1, 1, 1, '2020-09-12 01:00:59', '2020-11-12 05:19:11'),
(4, 0, '02', 'Hotel Service', '08:00:00', '20:00:21', 0, 0, 'http://order.lbh/uploads/01/service.jpg', 1, 13, 1, '2020-09-13 09:37:01', '2020-11-12 05:17:28'),
(5, 1, '777', 'Room Order', '00:00:00', '00:00:00', 0, 0, 'http://order.lbh/uploads/user/outlet/dessert.jpg', 1, 1, 1, '2020-09-14 09:23:55', '2020-10-04 03:10:22'),
(6, 1, '04', 'Percobaan', '00:00:00', '00:00:00', 30, 1, 'http://order.lbh/uploads/01/portfolio-3.jpg', 1, 1, 1, '2020-10-14 06:03:38', '2020-11-12 05:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `outlet_table`
--

CREATE TABLE `outlet_table` (
  `id` bigint(20) NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `table_no` varchar(12) NOT NULL,
  `qr_code` varchar(255) NOT NULL,
  `propertyid` int(11) NOT NULL,
  `userfirst` int(11) NOT NULL,
  `userlast` int(11) NOT NULL,
  `datefirst` datetime NOT NULL,
  `datelast` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outlet_table`
--

INSERT INTO `outlet_table` (`id`, `outlet_id`, `active`, `table_no`, `qr_code`, `propertyid`, `userfirst`, `userlast`, `datefirst`, `datelast`) VALUES
(1, 1, 0, '05', '', 1, 1, 1, '2020-09-27 10:43:05', '2020-09-27 10:43:05'),
(2, 1, 0, '15', '', 1, 1, 1, '2020-09-27 10:43:45', '2020-09-27 10:43:45'),
(3, -1, 0, '104', '', 1, 1, 1, '2020-09-27 10:48:26', '2020-09-27 10:48:26'),
(4, -1, 0, '120', '', 1, 1, 1, '2020-09-27 10:48:53', '2020-09-27 10:48:53');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descriptions` text,
  `topimage` varchar(255) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
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
(-2, 0, 'Welcome Message', '<h1>Welcome to Legian Beach Hotel</h1>\r\n\r\n<p>Legian is a Balinese word meaning pleasant and delightful to the senses. Your friendly hosts at Legian Beach Hotel will do everything to ensure that you holiday is not only delightful, but also very special and memorable.</p>\r\n', '', '', NULL, 1, 1, 1, '2020-09-14 02:59:00', '2020-11-09 08:35:31'),
(-1, 0, 'Room Directory', '<h2 style=\"text-align:center\"><strong>HOTEL DIRECTORY</strong></h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>We are delighted to welcome you to Legian Beach Hotel. This hotel directory gives you a thorough insight about all our facilities and services avaiable. If you have an additional question or request please contact one of our team members. We wish you a pleasant and enjoyable stay!</p>\r\n\r\n<p><strong>USEFUL TELEPHONES</strong></p>\r\n\r\n<p>Reception&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Dial 0&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;24 hour Service</p>\r\n\r\n<p>Room Service&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Dial 300&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;07;00 - 22;00 ( last order at&nbsp; 21:30 )</p>\r\n\r\n<p>Healing &amp; Wellness Center&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Dial 200&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;08:00 - 21;00 ( last booking at 19:00 )</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>EVENING SERVICE</strong></p>\r\n\r\n<p>Every evening a room maid will pass to empty your garbage bins, turn on beside light, draw the curtain and change the towels if needed. However if you wish to not be disturbed please plase the provided &quot;do not disturb&quot;sign outside your door</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>ELECTRIC KETTLE</strong></p>\r\n\r\n<p>These is an electric kettle at your disposal. Please use it only to heat water and not any other liquid</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>NON-SMOKING</strong></p>\r\n\r\n<p>As a healing destination retreat, Fivelements Retreat Bali maintains a peaceful atmosphere integrated with nature. To this regard, we support a smoke-free environment</p>\r\n', '', '', NULL, 1, 1, 1, '2020-09-13 07:04:33', '2020-11-09 08:36:06'),
(7, 0, 'percobaan', '<p>percobaan qwer</p>\r\n', '', 'percobaan', 'fdgdgfdgd1234', 1, 1, 1, '2020-09-14 10:33:08', '2020-09-14 11:26:04'),
(8, 0, 'rtrtt1234', '<p>trteter1234</p>\r\n', NULL, 'rtrtt1234', NULL, 1, 1, 1, '2020-09-26 05:50:44', '2020-09-26 05:51:39');

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
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `template_folder` varchar(255) NOT NULL DEFAULT '',
  `userfirst` int(11) NOT NULL,
  `userlast` int(11) NOT NULL,
  `datefirst` datetime NOT NULL,
  `datelast` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `active`, `code`, `name`, `address`, `phone`, `email`, `template_folder`, `userfirst`, `userlast`, `datefirst`, `datelast`) VALUES
(1, 0, '01', 'Legian Beach Hotel', '', '+62 361 469 206', 'contact@fivelements.org', '01', 1, 1, '0000-00-00 00:00:00', '2020-10-04 05:40:22');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` bigint(11) NOT NULL,
  `line` int(11) NOT NULL,
  `question` text NOT NULL,
  `sub_of` int(11) DEFAULT NULL,
  `answer_type` int(11) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `property_id` int(11) NOT NULL,
  `userfirst` int(11) NOT NULL,
  `userlast` int(11) NOT NULL,
  `datefirst` datetime NOT NULL,
  `datelast` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `line`, `question`, `sub_of`, `answer_type`, `score`, `property_id`, `userfirst`, `userlast`, `datefirst`, `datelast`) VALUES
(0, 0, 'Have you now, or in the past 48 hours, had any of the following flu-like symptoms?\r\n', 0, 0, 0, 1, 1, 1, '2020-10-10 00:00:00', '0000-00-00 00:00:00'),
(1, 1, 'Fever (above 37.3C)', 1, 1, 10, 1, 1, 1, '2020-10-10 00:00:00', '2020-10-10 03:50:42'),
(2, 2, 'Breathlessness', 1, 1, 10, 1, 1, 1, '2020-10-10 00:00:00', '2020-10-10 03:50:47'),
(3, 3, 'Cough', 1, 1, 10, 1, 1, 1, '2020-10-10 00:00:00', '2020-10-10 03:50:51'),
(4, 4, 'Sore throat', 1, 1, 10, 1, 1, 1, '2020-10-10 00:00:00', '2020-10-10 03:50:57'),
(5, 5, 'Have you or any immediate family members been overseas in the past 14 days?', 0, 1, 10, 1, 1, 1, '2020-10-10 00:00:00', '2020-10-10 00:00:00'),
(6, 6, 'If yes, where ?', 5, 2, 10, 1, 1, 1, '2020-10-10 00:00:00', '2020-10-10 03:51:14'),
(7, 7, 'Have you or any immediate family members been come close into contact with a confirmed case of Covid-19?', 0, 1, 10, 1, 1, 1, '2020-10-10 00:00:00', '2020-10-10 00:00:00'),
(8, 8, 'If yes, where?', 7, 2, 10, 1, 1, 1, '2020-10-10 00:00:00', '2020-10-10 03:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `text_value` text NOT NULL,
  `property_id` int(11) NOT NULL,
  `userfirst` int(11) NOT NULL,
  `userlast` int(11) NOT NULL,
  `datefirst` datetime NOT NULL,
  `datelast` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`name`, `value`, `text_value`, `property_id`, `userfirst`, `userlast`, `datefirst`, `datelast`) VALUES
('closeword', '', '<p style=\"text-align:center\">Thank you for your valuable time answering all the questions.<br />\r\nHave a pleasant and safe holidays.</p>\r\n', 1, 1, 1, '2020-10-11 00:00:00', '2020-10-11 10:55:10'),
('default_outlet', '1', '', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('default_property', '1', '', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('foreword', '', '', 1, 1, 1, '2020-10-11 00:00:00', '2020-10-11 10:55:10'),
('multi_property', '0', '', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('popup_greeting', '0', '', 1, 1, 1, '2020-10-11 00:00:00', '2020-11-09 03:36:38'),
('popup_greeting_content', '', '<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p><br />\r\nGreetings Valued Guest,&nbsp;</p>\r\n\r\n<p>Thank you for choosing Fivelements Retreat Bali and warm welcome to our beautiful property.&nbsp;<br />\r\nYour health and well being is an utmost priority for us amidst the current global challenge. We have significantly<br />\r\nimproved our health, hygiene, and cleanliness standards to ensure that you are in a perfectly safe environment.<br />\r\nFivelements Retreat Bali fully adheres to the local government health protocol regulation about the new normal<br />\r\nera in Balinese hospitality and tourism industry.&nbsp;</p>\r\n\r\n<p>The improvements that we have made involved but not limited to the following:&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Ensure health and well being of our staff member so they are always fit to serve you</li>\r\n	<li>Use of face mask, gloves, and other applicable personal protective devices&nbsp;</li>\r\n	<li>Availability of hand sanitizer in the room and throughout resort premises</li>\r\n	<li>Disinfect arriving vehicles and items</li>\r\n	<li>Temperature check upon entry</li>\r\n	<li>Application of 1.5-meter physical distancing policy</li>\r\n</ul>\r\n\r\n<p>To make certain of your own health and well being, we require your support as below:</p>\r\n\r\n<ul>\r\n	<li>Use of face mask in the resort premises</li>\r\n	<li>Wash hands or applying hand sanitizer after any physical interaction</li>\r\n	<li>Keep 1.5-meter physical distancing with others</li>\r\n	<li>Follow and support our health protocol regulation</li>\r\n</ul>\r\n\r\n<p>Should you like to further understand about our improved our health, hygiene, and cleanliness standards, please<br />\r\ndo not hesitate to contact our staff members. We have a detailed guideline about the new normal at Fivelements<br />\r\nRetreat Bali for internal use and also for your perusal.<br />\r\nMany thanks and on behalf of Fivelements Retreat Bali, allow me to wish you a wonderful and pleasant time with<br />\r\nus.&nbsp;</p>\r\n\r\n<p><br />\r\nYour sicerely,</p>\r\n\r\n<p>Reinaldo Putra<br />\r\nFront Office Manager<br />\r\nPerson in Charge for The New Normal</p>\r\n\r\n<p>&nbsp;</p>\r\n', 1, 1, 1, '2020-10-11 00:00:00', '2020-11-09 03:36:38'),
('qrsize', '265', '', 1, 0, 1, '0000-00-00 00:00:00', '2020-11-09 03:14:55'),
('service', '11', '', 1, 0, 1, '0000-00-00 00:00:00', '2020-11-09 03:14:54'),
('tax', '10', '', 1, 0, 1, '0000-00-00 00:00:00', '2020-11-09 03:14:54'),
('time_zone', 'Asia/Makassar', '', 1, 0, 1, '0000-00-00 00:00:00', '2020-11-09 03:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id` int(11) NOT NULL,
  `menuid` bigint(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '0',
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
(13, 21, 0, 1, 'Juice', 1, 1, '2020-09-24 06:21:10', '2020-09-24 06:21:10'),
(14, 48, 0, 1, 'coffee or tea', 1, 1, '2020-10-01 08:25:19', '2020-11-09 07:53:05'),
(15, 16, 0, 1, 'select beef, chicken or prawns', 1, 1, '2020-11-09 08:11:17', '2020-11-09 08:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu_item`
--

CREATE TABLE `sub_menu_item` (
  `id` bigint(20) NOT NULL,
  `submenuid` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '0',
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
(12, 13, 0, 1, 'Orange Juice', 45000, 1, 1, '2020-09-24 06:21:45', '2020-09-24 06:21:45'),
(13, 13, 0, 1, 'Avocado Juice', 45000, 1, 1, '2020-09-24 06:22:00', '2020-09-24 06:22:00'),
(15, 14, 0, 1, 'Coffee', 0, 1, 1, '2020-10-01 08:25:35', '2020-11-09 07:53:17'),
(16, 14, 0, 1, 'Tea', 0, 1, 1, '2020-10-01 08:25:45', '2020-11-09 07:53:26'),
(17, 15, 0, 1, 'crispy bacon or beef bacon', 50000, 1, 1, '2020-11-09 08:11:57', '2020-11-09 08:12:57'),
(18, 15, 0, 2, 'grilled tarragon chicken breast', 55000, 1, 1, '2020-11-09 08:12:28', '2020-11-09 08:12:28'),
(19, 15, 0, 3, 'grilled prawns', 85000, 1, 1, '2020-11-09 08:12:50', '2020-11-09 08:12:50');

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
(14, 'Supervisor', 1, 1, 1, '2019-10-25 08:07:02', '2020-09-30 08:42:35'),
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
(2, 'giller', 'Andy Giller123', '456', 2, 1, 1, 1, '0000-00-00 00:00:00', '2020-09-30 08:00:46'),
(13, 'gueadmin', 'Admin', '14045', 14, 1, 1, 1, '2019-10-27 10:43:01', '2019-11-01 09:10:54'),
(21, '01-wtr', 'waitress', '123', 15, 1, 2, 2, '2020-09-30 10:01:45', '2020-09-30 10:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `whatson`
--

CREATE TABLE `whatson` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `page_link` int(11) DEFAULT NULL,
  `short_desc` text,
  `descriptions` text,
  `topimage` varchar(255) DEFAULT NULL,
  `showonhome` tinyint(1) NOT NULL DEFAULT '0',
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
(1, 0, 3, 'Guest and Employee Healthcare', 0, '\r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                        ', NULL, '', 0, 'http://order.lbh/uploads//01/SilenceSerenity.jpg', 'guest-and-employee-healthcare', 'https://legianbeachbali.com/page/whatson/guest-and-employee-healthcare', 1, 1, 1, '2020-09-14 02:42:46', '2020-11-09 08:55:57'),
(2, 0, 2, 'Newly Renovated Rooms', 0, '                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                        ', NULL, '', 0, 'http://order.lbh/uploads//01/Newly-Renovated.jpg', 'newly-renovated-rooms', 'https://legianbeachbali.com/page/whatson/newly-renovated-rooms---superior-family-room', 1, 1, 1, '2020-09-14 02:56:50', '2020-11-09 08:53:16'),
(13, 0, 1, 'Direct booking pay less get more', 0, '                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                        ', NULL, '', 0, 'http://order.lbh/uploads//01/Direct-Booking.jpg', 'direct-booking-pay-less-get-more', 'https://be.synxis.com/?chain=16756&currency=IDR&hotel=23499&level=hotel&locale=en-US', 1, 1, 1, '2020-09-14 08:07:24', '2020-11-09 08:44:12'),
(16, 0, 4, 'Travelife Gold Award ', 0, ' \r\n                                                         \r\n                                                         \r\n                                                         \r\n                                                        ', NULL, '', 0, 'http://order.lbh/uploads//01/Legian-Family-Treats-Package.jpg', 'travelife-gold-award-', 'https://legianbeachbali.com/page/whatson/travelife-gold-award-11111', 1, 1, 1, '2020-09-19 07:36:16', '2020-11-09 08:57:29');

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
-- Indexes for table `decl_answer_master`
--
ALTER TABLE `decl_answer_master`
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
-- Indexes for table `order_print`
--
ALTER TABLE `order_print`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `propertyid` (`propertyid`);

--
-- Indexes for table `outlet_table`
--
ALTER TABLE `outlet_table`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `menu_cat`
--
ALTER TABLE `menu_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `menu_disc`
--
ALTER TABLE `menu_disc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `outlet_table`
--
ALTER TABLE `outlet_table`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sub_menu_item`
--
ALTER TABLE `sub_menu_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `usergroups`
--
ALTER TABLE `usergroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `whatson`
--
ALTER TABLE `whatson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
