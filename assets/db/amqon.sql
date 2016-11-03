-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2016 at 06:17 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amqon`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `bgcolor` enum('bg-navy','bg-maroon','bg-purple','bg-orange','bg-olive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `bgcolor`) VALUES
(1, 'super user', 'super user', 'bg-navy'),
(2, 'developer', 'developer', 'bg-maroon'),
(3, 'agen', 'sudo', 'bg-purple');

-- --------------------------------------------------------

--
-- Table structure for table `groups_control`
--

CREATE TABLE `groups_control` (
  `id_control` mediumint(8) NOT NULL,
  `group_id` mediumint(8) NOT NULL,
  `group_control_id` mediumint(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id_image` int(6) NOT NULL,
  `menu_id` mediumint(3) NOT NULL,
  `nama_image` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `deskripsi` mediumtext NOT NULL,
  `tgl_input_image` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id_image`, `menu_id`, `nama_image`, `image`, `deskripsi`, `tgl_input_image`) VALUES
(1, 1, 'Aku galau tingkat dewa', 'Saitama_OK.jpg', 'kau disini dan ku disana', '2016-09-11 13:10:02'),
(2, 1, 'Tampan & Berani', 'we.jpg', 'la.. la.. la.. aku sayang sekali doraemon...', '2016-09-11 06:14:57'),
(3, 1, 'wew galau', 'John-Lennon-600x405.jpg', 'disini aku menunggu mu dan bertanya?', '2016-09-11 06:16:41');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `order` int(3) NOT NULL,
  `nama_menu` varchar(25) NOT NULL,
  `url_pages` varchar(25) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `id_parent`, `order`, `nama_menu`, `url_pages`, `icon`, `status`) VALUES
(1, 0, 1, 'MAIN NAVIGATION', '', '', '1'),
(2, 1, 2, 'Dashboard', 'dashboard', 'fa fa-dashboard', '1'),
(25, 0, 0, 'settings', '', '', '1'),
(26, 25, 0, 'Menu Management', 'menu_manage', 'fa fa-th-list', '1'),
(27, 26, 0, 'FrontEnd Menu', 'menu_front_manage', 'fa fa-navicon', '1'),
(28, 26, 0, 'BackEnd Menu', 'menu_back_manage', '', '1'),
(29, 25, 0, 'Actor Management', '', 'fa fa-black-tie', '1'),
(30, 29, 0, 'User Management', 'user_manage', 'fa fa-black-tie', '1'),
(31, 29, 0, 'Role Management', 'role_manage', '', '1'),
(32, 25, 0, 'Content Management', '', 'fa fa-pencil-square', '1'),
(33, 32, 0, 'FrontEnd Text', 'text_front_manage', '', '1'),
(34, 32, 0, 'FrontEnd Image', 'image_front_manage', '', '1'),
(35, 32, 0, 'FrontEnd Content', 'content_front_manage', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `menu_access`
--

CREATE TABLE `menu_access` (
  `id_access` int(3) NOT NULL,
  `menu_id` int(3) DEFAULT NULL,
  `group_id` int(3) DEFAULT NULL,
  `buat` enum('0','1') NOT NULL DEFAULT '1',
  `baca` enum('0','1') NOT NULL DEFAULT '1',
  `ubah` enum('0','1') NOT NULL DEFAULT '1',
  `hapus` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_access`
--

INSERT INTO `menu_access` (`id_access`, `menu_id`, `group_id`, `buat`, `baca`, `ubah`, `hapus`) VALUES
(1, 1, 1, '1', '1', '1', '1'),
(2, 2, 1, '1', '1', '1', '1'),
(3, 25, 1, '1', '1', '1', '1'),
(4, 26, 1, '1', '1', '1', '1'),
(5, 27, 1, '1', '1', '1', '1'),
(6, 30, 1, '1', '1', '1', '1'),
(7, 3, 1, '1', '1', '1', '1'),
(8, 4, 1, '1', '1', '1', '1'),
(9, 28, 1, '1', '1', '1', '1'),
(10, 29, 1, '1', '1', '1', '1'),
(11, 31, 1, '1', '1', '1', '1'),
(12, 32, 1, '1', '1', '1', '1'),
(13, 33, 1, '1', '1', '1', '1'),
(14, 34, 1, '1', '1', '1', '1'),
(15, 35, 1, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `nav_menu`
--

CREATE TABLE `nav_menu` (
  `id_nav` mediumint(3) NOT NULL,
  `id_parent` mediumint(3) NOT NULL,
  `id_child` mediumint(3) NOT NULL,
  `nama_nav` varchar(25) NOT NULL,
  `url_page` varchar(25) NOT NULL,
  `description` mediumtext NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0 = tidak aktif, 1 = aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nav_menu`
--

INSERT INTO `nav_menu` (`id_nav`, `id_parent`, `id_child`, `nama_nav`, `url_page`, `description`, `status`) VALUES
(1, 0, 0, 'Home', 'home', 'Ini Adalah Halaman Home ', '1'),
(2, 1, 0, 'About', 'about', 'Ini Adalah Halaman About', '1'),
(3, 0, 0, 'Education', 'education', 'ini adalah halaman educatio', '1'),
(4, 0, 0, 'Blog', 'blog', 'Ini Halaman Blog bob', '1');

-- --------------------------------------------------------

--
-- Table structure for table `texts`
--

CREATE TABLE `texts` (
  `id_text` int(6) NOT NULL,
  `menu_id` mediumint(3) NOT NULL,
  `judul_text` varchar(255) NOT NULL,
  `isi_text` mediumtext NOT NULL,
  `tgl_input_text` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `texts`
--

INSERT INTO `texts` (`id_text`, `menu_id`, `judul_text`, `isi_text`, `tgl_input_text`) VALUES
(4, 1, 'About Colasive new', '<p>aaaanssssss sfffsffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff<i><span class="wysiwyg-color-gray">fffffffffffffffffffffffffffffffffffffffffffffffffff</span></i></p>', '2016-09-06 05:13:39'),
(5, 3, 'Belajar jatuh Cinta', '<p>la...la...la... aku senang sekali doraemon ,semua semua semua dapat dikabulkan dapat dikabulkan dengan kantong ajaib&nbsp; <br></p>', '2016-09-06 08:54:25'),
(6, 1, 'papa si kipapap', '<p>lo toir addjgnadglnajdl &nbsp;gahuug wh uhg &nbsp;hgweuhw uhwee gthwuh uht <b>yhhwtuhypr yhrwur9hy 9rhy9rhy9wrp</b></p>', '2016-09-06 09:38:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_picture` varchar(15) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_picture`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, 'avatar4.png', '127.0.0.1', 'SNmayer', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', NULL, 'cYPFiblxwOTxVsOqqOyBoO466dbf08dbf539cf58', 1471520056, 'EiVtpOZtD22FWxByNKjmBu', 1268889823, 1473583810, 1, 'abraham', 'setyanugraha', 'web programmer', '0'),
(2, 'avatar4.png', '::1', 'Oneng', '$2y$08$RyAkUVlNEwkNdgg3.U/gJe1oI2QUfHISxgC26mOkllhH2wFTi0Cgq', NULL, 'abrahamsn.mayer@gmail.com', NULL, NULL, NULL, NULL, 1470594091, NULL, 1, 'ganteng', 'setyanugraha', 'abrahamSN', '8996425057');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(22, 1, 1),
(19, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups_control`
--
ALTER TABLE `groups_control`
  ADD PRIMARY KEY (`id_control`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_image`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_parent` (`id_parent`),
  ADD KEY `id_parent_2` (`id_parent`);

--
-- Indexes for table `menu_access`
--
ALTER TABLE `menu_access`
  ADD PRIMARY KEY (`id_access`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `role_id` (`group_id`),
  ADD KEY `menu_id_2` (`menu_id`);

--
-- Indexes for table `nav_menu`
--
ALTER TABLE `nav_menu`
  ADD PRIMARY KEY (`id_nav`),
  ADD KEY `id_parent` (`id_parent`),
  ADD KEY `id_child` (`id_child`);

--
-- Indexes for table `texts`
--
ALTER TABLE `texts`
  ADD PRIMARY KEY (`id_text`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id_image` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `nav_menu`
--
ALTER TABLE `nav_menu`
  MODIFY `id_nav` mediumint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `texts`
--
ALTER TABLE `texts`
  MODIFY `id_text` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `texts`
--
ALTER TABLE `texts`
  ADD CONSTRAINT `fk_nav_menu_id_texts` FOREIGN KEY (`menu_id`) REFERENCES `nav_menu` (`id_nav`) ON UPDATE CASCADE;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
