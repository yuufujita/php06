-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2023 年 8 月 04 日 15:12
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_together_table`
--

CREATE TABLE `gs_together_table` (
  `together_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `user_id` int(12) NOT NULL,
  `user_nm` varchar(64) NOT NULL,
  `together_chat` varchar(200) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_together_table`
--

INSERT INTO `gs_together_table` (`together_id`, `id`, `user_id`, `user_nm`, `together_chat`, `date`) VALUES
(1, 10, 4, 'ユーザー03', '2023/07/28(金)〜2023/07/29(土)に1泊2日を検討中です。2023/07/28(金)の17:00頃にJR美瑛駅に到着する予定です。JR美瑛駅の徒歩圏内で一緒に夕食できる方募集中です。', '2023-07-24'),
(2, 10, 5, 'ユーザー04', '私は金曜日に富良野に宿泊します。富良野駅で良ければご一緒できますが…。', '2023-07-26'),
(3, 79, 5, 'ユーザー04', '誰か10:00からジーズでAWSアカデミー一緒にインストールする人いませんか？', '2023-07-29'),
(4, 79, 3, 'ユーザー02', '今日はオンライン参加なので、ジーズには行かないのですー', '2023-07-29'),
(5, 79, 4, 'ユーザー03', 'テスト', '2023-07-29');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_together_table`
--
ALTER TABLE `gs_together_table`
  ADD PRIMARY KEY (`together_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `gs_together_table`
--
ALTER TABLE `gs_together_table`
  MODIFY `together_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
