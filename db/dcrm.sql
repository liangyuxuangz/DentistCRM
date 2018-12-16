-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 年 12 月 16 日 15:11
-- 服务器版本: 5.5.53
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `dcrm`
--

-- --------------------------------------------------------

--
-- 表的结构 `visitors`
--

CREATE TABLE IF NOT EXISTS `visitors` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `personId` varchar(30) NOT NULL,
  `name` varchar(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `age` int(4) NOT NULL,
  `imageurl` varchar(150) NOT NULL DEFAULT '',
  `faceposition` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `visitors`
--

INSERT INTO `visitors` (`id`, `personId`, `name`, `type`, `sex`, `age`, `imageurl`, `faceposition`) VALUES
(6, '08ef0220000a-cd98-8e11-1cc2-03', '员工1', 'staff', 0, 0, 'https://static.tuputech.com/api/image/big/bi-api/storage-0831/2018-12-16/12/5b6eb9668e80690c1b69b254/15449354535670.722858018045959.jpg', ''),
(5, '08ef0220000a-cd98-8e11-4cc2-4a', '员工4', 'staff', 0, 0, 'https://static.tuputech.com/api/image/big/bi-api/storage-0831/2018-12-16/17/5b6eb9668e80690c1b69b254/15449515475900.0036675565044297365.jpg', ''),
(7, '08ef0220000a-cd98-8e11-4cc2-4a', '员工4', 'staff', 0, 0, 'https://static.tuputech.com/api/image/big/bi-api/storage-0831/2018-12-16/17/5b6eb9668e80690c1b69b254/15449515475900.0036675565044297365.jpg', 'null'),
(8, '08ef0220000a-cd98-8e11-1cc2-03', '员工1', 'staff', 0, 0, 'https://static.tuputech.com/api/image/big/bi-api/storage-0831/2018-12-16/12/5b6eb9668e80690c1b69b254/15449354535670.722858018045959.jpg', 'null'),
(9, '08ef0220000a-cd98-8e11-4cc2-4a', '员工4', 'staff', 0, 0, 'https://static.tuputech.com/api/image/big/bi-api/storage-0831/2018-12-16/17/5b6eb9668e80690c1b69b254/15449515475900.0036675565044297365.jpg', '[[0.23125,0.13611111111111],[0.29010416666667,0.13611111111111],[0.29010416666667,0.24074074074074],[0.23125,0.24074074074074]]'),
(10, '08ef0220000a-cd98-8e11-1cc2-03', '员工1', 'staff', 0, 0, 'https://static.tuputech.com/api/image/big/bi-api/storage-0831/2018-12-16/12/5b6eb9668e80690c1b69b254/15449354535670.722858018045959.jpg', '[[0.340625,0.040740740740741],[0.39791666666667,0.040740740740741],[0.39791666666667,0.14259259259259],[0.340625,0.14259259259259]]');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
