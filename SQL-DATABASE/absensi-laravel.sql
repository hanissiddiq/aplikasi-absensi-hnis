/*
 Navicat Premium Dump SQL

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80038 (8.0.38)
 Source Host           : localhost:3306
 Source Schema         : absensi-laravel

 Target Server Type    : MySQL
 Target Server Version : 80038 (8.0.38)
 File Encoding         : 65001

 Date: 11/05/2025 10:14:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for auto_shifts
-- ----------------------------
DROP TABLE IF EXISTS `auto_shifts`;
CREATE TABLE `auto_shifts`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `jabatan_id` bigint UNSIGNED NOT NULL,
  `shift_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auto_shifts
-- ----------------------------

-- ----------------------------
-- Table structure for beritas
-- ----------------------------
DROP TABLE IF EXISTS `beritas`;
CREATE TABLE `beritas`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipe` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `judul` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `isi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `berita_file_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `berita_file_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of beritas
-- ----------------------------
INSERT INTO `beritas` VALUES (1, 'Berita', 'Berita 1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/banner.jpg', NULL, '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `beritas` VALUES (2, 'Berita', 'Berita 2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/banner2.jpg', NULL, '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `beritas` VALUES (3, 'Berita', 'Berita 3', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/banner3.jpg', NULL, '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `beritas` VALUES (4, 'Berita', 'Berita 4', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/banner4.jpg', NULL, '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `beritas` VALUES (5, 'Berita', 'Berita 5', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/banner5.jpg', NULL, '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `beritas` VALUES (6, 'Informasi', 'Informasi 1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/informasi.png', NULL, '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `beritas` VALUES (7, 'Informasi', 'Informasi 2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/informasi.png', NULL, '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `beritas` VALUES (8, 'Informasi', 'Informasi 3', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/informasi.png', NULL, '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `beritas` VALUES (9, 'Informasi', 'Informasi 4', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/informasi.png', NULL, '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `beritas` VALUES (10, 'Informasi', 'Informasi 5', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/informasi.png', NULL, '2025-05-04 21:25:24', '2025-05-04 21:25:24');

-- ----------------------------
-- Table structure for counters
-- ----------------------------
DROP TABLE IF EXISTS `counters`;
CREATE TABLE `counters`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `counter` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of counters
-- ----------------------------
INSERT INTO `counters` VALUES (1, 'Gaji', 'GJ', 0, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `counters` VALUES (2, 'Target Kinerja', 'TK', 0, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `counters` VALUES (3, 'Pengajuan Keuangan', 'PK', 0, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `counters` VALUES (4, 'Inventory', 'INV', 0, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `counters` VALUES (5, 'Penugasan', NULL, 0, '2025-05-04 21:25:25', '2025-05-04 21:25:25');

-- ----------------------------
-- Table structure for cutis
-- ----------------------------
DROP TABLE IF EXISTS `cutis`;
CREATE TABLE `cutis`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `lokasi_id` bigint UNSIGNED NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `nama_cuti` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tanggal` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alasan_cuti` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `foto_cuti` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status_cuti` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `catatan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_approval` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cutis_user_approval_foreign`(`user_approval` ASC) USING BTREE,
  CONSTRAINT `cutis_user_approval_foreign` FOREIGN KEY (`user_approval`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cutis
-- ----------------------------

-- ----------------------------
-- Table structure for dinas_luars
-- ----------------------------
DROP TABLE IF EXISTS `dinas_luars`;
CREATE TABLE `dinas_luars`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `shift_id` bigint UNSIGNED NOT NULL,
  `tanggal` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_absen` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `telat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lat_absen` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `long_absen` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `foto_jam_absen` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jam_pulang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `pulang_cepat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `foto_jam_pulang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lat_pulang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `long_pulang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status_absen` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dinas_luars
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for files
-- ----------------------------
DROP TABLE IF EXISTS `files`;
CREATE TABLE `files`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `jenis_file` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `fileUpload` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of files
-- ----------------------------

-- ----------------------------
-- Table structure for golongans
-- ----------------------------
DROP TABLE IF EXISTS `golongans`;
CREATE TABLE `golongans`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of golongans
-- ----------------------------
INSERT INTO `golongans` VALUES (1, 'DIREKSI', '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `golongans` VALUES (2, 'KABAG', '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `golongans` VALUES (3, 'STAFF', '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `golongans` VALUES (4, 'PELAKSANA', '2025-05-04 21:25:25', '2025-05-04 21:25:25');

-- ----------------------------
-- Table structure for inventories
-- ----------------------------
DROP TABLE IF EXISTS `inventories`;
CREATE TABLE `inventories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nama_barang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `stok` double(8, 2) NULL DEFAULT NULL,
  `uom` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `lokasi_id` bigint UNSIGNED NULL DEFAULT NULL,
  `jabatan_id` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of inventories
-- ----------------------------

-- ----------------------------
-- Table structure for jabatans
-- ----------------------------
DROP TABLE IF EXISTS `jabatans`;
CREATE TABLE `jabatans`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `manager` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jabatans_manager_foreign`(`manager` ASC) USING BTREE,
  CONSTRAINT `jabatans_manager_foreign` FOREIGN KEY (`manager`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jabatans
-- ----------------------------
INSERT INTO `jabatans` VALUES (1, 'Teknologi Informasi', 1, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `jabatans` VALUES (2, 'Keuangan dan Akutansi', NULL, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `jabatans` VALUES (3, 'Administrasi & Umum', NULL, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `jabatans` VALUES (4, 'Humas & Pemasaran', NULL, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `jabatans` VALUES (5, 'Sekretariat', NULL, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `jabatans` VALUES (6, 'Direktur', NULL, '2025-05-04 21:25:25', '2025-05-04 21:25:25');

-- ----------------------------
-- Table structure for jenis_kinerjas
-- ----------------------------
DROP TABLE IF EXISTS `jenis_kinerjas`;
CREATE TABLE `jenis_kinerjas`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bobot` bigint NULL DEFAULT NULL,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jenis_kinerjas
-- ----------------------------
INSERT INTO `jenis_kinerjas` VALUES (1, 'Menyelesaikan Penugasan Kerja', 20, 'Jika pegawai menyelesaikan Penugasan Kerja yang diberikan pimpinan', '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `jenis_kinerjas` VALUES (2, 'Menghadiri Pertemuan', 5, 'Jika pegawai melakukan melakukan presensi saat pertemuan/rapat', '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `jenis_kinerjas` VALUES (3, 'Laporan Kerja', 10, 'Jika pegawai melaporkan pekerjaan sesuai tugas kerjanya', '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `jenis_kinerjas` VALUES (4, 'Pulang tepat waktu', 10, 'Jika pegawai tidak melakukan presensi pulang kerja', '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `jenis_kinerjas` VALUES (5, 'Pulang Sebelum waktunya', -5, 'Jika pegawai melakukan melakukan presensi sebelum jam kerja selesai', '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `jenis_kinerjas` VALUES (6, 'Telat Presensi Masuk', -10, 'Jika pegawai telat melakukan presensi masuk kerja', '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `jenis_kinerjas` VALUES (7, 'Presensi Kehadiran Ontime', 10, 'Jika pegawai melakukan presensi masuk kerja', '2025-05-04 21:25:25', '2025-05-04 21:25:25');

-- ----------------------------
-- Table structure for kasbons
-- ----------------------------
DROP TABLE IF EXISTS `kasbons`;
CREATE TABLE `kasbons`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` int NOT NULL,
  `keperluan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kasbons
-- ----------------------------

-- ----------------------------
-- Table structure for kategoris
-- ----------------------------
DROP TABLE IF EXISTS `kategoris`;
CREATE TABLE `kategoris`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` bigint NULL DEFAULT NULL,
  `active` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategoris
-- ----------------------------
INSERT INTO `kategoris` VALUES (1, 'Bensin Pertalite (Mobil)', 200000, 1, '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `kategoris` VALUES (2, 'Bensin Pertalite (Motor)', 100000, 1, '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `kategoris` VALUES (3, 'Biaya Jasa Pasang PSB (50.000)', 50000, 1, '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `kategoris` VALUES (4, 'Pasang ODP (200.000)', 200000, 1, '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `kategoris` VALUES (5, 'Tarik Kabel DC Backbone (500/m)', 2000000, 1, '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `kategoris` VALUES (6, 'Lain-lain', NULL, 1, '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `kategoris` VALUES (7, 'Pelatihan Olahraga', 1000000, NULL, '2025-05-04 21:25:24', '2025-05-04 21:25:24');

-- ----------------------------
-- Table structure for kontraks
-- ----------------------------
DROP TABLE IF EXISTS `kontraks`;
CREATE TABLE `kontraks`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `jenis_kontrak` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tanggal_mulai` date NULL DEFAULT NULL,
  `tanggal_selesai` date NULL DEFAULT NULL,
  `masa_berlaku_sebelumnya` date NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `kontrak_file_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kontrak_file_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kontraks
-- ----------------------------

-- ----------------------------
-- Table structure for kunjungans
-- ----------------------------
DROP TABLE IF EXISTS `kunjungans`;
CREATE TABLE `kunjungans`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `visit_in` datetime NULL DEFAULT NULL,
  `foto_in` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lat_in` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `long_in` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `keterangan_in` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `visit_out` datetime NULL DEFAULT NULL,
  `foto_out` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lat_out` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `long_out` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `keterangan_out` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kunjungans
-- ----------------------------

-- ----------------------------
-- Table structure for laporan_kerjas
-- ----------------------------
DROP TABLE IF EXISTS `laporan_kerjas`;
CREATE TABLE `laporan_kerjas`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `informasi_umum` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `pekerjaan_dilaksanakan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `pekerjaan_belum_selesai` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of laporan_kerjas
-- ----------------------------

-- ----------------------------
-- Table structure for laporan_kinerjas
-- ----------------------------
DROP TABLE IF EXISTS `laporan_kinerjas`;
CREATE TABLE `laporan_kinerjas`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `jenis_kinerja_id` bigint UNSIGNED NULL DEFAULT NULL,
  `nilai` bigint NULL DEFAULT NULL,
  `penilaian_berjalan` bigint NULL DEFAULT NULL,
  `reference` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `reference_id` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of laporan_kinerjas
-- ----------------------------

-- ----------------------------
-- Table structure for lemburs
-- ----------------------------
DROP TABLE IF EXISTS `lemburs`;
CREATE TABLE `lemburs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `lokasi_id` bigint UNSIGNED NOT NULL,
  `tanggal` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_masuk` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat_masuk` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_masuk` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jarak_masuk` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_jam_masuk` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_keluar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lat_keluar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `long_keluar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jarak_keluar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `foto_jam_keluar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `total_lembur` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `notes` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `approved_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `lemburs_approved_by_foreign`(`approved_by` ASC) USING BTREE,
  CONSTRAINT `lemburs_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lemburs
-- ----------------------------

-- ----------------------------
-- Table structure for lokasis
-- ----------------------------
DROP TABLE IF EXISTS `lokasis`;
CREATE TABLE `lokasis`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_lokasi` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat_kantor` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `long_kantor` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `radius` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `keterangan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `approved_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `lokasis_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `lokasis_approved_by_foreign`(`approved_by` ASC) USING BTREE,
  CONSTRAINT `lokasis_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `lokasis_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lokasis
-- ----------------------------
INSERT INTO `lokasis` VALUES (1, 'Kantor Cabang A', '-6.3707314', '106.8138057', '200', 'Office', 'approved', 1, NULL, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `lokasis` VALUES (2, 'Kantor Cabang B', '-6.3707314', '106.8138057', '200', 'Office', 'approved', 1, NULL, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `lokasis` VALUES (3, 'Gedung A', '-6.3707314', '106.8138057', '200', 'Patroli', 'approved', 1, NULL, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `lokasis` VALUES (4, 'Gedung B', '-6.3707332', '106.81380572', '200', 'Patroli', 'approved', 1, NULL, '2025-05-04 21:25:25', '2025-05-04 21:25:25');

-- ----------------------------
-- Table structure for mapping_shifts
-- ----------------------------
DROP TABLE IF EXISTS `mapping_shifts`;
CREATE TABLE `mapping_shifts`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `shift_id` bigint UNSIGNED NULL DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam_absen` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `telat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lat_absen` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `long_absen` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jarak_masuk` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `foto_jam_absen` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `keterangan_masuk` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jam_pulang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `pulang_cepat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lat_pulang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `long_pulang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jarak_pulang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `foto_jam_pulang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `keterangan_pulang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status_absen` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lock_location` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jam_masuk_pengajuan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jam_pulang_pengajuan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deskripsi` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status_pengajuan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `file_pengajuan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `komentar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `approved_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `mapping_shifts_approved_by_foreign`(`approved_by` ASC) USING BTREE,
  CONSTRAINT `mapping_shifts_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mapping_shifts
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 47 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2022_09_16_095447_create_shifts_table', 1);
INSERT INTO `migrations` VALUES (6, '2022_09_19_032649_create_mapping_shifts_table', 1);
INSERT INTO `migrations` VALUES (7, '2022_09_20_074944_create_lemburs_table', 1);
INSERT INTO `migrations` VALUES (8, '2022_09_20_092230_create_cutis_table', 1);
INSERT INTO `migrations` VALUES (9, '2022_10_31_083510_create_lokasis_table', 1);
INSERT INTO `migrations` VALUES (10, '2022_11_02_061554_create_reset_cutis_table', 1);
INSERT INTO `migrations` VALUES (11, '2022_12_01_041742_create_sips_table', 1);
INSERT INTO `migrations` VALUES (12, '2022_12_14_080034_create_jabatans_table', 1);
INSERT INTO `migrations` VALUES (13, '2023_03_22_103407_create_dinas_luars_table', 1);
INSERT INTO `migrations` VALUES (14, '2023_04_10_130307_create_auto_shifts_table', 1);
INSERT INTO `migrations` VALUES (15, '2023_06_28_042019_create_files_table', 1);
INSERT INTO `migrations` VALUES (16, '2023_07_15_095632_create_tunjangans_table', 1);
INSERT INTO `migrations` VALUES (17, '2023_07_16_152608_create_golongans_table', 1);
INSERT INTO `migrations` VALUES (18, '2023_07_19_122052_create_status_ptkps_table', 1);
INSERT INTO `migrations` VALUES (19, '2023_07_20_082307_create_pajaks_table', 1);
INSERT INTO `migrations` VALUES (20, '2023_07_21_085614_create_payrolls_table', 1);
INSERT INTO `migrations` VALUES (21, '2023_12_05_140334_create_counters_table', 1);
INSERT INTO `migrations` VALUES (22, '2023_12_06_163716_create_kasbons_table', 1);
INSERT INTO `migrations` VALUES (23, '2024_06_15_075202_create_notifications_table', 1);
INSERT INTO `migrations` VALUES (24, '2024_07_27_095429_create_settings_table', 1);
INSERT INTO `migrations` VALUES (25, '2024_09_19_040613_create_reimbursements_table', 1);
INSERT INTO `migrations` VALUES (26, '2024_09_19_040828_create_kategoris_table', 1);
INSERT INTO `migrations` VALUES (27, '2024_09_22_082937_create_kunjungans_table', 1);
INSERT INTO `migrations` VALUES (28, '2024_10_02_182404_create_reimbursements_items_table', 1);
INSERT INTO `migrations` VALUES (29, '2024_11_23_125436_create_jenis_kinerjas_table', 1);
INSERT INTO `migrations` VALUES (30, '2024_11_23_143017_create_laporan_kinerjas_table', 1);
INSERT INTO `migrations` VALUES (31, '2024_11_23_190924_create_penugasans_table', 1);
INSERT INTO `migrations` VALUES (32, '2024_11_23_200000_create_penugasan_items_table', 1);
INSERT INTO `migrations` VALUES (33, '2024_11_26_031205_create_rapats_table', 1);
INSERT INTO `migrations` VALUES (34, '2024_11_26_040949_create_rapat_pegawais_table', 1);
INSERT INTO `migrations` VALUES (35, '2024_11_26_081727_create_rapat_notulens_table', 1);
INSERT INTO `migrations` VALUES (36, '2024_11_26_140652_create_inventories_table', 1);
INSERT INTO `migrations` VALUES (37, '2024_12_06_123720_create_kontraks_table', 1);
INSERT INTO `migrations` VALUES (38, '2024_12_08_072818_create_pegawai_keluars_table', 1);
INSERT INTO `migrations` VALUES (39, '2024_12_16_100744_create_patrolis_table', 1);
INSERT INTO `migrations` VALUES (40, '2024_12_21_174829_create_target_kinerjas_table', 1);
INSERT INTO `migrations` VALUES (41, '2024_12_23_163056_create_target_kinerja_teams_table', 1);
INSERT INTO `migrations` VALUES (42, '2025_01_01_155603_create_laporan_kerjas_table', 1);
INSERT INTO `migrations` VALUES (43, '2025_01_24_171233_create_permission_tables', 1);
INSERT INTO `migrations` VALUES (44, '2025_01_31_124509_create_pengajuan_keuangans_table', 1);
INSERT INTO `migrations` VALUES (45, '2025_01_31_161224_create_pengajuan_keuangan_items_table', 1);
INSERT INTO `migrations` VALUES (46, '2025_02_01_160925_create_beritas_table', 1);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\User', 1);
INSERT INTO `model_has_roles` VALUES (2, 'App\\Models\\User', 2);
INSERT INTO `model_has_roles` VALUES (3, 'App\\Models\\User', 3);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 4);
INSERT INTO `model_has_roles` VALUES (5, 'App\\Models\\User', 5);
INSERT INTO `model_has_roles` VALUES (6, 'App\\Models\\User', 6);
INSERT INTO `model_has_roles` VALUES (7, 'App\\Models\\User', 7);

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `notifications_notifiable_type_notifiable_id_index`(`notifiable_type` ASC, `notifiable_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notifications
-- ----------------------------

-- ----------------------------
-- Table structure for pajaks
-- ----------------------------
DROP TABLE IF EXISTS `pajaks`;
CREATE TABLE `pajaks`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `bulan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pajaks_status_id_foreign`(`status_id` ASC) USING BTREE,
  CONSTRAINT `pajaks_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status_ptkps` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pajaks
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for patrolis
-- ----------------------------
DROP TABLE IF EXISTS `patrolis`;
CREATE TABLE `patrolis`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `lokasi_id` bigint UNSIGNED NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `jam` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `long` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jarak` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of patrolis
-- ----------------------------

-- ----------------------------
-- Table structure for payrolls
-- ----------------------------
DROP TABLE IF EXISTS `payrolls`;
CREATE TABLE `payrolls`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `bulan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `persentase_kehadiran` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_gaji` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gaji_pokok` bigint NOT NULL,
  `uang_transport` bigint NOT NULL,
  `total_reimbursement` bigint NOT NULL,
  `jumlah_mangkir` bigint NOT NULL,
  `uang_mangkir` bigint NOT NULL,
  `total_mangkir` bigint NOT NULL,
  `jumlah_lembur` bigint NOT NULL,
  `uang_lembur` bigint NOT NULL,
  `total_lembur` bigint NOT NULL,
  `jumlah_izin` bigint NOT NULL,
  `uang_izin` bigint NOT NULL,
  `total_izin` bigint NOT NULL,
  `bonus_pribadi` bigint NOT NULL,
  `bonus_team` bigint NOT NULL,
  `bonus_jackpot` bigint NOT NULL,
  `jumlah_terlambat` bigint NOT NULL,
  `uang_terlambat` bigint NOT NULL,
  `total_terlambat` bigint NOT NULL,
  `jumlah_kehadiran` bigint NOT NULL,
  `uang_kehadiran` bigint NOT NULL,
  `total_kehadiran` bigint NOT NULL,
  `saldo_kasbon` bigint NOT NULL,
  `bayar_kasbon` bigint NOT NULL,
  `jumlah_thr` bigint NOT NULL,
  `uang_thr` bigint NOT NULL,
  `total_thr` bigint NOT NULL,
  `loss` bigint NOT NULL,
  `total_penjumlahan` bigint NOT NULL,
  `total_pengurangan` bigint NOT NULL,
  `grand_total` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payrolls
-- ----------------------------

-- ----------------------------
-- Table structure for pegawai_keluars
-- ----------------------------
DROP TABLE IF EXISTS `pegawai_keluars`;
CREATE TABLE `pegawai_keluars`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `jenis` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `pegawai_keluar_file_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `pegawai_keluar_file_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `approved_by` bigint UNSIGNED NULL DEFAULT NULL,
  `tanggal_approval` date NULL DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pegawai_keluars_approved_by_foreign`(`approved_by` ASC) USING BTREE,
  CONSTRAINT `pegawai_keluars_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pegawai_keluars
-- ----------------------------

-- ----------------------------
-- Table structure for pengajuan_keuangan_items
-- ----------------------------
DROP TABLE IF EXISTS `pengajuan_keuangan_items`;
CREATE TABLE `pengajuan_keuangan_items`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pengajuan_keuangan_id` bigint UNSIGNED NULL DEFAULT NULL,
  `nama` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `qty` double NULL DEFAULT NULL,
  `harga` bigint NULL DEFAULT NULL,
  `total` bigint NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengajuan_keuangan_items
-- ----------------------------

-- ----------------------------
-- Table structure for pengajuan_keuangans
-- ----------------------------
DROP TABLE IF EXISTS `pengajuan_keuangans`;
CREATE TABLE `pengajuan_keuangans`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `nomor` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `total_harga` bigint NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `pk_file_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `pk_file_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nota_file_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nota_file_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_approval` bigint UNSIGNED NULL DEFAULT NULL,
  `note_approval` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pengajuan_keuangans_user_approval_foreign`(`user_approval` ASC) USING BTREE,
  CONSTRAINT `pengajuan_keuangans_user_approval_foreign` FOREIGN KEY (`user_approval`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengajuan_keuangans
-- ----------------------------

-- ----------------------------
-- Table structure for penugasan_items
-- ----------------------------
DROP TABLE IF EXISTS `penugasan_items`;
CREATE TABLE `penugasan_items`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `penugasan_id` bigint UNSIGNED NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `flow` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penugasan_items
-- ----------------------------

-- ----------------------------
-- Table structure for penugasans
-- ----------------------------
DROP TABLE IF EXISTS `penugasans`;
CREATE TABLE `penugasans`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomor_penugasan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `judul` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `rincian` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penugasans
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for rapat_notulens
-- ----------------------------
DROP TABLE IF EXISTS `rapat_notulens`;
CREATE TABLE `rapat_notulens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `rapat_id` bigint UNSIGNED NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `notulen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rapat_notulens
-- ----------------------------

-- ----------------------------
-- Table structure for rapat_pegawais
-- ----------------------------
DROP TABLE IF EXISTS `rapat_pegawais`;
CREATE TABLE `rapat_pegawais`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `rapat_id` bigint UNSIGNED NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `hadir` datetime NULL DEFAULT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rapat_pegawais
-- ----------------------------

-- ----------------------------
-- Table structure for rapats
-- ----------------------------
DROP TABLE IF EXISTS `rapats`;
CREATE TABLE `rapats`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_selesai` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rapats
-- ----------------------------

-- ----------------------------
-- Table structure for reimbursements
-- ----------------------------
DROP TABLE IF EXISTS `reimbursements`;
CREATE TABLE `reimbursements`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `event` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jumlah` bigint NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `total` bigint NULL DEFAULT NULL,
  `sisa` bigint NULL DEFAULT NULL,
  `file_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `file_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reimbursements
-- ----------------------------

-- ----------------------------
-- Table structure for reimbursements_items
-- ----------------------------
DROP TABLE IF EXISTS `reimbursements_items`;
CREATE TABLE `reimbursements_items`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reimbursement_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `fee` bigint NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reimbursements_items
-- ----------------------------

-- ----------------------------
-- Table structure for reset_cutis
-- ----------------------------
DROP TABLE IF EXISTS `reset_cutis`;
CREATE TABLE `reset_cutis`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `izin_cuti` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `izin_dinas_luar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `izin_sakit` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `izin_cek_kesehatan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `izin_keperluan_pribadi` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `izin_telat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `izin_pulang_cepat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `izin_lainnya` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reset_cutis
-- ----------------------------
INSERT INTO `reset_cutis` VALUES (1, '10', '10', '10', '10', '10', '10', '10', '10', '2025-05-04 21:25:25', '2025-05-04 21:25:25');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'admin', 'web', '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `roles` VALUES (2, 'user', 'web', '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `roles` VALUES (3, 'hrd', 'web', '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `roles` VALUES (4, 'general_manager', 'web', '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `roles` VALUES (5, 'finance', 'web', '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `roles` VALUES (6, 'kepala_cabang', 'web', '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `roles` VALUES (7, 'regional_manager', 'web', '2025-05-04 21:25:24', '2025-05-04 21:25:24');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `logo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alamat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `whatsapp` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `api_url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `api_whatsapp` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES (1, 'Absensi', 'logo/absensi.png', 'jln. akasia 1 c.221, purwakarta, aceh', '6281212099664', '6285183397739', 'https://wa.haihalo.com/send-message', 'AI3BsRRM9bVwBZB5zHhDjoq4SLBFBkNj', 'absensi@gmail.com', '2025-05-04 21:25:24', '2025-05-04 21:25:24');

-- ----------------------------
-- Table structure for shifts
-- ----------------------------
DROP TABLE IF EXISTS `shifts`;
CREATE TABLE `shifts`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_shift` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_masuk` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_keluar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shifts
-- ----------------------------
INSERT INTO `shifts` VALUES (1, 'Libur', '00:00', '00:00', '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `shifts` VALUES (2, 'Office', '08:00', '17:00', '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `shifts` VALUES (3, 'Siang', '13:00', '21:00', '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `shifts` VALUES (4, 'Malam', '21:00', '07:00', '2025-05-04 21:25:25', '2025-05-04 21:25:25');

-- ----------------------------
-- Table structure for sips
-- ----------------------------
DROP TABLE IF EXISTS `sips`;
CREATE TABLE `sips`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama_dokumen` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_berakhir` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sips
-- ----------------------------

-- ----------------------------
-- Table structure for status_ptkps
-- ----------------------------
DROP TABLE IF EXISTS `status_ptkps`;
CREATE TABLE `status_ptkps`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ptkp_2016` decimal(15, 2) NOT NULL DEFAULT 0.00,
  `ptkp_2015` decimal(15, 2) NOT NULL DEFAULT 0.00,
  `ptkp_2009_2012` decimal(15, 2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of status_ptkps
-- ----------------------------
INSERT INTO `status_ptkps` VALUES (1, 'TK/0', 54000000.00, 36000000.00, 15840000.00, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `status_ptkps` VALUES (2, 'TK/1', 58500000.00, 39000000.00, 17160000.00, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `status_ptkps` VALUES (3, 'TK/2', 63000000.00, 42000000.00, 18480000.00, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `status_ptkps` VALUES (4, 'TK/3', 67500000.00, 45000000.00, 19800000.00, '2025-05-04 21:25:25', '2025-05-04 21:25:25');

-- ----------------------------
-- Table structure for target_kinerja_teams
-- ----------------------------
DROP TABLE IF EXISTS `target_kinerja_teams`;
CREATE TABLE `target_kinerja_teams`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `target_kinerja_id` bigint UNSIGNED NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `jabatan_id` bigint UNSIGNED NULL DEFAULT NULL,
  `target_pribadi` bigint NULL DEFAULT NULL,
  `jumlah_persen_pribadi` bigint NULL DEFAULT NULL,
  `bonus_pribadi` bigint NULL DEFAULT NULL,
  `judul` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jumlah` bigint NULL DEFAULT NULL,
  `capai` double NULL DEFAULT NULL,
  `nilai` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bonus_p` bigint NULL DEFAULT NULL,
  `bonus_t` bigint NULL DEFAULT NULL,
  `bonus_j` bigint NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `target_kinerja_teams_target_kinerja_id_foreign`(`target_kinerja_id` ASC) USING BTREE,
  INDEX `target_kinerja_teams_user_id_foreign`(`user_id` ASC) USING BTREE,
  INDEX `target_kinerja_teams_jabatan_id_foreign`(`jabatan_id` ASC) USING BTREE,
  CONSTRAINT `target_kinerja_teams_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatans` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `target_kinerja_teams_target_kinerja_id_foreign` FOREIGN KEY (`target_kinerja_id`) REFERENCES `target_kinerjas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `target_kinerja_teams_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of target_kinerja_teams
-- ----------------------------

-- ----------------------------
-- Table structure for target_kinerjas
-- ----------------------------
DROP TABLE IF EXISTS `target_kinerjas`;
CREATE TABLE `target_kinerjas`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomor` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `target_team` bigint NULL DEFAULT NULL,
  `jumlah_persen_team` bigint NULL DEFAULT NULL,
  `bonus_team` bigint NULL DEFAULT NULL,
  `jackpot` bigint NULL DEFAULT NULL,
  `tanggal_awal` date NULL DEFAULT NULL,
  `tanggal_akhir` date NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of target_kinerjas
-- ----------------------------

-- ----------------------------
-- Table structure for tunjangans
-- ----------------------------
DROP TABLE IF EXISTS `tunjangans`;
CREATE TABLE `tunjangans`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `golongan_id` bigint UNSIGNED NOT NULL,
  `tunjangan_makan` decimal(15, 2) NOT NULL DEFAULT 0.00,
  `tunjangan_transport` decimal(15, 2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tunjangans
-- ----------------------------
INSERT INTO `tunjangans` VALUES (1, 1, 20000.00, 20000.00, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `tunjangans` VALUES (2, 2, 30000.00, 20000.00, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `tunjangans` VALUES (3, 3, 30000.00, 30000.00, '2025-05-04 21:25:25', '2025-05-04 21:25:25');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_karyawan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `foto_face_recognition` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `telepon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tgl_lahir` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gender` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tgl_join` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status_nikah` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `izin_cuti` bigint NOT NULL DEFAULT 0,
  `izin_lainnya` bigint NOT NULL DEFAULT 0,
  `izin_telat` bigint NOT NULL DEFAULT 0,
  `izin_pulang_cepat` bigint NOT NULL DEFAULT 0,
  `is_admin` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `masa_berlaku` date NULL DEFAULT NULL,
  `jabatan_id` bigint UNSIGNED NULL DEFAULT NULL,
  `lokasi_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ktp` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kartu_keluarga` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bpjs_kesehatan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bpjs_ketenagakerjaan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `npwp` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sim` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `no_pkwt` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `no_kontrak` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tanggal_mulai_pkwt` date NULL DEFAULT NULL,
  `tanggal_berakhir_pkwt` date NULL DEFAULT NULL,
  `rekening` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nama_rekening` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gaji_pokok` bigint NULL DEFAULT NULL,
  `makan_transport` bigint NULL DEFAULT NULL,
  `lembur` bigint NULL DEFAULT NULL,
  `kehadiran` bigint NULL DEFAULT NULL,
  `thr` bigint NULL DEFAULT NULL,
  `bonus_pribadi` bigint NULL DEFAULT NULL,
  `bonus_team` bigint NULL DEFAULT NULL,
  `bonus_jackpot` bigint NULL DEFAULT NULL,
  `izin` bigint NULL DEFAULT NULL,
  `terlambat` bigint NULL DEFAULT NULL,
  `mangkir` bigint NULL DEFAULT NULL,
  `saldo_kasbon` bigint NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Super Admin', NULL, NULL, 'admin@gmail.com', '085171744592', 'admin', '$2y$10$G93cEE8.Q3.PcECCLrvV3uWJSXqMfUpf8aqisFS90pxBjWY0063Lq', '2025-05-04', 'Laki-Laki', '1998-01-26', 'TK/1', 'jl. admin test', 12, 6, 16, 9, 'admin', NULL, 1, 1, '3375212601981211', '2311876775523112', '1627789654371789', '2312342432556232', '2312242432556232', '2312342433356232', '8312342433356232', '8312342433356232', '2025-05-04', '2028-10-10', '1255342433356232', 'Ricky Ramadhan', 7000000, 800000, 20000, 300000, 200000, 200000, 2000000, 0, 100000, 100000, 200000, 220000, NULL, NULL, '2025-05-04 21:25:24', '2025-05-04 21:25:24');
INSERT INTO `users` VALUES (2, 'User', NULL, NULL, 'user@gmail.com', '123456789', 'user', '$2y$10$Ze2V6WeH8T8TXERZeDi4D.9/aOExWnGhjygJRFTBixnrD/oVGzwKK', '2025-05-04', 'Laki-Laki', '2022-01-28', 'TK/0', 'jl. user test', 10, 10, 10, 10, 'user', NULL, 1, 1, '4575212601981211', '5311876775523112', '6227789654371789', '9712342432556232', '7712242432556232', '8312342433356232', '8312342433356232', '8312342433356232', '2025-05-04', '2028-10-10', '9255342433356232', 'User Ramadhan', 10000000, 900000, 20000, 800000, 700000, 0, 0, 0, 100000, 100000, 200000, 4000000, NULL, NULL, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `users` VALUES (3, 'User HRD', NULL, NULL, 'baim@gmail.com', '123456789', 'baim', '$2y$10$JHtil.2EX0yXewbNbdUxbu/2ah2Z6bCgrRQzEgJUmtNc2Jmri7eDu', '2025-05-04', 'Laki-Laki', '2022-01-28', 'K/0', 'jl. user test', 10, 10, 10, 10, 'user', NULL, 1, 2, '4575212601981211', '5311876775523112', '6227789654371789', '9712342432556232', '7712242432556232', '8312342433356232', '8312342433356232', '8312342433356232', '2025-05-04', '2028-10-10', '9255342433356232', 'User Ramadhan', 10000000, 900000, 20000, 800000, 700000, 0, 0, 0, 100000, 100000, 200000, 4000000, NULL, NULL, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `users` VALUES (4, 'User GM', NULL, NULL, 'fauzan@gmail.com', '123456789', 'fauzan', '$2y$10$ViY.cb99KhtOmyEtamfuQOaRPUk7ugrBzU/Y.6sjvrAZxbYsHEqSa', '2025-05-04', 'Laki-Laki', '2022-01-28', 'K/0', 'jl. user test', 10, 10, 10, 10, 'user', NULL, 1, 2, '4575212601981211', '5311876775523112', '6227789654371789', '9712342432556232', '7712242432556232', '8312342433356232', '8312342433356232', '8312342433356232', '2025-05-04', '2028-10-10', '9255342433356232', 'Fauzan Arya', 10000000, 900000, 20000, 800000, 700000, 0, 0, 0, 100000, 100000, 200000, 4000000, NULL, NULL, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `users` VALUES (5, 'User Finance', NULL, NULL, 'Pandu@gmail.com', '123456789', 'pandu', '$2y$10$DzLXuoPUEU9FYzPKYaa9Iuvo2cz0BeXsrXsnrFgeNQEcT9x/lAY0m', '2025-05-04', 'Laki-Laki', '2022-01-28', 'K/0', 'jl. user test', 10, 10, 10, 10, 'user', NULL, 1, 1, '4575212601981211', '5311876775523112', '6227789654371789', '9712342432556232', '7712242432556232', '8312342433356232', '8312342433356232', '8312342433356232', '2025-05-04', '2028-10-10', '9255342433356232', 'Pandu Arya', 10000000, 900000, 20000, 800000, 700000, 0, 0, 0, 100000, 100000, 200000, 4000000, NULL, NULL, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `users` VALUES (6, 'User Kep.Cabang', NULL, NULL, 'zhafira@gmail.com', '6281818607319', 'zhafira', '$2y$10$xWWlA2XYWwCh8bxknhI4HOR0TIrpmn.Ef21/l3I5A4kgB2YA2A1Sm', '2025-05-04', 'Laki-Laki', '2022-01-28', 'K/0', 'jl. user test', 10, 10, 10, 10, 'user', NULL, 1, 1, '4575212601981211', '5311876775523112', '6227789654371789', '9712342432556232', '7712242432556232', '8312342433356232', '8312342433356232', '8312342433356232', '2025-05-04', '2028-10-10', '9255342433356232', 'Zhafira Salsabil', 10000000, 900000, 20000, 800000, 700000, 0, 0, 0, 100000, 100000, 200000, 4000000, NULL, NULL, '2025-05-04 21:25:25', '2025-05-04 21:25:25');
INSERT INTO `users` VALUES (7, 'User Reg.Manager', NULL, NULL, 'yahya@gmail.com', '081818607319', 'yahya', '$2y$10$QhLtkEeziU60/.Js7zLL6ettYWTM0aWGt8pyIwPjoyQpquxczM5Uy', '2025-05-04', 'Laki-Laki', '2022-01-28', 'K/1', 'jl. user test', 10, 10, 10, 10, 'user', NULL, 1, 1, '4575212601981211', '5311876775523112', '6227789654371789', '9712342432556232', '7712242432556232', '8312342433356232', '8312342433356232', '8312342433356232', '2025-05-04', '2028-10-10', '9255342433356232', 'Yahya', 10000000, 900000, 20000, 800000, 700000, 0, 0, 0, 100000, 100000, 200000, 4000000, NULL, NULL, '2025-05-04 21:25:25', '2025-05-04 21:25:25');

SET FOREIGN_KEY_CHECKS = 1;
