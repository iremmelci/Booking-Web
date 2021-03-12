-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3308
-- Üretim Zamanı: 09 Oca 2020, 23:28:55
-- Sunucu sürümü: 8.0.18
-- PHP Sürümü: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `booking`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

DROP TABLE IF EXISTS `kullanicilar`;
CREATE TABLE IF NOT EXISTS `kullanicilar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `username`, `password`, `name`) VALUES
(1, 'hasan', '1234', 'Hasan Hüseyin'),
(2, 'mehmet', '1234', 'Mehmet Ersöz');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `satin_alinan_urunler`
--

DROP TABLE IF EXISTS `satin_alinan_urunler`;
CREATE TABLE IF NOT EXISTS `satin_alinan_urunler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `productPrice` float NOT NULL,
  `startDate` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `endDate` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `totalPrice` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `satin_alinan_urunler`
--

INSERT INTO `satin_alinan_urunler` (`id`, `userId`, `productId`, `productName`, `productPrice`, `startDate`, `endDate`, `totalPrice`) VALUES
(5, 2, 6, 'Renault Symbol', 130, '2020-01-10', '2020-01-11', 130),
(4, 2, 4, 'SITbus havaalanı servisi', 35, '2020-01-10', '2020-01-11', 35),
(6, 2, 5, 'Maxi Combo - Rehberli Kolezyum ve Vatikan', 618, '2020-01-10', '2020-01-12', 1236),
(7, 2, 7, 'Volkswagen Polo', 170, '2020-01-10', '2020-01-10', 170);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

DROP TABLE IF EXISTS `urunler`;
CREATE TABLE IF NOT EXISTS `urunler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `price` float NOT NULL,
  `type` int(11) NOT NULL COMMENT '0 = konaklama, 1 = tur, 2 = araba kiralama',
  `description` varchar(9999) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `name`, `img`, `price`, `type`, `description`) VALUES
(1, 'Quba Palace Hotel', 'public/img/qubaPalace.jpg', 650, 0, 'Tablo güzelliğindeki bir bölgede yer alan Quba Palace Hotel\'de spa ve sağlıklı yaşam merkezi, kapalı ve açık havuzlar, sauna, hamam ve fitness merkezi bulunmaktadır.'),
(2, 'SHANI Hotel & Villas', 'public/img/ShaniHotel.jpg', 350, 0, 'Mardakan\'da yer alan SHANI Hotel & Villas barı, ortak salonu ve bahçesiyle hizmet vermektedir. Tesis genelinde WiFi erişimi ücretsizdir.'),
(3, 'Midtown Hotel Baku', 'public/img/MidtownHotel.jpg', 400, 0, 'Bakü\'de Fevvareler Meydanı\'na 1,6 km mesafede yer alan Midtown Hotel Baku restoran, ücretsiz özel otopark, bar ve teras ile konaklama imkanı sunmaktadır.'),
(4, 'SITbus havaalanı servisi', 'public/img/SITbus.jpg', 35, 1, 'Bu servis otobüsleri Roma Termini İstasyonu ile şehrin iki havaalanı (Ciampino ve Fiumicino) arasında ulaşım olanağı sağlar. Ciampino rotası direkttir; Fiumicino rotası ise Vatikan yakınındaki yol üzerinde ve Via Aurelia\'da durmaktadır.'),
(5, 'Maxi Combo - Rehberli Kolezyum ve Vatikan\r\n', 'public/img/vatikan.jpg', 618, 1, 'Bu dolu dolu turla Vatikan ve Kolezyum dahil Roma\'nın önemli dini ve tarihi mekanlarını görebilirsiniz. İlk olarak antik Roma yaşamına göz atmak ve hayatı için savaşmak üzere büyük arenaya giriş yapan bir gladyatör gibi hissetmek için Kolezyum, Roma Forumu ve Palatino Tepesi\'ni keşfe çıkacaksınız. Sonrasında Vatikan Müzeleri\'nin galerilerinde dolaşıp sanatsal hazineleri tanıyacak, Michelangelo\'nun Sistina Şapeli\'ni göreceksiniz.'),
(6, 'Renault Symbol', 'public/img/renaultSymbol.jpg', 130, 2, 'Esenboğa havalimanı içerisinde teslim.'),
(7, 'Volkswagen Polo', 'public/img/volkswagenPolo.jpg', 170, 2, 'Esenboğa havalimanı içerisinde teslim.'),
(8, 'Dacia Duster', 'public/img/daciaDuster.jpg', 185, 2, 'Esenboğa havalimanı içerisinde teslim.'),
(9, 'Hyundai i20', 'public/img/hyundaiI20.jpg', 220, 2, 'Esenboğa havalimanı içerisinde teslim.'),
(10, 'Fiat Doblo', 'public/img/fiatDoblo.jpg', 250, 2, 'Esenboğa havalimanı içerisinde teslim.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
