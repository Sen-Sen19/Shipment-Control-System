-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2023 at 01:18 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_template`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_exercise`
--

CREATE TABLE `t_exercise` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_exercise`
--

INSERT INTO `t_exercise` (`id`, `name`, `details`, `date_updated`) VALUES
(1, 'HTML', 'This markup tells a web browser how to display text, images and other forms of multimedia on a webpage.', '2023-08-01 09:07:18'),
(2, 'CSS', 'CSS is the acronym of “Cascading Style Sheets”. CSS is a computer language for laying out and structuring web pages (HTML or XML).', '2023-08-01 09:07:18'),
(3, 'JavaScript', 'It allows you to implement dynamic features on web pages that cannot be done with only HTML and CSS.', '2023-08-01 09:08:36'),
(4, 'PHP', 'widely-used open source general-purpose scripting language that is especially suited for web.', '2023-08-01 09:08:36'),
(5, 'SQL', 'a standard language for database creation and manipulation.', '2023-08-01 09:09:17');

-- --------------------------------------------------------

--
-- Table structure for table `t_t1`
--

CREATE TABLE `t_t1` (
  `id` int(10) UNSIGNED NOT NULL,
  `c1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_t1`
--

INSERT INTO `t_t1` (`id`, `c1`, `c2`, `c3`, `c4`, `date_updated`) VALUES
(1, 'r1', 'abc', 'def', 'ghi', '2023-10-18 12:47:18'),
(2, 'r2', 'jkl', 'mno', 'pqr', '2023-10-18 12:47:18'),
(3, 'r3', 'stu', 'vwx', 'yz1', '2023-10-18 12:47:18'),
(4, 'r4', '234', '567', '890', '2023-10-18 12:47:18');

-- --------------------------------------------------------

--
-- Table structure for table `t_t2`
--

CREATE TABLE `t_t2` (
  `id` int(10) UNSIGNED NOT NULL,
  `c1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `d1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `d2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `d3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_t2`
--

INSERT INTO `t_t2` (`id`, `c1`, `d1`, `d2`, `d3`, `date_updated`) VALUES
(1, 'r1', 'abc', 'def', 'ghi', '2023-10-18 12:49:11'),
(2, 'r1', 'jkl', 'mno', 'pqr', '2023-10-18 12:49:11'),
(3, 'r1', 'stu', 'vwx', 'yz1', '2023-10-18 12:49:11'),
(4, 'r4', '234', '567', '890', '2023-10-18 12:49:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(50) NOT NULL,
  `id_number` varchar(20) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `id_number`, `full_name`, `username`, `password`, `section`, `role`) VALUES
(1, 'N/A', 'ADMIN', 'admin', 'admin', 'General Affairs', 'admin'),
(3, ' 23-09803', 'JESSICA FAMILARAN', 'PDC_CLERK', 'PDC_CLERK', 'PDC', 'user'),
(4, '13-0317 ', 'Joanna Marie Carreon', 'Joancarreon', 'NFjoan2023', 'NF', 'user'),
(5, 'BF-48279', 'MARY JOYCE BARTOLOME', 'MJ BARTOLOME', 'MPD48279', 'MP', 'user'),
(6, 'MWM-00017959', 'MARY ROSE MORES', 'MR MORES', 'MPD17959', 'MP', 'user'),
(7, '17-03178', 'CATHERINE RAMOS', 'CATHERINERAMOS', 'MPD03178', 'MP', 'user'),
(8, '22-08336', 'Melody', 'Safety', 'Safety@2023', 'SAFETY', 'user'),
(9, '21-06234', 'Sumagui, Michelle Jane R.', 'EQD', 'CHENGOT', 'EQD', 'user'),
(10, '17-03137', 'Gay Marasigan', 'Gay', 'gabriella', 'IT', 'user'),
(11, ' 22-08055', 'Joselle Rose Velecina', '22-08055', 'Acc0unting', 'Accounting', 'user'),
(12, '15-02613', 'Juliet H. Masarap', 'QMJULIET', '15-02613', 'QM', 'user'),
(13, '21-06254', 'Cristel Mae J. Aguarin', '21-06254', 'PPG@2023', 'PPG', 'user'),
(14, '22-07915', 'Rea O. Briones', '22-07915', 'FGI@2023', 'PPG', 'user'),
(15, '21-06691', 'Genie Rose B. Liwanag', '21-06691', '21-06691', 'PPG', 'user'),
(16, '22-09248', 'Renabel N. Casilang', '22-09248', '22-09248', 'PPG', 'user'),
(17, '21-06344', 'Vanessa M. Lopez', '21-06344', '21-06344', 'PPG', 'user'),
(18, '21-07102', 'Leonellaine B. Garcia', 'HRSAS01', 'Elaine2107102', 'HR', 'user'),
(19, '22-07632', 'Emily L. Eresima', 'HRSAS02', 'Ems2207632', 'HR', 'user'),
(20, '22-07607', 'JEMARIE TRINIDAD', '22-07607', '22-07607', 'FG', 'user'),
(21, '20-05737', 'ANJEANETTE ATASAN', '20-05737', '20-05737', 'FG', 'user'),
(22, 'N/A', 'GA-Clerk-DS', 'GA-DS', 'DAYSHIFT', 'General Affairs', 'user'),
(23, 'N/A', 'GA-Clerk-NS', 'GA-NS', 'NIGHTSHIFT', 'General Affairs', 'user'),
(24, '14-02065', 'VALENCIA, LORNA', '14-02065', '14-02065', 'MM', 'user'),
(25, '21-06323', 'GATCHALIAN, JESSA ', '21-06323', '21-06323', 'MM', 'user'),
(26, '13-0821', 'DINGLASAN, GJOANA ', '13-0821', '13-0821', 'MM', 'user'),
(27, ' 22-08839', 'Uranza, Lani Diaz ', '22-08839', 'QAclerk', 'QA', 'user'),
(28, '22-08696', 'Ausa, Ivy Diaz', '22-08696', 'QAclerk', 'QA', 'user'),
(29, '23-09876', 'WELL,SANDIE R.', '23-09876', '23-09876', 'IMPEX', 'user'),
(30, '22-09338', 'MOICO,NICO C.', '22-09338', 'IMPEX123', 'IMPEX', 'user'),
(31, '22-07601', 'Ann Lorraine V. Luzano', '22-07601', 'PEC&C', 'PEC&C', 'user'),
(32, '14-02410', 'SAN JUAN, RUBIELYN', 'PC-D', '14-02410', 'PMD-PC', 'user'),
(33, '14-02410', 'SAN JUAN, RUBIELYN', 'PC-N', '14-02410', 'PMD-PC', 'user'),
(34, '19-05168', 'De Chavez, Arrissa V.', 'RTS', 'AVDC', 'RTS', 'user'),
(35, '13-0205', 'Asis, Monica C.', 'PTT', 'BTS', 'RTS', 'user'),
(36, '18-04342', 'Jennifer Falcon', 'JFalcon', '1804342', 'PE-MPPD', 'user'),
(37, '21-06371', 'Permejo, Michelle', 'Michelle', '2106371', 'Section 1', 'user'),
(38, '17-03465', 'Policarpio, Bona B.', 'Bona', '1703465', 'Section 1', 'user'),
(39, '22-07875', 'Semilla, Mary Dian Manio', 'Dian', '2207875', 'Section 1', 'user'),
(40, '21_PK53587', 'Canoy, Mae Ann Serna', 'Mae Ann', '21PK53587', 'Section 1', 'user'),
(41, '13-00888', 'Barunia, Rachelle L.', 'Rachelle', '1300888', 'Section 2', 'user'),
(42, '22-07807', 'Casabuena, Princess Daivie P.', 'Daivie', '2207807', 'Section 2', 'user'),
(43, '14-01884', 'Dimapasok, Mary Joy A.', 'Mary Joy', '1401884', 'Section 3', 'user'),
(44, '15-02532', 'Escalona, Sharon A.', 'Sharon', '1502532', 'Section 3', 'user'),
(45, '23-09663', 'Caraan, Esther Grace Contreras', 'Esther', '2309663', 'Section 3', 'user'),
(46, 'Section 4', 'Almanzor, May Mercado', 'May', '2309433', 'Section 4', 'user'),
(47, '21_PK53858', 'Binauhan, Raquel M.', 'Raquel', '21PK53858', 'Section 4', 'user'),
(48, '22_PK64004', 'Catalla, Crisha Mae Pornobi', 'Crisha', '22PK64004', 'Section 4', 'user'),
(49, '20-05771', 'Manalo, Sharmaine G.', 'Sharmaine', '2005771', 'Section 5', 'user'),
(50, '19-05333', 'Villa, Ma. Fe. Elizabeth A.', 'Faye', '1905333', 'Section 5', 'user'),
(51, '22-08009', 'Delos Reyes, Daisa M.', 'Daisa', '2208009', 'Section 6', 'user'),
(52, '21-05970', 'Ramos, Joy D.', 'Joy', '2105970', 'Section 6', 'user'),
(53, '22-08369', 'Asilo, Megan Jaen', 'Meagan', '2208369', 'Section 6', 'user'),
(54, 'EN69-6601', 'Balmaceda, Renalyn', 'Renalyn', 'EN696601', 'Section 6', 'user'),
(55, '22-09200', 'Almonares, Mark Joel S.', 'Marky', '2209200', 'Section 7', 'user'),
(56, '13-0818', 'Viola, Karen L.', 'Karen', '130818', 'Section 7', 'user'),
(57, '21_PK51575', 'Calalo, John Patrick', 'Patrick', '21PK51575', 'Section 7', 'user'),
(58, '22_PK57323', 'Paz, Rogelyn V.', 'Rogelyn', '22PK57323', 'Section 7', 'user'),
(59, 'EN69-5998', 'Carandang, Ronnel M.', 'Ronnel', 'EN695998', 'Section 8', 'user'),
(60, '22_PK61728', 'Matriz, Kuenie Chin M.', 'Kuenie', '22PK61728', 'Section 8', 'user'),
(61, '14-01113', 'Berongoy, Maria Noime C.', 'Noime', '1401113', 'Section 8', 'user'),
(62, '23-09677', 'Fanoga, Chrissie Joyce F.', 'Chrissie', '2309677', 'Section 8', 'user'),
(63, '17-03276', 'Valencia, Princess C.', 'Princess', '1703276', 'Section 4', 'user'),
(64, '22-09407', 'Geron,Princess Shella L.', '22-09407', 'Partslist.01', 'PE-AME', 'user'),
(65, '13-0510', 'Alcantara, Edgar D.', '13-0510', '13-0510', 'PE-AME', 'user'),
(66, '22-08211', 'Servidad,Kim Aldrich ', '22-08211', '22-08211', 'PE-AME', 'user'),
(67, 'N/A', 'MAXIM', 'MAXIM', 'MAXIM', 'MAXIM', 'user'),
(68, 'N/A', 'ONESOURCE', 'ONESOURCE', 'ONESOURCE', 'ONESOURCE', 'user'),
(69, 'N/A', 'PKIMT', 'PKIMT', 'PKIMT', 'PKIMT', 'user'),
(70, 'N/A', 'MEGATREND', 'MEGATREND', 'MEGATREND', 'MEGATREND', 'user'),
(71, 'N/A', 'ADDEVEN', 'ADDEVEN', 'ADDEVEN', 'ADDEVEN', 'user'),
(72, 'N/A', 'GOLDENHAND', 'GOLDENHAND', 'GOLDENHAND', 'GOLDENHAND', 'user'),
(73, 'N/A', 'GUARD', 'GUARD', 'GUARD', 'ARAGON', 'user'),
(74, '15-02782', 'Gutierrez,Maricar V.', '15-02782', '15-02782', 'IT', 'user'),
(75, '15-02839', 'Mitra, Renelyn R.', '15-02839', '15-02839', 'IT', 'user'),
(76, '17-03219', 'Manalo, Mary Grace M.', '17-03219', '17-03219', 'IT', 'user'),
(77, '20-05704', 'Mahinay,Lonriel Y.', '20-05704', '20-05704', 'IT', 'user'),
(78, '21-06733', 'Cena, Emanuel John R.', '21-06733', '21-06733', 'IT', 'user'),
(79, '21-06814', 'Sauro, Jhon Paulo M.', '21-06814', '21-06814', 'IT', 'user'),
(80, '21-06993', 'Ballesteros, John Denver B.', '21-06993', '21-06993', 'IT', 'user'),
(81, ' 23-09801', 'Verna C. Faclarin', '23-09801', 'QCclerk2023', 'QC', 'user'),
(82, '22-08675', 'USER', 'user', 'user', 'IT', 'user'),
(83, 'N/A', 'USER1', 'user1', 'user1', 'IT', 'user'),
(84, 'N/A', 'USER2', 'user2', 'user2', 'IT', 'user'),
(85, 'N/A', 'USER3', 'user3', 'user3', 'IT', 'user'),
(86, 'N/A', 'USER4', 'user4', 'user4', 'IT', 'user'),
(87, 'N/A', 'USER5', 'user5', 'user5', 'IT', 'user'),
(88, 'N/A', 'user7', 'user7', 'user7', 'IT', 'user'),
(89, 'N/A', 'user8', 'user8', 'user8', 'IT', 'user'),
(91, 'n1', 'v1', 'v1', 'v1', 'IT', 'user'),
(92, 'n2', 'v2', 'v2', 'v2', 'IT', 'user'),
(93, 'n3', 'v3', 'v3', 'v3', 'IT', 'user'),
(94, 'n4', 'v4', 'v4', 'v4', 'IT', 'user'),
(95, 'n5', 'v5', 'v5', 'v5', 'IT', 'user'),
(96, 'n6', 'v6', 'v6', 'v6', 'IT', 'user'),
(97, 'n7', 'v7', 'v7', 'v7', 'IT', 'user'),
(98, 'n8', 'v8', 'v8', 'v8', 'IT', 'user'),
(99, 'n9', 'v9', 'v9', 'v9', 'IT', 'user'),
(100, 'n10', 'v10', 'v10', 'v10', 'IT', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_exercise`
--
ALTER TABLE `t_exercise`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `t_t1`
--
ALTER TABLE `t_t1`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `c1` (`c1`);

--
-- Indexes for table `t_t2`
--
ALTER TABLE `t_t2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_exercise`
--
ALTER TABLE `t_exercise`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_t1`
--
ALTER TABLE `t_t1`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_t2`
--
ALTER TABLE `t_t2`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
