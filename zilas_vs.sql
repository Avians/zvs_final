-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 27, 2016 at 06:44 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zilas_vs`
--

-- --------------------------------------------------------

--
-- Table structure for table `zvs_application_users`
--

CREATE TABLE `zvs_application_users` (
  `id` int(11) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `identificationCode` varchar(240) NOT NULL,
  `userStatus` tinyint(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_application_users`
--

INSERT INTO `zvs_application_users` (`id`, `email`, `password`, `identificationCode`, `userStatus`) VALUES
(1, 'zvs.super.admin@zilasvirtualschools.com', '-Ehl7B6z-kmxchfs5X0J9syfbjr5U3HOEs_ZGemaD5w', 'pSoaHX1j8XXb2diMDomSijvRhBm6bxybcBWAbm6KL-mtWlM0NHJJdIXj6sxsi4NWMsv34U7kuRjGb3fd9rPlDMw_RESDtvMpAfdTYg23vR_7rylRfEqSABHs29kz0IxS', 1),
(2, 'zvs.platform.admin@zilasvirtualschools.com', '-Ehl7B6z-kmxchfs5X0J9syfbjr5U3HOEs_ZGemaD5w', 'YwfPDAkaDbBBuNbYAHfR8030FKTxS2GuxQ8uKKThnfbiDl4uFwZHOU-hRZzth9RM42ZewiPLLSyjliRIUZq9Cm_KW7hQeCNX5bW0ZQmxug5hV8F5VI6XiaCLcPiyYJRe', 1),
(3, 'mathew@kangaschool.ac.ke', '-Ehl7B6z-kmxchfs5X0J9syfbjr5U3HOEs_ZGemaD5w', 'VNb7FU5Q1KcTbMBNFGWDBBuoW5bYlrBQ1jdxDpTZHmxqxHdJcPKmR122yD7LLzKT_8O9ezn61fpjMX00tqh9d-Proh5vZbJddzXuk6WASb4BQ0p0Bifd3NDxGdWUSZoq', 1),
(4, 'mathew@masenoschool.ac.ke', '-Ehl7B6z-kmxchfs5X0J9syfbjr5U3HOEs_ZGemaD5w', 'ARiPxSbwlrH-jfJlyruRZkkvQYqnEVf1FUqZZlTMKb-U43O2LrqHwwm54trM2o7z0uzsF4UPPhwWc6f8GY8-ReProh5vZbJddzXuk6WASb4BQ0p0Bifd3NDxGdWUSZoq', 1),
(5, 'jane@stflorence.ac.ke', '-Ehl7B6z-kmxchfs5X0J9syfbjr5U3HOEs_ZGemaD5w', 'hMPmq4RdF-0qwPfQNF9vM8Vjh0OGCQ2BtqQ5bNc099C7ZjyMlN3nB8iuqzah0nvqcq7nqj8JA2uxH_NRqQsm2c1luUIQsEIsluSRL8xVcB47m9JS6ZfXeExKoM_DoPxF', 0),
(6, 'kore@kisumupoly.ac.ke', '-Ehl7B6z-kmxchfs5X0J9syfbjr5U3HOEs_ZGemaD5w', 'wiKJk7ArVzYn2WOZUH07zgUj0J7E0z-ycHYz3dA06leTpM2SENzC8dBmfhOjV_g0ItEC1mf4c2QnZnOZs50xKNgE1JO73X3pl1KOPQ1xAASrrDDFnHfUTmWzNB5_n5Hu', 0),
(7, 'athiasavians@gmail.com', '-Ehl7B6z-kmxchfs5X0J9syfbjr5U3HOEs_ZGemaD5w', '-B8SXuuBHzlhkuoFkxWLsh21XcsB5XCazm2sChuJZnGqKD6lrzLxIj4qrUFkd5LcGNOjRAflqjzp2daSmHbaOeProh5vZbJddzXuk6WASb4BQ0p0Bifd3NDxGdWUSZoq', 1),
(8, 'frida@zilasvirtualschools.com', '9xwQaWODCuoOASrkWUKzKTTLEH-XthPCIMqH_oiipwY', 'pSoaHX1j8XXb2diMDomSijvRhBm6bxybcBWAbm6KL-mKnf601gVVsnjNPfnt5wclTlXDRp78mC6Y69_jWauJjagrwdqBkdLh9RvqvMF8O3_9G2EJloD2wNVgUddYWyLw', 1),
(9, 'liz@pangani.ac.ke', '-Ehl7B6z-kmxchfs5X0J9syfbjr5U3HOEs_ZGemaD5w', 'Ujtzm2mvPdc_9TvTJK7Xj0q7uQW68YotqQJt4BjFJ26dDam-gc_dprXCAxPYR1725xxw_hz8RFK4WpGLC5Fav45ejoXQ9pqeBItL2ZyXjq1I-p90244FXFQ-6Klwlf6X', 1),
(10, 'principal@kangaschool.ac.ke', '-Ehl7B6z-kmxchfs5X0J9syfbjr5U3HOEs_ZGemaD5w', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(11, 'elvis@migtech.co.ke', 'FbCzkk2c9C-_e5VO8EM4amH_hpi5CRKpz3z-PbMkSe0', 'Gx09RceJmKjyZXazBudPOO_0lmmHibkZqheh3XE3xNFHCgacBK7zIJNL_36pylAiliQ3UT2L5Q5O7rF-xHE6AbE3vObQAP46tnDEhUvPg7RWXr8zOy5f2AvMTXf0Kuow', 1),
(12, 'bursar@kangaschool.ac.ke', '-Ehl7B6z-kmxchfs5X0J9syfbjr5U3HOEs_ZGemaD5w', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKyw-N5NqEiU3LcvotPg2TBx6_zGrL-XOE_QiZHy6f3lhuZLHGyrtbRyJjrRU18pIybtpLOc66TIhTUzYuMTAXj0', 1),
(13, 'tonyiha@gmail.com', '-Ehl7B6z-kmxchfs5X0J9syfbjr5U3HOEs_ZGemaD5w', '-VTXy54DNq-q9DS5pIYdP0a_4HiLKYH8cec11LCh3l539WT6-ZP62JtpkOG7D3hkKhtTPomkzaVP0W7Y5ZvbKosxff2L7bWm6xqr2QZKvAaLG-0K3_HnKn8Bx1oKGOxh', 1),
(14, 'athias@kangaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'e6mAOGO__zw3LClVBU0ne-9apgJVhiOFCsQVUW856CUzLsZ1SIP3jYbQqsy4O5nuWxt14oO7FK6nEVfHXEJZ3S3LQ4PJY1qawziESx1Lh6cv-FAKY8W-7uEjcFz2PUAz', 1),
(15, 'george@kangaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'e6mAOGO__zw3LClVBU0ne-9apgJVhiOFCsQVUW856CVdVRlHEsWYSlQIBHExsOyZ-_QMe4fIznNN-yToz2EmBMfJ0qbn1tpjv9MKIc3DbmV2f42fAVAQSowDIb_FOw6P', 1),
(16, 'regan@kangaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', '3avG_MewSyIwuMTE3n0dTf3c8IQ2VyuyOP8a6C8sX7p171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ19tlmK8AtLL13CxFHJo3ecqxgTNonZMCoiN0Q7HWHjF', 1),
(17, 'wasabi@kangaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', '3avG_MewSyIwuMTE3n0dTf3c8IQ2VyuyOP8a6C8sX7rLptgW3USq1nyAawK6NhLkbZ3F2gtQR3jio4F9Vc_tHn5Ax4_kg8i6AOBKaVZHAA0huUG_TndqdI59uNQwbWXy', 1),
(18, 'frida@kangaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', '2gL1f93cu0uUa-rb_GvQRihjbrz9ixEm2zLsVxEaaAtxUvUuKrCzbRCOIa_tYsk7U671GMtmTMwUQEpdbcGKsrPLY3bjvkHNjvwN4-1HAlYdzjudhvKjVCOVXYYZ5D-2', 1),
(19, 'george3@kangaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'vdEWiFSBc93Ntq7Eicl1WcARo52lypUga60kcbygnMLLptgW3USq1nyAawK6NhLkbZ3F2gtQR3jio4F9Vc_tHn5Ax4_kg8i6AOBKaVZHAA0huUG_TndqdI59uNQwbWXy', 1),
(20, 'gendi@kangaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'e6mAOGO__zw3LClVBU0ne-9apgJVhiOFCsQVUW856CUzLsZ1SIP3jYbQqsy4O5nuWxt14oO7FK6nEVfHXEJZ3VQGCmTny9he1NaH7w6cxxtngI3nwmnjCbvwIulppdZc', 1),
(21, 'abongo@kangaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'e6mAOGO__zw3LClVBU0ne-9apgJVhiOFCsQVUW856CVdVRlHEsWYSlQIBHExsOyZ-_QMe4fIznNN-yToz2EmBNGDsRD7mIhsz3rxGiSG_j4weNLHBqcMHW27UfIekYLI', 1),
(22, 'jane@gmail.com', 'g04VBsMIYHPrCybCW0DGqH2XoUcDIRi-rLJKWenyjmY', 'Y6U6uC21UebV5s3jkxnCc0t6h6qnRwGOpkmrjyExNCVmtFmACh_e7m7uyPdkM2qRf-VsWEg_OdqI9p811H2wim_NXt-bINsOYGqv4omZ1hrUAi_P8K-o8jz9GFuPQizL', 1),
(23, 'emily@gmail.com', 'g04VBsMIYHPrCybCW0DGqH2XoUcDIRi-rLJKWenyjmY', 'UASfVHRTsCrz1l_I05OHDPmVo6-VF7QgvstaWawIjjFmtFmACh_e7m7uyPdkM2qRf-VsWEg_OdqI9p811H2wim_NXt-bINsOYGqv4omZ1hrUAi_P8K-o8jz9GFuPQizL', 1),
(24, 'athiasz@kangaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'WK-ETLGgAtaCzA1FfF_qODOsYf9MPqfQ-ot-Qn5xYiB171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ3dMsvGmbdMbIylFd4zV3q0ZLAF722IHGHhhUBXp7AZs', 1),
(25, 'georgez@kangaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'WK-ETLGgAtaCzA1FfF_qODOsYf9MPqfQ-ot-Qn5xYiDLptgW3USq1nyAawK6NhLkbZ3F2gtQR3jio4F9Vc_tHpKXn_q2g79_jsVFCcmeo9zDX3eM9sFB1n6Q6gLG7lMJ', 1),
(26, 'athiasy@kangaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', '3avG_MewSyIwuMTE3n0dTf3c8IQ2VyuyOP8a6C8sX7p171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ-9Yi1Y4lCHQ5srGrjKzAbJlVC7m-WTjkhCjrnTXVxBc', 1),
(27, 'georgey@kangaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'WK-ETLGgAtaCzA1FfF_qODOsYf9MPqfQ-ot-Qn5xYiDLptgW3USq1nyAawK6NhLkbZ3F2gtQR3jio4F9Vc_tHjisfGu_0jxC_jY3LqLpvkrUEoXCnRwl3yujWJpYGFri', 1),
(28, 'athiasw@kangaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'llyTLza9apoL_qsV-vP9IvkgLDkkNjQRb9cvImeLT7spRVR3wIe6QOol45Jjyl2kzuvH5j93aNBwowCJ6fpHsa3B_HWE9Xg-l3y2Be7rOemZJ4Cdpi-flQFaf1hUU2Wa', 1),
(29, 'georgew@kangaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'llyTLza9apoL_qsV-vP9IvkgLDkkNjQRb9cvImeLT7t171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ3J5rVfM5NtUlWazKtyiB5iznyOLNlCqenWcINCwlotC', 1),
(30, 'athiasu@kangaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'llyTLza9apoL_qsV-vP9IvkgLDkkNjQRb9cvImeLT7t171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ0-MfGSmjwuJdlXlzrovGBdaI34izYg3ejGmlNHsSTxN', 1),
(31, 'georgeu@kangaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'WK-ETLGgAtaCzA1FfF_qODOsYf9MPqfQ-ot-Qn5xYiDLptgW3USq1nyAawK6NhLkbZ3F2gtQR3jio4F9Vc_tHvKp0x7WhgAx_2YvQpAjYnAI42kjgetfU8E4I2VILFGV', 1),
(32, 'athiasj@kangaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'BUVjLKjR2-gwMwQm8VDvfR6pe6hq4MLhEj5m4jUnJTl171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ4_xVsS9h17dszG8TkgI1pp8fM2o5EFSxDRJyixzVf9J', 1),
(33, 'georgej@kangaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'BUVjLKjR2-gwMwQm8VDvfR6pe6hq4MLhEj5m4jUnJTnLptgW3USq1nyAawK6NhLkbZ3F2gtQR3jio4F9Vc_tHosxff2L7bWm6xqr2QZKvAaLG-0K3_HnKn8Bx1oKGOxh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_blood_groups`
--

CREATE TABLE `zvs_blood_groups` (
  `id` int(11) NOT NULL,
  `bloodGroupCode` varchar(60) NOT NULL,
  `bloodGroupName` varchar(60) NOT NULL,
  `bloodGroupStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_blood_groups`
--

INSERT INTO `zvs_blood_groups` (`id`, `bloodGroupCode`, `bloodGroupName`, `bloodGroupStatus`) VALUES
(1, 'AB+', 'AB + (Positive)', 1),
(2, 'AB-', 'AB - (Negative)', 1),
(3, 'A+', 'A + (Positive)', 1),
(4, 'A-', 'A - (Negative)', 1),
(5, 'B+', 'B + (Positive)', 1),
(6, 'B-', 'B - (Negative)', 1),
(7, 'O+', 'O + (Positive)', 1),
(8, 'O-', 'O - (Negative)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_class_school_fees`
--

CREATE TABLE `zvs_class_school_fees` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(200) NOT NULL,
  `schoolClassCode` varchar(200) NOT NULL,
  `systemFeeCode` varchar(240) NOT NULL,
  `feeItem` varchar(30) NOT NULL,
  `itemAlias` varchar(30) NOT NULL,
  `itemAmount` decimal(10,0) NOT NULL,
  `feeItemYear` varchar(5) NOT NULL,
  `itemStatus` tinyint(1) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_class_school_fees`
--

INSERT INTO `zvs_class_school_fees` (`id`, `systemSchoolCode`, `schoolClassCode`, `systemFeeCode`, `feeItem`, `itemAlias`, `itemAmount`, `feeItemYear`, `itemStatus`, `dateCreated`) VALUES
(1, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormFour', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Tuition[`^`]2017', 'Tuition', 'Tuition', '2392', '2017', 1, '2016-10-23'),
(2, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormFour', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]LTT[`^`]2017', 'LT & T', 'LT & T', '1621', '2017', 1, '2016-10-23'),
(3, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormFour', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]AdmissionCost[`^`]2017', 'Admission Cost', 'ADM Cost', '2516', '2017', 1, '2016-10-23'),
(4, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormFour', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]EWC[`^`]2017', 'EWC', 'EWC', '6302', '2017', 1, '2016-10-23'),
(5, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormFour', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Activity[`^`]2017', 'Activity', 'Activity', '798', '2017', 1, '2016-10-23'),
(6, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormFour', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]P/Emoluments[`^`]2017', 'P/Emoluments', 'P/Emoluments', '5972', '2017', 0, '2016-10-23'),
(7, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormFour', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Insurance[`^`]2017', 'Insurance', 'Insurance', '1060', '2017', 1, '2016-10-23'),
(8, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormFour', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Boarding[`^`]2017', 'Boarding', 'Boarding', '32385', '2017', 1, '2016-10-23');

-- --------------------------------------------------------

--
-- Table structure for table `zvs_general_school_fees`
--

CREATE TABLE `zvs_general_school_fees` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(200) NOT NULL,
  `systemFeeCode` varchar(240) NOT NULL,
  `feeItem` varchar(30) NOT NULL,
  `itemAlias` varchar(30) NOT NULL,
  `itemAmount` decimal(10,0) NOT NULL,
  `feeItemYear` varchar(5) NOT NULL,
  `itemStatus` tinyint(1) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_general_school_fees`
--

INSERT INTO `zvs_general_school_fees` (`id`, `systemSchoolCode`, `systemFeeCode`, `feeItem`, `itemAlias`, `itemAmount`, `feeItemYear`, `itemStatus`, `dateCreated`) VALUES
(1, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Medical[`^`]2017', 'Medical', 'Medical', '508', '2017', 0, '2016-10-23');

-- --------------------------------------------------------

--
-- Table structure for table `zvs_platform_admin`
--

CREATE TABLE `zvs_platform_admin` (
  `id` int(11) NOT NULL,
  `identificationCode` varchar(200) NOT NULL,
  `idNumber` varchar(45) NOT NULL,
  `designation` varchar(15) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `middleName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) NOT NULL,
  `mobileNumber` varchar(15) NOT NULL,
  `boxAddress` varchar(60) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `country` varchar(11) NOT NULL,
  `locality` varchar(11) NOT NULL,
  `imagePath` varchar(300) DEFAULT NULL,
  `dateCreated` date NOT NULL,
  `timeCreated` time NOT NULL,
  `dateModified` date DEFAULT NULL,
  `timeModified` time DEFAULT NULL,
  `createdBy` varchar(200) NOT NULL,
  `userStatus` tinyint(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_platform_admin`
--

INSERT INTO `zvs_platform_admin` (`id`, `identificationCode`, `idNumber`, `designation`, `firstName`, `middleName`, `lastName`, `mobileNumber`, `boxAddress`, `gender`, `country`, `locality`, `imagePath`, `dateCreated`, `timeCreated`, `dateModified`, `timeModified`, `createdBy`, `userStatus`) VALUES
(1, 'YwfPDAkaDbBBuNbYAHfR8030FKTxS2GuxQ8uKKThnfbiDl4uFwZHOU-hRZzth9RM42ZewiPLLSyjliRIUZq9Cm_KW7hQeCNX5bW0ZQmxug5hV8F5VI6XiaCLcPiyYJRe', 'ZVS_PA_25138058', 'Mr.', 'James', 'Makau', 'Mweu', '0725830529', 'P.O Box 73619 - Nairobi', 'Male', '+254', '+30', NULL, '2015-08-18', '06:17:24', NULL, NULL, 'pSoaHX1j8XXb2diMDomSijvRhBm6bxybcBWAbm6KL-mtWlM0NHJJdIXj6sxsi4NWMsv34U7kuRjGb3fd9rPlDMw_RESDtvMpAfdTYg23vR_7rylRfEqSABHs29kz0IxS', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_platform_designations`
--

CREATE TABLE `zvs_platform_designations` (
  `id` int(100) NOT NULL,
  `designationCode` varchar(15) NOT NULL,
  `designationName` varchar(15) NOT NULL,
  `designationStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_platform_designations`
--

INSERT INTO `zvs_platform_designations` (`id`, `designationCode`, `designationName`, `designationStatus`) VALUES
(1, 'Dr', 'Dr', 1),
(2, 'Mr', 'Mr', 1),
(3, 'Mrs', 'Mrs', 1),
(4, 'Miss', 'Miss', 1),
(5, 'Ms', 'Ms', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_platform_guardians`
--

CREATE TABLE `zvs_platform_guardians` (
  `id` int(11) NOT NULL,
  `guardianCode` varchar(60) NOT NULL,
  `guardianName` varchar(60) NOT NULL,
  `guardianStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_platform_guardians`
--

INSERT INTO `zvs_platform_guardians` (`id`, `guardianCode`, `guardianName`, `guardianStatus`) VALUES
(1, 'Parent', 'Parent', 1),
(2, 'Adoptive Parent', 'Adoptive Parent', 1),
(3, 'Grandparent', 'Grandparent', 1),
(4, 'Uncle or Aunt', 'Uncle/Aunt', 1),
(5, 'Cousin', 'Cousin', 1),
(6, 'Nephew or Niece', 'Nephew/Niece', 1),
(7, 'Sponsor', 'Sponsor', 1),
(8, 'Family Friend', 'Family Friend', 1),
(9, 'Others', 'Others', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_platform_languages`
--

CREATE TABLE `zvs_platform_languages` (
  `id` int(11) NOT NULL,
  `languageCode` varchar(60) NOT NULL,
  `languageName` varchar(60) NOT NULL,
  `languageStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_platform_languages`
--

INSERT INTO `zvs_platform_languages` (`id`, `languageCode`, `languageName`, `languageStatus`) VALUES
(1, 'English', 'English', 1),
(2, 'French', 'French', 1),
(3, 'Spanish', 'Spanish', 1),
(4, 'Russian', 'Russian', 1),
(5, 'Arabic', 'Arabic', 1),
(6, 'Chinese', 'Chinese', 1),
(7, 'German', 'German', 1),
(8, 'Japanese', 'Japanese', 1),
(9, 'Portuguese', 'Portuguese', 1),
(10, 'Hindi', 'Hindi/Urdu', 1),
(11, 'Others', 'Others', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_platform_religions`
--

CREATE TABLE `zvs_platform_religions` (
  `id` int(11) NOT NULL,
  `religionCode` varchar(60) NOT NULL,
  `religionName` varchar(60) NOT NULL,
  `religionStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_platform_religions`
--

INSERT INTO `zvs_platform_religions` (`id`, `religionCode`, `religionName`, `religionStatus`) VALUES
(1, 'Christian', 'Christian', 1),
(2, 'Muslim', 'Muslim', 1),
(3, 'Hindu', 'Hindu', 1),
(4, 'Buddhist', 'Buddhist', 1),
(5, 'Others', 'Others', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_platform_resources`
--

CREATE TABLE `zvs_platform_resources` (
  `id` int(11) NOT NULL,
  `resourceId` varchar(45) NOT NULL,
  `resourceName` varchar(100) NOT NULL,
  `resourceCategory` varchar(100) NOT NULL,
  `dateCreated` date NOT NULL,
  `dateModified` date DEFAULT NULL,
  `resourceStatus` tinyint(1) unsigned zerofill NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_platform_resources`
--

INSERT INTO `zvs_platform_resources` (`id`, `resourceId`, `resourceName`, `resourceCategory`, `dateCreated`, `dateModified`, `resourceStatus`) VALUES
(1, 'ClsMod[`^`]ViewClasses', 'View Classes', 'Class', '2016-07-03', NULL, 1),
(2, 'ClsMod[`^`]ClassProfile', 'Class Profile', 'Class', '2016-07-03', NULL, 0),
(3, 'ClsMod[`^`]ViewStreams', 'View Streams', 'Class', '2016-07-03', NULL, 0),
(4, 'ClsMod[`^`]StreamProfile', 'Stream Profile', 'Class', '2016-07-03', NULL, 0),
(5, 'DepMod[`^`]ViewDepartments', 'View Departments', 'Department', '2016-07-03', NULL, 0),
(6, 'DepMod[`^`]DepartmentProfile', 'Department Profile', 'Department', '2016-07-03', NULL, 0),
(7, 'DepMod[`^`]ViewSubDepartments', 'View Sub Departments', 'Department', '2016-07-03', NULL, 0),
(8, 'DepMod[`^`]SubDepartmentProfile', 'Sub Department Profile', 'Department', '2016-07-03', NULL, 0),
(9, 'FinMod[`^`]CreateFees', 'Create Fees', 'Finance', '2016-07-03', NULL, 0),
(10, 'FinMod[`^`]AllocateFinances', 'Allocate Finances', 'Finance', '2016-07-03', NULL, 0),
(11, 'FinMod[`^`]CollectFees', 'Collect Fees', 'Finance', '2016-07-03', NULL, 1),
(12, 'FinMod[`^`]FinanceStatus', 'Finance Status', 'Finance', '2016-07-03', NULL, 0),
(13, 'FinMod[`^`]FeeStructure', 'Fee Structure', 'Finance', '2016-07-03', NULL, 1),
(14, 'FinMod[`^`]FeeDefaulters', 'Fee Defaulters', 'Finance', '2016-07-03', NULL, 0),
(15, 'FinMod[`^`]FeeRefunds', 'Fee Refunds', 'Finance', '2016-07-03', NULL, 0),
(16, 'StuMod[`^`]RegisterStudent', 'Register Student', 'Student', '2016-07-03', NULL, 1),
(17, 'StuMod[`^`]ViewStudents', 'View Students', 'Student', '2016-07-03', NULL, 0),
(18, 'StuMod[`^`]StudentProfile', 'Student Profile', 'Student', '2016-07-03', NULL, 0),
(19, 'StuMod[`^`]StudentExamResults', 'Student Exam Results', 'Student', '2016-07-03', NULL, 0),
(20, 'StuMod[`^`]StudentFeeDetails', 'Student Fee Details', 'Student', '2016-07-03', NULL, 0),
(21, 'StuMod[`^`]StudentSubjectDetails', 'Student Subject Details', 'Student', '2016-07-03', NULL, 0),
(22, 'StuMod[`^`]StudentMedicalHistory', 'Student Medical History', 'Student', '2016-07-03', NULL, 0),
(23, 'StuMod[`^`]StudentChatBox', 'Student Chat Box', 'Student', '2016-07-03', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_resource_categories`
--

CREATE TABLE `zvs_resource_categories` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(100) NOT NULL,
  `categoryPrefix` varchar(45) NOT NULL,
  `dateCreated` date DEFAULT NULL,
  `categoryStatus` tinyint(1) unsigned zerofill NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_resource_categories`
--

INSERT INTO `zvs_resource_categories` (`id`, `categoryName`, `categoryPrefix`, `dateCreated`, `categoryStatus`) VALUES
(1, 'Class', 'ClsMod', '2016-06-09', 1),
(2, 'Department', 'DepMod', '2016-06-09', 0),
(3, 'Finance', 'FinMod', '2016-06-09', 1),
(4, 'Student', 'StuMod', '2016-06-09', 1),
(5, 'Teacher', 'TchMod', '2016-06-09', 0),
(6, 'Sub Staff', 'SstMod', '2016-06-09', 0),
(7, 'Parent', 'ParMod', '2016-06-09', 0),
(8, 'BOG', 'BogMod', '2016-06-09', 0),
(9, 'Subject', 'SubMod', '2016-06-10', 0),
(10, 'Examination', 'ExmMod', '2016-06-10', 0),
(11, 'Marksheet', 'MrkMod', '2016-06-10', 0),
(12, 'Timetable', 'TtbMod', '2016-06-10', 0),
(13, 'Noticeboard', 'NtcMod', '2016-06-10', 0),
(14, 'Library', 'LibMod', '2016-06-10', 0),
(15, 'Transport', 'TrnMod', '2016-06-10', 0),
(16, 'Kitchen', 'KtnMod', '2016-06-10', 0),
(17, 'Health Care', 'HthMod', '2016-06-10', 0),
(18, 'Hostel', 'HosMod', '2016-06-10', 0),
(19, 'Asset Management', 'AstMod', '2016-08-18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_resource_role_mapper`
--

CREATE TABLE `zvs_resource_role_mapper` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(200) NOT NULL,
  `schoolRoleId` varchar(100) NOT NULL,
  `schoolResourceId` varchar(45) DEFAULT NULL,
  `resourceCategory` varchar(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_resource_role_mapper`
--

INSERT INTO `zvs_resource_role_mapper` (`id`, `systemSchoolCode`, `schoolRoleId`, `schoolResourceId`, `resourceCategory`) VALUES
(1, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Principal', 'StuMod[`^`]RegisterStudent', 'StuMod'),
(3, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Bursar', 'StuMod[`^`]RegisterStudent', 'StuMod'),
(7, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Principal', 'ClsMod[`^`]ViewClasses', 'ClsMod'),
(8, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Principal', 'FinMod[`^`]CollectFees', 'FinMod'),
(9, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Principal', 'FinMod[`^`]FeeStructure', 'FinMod');

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_admin`
--

CREATE TABLE `zvs_school_admin` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(200) NOT NULL,
  `identificationCode` varchar(200) NOT NULL,
  `idNumber` varchar(45) NOT NULL,
  `designation` varchar(15) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `middleName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) NOT NULL,
  `mobileNumber` varchar(15) NOT NULL,
  `boxAddress` varchar(60) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `country` varchar(11) NOT NULL,
  `locality` varchar(11) NOT NULL,
  `imagePath` varchar(300) DEFAULT NULL,
  `dateCreated` date NOT NULL,
  `timeCreated` time NOT NULL,
  `dateModified` date DEFAULT NULL,
  `timeModified` time DEFAULT NULL,
  `createdBy` varchar(200) NOT NULL,
  `userStatus` tinyint(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_admin`
--

INSERT INTO `zvs_school_admin` (`id`, `systemSchoolCode`, `identificationCode`, `idNumber`, `designation`, `firstName`, `middleName`, `lastName`, `mobileNumber`, `boxAddress`, `gender`, `country`, `locality`, `imagePath`, `dateCreated`, `timeCreated`, `dateModified`, `timeModified`, `createdBy`, `userStatus`) VALUES
(1, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'VNb7FU5Q1KcTbMBNFGWDBBuoW5bYlrBQ1jdxDpTZHmxqxHdJcPKmR122yD7LLzKT_8O9ezn61fpjMX00tqh9d-Proh5vZbJddzXuk6WASb4BQ0p0Bifd3NDxGdWUSZoq', 'ZVS_SA_25138058', 'Mr', 'Kaunda', 'Ogweno', 'Wanjiru', '0727074108', 'P.O Box 73619 Nairobi', 'Male', '+254', '30', 'VNb7FU5Q1KcTbMBNFGWDBBuoW5bYlrBQ1jdxDpTZHmxqxHdJcPKmR122yD7LLzKT_8O9ezn61fpjMX00tqh9d-Proh5vZbJddzXuk6WASb4BQ0p0Bifd3NDxGdWUSZoq.png', '2015-08-10', '19:12:05', NULL, NULL, 'pSoaHX1j8XXb2diMDomSijvRhBm6bxybcBWAbm6KL-mtWlM0NHJJdIXj6sxsi4NWMsv34U7kuRjGb3fd9rPlDMw_RESDtvMpAfdTYg23vR_7rylRfEqSABHs29kz0IxS', 1),
(2, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'ARiPxSbwlrH-jfJlyruRZkkvQYqnEVf1FUqZZlTMKb-U43O2LrqHwwm54trM2o7z0uzsF4UPPhwWc6f8GY8-ReProh5vZbJddzXuk6WASb4BQ0p0Bifd3NDxGdWUSZoq', 'ZVS_SA_25138058', 'Mr', 'Alfred', 'Opar', 'Ayanga', '0727074108', 'P.O Box 73619-00100 Nairobi', 'Male', '+254', '30', 'ARiPxSbwlrH-jfJlyruRZkkvQYqnEVf1FUqZZlTMKb-U43O2LrqHwwm54trM2o7z0uzsF4UPPhwWc6f8GY8-ReProh5vZbJddzXuk6WASb4BQ0p0Bifd3NDxGdWUSZoq.png', '2015-08-18', '19:25:22', NULL, NULL, 'YwfPDAkaDbBBuNbYAHfR8030FKTxS2GuxQ8uKKThnfbiDl4uFwZHOU-hRZzth9RM42ZewiPLLSyjliRIUZq9Cm_KW7hQeCNX5bW0ZQmxug5hV8F5VI6XiaCLcPiyYJRe', 1),
(3, '!EvtamRl0u?Q@F4oLBWwYC*iJ3N8pr', 'hMPmq4RdF-0qwPfQNF9vM8Vjh0OGCQ2BtqQ5bNc099C7ZjyMlN3nB8iuqzah0nvqcq7nqj8JA2uxH_NRqQsm2c1luUIQsEIsluSRL8xVcB47m9JS6ZfXeExKoM_DoPxF', 'ZVS_SA_26178900', 'Miss', 'Jane', 'Katanu', 'Kavita', '0713336677', 'P O Box 4343 Kericho', 'Male', '+254', '12', 'HMPmq4RdF-0qwPfQNF9vM8Vjh0OGCQ2BtqQ5bNc099C7ZjyMlN3nB8iuqzah0nvqcq7nqj8JA2uxH_NRqQsm2c1luUIQsEIsluSRL8xVcB47m9JS6ZfXeExKoM_DoPxF.png', '2015-08-19', '12:52:07', NULL, NULL, 'YwfPDAkaDbBBuNbYAHfR8030FKTxS2GuxQ8uKKThnfbiDl4uFwZHOU-hRZzth9RM42ZewiPLLSyjliRIUZq9Cm_KW7hQeCNX5bW0ZQmxug5hV8F5VI6XiaCLcPiyYJRe', 0),
(4, 'q?8mu4aVe$nBr1Thzvd&F!#sIpiO7x', 'wiKJk7ArVzYn2WOZUH07zgUj0J7E0z-ycHYz3dA06leTpM2SENzC8dBmfhOjV_g0ItEC1mf4c2QnZnOZs50xKNgE1JO73X3pl1KOPQ1xAASrrDDFnHfUTmWzNB5_n5Hu', 'ZVS_SA_25674813', 'Mr', 'Lawrence', 'Kore', 'Gombe', '0727564532', 'P.O. BOX 143, KISUMU 40100', 'Male', '+254', '17', 'WiKJk7ArVzYn2WOZUH07zgUj0J7E0z-ycHYz3dA06leTpM2SENzC8dBmfhOjV_g0ItEC1mf4c2QnZnOZs50xKNgE1JO73X3pl1KOPQ1xAASrrDDFnHfUTmWzNB5_n5Hu.png', '2015-08-30', '13:36:41', NULL, NULL, 'YwfPDAkaDbBBuNbYAHfR8030FKTxS2GuxQ8uKKThnfbiDl4uFwZHOU-hRZzth9RM42ZewiPLLSyjliRIUZq9Cm_KW7hQeCNX5bW0ZQmxug5hV8F5VI6XiaCLcPiyYJRe', 0),
(5, 'u7#1a&eYgVJXnUKvlrAPG4k@DFqf!c', '-B8SXuuBHzlhkuoFkxWLsh21XcsB5XCazm2sChuJZnGqKD6lrzLxIj4qrUFkd5LcGNOjRAflqjzp2daSmHbaOeProh5vZbJddzXuk6WASb4BQ0p0Bifd3NDxGdWUSZoq', 'ZVS_SA_25134058', 'Ms', 'Stephy', 'Atieno', 'Atieno', '0711111111', '12345', 'Female', '+254', '17', '-B8SXuuBHzlhkuoFkxWLsh21XcsB5XCazm2sChuJZnGqKD6lrzLxIj4qrUFkd5LcGNOjRAflqjzp2daSmHbaOeProh5vZbJddzXuk6WASb4BQ0p0Bifd3NDxGdWUSZoq.png', '2016-01-08', '16:46:53', NULL, NULL, 'pSoaHX1j8XXb2diMDomSijvRhBm6bxybcBWAbm6KL-mtWlM0NHJJdIXj6sxsi4NWMsv34U7kuRjGb3fd9rPlDMw_RESDtvMpAfdTYg23vR_7rylRfEqSABHs29kz0IxS', 0),
(6, 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9', 'Ujtzm2mvPdc_9TvTJK7Xj0q7uQW68YotqQJt4BjFJ26dDam-gc_dprXCAxPYR1725xxw_hz8RFK4WpGLC5Fav45ejoXQ9pqeBItL2ZyXjq1I-p90244FXFQ-6Klwlf6X', 'ZVS_SA_123456789', 'Ms', 'Liz', 'Reagan', 'Rigo Rigo', '123456789', '12345678', 'Female', '+254', '30', 'Ujtzm2mvPdc_9TvTJK7Xj0q7uQW68YotqQJt4BjFJ26dDam-gc_dprXCAxPYR1725xxw_hz8RFK4WpGLC5Fav45ejoXQ9pqeBItL2ZyXjq1I-p90244FXFQ-6Klwlf6X.png', '2016-01-29', '21:23:17', NULL, NULL, 'pSoaHX1j8XXb2diMDomSijvRhBm6bxybcBWAbm6KL-mKnf601gVVsnjNPfnt5wclTlXDRp78mC6Y69_jWauJjagrwdqBkdLh9RvqvMF8O3_9G2EJloD2wNVgUddYWyLw', 0),
(7, '7EYpZNOA@kQ$9V1X2W&Cmgu!jwl4hK', 'Gx09RceJmKjyZXazBudPOO_0lmmHibkZqheh3XE3xNFHCgacBK7zIJNL_36pylAiliQ3UT2L5Q5O7rF-xHE6AbE3vObQAP46tnDEhUvPg7RWXr8zOy5f2AvMTXf0Kuow', 'ZVS_SA_231789000', 'Mr', 'Elvis', 'Bando', 'Bando', '0727074108', 'P.O Box 4678899', 'Male', '+254', '27', 'Gx09RceJmKjyZXazBudPOO_0lmmHibkZqheh3XE3xNFHCgacBK7zIJNL_36pylAiliQ3UT2L5Q5O7rF-xHE6AbE3vObQAP46tnDEhUvPg7RWXr8zOy5f2AvMTXf0Kuow.png', '2016-05-24', '15:15:32', NULL, NULL, 'YwfPDAkaDbBBuNbYAHfR8030FKTxS2GuxQ8uKKThnfbiDl4uFwZHOU-hRZzth9RM42ZewiPLLSyjliRIUZq9Cm_KW7hQeCNX5bW0ZQmxug5hV8F5VI6XiaCLcPiyYJRe', 0),
(8, '9$DKnOwP%FUlkgHfLVIcyQ@iM*oC#d', '-VTXy54DNq-q9DS5pIYdP0a_4HiLKYH8cec11LCh3l539WT6-ZP62JtpkOG7D3hkKhtTPomkzaVP0W7Y5ZvbKosxff2L7bWm6xqr2QZKvAaLG-0K3_HnKn8Bx1oKGOxh', 'ZVS_SA_1234567', 'Mr', 'Tony', 'Kazungu', 'Kazungu', '12345678', '123456', 'Male', '+254', '28', '-VTXy54DNq-q9DS5pIYdP0a_4HiLKYH8cec11LCh3l539WT6-ZP62JtpkOG7D3hkKhtTPomkzaVP0W7Y5ZvbKosxff2L7bWm6xqr2QZKvAaLG-0K3_HnKn8Bx1oKGOxh.png', '2016-07-11', '12:30:54', NULL, NULL, 'pSoaHX1j8XXb2diMDomSijvRhBm6bxybcBWAbm6KL-mtWlM0NHJJdIXj6sxsi4NWMsv34U7kuRjGb3fd9rPlDMw_RESDtvMpAfdTYg23vR_7rylRfEqSABHs29kz0IxS', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_classes`
--

CREATE TABLE `zvs_school_classes` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(200) NOT NULL,
  `schoolClassCode` varchar(200) NOT NULL,
  `schoolClassName` varchar(100) NOT NULL,
  `schoolClassAlias` varchar(100) NOT NULL,
  `dateCreated` date DEFAULT NULL,
  `dateModified` date NOT NULL,
  `classStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_classes`
--

INSERT INTO `zvs_school_classes` (`id`, `systemSchoolCode`, `schoolClassCode`, `schoolClassName`, `schoolClassAlias`, `dateCreated`, `dateModified`, `classStatus`) VALUES
(1, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne', 'Form One', 'Form One', '2015-09-09', '0000-00-00', 0),
(2, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormTwo', 'Form Two', 'Form Two', '2015-09-09', '0000-00-00', 0),
(3, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormOne', 'Form One', 'Form One', '2015-09-09', '0000-00-00', 0),
(4, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormTwo', 'Form Two', 'Form Two', '2015-09-19', '0000-00-00', 0),
(5, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormThree', 'Form Three', 'Form Three', '2015-09-19', '0000-00-00', 0),
(6, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormThree', 'Form Three', 'Form Three', '2015-09-19', '0000-00-00', 0),
(7, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormFour', 'Form Four', 'Form Four', '2015-09-19', '0000-00-00', 0),
(8, 'u7#1a&eYgVJXnUKvlrAPG4k@DFqf!c', 'u7#1a&eYgVJXnUKvlrAPG4k@DFqf!c[`^`]FormOne', 'Form One', 'Newer', '2016-01-08', '0000-00-00', 0),
(9, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormFour', 'Form Four', 'Form Four', '2016-01-23', '0000-00-00', 0),
(10, 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9', 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9[`^`]FormOne', 'Form One', 'Form 1', '2016-01-29', '0000-00-00', 0),
(11, 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9', 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9[`^`]FormTwo', 'Form Two', 'Form 2', '2016-01-29', '0000-00-00', 0),
(12, 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9', 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9[`^`]FormThree', 'Form Three', 'Form 3', '2016-01-29', '0000-00-00', 0),
(13, 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9', 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9[`^`]FormFour', 'Form Four', 'Form 4', '2016-01-29', '0000-00-00', 0),
(14, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]JAVA', 'JAVA', 'JAV', '2016-03-17', '0000-00-00', 0),
(15, '7EYpZNOA@kQ$9V1X2W&Cmgu!jwl4hK', '7EYpZNOA@kQ$9V1X2W&Cmgu!jwl4hK[`^`]FormOne', 'Form One', 'Form 1', '2016-05-24', '0000-00-00', 0),
(16, '7EYpZNOA@kQ$9V1X2W&Cmgu!jwl4hK', '7EYpZNOA@kQ$9V1X2W&Cmgu!jwl4hK[`^`]FormTwo', 'Form Two', 'Form 2', '2016-05-24', '0000-00-00', 0),
(17, '9$DKnOwP%FUlkgHfLVIcyQ@iM*oC#d', '9$DKnOwP%FUlkgHfLVIcyQ@iM*oC#d[`^`]FormOne', 'Form One', 'Form 1', '2016-07-11', '0000-00-00', 0),
(18, '9$DKnOwP%FUlkgHfLVIcyQ@iM*oC#d', '9$DKnOwP%FUlkgHfLVIcyQ@iM*oC#d[`^`]FormTwo', 'Form Two', 'Form Two', '2016-07-11', '0000-00-00', 0),
(19, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormFive', 'Form Five', 'Form 5', '2016-09-25', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_country`
--

CREATE TABLE `zvs_school_country` (
  `id` int(11) NOT NULL,
  `counrtyInitials` varchar(2) NOT NULL,
  `countryCode` varchar(10) NOT NULL,
  `countryCurrency` varchar(3) NOT NULL,
  `countryName` varchar(60) NOT NULL,
  `countryStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=276 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_country`
--

INSERT INTO `zvs_school_country` (`id`, `counrtyInitials`, `countryCode`, `countryCurrency`, `countryName`, `countryStatus`) VALUES
(1, 'AF', '+93', 'AFN', 'Afghanistan', 0),
(2, 'AL', '+355', 'ALL', 'Albania', 0),
(3, 'DZ', '+213', 'DZD', 'Algeria', 0),
(4, 'AS', '+1 684', 'USD', 'American Samoa', 0),
(5, 'AD', '+376', 'ADP', 'Andorra', 0),
(6, 'AO', '+244', 'AOA', 'Angola', 0),
(7, 'AG', '+1 268', 'XCD', 'Antigua and Barbuda', 0),
(8, 'AI', '+1 264', 'XCD', 'Anguilla', 0),
(9, 'AR', '+54', 'ARS', 'Argentina', 0),
(10, 'AM', '+374', 'AMD', 'Armenia', 0),
(11, 'AW', '+297', 'AWG', 'Aruba', 0),
(12, 'AU', '+61', 'AUD', 'Australia', 0),
(13, 'AT', '+43', 'EUR', 'Austria', 0),
(14, 'AZ', '+994', 'AZN', 'Azerbaijan', 0),
(15, 'BS', '+1 242', 'BSD', 'Bahamas', 0),
(16, 'BH', '+937', 'BHD', 'Bahrain', 0),
(17, 'BD', '+880', 'BDT', 'Bangladesh', 0),
(18, 'BB', '+1 246', 'BBD', 'Barbados', 0),
(19, 'BY', '+375', 'BYR', 'Belarus', 0),
(20, 'BE', '+32', 'EUR', 'Belgium', 0),
(21, 'BZ', '+501', 'BZD', 'Belize', 0),
(22, 'BJ', '+229', 'XOF', 'Benin', 0),
(23, 'BM', '+1 441', 'BMD', 'Bermuda', 0),
(24, 'BT', '+975', 'BTN', 'Bhutan', 0),
(25, 'BO', '+591', 'BOB', 'Bolivia', 0),
(26, 'BA', '+387', 'BAM', 'Bosnia and Herzegowina', 0),
(27, 'BW', '+267', 'BWP', 'Botswana', 0),
(28, 'BR', '+55', 'BRL', 'Brazil', 0),
(29, 'IO', '+246', 'GBP', 'British Indian Ocean Territory', 0),
(30, 'BN', '+673', 'BND', 'Brunei Darussulam', 0),
(31, 'BG', '+359', 'BGN', 'Bulgaria', 0),
(32, 'BF', '+226', 'XOF', 'Burkina Faso', 0),
(33, 'BI', '+257', 'BIF', 'Burundi', 0),
(34, 'KH', '+855', 'KHR', 'Cambodia', 0),
(35, 'CM', '+237', 'XAF', 'Cameroon', 0),
(36, 'CA', '+1 1', 'CAD', 'Canada', 0),
(37, 'CV', '+238', 'CVE', 'Cape Verde', 0),
(38, 'KY', '+ 1 345', 'KYD', 'Cayman Islands', 0),
(39, 'CF', '+236', 'XAF', 'Central African Republic', 0),
(40, 'TD', '+235', 'XAF', 'Chad', 0),
(41, 'CL', '+56', 'CLP', 'Chile', 0),
(42, 'CN', '+86', 'CYN', 'China', 0),
(43, 'CX', '+61 8 9164', 'AUD', 'Christmas Island', 0),
(44, 'CC', '+61 8 9162', 'AUD', 'Cocos (Keeling) Islands', 0),
(45, 'CO', '+57', 'COP', 'Colombia', 0),
(46, 'KM', '+269', 'KMF', 'Comoros', 0),
(47, 'CG', '+242', 'XAF', 'Congo', 0),
(48, 'CD', '+243', 'CDZ', 'Congo, the Democratic Republic of the', 0),
(49, 'CK', '+682', 'NZD', 'Cook Islands', 0),
(50, 'CR', '+506', 'CRC', 'Costa Rica', 0),
(51, 'CI', '+225', 'XOF', 'Cote d''Ivoire', 0),
(52, 'HR', '+385', 'HRK', 'Croatia', 0),
(53, 'CU', '+53', 'CUP', 'Cuba', 0),
(54, 'CY', '+357', 'EUR', 'Cyprus', 0),
(55, 'CZ', '+420', 'CZK', 'Czech Republic', 0),
(56, 'DK', '+45', 'DKK', 'Denmark', 0),
(57, 'DJ', '+253', 'DJF', 'Djibouti', 0),
(58, 'DM', '+1 767', 'XCD', 'Dominica', 0),
(59, 'DO', '+1 809', 'DOP', 'Dominica Republic', 0),
(60, 'EC', '+593', 'ECS', 'Ecuador', 0),
(61, 'EG', '+20', 'EGP', 'EGYPT', 0),
(62, 'SV', '+503', 'USD', 'El Salvador', 0),
(63, 'GQ', '+240', 'XAF', 'Equatorial Guinea', 0),
(64, 'ER', '+291', 'ERN', 'Eritrea', 0),
(65, 'EE', '+372', 'EEK', 'Estonia', 0),
(66, 'ET', '+251', 'ETB', 'Ethiopia', 0),
(67, 'FK', '+500', 'FKP', 'Falkland Islands (Malvinas)', 0),
(68, 'FO', '+298', 'DKK', 'Faroe Islands', 0),
(69, 'FJ', '+679', 'FJD', 'Fiji', 0),
(70, 'FI', '+358', 'EUR', 'Finland', 0),
(71, 'FR', '+33', 'EUR', 'France', 0),
(72, 'GF', '+594', 'EUR', 'French Guiana', 0),
(73, 'PF', '+689', 'XPF', 'French Ploynesia', 0),
(74, 'GA', '+241', 'XAF', 'Gabon', 0),
(75, 'GM', '+220', 'GMD', 'Gambia', 0),
(76, 'GE', '+995', 'GEL', 'Georgia', 0),
(77, 'DE', '+49', 'EUR', 'Germany', 0),
(78, 'GH', '+233', 'GHS', 'Ghana', 0),
(79, 'GI', '+350', 'GIP', 'Gibralter', 0),
(80, 'GR', '+30', 'EUR', 'Greece', 0),
(81, 'GL', '+299', 'DKK', 'Greenland', 0),
(82, 'GD', '+1 473', 'XCD', 'Grenada', 0),
(83, 'GP', '+590', 'EUR', 'Guateloupe', 0),
(84, 'GU', '+1 671', 'USD', 'Guam', 0),
(85, 'GT', '+502', 'GTQ', 'Guatemala', 0),
(86, 'GN', '+224', 'GNS', 'Guinea', 0),
(87, 'GW', '+245', 'GWP', 'Guinea-Bissau', 0),
(88, 'GY', '+592', 'GYD', 'Guyana', 0),
(89, 'HT', '+509', 'HTG', 'Haiti', 0),
(90, 'VA', '+379', 'EUR', 'Holy See (Vatican City State)', 0),
(91, 'HN', '+504', 'HNL', 'Honduras', 0),
(92, 'HK', '+852', 'HKD', 'Hong Kong', 0),
(93, 'HU', '+36', 'HUF', 'Hungary', 0),
(94, 'IS', '+354', 'ISK', 'Iceland', 0),
(95, 'IN', '+91', 'INR', 'India', 0),
(96, 'ID', '+62', 'IDR', 'Indonesia', 0),
(97, 'IR', '+98', 'IRR', 'Iran (Islamic Republic of)', 0),
(98, 'IQ', '+964', 'IQD', 'Iraq', 0),
(99, 'IE', '+353', 'EUR', 'Ireland', 0),
(100, 'IL', '+972', 'ILS', 'Israel', 0),
(101, 'IT', '+39', 'EUR', 'Italy', 0),
(102, 'JM', '+1 876', 'JMD', 'Jamaica', 0),
(103, 'JP', '+81', 'JPY', 'Japan', 0),
(104, 'JO', '+962', 'JOD', 'Jordan', 0),
(105, 'KZ', '+7 600', 'KZT', 'Kazakhstan', 0),
(106, 'KE', '+254', 'KES', 'Kenya', 0),
(107, 'KI', '+686', 'AUD', 'Kiribati', 0),
(108, 'KP', '+850', 'KPW', 'Korea, Democratic People''s Republic of', 0),
(109, 'KR', '+82', 'KRW', 'Korea, Republic of', 0),
(110, 'KW', '+965', 'KWD', 'Kuwait', 0),
(111, 'KG', '+996', 'KGS', 'Kyrgyzstan', 0),
(112, 'LA', '+856', 'LAK', 'Lao People''s Democratic Republic', 0),
(113, 'LV', '+371', 'EUR', 'Latvia', 0),
(114, 'LB', '+961', 'LBP', 'Lebanon', 0),
(115, 'LS', '+266', 'LSL', 'Lesotho', 0),
(116, 'LR', '+231', 'LRD', 'Liberia', 0),
(117, 'LY', '+218', 'LYD', 'Libyan Arab Jamahiriya', 0),
(118, 'LI', '+423', 'CHF', 'Liechtenstein', 0),
(119, 'LT', '+370', 'LTL', 'Lithuania', 0),
(120, 'LU', '+352', 'EUR', 'Luxembourg', 0),
(144, 'MO', '+853', 'MOP', 'Macau', 0),
(145, 'MK', '+389', 'MKD', 'Macedonia, The Former Yugoslav Republic of', 0),
(146, 'MG', '+261', 'MGF', 'Madagascar', 0),
(147, 'MW', '+265', 'MWK', 'Malawi', 0),
(148, 'MY', '+60', 'MYR', 'Malaysia', 0),
(149, 'MV', '+960', 'MVR', 'Maldives', 0),
(150, 'ML', '+223', 'XAF', 'Mali', 0),
(151, 'MT', '+356', 'EUR', 'Malta', 0),
(152, 'MH', '+692', 'USD', 'Marshall Islands', 0),
(153, 'MQ', '+596', 'EUR', 'Martinique', 0),
(154, 'MR', '+222', 'MRO', 'Mauritania', 0),
(155, 'MU', '+230', 'MUR', 'Mauritius', 0),
(156, 'YT', '+639', 'EUR', 'Mayotte', 0),
(157, 'MX', '+52', 'MXN', 'Mexico', 0),
(158, 'FM', '+691', 'USD', 'Micronesia, Federated States of', 0),
(159, 'MD', '+373', 'MDL', 'Moldova, Republic of', 0),
(160, 'MC', '+377', 'EUR', 'Monaco', 0),
(161, 'MN', '+976', 'MNT', 'Mongolia', 0),
(162, 'ME', '+382', 'CSD', 'Montenegro', 0),
(163, 'MS', '+1 664', 'XCD', 'Montserrat', 0),
(164, 'MA', '+212', 'MAD', 'Morocco', 0),
(165, 'MZ', '+258', 'MZN', 'Mozambique', 0),
(166, 'MM', '+95', 'MMK', 'Myanmar (Burma)', 0),
(167, 'NA', '+264', 'NAD', 'Namibia', 0),
(168, 'NR', '+674', 'AUD', 'Nauru', 0),
(169, 'NP', '+977', 'NPR', 'Nepal', 0),
(170, 'NL', '+31', 'EUR', 'Netherlands', 0),
(171, 'AN', '+599', 'ANG', 'Netherlands Antilles', 0),
(172, 'NC', '+687', 'XPF', 'New Caledonia', 0),
(173, 'NZ', '+64', 'NZD', 'New Zealand', 0),
(174, 'NI', '+505', 'NIO', 'Nicaragua', 0),
(175, 'NE', '+227', 'XOF', 'Niger', 0),
(176, 'NG', '+234', 'NGN', 'Nigeria', 0),
(177, 'NU', '+683', 'NZD', 'Niue', 0),
(178, 'NF', '+672', 'AUD', 'Norfolk Island', 0),
(179, 'MP', '+1 670', 'USD', 'Northern Mariana Islands', 0),
(180, 'NO', '+47', 'NOK', 'Norway', 0),
(181, 'OM', '+968', 'OMR', 'Oman', 0),
(199, 'PK', '+92', 'PKR', 'Pakistan', 0),
(200, 'PS', '+970', 'PSE', 'Palestine *', 0),
(201, 'PW', '+680', 'USD', 'Palau', 0),
(202, 'PA', '+507', 'PAB', 'Panama', 0),
(203, 'PG', '+675', 'PGK', 'Papua New Guinea', 0),
(204, 'PY', '+595', 'PYG', 'Paraguay', 0),
(205, 'PE', '+51', 'PEN', 'Peru', 0),
(206, 'PH', '+63', 'PHP', 'Philippines', 0),
(207, 'PN', '+64 1', 'NZD', 'Pitcairn', 0),
(208, 'PL', '+48', 'PLN', 'Poland', 0),
(209, 'PT', '+351', 'EUR', 'Portugal', 0),
(210, 'PR', '+1 787', 'USD', 'Puerto Rico', 0),
(211, 'QA', '+974', 'QAR', 'Qatar', 0),
(212, 'RE', '+262', 'EUR', 'Reunion', 0),
(213, 'RO', '+40', 'RON', 'Romania', 0),
(214, 'RU', '+7', 'RUB', 'Russian Federation', 0),
(215, 'RW', '+250', 'RWF', 'Rwanda', 0),
(216, 'KN', '+1 869', 'XCD', 'Saint Kitts and Nevis', 0),
(217, 'LC', '+1 758', 'XCD', 'Saint LUCIA', 0),
(218, 'VC', '+1 784', 'XCD', 'Saint Vincent and the Grenadines', 0),
(219, 'WS', '+685', 'WST', 'Samoa', 0),
(220, 'SM', '+378', 'EUR', 'San Marino', 0),
(221, 'ST', '+239', 'STD', 'Sao Tome and Principe', 0),
(222, 'SA', '+966', 'SAR', 'Saudi Arabia', 0),
(223, 'SN', '+221', 'XOF', 'Senegal', 0),
(224, 'RS', '+381', 'RSD', 'Serbia', 0),
(225, 'SC', '+248', 'SCR', 'Seychelles', 0),
(226, 'SL', '+232', 'SLL', 'Sierra Leone', 0),
(227, 'SG', '+65', 'SGD', 'Singapore', 0),
(228, 'SK', '+421', 'SKK', 'Slovakia (Slovak Republic)', 0),
(229, 'SI', '+386', 'EUR', 'Slovenia', 0),
(230, 'SB', '+677', 'SBD', 'Solomon Islands', 0),
(231, 'SO', '+252', 'SOS', 'Somalia', 0),
(232, 'ZA', '+27', 'ZAR', 'South Africa', 0),
(233, 'SU', '+211', 'SDP', 'South Sudan', 0),
(234, 'GS', '+500 1', 'GBP', 'South Georgia and the South Sandwich Islands', 0),
(235, 'ES', '+34', 'EUR', 'Spain', 0),
(236, 'LK', '+94', 'LKR', 'Sri Lanka', 0),
(237, 'SH', '+290', 'SHP', 'St. Helena', 0),
(238, 'PM', '+508', 'EUR', 'St. Pierre and Miquelon', 0),
(239, 'SD', '+249', 'SDG', 'Sudan', 0),
(240, 'SR', '+597', 'SRD', 'Suriname', 0),
(241, 'SJ', '+47 79', 'NOK', 'Svalbard and Jan Mayen Islands', 0),
(242, 'SZ', '+268', 'SZL', 'Swaziland', 0),
(243, 'SE', '+46', 'SEK', 'Sweden', 0),
(244, 'CH', '+41', 'CHF', 'Switzerland', 0),
(245, 'SY', '+963', 'SYP', 'Syrian Arab Republic', 0),
(246, 'TW', '+886', 'TWD', 'Taiwan, Province of China', 0),
(247, 'TJ', '+992', 'TJS', 'Tajikistan', 0),
(248, 'TZ', '+255', 'TZS', 'Tanzania', 0),
(249, 'TH', '+66', 'THB', 'Thailand', 0),
(250, 'TL', '+670', 'TPE', 'Timor-Leste', 0),
(251, 'TG', '+228', 'XAF', 'Togo', 0),
(252, 'TK', '+690', 'NZD', 'Tokelau', 0),
(253, 'TO', '+676', 'TOP', 'Tonga', 0),
(254, 'TT', '+1 868', 'TTD', 'Trinidad and Tobago', 0),
(255, 'TN', '+216', 'TND', 'Tunisia', 0),
(256, 'TR', '+90', 'TRY', 'Turkey', 0),
(257, 'TM', '+993', 'TMT', 'Turkmenistan', 0),
(258, 'TC', '+1 649', 'USD', 'Turks and Caicos Islands', 0),
(259, 'TV', '+688', 'AUD', 'Tuvalu', 0),
(260, 'UG', '+256', 'UGX', 'Uganda', 0),
(261, 'UA', '+380', 'UAH', 'Ukraine', 0),
(262, 'AE', '+971', 'AED', 'United Arab Emirates', 0),
(263, 'GB', '+44', 'GBP', 'United Kingdom', 0),
(264, 'US', '+1', 'USD', 'United States', 0),
(265, 'UY', '+598', 'UYU', 'Uruguay', 0),
(266, 'UZ', '+998', 'UZS', 'Uzebkistan', 0),
(267, 'VU', '+678', 'VUV', 'Vanuatu', 0),
(268, 'VE', '+58', 'VEF', 'Venezuela', 0),
(269, 'VN', '+84', 'VND', 'Viet Nam', 0),
(270, 'VG', '+1 284', 'GBP', 'Virgin Islands (British)', 0),
(271, 'VI', '+1 340', 'USD', 'Virgin Islands (U.S.)', 0),
(272, 'WF', '+681', 'XPF', 'Wallis and Futuna Islands', 0),
(273, 'YE', '+967', 'YER', 'Yemen', 0),
(274, 'ZM', '+260', 'ZMW', 'Zambia', 0),
(275, 'ZW', '+263', 'ZWD', 'Zimbabwe', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_departments`
--

CREATE TABLE `zvs_school_departments` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(200) NOT NULL,
  `schoolDepartmentCode` varchar(200) NOT NULL,
  `schoolDepartmentName` varchar(100) NOT NULL,
  `schoolDepartmentAlias` varchar(100) DEFAULT NULL,
  `dateCreated` date DEFAULT NULL,
  `dateModified` date DEFAULT NULL,
  `departmentStatus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_departments`
--

INSERT INTO `zvs_school_departments` (`id`, `systemSchoolCode`, `schoolDepartmentCode`, `schoolDepartmentName`, `schoolDepartmentAlias`, `dateCreated`, `dateModified`, `departmentStatus`) VALUES
(1, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Mathematics', 'Mathematics', 'Mathematics', '2016-10-09', NULL, 0),
(2, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Languages', 'Languages', 'Languages', '2016-10-09', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_department_heads`
--

CREATE TABLE `zvs_school_department_heads` (
  `id` int(11) NOT NULL,
  `identificationCode` varchar(200) NOT NULL,
  `schoolDepartmentCode` varchar(200) NOT NULL,
  `dateCreated` date DEFAULT NULL,
  `dateModified` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_details`
--

CREATE TABLE `zvs_school_details` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(200) NOT NULL,
  `schoolCode` varchar(120) NOT NULL,
  `registrationNumber` varchar(120) NOT NULL,
  `schoolName` varchar(120) NOT NULL,
  `dateOfEstablishment` year(4) NOT NULL,
  `schoolEmail` varchar(120) NOT NULL,
  `schoolWebsite` varchar(120) NOT NULL,
  `schoolPhoneNumber` varchar(45) DEFAULT NULL,
  `schoolMobileNumber` varchar(15) NOT NULL,
  `schoolBoxAddress` varchar(120) NOT NULL,
  `schoolMotto` text NOT NULL,
  `schoolLevel` varchar(45) NOT NULL,
  `schoolCategory` varchar(45) NOT NULL,
  `schoolGender` varchar(45) NOT NULL,
  `schoolType` varchar(45) NOT NULL,
  `schoolCountry` varchar(15) NOT NULL,
  `schoolLocality` varchar(100) NOT NULL,
  `schoolLogoPath` varchar(200) DEFAULT NULL,
  `dateCreated` date NOT NULL,
  `timeCreated` time NOT NULL,
  `dateModified` date DEFAULT NULL,
  `timeModified` time DEFAULT NULL,
  `createdBy` varchar(200) NOT NULL,
  `schoolStatus` tinyint(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_details`
--

INSERT INTO `zvs_school_details` (`id`, `systemSchoolCode`, `schoolCode`, `registrationNumber`, `schoolName`, `dateOfEstablishment`, `schoolEmail`, `schoolWebsite`, `schoolPhoneNumber`, `schoolMobileNumber`, `schoolBoxAddress`, `schoolMotto`, `schoolLevel`, `schoolCategory`, `schoolGender`, `schoolType`, `schoolCountry`, `schoolLocality`, `schoolLogoPath`, `dateCreated`, `timeCreated`, `dateModified`, `timeModified`, `createdBy`, `schoolStatus`) VALUES
(1, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'B6060752', 'KEB6060752', 'Kanga High School', 1985, 'info@kangaschool.ac.ke', 'http://www.kangaschool.ac.ke', '07271231456', '0727074108', 'P.O Box 4 Rongo', 'Faithful and Excellent Service', 'Secondary School', 'Boarding School', 'Boys School', 'Public School', '+254', '27', 'KangaHighSchool_xnCwJMKLVkrXbmBl40eW29IcjO.png', '2015-08-10', '19:12:05', NULL, NULL, 'pSoaHX1j8XXb2diMDomSijvRhBm6bxybcBWAbm6KL-mtWlM0NHJJdIXj6sxsi4NWMsv34U7kuRjGb3fd9rPlDMw_RESDtvMpAfdTYg23vR_7rylRfEqSABHs29kz0IxS', 1),
(2, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'A6040008', 'KEA6040008', 'Maseno School', 1906, 'info@masenoschool.ac.ke', 'http://www.masenoschool.ac.ke', '0713131313', '0727074108', 'P.O Box 120 Maseno', 'Perseverance shall win through', 'Secondary School', 'Boarding School', 'Boys School', 'Public School', '+254', '17', 'MasenoSchool_SpRYrqdouYNAnxVZDXEyg3MFH.png', '2015-08-18', '19:25:23', NULL, NULL, 'YwfPDAkaDbBBuNbYAHfR8030FKTxS2GuxQ8uKKThnfbiDl4uFwZHOU-hRZzth9RM42ZewiPLLSyjliRIUZq9Cm_KW7hQeCNX5bW0ZQmxug5hV8F5VI6XiaCLcPiyYJRe', 1),
(3, '!EvtamRl0u?Q@F4oLBWwYC*iJ3N8pr', '7346WEVTY08', 'KE7346WEVTY08', 'St. Florence Academy', 1996, 'info@stflorence.ac.ke', 'http://www.stflorence.ac.ke', '0733123456', '0733123456', 'P.O Box 4567 Kericho', 'Inspired by growth', 'Primary School', 'Boarding and Day', 'Girls School', 'Private School', '+254', '12', 'ST.Florence_EvtamRl0uQF4oLBWwYCiJ3N8pr.png', '2015-08-19', '12:52:07', NULL, NULL, 'YwfPDAkaDbBBuNbYAHfR8030FKTxS2GuxQ8uKKThnfbiDl4uFwZHOU-hRZzth9RM42ZewiPLLSyjliRIUZq9Cm_KW7hQeCNX5bW0ZQmxug5hV8F5VI6XiaCLcPiyYJRe', 0),
(4, 'q?8mu4aVe$nBr1Thzvd&F!#sIpiO7x', 'KPLY231456XZ', 'KPLY231456XZ', 'Kisumu Polytechnic', 1906, 'info@kisumupoly.ac.ke', 'http://www.kisumupoly.ac.ke', '+254 57 2020071', '0723 446773', 'P.O. BOX 143, KISUMU 40100', 'Industry Succeeds', 'Polytechnic', 'Boarding and Day', 'Mixed School', 'Public School', '+254', '17', 'KisumuPolytechnic_q8mu4aVenBr1ThzvdFsIpiO7x.png', '2015-08-30', '13:36:41', NULL, NULL, 'YwfPDAkaDbBBuNbYAHfR8030FKTxS2GuxQ8uKKThnfbiDl4uFwZHOU-hRZzth9RM42ZewiPLLSyjliRIUZq9Cm_KW7hQeCNX5bW0ZQmxug5hV8F5VI6XiaCLcPiyYJRe', 1),
(5, 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9', '23456789', '2345678', 'Pangani Girls', 0000, 'info@pangani.ac.ke', 'http://www.pangani.ac.ke', '12345678', '1234567866', '12345656', 'Excellence', 'Secondary School', 'Boarding School', 'Girls School', 'Public School', '+254', '30', 'PanganiGirls_A4dbM8xWHUmZKFuO3sL07jEt9.png', '2016-01-29', '21:23:17', NULL, NULL, 'pSoaHX1j8XXb2diMDomSijvRhBm6bxybcBWAbm6KL-mKnf601gVVsnjNPfnt5wclTlXDRp78mC6Y69_jWauJjagrwdqBkdLh9RvqvMF8O3_9G2EJloD2wNVgUddYWyLw', 1),
(6, '7EYpZNOA@kQ$9V1X2W&Cmgu!jwl4hK', '12345CVS', '12345689', 'Migori Technical', 2015, 'info@migtech.co.ke', 'http://migtech.co.ke', '1234567890', '12345678', 'P.O Box 467788', 'Going places', 'Tertiary College', 'Boarding and Day', 'Mixed School', 'Public School', '+254', '27', 'MigoriTechnical_7EYpZNOAkQ9V1X2WCmgujwl4hK.png', '2016-05-24', '15:15:32', NULL, NULL, 'YwfPDAkaDbBBuNbYAHfR8030FKTxS2GuxQ8uKKThnfbiDl4uFwZHOU-hRZzth9RM42ZewiPLLSyjliRIUZq9Cm_KW7hQeCNX5bW0ZQmxug5hV8F5VI6XiaCLcPiyYJRe', 1),
(7, '9$DKnOwP%FUlkgHfLVIcyQ@iM*oC#d', '1234567', '1234567', 'Tony Coast', 0000, 'info@tonyk.ac.ke', 'http://tonyk.ac.ke', '1234567', '1234567', '1234567', 'asdfghjkl', 'Secondary School', 'Boarding School', 'Mixed School', 'Public School', '+254', '28', 'TonyCoast_9DKnOwPFUlkgHfLVIcyQiMoCd.png', '2016-07-11', '12:30:54', NULL, NULL, 'pSoaHX1j8XXb2diMDomSijvRhBm6bxybcBWAbm6KL-mtWlM0NHJJdIXj6sxsi4NWMsv34U7kuRjGb3fd9rPlDMw_RESDtvMpAfdTYg23vR_7rylRfEqSABHs29kz0IxS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_examinations`
--

CREATE TABLE `zvs_school_examinations` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(200) NOT NULL,
  `systemExamCode` varchar(200) NOT NULL,
  `examName` varchar(30) NOT NULL,
  `examAlias` varchar(30) NOT NULL,
  `percentageProportion` varchar(3) NOT NULL,
  `schoolSubjectCode` varchar(200) NOT NULL,
  `examStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_examinations`
--

INSERT INTO `zvs_school_examinations` (`id`, `systemSchoolCode`, `systemExamCode`, `examName`, `examAlias`, `percentageProportion`, `schoolSubjectCode`, `examStatus`) VALUES
(1, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Mathematics[`^`]CatOne', 'Cat One', 'Cat 1', '15', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Mathematics', 1),
(2, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]English[`^`]CatOne', 'Cat One', 'Cat 1', '15', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]English', 1),
(3, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Mathematics[`^`]CatTwo', 'Cat Two', 'Cat 2', '15', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Mathematics', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_general_admins`
--

CREATE TABLE `zvs_school_general_admins` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_grades`
--

CREATE TABLE `zvs_school_grades` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(200) NOT NULL,
  `systemGradeCode` varchar(200) NOT NULL,
  `gradeName` varchar(4) NOT NULL,
  `gradeAlias` varchar(10) NOT NULL,
  `gradePoints` int(3) NOT NULL,
  `gradeComments` varchar(120) NOT NULL,
  `gradeStatus` tinyint(1) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_grades`
--

INSERT INTO `zvs_school_grades` (`id`, `systemSchoolCode`, `systemGradeCode`, `gradeName`, `gradeAlias`, `gradePoints`, `gradeComments`, `gradeStatus`, `dateCreated`) VALUES
(1, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]A', 'A', 'A Plain', 12, 'Excellent', 1, '0000-00-00'),
(2, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]A-', 'A -', 'A Minus', 11, 'Very Good', 1, '0000-00-00'),
(3, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]B+', 'B +', 'B Plus', 10, 'Great', 1, '2016-10-18');

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_hostels`
--

CREATE TABLE `zvs_school_hostels` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(200) NOT NULL,
  `schoolHostelCode` varchar(200) NOT NULL,
  `schoolHostelName` varchar(100) NOT NULL,
  `schoolHostelAlias` varchar(100) NOT NULL,
  `schoolHostelGender` varchar(7) NOT NULL,
  `schoolHostelCapacity` int(4) NOT NULL,
  `schoolHostelOccupancy` int(4) NOT NULL,
  `schoolHostelDescription` text NOT NULL,
  `dateCreated` date DEFAULT NULL,
  `dateModified` date NOT NULL,
  `hostelStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_hostels`
--

INSERT INTO `zvs_school_hostels` (`id`, `systemSchoolCode`, `schoolHostelCode`, `schoolHostelName`, `schoolHostelAlias`, `schoolHostelGender`, `schoolHostelCapacity`, `schoolHostelOccupancy`, `schoolHostelDescription`, `dateCreated`, `dateModified`, `hostelStatus`) VALUES
(5, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]Mara[`^`]Female', 'Mara', 'Mara', 'Female', 120, 0, '', '2016-01-29', '0000-00-00', 0),
(6, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]Amboseli[`^`]Female', 'Amboseli', 'Amboseli', 'Female', 150, 0, '', '2016-01-29', '0000-00-00', 0),
(7, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]Mara[`^`]Male', 'Mara', 'Mara', 'Male', 200, 0, '', '2016-01-29', '0000-00-00', 0),
(8, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]Amboseli[`^`]Male', 'Amboseli', 'Amboseli', 'Male', 200, 0, '', '2016-01-29', '0000-00-00', 0),
(9, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]Tana[`^`]Male', 'Tana', 'Tna', 'Male', 200, 0, '', '2016-01-30', '0000-00-00', 0),
(10, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Mara[`^`]Male', 'Mara', 'Mara', 'Male', 150, 0, '', '2016-10-09', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_locality`
--

CREATE TABLE `zvs_school_locality` (
  `id` int(11) NOT NULL,
  `countryCode` varchar(10) NOT NULL,
  `localityCode` varchar(60) NOT NULL,
  `localityName` varchar(60) NOT NULL,
  `localityType` varchar(60) NOT NULL,
  `localityStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_locality`
--

INSERT INTO `zvs_school_locality` (`id`, `countryCode`, `localityCode`, `localityName`, `localityType`, `localityStatus`) VALUES
(1, '+254', '1', 'Baringo', 'County', 0),
(2, '+254', '2', 'Bomet', 'County', 0),
(3, '+254', '3', 'Bungoma', 'County', 0),
(4, '+254', '4', 'Busia', 'County', 0),
(5, '+254', '5', 'Elgeyo/Marakwet', 'County', 0),
(6, '+254', '6', 'Embu', 'County', 0),
(7, '+254', '7', 'Garissa', 'County', 0),
(8, '+254', '8', 'Homa Bay', 'County', 0),
(9, '+254', '9', 'Isiolo', 'County', 0),
(10, '+254', '10', 'Kajiado', 'County', 0),
(11, '+254', '11', 'Kakamega', 'County', 0),
(12, '+254', '12', 'Kericho', 'County', 0),
(13, '+254', '13', 'Kiambu', 'County', 0),
(14, '+254', '14', 'Kilifi', 'County', 0),
(15, '+254', '15', 'Kirinyaga', 'County', 0),
(16, '+254', '16', 'Kisii', 'County', 0),
(17, '+254', '17', 'Kisumu', 'County', 0),
(18, '+254', '18', 'Kitui', 'County', 0),
(19, '+254', '19', 'Kwale', 'County', 0),
(20, '+254', '20', 'Laikipia', 'County', 0),
(21, '+254', '21', 'Lamu', 'County', 0),
(22, '+254', '22', 'Machakos', 'County', 0),
(23, '+254', '23', 'Makueni', 'County', 0),
(24, '+254', '24', 'Mandera', 'County', 0),
(25, '+254', '25', 'Marsabit', 'County', 0),
(26, '+254', '26', 'Meru', 'County', 0),
(27, '+254', '27', 'Migori', 'County', 0),
(28, '+254', '28', 'Mombasa', 'County', 0),
(29, '+254', '29', 'Murang''a', 'County', 0),
(30, '+254', '30', 'Nairobi', 'County', 0),
(31, '+254', '31', 'Nakuru', 'County', 0),
(32, '+254', '32', 'Nandi', 'County', 0),
(33, '+254', '33', 'Narok', 'County', 0),
(34, '+254', '34', 'Nyamira', 'County', 0),
(35, '+254', '35', 'Nyandarua', 'County', 0),
(36, '+254', '36', 'Nyeri', 'County', 0),
(37, '+254', '37', 'Samburu', 'County', 0),
(38, '+254', '38', 'Siaya', 'County', 0),
(39, '+254', '39', 'Taita Taveta', 'County', 0),
(40, '+254', '40', 'Tana River', 'County', 0),
(41, '+254', '41', 'Tharaka Nithi', 'County', 0),
(42, '+254', '42', 'Trans Nzoia', 'County', 0),
(43, '+254', '43', 'Turkana', 'County', 0),
(44, '+254', '44', 'Uasin Gishu', 'County', 0),
(45, '+254', '45', 'Vihiga', 'County', 0),
(46, '+254', '46', 'Wajir', 'County', 0),
(47, '+254', '47', 'West Pokot', 'County', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_roles`
--

CREATE TABLE `zvs_school_roles` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(200) NOT NULL,
  `schoolRoleCode` varchar(200) NOT NULL,
  `schoolRoleName` varchar(200) NOT NULL,
  `schoolRoleAlias` varchar(200) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `schoolRoleId` varchar(100) NOT NULL,
  `dateCreated` date NOT NULL,
  `dateModified` date DEFAULT NULL,
  `assignStatus` tinyint(1) unsigned zerofill NOT NULL,
  `roleStatus` tinyint(1) unsigned zerofill NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_roles`
--

INSERT INTO `zvs_school_roles` (`id`, `systemSchoolCode`, `schoolRoleCode`, `schoolRoleName`, `schoolRoleAlias`, `schoolRoleId`, `dateCreated`, `dateModified`, `assignStatus`, `roleStatus`) VALUES
(1, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Principal', 'Principal', 'Principal', 'Principal', '2016-08-18', NULL, 1, 1),
(2, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Bursar', 'Bursar', 'Bursar', 'Bursar', '2016-09-10', NULL, 1, 1),
(3, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Student', 'Student', 'Student', 'Student', '2016-09-11', NULL, 1, 1),
(4, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Parent', 'Parent', 'Parent', 'Parent', '2016-09-17', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_streams`
--

CREATE TABLE `zvs_school_streams` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(200) NOT NULL,
  `schoolClassCode` varchar(200) NOT NULL,
  `schoolStreamCode` varchar(200) NOT NULL,
  `schoolStreamName` varchar(30) NOT NULL,
  `schoolStreamCapacity` int(3) NOT NULL,
  `schoolStreamOccupancy` int(3) NOT NULL,
  `dateCreated` date DEFAULT NULL,
  `dateModified` date NOT NULL,
  `streamStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_streams`
--

INSERT INTO `zvs_school_streams` (`id`, `systemSchoolCode`, `schoolClassCode`, `schoolStreamCode`, `schoolStreamName`, `schoolStreamCapacity`, `schoolStreamOccupancy`, `dateCreated`, `dateModified`, `streamStatus`) VALUES
(1, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne[`^`]East', 'East', 65, 3, '2015-09-10', '0000-00-00', 1),
(2, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne[`^`]West', 'West', 65, 42, '2015-09-10', '0000-00-00', 0),
(3, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormOne', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormOne[`^`]Heroes', 'Heroes', 60, 30, '2015-09-10', '0000-00-00', 0),
(4, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormOne', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormOne[`^`]Champions', 'Champions', 60, 45, '2015-09-10', '0000-00-00', 0),
(5, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormTwo', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormTwo[`^`]East', 'East', 65, 15, '2015-09-10', '0000-00-00', 0),
(6, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormOne', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormOne[`^`]Bulldozer', 'Bulldozer', 60, 0, '2015-09-27', '0000-00-00', 0),
(7, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormTwo', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormTwo[`^`]SkyRiders', 'Sky Riders', 60, 0, '2015-09-27', '0000-00-00', 0),
(8, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormTwo', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormTwo[`^`]West', 'West', 65, 0, '2015-09-27', '0000-00-00', 0),
(9, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormThree', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormThree[`^`]East', 'East', 65, 0, '2015-09-27', '0000-00-00', 0),
(10, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormFour', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormFour[`^`]East', 'East', 65, 0, '2015-09-27', '0000-00-00', 0),
(11, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormThree', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormThree[`^`]West', 'West', 65, 0, '2015-09-27', '0000-00-00', 0),
(12, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormFour', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormFour[`^`]West', 'West', 65, 0, '2015-09-27', '0000-00-00', 0),
(13, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne[`^`]North', 'North', 65, 0, '2015-09-27', '0000-00-00', 0),
(14, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormTwo', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormTwo[`^`]North', 'North', 65, 0, '2015-09-27', '0000-00-00', 0),
(15, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormFour', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormFour[`^`]North', 'North', 65, 0, '2015-09-27', '0000-00-00', 0),
(16, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormThree', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormThree[`^`]North', 'North', 65, 0, '2015-09-27', '0000-00-00', 0),
(17, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormTwo', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormTwo[`^`]Kings', 'Kings', 60, 0, '2015-10-15', '0000-00-00', 0),
(18, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormTwo', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormTwo[`^`]Elite', 'Elite', 60, 0, '2015-10-15', '0000-00-00', 0),
(19, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormThree', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormThree[`^`]TorchBearers', 'Torch Bearers', 60, 0, '2015-10-15', '0000-00-00', 0),
(20, 'u7#1a&eYgVJXnUKvlrAPG4k@DFqf!c', 'u7#1a&eYgVJXnUKvlrAPG4k@DFqf!c[`^`]FormOne', 'u7#1a&eYgVJXnUKvlrAPG4k@DFqf!c[`^`]FormOne[`^`]East', 'East', 50, 0, '2016-01-08', '0000-00-00', 0),
(21, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormFour', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormFour[`^`]Hammers', 'Hammers', 60, 0, '2016-01-23', '0000-00-00', 0),
(22, 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9', 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9[`^`]FormOne', 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9[`^`]FormOne[`^`]FormP', 'Form P', 60, 0, '2016-01-29', '0000-00-00', 0),
(23, 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9', 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9[`^`]FormTwo', 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9[`^`]FormTwo[`^`]FormP', 'Form P', 68, 0, '2016-01-29', '0000-00-00', 0),
(24, 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9', 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9[`^`]FormThree', 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9[`^`]FormThree[`^`]FormP', 'Form P', 60, 0, '2016-01-29', '0000-00-00', 0),
(25, 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9', 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9[`^`]FormFour', 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9[`^`]FormFour[`^`]FormP', 'Form P', 60, 0, '2016-01-29', '0000-00-00', 0),
(26, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormTwo', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormTwo[`^`]FRIDA', 'FRIDA', 50, 0, '2016-03-17', '0000-00-00', 0),
(27, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormOne', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]FormOne[`^`]ORANGE', 'ORANGE', 70, 0, '2016-03-17', '0000-00-00', 0),
(28, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]JAVA', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]JAVA[`^`]WEST', 'WEST', 80, 0, '2016-03-17', '0000-00-00', 0),
(29, '7EYpZNOA@kQ$9V1X2W&Cmgu!jwl4hK', '7EYpZNOA@kQ$9V1X2W&Cmgu!jwl4hK[`^`]FormOne', '7EYpZNOA@kQ$9V1X2W&Cmgu!jwl4hK[`^`]FormOne[`^`]East', 'East', 50, 0, '2016-05-24', '0000-00-00', 0),
(30, '9$DKnOwP%FUlkgHfLVIcyQ@iM*oC#d', '9$DKnOwP%FUlkgHfLVIcyQ@iM*oC#d[`^`]FormOne', '9$DKnOwP%FUlkgHfLVIcyQ@iM*oC#d[`^`]FormOne[`^`]East', 'East', 50, 0, '2016-07-11', '0000-00-00', 0),
(31, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne[`^`]South', 'South', 65, 0, '2016-09-11', '0000-00-00', 0),
(32, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormTwo', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormTwo[`^`]Hero', 'Hero', 50, 0, '2016-10-13', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_subjects`
--

CREATE TABLE `zvs_school_subjects` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(200) NOT NULL,
  `systemSubjectCode` varchar(200) NOT NULL,
  `subjectName` varchar(30) NOT NULL,
  `subjectAlias` varchar(30) NOT NULL,
  `subjectCode` varchar(10) NOT NULL,
  `subjectStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_subjects`
--

INSERT INTO `zvs_school_subjects` (`id`, `systemSchoolCode`, `systemSubjectCode`, `subjectName`, `subjectAlias`, `subjectCode`, `subjectStatus`) VALUES
(1, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Mathematics', 'Mathematics', 'Mathematics', '101', 1),
(2, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]English', 'English', 'Eng', '102', 1),
(3, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Kiswahili', 'Kiswahili', 'Kiswahili', '102', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_sub_departments`
--

CREATE TABLE `zvs_school_sub_departments` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(200) NOT NULL,
  `schoolDepartmentCode` varchar(200) NOT NULL,
  `schoolSubDepartmentCode` varchar(250) NOT NULL,
  `schoolSubDepartmentName` varchar(100) NOT NULL,
  `dateCreated` date NOT NULL,
  `dateModified` date DEFAULT NULL,
  `subDepartmentStatus` tinyint(1) unsigned zerofill DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_sub_departments`
--

INSERT INTO `zvs_school_sub_departments` (`id`, `systemSchoolCode`, `schoolDepartmentCode`, `schoolSubDepartmentCode`, `schoolSubDepartmentName`, `dateCreated`, `dateModified`, `subDepartmentStatus`) VALUES
(3, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]Science', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]Science[`^`]Physics', 'Physics', '2016-01-28', NULL, 0),
(4, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]Science', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]Science[`^`]Biology', 'Biology', '2016-01-28', NULL, 0),
(5, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]Languages', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]Languages[`^`]English', 'English', '2016-01-28', NULL, 0),
(6, 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]Languages', 'SpRYrqdo*u?!&NAnxVZDXE@yg3MF$H[`^`]Languages[`^`]Kiswahili', 'Kiswahili', '2016-01-28', NULL, 0),
(7, 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9', 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9[`^`]Humanities', 'A4dbM8xWHUm@ZKFu#O3?sL&07jEt%9[`^`]Humanities[`^`]History', 'History', '2016-01-31', NULL, 0),
(8, '7EYpZNOA@kQ$9V1X2W&Cmgu!jwl4hK', '7EYpZNOA@kQ$9V1X2W&Cmgu!jwl4hK[`^`]Language', '7EYpZNOA@kQ$9V1X2W&Cmgu!jwl4hK[`^`]Language[`^`]English', 'English', '2016-05-24', NULL, 0),
(9, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Languages', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]Languages[`^`]English', 'English', '2016-10-09', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_students_class_details`
--

CREATE TABLE `zvs_students_class_details` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(240) NOT NULL,
  `identificationCode` varchar(240) NOT NULL,
  `studentClassCode` varchar(240) NOT NULL,
  `studentStreamCode` varchar(240) NOT NULL,
  `studentYearOfStudy` varchar(4) NOT NULL,
  `studentAdmissionNumber` varchar(30) NOT NULL,
  `registeredBy` varchar(240) NOT NULL,
  `studentClassStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_students_class_details`
--

INSERT INTO `zvs_students_class_details` (`id`, `systemSchoolCode`, `identificationCode`, `studentClassCode`, `studentStreamCode`, `studentYearOfStudy`, `studentAdmissionNumber`, `registeredBy`, `studentClassStatus`) VALUES
(2, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'e6mAOGO__zw3LClVBU0ne-9apgJVhiOFCsQVUW856CUzLsZ1SIP3jYbQqsy4O5nuWxt14oO7FK6nEVfHXEJZ3S3LQ4PJY1qawziESx1Lh6cv-FAKY8W-7uEjcFz2PUAz', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne[`^`]East', '2014', '0001', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(3, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', '3avG_MewSyIwuMTE3n0dTf3c8IQ2VyuyOP8a6C8sX7p171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ19tlmK8AtLL13CxFHJo3ecqxgTNonZMCoiN0Q7HWHjF', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne[`^`]West', '2015', '0002', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(4, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', '2gL1f93cu0uUa-rb_GvQRihjbrz9ixEm2zLsVxEaaAtxUvUuKrCzbRCOIa_tYsk7U671GMtmTMwUQEpdbcGKsrPLY3bjvkHNjvwN4-1HAlYdzjudhvKjVCOVXYYZ5D-2', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormTwo', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormTwo[`^`]East', '2016', '2371', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(5, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'e6mAOGO__zw3LClVBU0ne-9apgJVhiOFCsQVUW856CUzLsZ1SIP3jYbQqsy4O5nuWxt14oO7FK6nEVfHXEJZ3VQGCmTny9he1NaH7w6cxxtngI3nwmnjCbvwIulppdZc', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne[`^`]North', '2015', '0003', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(6, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'Y6U6uC21UebV5s3jkxnCc0t6h6qnRwGOpkmrjyExNCVmtFmACh_e7m7uyPdkM2qRf-VsWEg_OdqI9p811H2wim_NXt-bINsOYGqv4omZ1hrUAi_P8K-o8jz9GFuPQizL', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormThree', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormThree[`^`]West', '2012', '6578', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(7, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'WK-ETLGgAtaCzA1FfF_qODOsYf9MPqfQ-ot-Qn5xYiB171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ3dMsvGmbdMbIylFd4zV3q0ZLAF722IHGHhhUBXp7AZs', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne[`^`]East', '2014', '2372', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(8, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', '3avG_MewSyIwuMTE3n0dTf3c8IQ2VyuyOP8a6C8sX7p171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ-9Yi1Y4lCHQ5srGrjKzAbJlVC7m-WTjkhCjrnTXVxBc', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne[`^`]East', '2015', '2373', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(9, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'llyTLza9apoL_qsV-vP9IvkgLDkkNjQRb9cvImeLT7spRVR3wIe6QOol45Jjyl2kzuvH5j93aNBwowCJ6fpHsa3B_HWE9Xg-l3y2Be7rOemZJ4Cdpi-flQFaf1hUU2Wa', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne[`^`]East', '2016', '2374', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(10, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'llyTLza9apoL_qsV-vP9IvkgLDkkNjQRb9cvImeLT7t171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ0-MfGSmjwuJdlXlzrovGBdaI34izYg3ejGmlNHsSTxN', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne[`^`]East', '2016', '2376', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(11, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'BUVjLKjR2-gwMwQm8VDvfR6pe6hq4MLhEj5m4jUnJTl171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ4_xVsS9h17dszG8TkgI1pp8fM2o5EFSxDRJyixzVf9J', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne', 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO[`^`]FormOne[`^`]East', '2016', '2377', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_students_guardians_mapper`
--

CREATE TABLE `zvs_students_guardians_mapper` (
  `id` int(11) NOT NULL,
  `studentIdentificationCode` varchar(240) NOT NULL,
  `guardianIdentificationCode` varchar(240) NOT NULL,
  `recordStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_students_guardians_mapper`
--

INSERT INTO `zvs_students_guardians_mapper` (`id`, `studentIdentificationCode`, `guardianIdentificationCode`, `recordStatus`) VALUES
(1, 'e6mAOGO__zw3LClVBU0ne-9apgJVhiOFCsQVUW856CUzLsZ1SIP3jYbQqsy4O5nuWxt14oO7FK6nEVfHXEJZ3S3LQ4PJY1qawziESx1Lh6cv-FAKY8W-7uEjcFz2PUAz', 'e6mAOGO__zw3LClVBU0ne-9apgJVhiOFCsQVUW856CVdVRlHEsWYSlQIBHExsOyZ-_QMe4fIznNN-yToz2EmBMfJ0qbn1tpjv9MKIc3DbmV2f42fAVAQSowDIb_FOw6P', 1),
(2, '3avG_MewSyIwuMTE3n0dTf3c8IQ2VyuyOP8a6C8sX7p171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ19tlmK8AtLL13CxFHJo3ecqxgTNonZMCoiN0Q7HWHjF', '3avG_MewSyIwuMTE3n0dTf3c8IQ2VyuyOP8a6C8sX7rLptgW3USq1nyAawK6NhLkbZ3F2gtQR3jio4F9Vc_tHn5Ax4_kg8i6AOBKaVZHAA0huUG_TndqdI59uNQwbWXy', 1),
(3, '2gL1f93cu0uUa-rb_GvQRihjbrz9ixEm2zLsVxEaaAtxUvUuKrCzbRCOIa_tYsk7U671GMtmTMwUQEpdbcGKsrPLY3bjvkHNjvwN4-1HAlYdzjudhvKjVCOVXYYZ5D-2', 'vdEWiFSBc93Ntq7Eicl1WcARo52lypUga60kcbygnMLLptgW3USq1nyAawK6NhLkbZ3F2gtQR3jio4F9Vc_tHn5Ax4_kg8i6AOBKaVZHAA0huUG_TndqdI59uNQwbWXy', 1),
(4, 'e6mAOGO__zw3LClVBU0ne-9apgJVhiOFCsQVUW856CUzLsZ1SIP3jYbQqsy4O5nuWxt14oO7FK6nEVfHXEJZ3VQGCmTny9he1NaH7w6cxxtngI3nwmnjCbvwIulppdZc', 'e6mAOGO__zw3LClVBU0ne-9apgJVhiOFCsQVUW856CVdVRlHEsWYSlQIBHExsOyZ-_QMe4fIznNN-yToz2EmBNGDsRD7mIhsz3rxGiSG_j4weNLHBqcMHW27UfIekYLI', 1),
(5, 'Y6U6uC21UebV5s3jkxnCc0t6h6qnRwGOpkmrjyExNCVmtFmACh_e7m7uyPdkM2qRf-VsWEg_OdqI9p811H2wim_NXt-bINsOYGqv4omZ1hrUAi_P8K-o8jz9GFuPQizL', 'UASfVHRTsCrz1l_I05OHDPmVo6-VF7QgvstaWawIjjFmtFmACh_e7m7uyPdkM2qRf-VsWEg_OdqI9p811H2wim_NXt-bINsOYGqv4omZ1hrUAi_P8K-o8jz9GFuPQizL', 1),
(6, 'WK-ETLGgAtaCzA1FfF_qODOsYf9MPqfQ-ot-Qn5xYiB171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ3dMsvGmbdMbIylFd4zV3q0ZLAF722IHGHhhUBXp7AZs', 'WK-ETLGgAtaCzA1FfF_qODOsYf9MPqfQ-ot-Qn5xYiDLptgW3USq1nyAawK6NhLkbZ3F2gtQR3jio4F9Vc_tHpKXn_q2g79_jsVFCcmeo9zDX3eM9sFB1n6Q6gLG7lMJ', 1),
(7, '3avG_MewSyIwuMTE3n0dTf3c8IQ2VyuyOP8a6C8sX7p171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ-9Yi1Y4lCHQ5srGrjKzAbJlVC7m-WTjkhCjrnTXVxBc', 'WK-ETLGgAtaCzA1FfF_qODOsYf9MPqfQ-ot-Qn5xYiDLptgW3USq1nyAawK6NhLkbZ3F2gtQR3jio4F9Vc_tHjisfGu_0jxC_jY3LqLpvkrUEoXCnRwl3yujWJpYGFri', 1),
(8, 'llyTLza9apoL_qsV-vP9IvkgLDkkNjQRb9cvImeLT7spRVR3wIe6QOol45Jjyl2kzuvH5j93aNBwowCJ6fpHsa3B_HWE9Xg-l3y2Be7rOemZJ4Cdpi-flQFaf1hUU2Wa', 'llyTLza9apoL_qsV-vP9IvkgLDkkNjQRb9cvImeLT7t171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ3J5rVfM5NtUlWazKtyiB5iznyOLNlCqenWcINCwlotC', 1),
(9, 'llyTLza9apoL_qsV-vP9IvkgLDkkNjQRb9cvImeLT7t171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ0-MfGSmjwuJdlXlzrovGBdaI34izYg3ejGmlNHsSTxN', 'WK-ETLGgAtaCzA1FfF_qODOsYf9MPqfQ-ot-Qn5xYiDLptgW3USq1nyAawK6NhLkbZ3F2gtQR3jio4F9Vc_tHvKp0x7WhgAx_2YvQpAjYnAI42kjgetfU8E4I2VILFGV', 1),
(10, 'BUVjLKjR2-gwMwQm8VDvfR6pe6hq4MLhEj5m4jUnJTl171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ4_xVsS9h17dszG8TkgI1pp8fM2o5EFSxDRJyixzVf9J', 'BUVjLKjR2-gwMwQm8VDvfR6pe6hq4MLhEj5m4jUnJTnLptgW3USq1nyAawK6NhLkbZ3F2gtQR3jio4F9Vc_tHosxff2L7bWm6xqr2QZKvAaLG-0K3_HnKn8Bx1oKGOxh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_students_guardian_details`
--

CREATE TABLE `zvs_students_guardian_details` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(240) NOT NULL,
  `identificationCode` varchar(240) NOT NULL,
  `guardianDesignation` varchar(10) NOT NULL,
  `guardianFirstName` varchar(60) NOT NULL,
  `guardianMiddleName` varchar(60) DEFAULT NULL,
  `guardianLastName` varchar(60) NOT NULL,
  `guardianGender` varchar(15) NOT NULL,
  `guardianDateOfBirth` varchar(15) NOT NULL,
  `guardianReligion` varchar(15) DEFAULT NULL,
  `guardianCountry` varchar(15) NOT NULL,
  `guardianLocality` varchar(60) NOT NULL,
  `guardianBoxAddress` varchar(60) DEFAULT NULL,
  `guardianPhoneNumber` varchar(60) NOT NULL,
  `guardianRelation` varchar(60) NOT NULL,
  `guardianOccupation` varchar(120) DEFAULT NULL,
  `guardianLanguage` varchar(60) NOT NULL,
  `registeredBy` varchar(240) NOT NULL,
  `guardianStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_students_guardian_details`
--

INSERT INTO `zvs_students_guardian_details` (`id`, `systemSchoolCode`, `identificationCode`, `guardianDesignation`, `guardianFirstName`, `guardianMiddleName`, `guardianLastName`, `guardianGender`, `guardianDateOfBirth`, `guardianReligion`, `guardianCountry`, `guardianLocality`, `guardianBoxAddress`, `guardianPhoneNumber`, `guardianRelation`, `guardianOccupation`, `guardianLanguage`, `registeredBy`, `guardianStatus`) VALUES
(1, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'e6mAOGO__zw3LClVBU0ne-9apgJVhiOFCsQVUW856CVdVRlHEsWYSlQIBHExsOyZ-_QMe4fIznNN-yToz2EmBMfJ0qbn1tpjv9MKIc3DbmV2f42fAVAQSowDIb_FOw6P', 'Mr', 'George', 'Otieno', 'Abong''o', 'Male', '23-09-2016', 'Christian', '+254', '17', 'P.O Box 73619 -00100', '0703334363', 'Parent', 'Accountant', 'English', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(2, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', '3avG_MewSyIwuMTE3n0dTf3c8IQ2VyuyOP8a6C8sX7rLptgW3USq1nyAawK6NhLkbZ3F2gtQR3jio4F9Vc_tHn5Ax4_kg8i6AOBKaVZHAA0huUG_TndqdI59uNQwbWXy', 'Mr', 'Wasabi', 'Ombaka', 'Anene', 'Male', '23-09-2016', 'Christian', '+254', '3', 'P.O Box 73619 -00100', '0703334363', 'Parent', 'Farmer', 'English', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(3, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'vdEWiFSBc93Ntq7Eicl1WcARo52lypUga60kcbygnMLLptgW3USq1nyAawK6NhLkbZ3F2gtQR3jio4F9Vc_tHn5Ax4_kg8i6AOBKaVZHAA0huUG_TndqdI59uNQwbWXy', 'Mr', 'George', 'Otieno', 'Abong''o', 'Male', '23-09-2016', 'Christian', '+254', '1', 'P.O Box 73619 -00100', '0703334363', 'Parent', 'Accountant', 'English', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(4, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'e6mAOGO__zw3LClVBU0ne-9apgJVhiOFCsQVUW856CVdVRlHEsWYSlQIBHExsOyZ-_QMe4fIznNN-yToz2EmBNGDsRD7mIhsz3rxGiSG_j4weNLHBqcMHW27UfIekYLI', 'Mr', 'George', 'Otieno', 'Abong''o', 'Male', '24-09-2016', 'Christian', '+254', '17', 'P.O Box 73619 -00100', '0703334363', 'Parent', 'Accountant', 'English', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(5, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'UASfVHRTsCrz1l_I05OHDPmVo6-VF7QgvstaWawIjjFmtFmACh_e7m7uyPdkM2qRf-VsWEg_OdqI9p811H2wim_NXt-bINsOYGqv4omZ1hrUAi_P8K-o8jz9GFuPQizL', 'Mr', 'Wairimu', NULL, 'Wamatee', 'Male', '28-08-2011', 'Christian', '+254', '4', '34351', '07245678', 'Parent', 'teacher', 'French', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(6, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'WK-ETLGgAtaCzA1FfF_qODOsYf9MPqfQ-ot-Qn5xYiDLptgW3USq1nyAawK6NhLkbZ3F2gtQR3jio4F9Vc_tHpKXn_q2g79_jsVFCcmeo9zDX3eM9sFB1n6Q6gLG7lMJ', 'Mr', 'George', 'Otieno', 'Abong''o', 'Male', '01-10-2016', 'Christian', '+254', '6', 'P.O Box 73619 -00100', '0703334363', 'Parent', 'Accountant', 'English', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(7, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'WK-ETLGgAtaCzA1FfF_qODOsYf9MPqfQ-ot-Qn5xYiDLptgW3USq1nyAawK6NhLkbZ3F2gtQR3jio4F9Vc_tHjisfGu_0jxC_jY3LqLpvkrUEoXCnRwl3yujWJpYGFri', 'Mr', 'George', 'Otieno', 'Abong''o', 'Male', '01-10-2016', 'Christian', '+254', '6', 'P.O Box 73619 -00100', '0703334363', 'Parent', 'Accountant', 'English', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(8, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'llyTLza9apoL_qsV-vP9IvkgLDkkNjQRb9cvImeLT7t171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ3J5rVfM5NtUlWazKtyiB5iznyOLNlCqenWcINCwlotC', 'Mr', 'George', 'Otieno', 'Abong''o', 'Male', '01-10-2016', 'Christian', '+254', '2', 'P.O Box 73619 -00100', '0703334363', 'Parent', 'Accountant', 'English', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(9, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'WK-ETLGgAtaCzA1FfF_qODOsYf9MPqfQ-ot-Qn5xYiDLptgW3USq1nyAawK6NhLkbZ3F2gtQR3jio4F9Vc_tHvKp0x7WhgAx_2YvQpAjYnAI42kjgetfU8E4I2VILFGV', 'Mr', 'George', 'Otieno', 'Abong''o', 'Male', '01-10-2016', 'Christian', '+254', '6', 'P.O Box 73619 -00100', '0703334363', 'Parent', 'Accountant', 'English', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(10, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'BUVjLKjR2-gwMwQm8VDvfR6pe6hq4MLhEj5m4jUnJTnLptgW3USq1nyAawK6NhLkbZ3F2gtQR3jio4F9Vc_tHosxff2L7bWm6xqr2QZKvAaLG-0K3_HnKn8Bx1oKGOxh', 'Mr', 'George', 'Otieno', 'Abong''o', 'Male', '01-10-2016', 'Christian', '+254', '5', 'P.O Box 73619 -00100', '0703334363', 'Parent', 'Accountant', 'English', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_students_medical_details`
--

CREATE TABLE `zvs_students_medical_details` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(240) NOT NULL,
  `studentIdentificationCode` varchar(240) NOT NULL,
  `studentAdmissionNumber` varchar(30) NOT NULL,
  `isStudentBloodGroup` varchar(5) NOT NULL,
  `studentBloodGroup` text,
  `isStudentDisable` varchar(5) NOT NULL,
  `studentDisability` text,
  `isStudentMedicated` varchar(5) NOT NULL,
  `studentMedication` text,
  `isStudentAllergic` varchar(5) NOT NULL,
  `studentAllergic` text,
  `isStudentTreatment` varchar(5) NOT NULL,
  `studentTreatment` text,
  `isStudentPhysician` varchar(5) NOT NULL,
  `physicianDesignation` varchar(5) DEFAULT NULL,
  `physicianFirstName` varchar(60) DEFAULT NULL,
  `physicianLastName` varchar(60) DEFAULT NULL,
  `firstPhysicianMobileNumber` varchar(30) DEFAULT NULL,
  `secondPhysicianMobileNumber` varchar(30) DEFAULT NULL,
  `physicianEmailAddress` varchar(60) DEFAULT NULL,
  `physicianBoxAddress` varchar(60) DEFAULT NULL,
  `physicianCountry` varchar(15) DEFAULT NULL,
  `physicianLocality` varchar(30) DEFAULT NULL,
  `isStudentHospital` varchar(5) NOT NULL,
  `hospitalName` varchar(60) DEFAULT NULL,
  `firstHospitalNumber` varchar(30) DEFAULT NULL,
  `secondHospitalNumber` varchar(30) DEFAULT NULL,
  `hospitalBoxAddress` varchar(60) DEFAULT NULL,
  `hospitalEmailAddress` varchar(60) DEFAULT NULL,
  `hospitalCountry` varchar(15) DEFAULT NULL,
  `hospitalLocality` varchar(30) DEFAULT NULL,
  `registeredBy` varchar(240) NOT NULL,
  `studentStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_students_medical_details`
--

INSERT INTO `zvs_students_medical_details` (`id`, `systemSchoolCode`, `studentIdentificationCode`, `studentAdmissionNumber`, `isStudentBloodGroup`, `studentBloodGroup`, `isStudentDisable`, `studentDisability`, `isStudentMedicated`, `studentMedication`, `isStudentAllergic`, `studentAllergic`, `isStudentTreatment`, `studentTreatment`, `isStudentPhysician`, `physicianDesignation`, `physicianFirstName`, `physicianLastName`, `firstPhysicianMobileNumber`, `secondPhysicianMobileNumber`, `physicianEmailAddress`, `physicianBoxAddress`, `physicianCountry`, `physicianLocality`, `isStudentHospital`, `hospitalName`, `firstHospitalNumber`, `secondHospitalNumber`, `hospitalBoxAddress`, `hospitalEmailAddress`, `hospitalCountry`, `hospitalLocality`, `registeredBy`, `studentStatus`) VALUES
(1, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'e6mAOGO__zw3LClVBU0ne-9apgJVhiOFCsQVUW856CUzLsZ1SIP3jYbQqsy4O5nuWxt14oO7FK6nEVfHXEJZ3S3LQ4PJY1qawziESx1Lh6cv-FAKY8W-7uEjcFz2PUAz', '', 'Yes', 'O+', 'Yes', 'My ears are so big, I hear everything.', 'Yes', 'I had a tooth recently extracted and I am still on medication', 'Yes', 'I formulate goose pimples when it gets cold', 'Yes', 'At night, I usually get scared', 'Yes', 'Dr', 'Michael', 'Ocholla', '0711111111', '0722222222', 'ocholla@gmail.com', 'P.O Box 25555 - 001111', '+254', '17', 'Yes', 'Aga Khan', '071111111', '07111111', 'P.O Box 7777 - 00100', 'admin@agakhan.com', '+254', '17', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(2, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', '3avG_MewSyIwuMTE3n0dTf3c8IQ2VyuyOP8a6C8sX7p171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ19tlmK8AtLL13CxFHJo3ecqxgTNonZMCoiN0Q7HWHjF', '', 'Yes', 'AB+', 'Yes', 'My ears are so big, I hear everything.', 'Yes', 'I had a tooth recently extracted and I am still on medication', 'Yes', 'I formulate goose pimples when it gets cold', 'Yes', 'At night, I usually get scared', 'Yes', 'Dr', 'Michael', 'Ocholla', '0711111111', '0722222222', 'ocholla@gmail.com', 'P.O Box 25555 - 001111', '+254', NULL, 'Yes', 'Aga Khan', '071111111', '07111111', 'P.O Box 7777 - 00100', 'admin@agakhan.com', '+254', NULL, '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(3, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', '2gL1f93cu0uUa-rb_GvQRihjbrz9ixEm2zLsVxEaaAtxUvUuKrCzbRCOIa_tYsk7U671GMtmTMwUQEpdbcGKsrPLY3bjvkHNjvwN4-1HAlYdzjudhvKjVCOVXYYZ5D-2', '2371', 'No', NULL, 'Yes', NULL, 'No', NULL, 'No', NULL, 'Yes', 'At night, I usually get scared', 'Yes', 'Dr', 'Michael', 'Ocholla', '0711111111', '0722222222', 'ocholla@gmail.com', 'P.O Box 25555 - 001111', '+254', NULL, 'Yes', 'Aga Khan', '071111111', '07111111', 'P.O Box 7777 - 00100', 'admin@agakhan.com', '+254', NULL, '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(4, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'e6mAOGO__zw3LClVBU0ne-9apgJVhiOFCsQVUW856CUzLsZ1SIP3jYbQqsy4O5nuWxt14oO7FK6nEVfHXEJZ3VQGCmTny9he1NaH7w6cxxtngI3nwmnjCbvwIulppdZc', '0003', 'Yes', 'O+', 'Yes', 'My ears are so big, I hear everything.', 'Yes', 'I had a tooth recently extracted and I am still on medication', 'Yes', 'I formulate goose pimples when it gets cold', 'Yes', 'At night, I usually get scared', 'Yes', 'Dr', 'Michael', 'Ocholla', '0711111111', '0722222222', 'ocholla@gmail.com', 'P.O Box 25555 - 001111', '+254', NULL, 'Yes', 'Aga Khan', '071111111', '07111111', 'P.O Box 7777 - 00100', 'admin@agakhan.com', '+254', NULL, '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(5, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'Y6U6uC21UebV5s3jkxnCc0t6h6qnRwGOpkmrjyExNCVmtFmACh_e7m7uyPdkM2qRf-VsWEg_OdqI9p811H2wim_NXt-bINsOYGqv4omZ1hrUAi_P8K-o8jz9GFuPQizL', '6578', 'Yes', 'A+', 'No', NULL, 'No', NULL, 'No', NULL, 'No', NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(6, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'WK-ETLGgAtaCzA1FfF_qODOsYf9MPqfQ-ot-Qn5xYiB171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ3dMsvGmbdMbIylFd4zV3q0ZLAF722IHGHhhUBXp7AZs', '2372', 'Yes', 'O+', 'Yes', 'My ears are so big, I hear everything.', 'Yes', 'I had a tooth recently extracted and I am still on medication', 'Yes', 'I formulate goose pimples when it gets cold', 'Yes', 'At night, I usually get scared', 'Yes', 'Dr', 'Michael', 'Ocholla', '0711111111', '0722222222', 'ocholla@gmail.com', 'P.O Box 25555 - 001111', '+254', NULL, 'Yes', 'Aga Khan', '071111111', '07111111', 'P.O Box 7777 - 00100', 'admin@agakhan.com', '+254', NULL, '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(7, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', '3avG_MewSyIwuMTE3n0dTf3c8IQ2VyuyOP8a6C8sX7p171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ-9Yi1Y4lCHQ5srGrjKzAbJlVC7m-WTjkhCjrnTXVxBc', '2373', 'Yes', 'O+', 'Yes', 'My ears are so big, I hear everything.', 'Yes', 'I had a tooth recently extracted and I am still on medication', 'Yes', 'I formulate goose pimples when it gets cold', 'Yes', 'At night, I usually get scared', 'Yes', 'Dr', 'Michael', 'Ocholla', '0711111111', '0722222222', 'ocholla@gmail.com', 'P.O Box 25555 - 001111', '+254', NULL, 'Yes', 'Aga Khan', '071111111', '07111111', 'P.O Box 7777 - 00100', 'admin@agakhan.com', '+254', NULL, '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(8, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'llyTLza9apoL_qsV-vP9IvkgLDkkNjQRb9cvImeLT7spRVR3wIe6QOol45Jjyl2kzuvH5j93aNBwowCJ6fpHsa3B_HWE9Xg-l3y2Be7rOemZJ4Cdpi-flQFaf1hUU2Wa', '2374', 'Yes', 'O+', 'Yes', 'My ears are so big, I hear everything.', 'Yes', 'I had a tooth recently extracted and I am still on medication', 'Yes', 'I formulate goose pimples when it gets cold', 'Yes', 'At night, I usually get scared', 'Yes', 'Dr', 'Michael', 'Ocholla', '0711111111', '0722222222', 'ocholla@gmail.com', 'P.O Box 25555 - 001111', '+254', NULL, 'Yes', 'Aga Khan', '071111111', '07111111', 'P.O Box 7777 - 00100', 'admin@agakhan.com', '+254', NULL, '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(9, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'llyTLza9apoL_qsV-vP9IvkgLDkkNjQRb9cvImeLT7t171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ0-MfGSmjwuJdlXlzrovGBdaI34izYg3ejGmlNHsSTxN', '2376', 'Yes', 'O+', 'Yes', 'My ears are so big, I hear everything.', 'Yes', 'I had a tooth recently extracted and I am still on medication', 'Yes', 'I formulate goose pimples when it gets cold', 'Yes', 'At night, I usually get scared', 'Yes', 'Dr', 'Michael', 'Ocholla', '0711111111', '0722222222', 'ocholla@gmail.com', 'P.O Box 25555 - 001111', '+254', NULL, 'Yes', 'Aga Khan', '071111111', '07111111', 'P.O Box 7777 - 00100', 'admin@agakhan.com', '+254', NULL, '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(10, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'BUVjLKjR2-gwMwQm8VDvfR6pe6hq4MLhEj5m4jUnJTl171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ4_xVsS9h17dszG8TkgI1pp8fM2o5EFSxDRJyixzVf9J', '2377', 'Yes', 'O+', 'Yes', 'My ears are so big, I hear everything.', 'Yes', 'I had a tooth recently extracted and I am still on medication', 'Yes', 'I formulate goose pimples when it gets cold', 'Yes', 'At night, I usually get scared', 'Yes', 'Dr', 'Michael', 'Ocholla', '0711111111', '0722222222', 'ocholla@gmail.com', 'P.O Box 25555 - 001111', '+254', NULL, 'Yes', 'Aga Khan', '071111111', '07111111', 'P.O Box 7777 - 00100', 'admin@agakhan.com', '+254', NULL, '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_students_personal_details`
--

CREATE TABLE `zvs_students_personal_details` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(240) NOT NULL,
  `identificationCode` varchar(240) NOT NULL,
  `studentAdmissionNumber` varchar(30) NOT NULL,
  `studentFirstName` varchar(60) NOT NULL,
  `studentMiddleName` varchar(60) NOT NULL,
  `studentLastName` varchar(60) NOT NULL,
  `studentGender` varchar(60) NOT NULL,
  `studentDateOfBirth` varchar(15) NOT NULL,
  `studentReligion` varchar(30) NOT NULL,
  `studentCountry` varchar(15) NOT NULL,
  `studentLocality` varchar(100) NOT NULL,
  `studentBoxAddress` varchar(60) NOT NULL,
  `studentPhoneNumber` varchar(60) NOT NULL,
  `studentLanguage` varchar(60) NOT NULL,
  `registeredBy` varchar(240) NOT NULL,
  `studentStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_students_personal_details`
--

INSERT INTO `zvs_students_personal_details` (`id`, `systemSchoolCode`, `identificationCode`, `studentAdmissionNumber`, `studentFirstName`, `studentMiddleName`, `studentLastName`, `studentGender`, `studentDateOfBirth`, `studentReligion`, `studentCountry`, `studentLocality`, `studentBoxAddress`, `studentPhoneNumber`, `studentLanguage`, `registeredBy`, `studentStatus`) VALUES
(1, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'e6mAOGO__zw3LClVBU0ne-9apgJVhiOFCsQVUW856CUzLsZ1SIP3jYbQqsy4O5nuWxt14oO7FK6nEVfHXEJZ3S3LQ4PJY1qawziESx1Lh6cv-FAKY8W-7uEjcFz2PUAz', '0001', 'Mathew', 'Juma', 'Otieno', 'Male', '23-09-2016', 'Christian', '+254', '17', 'P.O Box 73619 -00100', '0727074108', 'English', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(2, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', '3avG_MewSyIwuMTE3n0dTf3c8IQ2VyuyOP8a6C8sX7p171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ19tlmK8AtLL13CxFHJo3ecqxgTNonZMCoiN0Q7HWHjF', '0002', 'Regan', 'Inganji', 'Mulembe', 'Male', '23-09-2016', 'Christian', '+254', '3', 'P.O Box 73619 -00100', '0727074108', 'English', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(3, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', '2gL1f93cu0uUa-rb_GvQRihjbrz9ixEm2zLsVxEaaAtxUvUuKrCzbRCOIa_tYsk7U671GMtmTMwUQEpdbcGKsrPLY3bjvkHNjvwN4-1HAlYdzjudhvKjVCOVXYYZ5D-2', '2371', 'Frida', 'Mukei', 'Mulili', 'Female', '22-12-1992', 'Christian', '+254', '23', 'P.O Box 73619 -00100', '0727074108', 'English', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(4, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'e6mAOGO__zw3LClVBU0ne-9apgJVhiOFCsQVUW856CUzLsZ1SIP3jYbQqsy4O5nuWxt14oO7FK6nEVfHXEJZ3VQGCmTny9he1NaH7w6cxxtngI3nwmnjCbvwIulppdZc', '0003', 'Marsellah', 'Ogendo', 'Otieno', 'Female', '24-09-2016', 'Christian', '+254', '17', 'P.O Box 73619 -00100', '0727074108', 'English', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(5, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'Y6U6uC21UebV5s3jkxnCc0t6h6qnRwGOpkmrjyExNCVmtFmACh_e7m7uyPdkM2qRf-VsWEg_OdqI9p811H2wim_NXt-bINsOYGqv4omZ1hrUAi_P8K-o8jz9GFuPQizL', '6578', 'Mary', 'Emily', 'Jane', 'Female', '30-07-2012', 'Hindu', '+254', '7', '2431', '0700222222', 'French', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(6, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'WK-ETLGgAtaCzA1FfF_qODOsYf9MPqfQ-ot-Qn5xYiB171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ3dMsvGmbdMbIylFd4zV3q0ZLAF722IHGHhhUBXp7AZs', '2372', 'Mathew', 'Juma', 'Otieno', 'Male', '01-10-2016', 'Christian', '+254', '6', 'P.O Box 73619 -00100', '0727074108', 'English', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(7, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', '3avG_MewSyIwuMTE3n0dTf3c8IQ2VyuyOP8a6C8sX7p171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ-9Yi1Y4lCHQ5srGrjKzAbJlVC7m-WTjkhCjrnTXVxBc', '2373', 'Mathew', 'Juma', 'Otieno', 'Male', '01-10-2016', 'Christian', '+254', '3', 'P.O Box 73619 -00100', '0727074108', 'English', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(8, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'llyTLza9apoL_qsV-vP9IvkgLDkkNjQRb9cvImeLT7spRVR3wIe6QOol45Jjyl2kzuvH5j93aNBwowCJ6fpHsa3B_HWE9Xg-l3y2Be7rOemZJ4Cdpi-flQFaf1hUU2Wa', '2374', 'Mathew', 'Juma', 'Otieno', 'Male', '01-10-2016', 'Christian', '+254', '2', 'P.O Box 73619 -00100', '0727074108', 'English', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(9, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'llyTLza9apoL_qsV-vP9IvkgLDkkNjQRb9cvImeLT7t171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ0-MfGSmjwuJdlXlzrovGBdaI34izYg3ejGmlNHsSTxN', '2376', 'Mathew', 'Juma', 'Otieno', 'Male', '01-10-2016', 'Christian', '+254', '2', 'P.O Box 73619 -00100', '0727074108', 'English', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1),
(10, 'xnCwJMK&LVkrX#bmBl40$!eW29IcjO', 'BUVjLKjR2-gwMwQm8VDvfR6pe6hq4MLhEj5m4jUnJTl171m8qyRVLlYDMtAlw_RIkpYo4rUpXMlm82opCc8oJ4_xVsS9h17dszG8TkgI1pp8fM2o5EFSxDRJyixzVf9J', '2377', 'Mathew', 'Juma', 'Otieno', 'Male', '01-10-2016', 'Christian', '+254', '5', 'P.O Box 73619 -00100', '0727074108', 'English', '_ggzjo422a8OskMuV3J0Q00DJVEN7YG7VXu25mK_FKx-sndjTSmU-dlm7lcVktUrhGii79_zec1hFqCeNGTH1t-asd086NLDROS8Yw5zXB-D0xmozRC8lndDcG1CPW8k', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_super_admin`
--

CREATE TABLE `zvs_super_admin` (
  `id` int(11) NOT NULL,
  `identificationCode` varchar(200) NOT NULL,
  `idNumber` varchar(45) NOT NULL,
  `designation` varchar(15) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `middleName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) NOT NULL,
  `mobileNumber` varchar(15) NOT NULL,
  `boxAddress` varchar(60) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `country` varchar(11) NOT NULL,
  `locality` varchar(11) NOT NULL,
  `imagePath` varchar(300) DEFAULT NULL,
  `dateCreated` date NOT NULL,
  `timeCreated` time NOT NULL,
  `dateModified` date DEFAULT NULL,
  `timeModified` time DEFAULT NULL,
  `userStatus` tinyint(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_super_admin`
--

INSERT INTO `zvs_super_admin` (`id`, `identificationCode`, `idNumber`, `designation`, `firstName`, `middleName`, `lastName`, `mobileNumber`, `boxAddress`, `gender`, `country`, `locality`, `imagePath`, `dateCreated`, `timeCreated`, `dateModified`, `timeModified`, `userStatus`) VALUES
(1, 'pSoaHX1j8XXb2diMDomSijvRhBm6bxybcBWAbm6KL-mtWlM0NHJJdIXj6sxsi4NWMsv34U7kuRjGb3fd9rPlDMw_RESDtvMpAfdTYg23vR_7rylRfEqSABHs29kz0IxS', 'ZVS_PSA_25138058', 'Mr', 'Mathew', 'Juma', 'Otieno', '0727074108', '73619 Nairobi', 'Male', '+254', '30', 'PSoaHX1j8XXb2diMDomSijvRhBm6bxybcBWAbm6KL-mtWlM0NHJJdIXj6sxsi4NWMsv34U7kuRjGb3fd9rPlDMw_RESDtvMpAfdTYg23vR_7rylRfEqSABHs29kz0IxS.png', '2015-07-04', '06:38:53', NULL, NULL, 1),
(2, 'pSoaHX1j8XXb2diMDomSijvRhBm6bxybcBWAbm6KL-mKnf601gVVsnjNPfnt5wclTlXDRp78mC6Y69_jWauJjagrwdqBkdLh9RvqvMF8O3_9G2EJloD2wNVgUddYWyLw', 'ZVS_PSA_2727272722', 'Ms', 'Frida', 'Mukei', 'Mulili', '0703334363', 'P.O. BOX 143, KISUMU 40100', 'Female', '+254', '30', 'PSoaHX1j8XXb2diMDomSijvRhBm6bxybcBWAbm6KL-mKnf601gVVsnjNPfnt5wclTlXDRp78mC6Y69_jWauJjagrwdqBkdLh9RvqvMF8O3_9G2EJloD2wNVgUddYWyLw.png', '2016-01-29', '21:14:53', NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `zvs_application_users`
--
ALTER TABLE `zvs_application_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identificationCode` (`identificationCode`);

--
-- Indexes for table `zvs_blood_groups`
--
ALTER TABLE `zvs_blood_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zvs_class_school_fees`
--
ALTER TABLE `zvs_class_school_fees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `systemFeeCode` (`systemFeeCode`);

--
-- Indexes for table `zvs_general_school_fees`
--
ALTER TABLE `zvs_general_school_fees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `systemFeeCode` (`systemFeeCode`);

--
-- Indexes for table `zvs_platform_admin`
--
ALTER TABLE `zvs_platform_admin`
  ADD PRIMARY KEY (`id`,`identificationCode`);

--
-- Indexes for table `zvs_platform_designations`
--
ALTER TABLE `zvs_platform_designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zvs_platform_guardians`
--
ALTER TABLE `zvs_platform_guardians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zvs_platform_languages`
--
ALTER TABLE `zvs_platform_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zvs_platform_religions`
--
ALTER TABLE `zvs_platform_religions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zvs_platform_resources`
--
ALTER TABLE `zvs_platform_resources`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `resourceId_UNIQUE` (`resourceId`);

--
-- Indexes for table `zvs_resource_categories`
--
ALTER TABLE `zvs_resource_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `categoryName_UNIQUE` (`categoryName`);

--
-- Indexes for table `zvs_resource_role_mapper`
--
ALTER TABLE `zvs_resource_role_mapper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zvs_school_admin`
--
ALTER TABLE `zvs_school_admin`
  ADD PRIMARY KEY (`id`,`identificationCode`);

--
-- Indexes for table `zvs_school_classes`
--
ALTER TABLE `zvs_school_classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schoolClassCode` (`schoolClassCode`);

--
-- Indexes for table `zvs_school_country`
--
ALTER TABLE `zvs_school_country`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countryCode` (`countryCode`);

--
-- Indexes for table `zvs_school_departments`
--
ALTER TABLE `zvs_school_departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schoolDepartmentName_UNIQUE` (`schoolDepartmentName`);

--
-- Indexes for table `zvs_school_department_heads`
--
ALTER TABLE `zvs_school_department_heads`
  ADD PRIMARY KEY (`identificationCode`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `identificationCode_UNIQUE` (`identificationCode`);

--
-- Indexes for table `zvs_school_details`
--
ALTER TABLE `zvs_school_details`
  ADD PRIMARY KEY (`id`,`systemSchoolCode`);

--
-- Indexes for table `zvs_school_examinations`
--
ALTER TABLE `zvs_school_examinations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `systemExamCode` (`systemExamCode`);

--
-- Indexes for table `zvs_school_general_admins`
--
ALTER TABLE `zvs_school_general_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zvs_school_grades`
--
ALTER TABLE `zvs_school_grades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `systemGradeCode` (`systemGradeCode`);

--
-- Indexes for table `zvs_school_hostels`
--
ALTER TABLE `zvs_school_hostels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schoolHostelCode_UNIQUE` (`schoolHostelCode`);

--
-- Indexes for table `zvs_school_locality`
--
ALTER TABLE `zvs_school_locality`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `localityCode` (`localityCode`);

--
-- Indexes for table `zvs_school_roles`
--
ALTER TABLE `zvs_school_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schoolRoleCode_UNIQUE` (`schoolRoleCode`);

--
-- Indexes for table `zvs_school_streams`
--
ALTER TABLE `zvs_school_streams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schoolStreamCode` (`schoolStreamCode`);

--
-- Indexes for table `zvs_school_subjects`
--
ALTER TABLE `zvs_school_subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `systemSubjectCode` (`systemSubjectCode`);

--
-- Indexes for table `zvs_school_sub_departments`
--
ALTER TABLE `zvs_school_sub_departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schoolSubDepartmentCode_UNIQUE` (`schoolSubDepartmentCode`);

--
-- Indexes for table `zvs_students_class_details`
--
ALTER TABLE `zvs_students_class_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zvs_students_guardians_mapper`
--
ALTER TABLE `zvs_students_guardians_mapper`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentIdentificationCode` (`studentIdentificationCode`);

--
-- Indexes for table `zvs_students_guardian_details`
--
ALTER TABLE `zvs_students_guardian_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identificationCode` (`identificationCode`);

--
-- Indexes for table `zvs_students_medical_details`
--
ALTER TABLE `zvs_students_medical_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentIdentificationCode` (`studentIdentificationCode`);

--
-- Indexes for table `zvs_students_personal_details`
--
ALTER TABLE `zvs_students_personal_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identificationCode` (`identificationCode`);

--
-- Indexes for table `zvs_super_admin`
--
ALTER TABLE `zvs_super_admin`
  ADD PRIMARY KEY (`id`,`identificationCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `zvs_application_users`
--
ALTER TABLE `zvs_application_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `zvs_blood_groups`
--
ALTER TABLE `zvs_blood_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `zvs_class_school_fees`
--
ALTER TABLE `zvs_class_school_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `zvs_general_school_fees`
--
ALTER TABLE `zvs_general_school_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `zvs_platform_admin`
--
ALTER TABLE `zvs_platform_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `zvs_platform_designations`
--
ALTER TABLE `zvs_platform_designations`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `zvs_platform_guardians`
--
ALTER TABLE `zvs_platform_guardians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `zvs_platform_languages`
--
ALTER TABLE `zvs_platform_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `zvs_platform_religions`
--
ALTER TABLE `zvs_platform_religions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `zvs_platform_resources`
--
ALTER TABLE `zvs_platform_resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `zvs_resource_categories`
--
ALTER TABLE `zvs_resource_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `zvs_resource_role_mapper`
--
ALTER TABLE `zvs_resource_role_mapper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `zvs_school_admin`
--
ALTER TABLE `zvs_school_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `zvs_school_classes`
--
ALTER TABLE `zvs_school_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `zvs_school_country`
--
ALTER TABLE `zvs_school_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=276;
--
-- AUTO_INCREMENT for table `zvs_school_departments`
--
ALTER TABLE `zvs_school_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `zvs_school_department_heads`
--
ALTER TABLE `zvs_school_department_heads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zvs_school_details`
--
ALTER TABLE `zvs_school_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `zvs_school_examinations`
--
ALTER TABLE `zvs_school_examinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `zvs_school_grades`
--
ALTER TABLE `zvs_school_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `zvs_school_hostels`
--
ALTER TABLE `zvs_school_hostels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `zvs_school_locality`
--
ALTER TABLE `zvs_school_locality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `zvs_school_roles`
--
ALTER TABLE `zvs_school_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `zvs_school_streams`
--
ALTER TABLE `zvs_school_streams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `zvs_school_subjects`
--
ALTER TABLE `zvs_school_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `zvs_school_sub_departments`
--
ALTER TABLE `zvs_school_sub_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `zvs_students_class_details`
--
ALTER TABLE `zvs_students_class_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `zvs_students_guardians_mapper`
--
ALTER TABLE `zvs_students_guardians_mapper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `zvs_students_guardian_details`
--
ALTER TABLE `zvs_students_guardian_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `zvs_students_medical_details`
--
ALTER TABLE `zvs_students_medical_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `zvs_students_personal_details`
--
ALTER TABLE `zvs_students_personal_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `zvs_super_admin`
--
ALTER TABLE `zvs_super_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
