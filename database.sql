-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 13, 2021 at 09:32 AM
-- Server version: 10.1.48-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digispace`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `agendaID` int(11) NOT NULL,
  `customerID` varchar(255) NOT NULL,
  `agenda_name` varchar(255) NOT NULL,
  `speaker_name` varchar(200) NOT NULL,
  `speaker_name2` varchar(300) NOT NULL,
  `speaker_name3` varchar(200) NOT NULL,
  `speaker_name4` varchar(200) NOT NULL,
  `speaker_name5` varchar(500) NOT NULL,
  `speaker_name6` varchar(200) NOT NULL,
  `speaker_name7` varchar(200) NOT NULL,
  `speaker_name8` varchar(200) NOT NULL,
  `speaker_name9` varchar(400) NOT NULL,
  `schedule_date` varchar(255) NOT NULL,
  `schedule_date_color` varchar(255) NOT NULL,
  `schedule_start_time` varchar(255) NOT NULL,
  `schedule_end_time` varchar(255) NOT NULL,
  `time_schedule` varchar(255) NOT NULL,
  `link_title` varchar(255) NOT NULL,
  `link_url` varchar(255) NOT NULL,
  `link_color` varchar(255) NOT NULL,
  `agenda_category` varchar(255) NOT NULL,
  `agenda_category_2` varchar(255) NOT NULL,
  `agenda_category_3` varchar(255) NOT NULL,
  `type` enum('event','break') NOT NULL DEFAULT 'event',
  `createAT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`agendaID`, `customerID`, `agenda_name`, `speaker_name`, `speaker_name2`, `speaker_name3`, `speaker_name4`, `speaker_name5`, `speaker_name6`, `speaker_name7`, `speaker_name8`, `speaker_name9`, `schedule_date`, `schedule_date_color`, `schedule_start_time`, `schedule_end_time`, `time_schedule`, `link_title`, `link_url`, `link_color`, `agenda_category`, `agenda_category_2`, `agenda_category_3`, `type`, `createAT`) VALUES
(8, '', 'Workshop 3  - Design Thinking', '', '', '', '', '', '', '', '', '', '2021-05-31', '#EDB045', '02:10', '', '', 'go to meeting', '', '', '7', '', '', 'event', '2021-05-12 10:43:39'),
(6, '', 'Welcome Day 1 - Foundation for Trust ', '', '', '', '', '', '', '', '', '', '2021-03-17', '#06AED5', '12:45', '', '', 'go to meeting', '', '#ed1c24', '5', '', '', 'event', '2021-05-11 07:28:05'),
(7, '', 'OKR Refresh and Workshop Intro', '', '', '', '', '', '', '', '', '', '2021-03-18', '#06AED5', '09:50', '', '', '', '', '#ed1c24', '6', '', '', 'event', '2021-05-11 07:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `agenda_cat`
--

CREATE TABLE `agenda_cat` (
  `agenda_cat_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `agenda_cat_name` varchar(255) NOT NULL,
  `category_color_code` varchar(255) NOT NULL,
  `category_type` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agenda_cat`
--

INSERT INTO `agenda_cat` (`agenda_cat_id`, `customer_id`, `agenda_cat_name`, `category_color_code`, `category_type`, `sort`, `create_at`) VALUES
(5, 5, '17 March', '#2E59D9', '', 0, '2021-05-11 07:26:23'),
(6, 5, '18 March', '#DD1C1A', '', 0, '2021-05-11 07:26:38'),
(7, 5, 'May 31', '#EF421B', '', 0, '2021-05-12 10:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `index_page_settings`
--

CREATE TABLE `index_page_settings` (
  `index_page_settings_id` int(11) NOT NULL,
  `sign_in_form_heading` varchar(255) NOT NULL,
  `sign_up_form_heading` varchar(255) NOT NULL,
  `sign_in_button_text` varchar(255) NOT NULL,
  `sign_up_button_text` varchar(255) NOT NULL,
  `privacy_policy_text` longtext NOT NULL,
  `privacy_policy_text_appears` varchar(255) NOT NULL,
  `privacy_policy_checkbox_text` varchar(255) NOT NULL,
  `privacy_policy_checkbox_text_appears` varchar(255) NOT NULL,
  `sign_up_appears` varchar(255) NOT NULL,
  `index_page_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `index_page_settings`
--

INSERT INTO `index_page_settings` (`index_page_settings_id`, `sign_in_form_heading`, `sign_up_form_heading`, `sign_in_button_text`, `sign_up_button_text`, `privacy_policy_text`, `privacy_policy_text_appears`, `privacy_policy_checkbox_text`, `privacy_policy_checkbox_text_appears`, `sign_up_appears`, `index_page_image`) VALUES
(1, 'Sign In', 'Sign Up', 'Sign In', 'Sign Up', 'Vos données personnelles sont traitées pour vous permettre de vous connecter à la plateforme Dorier. Pour plus d’informations sur le traitement de vos données personnelles, <a href=\"\" target=”_blank”><strong>cliquez ici</strong></a>.', 'yes', 'J’ai pris connaissance de la politique de protection des données personnelles.', 'yes', 'yes', '/admin/uploads/image/1619985417Novartis DP Demo.png');

-- --------------------------------------------------------

--
-- Table structure for table `info_icon`
--

CREATE TABLE `info_icon` (
  `info_icon_ID` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `info_icon` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `info_icon`
--

INSERT INTO `info_icon` (`info_icon_ID`, `customer_id`, `info_icon`, `create_at`) VALUES
(1, 1, '1606209480icone_Info.png', '2020-07-22 11:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `lobby`
--

CREATE TABLE `lobby` (
  `lobbyID` int(11) NOT NULL,
  `customerID` varchar(255) NOT NULL,
  `help_desk` longtext NOT NULL,
  `our_website` varchar(255) NOT NULL,
  `our_website_appears` varchar(255) NOT NULL,
  `qa_link` varchar(255) NOT NULL,
  `qa_link_appears` varchar(255) NOT NULL,
  `video_in_fullscreen` varchar(255) NOT NULL,
  `german_webnar_video` varchar(255) NOT NULL,
  `pleanry_1_de_appears` varchar(255) NOT NULL,
  `french_webnar_video` varchar(255) NOT NULL,
  `pleanry_2_fr_appears` varchar(255) NOT NULL,
  `gp1_de_btn_text` varchar(255) NOT NULL,
  `breakout_1_de_appears` varchar(255) NOT NULL,
  `breakout1_join_video_conference` longtext NOT NULL,
  `gp1_fr_btn_text` varchar(255) NOT NULL,
  `breakout_1_fr_appears` varchar(255) NOT NULL,
  `gp1_fr` varchar(255) NOT NULL,
  `gp2_btn_text` varchar(255) NOT NULL,
  `breakout_2_appears` varchar(255) NOT NULL,
  `breakout2_join_video_conference` longtext NOT NULL,
  `respiratory_btn_text` varchar(255) NOT NULL,
  `breakout_3_appears` varchar(255) NOT NULL,
  `breakout3_join_video_conference` longtext NOT NULL,
  `cardio_metabolic_btn_text` varchar(255) NOT NULL,
  `breakout_4_appears` varchar(255) NOT NULL,
  `breakout4_join_video_conference` longtext NOT NULL,
  `ihd_cosentyx_pso_btn_text` varchar(255) NOT NULL,
  `breakout_5_appears` varchar(255) NOT NULL,
  `breakout5_join_video_conference` longtext NOT NULL,
  `ihd_cosentyx_spa_btn_text` varchar(255) NOT NULL,
  `breakout_6_appears` varchar(255) NOT NULL,
  `breakout6_join_video_conference` longtext NOT NULL,
  `ophtha_beovu_btn_text` varchar(255) NOT NULL,
  `breakout_7_appears` varchar(255) NOT NULL,
  `breakout7_join_video_conference` longtext NOT NULL,
  `ophtha_lucentis_btn_text` varchar(255) NOT NULL,
  `breakout_8_appears` varchar(255) NOT NULL,
  `breakout8_join_video_conference` longtext NOT NULL,
  `neuroscience_ms_btn_text` varchar(255) NOT NULL,
  `breakout_9_appears` varchar(255) NOT NULL,
  `breakout9_join_video_conference` longtext NOT NULL,
  `coffee_break_btn_text` varchar(255) NOT NULL,
  `coffee_break_appears` varchar(255) NOT NULL,
  `coffee_break_join_video_conference` longtext NOT NULL,
  `Download_Pdf` varchar(255) NOT NULL,
  `stream_video` longtext NOT NULL,
  `atelier_stream_video` varchar(255) NOT NULL,
  `help_link` longtext NOT NULL,
  `information_link` varchar(255) NOT NULL,
  `information_text` varchar(255) NOT NULL,
  `information_video` varchar(255) NOT NULL,
  `site_title` varchar(255) NOT NULL,
  `site_logo` varchar(255) NOT NULL,
  `createAT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `video_url` text NOT NULL,
  `help_desk_appears` varchar(255) NOT NULL,
  `stream_video_appears` varchar(255) NOT NULL,
  `atelier_stream_video_appears` varchar(255) NOT NULL,
  `resources_icon_appears` varchar(255) NOT NULL,
  `information_text_appears` varchar(255) NOT NULL,
  `footer_hyperlink_text` varchar(255) NOT NULL,
  `footer_hyperlink_text_appears` varchar(255) NOT NULL,
  `footer_hyperlink` varchar(255) NOT NULL,
  `help_desk_text` varchar(255) NOT NULL,
  `help_desk_icon` varchar(255) NOT NULL,
  `pleanry_text` varchar(255) NOT NULL,
  `pleanry_icon` varchar(255) NOT NULL,
  `atelier_text` varchar(255) NOT NULL,
  `atelier_icon` varchar(255) NOT NULL,
  `resources_text` varchar(255) NOT NULL,
  `resources_icon` varchar(255) NOT NULL,
  `background_img` varchar(255) NOT NULL,
  `information_icon` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lobby`
--

INSERT INTO `lobby` (`lobbyID`, `customerID`, `help_desk`, `our_website`, `our_website_appears`, `qa_link`, `qa_link_appears`, `video_in_fullscreen`, `german_webnar_video`, `pleanry_1_de_appears`, `french_webnar_video`, `pleanry_2_fr_appears`, `gp1_de_btn_text`, `breakout_1_de_appears`, `breakout1_join_video_conference`, `gp1_fr_btn_text`, `breakout_1_fr_appears`, `gp1_fr`, `gp2_btn_text`, `breakout_2_appears`, `breakout2_join_video_conference`, `respiratory_btn_text`, `breakout_3_appears`, `breakout3_join_video_conference`, `cardio_metabolic_btn_text`, `breakout_4_appears`, `breakout4_join_video_conference`, `ihd_cosentyx_pso_btn_text`, `breakout_5_appears`, `breakout5_join_video_conference`, `ihd_cosentyx_spa_btn_text`, `breakout_6_appears`, `breakout6_join_video_conference`, `ophtha_beovu_btn_text`, `breakout_7_appears`, `breakout7_join_video_conference`, `ophtha_lucentis_btn_text`, `breakout_8_appears`, `breakout8_join_video_conference`, `neuroscience_ms_btn_text`, `breakout_9_appears`, `breakout9_join_video_conference`, `coffee_break_btn_text`, `coffee_break_appears`, `coffee_break_join_video_conference`, `Download_Pdf`, `stream_video`, `atelier_stream_video`, `help_link`, `information_link`, `information_text`, `information_video`, `site_title`, `site_logo`, `createAT`, `video_url`, `help_desk_appears`, `stream_video_appears`, `atelier_stream_video_appears`, `resources_icon_appears`, `information_text_appears`, `footer_hyperlink_text`, `footer_hyperlink_text_appears`, `footer_hyperlink`, `help_desk_text`, `help_desk_icon`, `pleanry_text`, `pleanry_icon`, `atelier_text`, `atelier_icon`, `resources_text`, `resources_icon`, `background_img`, `information_icon`) VALUES
(1, '1', 'https://teams.microsoft.com/l/meetup-join/19%3ameeting_MzJhY2E5NmItOTExZS00NDcwLTkxY2YtZjczMjFmZGIzMjZi%40thread.v2/0?context=%7b%22Tid%22%3a%22ac144e41-8001-48f0-9e1c-170716ed06b6%22%2c%22Oid%22%3a%221dcde3dc-24b1-4a81-a173-e1dce23e93c1%22%7d', '', '', '', '', '1', '', '', '', '', 'Join the video conference', 'yes', 'https://teams.microsoft.com/l/meetup-join/19%3ameeting_NGJlNDFkMmEtMTFlZC00Y2EzLWJmYjQtMjc5MDc3ZGMyOTA5%40thread.v2/0?context=%7b%22Tid%22%3a%22ac144e41-8001-48f0-9e1c-170716ed06b6%22%2c%22Oid%22%3a%221dcde3dc-24b1-4a81-a173-e1dce23e93c1%22%7d', '', '', '', 'Join the video conference', 'yes', 'https://teams.microsoft.com/l/meetup-join/19%3ameeting_Nzc0NTFmYTgtZGIyMy00MmE4LTk3ZTItMGRmM2EzZjY5OWRi%40thread.v2/0?context=%7b%22Tid%22%3a%22ac144e41-8001-48f0-9e1c-170716ed06b6%22%2c%22Oid%22%3a%221dcde3dc-24b1-4a81-a173-e1dce23e93c1%22%7d', 'Join the video conference', '', 'https://teams.microsoft.com/l/meetup-join/19%3ameeting_ZmQ3YjdhODItN2Q2MC00ZWZhLTlmZTEtNjBlNzEyYmJjNTlk%40thread.v2/0?context=%7b%22Tid%22%3a%22ac144e41-8001-48f0-9e1c-170716ed06b6%22%2c%22Oid%22%3a%221dcde3dc-24b1-4a81-a173-e1dce23e93c1%22%7d', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Join the video conference', '', 'https://teams.microsoft.com/l/meetup-join/19%3ameeting_MTIxMGU4NzEtOTY2ZC00MzZhLThmZmUtZjFiM2M3NDU2YjNl%40thread.v2/0?context=%7b%22Tid%22%3a%22ac144e41-8001-48f0-9e1c-170716ed06b6%22%2c%22Oid%22%3a%225a7f4b43-6e6e-4e86-bd0b-44d01cd9142e%22%7d', '', 'https://teams.microsoft.com/l/meetup-join/19%3ameeting_MTc0YTVmZDktYzdjOC00OGY1LWEyN2ItZmJkYjQyZjQzMmUy%40thread.v2/0?context=%7b%22Tid%22%3a%22ac144e41-8001-48f0-9e1c-170716ed06b6%22%2c%22Oid%22%3a%221dcde3dc-24b1-4a81-a173-e1dce23e93c1%22%7d', 'https://vimeo.com/event/', 'https://teams.microsoft.com/l/meetup-join/19%3ameeting_ZWNiOTc1NTMtYWI1NS00MWU4LWE0N2QtNTE4ODRjOTI1NzE1%40thread.v2/0?context=%7b%22Tid%22%3a%22ac144e41-8001-48f0-9e1c-170716ed06b6%22%2c%22Oid%22%3a%225a7f4b43-6e6e-4e86-bd0b-44d01cd9142e%22%7d', 'assets/Teaser TGA - validé.mp4', 'best', '/admin/uploads/video/1611228915Slideshow_image_2.jpg', 'Dorier Digiplace', 'admin/uploads/site_logo/162081015216083695001608336908logo-01.png', '2020-06-21 19:05:30', 'https://player.vimeo.com/video/492412849', 'yes', 'yes', 'yes', 'yes', 'yes', '#Privacy Policy', 'yes', 'https://dorier-digiplace.com/', '', 'admin/uploads/image/1620809430icone_chatbot.png', 'Go to Pleniere', 'admin/uploads/image/1620311739workshop-20.png', 'Aller à l Atelier', 'admin/uploads/image/1620284334workshop-20.png', 'Aller à la Bibliothèque', 'admin/uploads/image/1620284358workshop-20.png', 'admin/uploads/image/1620809972Lobby.jpg', 'admin/uploads/image/1620284378workshop-20.png');

-- --------------------------------------------------------

--
-- Table structure for table `loginout`
--

CREATE TABLE `loginout` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loginout`
--

INSERT INTO `loginout` (`id`, `user_id`, `username`, `login`, `logout`) VALUES
(1, 1, 'admin@digispace.site', '2021-03-06 19:42:51', '0000-00-00 00:00:00'),
(2, 1, 'admin@digispace.site', '2021-03-06 20:33:41', '0000-00-00 00:00:00'),
(3, 1, 'admin@digispace.site', '2021-03-10 17:59:11', '0000-00-00 00:00:00'),
(4, 0, '', '2021-03-11 09:42:26', '0000-00-00 00:00:00'),
(5, 0, '', '2021-03-11 09:42:27', '0000-00-00 00:00:00'),
(6, 1, 'admin@digispace.site', '2021-03-11 10:22:14', '2021-03-11 10:59:08'),
(7, 1, 'admin@digispace.site', '2021-03-11 10:30:00', '0000-00-00 00:00:00'),
(8, 1, 'admin@digispace.site', '2021-03-11 10:48:57', '0000-00-00 00:00:00'),
(9, 1, 'admin@digispace.site', '2021-03-11 10:50:59', '0000-00-00 00:00:00'),
(10, 1, 'admin@digispace.site', '2021-03-11 10:59:13', '0000-00-00 00:00:00'),
(11, 1, 'admin@digispace.site', '2021-03-11 11:34:59', '0000-00-00 00:00:00'),
(12, 0, '', '2021-03-16 22:00:16', '0000-00-00 00:00:00'),
(13, 0, '', '2021-03-16 22:00:16', '0000-00-00 00:00:00'),
(14, 5, 'test@test.com', '2021-04-23 11:15:59', '0000-00-00 00:00:00'),
(15, 5, 'test@test.com', '2021-04-23 12:17:25', '0000-00-00 00:00:00'),
(16, 5, 'test@test.com', '2021-04-23 13:21:43', '0000-00-00 00:00:00'),
(17, 5, 'test@test.com', '2021-04-24 05:30:03', '0000-00-00 00:00:00'),
(18, 5, 'test@test.com', '2021-04-26 05:04:11', '2021-04-26 05:46:42'),
(19, 5, 'test@test.com', '2021-04-26 06:52:45', '2021-04-26 06:52:56'),
(20, 0, '', '2021-04-26 06:53:04', '0000-00-00 00:00:00'),
(21, 5, 'test@test.com', '2021-04-26 06:54:16', '2021-04-26 06:54:26'),
(22, 5, 'test@test.com', '2021-04-26 06:56:08', '0000-00-00 00:00:00'),
(23, 5, 'test@test.com', '2021-04-26 06:57:14', '0000-00-00 00:00:00'),
(24, 5, 'test@test.com', '2021-04-26 08:47:33', '0000-00-00 00:00:00'),
(25, 5, 'test@test.com', '2021-04-26 08:48:31', '0000-00-00 00:00:00'),
(26, 5, 'test@test.com', '2021-04-26 09:37:17', '0000-00-00 00:00:00'),
(27, 5, 'test@test.com', '2021-04-26 10:12:40', '0000-00-00 00:00:00'),
(28, 5, 'test@test.com', '2021-04-26 10:15:00', '0000-00-00 00:00:00'),
(29, 5, 'test@test.com', '2021-04-26 10:15:59', '0000-00-00 00:00:00'),
(30, 5, 'test@test.com', '2021-04-26 10:18:05', '0000-00-00 00:00:00'),
(31, 5, 'test@test.com', '2021-04-26 10:53:54', '0000-00-00 00:00:00'),
(32, 0, '', '2021-04-27 06:31:36', '0000-00-00 00:00:00'),
(33, 5, 'test@test.com', '2021-04-27 06:31:50', '0000-00-00 00:00:00'),
(34, 5, 'test@test.com', '2021-04-28 05:26:23', '0000-00-00 00:00:00'),
(35, 5, 'test@test.com', '2021-04-28 05:38:48', '0000-00-00 00:00:00'),
(36, 5, 'test@test.com', '2021-04-28 05:44:44', '2021-04-28 05:46:16'),
(37, 5, 'test@test.com', '2021-04-28 06:09:24', '0000-00-00 00:00:00'),
(38, 5, 'test@test.com', '2021-04-28 08:44:54', '0000-00-00 00:00:00'),
(39, 0, '', '2021-04-29 05:58:16', '0000-00-00 00:00:00'),
(40, 5, 'test@test.com', '2021-04-29 05:58:22', '0000-00-00 00:00:00'),
(41, 5, 'test@test.com', '2021-04-29 10:56:06', '0000-00-00 00:00:00'),
(42, 5, 'test@test.com', '2021-04-29 14:46:16', '0000-00-00 00:00:00'),
(43, 5, 'test@test.com', '2021-05-01 08:56:50', '0000-00-00 00:00:00'),
(44, 5, 'test@test.com', '2021-05-02 16:56:56', '0000-00-00 00:00:00'),
(45, 0, '', '2021-05-02 16:58:16', '0000-00-00 00:00:00'),
(46, 5, 'test@test.com', '2021-05-02 16:58:24', '0000-00-00 00:00:00'),
(47, 5, 'test@test.com', '2021-05-02 18:01:16', '0000-00-00 00:00:00'),
(48, 5, 'test@test.com', '2021-05-02 18:02:12', '0000-00-00 00:00:00'),
(49, 5, 'test@test.com', '2021-05-02 19:27:46', '2021-05-02 19:43:23'),
(50, 5, 'test@test.com', '2021-05-02 19:43:32', '2021-05-02 19:53:20'),
(51, 5, 'test@test.com', '2021-05-02 19:53:43', '2021-05-02 19:54:28'),
(52, 5, 'test@test.com', '2021-05-02 19:56:18', '2021-05-02 19:57:36'),
(53, 5, 'test@test.com', '2021-05-02 20:07:21', '2021-05-02 20:17:44'),
(54, 5, 'test@test.com', '2021-05-02 20:17:55', '2021-05-02 20:28:22'),
(55, 5, 'test@test.com', '2021-05-02 20:28:32', '2021-05-02 20:43:59'),
(56, 5, 'test@test.com', '2021-05-02 20:40:05', '2021-05-02 20:40:30'),
(57, 5, 'test@test.com', '2021-05-02 20:40:35', '0000-00-00 00:00:00'),
(58, 5, 'test@test.com', '2021-05-02 20:44:12', '2021-05-02 21:02:25'),
(59, 5, 'test@test.com', '2021-05-02 20:45:45', '0000-00-00 00:00:00'),
(60, 5, 'test@test.com', '2021-05-02 21:03:17', '2021-05-02 21:19:57'),
(61, 5, 'test@test.com', '2021-05-02 21:23:03', '0000-00-00 00:00:00'),
(62, 7, 'test@dorier-digiplace.com', '2021-05-02 21:32:07', '0000-00-00 00:00:00'),
(63, 5, 'test@test.com', '2021-05-03 06:12:15', '0000-00-00 00:00:00'),
(64, 5, 'test@test.com', '2021-05-03 07:29:15', '2021-05-03 07:36:46'),
(65, 5, 'test@test.com', '2021-05-03 07:36:53', '0000-00-00 00:00:00'),
(66, 5, 'test@test.com', '2021-05-03 09:26:21', '0000-00-00 00:00:00'),
(67, 5, 'test@test.com', '2021-05-03 14:17:49', '2021-05-03 14:26:15'),
(68, 5, 'test@test.com', '2021-05-03 14:26:22', '2021-05-03 14:28:28'),
(69, 5, 'test@test.com', '2021-05-03 14:28:43', '2021-05-03 14:33:08'),
(70, 5, 'test@test.com', '2021-05-03 14:33:15', '2021-05-03 14:34:18'),
(71, 5, 'test@test.com', '2021-05-03 14:34:26', '2021-05-03 14:36:21'),
(72, 5, 'test@test.com', '2021-05-03 14:36:31', '2021-05-03 14:38:38'),
(73, 5, 'test@test.com', '2021-05-03 14:38:45', '2021-05-03 14:39:53'),
(74, 5, 'test@test.com', '2021-05-03 14:40:07', '2021-05-03 14:43:54'),
(75, 5, 'test@test.com', '2021-05-03 14:45:50', '0000-00-00 00:00:00'),
(76, 5, 'test@test.com', '2021-05-03 19:08:26', '0000-00-00 00:00:00'),
(77, 5, 'test@test.com', '2021-05-04 04:03:31', '0000-00-00 00:00:00'),
(78, 5, 'test@test.com', '2021-05-04 05:15:31', '2021-05-04 05:21:44'),
(79, 5, 'test@test.com', '2021-05-05 06:08:26', '0000-00-00 00:00:00'),
(80, 5, 'test@test.com', '2021-05-05 06:30:58', '2021-05-05 06:38:09'),
(81, 5, 'test@test.com', '2021-05-05 06:38:13', '0000-00-00 00:00:00'),
(82, 5, 'test@test.com', '2021-05-05 06:41:00', '0000-00-00 00:00:00'),
(83, 5, 'test@test.com', '2021-05-06 06:56:16', '0000-00-00 00:00:00'),
(84, 5, 'test@test.com', '2021-05-06 12:38:39', '0000-00-00 00:00:00'),
(85, 5, 'test@test.com', '2021-05-06 14:09:11', '0000-00-00 00:00:00'),
(86, 5, 'test@test.com', '2021-05-06 14:35:32', '0000-00-00 00:00:00'),
(87, 5, 'test@test.com', '2021-05-06 18:31:15', '2021-05-06 19:12:11'),
(88, 5, 'test@test.com', '2021-05-06 20:34:07', '0000-00-00 00:00:00'),
(89, 5, 'test@test.com', '2021-05-06 20:39:38', '0000-00-00 00:00:00'),
(90, 5, 'test@test.com', '2021-05-07 05:53:48', '2021-05-07 05:53:54'),
(91, 5, 'test@test.com', '2021-05-07 05:57:11', '0000-00-00 00:00:00'),
(92, 5, 'test@test.com', '2021-05-07 08:50:52', '0000-00-00 00:00:00'),
(93, 5, 'test@test.com', '2021-05-07 09:03:07', '2021-05-07 09:45:34'),
(94, 5, 'test@test.com', '2021-05-07 09:44:47', '0000-00-00 00:00:00'),
(95, 5, 'test@test.com', '2021-05-07 09:47:21', '0000-00-00 00:00:00'),
(96, 5, 'test@test.com', '2021-05-07 10:25:15', '0000-00-00 00:00:00'),
(97, 0, '', '2021-05-11 07:14:58', '0000-00-00 00:00:00'),
(98, 5, 'test@test.com', '2021-05-11 07:15:03', '2021-05-11 07:31:33'),
(99, 5, 'test@test.com', '2021-05-11 07:32:08', '0000-00-00 00:00:00'),
(100, 5, 'test@test.com', '2021-05-11 07:32:13', '0000-00-00 00:00:00'),
(101, 5, 'test@test.com', '2021-05-12 05:41:12', '0000-00-00 00:00:00'),
(102, 5, 'test@test.com', '2021-05-12 08:35:06', '0000-00-00 00:00:00'),
(103, 5, 'test@test.com', '2021-05-12 12:15:22', '0000-00-00 00:00:00'),
(104, 5, 'test@test.com', '2021-05-12 12:15:48', '0000-00-00 00:00:00'),
(105, 5, 'test@test.com', '2021-05-13 08:06:25', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `meetingId` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `meeting_name` varchar(255) NOT NULL,
  `meeting_picture` varchar(255) NOT NULL,
  `watch_link` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `datetime` datetime NOT NULL,
  `time` time NOT NULL,
  `updated_date` date NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `updated_time` time NOT NULL,
  `del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qalinks`
--

CREATE TABLE `qalinks` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `qa_link` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `datetime` datetime NOT NULL,
  `del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qalinks`
--

INSERT INTO `qalinks` (`id`, `customer_id`, `qa_link`, `date`, `time`, `datetime`, `del`) VALUES
(1, 1, 'https://dorier-group.webex.com/dorier-group/j.php?MTID=m14e0154d14c1ec188d0c18b67926e983', '2020-07-09', '16:14:48', '2020-07-09 16:14:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE `resource` (
  `resourceId` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `resource_name` varchar(255) NOT NULL,
  `resource_picture` varchar(255) NOT NULL,
  `resource_pdf` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `datetime` datetime NOT NULL,
  `time` time NOT NULL,
  `updated_date` date NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `updated_time` time NOT NULL,
  `del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rg_menu_setting`
--

CREATE TABLE `rg_menu_setting` (
  `ID` int(11) NOT NULL,
  `rg_menu_1_appears` varchar(255) NOT NULL,
  `rg_menu_2_appears` varchar(255) NOT NULL,
  `rg_menu_3_appears` varchar(255) NOT NULL,
  `rg_menu_4_appears` varchar(255) NOT NULL,
  `rg_menu_5_appears` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rg_menu_setting`
--

INSERT INTO `rg_menu_setting` (`ID`, `rg_menu_1_appears`, `rg_menu_2_appears`, `rg_menu_3_appears`, `rg_menu_4_appears`, `rg_menu_5_appears`) VALUES
(1, 'yes', 'yes', 'yes', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `ID` int(11) NOT NULL,
  `customerID` varchar(255) NOT NULL,
  `pleniere_de_btn_text` varchar(255) NOT NULL,
  `pleniere_de_iframe_full_width` varchar(255) NOT NULL,
  `pleniere_fr_btn_text` varchar(255) NOT NULL,
  `pleniere_fr_iframe_full_width` varchar(255) NOT NULL,
  `plan_menu_text` varchar(255) NOT NULL,
  `program_menu_text` varchar(255) NOT NULL,
  `speaker_menu_text` varchar(255) NOT NULL,
  `resource_menu_text` varchar(255) NOT NULL,
  `meeting_reply_menu_text` varchar(255) NOT NULL,
  `plan_menu` varchar(255) NOT NULL,
  `program_menu` varchar(255) NOT NULL,
  `speaker_menu` varchar(255) NOT NULL,
  `resource_menu` varchar(255) NOT NULL,
  `meeting_reply_menu` varchar(255) NOT NULL,
  `plan_menu_mobile_appears` varchar(255) NOT NULL,
  `program_menu_mobile_appears` varchar(255) NOT NULL,
  `speaker_menu_mobile_appears` varchar(255) NOT NULL,
  `resource_menu_mobile_appears` varchar(255) NOT NULL,
  `meeting_reply_menu_mobile_appears` varchar(255) NOT NULL,
  `cr_gp1_btn_text` varchar(255) NOT NULL,
  `breakout_1_appears` varchar(255) NOT NULL,
  `cr_gp2_btn_text` varchar(255) NOT NULL,
  `breakout_2_appears` varchar(255) NOT NULL,
  `cr_respiratory_btn_text` varchar(255) NOT NULL,
  `breakout_3_appears` varchar(255) NOT NULL,
  `cr_cardio_metabolic_btn_text` varchar(255) NOT NULL,
  `breakout_4_appears` varchar(255) NOT NULL,
  `cr_ihd_cosentyx_pso_btn_text` varchar(255) NOT NULL,
  `breakout_5_appears` varchar(255) NOT NULL,
  `cr_ihd_consentyx_spa_btn_text` varchar(255) NOT NULL,
  `breakout_6_appears` varchar(255) NOT NULL,
  `cr_optha_beovu_btn_text` varchar(25) NOT NULL,
  `breakout_7_appears` varchar(255) NOT NULL,
  `cr_optha_lucentis_btn_text` varchar(255) NOT NULL,
  `breakout_8_appears` varchar(255) NOT NULL,
  `cr_neuroscience_ms_btn_text` varchar(255) NOT NULL,
  `breakout_9_appears` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`ID`, `customerID`, `pleniere_de_btn_text`, `pleniere_de_iframe_full_width`, `pleniere_fr_btn_text`, `pleniere_fr_iframe_full_width`, `plan_menu_text`, `program_menu_text`, `speaker_menu_text`, `resource_menu_text`, `meeting_reply_menu_text`, `plan_menu`, `program_menu`, `speaker_menu`, `resource_menu`, `meeting_reply_menu`, `plan_menu_mobile_appears`, `program_menu_mobile_appears`, `speaker_menu_mobile_appears`, `resource_menu_mobile_appears`, `meeting_reply_menu_mobile_appears`, `cr_gp1_btn_text`, `breakout_1_appears`, `cr_gp2_btn_text`, `breakout_2_appears`, `cr_respiratory_btn_text`, `breakout_3_appears`, `cr_cardio_metabolic_btn_text`, `breakout_4_appears`, `cr_ihd_cosentyx_pso_btn_text`, `breakout_5_appears`, `cr_ihd_consentyx_spa_btn_text`, `breakout_6_appears`, `cr_optha_beovu_btn_text`, `breakout_7_appears`, `cr_optha_lucentis_btn_text`, `breakout_8_appears`, `cr_neuroscience_ms_btn_text`, `breakout_9_appears`) VALUES
(1, '1', 'Join The German Webinar', '', 'Join The French Webinar', '', 'VIEW THE MAP', 'VIEW THE PROGRAM', 'SPEAKERS', 'RESOURCES', 'Replay', 'yes', 'yes', 'yes', 'yes', 'yes', '', '', '', '', '', 'Go to breakout 1 ', 'yes', 'Go to breakout 2', 'yes', 'Go to breakout 3', 'yes', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `speakers`
--

CREATE TABLE `speakers` (
  `SpeakerId` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `speaker_name` varchar(255) NOT NULL,
  `speaker_name2` varchar(100) NOT NULL,
  `speaker_name3` varchar(100) NOT NULL,
  `speaker_name4` varchar(100) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `linkdin` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `datetime` datetime NOT NULL,
  `time` time NOT NULL,
  `updated_date` date NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `updated_time` time NOT NULL,
  `speakers_order` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `speakers`
--

INSERT INTO `speakers` (`SpeakerId`, `customer_id`, `speaker_name`, `speaker_name2`, `speaker_name3`, `speaker_name4`, `designation`, `linkdin`, `email`, `profile`, `date`, `datetime`, `time`, `updated_date`, `updated_datetime`, `updated_time`, `speakers_order`, `description`, `del`) VALUES
(1, 5, 'Photo Manuela Buxo', '', '', '', 'Doctor', '-', '-', '1619420842irene-rojnik.1024x1024.jpg', '2021-02-26', '2021-02-26 10:17:59', '10:17:59', '2021-04-26', '2021-04-26 07:07:22', '07:07:22', '-', '', 1),
(2, 5, 'Anita Simonds', '', '', '', 'President of Novartis Oncology', '-', '-', '1619426927kristina-knezevic.256x256.jpg', '2021-02-26', '2021-02-26 10:18:33', '10:18:33', '2021-04-26', '2021-04-26 08:48:47', '08:48:47', '-', '', 1),
(3, 5, 'Chris Brightling', '', '', '', '-', '-', '-', '1619426943barbara-huber.1024x1024.jpg', '2021-02-26', '2021-02-26 10:18:53', '10:18:53', '2021-04-26', '2021-04-26 08:49:03', '08:49:03', '-', '', 1),
(4, 5, 'Menelas Pangalos', '', '', '', '-', '-', '-', '1619426958susanne-formanek.1024x1024.jpg', '2021-02-26', '2021-02-26 10:19:06', '10:19:06', '2021-04-26', '2021-04-26 08:49:18', '08:49:18', '-', '', 1),
(5, 5, 'Prof. Dr. Karl Dula ', '', '', '', 'Klinik für Oral Health & Medicine, Universitäres Zentrum für Zahnmedizin Basel UZB ', '-', 'invisible23@gmx.de', '1620022346Photo Manuela Buxo.jpg', '2021-04-26', '2021-04-26 10:14:03', '10:14:03', '2021-05-03', '2021-05-03 06:12:26', '06:12:26', '1', '                      ', 1),
(6, 5, 'Dr. Sandro Leoncini ', '', '', '', 'Station für Zahnärztliche Radiologie und Stomatologie, Zahnmedizinische Kliniken der Universität Bern', '-', 'invisible23@gmx.de', '1619432068Leoncini.PNG', '2021-04-26', '2021-04-26 10:14:28', '10:14:28', '0000-00-00', '0000-00-00 00:00:00', '00:00:00', '2', '', 1),
(7, 5, 'Sanjay Duddupudi', '', '', '', 'Full Stack Developer', '-', '-', '1620027024Sanjay D.jfif', '2021-05-03', '2021-05-03 07:30:24', '07:30:24', '0000-00-00', '0000-00-00 00:00:00', '00:00:00', '3', '-', 1),
(8, 5, 'Martin Pfatschbacher', '', '', '', 'Production Manager', '-', '-', '1620027157Martin P.jfif', '2021-05-03', '2021-05-03 07:32:37', '07:32:37', '0000-00-00', '0000-00-00 00:00:00', '00:00:00', '2', '-', 1),
(9, 5, 'David Granite', '', '', '', 'Creative Technologist', '-', '-', '1620027224David G.jfif', '2021-05-03', '2021-05-03 07:33:44', '07:33:44', '0000-00-00', '0000-00-00 00:00:00', '00:00:00', '2', '-', 1),
(10, 5, 'Mickael Decoppet', '', '', '', 'Digital designer', '-', '-', '1620027298Micka.jfif', '2021-05-03', '2021-05-03 07:34:58', '07:34:58', '0000-00-00', '0000-00-00 00:00:00', '00:00:00', '4', '-', 1),
(11, 5, 'Simon Tomei', '', '', '', 'Event Manager', '-', '-', '1620027375Simon T.jfif', '2021-05-03', '2021-05-03 07:36:15', '07:36:15', '0000-00-00', '0000-00-00 00:00:00', '00:00:00', '5', '-', 1),
(12, 5, 'Sébastien Chausset', '', '', '', 'Production Director at Dorier Group', '-', '-', '1620052070Seb C.jfif', '2021-05-03', '2021-05-03 14:27:50', '14:27:50', '2021-05-06', '2021-05-06 07:08:15', '07:08:15', '1', 'terterter', 1);

-- --------------------------------------------------------

--
-- Table structure for table `strem_urls`
--

CREATE TABLE `strem_urls` (
  `url_id` int(11) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `urls` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `strem_urls`
--

INSERT INTO `strem_urls` (`url_id`, `user_type`, `urls`) VALUES
(1, 'Salle 01', 'https://zoom.us/j/97898834596'),
(2, 'Salle 02', 'https://zoom.us/j/98470680342'),
(3, 'Salle 03', 'https://zoom.us/j/97066690280'),
(4, 'Salle 04', 'https://zoom.us/j/99408063879'),
(5, 'Salle 05', 'https://zoom.us/j/99065773017'),
(6, 'Salle 06', 'https://zoom.us/j/94238736393'),
(7, 'Salle 07', 'https://zoom.us/j/92481332395'),
(8, 'Salle 08', 'https://zoom.us/j/92621793345'),
(9, 'Salle 09', 'https://zoom.us/j/92933291945'),
(10, 'Salle 10', 'https://zoom.us/j/95231162533 		'),
(11, 'Salle 11', 'https://zoom.us/j/94448151905');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `userType` varchar(255) NOT NULL,
  `createAT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verifyStatus` int(11) NOT NULL COMMENT '0=not,1=yes',
  `del` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `type`, `name`, `surname`, `title`, `userName`, `Password`, `userType`, `createAT`, `verifyStatus`, `del`) VALUES
(1, '', '', '', '', 'admin@digispace.site', '306eedb994a65923835ef137cc8b23a6', 'customer', '2021-02-04 17:53:21', 0, 0),
(2, '', '', '', '', 'sanjay@dorier-group.com', '8380d64cd0728f9c5818e02757b1ff62', 'customer', '2021-02-04 18:07:37', 0, 0),
(3, '', '', '', '', 'dorier@digispace.site', 'a3517c277d41d3d073270be3b67430db', 'subscriber', '2021-02-05 10:17:44', 0, 0),
(4, '', '', '', '', 'superadmin@gmail.com', '0e7517141fb53f21ee439b355b5a1d0a', 'customer', '2021-02-08 09:24:17', 0, 0),
(5, '', '', '', '', 'test@test.com', '098f6bcd4621d373cade4e832627b4f6', 'customer', '2021-02-24 10:07:44', 0, 0),
(6, '', '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', 'subscriber', '2021-05-02 18:00:11', 0, 0),
(7, '', '', '', '', 'test@dorier-digiplace.com', '098f6bcd4621d373cade4e832627b4f6', 'subscriber', '2021-05-02 21:31:48', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `userID` varchar(80) NOT NULL,
  `token` varchar(80) NOT NULL,
  `timemodified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`agendaID`);

--
-- Indexes for table `agenda_cat`
--
ALTER TABLE `agenda_cat`
  ADD PRIMARY KEY (`agenda_cat_id`);

--
-- Indexes for table `index_page_settings`
--
ALTER TABLE `index_page_settings`
  ADD PRIMARY KEY (`index_page_settings_id`);

--
-- Indexes for table `info_icon`
--
ALTER TABLE `info_icon`
  ADD PRIMARY KEY (`info_icon_ID`);

--
-- Indexes for table `lobby`
--
ALTER TABLE `lobby`
  ADD PRIMARY KEY (`lobbyID`);

--
-- Indexes for table `loginout`
--
ALTER TABLE `loginout`
  ADD PRIMARY KEY (`id`) KEY_BLOCK_SIZE=100;

--
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`meetingId`);

--
-- Indexes for table `qalinks`
--
ALTER TABLE `qalinks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`resourceId`);

--
-- Indexes for table `rg_menu_setting`
--
ALTER TABLE `rg_menu_setting`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `speakers`
--
ALTER TABLE `speakers`
  ADD PRIMARY KEY (`SpeakerId`);

--
-- Indexes for table `strem_urls`
--
ALTER TABLE `strem_urls`
  ADD PRIMARY KEY (`url_id`) KEY_BLOCK_SIZE=100;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `agendaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `agenda_cat`
--
ALTER TABLE `agenda_cat`
  MODIFY `agenda_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `index_page_settings`
--
ALTER TABLE `index_page_settings`
  MODIFY `index_page_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `info_icon`
--
ALTER TABLE `info_icon`
  MODIFY `info_icon_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lobby`
--
ALTER TABLE `lobby`
  MODIFY `lobbyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loginout`
--
ALTER TABLE `loginout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `meetingId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qalinks`
--
ALTER TABLE `qalinks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `resourceId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rg_menu_setting`
--
ALTER TABLE `rg_menu_setting`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `speakers`
--
ALTER TABLE `speakers`
  MODIFY `SpeakerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `strem_urls`
--
ALTER TABLE `strem_urls`
  MODIFY `url_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
