-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 10, 2025 at 04:45 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwl_pos`
--

--
-- Dumping data for table `m_barang`
--

INSERT INTO `m_barang` (`barang_id`, `kategori_id`, `barang_kode`, `barang_nama`, `harga_beli`, `harga_jual`, `created_at`, `updated_at`) VALUES
(1, 1, 'BRG001', 'Laptop', '5000000', '7000000', '2025-03-09 10:32:54', NULL),
(2, 1, 'BRG002', 'Smartphone', '3000000', '4500000', '2025-03-09 10:32:54', NULL),
(3, 2, 'BRG006', 'Kemeja', '100000', '150000', '2025-03-09 10:32:54', NULL),
(4, 2, 'BRG007', 'Celana Jeans', '200000', '300000', '2025-03-09 10:32:54', NULL),
(5, 3, 'BRG011', 'Pensil', '2000', '5000', '2025-03-09 10:32:54', NULL),
(6, 3, 'BRG012', 'Buku Tulis', '5000', '10000', '2025-03-09 10:32:54', NULL);

--
-- Dumping data for table `m_kategori`
--

INSERT INTO `m_kategori` (`kategori_id`, `kategori_kode`, `kategori_nama`, `created_at`, `updated_at`) VALUES
(1, 'KTG001', 'Elektronik', '2025-03-09 10:32:54', NULL),
(2, 'KTG002', 'Pakaian', '2025-03-09 10:32:54', NULL),
(3, 'KTG003', 'Makanan', '2025-03-09 10:32:54', NULL),
(4, 'KTG004', 'Alat Tulis', '2025-03-09 10:32:54', NULL),
(5, 'KTG005', 'Perabotan', '2025-03-09 10:32:54', NULL);

--
-- Dumping data for table `m_level`
--

INSERT INTO `m_level` (`level_id`, `level_kode`, `level_nama`, `created_at`, `updated_at`) VALUES
(1, 'ADM', 'Administrator', '2025-03-09 10:32:53', NULL),
(2, 'MNG', 'Manager', '2025-03-09 10:32:53', NULL),
(3, 'STF', 'Staff/Kasir', '2025-03-09 10:32:53', NULL),
(4, 'CUS2', 'Customer', '2025-03-09 10:33:44', '2025-03-09 10:33:50');

--
-- Dumping data for table `m_supplier`
--

INSERT INTO `m_supplier` (`supplier_id`, `supplier_kode`, `supplier_nama`, `supplier_alamat`, `created_at`, `updated_at`) VALUES
(1, 'SUP001', 'PT. Sumber Jaya', 'Jl. Merdeka No.1', '2025-03-09 10:32:54', NULL),
(2, 'SUP002', 'CV. Makmur Sentosa', 'Jl. Sudirman No.45', '2025-03-09 10:32:54', NULL),
(3, 'SUP003', 'UD. Sukses Abadi', 'Jl. Diponegoro No.77', '2025-03-09 10:32:54', NULL);

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`user_id`, `level_id`, `username`, `nama`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'Administrator', '$2y$12$8bIWy6F4i6b1T3c9Ww3I4uaZPQP4Q405xZC/ns0BXn9hwduskwWwC', '2025-03-09 10:32:53', NULL),
(2, 2, 'manager', 'Manager', '$2y$12$v6aTF8wtrBH82N95.CNtbes4jbETPma7CAGbjGsY0h8jQm5YzztEq', '2025-03-09 10:32:53', NULL),
(3, 3, 'staff', 'Staff/Kasir', '$2y$12$0i7kRrj3vOHpVEu3LcK/BeEjJirVukCyW80WyJ58TmpolgNtWOhCy', '2025-03-09 10:32:54', NULL),
(4, 4, 'customer-1', 'Pelanggan', '$2y$12$YpYPryw7EUlSYks19TpvXegddrEsP7OxFVHK7Y0iAUIocvFcVotly', NULL, NULL),
(5, 2, 'manager_dua', 'Manager 2', '$2y$12$973AzU1n7IUEZa7dZCzX2egfCMwGyVZ8C5QdtnVFgy4wSspRlYTwO', '2025-03-09 11:57:39', '2025-03-09 11:57:39'),
(6, 2, 'manager_tiga', NULL, '$2y$12$nOhnx37qTxrOXohTPysgB.vY5cCM1jd.IHZwHtXk9fY/JKyDR97IC', '2025-03-09 12:10:27', '2025-03-09 12:10:27'),
(8, 2, 'manager33', 'Manager tiga tiga', '$2y$12$LVkxmnFMVN/ZKDtUsrZwVOmyBTbYyNYchMkTU.xFRh217fyIPHcNq', '2025-03-09 14:49:43', '2025-03-09 15:17:34');

--
-- Dumping data for table `t_penjualan`
--

INSERT INTO `t_penjualan` (`penjualan_id`, `user_id`, `pembeli`, `penjualan_kode`, `penjualan_tanggal`, `created_at`, `updated_at`) VALUES
(1, 1, 'Andi', 'TRX001', '2025-03-09 17:32:54', '2025-03-09 10:32:54', NULL),
(2, 2, 'Budi', 'TRX002', '2025-03-09 17:32:54', '2025-03-09 10:32:54', NULL),
(3, 3, 'Citra', 'TRX003', '2025-03-09 17:32:54', '2025-03-09 10:32:54', NULL);

--
-- Dumping data for table `t_penjualan_detail`
--

INSERT INTO `t_penjualan_detail` (`detail_id`, `penjualan_id`, `barang_id`, `harga`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 7000000, 1, '2025-03-09 10:32:54', NULL),
(2, 1, 2, 4500000, 1, '2025-03-09 10:32:54', NULL),
(3, 2, 6, 150000, 2, '2025-03-09 10:32:54', NULL),
(4, 3, 3, 300000, 1, '2025-03-09 10:32:54', NULL);

--
-- Dumping data for table `t_stok`
--

INSERT INTO `t_stok` (`stok_id`, `supplier_id`, `barang_id`, `user_id`, `stok_tanggal`, `stok_jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2025-03-09 17:32:54', 50, '2025-03-09 10:32:54', NULL),
(2, 1, 2, 1, '2025-03-09 17:32:54', 40, '2025-03-09 10:32:54', NULL),
(3, 2, 6, 2, '2025-03-09 17:32:54', 80, '2025-03-09 10:32:54', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
