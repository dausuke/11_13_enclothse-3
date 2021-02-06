-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2021 年 2 月 06 日 03:50
-- サーバのバージョン： 10.4.17-MariaDB
-- PHP のバージョン: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `enclothes`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `article`
--

CREATE TABLE `article` (
  `article_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `main_text` varchar(500) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `shop_id` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updeted_at` datetime(1) NOT NULL,
  `is_daleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `brand1` varchar(100) NOT NULL,
  `brand2` varchar(100) NOT NULL,
  `brand3` varchar(100) NOT NULL,
  `brand4` varchar(100) NOT NULL,
  `brand5` varchar(100) NOT NULL,
  `brand6` varchar(100) DEFAULT NULL,
  `brand7` varchar(100) DEFAULT NULL,
  `brand8` varchar(100) DEFAULT NULL,
  `brand9` varchar(100) DEFAULT NULL,
  `brand10` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updateted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `brand`
--

INSERT INTO `brand` (`id`, `shop_id`, `brand1`, `brand2`, `brand3`, `brand4`, `brand5`, `brand6`, `brand7`, `brand8`, `brand9`, `brand10`, `created_at`, `updateted_at`) VALUES
(1, 2, 'rdv o globe', 'lanefortyfive', 'gicipi', 'AMIACALVA', 'nakamura', 'userd', 'vintage', NULL, NULL, NULL, '2021-02-02 23:15:32', '2021-02-02 23:15:32');

-- --------------------------------------------------------

--
-- テーブルの構造 `consumer`
--

CREATE TABLE `consumer` (
  `consumer_id` int(100) NOT NULL,
  `name` varchar(128) NOT NULL,
  `age` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `gender` varchar(128) NOT NULL,
  `shop` varchar(128) NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `height` varchar(128) NOT NULL,
  `weight` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `consumer`
--

INSERT INTO `consumer` (`consumer_id`, `name`, `age`, `city`, `gender`, `shop`, `img`, `height`, `weight`, `email`, `password`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'やまだ', '33', '岩手', '男性', 'bshop', '../../up_file/consumer/2021020514140620ef2b512868d6dbd98d1c6a5372872b.jpeg', '175', '55', 'kkkk@gmail.com', '123456', '2021-01-26 10:31:47', '2021-02-05 22:14:06', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `coordinat`
--

CREATE TABLE `coordinat` (
  `coordinat_id` int(100) NOT NULL,
  `consumer_id` int(100) DEFAULT NULL,
  `salesperson_id` int(100) DEFAULT NULL,
  `coordinat_img` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `coordinat`
--

INSERT INTO `coordinat` (`coordinat_id`, `consumer_id`, `salesperson_id`, `coordinat_img`, `created_at`, `is_deleted`) VALUES
(1, 1, NULL, '../../up_file/consumer/20210205164311f60d379b40490ca8fae0da6d7bba5c5b.jpeg', '2021-02-06 00:43:11', 0),
(2, 1, NULL, '../../up_file/consumer/20210205164345b80d9afee91876883ff06c2aa038a400.jpeg', '2021-02-06 00:43:46', 0),
(3, 1, NULL, '../../up_file/consumer/202102051644531a9ed0728accbe0b09ee5ed2a893507b.jpeg', '2021-02-06 00:44:53', 0),
(4, 1, NULL, '../../up_file/consumer/20210205164508241498c4720bcdf1918a9b34d1dac4c1.jpeg', '2021-02-06 00:45:08', 0),
(7, NULL, 1, '../up_file/coordinate/20210206031957d41d8cd98f00b204e9800998ecf8427e.jpeg', '2021-02-06 11:21:18', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `consumer_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `favorite`
--

INSERT INTO `favorite` (`id`, `consumer_id`, `shop_id`, `created_at`) VALUES
(8, 1, 2, '2021-02-04 21:58:54');

-- --------------------------------------------------------

--
-- テーブルの構造 `salesperson`
--

CREATE TABLE `salesperson` (
  `salesperson_id` int(100) NOT NULL,
  `shop_id` int(100) NOT NULL,
  `name` varchar(128) NOT NULL,
  `age` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `gender` varchar(128) NOT NULL,
  `shop` varchar(128) NOT NULL,
  `experience` varchar(128) NOT NULL,
  `image` varchar(100) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `salesperson`
--

INSERT INTO `salesperson` (`salesperson_id`, `shop_id`, `name`, `age`, `city`, `gender`, `shop`, `experience`, `image`, `email`, `password`, `created_at`, `is_deleted`) VALUES
(1, 2, 'こが', '25', '千葉', '男性', 'Bshop', 'Bshop', '../up_file/salesperson/20210203104810d41d8cd98f00b204e9800998ecf8427e.jpg', 'lolo@gmail.com', '567890', '2021-01-26 10:40:04', 0),
(2, 2, 'よしだ', '２４', '福岡', '男性', 'ひみつ', 'ひみつ', '../up_file/salesperson/20210203143336d41d8cd98f00b204e9800998ecf8427e.jpeg', 'popo@gmail.com', '20210202', '2021-02-02 22:34:18', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(100) NOT NULL,
  `shopname` varchar(128) NOT NULL,
  `Introduction` varchar(300) NOT NULL,
  `area` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `salesperson_id` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updatete_at` datetime NOT NULL,
  `is_daleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `shop`
--

INSERT INTO `shop` (`shop_id`, `shopname`, `Introduction`, `area`, `photo`, `salesperson_id`, `created_at`, `updatete_at`, `is_daleted`) VALUES
(2, 'add', '今泉のマンションの一角にあるセレクトショップ。古着とセレクトブランドを取り扱っています。', '今泉', '../up_file/store/20210202132138d41d8cd98f00b204e9800998ecf8427e.jpeg', 1, '2021-02-02 18:27:34', '2021-02-02 18:27:34', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `stylest`
--

CREATE TABLE `stylest` (
  `stylest_id` int(100) NOT NULL,
  `salesperson_id` int(1) NOT NULL,
  `consumer_id` int(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `stylest`
--

INSERT INTO `stylest` (`stylest_id`, `salesperson_id`, `consumer_id`, `created_at`) VALUES
(1, 1, 1, '2021-02-03 20:48:48'),
(2, 2, 1, '2021-02-03 22:36:18');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`);

--
-- テーブルのインデックス `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `consumer`
--
ALTER TABLE `consumer`
  ADD PRIMARY KEY (`consumer_id`);

--
-- テーブルのインデックス `coordinat`
--
ALTER TABLE `coordinat`
  ADD PRIMARY KEY (`coordinat_id`);

--
-- テーブルのインデックス `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `salesperson`
--
ALTER TABLE `salesperson`
  ADD PRIMARY KEY (`salesperson_id`);

--
-- テーブルのインデックス `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id`);

--
-- テーブルのインデックス `stylest`
--
ALTER TABLE `stylest`
  ADD PRIMARY KEY (`stylest_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `consumer`
--
ALTER TABLE `consumer`
  MODIFY `consumer_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `coordinat`
--
ALTER TABLE `coordinat`
  MODIFY `coordinat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルの AUTO_INCREMENT `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `salesperson`
--
ALTER TABLE `salesperson`
  MODIFY `salesperson_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `stylest`
--
ALTER TABLE `stylest`
  MODIFY `stylest_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
