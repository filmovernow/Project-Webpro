-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307:3307
-- Generation Time: Dec 14, 2025 at 12:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onebyone`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `username`, `password`, `email`) VALUES
(8, '1', '$argon2id$v=19$m=65536,t=4,p=1$akhwZGtsSEFKR3JiY09LZg$hKBrs3VEUVsH25Ck10VDhjDVlqzOjhIvs/883pWxg98', '1@gmail.com'),
(9, '2', '$argon2id$v=19$m=65536,t=4,p=1$d1Bsa0k2Y1lmTXk0V290Zg$xP55zfAA3yAHT2kzeL5hHJ+5LSC4V+VdzIOmVpZMwiE', '2@gmail.com'),
(10, '3', '$argon2id$v=19$m=65536,t=4,p=1$all2aXhtWGdNUEI0UTBKSQ$6hFUNnirOR9kp0vipsD4CLmUlgcrbQNTU/a1LcW4+88', '3@gmail.com'),
(11, '4', '$argon2id$v=19$m=65536,t=4,p=1$RXpBbXZJcTY1TjdGNVdYMQ$B1xGX6kOWeJfrRViwhTkGER5p+G2T91Pab8xgRqB360', '4@gmail.com'),
(12, '5', '$argon2id$v=19$m=65536,t=4,p=1$Ry4yZi9PbWp5V0h3UktsMw$BkKZed/4Vz2WVJnit7ECVewdHxpX4CD3kjAgCSrKW4Q', '5@gmail.com'),
(13, '6', '$argon2id$v=19$m=65536,t=4,p=1$WTdnQVBRdFF4RXR0bHZHMg$u5wwGyvPvf/8Ar4OC+92hTebRxpT8VRCgB/U3U5ZOBk', '6@gmail.com'),
(14, '7', '$argon2id$v=19$m=65536,t=4,p=1$TWF3dTZoV2pRWVlMN2Z2Sg$QKeSNLvOdfdEvuzZvDAKRUZQXHEFpqSMyqg03I3dlZM', '7@gmail.com'),
(15, 'BeeGus', '$argon2id$v=19$m=65536,t=4,p=1$U2ZwQ1J5dTZHcDVuTFJxeg$30iLBpXItfyl0tV9sfbIBJPVEwQpKmTypCzN9OyeKB4', 'tang210348@gmail.com'),
(16, 'gusnaja', '$argon2id$v=19$m=65536,t=4,p=1$MHk5cXozZ1Z1Y2pjdS5DYQ$iiHHrKoKj3oac/UobgqXDEPv3TOBUihg66IaeOqOuzg', 'gus@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `movieID` int(10) UNSIGNED NOT NULL,
  `movieName` varchar(100) NOT NULL,
  `movieDesc` text NOT NULL,
  `rentalPrice` decimal(7,2) NOT NULL COMMENT 'in baht',
  `moviePosterURL` varchar(255) NOT NULL,
  `movieVideoURL` varchar(255) NOT NULL,
  `pgRatings` varchar(20) NOT NULL,
  `length` int(10) NOT NULL COMMENT 'in minutes',
  `language` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`movieID`, `movieName`, `movieDesc`, `rentalPrice`, `moviePosterURL`, `movieVideoURL`, `pgRatings`, `length`, `language`) VALUES
(1, 'พี่มาก..พระโขนง', 'ทหารกลับจากสงคราม พบว่าภรรยาที่บ้านเสียชีวิตไปแล้วและกลายเป็นผี ', 39.00, 'POSTER/1_PeeMak.png', 'VIDEO/1_PeeMak.mp4', 'PG-13', 112, 'Thai'),
(2, 'ชัตเตอร์ กดติดวิญญาณ', 'ช่างภาพหนุ่มและแฟนสาวถูกหลอนโดยภาพถ่ายเหนือธรรมชาติที่ปรากฏในรูปถ่ายของเขา', 49.00, 'POSTER/2_Shutter.png', 'VIDEO/2_Shutter.mp4', 'R', 97, 'Thai'),
(3, 'ฉลาดเกมส์โกง', 'นักเรียนมัธยมที่มีไอคิวระดับอัจฉริยะ วางแผนการโกงข้อสอบเพื่อแลกกับเงิน', 39.00, 'POSTER/3_BadGenius.png', 'VIDEO/3_BadGenius.mp4', 'PG-13', 130, 'Thai'),
(4, 'รักแห่งสยาม', 'ละครโรแมนติกที่เน้นความสัมพันธ์ระหว่างเด็กวัยรุ่นสองคนและครอบครัวของพวกเขา', 29.00, 'POSTER/4_LoveOfSiam.png', 'VIDEO/4_LoveOfSiam.mp4', 'PG-13', 155, 'Thai'),
(5, 'องค์บาก', 'นักรบศิลปะการต่อสู้เดินทางไปกรุงเทพฯ เพื่อนำเศียรพระพุทธรูปศักดิ์สิทธิ์ที่ถูกขโมยกลับคืนมา', 39.00, 'POSTER/5_OngBak.png', 'VIDEO/5_OngBak.mp4', 'R', 108, 'Thai'),
(6, 'กวน มึน โฮ', 'นักท่องเที่ยวชาวไทยสองคนพบกันโดยบังเอิญในเกาหลีใต้ ตกลงที่จะเดินทางด้วยกันโดยไม่เปิดเผยชื่อ', 29.00, 'POSTER/6_HelloStranger.png', 'VIDEO/6_HelloStranger.mp4', 'PG', 127, 'Thai'),
(7, 'ต้มยำกุ้ง', 'ชายหนุ่มต่อสู้เพื่อทวงช้างที่ถูกขโมยไปคืนจากแก๊งมาเฟียข้ามชาติในออสเตรเลีย', 39.00, 'POSTER/7_TomYumGoong.png', 'VIDEO/7_TomYumGoong.mp4', 'R', 108, 'Thai'),
(8, 'ร่างทรง', 'ทีมงานสารคดีตามติดหมอผี จนเกิดเหตุการณ์น่าสะพรึงกลัวเมื่อหลานสาวของเธอมีอาการถูกสิง', 49.00, 'POSTER/8_TheMedium.png', 'VIDEO/8_TheMedium.mp4', 'R', 131, 'Thai'),
(9, 'ลัดดาแลนด์', 'ครอบครัวย้ายเข้าไปอยู่ในโครงการบ้านจัดสรรใหม่ แต่ถูกก่อกวนโดยวิญญาณจากบ้านข้างๆ', 39.00, 'POSTER/9_Laddaland.png', 'VIDEO/9_Laddaland.mp4', 'R', 110, 'Thai'),
(10, 'รักที่รอคอย', 'เรื่องราวสุดเศร้าของผู้หญิงที่รอคอยความรักที่หายไปนานหลายปีโดยไม่ยอมแพ้', 29.00, 'POSTER/10_OctoberSonata.png', 'VIDEO/10_OctoberSonata.mp4', 'PG', 124, 'Thai'),
(11, 'รถไฟฟ้ามาหานะเธอ', 'หญิงโสดวัย 30 ปี พยายามตามหาความรักและพบเนื้อคู่ที่เป็นไปได้บนรถไฟฟ้า', 19.00, 'POSTER/11_BangkokTraffic.png', 'VIDEO/11_BangkokTraffic.mp4', 'PG', 125, 'Thai'),
(12, 'ซักซี้ด ห่วยขั้นเทพ', 'นักเรียนมัธยมปลายตั้งวงร็อกกับเพื่อนๆ โดยมีแรงผลักดันจากความรักในเสียงเพลงและความรู้สึกต่อผู้หญิงคนหนึ่ง', 29.00, 'POSTER/12_Suckseed.png', 'VIDEO/12_Suckseed.mp4', 'PG', 120, 'Thai'),
(13, 'นางนอน', 'เรื่องจริงของภารกิจช่วยชีวิตเด็กชาย 12 คนและโค้ชฟุตบอลที่ติดอยู่ในถ้ำหลวง-ขุนน้ำนางนอน ปี 2561', 39.00, 'POSTER/13_TheCave.png', 'VIDEO/13_TheCave.mp4', 'PG-13', 103, 'Thai'),
(14, 'เรื่องรัก น้อยนิด มหาศาล', 'นักธุรกิจชาวญี่ปุ่นผู้โดดเดี่ยวและหญิงสาวชาวไทยได้สร้างความสัมพันธ์ที่ไม่คาดคิดท่ามกลางความวุ่นวายในกรุงเทพฯ', 29.00, 'POSTER/14_LastLife.png', 'VIDEO/14_LastLife.mp4', 'R', 112, 'Thai'),
(15, 'สัตว์ประหลาด', 'ภาพยนตร์ที่ไม่เหมือนใคร แบ่งออกเป็นสองส่วน: ความรักระหว่างทหารกับเด็กหนุ่มบ้านนอก และการไล่ล่าในป่าลึกลับ', 19.00, 'POSTER/15_TropicalMalady.png', 'VIDEO/15_TropicalMalady.mp4', 'R', 118, 'Thai'),
(16, '2499 อันธพาลครองเมือง', 'ละครอาชญากรรมที่บันทึกชีวิตของอันธพาลวัยหนุ่มในกรุงเทพฯ ยุคปี 1950', 39.00, 'POSTER/16_DaengBireley.png', 'VIDEO/16_DaengBireley.mp4', 'R', 110, 'Thai'),
(17, 'ก้านกล้วย', 'การผจญภัยแอนิเมชันที่ติดตามชีวิตของลูกช้างที่เติบโตเป็นช้างศึก', 19.00, 'POSTER/17_Kluay.png', 'VIDEO/17_Kluay.mp4', 'G', 83, 'Thai'),
(18, 'หัวใจทรนง', 'สายลับสาวประเภทสองที่ต้องตามหาชิปคอมพิวเตอร์อันทรงพลังจากวายร้าย', 29.00, 'POSTER/18_IronPussy.png', 'VIDEO/18_IronPussy.mp4', 'PG-13', 87, 'Thai'),
(19, 'หมานคร', 'เรื่องราวเหนือจริงของเด็กหนุ่มจากชนบทที่ย้ายมาอยู่กรุงเทพฯ และตกหลุมรัก', 29.00, 'POSTER/19_CitizenDog.png', 'VIDEO/19_CitizenDog.mp4', 'PG', 100, 'Thai'),
(20, 'ATM เออรัก เออเร่อ', 'คู่รักที่ทำงานธนาคารพยายามปกปิดข้อผิดพลาดของตู้ ATM ที่จ่ายเงินเกินให้ลูกค้าหลายพันราย', 39.00, 'POSTER/20_ATMError.png', 'VIDEO/20_ATMError.mp4', 'PG-13', 120, 'Thai'),
(21, 'เฉือน', 'ระทึกขวัญเข้มข้นเกี่ยวกับนักสืบที่กำลังสอบสวนคดีฆาตกรรมอันโหดเหี้ยมที่เชื่อมโยงกับอดีตของเขา', 49.00, 'POSTER/21_Slice.png', 'VIDEO/21_Slice.mp4', 'R', 128, 'Thai'),
(22, 'Midnight Hotel', 'A poor young man secretly works as a hotel receptionist at night to save money for his dream.', 39.00, 'POSTER/22_MidnightHotel.png', 'VIDEO/22_MidnightHotel.mp4', 'PG', 105, 'English'),
(23, 'รัก 7 ปี ดี 7 หน', 'รวมหนังสั้นสามเรื่องที่แสดงถึงเรื่องราวความรักในช่วงอายุต่างๆ: 14, 21 และ 40', 29.00, 'POSTER/23_SevenSomething.png', 'VIDEO/23_SevenSomething.mp4', 'PG-13', 140, 'Thai'),
(24, 'บอดี้การ์ดหน้าเหลี่ยม', 'บอดี้การ์ดฝีมือดีที่ต้องปลอมตัวเพื่อปกป้องลูกสาวของนักธุรกิจผู้มีอิทธิพล', 39.00, 'POSTER/24_TheBodyguard.png', 'VIDEO/24_TheBodyguard.mp4', 'PG-13', 100, 'Thai'),
(25, 'สี่แพร่ง', 'ภาพยนตร์รวมสี่เรื่องสั้นแนวสยองขวัญ ซึ่งแต่ละเรื่องเกี่ยวข้องกับความกลัวในรูปแบบต่างๆ', 49.00, 'POSTER/25_4Bia.png', 'VIDEO/25_4Bia.mp4', 'R', 96, 'Thai'),
(26, 'ปืนใหญ่จอมสลัด', 'ภาพยนตร์แอ็คชั่นอิงประวัติศาสตร์เกี่ยวกับนายพลตำรวจในตำนานที่ต่อสู้กับโจรในภาคใต้ของประเทศไทย', 39.00, 'POSTER/26_CryOfTheEagle.png', 'VIDEO/26_CryOfTheEagle.mp4', 'PG-13', 120, 'Thai'),
(27, 'ฟรีแลนซ์..ห้ามป่วย ห้ามพัก ห้ามรักหมอ', 'ฟรีแลนซ์บ้างานผู้ประสบความสำเร็จ เกิดผื่นขึ้นที่ผิวหนังและตกหลุมรักหมอสาวของเขา', 39.00, 'POSTER/27_HeartAttack.png', 'VIDEO/27_HeartAttack.mp4', 'PG-13', 132, 'Thai'),
(28, 'นักรบผู้ก่อการร้าย', 'ละครเข้มข้นเกี่ยวกับกลุ่มนักศึกษาที่เข้าไปพัวพันกับการต่อต้านทางการเมืองและการก่อการร้าย', 39.00, 'POSTER/28_TheTerrorist.png', 'VIDEO/28_TheTerrorist.mp4', 'R', 115, 'Thai'),
(29, 'มนต์รักลูกทุ่ง', 'ภาพยนตร์เพลงโรแมนติกสุดคลาสสิกในชนบท ที่นำเสนอเพลงลูกทุ่งไทยดั้งเดิม', 19.00, 'POSTER/29_Monrak.png', 'VIDEO/29_Monrak.mp4', 'G', 120, 'Thai'),
(30, 'โหมโรง', 'ละครชีวประวัติเกี่ยวกับปรมาจารย์ระนาดเอกในรัชสมัยของรัชกาลที่ 5', 29.00, 'POSTER/30_TheOverture.png', 'VIDEO/30_TheOverture.mp4', 'PG', 103, 'Thai'),
(31, 'แฝด', 'ภาพยนตร์สยองขวัญเกี่ยวกับหญิงสาวที่ชีวิตถูกทรมานโดยวิญญาณของฝาแฝดสยามที่เสียชีวิตไปแล้ว', 49.00, 'POSTER/31_Alone.png', 'VIDEO/31_Alone.mp4', 'R', 100, 'Thai'),
(32, 'น้อง.พี่.ที่รัก', 'คอเมดี้สุดฮาและอบอุ่นหัวใจเกี่ยวกับพี่ชายจอมบงการและความสัมพันธ์ของเขากับน้องสาว', 39.00, 'POSTER/32_BrotherofTheYear.png', 'VIDEO/32_BrotherofTheYear.mp4', 'PG-13', 121, 'Thai'),
(33, 'แฮปปี้เบิร์ธเดย์', 'ชายหนุ่มพบว่าตัวเองติดอยู่ในห้วงเวลาที่ต้องย้อนกลับไปใช้ชีวิตในวันเกิดของเขาซ้ำแล้วซ้ำอีก เพื่อพยายามช่วยคนที่รัก', 29.00, 'POSTER/33_HappyBirthday.png', 'VIDEO/33_HappyBirthday.mp4', 'PG', 108, 'Thai'),
(34, 'เดอะกิ๊ก', 'โรแมนติกคอเมดี้เกี่ยวกับนักดนตรีผู้มีความฝันสองคนที่ความฝันและชีวิตรักมาบรรจบกัน', 19.00, 'POSTER/34_TheGig.png', 'VIDEO/34_TheGig.mp4', 'PG', 115, 'Thai'),
(35, 'เรื่องตลก69', 'ตลกดาร์กเกี่ยวกับผู้หญิงที่เจอกระเป๋าเงินและพยายามอย่างยิ่งยวดที่จะเก็บมันไว้', 39.00, 'POSTER/35_SixNinetyNine.png', 'VIDEO/35_SixNinetyNine.mp4', 'R', 117, 'Thai'),
(36, 'ห้วงรักอารมณ์เสน่หา', 'เรื่องราววัยรุ่นที่มีชีวิตชีวาในหมู่บ้านชาวประมงเล็กๆ ทางภาคใต้ของประเทศไทย', 29.00, 'POSTER/36_InTheMood.png', 'VIDEO/36_InTheMood.mp4', 'PG', 105, 'Thai'),
(37, 'ตุ๊กตาสยองขวัญ', 'ระทึกขวัญเกี่ยวกับกลุ่มเพื่อนที่เจอตุ๊กตาลึกลับและถูกสาปหลังจากเดินทางไกล', 49.00, 'POSTER/37_DeadlyDolls.png', 'VIDEO/37_DeadlyDolls.mp4', 'R', 95, 'Thai'),
(38, 'รักแรกจูบ', 'โรแมนติกคอเมดี้เกี่ยวกับเด็กสาวมัธยมปลายที่ตกหลุมรักผู้ชายที่อายุมากกว่าเธอ 10 ปี', 29.00, 'POSTER/38_FirstKiss.png', 'VIDEO/38_FirstKiss.mp4', 'PG', 110, 'Thai'),
(39, 'BangkokDangerous', 'An English-language action thriller starring Nicolas Cage, filmed and set in Bangkok.', 49.00, 'POSTER/39_BangkokDangerous.png', 'VIDEO/39_BangkokDangerous.mp4', 'R', 99, 'English'),
(40, 'TheBeach', 'An American backpacker finds a map to a secluded paradise island in the Gulf of Thailand.', 39.00, 'POSTER/40_TheBeach.png', 'VIDEO/40_TheBeach.mp4', 'R', 119, 'English'),
(41, 'TheElephantKing', 'A drama focusing on an American man who goes to Thailand seeking enlightenment and finds a spiritual connection with an elephant.', 29.00, 'POSTER/41_TheElephantKing.png', 'VIDEO/41_TheElephantKing.mp4', 'PG-13', 100, 'English'),
(42, 'บั้งไฟพญานาค', 'ระทึกขวัญเหนือธรรมชาติจากตำนานลูกไฟที่ลอยขึ้นจากแม่น้ำโขง', 39.00, 'POSTER/42_MekhongFullMoon.png', 'VIDEO/42_MekhongFullMoon.mp4', 'PG-13', 105, 'Thai'),
(43, 'โกว์คลับ', 'ละครเกี่ยวกับชีวิตของเด็กหนุ่มห้าคนที่หลงใหลในฟุตบอลในชุมชนเล็กๆ ของพวกเขา', 29.00, 'POSTER/43_GoalClub.png', 'VIDEO/43_GoalClub.mp4', 'PG', 100, 'Thai'),
(44, 'Friend Zone ระวัง..สิ้นสุดทางเพื่อน', 'ชายหนุ่มพยายามหลุดพ้นจาก Friend Zone หลังจากเป็นเพื่อนสนิทกับผู้หญิงที่เขารักมานาน 10 ปี', 39.00, 'POSTER/44_FriendZone.png', 'VIDEO/44_FriendZone.mp4', 'PG-13', 118, 'Thai'),
(45, 'เพื่อนที่ระลึก', 'เพื่อนสมัยเด็กสองคนสัญญาว่าจะฆ่าตัวตายด้วยกัน แต่มีเพียงคนเดียวที่รักษาสัญญา', 49.00, 'POSTER/45_ThePromise.png', 'VIDEO/45_ThePromise.mp4', 'R', 115, 'Thai'),
(46, 'รุ่นพี่', 'เด็กสาวมัธยมปลายที่ได้กลิ่นวิญญาณสามารถไขคดีฆาตกรรมได้ด้วยความช่วยเหลือจากวิญญาณรุ่นพี่', 29.00, 'POSTER/46_Senior.png', 'VIDEO/46_Senior.mp4', 'PG-13', 108, 'Thai'),
(47, 'คิดถึงวิทยา', 'ครูสองคนต่างเวลากัน เขียนไดอารี่เล่มเดียวกัน แบ่งปันเรื่องราวชีวิตในโรงเรียนลอยน้ำที่ห่างไกล', 29.00, 'POSTER/47_TeacherDiary.png', 'VIDEO/47_TeacherDiary.mp4', 'PG', 110, 'Thai'),
(48, 'ปิดเทอมใหญ่ หัวใจว้าวุ่น', 'ชุดละครวัยรุ่นสี่เรื่องที่เกี่ยวพันกัน ติดตามชีวิตที่ซับซ้อนของนักเรียนมัธยมปลาย', 39.00, 'POSTER/48_Hormones.png', 'VIDEO/48_Hormones.mp4', 'PG-13', 118, 'Thai'),
(49, 'แฟนฉัน', 'ชายหนุ่มรำลึกถึงวัยเด็กและความผูกพันอันบริสุทธิ์กับเพื่อนสนิทที่สุดของเขาที่ตอนนี้เติบโตไปแล้ว', 19.00, 'POSTER/49_MyGirl.png', 'VIDEO/49_MyGirl.mp4', 'G', 100, 'Thai'),
(50, 'ขุนแผนฟ้าฟื้น', 'ภาพยนตร์แอ็คชั่นแฟนตาซีอิงจากนิทานพื้นบ้านของขุนแผน ผู้มีวิชาอาคมและมีความสามารถเหนือธรรมชาติ', 39.00, 'POSTER/50_Kunpan.png', 'VIDEO/50_Kunpan.mp4', 'PG-13', 130, 'Thai');

-- --------------------------------------------------------

--
-- Table structure for table `movie_tag`
--

CREATE TABLE `movie_tag` (
  `movieID` int(10) UNSIGNED NOT NULL,
  `tagID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `movie_tag`
--

INSERT INTO `movie_tag` (`movieID`, `tagID`) VALUES
(1, 1),
(1, 8),
(2, 2),
(2, 3),
(3, 3),
(3, 6),
(4, 3),
(4, 8),
(5, 6),
(5, 7),
(6, 1),
(6, 7),
(6, 8),
(7, 6),
(7, 7),
(8, 2),
(8, 3),
(9, 2),
(9, 3),
(10, 3),
(10, 8),
(11, 1),
(11, 8),
(12, 1),
(12, 8),
(13, 3),
(13, 7),
(14, 3),
(14, 8),
(15, 3),
(15, 4),
(16, 3),
(16, 6),
(17, 7),
(17, 9),
(18, 1),
(18, 6),
(19, 4),
(19, 8),
(20, 1),
(20, 6),
(21, 3),
(21, 6),
(22, 3),
(22, 8),
(23, 3),
(23, 8),
(24, 1),
(24, 6),
(25, 2),
(26, 3),
(26, 6),
(27, 1),
(27, 3),
(27, 8),
(28, 3),
(28, 6),
(29, 1),
(29, 8),
(30, 3),
(31, 2),
(31, 3),
(32, 1),
(32, 8),
(33, 5),
(33, 8),
(34, 1),
(34, 8),
(35, 1),
(35, 3),
(36, 3),
(36, 8),
(37, 2),
(37, 7),
(39, 3),
(39, 6),
(40, 3),
(40, 7),
(41, 3),
(41, 7),
(42, 2),
(42, 4),
(43, 1),
(43, 3),
(44, 1),
(44, 7),
(44, 8),
(45, 2),
(45, 3),
(46, 2),
(46, 8),
(47, 3),
(47, 8),
(48, 3),
(48, 8),
(49, 1),
(49, 3),
(49, 8),
(50, 4),
(50, 6);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(10) UNSIGNED NOT NULL,
  `rentalID` int(10) UNSIGNED NOT NULL,
  `paymentMethod` enum('promptPay','trueMoney','creditcard','') NOT NULL,
  `amount` decimal(7,2) NOT NULL,
  `paymentDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `rentalID`, `paymentMethod`, `amount`, `paymentDate`) VALUES
(1, 3, 'trueMoney', 39.00, '2025-12-14'),
(2, 4, 'trueMoney', 29.00, '2025-12-14'),
(3, 5, 'trueMoney', 39.00, '2025-12-14'),
(4, 6, 'trueMoney', 58.00, '2025-12-14'),
(5, 7, 'promptPay', 39.00, '2025-12-14'),
(6, 8, 'trueMoney', 39.00, '2025-12-14'),
(7, 9, 'promptPay', 29.00, '2025-12-14'),
(8, 10, 'promptPay', 39.00, '2025-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `ratingID` int(10) UNSIGNED NOT NULL,
  `movieID` int(10) UNSIGNED NOT NULL,
  `rentalID` int(10) UNSIGNED NOT NULL,
  `stars` int(5) NOT NULL,
  `ratedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`ratingID`, `movieID`, `rentalID`, `stars`, `ratedDate`) VALUES
(3, 3, 1, 4, '2025-12-14'),
(4, 16, 1, 3, '2025-12-14'),
(5, 42, 1, 5, '2025-12-14'),
(6, 3, 2, 5, '2025-12-14'),
(7, 39, 2, 1, '2025-12-14'),
(8, 1, 1, 4, '2025-12-14'),
(9, 47, 4, 4, '2025-12-14'),
(10, 48, 5, 5, '2025-12-14'),
(11, 48, 8, 5, '2025-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `rentalID` int(10) UNSIGNED NOT NULL,
  `customerID` int(10) UNSIGNED NOT NULL,
  `rentalDate` date NOT NULL,
  `expireDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`rentalID`, `customerID`, `rentalDate`, `expireDate`) VALUES
(1, 8, '2025-12-13', '2025-12-17'),
(2, 9, '2025-12-13', '2025-12-17'),
(3, 8, '2025-12-14', '2025-12-21'),
(4, 8, '2025-12-14', '2025-12-21'),
(5, 8, '2025-12-14', '2025-12-21'),
(6, 8, '2025-12-14', '2025-12-21'),
(7, 8, '2025-12-14', '2025-12-21'),
(8, 15, '2025-12-14', '2025-12-21'),
(9, 15, '2025-12-14', '2025-12-21'),
(10, 15, '2025-12-14', '2025-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `rental_movie`
--

CREATE TABLE `rental_movie` (
  `movieID` int(10) UNSIGNED NOT NULL,
  `rentalID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rental_movie`
--

INSERT INTO `rental_movie` (`movieID`, `rentalID`) VALUES
(1, 1),
(3, 1),
(3, 2),
(16, 1),
(20, 1),
(23, 1),
(39, 2),
(42, 1),
(44, 7),
(45, 1),
(46, 6),
(46, 9),
(47, 6),
(48, 5),
(48, 8),
(50, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tagID` int(10) UNSIGNED NOT NULL,
  `tag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tagID`, `tag`) VALUES
(1, 'ตลก'),
(2, 'สยองขวัญ'),
(3, 'ดราม่า'),
(4, 'แฟนตาซี'),
(5, 'ไซไฟ'),
(6, 'แอคชั่น'),
(7, 'ผจญภัย'),
(8, 'โรแมนติก'),
(9, 'แอนิเมชัน');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movieID`);

--
-- Indexes for table `movie_tag`
--
ALTER TABLE `movie_tag`
  ADD PRIMARY KEY (`movieID`,`tagID`) USING BTREE,
  ADD KEY `movieID` (`movieID`),
  ADD KEY `tagID` (`tagID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `rentalID` (`rentalID`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`ratingID`),
  ADD KEY `movieID` (`movieID`),
  ADD KEY `rentalID` (`rentalID`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`rentalID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `rental_movie`
--
ALTER TABLE `rental_movie`
  ADD PRIMARY KEY (`movieID`,`rentalID`) USING BTREE,
  ADD KEY `rentalID` (`rentalID`) USING BTREE,
  ADD KEY `movieID` (`movieID`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tagID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `movieID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `ratingID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `rentalID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tagID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movie_tag`
--
ALTER TABLE `movie_tag`
  ADD CONSTRAINT `movie_tag_ibfk_1` FOREIGN KEY (`movieID`) REFERENCES `movie` (`movieID`),
  ADD CONSTRAINT `movie_tag_ibfk_2` FOREIGN KEY (`tagID`) REFERENCES `tag` (`tagID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`rentalID`) REFERENCES `rental` (`rentalID`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`movieID`) REFERENCES `movie` (`movieID`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`rentalID`) REFERENCES `rental` (`rentalID`);

--
-- Constraints for table `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `rental_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`);

--
-- Constraints for table `rental_movie`
--
ALTER TABLE `rental_movie`
  ADD CONSTRAINT `rental_movie_ibfk_1` FOREIGN KEY (`movieID`) REFERENCES `movie` (`movieID`),
  ADD CONSTRAINT `rental_movie_ibfk_2` FOREIGN KEY (`rentalID`) REFERENCES `rental` (`rentalID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
