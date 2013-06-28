-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2013 年 06 月 28 日 10:38
-- 服务器版本: 5.5.27
-- PHP 版本: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `blogs`
--

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`ID`, `name`, `password`) VALUES
(1, 'bbb', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'green', '47bce5c74f589f4867dbd57e9ca9f808'),
(9, 'aaa', '74b87337454200d4d33f80c4663dc5e5'),
(10, 'aaa', '74b87337454200d4d33f80c4663dc5e5'),
(11, 'aaa', '74b87337454200d4d33f80c4663dc5e5'),
(12, 'aaa', '74b87337454200d4d33f80c4663dc5e5'),
(13, 'bbb', '47bce5c74f589f4867dbd57e9ca9f808'),
(14, 'bbb', '47bce5c74f589f4867dbd57e9ca9f808'),
(15, 'bbb', '47bce5c74f589f4867dbd57e9ca9f808'),
(16, 'bbb', '47bce5c74f589f4867dbd57e9ca9f808'),
(17, 'bbb', '47bce5c74f589f4867dbd57e9ca9f808'),
(18, 'bbb', '47bce5c74f589f4867dbd57e9ca9f808'),
(19, 'bbb', '47bce5c74f589f4867dbd57e9ca9f808'),
(20, 'bbb', '47bce5c74f589f4867dbd57e9ca9f808');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
