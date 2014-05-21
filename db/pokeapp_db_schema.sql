-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 21, 2014 at 02:13 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pokeapp`
--
CREATE DATABASE IF NOT EXISTS `pokeapp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pokeapp`;

-- --------------------------------------------------------

--
-- Table structure for table `abilities`
--

CREATE TABLE IF NOT EXISTS `abilities` (
  `id` int(11) NOT NULL,
  `identifier` varchar(20) NOT NULL,
  `gen` int(11) NOT NULL,
  `is_main_series` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gen` (`gen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ability_names`
--

CREATE TABLE IF NOT EXISTS `ability_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ability_id` int(11) NOT NULL,
  `local_language_id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1132 ;

-- --------------------------------------------------------

--
-- Table structure for table `egg_groups`
--

CREATE TABLE IF NOT EXISTS `egg_groups` (
  `id` int(11) NOT NULL,
  `identifier` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `evolution_chains`
--

CREATE TABLE IF NOT EXISTS `evolution_chains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baby_trigger_item_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `baby_trigger_item_id` (`baby_trigger_item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=372 ;

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE IF NOT EXISTS `experience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `growth_rate_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `experience` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `growth_rate_id` (`growth_rate_id`),
  KEY `growth_rate_id_2` (`growth_rate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=601 ;

-- --------------------------------------------------------

--
-- Table structure for table `experience_curve`
--

CREATE TABLE IF NOT EXISTS `experience_curve` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `generations`
--

CREATE TABLE IF NOT EXISTS `generations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_region_id` int(11) NOT NULL,
  `identifier` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `main_region_id` (`main_region_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(25) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=750 ;

-- --------------------------------------------------------

--
-- Table structure for table `items_pockets`
--

CREATE TABLE IF NOT EXISTS `items_pockets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE IF NOT EXISTS `item_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pocket_id` int(11) NOT NULL,
  `identifier` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pocket_id` (`pocket_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10002 ;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso639` varchar(3) NOT NULL,
  `iso3166` varchar(3) NOT NULL,
  `identifier` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `moves`
--

CREATE TABLE IF NOT EXISTS `moves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(30) NOT NULL,
  `generation_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `power` int(11) DEFAULT NULL,
  `pp` int(11) DEFAULT NULL,
  `accuracy` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `target_id` int(11) DEFAULT NULL,
  `damage_class_id` int(11) DEFAULT NULL,
  `effect_id` int(11) DEFAULT NULL,
  `effect_chance` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `generation_id` (`generation_id`),
  KEY `type_id` (`type_id`),
  KEY `target_id` (`target_id`),
  KEY `damage_class_id` (`damage_class_id`),
  KEY `effect_id` (`effect_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10019 ;

-- --------------------------------------------------------

--
-- Table structure for table `move_damage_classes`
--

CREATE TABLE IF NOT EXISTS `move_damage_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `move_effects`
--

CREATE TABLE IF NOT EXISTS `move_effects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10007 ;

-- --------------------------------------------------------

--
-- Table structure for table `move_targets`
--

CREATE TABLE IF NOT EXISTS `move_targets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `nature`
--

CREATE TABLE IF NOT EXISTS `nature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `decreased_stat_id` int(11) NOT NULL,
  `increased_stat_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `decreased_stat_id` (`decreased_stat_id`),
  KEY `increased_stat_id` (`increased_stat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `nature_names`
--

CREATE TABLE IF NOT EXISTS `nature_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nature_id` int(11) NOT NULL,
  `local_language_id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=151 ;

-- --------------------------------------------------------

--
-- Table structure for table `pokeball`
--

CREATE TABLE IF NOT EXISTS `pokeball` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `index_pokeball` int(11) NOT NULL,
  `name_pokeball` varchar(14) COLLATE utf8_spanish_ci NOT NULL,
  `name_es_pokeball` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `catch_rate_pokeball` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_pokeball` (`index_pokeball`),
  KEY `index_pokeball_2` (`index_pokeball`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `pokemon`
--

CREATE TABLE IF NOT EXISTS `pokemon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(14) CHARACTER SET utf8 NOT NULL,
  `species_id` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `base_experience` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `is_default` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `species_id` (`species_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10061 ;

-- --------------------------------------------------------

--
-- Table structure for table `pokemon_abilities`
--

CREATE TABLE IF NOT EXISTS `pokemon_abilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pokemon_id` int(11) NOT NULL,
  `ability_id` int(11) NOT NULL,
  `is_hidden` int(11) NOT NULL,
  `slot` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pokemon_id` (`pokemon_id`),
  KEY `ability_id` (`ability_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1829 ;

-- --------------------------------------------------------

--
-- Table structure for table `pokemon_color`
--

CREATE TABLE IF NOT EXISTS `pokemon_color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `pokemon_egg_groups`
--

CREATE TABLE IF NOT EXISTS `pokemon_egg_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `species_id` int(11) NOT NULL,
  `egg_group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=911 ;

-- --------------------------------------------------------

--
-- Table structure for table `pokemon_forms`
--

CREATE TABLE IF NOT EXISTS `pokemon_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(30) NOT NULL,
  `form_identifier` varchar(30) DEFAULT NULL,
  `pokemon_id` int(11) NOT NULL,
  `introduced_in_version_group_id` int(11) NOT NULL,
  `is_default` int(11) NOT NULL,
  `is_battle_only` int(11) NOT NULL,
  `is_mega` int(11) NOT NULL,
  `form_order` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pokemon_id` (`pokemon_id`),
  KEY `introduced_in_version_group_id` (`introduced_in_version_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10161 ;

-- --------------------------------------------------------

--
-- Table structure for table `pokemon_form_generations`
--

CREATE TABLE IF NOT EXISTS `pokemon_form_generations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pokemon_form_id` int(11) NOT NULL,
  `generation_id` int(11) NOT NULL,
  `game_index` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pokemon_form_id` (`pokemon_form_id`),
  KEY `generation_id` (`generation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pokemon_form_names`
--

CREATE TABLE IF NOT EXISTS `pokemon_form_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pokemon_form_id` int(11) NOT NULL,
  `local_language_id` int(11) NOT NULL,
  `form_name` varchar(50) NOT NULL,
  `pokemon_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pokemon_form_id` (`pokemon_form_id`),
  KEY `local_language_id` (`local_language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1758 ;

-- --------------------------------------------------------

--
-- Table structure for table `pokemon_habitats`
--

CREATE TABLE IF NOT EXISTS `pokemon_habitats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `pokemon_moves`
--

CREATE TABLE IF NOT EXISTS `pokemon_moves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pokemon_id` int(11) NOT NULL,
  `version_group_id` int(11) NOT NULL,
  `move_id` int(11) NOT NULL,
  `pokemon_move_method_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pokemon_id` (`pokemon_id`),
  KEY `version_group_id` (`version_group_id`),
  KEY `move_id` (`move_id`),
  KEY `pokemon_move_method_id` (`pokemon_move_method_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=311995 ;

-- --------------------------------------------------------

--
-- Table structure for table `pokemon_move_methods`
--

CREATE TABLE IF NOT EXISTS `pokemon_move_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `pokemon_shapes`
--

CREATE TABLE IF NOT EXISTS `pokemon_shapes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `pokemon_species`
--

CREATE TABLE IF NOT EXISTS `pokemon_species` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(15) CHARACTER SET utf8 NOT NULL,
  `generation_id` int(11) NOT NULL,
  `evolves_from_species_id` int(11) DEFAULT NULL,
  `evolution_chain_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `shape_id` int(11) NOT NULL,
  `habitat_id` int(11) DEFAULT NULL,
  `gender_rate` int(11) NOT NULL,
  `capture_rate` int(11) NOT NULL,
  `base_happiness` int(11) NOT NULL,
  `is_baby` int(11) NOT NULL,
  `hatch_counter` int(11) NOT NULL,
  `has_gender_differences` int(11) NOT NULL,
  `growth_rate_id` int(11) NOT NULL,
  `forms_switchable` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `generation_id` (`generation_id`),
  KEY `evolves_from_species_id` (`evolves_from_species_id`),
  KEY `evolution_chain_id` (`evolution_chain_id`),
  KEY `color_id` (`color_id`),
  KEY `shape_id` (`shape_id`),
  KEY `growth_rate_id` (`growth_rate_id`),
  KEY `habitat_id` (`habitat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=720 ;

-- --------------------------------------------------------

--
-- Table structure for table `pokemon_stats`
--

CREATE TABLE IF NOT EXISTS `pokemon_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pokemon_id` int(11) NOT NULL,
  `stat_id` int(11) NOT NULL,
  `base_stat` int(11) NOT NULL,
  `effort` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pokemon_id` (`pokemon_id`),
  KEY `stat_id` (`stat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4675 ;

-- --------------------------------------------------------

--
-- Table structure for table `pokemon_types`
--

CREATE TABLE IF NOT EXISTS `pokemon_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pokemon_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `slot` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pokemon_id` (`pokemon_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1171 ;

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE IF NOT EXISTS `stats` (
  `id` int(11) NOT NULL,
  `damage_class_id` int(11) DEFAULT NULL,
  `identifier` varchar(16) NOT NULL,
  `is_battle_only` int(11) NOT NULL,
  `game_index` int(11) NOT NULL,
  `short` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `damage_class_id` (`damage_class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL,
  `identifier` varchar(12) NOT NULL,
  `gen` int(11) NOT NULL,
  `damage_class` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gen` (`gen`),
  KEY `damage_class` (`damage_class`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `versions`
--

CREATE TABLE IF NOT EXISTS `versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version_group_id` int(11) NOT NULL,
  `identifier` varchar(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `version_group_id` (`version_group_id`),
  KEY `version_group_id_2` (`version_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Table structure for table `version_groups`
--

CREATE TABLE IF NOT EXISTS `version_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(30) NOT NULL,
  `generation_id` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `generation_id` (`generation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `abilities`
--
ALTER TABLE `abilities`
  ADD CONSTRAINT `abilities_ibfk_1` FOREIGN KEY (`gen`) REFERENCES `generations` (`id`);

--
-- Constraints for table `evolution_chains`
--
ALTER TABLE `evolution_chains`
  ADD CONSTRAINT `evolution_chains_ibfk_1` FOREIGN KEY (`baby_trigger_item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `experience_ibfk_1` FOREIGN KEY (`growth_rate_id`) REFERENCES `experience_curve` (`id`);

--
-- Constraints for table `generations`
--
ALTER TABLE `generations`
  ADD CONSTRAINT `generations_ibfk_1` FOREIGN KEY (`main_region_id`) REFERENCES `region` (`id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `item_categories` (`id`);

--
-- Constraints for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD CONSTRAINT `item_categories_ibfk_1` FOREIGN KEY (`pocket_id`) REFERENCES `items_pockets` (`id`);

--
-- Constraints for table `moves`
--
ALTER TABLE `moves`
  ADD CONSTRAINT `moves_ibfk_1` FOREIGN KEY (`generation_id`) REFERENCES `generations` (`id`),
  ADD CONSTRAINT `moves_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`),
  ADD CONSTRAINT `moves_ibfk_3` FOREIGN KEY (`target_id`) REFERENCES `move_targets` (`id`),
  ADD CONSTRAINT `moves_ibfk_4` FOREIGN KEY (`effect_id`) REFERENCES `move_effects` (`id`),
  ADD CONSTRAINT `moves_ibfk_5` FOREIGN KEY (`damage_class_id`) REFERENCES `move_damage_classes` (`id`);

--
-- Constraints for table `nature`
--
ALTER TABLE `nature`
  ADD CONSTRAINT `nature_ibfk_1` FOREIGN KEY (`decreased_stat_id`) REFERENCES `stats` (`id`),
  ADD CONSTRAINT `nature_ibfk_2` FOREIGN KEY (`increased_stat_id`) REFERENCES `stats` (`id`);

--
-- Constraints for table `pokeball`
--
ALTER TABLE `pokeball`
  ADD CONSTRAINT `pokeball_ibfk_1` FOREIGN KEY (`id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `pokeball_ibfk_2` FOREIGN KEY (`index_pokeball`) REFERENCES `items` (`id`);

--
-- Constraints for table `pokemon`
--
ALTER TABLE `pokemon`
  ADD CONSTRAINT `pokemon_ibfk_1` FOREIGN KEY (`species_id`) REFERENCES `pokemon_species` (`id`);

--
-- Constraints for table `pokemon_abilities`
--
ALTER TABLE `pokemon_abilities`
  ADD CONSTRAINT `pokemon_abilities_ibfk_2` FOREIGN KEY (`ability_id`) REFERENCES `abilities` (`id`),
  ADD CONSTRAINT `pokemon_abilities_ibfk_1` FOREIGN KEY (`pokemon_id`) REFERENCES `pokemon` (`id`);

--
-- Constraints for table `pokemon_forms`
--
ALTER TABLE `pokemon_forms`
  ADD CONSTRAINT `pokemon_forms_ibfk_1` FOREIGN KEY (`pokemon_id`) REFERENCES `pokemon` (`id`),
  ADD CONSTRAINT `pokemon_forms_ibfk_2` FOREIGN KEY (`introduced_in_version_group_id`) REFERENCES `version_groups` (`id`);

--
-- Constraints for table `pokemon_form_generations`
--
ALTER TABLE `pokemon_form_generations`
  ADD CONSTRAINT `pokemon_form_generations_ibfk_1` FOREIGN KEY (`pokemon_form_id`) REFERENCES `pokemon_forms` (`id`),
  ADD CONSTRAINT `pokemon_form_generations_ibfk_2` FOREIGN KEY (`generation_id`) REFERENCES `generations` (`id`);

--
-- Constraints for table `pokemon_form_names`
--
ALTER TABLE `pokemon_form_names`
  ADD CONSTRAINT `pokemon_form_names_ibfk_1` FOREIGN KEY (`pokemon_form_id`) REFERENCES `pokemon_forms` (`id`),
  ADD CONSTRAINT `pokemon_form_names_ibfk_2` FOREIGN KEY (`local_language_id`) REFERENCES `languages` (`id`);

--
-- Constraints for table `pokemon_moves`
--
ALTER TABLE `pokemon_moves`
  ADD CONSTRAINT `pokemon_moves_ibfk_4` FOREIGN KEY (`pokemon_move_method_id`) REFERENCES `pokemon_move_methods` (`id`),
  ADD CONSTRAINT `pokemon_moves_ibfk_1` FOREIGN KEY (`pokemon_id`) REFERENCES `pokemon` (`id`),
  ADD CONSTRAINT `pokemon_moves_ibfk_2` FOREIGN KEY (`version_group_id`) REFERENCES `version_groups` (`id`),
  ADD CONSTRAINT `pokemon_moves_ibfk_3` FOREIGN KEY (`move_id`) REFERENCES `moves` (`id`);

--
-- Constraints for table `pokemon_species`
--
ALTER TABLE `pokemon_species`
  ADD CONSTRAINT `pokemon_species_ibfk_1` FOREIGN KEY (`generation_id`) REFERENCES `generations` (`id`),
  ADD CONSTRAINT `pokemon_species_ibfk_3` FOREIGN KEY (`evolution_chain_id`) REFERENCES `evolution_chains` (`id`),
  ADD CONSTRAINT `pokemon_species_ibfk_4` FOREIGN KEY (`color_id`) REFERENCES `pokemon_color` (`id`),
  ADD CONSTRAINT `pokemon_species_ibfk_5` FOREIGN KEY (`shape_id`) REFERENCES `pokemon_shapes` (`id`),
  ADD CONSTRAINT `pokemon_species_ibfk_6` FOREIGN KEY (`habitat_id`) REFERENCES `pokemon_habitats` (`id`),
  ADD CONSTRAINT `pokemon_species_ibfk_7` FOREIGN KEY (`growth_rate_id`) REFERENCES `experience_curve` (`id`);

--
-- Constraints for table `pokemon_stats`
--
ALTER TABLE `pokemon_stats`
  ADD CONSTRAINT `pokemon_stats_ibfk_2` FOREIGN KEY (`stat_id`) REFERENCES `pokemon_stats` (`id`),
  ADD CONSTRAINT `pokemon_stats_ibfk_1` FOREIGN KEY (`pokemon_id`) REFERENCES `pokemon` (`id`);

--
-- Constraints for table `pokemon_types`
--
ALTER TABLE `pokemon_types`
  ADD CONSTRAINT `pokemon_types_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`),
  ADD CONSTRAINT `pokemon_types_ibfk_1` FOREIGN KEY (`pokemon_id`) REFERENCES `pokemon` (`id`);

--
-- Constraints for table `stats`
--
ALTER TABLE `stats`
  ADD CONSTRAINT `stats_ibfk_1` FOREIGN KEY (`damage_class_id`) REFERENCES `move_damage_classes` (`id`);

--
-- Constraints for table `types`
--
ALTER TABLE `types`
  ADD CONSTRAINT `types_ibfk_1` FOREIGN KEY (`gen`) REFERENCES `generations` (`id`),
  ADD CONSTRAINT `types_ibfk_2` FOREIGN KEY (`damage_class`) REFERENCES `move_damage_classes` (`id`);

--
-- Constraints for table `versions`
--
ALTER TABLE `versions`
  ADD CONSTRAINT `versions_ibfk_1` FOREIGN KEY (`version_group_id`) REFERENCES `version_groups` (`id`);

--
-- Constraints for table `version_groups`
--
ALTER TABLE `version_groups`
  ADD CONSTRAINT `version_groups_ibfk_1` FOREIGN KEY (`generation_id`) REFERENCES `generations` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
