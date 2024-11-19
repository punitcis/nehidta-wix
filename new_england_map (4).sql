-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 19, 2024 at 06:19 PM
-- Server version: 8.0.39-0ubuntu0.22.04.1
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_england_map`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_14_091058_create_new_england_states_table', 1),
(5, '2024_10_14_091103_create_new_england_places_table', 1),
(6, '2024_10_17_105007_create_password_resets_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `new_england_places`
--

CREATE TABLE `new_england_places` (
  `id` bigint UNSIGNED NOT NULL,
  `new_england_state_id` bigint UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` decimal(10,7) NOT NULL,
  `lng` decimal(10,7) NOT NULL,
  `project_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipient_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `year` year NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `new_england_places`
--

INSERT INTO `new_england_places` (`id`, `new_england_state_id`, `address`, `lat`, `lng`, `project_name`, `city`, `receipient_name`, `project_type`, `project_target`, `description`, `year`, `contact`, `project_link`, `facebook_link`, `youtube_link`, `created_at`, `updated_at`) VALUES
(1, 6, '101 Pine Street, Bridgeport, CT 06606', 41.1660117, -73.2072121, 'Coalition for Drug Free Escondido (CDFE)', 'Stamford', 'Town of Somers', 'Drug Free Communities Coalitions', 'Alcohol,Marijuana/Cannabis', 'hello the desription is loaded successfully', '2001', '7823-6844-3435', 'https://www.google.com', 'https://www.facebook.com/', 'https://www.youtube.com/watch?v=3KtWfp0UopM', '2024-10-14 04:29:24', '2024-11-04 04:53:29'),
(2, 3, '123 Ocean Avenue, Portland, ME 04101', 43.6757960, -70.2823530, 'Ride With Pride Coalition', 'Skowhegan', 'Waterford Community Coalition', 'CARA Coalitions', 'Marijuana/Cannabis, Tobacco/nicotine', NULL, '2002', '7823-6844-3435', 'https://www.google.com', 'https://www.facebook.com/', 'https://www.youtube.com/watch?v=3KtWfp0UopM', '2024-10-14 04:34:12', '2024-10-14 04:34:12'),
(3, 2, '789 Ocean Drive, Cape Cod, MA 02601', 41.6346722, -70.3177484, 'Clay County Anti-Drug Coalition', 'Hopkinton', 'Words of Hope 4 Life', 'National Guard Counter Drug', 'Alcohol, Heroin and fentanyl', NULL, '2003', '7823-6844-3435', 'https://www.google.com', 'https://www.facebook.com/', 'https://www.youtube.com/watch?v=3KtWfp0UopM', '2024-10-14 04:35:34', '2024-10-14 04:35:34'),
(4, 4, '321 Ocean Avenue, Providence, RI 02903', 41.7674520, -71.3905110, 'NATIONAL COUNCIL ON ALCOHOLISM AND DRUG DEPENDENTS', 'south end', 'Coastline employee assistance program, dba RISAS', 'Drug Free Communities Coalitions', 'Tobacco/nicotine', 'In a vibrant forest where sunlight filters through a thick canopy of emerald leaves', '2009', '7823-6844-3435', 'https://www.google.com', 'https://www.facebook.com/', 'https://www.youtube.com/watch?v=3KtWfp0UopM', '2024-10-14 04:36:57', '2024-10-21 08:50:26'),
(5, 3, '456 Pine Street, Bangor, ME 04401', 44.8075089, -68.7677365, 'HAMBLEN COUNTY SUBSTANCE ABUSE COALITION', 'Gardiner', 'County Substance Abuse', 'Drug Free Communities Coalitions', 'Marijuana/Cannabis, Heroin and fentanyl', NULL, '2005', '7823-6844-3435', 'https://www.google.com', 'https://www.facebook.com/', 'https://www.youtube.com/watch?v=3KtWfp0UopM', '2024-10-14 04:39:59', '2024-10-14 04:39:59'),
(6, 3, 'Millinocket, ME 04462, United States', 45.6565049, -68.7091349, 'Waterford Community Coalition', 'Millinocket', 'Clarkston', 'Drug Free Communities Coalitions', 'Heroin and fentanyl', 'In a vibrant forest where sunlight filters through a thick canopy of emerald leaves, a small brook babbles happily over smooth, rounded stones', '2007', '7823-6844-3435', 'https://www.google.com', 'https://www.facebook.com/', NULL, '2024-10-14 04:57:54', '2024-10-16 08:50:19'),
(7, 3, '227 Eustis Ridge Rd, Eustis, ME 04936, United States', 45.1912670, -70.4861435, 'Ride With Pride Coalition', 'Eustis', 'County Substance Abuse', 'Local Initiatives', 'Methamphetamine', 'In a vibrant forest where sunlight filters through a thick canopy of emerald leaves', '2008', '7823-6844-3435', 'https://www.google.com', NULL, NULL, '2024-10-14 04:59:49', '2024-11-04 03:11:26'),
(9, 5, '63 Bog Rd, Concord, NH 03303, United States', 43.2535708, -71.5890265, 'Drug Free Dickson Coalition', 'Portsmouth', 'Clarkston', 'CARA Coalitions', 'Alcohol, Tobacco/nicotine', 'In a vibrant forest where sunlight filters through a thick canopy of emerald leaves, a small brook babbles happily over smooth, rounded stones', '2005', '7823-6844-3435', 'https://www.google.com', NULL, 'https://www.youtube.com/watch?v=3KtWfp0UopM', '2024-10-21 08:53:18', '2024-10-21 08:53:18'),
(10, 2, '456 Elm Avenue, Springfield, MA 01103', 42.1013617, -72.6421909, 'Prevention Alliance of Cocke County', 'Braintree', 'Town of Braintree', 'CARA Coalitions', 'Tobacco/nicotine,Heroin and fentanyl', 'In a vibrant forest where sunlight filters through a thick canopy of emerald leaves', '2008', '7823-6844-3435', 'https://www.google.com', 'https://www.facebook.com/', 'https://www.youtube.com/watch?v=3KtWfp0UopM', '2024-10-21 08:55:52', '2024-11-11 05:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `new_england_states`
--

CREATE TABLE `new_england_states` (
  `id` bigint UNSIGNED NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `new_england_states`
--

INSERT INTO `new_england_states` (`id`, `state`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 'Vermont', 'newenglandgeojson/Vermont.json', '2024-10-14 04:20:33', '2024-10-14 04:20:33'),
(2, 'Massachusetts', 'newenglandgeojson/Massachusetts.json', '2024-10-14 04:21:00', '2024-10-14 04:21:00'),
(3, 'Maine', 'newenglandgeojson/Maine.json', '2024-10-14 04:21:22', '2024-10-14 04:21:22'),
(4, 'Rhode Island', 'newenglandgeojson/Rhode Island.json', '2024-10-14 04:21:39', '2024-10-14 04:21:39'),
(5, 'New Hampshire', 'newenglandgeojson/New Hampshire.json', '2024-10-14 04:22:01', '2024-10-14 04:22:01'),
(6, 'Connecticut', 'newenglandgeojson/Connecticut.json', '2024-10-14 04:22:28', '2024-10-14 04:22:28');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`, `updated_at`) VALUES
('admin@gmail.com', 'eQtgmd61XQD94dJOVJJH95pLYGSF1VZ1y7jux8sl8uMFgq6Ldix4PwhGTob0LJGQ', '2024-10-17 05:47:49', NULL),
('abhishek.d@cisinlabs.com', 'bC06ZU1Lelzl3QfKAY6Lw6JpZUw4ufIz7eiFkhJef1LmCAKog6hF4IQNSg3oxIwC', '2024-10-17 05:50:59', NULL),
('abhishek.d@cisinlabs.com', '7KH3hkklZhCfYwi9xp2Ck8Z5o1LcE3E0P8l7sGenYtH7UYt8G8BdmYkpvOLcCoJx', '2024-10-17 07:55:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('txVXFiJz40y3OPlYMbKvSM4rkDHYFJsjd8mUaGKo', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1BqYmtsNTY5U2JCbG5nREpXZkZVZHZ6cm1XRmpTbzVuMWJZOEp2aiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1732015428);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$VNfBk8QsKBc93joKk4Gl2Or1RlqFMjV1.BHUAmCzDVjS9KOgS66kG', NULL, '2024-10-14 04:15:50', '2024-10-14 04:15:50'),
(2, 'abhishek', 'abhishek.d@cisinlabs.com', NULL, '$2y$12$w/HTu43cUFRT0v6c/FjHOOqvFEk19oqeyG.7JeOWuhKoz51AHPYB6', NULL, '2024-10-17 05:50:42', '2024-10-17 05:50:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_england_places`
--
ALTER TABLE `new_england_places`
  ADD PRIMARY KEY (`id`),
  ADD KEY `new_england_places_new_england_state_id_foreign` (`new_england_state_id`);

--
-- Indexes for table `new_england_states`
--
ALTER TABLE `new_england_states`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `new_england_states_state_unique` (`state`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `new_england_places`
--
ALTER TABLE `new_england_places`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `new_england_states`
--
ALTER TABLE `new_england_states`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `new_england_places`
--
ALTER TABLE `new_england_places`
  ADD CONSTRAINT `new_england_places_new_england_state_id_foreign` FOREIGN KEY (`new_england_state_id`) REFERENCES `new_england_states` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
