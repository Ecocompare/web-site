-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mar. 07 mai 2019 à 15:06
-- Version du serveur :  10.0.38-MariaDB-0+deb8u1
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `patrick_montier_`
--

-- --------------------------------------------------------

--
-- Structure de la table `articleimages`
--

CREATE TABLE `articleimages` (
  `id` int(11) NOT NULL,
  `articleid` int(11) NOT NULL,
  `originalname` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `title` text NOT NULL,
  `tags` text NOT NULL,
  `text` longtext NOT NULL,
  `created` int(11) NOT NULL,
  `enable` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `badge_client_code`
--

CREATE TABLE `badge_client_code` (
  `domaine` varchar(100) NOT NULL,
  `code` varchar(13) NOT NULL,
  `entreprise` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `badge_views`
--

CREATE TABLE `badge_views` (
  `id_view` int(11) NOT NULL,
  `id_pdt` int(11) NOT NULL,
  `code` varchar(13) NOT NULL,
  `domaine` varchar(100) NOT NULL,
  `chemin_page` varchar(100) NOT NULL,
  `date_vue` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `brand`
--

CREATE TABLE `brand` (
  `BRAND_CD` int(11) NOT NULL,
  `BRAND_NM` varchar(255) NOT NULL,
  `GROUP_CD` int(11) DEFAULT NULL,
  `BRAND_TYPE_CD` int(11) NOT NULL DEFAULT '1',
  `BRAND_LINK` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `brand_type`
--

CREATE TABLE `brand_type` (
  `BRAND_TYPE_CD` int(11) NOT NULL,
  `BRAND_TYPE_NM` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parentid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `type` varchar(16) NOT NULL DEFAULT 'product',
  `productid` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `text` text NOT NULL,
  `date` int(11) NOT NULL,
  `state` enum('pending','published','deleted') NOT NULL DEFAULT 'pending',
  `ip` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `title` text NOT NULL,
  `site` text NOT NULL,
  `text` text NOT NULL,
  `created` int(11) NOT NULL,
  `ecosapiens_id` int(11) NOT NULL COMMENT 'id du fliux XML ecosapiens',
  `own_url_shop` varchar(255) NOT NULL,
  `enable` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `dico`
--

CREATE TABLE `dico` (
  `id` int(11) NOT NULL,
  `term` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ecoac_categories`
--

CREATE TABLE `ecoac_categories` (
  `id_ecoac` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ecoac_criteres`
--

CREATE TABLE `ecoac_criteres` (
  `id_criteria` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ecoac_evaluation`
--

CREATE TABLE `ecoac_evaluation` (
  `id_evaluation` int(11) NOT NULL,
  `id_ecoac_evaluation` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `suremballage` tinyint(1) NOT NULL,
  `generateur_dechet` tinyint(1) NOT NULL,
  `matieres_recyclables` tinyint(1) NOT NULL,
  `duree_de_vie` int(11) NOT NULL,
  `qualite_fabrication` varchar(50) NOT NULL,
  `biodegradable` tinyint(1) NOT NULL,
  `appreciation_generale` int(11) NOT NULL,
  `commentaire` text CHARACTER SET utf8 NOT NULL,
  `id_product` int(11) NOT NULL,
  `statut` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ecoac_impacts`
--

CREATE TABLE `ecoac_impacts` (
  `id_ecoac` int(11) NOT NULL,
  `id_impact` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ecoac_labels`
--

CREATE TABLE `ecoac_labels` (
  `id_ecoac` int(11) NOT NULL,
  `id_label` int(11) NOT NULL,
  `id_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ecoac_marques`
--

CREATE TABLE `ecoac_marques` (
  `id_brand` int(11) NOT NULL,
  `id_ecoac` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ecoac_priority`
--

CREATE TABLE `ecoac_priority` (
  `id_ecoac` int(11) NOT NULL,
  `pourcent_environnemental` int(11) NOT NULL DEFAULT '33',
  `pourcent_sanitaire` int(11) NOT NULL DEFAULT '33',
  `pourcent_societal` int(11) NOT NULL DEFAULT '33',
  `pourcent_social` decimal(11,1) NOT NULL DEFAULT '6.6',
  `pourcent_ethique` decimal(11,1) NOT NULL DEFAULT '6.6',
  `pourcent_fairtrade_n_s` decimal(11,1) NOT NULL DEFAULT '6.6',
  `pourcent_fairtrade_n_n` decimal(11,1) NOT NULL DEFAULT '6.6',
  `pourcent_qualite` decimal(11,1) NOT NULL DEFAULT '6.6'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `freetexts`
--

CREATE TABLE `freetexts` (
  `id` varchar(40) NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `freetexts2`
--

CREATE TABLE `freetexts2` (
  `id` varchar(40) NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gcp`
--

CREATE TABLE `gcp` (
  `GCP_CD` varchar(13) NOT NULL,
  `GLN_CD` varchar(13) NOT NULL,
  `GLN_NM` varchar(255) NOT NULL,
  `GLN_ADDR_02` varchar(38) NOT NULL,
  `GLN_ADDR_03` varchar(38) NOT NULL,
  `GLN_ADDR_04` varchar(38) NOT NULL,
  `GLN_ADDR_POSTALCODE` varchar(38) NOT NULL,
  `GLN_ADDR_CITY` varchar(38) NOT NULL,
  `GLN_COUNTRY_ISO_CD` varchar(38) NOT NULL,
  `CONTACT_NAME` varchar(38) NOT NULL,
  `CONTACT_TEL` varchar(255) NOT NULL,
  `CONTACT_FAX` varchar(255) NOT NULL,
  `CONTACT_MAIL` varchar(255) NOT NULL,
  `CONTACT_WEB` varchar(255) NOT NULL,
  `GLN_LAST_CHANGE` varchar(10) NOT NULL,
  `GLN_PROVIDER` varchar(13) NOT NULL,
  `SEARCH_GTIN_CD` varchar(13) NOT NULL,
  `GEPIR_GCP_CD` varchar(13) NOT NULL,
  `ADD_PARTY_ID` varchar(13) NOT NULL,
  `RETURN_CODE` varchar(2) NOT NULL,
  `SOURCE` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gpc`
--

CREATE TABLE `gpc` (
  `GPC_LANG` varchar(3) NOT NULL,
  `GPC_CD` varchar(20) NOT NULL,
  `GPC_NM` text NOT NULL,
  `GPC_LEVEL` varchar(1) NOT NULL,
  `SOURCE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gpc_hier`
--

CREATE TABLE `gpc_hier` (
  `GPC_S_CD` varchar(8) NOT NULL,
  `GPC_F_CD` varchar(8) NOT NULL,
  `GPC_C_CD` varchar(8) NOT NULL,
  `GPC_B_CD` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `group`
--

CREATE TABLE `group` (
  `GROUP_CD` int(11) NOT NULL,
  `GROUP_NM` varchar(255) NOT NULL,
  `GROUP_LINK` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gs1_country`
--

CREATE TABLE `gs1_country` (
  `PREFIXE_CD` varchar(3) NOT NULL,
  `PREFIXE_NM` varchar(255) NOT NULL,
  `COUNTRY_ISO_CD` varchar(11) NOT NULL,
  `GCP_LENGTH` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gtin`
--

CREATE TABLE `gtin` (
  `GTIN_CD` varchar(13) NOT NULL,
  `GTIN_LEVEL_CD` int(11) NOT NULL DEFAULT '1',
  `GCP_CD` varchar(13) DEFAULT NULL,
  `BRAND_CD` int(11) DEFAULT NULL,
  `BRAND_NM` varchar(255) DEFAULT NULL,
  `BRAND_TYPE_CD` int(11) NOT NULL DEFAULT '1',
  `GPC_S_CD` varchar(8) DEFAULT NULL,
  `GPC_F_CD` varchar(8) DEFAULT NULL,
  `GPC_C_CD` varchar(8) DEFAULT NULL,
  `GPC_B_CD` varchar(8) DEFAULT NULL,
  `GTIN_NM` varchar(255) DEFAULT NULL,
  `PRODUCT_LINE` varchar(255) DEFAULT NULL,
  `M_G` float DEFAULT NULL COMMENT 'gramme',
  `M_OZ` float DEFAULT NULL COMMENT 'oz.',
  `M_ML` float DEFAULT NULL COMMENT 'ml',
  `M_FLOZ` float DEFAULT NULL COMMENT 'fl.oz.',
  `M_ABV` float DEFAULT NULL,
  `M_ABW` float DEFAULT NULL,
  `PKG_UNIT` int(11) NOT NULL DEFAULT '1' COMMENT 'Number of items in the product',
  `PKG_TYPE_CD` int(11) DEFAULT NULL,
  `PKG_TYPE_NM` varchar(255) DEFAULT NULL,
  `LABEL_AB_FR` tinyint(1) DEFAULT NULL,
  `LABEL_AB_EU` tinyint(1) DEFAULT NULL,
  `REF_CD` varchar(255) NOT NULL,
  `QUALITY_LEVEL_CD` int(11) DEFAULT NULL,
  `SOURCE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `ip` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `iphone_5products`
--

CREATE TABLE `iphone_5products` (
  `nombre` int(11) NOT NULL,
  `ean` varchar(13) NOT NULL,
  `description` varchar(150) NOT NULL,
  `marque` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `iphone_eans`
--

CREATE TABLE `iphone_eans` (
  `id` int(11) NOT NULL,
  `ean` varchar(50) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `iphone_eans_desc`
--

CREATE TABLE `iphone_eans_desc` (
  `id` int(11) NOT NULL,
  `ean` varchar(50) DEFAULT NULL,
  `description` varchar(150) NOT NULL,
  `marque` varchar(150) NOT NULL,
  `date_update` date NOT NULL COMMENT 'Date à laquelle on demande le libellé du EAN',
  `produitvert` tinyint(1) NOT NULL COMMENT 'Produit écologique',
  `date_request` date NOT NULL COMMENT '1ere date de demande ',
  `ecocompare` int(11) NOT NULL,
  `noresult` tinyint(1) NOT NULL,
  `hit` int(11) NOT NULL,
  `brandaction` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `iphone_eans_SW`
--

CREATE TABLE `iphone_eans_SW` (
  `id` int(11) NOT NULL,
  `ean` varchar(50) NOT NULL,
  `dpt` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `cp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `iphone_marque`
--

CREATE TABLE `iphone_marque` (
  `id` int(11) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `iphone_marqueverte`
--

CREATE TABLE `iphone_marqueverte` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `action` varchar(255) NOT NULL,
  `eanfamily` varchar(255) NOT NULL,
  `sector_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Table contenant la liste des marques vertes';

-- --------------------------------------------------------

--
-- Structure de la table `iphone_query`
--

CREATE TABLE `iphone_query` (
  `id` int(11) NOT NULL,
  `iphone_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `ean` varchar(50) DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `altitude` float DEFAULT NULL,
  `date` datetime NOT NULL,
  `codeInsee` int(11) NOT NULL COMMENT 'id de la ville',
  `useragent` varchar(200) NOT NULL,
  `sumsent` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `iphone_query_month`
--

CREATE TABLE `iphone_query_month` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `sort` int(11) NOT NULL COMMENT 'classement',
  `totalproduitvert` int(11) NOT NULL COMMENT 'dont ceux qui sont tagés green',
  `year` int(11) NOT NULL,
  `win_max` tinyint(1) NOT NULL,
  `win_maxgreen` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `iphone_query_SW`
--

CREATE TABLE `iphone_query_SW` (
  `id` int(11) NOT NULL,
  `iphone_id` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `dpt` int(11) NOT NULL,
  `cp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `iphone_recap_mois`
--

CREATE TABLE `iphone_recap_mois` (
  `id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `nb_total_scan_thismonth` int(11) NOT NULL COMMENT 'Nb total de scan pour ce mois',
  `nb_user_scan_thismonth` int(11) NOT NULL COMMENT 'Nombre distinct d''ecoacteurs pour ce mois',
  `nb_total_search_thismonth` int(11) NOT NULL,
  `nb_user_search_thismonth` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `iphone_scan_month`
--

CREATE TABLE `iphone_scan_month` (
  `ean` varchar(50) DEFAULT NULL,
  `iphone_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `marque` varchar(150) DEFAULT NULL,
  `ecocompare` int(11) DEFAULT NULL,
  `produitvert` tinyint(1) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `codeInsee` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `iphone_users`
--

CREATE TABLE `iphone_users` (
  `id` int(11) NOT NULL,
  `iphone_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) NOT NULL,
  `isValid` tinyint(1) NOT NULL,
  `token` varchar(26) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `birthyear` varchar(4) NOT NULL,
  `postalcode` varchar(5) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `job` varchar(255) NOT NULL,
  `nb_child` int(2) NOT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `inscription` datetime NOT NULL,
  `mail_inscription` date NOT NULL,
  `FB_id` varchar(30) NOT NULL COMMENT 'id facebook',
  `alert_geo` date NOT NULL,
  `useragent` varchar(200) NOT NULL,
  `stopsummary` tinyint(1) NOT NULL,
  `prevsort` int(11) NOT NULL,
  `actualsort` int(11) NOT NULL,
  `description` text,
  `news_priorites` tinyint(1) NOT NULL DEFAULT '0',
  `news_criteres` tinyint(1) NOT NULL DEFAULT '0',
  `news_categories` tinyint(1) NOT NULL DEFAULT '0',
  `news_labels` tinyint(1) NOT NULL DEFAULT '0',
  `news_marques` tinyint(1) NOT NULL DEFAULT '0',
  `news_impacts` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `iphone_users_stat`
--

CREATE TABLE `iphone_users_stat` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `total_scan` bigint(21) DEFAULT NULL,
  `total_resp_scan` bigint(21) DEFAULT NULL,
  `month_scan` bigint(11) DEFAULT NULL,
  `month_resp_scan` bigint(11) DEFAULT NULL,
  `nbwin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `iphone_winners`
--

CREATE TABLE `iphone_winners` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `month` varchar(2) NOT NULL,
  `year` int(11) NOT NULL,
  `nbscans` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `label`
--

CREATE TABLE `label` (
  `GTIN_CD` varchar(13) NOT NULL,
  `LABEL_CD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `labels`
--

CREATE TABLE `labels` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `referentiel` varchar(200) NOT NULL,
  `zindex` int(11) NOT NULL,
  `subratingid` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `version` varchar(250) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `labels_has_ecoac_user`
--

CREATE TABLE `labels_has_ecoac_user` (
  `id` int(11) NOT NULL,
  `labels_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `label_nm`
--

CREATE TABLE `label_nm` (
  `label_cd` int(11) NOT NULL,
  `label_nm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lastuserchange`
--

CREATE TABLE `lastuserchange` (
  `id` int(11) DEFAULT NULL,
  `lastupdate` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `intro` text NOT NULL,
  `conclusion` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `matchproducts`
--

CREATE TABLE `matchproducts` (
  `matchid` int(11) NOT NULL,
  `productid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `m_criteria`
--

CREATE TABLE `m_criteria` (
  `id` int(11) NOT NULL,
  `lifecycle_id` int(11) NOT NULL,
  `theme_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `heading_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `proof_exist` text NOT NULL,
  `proof_new` text NOT NULL,
  `example` text NOT NULL,
  `points` decimal(5,2) NOT NULL,
  `ask_proof` tinyint(1) NOT NULL COMMENT '0 : commentaire, 1 preuve ou photo envoyée, 2 Déclaration sur l''honneur',
  `lang` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `m_criteria_label`
--

CREATE TABLE `m_criteria_label` (
  `id` int(11) NOT NULL,
  `label_id` int(11) NOT NULL,
  `criteria_id` int(11) NOT NULL,
  `value` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `m_crit_indic`
--

CREATE TABLE `m_crit_indic` (
  `id` int(11) NOT NULL,
  `criteria_id` int(11) NOT NULL,
  `indicator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `m_heading`
--

CREATE TABLE `m_heading` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `lang` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `m_indicator`
--

CREATE TABLE `m_indicator` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `help` text NOT NULL,
  `lang` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `m_lifecycle`
--

CREATE TABLE `m_lifecycle` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lang` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `m_theme`
--

CREATE TABLE `m_theme` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lang` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `tags` text NOT NULL,
  `text` text NOT NULL,
  `created` int(11) NOT NULL DEFAULT '1',
  `enable` smallint(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `partnerbrandlink`
--

CREATE TABLE `partnerbrandlink` (
  `id` int(11) NOT NULL,
  `partner` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `brandid` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `dateupdate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `partnerproductlink`
--

CREATE TABLE `partnerproductlink` (
  `id` int(11) NOT NULL,
  `partner` varchar(100) NOT NULL,
  `productid` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `dateupdate` date NOT NULL,
  `partnerid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pkg_type`
--

CREATE TABLE `pkg_type` (
  `pkg_type_cd` int(11) NOT NULL,
  `pkg_type_nm` varchar(255) NOT NULL,
  `pkg_type_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `productcategories`
--

CREATE TABLE `productcategories` (
  `productid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `productindicator`
--

CREATE TABLE `productindicator` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `indicatorid` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `productlabels`
--

CREATE TABLE `productlabels` (
  `productid` int(11) NOT NULL,
  `labelid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `productlinkhs`
--

CREATE TABLE `productlinkhs` (
  `id` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `productid` int(11) NOT NULL,
  `date` date NOT NULL,
  `server_addr` varchar(200) NOT NULL,
  `server_name` varchar(200) NOT NULL,
  `http_referer` varchar(200) NOT NULL,
  `http_host` varchar(200) NOT NULL,
  `http_user_agent` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `productreview`
--

CREATE TABLE `productreview` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `typeid` int(11) NOT NULL COMMENT 'type du produit',
  `equitable_sud` tinyint(1) NOT NULL,
  `refid` int(11) NOT NULL,
  `state` enum('submission','draft','published') NOT NULL DEFAULT 'published',
  `image` text NOT NULL,
  `name` text NOT NULL,
  `brand` text NOT NULL,
  `EAN` text NOT NULL,
  `description` text NOT NULL,
  `tags` text NOT NULL,
  `rating1comment` text NOT NULL,
  `rating2comment` text NOT NULL,
  `rating3comment` text NOT NULL,
  `rating4comment` text NOT NULL,
  `rating5comment` text NOT NULL,
  `rating6comment` text NOT NULL,
  `price` text NOT NULL,
  `facts` text NOT NULL,
  `findit` text NOT NULL,
  `related` text NOT NULL,
  `created` int(11) NOT NULL,
  `pubdate` int(11) NOT NULL,
  `published` enum('submission','false','true','deactivated','saved') NOT NULL DEFAULT 'true',
  `selec` enum('false','true') NOT NULL DEFAULT 'false',
  `contact` text NOT NULL,
  `co2` text NOT NULL,
  `majdate` int(11) NOT NULL,
  `majuserid` int(11) NOT NULL,
  `AE` varchar(100) NOT NULL,
  `rating1` decimal(5,2) NOT NULL,
  `rating2` decimal(5,2) NOT NULL,
  `rating3` decimal(5,2) NOT NULL,
  `score1` decimal(5,2) NOT NULL,
  `score2` decimal(5,2) NOT NULL,
  `score3` decimal(5,2) NOT NULL,
  `score4` decimal(5,1) NOT NULL,
  `globalcomment` varchar(250) NOT NULL,
  `scorereview` decimal(10,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `productscore`
--

CREATE TABLE `productscore` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `theme_id` int(11) NOT NULL,
  `lifecycle_id` int(11) NOT NULL,
  `score` decimal(5,2) NOT NULL,
  `note` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `productstats`
--

CREATE TABLE `productstats` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(20) NOT NULL,
  `useragent` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `productsubratingjustif`
--

CREATE TABLE `productsubratingjustif` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `subratingid` int(11) NOT NULL,
  `bo_received` tinyint(1) NOT NULL,
  `bo_date` date NOT NULL,
  `bo_comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `productsubratings`
--

CREATE TABLE `productsubratings` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `subratingid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `feedback` text NOT NULL,
  `islabel` tinyint(1) NOT NULL,
  `bo_received` tinyint(1) NOT NULL,
  `bo_date` date NOT NULL,
  `bo_comment` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `productsubratingscomments`
--

CREATE TABLE `productsubratingscomments` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `subratingid` int(11) NOT NULL,
  `labelid` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `products_old`
--

CREATE TABLE `products_old` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `typeid` int(11) NOT NULL COMMENT 'type du produit',
  `refid` int(11) NOT NULL,
  `state` enum('submission','draft','published') NOT NULL DEFAULT 'published',
  `image` text NOT NULL,
  `name` text NOT NULL,
  `brand` text NOT NULL,
  `EAN` text NOT NULL,
  `description` text NOT NULL,
  `tags` text NOT NULL,
  `rating1` float NOT NULL,
  `score1` int(11) NOT NULL,
  `rating1comment` text NOT NULL,
  `rating1enabled` enum('false','true') NOT NULL DEFAULT 'true',
  `rating2` float NOT NULL,
  `score2` int(11) NOT NULL,
  `rating2comment` text NOT NULL,
  `rating2enabled` enum('false','true') NOT NULL DEFAULT 'true',
  `rating3` float NOT NULL,
  `score3` int(11) NOT NULL,
  `rating3comment` text NOT NULL,
  `rating3enabled` enum('false','true') NOT NULL DEFAULT 'true',
  `rating4` float NOT NULL,
  `score4` int(11) NOT NULL,
  `rating4comment` text NOT NULL,
  `rating4enabled` enum('false','true') NOT NULL,
  `price` text NOT NULL,
  `facts` text NOT NULL,
  `findit` text NOT NULL,
  `related` text NOT NULL,
  `created` int(11) NOT NULL,
  `pubdate` int(11) NOT NULL,
  `published` enum('submission','false','true','deactivated') NOT NULL DEFAULT 'true',
  `selec` enum('false','true') NOT NULL DEFAULT 'false',
  `contact` text NOT NULL,
  `co2` text NOT NULL,
  `majdate` int(11) NOT NULL,
  `majuserid` int(11) NOT NULL,
  `AE` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reviewquestion`
--

CREATE TABLE `reviewquestion` (
  `id` int(11) NOT NULL,
  `question` varchar(200) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `isbadge` tinyint(1) NOT NULL,
  `isrequired` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sectors`
--

CREATE TABLE `sectors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `statistics`
--

CREATE TABLE `statistics` (
  `id` int(11) NOT NULL,
  `cle` varchar(50) NOT NULL,
  `valeur` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `subratings2`
--

CREATE TABLE `subratings2` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `shortname` text NOT NULL,
  `ratingid` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `help` text NOT NULL,
  `comment` enum('false','true') NOT NULL,
  `modification` int(11) DEFAULT NULL,
  `version` varchar(20) NOT NULL DEFAULT '1.0',
  `guideline` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `libelle` varchar(50) NOT NULL,
  `nombre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tclickcategory`
--

CREATE TABLE `tclickcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `deleted` enum('Y','N') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tclicktable`
--

CREATE TABLE `tclicktable` (
  `id` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `clicks` bigint(20) DEFAULT NULL,
  `deleted` enum('Y','N') DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(20) NOT NULL,
  `productid` int(11) NOT NULL COMMENT 'id du produit',
  `page` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `testimony`
--

CREATE TABLE `testimony` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `author` varchar(200) NOT NULL,
  `source` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `top_product_view`
--

CREATE TABLE `top_product_view` (
  `productid` int(11) DEFAULT NULL,
  `name` text,
  `count(*)` bigint(21) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL,
  `example` text COLLATE utf8_bin NOT NULL,
  `ideal` text COLLATE utf8_bin NOT NULL,
  `name_en` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `typelabel`
--

CREATE TABLE `typelabel` (
  `typeid` int(11) NOT NULL,
  `labelid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `typescore`
--

CREATE TABLE `typescore` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `theme_id` int(11) NOT NULL,
  `lifecycle_id` int(11) NOT NULL,
  `scoreideal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `typesubrating`
--

CREATE TABLE `typesubrating` (
  `type_id` int(11) NOT NULL,
  `subrating_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` text NOT NULL,
  `type` enum('admin','company') NOT NULL,
  `companyid` int(11) NOT NULL,
  `lang` tinyint(4) NOT NULL COMMENT '1 :FR, 2: EN',
  `lastupdate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `usersreviews`
--

CREATE TABLE `usersreviews` (
  `id_avis` int(11) NOT NULL,
  `num_question` int(11) NOT NULL COMMENT 'si 1 : ces infos vous ont-elles guide lors de votre acte d''achat? , si 2 : que pensez-vous de cet eco-comparateur?',
  `avis` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `view_clickproducts`
--

CREATE TABLE `view_clickproducts` (
  `productid` int(11) DEFAULT NULL,
  `name` text,
  `brand` text,
  `date` datetime DEFAULT NULL,
  `username` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `view_iphonesearchproduct`
--

CREATE TABLE `view_iphonesearchproduct` (
  `product_id` int(11) DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `iphone_id` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `name` text,
  `brand` text,
  `userid` int(11) DEFAULT NULL,
  `username` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `view_labeltype`
--

CREATE TABLE `view_labeltype` (
  `typeid` int(11) DEFAULT NULL,
  `nomtype` varchar(45) DEFAULT NULL,
  `labelid` int(11) DEFAULT NULL,
  `nomlabel` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `view_productstats`
--

CREATE TABLE `view_productstats` (
  `id` int(11) DEFAULT NULL,
  `name` text,
  `brand` text,
  `username` varchar(40) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `view_scaniphone`
--

CREATE TABLE `view_scaniphone` (
  `ean` varchar(50) DEFAULT NULL,
  `iphone_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `marque` varchar(150) DEFAULT NULL,
  `ecocompare` int(11) DEFAULT NULL,
  `produitvert` tinyint(1) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `codeInsee` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wgs84_codes_postaux`
--

CREATE TABLE `wgs84_codes_postaux` (
  `ville` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `villeMaj` varchar(255) COLLATE latin1_general_ci NOT NULL COMMENT 'ville en majuscule sans caractères spéciaux (accent, apostrophe et tiret)',
  `codePostal` int(10) UNSIGNED NOT NULL,
  `codeInsee` int(10) UNSIGNED NOT NULL,
  `codeRegion` int(10) UNSIGNED NOT NULL,
  `longitude` float(10,6) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `googleWgs84Lon` float(10,6) NOT NULL,
  `googleWgs84Lat` float(10,6) NOT NULL,
  `googleStatusCode` int(10) UNSIGNED NOT NULL,
  `googleAccuracy` int(10) UNSIGNED NOT NULL,
  `googleAdministrativeAreaName` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `googleSubAdministrativeAreaName` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `googleLocalityName` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `googlePostalCodeNumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `yahooWgs84Lon` float(10,6) NOT NULL,
  `yahooWgs84Lat` float(10,6) NOT NULL,
  `yahooPrecision` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `yahooCity` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `yahooZip` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `yahooWarning` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `region` varchar(200) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `wiew_criteres`
--

CREATE TABLE `wiew_criteres` (
  `type_id` int(11) DEFAULT NULL,
  `ratingid` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `name` text,
  `help` text,
  `guideline` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articleimages`
--
ALTER TABLE `articleimages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `badge_client_code`
--
ALTER TABLE `badge_client_code`
  ADD PRIMARY KEY (`domaine`,`code`);

--
-- Index pour la table `badge_views`
--
ALTER TABLE `badge_views`
  ADD PRIMARY KEY (`id_view`);

--
-- Index pour la table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`BRAND_CD`);

--
-- Index pour la table `brand_type`
--
ALTER TABLE `brand_type`
  ADD PRIMARY KEY (`BRAND_TYPE_CD`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dico`
--
ALTER TABLE `dico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `term` (`term`);

--
-- Index pour la table `ecoac_categories`
--
ALTER TABLE `ecoac_categories`
  ADD PRIMARY KEY (`id_ecoac`,`id_categorie`);

--
-- Index pour la table `ecoac_criteres`
--
ALTER TABLE `ecoac_criteres`
  ADD PRIMARY KEY (`id_criteria`,`id_user`);

--
-- Index pour la table `ecoac_evaluation`
--
ALTER TABLE `ecoac_evaluation`
  ADD PRIMARY KEY (`id_evaluation`);

--
-- Index pour la table `ecoac_impacts`
--
ALTER TABLE `ecoac_impacts`
  ADD PRIMARY KEY (`id_ecoac`,`id_impact`);

--
-- Index pour la table `ecoac_labels`
--
ALTER TABLE `ecoac_labels`
  ADD PRIMARY KEY (`id_ecoac`,`id_label`,`id_type`);

--
-- Index pour la table `ecoac_marques`
--
ALTER TABLE `ecoac_marques`
  ADD PRIMARY KEY (`id_brand`,`id_ecoac`);

--
-- Index pour la table `ecoac_priority`
--
ALTER TABLE `ecoac_priority`
  ADD PRIMARY KEY (`id_ecoac`);

--
-- Index pour la table `freetexts`
--
ALTER TABLE `freetexts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `freetexts2`
--
ALTER TABLE `freetexts2`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gpc`
--
ALTER TABLE `gpc`
  ADD PRIMARY KEY (`GPC_LANG`,`GPC_CD`);

--
-- Index pour la table `gpc_hier`
--
ALTER TABLE `gpc_hier`
  ADD PRIMARY KEY (`GPC_B_CD`);

--
-- Index pour la table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`GROUP_CD`);

--
-- Index pour la table `gs1_country`
--
ALTER TABLE `gs1_country`
  ADD PRIMARY KEY (`PREFIXE_CD`);

--
-- Index pour la table `gtin`
--
ALTER TABLE `gtin`
  ADD PRIMARY KEY (`GTIN_CD`);

--
-- Index pour la table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `iphone_eans`
--
ALTER TABLE `iphone_eans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ean` (`ean`);

--
-- Index pour la table `iphone_eans_desc`
--
ALTER TABLE `iphone_eans_desc`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ean_2` (`ean`),
  ADD KEY `marque` (`marque`);

--
-- Index pour la table `iphone_eans_SW`
--
ALTER TABLE `iphone_eans_SW`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `iphone_marque`
--
ALTER TABLE `iphone_marque`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_nom` (`description`);

--
-- Index pour la table `iphone_marqueverte`
--
ALTER TABLE `iphone_marqueverte`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `libelle` (`libelle`);

--
-- Index pour la table `iphone_query`
--
ALTER TABLE `iphone_query`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `antidoublon` (`iphone_id`,`ean`,`date`),
  ADD KEY `iphone_id` (`iphone_id`),
  ADD KEY `ean` (`ean`),
  ADD KEY `latitude` (`latitude`),
  ADD KEY `longitude` (`longitude`),
  ADD KEY `codeinsee` (`codeInsee`);

--
-- Index pour la table `iphone_query_month`
--
ALTER TABLE `iphone_query_month`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `iphone_query_SW`
--
ALTER TABLE `iphone_query_SW`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `iphone_recap_mois`
--
ALTER TABLE `iphone_recap_mois`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `iphone_users`
--
ALTER TABLE `iphone_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iphone_id` (`iphone_id`);

--
-- Index pour la table `iphone_users_stat`
--
ALTER TABLE `iphone_users_stat`
  ADD PRIMARY KEY (`user_id`);

--
-- Index pour la table `iphone_winners`
--
ALTER TABLE `iphone_winners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cle2` (`user_id`,`month`,`year`);

--
-- Index pour la table `label`
--
ALTER TABLE `label`
  ADD PRIMARY KEY (`GTIN_CD`,`LABEL_CD`);

--
-- Index pour la table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `labels_has_ecoac_user`
--
ALTER TABLE `labels_has_ecoac_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_labels_has_ecoac_user_labels` (`labels_id`),
  ADD KEY `fk_labels_has_ecoac_user_ecoac_user` (`user_id`);

--
-- Index pour la table `label_nm`
--
ALTER TABLE `label_nm`
  ADD PRIMARY KEY (`label_cd`);

--
-- Index pour la table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `m_criteria`
--
ALTER TABLE `m_criteria`
  ADD UNIQUE KEY `id` (`id`,`lang`);

--
-- Index pour la table `m_criteria_label`
--
ALTER TABLE `m_criteria_label`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label_id` (`label_id`,`criteria_id`);

--
-- Index pour la table `m_crit_indic`
--
ALTER TABLE `m_crit_indic`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `m_heading`
--
ALTER TABLE `m_heading`
  ADD UNIQUE KEY `id` (`id`,`lang`);

--
-- Index pour la table `m_indicator`
--
ALTER TABLE `m_indicator`
  ADD UNIQUE KEY `id` (`id`,`lang`);

--
-- Index pour la table `m_lifecycle`
--
ALTER TABLE `m_lifecycle`
  ADD UNIQUE KEY `id` (`id`,`lang`);

--
-- Index pour la table `m_theme`
--
ALTER TABLE `m_theme`
  ADD UNIQUE KEY `id` (`id`,`lang`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `partnerbrandlink`
--
ALTER TABLE `partnerbrandlink`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brandid` (`brandid`);

--
-- Index pour la table `partnerproductlink`
--
ALTER TABLE `partnerproductlink`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productid` (`productid`);

--
-- Index pour la table `pkg_type`
--
ALTER TABLE `pkg_type`
  ADD PRIMARY KEY (`pkg_type_cd`);

--
-- Index pour la table `productindicator`
--
ALTER TABLE `productindicator`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productid` (`productid`,`indicatorid`);

--
-- Index pour la table `productlabels`
--
ALTER TABLE `productlabels`
  ADD UNIQUE KEY `productid` (`productid`,`labelid`);

--
-- Index pour la table `productlinkhs`
--
ALTER TABLE `productlinkhs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `productreview`
--
ALTER TABLE `productreview`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);
ALTER TABLE `products` ADD FULLTEXT KEY `Fulltext` (`name`,`brand`,`EAN`,`description`,`tags`);

--
-- Index pour la table `productscore`
--
ALTER TABLE `productscore`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `productstats`
--
ALTER TABLE `productstats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `productsubratingjustif`
--
ALTER TABLE `productsubratingjustif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productid` (`productid`),
  ADD KEY `subratingid` (`subratingid`);

--
-- Index pour la table `productsubratings`
--
ALTER TABLE `productsubratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productid` (`productid`),
  ADD KEY `subratingid` (`subratingid`);

--
-- Index pour la table `productsubratingscomments`
--
ALTER TABLE `productsubratingscomments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productid` (`productid`),
  ADD KEY `subratingid` (`subratingid`);

--
-- Index pour la table `products_old`
--
ALTER TABLE `products_old`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `products_old` ADD FULLTEXT KEY `Fulltext` (`name`,`brand`,`EAN`,`description`,`tags`);

--
-- Index pour la table `reviewquestion`
--
ALTER TABLE `reviewquestion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cle` (`cle`);

--
-- Index pour la table `subratings2`
--
ALTER TABLE `subratings2`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tclickcategory`
--
ALTER TABLE `tclickcategory`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tclicktable`
--
ALTER TABLE `tclicktable`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `testimony`
--
ALTER TABLE `testimony`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typelabel`
--
ALTER TABLE `typelabel`
  ADD UNIQUE KEY `typeid` (`typeid`,`labelid`);

--
-- Index pour la table `typescore`
--
ALTER TABLE `typescore`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typesubrating`
--
ALTER TABLE `typesubrating`
  ADD UNIQUE KEY `antidoublon` (`type_id`,`subrating_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `usersreviews`
--
ALTER TABLE `usersreviews`
  ADD PRIMARY KEY (`id_avis`);

--
-- Index pour la table `wgs84_codes_postaux`
--
ALTER TABLE `wgs84_codes_postaux`
  ADD PRIMARY KEY (`codeInsee`),
  ADD KEY `longitude` (`longitude`),
  ADD KEY `latutude` (`latitude`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articleimages`
--
ALTER TABLE `articleimages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `badge_views`
--
ALTER TABLE `badge_views`
  MODIFY `id_view` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `brand`
--
ALTER TABLE `brand`
  MODIFY `BRAND_CD` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `dico`
--
ALTER TABLE `dico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ecoac_evaluation`
--
ALTER TABLE `ecoac_evaluation`
  MODIFY `id_evaluation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `group`
--
ALTER TABLE `group`
  MODIFY `GROUP_CD` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `iphone_eans`
--
ALTER TABLE `iphone_eans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `iphone_eans_desc`
--
ALTER TABLE `iphone_eans_desc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `iphone_eans_SW`
--
ALTER TABLE `iphone_eans_SW`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `iphone_marque`
--
ALTER TABLE `iphone_marque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `iphone_marqueverte`
--
ALTER TABLE `iphone_marqueverte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `iphone_query`
--
ALTER TABLE `iphone_query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `iphone_query_month`
--
ALTER TABLE `iphone_query_month`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `iphone_query_SW`
--
ALTER TABLE `iphone_query_SW`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `iphone_recap_mois`
--
ALTER TABLE `iphone_recap_mois`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `iphone_users`
--
ALTER TABLE `iphone_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `iphone_winners`
--
ALTER TABLE `iphone_winners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `labels_has_ecoac_user`
--
ALTER TABLE `labels_has_ecoac_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `m_criteria`
--
ALTER TABLE `m_criteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `m_criteria_label`
--
ALTER TABLE `m_criteria_label`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `m_crit_indic`
--
ALTER TABLE `m_crit_indic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `m_indicator`
--
ALTER TABLE `m_indicator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `m_lifecycle`
--
ALTER TABLE `m_lifecycle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `m_theme`
--
ALTER TABLE `m_theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `partnerbrandlink`
--
ALTER TABLE `partnerbrandlink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `partnerproductlink`
--
ALTER TABLE `partnerproductlink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `productindicator`
--
ALTER TABLE `productindicator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `productlinkhs`
--
ALTER TABLE `productlinkhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `productreview`
--
ALTER TABLE `productreview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `productscore`
--
ALTER TABLE `productscore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `productstats`
--
ALTER TABLE `productstats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `productsubratingjustif`
--
ALTER TABLE `productsubratingjustif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `productsubratings`
--
ALTER TABLE `productsubratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `productsubratingscomments`
--
ALTER TABLE `productsubratingscomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `products_old`
--
ALTER TABLE `products_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `subratings2`
--
ALTER TABLE `subratings2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tclickcategory`
--
ALTER TABLE `tclickcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tclicktable`
--
ALTER TABLE `tclicktable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `testimony`
--
ALTER TABLE `testimony`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `typescore`
--
ALTER TABLE `typescore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `usersreviews`
--
ALTER TABLE `usersreviews`
  MODIFY `id_avis` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
