-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 11 Nov 2023 pada 12.13
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pemesanan_barakat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint UNSIGNED NOT NULL,
  `food_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `price` int UNSIGNED NOT NULL DEFAULT '0',
  `quantity` int DEFAULT '0',
  `status` enum('pending','process') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cart_items`
--

INSERT INTO `cart_items` (`id`, `food_id`, `user_id`, `price`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(386, 4, 103, 15000, 1, 'process', '2023-08-09 02:48:37', '2023-08-09 02:48:47'),
(387, 3, 103, 4000, 1, 'process', '2023-08-09 02:48:39', '2023-08-09 02:48:47'),
(388, 14, 104, 25000, 1, 'process', '2023-08-09 02:49:05', '2023-08-09 02:49:19'),
(389, 5, 104, 5000, 1, 'process', '2023-08-09 02:49:07', '2023-08-09 02:49:19'),
(390, 13, 104, 4000, 1, 'process', '2023-08-09 02:49:08', '2023-08-09 02:49:19'),
(391, 18, 105, 5000, 1, 'process', '2023-08-09 02:49:32', '2023-08-09 02:49:50'),
(392, 14, 105, 25000, 1, 'process', '2023-08-09 02:49:34', '2023-08-09 02:49:50'),
(393, 29, 105, 20000, 1, 'process', '2023-08-09 02:49:35', '2023-08-09 02:49:50'),
(394, 33, 106, 30000, 1, 'process', '2023-08-09 02:50:06', '2023-08-09 02:50:16'),
(395, 35, 106, 5000, 1, 'process', '2023-08-09 02:50:07', '2023-08-09 02:50:16'),
(396, 33, 112, 30000, 1, 'process', '2023-08-09 02:50:24', '2023-08-09 02:50:33'),
(397, 36, 112, 5000, 1, 'process', '2023-08-09 02:50:27', '2023-08-09 02:50:33'),
(399, 3, 103, 4000, 1, 'process', '2023-08-09 03:09:08', '2023-08-09 03:09:16'),
(400, 3, 103, 4000, 1, 'process', '2023-08-09 03:18:30', '2023-08-09 03:18:40'),
(401, 5, 105, 5000, 1, 'process', '2023-08-09 03:27:39', '2023-08-09 03:27:50'),
(459, 3, 103, 4000, 1, 'process', '2023-08-17 07:04:46', '2023-08-17 07:06:04'),
(460, 4, 103, 15000, 2, 'process', '2023-08-17 07:04:48', '2023-08-17 07:06:04'),
(461, 5, 103, 5000, 2, 'process', '2023-08-17 07:04:50', '2023-08-17 07:06:04'),
(462, 13, 103, 4000, 1, 'process', '2023-08-17 07:04:51', '2023-08-17 07:06:04'),
(463, 5, 103, 5000, 2, 'process', '2023-08-17 07:06:19', '2023-08-17 07:06:42'),
(464, 16, 103, 2000, 2, 'process', '2023-08-17 07:06:22', '2023-08-17 07:06:42'),
(465, 30, 103, 22000, 1, 'process', '2023-08-17 07:06:24', '2023-08-17 07:06:42'),
(466, 29, 103, 20000, 1, 'process', '2023-08-17 07:06:25', '2023-08-17 07:06:42'),
(467, 18, 103, 5000, 4, 'process', '2023-08-17 07:07:28', '2023-08-17 07:07:48'),
(468, 14, 103, 25000, 4, 'process', '2023-08-17 07:07:31', '2023-08-17 07:07:48'),
(469, 29, 103, 20000, 4, 'process', '2023-08-17 07:08:24', '2023-08-17 07:08:36'),
(470, 17, 103, 2000, 4, 'process', '2023-08-17 07:08:26', '2023-08-17 07:08:36'),
(471, 33, 103, 30000, 6, 'process', '2023-08-17 07:08:49', '2023-08-17 07:09:06'),
(472, 34, 103, 45000, 3, 'process', '2023-08-17 07:08:51', '2023-08-17 07:09:06'),
(473, 35, 103, 5000, 3, 'process', '2023-08-17 07:08:52', '2023-08-17 07:09:06'),
(474, 36, 103, 5000, 2, 'process', '2023-08-17 07:09:33', '2023-08-17 07:09:47'),
(475, 34, 103, 45000, 1, 'process', '2023-08-17 07:09:35', '2023-08-17 07:09:47'),
(476, 33, 103, 30000, 1, 'process', '2023-08-17 07:09:37', '2023-08-17 07:09:47'),
(477, 32, 103, 25000, 2, 'process', '2023-08-17 07:10:03', '2023-08-17 07:10:17'),
(478, 30, 103, 22000, 1, 'process', '2023-08-17 07:10:05', '2023-08-17 07:10:17'),
(479, 13, 103, 4000, 1, 'process', '2023-08-17 07:10:08', '2023-08-17 07:10:17'),
(480, 5, 104, 5000, 3, 'process', '2023-08-17 07:10:35', '2023-08-17 07:10:54'),
(481, 3, 104, 4000, 3, 'process', '2023-08-17 07:10:36', '2023-08-17 07:10:54'),
(482, 4, 104, 15000, 3, 'process', '2023-08-17 07:10:37', '2023-08-17 07:10:54'),
(483, 16, 104, 2000, 1, 'process', '2023-08-17 07:11:06', '2023-08-17 07:11:18'),
(484, 14, 104, 25000, 5, 'process', '2023-08-17 07:11:07', '2023-08-17 07:11:18'),
(485, 28, 104, 20000, 2, 'process', '2023-08-17 07:11:28', '2023-08-17 07:11:40'),
(486, 17, 104, 2000, 2, 'process', '2023-08-17 07:11:31', '2023-08-17 07:11:40'),
(487, 4, 104, 15000, 2, 'process', '2023-08-17 07:12:05', '2023-08-17 07:12:16'),
(488, 3, 104, 4000, 2, 'process', '2023-08-17 07:12:07', '2023-08-17 07:12:16'),
(489, 3, 105, 4000, 4, 'process', '2023-08-17 07:12:51', '2023-08-17 07:13:02'),
(490, 4, 105, 15000, 4, 'process', '2023-08-17 07:12:52', '2023-08-17 07:13:02'),
(491, 5, 105, 5000, 3, 'process', '2023-08-17 07:13:14', '2023-08-17 07:13:23'),
(492, 13, 105, 4000, 3, 'process', '2023-08-17 07:13:15', '2023-08-17 07:13:23'),
(493, 17, 105, 2000, 3, 'process', '2023-08-17 07:14:14', '2023-08-17 07:14:25'),
(494, 32, 105, 25000, 3, 'process', '2023-08-17 07:14:16', '2023-08-17 07:14:25'),
(495, 32, 105, 25000, 4, 'process', '2023-08-17 07:14:58', '2023-08-17 07:15:11'),
(496, 33, 105, 30000, 2, 'process', '2023-08-17 07:14:59', '2023-08-17 07:15:11'),
(497, 18, 105, 5000, 2, 'process', '2023-08-17 07:15:01', '2023-08-17 07:15:11'),
(498, 28, 105, 20000, 2, 'process', '2023-08-17 07:15:57', '2023-08-17 07:16:44'),
(499, 17, 105, 2000, 2, 'process', '2023-08-17 07:16:00', '2023-08-17 07:16:44'),
(500, 16, 106, 2000, 3, 'process', '2023-08-17 07:16:58', '2023-08-17 07:17:13'),
(501, 14, 106, 25000, 3, 'process', '2023-08-17 07:17:00', '2023-08-17 07:17:13'),
(502, 5, 106, 5000, 2, 'process', '2023-08-17 07:17:32', '2023-08-17 07:17:47'),
(503, 14, 106, 25000, 2, 'process', '2023-08-17 07:17:33', '2023-08-17 07:17:47'),
(504, 13, 106, 4000, 4, 'process', '2023-08-17 07:17:33', '2023-08-17 07:17:47'),
(505, 14, 106, 25000, 4, 'process', '2023-08-17 07:24:37', '2023-08-17 07:24:47'),
(506, 16, 106, 2000, 4, 'process', '2023-08-17 07:24:38', '2023-08-17 07:24:47'),
(507, 35, 106, 5000, 3, 'process', '2023-08-17 07:24:56', '2023-08-17 07:25:08'),
(508, 34, 106, 45000, 3, 'process', '2023-08-17 07:24:57', '2023-08-17 07:25:08'),
(509, 30, 106, 22000, 3, 'process', '2023-08-17 07:25:17', '2023-08-17 07:25:28'),
(510, 18, 106, 5000, 3, 'process', '2023-08-17 07:25:19', '2023-08-17 07:25:28'),
(511, 18, 112, 5000, 3, 'process', '2023-08-17 07:26:10', '2023-08-17 07:26:21'),
(512, 34, 112, 45000, 3, 'process', '2023-08-17 07:26:12', '2023-08-17 07:26:21'),
(513, 36, 112, 5000, 3, 'process', '2023-08-17 07:26:30', '2023-08-17 07:26:42'),
(514, 33, 112, 30000, 3, 'process', '2023-08-17 07:26:33', '2023-08-17 07:26:42'),
(515, 36, 112, 5000, 3, 'process', '2023-08-17 07:27:14', '2023-08-17 07:27:34'),
(516, 28, 112, 20000, 3, 'process', '2023-08-17 07:27:16', '2023-08-17 07:27:34'),
(517, 3, 103, 4000, 1, 'process', '2023-08-17 09:55:37', '2023-08-17 09:55:52'),
(518, 5, 103, 5000, 1, 'process', '2023-08-17 09:55:39', '2023-08-17 09:55:52'),
(520, 3, 103, 4000, 1, 'process', '2023-08-17 10:14:13', '2023-08-17 10:14:22'),
(526, 3, 103, 4000, 1, 'process', '2023-08-18 01:03:19', '2023-08-18 01:03:31'),
(527, 4, 103, 15000, 1, 'process', '2023-08-18 01:03:49', '2023-08-18 01:03:56'),
(532, 5, 103, 5000, 3, 'process', '2023-08-18 03:17:42', '2023-08-18 03:17:55'),
(536, 3, 103, 4000, 1, 'process', '2023-08-18 06:07:48', '2023-08-18 06:08:07'),
(537, 4, 103, 15000, 1, 'process', '2023-08-18 06:07:52', '2023-08-18 06:08:07'),
(538, 28, 103, 20000, 1, 'process', '2023-08-18 06:08:30', '2023-08-18 06:08:41'),
(539, 5, 103, 5000, 1, 'process', '2023-08-23 03:56:28', '2023-08-23 03:56:39'),
(540, 4, 103, 15000, 1, 'process', '2023-08-23 04:05:00', '2023-08-23 04:05:19'),
(546, 3, 105, 4000, 1, 'pending', '2023-08-23 06:25:38', '2023-08-23 06:25:38'),
(567, 5, 103, 5000, 10, 'process', '2023-08-23 06:43:56', '2023-08-23 06:44:25'),
(568, 13, 103, 4000, 10, 'process', '2023-08-23 06:43:59', '2023-08-23 06:44:25'),
(569, 29, 103, 20000, 10, 'process', '2023-08-23 06:44:01', '2023-08-23 06:44:25'),
(570, 33, 103, 30000, 3, 'process', '2023-08-23 06:44:35', '2023-08-23 06:44:42'),
(582, 14, 112, 25000, 2, 'process', '2023-08-27 01:33:15', '2023-08-27 01:33:36'),
(583, 5, 112, 5000, 2, 'process', '2023-08-27 01:33:18', '2023-08-27 01:33:36'),
(584, 3, 112, 4000, 2, 'process', '2023-08-27 01:33:19', '2023-08-27 01:33:36'),
(585, 4, 106, 15000, 1, 'process', '2023-08-27 01:35:26', '2023-08-27 01:35:47'),
(605, 36, 102, 5000, 1, 'pending', '2023-11-07 10:55:29', '2023-11-07 10:55:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cash`
--

CREATE TABLE `cash` (
  `id` bigint UNSIGNED NOT NULL,
  `cash` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `total` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cash`
--

INSERT INTO `cash` (`id`, `cash`, `total`, `created_at`, `updated_at`) VALUES
(1, 'Uang Kas', 55568802, '2023-06-27 02:48:29', '2023-09-01 00:10:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'fa-solid fa-utensils',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', 'makanan', 'fa-solid fa-bowl-rice', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(2, 'Minuman', 'minuman', 'fa fa-coffee', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(6, 'Snack', 'snack', 'fa-solid fa-utensils', '2023-08-08 08:55:00', '2023-08-08 08:55:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `expense_date` date NOT NULL,
  `total` int UNSIGNED NOT NULL DEFAULT '0',
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `expenses`
--

INSERT INTO `expenses` (`expense_id`, `expense_date`, `total`, `description`, `created_at`, `updated_at`) VALUES
('EXP-010123A5B7', '2023-01-01', 1200000, 'Bayar sewa warung 1 bulan', '2023-01-01 23:39:00', '2023-01-01 23:39:00'),
('EXP-010223N2P8', '2023-02-01', 1200000, 'Bayar sewa warung 1 bulan', '2023-02-01 23:45:00', '2023-02-01 23:45:00'),
('EXP-010323C8D9', '2023-03-01', 313300, 'Bayar Tagihan indihome', '2023-03-01 23:48:00', '2023-03-01 23:48:00'),
('EXP-010323E0F6', '2023-03-01', 1200000, 'Bayar sewa warung 1 bulan', '2023-03-01 23:47:00', '2023-03-01 23:47:00'),
('EXP-010423W8X0', '2023-04-01', 1200000, 'Bayar sewa warung 1 bulan', '2023-04-01 23:39:00', '2023-04-01 23:39:00'),
('EXP-010523J2K1', '2023-05-01', 1200000, 'Bayar sewa warung 1 bulan', '2023-05-01 23:45:00', '2023-05-01 23:45:00'),
('EXP-010623Z9K3', '2023-06-01', 1200000, 'Bayar sewa warung 1 bulan', '2023-06-01 23:39:00', '2023-06-01 23:39:00'),
('EXP-0107233QRV', '2023-07-01', 1200000, 'Bayar sewa warung', '2023-08-08 15:45:18', '2023-08-08 15:45:18'),
('EXP-010823KN1G', '2023-08-01', 1200000, 'Bayar Sewa warung', '2023-08-08 15:48:55', '2023-08-08 15:48:55'),
('EXP-030123Y1Z0', '2023-01-03', 202500, 'Beli token listrik isi 200ribu', '2023-01-03 23:40:00', '2023-01-03 23:40:00'),
('EXP-030423T5V6', '2023-04-03', 202500, 'Beli token listrik isi 200ribu', '2023-04-03 23:40:00', '2023-04-03 23:40:00'),
('EXP-03062331S4', '2023-06-03', 202500, 'Beli token listrik isi 200ribu', '2023-08-08 15:40:36', '2023-08-08 15:42:29'),
('EXP-050123W7X3', '2023-01-05', 313300, 'Bayar tagihan indihome', '2023-01-05 23:41:00', '2023-01-05 23:41:00'),
('EXP-050223L9M1', '2023-02-05', 313300, 'Bayar Tagihan indihome', '2023-02-05 23:46:00', '2023-02-05 23:46:00'),
('EXP-050323A1B5', '2023-03-05', 202500, 'beli token listrik isi 200ribu', '2023-03-05 23:49:00', '2023-03-05 23:49:00'),
('EXP-050423R9S4', '2023-04-05', 313300, 'Bayar tagihan indihome', '2023-04-05 23:41:00', '2023-04-05 23:41:00'),
('EXP-050523G6H5', '2023-05-05', 313300, 'Bayar Tagihan indihome', '2023-05-05 23:46:00', '2023-05-05 23:46:00'),
('EXP-0506230V7R', '2023-06-05', 313300, 'Bayar tagihan indihome', '2023-08-08 15:41:14', '2023-08-08 15:42:36'),
('EXP-05082384Y2', '2023-08-05', 313300, 'Bayar Tagihan indihome', '2023-08-08 15:49:20', '2023-08-08 15:49:20'),
('EXP-08072372B3', '2023-07-08', 313300, 'Bayar indihome', '2023-08-08 15:45:45', '2023-08-08 15:45:45'),
('EXP-110223J3K2', '2023-02-11', 202500, 'beli token listrik isi 200ribu', '2023-02-11 23:46:00', '2023-02-11 23:46:00'),
('EXP-110523E1F9', '2023-05-11', 202500, 'beli token listrik isi 200ribu', '2023-05-11 23:46:00', '2023-05-11 23:46:00'),
('EXP-1107239R76', '2023-07-11', 202500, 'beli token listrik isi 200ribu', '2023-08-08 15:46:20', '2023-08-08 15:48:31'),
('EXP-140123T4V9', '2023-01-14', 245500, 'Bayar tagihan air', '2023-01-14 23:43:00', '2023-01-14 23:43:00'),
('EXP-140223G7H4', '2023-02-14', 256500, 'Bayar air', '2023-02-14 23:46:00', '2023-02-14 23:46:00'),
('EXP-140423N3P7', '2023-04-14', 245500, 'Bayar tagihan air', '2023-04-14 23:43:00', '2023-04-14 23:43:00'),
('EXP-140523C7D8', '2023-05-14', 256500, 'Bayar air', '2023-05-14 23:46:00', '2023-05-14 23:46:00'),
('EXP-14062369S8', '2023-06-14', 245500, 'Bayar tagihan air', '2023-08-08 15:43:11', '2023-08-08 15:43:19'),
('EXP-1407235R06', '2023-07-14', 256500, 'Bayar air', '2023-08-08 15:46:50', '2023-08-08 15:46:50'),
('EXP-150323Y4Z2', '2023-03-15', 256500, 'Bayar air', '2023-03-15 23:49:00', '2023-03-15 23:49:00'),
('EXP-15082384Y7', '2023-08-15', 296000, 'Bayar air', '2023-08-15 15:49:20', '2023-08-15 15:49:20'),
('EXP-16082381Y7', '2023-08-16', 202500, 'Beli token listrik isi 200ribu', '2023-08-16 10:58:43', '2023-08-16 10:58:43'),
('EXP-280123R6S5', '2023-01-28', 51500, 'Beli token listrik isi 50ribu', '2023-01-28 23:44:00', '2023-01-28 23:44:00'),
('EXP-280423L0M8', '2023-04-28', 51500, 'Beli token listrik isi 50ribu', '2023-04-28 23:44:00', '2023-04-28 23:44:00'),
('EXP-280623A99I', '2023-06-28', 51500, 'Beli token listrik isi 50ribu', '2023-08-08 15:44:23', '2023-08-08 15:44:43'),
('EXP-310723YV9S', '2023-07-31', 202500, 'Beli token listrik isi 200ribu', '2023-08-08 15:47:37', '2023-08-08 15:47:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `connection` text COLLATE utf8mb4_general_ci NOT NULL,
  `queue` text COLLATE utf8mb4_general_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `food`
--

CREATE TABLE `food` (
  `food_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_general_ci,
  `price` int UNSIGNED NOT NULL,
  `ready` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `food`
--

INSERT INTO `food` (`food_id`, `category_id`, `name`, `slug`, `image`, `description`, `price`, `ready`, `created_at`, `updated_at`) VALUES
(3, 2, 'Teh es', 'teh-es', 'nT45UwdlUe72GvHy0HG54sfWYXHuBLcXOOH5lhvh.png', 'Teh es', 4000, 1, '2023-06-22 02:35:50', '2023-08-23 09:30:34'),
(4, 6, 'Sambosa Goreng (6pc)', 'sambosa-goreng-(6pc)', 'DlzsBTxBJBwCZvIwwOjVBmNae8EF4y3MhMDZIv0k.png', 'Sambosa dengan isian daging ayam, isi 6pc', 15000, 1, '2023-06-22 02:35:52', '2023-08-08 14:14:48'),
(5, 6, 'Roti Maryam', 'roti-maryam', '4DUJaFWnbf0GpkStANSe4Ag3UWgxyooJwBtqFG0q.png', 'Roti Maryam (royam) dengan toping coklat', 5000, 1, '2023-06-22 02:35:51', '2023-08-08 14:16:12'),
(13, 2, 'Teh Panas', 'teh-panas', '8xWH65XrmkReNKPneKLfwlEl0WeLHAiVUBztOthp.png', 'Teh panas', 4000, 1, '2023-08-08 08:56:35', '2023-08-08 14:15:35'),
(14, 6, 'Sambosa Goreng (10pc)', 'sambosa-goreng-(10pc)', 'KgwZVh0Ys05KerqgdhupLl3RzSeMVvO82QZb9Pmv.png', 'Sambosa dengan isian daging ayam, isi 10pc', 25000, 1, '2023-08-08 08:58:13', '2023-08-08 14:15:16'),
(16, 2, 'Air Es', 'air-es', 'Ocm6TQRaSHE0nBeQK2Gvbpe3Tiy6QjkeVVbcDUQO.png', 'Air es', 2000, 1, '2023-08-08 08:59:29', '2023-08-08 14:16:42'),
(17, 2, 'Air Putih Panas', 'air-putih-panas', 'FxnTk1bm4VIJ5SER4yJBUAKeXrm36mfo3coFPEgV.png', 'Air putih panas', 2000, 1, '2023-08-08 08:59:42', '2023-08-08 14:19:26'),
(18, 2, 'Kopi Gula Aren', 'kopi-gula-aren', 'XkfDbx5YDFizLceWxWPOCEhVBYgGN9iBAnkB45P8.png', 'Kopi hitam dengan gula aren', 5000, 1, '2023-08-08 09:00:26', '2023-08-08 14:20:02'),
(28, 1, 'Nasi Mandhi Lauk Ayam Goreng Kalasan', 'nasi-mandhi-lauk-ayam-goreng-kalasan', 'bsEGq0GDPWQ39u369WxM1vp3XlEKvPHYbAF3v2TW.png', 'Nasi mandhi dengan lauk ayam goreng kalasan', 20000, 1, '2023-08-08 09:05:52', '2023-08-08 14:21:29'),
(29, 1, 'Nasi Mandhi Lauk Ayam Mandhi Original', 'nasi-mandhi-lauk-ayam-mandhi-original', 'px1CVz1KMKwU4jc7mRlbCjulwwkSu6758O9HWa0R.png', 'Nasi mandhi dengan lauk ayam goreng mandhi original', 20000, 1, '2023-08-08 09:06:23', '2023-08-08 14:22:16'),
(30, 1, 'Nasi Mandhi Lauk Ayam Goreng Rempah', 'nasi-mandhi-lauk-ayam-goreng-rempah', 'ywmbyekij49UR7OoFtrYSnEWnlTV1wA0tG9gAQ5U.png', 'Nasi mandhi dengan lauk ayam goreng rempah', 22000, 1, '2023-08-08 09:06:45', '2023-08-08 14:22:52'),
(31, 1, 'Nasi Mandhi Lauk Ayam Bakar Betutu', 'nasi-mandhi-lauk-ayam-bakar-betutu', '0yFp4oukAZULzlZPd1EVq5CMzhGwZmPRrJheybkP.png', 'Nasi mandhi dengan lauk ayam bakar betutu', 25000, 1, '2023-08-08 09:07:10', '2023-08-08 14:23:57'),
(32, 1, 'Nasi Mandhi Lauk Ayam Bakar Taliwang', 'nasi-mandhi-lauk-ayam-bakar-taliwang', 'flPZsg9ohnexgEimQBKSO0bOVHq0PU92S0nJOjXH.png', 'Nasi mandhi dengan lauk ayam bakar taliwang', 25000, 1, '2023-08-08 09:07:36', '2023-08-08 14:24:16'),
(33, 1, 'Nasi Mandhi Lauk Daging Sapi', 'nasi-mandhi-lauk-daging-sapi', 'fxQC5Hq7xoerX3A43Exn4s24ekV0TQ5tjDaJB4Qc.png', 'Nasi mandhi dengan lauk daging sapi', 30000, 1, '2023-08-08 09:07:59', '2023-08-08 14:24:50'),
(34, 1, 'Nasi Mandhi Lauk Daging Kambing', 'nasi-mandhi-lauk-daging-kambing', 'Sq6w2lsP1oE078Hdp5lPycd9FC6INTGnwHHMV1RI.png', 'Nasi mandhi dengan lauk daging kambing', 45000, 1, '2023-08-08 09:08:17', '2023-08-08 14:25:06'),
(35, 2, 'Sirup Panas', 'sirup-panas', '9skLJCKmbgPtIpMq5exKM7C4lqMJoV8gZoAoZzlK.png', 'Sirup merah panas', 5000, 1, '2023-08-08 14:26:56', '2023-08-08 14:26:56'),
(36, 2, 'Es Sirup', 'es-sirup', 'jedCmWyibzPTUIAqVCx0Wf98cfS0DH4LLHrK8qpn.png', 'Es sirup merah', 5000, 1, '2023-08-08 14:27:22', '2023-08-08 14:27:22'),
(37, 1, 'Nasi Mandhi Nampan Lauk Daging Sapi Kareh', 'nasi-mandhi-nampan-lauk-daging-sapi-kareh', 'jnJq5Rkrw15piGexXj84aQfJN1uUoX2DLESbgBJz.png', 'Nasi mandhi lauk kareh daging sapi dengan nampan untuk 6 orang', 220000, 1, '2023-08-08 14:30:27', '2023-08-08 14:30:27'),
(38, 1, 'Nasi Mandhi Nampan lauk ayam goreng kalasan', 'nasi-mandhi-nampan-lauk-ayam-goreng-kalasan', '7Y9KY3AKC8bOWfTBUdkKVTuixP31zkcxckyglHYX.png', 'Nasi mandhi lauk ayam goreng kalasan dan ayam mandhi original dengan nampan untuk 8 orang', 186000, 1, '2023-08-08 14:32:17', '2023-08-08 14:32:17'),
(39, 1, 'nasi mandhi nampan lauk ayam bakar taliwang dan kareh daging sapi', 'nasi-mandhi-nampan-lauk-ayam-bakar-taliwang-dan-kareh-daging-sapi', 'Z96VgGueJcJt3QUfEeG62nREBKfDzSNRIOpfyfLk.png', 'Nasi mandhi lauk ayam bakar taliwang dan kareh daging sapi dengan nampan untuk 10 orang', 320000, 1, '2023-08-08 14:33:51', '2023-08-08 14:33:51'),
(40, 1, 'nasi mandhi beras reguler nampan', 'nasi-mandhi-beras-reguler-nampan', 'H4FlDlPq0QTMJHvIA8CROPohMzizA8HRNLkybnAr.png', 'Nasi mandhi beras reguler lauk ayam goreng mandhi original dengan nampan untuk 5 orang', 85000, 1, '2023-08-08 14:35:20', '2023-08-08 14:35:20'),
(41, 1, 'nasi mandhi nampan lauk ayam bakar taliwang dan ayam goreng mandhi original', 'nasi-mandhi-nampan-lauk-ayam-bakar-taliwang-dan-ayam-goreng-mandhi-original', 'VNXJgqyM7W15MafOn94fGddnQrBIPiYduhsndnuU.png', 'Nasi mandhi lauk ayam bakar taliwang dan ayam goreng mandhi original dengan nampan untuk 6 orang', 150000, 1, '2023-08-08 14:36:37', '2023-08-08 14:36:37'),
(42, 6, 'Sambosa Nampan (40pc)', 'sambosa-nampan-(40pc)', 'N8dM8L0Swq1x1gFJLKwob9Jur8zGQ1PTVrHp2guR.png', 'Sambosa dengan nampan isi 40pc', 110000, 1, '2023-08-08 14:38:14', '2023-08-08 14:38:14'),
(43, 6, 'Sambosa Nampan (70pc)', 'sambosa-nampan-(70pc)', 'C6M1sxf2KFEENpyQdc37hRR7V55E3t7VVLzAsTQM.png', 'Sambosa dengan nampan isi 70pc', 185000, 1, '2023-08-08 14:38:57', '2023-08-08 14:38:57'),
(44, 6, 'Roti Maryam Original', 'roti-maryam-original', 'S38Nszmxf73CleSt43BRSD8LgNz70WkzNcgFLKEy.jpg', 'Roti maryam (royam) original', 4000, 1, '2023-08-08 14:44:34', '2023-08-08 14:44:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_05_19_153618_create_categories_table', 1),
(7, '2023_05_19_153841_create_food_table', 1),
(8, '2023_05_19_174217_create_tables_table', 1),
(9, '2023_05_19_174454_create_cart_items_table', 1),
(10, '2023_05_19_175003_create_reservations_table', 1),
(11, '2023_05_19_175430_create_reservation_items_table', 1),
(12, '2023_05_19_180621_create_offline_orders_table', 1),
(13, '2023_05_19_180621_create_online_orders_table', 1),
(14, '2023_05_19_212518_create_offline_order_items_table', 1),
(15, '2023_05_19_212518_create_online_order_items_table', 1),
(16, '2023_05_19_214048_create_payments_table', 1),
(17, '2023_05_19_214048_create_shop_funds_table', 1),
(18, '2023_05_19_214513_create_sales_table', 1),
(19, '2023_05_19_214948_create_sale_items_table', 1),
(20, '2023_05_19_215235_create_expenses_table', 1),
(21, '2023_06_12_123146_create_raw_materials_table', 1),
(22, '2023_06_12_125402_create_suppliers_table', 1),
(23, '2023_06_12_125410_create_purchase_of_raw_materials_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `offline_orders`
--

CREATE TABLE `offline_orders` (
  `offline_order_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('success','process','failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'process',
  `total` int UNSIGNED NOT NULL,
  `snap_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `offline_orders`
--

INSERT INTO `offline_orders` (`offline_order_id`, `user_id`, `name`, `status`, `total`, `snap_token`, `created_at`, `updated_at`) VALUES
('OFD-0908231NR6', 103, 'Muhammad Fadhilah', 'success', 19000, '16e43efc-5155-4401-ad26-8a27a3c5d669', '2023-08-09 02:48:47', '2023-08-09 02:48:53'),
('OFD-0908233F16', 106, 'Iman', 'success', 35000, NULL, '2023-08-09 02:50:16', '2023-08-09 02:51:03'),
('OFD-0908235022', 104, 'Ahmad Budi', 'success', 34000, '05e7044d-666a-4f79-9f0e-cb81f026760c', '2023-07-09 02:49:19', '2023-08-09 02:49:23'),
('OFD-090823982N', 105, 'Rudi', 'success', 50000, 'c92d6ced-bc04-41b6-9d9c-e62d983ae396', '2023-08-09 02:49:50', '2023-08-09 02:49:56'),
('OFD-090823G248', 112, 'Dinda', 'success', 35000, NULL, '2023-08-09 02:50:33', '2023-08-09 02:51:01'),
('OFD-090823JUJZ', 105, 'Fadil', 'success', 5000, 'c9df5bc7-f550-4322-b5ab-e30b16784097', '2023-08-09 03:27:50', '2023-08-09 03:28:05'),
('OFD-090823MXZ6', 103, 'Fadil', 'success', 4000, '00ef952e-a2fa-4156-8e95-1f277ae9224f', '2023-06-09 03:09:16', '2023-08-09 03:09:39'),
('OFD-090823Y511', 103, 'Fadil', 'success', 4000, '644fc722-1716-44f3-930f-37f9553e737a', '2023-08-09 03:18:40', '2023-08-09 03:18:54'),
('OFD-1708230370', 104, 'Siska Amelia', 'success', 127000, '40e4867c-7867-448a-8834-0e75586e081b', '2023-02-04 07:11:18', '2023-08-17 07:11:22'),
('OFD-17082308X6', 103, 'Yoga Putra', 'success', 330000, 'de73ee26-c732-47f6-9db8-53a443b0e278', '2023-01-07 07:09:06', '2023-08-17 07:09:31'),
('OFD-1708230C53', 105, 'Ayu Dewi', 'success', 27000, 'fe5e51c8-7b00-4b6c-8f9f-63e8dadb236a', '2023-03-05 07:13:23', '2023-08-17 07:13:48'),
('OFD-1708232H8X', 106, 'Eko Nugroho', 'success', 81000, '95839744-810a-4ac6-818e-eb0eb9a0c9ca', '2023-04-27 07:17:12', '2023-08-17 07:17:21'),
('OFD-1708233184', 112, 'Lita Purnama', 'success', 75000, '7ff1ab61-d5ea-464f-b637-84c44c34869f', '2023-07-21 07:27:34', '2023-08-17 07:27:38'),
('OFD-17082342KZ', 104, 'Bayu Wijaya', 'success', 72000, '826ae79f-20cc-4f60-af7f-330d70de1a20', '2023-01-21 07:10:54', '2023-08-17 07:11:19'),
('OFD-1708238202', 112, 'Koko Saputra', 'success', 105000, '57f4bf2f-9c5d-4322-92f2-fcf00ebfa5ff', '2023-07-17 07:26:42', '2023-08-17 07:27:07'),
('OFD-17082382RT', 106, 'Galih Prasetyo', 'success', 108000, 'd0b1d4f3-9d8d-4bd0-85d9-18a0f888a1f9', '2023-05-11 07:24:47', '2023-08-17 07:24:51'),
('OFD-170823863M', 105, 'Dian Permata', 'success', 44000, '95150a6f-11d7-421a-81ef-793f994b318b', '2023-04-20 07:16:44', '2023-08-17 07:16:47'),
('OFD-1708239N8Q', 106, 'Fika Maharani', 'success', 76000, '606e5681-eeb5-4417-a7d9-4832300944c8', '2023-05-01 07:17:47', '2023-08-17 07:18:12'),
('OFD-170823A512', 103, 'Fahmi Pratama', 'success', 120000, '55732d1a-baa0-462a-ac62-848036e995b1', '2022-12-21 07:07:48', '2023-08-17 07:08:13'),
('OFD-170823A6M3', 105, 'Citra Wardani', 'success', 170000, '25f9ff29-e349-41ec-8550-6d1dd439c99a', '2023-04-03 07:15:11', '2023-08-17 07:15:39'),
('OFD-170823BAP5', 105, 'Agung Santoso', 'success', 76000, 'c1438100-831f-43d9-8602-c2132e2d0be9', '2023-02-27 07:13:02', '2023-08-17 07:13:29'),
('OFD-170823CXYM', 103, 'Rani Indriani', 'success', 56000, '5bf4239c-857d-4bf0-9f3d-1c3aa1a4a021', '2022-12-12 07:06:42', '2023-08-17 07:07:07'),
('OFD-170823E3C4', 103, 'Budi Slamet', 'success', 9000, '2dd0588f-6bda-4966-9b96-390d7d6d8f2d', '2023-08-17 09:55:52', '2023-08-17 10:12:53'),
('OFD-170823GMOU', 103, 'Dina Fitriani', 'success', 76000, 'bdaf0bf5-c940-416d-af41-9181b5e0ebf9', '2023-01-17 07:10:17', '2023-08-17 07:10:21'),
('OFD-170823KV93', 112, 'Jihan Putri', 'success', 150000, 'd119a198-08e3-4709-8781-45d0be0d4462', '2023-07-05 07:26:21', '2023-08-17 07:26:25'),
('OFD-170823M4J2', 105, 'Bima Nugraha', 'success', 81000, '360412a1-90d2-4ba7-a2a2-faeb1f1bb3fe', '2023-03-11 07:14:25', '2023-08-17 07:14:50'),
('OFD-170823N6M1', 106, 'Irfan Hakim', 'success', 81000, '6b847dbf-0456-4c49-9f08-f816e1662d3b', '2023-06-17 07:25:28', '2023-08-17 07:25:55'),
('OFD-170823NP2E', 106, 'Hana Pangestu', 'success', 150000, 'a6d32e46-8c2e-4dcf-82a2-e971082699b3', '2023-06-03 07:25:08', '2023-08-17 07:25:13'),
('OFD-170823NV8T', 103, 'Novita Sari', 'success', 88000, 'a2693ae8-f102-4801-bbbe-89cce584122c', '2022-01-03 07:08:36', '2023-08-17 07:08:42'),
('OFD-170823P600', 103, 'Aulia Rahman', 'success', 85000, 'a30cb5e3-78b8-4508-8f05-4b81f59c0ef6', '2023-01-11 07:09:47', '2023-08-17 07:10:13'),
('OFD-170823THU4', 104, 'Desi Puspita', 'success', 38000, '4b28e75f-c18c-45da-a9c0-c61d2cfee64a', '2023-02-17 07:12:16', '2023-08-17 07:12:21'),
('OFD-170823U0FC', 103, 'Muhammad Fadhilah', 'success', 4000, '479ca85c-3f08-4daa-a906-09bde27c1cc6', '2023-08-17 10:14:22', '2023-08-17 10:15:54'),
('OFD-170823WZL2', 104, 'Rizki Ramadhan', 'success', 44000, '1ccd04ce-4e5b-486c-b2bb-485d081864b8', '2023-02-10 07:11:40', '2023-08-17 07:12:06'),
('OFD-170823ZNVD', 103, 'Aditya Wirawan', 'success', 48000, '071c54a7-517d-4932-a089-6199133d55b0', '2022-12-01 07:06:04', '2023-08-17 07:06:11'),
('OFD-1808231257', 103, 'Budi', 'success', 15000, '5317e2ee-976c-458d-bcfd-6ba6b65892ff', '2023-08-18 03:17:55', '2023-08-18 03:18:03'),
('OFD-1808233A2C', 103, 'Fadhil', 'success', 19000, 'bed406e5-f932-45fc-b09d-7583501d3415', '2023-08-18 01:03:31', '2023-08-18 01:04:22'),
('OFD-180823EM3A', 103, 'Fadhilah', 'success', 39000, '46df2f4a-29f4-462b-8e6a-8bc7383cecd3', '2023-08-18 06:08:07', '2023-08-18 06:09:25'),
('OFD-23082313G2', 103, 'Imam', 'success', 5000, NULL, '2023-08-23 03:56:39', '2023-08-23 03:57:21'),
('OFD-230823CV4M', 103, 'Fadil', 'success', 380000, '69fe9dad-7e5d-45c7-8a66-c90499fd8d45', '2023-08-23 06:44:25', '2023-08-23 06:44:59'),
('OFD-230823G2AC', 103, 'Budiman', 'success', 15000, '74211f90-7fb7-4fc7-b756-71a276059cee', '2023-08-23 04:05:19', '2023-08-27 00:05:56'),
('OFD-2708232JD3', 112, 'Budiman Cahyono', 'success', 68000, 'aa290a9c-33f3-4a33-82d2-67a74b005131', '2023-08-27 01:33:36', '2023-08-27 01:33:43'),
('OFD-270823VD77', 106, 'Saipul Ferdiansyah', 'success', 15000, '88092f0a-b5b0-4c72-8941-22f0310b172e', '2023-08-27 01:35:47', '2023-08-27 01:35:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `offline_order_items`
--

CREATE TABLE `offline_order_items` (
  `offline_order_items_id` bigint UNSIGNED NOT NULL,
  `offline_order_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `food_id` bigint UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL DEFAULT '0',
  `price` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `offline_order_items`
--

INSERT INTO `offline_order_items` (`offline_order_items_id`, `offline_order_id`, `food_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(71, 'OFD-0908231NR6', 4, 1, 15000, '2023-08-09 02:48:47', '2023-08-09 02:48:47'),
(72, 'OFD-0908231NR6', 3, 1, 4000, '2023-08-09 02:48:47', '2023-08-09 02:48:47'),
(73, 'OFD-0908235022', 14, 1, 25000, '2023-08-09 02:49:19', '2023-08-09 02:49:19'),
(74, 'OFD-0908235022', 5, 1, 5000, '2023-08-09 02:49:19', '2023-08-09 02:49:19'),
(75, 'OFD-0908235022', 13, 1, 4000, '2023-08-09 02:49:19', '2023-08-09 02:49:19'),
(76, 'OFD-090823982N', 18, 1, 5000, '2023-08-09 02:49:50', '2023-08-09 02:49:50'),
(77, 'OFD-090823982N', 14, 1, 25000, '2023-08-09 02:49:50', '2023-08-09 02:49:50'),
(78, 'OFD-090823982N', 29, 1, 20000, '2023-08-09 02:49:50', '2023-08-09 02:49:50'),
(79, 'OFD-0908233F16', 33, 1, 30000, '2023-08-09 02:50:16', '2023-08-09 02:50:16'),
(80, 'OFD-0908233F16', 35, 1, 5000, '2023-08-09 02:50:16', '2023-08-09 02:50:16'),
(81, 'OFD-090823G248', 33, 1, 30000, '2023-08-09 02:50:33', '2023-08-09 02:50:33'),
(82, 'OFD-090823G248', 36, 1, 5000, '2023-08-09 02:50:33', '2023-08-09 02:50:33'),
(83, 'OFD-090823MXZ6', 3, 1, 4000, '2023-08-09 03:09:16', '2023-08-09 03:09:16'),
(84, 'OFD-090823Y511', 3, 1, 4000, '2023-08-09 03:18:40', '2023-08-09 03:18:40'),
(85, 'OFD-090823JUJZ', 5, 1, 5000, '2023-08-09 03:27:50', '2023-08-09 03:27:50'),
(86, 'OFD-170823ZNVD', 3, 1, 4000, '2023-08-17 07:06:04', '2023-08-17 07:06:04'),
(87, 'OFD-170823ZNVD', 4, 2, 15000, '2023-08-17 07:06:04', '2023-08-17 07:06:04'),
(88, 'OFD-170823ZNVD', 5, 2, 5000, '2023-08-17 07:06:04', '2023-08-17 07:06:04'),
(89, 'OFD-170823ZNVD', 13, 1, 4000, '2023-08-17 07:06:04', '2023-08-17 07:06:04'),
(90, 'OFD-170823CXYM', 5, 2, 5000, '2023-08-17 07:06:42', '2023-08-17 07:06:42'),
(91, 'OFD-170823CXYM', 16, 2, 2000, '2023-08-17 07:06:42', '2023-08-17 07:06:42'),
(92, 'OFD-170823CXYM', 30, 1, 22000, '2023-08-17 07:06:42', '2023-08-17 07:06:42'),
(93, 'OFD-170823CXYM', 29, 1, 20000, '2023-08-17 07:06:42', '2023-08-17 07:06:42'),
(94, 'OFD-170823A512', 18, 4, 5000, '2023-08-17 07:07:48', '2023-08-17 07:07:48'),
(95, 'OFD-170823A512', 14, 4, 25000, '2023-08-17 07:07:48', '2023-08-17 07:07:48'),
(96, 'OFD-170823NV8T', 29, 4, 20000, '2023-08-17 07:08:36', '2023-08-17 07:08:36'),
(97, 'OFD-170823NV8T', 17, 4, 2000, '2023-08-17 07:08:36', '2023-08-17 07:08:36'),
(98, 'OFD-17082308X6', 33, 6, 30000, '2023-08-17 07:09:06', '2023-08-17 07:09:06'),
(99, 'OFD-17082308X6', 34, 3, 45000, '2023-08-17 07:09:06', '2023-08-17 07:09:06'),
(100, 'OFD-17082308X6', 35, 3, 5000, '2023-08-17 07:09:06', '2023-08-17 07:09:06'),
(101, 'OFD-170823P600', 36, 2, 5000, '2023-08-17 07:09:47', '2023-08-17 07:09:47'),
(102, 'OFD-170823P600', 34, 1, 45000, '2023-08-17 07:09:47', '2023-08-17 07:09:47'),
(103, 'OFD-170823P600', 33, 1, 30000, '2023-08-17 07:09:47', '2023-08-17 07:09:47'),
(104, 'OFD-170823GMOU', 32, 2, 25000, '2023-08-17 07:10:17', '2023-08-17 07:10:17'),
(105, 'OFD-170823GMOU', 30, 1, 22000, '2023-08-17 07:10:17', '2023-08-17 07:10:17'),
(106, 'OFD-170823GMOU', 13, 1, 4000, '2023-08-17 07:10:17', '2023-08-17 07:10:17'),
(107, 'OFD-17082342KZ', 5, 3, 5000, '2023-08-17 07:10:54', '2023-08-17 07:10:54'),
(108, 'OFD-17082342KZ', 3, 3, 4000, '2023-08-17 07:10:54', '2023-08-17 07:10:54'),
(109, 'OFD-17082342KZ', 4, 3, 15000, '2023-08-17 07:10:54', '2023-08-17 07:10:54'),
(110, 'OFD-1708230370', 16, 1, 2000, '2023-08-17 07:11:18', '2023-08-17 07:11:18'),
(111, 'OFD-1708230370', 14, 5, 25000, '2023-08-17 07:11:18', '2023-08-17 07:11:18'),
(112, 'OFD-170823WZL2', 28, 2, 20000, '2023-08-17 07:11:40', '2023-08-17 07:11:40'),
(113, 'OFD-170823WZL2', 17, 2, 2000, '2023-08-17 07:11:40', '2023-08-17 07:11:40'),
(114, 'OFD-170823THU4', 4, 2, 15000, '2023-08-17 07:12:16', '2023-08-17 07:12:16'),
(115, 'OFD-170823THU4', 3, 2, 4000, '2023-08-17 07:12:16', '2023-08-17 07:12:16'),
(116, 'OFD-170823BAP5', 3, 4, 4000, '2023-08-17 07:13:02', '2023-08-17 07:13:02'),
(117, 'OFD-170823BAP5', 4, 4, 15000, '2023-08-17 07:13:02', '2023-08-17 07:13:02'),
(118, 'OFD-1708230C53', 5, 3, 5000, '2023-08-17 07:13:23', '2023-08-17 07:13:23'),
(119, 'OFD-1708230C53', 13, 3, 4000, '2023-08-17 07:13:23', '2023-08-17 07:13:23'),
(120, 'OFD-170823M4J2', 17, 3, 2000, '2023-08-17 07:14:25', '2023-08-17 07:14:25'),
(121, 'OFD-170823M4J2', 32, 3, 25000, '2023-08-17 07:14:25', '2023-08-17 07:14:25'),
(122, 'OFD-170823A6M3', 32, 4, 25000, '2023-08-17 07:15:11', '2023-08-17 07:15:11'),
(123, 'OFD-170823A6M3', 33, 2, 30000, '2023-08-17 07:15:11', '2023-08-17 07:15:11'),
(124, 'OFD-170823A6M3', 18, 2, 5000, '2023-08-17 07:15:11', '2023-08-17 07:15:11'),
(125, 'OFD-170823863M', 28, 2, 20000, '2023-08-17 07:16:44', '2023-08-17 07:16:44'),
(126, 'OFD-170823863M', 17, 2, 2000, '2023-08-17 07:16:44', '2023-08-17 07:16:44'),
(127, 'OFD-1708232H8X', 16, 3, 2000, '2023-08-17 07:17:13', '2023-08-17 07:17:13'),
(128, 'OFD-1708232H8X', 14, 3, 25000, '2023-08-17 07:17:13', '2023-08-17 07:17:13'),
(129, 'OFD-1708239N8Q', 5, 2, 5000, '2023-08-17 07:17:47', '2023-08-17 07:17:47'),
(130, 'OFD-1708239N8Q', 14, 2, 25000, '2023-08-17 07:17:47', '2023-08-17 07:17:47'),
(131, 'OFD-1708239N8Q', 13, 4, 4000, '2023-08-17 07:17:47', '2023-08-17 07:17:47'),
(132, 'OFD-17082382RT', 14, 4, 25000, '2023-08-17 07:24:47', '2023-08-17 07:24:47'),
(133, 'OFD-17082382RT', 16, 4, 2000, '2023-08-17 07:24:47', '2023-08-17 07:24:47'),
(134, 'OFD-170823NP2E', 35, 3, 5000, '2023-08-17 07:25:08', '2023-08-17 07:25:08'),
(135, 'OFD-170823NP2E', 34, 3, 45000, '2023-08-17 07:25:08', '2023-08-17 07:25:08'),
(136, 'OFD-170823N6M1', 30, 3, 22000, '2023-08-17 07:25:28', '2023-08-17 07:25:28'),
(137, 'OFD-170823N6M1', 18, 3, 5000, '2023-08-17 07:25:28', '2023-08-17 07:25:28'),
(138, 'OFD-170823KV93', 18, 3, 5000, '2023-08-17 07:26:21', '2023-08-17 07:26:21'),
(139, 'OFD-170823KV93', 34, 3, 45000, '2023-08-17 07:26:21', '2023-08-17 07:26:21'),
(140, 'OFD-1708238202', 36, 3, 5000, '2023-08-17 07:26:42', '2023-08-17 07:26:42'),
(141, 'OFD-1708238202', 33, 3, 30000, '2023-08-17 07:26:42', '2023-08-17 07:26:42'),
(142, 'OFD-1708233184', 36, 3, 5000, '2023-08-17 07:27:34', '2023-08-17 07:27:34'),
(143, 'OFD-1708233184', 28, 3, 20000, '2023-08-17 07:27:34', '2023-08-17 07:27:34'),
(144, 'OFD-170823E3C4', 3, 1, 4000, '2023-08-17 09:55:52', '2023-08-17 09:55:52'),
(145, 'OFD-170823E3C4', 5, 1, 5000, '2023-08-17 09:55:52', '2023-08-17 09:55:52'),
(146, 'OFD-170823U0FC', 3, 1, 4000, '2023-08-17 10:14:22', '2023-08-17 10:14:22'),
(147, 'OFD-1808233A2C', 3, 1, 4000, '2023-08-18 01:03:31', '2023-08-18 01:03:31'),
(148, 'OFD-1808233A2C', 4, 1, 15000, '2023-08-18 01:03:56', '2023-08-18 01:03:56'),
(149, 'OFD-1808231257', 5, 3, 5000, '2023-08-18 03:17:55', '2023-08-18 03:17:55'),
(150, 'OFD-180823EM3A', 3, 1, 4000, '2023-08-18 06:08:07', '2023-08-18 06:08:07'),
(151, 'OFD-180823EM3A', 4, 1, 15000, '2023-08-18 06:08:07', '2023-08-18 06:08:07'),
(152, 'OFD-180823EM3A', 28, 1, 20000, '2023-08-18 06:08:41', '2023-08-18 06:08:41'),
(153, 'OFD-23082313G2', 5, 1, 5000, '2023-08-23 03:56:39', '2023-08-23 03:56:39'),
(154, 'OFD-230823G2AC', 4, 1, 15000, '2023-08-23 04:05:19', '2023-08-23 04:05:19'),
(155, 'OFD-230823CV4M', 5, 10, 5000, '2023-08-23 06:44:25', '2023-08-23 06:44:25'),
(156, 'OFD-230823CV4M', 13, 10, 4000, '2023-08-23 06:44:25', '2023-08-23 06:44:25'),
(157, 'OFD-230823CV4M', 29, 10, 20000, '2023-08-23 06:44:25', '2023-08-23 06:44:25'),
(158, 'OFD-230823CV4M', 33, 3, 30000, '2023-08-23 06:44:42', '2023-08-23 06:44:42'),
(159, 'OFD-2708232JD3', 14, 2, 25000, '2023-08-27 01:33:36', '2023-08-27 01:33:36'),
(160, 'OFD-2708232JD3', 5, 2, 5000, '2023-08-27 01:33:36', '2023-08-27 01:33:36'),
(161, 'OFD-2708232JD3', 3, 2, 4000, '2023-08-27 01:33:36', '2023-08-27 01:33:36'),
(162, 'OFD-270823VD77', 4, 1, 15000, '2023-08-27 01:35:47', '2023-08-27 01:35:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `online_orders`
--

CREATE TABLE `online_orders` (
  `online_order_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `pick_up_date` date NOT NULL,
  `pick_up_time` time NOT NULL,
  `estimation_time` time NOT NULL,
  `status` enum('pending','success','failed','process') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `total` int UNSIGNED NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `payment_method` enum('cash','virtual') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'cash',
  `snap_token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reservation_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `online_orders`
--

INSERT INTO `online_orders` (`online_order_id`, `user_id`, `name`, `phone`, `address`, `pick_up_date`, `pick_up_time`, `estimation_time`, `status`, `total`, `message`, `payment_method`, `snap_token`, `reservation_id`, `created_at`, `updated_at`) VALUES
('OND-01092384I3', 23, 'Laila Wani Nurdiyanti', '08115678901238', 'Jl. Tasan Panyi, Rantau', '2023-09-01', '08:06:00', '10:06:00', 'success', 290000, NULL, 'virtual', 'f401a511-a70a-4985-81bf-6c853cd5ef56', NULL, '2023-09-01 00:08:56', '2023-09-01 00:11:12'),
('OND-010923LWQ4', 23, 'Laila Wani Nurdiyanti', '08115678901238', 'Jl. Pembangunan, Rantau', '2023-09-01', '07:59:00', '09:59:00', 'success', 228000, NULL, 'virtual', '0d890e84-adb4-41e8-a443-8decfb7ef3be', NULL, '2023-09-01 00:01:20', '2023-09-01 00:04:15'),
('OND-010923O04B', 23, 'Laila Wani Nurdiyanti', '08115678901238', 'Desa Antasari', '2023-08-31', '07:33:00', '08:33:00', 'success', 125000, NULL, 'virtual', '4ab9d857-443a-4891-b5be-847a79276908', NULL, '2023-08-31 23:33:44', '2023-08-31 23:37:51'),
('OND-0908230UBL', 32, 'Tira Mulyani', '+881971448835', NULL, '2023-05-19', '10:18:00', '11:18:00', 'success', 285000, NULL, 'cash', NULL, NULL, '2023-08-09 02:18:37', '2023-08-09 02:24:30'),
('OND-09082324I9', 32, 'Tira Mulyani', '+881971448835', NULL, '2023-07-23', '14:18:00', '15:18:00', 'success', 840000, NULL, 'cash', NULL, NULL, '2023-08-09 02:19:07', '2023-08-09 02:24:32'),
('OND-0908232SBC', 39, 'Zaenab Rahmawati', '+5955623365662', NULL, '2023-08-10', '13:22:00', '15:22:00', 'process', 430000, NULL, 'virtual', '77620eb6-8423-48ea-93cf-23505da0d871', NULL, '2023-08-09 02:22:55', '2023-08-23 04:29:19'),
('OND-0908233DU0', 3, 'Harto Gaiman Budiyanto', '+40343659125', NULL, '2023-06-11', '08:37:00', '09:37:00', 'success', 406000, NULL, 'cash', NULL, NULL, '2023-08-08 22:37:31', '2023-08-09 02:24:20'),
('OND-09082349S7', 10, 'Adika Lazuardi M.Farm', '+6748718445', NULL, '2023-07-09', '10:13:00', '11:13:00', 'success', 345000, NULL, 'cash', NULL, NULL, '2023-08-09 02:14:00', '2023-08-09 02:25:10'),
('OND-0908236C96', 9, 'Jono Wijaya', '+40317075798', NULL, '2023-06-20', '10:10:00', '11:10:00', 'success', 225000, NULL, 'cash', NULL, NULL, '2023-08-09 02:11:00', '2023-08-09 02:24:51'),
('OND-0908236N9W', 9, 'Jono Wijaya', '+40317075798', NULL, '2023-06-16', '10:10:00', '11:10:00', 'success', 445000, NULL, 'cash', NULL, 'RSV-090823171U', '2023-08-09 02:10:26', '2023-08-09 02:24:46'),
('OND-09082372E0', 3, 'Harto Gaiman Budiyanto', '+40343659125', NULL, '2023-06-10', '08:36:00', '09:36:00', 'success', 320000, NULL, 'cash', NULL, NULL, '2023-08-08 22:36:55', '2023-08-09 02:24:15'),
('OND-090823786W', 3, 'Harto Gaiman Budiyanto', '085453221102', NULL, '2023-06-02', '08:00:00', '09:00:00', 'success', 225000, NULL, 'cash', NULL, NULL, '2023-08-08 22:35:21', '2023-08-09 02:24:01'),
('OND-0908238537', 3, 'Harto Gaiman Budiyanto', '+40343659125', NULL, '2023-06-08', '08:30:00', '10:30:00', 'success', 150000, NULL, 'cash', NULL, 'RSV-090823K05Y', '2023-08-08 22:36:22', '2023-08-09 02:24:07'),
('OND-09082386H8', 24, 'Bella Yulianti', '+6797519680', NULL, '2023-07-12', '10:15:00', '11:15:00', 'success', 700000, NULL, 'cash', NULL, NULL, '2023-08-09 02:16:05', '2023-08-09 02:24:24'),
('OND-0908238787', 1, 'Imam Cahyo', '+50398381131', NULL, '2023-08-09', '16:17:00', '17:17:00', 'failed', 19000, NULL, 'cash', NULL, 'RSV-09082348PN', '2023-08-09 08:17:55', '2023-08-17 06:50:51'),
('OND-0908238TUD', 26, 'Halima Hartati S.Gz', '+9714370951754', NULL, '2023-07-12', '10:16:00', '11:16:00', 'success', 920000, NULL, 'cash', NULL, NULL, '2023-08-09 02:16:51', '2023-08-09 02:24:25'),
('OND-0908238Y41', 3, 'Harto Gaiman Budiyanto', '+40343659125', NULL, '2023-06-15', '10:38:00', '11:38:00', 'success', 485000, NULL, 'cash', NULL, 'RSV-090823O068', '2023-08-08 22:38:21', '2023-08-09 02:24:41'),
('OND-090823909G', 44, 'Baktiadi Rajasa', '+815900996176', NULL, '2023-07-25', '12:35:00', '15:35:00', 'success', 48000, NULL, 'cash', NULL, 'RSV-090823ZX8D', '2023-08-09 02:36:23', '2023-08-09 02:39:00'),
('OND-090823ATGS', 26, 'Halima Hartati S.Gz', '+9714370951754', NULL, '2023-07-15', '10:17:00', '11:17:00', 'success', 1218000, NULL, 'cash', NULL, NULL, '2023-08-09 02:17:19', '2023-08-09 02:24:28'),
('OND-090823CB6H', 36, 'Salwa Nasyiah S.I.Kom', '+50074566', NULL, '2023-08-10', '10:21:00', '11:21:00', 'success', 235000, NULL, 'cash', NULL, NULL, '2023-08-09 02:21:54', '2023-08-23 04:29:14'),
('OND-090823E6IW', 34, 'Johan Hardiansyah S.Kom', '+376671705428', NULL, '2023-08-09', '10:20:00', '12:20:00', 'failed', 225000, NULL, 'cash', NULL, NULL, '2023-08-09 02:21:13', '2023-08-09 02:25:24'),
('OND-090823ET34', 42, 'Dina Pratiwi', '+3813587949721', NULL, '2023-06-06', '10:33:00', '11:33:00', 'success', 24000, NULL, 'cash', NULL, 'RSV-090823FCXZ', '2023-08-09 02:34:08', '2023-08-09 02:39:03'),
('OND-090823GHW1', 10, 'Adika Lazuardi M.Farm', '+6748718445', NULL, '2023-07-02', '10:13:00', '12:13:00', 'success', 235000, NULL, 'cash', NULL, 'RSV-09082311W4', '2023-08-09 02:13:28', '2023-08-09 02:25:05'),
('OND-090823JF92', 1, 'Resti Oktini', '+50398381131', NULL, '2023-08-09', '12:34:00', '13:34:00', 'pending', 4000, NULL, 'cash', NULL, NULL, '2023-08-09 04:35:14', '2023-08-09 04:35:14'),
('OND-090823K42E', 1, 'Ahmad Setiaji', '+50398381131', NULL, '2023-08-09', '10:58:00', '11:58:00', 'pending', 110000, NULL, 'virtual', 'd6474e26-f0fa-4750-a7ef-716e49bd53fe', NULL, '2023-08-09 02:59:07', '2023-08-09 02:59:08'),
('OND-090823L15L', 10, 'Adika Lazuardi M.Farm', '+6748718445', NULL, '2023-06-27', '10:12:00', '11:12:00', 'success', 225000, NULL, 'cash', NULL, 'RSV-090823WWM9', '2023-08-09 02:12:44', '2023-08-09 02:25:01'),
('OND-090823MHIB', 34, 'Johan Hardiansyah S.Kom', '+376671705428', NULL, '2023-08-03', '10:20:00', '11:20:00', 'success', 1260000, NULL, 'cash', NULL, NULL, '2023-08-09 02:20:31', '2023-08-09 02:25:29'),
('OND-090823Q0R9', 10, 'Adika Lazuardi M.Farm', '+6748718445', NULL, '2023-06-25', '10:12:00', '11:12:00', 'success', 170000, NULL, 'cash', NULL, NULL, '2023-08-09 02:12:10', '2023-08-09 02:24:56'),
('OND-090823V4T0', 34, 'Johan Hardiansyah S.Kom', '+376671705428', NULL, '2023-08-02', '10:19:00', '11:19:00', 'success', 225000, NULL, 'cash', NULL, 'RSV-090823ZS7J', '2023-08-09 02:19:55', '2023-08-09 02:24:35'),
('OND-090823Y505', 24, 'Bella Yulianti', '+6797519680', NULL, '2023-07-09', '12:15:00', '13:15:00', 'success', 805000, NULL, 'cash', NULL, NULL, '2023-08-09 02:15:31', '2023-08-09 02:25:15'),
('OND-1708230VIS', 3, 'Harto Gaiman Budiyanto', '0898765432109', NULL, '2022-12-02', '10:19:00', '11:19:00', 'success', 80000, NULL, 'cash', NULL, NULL, '2023-08-17 02:20:23', '2023-08-17 03:32:43'),
('OND-1708230YGQ', 6, 'Caraka Adriansyah S.H.', '08110567890321', NULL, '2023-01-21', '10:54:00', '11:54:00', 'success', 400000, NULL, 'cash', NULL, NULL, '2023-08-17 02:54:37', '2023-08-17 03:33:33'),
('OND-1708231R2S', 4, 'Yessi Hariyah', '0810192837465', NULL, '2023-01-13', '10:52:00', '11:52:00', 'success', 440000, NULL, 'cash', NULL, NULL, '2023-08-17 02:52:57', '2023-08-17 03:33:21'),
('OND-170823272K', 10, 'Adika Lazuardi M.Farm', '08134455667788', NULL, '2023-04-24', '11:00:00', '12:00:00', 'success', 100000, NULL, 'cash', NULL, NULL, '2023-08-17 03:00:57', '2023-08-17 03:34:34'),
('OND-1708232CJI', 10, 'Adika Lazuardi M.Farm', '08134455667788', NULL, '2023-05-17', '11:00:00', '12:00:00', 'success', 166000, NULL, 'cash', NULL, NULL, '2023-08-17 03:00:44', '2023-08-17 03:34:46'),
('OND-1708232WIF', 11, 'Elon Bahuwirya Hakim', '081234567890', NULL, '2023-05-21', '11:01:00', '12:01:00', 'success', 846000, NULL, 'cash', NULL, NULL, '2023-08-17 03:01:45', '2023-08-17 03:34:49'),
('OND-1708232XKI', 20, 'Narji Sihombing', '081987654321', NULL, '2023-05-27', '11:08:00', '12:08:00', 'success', 235000, NULL, 'cash', NULL, NULL, '2023-08-17 03:08:26', '2023-08-17 03:34:52'),
('OND-1708233D7R', 13, 'Opung Widodo', '0819081726354', NULL, '2023-03-05', '11:02:00', '12:02:00', 'success', 555000, NULL, 'cash', NULL, NULL, '2023-08-17 03:02:47', '2023-08-17 03:33:52'),
('OND-1708234PTH', 18, 'Irnanto Saragih M.Farm', '08123456789102', NULL, '2023-03-22', '11:07:00', '12:07:00', 'success', 330000, NULL, 'cash', NULL, NULL, '2023-08-17 03:07:07', '2023-08-17 03:34:01'),
('OND-1708234X86', 13, 'Opung Widodo', '0819081726354', NULL, '2023-04-07', '11:02:00', '12:02:00', 'success', 526000, NULL, 'cash', NULL, NULL, '2023-08-17 03:03:01', '2023-08-17 03:34:16'),
('OND-1708235639', 12, 'Soleh Megantara', '0897654321098', NULL, '2023-04-19', '11:02:00', '12:02:00', 'success', 250000, NULL, 'cash', NULL, NULL, '2023-08-17 03:02:09', '2023-08-17 03:34:25'),
('OND-1708236PMW', 14, 'Cawisadi Jumari Hutapea M.TI.', '08114567890123', NULL, '2023-05-12', '11:03:00', '12:03:00', 'success', 195000, NULL, 'cash', NULL, NULL, '2023-08-17 03:03:23', '2023-08-17 03:34:43'),
('OND-17082377CU', 16, 'Respati Pradana', '089098765434', NULL, '2023-05-03', '11:04:00', '12:04:00', 'success', 500000, NULL, 'cash', NULL, NULL, '2023-08-17 03:04:47', '2023-08-17 03:34:39'),
('OND-1708237PG2', 16, 'Respati Pradana', '089098765434', NULL, '2023-04-22', '11:05:00', '12:05:00', 'success', 233000, NULL, 'cash', NULL, NULL, '2023-08-17 03:05:07', '2023-08-17 03:34:30'),
('OND-17082388WT', 15, 'Zizi Dian Agustina S.T.', '08110567984321', NULL, '2023-04-18', '11:04:00', '12:04:00', 'success', 120000, NULL, 'cash', NULL, NULL, '2023-08-17 03:04:22', '2023-08-17 03:34:21'),
('OND-1708239C21', 6, 'Caraka Adriansyah S.H.', '08110567890321', NULL, '2023-01-11', '10:54:00', '11:54:00', 'success', 450000, NULL, 'cash', NULL, NULL, '2023-08-17 02:54:19', '2023-08-17 03:33:16'),
('OND-1708239P2I', 102, 'Muhammad Fadhilah', '01151154454', NULL, '2023-08-17', '21:39:00', '22:39:00', 'failed', 35000, NULL, 'cash', NULL, NULL, '2023-08-17 13:39:26', '2023-08-23 04:29:26'),
('OND-170823A74R', 5, 'Kenzie Oman Firmansyah', '08115678901234', NULL, '2023-01-03', '10:53:00', '11:53:00', 'success', 170000, NULL, 'cash', NULL, NULL, '2023-08-17 02:53:41', '2023-08-17 03:33:13'),
('OND-170823C74G', 20, 'Narji Sihombing', '081987654321', NULL, '2023-04-05', '11:08:00', '12:08:00', 'success', 925000, NULL, 'cash', NULL, NULL, '2023-08-17 03:08:13', '2023-08-17 03:34:13'),
('OND-170823CFS5', 1, 'H.Bajuri', '081234567891', NULL, '2023-08-17', '11:45:00', '13:45:00', 'success', 110000, NULL, 'cash', NULL, 'RSV-170823C2ZS', '2023-08-17 03:46:07', '2023-08-17 03:59:15'),
('OND-170823ECUM', 17, 'Hamima Utami', '08109786543212', NULL, '2023-04-04', '11:06:00', '12:06:00', 'success', 285000, NULL, 'cash', NULL, NULL, '2023-08-17 03:06:20', '2023-08-17 03:34:08'),
('OND-170823GGSQ', 14, 'Cawisadi Jumari Hutapea M.TI.', '08114567890123', NULL, '2023-04-02', '11:03:00', '12:03:00', 'success', 250000, NULL, 'cash', NULL, NULL, '2023-08-17 03:03:42', '2023-08-17 03:34:06'),
('OND-170823IW99', 8, 'Intan Kartika Namaga S.Pt', '08109876543211', NULL, '2023-01-02', '10:55:00', '11:55:00', 'success', 120000, NULL, 'cash', NULL, NULL, '2023-08-17 02:55:47', '2023-08-17 03:33:08'),
('OND-170823KC03', 12, 'Soleh Megantara', '0897654321098', NULL, '2023-03-24', '11:02:00', '12:02:00', 'success', 1180000, NULL, 'cash', NULL, NULL, '2023-08-17 03:02:22', '2023-08-17 03:34:04'),
('OND-170823KS8P', 4, 'Yessi Hariyah', '0810192837465', NULL, '2022-12-24', '10:53:00', '11:53:00', 'success', 450000, NULL, 'cash', NULL, NULL, '2023-08-17 02:53:14', '2023-08-17 03:33:04'),
('OND-170823M394', 19, 'Martani Tamba', '08134455667789', NULL, '2023-03-19', '11:07:00', '12:07:00', 'success', 800000, NULL, 'cash', NULL, NULL, '2023-08-17 03:07:51', '2023-08-17 03:33:58'),
('OND-170823M5M2', 21, 'Patricia Titin Laksmiwati S.T.', '0897654321098', NULL, '2023-03-18', '11:08:00', '12:08:00', 'success', 276000, NULL, 'cash', NULL, NULL, '2023-08-17 03:08:52', '2023-08-17 03:33:56'),
('OND-170823NDK4', 5, 'Kenzie Oman Firmansyah', '08115678901234', NULL, '2022-12-15', '10:53:00', '11:53:00', 'success', 440000, NULL, 'cash', NULL, NULL, '2023-08-17 02:53:54', '2023-08-17 03:33:00'),
('OND-170823Q9QS', 3, 'Harto Gaiman Budiyanto', '0898765432109', NULL, '2022-12-10', '10:51:00', '11:51:00', 'success', 925000, NULL, 'cash', NULL, NULL, '2023-08-17 02:51:52', '2023-08-17 03:32:57'),
('OND-170823R763', 19, 'Martani Tamba', '08134455667789', NULL, '2023-02-03', '11:07:00', '12:07:00', 'success', 770000, NULL, 'cash', NULL, NULL, '2023-08-17 03:07:33', '2023-08-17 03:33:37'),
('OND-170823TSWQ', 15, 'Zizi Dian Agustina S.T.', '08110567984321', NULL, '2023-03-07', '11:04:00', '12:04:00', 'success', 160000, NULL, 'cash', NULL, NULL, '2023-08-17 03:04:06', '2023-08-17 03:33:54'),
('OND-170823TX4Y', 18, 'Irnanto Saragih M.Farm', '08123456789102', NULL, '2023-03-01', '11:06:00', '12:06:00', 'success', 925000, NULL, 'cash', NULL, NULL, '2023-08-17 03:06:54', '2023-08-17 03:33:48'),
('OND-170823U10E', 11, 'Elon Bahuwirya Hakim', '081234567890', NULL, '2023-02-28', '11:01:00', '12:01:00', 'success', 155000, NULL, 'cash', NULL, NULL, '2023-08-17 03:01:31', '2023-08-17 03:33:45'),
('OND-170823U844', 9, 'Jono Wijaya', '08123456789101', NULL, '2023-02-17', '11:00:00', '12:00:00', 'success', 275000, NULL, 'cash', NULL, NULL, '2023-08-17 03:00:17', '2023-08-17 03:33:43'),
('OND-170823WQ9X', 17, 'Hamima Utami', '08109786543212', NULL, '2023-02-04', '11:06:00', '12:06:00', 'success', 180000, NULL, 'cash', NULL, NULL, '2023-08-17 03:06:35', '2023-08-17 03:33:40'),
('OND-170823XSXZ', 7, 'Irma Prastuti', '089012345678', NULL, '2023-01-29', '10:55:00', '11:55:00', 'success', 135000, NULL, 'cash', NULL, NULL, '2023-08-17 02:55:21', '2023-08-17 03:33:35'),
('OND-1808230ZHT', 102, 'Budi', '01354874454', NULL, '2023-08-18', '14:01:00', '15:01:00', 'pending', 119000, NULL, 'virtual', '70f46181-c94f-460a-a33f-d4fdadfbcfe8', NULL, '2023-08-18 06:04:36', '2023-08-18 06:04:37'),
('OND-180823AT90', 102, 'Imam Sukoco', '01354874454', NULL, '2023-08-18', '11:12:00', '13:12:00', 'success', 295000, NULL, 'virtual', '4ddcaccb-9070-417b-bab9-ec835fbf0736', NULL, '2023-08-18 03:12:53', '2023-08-18 03:14:04'),
('OND-180823M3Z9', 102, 'Ipul Hadi', '01354874454', NULL, '2023-08-18', '11:14:00', '13:14:00', 'success', 9000, NULL, 'cash', NULL, 'RSV-180823FEF2', '2023-08-18 03:15:18', '2023-08-18 03:15:49'),
('OND-180823P6FZ', 102, 'Muhammad Fadhilah', '01151154454', NULL, '2023-08-18', '08:54:00', '09:54:00', 'success', 13000, NULL, 'virtual', 'c8b8b089-fe7a-4ebc-a805-ac88ee254819', NULL, '2023-08-18 00:54:22', '2023-08-18 00:59:06'),
('OND-230823339R', 102, 'Muhammad Fadhilah', '081333221102', NULL, '2023-08-23', '12:47:00', '13:47:00', 'failed', 15000, NULL, 'cash', NULL, 'RSV-23082383GY', '2023-08-23 04:48:15', '2023-08-23 04:49:56'),
('OND-2308233536', 102, 'Muhammad Fadhilah', '01151154454', NULL, '2023-08-23', '21:40:00', '22:40:00', 'success', 188000, NULL, 'cash', NULL, 'RSV-230823SQ56', '2023-08-23 13:43:49', '2023-08-23 13:44:12'),
('OND-23082341X4', 1, 'H.Bajuri', '081234567891', NULL, '2023-08-23', '14:45:00', '15:45:00', 'success', 2330000, NULL, 'cash', NULL, 'RSV-2308230FQ4', '2023-08-23 06:46:15', '2023-08-23 10:19:59'),
('OND-2308236RO5', 102, 'Muhammad Fadhilah', '01151154454', NULL, '2023-08-23', '12:50:00', '13:50:00', 'success', 4000, NULL, 'cash', NULL, 'RSV-23082382LI', '2023-08-23 04:50:28', '2023-08-23 04:56:31'),
('OND-230823IB6T', 102, 'Muhammad Fadhilah', '01151154454', NULL, '2023-08-23', '12:30:00', '13:30:00', 'success', 30000, NULL, 'cash', NULL, NULL, '2023-08-23 04:30:48', '2023-08-23 04:33:01'),
('OND-24082356IX', 17, 'Hamima Utami', '08109786543212', NULL, '2023-08-24', '09:11:00', '13:11:00', 'pending', 110000, NULL, 'virtual', '259cad3e-e756-4950-aa5f-ec561b2fa2bb', NULL, '2023-08-24 01:11:37', '2023-08-24 01:11:38'),
('OND-240823GJ5J', 17, 'Hamima Utami', '08109786543212', NULL, '2023-08-24', '08:59:00', '10:59:00', 'pending', 45000, NULL, 'virtual', 'e596b325-12dc-4ace-8fca-6880e8089702', NULL, '2023-08-24 01:00:07', '2023-08-24 01:00:09'),
('OND-240823H9E1', 17, 'Hamima Utami', '08109786543212', NULL, '2023-08-24', '09:04:00', '12:04:00', 'pending', 70000, NULL, 'virtual', 'c66ac076-434e-4ea7-a1b4-c0426470f118', NULL, '2023-08-24 01:04:21', '2023-08-24 01:04:22'),
('OND-240823LSYT', 1, 'H.Bajuri', '081234567891', NULL, '2023-08-24', '09:41:00', '13:41:00', 'pending', 110000, NULL, 'virtual', 'ebf3077d-0da2-41ee-a21c-c861cd8dfd5b', NULL, '2023-08-24 01:41:43', '2023-08-24 01:41:43'),
('OND-290823LGU0', 102, 'Muhammad Fadhilah', '01151154454', NULL, '2023-08-29', '21:07:00', '22:07:00', 'pending', 32000, NULL, 'cash', NULL, NULL, '2023-08-29 13:07:56', '2023-08-29 13:07:56'),
('OND-290823O77Q', 102, 'Muhammad Fadhilah', '01151154454', 'Kepayang', '2023-08-29', '21:20:00', '22:20:00', 'success', 14000, NULL, 'cash', NULL, NULL, '2023-08-29 13:23:59', '2023-08-29 13:58:57'),
('OND-3108237G2A', 102, 'Muhammad Fadhilah', '01151154454', NULL, '2023-08-31', '18:21:00', '19:21:00', 'pending', 185000, NULL, 'virtual', 'a9794277-2759-42bf-ae08-ff800c610937', NULL, '2023-08-31 10:21:32', '2023-08-31 10:21:32'),
('OND-310823G85S', 18, 'Irnanto Saragih M.Farm', '08123456789102', NULL, '2023-08-31', '18:16:00', '19:16:00', 'pending', 4000, NULL, 'virtual', '7649065e-d811-4fee-94a3-5fda660f907f', NULL, '2023-08-31 10:17:01', '2023-08-31 10:17:01'),
('OND-310823LFYY', 22, 'Winda Siti Hassanah M.Pd', '0812345678098', 'Bitahan', '2023-08-31', '18:47:00', '19:47:00', 'pending', 276000, NULL, 'virtual', '9d0822eb-38b4-45c2-9ab6-5db874f048d4', NULL, '2023-08-31 11:01:51', '2023-08-31 11:01:52'),
('OND-310823TZU5', 22, 'Winda Siti Hassanah M.Pd', '0812345678098', NULL, '2023-08-31', '18:43:00', '19:43:00', 'success', 119000, NULL, 'cash', NULL, NULL, '2023-08-31 10:43:32', '2023-08-31 10:44:04'),
('OND-310823UXW3', 22, 'Winda Siti Hassanah M.Pd', '0812345678098', NULL, '2023-08-31', '18:36:00', '19:36:00', 'success', 295000, NULL, 'virtual', 'da7d1778-92c5-4393-b823-70f729df9180', NULL, '2023-08-31 10:36:30', '2023-08-31 10:39:39'),
('OND-310823W9AM', 102, 'Muhammad Fadhilah', '01151154454', NULL, '2023-08-31', '17:57:00', '18:57:00', 'success', 20000, NULL, 'virtual', '8e56a99a-aebd-4328-a95e-1fc337aaa7c7', NULL, '2023-08-31 09:57:36', '2023-08-31 10:05:41'),
('OND-310823XPLP', 18, 'Irnanto Saragih M.Farm', '08123456789102', NULL, '2023-08-31', '18:18:00', '19:18:00', 'pending', 110000, NULL, 'virtual', '3eb89da5-e7dc-4f40-bdbb-7e9b6ef4bc39', NULL, '2023-08-31 10:18:57', '2023-08-31 10:18:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `online_order_items`
--

CREATE TABLE `online_order_items` (
  `online_order_items_id` bigint UNSIGNED NOT NULL,
  `online_order_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `food_id` bigint UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL DEFAULT '0',
  `price` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `online_order_items`
--

INSERT INTO `online_order_items` (`online_order_items_id`, `online_order_id`, `food_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(135, 'OND-090823786W', 43, 1, 185000, '2023-08-08 22:35:21', '2023-08-08 22:35:21'),
(136, 'OND-090823786W', 44, 10, 4000, '2023-08-08 22:35:21', '2023-08-08 22:35:21'),
(137, 'OND-0908238537', 42, 1, 110000, '2023-08-08 22:36:22', '2023-08-08 22:36:22'),
(138, 'OND-0908238537', 44, 10, 4000, '2023-08-08 22:36:22', '2023-08-08 22:36:22'),
(139, 'OND-09082372E0', 39, 1, 320000, '2023-08-08 22:36:55', '2023-08-08 22:36:55'),
(140, 'OND-0908233DU0', 37, 1, 220000, '2023-08-08 22:37:31', '2023-08-08 22:37:31'),
(141, 'OND-0908233DU0', 38, 1, 186000, '2023-08-08 22:37:31', '2023-08-08 22:37:31'),
(142, 'OND-0908238Y41', 34, 5, 45000, '2023-08-08 22:38:21', '2023-08-08 22:38:21'),
(143, 'OND-0908238Y41', 33, 5, 30000, '2023-08-08 22:38:21', '2023-08-08 22:38:21'),
(144, 'OND-0908238Y41', 30, 5, 22000, '2023-08-08 22:38:21', '2023-08-08 22:38:21'),
(145, 'OND-0908236N9W', 39, 1, 320000, '2023-08-09 02:10:26', '2023-08-09 02:10:26'),
(146, 'OND-0908236N9W', 40, 1, 85000, '2023-08-09 02:10:26', '2023-08-09 02:10:26'),
(147, 'OND-0908236N9W', 44, 10, 4000, '2023-08-09 02:10:26', '2023-08-09 02:10:26'),
(148, 'OND-0908236C96', 31, 3, 25000, '2023-08-09 02:11:00', '2023-08-09 02:11:00'),
(149, 'OND-0908236C96', 33, 3, 30000, '2023-08-09 02:11:00', '2023-08-09 02:11:00'),
(150, 'OND-0908236C96', 29, 3, 20000, '2023-08-09 02:11:00', '2023-08-09 02:11:00'),
(151, 'OND-090823Q0R9', 34, 2, 45000, '2023-08-09 02:12:10', '2023-08-09 02:12:10'),
(152, 'OND-090823Q0R9', 29, 2, 20000, '2023-08-09 02:12:10', '2023-08-09 02:12:10'),
(153, 'OND-090823Q0R9', 28, 2, 20000, '2023-08-09 02:12:10', '2023-08-09 02:12:10'),
(154, 'OND-090823L15L', 43, 1, 185000, '2023-08-09 02:12:44', '2023-08-09 02:12:44'),
(155, 'OND-090823L15L', 44, 10, 4000, '2023-08-09 02:12:44', '2023-08-09 02:12:44'),
(156, 'OND-090823GHW1', 42, 1, 110000, '2023-08-09 02:13:28', '2023-08-09 02:13:28'),
(157, 'OND-090823GHW1', 40, 1, 85000, '2023-08-09 02:13:28', '2023-08-09 02:13:28'),
(158, 'OND-090823GHW1', 44, 10, 4000, '2023-08-09 02:13:28', '2023-08-09 02:13:28'),
(159, 'OND-09082349S7', 39, 1, 320000, '2023-08-09 02:14:00', '2023-08-09 02:14:00'),
(160, 'OND-09082349S7', 14, 1, 25000, '2023-08-09 02:14:00', '2023-08-09 02:14:00'),
(161, 'OND-090823Y505', 39, 1, 320000, '2023-08-09 02:15:31', '2023-08-09 02:15:31'),
(162, 'OND-090823Y505', 37, 1, 220000, '2023-08-09 02:15:31', '2023-08-09 02:15:31'),
(163, 'OND-090823Y505', 43, 1, 185000, '2023-08-09 02:15:31', '2023-08-09 02:15:31'),
(164, 'OND-090823Y505', 44, 20, 4000, '2023-08-09 02:15:31', '2023-08-09 02:15:31'),
(165, 'OND-09082386H8', 34, 10, 45000, '2023-08-09 02:16:05', '2023-08-09 02:16:05'),
(166, 'OND-09082386H8', 32, 10, 25000, '2023-08-09 02:16:05', '2023-08-09 02:16:05'),
(167, 'OND-0908238TUD', 41, 5, 150000, '2023-08-09 02:16:51', '2023-08-09 02:16:51'),
(168, 'OND-0908238TUD', 40, 2, 85000, '2023-08-09 02:16:51', '2023-08-09 02:16:51'),
(169, 'OND-090823ATGS', 37, 3, 220000, '2023-08-09 02:17:19', '2023-08-09 02:17:19'),
(170, 'OND-090823ATGS', 38, 3, 186000, '2023-08-09 02:17:19', '2023-08-09 02:17:19'),
(171, 'OND-0908230UBL', 43, 1, 185000, '2023-08-09 02:18:37', '2023-08-09 02:18:37'),
(172, 'OND-0908230UBL', 5, 20, 5000, '2023-08-09 02:18:37', '2023-08-09 02:18:37'),
(173, 'OND-09082324I9', 42, 2, 110000, '2023-08-09 02:19:07', '2023-08-09 02:19:07'),
(174, 'OND-09082324I9', 41, 3, 150000, '2023-08-09 02:19:07', '2023-08-09 02:19:07'),
(175, 'OND-09082324I9', 40, 2, 85000, '2023-08-09 02:19:07', '2023-08-09 02:19:07'),
(176, 'OND-090823V4T0', 43, 1, 185000, '2023-08-09 02:19:55', '2023-08-09 02:19:55'),
(177, 'OND-090823V4T0', 44, 10, 4000, '2023-08-09 02:19:55', '2023-08-09 02:19:55'),
(178, 'OND-090823MHIB', 39, 3, 320000, '2023-08-09 02:20:31', '2023-08-09 02:20:31'),
(179, 'OND-090823MHIB', 41, 2, 150000, '2023-08-09 02:20:31', '2023-08-09 02:20:31'),
(180, 'OND-090823E6IW', 43, 1, 185000, '2023-08-09 02:21:13', '2023-08-09 02:21:13'),
(181, 'OND-090823E6IW', 44, 10, 4000, '2023-08-09 02:21:13', '2023-08-09 02:21:13'),
(182, 'OND-090823CB6H', 41, 1, 150000, '2023-08-09 02:21:56', '2023-08-09 02:21:56'),
(183, 'OND-090823CB6H', 40, 1, 85000, '2023-08-09 02:21:56', '2023-08-09 02:21:56'),
(184, 'OND-0908232SBC', 39, 1, 320000, '2023-08-09 02:22:54', '2023-08-09 02:22:54'),
(185, 'OND-0908232SBC', 42, 1, 110000, '2023-08-09 02:22:54', '2023-08-09 02:22:54'),
(186, 'OND-090823ET34', 3, 1, 4000, '2023-08-09 02:34:08', '2023-08-09 02:34:08'),
(187, 'OND-090823ET34', 5, 1, 5000, '2023-08-09 02:34:08', '2023-08-09 02:34:08'),
(188, 'OND-090823ET34', 4, 1, 15000, '2023-08-09 02:34:08', '2023-08-09 02:34:08'),
(189, 'OND-090823909G', 4, 2, 15000, '2023-08-09 02:36:23', '2023-08-09 02:36:23'),
(190, 'OND-090823909G', 13, 1, 4000, '2023-08-09 02:36:23', '2023-08-09 02:36:23'),
(191, 'OND-090823909G', 5, 2, 5000, '2023-08-09 02:36:23', '2023-08-09 02:36:23'),
(192, 'OND-090823909G', 3, 1, 4000, '2023-08-09 02:36:23', '2023-08-09 02:36:23'),
(193, 'OND-090823K42E', 42, 1, 110000, '2023-08-09 02:59:07', '2023-08-09 02:59:07'),
(194, 'OND-090823JF92', 44, 1, 4000, '2023-08-09 04:35:14', '2023-08-09 04:35:14'),
(195, 'OND-0908238787', 3, 1, 4000, '2023-08-09 08:17:55', '2023-08-09 08:17:55'),
(196, 'OND-0908238787', 4, 1, 15000, '2023-08-09 08:17:55', '2023-08-09 08:17:55'),
(197, 'OND-1708230VIS', 44, 20, 4000, '2023-08-17 02:20:23', '2023-08-17 02:20:23'),
(198, 'OND-170823Q9QS', 43, 5, 185000, '2023-08-17 02:51:52', '2023-08-17 02:51:52'),
(199, 'OND-1708231R2S', 42, 4, 110000, '2023-08-17 02:52:57', '2023-08-17 02:52:57'),
(200, 'OND-170823KS8P', 41, 3, 150000, '2023-08-17 02:53:14', '2023-08-17 02:53:14'),
(201, 'OND-170823A74R', 40, 2, 85000, '2023-08-17 02:53:41', '2023-08-17 02:53:41'),
(202, 'OND-170823NDK4', 37, 2, 220000, '2023-08-17 02:53:54', '2023-08-17 02:53:54'),
(203, 'OND-1708239C21', 37, 2, 220000, '2023-08-17 02:54:19', '2023-08-17 02:54:19'),
(204, 'OND-1708239C21', 36, 2, 5000, '2023-08-17 02:54:19', '2023-08-17 02:54:19'),
(205, 'OND-1708230YGQ', 44, 100, 4000, '2023-08-17 02:54:37', '2023-08-17 02:54:37'),
(206, 'OND-170823XSXZ', 34, 3, 45000, '2023-08-17 02:55:21', '2023-08-17 02:55:21'),
(207, 'OND-170823IW99', 29, 3, 20000, '2023-08-17 02:55:47', '2023-08-17 02:55:47'),
(208, 'OND-170823IW99', 28, 3, 20000, '2023-08-17 02:55:47', '2023-08-17 02:55:47'),
(209, 'OND-170823U844', 31, 11, 25000, '2023-08-17 03:00:17', '2023-08-17 03:00:17'),
(210, 'OND-1708232CJI', 29, 5, 20000, '2023-08-17 03:00:44', '2023-08-17 03:00:44'),
(211, 'OND-1708232CJI', 30, 3, 22000, '2023-08-17 03:00:44', '2023-08-17 03:00:44'),
(212, 'OND-170823272K', 31, 4, 25000, '2023-08-17 03:00:57', '2023-08-17 03:00:57'),
(213, 'OND-170823U10E', 29, 4, 20000, '2023-08-17 03:01:31', '2023-08-17 03:01:31'),
(214, 'OND-170823U10E', 31, 3, 25000, '2023-08-17 03:01:31', '2023-08-17 03:01:31'),
(215, 'OND-1708232WIF', 37, 3, 220000, '2023-08-17 03:01:45', '2023-08-17 03:01:45'),
(216, 'OND-1708232WIF', 38, 1, 186000, '2023-08-17 03:01:45', '2023-08-17 03:01:45'),
(217, 'OND-1708235639', 31, 4, 25000, '2023-08-17 03:02:09', '2023-08-17 03:02:09'),
(218, 'OND-1708235639', 33, 5, 30000, '2023-08-17 03:02:09', '2023-08-17 03:02:09'),
(219, 'OND-170823KC03', 37, 1, 220000, '2023-08-17 03:02:22', '2023-08-17 03:02:22'),
(220, 'OND-170823KC03', 39, 3, 320000, '2023-08-17 03:02:22', '2023-08-17 03:02:22'),
(221, 'OND-1708233D7R', 43, 3, 185000, '2023-08-17 03:02:47', '2023-08-17 03:02:47'),
(222, 'OND-1708234X86', 38, 1, 186000, '2023-08-17 03:03:01', '2023-08-17 03:03:01'),
(223, 'OND-1708234X86', 40, 4, 85000, '2023-08-17 03:03:01', '2023-08-17 03:03:01'),
(224, 'OND-1708236PMW', 33, 4, 30000, '2023-08-17 03:03:23', '2023-08-17 03:03:23'),
(225, 'OND-1708236PMW', 32, 3, 25000, '2023-08-17 03:03:23', '2023-08-17 03:03:23'),
(226, 'OND-170823GGSQ', 5, 11, 5000, '2023-08-17 03:03:42', '2023-08-17 03:03:42'),
(227, 'OND-170823GGSQ', 4, 13, 15000, '2023-08-17 03:03:42', '2023-08-17 03:03:42'),
(228, 'OND-170823TSWQ', 31, 4, 25000, '2023-08-17 03:04:06', '2023-08-17 03:04:06'),
(229, 'OND-170823TSWQ', 29, 3, 20000, '2023-08-17 03:04:06', '2023-08-17 03:04:06'),
(230, 'OND-17082388WT', 14, 3, 25000, '2023-08-17 03:04:22', '2023-08-17 03:04:22'),
(231, 'OND-17082388WT', 4, 3, 15000, '2023-08-17 03:04:22', '2023-08-17 03:04:22'),
(232, 'OND-17082377CU', 42, 3, 110000, '2023-08-17 03:04:47', '2023-08-17 03:04:47'),
(233, 'OND-17082377CU', 40, 2, 85000, '2023-08-17 03:04:47', '2023-08-17 03:04:47'),
(234, 'OND-1708237PG2', 3, 2, 4000, '2023-08-17 03:05:07', '2023-08-17 03:05:07'),
(235, 'OND-1708237PG2', 14, 9, 25000, '2023-08-17 03:05:07', '2023-08-17 03:05:07'),
(236, 'OND-170823ECUM', 33, 5, 30000, '2023-08-17 03:06:20', '2023-08-17 03:06:20'),
(237, 'OND-170823ECUM', 34, 3, 45000, '2023-08-17 03:06:20', '2023-08-17 03:06:20'),
(238, 'OND-170823WQ9X', 14, 4, 25000, '2023-08-17 03:06:35', '2023-08-17 03:06:35'),
(239, 'OND-170823WQ9X', 28, 4, 20000, '2023-08-17 03:06:35', '2023-08-17 03:06:35'),
(240, 'OND-170823TX4Y', 43, 5, 185000, '2023-08-17 03:06:54', '2023-08-17 03:06:54'),
(241, 'OND-1708234PTH', 32, 6, 25000, '2023-08-17 03:07:07', '2023-08-17 03:07:07'),
(242, 'OND-1708234PTH', 34, 4, 45000, '2023-08-17 03:07:07', '2023-08-17 03:07:07'),
(243, 'OND-170823R763', 42, 7, 110000, '2023-08-17 03:07:33', '2023-08-17 03:07:33'),
(244, 'OND-170823M394', 44, 200, 4000, '2023-08-17 03:07:51', '2023-08-17 03:07:51'),
(245, 'OND-170823C74G', 43, 5, 185000, '2023-08-17 03:08:13', '2023-08-17 03:08:13'),
(246, 'OND-1708232XKI', 32, 4, 25000, '2023-08-17 03:08:26', '2023-08-17 03:08:26'),
(247, 'OND-1708232XKI', 34, 3, 45000, '2023-08-17 03:08:26', '2023-08-17 03:08:26'),
(248, 'OND-170823M5M2', 30, 8, 22000, '2023-08-17 03:08:52', '2023-08-17 03:08:52'),
(249, 'OND-170823M5M2', 29, 5, 20000, '2023-08-17 03:08:52', '2023-08-17 03:08:52'),
(250, 'OND-170823CFS5', 42, 1, 110000, '2023-08-17 03:46:07', '2023-08-17 03:46:07'),
(251, 'OND-1708239P2I', 32, 1, 25000, '2023-08-17 13:39:26', '2023-08-17 13:39:26'),
(252, 'OND-1708239P2I', 36, 1, 5000, '2023-08-17 13:39:26', '2023-08-17 13:39:26'),
(253, 'OND-1708239P2I', 5, 1, 5000, '2023-08-17 13:39:26', '2023-08-17 13:39:26'),
(254, 'OND-180823P6FZ', 5, 1, 5000, '2023-08-18 00:54:22', '2023-08-18 00:54:22'),
(255, 'OND-180823P6FZ', 44, 2, 4000, '2023-08-18 00:54:22', '2023-08-18 00:54:22'),
(256, 'OND-180823AT90', 42, 1, 110000, '2023-08-18 03:12:53', '2023-08-18 03:12:53'),
(257, 'OND-180823AT90', 43, 1, 185000, '2023-08-18 03:12:53', '2023-08-18 03:12:53'),
(258, 'OND-180823M3Z9', 3, 1, 4000, '2023-08-18 03:15:18', '2023-08-18 03:15:18'),
(259, 'OND-180823M3Z9', 5, 1, 5000, '2023-08-18 03:15:18', '2023-08-18 03:15:18'),
(260, 'OND-1808230ZHT', 44, 1, 4000, '2023-08-18 06:04:36', '2023-08-18 06:04:36'),
(261, 'OND-1808230ZHT', 36, 1, 5000, '2023-08-18 06:04:36', '2023-08-18 06:04:36'),
(262, 'OND-1808230ZHT', 42, 1, 110000, '2023-08-18 06:04:36', '2023-08-18 06:04:36'),
(263, 'OND-230823IB6T', 14, 1, 25000, '2023-08-23 04:30:48', '2023-08-23 04:30:48'),
(264, 'OND-230823IB6T', 36, 1, 5000, '2023-08-23 04:30:48', '2023-08-23 04:30:48'),
(265, 'OND-230823339R', 5, 3, 5000, '2023-08-23 04:48:15', '2023-08-23 04:48:15'),
(266, 'OND-2308236RO5', 3, 1, 4000, '2023-08-23 04:50:28', '2023-08-23 04:50:28'),
(267, 'OND-23082341X4', 28, 4, 20000, '2023-08-23 06:46:15', '2023-08-23 06:46:15'),
(268, 'OND-23082341X4', 29, 1, 20000, '2023-08-23 06:46:15', '2023-08-23 06:46:15'),
(269, 'OND-23082341X4', 33, 1, 30000, '2023-08-23 06:46:15', '2023-08-23 06:46:15'),
(270, 'OND-23082341X4', 37, 10, 220000, '2023-08-23 06:46:15', '2023-08-23 06:46:15'),
(271, 'OND-2308233536', 3, 2, 4000, '2023-08-23 13:43:49', '2023-08-23 13:43:49'),
(272, 'OND-2308233536', 28, 9, 20000, '2023-08-23 13:43:49', '2023-08-23 13:43:49'),
(273, 'OND-240823GJ5J', 36, 1, 5000, '2023-08-24 01:00:07', '2023-08-24 01:00:07'),
(274, 'OND-240823GJ5J', 31, 1, 25000, '2023-08-24 01:00:07', '2023-08-24 01:00:07'),
(275, 'OND-240823GJ5J', 4, 1, 15000, '2023-08-24 01:00:07', '2023-08-24 01:00:07'),
(276, 'OND-240823H9E1', 34, 1, 45000, '2023-08-24 01:04:21', '2023-08-24 01:04:21'),
(277, 'OND-240823H9E1', 32, 1, 25000, '2023-08-24 01:04:21', '2023-08-24 01:04:21'),
(278, 'OND-24082356IX', 42, 1, 110000, '2023-08-24 01:11:37', '2023-08-24 01:11:37'),
(279, 'OND-240823LSYT', 42, 1, 110000, '2023-08-24 01:41:43', '2023-08-24 01:41:43'),
(280, 'OND-290823LGU0', 30, 1, 22000, '2023-08-29 13:07:56', '2023-08-29 13:07:56'),
(281, 'OND-290823LGU0', 36, 2, 5000, '2023-08-29 13:07:56', '2023-08-29 13:07:56'),
(282, 'OND-290823O77Q', 44, 1, 4000, '2023-08-29 13:23:59', '2023-08-29 13:23:59'),
(283, 'OND-290823O77Q', 18, 1, 5000, '2023-08-29 13:23:59', '2023-08-29 13:23:59'),
(284, 'OND-310823W9AM', 29, 1, 20000, '2023-08-31 09:57:36', '2023-08-31 09:57:36'),
(285, 'OND-310823G85S', 44, 1, 4000, '2023-08-31 10:17:01', '2023-08-31 10:17:01'),
(286, 'OND-310823XPLP', 42, 1, 110000, '2023-08-31 10:18:57', '2023-08-31 10:18:57'),
(287, 'OND-3108237G2A', 43, 1, 185000, '2023-08-31 10:21:32', '2023-08-31 10:21:32'),
(288, 'OND-310823UXW3', 42, 1, 110000, '2023-08-31 10:36:30', '2023-08-31 10:36:30'),
(289, 'OND-310823UXW3', 34, 3, 45000, '2023-08-31 10:36:30', '2023-08-31 10:36:30'),
(290, 'OND-310823UXW3', 32, 2, 25000, '2023-08-31 10:36:30', '2023-08-31 10:36:30'),
(291, 'OND-310823TZU5', 31, 1, 25000, '2023-08-31 10:43:32', '2023-08-31 10:43:32'),
(292, 'OND-310823TZU5', 32, 2, 25000, '2023-08-31 10:43:32', '2023-08-31 10:43:32'),
(293, 'OND-310823TZU5', 30, 2, 22000, '2023-08-31 10:43:32', '2023-08-31 10:43:32'),
(294, 'OND-310823LFYY', 40, 1, 85000, '2023-08-31 11:01:51', '2023-08-31 11:01:51'),
(295, 'OND-310823LFYY', 38, 1, 186000, '2023-08-31 11:01:51', '2023-08-31 11:01:51'),
(296, 'OND-010923O04B', 34, 1, 45000, '2023-08-31 23:33:44', '2023-08-31 23:33:44'),
(297, 'OND-010923O04B', 32, 3, 25000, '2023-08-31 23:33:44', '2023-08-31 23:33:44'),
(298, 'OND-010923LWQ4', 34, 1, 45000, '2023-09-01 00:01:20', '2023-09-01 00:01:20'),
(299, 'OND-010923LWQ4', 40, 2, 85000, '2023-09-01 00:01:20', '2023-09-01 00:01:20'),
(300, 'OND-010923LWQ4', 44, 2, 4000, '2023-09-01 00:01:20', '2023-09-01 00:01:20'),
(301, 'OND-01092384I3', 40, 2, 85000, '2023-09-01 00:08:56', '2023-09-01 00:08:56'),
(302, 'OND-01092384I3', 34, 2, 45000, '2023-09-01 00:08:56', '2023-09-01 00:08:56'),
(303, 'OND-01092384I3', 32, 1, 25000, '2023-09-01 00:08:56', '2023-09-01 00:08:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `payment_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `online_order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `offline_order_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_status` enum('pending','expired','success','failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`payment_id`, `online_order_id`, `offline_order_id`, `payment_status`, `created_at`, `updated_at`) VALUES
('PYM-0109237D2D', 'OND-010923O04B', NULL, 'success', '2023-08-31 23:33:44', '2023-08-31 23:33:44'),
('PYM-010923N212', 'OND-010923LWQ4', NULL, 'success', '2023-09-01 00:01:20', '2023-09-01 00:01:20'),
('PYM-010923VEWQ', 'OND-01092384I3', NULL, 'success', '2023-09-01 00:08:56', '2023-09-01 00:10:12'),
('PYM-0908230213', 'OND-090823E6IW', NULL, 'failed', '2023-08-09 02:21:13', '2023-08-09 02:25:24'),
('PYM-0908231B6N', 'OND-0908232SBC', NULL, 'success', '2023-08-09 02:22:54', '2023-08-09 02:22:54'),
('PYM-0908231U0Q', 'OND-090823909G', NULL, 'success', '2023-08-09 02:36:23', '2023-08-09 02:36:23'),
('PYM-0908231U85', NULL, 'OFD-0908235022', 'success', '2023-08-09 02:49:23', '2023-08-09 02:51:09'),
('PYM-0908232U9O', 'OND-0908238Y41', NULL, 'success', '2023-08-08 22:38:21', '2023-08-08 22:38:21'),
('PYM-0908233042', 'OND-09082386H8', NULL, 'success', '2023-08-09 02:16:05', '2023-08-09 02:16:05'),
('PYM-0908233Y3Q', NULL, 'OFD-0908233F16', 'success', '2023-08-09 02:51:03', '2023-08-09 02:51:03'),
('PYM-09082363FS', 'OND-0908238787', NULL, 'failed', '2023-08-09 08:17:55', '2023-08-17 06:50:51'),
('PYM-0908236T9F', 'OND-090823K42E', NULL, 'pending', '2023-08-09 02:59:07', '2023-08-09 02:59:07'),
('PYM-090823706Z', 'OND-090823ET34', NULL, 'success', '2023-08-09 02:34:08', '2023-08-09 02:34:08'),
('PYM-0908237J41', 'OND-0908238TUD', NULL, 'success', '2023-08-09 02:16:51', '2023-08-09 02:16:51'),
('PYM-09082385NE', 'OND-0908233DU0', NULL, 'success', '2023-08-08 22:37:31', '2023-08-08 22:37:31'),
('PYM-0908238BQH', NULL, 'OFD-0908231NR6', 'success', '2023-08-09 02:48:53', '2023-08-09 02:51:11'),
('PYM-0908238DR1', 'OND-0908236C96', NULL, 'success', '2023-08-09 02:11:00', '2023-08-09 02:11:00'),
('PYM-0908238Q93', NULL, 'OFD-090823MXZ6', 'success', '2023-08-09 03:09:39', '2023-08-09 03:21:41'),
('PYM-09082392T8', NULL, 'OFD-090823MXZ6', 'pending', '2023-08-09 03:09:38', '2023-08-09 03:09:38'),
('PYM-090823941I', 'OND-09082349S7', NULL, 'success', '2023-08-09 02:14:00', '2023-08-09 02:14:00'),
('PYM-0908239631', 'OND-090823786W', NULL, 'success', '2023-08-08 22:35:21', '2023-08-08 22:35:21'),
('PYM-090823B0SC', 'OND-090823MHIB', NULL, 'success', '2023-08-09 02:20:31', '2023-08-09 02:20:31'),
('PYM-090823DF24', 'OND-090823Y505', NULL, 'success', '2023-08-09 02:15:31', '2023-08-09 02:15:31'),
('PYM-090823ELZ2', 'OND-0908238537', NULL, 'success', '2023-08-08 22:36:22', '2023-08-08 22:36:22'),
('PYM-090823FPW3', NULL, 'OFD-090823982N', 'success', '2023-08-09 02:49:56', '2023-08-09 02:51:06'),
('PYM-090823GD2K', 'OND-0908230UBL', NULL, 'success', '2023-08-09 02:18:37', '2023-08-09 02:18:37'),
('PYM-090823GKHR', 'OND-09082372E0', NULL, 'success', '2023-08-08 22:36:55', '2023-08-08 22:36:55'),
('PYM-090823GUD7', NULL, 'OFD-090823JUJZ', 'success', '2023-08-09 03:28:05', '2023-08-09 03:28:34'),
('PYM-090823I012', 'OND-090823GHW1', NULL, 'success', '2023-08-09 02:13:28', '2023-08-09 02:13:28'),
('PYM-090823I71C', NULL, 'OFD-090823982N', 'pending', '2023-08-09 02:49:55', '2023-08-09 02:49:55'),
('PYM-090823IY71', NULL, 'OFD-090823G248', 'success', '2023-08-09 02:51:01', '2023-08-09 02:51:01'),
('PYM-090823M402', 'OND-090823CB6H', NULL, 'success', '2023-08-09 02:21:56', '2023-08-09 02:21:56'),
('PYM-090823PH28', 'OND-090823ATGS', NULL, 'success', '2023-08-09 02:17:19', '2023-08-09 02:17:19'),
('PYM-090823Q6BD', 'OND-09082324I9', NULL, 'success', '2023-08-09 02:19:07', '2023-08-09 02:19:07'),
('PYM-090823R8KQ', 'OND-090823V4T0', NULL, 'success', '2023-08-09 02:19:55', '2023-08-09 02:19:55'),
('PYM-090823S5RS', 'OND-0908236N9W', NULL, 'success', '2023-08-09 02:10:26', '2023-08-09 02:10:26'),
('PYM-090823U1E0', NULL, 'OFD-090823982N', 'pending', '2023-08-09 02:49:54', '2023-08-09 02:49:54'),
('PYM-090823U866', 'OND-090823L15L', NULL, 'success', '2023-08-09 02:12:44', '2023-08-09 02:12:44'),
('PYM-090823UFA1', 'OND-090823JF92', NULL, 'pending', '2023-08-09 04:35:14', '2023-08-09 04:35:14'),
('PYM-090823VD06', 'OND-090823Q0R9', NULL, 'success', '2023-08-09 02:12:10', '2023-08-09 02:12:10'),
('PYM-090823WYC1', NULL, 'OFD-090823Y511', 'success', '2023-08-09 03:18:54', '2023-08-09 03:19:18'),
('PYM-17082302JB', 'OND-1708232WIF', NULL, 'success', '2023-08-17 03:01:45', '2023-08-17 03:34:49'),
('PYM-1708230FFZ', 'OND-170823KS8P', NULL, 'success', '2023-08-17 02:53:14', '2023-08-17 03:33:04'),
('PYM-1708230QUB', 'OND-1708235639', NULL, 'success', '2023-08-17 03:02:09', '2023-08-17 03:34:25'),
('PYM-1708230RG6', 'OND-1708231R2S', NULL, 'success', '2023-08-17 02:52:57', '2023-08-17 03:33:21'),
('PYM-17082322S2', NULL, 'OFD-1708238202', 'success', '2023-08-17 07:27:07', '2023-08-17 07:29:26'),
('PYM-1708232853', 'OND-170823NDK4', NULL, 'success', '2023-08-17 02:53:54', '2023-08-17 03:33:00'),
('PYM-1708232G20', 'OND-170823M5M2', NULL, 'success', '2023-08-17 03:08:52', '2023-08-17 03:33:56'),
('PYM-17082335L2', 'OND-170823TX4Y', NULL, 'success', '2023-08-17 03:06:54', '2023-08-17 03:33:48'),
('PYM-1708233PZ4', 'OND-1708232CJI', NULL, 'success', '2023-08-17 03:00:44', '2023-08-17 03:34:46'),
('PYM-170823400I', NULL, 'OFD-170823CXYM', 'success', '2023-08-17 07:07:07', '2023-08-17 07:28:36'),
('PYM-17082343V5', NULL, 'OFD-170823KV93', 'success', '2023-08-17 07:26:25', '2023-08-17 07:29:24'),
('PYM-170823458P', 'OND-170823M394', NULL, 'success', '2023-08-17 03:07:51', '2023-08-17 03:33:58'),
('PYM-1708234SHS', 'OND-1708236PMW', NULL, 'success', '2023-08-17 03:03:23', '2023-08-17 03:34:43'),
('PYM-1708234UO0', 'OND-17082388WT', NULL, 'success', '2023-08-17 03:04:22', '2023-08-17 03:34:21'),
('PYM-1708235684', 'OND-170823CFS5', NULL, 'success', '2023-08-17 03:46:07', '2023-08-17 03:59:15'),
('PYM-1708235A85', 'OND-1708239P2I', NULL, 'failed', '2023-08-17 13:39:26', '2023-08-23 04:29:26'),
('PYM-1708235PB9', 'OND-170823U10E', NULL, 'success', '2023-08-17 03:01:31', '2023-08-17 03:33:45'),
('PYM-17082368PM', NULL, 'OFD-170823863M', 'success', '2023-08-17 07:16:47', '2023-08-17 07:29:08'),
('PYM-17082369J3', NULL, 'OFD-170823THU4', 'success', '2023-08-17 07:12:21', '2023-08-17 07:28:57'),
('PYM-1708236I46', NULL, 'OFD-1708230370', 'success', '2023-08-17 07:11:22', '2023-08-17 07:28:52'),
('PYM-1708236ISV', 'OND-17082377CU', NULL, 'success', '2023-08-17 03:04:47', '2023-08-17 03:34:39'),
('PYM-1708236S5S', 'OND-1708230YGQ', NULL, 'success', '2023-08-17 02:54:37', '2023-08-17 03:33:33'),
('PYM-1708238EJQ', 'OND-1708233D7R', NULL, 'success', '2023-08-17 03:02:47', '2023-08-17 03:33:52'),
('PYM-1708238WAE', NULL, 'OFD-170823BAP5', 'success', '2023-08-17 07:13:29', '2023-08-17 07:28:59'),
('PYM-170823978W', 'OND-1708237PG2', NULL, 'success', '2023-08-17 03:05:07', '2023-08-17 03:34:30'),
('PYM-1708239GO4', 'OND-170823KC03', NULL, 'success', '2023-08-17 03:02:22', '2023-08-17 03:34:04'),
('PYM-1708239JL2', NULL, 'OFD-170823WZL2', 'success', '2023-08-17 07:12:06', '2023-08-17 07:28:55'),
('PYM-1708239U29', NULL, 'OFD-170823P600', 'success', '2023-08-17 07:10:13', '2023-08-17 07:28:45'),
('PYM-170823B0SC', 'OND-1708234PTH', NULL, 'success', '2023-08-17 03:07:07', '2023-08-17 03:34:01'),
('PYM-170823B9V2', 'OND-170823R763', NULL, 'success', '2023-08-17 03:07:33', '2023-08-17 03:33:37'),
('PYM-170823BUV6', 'OND-1708234X86', NULL, 'success', '2023-08-17 03:03:01', '2023-08-17 03:34:16'),
('PYM-170823BXJ7', 'OND-170823Q9QS', NULL, 'success', '2023-08-17 02:51:52', '2023-08-17 03:32:57'),
('PYM-170823CA0T', 'OND-170823IW99', NULL, 'success', '2023-08-17 02:55:47', '2023-08-17 03:33:08'),
('PYM-170823D3I1', 'OND-170823A74R', NULL, 'success', '2023-08-17 02:53:41', '2023-08-17 03:33:13'),
('PYM-170823E6O7', NULL, 'OFD-170823M4J2', 'success', '2023-08-17 07:14:50', '2023-08-17 07:29:03'),
('PYM-170823F2L6', NULL, 'OFD-170823ZNVD', 'success', '2023-08-17 07:06:11', '2023-08-17 07:28:34'),
('PYM-170823FYK9', NULL, 'OFD-170823NP2E', 'success', '2023-08-17 07:25:13', '2023-08-17 07:29:18'),
('PYM-170823H8NG', NULL, 'OFD-1708232H8X', 'success', '2023-08-17 07:17:21', '2023-08-17 07:29:10'),
('PYM-170823H9LW', 'OND-1708232XKI', NULL, 'success', '2023-08-17 03:08:26', '2023-08-17 03:34:52'),
('PYM-170823J8Z5', 'OND-170823272K', NULL, 'success', '2023-08-17 03:00:57', '2023-08-17 03:34:34'),
('PYM-170823J977', 'OND-170823ECUM', NULL, 'success', '2023-08-17 03:06:20', '2023-08-17 03:34:08'),
('PYM-170823JN72', 'OND-170823GGSQ', NULL, 'success', '2023-08-17 03:03:42', '2023-08-17 03:34:06'),
('PYM-170823JR4G', NULL, 'OFD-17082308X6', 'success', '2023-08-17 07:09:31', '2023-08-17 07:28:43'),
('PYM-170823L7Z5', 'OND-170823C74G', NULL, 'success', '2023-08-17 03:08:13', '2023-08-17 03:34:13'),
('PYM-170823N0D0', NULL, 'OFD-17082382RT', 'success', '2023-08-17 07:24:51', '2023-08-17 07:29:16'),
('PYM-170823N3E2', NULL, 'OFD-170823GMOU', 'success', '2023-08-17 07:10:21', '2023-08-17 07:28:47'),
('PYM-170823PG75', NULL, 'OFD-170823A6M3', 'success', '2023-08-17 07:15:39', '2023-08-17 07:29:06'),
('PYM-170823PLAW', 'OND-170823U844', NULL, 'success', '2023-08-17 03:00:17', '2023-08-17 03:33:43'),
('PYM-170823PTFD', NULL, 'OFD-1708239N8Q', 'success', '2023-08-17 07:18:12', '2023-08-17 07:29:13'),
('PYM-170823Q2IX', NULL, 'OFD-170823U0FC', 'success', '2023-08-17 10:15:54', '2023-08-27 00:06:31'),
('PYM-170823R254', NULL, 'OFD-1708233184', 'success', '2023-08-17 07:27:38', '2023-08-17 07:28:30'),
('PYM-170823RLV3', NULL, 'OFD-170823NV8T', 'success', '2023-08-17 07:08:42', '2023-08-17 07:28:40'),
('PYM-170823RW2V', NULL, 'OFD-1708230C53', 'success', '2023-08-17 07:13:48', '2023-08-17 07:29:01'),
('PYM-170823S10A', NULL, 'OFD-170823A512', 'success', '2023-08-17 07:08:13', '2023-08-17 07:28:38'),
('PYM-170823S2Z6', 'OND-1708230VIS', NULL, 'success', '2023-08-17 02:20:23', '2023-08-17 03:32:43'),
('PYM-170823S7AW', 'OND-170823TSWQ', NULL, 'success', '2023-08-17 03:04:06', '2023-08-17 03:33:54'),
('PYM-170823ULO3', 'OND-170823WQ9X', NULL, 'success', '2023-08-17 03:06:35', '2023-08-17 03:33:40'),
('PYM-170823V9C3', 'OND-1708239C21', NULL, 'success', '2023-08-17 02:54:19', '2023-08-17 03:33:16'),
('PYM-170823X1G2', NULL, 'OFD-17082342KZ', 'success', '2023-08-17 07:11:19', '2023-08-17 07:28:49'),
('PYM-170823XAGG', NULL, 'OFD-170823E3C4', 'pending', '2023-08-17 10:12:53', '2023-08-17 10:12:53'),
('PYM-170823YUU8', NULL, 'OFD-170823N6M1', 'success', '2023-08-17 07:25:55', '2023-08-17 07:29:20'),
('PYM-170823Z8GO', 'OND-170823XSXZ', NULL, 'success', '2023-08-17 02:55:21', '2023-08-17 03:33:35'),
('PYM-1808232E60', NULL, 'OFD-180823EM3A', 'success', '2023-08-18 06:09:25', '2023-08-18 06:10:29'),
('PYM-1808232KYE', NULL, 'OFD-1808231257', 'success', '2023-08-18 03:18:03', '2023-08-23 03:57:36'),
('PYM-18082361Q8', 'OND-1808230ZHT', NULL, 'success', '2023-08-18 06:04:36', '2023-08-18 06:05:09'),
('PYM-1808236Y42', 'OND-180823AT90', NULL, 'success', '2023-08-18 03:12:53', '2023-08-18 03:13:31'),
('PYM-180823GS5S', 'OND-180823P6FZ', NULL, 'success', '2023-08-18 00:54:22', '2023-08-18 00:55:27'),
('PYM-180823Q09G', NULL, 'OFD-1808233A2C', 'success', '2023-08-18 01:04:22', '2023-08-18 01:05:14'),
('PYM-180823UU4P', 'OND-180823M3Z9', NULL, 'success', '2023-08-18 03:15:18', '2023-08-18 03:15:49'),
('PYM-2308230398', 'OND-23082341X4', NULL, 'success', '2023-08-23 06:46:15', '2023-08-23 10:20:47'),
('PYM-2308230553', 'OND-2308233536', NULL, 'success', '2023-08-23 13:43:49', '2023-08-23 13:44:23'),
('PYM-23082359B0', NULL, 'OFD-230823CV4M', 'success', '2023-08-23 06:44:59', '2023-08-27 00:06:22'),
('PYM-230823M422', 'OND-2308236RO5', NULL, 'success', '2023-08-23 04:50:28', '2023-08-23 05:07:48'),
('PYM-230823N067', 'OND-230823339R', NULL, 'failed', '2023-08-23 04:48:15', '2023-08-23 04:49:56'),
('PYM-230823TP8B', 'OND-230823IB6T', NULL, 'success', '2023-08-23 04:30:48', '2023-08-23 04:39:44'),
('PYM-230823X0E4', NULL, 'OFD-23082313G2', 'success', '2023-08-23 03:57:21', '2023-08-23 03:57:21'),
('PYM-24082339L1', 'OND-240823LSYT', NULL, 'pending', '2023-08-24 01:41:43', '2023-08-24 01:41:43'),
('PYM-240823A3E2', 'OND-240823GJ5J', NULL, 'success', '2023-08-24 01:00:07', '2023-08-24 01:03:26'),
('PYM-240823T4A5', 'OND-240823H9E1', NULL, 'pending', '2023-08-24 01:04:21', '2023-08-24 01:04:21'),
('PYM-240823X93L', 'OND-24082356IX', NULL, 'pending', '2023-08-24 01:11:37', '2023-08-24 01:11:37'),
('PYM-27082360AG', NULL, 'OFD-2708232JD3', 'pending', '2023-08-27 01:33:43', '2023-08-27 01:33:43'),
('PYM-270823KHZR', NULL, 'OFD-270823VD77', 'pending', '2023-08-27 01:35:53', '2023-08-27 01:35:53'),
('PYM-270823PH8V', NULL, 'OFD-230823G2AC', 'success', '2023-08-27 00:05:56', '2023-08-27 00:06:26'),
('PYM-2908235Y3Z', 'OND-290823O77Q', NULL, 'success', '2023-08-29 13:23:59', '2023-08-29 13:58:57'),
('PYM-2908238I9Q', 'OND-290823LGU0', NULL, 'pending', '2023-08-29 13:07:56', '2023-08-29 13:07:56'),
('PYM-310823800D', 'OND-310823W9AM', NULL, 'success', '2023-08-31 09:57:36', '2023-08-31 09:57:36'),
('PYM-310823AKR2', 'OND-3108237G2A', NULL, 'success', '2023-08-31 10:21:32', '2023-08-31 10:22:06'),
('PYM-310823DN9B', 'OND-310823UXW3', NULL, 'success', '2023-08-31 10:36:31', '2023-08-31 10:37:55'),
('PYM-310823N975', 'OND-310823G85S', NULL, 'success', '2023-08-31 10:17:01', '2023-08-31 10:17:35'),
('PYM-310823O211', 'OND-310823TZU5', NULL, 'success', '2023-08-31 10:43:32', '2023-08-31 10:44:04'),
('PYM-310823PT16', 'OND-310823XPLP', NULL, 'expired', '2023-08-31 10:18:57', '2023-08-31 10:38:31'),
('PYM-310823TV85', 'OND-310823LFYY', NULL, 'success', '2023-08-31 11:01:51', '2023-08-31 11:01:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_general_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_of_raw_materials`
--

CREATE TABLE `purchase_of_raw_materials` (
  `purchase_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `raw_material_id` bigint UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `unit_price` int UNSIGNED NOT NULL,
  `total` int UNSIGNED NOT NULL,
  `purchase_date` date NOT NULL,
  `supplier_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `purchase_of_raw_materials`
--

INSERT INTO `purchase_of_raw_materials` (`purchase_id`, `raw_material_id`, `quantity`, `unit_price`, `total`, `purchase_date`, `supplier_id`, `created_at`, `updated_at`) VALUES
('PCH-010123NVGZ', 2, 95, 16000, 152000, '2023-01-01', 2, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-010223KIVQ', 5, 87, 28000, 243600, '2023-02-01', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-010223OLNI', 5, 33, 18000, 594000, '2023-02-01', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-010523RZMI', 5, 91, 40000, 364000, '2023-05-01', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-020323VHWJ', 4, 87, 54000, 469800, '2023-03-02', 4, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-020423UEIZ', 1, 100, 26000, 200000, '2023-04-02', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-020523BLZR', 6, 60, 26000, 160000, '2023-05-02', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-020623YTSJ', 5, 32, 52000, 164000, '2023-06-02', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-030223OUZU', 5, 81, 46000, 36000, '2023-02-03', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-030423VMWM', 5, 46, 46000, 216000, '2023-04-03', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-030523DUAY', 1, 33, 42000, 1386000, '2023-05-03', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-030623JEGC', 5, 72, 40000, 280000, '2023-06-03', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-030723TIPO', 5, 45, 32000, 1440000, '2023-07-03', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-040123TZOH', 6, 36, 24000, 864000, '2023-01-04', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-040823EGUU', 6, 50, 40000, 200000, '2023-08-04', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-040823GGHZ', 6, 58, 14000, 812000, '2023-08-04', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-050123VJJU', 3, 2000, 300, 600000, '2023-01-05', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-050523DLDU', 2, 70, 50000, 300000, '2023-05-05', 2, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-050723IQLB', 4, 35, 12000, 420000, '2023-07-05', 4, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-050723ULYC', 3, 1000, 350, 350000, '2023-07-05', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-050723WRFR', 6, 37, 20000, 740000, '2023-07-05', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-060123JCJS', 1, 83, 38000, 3154000, '2023-01-06', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-060323MPYR', 5, 47, 30000, 1410000, '2023-03-06', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-060423QXVM', 2, 76, 20000, 1520000, '2023-04-06', 2, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-060723KKUG', 4, 44, 46000, 224000, '2023-07-06', 4, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-060823TOKM', 1, 28, 14000, 392000, '2023-08-06', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-060823ZOVI', 2, 75, 54000, 405000, '2023-08-06', 2, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-070323ILVC', 5, 86, 54000, 444000, '2023-03-07', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-070323POMJ', 5, 93, 28000, 204000, '2023-03-07', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-070523KUQO', 4, 32, 20000, 640000, '2023-05-07', 4, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-070623QIXD', 4, 82, 50000, 4100000, '2023-06-07', 4, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-070823OJXT', 4, 94, 46000, 432400, '2023-08-07', 4, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-080323WRVD', 5, 63, 34000, 242000, '2023-03-08', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-080423EMCA', 5, 44, 18000, 792000, '2023-04-08', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-080523FDJQ', 1, 47, 12000, 564000, '2023-05-08', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-080623HONY', 1, 51, 24000, 124000, '2023-06-08', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-080623KFBQ', 1, 91, 50000, 450000, '2023-06-08', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-080723IXCA', 4, 67, 44000, 248000, '2023-07-08', 4, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-080723WDZH', 1, 36, 24000, 864000, '2023-07-08', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-090123BLQX', 6, 73, 50000, 3650000, '2023-01-09', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-090123VTTM', 5, 55, 18000, 990000, '2023-01-09', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-090223VTLS', 6, 84, 40000, 3360000, '2023-02-09', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-090623KZOM', 3, 2000, 300, 600000, '2023-06-09', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-090623RNLV', 1, 47, 28000, 116000, '2023-06-09', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-090723YSKV', 6, 83, 34000, 222000, '2023-07-09', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-100323HVNT', 2, 45, 24000, 180000, '2023-03-10', 2, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-100323NGGY', 5, 29, 42000, 1218000, '2023-03-10', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-100723PGWN', 6, 26, 44000, 144000, '2023-07-10', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-110123UYZB', 5, 37, 44000, 128000, '2023-01-11', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-110223NZIA', 5, 85, 26000, 221000, '2023-02-11', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-110223VGAK', 3, 2000, 350, 700000, '2023-02-11', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-110323WLET', 5, 31, 24000, 744000, '2023-03-11', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-110323ZTQP', 1, 89, 54000, 4806000, '2023-03-11', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-120123MSAY', 4, 58, 42000, 2436000, '2023-01-12', 4, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-120523KQLT', 3, 1000, 300, 300000, '2023-05-12', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-120823HMXW', 2, 28, 50000, 1100000, '2023-08-12', 2, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-130323JQAE', 4, 70, 46000, 320000, '2023-03-13', 4, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-130523JAJJ', 1, 77, 44000, 338000, '2023-05-13', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-130623DHUG', 3, 1000, 350, 350000, '2023-06-13', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-130723PFZD', 1, 43, 38000, 164000, '2023-07-13', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-130723QCGF', 6, 68, 44000, 2992000, '2023-07-13', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-140123BNVT', 2, 90, 22000, 1980000, '2023-01-14', 2, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-140223YCOH', 2, 99, 16000, 1584000, '2023-02-14', 2, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-140223ZTJX', 3, 2000, 350, 700000, '2023-02-14', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-140823BPZY', 2, 80, 20000, 100000, '2023-08-14', 2, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-150123EJOI', 1, 72, 24000, 128000, '2023-01-15', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-150323FDIT', 1, 78, 38000, 2964000, '2023-03-15', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-150423JHRC', 6, 36, 26000, 936000, '2023-04-15', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-150523EZXR', 1, 95, 48000, 456000, '2023-05-15', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-150823EAUE', 5, 63, 38000, 294000, '2023-08-15', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-160123IIPY', 5, 98, 34000, 332000, '2023-01-16', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-160723SFQI', 6, 36, 10000, 360000, '2023-07-16', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-170123USDG', 6, 42, 28000, 1176000, '2023-01-17', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-170323YYBR', 3, 1000, 350, 350000, '2023-03-17', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-170623SVFB', 2, 99, 12000, 1188000, '2023-06-17', 2, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-180523KLYS', 4, 67, 42000, 214000, '2023-05-18', 4, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-190123WGPN', 2, 58, 44000, 252000, '2023-01-19', 2, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-190523LJHI', 3, 1000, 300, 300000, '2023-05-19', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-200123LQXM', 5, 36, 36000, 1296000, '2023-01-20', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-200323YJEP', 4, 94, 48000, 4512000, '2023-03-20', 4, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-200423EFPV', 5, 40, 22000, 880000, '2023-04-20', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-200623ODAJ', 3, 1000, 350, 350000, '2023-06-20', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-210223ILMM', 1, 43, 54000, 232000, '2023-02-21', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-210223PPRO', 3, 1000, 300, 300000, '2023-02-21', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-210423JDSI', 1, 41, 40000, 1640000, '2023-04-21', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-210623CDYF', 6, 68, 36000, 248000, '2023-06-21', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-210623QDFI', 3, 1000, 350, 350000, '2023-06-21', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-220123RTVS', 6, 76, 16000, 1216000, '2023-01-22', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-220423GBND', 3, 1000, 300, 300000, '2023-04-22', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-230223XACK', 5, 59, 36000, 212000, '2023-02-23', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-230423ABFO', 3, 1000, 350, 350000, '2023-04-23', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-230623JWUJ', 1, 48, 54000, 2592000, '2023-06-23', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-230723IQCD', 4, 39, 10000, 390000, '2023-07-23', 4, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-230723ZHHI', 3, 2000, 350, 700000, '2023-07-23', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-240223NSRM', 2, 99, 40000, 396000, '2023-02-24', 2, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-240323JZVJ', 2, 87, 26000, 226000, '2023-03-24', 2, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-250123BFOZ', 3, 2000, 300, 600000, '2023-01-25', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-250123IIFA', 3, 1000, 300, 300000, '2023-01-25', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-250123TWYR', 5, 54, 48000, 259000, '2023-01-25', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-250223XHPR', 1, 39, 50000, 190000, '2023-02-25', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-250323HXJA', 4, 88, 48000, 4224000, '2023-03-25', 4, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-260423XFJI', 5, 25, 24000, 600000, '2023-04-26', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-260623AEQU', 4, 34, 20000, 680000, '2023-06-26', 4, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-270123HNQQ', 6, 42, 44000, 1848000, '2023-01-27', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-270123HQZR', 3, 2000, 350, 700000, '2023-01-27', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-270223WAPO', 6, 44, 36000, 1584000, '2023-02-27', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-270323JFVY', 1, 90, 38000, 3420000, '2023-03-27', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-270423FGKI', 5, 31, 46000, 1426000, '2023-04-27', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-270523LTDU', 6, 86, 36000, 3096000, '2023-05-27', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-270523VHWZ', 4, 50, 14000, 700000, '2023-05-27', 4, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-270623BTCJ', 6, 91, 50000, 4550000, '2023-06-27', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-280123WBWT', 6, 34, 12000, 408000, '2023-01-28', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-280223JWVS', 6, 28, 48000, 1344000, '2023-02-28', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-280223TKMZ', 5, 54, 52000, 2808000, '2023-02-28', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-280323EWZO', 6, 51, 32000, 1632000, '2023-03-28', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-280323FSMM', 3, 2000, 300, 600000, '2023-03-28', 3, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-280523PXWJ', 4, 40, 12000, 480000, '2023-05-28', 4, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-280523SNWY', 1, 55, 10000, 550000, '2023-05-28', 1, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-280623MWUD', 6, 77, 42000, 3234000, '2023-06-28', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-290123JQJB', 2, 64, 50000, 3200000, '2023-01-29', 2, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-290423ZWGZ', 4, 79, 12000, 948000, '2023-04-29', 4, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-290623VFTU', 5, 87, 50000, 4350000, '2023-06-29', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-290723HFIU', 2, 61, 42000, 2562000, '2023-07-29', 2, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-290723NRWB', 4, 93, 44000, 4092000, '2023-07-29', 4, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-290723WPHO', 2, 95, 12000, 1140000, '2023-07-29', 2, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-300123CHVU', 6, 60, 54000, 3240000, '2023-01-30', 6, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-300423NQVF', 5, 34, 12000, 408000, '2023-04-30', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-300623PXJI', 2, 51, 48000, 2448000, '2023-06-30', 2, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-300623RSQR', 5, 26, 42000, 1092000, '2023-06-30', 5, '2023-08-16 13:53:27', '2023-08-16 13:53:27'),
('PCH-300723BJLC', 2, 35, 16000, 560000, '2023-07-30', 2, '2023-08-16 13:53:27', '2023-08-16 13:53:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `raw_materials`
--

CREATE TABLE `raw_materials` (
  `id` bigint NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `stock` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `raw_materials`
--

INSERT INTO `raw_materials` (`id`, `name`, `unit`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'Kulit Lumpia Abu Hafidz', 'bungkus', 40, '2023-08-16 13:00:17', '2023-08-16 13:00:17'),
(2, 'Beras Basmati Daawat', 'kg', 35, '2023-08-16 13:01:46', '2023-08-16 13:01:46'),
(3, 'Kapulaga', 'gr', 1000, '2023-08-16 13:03:46', '2023-08-16 13:03:46'),
(4, 'Ayam Potong', 'kg', 10, '2023-08-16 13:04:39', '2023-08-16 13:04:39'),
(5, 'Minyak Goreng 2L', 'bungkus', 12, '2023-08-16 13:05:24', '2023-08-16 13:05:24'),
(6, 'Beras Biasa', 'kg', 8, '2023-08-16 13:05:57', '2023-08-16 13:05:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `reservation_status` enum('pending','failed','success','process') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` bigint DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  `reservation_time` time DEFAULT NULL,
  `visit_time` time DEFAULT NULL,
  `finished_time` time DEFAULT NULL,
  `estimation_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `waiting` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `reservation_status`, `name`, `phone`, `user_id`, `reservation_date`, `reservation_time`, `visit_time`, `finished_time`, `estimation_time`, `created_at`, `updated_at`, `waiting`) VALUES
('ROF-0908236X7V', 'success', 'Dendi Kusuma', NULL, NULL, '2023-07-06', '10:42:57', '10:44:25', '11:45:25', NULL, '2023-08-09 02:42:57', '2023-08-09 02:43:48', 0),
('ROF-0908239362', 'success', 'Rahmawati', NULL, NULL, '2023-08-17', '17:30:49', '17:36:05', '18:36:05', NULL, '2023-08-09 02:42:49', '2023-08-17 09:38:01', 0),
('ROF-0908239MZ2', 'success', 'Masni', NULL, NULL, '2023-08-05', '10:42:27', '10:44:32', '11:44:32', NULL, '2023-08-09 02:42:27', '2023-08-17 09:40:41', 0),
('ROF-090823T1R7', 'failed', 'Andirja', NULL, NULL, '2023-08-04', '10:42:43', '10:44:33', NULL, NULL, '2023-08-09 02:42:43', '2023-08-17 07:44:26', 0),
('ROF-090823VY3U', 'success', 'Muhammad Bakti', NULL, NULL, '2023-08-04', '10:42:35', '10:44:33', '11:45:20', '12:45:20', '2023-08-09 02:42:35', '2023-08-09 02:43:48', 0),
('ROF-1708230982', 'success', 'Desi Puspita', NULL, NULL, '2023-03-17', '16:56:56', '17:47:11', '19:18:11', NULL, '2023-08-17 08:56:56', '2023-08-17 09:08:50', 0),
('ROF-1708232LQI', 'success', 'Bima Nugraha', NULL, NULL, '2023-03-27', '16:57:09', '17:50:11', '18:18:11', NULL, '2023-08-17 08:57:09', '2023-08-17 09:08:39', 0),
('ROF-1708232UH8', 'success', 'Lita Purnama', NULL, NULL, '2023-06-01', '14:23:11', '15:00:11', '16:00:11', NULL, '2023-08-17 08:58:35', '2023-08-17 09:07:51', 0),
('ROF-1708234M43', 'success', 'Siska Amelia', NULL, NULL, '2023-03-02', '16:56:45', '17:22:11', '18:45:50', NULL, '2023-08-17 08:56:45', '2023-08-17 09:08:57', 0),
('ROF-1708234TA1', 'success', 'Dina Fitriani', NULL, NULL, '2023-02-11', '16:56:36', '17:21:11', '18:18:11', NULL, '2023-08-17 08:56:36', '2023-08-17 09:09:05', 0),
('ROF-1708235DK0', 'success', 'Maya Dewanti', NULL, NULL, '2023-07-03', '14:49:11', '15:11:11', '16:11:11', NULL, '2023-08-17 08:59:02', '2023-08-17 09:07:39', 0),
('ROF-17082367Z3', 'success', 'Sari Putri', NULL, NULL, '2023-07-10', '14:52:11', '15:11:11', '16:11:11', NULL, '2023-08-17 08:59:09', '2023-08-17 09:00:43', 0),
('ROF-170823698J', 'failed', 'Hana Pangestu', NULL, NULL, '2023-05-10', '12:41:11', '13:29:11', '14:29:11', NULL, '2023-08-17 08:58:13', '2023-08-17 09:14:55', 0),
('ROF-17082386Q2', 'success', 'Rani Indriani', NULL, NULL, '2023-01-01', '16:56:11', '17:00:11', '17:56:11', NULL, '2023-08-17 08:56:11', '2023-08-17 09:15:55', 0),
('ROF-1708239K65', 'success', 'Agung Santoso', NULL, NULL, '2023-03-23', '16:57:00', '17:41:11', '18:18:11', NULL, '2023-08-17 08:57:00', '2023-08-17 09:08:47', 0),
('ROF-170823B7I1', 'success', 'Nisa Nurul', NULL, NULL, '2023-06-10', '14:38:11', '15:29:11', '16:29:11', NULL, '2023-08-17 08:58:53', '2023-08-17 09:07:47', 0),
('ROF-170823C4G1', 'success', 'Eko Nugroho', NULL, NULL, '2023-04-17', '12:30:11', '13:00:11', '14:00:11', NULL, '2023-08-17 08:58:01', '2023-08-17 09:08:28', 0),
('ROF-170823CCL1', 'success', 'Citra Wardani', NULL, NULL, '2023-04-05', '16:57:52', '17:11:11', '18:11:11', NULL, '2023-08-17 08:57:52', '2023-08-17 09:08:33', 0),
('ROF-170823DM19', 'success', 'Galih Prasetyo', NULL, NULL, '2023-05-10', '12:30:11', '13:20:11', '14:46:41', NULL, '2023-08-17 08:58:08', '2023-08-17 09:08:19', 0),
('ROF-170823DQ4G', 'success', 'Irfan Hakim', NULL, NULL, '2023-05-17', '12:48:11', '13:48:11', '14:48:11', NULL, '2023-08-17 08:58:16', '2023-08-17 09:08:13', 0),
('ROF-170823EAKY', 'success', 'Rizki Ramadhan', NULL, NULL, '2023-03-02', '16:56:51', '17:45:11', '18:18:11', NULL, '2023-08-17 08:56:51', '2023-08-17 09:08:54', 0),
('ROF-170823G7HC', 'success', 'Koko Saputra', NULL, NULL, '2023-06-01', '12:11:11', '13:23:11', '14:23:11', NULL, '2023-08-17 08:58:24', '2023-08-17 09:07:55', 0),
('ROF-170823G81U', 'success', 'Bayu Wijaya', NULL, NULL, '2023-02-11', '16:56:41', '17:08:11', '19:18:11', NULL, '2023-08-17 08:56:41', '2023-08-17 09:09:01', 0),
('ROF-170823G93P', 'success', 'Fahmi Pratama', NULL, NULL, '2023-01-01', '16:56:16', '17:18:11', '18:18:11', NULL, '2023-08-17 08:56:16', '2023-08-17 09:09:27', 0),
('ROF-170823J0UN', 'success', 'Fika Maharani', NULL, NULL, '2023-05-06', '12:12:11', '13:20:11', '14:20:11', NULL, '2023-08-17 08:58:05', '2023-08-17 09:08:24', 0),
('ROF-170823J68K', 'success', 'Aulia Rahman', NULL, NULL, '2023-02-03', '16:56:31', '17:22:11', '18:18:11', NULL, '2023-08-17 08:56:32', '2023-08-17 09:09:08', 0),
('ROF-170823M6S6', 'success', 'Novita Sari', NULL, NULL, '2023-01-10', '16:56:22', '17:15:11', '18:18:11', NULL, '2023-08-17 08:56:22', '2023-08-17 09:09:23', 0),
('ROF-170823MX4I', 'success', 'Yoga Putra', NULL, NULL, '2023-02-03', '16:56:27', '17:25:11', '18:18:11', NULL, '2023-08-17 08:56:27', '2023-08-17 09:09:20', 0),
('ROF-170823O109', 'failed', 'Dian Permata', NULL, NULL, '2023-04-11', '16:57:56', '17:20:11', NULL, NULL, '2023-08-17 08:57:56', '2023-08-17 09:14:55', 0),
('ROF-170823OD0K', 'success', 'Rizal Fauzi', NULL, NULL, '2023-06-10', '14:45:11', '15:39:11', '16:39:11', NULL, '2023-08-17 08:58:57', '2023-08-17 09:07:43', 0),
('ROF-170823WHYB', 'success', 'Ayu Dewi', NULL, NULL, '2023-03-23', '16:57:04', '17:42:11', '18:18:11', NULL, '2023-08-17 08:57:04', '2023-08-17 09:08:43', 0),
('ROF-170823X45X', 'success', 'Jihan Putri', NULL, NULL, '2023-06-01', '12:42:11', '13:27:11', '14:27:11', NULL, '2023-08-17 08:58:20', '2023-08-17 09:08:01', 0),
('ROF-170823X5FQ', 'success', 'Andi Kusuma', NULL, NULL, '2023-07-03', '14:47:11', '15:23:11', '17:23:11', NULL, '2023-08-17 08:59:05', '2023-08-17 09:07:36', 0),
('ROF-1808230ERO', 'success', 'Fadhil', NULL, NULL, '2023-08-18', '09:06:24', '09:07:28', '10:07:28', NULL, '2023-08-18 01:06:24', '2023-08-18 01:07:43', 0),
('ROF-180823OQR2', 'failed', 'Ramdhani', NULL, NULL, '2023-08-18', '11:18:39', NULL, NULL, NULL, '2023-08-18 03:18:39', '2023-08-23 05:10:25', 0),
('ROF-2308231GX4', 'success', 'Saipul', NULL, NULL, '2023-08-23', '22:10:42', '22:10:54', '23:10:54', NULL, '2023-08-23 14:10:42', '2023-08-23 14:11:15', 0),
('ROF-230823A5D8', 'failed', 'Fitriansyah', NULL, NULL, '2023-08-23', '13:30:04', NULL, NULL, NULL, '2023-08-23 05:30:04', '2023-08-23 05:30:15', 0),
('ROF-230823F21U', 'success', 'Ahmadi Aji', NULL, NULL, '2023-08-23', '13:28:31', '13:28:50', '14:28:50', NULL, '2023-08-23 05:28:31', '2023-08-23 05:29:02', 0),
('RSV-09082306AY', 'success', 'Dina Pratiwi', '+3813587949721', 42, '2023-07-09', '10:34:00', '10:44:34', '11:45:18', '11:34:00', '2023-08-09 02:34:51', '2023-08-09 02:34:51', 0),
('RSV-09082311W4', 'success', 'Adika Lazuardi M.Farm', '+6748718445', 10, '2023-07-02', '10:13:00', '10:44:41', '11:45:17', '12:13:00', '2023-08-09 02:14:10', '2023-08-09 02:14:10', 0),
('RSV-090823171U', 'success', 'Jono Wijaya', '+40317075798', 9, '2023-06-16', '10:10:00', '10:44:42', '11:45:16', '11:10:00', '2023-08-09 02:11:10', '2023-08-09 02:11:10', 0),
('RSV-09082324GF', 'success', 'Baktiadi Rajasa', '+815900996176', 44, '2023-07-15', '10:35:00', '10:44:43', '11:45:15', '11:35:00', '2023-08-09 02:35:35', '2023-08-09 02:35:35', 0),
('RSV-09082348PN', 'failed', 'H.Bajuri', '081234567891', 1, '2023-08-09', '16:17:00', NULL, NULL, '17:17:00', '2023-08-09 08:17:31', '2023-08-17 06:50:51', 0),
('RSV-090823FCXZ', 'success', 'Dina Pratiwi', '+3813587949721', 42, '2023-06-06', '10:33:00', '10:44:44', '11:45:13', '11:33:00', '2023-08-09 02:33:49', '2023-08-09 02:33:49', 0),
('RSV-090823K05Y', 'success', 'Harto Gaiman Budiyanto', '+40343659125', 3, '2023-06-08', '08:30:00', '08:44:45', '13:45:11', '10:30:00', '2023-08-09 02:08:41', '2023-08-09 02:08:41', 0),
('RSV-090823O068', 'success', 'Harto Gaiman Budiyanto', '+40343659125', 3, '2023-06-15', '10:38:00', '10:44:48', '12:45:10', '11:38:00', '2023-08-09 02:08:33', '2023-08-09 02:08:33', 0),
('RSV-090823WWM9', 'success', 'Adika Lazuardi M.Farm', '+6748718445', 10, '2023-06-27', '10:12:00', '10:44:50', '11:45:08', '11:12:00', '2023-08-09 02:12:51', '2023-08-09 02:12:51', 0),
('RSV-090823ZS7J', 'success', 'Johan Hardiansyah S.Kom', '+376671705428', 34, '2023-08-02', '10:19:00', '10:44:51', '12:45:05', '11:19:00', '2023-08-09 02:20:07', '2023-08-09 02:20:07', 0),
('RSV-090823ZX8D', 'success', 'Baktiadi Rajasa', '+815900996176', 44, '2023-07-25', '12:35:00', '13:44:52', '14:45:00', '15:35:00', '2023-08-09 02:35:57', '2023-08-09 02:35:57', 0),
('RSV-1708230092', 'success', 'Irma Prastuti', '089012345678', 7, '2023-04-02', '13:36:00', '14:02:57', '14:32:57', '14:36:00', '2023-08-17 05:36:38', '2023-08-17 06:02:57', 0),
('RSV-170823160J', 'success', 'Caraka Adriansyah S.H.', '08110567890321', 6, '2023-03-11', '13:36:00', '14:02:51', '14:32:51', '14:36:00', '2023-08-17 05:36:11', '2023-08-17 06:02:51', 0),
('RSV-170823553M', 'success', 'Adika Lazuardi M.Farm', '08134455667788', 10, '2023-05-10', '13:37:00', '14:03:08', '14:33:08', '14:37:00', '2023-08-17 05:37:35', '2023-08-17 06:03:08', 0),
('RSV-17082359W7', 'success', 'Caraka Adriansyah S.H.', '08110567890321', 6, '2023-03-27', '13:36:00', '14:02:55', '14:32:55', '14:36:00', '2023-08-17 05:36:19', '2023-08-17 06:02:55', 0),
('RSV-17082375B5', 'success', 'Kenzie Oman Firmansyah', '08115678901234', 5, '2023-02-11', '13:35:00', '14:02:44', '14:32:44', '14:35:00', '2023-08-17 05:35:47', '2023-08-17 06:02:44', 0),
('RSV-17082380HD', 'success', 'Harto Gaiman Budiyanto', '0898765432109', 3, '2023-01-05', '13:32:00', '14:01:25', '14:31:25', '14:32:00', '2023-08-17 05:33:01', '2023-08-17 06:01:25', 0),
('RSV-1708238E82', 'failed', 'H.Bajuri', '081234567891', 1, '2023-08-17', '11:44:00', NULL, NULL, '13:45:00', '2023-08-17 03:45:16', '2023-08-18 03:15:30', 0),
('RSV-1708238U7K', 'success', 'Yessi Hariyah', '0810192837465', 4, '2023-02-06', '13:35:00', '14:02:42', '14:32:42', '14:35:00', '2023-08-17 05:35:28', '2023-08-17 06:02:42', 0),
('RSV-170823A734', 'success', 'Yessi Hariyah', '0810192837465', 4, '2023-01-27', '13:35:00', '14:02:39', '14:32:39', '14:35:00', '2023-08-17 05:35:20', '2023-08-17 06:02:39', 0),
('RSV-170823C2ZS', 'success', 'H.Bajuri', '081234567891', 1, '2023-08-17', '11:45:00', '11:59:15', '12:29:15', '13:45:00', '2023-08-17 03:46:15', '2023-08-17 03:59:15', 0),
('RSV-170823E51A', 'success', 'Elon Bahuwirya Hakim', '081234567890', 11, '2023-05-21', '13:38:00', '14:03:10', '14:33:10', '14:38:00', '2023-08-17 05:38:15', '2023-08-17 06:03:10', 0),
('RSV-170823H8V4', 'success', 'Irma Prastuti', '089012345678', 7, '2023-04-11', '13:36:00', '14:03:00', '14:33:00', '14:36:00', '2023-08-17 05:36:46', '2023-08-17 06:03:00', 0),
('RSV-170823L3L8', 'success', 'Jono Wijaya', '08123456789101', 9, '2023-04-28', '13:37:00', '14:03:05', '14:33:05', '14:37:00', '2023-08-17 05:37:16', '2023-08-17 06:03:05', 0),
('RSV-170823R00M', 'success', 'Intan Kartika Namaga S.Pt', '08109876543211', 8, '2023-04-21', '13:36:00', '14:03:03', '14:33:03', '14:36:00', '2023-08-17 05:37:02', '2023-08-17 06:03:03', 0),
('RSV-170823TB47', 'success', 'Harto Gaiman Budiyanto', '0898765432109', 3, '2023-01-21', '13:34:00', '14:02:37', '14:32:37', '14:34:00', '2023-08-17 05:34:58', '2023-08-17 06:02:37', 0),
('RSV-170823ZE5P', 'success', 'Kenzie Oman Firmansyah', '08115678901234', 5, '2023-03-01', '13:35:00', '14:02:47', '14:32:47', '14:35:00', '2023-08-17 05:35:54', '2023-08-17 06:02:47', 0),
('RSV-1808236BE2', 'failed', 'Muhammad Fadhilah', '01151154454', 102, '2023-08-18', '08:56:00', NULL, NULL, '09:56:00', '2023-08-18 00:57:03', '2023-08-23 04:42:05', 0),
('RSV-180823FEF2', 'success', 'Ipul Hadi', '01354874454', 102, '2023-08-18', '11:14:00', '11:56:31', '12:56:31', '13:14:00', '2023-08-18 03:14:52', '2023-08-18 03:15:49', 0),
('RSV-2308230FQ4', 'success', 'H.Bajuri', '081234567891', 1, '2023-08-23', '14:45:00', '18:19:59', '18:49:59', '15:45:00', '2023-08-23 06:45:36', '2023-08-23 10:19:59', 0),
('RSV-23082382LI', 'success', 'Muhammad Fadhilah', '01151154454', 102, '2023-08-23', '12:50:00', '12:56:31', '13:26:31', '13:50:00', '2023-08-23 04:50:13', '2023-08-23 04:56:31', 0),
('RSV-23082383GY', 'failed', 'Muhammad Fadhilah', '081333221102', 102, '2023-08-23', '12:47:00', NULL, NULL, '13:47:00', '2023-08-23 04:48:01', '2023-08-23 04:49:56', 0),
('RSV-230823K0RV', 'success', 'Muhammad Fadhilah', '01151154454', 102, '2023-08-23', '21:41:00', '21:43:08', '22:13:08', '00:41:00', '2023-08-23 13:41:19', '2023-08-23 13:43:08', 0),
('RSV-230823SQ56', 'success', 'Muhammad Fadhilah', '01151154454', 102, '2023-08-23', '21:40:00', '21:44:12', '22:14:12', '22:40:00', '2023-08-23 13:41:05', '2023-08-23 13:44:12', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservation_items`
--

CREATE TABLE `reservation_items` (
  `reservation_item_id` bigint UNSIGNED NOT NULL,
  `table_id` bigint UNSIGNED NOT NULL,
  `reservation_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `reservation_items`
--

INSERT INTO `reservation_items` (`reservation_item_id`, `table_id`, `reservation_id`, `created_at`, `updated_at`) VALUES
(86, 1, 'RSV-090823O068', '2023-08-09 02:08:33', '2023-08-09 02:08:33'),
(87, 2, 'RSV-090823K05Y', '2023-08-09 02:08:41', '2023-08-09 02:08:41'),
(88, 3, 'RSV-090823K05Y', '2023-08-09 02:08:41', '2023-08-09 02:08:41'),
(89, 4, 'RSV-090823171U', '2023-08-09 02:11:10', '2023-08-09 02:11:10'),
(90, 5, 'RSV-090823WWM9', '2023-08-09 02:12:51', '2023-08-09 02:12:51'),
(91, 3, 'RSV-09082311W4', '2023-08-09 02:14:10', '2023-08-09 02:14:10'),
(92, 1, 'RSV-090823ZS7J', '2023-08-09 02:20:07', '2023-08-09 02:20:07'),
(93, 1, 'RSV-090823FCXZ', '2023-08-09 02:33:49', '2023-08-09 02:33:49'),
(94, 2, 'RSV-09082306AY', '2023-08-09 02:34:51', '2023-08-09 02:34:51'),
(95, 3, 'RSV-09082306AY', '2023-08-09 02:34:51', '2023-08-09 02:34:51'),
(96, 2, 'RSV-09082324GF', '2023-08-09 02:35:35', '2023-08-09 02:35:35'),
(97, 1, 'RSV-090823ZX8D', '2023-08-09 02:35:57', '2023-08-09 02:35:57'),
(98, 2, 'RSV-090823ZX8D', '2023-08-09 02:35:57', '2023-08-09 02:35:57'),
(99, 1, 'RSV-09082348PN', '2023-08-09 08:17:31', '2023-08-09 08:17:31'),
(100, 1, 'RSV-1708238E82', '2023-08-17 03:45:16', '2023-08-17 03:45:16'),
(101, 2, 'RSV-170823C2ZS', '2023-08-17 03:46:15', '2023-08-17 03:46:15'),
(102, 1, 'RSV-17082380HD', '2023-08-17 05:33:01', '2023-08-17 05:33:01'),
(103, 2, 'RSV-170823TB47', '2023-08-17 05:34:58', '2023-08-17 05:34:58'),
(104, 4, 'RSV-170823A734', '2023-08-17 05:35:20', '2023-08-17 05:35:20'),
(105, 3, 'RSV-1708238U7K', '2023-08-17 05:35:28', '2023-08-17 05:35:28'),
(106, 1, 'RSV-17082375B5', '2023-08-17 05:35:47', '2023-08-17 05:35:47'),
(107, 2, 'RSV-17082375B5', '2023-08-17 05:35:47', '2023-08-17 05:35:47'),
(108, 1, 'RSV-170823ZE5P', '2023-08-17 05:35:54', '2023-08-17 05:35:54'),
(109, 2, 'RSV-170823160J', '2023-08-17 05:36:11', '2023-08-17 05:36:11'),
(110, 5, 'RSV-17082359W7', '2023-08-17 05:36:19', '2023-08-17 05:36:19'),
(111, 2, 'RSV-1708230092', '2023-08-17 05:36:38', '2023-08-17 05:36:38'),
(112, 4, 'RSV-170823H8V4', '2023-08-17 05:36:46', '2023-08-17 05:36:46'),
(113, 2, 'RSV-170823R00M', '2023-08-17 05:37:02', '2023-08-17 05:37:02'),
(114, 1, 'RSV-170823L3L8', '2023-08-17 05:37:16', '2023-08-17 05:37:16'),
(115, 4, 'RSV-170823553M', '2023-08-17 05:37:35', '2023-08-17 05:37:35'),
(116, 5, 'RSV-170823E51A', '2023-08-17 05:38:15', '2023-08-17 05:38:15'),
(117, 1, 'ROF-17082367Z3', '2023-08-17 09:00:24', '2023-08-17 09:00:24'),
(118, 2, 'ROF-17082386Q2', '2023-08-17 09:03:03', '2023-08-17 09:03:03'),
(119, 2, 'ROF-170823G93P', '2023-08-17 09:03:21', '2023-08-17 09:03:21'),
(120, 1, 'ROF-170823X5FQ', '2023-08-17 09:03:34', '2023-08-17 09:03:34'),
(121, 5, 'ROF-1708235DK0', '2023-08-17 09:03:40', '2023-08-17 09:03:40'),
(122, 4, 'ROF-170823OD0K', '2023-08-17 09:03:46', '2023-08-17 09:03:46'),
(123, 5, 'ROF-170823B7I1', '2023-08-17 09:03:54', '2023-08-17 09:03:54'),
(124, 3, 'ROF-1708232UH8', '2023-08-17 09:03:59', '2023-08-17 09:03:59'),
(125, 3, 'ROF-1708232UH8', '2023-08-17 09:04:05', '2023-08-17 09:04:05'),
(126, 4, 'ROF-170823G7HC', '2023-08-17 09:04:11', '2023-08-17 09:04:11'),
(127, 3, 'ROF-170823G7HC', '2023-08-17 09:04:21', '2023-08-17 09:04:21'),
(128, 1, 'ROF-170823X45X', '2023-08-17 09:04:37', '2023-08-17 09:04:37'),
(129, 2, 'ROF-170823DQ4G', '2023-08-17 09:04:51', '2023-08-17 09:04:51'),
(130, 1, 'ROF-170823698J', '2023-08-17 09:04:59', '2023-08-17 09:04:59'),
(131, 1, 'ROF-170823DM19', '2023-08-17 09:05:05', '2023-08-17 09:05:05'),
(132, 1, 'ROF-170823J0UN', '2023-08-17 09:05:18', '2023-08-17 09:05:18'),
(133, 2, 'ROF-170823C4G1', '2023-08-17 09:05:24', '2023-08-17 09:05:24'),
(134, 2, 'ROF-170823C4G1', '2023-08-17 09:05:29', '2023-08-17 09:05:29'),
(135, 5, 'ROF-170823O109', '2023-08-17 09:05:34', '2023-08-17 09:05:34'),
(136, 5, 'ROF-170823CCL1', '2023-08-17 09:05:39', '2023-08-17 09:05:39'),
(137, 5, 'ROF-1708232LQI', '2023-08-17 09:05:46', '2023-08-17 09:05:46'),
(138, 3, 'ROF-170823WHYB', '2023-08-17 09:05:55', '2023-08-17 09:05:55'),
(139, 4, 'ROF-1708239K65', '2023-08-17 09:06:02', '2023-08-17 09:06:02'),
(140, 1, 'ROF-1708230982', '2023-08-17 09:06:10', '2023-08-17 09:06:10'),
(141, 2, 'ROF-170823EAKY', '2023-08-17 09:06:16', '2023-08-17 09:06:16'),
(142, 2, 'ROF-1708234M43', '2023-08-17 09:06:22', '2023-08-17 09:06:22'),
(143, 4, 'ROF-170823G81U', '2023-08-17 09:06:30', '2023-08-17 09:06:30'),
(144, 2, 'ROF-1708234TA1', '2023-08-17 09:06:36', '2023-08-17 09:06:36'),
(145, 3, 'ROF-170823J68K', '2023-08-17 09:06:43', '2023-08-17 09:06:43'),
(146, 4, 'ROF-170823MX4I', '2023-08-17 09:06:51', '2023-08-17 09:06:51'),
(147, 4, 'ROF-170823M6S6', '2023-08-17 09:06:59', '2023-08-17 09:06:59'),
(148, 2, 'ROF-0908239362', '2023-08-17 09:31:05', '2023-08-17 09:31:05'),
(149, 1, 'ROF-0908239362', '2023-08-17 09:36:05', '2023-08-17 09:36:05'),
(150, 2, 'RSV-1808236BE2', '2023-08-18 00:57:03', '2023-08-18 00:57:03'),
(151, 4, 'ROF-1808230ERO', '2023-08-18 01:07:28', '2023-08-18 01:07:28'),
(152, 5, 'RSV-180823FEF2', '2023-08-18 03:14:52', '2023-08-18 03:14:52'),
(153, 1, 'RSV-23082383GY', '2023-08-23 04:48:01', '2023-08-23 04:48:01'),
(154, 2, 'RSV-23082383GY', '2023-08-23 04:48:01', '2023-08-23 04:48:01'),
(155, 2, 'RSV-23082382LI', '2023-08-23 04:50:13', '2023-08-23 04:50:13'),
(156, 1, 'ROF-230823F21U', '2023-08-23 05:28:50', '2023-08-23 05:28:50'),
(157, 2, 'RSV-2308230FQ4', '2023-08-23 06:45:36', '2023-08-23 06:45:36'),
(158, 2, 'RSV-230823SQ56', '2023-08-23 13:41:05', '2023-08-23 13:41:05'),
(159, 1, 'RSV-230823K0RV', '2023-08-23 13:41:19', '2023-08-23 13:41:19'),
(160, 1, 'ROF-2308231GX4', '2023-08-23 14:10:54', '2023-08-23 14:10:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `sale_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sale_date` date NOT NULL,
  `total` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sales`
--

INSERT INTO `sales` (`sale_id`, `sale_date`, `total`, `created_at`, `updated_at`) VALUES
('SAL-16082300B7', '2023-02-02', 696000, '2023-02-01 10:41:42', '2023-02-01 10:41:42'),
('SAL-1608230JZI', '2023-07-01', 1576000, '2023-07-22 11:48:29', '2023-07-22 11:48:29'),
('SAL-16082312X0', '2023-08-13', 438000, '2023-08-10 04:27:47', '2023-08-10 04:27:47'),
('SAL-1608231X4H', '2023-05-27', 1712000, '2023-05-10 10:06:16', '2023-05-10 10:06:16'),
('SAL-16082321W4', '2023-07-19', 1348000, '2023-07-10 03:01:23', '2023-07-10 03:01:23'),
('SAL-1608232J5C', '2023-07-07', 1030000, '2023-07-16 20:46:58', '2023-07-16 20:46:58'),
('SAL-1608232U7E', '2023-04-07', 598000, '2023-04-22 04:04:47', '2023-04-22 04:04:47'),
('SAL-16082331M0', '2023-01-31', 2204000, '2023-01-19 11:03:37', '2023-01-19 11:03:37'),
('SAL-16082333G3', '2023-04-01', 1302000, '2023-04-19 19:42:48', '2023-04-19 19:42:48'),
('SAL-16082333UU', '2023-03-15', 2326000, '2023-03-08 15:16:32', '2023-03-08 15:16:32'),
('SAL-16082333XK', '2023-06-05', 1640000, '2023-06-13 22:54:40', '2023-06-13 22:54:40'),
('SAL-1608233I70', '2023-07-06', 1906000, '2023-07-12 11:20:53', '2023-07-12 11:20:53'),
('SAL-1608233IVT', '2023-01-15', 1424000, '2023-01-03 18:10:56', '2023-01-03 18:10:56'),
('SAL-1608233R4O', '2023-02-26', 2258000, '2023-02-24 01:30:54', '2023-02-24 01:30:54'),
('SAL-1608234KNH', '2023-05-18', 394000, '2023-05-23 11:06:20', '2023-05-23 11:06:20'),
('SAL-1608235RBK', '2023-06-30', 1984000, '2023-06-18 11:01:15', '2023-06-18 11:01:15'),
('SAL-1608235RYF', '2023-01-12', 804000, '2023-01-12 20:58:17', '2023-01-12 20:58:17'),
('SAL-1608236H7D', '2023-05-23', 1574000, '2023-05-03 02:16:12', '2023-05-03 02:16:12'),
('SAL-1608236KTB', '2023-06-03', 1654000, '2023-06-22 23:58:47', '2023-06-22 23:58:47'),
('SAL-1608236OF2', '2023-07-16', 1468000, '2023-07-01 08:28:52', '2023-07-01 08:28:52'),
('SAL-1608236WJ4', '2023-03-11', 1212000, '2023-03-23 22:40:47', '2023-03-23 22:40:47'),
('SAL-1608237600', '2023-01-18', 1134000, '2023-01-27 22:48:48', '2023-01-27 22:48:48'),
('SAL-16082379QG', '2023-03-07', 1400000, '2023-03-03 15:24:29', '2023-03-03 15:24:29'),
('SAL-1608237GY4', '2023-05-31', 534000, '2023-05-07 00:58:00', '2023-05-07 00:58:00'),
('SAL-16082380UQ', '2023-06-03', 466000, '2023-06-03 03:29:33', '2023-06-03 03:29:33'),
('SAL-16082385RK', '2023-03-06', 462000, '2023-03-15 21:22:03', '2023-03-15 21:22:03'),
('SAL-1608238AT8', '2023-05-09', 2420000, '2023-05-14 11:03:55', '2023-05-14 11:03:55'),
('SAL-1608238CDC', '2023-06-03', 2478000, '2023-06-03 12:56:24', '2023-06-03 12:56:24'),
('SAL-1608238SC7', '2023-03-11', 2494000, '2023-03-06 03:52:17', '2023-03-06 03:52:17'),
('SAL-1608238X6U', '2023-02-24', 1360000, '2023-02-27 23:06:43', '2023-02-27 23:06:43'),
('SAL-1608238XO6', '2023-03-07', 1194000, '2023-03-16 18:19:36', '2023-03-16 18:19:36'),
('SAL-1608239EDZ', '2023-07-21', 1528000, '2023-07-04 15:48:21', '2023-07-04 15:48:21'),
('SAL-1608239HQP', '2023-04-10', 86000, '2023-04-06 01:03:47', '2023-04-06 01:03:47'),
('SAL-1608239HXU', '2023-06-21', 1448000, '2023-06-25 10:09:19', '2023-06-25 10:09:19'),
('SAL-1608239UBD', '2023-07-16', 1486000, '2023-07-24 19:52:26', '2023-07-24 19:52:26'),
('SAL-1608239WXN', '2023-06-18', 2260000, '2023-06-12 15:36:03', '2023-06-12 15:36:03'),
('SAL-1608239Y69', '2023-07-07', 1916000, '2023-07-16 07:51:26', '2023-07-16 07:51:26'),
('SAL-160823ATWA', '2023-01-17', 1338000, '2023-01-21 12:32:38', '2023-01-21 12:32:38'),
('SAL-160823AYRW', '2023-07-23', 372000, '2023-07-18 00:03:24', '2023-07-18 00:03:24'),
('SAL-160823B79Z', '2023-04-24', 2162000, '2023-04-14 06:47:48', '2023-04-14 06:47:48'),
('SAL-160823BG9S', '2023-05-26', 990000, '2023-05-12 06:58:59', '2023-05-12 06:58:59'),
('SAL-160823BHQ0', '2023-06-07', 158000, '2023-06-28 00:37:36', '2023-06-28 00:37:36'),
('SAL-160823BPKK', '2023-07-30', 1906000, '2023-07-15 11:12:20', '2023-07-15 11:12:20'),
('SAL-160823CF0C', '2023-04-28', 1910000, '2023-04-05 14:39:46', '2023-04-05 14:39:46'),
('SAL-160823CH3H', '2023-03-22', 1216000, '2023-03-18 19:35:34', '2023-03-18 19:35:34'),
('SAL-160823DL74', '2023-05-20', 798000, '2023-05-11 04:43:57', '2023-05-11 04:43:57'),
('SAL-160823DNF6', '2023-05-09', 990000, '2023-05-08 03:07:52', '2023-05-08 03:07:52'),
('SAL-160823DU67', '2023-08-09', 2362000, '2023-08-19 13:21:18', '2023-08-19 13:21:18'),
('SAL-160823E2Z5', '2023-01-05', 1706000, '2023-01-12 19:14:03', '2023-01-12 19:14:03'),
('SAL-160823F17S', '2023-04-24', 2212000, '2023-04-26 12:02:45', '2023-04-26 12:02:45'),
('SAL-160823F2B3', '2023-01-20', 1456000, '2023-01-14 16:54:41', '2023-01-14 16:54:41'),
('SAL-160823FRE2', '2023-06-17', 700000, '2023-06-22 12:47:25', '2023-06-22 12:47:25'),
('SAL-160823GG4G', '2023-03-12', 454000, '2023-03-16 15:21:26', '2023-03-16 15:21:26'),
('SAL-160823H1GI', '2023-08-03', 2404000, '2023-08-02 01:16:51', '2023-08-02 01:16:51'),
('SAL-160823H53I', '2023-03-08', 906000, '2023-03-28 06:02:28', '2023-03-28 06:02:28'),
('SAL-160823HDIG', '2023-04-30', 1340000, '2023-04-07 04:10:54', '2023-04-07 04:10:54'),
('SAL-160823HW2J', '2023-03-30', 1628000, '2023-03-27 16:26:59', '2023-03-27 16:26:59'),
('SAL-160823ID01', '2023-06-13', 40000, '2023-06-07 18:15:54', '2023-06-07 18:15:54'),
('SAL-160823IKIX', '2023-06-11', 1072000, '2023-06-23 08:33:35', '2023-06-23 08:33:35'),
('SAL-160823J068', '2023-01-17', 582000, '2023-01-28 15:18:22', '2023-01-28 15:18:22'),
('SAL-160823J6VL', '2023-01-26', 1358000, '2023-01-22 21:43:56', '2023-01-22 21:43:56'),
('SAL-160823JAK7', '2023-05-20', 2176000, '2023-05-05 16:05:11', '2023-05-05 16:05:11'),
('SAL-160823JCXR', '2023-04-26', 94000, '2023-04-26 08:50:35', '2023-04-26 08:50:35'),
('SAL-160823JUDX', '2023-08-16', 82000, '2023-08-04 03:34:53', '2023-08-04 03:34:53'),
('SAL-160823KLSZ', '2023-02-27', 1072000, '2023-02-04 23:57:38', '2023-02-04 23:57:38'),
('SAL-160823KMSL', '2023-01-26', 232000, '2023-01-13 04:25:07', '2023-01-13 04:25:07'),
('SAL-160823KNMY', '2023-05-30', 1870000, '2023-05-04 12:28:58', '2023-05-04 12:28:58'),
('SAL-160823KOTX', '2023-05-01', 712000, '2023-05-02 04:51:12', '2023-05-02 04:51:12'),
('SAL-160823L1IL', '2023-05-03', 1810000, '2023-05-19 19:46:48', '2023-05-19 19:46:48'),
('SAL-160823L211', '2023-04-28', 1538000, '2023-04-20 06:22:30', '2023-04-20 06:22:30'),
('SAL-160823LC8J', '2023-01-25', 800000, '2023-01-07 16:18:40', '2023-01-07 16:18:40'),
('SAL-160823LNNV', '2023-02-25', 2264000, '2023-02-17 01:47:23', '2023-02-17 01:47:23'),
('SAL-160823LTLX', '2023-01-23', 1838000, '2023-01-12 09:42:44', '2023-01-12 09:42:44'),
('SAL-160823LVSE', '2023-03-18', 2324000, '2023-03-18 03:39:16', '2023-03-18 03:39:16'),
('SAL-160823MQWD', '2023-04-05', 1376000, '2023-04-09 00:56:11', '2023-04-09 00:56:11'),
('SAL-160823NC7L', '2023-06-26', 474000, '2023-06-10 13:12:14', '2023-06-10 13:12:14'),
('SAL-160823NCH3', '2023-05-30', 1694000, '2023-05-18 13:26:18', '2023-05-18 13:26:18'),
('SAL-160823NDWU', '2023-01-05', 2094000, '2023-01-17 07:11:01', '2023-01-17 07:11:01'),
('SAL-160823NGLH', '2023-05-28', 2282000, '2023-05-13 21:14:55', '2023-05-13 21:14:55'),
('SAL-160823NHEB', '2023-03-06', 688000, '2023-03-05 00:32:35', '2023-03-05 00:32:35'),
('SAL-160823NOZE', '2023-02-19', 384000, '2023-02-22 09:17:20', '2023-02-22 09:17:20'),
('SAL-160823NW8N', '2023-03-12', 1278000, '2023-03-08 05:33:31', '2023-03-08 05:33:31'),
('SAL-160823NXVK', '2023-05-21', 1382000, '2023-05-24 20:15:37', '2023-05-24 20:15:37'),
('SAL-160823O263', '2023-05-19', 2060000, '2023-05-13 03:02:45', '2023-05-13 03:02:45'),
('SAL-160823O2NN', '2023-01-05', 1966000, '2023-01-10 00:11:40', '2023-01-10 00:11:40'),
('SAL-160823O993', '2023-02-24', 434000, '2023-02-08 02:12:19', '2023-02-08 02:12:19'),
('SAL-160823OSQF', '2023-03-08', 498000, '2023-03-01 03:30:03', '2023-03-01 03:30:03'),
('SAL-160823P5WT', '2023-04-25', 1966000, '2023-04-07 20:10:37', '2023-04-07 20:10:37'),
('SAL-160823QRST', '2023-02-27', 226000, '2023-02-13 04:38:05', '2023-02-13 04:38:05'),
('SAL-160823QVAS', '2023-06-26', 1334000, '2023-06-07 21:27:50', '2023-06-07 21:27:50'),
('SAL-160823QXQP', '2023-02-20', 2042000, '2023-02-10 22:03:36', '2023-02-10 22:03:36'),
('SAL-160823R60D', '2023-06-19', 1904000, '2023-06-23 02:08:40', '2023-06-23 02:08:40'),
('SAL-160823RP4H', '2023-04-20', 1968000, '2023-04-16 08:55:06', '2023-04-16 08:55:06'),
('SAL-160823RPF0', '2023-04-16', 1182000, '2023-04-04 19:17:53', '2023-04-04 19:17:53'),
('SAL-160823RZD0', '2023-06-01', 1738000, '2023-06-21 19:47:04', '2023-06-21 19:47:04'),
('SAL-160823S06B', '2023-01-23', 736000, '2023-01-05 21:23:54', '2023-01-05 21:23:54'),
('SAL-160823S7ID', '2023-06-28', 1096000, '2023-06-07 14:52:49', '2023-06-07 14:52:49'),
('SAL-160823SA8Q', '2023-02-07', 2130000, '2023-02-16 15:46:39', '2023-02-16 15:46:39'),
('SAL-160823SBWC', '2023-05-23', 454000, '2023-05-24 22:44:35', '2023-05-24 22:44:35'),
('SAL-160823SSYW', '2023-02-01', 1712000, '2023-02-21 22:27:32', '2023-02-21 22:27:32'),
('SAL-160823SXOE', '2023-05-11', 1400000, '2023-05-14 16:20:29', '2023-05-14 16:20:29'),
('SAL-160823U6JI', '2023-07-18', 1748000, '2023-07-16 09:59:49', '2023-07-16 09:59:49'),
('SAL-160823UKNH', '2023-05-21', 188000, '2023-05-23 18:26:45', '2023-05-23 18:26:45'),
('SAL-160823UN9D', '2023-06-02', 170000, '2023-06-18 12:31:57', '2023-06-18 12:31:57'),
('SAL-160823V1X3', '2023-01-13', 626000, '2023-01-15 04:10:31', '2023-01-15 04:10:31'),
('SAL-160823V2Z3', '2023-07-20', 2172000, '2023-07-07 13:07:02', '2023-07-07 13:07:02'),
('SAL-160823VHD4', '2023-05-21', 1694000, '2023-05-05 09:35:11', '2023-05-05 09:35:11'),
('SAL-160823WG1M', '2023-07-08', 724000, '2023-07-22 17:46:30', '2023-07-22 17:46:30'),
('SAL-160823WGUA', '2023-02-10', 2050000, '2023-02-12 00:01:23', '2023-02-12 00:01:23'),
('SAL-160823WHD2', '2023-03-16', 1028000, '2023-03-16 17:50:15', '2023-03-16 17:50:15'),
('SAL-160823WHKA', '2023-05-12', 956000, '2023-05-11 11:32:09', '2023-05-11 11:32:09'),
('SAL-160823WPRB', '2023-07-21', 264000, '2023-07-26 19:21:19', '2023-07-26 19:21:19'),
('SAL-160823XIDQ', '2023-07-26', 944000, '2023-07-12 13:54:15', '2023-07-12 13:54:15'),
('SAL-160823XO94', '2023-04-13', 1182000, '2023-04-21 12:23:57', '2023-04-21 12:23:57'),
('SAL-160823YG47', '2023-03-06', 1938000, '2023-03-02 01:49:15', '2023-03-02 01:49:15'),
('SAL-160823YH00', '2023-03-10', 370000, '2023-03-21 12:46:58', '2023-03-21 12:46:58'),
('SAL-160823YQHY', '2023-02-12', 1828000, '2023-02-01 11:47:50', '2023-02-01 11:47:50'),
('SAL-160823Z893', '2023-06-24', 1116000, '2023-06-26 19:53:21', '2023-06-26 19:53:21'),
('SAL-160823ZRI2', '2023-01-18', 1312000, '2023-01-27 05:16:17', '2023-01-27 05:16:17'),
('SAL-160823ZTJI', '2023-02-16', 1044000, '2023-02-27 20:04:12', '2023-02-27 20:04:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sale_items`
--

CREATE TABLE `sale_items` (
  `id` bigint UNSIGNED NOT NULL,
  `sale_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `selling_id` bigint UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL DEFAULT '0',
  `price` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sale_items`
--

INSERT INTO `sale_items` (`id`, `sale_id`, `selling_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 'SAL-1608233I70', 3, 11, 54000, '2023-07-06 00:00:00', '0000-00-00 00:00:00'),
(3, 'SAL-1608233I70', 7, 82, 12000, '2023-07-06 00:00:00', '0000-00-00 00:00:00'),
(4, 'SAL-1608230JZI', 2, 18, 24000, '2023-07-01 00:00:00', '0000-00-00 00:00:00'),
(7, 'SAL-1608230JZI', 3, 27, 16000, '2023-07-01 00:00:00', '0000-00-00 00:00:00'),
(11, 'SAL-160823JUDX', 4, 14, 46000, '2023-08-16 00:00:00', '0000-00-00 00:00:00'),
(12, 'SAL-160823WGUA', 5, 70, 16000, '2023-02-10 00:00:00', '0000-00-00 00:00:00'),
(15, 'SAL-160823WGUA', 5, 86, 30000, '2023-02-10 00:00:00', '0000-00-00 00:00:00'),
(16, 'SAL-160823SXOE', 6, 29, 20000, '2023-05-11 00:00:00', '0000-00-00 00:00:00'),
(19, 'SAL-160823KNMY', 3, 69, 14000, '2023-05-30 00:00:00', '0000-00-00 00:00:00'),
(20, 'SAL-160823KNMY', 2, 28, 14000, '2023-05-30 00:00:00', '0000-00-00 00:00:00'),
(21, 'SAL-160823YQHY', 2, 11, 18000, '2023-02-12 00:00:00', '0000-00-00 00:00:00'),
(26, 'SAL-160823V1X3', 2, 60, 38000, '2023-01-13 00:00:00', '0000-00-00 00:00:00'),
(27, 'SAL-160823V1X3', 5, 53, 14000, '2023-01-13 00:00:00', '0000-00-00 00:00:00'),
(28, 'SAL-160823V1X3', 4, 64, 36000, '2023-01-13 00:00:00', '0000-00-00 00:00:00'),
(32, 'SAL-160823QVAS', 1, 22, 40000, '2023-06-26 00:00:00', '0000-00-00 00:00:00'),
(33, 'SAL-160823KOTX', 5, 41, 42000, '2023-05-01 00:00:00', '0000-00-00 00:00:00'),
(36, 'SAL-1608236WJ4', 3, 9, 12000, '2023-03-11 00:00:00', '0000-00-00 00:00:00'),
(38, 'SAL-1608232J5C', 6, 30, 46000, '2023-07-07 00:00:00', '0000-00-00 00:00:00'),
(41, 'SAL-1608232J5C', 6, 64, 14000, '2023-07-07 00:00:00', '0000-00-00 00:00:00'),
(42, 'SAL-160823NDWU', 7, 45, 20000, '2023-01-05 00:00:00', '0000-00-00 00:00:00'),
(45, 'SAL-1608238X6U', 2, 72, 18000, '2023-02-24 00:00:00', '0000-00-00 00:00:00'),
(46, 'SAL-1608238X6U', 5, 9, 38000, '2023-02-24 00:00:00', '0000-00-00 00:00:00'),
(47, 'SAL-160823LTLX', 4, 1, 34000, '2023-01-23 00:00:00', '0000-00-00 00:00:00'),
(51, 'SAL-1608239EDZ', 3, 13, 16000, '2023-07-21 00:00:00', '0000-00-00 00:00:00'),
(53, 'SAL-160823XIDQ', 4, 92, 36000, '2023-07-26 00:00:00', '0000-00-00 00:00:00'),
(56, 'SAL-160823XIDQ', 6, 55, 46000, '2023-07-26 00:00:00', '0000-00-00 00:00:00'),
(57, 'SAL-160823IKIX', 7, 54, 34000, '2023-06-11 00:00:00', '0000-00-00 00:00:00'),
(58, 'SAL-160823LVSE', 6, 66, 54000, '2023-03-18 00:00:00', '0000-00-00 00:00:00'),
(60, 'SAL-1608238SC7', 6, 59, 18000, '2023-03-11 00:00:00', '0000-00-00 00:00:00'),
(61, 'SAL-1608239HQP', 1, 77, 16000, '2023-04-10 00:00:00', '0000-00-00 00:00:00'),
(63, 'SAL-1608239HQP', 2, 59, 44000, '2023-04-10 00:00:00', '0000-00-00 00:00:00'),
(65, 'SAL-1608239HQP', 8, 59, 10000, '2023-04-10 00:00:00', '0000-00-00 00:00:00'),
(66, 'SAL-160823NCH3', 6, 75, 34000, '2023-05-30 00:00:00', '0000-00-00 00:00:00'),
(67, 'SAL-160823NCH3', 7, 94, 40000, '2023-05-30 00:00:00', '0000-00-00 00:00:00'),
(68, 'SAL-160823NCH3', 7, 43, 42000, '2023-05-30 00:00:00', '0000-00-00 00:00:00'),
(69, 'SAL-160823NCH3', 8, 53, 50000, '2023-05-30 00:00:00', '0000-00-00 00:00:00'),
(70, 'SAL-1608236KTB', 6, 84, 24000, '2023-06-03 00:00:00', '0000-00-00 00:00:00'),
(71, 'SAL-160823NGLH', 3, 83, 20000, '2023-05-28 00:00:00', '0000-00-00 00:00:00'),
(72, 'SAL-160823NGLH', 7, 27, 20000, '2023-05-28 00:00:00', '0000-00-00 00:00:00'),
(73, 'SAL-160823NGLH', 8, 19, 20000, '2023-05-28 00:00:00', '0000-00-00 00:00:00'),
(74, 'SAL-160823NGLH', 2, 93, 36000, '2023-05-28 00:00:00', '0000-00-00 00:00:00'),
(75, 'SAL-160823YG47', 7, 35, 28000, '2023-03-06 00:00:00', '0000-00-00 00:00:00'),
(76, 'SAL-160823YG47', 6, 83, 36000, '2023-03-06 00:00:00', '0000-00-00 00:00:00'),
(77, 'SAL-1608239Y69', 8, 37, 50000, '2023-07-07 00:00:00', '0000-00-00 00:00:00'),
(78, 'SAL-1608239Y69', 8, 68, 28000, '2023-07-07 00:00:00', '0000-00-00 00:00:00'),
(79, 'SAL-160823ATWA', 6, 13, 20000, '2023-01-17 00:00:00', '0000-00-00 00:00:00'),
(80, 'SAL-160823ATWA', 7, 14, 38000, '2023-01-17 00:00:00', '0000-00-00 00:00:00'),
(81, 'SAL-160823Z893', 5, 85, 32000, '2023-06-24 00:00:00', '0000-00-00 00:00:00'),
(82, 'SAL-16082331M0', 2, 10, 12000, '2023-01-31 00:00:00', '0000-00-00 00:00:00'),
(83, 'SAL-16082331M0', 2, 66, 42000, '2023-01-31 00:00:00', '0000-00-00 00:00:00'),
(84, 'SAL-16082331M0', 1, 34, 20000, '2023-01-31 00:00:00', '0000-00-00 00:00:00'),
(85, 'SAL-16082331M0', 1, 6, 34000, '2023-01-31 00:00:00', '0000-00-00 00:00:00'),
(86, 'SAL-16082331M0', 1, 2, 42000, '2023-01-31 00:00:00', '0000-00-00 00:00:00'),
(87, 'SAL-160823QRST', 4, 50, 52000, '2023-02-27 00:00:00', '0000-00-00 00:00:00'),
(88, 'SAL-160823QRST', 2, 61, 10000, '2023-02-27 00:00:00', '0000-00-00 00:00:00'),
(89, 'SAL-160823QRST', 4, 56, 32000, '2023-02-27 00:00:00', '0000-00-00 00:00:00'),
(90, 'SAL-160823QRST', 4, 30, 14000, '2023-02-27 00:00:00', '0000-00-00 00:00:00'),
(91, 'SAL-160823QRST', 6, 74, 46000, '2023-02-27 00:00:00', '0000-00-00 00:00:00'),
(92, 'SAL-1608233IVT', 1, 84, 38000, '2023-01-15 00:00:00', '0000-00-00 00:00:00'),
(93, 'SAL-1608233IVT', 3, 95, 24000, '2023-01-15 00:00:00', '0000-00-00 00:00:00'),
(94, 'SAL-1608233IVT', 2, 58, 50000, '2023-01-15 00:00:00', '0000-00-00 00:00:00'),
(95, 'SAL-160823O993', 8, 95, 54000, '2023-02-24 00:00:00', '0000-00-00 00:00:00'),
(96, 'SAL-160823O993', 4, 52, 16000, '2023-02-24 00:00:00', '0000-00-00 00:00:00'),
(97, 'SAL-160823O993', 3, 62, 40000, '2023-02-24 00:00:00', '0000-00-00 00:00:00'),
(98, 'SAL-160823O993', 6, 100, 16000, '2023-02-24 00:00:00', '0000-00-00 00:00:00'),
(99, 'SAL-160823O263', 1, 1, 12000, '2023-05-19 00:00:00', '0000-00-00 00:00:00'),
(100, 'SAL-160823O263', 4, 79, 40000, '2023-05-19 00:00:00', '0000-00-00 00:00:00'),
(101, 'SAL-160823O263', 4, 33, 14000, '2023-05-19 00:00:00', '0000-00-00 00:00:00'),
(102, 'SAL-1608234KNH', 4, 8, 10000, '2023-05-18 00:00:00', '0000-00-00 00:00:00'),
(103, 'SAL-1608234KNH', 4, 58, 46000, '2023-05-18 00:00:00', '0000-00-00 00:00:00'),
(104, 'SAL-1608234KNH', 3, 9, 36000, '2023-05-18 00:00:00', '0000-00-00 00:00:00'),
(105, 'SAL-1608234KNH', 8, 11, 22000, '2023-05-18 00:00:00', '0000-00-00 00:00:00'),
(106, 'SAL-1608234KNH', 7, 54, 54000, '2023-05-18 00:00:00', '0000-00-00 00:00:00'),
(107, 'SAL-1608236OF2', 3, 45, 46000, '2023-07-16 00:00:00', '0000-00-00 00:00:00'),
(108, 'SAL-1608236OF2', 3, 76, 50000, '2023-07-16 00:00:00', '0000-00-00 00:00:00'),
(109, 'SAL-1608238CDC', 2, 91, 20000, '2023-06-03 00:00:00', '0000-00-00 00:00:00'),
(110, 'SAL-1608238XO6', 8, 96, 40000, '2023-03-07 00:00:00', '0000-00-00 00:00:00'),
(111, 'SAL-1608238XO6', 2, 41, 40000, '2023-03-07 00:00:00', '0000-00-00 00:00:00'),
(112, 'SAL-1608238XO6', 4, 61, 18000, '2023-03-07 00:00:00', '0000-00-00 00:00:00'),
(113, 'SAL-160823U6JI', 4, 54, 44000, '2023-07-18 00:00:00', '0000-00-00 00:00:00'),
(114, 'SAL-160823H1GI', 7, 98, 14000, '2023-08-03 00:00:00', '0000-00-00 00:00:00'),
(115, 'SAL-1608231X4H', 6, 22, 20000, '2023-05-27 00:00:00', '0000-00-00 00:00:00'),
(116, 'SAL-160823S7ID', 4, 65, 38000, '2023-06-28 00:00:00', '0000-00-00 00:00:00'),
(117, 'SAL-160823BHQ0', 3, 82, 42000, '2023-06-07 00:00:00', '0000-00-00 00:00:00'),
(118, 'SAL-160823BHQ0', 2, 2, 20000, '2023-06-07 00:00:00', '0000-00-00 00:00:00'),
(119, 'SAL-160823BHQ0', 7, 39, 26000, '2023-06-07 00:00:00', '0000-00-00 00:00:00'),
(120, 'SAL-160823BHQ0', 2, 22, 38000, '2023-06-07 00:00:00', '0000-00-00 00:00:00'),
(121, 'SAL-160823WPRB', 8, 55, 24000, '2023-07-21 00:00:00', '0000-00-00 00:00:00'),
(122, 'SAL-160823WPRB', 5, 2, 28000, '2023-07-21 00:00:00', '0000-00-00 00:00:00'),
(123, 'SAL-160823WPRB', 6, 89, 30000, '2023-07-21 00:00:00', '0000-00-00 00:00:00'),
(124, 'SAL-160823WPRB', 4, 10, 26000, '2023-07-21 00:00:00', '0000-00-00 00:00:00'),
(125, 'SAL-160823WPRB', 8, 31, 18000, '2023-07-21 00:00:00', '0000-00-00 00:00:00'),
(126, 'SAL-160823R60D', 7, 82, 40000, '2023-06-19 00:00:00', '0000-00-00 00:00:00'),
(127, 'SAL-160823R60D', 7, 52, 46000, '2023-06-19 00:00:00', '0000-00-00 00:00:00'),
(128, 'SAL-1608237GY4', 3, 21, 54000, '2023-05-31 00:00:00', '0000-00-00 00:00:00'),
(129, 'SAL-1608237GY4', 5, 2, 40000, '2023-05-31 00:00:00', '0000-00-00 00:00:00'),
(130, 'SAL-1608237GY4', 7, 48, 22000, '2023-05-31 00:00:00', '0000-00-00 00:00:00'),
(131, 'SAL-1608237GY4', 6, 1, 16000, '2023-05-31 00:00:00', '0000-00-00 00:00:00'),
(132, 'SAL-160823ID01', 6, 54, 18000, '2023-06-13 00:00:00', '0000-00-00 00:00:00'),
(133, 'SAL-160823L211', 1, 82, 34000, '2023-04-28 00:00:00', '0000-00-00 00:00:00'),
(134, 'SAL-160823L211', 2, 22, 26000, '2023-04-28 00:00:00', '0000-00-00 00:00:00'),
(135, 'SAL-160823L211', 2, 96, 54000, '2023-04-28 00:00:00', '0000-00-00 00:00:00'),
(136, 'SAL-160823JCXR', 8, 9, 50000, '2023-04-26 00:00:00', '0000-00-00 00:00:00'),
(137, 'SAL-160823JCXR', 3, 67, 50000, '2023-04-26 00:00:00', '0000-00-00 00:00:00'),
(138, 'SAL-160823JCXR', 2, 98, 44000, '2023-04-26 00:00:00', '0000-00-00 00:00:00'),
(139, 'SAL-160823CH3H', 7, 68, 38000, '2023-03-22 00:00:00', '0000-00-00 00:00:00'),
(140, 'SAL-160823CH3H', 6, 87, 30000, '2023-03-22 00:00:00', '0000-00-00 00:00:00'),
(141, 'SAL-160823RP4H', 5, 59, 20000, '2023-04-20 00:00:00', '0000-00-00 00:00:00'),
(142, 'SAL-160823RP4H', 8, 1, 44000, '2023-04-20 00:00:00', '0000-00-00 00:00:00'),
(143, 'SAL-160823RP4H', 2, 19, 26000, '2023-04-20 00:00:00', '0000-00-00 00:00:00'),
(144, 'SAL-16082300B7', 5, 47, 54000, '2023-02-02 00:00:00', '0000-00-00 00:00:00'),
(145, 'SAL-16082300B7', 2, 3, 44000, '2023-02-02 00:00:00', '0000-00-00 00:00:00'),
(146, 'SAL-160823OSQF', 4, 44, 10000, '2023-03-08 00:00:00', '0000-00-00 00:00:00'),
(147, 'SAL-160823OSQF', 4, 8, 26000, '2023-03-08 00:00:00', '0000-00-00 00:00:00'),
(148, 'SAL-160823OSQF', 6, 55, 16000, '2023-03-08 00:00:00', '0000-00-00 00:00:00'),
(149, 'SAL-160823V2Z3', 3, 38, 10000, '2023-07-20 00:00:00', '0000-00-00 00:00:00'),
(150, 'SAL-160823F17S', 3, 8, 34000, '2023-04-24 00:00:00', '0000-00-00 00:00:00'),
(151, 'SAL-160823F17S', 7, 34, 38000, '2023-04-24 00:00:00', '0000-00-00 00:00:00'),
(152, 'SAL-160823NW8N', 7, 30, 20000, '2023-03-12 00:00:00', '0000-00-00 00:00:00'),
(153, 'SAL-160823NW8N', 5, 94, 36000, '2023-03-12 00:00:00', '0000-00-00 00:00:00'),
(154, 'SAL-160823NW8N', 4, 5, 16000, '2023-03-12 00:00:00', '0000-00-00 00:00:00'),
(155, 'SAL-160823NW8N', 1, 88, 14000, '2023-03-12 00:00:00', '0000-00-00 00:00:00'),
(156, 'SAL-160823NW8N', 3, 12, 30000, '2023-03-12 00:00:00', '0000-00-00 00:00:00'),
(157, 'SAL-160823NC7L', 8, 41, 54000, '2023-06-26 00:00:00', '0000-00-00 00:00:00'),
(158, 'SAL-160823NC7L', 1, 55, 40000, '2023-06-26 00:00:00', '0000-00-00 00:00:00'),
(159, 'SAL-160823NC7L', 5, 35, 28000, '2023-06-26 00:00:00', '0000-00-00 00:00:00'),
(160, 'SAL-16082321W4', 7, 30, 32000, '2023-07-19 00:00:00', '0000-00-00 00:00:00'),
(161, 'SAL-16082321W4', 5, 39, 20000, '2023-07-19 00:00:00', '0000-00-00 00:00:00'),
(162, 'SAL-16082321W4', 2, 34, 50000, '2023-07-19 00:00:00', '0000-00-00 00:00:00'),
(163, 'SAL-16082321W4', 5, 13, 38000, '2023-07-19 00:00:00', '0000-00-00 00:00:00'),
(164, 'SAL-160823NOZE', 3, 31, 24000, '2023-02-19 00:00:00', '0000-00-00 00:00:00'),
(165, 'SAL-160823DL74', 5, 52, 48000, '2023-05-20 00:00:00', '0000-00-00 00:00:00'),
(166, 'SAL-160823DL74', 1, 65, 38000, '2023-05-20 00:00:00', '0000-00-00 00:00:00'),
(167, 'SAL-160823ZRI2', 3, 20, 26000, '2023-01-18 00:00:00', '0000-00-00 00:00:00'),
(168, 'SAL-160823ZRI2', 7, 49, 10000, '2023-01-18 00:00:00', '0000-00-00 00:00:00'),
(169, 'SAL-160823ZRI2', 3, 46, 42000, '2023-01-18 00:00:00', '0000-00-00 00:00:00'),
(170, 'SAL-160823ZRI2', 8, 37, 38000, '2023-01-18 00:00:00', '0000-00-00 00:00:00'),
(171, 'SAL-160823HDIG', 7, 35, 10000, '2023-04-30 00:00:00', '0000-00-00 00:00:00'),
(172, 'SAL-160823HDIG', 1, 19, 26000, '2023-04-30 00:00:00', '0000-00-00 00:00:00'),
(173, 'SAL-160823HDIG', 2, 58, 34000, '2023-04-30 00:00:00', '0000-00-00 00:00:00'),
(174, 'SAL-160823HDIG', 2, 100, 18000, '2023-04-30 00:00:00', '0000-00-00 00:00:00'),
(175, 'SAL-1608238AT8', 6, 84, 28000, '2023-05-09 00:00:00', '0000-00-00 00:00:00'),
(176, 'SAL-1608238AT8', 6, 41, 18000, '2023-05-09 00:00:00', '0000-00-00 00:00:00'),
(177, 'SAL-1608238AT8', 2, 93, 14000, '2023-05-09 00:00:00', '0000-00-00 00:00:00'),
(178, 'SAL-1608238AT8', 5, 76, 24000, '2023-05-09 00:00:00', '0000-00-00 00:00:00'),
(179, 'SAL-1608238AT8', 5, 38, 40000, '2023-05-09 00:00:00', '0000-00-00 00:00:00'),
(180, 'SAL-160823SBWC', 2, 46, 16000, '2023-05-23 00:00:00', '0000-00-00 00:00:00'),
(181, 'SAL-160823SBWC', 2, 62, 54000, '2023-05-23 00:00:00', '0000-00-00 00:00:00'),
(182, 'SAL-160823SBWC', 8, 76, 44000, '2023-05-23 00:00:00', '0000-00-00 00:00:00'),
(183, 'SAL-160823SBWC', 4, 36, 40000, '2023-05-23 00:00:00', '0000-00-00 00:00:00'),
(184, 'SAL-16082312X0', 4, 6, 50000, '2023-08-13 00:00:00', '0000-00-00 00:00:00'),
(185, 'SAL-16082312X0', 2, 69, 26000, '2023-08-13 00:00:00', '0000-00-00 00:00:00'),
(186, 'SAL-16082312X0', 1, 33, 14000, '2023-08-13 00:00:00', '0000-00-00 00:00:00'),
(187, 'SAL-160823F2B3', 4, 63, 14000, '2023-01-20 00:00:00', '0000-00-00 00:00:00'),
(188, 'SAL-160823WHD2', 6, 91, 14000, '2023-03-16 00:00:00', '0000-00-00 00:00:00'),
(189, 'SAL-1608233R4O', 2, 8, 42000, '2023-02-26 00:00:00', '0000-00-00 00:00:00'),
(190, 'SAL-1608233R4O', 3, 83, 14000, '2023-02-26 00:00:00', '0000-00-00 00:00:00'),
(191, 'SAL-1608233R4O', 2, 65, 28000, '2023-02-26 00:00:00', '0000-00-00 00:00:00'),
(192, 'SAL-16082379QG', 2, 55, 52000, '2023-03-07 00:00:00', '0000-00-00 00:00:00'),
(193, 'SAL-16082379QG', 1, 90, 44000, '2023-03-07 00:00:00', '0000-00-00 00:00:00'),
(194, 'SAL-16082379QG', 8, 39, 50000, '2023-03-07 00:00:00', '0000-00-00 00:00:00'),
(195, 'SAL-160823RZD0', 5, 20, 24000, '2023-06-01 00:00:00', '0000-00-00 00:00:00'),
(196, 'SAL-160823RZD0', 2, 92, 34000, '2023-06-01 00:00:00', '0000-00-00 00:00:00'),
(197, 'SAL-160823RZD0', 4, 20, 38000, '2023-06-01 00:00:00', '0000-00-00 00:00:00'),
(198, 'SAL-1608237600', 2, 50, 28000, '2023-01-18 00:00:00', '0000-00-00 00:00:00'),
(199, 'SAL-1608237600', 3, 67, 40000, '2023-01-18 00:00:00', '0000-00-00 00:00:00'),
(200, 'SAL-1608237600', 4, 58, 16000, '2023-01-18 00:00:00', '0000-00-00 00:00:00'),
(201, 'SAL-160823WG1M', 5, 21, 32000, '2023-07-08 00:00:00', '0000-00-00 00:00:00'),
(202, 'SAL-160823WG1M', 8, 80, 24000, '2023-07-08 00:00:00', '0000-00-00 00:00:00'),
(203, 'SAL-160823WG1M', 5, 43, 40000, '2023-07-08 00:00:00', '0000-00-00 00:00:00'),
(204, 'SAL-160823WG1M', 4, 7, 30000, '2023-07-08 00:00:00', '0000-00-00 00:00:00'),
(205, 'SAL-160823WG1M', 4, 10, 12000, '2023-07-08 00:00:00', '0000-00-00 00:00:00'),
(206, 'SAL-160823AYRW', 4, 47, 42000, '2023-07-23 00:00:00', '0000-00-00 00:00:00'),
(207, 'SAL-160823AYRW', 4, 5, 40000, '2023-07-23 00:00:00', '0000-00-00 00:00:00'),
(208, 'SAL-160823AYRW', 2, 75, 44000, '2023-07-23 00:00:00', '0000-00-00 00:00:00'),
(209, 'SAL-160823AYRW', 4, 16, 32000, '2023-07-23 00:00:00', '0000-00-00 00:00:00'),
(210, 'SAL-1608232U7E', 5, 67, 12000, '2023-04-07 00:00:00', '0000-00-00 00:00:00'),
(211, 'SAL-1608232U7E', 6, 44, 18000, '2023-04-07 00:00:00', '0000-00-00 00:00:00'),
(212, 'SAL-1608232U7E', 2, 72, 40000, '2023-04-07 00:00:00', '0000-00-00 00:00:00'),
(213, 'SAL-1608232U7E', 2, 46, 18000, '2023-04-07 00:00:00', '0000-00-00 00:00:00'),
(214, 'SAL-1608232U7E', 7, 49, 48000, '2023-04-07 00:00:00', '0000-00-00 00:00:00'),
(215, 'SAL-160823NHEB', 2, 65, 44000, '2023-03-06 00:00:00', '0000-00-00 00:00:00'),
(216, 'SAL-16082385RK', 3, 77, 42000, '2023-03-06 00:00:00', '0000-00-00 00:00:00'),
(217, 'SAL-16082385RK', 2, 78, 18000, '2023-03-06 00:00:00', '0000-00-00 00:00:00'),
(218, 'SAL-16082385RK', 7, 63, 44000, '2023-03-06 00:00:00', '0000-00-00 00:00:00'),
(219, 'SAL-16082385RK', 8, 30, 24000, '2023-03-06 00:00:00', '0000-00-00 00:00:00'),
(220, 'SAL-160823NXVK', 8, 7, 54000, '2023-05-21 00:00:00', '0000-00-00 00:00:00'),
(221, 'SAL-160823NXVK', 4, 6, 52000, '2023-05-21 00:00:00', '0000-00-00 00:00:00'),
(222, 'SAL-160823NXVK', 5, 48, 44000, '2023-05-21 00:00:00', '0000-00-00 00:00:00'),
(223, 'SAL-160823NXVK', 1, 18, 12000, '2023-05-21 00:00:00', '0000-00-00 00:00:00'),
(224, 'SAL-160823E2Z5', 5, 20, 52000, '2023-01-05 00:00:00', '0000-00-00 00:00:00'),
(225, 'SAL-160823E2Z5', 8, 68, 28000, '2023-01-05 00:00:00', '0000-00-00 00:00:00'),
(226, 'SAL-160823E2Z5', 7, 36, 26000, '2023-01-05 00:00:00', '0000-00-00 00:00:00'),
(227, 'SAL-160823DU67', 4, 94, 38000, '2023-08-09 00:00:00', '0000-00-00 00:00:00'),
(228, 'SAL-160823DU67', 7, 80, 50000, '2023-08-09 00:00:00', '0000-00-00 00:00:00'),
(229, 'SAL-160823DU67', 2, 15, 16000, '2023-08-09 00:00:00', '0000-00-00 00:00:00'),
(230, 'SAL-160823CF0C', 5, 52, 38000, '2023-04-28 00:00:00', '0000-00-00 00:00:00'),
(231, 'SAL-160823CF0C', 5, 99, 40000, '2023-04-28 00:00:00', '0000-00-00 00:00:00'),
(232, 'SAL-160823CF0C', 1, 11, 46000, '2023-04-28 00:00:00', '0000-00-00 00:00:00'),
(233, 'SAL-160823CF0C', 1, 39, 22000, '2023-04-28 00:00:00', '0000-00-00 00:00:00'),
(234, 'SAL-160823CF0C', 6, 94, 40000, '2023-04-28 00:00:00', '0000-00-00 00:00:00'),
(235, 'SAL-160823S06B', 8, 5, 44000, '2023-01-23 00:00:00', '0000-00-00 00:00:00'),
(236, 'SAL-160823S06B', 7, 42, 16000, '2023-01-23 00:00:00', '0000-00-00 00:00:00'),
(237, 'SAL-160823S06B', 5, 68, 40000, '2023-01-23 00:00:00', '0000-00-00 00:00:00'),
(238, 'SAL-160823S06B', 3, 32, 22000, '2023-01-23 00:00:00', '0000-00-00 00:00:00'),
(239, 'SAL-160823S06B', 4, 78, 46000, '2023-01-23 00:00:00', '0000-00-00 00:00:00'),
(240, 'SAL-160823DNF6', 4, 15, 16000, '2023-05-09 00:00:00', '0000-00-00 00:00:00'),
(241, 'SAL-160823DNF6', 2, 80, 30000, '2023-05-09 00:00:00', '0000-00-00 00:00:00'),
(242, 'SAL-160823DNF6', 6, 71, 14000, '2023-05-09 00:00:00', '0000-00-00 00:00:00'),
(243, 'SAL-160823DNF6', 4, 69, 22000, '2023-05-09 00:00:00', '0000-00-00 00:00:00'),
(244, 'SAL-160823DNF6', 1, 66, 40000, '2023-05-09 00:00:00', '0000-00-00 00:00:00'),
(245, 'SAL-1608239UBD', 8, 53, 48000, '2023-07-16 00:00:00', '0000-00-00 00:00:00'),
(246, 'SAL-1608239UBD', 2, 98, 20000, '2023-07-16 00:00:00', '0000-00-00 00:00:00'),
(247, 'SAL-160823HW2J', 2, 67, 14000, '2023-03-30 00:00:00', '0000-00-00 00:00:00'),
(248, 'SAL-160823HW2J', 8, 57, 12000, '2023-03-30 00:00:00', '0000-00-00 00:00:00'),
(249, 'SAL-160823HW2J', 7, 37, 36000, '2023-03-30 00:00:00', '0000-00-00 00:00:00'),
(250, 'SAL-160823HW2J', 6, 24, 52000, '2023-03-30 00:00:00', '0000-00-00 00:00:00'),
(251, 'SAL-160823WHKA', 8, 80, 10000, '2023-05-12 00:00:00', '0000-00-00 00:00:00'),
(252, 'SAL-160823WHKA', 3, 30, 44000, '2023-05-12 00:00:00', '0000-00-00 00:00:00'),
(253, 'SAL-160823WHKA', 7, 95, 10000, '2023-05-12 00:00:00', '0000-00-00 00:00:00'),
(254, 'SAL-160823WHKA', 6, 10, 10000, '2023-05-12 00:00:00', '0000-00-00 00:00:00'),
(255, 'SAL-160823SSYW', 7, 43, 50000, '2023-02-01 00:00:00', '0000-00-00 00:00:00'),
(256, 'SAL-160823SSYW', 2, 62, 36000, '2023-02-01 00:00:00', '0000-00-00 00:00:00'),
(257, 'SAL-160823SSYW', 4, 92, 28000, '2023-02-01 00:00:00', '0000-00-00 00:00:00'),
(258, 'SAL-160823JAK7', 5, 39, 20000, '2023-05-20 00:00:00', '0000-00-00 00:00:00'),
(259, 'SAL-160823RPF0', 1, 19, 50000, '2023-04-16 00:00:00', '0000-00-00 00:00:00'),
(260, 'SAL-160823RPF0', 5, 4, 50000, '2023-04-16 00:00:00', '0000-00-00 00:00:00'),
(261, 'SAL-160823RPF0', 7, 77, 26000, '2023-04-16 00:00:00', '0000-00-00 00:00:00'),
(262, 'SAL-160823RPF0', 3, 78, 50000, '2023-04-16 00:00:00', '0000-00-00 00:00:00'),
(263, 'SAL-160823RPF0', 5, 37, 16000, '2023-04-16 00:00:00', '0000-00-00 00:00:00'),
(264, 'SAL-1608235RBK', 5, 87, 46000, '2023-06-30 00:00:00', '0000-00-00 00:00:00'),
(265, 'SAL-160823FRE2', 5, 63, 26000, '2023-06-17 00:00:00', '0000-00-00 00:00:00'),
(266, 'SAL-160823FRE2', 4, 34, 22000, '2023-06-17 00:00:00', '0000-00-00 00:00:00'),
(267, 'SAL-160823FRE2', 8, 80, 38000, '2023-06-17 00:00:00', '0000-00-00 00:00:00'),
(268, 'SAL-160823FRE2', 1, 78, 48000, '2023-06-17 00:00:00', '0000-00-00 00:00:00'),
(269, 'SAL-160823FRE2', 3, 47, 34000, '2023-06-17 00:00:00', '0000-00-00 00:00:00'),
(270, 'SAL-16082333UU', 2, 14, 44000, '2023-03-15 00:00:00', '0000-00-00 00:00:00'),
(271, 'SAL-16082333UU', 4, 43, 26000, '2023-03-15 00:00:00', '0000-00-00 00:00:00'),
(272, 'SAL-16082333UU', 6, 9, 28000, '2023-03-15 00:00:00', '0000-00-00 00:00:00'),
(273, 'SAL-160823ZTJI', 5, 65, 14000, '2023-02-16 00:00:00', '0000-00-00 00:00:00'),
(274, 'SAL-160823ZTJI', 5, 51, 42000, '2023-02-16 00:00:00', '0000-00-00 00:00:00'),
(275, 'SAL-160823GG4G', 1, 23, 26000, '2023-03-12 00:00:00', '0000-00-00 00:00:00'),
(276, 'SAL-16082333G3', 8, 30, 28000, '2023-04-01 00:00:00', '0000-00-00 00:00:00'),
(277, 'SAL-16082333G3', 8, 36, 20000, '2023-04-01 00:00:00', '0000-00-00 00:00:00'),
(278, 'SAL-16082333G3', 4, 22, 28000, '2023-04-01 00:00:00', '0000-00-00 00:00:00'),
(279, 'SAL-1608239WXN', 2, 85, 40000, '2023-06-18 00:00:00', '0000-00-00 00:00:00'),
(280, 'SAL-1608239WXN', 4, 29, 24000, '2023-06-18 00:00:00', '0000-00-00 00:00:00'),
(281, 'SAL-1608239WXN', 3, 68, 44000, '2023-06-18 00:00:00', '0000-00-00 00:00:00'),
(282, 'SAL-1608239WXN', 5, 7, 20000, '2023-06-18 00:00:00', '0000-00-00 00:00:00'),
(283, 'SAL-1608239WXN', 7, 100, 12000, '2023-06-18 00:00:00', '0000-00-00 00:00:00'),
(284, 'SAL-160823J6VL', 1, 21, 50000, '2023-01-26 00:00:00', '0000-00-00 00:00:00'),
(285, 'SAL-160823J6VL', 2, 39, 14000, '2023-01-26 00:00:00', '0000-00-00 00:00:00'),
(286, 'SAL-160823J6VL', 6, 16, 24000, '2023-01-26 00:00:00', '0000-00-00 00:00:00'),
(287, 'SAL-160823VHD4', 4, 87, 12000, '2023-05-21 00:00:00', '0000-00-00 00:00:00'),
(288, 'SAL-160823KLSZ', 7, 60, 54000, '2023-02-27 00:00:00', '0000-00-00 00:00:00'),
(289, 'SAL-160823UKNH', 4, 71, 32000, '2023-05-21 00:00:00', '0000-00-00 00:00:00'),
(290, 'SAL-160823UKNH', 4, 60, 46000, '2023-05-21 00:00:00', '0000-00-00 00:00:00'),
(291, 'SAL-160823UKNH', 7, 17, 24000, '2023-05-21 00:00:00', '0000-00-00 00:00:00'),
(292, 'SAL-160823UKNH', 5, 62, 34000, '2023-05-21 00:00:00', '0000-00-00 00:00:00'),
(293, 'SAL-160823LNNV', 1, 67, 10000, '2023-02-25 00:00:00', '0000-00-00 00:00:00'),
(294, 'SAL-160823LNNV', 4, 34, 34000, '2023-02-25 00:00:00', '0000-00-00 00:00:00'),
(295, 'SAL-160823LC8J', 1, 70, 54000, '2023-01-25 00:00:00', '0000-00-00 00:00:00'),
(296, 'SAL-160823LC8J', 2, 44, 16000, '2023-01-25 00:00:00', '0000-00-00 00:00:00'),
(297, 'SAL-160823LC8J', 2, 74, 30000, '2023-01-25 00:00:00', '0000-00-00 00:00:00'),
(298, 'SAL-160823UN9D', 1, 24, 34000, '2023-06-02 00:00:00', '0000-00-00 00:00:00'),
(299, 'SAL-160823BPKK', 1, 37, 20000, '2023-07-30 00:00:00', '0000-00-00 00:00:00'),
(300, 'SAL-160823BPKK', 1, 77, 28000, '2023-07-30 00:00:00', '0000-00-00 00:00:00'),
(301, 'SAL-160823BPKK', 6, 38, 14000, '2023-07-30 00:00:00', '0000-00-00 00:00:00'),
(302, 'SAL-160823BPKK', 2, 33, 18000, '2023-07-30 00:00:00', '0000-00-00 00:00:00'),
(303, 'SAL-160823J068', 5, 36, 38000, '2023-01-17 00:00:00', '0000-00-00 00:00:00'),
(304, 'SAL-160823J068', 4, 84, 12000, '2023-01-17 00:00:00', '0000-00-00 00:00:00'),
(305, 'SAL-160823J068', 7, 10, 34000, '2023-01-17 00:00:00', '0000-00-00 00:00:00'),
(306, 'SAL-160823J068', 5, 56, 22000, '2023-01-17 00:00:00', '0000-00-00 00:00:00'),
(307, 'SAL-160823J068', 6, 44, 24000, '2023-01-17 00:00:00', '0000-00-00 00:00:00'),
(308, 'SAL-160823SA8Q', 4, 42, 10000, '2023-02-07 00:00:00', '0000-00-00 00:00:00'),
(309, 'SAL-160823SA8Q', 5, 41, 38000, '2023-02-07 00:00:00', '0000-00-00 00:00:00'),
(310, 'SAL-1608236H7D', 3, 50, 18000, '2023-05-23 00:00:00', '0000-00-00 00:00:00'),
(311, 'SAL-1608236H7D', 3, 15, 10000, '2023-05-23 00:00:00', '0000-00-00 00:00:00'),
(312, 'SAL-1608236H7D', 2, 79, 24000, '2023-05-23 00:00:00', '0000-00-00 00:00:00'),
(313, 'SAL-160823O2NN', 4, 66, 28000, '2023-01-05 00:00:00', '0000-00-00 00:00:00'),
(314, 'SAL-160823O2NN', 1, 64, 36000, '2023-01-05 00:00:00', '0000-00-00 00:00:00'),
(315, 'SAL-160823O2NN', 2, 43, 10000, '2023-01-05 00:00:00', '0000-00-00 00:00:00'),
(316, 'SAL-160823O2NN', 4, 85, 38000, '2023-01-05 00:00:00', '0000-00-00 00:00:00'),
(317, 'SAL-16082380UQ', 6, 82, 12000, '2023-06-03 00:00:00', '0000-00-00 00:00:00'),
(318, 'SAL-16082380UQ', 4, 11, 44000, '2023-06-03 00:00:00', '0000-00-00 00:00:00'),
(319, 'SAL-16082380UQ', 5, 69, 44000, '2023-06-03 00:00:00', '0000-00-00 00:00:00'),
(320, 'SAL-160823XO94', 1, 17, 36000, '2023-04-13 00:00:00', '0000-00-00 00:00:00'),
(321, 'SAL-160823XO94', 7, 96, 44000, '2023-04-13 00:00:00', '0000-00-00 00:00:00'),
(322, 'SAL-160823XO94', 8, 2, 50000, '2023-04-13 00:00:00', '0000-00-00 00:00:00'),
(323, 'SAL-1608239HXU', 6, 79, 22000, '2023-06-21 00:00:00', '0000-00-00 00:00:00'),
(324, 'SAL-1608239HXU', 4, 99, 40000, '2023-06-21 00:00:00', '0000-00-00 00:00:00'),
(325, 'SAL-160823BG9S', 8, 95, 36000, '2023-05-26 00:00:00', '0000-00-00 00:00:00'),
(326, 'SAL-160823BG9S', 5, 19, 24000, '2023-05-26 00:00:00', '0000-00-00 00:00:00'),
(327, 'SAL-160823P5WT', 3, 95, 36000, '2023-04-25 00:00:00', '0000-00-00 00:00:00'),
(328, 'SAL-160823P5WT', 5, 13, 20000, '2023-04-25 00:00:00', '0000-00-00 00:00:00'),
(329, 'SAL-16082333XK', 1, 89, 46000, '2023-06-05 00:00:00', '0000-00-00 00:00:00'),
(330, 'SAL-16082333XK', 5, 67, 36000, '2023-06-05 00:00:00', '0000-00-00 00:00:00'),
(331, 'SAL-160823H53I', 3, 65, 42000, '2023-03-08 00:00:00', '0000-00-00 00:00:00'),
(332, 'SAL-160823H53I', 6, 16, 10000, '2023-03-08 00:00:00', '0000-00-00 00:00:00'),
(333, 'SAL-160823H53I', 7, 36, 22000, '2023-03-08 00:00:00', '0000-00-00 00:00:00'),
(334, 'SAL-160823H53I', 3, 84, 10000, '2023-03-08 00:00:00', '0000-00-00 00:00:00'),
(335, 'SAL-160823L1IL', 3, 71, 48000, '2023-05-03 00:00:00', '0000-00-00 00:00:00'),
(336, 'SAL-160823L1IL', 5, 18, 48000, '2023-05-03 00:00:00', '0000-00-00 00:00:00'),
(337, 'SAL-160823L1IL', 3, 26, 14000, '2023-05-03 00:00:00', '0000-00-00 00:00:00'),
(338, 'SAL-1608235RYF', 4, 77, 10000, '2023-01-12 00:00:00', '0000-00-00 00:00:00'),
(339, 'SAL-1608235RYF', 6, 32, 42000, '2023-01-12 00:00:00', '0000-00-00 00:00:00'),
(340, 'SAL-160823QXQP', 1, 58, 22000, '2023-02-20 00:00:00', '0000-00-00 00:00:00'),
(341, 'SAL-160823QXQP', 1, 39, 44000, '2023-02-20 00:00:00', '0000-00-00 00:00:00'),
(342, 'SAL-160823MQWD', 7, 48, 36000, '2023-04-05 00:00:00', '0000-00-00 00:00:00'),
(343, 'SAL-160823KMSL', 4, 20, 42000, '2023-01-26 00:00:00', '0000-00-00 00:00:00'),
(344, 'SAL-160823KMSL', 6, 84, 14000, '2023-01-26 00:00:00', '0000-00-00 00:00:00'),
(345, 'SAL-160823KMSL', 8, 81, 10000, '2023-01-26 00:00:00', '0000-00-00 00:00:00'),
(346, 'SAL-160823KMSL', 2, 60, 12000, '2023-01-26 00:00:00', '0000-00-00 00:00:00'),
(347, 'SAL-160823B79Z', 3, 10, 46000, '2023-04-24 00:00:00', '0000-00-00 00:00:00'),
(348, 'SAL-160823B79Z', 2, 59, 14000, '2023-04-24 00:00:00', '0000-00-00 00:00:00'),
(349, 'SAL-160823B79Z', 2, 65, 30000, '2023-04-24 00:00:00', '0000-00-00 00:00:00'),
(350, 'SAL-160823B79Z', 3, 30, 14000, '2023-04-24 00:00:00', '0000-00-00 00:00:00'),
(351, 'SAL-160823YH00', 6, 69, 32000, '2023-03-10 00:00:00', '0000-00-00 00:00:00'),
(352, 'SAL-160823YH00', 3, 97, 40000, '2023-03-10 00:00:00', '0000-00-00 00:00:00'),
(353, 'SAL-160823YH00', 5, 20, 10000, '2023-03-10 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `selling`
--

CREATE TABLE `selling` (
  `selling_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `unit` varchar(255) NOT NULL,
  `stock` int UNSIGNED NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `selling`
--

INSERT INTO `selling` (`selling_id`, `name`, `price`, `unit`, `stock`, `updated_at`, `created_at`) VALUES
(1, 'Roti Maryam Kemasan 5pc', 18000, 'bungkus', 85, '2023-08-08 17:06:04', '2023-08-05 09:51:07'),
(2, 'Sambosa Mentah Isi 5pc', 10000, 'mika', 100, '2023-08-08 17:02:26', '2023-08-05 10:26:01'),
(3, 'Pentol Bakso Daging Maju Mapan', 28000, 'bungkus', 58, '2023-08-09 10:14:01', '2023-08-07 01:18:01'),
(4, 'Sambosa Mentah Isi 10pc', 20000, 'mika', 80, '2023-08-08 17:06:46', '2023-08-08 15:26:01'),
(5, 'Durpas (Durian Kupas) Mentawai', 50000, 'buah', 50, '2023-08-08 17:06:26', '2023-08-08 15:29:59'),
(6, 'Kulit Lumpia Jaya Abadi', 20000, 'bungkus', 100, '2023-08-08 17:04:34', '2023-08-08 15:30:41'),
(7, 'Durpas (Durian Kupas) Nias', 55000, 'buah', 40, '2023-08-08 17:06:33', '2023-08-08 15:31:17'),
(8, 'Durpas (Durian Kupas) Sibolga', 55000, 'buah', 25, '2023-08-08 17:06:38', '2023-08-08 15:32:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone`, `address`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Abu Hafizh', '081387389378', 'Masuk gang samping roti gambung M.Haris, Jl. Kemuning No.25, RT.32/RW.06, belakang bestmeat, Kemuning, Kota Banjar Baru', 'Agen Kulit Lumpia', '2023-06-27 03:25:09', '2023-08-08 15:07:21'),
(2, 'Toko Beras Srikandi', '087788389378', 'Jakarta Selatan', 'Agen Beras Basmati Daawat', '2023-06-27 03:26:03', '2023-08-08 15:12:09'),
(3, 'Toko Rempah Ipul', '083910389378', 'Jl. abd. azis RT. IV no. 89, komplek pasar, Antasari, Kec. Amuntai Tengah, Kabupaten Hulu Sungai Utara', 'Agen Kapulaga Murah', '2023-08-08 15:14:22', '2023-08-08 15:14:22'),
(4, 'Ibu Ayam Pasar', '081386677378', 'Pasar hanyar keraton, Rantau', 'Jual ayam potong', '2023-08-08 15:17:05', '2023-08-08 15:17:05'),
(5, 'Toko H. Ijak', '082290679378', 'Seberang jalan masuk pasar hanyar, Rantau', 'Jual sembako', '2023-08-08 15:18:08', '2023-08-08 15:18:08'),
(6, 'Toko Beras H. Hasyim', '085577891378', 'Jl. Hakim Samad, Antasari, Walang', 'Jual beras', '2023-08-08 15:20:20', '2023-08-08 15:20:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tables`
--

CREATE TABLE `tables` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tables`
--

INSERT INTO `tables` (`id`, `user_id`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 103, 'vDohqTL6E9B6g2a5SZRyQlCln0pJRLvIaroxb27E.jpg', 'Meja nomor 1, berada di sebelah paling kiri', '2023-08-08 14:54:00', '2023-08-08 14:55:52'),
(2, 104, 'ScVlB6kOfMq3IkFUVGZ4Qsm1sha1FgoWqhlfMlVj.jpg', 'Meja nomor 2, berada di sebelah kiri dan bersebelahan dengan meja nomor 1', '2023-08-08 14:54:45', '2023-08-08 14:56:07'),
(3, 105, 'RFfhGXDcS04VtO9toQA8KotWR4EREgF53uZYFqPi.jpg', 'Meja nomor 3, berada di tengah', '2023-08-08 14:55:23', '2023-08-08 14:55:23'),
(4, 106, 'dLsLGbwZNNqaB8jezNOuMCrFssGRFZ9yZs0Kmxlb.jpg', 'Meja nomor 4, berada di sebelah kanan dan bersebelahan dengan meja nomor 3', '2023-08-08 14:56:48', '2023-08-08 14:56:48'),
(5, 112, 'S6lRF9yi5RE5jnK6no4jexPks6ucopvUuncDV6TG.jpg', 'Meja nomor 5, berada di sebelah paling kanan', '2023-08-08 14:57:20', '2023-08-08 14:57:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tests`
--

CREATE TABLE `tests` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` enum('admin','customer') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `phone`, `role`, `created_at`, `updated_at`) VALUES
(1, 'H.Bajuri', 'admin', '$2y$10$M0guiAeQjCgnq0tjCB5rzOBcOugaG9iGsXdXGndi1UYbZFP3mkWOC', '081234567891', 'admin', '2023-06-17 14:02:32', '2023-07-12 00:05:30'),
(3, 'Harto Gaiman Budiyanto', 'kayla.gunawan', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0898765432109', 'customer', '2023-06-17 14:02:32', '2023-08-16 09:36:42'),
(4, 'Yessi Hariyah', 'mahendra.aslijan', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0810192837465', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(5, 'Kenzie Oman Firmansyah', 'nnashiruddin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08115678901234', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(6, 'Caraka Adriansyah S.H.', 'asuryatmi', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08110567890321', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(7, 'Irma Prastuti', 'raden.pranowo', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '089012345678', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(8, 'Intan Kartika Namaga S.Pt', 'citra12', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08109876543211', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(9, 'Jono Wijaya', 'irfan46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08123456789101', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(10, 'Adika Lazuardi M.Farm', 'cager.hutapea', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08134455667788', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(11, 'Elon Bahuwirya Hakim', 'mhasanah', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '081234567890', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(12, 'Soleh Megantara', 'hutasoit.jamal', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0897654321098', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(13, 'Opung Widodo', 'panji.saptono', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0819081726354', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(14, 'Cawisadi Jumari Hutapea M.TI.', 'balijan.widodo', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08114567890123', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(15, 'Zizi Dian Agustina S.T.', 'rajasa.ade', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08110567984321', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(16, 'Respati Pradana', 'maheswara.natalia', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '089098765434', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(17, 'Hamima Utami', 'usantoso', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08109786543212', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(18, 'Irnanto Saragih M.Farm', 'titin10', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08123456789102', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(19, 'Martani Tamba', 'yance78', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08134455667789', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(20, 'Narji Sihombing', 'ajeng75', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '081987654321', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(21, 'Patricia Titin Laksmiwati S.T.', 'siska62', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0897654321098', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(22, 'Winda Siti Hassanah M.Pd', 'nasab80', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0812345678098', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(23, 'Laila Wani Nurdiyanti', 'gpuspita', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08115678901238', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(24, 'Bella Yulianti', 'santoso.liman', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08110567894321', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(25, 'Cici Lailasari', 'siregar.taswir', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '089012345643', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(26, 'Halima Hartati S.Gz', 'nuyainah', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08109876543218', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(27, 'Ana Winarsih', 'karja.anggraini', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08123456789109', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(28, 'Manah Waluyo S.E.', 'msiregar', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '08134455667088', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(29, 'Lulut Salahudin', 'cici.wulandari', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '081876543210', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(30, 'Mumpuni Umaya Siregar', 'hutagalung.samsul', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0895432109876', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(31, 'Restu Rika Mulyani', 'damanik.eka', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0812345678123', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(32, 'Tira Mulyani', 'najam.puspita', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+881971448835', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(33, 'Edward Firmansyah', 'kastuti', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+968586179579', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(34, 'Johan Hardiansyah S.Kom', 'permadi.ulya', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+376671705428', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(35, 'Purwanto Tampubolon', 'zalindra76', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+681549750607', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(36, 'Salwa Nasyiah S.I.Kom', 'jayeng.siregar', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+50074566', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(37, 'Dariati Simanjuntak', 'wirda.winarsih', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+861622702562', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(38, 'Cager Prasasta', 'namaga.lukita', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+540540857995', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(39, 'Zaenab Rahmawati', 'saadat58', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+5955623365662', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(40, 'Cakrawangsa Sihotang', 'nainggolan.oni', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+2973627638', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(41, 'Vinsen Santoso', 'oastuti', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+50078253', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(42, 'Dina Pratiwi', 'embuh12', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+3813587949721', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(43, 'Samsul Marpaung', 'mahesa.wastuti', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+264613686523', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(44, 'Baktiadi Rajasa', 'siska.putra', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+815900996176', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(45, 'Harsaya Thamrin', 'gamblang.anggraini.supian.hariadi.kartojoyo', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+272258291679', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(46, 'Kunthara Tarihoran', 'waluyo47', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+50623547059', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(47, 'Zulaikha Shania Permata', 'dtarihoran', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+6929164385', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(48, 'Gasti Wahyuni', 'pangestu.kenes', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+387684126268', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(49, 'Amalia Usamah', 'siska.mangunsong', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+5074338490978', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(50, 'Rusman Hutagalung M.M.', 'yosef75', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+421689646294', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(51, 'Dewi Ophelia Uyainah S.Kom', 'salsabila.sitompul', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+530769899440', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(52, 'Dagel Cakrabirawa Sinaga', 'irajata', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+23560274411', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(53, 'Farhunnisa Handayani', 'ohariyah', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+9641883018361', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(54, 'Limar Iswahyudi M.M.', 'taufan93', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+2258820306551', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(55, 'Salman Waskita', 'pmandasari', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+9712878470667', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(56, 'Yance Usyi Riyanti S.Kom', 'wasita.hafshah', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+85301856649', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(57, 'Caturangga Respati Uwais', 'hasanah.yosef', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+50018132', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(58, 'Farhunnisa Raisa Farida', 'kuswoyo.fathonah', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+93800108289', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(59, 'Salimah Wahyuni', 'ykuswoyo', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+2202876467', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(60, 'Titin Astuti', 'samiah50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+5018525649', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(61, 'Hamzah Saefullah S.Farm', 'ratna93', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+212484833083', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(62, 'Ibrahim Sihombing', 'narji88', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+231845107296', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(63, 'Samsul Kalim Narpati S.T.', 'hidayanto.pia', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+22919419423', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(64, 'Umay Adriansyah', 'hassanah.kani', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+6775858949', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(65, 'Hana Pertiwi', 'tiara.nainggolan', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+5956336044596', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(66, 'Ihsan Maras Damanik', 'cinthia.prakasa', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+243946853578', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(67, 'Edward Zulkarnain', 'kuswoyo.raden', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+355590047862', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(68, 'Asmadi Permadi S.I.Kom', 'hutasoit.ulva', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+382220804267', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(69, 'Catur Dartono Siregar M.Farm', 'martani36', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+50921609575', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(70, 'Cengkal Suryono', 'puwais', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+918076316177', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(71, 'Karma Napitupulu', 'tania36', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+614033027246', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(72, 'Jamal Heryanto Iswahyudi', 'novitasari.lasmanto', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+22833897010', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(73, 'Kurnia Pratama', 'hasna.yolanda', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+50575513022', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(74, 'Darmaji Firgantoro', 'soleh.marpaung', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+542595433641', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(75, 'Tomi Wahyudin', 'cengkir83', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+651872203748', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(76, 'Irnanto Uwais', 'nurul01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+97542189910', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(77, 'Zahra Belinda Yolanda S.Gz', 'firmansyah.simon', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+260113915102', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(78, 'Endra Narpati S.E.I', 'natsir.asmuni', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+534521245160', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(79, 'Calista Kusmawati', 'mandasari.vivi', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+34019481926', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(80, 'Warsa Pratama', 'tarihoran.pia', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+878869034958796', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(81, 'Queen Fitria Utami S.E.I', 'unggul63', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+24182889192', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(82, 'Kalim Uwais', 'tugiman08', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+881832508141', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(83, 'Jagaraga Waluyo', 'bmaryati', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+24143659031', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(84, 'Septi Usada S.H.', 'situmorang.panji', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+260057276236', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(85, 'Bella Sari Sudiati M.M.', 'maya.rahayu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+5957683582768', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(86, 'Belinda Yuliarti', 'belinda.melani', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+617693000088', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(87, 'Banawi Bakidin Tampubolon', 'handayani.luis', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+38968489783', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(88, 'Harimurti Prakasa M.Pd', 'kasusra71', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+383322256484', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(89, 'Gabriella Bella Lailasari', 'adiarja04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+265656393293', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(90, 'Bakidin Eko Narpati S.H.', 'wawan.kuswandari', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+50534622342', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(91, 'Vivi Padmasari', 'eka.wulandari', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+67013418787', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(92, 'Eva Gabriella Prastuti S.Pt', 'haryanti.tania', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+6761962461', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(93, 'Azalea Gina Agustina', 'bakiadi.halimah', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+34709421742', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(94, 'Salsabila Purnawati', 'hakim.darmana', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+59944706455', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(95, 'Darmana Prabowo', 'znashiruddin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+994322158880', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(96, 'Ika Nuraini', 'wasita.jati', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+6883044020', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(97, 'Wawan Nainggolan S.I.Kom', 'indah.santoso', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+962121117505', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(99, 'Tina Rahmi Aryani S.Psi', 'tarihoran.nasrullah', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+299974187', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(100, 'Umi Lidya Hassanah S.Pt', 'winarno.ratih', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+5985632421455', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(101, 'Ikhsan Samosir', 'ira.budiyanto', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+2208791612', 'customer', '2023-06-17 14:02:32', '2023-06-17 14:02:32'),
(102, 'Muhammad Fadhilah', 'dhilah', '$2y$10$uy2/2pOB28rewhyf6bL3tetzyZHN07gG7wps/ASSb84u6eVNntPlu', '01151154454', 'customer', '2023-06-18 14:48:29', '2023-06-18 14:48:29'),
(103, 'Meja 1', 'meja1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'customer', '2023-06-22 04:35:28', '2023-06-22 04:35:38'),
(104, 'Meja 2', 'meja2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'customer', '2023-06-22 04:35:28', '2023-06-22 04:35:38'),
(105, 'Meja 3', 'meja3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'customer', '2023-06-22 04:35:28', '2023-06-22 04:35:38'),
(106, 'Meja 4', 'meja4', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'customer', '2023-06-22 04:35:28', '2023-06-22 04:35:38'),
(107, 'Andi', 'Andiaja', '$2y$10$Ggm7063hnep8vyVZ4vGer.bhHvy4Xv534QKSHUfpN9lpSSN0OHmk2', NULL, 'customer', '2023-06-23 07:27:39', '2023-06-23 07:27:39'),
(112, 'Meja 5', 'meja5', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'customer', '2023-06-22 04:35:28', '2023-06-22 04:35:38');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_food_id_foreign` (`food_id`),
  ADD KEY `cart_items_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`) USING BTREE;

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`) USING BTREE,
  ADD UNIQUE KEY `food_slug_unique` (`slug`),
  ADD KEY `food_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `offline_orders`
--
ALTER TABLE `offline_orders`
  ADD PRIMARY KEY (`offline_order_id`),
  ADD KEY `FK_offline_orders_users` (`user_id`);

--
-- Indeks untuk tabel `offline_order_items`
--
ALTER TABLE `offline_order_items`
  ADD PRIMARY KEY (`offline_order_items_id`),
  ADD KEY `offline_order_items_offline_order_id_foreign` (`offline_order_id`),
  ADD KEY `offline_order_items_food_id_foreign` (`food_id`);

--
-- Indeks untuk tabel `online_orders`
--
ALTER TABLE `online_orders`
  ADD PRIMARY KEY (`online_order_id`),
  ADD KEY `online_orders_user_id_foreign` (`user_id`),
  ADD KEY `online_orders_reservation_id_foreign` (`reservation_id`);

--
-- Indeks untuk tabel `online_order_items`
--
ALTER TABLE `online_order_items`
  ADD PRIMARY KEY (`online_order_items_id`),
  ADD KEY `online_order_items_online_order_id_foreign` (`online_order_id`),
  ADD KEY `online_order_items_food_id_foreign` (`food_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payments_online_order_id_foreign` (`online_order_id`),
  ADD KEY `FK_payments_offline_orders` (`offline_order_id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `purchase_of_raw_materials`
--
ALTER TABLE `purchase_of_raw_materials`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `purchase_of_raw_materials_raw_material_id_foreign` (`raw_material_id`),
  ADD KEY `purchase_of_raw_materials_supplier_id_foreign` (`supplier_id`);

--
-- Indeks untuk tabel `raw_materials`
--
ALTER TABLE `raw_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indeks untuk tabel `reservation_items`
--
ALTER TABLE `reservation_items`
  ADD PRIMARY KEY (`reservation_item_id`),
  ADD KEY `reservation_items_table_id_foreign` (`table_id`),
  ADD KEY `reservation_items_reservation_id_foreign` (`reservation_id`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`) USING BTREE;

--
-- Indeks untuk tabel `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `selling_id_foreign` (`selling_id`),
  ADD KEY `sale_id` (`sale_id`);

--
-- Indeks untuk tabel `selling`
--
ALTER TABLE `selling`
  ADD PRIMARY KEY (`selling_id`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_name_unique` (`name`);

--
-- Indeks untuk tabel `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tables_users` (`user_id`);

--
-- Indeks untuk tabel `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=606;

--
-- AUTO_INCREMENT untuk tabel `cash`
--
ALTER TABLE `cash`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `food`
--
ALTER TABLE `food`
  MODIFY `food_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `offline_order_items`
--
ALTER TABLE `offline_order_items`
  MODIFY `offline_order_items_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT untuk tabel `online_order_items`
--
ALTER TABLE `online_order_items`
  MODIFY `online_order_items_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `raw_materials`
--
ALTER TABLE `raw_materials`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `reservation_items`
--
ALTER TABLE `reservation_items`
  MODIFY `reservation_item_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT untuk tabel `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=354;

--
-- AUTO_INCREMENT untuk tabel `selling`
--
ALTER TABLE `selling`
  MODIFY `selling_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `offline_orders`
--
ALTER TABLE `offline_orders`
  ADD CONSTRAINT `FK_offline_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `offline_order_items`
--
ALTER TABLE `offline_order_items`
  ADD CONSTRAINT `offline_order_items_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offline_order_items_offline_order_id_foreign` FOREIGN KEY (`offline_order_id`) REFERENCES `offline_orders` (`offline_order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `online_orders`
--
ALTER TABLE `online_orders`
  ADD CONSTRAINT `online_orders_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `online_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `online_order_items`
--
ALTER TABLE `online_order_items`
  ADD CONSTRAINT `online_order_items_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `online_order_items_online_order_id_foreign` FOREIGN KEY (`online_order_id`) REFERENCES `online_orders` (`online_order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `FK_payments_offline_orders` FOREIGN KEY (`offline_order_id`) REFERENCES `offline_orders` (`offline_order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_online_order_id_foreign` FOREIGN KEY (`online_order_id`) REFERENCES `online_orders` (`online_order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reservation_items`
--
ALTER TABLE `reservation_items`
  ADD CONSTRAINT `reservation_items_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_items_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sale_items`
--
ALTER TABLE `sale_items`
  ADD CONSTRAINT `sale_items_ibfk_1` FOREIGN KEY (`selling_id`) REFERENCES `selling` (`selling_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_items_ibfk_2` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`sale_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tables`
--
ALTER TABLE `tables`
  ADD CONSTRAINT `FK_tables_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
