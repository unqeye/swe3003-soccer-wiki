-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 19-06-23 20:17
-- 서버 버전: 10.1.39-MariaDB
-- PHP 버전: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `webdb`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `country`
--

CREATE TABLE `country` (
  `c_id` int(11) NOT NULL,
  `c_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `country`
--

INSERT INTO `country` (`c_id`, `c_name`) VALUES
(14, '잉글랜드'),
(18, '프랑스'),
(21, '독일'),
(27, '이탈리아'),
(34, '네덜란드'),
(38, '포르투갈'),
(45, '스페인'),
(50, '웨일스'),
(52, '아르헨티나'),
(54, '브라질'),
(167, '대한민국');

-- --------------------------------------------------------

--
-- 테이블 구조 `favorite`
--

CREATE TABLE `favorite` (
  `u_id` varchar(12) NOT NULL,
  `p_id` int(11) NOT NULL,
  `memo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `favorite`
--

INSERT INTO `favorite` (`u_id`, `p_id`, `memo`) VALUES
('admin', 200104, '우리 흥');

-- --------------------------------------------------------

--
-- 테이블 구조 `league`
--

CREATE TABLE `league` (
  `l_id` int(11) NOT NULL,
  `l_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `league`
--

INSERT INTO `league` (`l_id`, `l_name`) VALUES
(10, '네덜란드 에레디비지'),
(13, '잉글랜드 프리미어리그'),
(19, '독일 분데스리가'),
(31, '이탈리아 세리에 A'),
(53, '스페인 라리가 산탄데르'),
(83, '대한민국 K리그 1');

-- --------------------------------------------------------

--
-- 테이블 구조 `manager`
--

CREATE TABLE `manager` (
  `m_id` int(11) NOT NULL,
  `m_fname` text NOT NULL,
  `m_lname` text NOT NULL,
  `m_birthdate` date DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL,
  `m_until` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `manager`
--

INSERT INTO `manager` (`m_id`, `m_fname`, `m_lname`, `m_birthdate`, `c_id`, `m_until`) VALUES
(1000067, '마우리시오', '포체티노', '1973-03-02', 52, 2023),
(1000417, '펩', '과르디올라', '1971-01-18', 45, 2021),
(1000524, '마르셀리노', '가르시아 토랄', '1965-08-14', 45, 2020);

-- --------------------------------------------------------

--
-- 테이블 구조 `player`
--

CREATE TABLE `player` (
  `p_id` int(11) NOT NULL,
  `p_fname` text NOT NULL,
  `p_lname` text NOT NULL,
  `p_birthdate` date DEFAULT NULL,
  `position` text,
  `height` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL,
  `t_id` int(11) DEFAULT NULL,
  `p_until` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `player`
--

INSERT INTO `player` (`p_id`, `p_fname`, `p_lname`, `p_birthdate`, `position`, `height`, `weight`, `c_id`, `t_id`, `p_until`) VALUES
(20801, '크리스티아누', '호날두', '1985-02-05', 'FW', 187, 80, 38, 45, 2022),
(167948, '위고', '요리스', '1986-12-26', 'GK', 188, 82, 18, 18, 2022),
(173731, '가레스', '베일', '1989-07-16', 'FW', 185, 82, 50, 243, 2022),
(200104, '흥민', '손', '1992-07-08', 'FW', 183, 78, 167, 18, 2023),
(211117, '델리', '알리', '1996-04-11', 'MF', 188, 80, 14, 18, 2024);

-- --------------------------------------------------------

--
-- 테이블 구조 `team`
--

CREATE TABLE `team` (
  `t_id` int(11) NOT NULL,
  `t_name` text NOT NULL,
  `l_id` int(11) NOT NULL,
  `m_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `team`
--

INSERT INTO `team` (`t_id`, `t_name`, `l_id`, `m_id`) VALUES
(5, '첼시', 13, NULL),
(10, '맨체스터 시티', 13, 1000417),
(18, '토트넘 홋스퍼', 13, 1000067),
(45, '유벤투스', 31, NULL),
(243, '레알 마드리드', 53, NULL),
(461, '발렌시아 CF', 53, 1000524);

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE `user` (
  `u_id` varchar(12) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`u_id`, `password`) VALUES
('admin', '1234'),
('user', '1234'),
('user2', '1234'),
('user3', '1234'),
('user4', '1234'),
('user5', '1234');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`c_id`);

--
-- 테이블의 인덱스 `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`u_id`,`p_id`),
  ADD KEY `p_id` (`p_id`);

--
-- 테이블의 인덱스 `league`
--
ALTER TABLE `league`
  ADD PRIMARY KEY (`l_id`);

--
-- 테이블의 인덱스 `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`m_id`),
  ADD KEY `c_id` (`c_id`);

--
-- 테이블의 인덱스 `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `t_id` (`t_id`);

--
-- 테이블의 인덱스 `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `l_id` (`l_id`),
  ADD KEY `m_id` (`m_id`);

--
-- 테이블의 인덱스 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`),
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `player` (`p_id`);

--
-- 테이블의 제약사항 `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `country` (`c_id`);

--
-- 테이블의 제약사항 `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `player_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `country` (`c_id`),
  ADD CONSTRAINT `player_ibfk_2` FOREIGN KEY (`t_id`) REFERENCES `team` (`t_id`);

--
-- 테이블의 제약사항 `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`l_id`) REFERENCES `league` (`l_id`),
  ADD CONSTRAINT `team_ibfk_2` FOREIGN KEY (`m_id`) REFERENCES `manager` (`m_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
