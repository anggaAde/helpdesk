SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `freehelpdesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `site_calls`
--

CREATE TABLE `site_calls` (
  `call_id` int(11) NOT NULL AUTO_INCREMENT,
  `call_first_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `call_last_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `call_phone` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `call_email` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `call_department` int(11) NOT NULL DEFAULT '0',
  `call_request` int(11) NOT NULL DEFAULT '0',
  `call_device` int(11) NOT NULL DEFAULT '0',
  `call_details` text COLLATE latin1_general_ci NOT NULL,
  `call_date` int(11) NOT NULL DEFAULT '0',
  `call_date2` int(11) NOT NULL DEFAULT '0',
  `call_status` int(11) NOT NULL DEFAULT '0',
  `call_solution` text COLLATE latin1_general_ci NOT NULL,
  `call_user` int(11) NOT NULL DEFAULT '0',
  `call_staff` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`call_id`),
  KEY `call_department` (`call_department`),
  KEY `call_request` (`call_request`),
  KEY `call_device` (`call_device`),
  KEY `call_status` (`call_status`),
  KEY `call_user` (`call_user`),
  KEY `call_staff` (`call_staff`)
) DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_notes`
--

CREATE TABLE `site_notes` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `note_title` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `note_body` text COLLATE latin1_general_ci NOT NULL,
  `note_relation` int(11) NOT NULL DEFAULT '0',
  `note_type` int(1) NOT NULL DEFAULT '0',
  `note_post_date` int(11) NOT NULL DEFAULT '0',
  `note_post_ip` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `note_post_user` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`note_id`),
  KEY `note_relation` (`note_relation`),
  KEY `note_type` (`note_type`),
  KEY `note_post_user` (`note_post_user`)
) DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_options`
--

CREATE TABLE `site_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) DEFAULT NULL,
  `option_value` varchar(500) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `option_name` (`option_name`)
) DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_options`
--

INSERT INTO `site_options` (`id`, `option_name`, `option_value`, `timestamp`) VALUES
(1, 'encrypted_passwords', 'yes', '2014-03-16 18:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `site_types`
--

CREATE TABLE `site_types` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) NOT NULL DEFAULT '0',
  `type_name` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `type_email` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `type_location` text COLLATE latin1_general_ci NOT NULL,
  `type_phone` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`type_id`),
  KEY `type` (`type`)
) DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `site_types`
--

INSERT INTO `site_types` (`type_id`, `type`, `type_name`, `type_email`, `type_location`, `type_phone`) VALUES
(1, 1, 'Sales', '', '', ''),
(2, 1, 'Marketing', '', '', ''),
(3, 2, 'Urgent', '', '', ''),
(4, 2, 'Question', '', '', ''),
(5, 3, 'Monitor', '', '', ''),
(6, 3, 'Keyboard', '', '', ''),
(8, 2, 'Non-Urgent', '', '', ''),
(9, 3, 'Mouse', '', '', ''),
(10, 3, 'Network', '', '', ''),
(11, 3, 'Other', '', '', ''),
(12, 3, 'Computer Unit', '', '', ''),
(13, 3, 'Printer', '', '', ''),
(14, 3, 'Software', '', '', ''),
(15, 1, 'Accounting', '', '', ''),
(16, 1, 'Customer Service', '', '', ''),
(17, 1, 'Design', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `site_upload`
--

CREATE TABLE `site_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `call_id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_ext` varchar(4) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `call_id` (`call_id`)
) DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `site_users`
--

CREATE TABLE `site_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `user_password` varchar(225) COLLATE latin1_general_ci DEFAULT NULL,
  `user_name` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `user_address` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `user_city` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `user_state` char(3) COLLATE latin1_general_ci NOT NULL,
  `user_zip` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `user_country` char(3) COLLATE latin1_general_ci NOT NULL,
  `user_phone` varchar(39) COLLATE latin1_general_ci NOT NULL,
  `user_email` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `user_email2` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `user_im_aol` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `user_im_icq` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `user_im_msn` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `user_im_yahoo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `user_im_other` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `user_status` int(1) NOT NULL DEFAULT '0',
  `user_level` int(1) NOT NULL DEFAULT '0',
  `user_pending` int(11) NOT NULL DEFAULT '0',
  `user_date` int(11) NOT NULL DEFAULT '0',
  `last_login` int(11) NOT NULL DEFAULT '0',
  `last_ip` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `user_msg_send` int(1) NOT NULL DEFAULT '0',
  `user_msg_subject` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `user_protect_delete` int(1) DEFAULT '0',
  `user_protect_edit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  KEY `user_pending` (`user_pending`),
  KEY `user_level` (`user_level`),
  KEY `user_status` (`user_status`),
  KEY `user_protect_edit` (`user_protect_edit`),
  KEY `user_msg_send` (`user_msg_send`)
) DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

--
-- Dumping data for table `site_users`
--

INSERT INTO `site_users` (`user_id`, `user_login`, `user_password`, `user_name`, `user_address`, `user_city`, `user_state`, `user_zip`, `user_country`, `user_phone`, `user_email`, `user_email2`, `user_im_aol`, `user_im_icq`, `user_im_msn`, `user_im_yahoo`, `user_im_other`, `user_status`, `user_level`, `user_pending`, `user_date`, `last_login`, `last_ip`, `user_msg_send`, `user_msg_subject`, `user_protect_delete`, `user_protect_edit`) VALUES
(1, 'admin', '$2a$08$oId6n7GyLv8fFjPDT40G0ury7Qm7mdvncEM0i6JYtJ12FYm63M.dy', 'Site Admin', '', '', '', '', '', '', 'admin@example.com', 'someone@example.com', '', '', '', '', '', 0, 0, 0, 0, 1395186217, '127.0.0.1', 1, 'New Message', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
