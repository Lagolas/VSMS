-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 07 月 20 日 09:31
-- 服务器版本: 5.5.36
-- PHP 版本: 5.4.26

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `vsite`
--

-- --------------------------------------------------------

--
-- 表的结构 `vs_article`
--

CREATE TABLE IF NOT EXISTS `vs_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `ctime` int(10) unsigned NOT NULL,
  `etime` int(10) unsigned NOT NULL,
  `listorder` tinyint(3) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `vs_article`
--

INSERT INTO `vs_article` (`id`, `uid`, `cid`, `title`, `keyword`, `description`, `thumb`, `content`, `ctime`, `etime`, `listorder`, `state`) VALUES
(1, 1, 2, '长江沉船救援人员向遇难者遗体鞠躬致哀', '长江沉船,长江沉船长江沉船', '长江沉船救援人员向遇难者遗体鞠躬致哀长江沉船救援人员向遇难者遗体鞠躬致哀11111111111', './Public/Upload//20150603/556ed5162826a.jpg', '<p style="word-wrap: break-word; margin-top: 0px; margin-bottom: 0px; padding: 0px; list-style: none; border: 0px; text-indent: 28px; line-height: 28px; font-size: 14px; white-space: normal; color: rgb(87, 86, 86); font-family: 宋体; background-color: rgb(255, 255, 255);">　【今晨第一批“东方之星”沉船遇难人员遗体打捞出水】6月3日7时50分，今天第一批“东方之星”沉船遇难人员遗体打捞出水。（曹英华、肖思明中国军网）</p><p style="word-wrap: break-word; margin-top: 0px; margin-bottom: 0px; padding: 0px; list-style: none; border: 0px; text-indent: 28px; line-height: 28px; font-size: 14px; white-space: normal; color: rgb(87, 86, 86); font-family: 宋体; background-color: rgb(255, 255, 255);">　【长江客船沉没34小时消息汇总】①截至今早7时，已救起21人，其中14人生还，7人遇难；②救援彻夜进行，凌晨3:49和4:07发现2名遇难者遗体；③搜救范围扩大至下游220公里处；④昨晚20时沉船位置已测定并系固，事发水域逐步恢复通航。（央视）</p><p style="word-wrap: break-word; margin-top: 0px; margin-bottom: 0px; padding: 0px; list-style: none; border: 0px; text-indent: 28px; line-height: 28px; font-size: 14px; white-space: normal; color: rgb(87, 86, 86); font-family: 宋体; background-color: rgb(255, 255, 255);"><br/></p><p style="word-wrap: break-word; margin-top: 0px; margin-bottom: 0px; padding: 0px; list-style: none; border: 0px; text-indent: 28px; line-height: 28px; font-size: 14px; white-space: normal; color: rgb(87, 86, 86); font-family: 宋体; background-color: rgb(255, 255, 255);"><br/></p><p style="text-align: center;"><img src="/Public/Upload/ueditor/image/20150603/1433315978130588.jpg" title="1433315978130588.jpg" alt="085113xogowonztwkntr6q.jpg"/></p>', 1433316002, 1433388676, 21, 1),
(2, 1, 1, '国内测试', 'adada', 'adad', '', '<p>大大大</p>', 1433320224, 0, 0, 1),
(3, 1, 3, '江苏连云港现火烧云美景', '', '', '', '<p><span style="color: rgb(51, 51, 51); font-family: &#39;Microsoft Yahei&#39;, sans-serif; font-size: 14px; line-height: 28px; background-color: rgb(249, 249, 249);">6月3日傍晚，江苏省连云港市赣榆区出现火烧云美景，天空中晚霞似火，壮美奇观，美不胜收。中新社发 邵世新 摄</span></p>', 1433387328, 1433387328, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `vs_categorys`
--

CREATE TABLE IF NOT EXISTS `vs_categorys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(100) NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `path` varchar(255) NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `model` tinyint(1) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `vs_categorys`
--

INSERT INTO `vs_categorys` (`id`, `cate_name`, `pid`, `path`, `uid`, `model`, `state`, `ctime`) VALUES
(1, '国内新闻', 0, '', 1, 1, 1, 1433312479),
(2, '国际新闻', 0, '', 1, 1, 1, 1433312486),
(3, '江苏新闻', 1, '-1', 1, 1, 1, 1433312495),
(4, '徐州新闻', 3, '-1-3', 1, 1, 1, 1433312503),
(5, '图片新闻', 0, '', 1, 2, 1, 1433386204),
(6, '国内图片', 5, '-5', 1, 2, 1, 1433386319),
(7, '国际图片', 5, '-5', 1, 2, 1, 1433386331),
(8, '江苏图集', 6, '-5-6', 1, 2, 1, 1433386341),
(9, '徐州图集', 8, '-5-6-8', 1, 2, 1, 1433386350),
(10, '瀛海图集', 9, '-5-6-8-9', 1, 2, 1, 1433386360),
(11, '特价商品', 0, '', 1, 3, 1, 1433743249);

-- --------------------------------------------------------

--
-- 表的结构 `vs_goods`
--

CREATE TABLE IF NOT EXISTS `vs_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '商品名称',
  `keyword` varchar(100) NOT NULL COMMENT '关键词',
  `description` varchar(255) NOT NULL COMMENT '商品简介',
  `price` float NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `content` text NOT NULL COMMENT '商品详情',
  `listorder` mediumint(5) NOT NULL,
  `state` tinyint(2) NOT NULL DEFAULT '1',
  `ctime` int(10) unsigned NOT NULL,
  `etime` int(10) unsigned NOT NULL,
  `remark` varchar(255) NOT NULL COMMENT '商品备注',
  `favor` mediumint(8) unsigned NOT NULL,
  `packagefee` float NOT NULL DEFAULT '0' COMMENT '包装费',
  `expressfee` float NOT NULL DEFAULT '0' COMMENT '快递费',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `vs_goods`
--

INSERT INTO `vs_goods` (`id`, `uid`, `cid`, `title`, `keyword`, `description`, `price`, `thumb`, `content`, `listorder`, `state`, `ctime`, `etime`, `remark`, `favor`, `packagefee`, `expressfee`) VALUES
(1, 1, 11, '也加手机1', '手机1', '手机简介1', 1111, './Public/Upload//20150608/557532fdc5e13.png', '<p>手机详情1</p>', 11, 0, 1433744125, 1433749671, '', 0, 11, 151),
(2, 1, 11, '第二个商品', '第二个', '简介', 11, '', '<p>详情</p>', 3, 1, 1433744241, 1433744241, '', 0, 1.5, 15.05),
(4, 1, 11, '测试状态', '测试', '这是测试', 1452, '', '<p>这是测试</p>', 0, 1, 1433749854, 1433749854, '', 0, 0, 0),
(5, 1, 11, '再次测试', '啊大大', '阿达大大大', 5252, '', '<p>啊大大</p>', 0, 0, 1433749888, 1433750195, '', 0, 0, 0),
(6, 1, 11, '哈哈', '', '', 152, '', '<p>啊大大</p>', 0, 0, 1433749919, 1433749919, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `vs_member`
--

CREATE TABLE IF NOT EXISTS `vs_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `ctime` int(10) unsigned NOT NULL,
  `mobile` char(11) NOT NULL,
  `verify_code` varchar(6) NOT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `salt` char(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `vs_member`
--

INSERT INTO `vs_member` (`id`, `openid`, `name`, `password`, `ctime`, `mobile`, `verify_code`, `level`, `state`, `salt`) VALUES
(1, '', 'admin', '08f98c90df92d7d87109dcbf77ee5ad8', 0, '', '', 1, 1, '123qwe');

-- --------------------------------------------------------

--
-- 表的结构 `vs_picgroup`
--

CREATE TABLE IF NOT EXISTS `vs_picgroup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `pics` text NOT NULL,
  `content` text NOT NULL,
  `listorder` mediumint(5) NOT NULL,
  `ctime` int(10) unsigned NOT NULL,
  `etime` int(10) unsigned NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `vs_picgroup`
--

INSERT INTO `vs_picgroup` (`id`, `uid`, `cid`, `title`, `keyword`, `description`, `thumb`, `pics`, `content`, `listorder`, `ctime`, `etime`, `state`) VALUES
(1, 1, 10, '这是图集测试1', 'adaa1', 'adadadadad1', './Public/Upload//20150608/5574f38775021.png', 'a:4:{i:0;s:77:"/Public/Upload/jqueryfileupload/20150608/4bcc708c9f285e745d32c9dfdad79f6b.png";i:1;s:77:"/Public/Upload/jqueryfileupload/20150608/820c15fd58ad246d2f189afbc92f1d71.png";i:2;s:77:"/Public/Upload/jqueryfileupload/20150608/00c3737ff88c0183c4c9cb65835deff3.png";i:3;s:77:"/Public/Upload/jqueryfileupload/20150608/3ee126a6af7419ec173c32da0c33937e.png";}', '<p>这是图集相关测试1</p>', 0, 1433490771, 1433728232, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
