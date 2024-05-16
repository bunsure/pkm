/*
 Navicat Premium Data Transfer

 Source Server         : 192.168.2.201
 Source Server Type    : MySQL
 Source Server Version : 50651
 Source Host           : 192.168.2.201:3306
 Source Schema         : db_web_disnakerin

 Target Server Type    : MySQL
 Target Server Version : 50651
 File Encoding         : 65001

 Date: 16/05/2024 11:38:31
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for berita
-- ----------------------------
DROP TABLE IF EXISTS `berita`;
CREATE TABLE `berita`  (
  `id_berita` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `isi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_posting` date NULL DEFAULT NULL,
  `created_at` datetime(0) NOT NULL,
  `create_by` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updated_at` datetime(0) NOT NULL,
  `update_by` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `uuid` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_berita`) USING BTREE,
  INDEX `uuid_index`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of berita
-- ----------------------------
INSERT INTO `berita` VALUES (15, 'Mediasi Antara PT. Kasongan Mining Milis Dengan Eks. Pekerja', '<p>Disnakerin Kab. Batang Hari, November 2023 bersama Mediator Melaksanakan Mediasi antara PT. Kasongan Mining Milis dgn eks pekerja</p>', '2023-11-07', '2023-11-07 12:24:22', 'administrator', '2023-11-09 12:30:03', 'administrator', '18fdac8f-6d17-3fe4-b7fa-d9b16d304444');
INSERT INTO `berita` VALUES (16, 'Pelaksanaan Monitoring dan Pembinaan IKM Batu Bata', '<p>Dinas Tenaga Kerja dan Perindustrian Kabupaten Batang Hari Bidang Perindustrian Melaksanakan Monitoring dan Pembinaan IKM Batu Bata di Kecamatan Muara Bulian Kabupaten Batang Hari Tahun 2023</p>', '2023-11-09', '2023-11-09 12:06:44', 'administrator', '2023-11-09 12:30:41', 'administrator', 'c7bfb265-ed21-333e-9829-41d5e6644ce0');
INSERT INTO `berita` VALUES (17, 'Pelaksanakan Monitoring dan Sosialisasi Ranperda Pajak Daerah dan Restribusi Daerah', '<p>Selamat Siang Sahabat Disnakerin, giat Kadis Nakerin Kab Batang Hari Bersama Kabid Pelatihan Penempatan dan Perluasan Kesempatan Kerja pada hari Rabu 08 November 2023 Melaksanakan Monitoring dan Sosialisasi Ranperda Pajak Daerah dan Restribusi Daerah Tentang Tenaga Kerja Asing di PT. Jambi Wood Industri dan PT. Superhome Produk Indonesia.</p>', '2023-11-09', '2023-11-09 12:38:08', 'administrator', '2023-11-09 12:38:08', 'administrator', '861dd002-0c97-3e1a-83bf-5a67a0a32016');
INSERT INTO `berita` VALUES (18, 'Disnakerin Mengikuti Senam Poco-Poco Kenangan', '<p>Sabtu 11 November 2023, Disnakerin Kab. Batang Hari mengikuti kegiatan Lomba Senam Poco-poco kenangan dalam rangka menyambut HUT. Batang Hari ke 75, acara di ikuti&nbsp;oleh OPD dan Masyarakat yang ada di Kabupaten Batang Hari.&nbsp;kegiatan berlangsung dari pukul 08.30 Wib sampai dengan Selesai yang di laksanakan di Gedung olahraga (GOR) Disparpora kabupaten Batang Hari.</p>', '2023-11-13', '2023-11-13 10:24:28', 'administrator', '2023-11-13 10:24:28', 'administrator', '224530c4-28ae-37cb-872e-b18ed67dd692');
INSERT INTO `berita` VALUES (19, 'Merayakan Hut Batang Hari ke 75', '<p>Dalam Rangka Batang Hari EXPO hut batang hari yang ke-75 Disnakerin Kab. Batang Hari Membuka Stand yang berlokasi di Depan Rumah Dinas Bupati Batang Hari, Disini tersedia Pelayanan untuk Pembuatan Kartu AK.I dan juga tersedia tempat Ngopi Barista binaan Disnakerin Kab. Batang Hari.. Yuk mampir, sambil santai guys....</p>', '2023-11-22', '2023-11-22 10:50:35', 'administrator', '2023-11-22 10:50:35', 'administrator', 'a7b178bf-a218-326b-8645-c82d4cbaccc9');
INSERT INTO `berita` VALUES (28, 'Disnakerin Melaksanakan Rapat Sidang Pleno Dewan Pengupahan', '<p>Disnakerin Melaksanakan Rapat Sidang Pleno Dewan Pengupahan Kabupaten Batang Hari Priode 2022- 2024 dalam Rangka Usulan Penetapan Upah Minimum Kabupaten (UMK) Tahun 2024</p>', '2023-12-06', '2023-12-06 15:52:43', 'administrator', '2023-12-06 15:52:43', 'administrator', '83d8918b-16ed-3e60-961f-8299f12b9bf6');
INSERT INTO `berita` VALUES (29, 'HUT BPJS Ketenagakerjaan ke- 46', '<p><em><strong>Kepala Dinas Nakerin</strong></em> Bersama <em><strong>Kasat Pol-PP</strong></em> Kab. Batang Hari memberikan Ucapan HUT BPJS Ketenagakerjaan <em>ke- 46</em>. Selamat dan sukses selalu untuk BPJS Ketenagakerjaan Kab. Batang Hari.</p>', '2023-12-07', '2023-12-07 16:08:49', 'administrator', '2023-12-07 16:08:49', 'administrator', '93d329a6-9593-3321-ae43-90acaadd3277');

-- ----------------------------
-- Table structure for dokumen
-- ----------------------------
DROP TABLE IF EXISTS `dokumen`;
CREATE TABLE `dokumen`  (
  `id_dokumen` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `filename` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipe` enum('file','gambar') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_dokumen`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of dokumen
-- ----------------------------
INSERT INTO `dokumen` VALUES ('1652237813968270', 'Modul Admin Web', 'upload/dokumen/modul-admin-website-1652237813968270.pdf', 'file', '2022-05-11 09:56:53', 'ngadmin');

-- ----------------------------
-- Table structure for dokumen_pengaduan
-- ----------------------------
DROP TABLE IF EXISTS `dokumen_pengaduan`;
CREATE TABLE `dokumen_pengaduan`  (
  `id_dokumen` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_dokumen` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `filename` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_pengaduan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_dokumen`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of dokumen_pengaduan
-- ----------------------------
INSERT INTO `dokumen_pengaduan` VALUES ('1698644130079381', 'marcopolo.png', 'upload/pengaduan/1698644130079381-marcopolo.png', '1698644099300765');

-- ----------------------------
-- Table structure for download
-- ----------------------------
DROP TABLE IF EXISTS `download`;
CREATE TABLE `download`  (
  `id_dokumen` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `filename` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipe` enum('file','gambar') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_dokumen`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of download
-- ----------------------------

-- ----------------------------
-- Table structure for gallery_photo
-- ----------------------------
DROP TABLE IF EXISTS `gallery_photo`;
CREATE TABLE `gallery_photo`  (
  `id_gallery` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `thumbs` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `caption` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_gallery`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of gallery_photo
-- ----------------------------

-- ----------------------------
-- Table structure for gambar
-- ----------------------------
DROP TABLE IF EXISTS `gambar`;
CREATE TABLE `gambar`  (
  `id_gambar` char(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `session` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `filename` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `thumbs` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `caption` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `create_by` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `update_by` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_gambar`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of gambar
-- ----------------------------
INSERT INTO `gambar` VALUES ('1663560792528217', 'c9d83f9f-3393-376b-995a-eeb68020b616', 'upload/gambar/1663560792528217.jpg', 'upload/gambar/thumb-1663560792528217.jpg', 'test', 'administrator', NULL, '2022-09-19 11:13:13', NULL);
INSERT INTO `gambar` VALUES ('1663562196905159', '900a3a06-a76b-3777-b1c7-a5afebc8c061', 'upload/gambar/1663562196905159.png', 'upload/gambar/thumb-1663562196905159.png', 'Vaksin', 'administrator', NULL, '2022-09-19 11:36:36', NULL);
INSERT INTO `gambar` VALUES ('1664370046708769', '900a3a06-a76b-3777-b1c7-a5afebc8c061', 'upload/gambar/1664370046708769.png', 'upload/gambar/thumb-1664370046708769.png', 'vaksin', 'administrator', NULL, '2022-09-28 20:00:47', NULL);
INSERT INTO `gambar` VALUES ('1664370754686718', '900a3a06-a76b-3777-b1c7-a5afebc8c061', 'upload/gambar/1664370754686718.png', 'upload/gambar/thumb-1664370754686718.png', 'vaksin', 'administrator', NULL, '2022-09-28 20:12:34', NULL);
INSERT INTO `gambar` VALUES ('1664375708320523', '9637547f-8343-345a-9638-6e8082c4ddd5', 'upload/gambar/1664375708320523.jpg', 'upload/gambar/thumb-1664375708320523.jpg', 'POLI UMUM', 'administrator', NULL, '2022-09-28 21:35:08', NULL);
INSERT INTO `gambar` VALUES ('1664436586216741', 'u', 'upload/gambar/1664436586216741.jpg', 'upload/gambar/thumb-1664436586216741.jpg', 'Alur Ruangan Tindakan', 'administrator', NULL, '2022-09-29 14:29:46', NULL);
INSERT INTO `gambar` VALUES ('1664436611831164', 'u', 'upload/gambar/1664436611831164.jpg', 'upload/gambar/thumb-1664436611831164.jpg', 'Alur Ruang Tindakan', 'administrator', NULL, '2022-09-29 14:30:12', NULL);
INSERT INTO `gambar` VALUES ('1664861170676854', '4b9fbce8-55ef-3ac8-b913-df6e3695bc83', 'upload/gambar/1664861170676854.jpg', 'upload/gambar/thumb-1664861170676854.jpg', 'Senam Prolanis', 'administrator', NULL, '2022-10-04 12:26:10', NULL);
INSERT INTO `gambar` VALUES ('1690353207807495', '8f874564-a5b0-3fb2-acdd-4fd57ceae347', 'upload/gambar/1690353207807495.jpeg', 'upload/gambar/thumb-1690353207807495.jpeg', 'dr.Astrid Ananda', 'administrator', NULL, '2023-07-26 13:33:27', NULL);
INSERT INTO `gambar` VALUES ('1690353249768230', '8f874564-a5b0-3fb2-acdd-4fd57ceae347', 'upload/gambar/1690353249768230.jpeg', 'upload/gambar/thumb-1690353249768230.jpeg', 'dr.Sri Ambarwati SR', 'administrator', NULL, '2023-07-26 13:34:09', NULL);
INSERT INTO `gambar` VALUES ('1690353974934859', '8f874564-a5b0-3fb2-acdd-4fd57ceae347', 'upload/gambar/1690353974934859.jpeg', 'upload/gambar/thumb-1690353974934859.jpeg', 'dr. Daan  Achmad', 'administrator', NULL, '2023-07-26 13:46:15', NULL);
INSERT INTO `gambar` VALUES ('1690354011656360', '8f874564-a5b0-3fb2-acdd-4fd57ceae347', 'upload/gambar/1690354011656360.jpeg', 'upload/gambar/thumb-1690354011656360.jpeg', 'dr. Sintia Widiawati', 'administrator', NULL, '2023-07-26 13:46:51', NULL);
INSERT INTO `gambar` VALUES ('1690354031012351', '8f874564-a5b0-3fb2-acdd-4fd57ceae347', 'upload/gambar/1690354031012351.jpeg', 'upload/gambar/thumb-1690354031012351.jpeg', 'drg.Mega Wulandari', 'administrator', NULL, '2023-07-26 13:47:11', NULL);
INSERT INTO `gambar` VALUES ('1690357118907612', '832faec9-8464-300e-bdb7-7c6b431bb8cf', 'upload/gambar/1690357118907612.jpeg', 'upload/gambar/thumb-1690357118907612.jpeg', '1', 'administrator', NULL, '2023-07-26 14:38:39', NULL);
INSERT INTO `gambar` VALUES ('1690357131155798', '832faec9-8464-300e-bdb7-7c6b431bb8cf', 'upload/gambar/1690357131155798.jpeg', 'upload/gambar/thumb-1690357131155798.jpeg', '2', 'administrator', NULL, '2023-07-26 14:38:51', NULL);
INSERT INTO `gambar` VALUES ('1690357148154293', '832faec9-8464-300e-bdb7-7c6b431bb8cf', 'upload/gambar/1690357148154293.jpeg', 'upload/gambar/thumb-1690357148154293.jpeg', '3', 'administrator', NULL, '2023-07-26 14:39:08', NULL);
INSERT INTO `gambar` VALUES ('1690357159142430', '832faec9-8464-300e-bdb7-7c6b431bb8cf', 'upload/gambar/1690357159142430.jpeg', 'upload/gambar/thumb-1690357159142430.jpeg', '4', 'administrator', NULL, '2023-07-26 14:39:19', NULL);
INSERT INTO `gambar` VALUES ('1690357201712827', '81a198b2-e688-3b39-b4e0-e5d7a44a5e27', 'upload/gambar/1690357201712827.jpeg', 'upload/gambar/thumb-1690357201712827.jpeg', '1', 'administrator', NULL, '2023-07-26 14:40:01', NULL);
INSERT INTO `gambar` VALUES ('1690357226688519', '04622452-f828-3f9f-92e3-d855dc6de3f7', 'upload/gambar/1690357226688519.jpeg', 'upload/gambar/thumb-1690357226688519.jpeg', 'Alur 1', 'administrator', NULL, '2023-07-26 14:40:26', NULL);
INSERT INTO `gambar` VALUES ('1690357309533611', '548a8c09-edf0-37ec-8ff1-f691b4f57f66', 'upload/gambar/1690357309533611.jpeg', 'upload/gambar/thumb-1690357309533611.jpeg', '1', 'administrator', NULL, '2023-07-26 14:41:49', NULL);
INSERT INTO `gambar` VALUES ('1690357574842414', '3c3205d6-8988-39a0-a1ef-b6342552daa6', 'upload/gambar/1690357574842414.jpeg', 'upload/gambar/thumb-1690357574842414.jpeg', '1', 'administrator', NULL, '2023-07-26 14:46:14', NULL);
INSERT INTO `gambar` VALUES ('1690357589823256', '3c3205d6-8988-39a0-a1ef-b6342552daa6', 'upload/gambar/1690357589823256.jpeg', 'upload/gambar/thumb-1690357589823256.jpeg', '2', 'administrator', NULL, '2023-07-26 14:46:29', NULL);
INSERT INTO `gambar` VALUES ('1690357601798334', '3c3205d6-8988-39a0-a1ef-b6342552daa6', 'upload/gambar/1690357601798334.jpeg', 'upload/gambar/thumb-1690357601798334.jpeg', '3', 'administrator', NULL, '2023-07-26 14:46:41', NULL);
INSERT INTO `gambar` VALUES ('1690357613454940', '3c3205d6-8988-39a0-a1ef-b6342552daa6', 'upload/gambar/1690357613454940.jpeg', 'upload/gambar/thumb-1690357613454940.jpeg', '4', 'administrator', NULL, '2023-07-26 14:46:53', NULL);
INSERT INTO `gambar` VALUES ('1690358567689675', '79590281-c408-32cc-9e85-0999672b3440', 'upload/gambar/1690358567689675.jpeg', 'upload/gambar/thumb-1690358567689675.jpeg', '1', 'administrator', NULL, '2023-07-26 15:02:47', NULL);
INSERT INTO `gambar` VALUES ('1690358577195356', '79590281-c408-32cc-9e85-0999672b3440', 'upload/gambar/1690358577195356.jpeg', 'upload/gambar/thumb-1690358577195356.jpeg', '2', 'administrator', NULL, '2023-07-26 15:02:57', NULL);
INSERT INTO `gambar` VALUES ('1690358586981475', '79590281-c408-32cc-9e85-0999672b3440', 'upload/gambar/1690358586981475.jpeg', 'upload/gambar/thumb-1690358586981475.jpeg', '3', 'administrator', NULL, '2023-07-26 15:03:07', NULL);
INSERT INTO `gambar` VALUES ('1690358595244149', '79590281-c408-32cc-9e85-0999672b3440', 'upload/gambar/1690358595244149.jpeg', 'upload/gambar/thumb-1690358595244149.jpeg', '4', 'administrator', NULL, '2023-07-26 15:03:15', NULL);
INSERT INTO `gambar` VALUES ('1690358604510470', '79590281-c408-32cc-9e85-0999672b3440', 'upload/gambar/1690358604510470.jpeg', 'upload/gambar/thumb-1690358604510470.jpeg', '5', 'administrator', NULL, '2023-07-26 15:03:24', NULL);
INSERT INTO `gambar` VALUES ('1690358618256185', '79590281-c408-32cc-9e85-0999672b3440', 'upload/gambar/1690358618256185.jpeg', 'upload/gambar/thumb-1690358618256185.jpeg', '6', 'administrator', NULL, '2023-07-26 15:03:38', NULL);
INSERT INTO `gambar` VALUES ('1690358632853935', '79590281-c408-32cc-9e85-0999672b3440', 'upload/gambar/1690358632853935.jpeg', 'upload/gambar/thumb-1690358632853935.jpeg', '7', 'administrator', NULL, '2023-07-26 15:03:52', NULL);
INSERT INTO `gambar` VALUES ('1690358653027464', '79590281-c408-32cc-9e85-0999672b3440', 'upload/gambar/1690358653027464.jpeg', 'upload/gambar/thumb-1690358653027464.jpeg', '8', 'administrator', NULL, '2023-07-26 15:04:13', NULL);
INSERT INTO `gambar` VALUES ('1690358671950933', '79590281-c408-32cc-9e85-0999672b3440', 'upload/gambar/1690358671950933.jpeg', 'upload/gambar/thumb-1690358671950933.jpeg', '9', 'administrator', NULL, '2023-07-26 15:04:32', NULL);
INSERT INTO `gambar` VALUES ('1690358689639136', '79590281-c408-32cc-9e85-0999672b3440', 'upload/gambar/1690358689639136.jpeg', 'upload/gambar/thumb-1690358689639136.jpeg', '10', 'administrator', NULL, '2023-07-26 15:04:49', NULL);
INSERT INTO `gambar` VALUES ('1690359019581426', '4f41fca1-0992-32e0-b4bb-c26ed50f16cd', 'upload/gambar/1690359019581426.jpeg', 'upload/gambar/thumb-1690359019581426.jpeg', '1', 'administrator', NULL, '2023-07-26 15:10:19', NULL);
INSERT INTO `gambar` VALUES ('1690359028983588', '4f41fca1-0992-32e0-b4bb-c26ed50f16cd', 'upload/gambar/1690359028983588.jpeg', 'upload/gambar/thumb-1690359028983588.jpeg', '2', 'administrator', NULL, '2023-07-26 15:10:29', NULL);
INSERT INTO `gambar` VALUES ('1690359038711673', '4f41fca1-0992-32e0-b4bb-c26ed50f16cd', 'upload/gambar/1690359038711673.jpeg', 'upload/gambar/thumb-1690359038711673.jpeg', '3', 'administrator', NULL, '2023-07-26 15:10:38', NULL);
INSERT INTO `gambar` VALUES ('169035904896379', '4f41fca1-0992-32e0-b4bb-c26ed50f16cd', 'upload/gambar/169035904896379.jpeg', 'upload/gambar/thumb-169035904896379.jpeg', '4', 'administrator', NULL, '2023-07-26 15:10:49', NULL);
INSERT INTO `gambar` VALUES ('1690359061500216', '4f41fca1-0992-32e0-b4bb-c26ed50f16cd', 'upload/gambar/1690359061500216.jpeg', 'upload/gambar/thumb-1690359061500216.jpeg', '5', 'administrator', NULL, '2023-07-26 15:11:01', NULL);
INSERT INTO `gambar` VALUES ('1690359072034286', '4f41fca1-0992-32e0-b4bb-c26ed50f16cd', 'upload/gambar/1690359072034286.jpeg', 'upload/gambar/thumb-1690359072034286.jpeg', '6', 'administrator', NULL, '2023-07-26 15:11:12', NULL);
INSERT INTO `gambar` VALUES ('1690359083579734', '4f41fca1-0992-32e0-b4bb-c26ed50f16cd', 'upload/gambar/1690359083579734.jpeg', 'upload/gambar/thumb-1690359083579734.jpeg', '7', 'administrator', NULL, '2023-07-26 15:11:23', NULL);
INSERT INTO `gambar` VALUES ('1690359093577550', '4f41fca1-0992-32e0-b4bb-c26ed50f16cd', 'upload/gambar/1690359093577550.jpeg', 'upload/gambar/thumb-1690359093577550.jpeg', '8', 'administrator', NULL, '2023-07-26 15:11:33', NULL);
INSERT INTO `gambar` VALUES ('1690359106685244', '4f41fca1-0992-32e0-b4bb-c26ed50f16cd', 'upload/gambar/1690359106685244.jpeg', 'upload/gambar/thumb-1690359106685244.jpeg', '9', 'administrator', NULL, '2023-07-26 15:11:46', NULL);
INSERT INTO `gambar` VALUES ('1690359119448439', '4f41fca1-0992-32e0-b4bb-c26ed50f16cd', 'upload/gambar/1690359119448439.jpeg', 'upload/gambar/thumb-1690359119448439.jpeg', '10', 'administrator', NULL, '2023-07-26 15:11:59', NULL);
INSERT INTO `gambar` VALUES ('1690359129966798', '4f41fca1-0992-32e0-b4bb-c26ed50f16cd', 'upload/gambar/1690359129966798.jpeg', 'upload/gambar/thumb-1690359129966798.jpeg', '11', 'administrator', NULL, '2023-07-26 15:12:10', NULL);
INSERT INTO `gambar` VALUES ('1690360167317522', '96adf142-5a12-3892-918a-2bf60754b8d6', 'upload/gambar/1690360167317522.jpeg', 'upload/gambar/thumb-1690360167317522.jpeg', '1', 'administrator', NULL, '2023-07-26 15:29:27', NULL);
INSERT INTO `gambar` VALUES ('1690360323413755', '46a3633b-c96c-3210-af06-f8583d1ee324', 'upload/gambar/1690360323413755.jpeg', 'upload/gambar/thumb-1690360323413755.jpeg', '2', 'administrator', NULL, '2023-07-26 15:32:03', NULL);
INSERT INTO `gambar` VALUES ('1690360365927724', 'd0c2febd-d438-3dba-ab9b-e497444a3f2e', 'upload/gambar/1690360365927724.jpeg', 'upload/gambar/thumb-1690360365927724.jpeg', '3', 'administrator', NULL, '2023-07-26 15:32:46', NULL);
INSERT INTO `gambar` VALUES ('1690360620120443', 'a2291ba7-a246-3f65-b8dc-fbf4f7fab038', 'upload/gambar/1690360620120443.jpeg', 'upload/gambar/thumb-1690360620120443.jpeg', '3', 'administrator', NULL, '2023-07-26 15:37:00', NULL);
INSERT INTO `gambar` VALUES ('1690360666508427', 'e97bcca4-c1b2-3a76-ac3b-5834efa128df', 'upload/gambar/1690360666508427.jpeg', 'upload/gambar/thumb-1690360666508427.jpeg', '4', 'administrator', NULL, '2023-07-26 15:37:46', NULL);
INSERT INTO `gambar` VALUES ('1690360717237221', '2df4472f-0ee7-312c-af2d-bf733b94e6b3', 'upload/gambar/1690360717237221.jpeg', 'upload/gambar/thumb-1690360717237221.jpeg', '5', 'administrator', NULL, '2023-07-26 15:38:37', NULL);
INSERT INTO `gambar` VALUES ('1690360767113562', '7561b2f8-6ed2-37c6-8a5a-7f6a1c2b1208', 'upload/gambar/1690360767113562.jpeg', 'upload/gambar/thumb-1690360767113562.jpeg', '5', 'administrator', NULL, '2023-07-26 15:39:27', NULL);
INSERT INTO `gambar` VALUES ('1690360819268117', 'ee8fced2-d272-3704-9021-f91d24eae0e2', 'upload/gambar/1690360819268117.jpeg', 'upload/gambar/thumb-1690360819268117.jpeg', '7', 'administrator', NULL, '2023-07-26 15:40:19', NULL);
INSERT INTO `gambar` VALUES ('169036085910655', '191f2a57-6b40-3a18-87bf-8c7953358b3a', 'upload/gambar/169036085910655.jpeg', 'upload/gambar/thumb-169036085910655.jpeg', '8', 'administrator', NULL, '2023-07-26 15:40:59', NULL);
INSERT INTO `gambar` VALUES ('1690360887092576', '8167a7e5-5ae3-3d48-a43b-7a539bec4c6b', 'upload/gambar/1690360887092576.jpeg', 'upload/gambar/thumb-1690360887092576.jpeg', '8', 'administrator', NULL, '2023-07-26 15:41:27', NULL);
INSERT INTO `gambar` VALUES ('1690361442319976', '4ff0685d-aadc-3c9b-a879-be45ad8423f9', 'upload/gambar/1690361442319976.jpeg', 'upload/gambar/thumb-1690361442319976.jpeg', '9', 'administrator', NULL, '2023-07-26 15:50:42', NULL);
INSERT INTO `gambar` VALUES ('1690361586969750', '4f41fca1-0992-32e0-b4bb-c26ed50f16cd', 'upload/gambar/1690361586969750.jpeg', 'upload/gambar/thumb-1690361586969750.jpeg', '11', 'administrator', NULL, '2023-07-26 15:53:07', NULL);
INSERT INTO `gambar` VALUES ('1690362685496689', '9073fa2a-73cf-3ab7-ae74-9d662c58909f', 'upload/gambar/1690362685496689.jpeg', 'upload/gambar/thumb-1690362685496689.jpeg', 'Fogging', 'administrator', NULL, '2023-07-26 16:11:25', NULL);
INSERT INTO `gambar` VALUES ('1690362723354799', 'c98bc92e-6812-3068-a57f-9946dc4af990', 'upload/gambar/1690362723354799.jpeg', 'upload/gambar/thumb-1690362723354799.jpeg', '11', 'administrator', NULL, '2023-07-26 16:12:03', NULL);
INSERT INTO `gambar` VALUES ('1690363345909974', 'f59fb617-be2a-33ce-a491-bbb6f57c1f3b', 'upload/gambar/1690363345909974.jpeg', 'upload/gambar/thumb-1690363345909974.jpeg', '1', 'administrator', NULL, '2023-07-26 16:22:26', NULL);
INSERT INTO `gambar` VALUES ('1690363644411136', 'a18c23cd-aad7-3742-afbe-dfe8dbf444d2', 'upload/gambar/1690363644411136.jpeg', 'upload/gambar/thumb-1690363644411136.jpeg', '12', 'administrator', NULL, '2023-07-26 16:27:24', NULL);
INSERT INTO `gambar` VALUES ('1690363785325734', '17438a03-add1-3dc6-8719-ab6dd58ff7e2', 'upload/gambar/1690363785325734.jpeg', 'upload/gambar/thumb-1690363785325734.jpeg', 'taman puskesmas jembatan mas', 'administrator', NULL, '2023-07-26 16:29:45', NULL);
INSERT INTO `gambar` VALUES ('1690364038594411', 'f74c9ea3-6300-348a-a75f-5cfaf85b8205', 'upload/gambar/1690364038594411.jpeg', 'upload/gambar/thumb-1690364038594411.jpeg', 'DBD', 'administrator', NULL, '2023-07-26 16:33:58', NULL);
INSERT INTO `gambar` VALUES ('169036459641788', '9b931a17-811b-37a7-855f-80bf002f4619', 'upload/gambar/169036459641788.jpeg', 'upload/gambar/thumb-169036459641788.jpeg', '1', 'administrator', NULL, '2023-07-26 16:43:16', NULL);
INSERT INTO `gambar` VALUES ('1690364606596139', '9b931a17-811b-37a7-855f-80bf002f4619', 'upload/gambar/1690364606596139.jpeg', 'upload/gambar/thumb-1690364606596139.jpeg', '2', 'administrator', NULL, '2023-07-26 16:43:26', NULL);
INSERT INTO `gambar` VALUES ('1690364615982738', '9b931a17-811b-37a7-855f-80bf002f4619', 'upload/gambar/1690364615982738.jpeg', 'upload/gambar/thumb-1690364615982738.jpeg', '3', 'administrator', NULL, '2023-07-26 16:43:36', NULL);
INSERT INTO `gambar` VALUES ('1690364627340798', '9b931a17-811b-37a7-855f-80bf002f4619', 'upload/gambar/1690364627340798.jpeg', 'upload/gambar/thumb-1690364627340798.jpeg', '3', 'administrator', NULL, '2023-07-26 16:43:47', NULL);
INSERT INTO `gambar` VALUES ('1690375772291684', '19504dc3-f8b8-3276-ab92-8ade5b3a39c7', 'upload/gambar/1690375772291684.jpg', 'upload/gambar/thumb-1690375772291684.jpg', '13', 'administrator', NULL, '2023-07-26 19:49:32', NULL);
INSERT INTO `gambar` VALUES ('1690375896371586', '4f41fca1-0992-32e0-b4bb-c26ed50f16cd', 'upload/gambar/1690375896371586.jpg', 'upload/gambar/thumb-1690375896371586.jpg', '13', 'administrator', NULL, '2023-07-26 19:51:36', NULL);
INSERT INTO `gambar` VALUES ('1691037793176887', '8dd2c594-a9a0-360f-b9c2-7364edc54e63', 'upload/gambar/1691037793176887.jpg', 'upload/gambar/thumb-1691037793176887.jpg', 'OBAT CACING', 'administrator', NULL, '2023-08-03 11:43:13', NULL);
INSERT INTO `gambar` VALUES ('1691037817942512', '8dd2c594-a9a0-360f-b9c2-7364edc54e63', 'upload/gambar/1691037817942512.jpg', 'upload/gambar/thumb-1691037817942512.jpg', 'OBAT CACING', 'administrator', NULL, '2023-08-03 11:43:38', NULL);
INSERT INTO `gambar` VALUES ('1691037922346963', 'd36316b2-e32a-33f9-8182-2bff79893229', 'upload/gambar/1691037922346963.jpg', 'upload/gambar/thumb-1691037922346963.jpg', '1', 'administrator', NULL, '2023-08-03 11:45:22', NULL);
INSERT INTO `gambar` VALUES ('169103844164498', 'c0fb6c29-3ee2-3b23-beab-b3c965648e4f', 'upload/gambar/169103844164498.jpeg', 'upload/gambar/thumb-169103844164498.jpeg', '12', 'administrator', NULL, '2023-08-03 11:54:01', NULL);
INSERT INTO `gambar` VALUES ('1698213177072366', 'db2f8f6e-c9b5-3202-866a-d81c55fcecb4', 'upload/gambar/1698213177072366.png', 'upload/gambar/thumb-1698213177072366.png', 'Pelaksanan Pelatihan Peserta', 'administrator', NULL, '2023-10-25 12:52:57', NULL);
INSERT INTO `gambar` VALUES ('1698213285257163', 'db2f8f6e-c9b5-3202-866a-d81c55fcecb4', 'upload/gambar/1698213285257163.png', 'upload/gambar/thumb-1698213285257163.png', 'Kegiatan Pelatihan Barista', 'administrator', NULL, '2023-10-25 12:54:45', NULL);
INSERT INTO `gambar` VALUES ('1699334634799697', '18fdac8f-6d17-3fe4-b7fa-d9b16d304444', 'upload/gambar/1699334634799697.jpg', 'upload/gambar/thumb-1699334634799697.jpg', 'Pelaksanaan Mediasi dengan Mediator', 'administrator', NULL, '2023-11-07 12:23:54', NULL);
INSERT INTO `gambar` VALUES ('1699334652593870', '18fdac8f-6d17-3fe4-b7fa-d9b16d304444', 'upload/gambar/1699334652593870.jpg', 'upload/gambar/thumb-1699334652593870.jpg', 'Pelaksanaan Mediasi dengan Mediator', 'administrator', NULL, '2023-11-07 12:24:12', NULL);
INSERT INTO `gambar` VALUES ('1699506383525298', 'c7bfb265-ed21-333e-9829-41d5e6644ce0', 'upload/gambar/1699506383525298.jpg', 'upload/gambar/thumb-1699506383525298.jpg', 'Pelaksanaan Monitoring dan Pembinaan IKM', 'administrator', NULL, '2023-11-09 12:06:23', NULL);
INSERT INTO `gambar` VALUES ('1699506955160242', '53ee49cf-6a0b-30df-8cc0-790e8d379468', 'upload/gambar/1699506955160242.jpg', 'upload/gambar/thumb-1699506955160242.jpg', 'Foto di Lokasi Pembuatan Batu Bata', 'administrator', NULL, '2023-11-09 12:15:55', NULL);
INSERT INTO `gambar` VALUES ('1699507838378664', 'c7bfb265-ed21-333e-9829-41d5e6644ce0', 'upload/gambar/1699507838378664.jpg', 'upload/gambar/thumb-1699507838378664.jpg', 'Pelaksanaan Monitoring dan Pembinaan IKM', 'administrator', NULL, '2023-11-09 12:30:38', NULL);
INSERT INTO `gambar` VALUES ('1699508222552196', '861dd002-0c97-3e1a-83bf-5a67a0a32016', 'upload/gambar/1699508222552196.jpg', 'upload/gambar/thumb-1699508222552196.jpg', 'Monitoring dan Sosialisasi Ranperda Pajak Daerah dan Restribusi Daerah', 'administrator', NULL, '2023-11-09 12:37:02', NULL);
INSERT INTO `gambar` VALUES ('1699508242417565', '861dd002-0c97-3e1a-83bf-5a67a0a32016', 'upload/gambar/1699508242417565.jpg', 'upload/gambar/thumb-1699508242417565.jpg', 'Monitoring dan Sosialisasi Ranperda Pajak Daerah dan Restribusi Daerah', 'administrator', NULL, '2023-11-09 12:37:22', NULL);
INSERT INTO `gambar` VALUES ('1699508261788252', '861dd002-0c97-3e1a-83bf-5a67a0a32016', 'upload/gambar/1699508261788252.jpg', 'upload/gambar/thumb-1699508261788252.jpg', 'Monitoring dan Sosialisasi Ranperda Pajak Daerah dan Restribusi Daerah', 'administrator', NULL, '2023-11-09 12:37:42', NULL);
INSERT INTO `gambar` VALUES ('1699509065365278', '47c66b68-7216-3fdc-a127-c6c07999e63b', 'upload/gambar/1699509065365278.jpg', 'upload/gambar/thumb-1699509065365278.jpg', 'Syarat Pembuatan Kartu AK.1', 'administrator', NULL, '2023-11-09 12:51:05', NULL);
INSERT INTO `gambar` VALUES ('1699581080847179', '40045ac4-b698-3cb8-a27b-04f6eba38560', 'upload/gambar/1699581080847179.jpg', 'upload/gambar/thumb-1699581080847179.jpg', 'Syarat Pembuatan Kartu AK.1', 'administrator', 'administrator', '2023-11-10 08:51:20', '2023-11-28 12:44:03');
INSERT INTO `gambar` VALUES ('1699844492370311', '224530c4-28ae-37cb-872e-b18ed67dd692', 'upload/gambar/1699844492370311.jpeg', 'upload/gambar/thumb-1699844492370311.jpeg', 'Peserta Senam Poco-poco Perwakilan Disnakerin Kab. Batang Hari', 'administrator', NULL, '2023-11-13 10:01:32', NULL);
INSERT INTO `gambar` VALUES ('1699844531340180', '224530c4-28ae-37cb-872e-b18ed67dd692', 'upload/gambar/1699844531340180.jpeg', 'upload/gambar/thumb-1699844531340180.jpeg', 'Foto Bersama', 'administrator', NULL, '2023-11-13 10:02:11', NULL);
INSERT INTO `gambar` VALUES ('1700624769345517', 'a7b178bf-a218-326b-8645-c82d4cbaccc9', 'upload/gambar/1700624769345517.jpeg', 'upload/gambar/thumb-1700624769345517.jpeg', 'Stand Disnaker Kab. Batang Hari', 'administrator', NULL, '2023-11-22 10:46:09', NULL);
INSERT INTO `gambar` VALUES ('170062488850271', 'a7b178bf-a218-326b-8645-c82d4cbaccc9', 'upload/gambar/170062488850271.jpeg', 'upload/gambar/thumb-170062488850271.jpeg', 'Kujungan ke Stand Disnakerin', 'administrator', NULL, '2023-11-22 10:48:08', NULL);
INSERT INTO `gambar` VALUES ('1700624989691469', 'a7b178bf-a218-326b-8645-c82d4cbaccc9', 'upload/gambar/1700624989691469.jpeg', 'upload/gambar/thumb-1700624989691469.jpeg', 'Kunjungan ke Stand Disnakerin', 'administrator', NULL, '2023-11-22 10:49:49', NULL);
INSERT INTO `gambar` VALUES ('170062503358749', 'a7b178bf-a218-326b-8645-c82d4cbaccc9', 'upload/gambar/170062503358749.jpeg', 'upload/gambar/thumb-170062503358749.jpeg', 'Kopi Barista Binaan Disnakerin Kab. Batang Hari', 'administrator', NULL, '2023-11-22 10:50:33', NULL);
INSERT INTO `gambar` VALUES ('1701666415966141', '6ec3c4c0-48ae-3cf8-826e-2a25687ce0b1', 'upload/gambar/1701666415966141.jpg', 'upload/gambar/thumb-1701666415966141.jpg', 'Dinas Tenaga Kerja dan Perindustrian Catat 33 Warga Batang hari Magang dan Bekerja di Luar Negeri', 'administrator', NULL, '2023-12-04 12:06:56', NULL);
INSERT INTO `gambar` VALUES ('1701852624851769', '83d8918b-16ed-3e60-961f-8299f12b9bf6', 'upload/gambar/1701852624851769.jpg', 'upload/gambar/thumb-1701852624851769.jpg', 'Giat Melaksanakan Rapat Sidang Pleno Dewan Pengupahan', 'administrator', NULL, '2023-12-06 15:50:24', NULL);
INSERT INTO `gambar` VALUES ('1701852712136418', '83d8918b-16ed-3e60-961f-8299f12b9bf6', 'upload/gambar/1701852712136418.jpg', 'upload/gambar/thumb-1701852712136418.jpg', 'Rapat Telaksana dengan dihadiri para Undangan', 'administrator', NULL, '2023-12-06 15:51:52', NULL);
INSERT INTO `gambar` VALUES ('1701852755091659', '83d8918b-16ed-3e60-961f-8299f12b9bf6', 'upload/gambar/1701852755091659.jpg', 'upload/gambar/thumb-1701852755091659.jpg', 'Pembahasan Usulan Penetapan Upah Minimum Kabupaten (UMK) Tahun 2024', 'administrator', NULL, '2023-12-06 15:52:35', NULL);
INSERT INTO `gambar` VALUES ('1701939881054996', '93d329a6-9593-3321-ae43-90acaadd3277', 'upload/gambar/1701939881054996.jpg', 'upload/gambar/thumb-1701939881054996.jpg', 'HUT BPJS Ketenagakerjaan ke 46', 'administrator', NULL, '2023-12-07 16:04:41', NULL);
INSERT INTO `gambar` VALUES ('170194002799360', '93d329a6-9593-3321-ae43-90acaadd3277', 'upload/gambar/170194002799360.jpeg', 'upload/gambar/thumb-170194002799360.jpeg', 'Ucapan dari Kadis Nakerin', 'administrator', NULL, '2023-12-07 16:07:09', NULL);
INSERT INTO `gambar` VALUES ('1701940060695180', '93d329a6-9593-3321-ae43-90acaadd3277', 'upload/gambar/1701940060695180.jpeg', 'upload/gambar/thumb-1701940060695180.jpeg', 'ucapan dari Kasat Pol-PP', 'administrator', NULL, '2023-12-07 16:07:41', NULL);
INSERT INTO `gambar` VALUES ('1701940098956276', '93d329a6-9593-3321-ae43-90acaadd3277', 'upload/gambar/1701940098956276.jpg', 'upload/gambar/thumb-1701940098956276.jpg', 'Foto Bersama Karyawan dan Karyawati BPJS Ketenagakerjaan', 'administrator', NULL, '2023-12-07 16:08:19', NULL);

-- ----------------------------
-- Table structure for gambar_berita
-- ----------------------------
DROP TABLE IF EXISTS `gambar_berita`;
CREATE TABLE `gambar_berita`  (
  `id_gambar_berita` int(11) NOT NULL AUTO_INCREMENT,
  `id_gambar` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_berita` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_gambar_berita`) USING BTREE,
  INDEX `id_gambar`(`id_gambar`) USING BTREE,
  INDEX `id_berita`(`id_berita`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of gambar_berita
-- ----------------------------
INSERT INTO `gambar_berita` VALUES (1, '1663560792528217', 1);
INSERT INTO `gambar_berita` VALUES (2, '1663562196905159', 2);
INSERT INTO `gambar_berita` VALUES (3, '1663562196905159', 3);
INSERT INTO `gambar_berita` VALUES (4, '1664370046708769', 3);
INSERT INTO `gambar_berita` VALUES (5, '1664370754686718', 3);
INSERT INTO `gambar_berita` VALUES (7, '1664861170676854', 4);
INSERT INTO `gambar_berita` VALUES (8, '1690268122961725', 5);
INSERT INTO `gambar_berita` VALUES (9, '1690291698445249', 6);
INSERT INTO `gambar_berita` VALUES (11, '1690364038594411', 7);
INSERT INTO `gambar_berita` VALUES (12, '169036459641788', 10);
INSERT INTO `gambar_berita` VALUES (13, '1690364606596139', 10);
INSERT INTO `gambar_berita` VALUES (14, '1690364615982738', 10);
INSERT INTO `gambar_berita` VALUES (15, '1690364627340798', 10);
INSERT INTO `gambar_berita` VALUES (20, '1690363785325734', 9);
INSERT INTO `gambar_berita` VALUES (21, '1691037922346963', 11);
INSERT INTO `gambar_berita` VALUES (22, '169103844164498', 12);
INSERT INTO `gambar_berita` VALUES (23, '1698213177072366', 13);
INSERT INTO `gambar_berita` VALUES (29, '1698213177072366', 14);
INSERT INTO `gambar_berita` VALUES (30, '1698213285257163', 14);
INSERT INTO `gambar_berita` VALUES (39, '1699334634799697', 15);
INSERT INTO `gambar_berita` VALUES (40, '1699334652593870', 15);
INSERT INTO `gambar_berita` VALUES (41, '1699506383525298', 16);
INSERT INTO `gambar_berita` VALUES (42, '1699507838378664', 16);
INSERT INTO `gambar_berita` VALUES (43, '1699508222552196', 17);
INSERT INTO `gambar_berita` VALUES (44, '1699508242417565', 17);
INSERT INTO `gambar_berita` VALUES (45, '1699508261788252', 17);
INSERT INTO `gambar_berita` VALUES (46, '1699844492370311', 18);
INSERT INTO `gambar_berita` VALUES (47, '1699844531340180', 18);
INSERT INTO `gambar_berita` VALUES (48, '1700624769345517', 19);
INSERT INTO `gambar_berita` VALUES (49, '170062488850271', 19);
INSERT INTO `gambar_berita` VALUES (50, '1700624989691469', 19);
INSERT INTO `gambar_berita` VALUES (51, '170062503358749', 19);
INSERT INTO `gambar_berita` VALUES (52, '1701852624851769', 28);
INSERT INTO `gambar_berita` VALUES (53, '1701852712136418', 28);
INSERT INTO `gambar_berita` VALUES (54, '1701852755091659', 28);
INSERT INTO `gambar_berita` VALUES (55, '1701939881054996', 29);
INSERT INTO `gambar_berita` VALUES (56, '170194002799360', 29);
INSERT INTO `gambar_berita` VALUES (57, '1701940060695180', 29);
INSERT INTO `gambar_berita` VALUES (58, '1701940098956276', 29);

-- ----------------------------
-- Table structure for gambar_halaman
-- ----------------------------
DROP TABLE IF EXISTS `gambar_halaman`;
CREATE TABLE `gambar_halaman`  (
  `id_gambar_halaman` int(11) NOT NULL AUTO_INCREMENT,
  `id_gambar` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_halaman` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_gambar_halaman`) USING BTREE,
  INDEX `id_gambar`(`id_gambar`) USING BTREE,
  INDEX `id_berita`(`id_halaman`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 184 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of gambar_halaman
-- ----------------------------
INSERT INTO `gambar_halaman` VALUES (16, '161793220829528', 2);
INSERT INTO `gambar_halaman` VALUES (17, '1618536706137993', 5);
INSERT INTO `gambar_halaman` VALUES (18, '1618537742278931', 6);
INSERT INTO `gambar_halaman` VALUES (19, '1618537874865477', 7);
INSERT INTO `gambar_halaman` VALUES (20, '1619063019319911', 8);
INSERT INTO `gambar_halaman` VALUES (24, '161915261765872', 11);
INSERT INTO `gambar_halaman` VALUES (25, '1619152799149359', 12);
INSERT INTO `gambar_halaman` VALUES (28, '1619152896858220', 15);
INSERT INTO `gambar_halaman` VALUES (34, '1619153686412532', 21);
INSERT INTO `gambar_halaman` VALUES (35, '1619153657487421', 20);
INSERT INTO `gambar_halaman` VALUES (39, '1619063447882855', 9);
INSERT INTO `gambar_halaman` VALUES (40, '1619153738099110', 22);
INSERT INTO `gambar_halaman` VALUES (41, '1619153503020899', 17);
INSERT INTO `gambar_halaman` VALUES (42, '1621820150588469', 23);
INSERT INTO `gambar_halaman` VALUES (43, '1621820269271812', 24);
INSERT INTO `gambar_halaman` VALUES (45, '1625641698197325', 26);
INSERT INTO `gambar_halaman` VALUES (53, '1627197923297198', 31);
INSERT INTO `gambar_halaman` VALUES (54, '1627197985717188', 31);
INSERT INTO `gambar_halaman` VALUES (55, '162719800155622', 31);
INSERT INTO `gambar_halaman` VALUES (56, '1627198014835675', 31);
INSERT INTO `gambar_halaman` VALUES (57, '1627198035754792', 31);
INSERT INTO `gambar_halaman` VALUES (105, '1690353207807495', 58);
INSERT INTO `gambar_halaman` VALUES (106, '1690353249768230', 58);
INSERT INTO `gambar_halaman` VALUES (107, '1690353974934859', 58);
INSERT INTO `gambar_halaman` VALUES (108, '1690354011656360', 58);
INSERT INTO `gambar_halaman` VALUES (109, '1690354031012351', 58);
INSERT INTO `gambar_halaman` VALUES (110, '1690357574842414', 57);
INSERT INTO `gambar_halaman` VALUES (111, '1690357589823256', 57);
INSERT INTO `gambar_halaman` VALUES (112, '1690357601798334', 57);
INSERT INTO `gambar_halaman` VALUES (113, '1690357613454940', 57);
INSERT INTO `gambar_halaman` VALUES (114, '1690358567689675', 60);
INSERT INTO `gambar_halaman` VALUES (115, '1690358577195356', 60);
INSERT INTO `gambar_halaman` VALUES (116, '1690358586981475', 60);
INSERT INTO `gambar_halaman` VALUES (117, '1690358595244149', 60);
INSERT INTO `gambar_halaman` VALUES (118, '1690358604510470', 60);
INSERT INTO `gambar_halaman` VALUES (119, '1690358618256185', 60);
INSERT INTO `gambar_halaman` VALUES (120, '1690358632853935', 60);
INSERT INTO `gambar_halaman` VALUES (121, '1690358653027464', 60);
INSERT INTO `gambar_halaman` VALUES (122, '1690358671950933', 60);
INSERT INTO `gambar_halaman` VALUES (123, '1690358689639136', 60);
INSERT INTO `gambar_halaman` VALUES (135, '1690360167317522', 62);
INSERT INTO `gambar_halaman` VALUES (136, '1690360323413755', 63);
INSERT INTO `gambar_halaman` VALUES (137, '1690360365927724', 64);
INSERT INTO `gambar_halaman` VALUES (138, '1690360620120443', 65);
INSERT INTO `gambar_halaman` VALUES (139, '1690360666508427', 66);
INSERT INTO `gambar_halaman` VALUES (140, '1690360717237221', 67);
INSERT INTO `gambar_halaman` VALUES (141, '1690360767113562', 68);
INSERT INTO `gambar_halaman` VALUES (142, '1690360819268117', 69);
INSERT INTO `gambar_halaman` VALUES (143, '169036085910655', 70);
INSERT INTO `gambar_halaman` VALUES (144, '1690360887092576', 71);
INSERT INTO `gambar_halaman` VALUES (145, '1690361442319976', 72);
INSERT INTO `gambar_halaman` VALUES (158, '1690363644411136', 73);
INSERT INTO `gambar_halaman` VALUES (171, '1690359019581426', 61);
INSERT INTO `gambar_halaman` VALUES (172, '1690359028983588', 61);
INSERT INTO `gambar_halaman` VALUES (173, '1690359038711673', 61);
INSERT INTO `gambar_halaman` VALUES (174, '169035904896379', 61);
INSERT INTO `gambar_halaman` VALUES (175, '1690359061500216', 61);
INSERT INTO `gambar_halaman` VALUES (176, '1690359072034286', 61);
INSERT INTO `gambar_halaman` VALUES (177, '1690359083579734', 61);
INSERT INTO `gambar_halaman` VALUES (178, '1690359093577550', 61);
INSERT INTO `gambar_halaman` VALUES (179, '1690359106685244', 61);
INSERT INTO `gambar_halaman` VALUES (180, '1690359119448439', 61);
INSERT INTO `gambar_halaman` VALUES (181, '1690359129966798', 61);
INSERT INTO `gambar_halaman` VALUES (182, '1690361586969750', 61);
INSERT INTO `gambar_halaman` VALUES (183, '1690375896371586', 61);

-- ----------------------------
-- Table structure for gambar_loker
-- ----------------------------
DROP TABLE IF EXISTS `gambar_loker`;
CREATE TABLE `gambar_loker`  (
  `id_gambar_loker` int(11) NOT NULL AUTO_INCREMENT,
  `id_gambar` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_loker` int(11) NOT NULL,
  PRIMARY KEY (`id_gambar_loker`) USING BTREE,
  INDEX `id_gambar`(`id_gambar`) USING BTREE,
  INDEX `id_loker`(`id_loker`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of gambar_loker
-- ----------------------------

-- ----------------------------
-- Table structure for halaman
-- ----------------------------
DROP TABLE IF EXISTS `halaman`;
CREATE TABLE `halaman`  (
  `id_halaman` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `isi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `create_by` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updated_at` datetime(0) NOT NULL,
  `update_by` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `uuid` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_halaman`) USING BTREE,
  INDEX `uuid_index`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 92 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of halaman
-- ----------------------------
INSERT INTO `halaman` VALUES (16, 'Gallery Video', '<p><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://www.youtube.com/embed/KsXUiuCD-qI\" width=\"100%\"></iframe></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://www.youtube.com/embed/rkbSCINfPts\" width=\"100%\"></iframe></p>', '2021-04-23 11:47:28', 'ngadmin', '2023-07-26 23:01:49', 'ngadmin', '21039db9-370d-3bca-807f-647c3eee010d');
INSERT INTO `halaman` VALUES (76, 'Struktur Organisasi', '<p><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://drive.google.com/file/d/1NBHaOyQEVCX7cIoEn9KRSjmOFC7_-HGf/preview\" width=\"100%\"></iframe></p>', '2023-10-30 12:26:47', 'administrator', '2023-10-30 12:26:47', 'administrator', '63771b92-5d3e-30fb-80d6-8522ff528b52');
INSERT INTO `halaman` VALUES (77, 'SOP Pencatatan Serikat Pekerja', '<p><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://drive.google.com/file/d/1Mo-3U8z_LDyP0NNcQHuozzFT_iVMD7TP/preview\" width=\"100%\"></iframe></p>', '2023-10-30 12:50:31', 'administrator', '2023-11-07 11:55:33', 'administrator', '67c62b4b-1d8a-3c47-8a35-e990ccaae32e');
INSERT INTO `halaman` VALUES (79, 'SOP Pengesahan Lembaga Kerja BIPARTIT', '<p><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://drive.google.com/file/d/1_WpTT8DPoY9gD0tBvolXkN_15NWifyv5/preview\" width=\"100%\"></iframe></p>', '2023-11-07 12:15:58', 'administrator', '2023-11-07 12:15:58', 'administrator', '664261a1-f64c-383e-b177-15e2eb869960');
INSERT INTO `halaman` VALUES (80, 'SOP Penyelesaian Perselisihan', '<p><iframe frameborder=\"0\" height=\"600\" scrolling=\"yes\" src=\"https://drive.google.com/file/d/1ouqG_XkVBda5MTvb8hZPoPKiL0400twF/preview\" width=\"100%\"></iframe><iframe frameborder=\"0\" height=\"600\" scrolling=\"yes\" src=\"https://drive.google.com/file/d/1ouqG_XkVBda5MTvb8hZPoPKiL0400twF/Preview\" width=\"100%\"></iframe><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://drive.google.com/file/d/1ouqG_XkVBda5MTvb8hZPoPKiL0400twF/review\" width=\"100%\"></iframe><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://drive.google.com/file/d/1ouqG_XkVBda5MTvb8hZPoPKiL0400twF/review\" width=\"100%\"></iframe></p>', '2023-11-07 15:41:05', 'administrator', '2023-11-07 16:19:26', 'administrator', 'b0199ce3-d7bc-30c4-8338-573ff4044ac2');
INSERT INTO `halaman` VALUES (82, 'SOP Prosedur Pendaftaran Kerja Bersama', '<p><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://drive.google.com/file/d/1UY7gbwHQBIGgLMJudIezV0s-4Q1r7raX/preview\" width=\"100%\"></iframe><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://drive.google.com/file/d/1UY7gbwHQBIGgLMJudIezV0s-4Q1r7raX/view?usp=sharing\" width=\"100%\"></iframe></p>', '2023-11-07 16:32:50', 'administrator', '2023-11-07 16:38:17', 'administrator', '8363ed8e-7414-3c86-8bb8-95c74463ac52');
INSERT INTO `halaman` VALUES (83, 'SOP Prosedur Pendaftaran Kerja Bersama', '<p><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://drive.google.com/file/d/1KIj6zd68fDRiXoCuQuqok2VEY1w6L6q7/preview\" width=\"100%\"></iframe></p>', '2023-11-08 08:47:35', 'administrator', '2023-11-08 08:47:35', 'administrator', '59bac62d-57a3-3971-b02c-e9078a805310');
INSERT INTO `halaman` VALUES (84, 'SOP Prosedur Pendaftaran Perjanjian Kerja Bersama', '<p><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://drive.google.com/file/d/1UpgaTXzyo_TWlg3fd9mJIRzJtg0glhyE/preview\" width=\"100%\"></iframe></p>', '2023-11-08 10:55:24', 'administrator', '2023-11-08 10:55:24', 'administrator', '9928d9fb-9afc-3de9-a567-778861338a57');
INSERT INTO `halaman` VALUES (85, 'SOP LPKS', '<p><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://drive.google.com/file/d/13Rwsa2q8cTd7bCHcpQOaUMnx85HCmza9/preview\" width=\"100%\"></iframe></p>', '2023-11-08 11:01:30', 'administrator', '2023-11-08 11:01:30', 'administrator', '8e5ca12b-d43a-3f6d-8b11-17b9b99c2c10');
INSERT INTO `halaman` VALUES (86, 'SOP LPTKS', '<p><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://drive.google.com/file/d/1rrTxHHIKLHyn0JnfehQS5OSKIm8hsia5/preview\" width=\"100%\"></iframe></p>', '2023-11-08 11:33:10', 'administrator', '2023-11-08 11:33:10', 'administrator', 'e2685b55-ed22-34a0-af61-8ab12884711a');
INSERT INTO `halaman` VALUES (87, 'SOP Pembuatan Kartu AK.I', '<p><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://drive.google.com/file/d/1DxJm9StpVupcyb04_x022va8CHU1uEOc/preview\" width=\"100%\"></iframe></p>', '2023-11-08 11:50:58', 'administrator', '2023-11-08 11:50:58', 'administrator', 'f81f9fee-c8b7-315c-b756-58688adf3286');
INSERT INTO `halaman` VALUES (88, 'Daftar Informasi Pekerja Migran, TKA Wilayah Batang Hari Th. 2023', '<p><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://drive.google.com/file/d/1zsG-_e36rOBtYD-sfu45XXSa2ZruhW5f/preview\" width=\"100%\"></iframe></p>', '2023-11-08 12:02:35', 'administrator', '2023-11-08 12:02:35', 'administrator', 'a15df99c-c5eb-378b-aa12-f031a7060d52');
INSERT INTO `halaman` VALUES (89, 'Rakor Kadis Nakerin Tahun 2023', '<p><iframe frameborder=\"0\" height=\"60\" scrolling=\"yes\" src=\"https://docs.google.com/spreadsheets/d/1OggN-MLsrJcROErWWr_LdroNUyf8pfMv/edit?usp=sharing&amp;ouid=112567490882202288631&amp;rtpof=true&amp;sd=true\" width=\"100%\"></iframe><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://docs.google.com/spreadsheets/d/1OggN-MLsrJcROErWWr_LdroNUyf8pfMv/edit?usp=sharing&amp;ouid=112567490882202288631&amp;rtpof=true&amp;sd=true\" width=\"100%\"></iframe></p>', '2023-11-08 16:16:48', 'administrator', '2023-11-08 16:19:09', 'administrator', '19118123-7c9e-3534-a5e8-4ae374de5859');
INSERT INTO `halaman` VALUES (90, 'Syarat Pembuatan Kartu AK.1', '<p><img alt=\"\" height=\"436\" src=\"https://disnakerin.batangharikab.go.id/upload/gambar/thumb-1699581080847179.jpg\" width=\"581\" /><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://drive.google.com/file/d/1iAk43YehD4h4WZRarT0jrB-Qmq5YazcB/view?usp=sharing\" width=\"100%\"></iframe></p>', '2023-11-09 12:51:10', 'administrator', '2023-11-28 12:45:59', 'administrator', '40045ac4-b698-3cb8-a27b-04f6eba38560');
INSERT INTO `halaman` VALUES (91, 'Informasi Pelayanan Disnakerin', '<p><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://drive.google.com/file/d/1PKk8CJbfXn5rvrO3BSzfyCq3uxpfycXV/preview\" width=\"100%\"></iframe><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://drive.google.com/file/d/1PKk8CJbfXn5rvrO3BSzfyCq3uxpfycXV/pview\" width=\"100%\"></iframe><iframe frameborder=\"0\" height=\"600\" scrolling=\"no\" src=\"https://drive.google.com/file/d/1PKk8CJbfXn5rvrO3BSzfyCq3uxpfycXV/view?usp=sharing\" width=\"100%\"></iframe></p>', '2023-11-28 10:09:47', 'administrator', '2023-11-28 12:40:47', 'administrator', '4a5901c0-bb30-3ca9-8b75-f511939dcf76');

-- ----------------------------
-- Table structure for loker
-- ----------------------------
DROP TABLE IF EXISTS `loker`;
CREATE TABLE `loker`  (
  `id_loker` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `isi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_posting` date NULL DEFAULT NULL,
  `created_at` datetime(0) NOT NULL,
  `create_by` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updated_at` datetime(0) NOT NULL,
  `update_by` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `uuid` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_loker`) USING BTREE,
  INDEX `uuid`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of loker
-- ----------------------------

-- ----------------------------
-- Table structure for media
-- ----------------------------
DROP TABLE IF EXISTS `media`;
CREATE TABLE `media`  (
  `id_media` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `filename` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `thumbs` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_media`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of media
-- ----------------------------
INSERT INTO `media` VALUES ('1698641283994279', 'upload/media/1698641283994310.jpeg', 'upload/media/thumb-1698641283994310.jpeg');
INSERT INTO `media` VALUES ('1700206762569363', 'upload/media/1700206762569473.jpg', 'upload/media/thumb-1700206762569473.jpg');
INSERT INTO `media` VALUES ('1700206872575263', 'upload/media/1700206872575276.png', 'upload/media/thumb-1700206872575276.png');
INSERT INTO `media` VALUES ('1700207151691482', 'upload/media/1700207151691421.png', 'upload/media/thumb-1700207151691421.png');
INSERT INTO `media` VALUES ('1700207456929118', 'upload/media/1700207456929139.jpg', 'upload/media/thumb-1700207456929139.jpg');
INSERT INTO `media` VALUES ('1700207917061296', 'upload/media/1700207917061220.jpg', 'upload/media/thumb-1700207917061220.jpg');
INSERT INTO `media` VALUES ('1701150198046630', 'upload/media/1701150198046713.jpg', 'upload/media/thumb-1701150198046713.jpg');
INSERT INTO `media` VALUES ('1701840237538379', 'upload/media/1701840237538363.png', 'upload/media/thumb-1701840237538363.png');
INSERT INTO `media` VALUES ('1701840517880778', 'upload/media/1701840517880775.png', 'upload/media/thumb-1701840517880775.png');
INSERT INTO `media` VALUES ('1701840902332910', 'upload/media/1701840902332929.jpg', 'upload/media/thumb-1701840902332929.jpg');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `url` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_menu_induk` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `icon` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `uuid` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_menu`) USING BTREE,
  INDEX `uuid`(`uuid`) USING BTREE,
  INDEX `uuid_2`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, 'Setting', '#', 0, 1, 'fa fa-cog', '88d2bbfd-44bb-3ff2-b3cc-887dba7001b9');
INSERT INTO `menu` VALUES (2, 'Menu', 'setting-menu', 1, 1, '', '63255de2-8b6e-3b6b-9ddf-1b76055ab3d6');
INSERT INTO `menu` VALUES (3, 'User', 'setting-user', 1, 3, '', 'c1ecf261-4ea2-3b40-be87-c810534a47b8');
INSERT INTO `menu` VALUES (4, 'Role', 'setting-role', 1, 2, '', 'c5ac1a69-19a8-3e9a-a66d-bc2e201da3e3');
INSERT INTO `menu` VALUES (5, 'Halaman', '#', 0, 2, 'fa fa-file', '88d2bbfd-44bb-3ff2-b3cc33-887dba7001b9');
INSERT INTO `menu` VALUES (6, 'Halaman Berita', 'halaman-berita', 5, 1, NULL, '7b60fdc0-47ea-3da1-90f3-cd45f790a8d6');
INSERT INTO `menu` VALUES (7, 'Halaman Statis', 'halaman-statis', 5, 2, NULL, '66e93394-e311-3f8a-9a39-6c52a6c35bf9');
INSERT INTO `menu` VALUES (8, 'Fitur Tambahan', '#', 0, 3, 'la la-paperclip', '88d2bbfd-44bb-3ff2-b3cc33-eeew6364');
INSERT INTO `menu` VALUES (9, 'Gallery Photo', 'gallery-photo', 8, 2, NULL, 'ea5b1181-318e-3114-839d-0b3a52dcdcdc');
INSERT INTO `menu` VALUES (10, 'Halaman Menu', 'halaman-menu', 5, 3, NULL, '519a3b81-ffeb-3cb5-ab21-d04078dba2b1');
INSERT INTO `menu` VALUES (11, 'Widget', 'widget', 8, 3, NULL, '096e0d00-807f-3f4a-867a-d66b1b574878');
INSERT INTO `menu` VALUES (14, 'Download', 'download', 8, 5, NULL, 'fb961296-b7b0-3528-9214-40dbc1705f7b');
INSERT INTO `menu` VALUES (15, 'Media', 'media', 8, 6, NULL, '6f513d68-fc37-3e02-ac55-e5f23abd244d');
INSERT INTO `menu` VALUES (16, 'Pesan & Pengaduan', '#', 0, 4, 'la la-inbox', '30bcb64f-32cc-3d5a-b57d-a40ffc355f26');
INSERT INTO `menu` VALUES (17, 'Kotak Pesan', 'kotak-pesan', 16, 1, NULL, '03bfac23-5030-37ae-940d-0d5d20a1beec');
INSERT INTO `menu` VALUES (18, 'Kotak Pengaduan', 'kotak-pengaduan', 16, 2, NULL, '625a4734-845b-3252-9741-1d70d5d3df5f');

-- ----------------------------
-- Table structure for pengaduan
-- ----------------------------
DROP TABLE IF EXISTS `pengaduan`;
CREATE TABLE `pengaduan`  (
  `id_pengaduan` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nomor_pengaduan` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_lengkap` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nomor_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `organisasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `subjek` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `isi_pengaduan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `submit` int(11) NULL DEFAULT 0,
  `dibaca` int(11) NULL DEFAULT 0,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengaduan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of pengaduan
-- ----------------------------
INSERT INTO `pengaduan` VALUES ('1663562723497515', '00001', 'Toni', '1504030406880001', 'Umum', 'toni04061010@gmail.com', '089508260826', 'Tes', 'Tes', 1, 1, '2022-09-19 11:46:07');
INSERT INTO `pengaduan` VALUES ('1698644099300765', '00002', 'Arie', '12345678', 'umum', 'mohdiqbalfazliawinata@gmail.com', '082280733436', 'Pengaduan Pelayanan', 'Pelayanan Disnakerin Sangat Memuaskan', 1, 1, '2023-10-30 12:35:30');

-- ----------------------------
-- Table structure for pesan
-- ----------------------------
DROP TABLE IF EXISTS `pesan`;
CREATE TABLE `pesan`  (
  `id_pesan` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_lengkap` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `subjek` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pesan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dibaca` int(11) NULL DEFAULT 0,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_pesan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of pesan
-- ----------------------------

-- ----------------------------
-- Table structure for role_menu
-- ----------------------------
DROP TABLE IF EXISTS `role_menu`;
CREATE TABLE `role_menu`  (
  `id_role_menu` int(11) NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `a_create` int(11) NOT NULL DEFAULT 0,
  `a_update` int(11) NOT NULL DEFAULT 0,
  `a_delete` int(11) NOT NULL DEFAULT 0,
  `uuid` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_role_menu`) USING BTREE,
  INDEX `id_role`(`id_role`) USING BTREE,
  INDEX `id_menu`(`id_menu`) USING BTREE,
  INDEX `uuid`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of role_menu
-- ----------------------------
INSERT INTO `role_menu` VALUES (1, 1, 2, 1, 1, 1, '2b55bf92-02ca-3b9d-84db-36a04d702bb5');
INSERT INTO `role_menu` VALUES (2, 1, 3, 1, 1, 1, 'ba8c81b0-29e3-3525-9be1-5f410452d491');
INSERT INTO `role_menu` VALUES (3, 1, 4, 1, 1, 1, '825b82b3-40bf-3648-9094-c9d1b1716295');
INSERT INTO `role_menu` VALUES (5, 1, 6, 1, 1, 1, '05f70bd7-b21b-3b48-9dff-3a6cc819e67d');
INSERT INTO `role_menu` VALUES (6, 1, 7, 1, 1, 1, 'ced71db7-7534-3610-b127-9c9fc968b8c6');
INSERT INTO `role_menu` VALUES (7, 13, 6, 1, 1, 1, '72a687d4-5189-3dd5-aa37-faa36d0cdbb0');
INSERT INTO `role_menu` VALUES (8, 13, 7, 1, 1, 1, 'a3cc8eb8-1ae2-30c1-ad98-cf267d864037');
INSERT INTO `role_menu` VALUES (10, 13, 9, 1, 1, 1, '6fd67fee-47f6-366d-9661-f43749fb5b1c');
INSERT INTO `role_menu` VALUES (12, 13, 11, 1, 1, 1, 'f276ada5-e3f3-38fb-bd7d-5ba683810e4a');
INSERT INTO `role_menu` VALUES (15, 13, 14, 1, 1, 1, '94b3fcac-46c2-3d0b-acc6-3afe6c01ea76');
INSERT INTO `role_menu` VALUES (16, 13, 15, 1, 1, 1, '59f978f9-5164-3cbe-bedf-3e0745958023');
INSERT INTO `role_menu` VALUES (17, 13, 17, 1, 1, 1, '6df2e8db-aedf-3b86-93ab-458cdb3f92e9');
INSERT INTO `role_menu` VALUES (18, 13, 18, 1, 1, 1, '51957508-4b84-3d13-9d8b-1625f8b326e1');
INSERT INTO `role_menu` VALUES (27, 1, 10, 1, 1, 1, 'a18276aa-9455-3108-bbca-cb40eaed4899');
INSERT INTO `role_menu` VALUES (28, 13, 10, 1, 1, 1, '1d6cf7c8-2a69-3aae-8894-0ad99f83d1d9');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `akses_global` int(11) NOT NULL DEFAULT 0,
  `uuid` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_role`) USING BTREE,
  INDEX `uuid`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Administrator', 1, '6dfc0e85-ad7c-3da7-8356-78467bdd9c63');
INSERT INTO `roles` VALUES (13, 'Operator Website', 0, '3a9edf1f-87b0-3b8d-a464-0ecb797646a5');

-- ----------------------------
-- Table structure for tree_menu
-- ----------------------------
DROP TABLE IF EXISTS `tree_menu`;
CREATE TABLE `tree_menu`  (
  `id_node` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_induk` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipe` enum('direktori','page','url','root') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_halaman` int(11) NULL DEFAULT NULL COMMENT 'Id Halaman tbl Halaman',
  `url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `urutan` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_node`) USING BTREE,
  INDEX `id_induk`(`id_induk`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tree_menu
-- ----------------------------
INSERT INTO `tree_menu` VALUES ('153675235429859', 'root', 'Beranda', 'url', NULL, 'https://disnakerin.batangharikab.go.id/', NULL);
INSERT INTO `tree_menu` VALUES ('153840335427737', 'root', 'Berita', 'url', NULL, 'https://disnakerin.batangharikab.go.id/list-berita', NULL);
INSERT INTO `tree_menu` VALUES ('153841034953201', 'root', 'Profil', 'direktori', NULL, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('153841034953256', 'root', 'Informasi', 'direktori', NULL, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('1538410349532560', '1538410349532560', 'Agenda', 'page', 17, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('153841034953304', 'root', 'Gallery', 'direktori', NULL, 'https://pdk.batangharikab.go.id/gallery', NULL);
INSERT INTO `tree_menu` VALUES ('1618539159382687', '1618539145184259', 'Gallery', 'url', NULL, 'https://pdk.batangharikab.go.id/gallery', NULL);
INSERT INTO `tree_menu` VALUES ('1619061263139797', 'root', 'Kontak', 'url', NULL, 'mailto:disnakertran@batangharikab.go.id', NULL);
INSERT INTO `tree_menu` VALUES ('1619067636189938', 'root', 'Download', 'url', NULL, 'https://disnakerin.batangharikab.go.id/download', NULL);
INSERT INTO `tree_menu` VALUES ('1619153099368519', '153841034953304', 'Gallery Photo', 'url', NULL, 'https://disnakerin.batangharikab.go.id/gallery', NULL);
INSERT INTO `tree_menu` VALUES ('1664441637390143', '153841034953201', 'Struktur Organisasi', 'page', 76, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('1690387215600592', '153841034953304', 'Gallery Video', 'page', 16, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('1698644646530252', '153841034953201', 'Bidang Pelatihan Penempatan dan Perluasan Kesempatan Kerja', 'direktori', NULL, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('1698644668500368', '153841034953201', 'Bidang Hubungan Industrial dan Lembaga Ketenagakerjaan', 'direktori', NULL, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('1698644682441751', '153841034953201', 'Bidang Perindustrian', 'direktori', NULL, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('1698645096453387', '1698644668500368', 'SOP Pencatatan Serikat Pekerja', 'page', 77, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('1699333903451715', '1698644668500368', 'SOP Pengesahan Lembaga Kerja BIPARTIT', 'page', 79, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('1699346500056448', '1698644668500368', 'SOP Penyelesaian Perselisihan', 'page', 80, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('1699349080053816', '1698644668500368', 'SOP Prosedur Pendaftaran Kerja Bersama', 'page', 82, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('1699415783457257', '1698644668500368', 'SOP Prosedur Pendaftaran Perjanjian Kerja Bersama', 'page', 84, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('1699416118523843', '1698644646530252', 'SOP LPKS', 'page', 85, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('1699418022760264', '1698644646530252', 'SOP LPTKS', 'page', 86, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('1699419121012660', '1698644646530252', 'SOP Pembuatan Kartu AK.I', 'page', 87, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('1699419800594936', '1698644646530252', 'Daftar Informasi Pekerja Migran, TKA Wilayah Batang Hari Th. 2023', 'page', 88, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('1699435051505925', '1698644646530252', 'Rakor Kadis Nakerin Tahun 2023', 'page', 89, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('1699509152490199', '153841034953256', 'Syarat Pembuatan Kartu AK.1', 'page', 90, NULL, NULL);
INSERT INTO `tree_menu` VALUES ('1701150064972927', '153841034953256', 'Informasi Pelayanan Disnakerin', 'page', 91, NULL, NULL);

-- ----------------------------
-- Table structure for user_role
-- ----------------------------
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role`  (
  `id_user_role` int(11) NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `uuid` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_user_role`) USING BTREE,
  INDEX `uuid`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of user_role
-- ----------------------------
INSERT INTO `user_role` VALUES (1, 1, 1, 'c235d41e-2650-301c-aa7f-5f1094c6bb1c');
INSERT INTO `user_role` VALUES (22, 13, 1, '365aef9b-0937-3720-8cc6-21f89fe44be1');
INSERT INTO `user_role` VALUES (23, 13, 2, '04ee509f-e438-3b2d-bdbb-68eb1049235b');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_pengguna` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telp` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `remember_token` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `uuid` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `uuid`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'ngadmin', '$2y$10$8Jw/thdqp.Yggqi2vJj9P.bnbvPDnleNqVKuCqhdOo/ZOkcW4/8mi', 'Administrator Sistem', 'adminsistem@batangharikab.go.id', '081231241256r', 'rrHmpZQgRjNncsInCrTkJgh4KAsmQqlSmBnW9sMGbxXGbfOSGWotKOk2Pe9a', '2018-03-06 09:00:00', '0000-00-00 00:00:00', '568042ed-ec8a-3acb-8c56-5a4d87054cb6');
INSERT INTO `users` VALUES (2, 'administrator', '$2y$10$2bVsvyGqzC3EvuK7NoJRP.SxcuqKTGwP3rfNbNCPLZhIjYBUTkeoK', 'Admin Disnakerin', 'adminwebsite@gmail.com', '0', 'M37Ko9y7iIGi8OaNOeNSUwI3hvmkNAzRTSrqokHQFR30SFZnar47ioHmew5t', '2019-01-25 16:01:28', NULL, '5bec664c-43e0-33ed-989e-e5e0b3c9f81d');

-- ----------------------------
-- Table structure for widget
-- ----------------------------
DROP TABLE IF EXISTS `widget`;
CREATE TABLE `widget`  (
  `id_widget` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `code` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `nama_widget` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_widget`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of widget
-- ----------------------------
INSERT INTO `widget` VALUES ('87c86e0d-d644-3f45-9ac0-26c1f264912d', '<div class=\"owl-carousel\" id=\"owltop\" owl-theme owl-loaded>\r\n    <div class=\"imgheader\" style=\"background-image: url(https://diskominfo.batangharikab.go.id/upload/media/1648525262897742.png);\">\r\n  </div> \r\n  \r\n</div>\r\n<script>\r\n  //ukuran gambar header\r\n  $(function(){\r\n  	var owltop = $(\'#owltop\');\r\n    owltop.owlCarousel({\r\n    loop:true,\r\n  	lazyLoad:true,\r\n    margin:20,\r\n  	autoHeight:true,\r\n    autoplay:true,\r\n    autoplayTimeout:5000,\r\n  	responsiveClass:true,\r\n  	responsive:{\r\n        		0:{\r\n            		items:1,\r\n            		nav:false\r\n        		},\r\n        		600:{\r\n            		items:1,\r\n            		nav:false\r\n        		},\r\n        		1000:{\r\n            	items:1,\r\n           	 		nav:false,\r\n            		loop:false\r\n        		}\r\n    		}\r\n      	});\r\n  	});\r\n   $(\".imgheader\").height(0.275*$(\".container\").width())\r\n</script>\r\n<style>\r\n	.imgheader{\r\n  	background-color: #cccccc;\r\n  				height: 300px;\r\n  				background-position: center;\r\n  				background-repeat: no-repeat;\r\n  				background-size: cover;\r\n  				position: relative;\r\n  }\r\n</style>', 'Top Widget');
INSERT INTO `widget` VALUES ('87c86e0d-d644-3f45-9ac0-26c1f264996e', '<div class=\"heading heading-primary heading-border heading-bottom-border\">\r\n  <h4 class=\"heading-default\">Website <strong>Terkait</strong></h4>\r\n</div>\r\n<div class=\"owl-carousel\" id=\"owl1\" owl-theme owl-loaded>\r\n       <div>\r\n    	<a href=\"https://kemnaker.go.id//\" target=\"_blank\">\r\n    		<img src=\"https://disnakerin.batangharikab.go.id/upload/media/1701840237538363.png\" class=\"img img-thumbnail img-responsive\">\r\n  		</a>\r\n	</div>\r\n     <div>\r\n    	<a href=\"https://kemenperin.go.id/\" target=\"_blank\">\r\n    		<img src=\"https://disnakerin.batangharikab.go.id/upload/media/1701840517880775.png\" class=\"img img-thumbnail img-responsive\">\r\n  		</a>\r\n	</div>\r\n      <div>\r\n    	<a href=\"https://batangharikab.go.id/bat/\" target=\"_blank\">\r\n    		<img src=\"https://disnakerin.batangharikab.go.id/upload/media/1701840902332929.jpg\" class=\"img img-thumbnail img-responsive\">\r\n  		</a>\r\n	</div>\r\n  	<div>\r\n    	<a href=\"http://lpse.batangharikab.go.id/\" target=\"_blank\">\r\n    		<img src=\"https://diskominfo.batangharikab.go.id/upload/media/1552296575269161.png\" class=\"img img-thumbnail img-responsive\">\r\n  		</a>\r\n  	</div>\r\n  	<div>\r\n    	<a href=\"https://sidia.batangharikab.go.id/\" target=\"_blank\">\r\n    		<img src=\"https://diskominfo.batangharikab.go.id/upload/media/1558542799507591.jpg\" class=\"img img-thumbnail img-responsive\">\r\n  		</a>\r\n  	</div>\r\n  	<div>\r\n    	<a href=\"https://www.kominfo.go.id/\" target=\"_blank\">\r\n    		<img src=\"https://diskominfo.batangharikab.go.id/upload/media/1552296282981677.png\" class=\"img img-thumbnail img-responsive\">\r\n  		</a>\r\n  	</div>\r\n</div>\r\n<script> \r\n  \"https://diskominfo.batangharikab.go.id/upload/media/1552296282981677.png\" class=\"img img-thumbnail img-responsive\"> https://puskesmasbulian.batangharikab.go.id/upload/gambar/thumb-1664374232444416.jpg\r\n   \r\n  $(function(){\r\n  	var owl1 = $(\'#owl1\');\r\n    owl1.owlCarousel({\r\n    loop:true,\r\n    margin:20,\r\n    autoplay:true,\r\n    autoplayTimeout:5000,\r\n  	responsiveClass:true,\r\n  	responsive:{\r\n        		0:{\r\n            		items:1,\r\n            		nav:false\r\n        		},\r\n        		600:{\r\n            		items:3,\r\n            		nav:false\r\n        		},\r\n        		1000:{\r\n            	items:5,\r\n           	 		nav:false,\r\n            		loop:false\r\n        		}\r\n    		}\r\n      	});\r\n  	});\r\n \r\n</script>', 'Bottom Widget');
INSERT INTO `widget` VALUES ('93563c94-a67a-3da6-bc8e-f4d0acca781f', '<center>\r\n  <b> Kepala Dinas Tenaga Kerja dan Perindustrian </b>\r\n    <img src=\"https://disnakerin.batangharikab.go.id/upload/media/1698641283994310.jpeg\" class=\"img img-rounded\" width=\"100%\">\r\n    <b>M. RIDWAN NOOR, SE.ME</b> <br>\r\n    \r\n     </center>\r\n<hr>\r\n\r\n<div class=\"heading heading-primary heading-border heading-bottom-border\">\r\n<h4 class=\'heading-default\'>\r\n  <a href=\"#\">Informasi <strong>Layanan</strong></a>\r\n </h4>\r\n<br>\r\n<ul class=\"list list-icons list-icons-sm\">\r\n  		<li>\r\n          <i class=\"fa fa-ticket\" aria-hidden=\"true\"></i>\r\n          <a href=\"https://disnakerin.batangharikab.go.id/kotak-pengaduan\">Kotak Pengaduan</a>\r\n  		</li>\r\n  		<li>\r\n          <i class=\"fa fa-facebook-square\" aria-hidden=\"true\"></i>\r\n          <a href=\"https://www.facebook.com/profile.php?id=61552860326236&locale=id_ID\">FaceBook Disnakerin Kab. Batang Hari</a>\r\n  		</li>\r\n    		<li>\r\n          <i class=\"fa fa-instagram\" aria-hidden=\"true\"></i>\r\n          <a href=\"#\">Instagram Disnakerin Kab. Batang Hari</a>\r\n  		</li>\r\n		<p></p>\r\n</ul>\r\n</div>\r\n<div class=\"heading heading-primary heading-border heading-bottom-border\">\r\n<h3 class=\'heading-default\'>\r\n  	<a href=\"#\">Layanan <strong>Aplikasi</strong></a>\r\n</h3>\r\n  <br>\r\n	<ul class=\"list list-icons list-icons-sm\">\r\n 			<a href=\"https://siinas.kemenperin.go.id//\">\r\n            	<img src=\"https://disnakerin.batangharikab.go.id/upload/media/1700206762569473.jpg\" style=\"width:80% !important;\">\r\n          	</a><br><br><br>\r\n     		<a href=\"https://siapkerja.kemnaker.go.id/app/home\">\r\n            	<img src=\"https://disnakerin.batangharikab.go.id/upload/media/1700206872575276.png\" style=\"width:80% !important;\">\r\n          	</a><br><br><br>\r\n     		<a href=\"https://tka-online.kemnaker.go.id/\">\r\n            	<img src=\"https://disnakerin.batangharikab.go.id/upload/media/1700207151691421.png\" style=\"width:80% !important;\">\r\n          	</a>\r\n  </ul>\r\n</div>\r\n<div id=\"fb-root\"></div>\r\n<script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v18.0\" nonce=\"Iz2cFQcT\"></script>', 'Side Widget');

SET FOREIGN_KEY_CHECKS = 1;
