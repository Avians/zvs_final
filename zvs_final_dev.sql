-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 28, 2017 at 09:10 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zvs_final(dev)`
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_application_users`
--

INSERT INTO `zvs_application_users` (`id`, `email`, `password`, `identificationCode`, `userStatus`) VALUES
(1, 'zvs.super.admin@zilasvirtualschools.com', '-Ehl7B6z-kmxchfs5X0J9syfbjr5U3HOEs_ZGemaD5w', 'pSoaHX1j8XXb2diMDomSijvRhBm6bxybcBWAbm6KL-mtWlM0NHJJdIXj6sxsi4NWMsv34U7kuRjGb3fd9rPlDMw_RESDtvMpAfdTYg23vR_7rylRfEqSABHs29kz0IxS', 1),
(2, 'zvs.platform.admin@zilasvirtualschools.com', '-Ehl7B6z-kmxchfs5X0J9syfbjr5U3HOEs_ZGemaD5w', 'YwfPDAkaDbBBuNbYAHfR8030FKTxS2GuxQ8uKKThnfbiDl4uFwZHOU-hRZzth9RM42ZewiPLLSyjliRIUZq9Cm_KW7hQeCNX5bW0ZQmxug5hV8F5VI6XiaCLcPiyYJRe', 1),
(3, 'mathew@lenanaschool.ac.ke', '-Ehl7B6z-kmxchfs5X0J9syfbjr5U3HOEs_ZGemaD5w', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7TLtEjbuUyFQ0TN6SmTIqLVZ0CIueM8EvCjD92ltiOqRuProh5vZbJddzXuk6WASb4BQ0p0Bifd3NDxGdWUSZoq', 1),
(4, 'principal@lenanaschool.ac.ke', '-Ehl7B6z-kmxchfs5X0J9syfbjr5U3HOEs_ZGemaD5w', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(5, 'athias@lenanaschool.ac.ke', '-Ehl7B6z-kmxchfs5X0J9syfbjr5U3HOEs_ZGemaD5w', 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9GvhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VLPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', 1),
(6, 'george@kangaschool.ac.ke', '-Ehl7B6z-kmxchfs5X0J9syfbjr5U3HOEs_ZGemaD5w', 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9Gu_iij8ixUXm3NsafrO-7iuGqqc4qU51fpgieCzw-FO62XPiPB3tNy1al0Bw8goj6AV32G0Vj7yn4fRFY7lySJK', 1),
(7, 'makau@lenanaschool.ac.ke', '-Ehl7B6z-kmxchfs5X0J9syfbjr5U3HOEs_ZGemaD5w', '1Ib5qGDZlQDWPjmMLx8LfOu7-9uqDucBi5zttHQqN_bhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VEfH4qs1N4jtmzglgkT65mm_Jsvc-n30la-DRXtPWSZe', 1),
(8, 'daglous@lenanaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', '1Ib5qGDZlQDWPjmMLx8LfOu7-9uqDucBi5zttHQqN_a_iij8ixUXm3NsafrO-7iuGqqc4qU51fpgieCzw-FO6015y12zQDqIIR2Y6CbpKtbG4nq7eQ2EptKcbFx4esHF', 1),
(9, 'allan@lenanaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'aWiMHE6ktI2E3MHc82Z7rgXTzGfvpAwswYmzU1DiaGDhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VJnjbqs0lVf-3qaihYVmuvHbAaeS0dFg_tG5uWqajBu4', 1),
(10, 'gershon@lenanaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'aWiMHE6ktI2E3MHc82Z7rgXTzGfvpAwswYmzU1DiaGC_iij8ixUXm3NsafrO-7iuGqqc4qU51fpgieCzw-FO69gE1JO73X3pl1KOPQ1xAASrrDDFnHfUTmWzNB5_n5Hu', 1),
(11, 'regan@lenanaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'dipvhr8Olna5rxtiuQhN0hIQarZuKGcAwqC3GeG8D8H982IWzB-90F9fb-1tccW9RTMdVuXDhlBDd21qBICk8LPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', 1),
(12, 'robert@lenananschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'dipvhr8Olna5rxtiuQhN0hIQarZuKGcAwqC3GeG8D8HmF4yFQGyNOseQt3K0-YCiV3ahMvq0_yiHDB_ntxgAGWXPiPB3tNy1al0Bw8goj6AV32G0Vj7yn4fRFY7lySJK', 1),
(13, 'kevin@lenanaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', '2OSpdqbWNYVQx-4g4GuFV23CrbimzwIT6LY-NGiCHn151-QkxhO4efqMqH1Ddpjg9LMRUy4rU-AjyUM9bnq1O015y12zQDqIIR2Y6CbpKtbG4nq7eQ2EptKcbFx4esHF', 1),
(14, 'roseline@lenanaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', '2OSpdqbWNYVQx-4g4GuFV23CrbimzwIT6LY-NGiCHn39ZdYc7tm0QASj0oD0aJErHD69-1EMZm4lW-7QE3nkbJKXn_q2g79_jsVFCcmeo9zDX3eM9sFB1n6Q6gLG7lMJ', 1),
(15, 'albert@lenanaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'KCZVMKpxNICmofxlL5QTDrQqxXVm0B2U1jcvr2RlxQj982IWzB-90F9fb-1tccW9RTMdVuXDhlBDd21qBICk8Jnjbqs0lVf-3qaihYVmuvHbAaeS0dFg_tG5uWqajBu4', 1),
(16, 'patrick@lenanaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'KCZVMKpxNICmofxlL5QTDrQqxXVm0B2U1jcvr2RlxQjmF4yFQGyNOseQt3K0-YCiV3ahMvq0_yiHDB_ntxgAGdgE1JO73X3pl1KOPQ1xAASrrDDFnHfUTmWzNB5_n5Hu', 1),
(17, 'mark@lenanaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9Gs7ocR-XZDDXwGGNizAL4AaDUsXZFZDCNpLt2BwhLni4rPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', 1),
(18, 'alfred@lenanaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9GvlAROHjheDoTyFANuXrRioPA8WvHQsEnHfq93X2J2VN2XPiPB3tNy1al0Bw8goj6AV32G0Vj7yn4fRFY7lySJK', 1),
(19, 'jeremy@lenanaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'k-EINdzHUkhtZq_gIUoxFbWFVG7yo-8h8qzVnxYQTiQQMxKmg-eQhAZzxPHpMZnQISwf3WaPYdlLnyzKPfV317PAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', 1),
(20, 'daniel@lenanaschool.ac.ke', 'xNxg0vxrehl-cVvEgeilFeSkHZi2xifvZcUe9-T68mI', 'k-EINdzHUkhtZq_gIUoxFbWFVG7yo-8h8qzVnxYQTiSu0YmG6vvoEbxY2REGewrIlN7fT3pUqxCaFQ1YAsk-82XPiPB3tNy1al0Bw8goj6AV32G0Vj7yn4fRFY7lySJK', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_class_school_fees`
--

INSERT INTO `zvs_class_school_fees` (`id`, `systemSchoolCode`, `schoolClassCode`, `systemFeeCode`, `feeItem`, `itemAlias`, `itemAmount`, `feeItemYear`, `itemStatus`, `dateCreated`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormFour', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FieldTrip[`^`]2017', 'Field Trip', 'Field Trip', '6000', '2017', 1, '2017-02-13'),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormFour', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]KCSEExams[`^`]2017', 'KCSE Exams', 'KCSE Exams', '3500', '2017', 1, '2017-02-13'),
(3, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Registration[`^`]2017', 'Registration', 'Registration', '2000', '2017', 1, '2017-02-13');

-- --------------------------------------------------------

--
-- Table structure for table `zvs_fees_payment_detials`
--

CREATE TABLE `zvs_fees_payment_detials` (
  `id` int(11) NOT NULL,
  `studentIdentificationCode` varchar(240) NOT NULL,
  `studentAdmissionNumber` varchar(30) NOT NULL,
  `systemSchoolCode` varchar(240) NOT NULL,
  `studentClassCode` varchar(240) NOT NULL,
  `studentStreamCode` varchar(240) NOT NULL,
  `paymentScheduleName` varchar(240) NOT NULL,
  `paymentScheduleYear` year(4) NOT NULL,
  `paymentAmount` double(15,2) NOT NULL,
  `modeOfPayment` varchar(30) NOT NULL,
  `referenceCode` varchar(30) NOT NULL,
  `createdBy` varchar(240) NOT NULL,
  `paymentDate` datetime NOT NULL,
  `approvedBy` varchar(240) NOT NULL DEFAULT 'Not yet approved',
  `approvalDate` datetime NOT NULL,
  `feesStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_fees_payment_detials`
--

INSERT INTO `zvs_fees_payment_detials` (`id`, `studentIdentificationCode`, `studentAdmissionNumber`, `systemSchoolCode`, `studentClassCode`, `studentStreamCode`, `paymentScheduleName`, `paymentScheduleYear`, `paymentAmount`, `modeOfPayment`, `referenceCode`, `createdBy`, `paymentDate`, `approvedBy`, `approvalDate`, `feesStatus`) VALUES
(1, 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9GvhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VLPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '1111', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne[`^`]East', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FirstTerm[`^`]2017', 2017, 20325.00, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-13 15:05:54', 'Not yet approved', '0000-00-00 00:00:00', 0),
(2, 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9GvhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VLPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '1111', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne[`^`]East', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]SecondTerm[`^`]2017', 2017, 14227.50, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-13 15:06:16', 'Not yet approved', '0000-00-00 00:00:00', 0),
(3, '1Ib5qGDZlQDWPjmMLx8LfOu7-9uqDucBi5zttHQqN_bhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VEfH4qs1N4jtmzglgkT65mm_Jsvc-n30la-DRXtPWSZe', '1112', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne[`^`]East', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FirstTerm[`^`]2017', 2017, 20325.00, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-13 15:11:40', 'Not yet approved', '0000-00-00 00:00:00', 0),
(4, '1Ib5qGDZlQDWPjmMLx8LfOu7-9uqDucBi5zttHQqN_bhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VEfH4qs1N4jtmzglgkT65mm_Jsvc-n30la-DRXtPWSZe', '1112', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne[`^`]East', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]SecondTerm[`^`]2017', 2017, 14227.50, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-13 15:12:14', 'Not yet approved', '0000-00-00 00:00:00', 0),
(5, 'aWiMHE6ktI2E3MHc82Z7rgXTzGfvpAwswYmzU1DiaGDhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VJnjbqs0lVf-3qaihYVmuvHbAaeS0dFg_tG5uWqajBu4', '1113', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne[`^`]West', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FirstTerm[`^`]2017', 2017, 20325.00, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-13 15:13:00', 'Not yet approved', '0000-00-00 00:00:00', 0),
(6, 'dipvhr8Olna5rxtiuQhN0hIQarZuKGcAwqC3GeG8D8H982IWzB-90F9fb-1tccW9RTMdVuXDhlBDd21qBICk8LPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '2111', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo[`^`]East', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]SecondTerm[`^`]2017', 2017, 13527.50, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-13 15:28:35', 'Not yet approved', '0000-00-00 00:00:00', 0),
(7, '2OSpdqbWNYVQx-4g4GuFV23CrbimzwIT6LY-NGiCHn151-QkxhO4efqMqH1Ddpjg9LMRUy4rU-AjyUM9bnq1O015y12zQDqIIR2Y6CbpKtbG4nq7eQ2EptKcbFx4esHF', '2112', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo[`^`]East', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FirstTerm[`^`]2017', 2017, 19325.00, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-13 15:31:28', 'Not yet approved', '0000-00-00 00:00:00', 0),
(8, '2OSpdqbWNYVQx-4g4GuFV23CrbimzwIT6LY-NGiCHn151-QkxhO4efqMqH1Ddpjg9LMRUy4rU-AjyUM9bnq1O015y12zQDqIIR2Y6CbpKtbG4nq7eQ2EptKcbFx4esHF', '2112', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo[`^`]East', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]SecondTerm[`^`]2017', 2017, 13527.50, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-13 15:32:27', 'Not yet approved', '0000-00-00 00:00:00', 0),
(9, 'KCZVMKpxNICmofxlL5QTDrQqxXVm0B2U1jcvr2RlxQj982IWzB-90F9fb-1tccW9RTMdVuXDhlBDd21qBICk8Jnjbqs0lVf-3qaihYVmuvHbAaeS0dFg_tG5uWqajBu4', '2113', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo[`^`]North', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FirstTerm[`^`]2017', 2017, 19325.00, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-13 15:35:34', 'Not yet approved', '0000-00-00 00:00:00', 0),
(10, 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9Gs7ocR-XZDDXwGGNizAL4AaDUsXZFZDCNpLt2BwhLni4rPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '3111', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormThree', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormThree[`^`]East', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FirstTerm[`^`]2017', 2017, 19325.00, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-13 15:37:08', 'Not yet approved', '0000-00-00 00:00:00', 0),
(11, 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9Gs7ocR-XZDDXwGGNizAL4AaDUsXZFZDCNpLt2BwhLni4rPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '3111', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormThree', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormThree[`^`]East', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]SecondTerm[`^`]2017', 2017, 13527.50, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-13 15:37:32', 'Not yet approved', '0000-00-00 00:00:00', 0),
(12, 'k-EINdzHUkhtZq_gIUoxFbWFVG7yo-8h8qzVnxYQTiQQMxKmg-eQhAZzxPHpMZnQISwf3WaPYdlLnyzKPfV317PAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '4111', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormFour', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormFour[`^`]East', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FirstTerm[`^`]2017', 2017, 24075.00, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-25 19:45:38', 'Not yet approved', '0000-00-00 00:00:00', 0),
(13, 'k-EINdzHUkhtZq_gIUoxFbWFVG7yo-8h8qzVnxYQTiQQMxKmg-eQhAZzxPHpMZnQISwf3WaPYdlLnyzKPfV317PAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '4111', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormFour', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormFour[`^`]East', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]SecondTerm[`^`]2017', 2017, 7222.50, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-25 20:01:08', 'Not yet approved', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_fees_payment_reserved`
--

CREATE TABLE `zvs_fees_payment_reserved` (
  `id` int(11) NOT NULL,
  `studentIdentificationCode` varchar(240) NOT NULL,
  `studentAdmissionNumber` varchar(30) NOT NULL,
  `systemSchoolCode` varchar(240) NOT NULL,
  `reservedAmount` double(15,2) NOT NULL,
  `modeOfPayment` varchar(30) NOT NULL,
  `paymentCode` varchar(30) NOT NULL,
  `createdBy` varchar(240) NOT NULL,
  `dateReserved` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_fees_payment_reserved`
--

INSERT INTO `zvs_fees_payment_reserved` (`id`, `studentIdentificationCode`, `studentAdmissionNumber`, `systemSchoolCode`, `reservedAmount`, `modeOfPayment`, `paymentCode`, `createdBy`, `dateReserved`) VALUES
(1, 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9GvhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VLPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '1111', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 0.00, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-13 15:06:46'),
(2, '1Ib5qGDZlQDWPjmMLx8LfOu7-9uqDucBi5zttHQqN_bhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VEfH4qs1N4jtmzglgkT65mm_Jsvc-n30la-DRXtPWSZe', '1112', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 0.00, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-13 15:12:38'),
(3, 'aWiMHE6ktI2E3MHc82Z7rgXTzGfvpAwswYmzU1DiaGDhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VJnjbqs0lVf-3qaihYVmuvHbAaeS0dFg_tG5uWqajBu4', '1113', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 0.00, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-13 15:14:25'),
(4, 'dipvhr8Olna5rxtiuQhN0hIQarZuKGcAwqC3GeG8D8H982IWzB-90F9fb-1tccW9RTMdVuXDhlBDd21qBICk8LPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '2111', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 0.00, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-13 15:29:28'),
(5, '2OSpdqbWNYVQx-4g4GuFV23CrbimzwIT6LY-NGiCHn151-QkxhO4efqMqH1Ddpjg9LMRUy4rU-AjyUM9bnq1O015y12zQDqIIR2Y6CbpKtbG4nq7eQ2EptKcbFx4esHF', '2112', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 0.00, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-13 15:34:30'),
(6, 'KCZVMKpxNICmofxlL5QTDrQqxXVm0B2U1jcvr2RlxQj982IWzB-90F9fb-1tccW9RTMdVuXDhlBDd21qBICk8Jnjbqs0lVf-3qaihYVmuvHbAaeS0dFg_tG5uWqajBu4', '2113', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 0.00, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-13 15:36:28'),
(7, 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9Gs7ocR-XZDDXwGGNizAL4AaDUsXZFZDCNpLt2BwhLni4rPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '3111', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 0.00, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-13 15:39:38'),
(8, 'k-EINdzHUkhtZq_gIUoxFbWFVG7yo-8h8qzVnxYQTiQQMxKmg-eQhAZzxPHpMZnQISwf3WaPYdlLnyzKPfV317PAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '4111', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 0.00, '', '', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-25 20:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `zvs_fees_payment_schedule`
--

CREATE TABLE `zvs_fees_payment_schedule` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(240) NOT NULL,
  `systemPaymentCode` varchar(240) NOT NULL,
  `paymentScheduleName` varchar(60) NOT NULL,
  `paymentScheduleYear` varchar(4) NOT NULL,
  `paymentScheduleProportion` varchar(5) NOT NULL,
  `paymentScheduleStatus` tinyint(1) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_fees_payment_schedule`
--

INSERT INTO `zvs_fees_payment_schedule` (`id`, `systemSchoolCode`, `systemPaymentCode`, `paymentScheduleName`, `paymentScheduleYear`, `paymentScheduleProportion`, `paymentScheduleStatus`, `dateCreated`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FirstTerm[`^`]2017', 'First Term', '2017', '50', 1, '2017-02-13'),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]SecondTerm[`^`]2017', 'Second Term', '2017', '35', 1, '2017-02-13'),
(3, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]ThirdTerm[`^`]2017', 'Third Term', '2017', '15', 1, '2017-02-13'),
(4, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FirstTerm[`^`]2018', 'First Term', '2018', '50', 1, '2017-02-21'),
(5, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]SecondTerm[`^`]2018', 'Second Term', '2018', '30', 1, '2017-02-21'),
(6, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]ThirdTerm[`^`]2018', 'Third Term', '2018', '20', 1, '2017-02-21');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_general_school_fees`
--

INSERT INTO `zvs_general_school_fees` (`id`, `systemSchoolCode`, `systemFeeCode`, `feeItem`, `itemAlias`, `itemAmount`, `feeItemYear`, `itemStatus`, `dateCreated`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Tuition[`^`]2017', 'Tuition', 'Tuition', '4000', '2017', 1, '2017-02-13'),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Boarding[`^`]2017', 'Boarding', 'Boarding', '32300', '2017', 1, '2017-02-13'),
(3, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Insurance[`^`]2017', 'Insurance', 'Insurance', '1050', '2017', 1, '2017-02-13'),
(4, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Medical[`^`]2017', 'Medical', 'Medical', '500', '2017', 1, '2017-02-13'),
(5, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Activity[`^`]2017', 'Activity', 'Activity', '800', '2017', 1, '2017-02-13'),
(6, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Tuition[`^`]2018', 'Tuition', 'Tution', '4700', '2018', 1, '2017-02-21'),
(7, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]R.M.I[`^`]2018', 'R.M.I', 'R.M.I', '3200', '2018', 1, '2017-02-21'),
(8, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]L,TT[`^`]2018', 'L, T & T', 'L, T & T', '2400', '2018', 1, '2017-02-21'),
(9, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Admission[`^`]2018', 'Admission', 'Admission', '3300', '2018', 1, '2017-02-21'),
(10, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]EWC[`^`]2018', 'EWC', 'EWC', '7800', '2018', 1, '2017-02-21'),
(11, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]ActivityFees[`^`]2018', 'Activity Fees', 'Activity Fees', '1400', '2018', 1, '2017-02-21'),
(12, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]P/Emoluments[`^`]2018', 'P/Emoluments', 'P/Emoluments', '8700', '2018', 1, '2017-02-21'),
(13, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Medical[`^`]2018', 'Medical', 'Medical', '790', '2018', 1, '2017-02-21'),
(14, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Insurance[`^`]2018', 'Insurance', 'Insurance', '1700', '2018', 1, '2017-02-21'),
(15, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]BoardingFees[`^`]2018', 'Boarding Fees', 'Boarding', '32400', '2018', 1, '2017-02-21');

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
  `resourceDescription` text NOT NULL,
  `dateCreated` date NOT NULL,
  `dateModified` date DEFAULT NULL,
  `resourceStatus` tinyint(1) unsigned zerofill NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_platform_resources`
--

INSERT INTO `zvs_platform_resources` (`id`, `resourceId`, `resourceName`, `resourceCategory`, `resourceDescription`, `dateCreated`, `dateModified`, `resourceStatus`) VALUES
(1, 'ClsMod[`^`]ViewClasses', 'View Classes', 'Class', 'This resource helps in viewing class details for a selected class year. Through this resource, you can have a graphical representation of the number of students in each stream of a given class for the selected year for the entire school.', '2016-07-03', NULL, 1),
(2, 'ClsMod[`^`]ClassProfile', 'Class Profile', 'Class', '', '2016-07-03', NULL, 0),
(3, 'ClsMod[`^`]ViewStreams', 'View Streams', 'Class', '', '2016-07-03', NULL, 0),
(4, 'ClsMod[`^`]StreamProfile', 'Stream Profile', 'Class', '', '2016-07-03', NULL, 0),
(5, 'DepMod[`^`]ViewDepartments', 'View Departments', 'Department', '', '2016-07-03', NULL, 0),
(6, 'DepMod[`^`]DepartmentProfile', 'Department Profile', 'Department', '', '2016-07-03', NULL, 0),
(7, 'DepMod[`^`]ViewSubDepartments', 'View Sub Departments', 'Department', '', '2016-07-03', NULL, 0),
(8, 'DepMod[`^`]SubDepartmentProfile', 'Sub Department Profile', 'Department', '', '2016-07-03', NULL, 0),
(9, 'FinMod[`^`]CreateFees', 'Create Fees', 'Finance', '', '2016-07-03', NULL, 0),
(10, 'FinMod[`^`]AllocateFinances', 'Allocate Finances', 'Finance', '', '2016-07-03', NULL, 1),
(11, 'FinMod[`^`]CollectFees', 'Collect Fees', 'Finance', 'This resource helps its consumers to collect and record school fees. The resource consumer searches for a student from a selected class and stream, then will be able to see the student''s fee history and subsequently collect fees being paid by the same student.', '2016-07-03', NULL, 1),
(12, 'FinMod[`^`]FinanceStatus', 'Finance Status', 'Finance', '', '2016-07-03', NULL, 1),
(13, 'FinMod[`^`]FeeStructure', 'Fee Structure', 'Finance', 'This resource is useful in presenting fees structure to its consumers. The consumers are able to select a given class and a corresponding year, for which they would like to view a fees structure. The resource draws a fees structure, percentage representations and more.', '2016-07-03', NULL, 1),
(14, 'FinMod[`^`]FeeDefaulters', 'Fee Defaulters', 'Finance', '', '2016-07-03', NULL, 0),
(15, 'FinMod[`^`]FeeRefunds', 'Fee Refunds', 'Finance', '', '2016-07-03', NULL, 0),
(16, 'StuMod[`^`]RegisterStudent', 'Register Student', 'Student', '', '2016-07-03', NULL, 1),
(17, 'StuMod[`^`]ViewStudents', 'View Students', 'Student', '', '2016-07-03', NULL, 0),
(18, 'StuMod[`^`]StudentProfile', 'Student Profile', 'Student', '', '2016-07-03', NULL, 0),
(19, 'StuMod[`^`]StudentExamResults', 'Student Exam Results', 'Student', '', '2016-07-03', NULL, 0),
(20, 'StuMod[`^`]StudentFeeDetails', 'Student Fee Details', 'Student', '', '2016-07-03', NULL, 0),
(21, 'StuMod[`^`]StudentSubjectDetails', 'Student Subject Details', 'Student', '', '2016-07-03', NULL, 0),
(22, 'StuMod[`^`]StudentMedicalHistory', 'Student Medical History', 'Student', '', '2016-07-03', NULL, 0),
(23, 'StuMod[`^`]StudentChatBox', 'Student Chat Box', 'Student', '', '2016-07-03', NULL, 0),
(24, 'StuMod[`^`]ShiftStudents', 'Shift Students', 'Student', '', '2016-12-02', NULL, 1),
(25, 'TtbMod[`^`]CreateTimeTable', 'Create Time Table', 'Timetable', 'This resource is useful in the creation of a new school school timetable item. A correctly created timetable item MUST have a an associated subject, an associated class, an associated stream, start time and end time', '2017-01-10', NULL, 1),
(26, 'SubMod[`^`]AssignSubjectToTeacher', 'Assign Subject to Teacher', 'Subject', 'Resource is used to assign subject(s) to a teacher. These are subjects that a respective teacher will be teaching respective classes. This is the resource that helps in creation of a teacher specific timetable', '2017-01-10', NULL, 1),
(27, 'FinMod[`^`]CreateBudget', 'Create Budget', 'Finance', '<p>This resource is useful in the creation of a budget for a budget item within a specific budget category</p>', '2017-02-22', NULL, 1);

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
(9, 'Subject', 'SubMod', '2016-06-10', 1),
(10, 'Examination', 'ExmMod', '2016-06-10', 0),
(11, 'Marksheet', 'MrkMod', '2016-06-10', 0),
(12, 'Timetable', 'TtbMod', '2016-06-10', 1),
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_resource_role_mapper`
--

INSERT INTO `zvs_resource_role_mapper` (`id`, `systemSchoolCode`, `schoolRoleId`, `schoolResourceId`, `resourceCategory`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Principal', 'ClsMod[`^`]ViewClasses', 'ClsMod'),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Principal', 'FinMod[`^`]CollectFees', 'FinMod'),
(3, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Principal', 'FinMod[`^`]FinanceStatus', 'FinMod'),
(4, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Principal', 'FinMod[`^`]FeeStructure', 'FinMod'),
(5, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Principal', 'StuMod[`^`]RegisterStudent', 'StuMod'),
(6, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Principal', 'FinMod[`^`]CreateBudget', 'FinMod'),
(7, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Principal', 'FinMod[`^`]AllocateFinances', 'FinMod');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_admin`
--

INSERT INTO `zvs_school_admin` (`id`, `systemSchoolCode`, `identificationCode`, `idNumber`, `designation`, `firstName`, `middleName`, `lastName`, `mobileNumber`, `boxAddress`, `gender`, `country`, `locality`, `imagePath`, `dateCreated`, `timeCreated`, `dateModified`, `timeModified`, `createdBy`, `userStatus`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7TLtEjbuUyFQ0TN6SmTIqLVZ0CIueM8EvCjD92ltiOqRuProh5vZbJddzXuk6WASb4BQ0p0Bifd3NDxGdWUSZoq', 'ZVS_SA_25138058', 'Mr', 'Mathew', 'Otieno', 'Juma', '0727074108', 'P.O. Box 30253, Nairobi 00100', 'Male', '+254', '30', 'I5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7TLtEjbuUyFQ0TN6SmTIqLVZ0CIueM8EvCjD92ltiOqRuProh5vZbJddzXuk6WASb4BQ0p0Bifd3NDxGdWUSZoq.png', '2017-02-13', '08:35:32', NULL, NULL, 'pSoaHX1j8XXb2diMDomSijvRhBm6bxybcBWAbm6KL-mtWlM0NHJJdIXj6sxsi4NWMsv34U7kuRjGb3fd9rPlDMw_RESDtvMpAfdTYg23vR_7rylRfEqSABHs29kz0IxS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_attendance_schedule`
--

CREATE TABLE `zvs_school_attendance_schedule` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(240) NOT NULL,
  `systemAttendanceCode` varchar(240) NOT NULL,
  `attendanceName` varchar(30) NOT NULL,
  `attendanceYear` varchar(5) NOT NULL,
  `attendanceStartDate` date NOT NULL,
  `attendanceEndDate` date NOT NULL,
  `attendanceStatus` tinyint(5) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_attendance_schedule`
--

INSERT INTO `zvs_school_attendance_schedule` (`id`, `systemSchoolCode`, `systemAttendanceCode`, `attendanceName`, `attendanceYear`, `attendanceStartDate`, `attendanceEndDate`, `attendanceStatus`, `dateCreated`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FirstTerm[`^`]2017', 'First Term', '2017', '2017-01-09', '2017-04-07', 1, '2017-02-13'),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]SecondTerm[`^`]2017', 'Second Term', '2017', '2017-05-01', '2017-08-04', 1, '2017-02-13'),
(3, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]ThirdTerm[`^`]2017', 'Third Term', '2017', '2017-09-04', '2017-11-17', 1, '2017-02-13'),
(4, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FirstTerm[`^`]2018', 'First Term', '2018', '2018-01-08', '2018-04-06', 1, '2017-02-21'),
(5, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]SecondTerm[`^`]2018', 'Second Term', '2018', '2018-05-01', '2018-08-03', 1, '2017-02-21'),
(6, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]ThirdTerm[`^`]2018', 'Third Term', '2018', '2018-09-03', '2018-11-23', 1, '2017-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_budget_categories`
--

CREATE TABLE `zvs_school_budget_categories` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(200) NOT NULL,
  `financialYearCode` varchar(240) NOT NULL,
  `budgetCategoryCode` varchar(200) NOT NULL,
  `budgetCategoryName` varchar(100) NOT NULL,
  `budgetCategoryAlias` varchar(100) NOT NULL,
  `dateCreated` date DEFAULT NULL,
  `dateModified` date NOT NULL,
  `budgetCategoryStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_budget_categories`
--

INSERT INTO `zvs_school_budget_categories` (`id`, `systemSchoolCode`, `financialYearCode`, `budgetCategoryCode`, `budgetCategoryName`, `budgetCategoryAlias`, `dateCreated`, `dateModified`, `budgetCategoryStatus`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Library', 'Library', 'Library', '2017-02-24', '0000-00-00', 0),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Health', 'Health', 'Health', '2017-02-24', '0000-00-00', 0),
(3, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Laboratory', 'Laboratory', 'Laboratory', '2017-02-24', '0000-00-00', 0),
(4, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2018-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2018-FinancialYear[`^`]Library', 'Library', 'Library', '2017-02-24', '0000-00-00', 0),
(5, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2018-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2018-FinancialYear[`^`]Kitchen', 'Kitchen', 'Kitchen', '2017-02-24', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_budget_sub_categories`
--

CREATE TABLE `zvs_school_budget_sub_categories` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(240) NOT NULL,
  `financialYearCode` varchar(240) NOT NULL,
  `budgetCategoryCode` varchar(240) NOT NULL,
  `budgetSubCategoryCode` varchar(240) NOT NULL,
  `subCategoryName` varchar(30) NOT NULL,
  `subCategoryAlias` varchar(45) NOT NULL,
  `dateCreated` date DEFAULT NULL,
  `dateModified` date NOT NULL,
  `subCategoryStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_budget_sub_categories`
--

INSERT INTO `zvs_school_budget_sub_categories` (`id`, `systemSchoolCode`, `financialYearCode`, `budgetCategoryCode`, `budgetSubCategoryCode`, `subCategoryName`, `subCategoryAlias`, `dateCreated`, `dateModified`, `subCategoryStatus`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Library', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Library[`^`]Books', 'Books', 'Books', '2017-02-24', '0000-00-00', 0),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Library', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Library[`^`]BooksRack', 'Books Rack', 'Books Rack', '2017-02-24', '0000-00-00', 0),
(3, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2018-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2018-FinancialYear[`^`]Kitchen', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2018-FinancialYear[`^`]Kitchen[`^`]Maize', 'Maize', 'Maize', '2017-02-24', '0000-00-00', 0),
(4, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Health', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Health[`^`]Medicines', 'Medicines', 'Medicines', '2017-02-26', '0000-00-00', 0),
(5, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Laboratory', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Laboratory[`^`]LabChemicals', 'Lab Chemicals', 'Lab Chemicals', '2017-02-26', '0000-00-00', 0),
(6, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Laboratory', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Laboratory[`^`]LabChairs', 'Lab Chairs', 'Lab Chairs', '2017-02-26', '0000-00-00', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_classes`
--

INSERT INTO `zvs_school_classes` (`id`, `systemSchoolCode`, `schoolClassCode`, `schoolClassName`, `schoolClassAlias`, `dateCreated`, `dateModified`, `classStatus`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne', 'Form One', 'Form One', '2017-02-13', '0000-00-00', 0),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo', 'Form Two', 'Form Two', '2017-02-13', '0000-00-00', 0),
(3, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormThree', 'Form Three', 'Form Three', '2017-02-13', '0000-00-00', 0),
(4, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormFour', 'Form Four', 'Form Four', '2017-02-13', '0000-00-00', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_departments`
--

INSERT INTO `zvs_school_departments` (`id`, `systemSchoolCode`, `schoolDepartmentCode`, `schoolDepartmentName`, `schoolDepartmentAlias`, `dateCreated`, `dateModified`, `departmentStatus`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Mathematics', 'Mathematics', 'Mathematics', '2017-02-13', NULL, 0),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Languages', 'Languages', 'Languages', '2017-02-13', NULL, 0),
(3, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Sciences', 'Sciences', 'Sciences', '2017-02-13', NULL, 0),
(4, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Humanities', 'Humanities', 'Humanities', '2017-02-13', NULL, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_details`
--

INSERT INTO `zvs_school_details` (`id`, `systemSchoolCode`, `schoolCode`, `registrationNumber`, `schoolName`, `dateOfEstablishment`, `schoolEmail`, `schoolWebsite`, `schoolPhoneNumber`, `schoolMobileNumber`, `schoolBoxAddress`, `schoolMotto`, `schoolLevel`, `schoolCategory`, `schoolGender`, `schoolType`, `schoolCountry`, `schoolLocality`, `schoolLogoPath`, `dateCreated`, `timeCreated`, `dateModified`, `timeModified`, `createdBy`, `schoolStatus`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', '20400001', 'ZVS_002017_01', 'Lenana School', 1946, 'info@lenanaschool.ac.ke', 'http://www.lenanaschool.ac.ke', '254-203872805', '254-203872805', 'P.O. Box 30253, Nairobi 00100', 'Nihil Praeter Optimum', 'Secondary School', 'Boarding School', 'Boys School', 'Public School', '+254', '30', 'LenanaSchool_Q4JRabMgAfyC15EVc2IYw3kKiL.png', '2017-02-13', '08:35:33', NULL, NULL, 'pSoaHX1j8XXb2diMDomSijvRhBm6bxybcBWAbm6KL-mtWlM0NHJJdIXj6sxsi4NWMsv34U7kuRjGb3fd9rPlDMw_RESDtvMpAfdTYg23vR_7rylRfEqSABHs29kz0IxS', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_finance_allocation`
--

CREATE TABLE `zvs_school_finance_allocation` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(240) NOT NULL,
  `financialYearCode` varchar(240) NOT NULL,
  `budgetCategoryCode` varchar(240) NOT NULL,
  `budgetSubCategoryCode` varchar(240) NOT NULL,
  `allocatedAmount` double NOT NULL,
  `createdBy` varchar(240) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `allocationStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_finance_allocation`
--

INSERT INTO `zvs_school_finance_allocation` (`id`, `systemSchoolCode`, `financialYearCode`, `budgetCategoryCode`, `budgetSubCategoryCode`, `allocatedAmount`, `createdBy`, `dateCreated`, `allocationStatus`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Library', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Library[`^`]Books', 50000, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-28 00:00:00', 0),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Library', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Library[`^`]BooksRack', 20000, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-28 00:00:00', 0),
(4, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Library', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Library[`^`]BooksRack', 10000, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-28 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_financial_years`
--

CREATE TABLE `zvs_school_financial_years` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(240) NOT NULL,
  `financialYearCode` varchar(240) NOT NULL,
  `financialYearName` varchar(60) NOT NULL,
  `financialYearAlias` varchar(60) NOT NULL,
  `financialYearStartDate` date NOT NULL,
  `financialYearEndDate` date NOT NULL,
  `dateCreated` date NOT NULL,
  `financialYearStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_financial_years`
--

INSERT INTO `zvs_school_financial_years` (`id`, `systemSchoolCode`, `financialYearCode`, `financialYearName`, `financialYearAlias`, `financialYearStartDate`, `financialYearEndDate`, `dateCreated`, `financialYearStatus`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear', '2017 - Financial Year', '2017 Financial Year', '2017-01-01', '2017-12-31', '2017-02-22', 1),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2018-FinancialYear', '2018 - Financial Year', '2018 Financial Year', '2018-01-01', '2018-12-31', '2017-02-24', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `zvs_school_payment_modes`
--

CREATE TABLE `zvs_school_payment_modes` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(240) NOT NULL,
  `paymentModeCode` varchar(240) NOT NULL,
  `paymentModeName` varchar(30) NOT NULL,
  `createdBy` varchar(240) NOT NULL,
  `dateCreated` date NOT NULL,
  `paymentModeStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_roles`
--

INSERT INTO `zvs_school_roles` (`id`, `systemSchoolCode`, `schoolRoleCode`, `schoolRoleName`, `schoolRoleAlias`, `schoolRoleId`, `dateCreated`, `dateModified`, `assignStatus`, `roleStatus`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Principal', 'Principal', 'Principal', 'Principal', '2017-02-13', NULL, 1, 1),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Student', 'Student', 'Student', 'Student', '2017-02-13', NULL, 0, 1),
(3, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Parent', 'Parent', 'Parent', 'Parent', '2017-02-13', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_running_budget`
--

CREATE TABLE `zvs_school_running_budget` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(240) NOT NULL,
  `financialYearCode` varchar(240) NOT NULL,
  `budgetCategoryCode` varchar(240) NOT NULL,
  `budgetSubCategoryCode` varchar(240) NOT NULL,
  `budgetedAmount` double NOT NULL,
  `createdBy` varchar(240) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `budgetStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_running_budget`
--

INSERT INTO `zvs_school_running_budget` (`id`, `systemSchoolCode`, `financialYearCode`, `budgetCategoryCode`, `budgetSubCategoryCode`, `budgetedAmount`, `createdBy`, `dateCreated`, `budgetStatus`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Library', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Library[`^`]Books', 100000, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-25 00:00:00', 0),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Library', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Library[`^`]BooksRack', 30000, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-26 00:00:00', 0),
(3, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Health', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Health[`^`]Medicines', 25000, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-26 00:00:00', 0),
(4, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Laboratory', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Laboratory[`^`]LabChemicals', 35000, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-26 00:00:00', 0),
(5, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Laboratory', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]2017-FinancialYear[`^`]Laboratory[`^`]LabChairs', 12000, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', '2017-02-26 00:00:00', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_streams`
--

INSERT INTO `zvs_school_streams` (`id`, `systemSchoolCode`, `schoolClassCode`, `schoolStreamCode`, `schoolStreamName`, `schoolStreamCapacity`, `schoolStreamOccupancy`, `dateCreated`, `dateModified`, `streamStatus`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne[`^`]East', 'East', 50, 2, '2017-02-13', '0000-00-00', 0),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne[`^`]West', 'West', 50, 1, '2017-02-13', '0000-00-00', 0),
(3, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne[`^`]North', 'North', 50, 0, '2017-02-13', '0000-00-00', 0),
(4, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne[`^`]South', 'South', 50, 0, '2017-02-13', '0000-00-00', 0),
(5, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo[`^`]East', 'East', 50, 2, '2017-02-13', '0000-00-00', 0),
(6, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo[`^`]West', 'West', 50, 0, '2017-02-13', '0000-00-00', 0),
(7, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo[`^`]North', 'North', 50, 1, '2017-02-13', '0000-00-00', 0),
(8, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo[`^`]South', 'South', 50, 0, '2017-02-13', '0000-00-00', 0),
(9, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormThree', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormThree[`^`]East', 'East', 50, 1, '2017-02-13', '0000-00-00', 0),
(10, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormThree', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormThree[`^`]West', 'West', 50, 0, '2017-02-13', '0000-00-00', 0),
(11, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormThree', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormThree[`^`]North', 'North', 50, 0, '2017-02-13', '0000-00-00', 0),
(12, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormThree', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormThree[`^`]South', 'South', 50, 0, '2017-02-13', '0000-00-00', 0),
(13, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormFour', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormFour[`^`]East', 'East', 50, 1, '2017-02-13', '0000-00-00', 0),
(14, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormFour', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormFour[`^`]West', 'West', 50, 0, '2017-02-13', '0000-00-00', 0),
(15, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormFour', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormFour[`^`]North', 'North', 50, 0, '2017-02-13', '0000-00-00', 0),
(16, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormFour', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormFour[`^`]South', 'South', 50, 0, '2017-02-13', '0000-00-00', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_school_sub_departments`
--

INSERT INTO `zvs_school_sub_departments` (`id`, `systemSchoolCode`, `schoolDepartmentCode`, `schoolSubDepartmentCode`, `schoolSubDepartmentName`, `dateCreated`, `dateModified`, `subDepartmentStatus`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Languages', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Languages[`^`]English', 'English', '2017-02-13', NULL, 0),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Languages', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Languages[`^`]Kiswahili', 'Kiswahili', '2017-02-13', NULL, 0),
(3, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Sciences', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Sciences[`^`]Physics', 'Physics', '2017-02-13', NULL, 0),
(4, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Sciences', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Sciences[`^`]Chemistry', 'Chemistry', '2017-02-13', NULL, 0),
(5, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Sciences', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Sciences[`^`]Biology', 'Biology', '2017-02-13', NULL, 0),
(6, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Humanities', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Humanities[`^`]Geography', 'Geography', '2017-02-13', NULL, 0),
(7, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Humanities', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]Humanities[`^`]History', 'History', '2017-02-13', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_school_time_table`
--

CREATE TABLE `zvs_school_time_table` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(240) NOT NULL,
  `schoolClassCode` varchar(240) NOT NULL,
  `schoolStreamCode` varchar(240) NOT NULL,
  `schoolSubjectCode` varchar(240) NOT NULL,
  `subjectWeekDay` varchar(10) NOT NULL,
  `subjectStartTime` time NOT NULL,
  `subjectEndTime` time NOT NULL,
  `subjectDuration` int(5) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `subjectStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_students_class_details`
--

INSERT INTO `zvs_students_class_details` (`id`, `systemSchoolCode`, `identificationCode`, `studentClassCode`, `studentStreamCode`, `studentYearOfStudy`, `studentAdmissionNumber`, `registeredBy`, `studentClassStatus`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9GvhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VLPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne[`^`]East', '2017', '1111', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', '1Ib5qGDZlQDWPjmMLx8LfOu7-9uqDucBi5zttHQqN_bhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VEfH4qs1N4jtmzglgkT65mm_Jsvc-n30la-DRXtPWSZe', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne[`^`]East', '2017', '1112', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(3, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'aWiMHE6ktI2E3MHc82Z7rgXTzGfvpAwswYmzU1DiaGDhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VJnjbqs0lVf-3qaihYVmuvHbAaeS0dFg_tG5uWqajBu4', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormOne[`^`]West', '2017', '1113', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(4, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'dipvhr8Olna5rxtiuQhN0hIQarZuKGcAwqC3GeG8D8H982IWzB-90F9fb-1tccW9RTMdVuXDhlBDd21qBICk8LPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo[`^`]East', '2017', '2111', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(5, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', '2OSpdqbWNYVQx-4g4GuFV23CrbimzwIT6LY-NGiCHn151-QkxhO4efqMqH1Ddpjg9LMRUy4rU-AjyUM9bnq1O015y12zQDqIIR2Y6CbpKtbG4nq7eQ2EptKcbFx4esHF', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo[`^`]East', '2017', '2112', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(6, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'KCZVMKpxNICmofxlL5QTDrQqxXVm0B2U1jcvr2RlxQj982IWzB-90F9fb-1tccW9RTMdVuXDhlBDd21qBICk8Jnjbqs0lVf-3qaihYVmuvHbAaeS0dFg_tG5uWqajBu4', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormTwo[`^`]North', '2017', '2113', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(7, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9Gs7ocR-XZDDXwGGNizAL4AaDUsXZFZDCNpLt2BwhLni4rPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormThree', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormThree[`^`]East', '2017', '3111', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(8, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'k-EINdzHUkhtZq_gIUoxFbWFVG7yo-8h8qzVnxYQTiQQMxKmg-eQhAZzxPHpMZnQISwf3WaPYdlLnyzKPfV317PAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormFour', 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL[`^`]FormFour[`^`]East', '2017', '4111', 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zvs_students_class_history`
--

CREATE TABLE `zvs_students_class_history` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(240) NOT NULL,
  `identificationCode` varchar(240) NOT NULL,
  `studentClassCode` varchar(240) NOT NULL,
  `studentStreamCode` varchar(240) NOT NULL,
  `studentYearOfStudy` varchar(4) NOT NULL,
  `studentAdmissionNumber` varchar(30) NOT NULL,
  `registeredBy` varchar(240) NOT NULL,
  `studentClassStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zvs_students_guardians_mapper`
--

CREATE TABLE `zvs_students_guardians_mapper` (
  `id` int(11) NOT NULL,
  `studentIdentificationCode` varchar(240) NOT NULL,
  `guardianIdentificationCode` varchar(240) NOT NULL,
  `recordStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_students_guardians_mapper`
--

INSERT INTO `zvs_students_guardians_mapper` (`id`, `studentIdentificationCode`, `guardianIdentificationCode`, `recordStatus`) VALUES
(1, 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9GvhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VLPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9Gu_iij8ixUXm3NsafrO-7iuGqqc4qU51fpgieCzw-FO62XPiPB3tNy1al0Bw8goj6AV32G0Vj7yn4fRFY7lySJK', 1),
(2, '1Ib5qGDZlQDWPjmMLx8LfOu7-9uqDucBi5zttHQqN_bhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VEfH4qs1N4jtmzglgkT65mm_Jsvc-n30la-DRXtPWSZe', '1Ib5qGDZlQDWPjmMLx8LfOu7-9uqDucBi5zttHQqN_a_iij8ixUXm3NsafrO-7iuGqqc4qU51fpgieCzw-FO6015y12zQDqIIR2Y6CbpKtbG4nq7eQ2EptKcbFx4esHF', 1),
(3, 'aWiMHE6ktI2E3MHc82Z7rgXTzGfvpAwswYmzU1DiaGDhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VJnjbqs0lVf-3qaihYVmuvHbAaeS0dFg_tG5uWqajBu4', 'aWiMHE6ktI2E3MHc82Z7rgXTzGfvpAwswYmzU1DiaGC_iij8ixUXm3NsafrO-7iuGqqc4qU51fpgieCzw-FO69gE1JO73X3pl1KOPQ1xAASrrDDFnHfUTmWzNB5_n5Hu', 1),
(4, 'dipvhr8Olna5rxtiuQhN0hIQarZuKGcAwqC3GeG8D8H982IWzB-90F9fb-1tccW9RTMdVuXDhlBDd21qBICk8LPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', 'dipvhr8Olna5rxtiuQhN0hIQarZuKGcAwqC3GeG8D8HmF4yFQGyNOseQt3K0-YCiV3ahMvq0_yiHDB_ntxgAGWXPiPB3tNy1al0Bw8goj6AV32G0Vj7yn4fRFY7lySJK', 1),
(5, '2OSpdqbWNYVQx-4g4GuFV23CrbimzwIT6LY-NGiCHn151-QkxhO4efqMqH1Ddpjg9LMRUy4rU-AjyUM9bnq1O015y12zQDqIIR2Y6CbpKtbG4nq7eQ2EptKcbFx4esHF', '2OSpdqbWNYVQx-4g4GuFV23CrbimzwIT6LY-NGiCHn39ZdYc7tm0QASj0oD0aJErHD69-1EMZm4lW-7QE3nkbJKXn_q2g79_jsVFCcmeo9zDX3eM9sFB1n6Q6gLG7lMJ', 1),
(6, 'KCZVMKpxNICmofxlL5QTDrQqxXVm0B2U1jcvr2RlxQj982IWzB-90F9fb-1tccW9RTMdVuXDhlBDd21qBICk8Jnjbqs0lVf-3qaihYVmuvHbAaeS0dFg_tG5uWqajBu4', 'KCZVMKpxNICmofxlL5QTDrQqxXVm0B2U1jcvr2RlxQjmF4yFQGyNOseQt3K0-YCiV3ahMvq0_yiHDB_ntxgAGdgE1JO73X3pl1KOPQ1xAASrrDDFnHfUTmWzNB5_n5Hu', 1),
(7, 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9Gs7ocR-XZDDXwGGNizAL4AaDUsXZFZDCNpLt2BwhLni4rPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9GvlAROHjheDoTyFANuXrRioPA8WvHQsEnHfq93X2J2VN2XPiPB3tNy1al0Bw8goj6AV32G0Vj7yn4fRFY7lySJK', 1),
(8, 'k-EINdzHUkhtZq_gIUoxFbWFVG7yo-8h8qzVnxYQTiQQMxKmg-eQhAZzxPHpMZnQISwf3WaPYdlLnyzKPfV317PAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', 'k-EINdzHUkhtZq_gIUoxFbWFVG7yo-8h8qzVnxYQTiSu0YmG6vvoEbxY2REGewrIlN7fT3pUqxCaFQ1YAsk-82XPiPB3tNy1al0Bw8goj6AV32G0Vj7yn4fRFY7lySJK', 1);

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
  `studentSchoolStatus` tinyint(1) NOT NULL,
  `registeredBy` varchar(240) NOT NULL,
  `guardianStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_students_guardian_details`
--

INSERT INTO `zvs_students_guardian_details` (`id`, `systemSchoolCode`, `identificationCode`, `guardianDesignation`, `guardianFirstName`, `guardianMiddleName`, `guardianLastName`, `guardianGender`, `guardianDateOfBirth`, `guardianReligion`, `guardianCountry`, `guardianLocality`, `guardianBoxAddress`, `guardianPhoneNumber`, `guardianRelation`, `guardianOccupation`, `guardianLanguage`, `studentSchoolStatus`, `registeredBy`, `guardianStatus`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9Gu_iij8ixUXm3NsafrO-7iuGqqc4qU51fpgieCzw-FO62XPiPB3tNy1al0Bw8goj6AV32G0Vj7yn4fRFY7lySJK', 'Mr', 'George', 'Otieno', 'Abong''o', 'Male', '13-02-2017', 'Christian', '+254', '17', 'P.O Box 73619 -00100', '0703334363', 'Parent', 'Accountant', 'English', 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', '1Ib5qGDZlQDWPjmMLx8LfOu7-9uqDucBi5zttHQqN_a_iij8ixUXm3NsafrO-7iuGqqc4qU51fpgieCzw-FO6015y12zQDqIIR2Y6CbpKtbG4nq7eQ2EptKcbFx4esHF', 'Mr', 'Daglous', 'Mweu', 'Musyoki', 'Male', '19-07-1972', 'Christian', '+254', '22', 'P.O Box 73619 -00100', '0703334363', 'Parent', 'Accountant', 'English', 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(3, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'aWiMHE6ktI2E3MHc82Z7rgXTzGfvpAwswYmzU1DiaGC_iij8ixUXm3NsafrO-7iuGqqc4qU51fpgieCzw-FO69gE1JO73X3pl1KOPQ1xAASrrDDFnHfUTmWzNB5_n5Hu', 'Mr', 'Gershon', 'Koskei', 'Cheptirit', 'Male', '27-07-1971', 'Christian', '+254', '32', 'P.O Box 73619 -00100', '0707773767', 'Uncle or Aunt', 'Teacher', 'English', 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(4, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'dipvhr8Olna5rxtiuQhN0hIQarZuKGcAwqC3GeG8D8HmF4yFQGyNOseQt3K0-YCiV3ahMvq0_yiHDB_ntxgAGWXPiPB3tNy1al0Bw8goj6AV32G0Vj7yn4fRFY7lySJK', 'Mr', 'Robert', 'Inganji', 'Wekesa', 'Male', '10-01-1949', 'Christian', '+254', '11', 'P.O Box 419 -00100, Kakamega', '0720676781', 'Grandparent', 'Farmer', 'English', 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(5, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', '2OSpdqbWNYVQx-4g4GuFV23CrbimzwIT6LY-NGiCHn39ZdYc7tm0QASj0oD0aJErHD69-1EMZm4lW-7QE3nkbJKXn_q2g79_jsVFCcmeo9zDX3eM9sFB1n6Q6gLG7lMJ', 'Mrs', 'Roseline', 'Atieno', 'Ndege', 'Female', '25-06-1970', 'Christian', '+254', '8', 'P.O Box 739 -00100, Homabay', '0771890679', 'Parent', 'Secretary', 'English', 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(6, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'KCZVMKpxNICmofxlL5QTDrQqxXVm0B2U1jcvr2RlxQjmF4yFQGyNOseQt3K0-YCiV3ahMvq0_yiHDB_ntxgAGdgE1JO73X3pl1KOPQ1xAASrrDDFnHfUTmWzNB5_n5Hu', 'Mr', 'Patrick', 'Kamau', 'Matu', 'Male', '10-04-1971', 'Christian', '+254', '13', 'P.O Box 4561 - 0200, Kiambu', '0703774363', 'Parent', 'Policeman', 'English', 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(7, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9GvlAROHjheDoTyFANuXrRioPA8WvHQsEnHfq93X2J2VN2XPiPB3tNy1al0Bw8goj6AV32G0Vj7yn4fRFY7lySJK', 'Mr', 'Alfred', 'Odondo', 'Mbaji', 'Male', '04-02-1971', 'Christian', '+254', '17', 'P.O Box 73619 -00100', '0703334363', 'Adoptive Parent', 'Accountant', 'English', 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(8, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'k-EINdzHUkhtZq_gIUoxFbWFVG7yo-8h8qzVnxYQTiSu0YmG6vvoEbxY2REGewrIlN7fT3pUqxCaFQ1YAsk-82XPiPB3tNy1al0Bw8goj6AV32G0Vj7yn4fRFY7lySJK', 'Mr', 'Daniel', 'Mulili', 'Mulili', 'Male', '29-12-1960', 'Christian', '+254', '23', 'P.O Box 476, Malili', '0703676767', 'Parent', 'Business man', 'English', 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1);

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
  `studentSchoolStatus` tinyint(1) NOT NULL,
  `registeredBy` varchar(240) NOT NULL,
  `studentStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_students_medical_details`
--

INSERT INTO `zvs_students_medical_details` (`id`, `systemSchoolCode`, `studentIdentificationCode`, `studentAdmissionNumber`, `isStudentBloodGroup`, `studentBloodGroup`, `isStudentDisable`, `studentDisability`, `isStudentMedicated`, `studentMedication`, `isStudentAllergic`, `studentAllergic`, `isStudentTreatment`, `studentTreatment`, `isStudentPhysician`, `physicianDesignation`, `physicianFirstName`, `physicianLastName`, `firstPhysicianMobileNumber`, `secondPhysicianMobileNumber`, `physicianEmailAddress`, `physicianBoxAddress`, `physicianCountry`, `physicianLocality`, `isStudentHospital`, `hospitalName`, `firstHospitalNumber`, `secondHospitalNumber`, `hospitalBoxAddress`, `hospitalEmailAddress`, `hospitalCountry`, `hospitalLocality`, `studentSchoolStatus`, `registeredBy`, `studentStatus`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9GvhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VLPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '1111', 'Yes', 'O+', 'Yes', 'My ears are so big, I hear everything.', 'Yes', 'I had a tooth recently extracted and I am still on medication', 'Yes', 'I formulate goose pimples when it gets cold', 'Yes', 'At night, I usually get scared', 'Yes', 'Dr', 'Michael', 'Ocholla', '0711111111', '0722222222', 'ocholla@gmail.com', 'P.O Box 25555 - 001111', '+254', '17', 'Yes', 'Aga Khan', '071111111', '07111111', 'P.O Box 7777 - 00100', 'admin@agakhan.com', '+254', '30', 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', '1Ib5qGDZlQDWPjmMLx8LfOu7-9uqDucBi5zttHQqN_bhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VEfH4qs1N4jtmzglgkT65mm_Jsvc-n30la-DRXtPWSZe', '1112', 'No', NULL, 'No', NULL, 'No', NULL, 'No', NULL, 'No', NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(3, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'aWiMHE6ktI2E3MHc82Z7rgXTzGfvpAwswYmzU1DiaGDhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VJnjbqs0lVf-3qaihYVmuvHbAaeS0dFg_tG5uWqajBu4', '1113', 'Yes', 'A+', 'No', NULL, 'Yes', 'I have breathing problems which means that I have to use inhaler.', 'No', NULL, 'No', NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(4, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'dipvhr8Olna5rxtiuQhN0hIQarZuKGcAwqC3GeG8D8H982IWzB-90F9fb-1tccW9RTMdVuXDhlBDd21qBICk8LPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '2111', 'Yes', 'A+', 'No', NULL, 'No', NULL, 'No', NULL, 'No', NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(5, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', '2OSpdqbWNYVQx-4g4GuFV23CrbimzwIT6LY-NGiCHn151-QkxhO4efqMqH1Ddpjg9LMRUy4rU-AjyUM9bnq1O015y12zQDqIIR2Y6CbpKtbG4nq7eQ2EptKcbFx4esHF', '2112', 'Yes', 'A+', 'No', NULL, 'No', NULL, 'No', NULL, 'Yes', 'I am Asthmatic. This condition requires regular medical check-up', 'Yes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(6, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'KCZVMKpxNICmofxlL5QTDrQqxXVm0B2U1jcvr2RlxQj982IWzB-90F9fb-1tccW9RTMdVuXDhlBDd21qBICk8Jnjbqs0lVf-3qaihYVmuvHbAaeS0dFg_tG5uWqajBu4', '2113', 'Yes', 'O+', 'Yes', 'I have vision problems. ', 'No', NULL, 'No', NULL, 'Yes', 'I am blind and need to use brialle', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(7, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9Gs7ocR-XZDDXwGGNizAL4AaDUsXZFZDCNpLt2BwhLni4rPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '3111', 'Yes', 'O+', 'No', NULL, 'No', NULL, 'No', NULL, 'No', NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(8, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'k-EINdzHUkhtZq_gIUoxFbWFVG7yo-8h8qzVnxYQTiQQMxKmg-eQhAZzxPHpMZnQISwf3WaPYdlLnyzKPfV317PAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '4111', 'Yes', 'O+', 'No', NULL, 'No', NULL, 'No', NULL, 'No', NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1);

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
  `studentSchoolStatus` tinyint(1) NOT NULL,
  `registeredBy` varchar(240) NOT NULL,
  `studentStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zvs_students_personal_details`
--

INSERT INTO `zvs_students_personal_details` (`id`, `systemSchoolCode`, `identificationCode`, `studentAdmissionNumber`, `studentFirstName`, `studentMiddleName`, `studentLastName`, `studentGender`, `studentDateOfBirth`, `studentReligion`, `studentCountry`, `studentLocality`, `studentBoxAddress`, `studentPhoneNumber`, `studentLanguage`, `studentSchoolStatus`, `registeredBy`, `studentStatus`) VALUES
(1, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9GvhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VLPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '1111', 'Mathew', 'Juma', 'Otieno', 'Male', '13-02-2017', 'Christian', '+254', '17', 'P.O Box 73619 -00100', '0727074108', 'English', 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(2, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', '1Ib5qGDZlQDWPjmMLx8LfOu7-9uqDucBi5zttHQqN_bhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VEfH4qs1N4jtmzglgkT65mm_Jsvc-n30la-DRXtPWSZe', '1112', 'James', 'Makau', 'Mweu', 'Male', '13-02-2017', 'Christian', '+254', '22', 'P.O Box 2500 -00700', '0725138058', 'English', 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(3, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'aWiMHE6ktI2E3MHc82Z7rgXTzGfvpAwswYmzU1DiaGDhljJtb7UxVINrmrIa3yg1P2qgW9wP7ltjekr1KGP8VJnjbqs0lVf-3qaihYVmuvHbAaeS0dFg_tG5uWqajBu4', '1113', 'Allan', 'Kibet', 'Koskei', 'Male', '09-02-1999', 'Christian', '+254', '32', 'P.O Box 40471 -00200', '0723676789', 'English', 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(4, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'dipvhr8Olna5rxtiuQhN0hIQarZuKGcAwqC3GeG8D8H982IWzB-90F9fb-1tccW9RTMdVuXDhlBDd21qBICk8LPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '2111', 'Regan', 'Mutuba', 'Inganji', 'Male', '24-05-1998', 'Christian', '+254', '11', 'P.O Box 519 -00100, Kakamega', '0720774563', 'English', 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(5, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', '2OSpdqbWNYVQx-4g4GuFV23CrbimzwIT6LY-NGiCHn151-QkxhO4efqMqH1Ddpjg9LMRUy4rU-AjyUM9bnq1O015y12zQDqIIR2Y6CbpKtbG4nq7eQ2EptKcbFx4esHF', '2112', 'Kevin', 'Odhiambo', 'Ndege', 'Male', '02-08-1998', 'Christian', '+254', '8', 'P.O Box 45 -0100, Homabay', '0721456723', 'English', 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(6, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'KCZVMKpxNICmofxlL5QTDrQqxXVm0B2U1jcvr2RlxQj982IWzB-90F9fb-1tccW9RTMdVuXDhlBDd21qBICk8Jnjbqs0lVf-3qaihYVmuvHbAaeS0dFg_tG5uWqajBu4', '2113', 'Albert', 'Kamau', 'Njeru', 'Male', '03-01-2000', 'Christian', '+254', '13', 'P.O Box 4561 - 0200, Kiambu', '0733678956', 'English', 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(7, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'oh6SipmG5IpN08r3LivJzYL__72riRvPlI8Nz0rE9Gs7ocR-XZDDXwGGNizAL4AaDUsXZFZDCNpLt2BwhLni4rPAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '3111', 'Mark', 'Ouma', 'Odondo', 'Male', '26-08-2000', 'Christian', '+254', '17', 'P.O Box 4678, Kisumu', '0733657842', 'English', 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1),
(8, 'Q&4%JR!abMgAfy*C15EVc2IYw3kKiL', 'k-EINdzHUkhtZq_gIUoxFbWFVG7yo-8h8qzVnxYQTiQQMxKmg-eQhAZzxPHpMZnQISwf3WaPYdlLnyzKPfV317PAHmxwFYEybxv0DTuRvyTuhBmlESJWhAeNA4IrzdUT', '4111', 'Jeremiah', 'Mutuva', 'Mulili', 'Male', '14-06-2000', 'Christian', '+254', '23', 'P.O Box 476, Malili', '0715768909', 'English', 1, 'i5OQFJp-sCHLEcjOAF_sed6nTEGw_tMwjRCdTyypl7Qx8nx0nKi4hI5kqCPArcxu2LNFBtaP0vZsBevbxGvQTg4tQEvNYpP95_59q_DnjhfJO6Q0GGn4SA4yKt-JFWDf', 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `zvs_teacher_subject_assignment`
--

CREATE TABLE `zvs_teacher_subject_assignment` (
  `id` int(11) NOT NULL,
  `systemSchoolCode` varchar(240) NOT NULL,
  `schoolClassCode` varchar(240) NOT NULL,
  `schoolStreamCode` varchar(240) NOT NULL,
  `schoolTeacherCode` varchar(240) NOT NULL,
  `schoolSubjectCode` varchar(240) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `teachingStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `zvs_fees_payment_detials`
--
ALTER TABLE `zvs_fees_payment_detials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zvs_fees_payment_reserved`
--
ALTER TABLE `zvs_fees_payment_reserved`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zvs_fees_payment_schedule`
--
ALTER TABLE `zvs_fees_payment_schedule`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `zvs_school_attendance_schedule`
--
ALTER TABLE `zvs_school_attendance_schedule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `systemAttendanceCode` (`systemAttendanceCode`);

--
-- Indexes for table `zvs_school_budget_categories`
--
ALTER TABLE `zvs_school_budget_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schoolClassCode` (`budgetCategoryCode`);

--
-- Indexes for table `zvs_school_budget_sub_categories`
--
ALTER TABLE `zvs_school_budget_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schoolStreamCode` (`budgetSubCategoryCode`);

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
-- Indexes for table `zvs_school_finance_allocation`
--
ALTER TABLE `zvs_school_finance_allocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zvs_school_financial_years`
--
ALTER TABLE `zvs_school_financial_years`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `zvs_school_payment_modes`
--
ALTER TABLE `zvs_school_payment_modes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zvs_school_roles`
--
ALTER TABLE `zvs_school_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schoolRoleCode_UNIQUE` (`schoolRoleCode`);

--
-- Indexes for table `zvs_school_running_budget`
--
ALTER TABLE `zvs_school_running_budget`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `zvs_school_time_table`
--
ALTER TABLE `zvs_school_time_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zvs_students_class_details`
--
ALTER TABLE `zvs_students_class_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identificationCode` (`identificationCode`);

--
-- Indexes for table `zvs_students_class_history`
--
ALTER TABLE `zvs_students_class_history`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `zvs_blood_groups`
--
ALTER TABLE `zvs_blood_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `zvs_class_school_fees`
--
ALTER TABLE `zvs_class_school_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `zvs_fees_payment_detials`
--
ALTER TABLE `zvs_fees_payment_detials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `zvs_fees_payment_reserved`
--
ALTER TABLE `zvs_fees_payment_reserved`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `zvs_fees_payment_schedule`
--
ALTER TABLE `zvs_fees_payment_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `zvs_general_school_fees`
--
ALTER TABLE `zvs_general_school_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `zvs_resource_categories`
--
ALTER TABLE `zvs_resource_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `zvs_resource_role_mapper`
--
ALTER TABLE `zvs_resource_role_mapper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `zvs_school_admin`
--
ALTER TABLE `zvs_school_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `zvs_school_attendance_schedule`
--
ALTER TABLE `zvs_school_attendance_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `zvs_school_budget_categories`
--
ALTER TABLE `zvs_school_budget_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `zvs_school_budget_sub_categories`
--
ALTER TABLE `zvs_school_budget_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `zvs_school_classes`
--
ALTER TABLE `zvs_school_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `zvs_school_country`
--
ALTER TABLE `zvs_school_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=276;
--
-- AUTO_INCREMENT for table `zvs_school_departments`
--
ALTER TABLE `zvs_school_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `zvs_school_department_heads`
--
ALTER TABLE `zvs_school_department_heads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zvs_school_details`
--
ALTER TABLE `zvs_school_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `zvs_school_examinations`
--
ALTER TABLE `zvs_school_examinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zvs_school_finance_allocation`
--
ALTER TABLE `zvs_school_finance_allocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `zvs_school_financial_years`
--
ALTER TABLE `zvs_school_financial_years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `zvs_school_grades`
--
ALTER TABLE `zvs_school_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zvs_school_hostels`
--
ALTER TABLE `zvs_school_hostels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zvs_school_locality`
--
ALTER TABLE `zvs_school_locality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `zvs_school_payment_modes`
--
ALTER TABLE `zvs_school_payment_modes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zvs_school_roles`
--
ALTER TABLE `zvs_school_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `zvs_school_running_budget`
--
ALTER TABLE `zvs_school_running_budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `zvs_school_streams`
--
ALTER TABLE `zvs_school_streams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `zvs_school_subjects`
--
ALTER TABLE `zvs_school_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zvs_school_sub_departments`
--
ALTER TABLE `zvs_school_sub_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `zvs_students_class_details`
--
ALTER TABLE `zvs_students_class_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `zvs_students_class_history`
--
ALTER TABLE `zvs_students_class_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zvs_students_guardians_mapper`
--
ALTER TABLE `zvs_students_guardians_mapper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `zvs_students_guardian_details`
--
ALTER TABLE `zvs_students_guardian_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `zvs_students_medical_details`
--
ALTER TABLE `zvs_students_medical_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `zvs_students_personal_details`
--
ALTER TABLE `zvs_students_personal_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `zvs_super_admin`
--
ALTER TABLE `zvs_super_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
