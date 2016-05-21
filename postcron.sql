-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2015 at 08:56 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `postcron`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(5) NOT NULL AUTO_INCREMENT,
  `adminname` varchar(30) NOT NULL,
  `adminpassword` varchar(30) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `adminname`, `adminpassword`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `loginview`
--

CREATE TABLE IF NOT EXISTS `loginview` (
  `user_id` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `logintime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loginview`
--

INSERT INTO `loginview` (`user_id`, `username`, `logintime`) VALUES
(1, 'ramesh', '2015-12-19 15:14:42'),
(1, 'ramesh', '2015-12-19 15:35:12'),
(1, 'ramesh', '2015-12-19 15:41:48'),
(1, 'ramesh', '2015-12-19 15:41:55'),
(1, 'ramesh', '2015-12-19 15:42:29'),
(1, 'ramesh', '2015-12-19 16:02:02');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `notice` tinyint(1) NOT NULL,
  `news` varchar(250) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `captcha` varchar(10) NOT NULL,
  `googleanalitic` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `notice`, `news`, `logo`, `captcha`, `googleanalitic`) VALUES
(1, 1, 'This is news', 'images/logo.png', '1', 'Google analytics');

-- --------------------------------------------------------

--
-- Table structure for table `socialnetwork`
--

CREATE TABLE IF NOT EXISTS `socialnetwork` (
  `social_id` int(5) NOT NULL AUTO_INCREMENT,
  `social_name` varchar(50) NOT NULL,
  `social_link` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`social_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `socialnetwork`
--

INSERT INTO `socialnetwork` (`social_id`, `social_name`, `social_link`, `status`) VALUES
(1, 'Facebook', 'login_facebook.php', 1),
(2, 'Twitter', 'login_twitter.php', 1),
(3, 'Blogger', 'login_blogger.php', 1),
(4, 'wordpress', 'login_wordpress.php', 1),
(7, 'Google', 'login_google.php', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `firstname`, `lastname`, `email`, `status`) VALUES
(1, 'ramesh', 'ramesh', 'ram', 'yadav', 'rameshyadavjee@gmail.com', '1'),
(7, 'junad', 'junad', 'Jnad', 'Pp', 'junad@gmail.com', '0'),
(9, 'demo', 'demo', 'Demo', 'Demo', 'demo@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users_social`
--

CREATE TABLE IF NOT EXISTS `users_social` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `oauth_email` varchar(30) NOT NULL,
  `oauth_provider` varchar(30) NOT NULL,
  `oauth_uid` varchar(100) NOT NULL,
  `oauth_username` varchar(50) NOT NULL,
  `oauth_access_token` varchar(100) NOT NULL,
  `oauth_token_secret` varchar(100) NOT NULL,
  `oauth_verifier` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users_social`
--

INSERT INTO `users_social` (`user_id`, `oauth_email`, `oauth_provider`, `oauth_uid`, `oauth_username`, `oauth_access_token`, `oauth_token_secret`, `oauth_verifier`) VALUES
(1, 'ramshyadavjee@gmail.com', 'twitter', 'qOjzEgAAAAAAUk1DAAABUbnKKFk', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
