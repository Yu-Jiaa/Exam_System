-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- 主機: localhost
-- 建立日期: May 21, 2017, 01:14 PM
-- 伺服器版本: 5.0.45
-- PHP 版本: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 資料庫: `data`
-- 

-- --------------------------------------------------------

-- 
-- 資料表格式： `question`
-- 

CREATE TABLE `question` (
  `qid` int(4) NOT NULL auto_increment,
  `qus` varchar(40) NOT NULL,
  `op1` varchar(20) NOT NULL,
  `op2` varchar(20) NOT NULL,
  `op3` varchar(20) NOT NULL,
  `op4` varchar(20) NOT NULL,
  `ans` char(1) NOT NULL,
  PRIMARY KEY  (`qid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

-- 
-- 列出以下資料庫的數據： `question`
-- 

INSERT INTO `question` VALUES (1, '何者不是宋家「三胞胎」？', '民國', '大韓', '書俊', '萬歲', '3');
INSERT INTO `question` VALUES (8, '3+3=?', '5', '6', '7', '4', '2');
INSERT INTO `question` VALUES (7, '2+2=?', '4', '12', '5', '3', '1');
INSERT INTO `question` VALUES (11, '「&#29319;」的讀音與下列的哪一個字相同?', '牛', '留', '奔', '苯', '3');
INSERT INTO `question` VALUES (2, '兄弟幾千，做屋相連，做個甜酒擱過年，合個好藥賣仔大價錢。', '蜜蜂', '蟑螂', '螞蟻', '老鼠', '1');
INSERT INTO `question` VALUES (3, '請問這個世界上誰的快遞最多', '王老小姐', '王老小孩', '王老先生', '王老阿公', '3');
INSERT INTO `question` VALUES (4, '那一牌子的掃把最爛？', '月亮', '星星', '水鳥', '火鳥', '4');
INSERT INTO `question` VALUES (5, '最貴的水果是什麼？', '西瓜', '蘋果', '釋迦', '芭樂', '3');
INSERT INTO `question` VALUES (6, '那一個字需要三天才能寫完?', '日', '白', '晶', '月', '3');
INSERT INTO `question` VALUES (9, '4+4=?', '6', '16', '7', '8', '4');
INSERT INTO `question` VALUES (10, '6+6=?', '14', '12', '11', '13', '2');
INSERT INTO `question` VALUES (12, '「&#21509;」的讀音與下列的哪一個字相同?', '宣', '口', '品', '圍', '1');
INSERT INTO `question` VALUES (13, '「毳」的讀音與下列的哪一個字相同?', '橇', '毛', '卯', '撬', '1');
INSERT INTO `question` VALUES (14, '「&#27502;」的讀音與下列的哪一個字相同?', '止', '徵', '涉', '澀', '4');
INSERT INTO `question` VALUES (15, '「&#30608;」的讀音與下列的哪一個字相同?', '晶', '末', '卯', '金', '2');
INSERT INTO `question` VALUES (16, '下列何者不是導引式(Guided)媒體?', '雙絞線', '大氣層', '同軸線', '光纖', '2');
INSERT INTO `question` VALUES (17, 'PPP協定組中, PAP需要使用者提供:_____、_____', '帳號、密碼', '碼、運算過的值', '帳號、運算過的值', '挑戰值、密碼', '1');
INSERT INTO `question` VALUES (18, '目前全球最大的廣域網路是?', 'ISDN', 'Internet', 'PSTN', 'X.25', '3');
INSERT INTO `question` VALUES (19, '第1類UTP纜線最常使用於＿網路中', '電話', '紅外線', '傳統乙太網路', '快速以太網路', '1');
INSERT INTO `question` VALUES (20, '現行的電話網路(PSTN)是使用下列何種交換技術？', '電路交換', '分封交換', '分頻交換', '分時交換', '1');
INSERT INTO `question` VALUES (21, 'PPP協定組中, LCP封包的目的是?', '斷線', '選項的協商', '組態設定', '以上皆是', '4');
INSERT INTO `question` VALUES (22, '通訊網路依節點交換方式可分為？', 'Messages Switching', 'Circuit Switching', 'Packet Switching', '以上皆是', '4');

-- --------------------------------------------------------

-- 
-- 資料表格式： `score`
-- 

CREATE TABLE `score` (
  `stu_id` varchar(20) NOT NULL,
  `scores` char(3) NOT NULL,
  `examtime` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `score`
-- 

INSERT INTO `score` VALUES ('apple', '80', '2016/01/02  16:08:48');
INSERT INTO `score` VALUES ('apple', '100', '2016/01/02  16:39:55');
INSERT INTO `score` VALUES ('apple', '90', '2016/01/02  16:37:05');
INSERT INTO `score` VALUES ('apple', '50', '2016/01/05  18:02:20');
INSERT INTO `score` VALUES ('DJS0112', '80', '2016/01/11  16:57:11');
INSERT INTO `score` VALUES ('DJS0112', '100', '2016/01/11  17:26:59');
INSERT INTO `score` VALUES ('D10316108', '80', '2016/01/07  15:25:03');
INSERT INTO `score` VALUES ('D10316108', '90', '2016/01/10  23:35:03');
INSERT INTO `score` VALUES ('D10316108', '100', '2016/01/11  15:40:00');
INSERT INTO `score` VALUES ('D10316108', '95', '2016/01/11  17:46:32');
INSERT INTO `score` VALUES ('D10316108', '95', '2016/01/11  17:47:39');
INSERT INTO `score` VALUES ('D10316108', '60', '2017/05/19  17:10:11');

-- --------------------------------------------------------

-- 
-- 資料表格式： `student`
-- 

CREATE TABLE `student` (
  `stu_class` tinyint(4) NOT NULL COMMENT '學生班級',
  `stu_name` varchar(5) NOT NULL COMMENT '學生姓名',
  `stu_id` varchar(20) NOT NULL COMMENT '學生帳號',
  `stu_pwd` varchar(40) NOT NULL COMMENT '學生密碼',
  `stu_pwd2` varchar(40) NOT NULL COMMENT '確認密碼'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `student`
-- 

INSERT INTO `student` VALUES (101, '林育嘉', 'D10316108', '19960120', '19960120');
INSERT INTO `student` VALUES (102, '朴燦烈', 'PCY1127', '19921127', '19921127');
INSERT INTO `student` VALUES (101, '邊伯賢', 'BBH0506', '19920506', '19920506');
INSERT INTO `student` VALUES (102, '都暻秀', 'DJS0112', '19930112', '19930112');

-- --------------------------------------------------------

-- 
-- 資料表格式： `teacher`
-- 

CREATE TABLE `teacher` (
  `tea_class` tinyint(4) NOT NULL COMMENT '班級',
  `tea_name` varchar(5) NOT NULL COMMENT '老師姓名',
  `tea_id` varchar(20) NOT NULL COMMENT '老師帳號',
  `tea_pwd` varchar(40) NOT NULL COMMENT '老師密碼'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `teacher`
-- 

INSERT INTO `teacher` VALUES (101, '吳世勳', 't101', '19940412');
INSERT INTO `teacher` VALUES (102, '張藝興', 't102', '19911007');
