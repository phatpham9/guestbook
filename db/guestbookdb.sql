-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2014 at 09:05 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `guestbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `gb_answer`
--

CREATE TABLE IF NOT EXISTS `gb_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `content` text,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gb_ava`
--

CREATE TABLE IF NOT EXISTS `gb_ava` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `file_name` varchar(32) NOT NULL,
  `file_ext` varchar(5) NOT NULL,
  `file_path` varchar(100) NOT NULL,
  `thumb_path` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `gb_ava`
--

INSERT INTO `gb_ava` (`id`, `user_id`, `file_name`, `file_ext`, `file_path`, `thumb_path`, `created`, `modified`) VALUES
(15, 10, 'cfa58a236f23cdeba379d8f0924d3ab0', '.jpg', 'assets/upload/ava/', 'assets/upload/ava/thumb/', '2014-05-11 13:54:03', '2014-05-11 06:59:14'),
(16, 11, '3055b20d8ffff0eaaab419ad795b3aaf', '.png', 'assets/upload/ava/', 'assets/upload/ava/thumb/', '2014-05-11 14:00:00', '2014-05-11 07:01:31'),
(17, 13, '0d22e658a785b52082320578a46f839c', '.jpg', 'assets/upload/ava/', 'assets/upload/ava/thumb/', '2014-05-12 10:48:39', '2014-05-12 03:48:39');

-- --------------------------------------------------------

--
-- Table structure for table `gb_basic_info`
--

CREATE TABLE IF NOT EXISTS `gb_basic_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `gender` tinyint(1) DEFAULT NULL COMMENT '0-female, 1-male',
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT 'city/province and country',
  `relationship_status` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `language` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT 'max 5 languages',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gb_basic_info`
--

INSERT INTO `gb_basic_info` (`id`, `user_id`, `gender`, `date_of_birth`, `place_of_birth`, `relationship_status`, `language`, `created`, `modified`) VALUES
(1, 10, 1, '1991-01-20', 'Quảng Ngãi', 'Open Relationship', 'Vietnamese, English', '0000-00-00 00:00:00', '2014-05-14 10:19:34'),
(2, 11, 0, '1991-07-29', 'Huế', 'Open relationship', 'Vietnamese, English', '2014-05-14 17:05:42', '2014-05-14 10:08:21');

-- --------------------------------------------------------

--
-- Table structure for table `gb_contact_info`
--

CREATE TABLE IF NOT EXISTS `gb_contact_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `skype` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `gb_contact_info`
--

INSERT INTO `gb_contact_info` (`id`, `user_id`, `address`, `phone`, `email`, `facebook`, `skype`, `created`, `modified`) VALUES
(1, 10, 'Q. Tân Phú, TP. HCM', '0122 5151 812', 'phat.pham9@gmail.com', 'facebook.com/phat.pham99', 'phat.pham9', '0000-00-00 00:00:00', '2014-05-20 12:49:44');

-- --------------------------------------------------------

--
-- Table structure for table `gb_favorite_quote`
--

CREATE TABLE IF NOT EXISTS `gb_favorite_quote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `favorite_quote` text,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `gb_favorite_quote`
--

INSERT INTO `gb_favorite_quote` (`id`, `user_id`, `favorite_quote`, `created`, `modified`) VALUES
(9, 11, 'My name''s Tôn Nữ Ngọc Ánh', '2014-05-14 13:23:14', '2014-05-14 06:23:14');

-- --------------------------------------------------------

--
-- Table structure for table `gb_job`
--

CREATE TABLE IF NOT EXISTS `gb_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `company_website` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `type` varchar(15) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `gb_job`
--

INSERT INTO `gb_job` (`id`, `user_id`, `company`, `company_website`, `title`, `type`, `created`, `modified`) VALUES
(14, 11, 'FSoft', 'www.fsoft.com', 'QC Engineer', 'current_job', '2014-05-20 21:57:21', '2014-05-20 14:57:21'),
(21, 10, 'Softfoundry', 'www.softfoundry.com', 'Web Developer (PHP & J2EE)', 'current_job', '2014-05-20 22:31:23', '2014-05-20 15:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `gb_like`
--

CREATE TABLE IF NOT EXISTS `gb_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `gb_like`
--

INSERT INTO `gb_like` (`id`, `status_id`, `user_id`, `created`) VALUES
(39, 57, 10, '2014-05-10 11:33:46'),
(41, 3, 10, '2014-05-10 11:33:56'),
(42, 4, 10, '2014-05-10 11:33:57'),
(43, 5, 10, '2014-05-10 11:33:57'),
(44, 6, 10, '2014-05-10 11:33:59'),
(45, 3, 11, '2014-05-10 11:37:40'),
(47, 5, 11, '2014-05-10 11:37:43'),
(48, 57, 11, '2014-05-10 11:37:44'),
(49, 58, 11, '2014-05-10 11:37:46'),
(50, 59, 11, '2014-05-10 11:37:47'),
(51, 4, 11, '2014-05-10 11:50:50'),
(56, 59, 13, '2014-05-12 10:53:32'),
(59, 58, 10, '2014-05-13 12:25:09'),
(64, 61, 10, '2014-05-13 12:31:48');

--
-- Triggers `gb_like`
--
DROP TRIGGER IF EXISTS `like_status_trigger`;
DELIMITER //
CREATE TRIGGER `like_status_trigger` AFTER INSERT ON `gb_like`
 FOR EACH ROW UPDATE `gb_status`
SET `gb_status`.`num_likes` = `gb_status`.`num_likes` + 1
WHERE `gb_status`.`id` = `NEW`.`status_id`
//
DELIMITER ;
DROP TRIGGER IF EXISTS `unlike_status_trigger`;
DELIMITER //
CREATE TRIGGER `unlike_status_trigger` AFTER DELETE ON `gb_like`
 FOR EACH ROW UPDATE `gb_status`
SET `gb_status`.`num_likes` = `gb_status`.`num_likes` - 1
WHERE `gb_status`.`id` = `OLD`.`status_id`
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `gb_login_attempt`
--

CREATE TABLE IF NOT EXISTS `gb_login_attempt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `login` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gb_question`
--

CREATE TABLE IF NOT EXISTS `gb_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `gb_question`
--

INSERT INTO `gb_question` (`id`, `content`, `order`, `created`, `modified`) VALUES
(1, 'Your most favorite course?', 1, '0000-00-00 00:00:00', '2014-05-28 14:37:15'),
(2, 'Which course did you fall asleep most?', 2, '0000-00-00 00:00:00', '2014-05-28 14:37:42'),
(3, 'Your most favorite lecturer?', 3, '0000-00-00 00:00:00', '2014-05-28 14:37:58'),
(4, 'Which lecturer did you dislike most?', 4, '0000-00-00 00:00:00', '2014-05-28 14:39:14');

-- --------------------------------------------------------

--
-- Table structure for table `gb_session`
--

CREATE TABLE IF NOT EXISTS `gb_session` (
  `session_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gb_session`
--

INSERT INTO `gb_session` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('04908ac994657e1f08534823cbcfe61d', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36', 1403709258, 'a:6:{s:9:"user_data";s:0:"";s:7:"user_id";s:2:"10";s:8:"username";s:7:"t093641";s:9:"full_name";s:19:"Phạm Thanh  Phát";s:7:"ava_url";s:74:"http://localhost/gb/assets/upload/ava/cfa58a236f23cdeba379d8f0924d3ab0.jpg";s:6:"status";s:1:"1";}'),
('5ba6e16d9abc0f1017e50a586955c0d1', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36', 1403763114, ''),
('975a4cd5f0808e527c4d823e3479382c', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.114 Safari/537.36', 1402502624, ''),
('e69a5dbf7b218e7db71fdc7a551dbedb', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.114 Safari/537.36', 1402557857, '');

-- --------------------------------------------------------

--
-- Table structure for table `gb_status`
--

CREATE TABLE IF NOT EXISTS `gb_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `num_likes` int(11) NOT NULL DEFAULT '0',
  `num_comments` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `gb_status`
--

INSERT INTO `gb_status` (`id`, `user_id`, `text`, `num_likes`, `num_comments`, `created`, `modified`) VALUES
(3, 11, 'len1', 2, 0, '2014-05-03 22:55:35', '2014-05-10 04:37:40'),
(4, 11, 'len2', 2, 0, '2014-05-03 22:55:51', '2014-05-10 04:50:50'),
(5, 11, 'len3', 2, 0, '2014-05-03 23:01:50', '2014-05-10 04:37:43'),
(57, 10, 'lskjdlkfjsdlkfjsdkfsd fsd fsdf ds', 2, 0, '2014-05-10 10:32:51', '2014-05-23 07:21:37'),
(59, 10, 'http://google.com', 2, 0, '2014-05-10 11:32:47', '2014-06-25 15:14:01'),
(60, 13, 'Hello worlds !', 0, 0, '2014-05-12 10:45:17', '2014-05-13 05:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `gb_student`
--

CREATE TABLE IF NOT EXISTS `gb_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(10) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `gb_student`
--

INSERT INTO `gb_student` (`id`, `student_id`, `full_name`) VALUES
(1, 't093945', 'Vũ Nguyên Anh'),
(2, 't095756', 'Tôn Nữ Ngọc Ánh'),
(3, 't094481', 'Đặng Thế Cường'),
(4, 't093785', 'Lê Bá Dũng'),
(5, 't097060', 'Nguyễn Hồng Hải'),
(6, 't095095', 'Lương Thị Hồng Hạnh'),
(7, 't094442', 'Trần Văn Hảo'),
(8, 't093798', 'Lê Lâm Hiếu'),
(9, 't094016', 'Nguyễn Phan Xuân Huy'),
(10, 't095578', 'Hồ Đắc Huy'),
(11, 't097590', 'Lê Đình Thạch Huyên'),
(12, 't093645', 'Đỗ Tiến Hưng'),
(13, 't094514', 'Nguyễn Hữu Hưng'),
(14, 't091900', 'Dương Hoài Khánh'),
(15, 't093686', 'Trần Hoàng Long'),
(16, 't097430', 'Bùi Huỳnh Kinh Luân'),
(17, 't095428', 'Trịnh Huỳnh Công Minh'),
(18, 't096375', 'Nguyễn Ngọc Ngân'),
(19, 't093606', 'Nguyễn Trọng Nghĩa'),
(20, 't092497', 'Đoàn Thành Nghiêm'),
(21, 't094477', 'Nguyễn Minh Ngọc'),
(22, 't095132', 'Châu Hồng Nhựt'),
(23, 't093641', 'Phạm Thanh Phát'),
(24, 't094971', 'Lai Thanh Phong'),
(25, 't093131', 'Tăng Khánh Phú'),
(26, 't094678', 'Nguyễn Bảo Phương'),
(27, 't094193', 'Nguyễn Phú Quang'),
(28, 't095090', 'Nguyễn Khánh Quảng'),
(29, 't093031', 'Trương Phú Quốc'),
(30, 't094967', 'Đặng Huy Sơn'),
(31, 't090549', 'Đỗ Minh Tâm'),
(32, 't093794', 'Nguyễn Phước Thắng'),
(33, 't090133', 'Nguyễn Phong Thanh'),
(34, 't096316', 'Trương Công Thành'),
(35, 't090208', 'Đỗ Trần Hoàng Thịnh'),
(36, 't095278', 'Nguyễn Ngọc Thủy'),
(37, 't093704', 'Bùi Nhật Tiến'),
(38, 't097676', 'Nguyễn Trung Tín'),
(39, 't094328', 'Nguyễn Minh Trí'),
(40, 't096260', 'Nguyễn Quốc Trung'),
(41, 't096764', 'Trần Huỳnh Thái Trung'),
(42, 't096270', 'Nguyễn Anh Tuấn'),
(43, 't094097', 'Lê Thị Bích Vân'),
(44, 't094174', 'Đỗ Thị Thanh Xuân');

-- --------------------------------------------------------

--
-- Table structure for table `gb_user`
--

CREATE TABLE IF NOT EXISTS `gb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) DEFAULT NULL,
  `new_password_key` varchar(50) DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) DEFAULT NULL,
  `new_email_key` varchar(50) DEFAULT NULL,
  `last_ip` varchar(40) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `gb_user`
--

INSERT INTO `gb_user` (`id`, `full_name`, `username`, `password`, `email`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`) VALUES
(10, 'Phạm Thanh  Phát', 't093641', '$2a$08$lZtZBGGQnrdNunsdZQ2ICO5yhe2nM3cL0ftJ/SzNCN5z7KdNQee3W', 't0934641@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2014-06-25 17:09:20', '2014-04-29 10:38:10', '2014-06-25 15:09:20'),
(11, 'Tôn Nữ Ngọc Ánh', 't095756', '$2a$08$kWXohD6vM59vZKnulAjjauRF9xp3WVAvOLRWMroH4o.fnioyGhtRa', 't095756@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2014-05-20 21:54:30', '2014-05-03 09:29:47', '2014-05-20 14:54:30'),
(12, 'Vũ Nguyên Anh', 't093945', '$2a$08$5VDOvz5.cDcx5bpIkDVGbudbgpaAASexGOipxpqF0GlPpNsP1k4P2', 't093945@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2014-05-11 21:23:53', '2014-05-11 21:22:46', '2014-05-11 14:26:45'),
(13, 'Nguyễn Phú Quang', 't094193', '$2a$08$em54PsHJ9.WdM.COUpbYyO4PfngcXSa9HBK18rvS8HASxq6dIhQve', 'nguyenphuquang90@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '192.168.1.20', '2014-05-12 10:50:08', '2014-05-12 10:44:23', '2014-05-12 03:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `gb_user_autologin`
--

CREATE TABLE IF NOT EXISTS `gb_user_autologin` (
  `key_id` char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
