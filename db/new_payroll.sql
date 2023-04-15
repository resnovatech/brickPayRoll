-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2023 at 11:34 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` int(20) DEFAULT NULL,
  `therapist_id` int(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(150) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `status` varchar(11) DEFAULT '1',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `staff_id`, `therapist_id`, `name`, `position`, `email`, `phone`, `username`, `email_verified_at`, `password`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'superadmin', NULL, 'superadmin@gmail.com', NULL, 'superadmin', NULL, '$2y$10$grm3z53L5a25UmMn2IN3k.rCggUR1xCXYKE6eO6yg6M6fN4RAQC8C', 'user-photo/1665758734.png', '1', NULL, '2021-03-24 05:29:53', '2023-03-05 00:11:11'),
(7, NULL, NULL, 'doctor', 'doctor', 'doctor@gmail.com', '01646735100', 'doctor', NULL, '$2y$10$N/0gxFIDsXihOrr3rjmy.OySYLgwxzyPlnSOONXxKBlbYBuhZK6jy', NULL, '1', NULL, '2023-03-28 00:12:40', '2023-03-28 00:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_address` text NOT NULL,
  `company_phone` varchar(20) NOT NULL,
  `company_logo` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `admin_id`, `company_name`, `company_address`, `company_phone`, `company_logo`, `created_at`, `updated_at`) VALUES
(2, 1, 'Padma Hut', 'Rajshahi', '01646735100', 'public/uploads/11.PNG', '2023-04-15 02:56:54', '2023-04-15 02:56:54');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `department_status` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `designation_name` varchar(50) NOT NULL,
  `designation_status` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile_number` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `designation_id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(255) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `job_location` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `discontinue_date` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2021_03_18_095906_create_permission_tables', 1),
(13, '2021_03_24_112406_create_admins_table', 2),
(14, '2022_02_07_091424_create_system_information_table', 2),
(15, '2019_12_14_000001_create_personal_access_tokens_table', 3),
(16, '2022_02_19_095110_create_permission_tables', 4),
(17, '2022_02_19_102354_create_admins_table', 5),
(18, '2022_10_15_105118_create_taxes_table', 5),
(19, '2022_10_15_105149_create_currencies_table', 5),
(20, '2022_10_15_105224_create_generals_table', 5),
(21, '2022_10_15_105308_create_invoicesettings_table', 5),
(22, '2022_10_15_105347_create_creditnotes_table', 5),
(23, '2022_10_15_105413_create_estimates_table', 5),
(24, '2022_10_17_141537_create_vendors_table', 6),
(25, '2022_10_17_141604_create_clients_table', 6),
(26, '2022_10_23_175519_create_brands_table', 7),
(27, '2022_10_23_175538_create_categories_table', 7),
(28, '2022_10_23_175612_create_subcategories_table', 7),
(29, '2022_10_23_175634_create_units_table', 7),
(30, '2022_10_23_175835_create_warehouses_table', 7),
(31, '2022_10_23_175948_create_products_table', 7),
(32, '2022_10_26_183747_create_sells_table', 8),
(33, '2022_10_26_184642_create_selldetails_table', 8),
(34, '2022_10_27_180531_create_purchases_table', 9),
(35, '2022_10_27_180549_create_purchasedetails_table', 9),
(36, '2022_10_27_223251_create_requisitions_table', 9),
(37, '2022_10_27_231141_create_rproducts_table', 10),
(38, '2023_01_05_105440_create_items_table', 11),
(39, '2023_01_05_105632_create_ingredients_table', 11),
(40, '2023_01_05_105723_create_tablelists_table', 11),
(41, '2023_01_05_105838_create_orders_table', 11),
(42, '2023_01_05_110254_create_menulists_table', 11),
(43, '2023_01_05_110315_create_menudetails_table', 11),
(44, '2023_01_10_045836_create_qrcodelists_table', 12),
(45, '2023_01_10_075200_create_orderdetails_table', 13),
(46, '2023_01_17_045638_create_pbanners_table', 14),
(47, '2023_01_25_052115_create_companybanners_table', 15),
(48, '2023_03_19_090028_create_walk_by_patients_table', 16),
(49, '2023_03_19_090121_create_patients_table', 17),
(50, '2023_03_19_090224_create_patient_admits_table', 17),
(51, '2023_03_19_090405_create_walk_by_patient_services_table', 17),
(52, '2023_03_19_090503_create_patient_files_table', 17),
(53, '2023_03_19_090620_create_doctors_table', 18),
(54, '2023_03_19_090833_create_doctor_appointments_table', 18),
(55, '2023_03_19_091020_create_therapy_appointments_table', 19),
(56, '2023_03_19_091344_create_therapy_appointment_details_table', 19),
(57, '2023_03_19_091427_create_therapy_appointment_date_and_times_table', 19),
(58, '2023_03_19_091648_create_doctor_consult_dates_table', 19),
(59, '2023_03_19_091805_create_diet_charts_table', 19),
(60, '2023_03_19_091946_create_medicines_table', 19),
(61, '2023_03_19_092045_create_health_supplements_table', 19),
(62, '2023_03_19_092651_create_therapy_ingredients_table', 19),
(63, '2023_03_19_093241_create_therapy_lists_table', 19),
(64, '2023_03_19_093345_create_staff_table', 19),
(65, '2023_03_19_093434_create_rewards_table', 19),
(66, '2023_03_19_093542_create_therapists_table', 19),
(67, '2023_03_19_112836_create_therapy_details_table', 19),
(76, '2023_03_28_073851_create_patient_histories_table', 20),
(77, '2023_03_28_074103_create_patient_therapies_table', 20),
(78, '2023_03_28_074256_create_patient_herbs_table', 20),
(79, '2023_03_28_074335_create_patient_medical_supplements_table', 20),
(80, '2023_03_30_075821_create_bills_table', 21),
(81, '2023_03_30_080008_create_payments_table', 21),
(82, '2023_04_15_053340_create_companies_table', 22),
(83, '2023_04_15_053454_create_departments_table', 22),
(84, '2023_04_15_053544_create_designations_table', 23),
(85, '2023_04_15_053610_create_banks_table', 23),
(86, '2023_04_15_053951_create_employees_table', 23),
(87, '2023_04_15_070011_create_salaries_table', 24),
(88, '2023_04_15_070040_create_overtimes_table', 24);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1),
(1, 'App\\User', 1),
(3, 'App\\Models\\Admin', 7);

-- --------------------------------------------------------

--
-- Table structure for table `overtimes`
--

CREATE TABLE `overtimes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `overtime_date` varchar(255) NOT NULL,
  `overtime_hour` varchar(20) NOT NULL,
  `overtime_pay` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `app_url` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `app_url`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.view', 'admin', 'dashboard', NULL, '2021-03-24 02:04:15', '2021-03-24 02:04:15'),
(2, 'dashboard.edit', 'admin', 'dashboard', NULL, '2021-03-24 02:04:15', '2021-03-24 02:04:15'),
(8, 'admin.create', 'admin', 'admin', NULL, '2021-03-24 02:04:16', '2021-03-24 02:04:16'),
(9, 'admin.view', 'admin', 'admin', NULL, '2021-03-24 02:04:16', '2021-03-24 02:04:16'),
(10, 'admin.edit', 'admin', 'admin', NULL, '2021-03-24 02:04:16', '2021-03-24 02:04:16'),
(11, 'admin.delete', 'admin', 'admin', NULL, '2021-03-24 02:04:16', '2021-03-24 02:04:16'),
(12, 'admin.approve', 'admin', 'admin', NULL, '2021-03-24 02:04:16', '2021-03-24 02:04:16'),
(13, 'role.create', 'admin', 'role', NULL, '2021-03-24 02:04:16', '2021-03-24 02:04:16'),
(14, 'role.view', 'admin', 'role', NULL, '2021-03-24 02:04:16', '2021-03-24 02:04:16'),
(15, 'role.edit', 'admin', 'role', NULL, '2021-03-24 02:04:17', '2021-03-24 02:04:17'),
(16, 'role.delete', 'admin', 'role', NULL, '2021-03-24 02:04:17', '2021-03-24 02:04:17'),
(17, 'role.approve', 'admin', 'role', NULL, '2021-03-24 02:04:17', '2021-03-24 02:04:17'),
(18, 'profile.view', 'admin', 'profile', NULL, '2021-03-24 02:04:17', '2021-03-24 02:04:17'),
(19, 'profile.edit', 'admin', 'profile', NULL, '2021-03-24 02:04:17', '2021-03-24 02:04:17'),
(20, 'permission.create', 'admin', 'permission', NULL, NULL, NULL),
(21, 'permission.view', 'admin', 'permission', NULL, NULL, NULL),
(22, 'permission.edit', 'admin', 'permission', NULL, NULL, NULL),
(23, 'permission.delete', 'admin', 'permission', NULL, NULL, NULL),
(25, 'system_information_add', 'admin', 'system_information', 'admin/system_information_add', NULL, NULL),
(26, 'system_information_view', 'admin', 'system_information', 'admin/system_information_view', NULL, NULL),
(27, 'system_information_delete', 'admin', 'system_information', 'admin/system_information_delete', NULL, NULL),
(28, 'system_information_update', 'admin', 'system_information', 'admin/system_information_update', NULL, NULL),
(240, 'company_add', 'admin', 'Comapny', 'admin/company_add', NULL, NULL),
(241, 'company_view', 'admin', 'Comapny', 'admin/company_view', NULL, NULL),
(242, 'company_delete', 'admin', 'Comapny', 'admin/company_delete', NULL, NULL),
(243, 'company_update', 'admin', 'Comapny', 'admin/company_update', NULL, NULL),
(244, 'department_add', 'admin', 'Department', 'admin/department_add', NULL, NULL),
(245, 'department_view', 'admin', 'Department', 'admin/department_view', NULL, NULL),
(246, 'department_delete', 'admin', 'Department', 'admin/department_delete', NULL, NULL),
(247, 'department_update', 'admin', 'Department', 'admin/department_update', NULL, NULL),
(248, 'designation_add', 'admin', 'Designation', 'admin/designation_add', NULL, NULL),
(249, 'designation_view', 'admin', 'Designation', 'admin/designation_view', NULL, NULL),
(250, 'designation_delete', 'admin', 'Designation', 'admin/designation_delete', NULL, NULL),
(251, 'designation_update', 'admin', 'Designation', 'admin/designation_update', NULL, NULL),
(252, 'bank_add', 'admin', 'Bank', 'admin/bank_add', NULL, NULL),
(253, 'bank_view', 'admin', 'Bank', 'admin/bank_view', NULL, NULL),
(254, 'bank_delete', 'admin', 'Bank', 'admin/bank_delete', NULL, NULL),
(255, 'bank_update', 'admin', 'Bank', 'admin/bank_update', NULL, NULL),
(256, 'employee_add', 'admin', 'Employee', 'admin/employee_add', NULL, NULL),
(257, 'employee_view', 'admin', 'Employee', 'admin/employee_view', NULL, NULL),
(258, 'employee_delete', 'admin', 'Employee', 'admin/employee_delete', NULL, NULL),
(259, 'employee_update', 'admin', 'Employee', 'admin/employee_update', NULL, NULL),
(260, 'salary_add', 'admin', 'Salary', 'admin/salary_add', NULL, NULL),
(261, 'salary_view', 'admin', 'Salary', 'admin/salary_view', NULL, NULL),
(262, 'salary_delete', 'admin', 'Salary', 'admin/salary_delete', NULL, NULL),
(263, 'salary_update', 'admin', 'Salary', 'admin/salary_update', NULL, NULL),
(264, 'overtime_add', 'admin', 'Overtime', 'admin/overtime_add', NULL, NULL),
(265, 'overtime_view', 'admin', 'Overtime', 'admin/overtime_view', NULL, NULL),
(266, 'overtime_delete', 'admin', 'Overtime', 'admin/overtime_delete', NULL, NULL),
(267, 'overtime_update', 'admin', 'Overtime', 'admin/overtime_update', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'admin', '2021-03-24 02:04:14', '2021-03-24 02:04:14'),
(3, 'admin', 'admin', '2021-03-24 02:04:14', '2023-04-14 23:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(2, 3),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(18, 3),
(19, 1),
(19, 3),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(240, 1),
(241, 1),
(242, 1),
(243, 1),
(244, 1),
(245, 1),
(246, 1),
(247, 1),
(248, 1),
(249, 1),
(250, 1),
(251, 1),
(252, 1),
(253, 1),
(254, 1),
(255, 1),
(256, 1),
(257, 1),
(258, 1),
(259, 1),
(260, 1),
(261, 1),
(262, 1),
(263, 1),
(264, 1),
(265, 1),
(266, 1),
(267, 1);

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `date_of_joining` varchar(255) NOT NULL,
  `employee_category` varchar(50) NOT NULL,
  `gross_salary` varchar(20) NOT NULL,
  `basic_fifty_percentage_of_gross` varchar(20) NOT NULL,
  `house_rent_fifty_percentage_of_basic` varchar(20) NOT NULL,
  `medical_fifteen_percentage_of_basic` varchar(20) NOT NULL,
  `convenience_ten_percentage_of_basic` varchar(20) NOT NULL,
  `food_fifteen_percentage_of_basic` varchar(20) NOT NULL,
  `other_allow` varchar(20) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_account_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_information`
--

CREATE TABLE `system_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `System_Name` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_information`
--

INSERT INTO `system_information` (`id`, `logo`, `icon`, `System_Name`, `Phone`, `Email`, `Address`, `created_at`, `updated_at`) VALUES
(1, 'public/uploads/1681112187.png', 'public/uploads/1679294912.ico', 'Ayurveda', '777', 'a@gmail.com', 'Dhaka', '2022-02-07 04:03:26', '2023-04-10 11:36:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_email_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `address`, `image`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_email_verified`) VALUES
(13, 'k_new', '01646735100', NULL, NULL, 'kajolkamruzzaman.cse@gmail.com', NULL, '$2y$10$EoUB6e9kq92ktYkkE2eTLu5qv4mkNhHcj42a97zQdoWB/pJuidspm', NULL, '2023-03-04 02:15:40', '2023-03-04 02:16:11', 1),
(23, 'Nir Rony Hossain', '017383990888', NULL, NULL, 'ronyhossain1920@gmail.com', NULL, '$2y$10$HS4JUlz3hFCUtkmzdwxPFOtyoJgwDBu9VMZOvablGYXRQ2qE2LM36', NULL, '2023-03-12 05:16:52', '2023-03-12 05:56:37', 1),
(24, 'Kamruzzaman kajol', '01646735100', NULL, NULL, 'kkajol428@gmail.com', NULL, '$2y$10$PnnoE9frIbaFD6TR4a.zGeR/d8OOSpSsQZFi2NsyM8npyP3x6xC7C', NULL, '2023-03-12 10:36:04', '2023-03-12 10:36:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_verify`
--

CREATE TABLE `users_verify` (
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_verify`
--

INSERT INTO `users_verify` (`user_id`, `token`, `created_at`, `updated_at`) VALUES
(1, 'EfqG6pUFQU', '2023-02-19 09:52:33', '2023-02-19 09:52:33'),
(2, 'hqfSIEDXjF', '2023-02-19 09:55:39', '2023-02-19 09:55:39'),
(3, 'glGVZiQPG0', '2023-02-19 10:00:03', '2023-02-19 10:00:03'),
(4, '16wutrzjPW', '2023-02-19 10:05:42', '2023-02-19 10:05:42'),
(5, 'BuSvDx6R0G', '2023-02-19 10:30:11', '2023-02-19 10:30:11'),
(6, 'TEg9L2WqxS', '2023-02-19 10:37:25', '2023-02-19 10:37:25'),
(7, 'uxCSsk54mA', '2023-02-19 23:04:28', '2023-02-19 23:04:28'),
(8, 'VOI21l1rfl', '2023-02-19 23:09:19', '2023-02-19 23:09:19'),
(9, 'jXy9A1kBPB', '2023-02-19 23:13:50', '2023-02-19 23:13:50'),
(10, 'B9rzkd5T1t', '2023-02-19 23:17:38', '2023-02-19 23:17:38'),
(11, 'YEtBDtIIWZ', '2023-02-19 23:26:27', '2023-02-19 23:26:27'),
(12, '89aOc5xOY2', '2023-02-26 02:56:58', '2023-02-26 02:56:58'),
(13, 'w2uc4Wx2ZL', '2023-03-04 02:15:40', '2023-03-04 02:15:40'),
(16, 'uWAA5VGzfI', '2023-03-11 00:25:08', '2023-03-11 00:25:08'),
(17, 'oDBVOqBw5K', '2023-03-11 03:01:37', '2023-03-11 03:01:37'),
(18, 'iImHP5nul6', '2023-03-11 03:36:10', '2023-03-11 03:36:10'),
(19, 'e1RHKHD0z2', '2023-03-11 03:39:16', '2023-03-11 03:39:16'),
(20, 'bi8vThyQ32', '2023-03-11 04:30:26', '2023-03-11 04:30:26'),
(21, 'qW0nl4m8N8', '2023-03-11 10:09:09', '2023-03-11 10:09:09'),
(22, 'dqunRpfn7c', '2023-03-11 10:11:00', '2023-03-11 10:11:00'),
(23, '5LmkhAJM9D', '2023-03-12 05:16:52', '2023-03-12 05:16:52'),
(24, 'UoR7ukUxqn', '2023-03-12 10:36:04', '2023-03-12 10:36:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banks_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companies_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `designations_admin_id_foreign` (`admin_id`),
  ADD KEY `designations_department_id_foreign` (`department_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_admin_id_foreign` (`admin_id`),
  ADD KEY `employees_designation_id_foreign` (`designation_id`),
  ADD KEY `employees_company_id_foreign` (`company_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `overtimes`
--
ALTER TABLE `overtimes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `overtimes_admin_id_foreign` (`admin_id`),
  ADD KEY `overtimes_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salaries_admin_id_foreign` (`admin_id`),
  ADD KEY `salaries_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `system_information`
--
ALTER TABLE `system_information`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `overtimes`
--
ALTER TABLE `overtimes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `banks`
--
ALTER TABLE `banks`
  ADD CONSTRAINT `banks_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`);

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`);

--
-- Constraints for table `designations`
--
ALTER TABLE `designations`
  ADD CONSTRAINT `designations_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `designations_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `employees_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `employees_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `overtimes`
--
ALTER TABLE `overtimes`
  ADD CONSTRAINT `overtimes_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `overtimes_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `salaries`
--
ALTER TABLE `salaries`
  ADD CONSTRAINT `salaries_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `salaries_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
