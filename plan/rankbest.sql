-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 19-10-07 23:48
-- 서버 버전: 10.1.41-MariaDB-0+deb9u1
-- PHP 버전: 7.3.9-1+0~20190902.44+debian9~1.gbpf8534c

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `rankbest`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `rankitems`
--

CREATE TABLE `rankitems` (
  `id` int(11) NOT NULL,
  `slug` varchar(7) NOT NULL COMMENT '고유주소',
  `title` varchar(127) NOT NULL COMMENT '제목(원래 시소러스의 title을 가져와야 되나 속도를 빠르게 하기 위해 여기에 필드를 만듦)',
  `lang` varchar(5) NOT NULL COMMENT '언어',
  `parent_slug` varchar(255) NOT NULL COMMENT '상위어 고유주소',
  `period` varchar(10) NOT NULL COMMENT '기간(2019-01-01형식)',
  `user_id` varchar(12) NOT NULL COMMENT '글쓴 사람 아이디',
  `memo` text NOT NULL,
  `sort` int(11) NOT NULL COMMENT '순위'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='순위리스트의 상세항목들';

--
-- 테이블의 덤프 데이터 `rankitems`
--

INSERT INTO `rankitems` (`id`, `slug`, `title`, `lang`, `parent_slug`, `period`, `user_id`, `memo`, `sort`) VALUES
(1, 'jeju', '제주도', 'ko-KR', 'tour', '', '', '', 0),
(2, 'seoul', '서울', 'ko-KR', 'tour', '', '', '', 0),
(3, 'gangwon', '강원', 'ko-KR', 'tour', '', '', '', 0),
(4, 'gyeongg', '경기', 'ko-KR', 'tour', '', '', '', 0);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `rankitems`
--
ALTER TABLE `rankitems`
  ADD PRIMARY KEY (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `rankitems`
--
ALTER TABLE `rankitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
