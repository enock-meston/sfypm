-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2022 at 06:55 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sfypm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcomment`
--

CREATE TABLE `tblcomment` (
  `cid` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `projectID` int(11) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcomment`
--

INSERT INTO `tblcomment` (`cid`, `message`, `projectID`, `status`) VALUES
(1, '', 3, 1),
(2, 'try to get more informatoin from your case study', 3, 1),
(3, 'comment', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblprojectcanvas`
--

CREATE TABLE `tblprojectcanvas` (
  `cid` int(11) NOT NULL,
  `groupNumber` varchar(45) NOT NULL,
  `title` varchar(100) NOT NULL,
  `Problem` longtext NOT NULL,
  `Solution` longtext NOT NULL,
  `UniqueValueProposition` longtext NOT NULL,
  `UnfairAdvantage` longtext NOT NULL,
  `CustomerSegments` longtext NOT NULL,
  `ExistingAlternatives` longtext NOT NULL,
  `KeyMetrics` longtext NOT NULL,
  `HighLevelConcept` longtext NOT NULL,
  `Channels` longtext NOT NULL,
  `EarlyAdopters` longtext NOT NULL,
  `CostStructure` longtext NOT NULL,
  `RevenueStructure` longtext NOT NULL,
  `AddedOnDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblprojectcanvas`
--

INSERT INTO `tblprojectcanvas` (`cid`, `groupNumber`, `title`, `Problem`, `Solution`, `UniqueValueProposition`, `UnfairAdvantage`, `CustomerSegments`, `ExistingAlternatives`, `KeyMetrics`, `HighLevelConcept`, `Channels`, `EarlyAdopters`, `CostStructure`, `RevenueStructure`, `AddedOnDate`, `Status`) VALUES
(2, '323133', 'Rwanda project', 'fjfk', 'kfek', 'kdfnk', 'kfgk', 'kfek', 'kfl', 'encok', 'ndagijimana', 'google', 'listView', 'in cash', 'in tools', '2022-10-31 13:55:23', 1),
(3, '279443', 'karate', 'karate', 'karate', 'karate', 'karate', 'V', 'karate', 'Vkarate', 'karate', 'karate', 'Vkarate', 'karate', 'karate', '2022-10-31 14:27:41', 4),
(4, '578104', 'USSD message with MoMo.', 'no communication', 'communication', 'use USSD', 'portable', 'Rwandans', '   MTN', 'new users per days', 'communication ', 'telecommunication', 'telephone', 'Employes and tools', '1000 per user times 1000 per resources equals 1M.', '2022-11-03 13:25:46', 2),
(5, 'enock meston', 'ikimina', '', '', '', '', '', '', '', '', '', '', '', '', '2022-11-03 15:57:14', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `id` int(11) NOT NULL,
  `postCanvasID` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group`
--

CREATE TABLE `tbl_group` (
  `gid` int(11) NOT NULL,
  `groupNumber` int(10) NOT NULL,
  `studentOne` int(11) NOT NULL,
  `studentTwo` int(11) NOT NULL,
  `superVisorID` int(11) DEFAULT NULL,
  `CreatedOne` date NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_group`
--

INSERT INTO `tbl_group` (`gid`, `groupNumber`, `studentOne`, `studentTwo`, `superVisorID`, `CreatedOne`, `status`) VALUES
(6, 323133, 2, 3, 9, '2022-10-16', 1),
(7, 149111, 12, 4, 9, '2022-10-21', 2),
(8, 35346, 6, 9, 9, '2022-10-31', 2),
(9, 279443, 29, 11, 8, '2022-10-31', 0),
(10, 578104, 38, 14, 8, '2022-11-02', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group_supervisor`
--

CREATE TABLE `tbl_group_supervisor` (
  `gs_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_group_supervisor`
--

INSERT INTO `tbl_group_supervisor` (`gs_id`, `group_id`, `supervisor_id`, `date`, `status`) VALUES
(1, 6, 8, '2022-11-02', 1),
(2, 8, 8, '2022-11-02', 1),
(3, 7, 8, '2022-11-02', 1),
(4, 6, 8, '2022-11-02', 1),
(5, 9, 9, '2022-11-02', 1),
(6, 6, 8, '2022-11-02', 1),
(7, 6, 8, '2022-11-02', 1),
(8, 7, 8, '2022-11-02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

CREATE TABLE `tbl_message` (
  `mid` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `messageMember` longtext DEFAULT NULL,
  `messageUser` longtext DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_message`
--

INSERT INTO `tbl_message` (`mid`, `memberID`, `userId`, `messageMember`, `messageUser`, `date`, `status`) VALUES
(2, 14, 8, 'hello there!', 'wazize ikihe kibazo?', '2022-11-02 14:24:22', 2),
(3, 14, 8, 'okfws', 'wazize ikihe kibazo?', '2022-11-02 14:24:48', 2),
(4, 14, 8, 'hd', 'wazize ikihe kibazo?', '2022-11-02 14:49:20', 2),
(5, 14, 8, 'my name is enock', 'wazize ikihe kibazo?', '2022-11-02 14:49:28', 2),
(6, 14, 8, 'kef', 'wazize ikihe kibazo?', '2022-11-02 14:49:54', 2),
(9, 14, 8, 'hello again', 'wazize ikihe kibazo?', '2022-11-02 14:53:26', 2),
(13, 14, 8, 'akadomo', 'akahe', '2022-11-02 15:00:08', 2),
(14, 14, 8, 'iki?', 'wazize ikihe kibazo?', '2022-11-02 15:12:24', 2),
(16, 14, 8, 'gwino', 'ok', '2022-11-02 15:17:31', 2),
(17, 14, 8, 'hi', 'hi', '2022-11-02 15:33:13', 2),
(18, 14, 8, 'amakuru', 'ni meza cyane', '2022-11-02 15:34:02', 2),
(19, 14, 8, 'k', NULL, '2022-11-02 15:44:36', 2),
(20, 14, 8, 'welcome', NULL, '2022-11-02 15:44:59', 2),
(21, 14, 8, 'welcome', '.', '2022-11-02 15:45:36', 2),
(22, 14, 8, 'prof vip zawe?', 'ni poa wa cyintu we', '2022-11-02 15:52:58', 2),
(23, 8, 0, 'bite sha', NULL, '2022-11-02 19:53:27', 1),
(24, 14, 8, 'nagize ikibazo', 'wazize ikihe kibazo?', '2022-11-02 19:53:56', 2),
(25, 14, 8, 'nigute bishyura kuri MoMo pay Programaticaly?', NULL, '2022-11-03 12:35:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projectbook`
--

CREATE TABLE `tbl_projectbook` (
  `proID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `owner_One` varchar(100) NOT NULL,
  `Owner_two` varchar(100) NOT NULL,
  `AccademicYear` varchar(30) NOT NULL,
  `SuperVisorName` varchar(200) NOT NULL,
  `bookPath` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_projectbook`
--

INSERT INTO `tbl_projectbook` (`proID`, `title`, `owner_One`, `Owner_two`, `AccademicYear`, `SuperVisorName`, `bookPath`, `date`, `status`) VALUES
(3, 'Umunara', 'muhirwa David', 'Enock Ndabarasa', '', 'Girbert', 'pdfBooks/FILE-637f3d7d239511.90839074Umunara.pdf', '2022-11-24', 1),
(4, 'Amanjyambere', 'mahirwe', 'Mugisha ', '2012-2015', 'Girbert', 'pdfBooks/FILE-637f44a49fc783.12774634Amanjyambere.pdf', '2022-11-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `sID` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `reg_number` varchar(18) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phoneNumber` varchar(18) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Department` varchar(100) NOT NULL,
  `Academic_Year` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL,
  `groupStatsu` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`sID`, `fname`, `lname`, `reg_number`, `email`, `phoneNumber`, `password`, `Department`, `Academic_Year`, `date`, `status`, `groupStatsu`) VALUES
(1, 'NDAGIJIMANA', 'Enock', '19RP00901', 'ndagijiamanaenock11@gmail.com', '783982872', '$2y$10$ZDJPJreRslTSI2uEdnGeke8aWrNrCar6VwvrG5C3JDPc5r/H0BcAy', 'ICT', '2019-2022', '2022-10-06 16:42:41', 1, 'no'),
(2, 'Udahemuka', 'Aline', '19RP00891', 'nn@end.com2', '783982872', '$2y$10$ubmZNCdM0PorPESCn9amE.Uowji39thythz/oQpNtwiiNkyLRrXGK', 'ICT', '2019-2022', '2022-10-06 16:42:42', 1, 'yes'),
(3, 'NIREMBERE', 'Patrick', '19RP01300', 'niremberepatrick@gmail.com', '783982872', '$2y$10$GSAk2hNMv5Sgf0t.dMPqeuFN0OybiKUtOX8ycdmK9yRe4AOSFJ5gm', 'ICT', '2019-2022', '2022-10-06 16:42:42', 1, 'yes'),
(4, 'DUSHIMIRIMANA', 'Solange', '19RP01353', 'nn@end.com5', '783982872', '$2y$10$QaoLr4WNs6/VaT0d0Z4/8OSnwV81ZZ1OUgyN/YqVAKSm2FoleBixy', 'ICT', '2019-2022', '2022-10-06 16:42:42', 1, 'yes'),
(5, 'Mavubi', 'Marc', '19RP01469', 'nn@end.com6', '783982872', '$2y$10$ICyBXOk2oXpdrIhCH3YPa.tI4y7hqPtcvPma/WhqGqbZwmQdfiudG', 'ICT', '2019-2022', '2022-10-06 16:42:42', 1, 'no'),
(6, 'INGABIRE', 'Chantal', '19RP01778', 'nn@end.com7', '783982872', '$2y$10$S2wc1SP69SfpZ5tlQrRuPufN2vg3PWSFcGKnETr3XZqsnlCD3TFbq', 'ICT', '2019-2022', '2022-10-06 16:42:43', 1, 'yes'),
(7, 'UKUNDWANAYO', 'EGIDIA', '19RP02165', 'nn@end.com8', '783982872', '$2y$10$TECXU8IqSgoDzIgcVT9L6eCf1oPoQ2W/olmycaVYFo7F7U5vg1zXa', 'ICT', '2019-2022', '2022-10-06 16:42:43', 1, 'no'),
(8, 'Umuziranenge', 'Diane', '19RP02228', 'nn@end.com9', '783982872', '$2y$10$AiktUbNKsTwcY0SkE0J0quJMER/8YX99f6WKamBrtx9P8fqe3H8qC', 'ICT', '2019-2022', '2022-10-06 16:42:43', 1, 'no'),
(9, 'Dushime', 'William', '19RP02288', 'nn@end.com10', '783982872', '$2y$10$lcas7rNsVN6ESp4uGpdzzud.W4WN13acONkq0JPjf8jlZ.aWmhtwO', 'ICT', '2019-2022', '2022-10-06 16:42:43', 1, 'yes'),
(10, 'Mugisha', 'solange', '19RP02416', 'nn@end.com11', '783982872', '$2y$10$SgkIi5HpPzbOEQWHw1ti9uyQabJkbZ/x.csjhBzxVW6w.oYGOOo2O', 'ICT', '2019-2022', '2022-10-06 16:42:43', 1, 'no'),
(11, 'Muhoza', 'Fred', '19RP02424', 'nn@end.com12', '783982872', '$2y$10$LKY3RST2aYMxOGYyVUeaHeIUJELJG53HV2Lydk/3MatTx7lw/WLpa', 'ICT', '2019-2022', '2022-10-06 16:42:43', 1, 'yes'),
(12, 'UWUMUKIZA', 'Elyse', '19RP03283', 'nn@end.com13', '783982872', '$2y$10$tRkQAqOF6Zen9D6TpYfAGeOSPqzEpnRpVmVFB9p6SXxWXEZfrvXH6', 'ICT', '2019-2022', '2022-10-06 16:42:43', 1, 'yes'),
(13, 'Niyitegeka', 'Promesse', '19RP03329', 'nn@end.com14', '783982872', '$2y$10$vCetMx7HmJhGagtxgdSBt.zGvtNUI6OWg0LdC9mFJA1rAx659AhN6', 'ICT', '2019-2022', '2022-10-06 16:42:44', 1, 'no'),
(14, 'HAGENIMANA', 'Feston', '19RP03373', 'nn@end.com15', '783982872', '$2y$10$DL0mnBrTpNchjrZ6iUBRduh/tRDLUVWWMAN6fq7wIv2g4a51KNU3a', 'ICT', '2019-2022', '2022-10-06 16:42:44', 1, 'yes'),
(15, 'NIYIBIZI', 'SHALOOM', '19RP03508', 'nn@end.com16', '783982872', '$2y$10$Rwv4LOQrGUlHGohGKzlL/OVCjQnwEUvlTj/AEuL2XpRHvTsXcq24m', 'ICT', '2019-2022', '2022-10-06 16:42:44', 1, 'no'),
(16, 'Sibomana', 'Yvette', '19RP03570', 'nn@end.com17', '783982872', '$2y$10$q7IztZviO0KUOFhGAuIh/.KmPRyrdy4MW5VwqWw4MlkWgFPGrZH8q', 'ICT', '2019-2022', '2022-10-06 16:42:44', 1, 'no'),
(17, 'MUGISHA', 'BENITO CHRETIEN', '19RP04343', 'nn@end.com18', '783982872', '$2y$10$yKLPWbTiCYzeAaF0VXKDCOjCU07.fv5IblIXIo3s52iC5L.G/wH9K', 'ICT', '2019-2022', '2022-10-06 16:42:44', 1, 'no'),
(18, 'IGIHOZO', 'FELICITE', '19RP04511', 'nn@end.com19', '783982872', '$2y$10$xgydJzkDwgNEeQw8sRE7/eHh5udG0YJnr.zvFaC4yHDik7efkukwK', 'ICT', '2019-2022', '2022-10-06 16:42:44', 1, 'no'),
(19, 'HATEGEKIMANANA', 'Alphonse', '19RP05053', 'nn@end.com20', '783982872', '$2y$10$BNJB9Tw6uYl2Bq3fmUIRjOlrNoCb1f8u.zm.9yHNVGe3A0xyFHHua', 'ICT', '2019-2022', '2022-10-06 16:42:44', 1, 'no'),
(20, 'KIRABO', 'Caroline', '19RP05064', 'nn@end.com21', '783982872', '$2y$10$ViIODeK/Ppf/nkXg24ZBl.jQ4D7g332p21A.dwo0kt4koMkqr4ZRW', 'ICT', '2019-2022', '2022-10-06 16:42:44', 1, 'no'),
(21, 'MUNEZERO', 'Delice', '19RP06338', 'nn@end.com22', '783982872', '$2y$10$Hj6PDKUzVYXj7ZYXaCyYEejxaSEDSwUxrLB489oI/nKYekmY5JqZO', 'ICT', '2019-2022', '2022-10-06 16:42:45', 1, 'no'),
(22, 'NSHIMIYIMANA', 'ALEXIS', '19RP06347', 'nn@end.com23', '783982872', '$2y$10$8pk9UAp7Fa4OyQtDeEq0kud6ZdcB3BlWfVQdDj9II4O9FbRzXJp..', 'ICT', '2019-2022', '2022-10-06 16:42:45', 1, 'no'),
(23, 'NIYOYITA GATARE', 'Emmanuel', '19RP06749', 'nn@end.com24', '783982872', '$2y$10$s/YmOipxAJ8lhL.EbCOWd.ILnKyXVFRVLbD73kyiSFtGL0isrQ78C', 'ICT', '2019-2022', '2022-10-06 16:42:45', 1, 'no'),
(24, 'TUYISENGE', 'PASCASIE', '19RP07007', 'nn@end.com25', '783982872', '$2y$10$PhWxJGCq60AAMZFWKyNVBu8tpLjeGgP8j/licwMdgAb1OBrml4eze', 'ICT', '2019-2022', '2022-10-06 16:42:45', 1, 'no'),
(25, 'NISHIMWE', 'Josiane', '19RP07859', 'nn@end.com26', '783982872', '$2y$10$69Td8IRkzRCA68w0Enf2MeFDthO.JfAqfl9429Nvj2hS1cUIOiVJ6', 'ICT', '2019-2022', '2022-10-06 16:42:45', 1, 'no'),
(26, 'NGABO', 'PRINCE', '19RP07873', 'nn@end.com27', '783982872', '$2y$10$7M4RpTwr89ckJfuoYMQi9.NXis68DVbrsTxzx7eonT2SUduY5C/Cy', 'ICT', '2019-2022', '2022-10-06 16:42:45', 1, 'no'),
(27, 'SEKANYANA', 'Gilbert', '19RP07943', 'nn@end.com28', '783982872', '$2y$10$0tgLxCgmBDuRq04zNTR1quW2qSWNyI8BJ9EADPJmooI/PhNq8w/9i', 'ICT', '2019-2022', '2022-10-06 16:42:45', 1, 'no'),
(28, 'NDAYAMBAJE', 'Elie', '19RP08055', 'nn@end.com29', '783982872', '$2y$10$iVN7YmG93JKk5WpEJXz8jO83TL9ptaAbapwbsHiIdeU8WquTXsDvC', 'ICT', '2019-2022', '2022-10-06 16:42:46', 1, 'no'),
(29, 'SESONGA', 'Thadeo', '19RP08294', 'nn@end.com30', '783982872', '$2y$10$Fgz1ZtPpABpn.x6vgPiZTeHs9o/51c9cO6m3.5Hm3kp5AOaJN/65a', 'ICT', '2019-2022', '2022-10-06 16:42:46', 1, 'yes'),
(30, 'NALWANYIRI', 'Dorah', '19RP08366', 'nn@end.com31', '783982872', '$2y$10$3DYYupfeD2UKmAT94EcdaOQ7zuydJlXJo7DhWVrqBlxPKpbGO4dLa', 'ICT', '2019-2022', '2022-10-06 16:42:46', 1, 'no'),
(31, 'MANIRAGUHA', 'Emmanuel', '19RP08677', 'nn@end.com32', '783982872', '$2y$10$lpiwFy8QqIl7NuUeFJWRl.1J9cFd/Eep4jD3iu7fwZolzzZei6gkC', 'ICT', '2019-2022', '2022-10-06 16:42:46', 1, 'no'),
(32, 'AKIMANA', 'Olivier', '19RP09041', 'nn@end.com33', '783982872', '$2y$10$Kc4q6s2ZEl7uxsjr5WUAvubso6EZ6bKRi8X6KdWfAUIJY4BGVEACG', 'ICT', '2019-2022', '2022-10-06 16:42:47', 1, 'no'),
(33, 'Isingizwe', 'Divine', '19RP09140', 'nn@end.com34', '783982872', '$2y$10$uPOCh9O9n24/ODfF0OJ4xeAVIhAdgxXGY7/hWbKDGvzzCJY02iBA2', 'ICT', '2019-2022', '2022-10-06 16:42:47', 1, 'no'),
(34, 'SINDAMBIWE', 'MOUSSA', '19RP09163', 'nn@end.com35', '783982872', '$2y$10$35EcVpjUV/goOloPKs/Uz.vI9ugQAdXvG1hVUV8c31dfyHL5igP.W', 'ICT', '2019-2022', '2022-10-06 16:42:47', 1, 'no'),
(35, 'GAJU', 'Darlenne', '19RP09379', 'nn@end.com36', '783982872', '$2y$10$IpIqLq7Cojh9ybXlEyHW3O5vJscV2rBGDdtg7YuoQYCor3YEwCdTS', 'ICT', '2019-2022', '2022-10-06 16:42:47', 1, 'no'),
(36, 'NAHAYO', 'ARTHUR', '19RP09615', 'nn@end.com37', '783982872', '$2y$10$.zWYvdlx0ETdFCtwtOQj0updJyc3rNe9MjKegw0BN72sfORmwWCJu', 'ICT', '2019-2022', '2022-10-06 16:42:47', 1, 'no'),
(37, 'IRADUKUNDA', 'Egide', '19RP10585', 'nn@end.com38', '783982872', '$2y$10$qq8BlCAPBAbg85Iz2giKXOjKSPe.KuNPTe4xYKSDGfxRPuKNnJCX6', 'ICT', '2019-2022', '2022-10-06 16:42:47', 1, 'no'),
(38, 'Munyaneza', 'Jean Baptiste', '18RP03773', 'nn@end.com39', '783982872', '$2y$10$uXjjR5mg6CbMCmPDjBNF3.unrDCWAjMlWycQgKi6H.jawS.rCXFqW', 'ICT', '2019-2022', '2022-10-06 16:42:48', 1, 'yes'),
(39, 'Izabayo', 'Honorine', '18RP07135', 'nn@end.com40', '783982872', '$2y$10$OcPel64VO.6c0ju2HEld3ul2urnrj.vgWZIh8hiXh2iu303ARZ1tW', 'ICT', '2019-2022', '2022-10-06 16:42:48', 1, 'no'),
(40, 'NTIHANABAYO', 'JEANPAUL', '18RP03984', 'nn@end.com41', '783982872', '$2y$10$0EZPLHEwJQNUyNU961b74.pTQUdZpbdIvUu6Skl.sX2To2WHIPjHO', 'ICT', '2019-2022', '2022-10-06 16:42:48', 1, 'no'),
(41, 'Mucyo', 'Enock', '18RP00022', 'nn@end.com42', '783982872', '$2y$10$WKyu8CFqND/CxNE52iJV/e6srFaWvIjb1r9Q2p/rGP.Ebf9DwbDKm', 'ICT', '2019-2022', '2022-10-06 16:42:48', 1, 'no'),
(42, 'Bayisenge', 'Shaimat', '19RP00239', 'nn@end.com43', '783982872', '$2y$10$ct/Mg351DlbHq9GGxUGUCeMyLAdPdEuQxGNPDGSSebi/1wYEncOaS', 'ICT', '2019-2022', '2022-10-06 16:42:48', 1, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `uid` int(11) NOT NULL,
  `fname` varchar(80) NOT NULL,
  `lname` varchar(80) NOT NULL,
  `phoneNumber` varchar(18) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userType` varchar(12) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`uid`, `fname`, `lname`, `phoneNumber`, `email`, `password`, `userType`, `date`, `status`) VALUES
(1, 'enock', 'ndagijimana', '0783982872', 'ndagijimanaenock11@gmail.com', '$2y$10$IbSbjXoROOmSgDPSLcKxYOmrh3L2MJ9cX.m.jJr095ZClAMpkt1Gi', 'admin', '2022-09-17 08:05:33', 1),
(8, 'Blaise', 'YONKURU', '0783982872', 'yonkuru@gmail.com', '$2y$10$xmInoxrX953KDI7x9razvup5iwDgjtmE/ObCf3D/ptYJ6/6NcyLTW', 'super', '2022-10-06 13:41:19', 1),
(9, 'Anastase', 'MUVANDIMWE', '0783982811', 'muvandimwe@gmail.com', '$2y$10$nuUcvYwk6uRSS.sR6JeRdu9dcBNl0xX7vsNkqZr5MzPGRzECxFOSC', 'super', '2022-10-06 13:45:14', 1),
(10, 'Chantal', 'Ingabire', '0783982872', 'chantalinbabire44@gmail.com', '$2y$10$vPXx2vF1HjJuXKV50rCLl.VRKQ7y0azjPZ8XdunIgUldTFBdLRkl2', 'HOF', '2022-10-06 14:29:55', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcomment`
--
ALTER TABLE `tblcomment`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tblprojectcanvas`
--
ALTER TABLE `tblprojectcanvas`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_group`
--
ALTER TABLE `tbl_group`
  ADD PRIMARY KEY (`gid`),
  ADD KEY `studentOne` (`studentOne`),
  ADD KEY `studentTwo` (`studentTwo`),
  ADD KEY `superVisorID` (`superVisorID`);

--
-- Indexes for table `tbl_group_supervisor`
--
ALTER TABLE `tbl_group_supervisor`
  ADD PRIMARY KEY (`gs_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `supervisor_id` (`supervisor_id`);

--
-- Indexes for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `tbl_projectbook`
--
ALTER TABLE `tbl_projectbook`
  ADD PRIMARY KEY (`proID`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`sID`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcomment`
--
ALTER TABLE `tblcomment`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblprojectcanvas`
--
ALTER TABLE `tblprojectcanvas`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_group`
--
ALTER TABLE `tbl_group`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_group_supervisor`
--
ALTER TABLE `tbl_group_supervisor`
  MODIFY `gs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_projectbook`
--
ALTER TABLE `tbl_projectbook`
  MODIFY `proID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `sID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_group`
--
ALTER TABLE `tbl_group`
  ADD CONSTRAINT `tbl_group_ibfk_1` FOREIGN KEY (`studentOne`) REFERENCES `tbl_students` (`sID`),
  ADD CONSTRAINT `tbl_group_ibfk_2` FOREIGN KEY (`studentTwo`) REFERENCES `tbl_students` (`sID`),
  ADD CONSTRAINT `tbl_group_ibfk_3` FOREIGN KEY (`superVisorID`) REFERENCES `tbl_users` (`uid`);

--
-- Constraints for table `tbl_group_supervisor`
--
ALTER TABLE `tbl_group_supervisor`
  ADD CONSTRAINT `tbl_group_supervisor_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `tbl_group` (`gid`),
  ADD CONSTRAINT `tbl_group_supervisor_ibfk_2` FOREIGN KEY (`supervisor_id`) REFERENCES `tbl_users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
