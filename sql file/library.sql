-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2024 at 11:42 PM
-- Server version: 9.0.1
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int UNSIGNED NOT NULL,
  `FullName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`) VALUES
(1, 'Лаптев Алексей', 'kumarpandule@gmail.com', 'admin', 'e6e061838856bf47e1de730719fb2609');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int UNSIGNED NOT NULL,
  `AuthorName` varchar(159) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `AuthorName`, `creationDate`) VALUES
(1, 'Роман Кузнецов', '2024-11-23 18:10:10'),
(2, 'Владимир Михайлов', '2024-11-23 18:10:10'),
(3, 'Анна Михайлова', '2024-11-23 18:10:10'),
(4, 'Елена Иванова', '2024-11-23 18:10:10'),
(5, 'Константин Иванов', '2024-11-23 18:10:10'),
(6, 'Дмитрий Соколов', '2024-11-23 18:10:10'),
(7, 'Сергей Соколов', '2024-11-23 18:10:10'),
(8, 'Дмитрий Попов', '2024-11-23 18:10:10'),
(9, 'Олег Петров', '2024-11-23 18:10:10'),
(10, 'Виктория Иванова', '2024-11-23 18:10:10'),
(11, 'Виктория Петрова', '2024-11-23 18:10:10'),
(12, 'Олег Соколов', '2024-11-23 18:10:10'),
(13, 'Михаил Кузнецов', '2024-11-23 18:10:10'),
(14, 'Александр Попов', '2024-11-23 18:10:10'),
(15, 'Роман Кузнецов', '2024-11-23 18:10:10'),
(16, 'Сергей Фёдоров', '2024-11-23 18:10:10'),
(17, 'Анна Михайлова', '2024-11-23 18:10:10'),
(18, 'Сергей Фёдоров', '2024-11-23 18:10:10'),
(19, 'Сергей Петров', '2024-11-23 18:10:10'),
(20, 'Олег Петров', '2024-11-23 18:10:10'),
(21, 'Мария Кузнецова', '2024-11-23 18:10:10'),
(22, 'Дарина Иванова', '2024-11-23 18:10:10'),
(23, 'Елена Смирнова', '2024-11-23 18:10:10'),
(24, 'Дмитрий Соколов', '2024-11-23 18:10:10'),
(25, 'Олег Кузнецов', '2024-11-23 18:10:10'),
(26, 'Сергей Васильев', '2024-11-23 18:10:10'),
(27, 'Дарина Соколова', '2024-11-23 18:10:10'),
(28, 'Мария Фёдорова', '2024-11-23 18:10:10'),
(29, 'Ирина Иванова', '2024-11-23 18:10:10'),
(30, 'Владимир Михайлов', '2024-11-23 18:10:10'),
(31, 'Елена Иванова', '2024-11-23 18:10:10'),
(32, 'Ольга Петрова', '2024-11-23 18:10:10'),
(33, 'Иван Соколов', '2024-11-23 18:10:10'),
(34, 'Олег Иванов', '2024-11-23 18:10:10'),
(35, 'Сергей Михайлов', '2024-11-23 18:10:10'),
(36, 'Александр Фёдоров', '2024-11-23 18:10:10'),
(37, 'Сергей Фёдоров', '2024-11-23 18:10:10'),
(38, 'Роман Кузнецов', '2024-11-23 18:10:10'),
(39, 'Дмитрий Фёдоров', '2024-11-23 18:10:10'),
(40, 'Константин Иванов', '2024-11-23 18:10:10'),
(41, 'Александр Соколов', '2024-11-23 18:10:10'),
(42, 'Владимир Попов', '2024-11-23 18:10:10'),
(43, 'Анна Кузнецова', '2024-11-23 18:10:10'),
(44, 'Сергей Соколов', '2024-11-23 18:10:10'),
(45, 'Анна Васильева', '2024-11-23 18:10:10'),
(46, 'Владимир Смирнов', '2024-11-23 18:10:10'),
(47, 'Роман Петров', '2024-11-23 18:10:10'),
(48, 'Дарина Фёдорова', '2024-11-23 18:10:10'),
(49, 'Елена Соколова', '2024-11-23 18:10:10'),
(50, 'Александр Соколов', '2024-11-23 18:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int UNSIGNED NOT NULL,
  `CategoryName` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Status` int DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `CategoryName`, `Status`, `CreationDate`) VALUES
(13, 'Проектная документация', 1, '2024-11-23 18:16:55'),
(14, 'Инструкции и регламенты', 1, '2024-11-23 18:17:02'),
(15, 'Отчеты о технических испытаниях', 1, '2024-11-23 18:17:08'),
(16, 'Документация по охране труда и технике безопасности', 1, '2024-11-23 18:17:20'),
(17, 'Документы по ремонту и обслуживанию оборудования', 1, '2024-11-23 18:17:29'),
(18, 'Технические паспорта и сертификаты', 1, '2024-11-23 18:17:38'),
(19, 'Сметы и расчеты', 1, '2024-11-23 18:17:47'),
(20, 'Планы и схемы коммуникаций', 1, '2024-11-23 18:17:57'),
(21, 'Пожарная безопасность', 1, '2024-11-23 18:18:04'),
(22, 'Документация по сертификации и лицензированию', 1, '2024-11-23 18:18:11'),
(23, 'Финансовая документация', 1, '2024-11-23 18:19:01'),
(24, 'Документы по кадрам (HR)', 1, '2024-11-23 18:19:08'),
(25, 'Маркетинговая документация', 1, '2024-11-23 18:19:17'),
(26, 'Юридическая документация', 1, '2024-11-23 18:19:24'),
(27, 'Документы по закупкам и поставкам', 1, '2024-11-23 18:19:34'),
(28, 'Протоколы собраний и совещаний', 1, '2024-11-23 18:19:40'),
(29, 'Документация по информационной безопасности', 1, '2024-11-23 18:19:49'),
(30, 'Экологическая документация', 1, '2024-11-23 18:19:56'),
(31, 'Транспортная документация', 1, '2024-11-23 18:20:04'),
(32, 'Качество и контроль', 1, '2024-11-23 18:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `ID` int UNSIGNED NOT NULL,
  `depName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`ID`, `depName`) VALUES
(1, 'Юридический отдел'),
(2, 'Бухгалтерия'),
(3, 'Финансовый отдел'),
(4, 'Отдел кадров'),
(5, 'Отдел продаж'),
(6, 'Отдел снабжения'),
(7, 'IT-отдел'),
(8, 'Архив');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `ID` int UNSIGNED NOT NULL,
  `DocumentName` varchar(200) NOT NULL,
  `CreationDate` date NOT NULL,
  `ArchiveDate` date NOT NULL,
  `LocationID` int UNSIGNED NOT NULL,
  `Status` enum('В наличии','Выдан','Списан') NOT NULL,
  `Description` text,
  `rOpId` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`ID`, `DocumentName`, `CreationDate`, `ArchiveDate`, `LocationID`, `Status`, `Description`, `rOpId`) VALUES
(15, 'Регламент по обработке персональных данных сотрудников', '2022-09-15', '2024-11-23', 4304, 'В наличии', '', 27),
(16, 'Отчет о результатах испытаний нового оборудования', '2024-04-11', '2024-11-23', 4303, 'В наличии', '', 25),
(17, 'Инструкция по безопасной эксплуатации электрооборудования', '2024-11-13', '2024-11-23', 4305, 'В наличии', '', NULL),
(18, 'Документ по ремонту и техническому обслуживанию станков', '2023-01-03', '2024-11-23', 4306, 'В наличии', '', NULL),
(19, 'Технический паспорт на системы вентиляции', '2019-10-17', '2024-11-23', 4307, 'В наличии', '', NULL),
(20, 'Смета на строительство офисных помещений', '2024-11-06', '2024-11-23', 4308, 'В наличии', '', NULL),
(21, 'Схема расположения кабельных линий в офисе', '2018-10-10', '2024-11-23', 4309, 'В наличии', '', NULL),
(22, 'Пожарный план эвакуации для офисного здания', '2024-02-15', '2024-11-23', 4310, 'В наличии', '', NULL),
(23, 'Документы для сертификации оборудования на соответствие ISO', '2022-09-22', '2024-11-23', 4311, 'В наличии', '', NULL),
(24, 'Годовой финансовый отчет компании', '2024-02-14', '2024-11-23', 4312, 'В наличии', '', NULL),
(25, 'Трудовой договор с новым сотрудником отдела продаж', '2024-11-22', '2024-11-23', 4313, 'В наличии', '', NULL),
(26, 'Маркетинговая стратегия по продвижению нового продукта', '2024-08-08', '2024-11-23', 4314, 'В наличии', '', NULL),
(27, 'Договор о предоставлении юридических услуг для компании', '2024-10-29', '2024-11-23', 4315, 'В наличии', '', NULL),
(28, 'Контракт на поставку материалов для производства', '2024-09-11', '2024-11-23', 4316, 'В наличии', '', NULL),
(29, 'Протокол совещания по вопросам качества продукции', '2024-05-15', '2024-11-23', 4317, 'В наличии', '', NULL),
(30, 'Документация по внедрению системы информационной безопасности', '2024-10-28', '2024-11-23', 4318, 'В наличии', '', NULL),
(31, 'Документ по экологической оценке проекта', '2023-09-20', '2024-11-23', 4319, 'В наличии', '', NULL),
(32, 'Технические данные для транспортировки оборудования', '2024-11-08', '2024-11-23', 4320, 'В наличии', '', NULL),
(33, 'Документ по контролю качества производства продукции', '2024-11-13', '2024-11-23', 4321, 'В наличии', '', NULL),
(34, 'Проектная документация на строительство нового здания', '2024-11-12', '2024-11-23', 4302, 'В наличии', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `document_authors`
--

CREATE TABLE `document_authors` (
  `DocumentID` int UNSIGNED NOT NULL,
  `AuthorID` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `document_authors`
--

INSERT INTO `document_authors` (`DocumentID`, `AuthorID`) VALUES
(23, 2),
(33, 3),
(34, 3),
(27, 4),
(33, 4),
(34, 4),
(20, 9),
(32, 9),
(23, 12),
(32, 12),
(29, 13),
(16, 14),
(17, 14),
(29, 14),
(31, 15),
(19, 16),
(24, 16),
(18, 17),
(28, 17),
(31, 18),
(21, 20),
(21, 21),
(22, 22),
(25, 24),
(26, 28),
(15, 29),
(30, 34),
(30, 49);

-- --------------------------------------------------------

--
-- Table structure for table `document_categories`
--

CREATE TABLE `document_categories` (
  `DocumentID` int UNSIGNED NOT NULL,
  `CategoryID` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `document_categories`
--

INSERT INTO `document_categories` (`DocumentID`, `CategoryID`) VALUES
(34, 13),
(15, 14),
(16, 15),
(17, 16),
(18, 17),
(19, 18),
(20, 19),
(21, 20),
(22, 21),
(23, 22),
(24, 23),
(25, 24),
(26, 25),
(27, 26),
(28, 27),
(29, 28),
(30, 29),
(31, 30),
(32, 31),
(33, 32);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `ID` int UNSIGNED NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `Position` varchar(100) NOT NULL,
  `DepID` int UNSIGNED NOT NULL,
  `RegDate` date NOT NULL,
  `password` varchar(120) NOT NULL,
  `Status` enum('Активный','Деактивирован') NOT NULL DEFAULT 'Активный'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`ID`, `FullName`, `email`, `phone`, `Position`, `DepID`, `RegDate`, `password`, `Status`) VALUES
(33, 'Анастасия Кузнецова', 'roman.kuznetsov@example.com', '+79123456789', 'Юрист-консультант', 1, '2024-11-23', 'defaultpassword', 'Активный'),
(34, 'Владимир Михайлов', 'vladimir.mikhaylov@example.com', '+79122345678', 'Специалист по корпоративному праву', 1, '2024-11-23', 'defaultpassword', 'Активный'),
(35, 'Ольга Михайлова', 'anna.mikhaylova@example.com', '+79121234567', 'Бухгалтер', 2, '2024-11-23', 'defaultpassword', 'Активный'),
(36, 'Елена Иванова', 'elena.ivanova@example.com', '+79122345679', 'Главный бухгалтер', 2, '2024-11-23', 'defaultpassword', 'Активный'),
(37, 'Константин Иванов', 'konstantin.ivanov@example.com', '+79123456780', 'Финансовый аналитик', 3, '2024-11-23', 'defaultpassword', 'Активный'),
(38, 'Дмитрий Соколов', 'dmitry.sokolov@example.com', '+79124567890', 'HR-менеджер', 4, '2024-11-23', 'defaultpassword', 'Активный'),
(39, 'Сергей Соколов', 'sergey.sokolov@example.com', '+79125678901', 'Рекрутер', 4, '2024-11-23', 'defaultpassword', 'Активный'),
(40, 'Дмитрий Попов', 'dmitry.popov@example.com', '+79126789012', 'Менеджер по продажам', 5, '2024-11-23', 'defaultpassword', 'Активный'),
(41, 'Алексей Соколов', 'oleg.petrov@example.com', '+79127890123', 'Специалист по продажам', 5, '2024-11-23', 'defaultpassword', 'Активный'),
(42, 'Виктория Иванова', 'victoria.ivanova@example.com', '+79128901234', 'Менеджер по закупкам', 6, '2024-11-23', 'defaultpassword', 'Активный'),
(43, 'Виктория Петрова', 'victoria.petrova@example.com', '+79129012345', 'Менеджер по снабжению', 6, '2024-11-23', 'defaultpassword', 'Активный'),
(44, 'Олег Соколов', 'oleg.sokolov@example.com', '+79121234567', 'Системный администратор', 7, '2024-11-23', 'defaultpassword', 'Активный'),
(45, 'Михаил Кузнецов', 'mikhail.kuznetsov@example.com', '+79122345678', 'Программист-разработчик', 7, '2024-11-23', 'defaultpassword', 'Активный'),
(46, 'Александр Попов', 'alexander.popov@example.com', '+79123456789', 'Архивариус', 8, '2024-11-23', 'defaultpassword', 'Активный'),
(47, 'Роман Кузнецов', 'roman.kuznetsov@example.com', '+79124567890', 'Археограф', 8, '2024-11-23', 'defaultpassword', 'Активный'),
(48, 'Иван Смирнов', 'sergey.fedorov@example.com', '+79125678901', 'Юрист-консультант', 1, '2024-11-23', 'defaultpassword', 'Активный'),
(49, 'Анна Михайлова', 'anna.mikhaylova@example.com', '+79126789012', 'Бухгалтер', 2, '2024-11-23', 'defaultpassword', 'Активный'),
(50, 'Сергей Фёдоров', 'sergey.fedorov@example.com', '+79127890123', 'Финансовый аналитик', 3, '2024-11-23', 'defaultpassword', 'Активный'),
(51, 'Сергей Петров', 'sergey.petrov@example.com', '+79128901234', 'HR-менеджер', 4, '2024-11-23', 'defaultpassword', 'Активный'),
(52, 'Олег Петров', 'oleg.petrov@example.com', '+79129012345', 'Менеджер по продажам', 5, '2024-11-23', 'defaultpassword', 'Активный');

-- --------------------------------------------------------

--
-- Table structure for table `operations`
--

CREATE TABLE `operations` (
  `ID` int UNSIGNED NOT NULL,
  `opType` enum('Выдача','Возврат','Списание') NOT NULL,
  `opDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `opID` int UNSIGNED DEFAULT NULL,
  `emID` int UNSIGNED DEFAULT NULL,
  `docId` int UNSIGNED DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `operations`
--

INSERT INTO `operations` (`ID`, `opType`, `opDate`, `opID`, `emID`, `docId`, `description`) VALUES
(23, 'Выдача', '2024-11-23 22:37:25', 1, 33, 15, ''),
(24, 'Возврат', '2024-11-23 22:38:45', 1, 33, 15, ''),
(25, 'Выдача', '2024-11-23 22:39:19', 1, 33, 16, ''),
(26, 'Возврат', '2024-11-23 22:39:39', 1, 33, 16, ''),
(27, 'Выдача', '2024-11-23 22:41:44', 1, 33, 15, ''),
(28, 'Возврат', '2024-11-23 22:41:54', 1, 33, 15, '');

-- --------------------------------------------------------

--
-- Table structure for table `racks`
--

CREATE TABLE `racks` (
  `ID` int UNSIGNED NOT NULL,
  `RackNumber` int UNSIGNED DEFAULT NULL,
  `deliveryDate` date NOT NULL,
  `Capacity` int UNSIGNED NOT NULL,
  `RackStatus` enum('Списан','Заполнен','В работе') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Description` varchar(1000) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `racks`
--

INSERT INTO `racks` (`ID`, `RackNumber`, `deliveryDate`, `Capacity`, `RackStatus`, `Description`) VALUES
(19, 5, '2024-10-10', 200, 'В работе', 'Чертежи'),
(25, 1, '2024-11-01', 200, 'В работе', 'Бухгалтерские документы');

-- --------------------------------------------------------

--
-- Table structure for table `shelves`
--

CREATE TABLE `shelves` (
  `ID` int UNSIGNED NOT NULL,
  `ShelfNumber` int UNSIGNED NOT NULL,
  `Capacity` int UNSIGNED NOT NULL,
  `RackID` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shelves`
--

INSERT INTO `shelves` (`ID`, `ShelfNumber`, `Capacity`, `RackID`) VALUES
(83, 1, 20, 19),
(84, 2, 20, 19),
(85, 3, 20, 19),
(86, 4, 20, 19),
(87, 5, 20, 19),
(88, 6, 20, 19),
(89, 7, 20, 19),
(90, 8, 20, 19),
(91, 9, 20, 19),
(92, 10, 20, 19),
(106, 1, 20, 25),
(107, 2, 20, 25),
(108, 3, 20, 25),
(109, 4, 20, 25),
(110, 5, 20, 25),
(111, 6, 20, 25),
(112, 7, 20, 25),
(113, 8, 20, 25),
(114, 9, 20, 25),
(115, 10, 20, 25);

-- --------------------------------------------------------

--
-- Table structure for table `storagecells`
--

CREATE TABLE `storagecells` (
  `ID` int UNSIGNED NOT NULL,
  `CellNumber` int UNSIGNED NOT NULL,
  `ShelfID` int UNSIGNED NOT NULL,
  `CellStatus` enum('Свободно','Занято') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `storagecells`
--

INSERT INTO `storagecells` (`ID`, `CellNumber`, `ShelfID`, `CellStatus`) VALUES
(4302, 1, 83, 'Занято'),
(4303, 2, 83, 'Занято'),
(4304, 3, 83, 'Занято'),
(4305, 4, 83, 'Занято'),
(4306, 5, 83, 'Занято'),
(4307, 6, 83, 'Занято'),
(4308, 7, 83, 'Занято'),
(4309, 8, 83, 'Занято'),
(4310, 9, 83, 'Занято'),
(4311, 10, 83, 'Занято'),
(4312, 11, 83, 'Занято'),
(4313, 12, 83, 'Занято'),
(4314, 13, 83, 'Занято'),
(4315, 14, 83, 'Занято'),
(4316, 15, 83, 'Занято'),
(4317, 16, 83, 'Занято'),
(4318, 17, 83, 'Занято'),
(4319, 18, 83, 'Занято'),
(4320, 19, 83, 'Занято'),
(4321, 20, 83, 'Занято'),
(4322, 1, 84, 'Свободно'),
(4323, 2, 84, 'Свободно'),
(4324, 3, 84, 'Свободно'),
(4325, 4, 84, 'Свободно'),
(4326, 5, 84, 'Свободно'),
(4327, 6, 84, 'Свободно'),
(4328, 7, 84, 'Свободно'),
(4329, 8, 84, 'Свободно'),
(4330, 9, 84, 'Свободно'),
(4331, 10, 84, 'Свободно'),
(4332, 11, 84, 'Свободно'),
(4333, 12, 84, 'Свободно'),
(4334, 13, 84, 'Свободно'),
(4335, 14, 84, 'Свободно'),
(4336, 15, 84, 'Свободно'),
(4337, 16, 84, 'Свободно'),
(4338, 17, 84, 'Свободно'),
(4339, 18, 84, 'Свободно'),
(4340, 19, 84, 'Свободно'),
(4341, 20, 84, 'Свободно'),
(4342, 1, 85, 'Свободно'),
(4343, 2, 85, 'Свободно'),
(4344, 3, 85, 'Свободно'),
(4345, 4, 85, 'Свободно'),
(4346, 5, 85, 'Свободно'),
(4347, 6, 85, 'Свободно'),
(4348, 7, 85, 'Свободно'),
(4349, 8, 85, 'Свободно'),
(4350, 9, 85, 'Свободно'),
(4351, 10, 85, 'Свободно'),
(4352, 11, 85, 'Свободно'),
(4353, 12, 85, 'Свободно'),
(4354, 13, 85, 'Свободно'),
(4355, 14, 85, 'Свободно'),
(4356, 15, 85, 'Свободно'),
(4357, 16, 85, 'Свободно'),
(4358, 17, 85, 'Свободно'),
(4359, 18, 85, 'Свободно'),
(4360, 19, 85, 'Свободно'),
(4361, 20, 85, 'Свободно'),
(4362, 1, 86, 'Свободно'),
(4363, 2, 86, 'Свободно'),
(4364, 3, 86, 'Свободно'),
(4365, 4, 86, 'Свободно'),
(4366, 5, 86, 'Свободно'),
(4367, 6, 86, 'Свободно'),
(4368, 7, 86, 'Свободно'),
(4369, 8, 86, 'Свободно'),
(4370, 9, 86, 'Свободно'),
(4371, 10, 86, 'Свободно'),
(4372, 11, 86, 'Свободно'),
(4373, 12, 86, 'Свободно'),
(4374, 13, 86, 'Свободно'),
(4375, 14, 86, 'Свободно'),
(4376, 15, 86, 'Свободно'),
(4377, 16, 86, 'Свободно'),
(4378, 17, 86, 'Свободно'),
(4379, 18, 86, 'Свободно'),
(4380, 19, 86, 'Свободно'),
(4381, 20, 86, 'Свободно'),
(4382, 1, 87, 'Свободно'),
(4383, 2, 87, 'Свободно'),
(4384, 3, 87, 'Свободно'),
(4385, 4, 87, 'Свободно'),
(4386, 5, 87, 'Свободно'),
(4387, 6, 87, 'Свободно'),
(4388, 7, 87, 'Свободно'),
(4389, 8, 87, 'Свободно'),
(4390, 9, 87, 'Свободно'),
(4391, 10, 87, 'Свободно'),
(4392, 11, 87, 'Свободно'),
(4393, 12, 87, 'Свободно'),
(4394, 13, 87, 'Свободно'),
(4395, 14, 87, 'Свободно'),
(4396, 15, 87, 'Свободно'),
(4397, 16, 87, 'Свободно'),
(4398, 17, 87, 'Свободно'),
(4399, 18, 87, 'Свободно'),
(4400, 19, 87, 'Свободно'),
(4401, 20, 87, 'Свободно'),
(4402, 1, 88, 'Свободно'),
(4403, 2, 88, 'Свободно'),
(4404, 3, 88, 'Свободно'),
(4405, 4, 88, 'Свободно'),
(4406, 5, 88, 'Свободно'),
(4407, 6, 88, 'Свободно'),
(4408, 7, 88, 'Свободно'),
(4409, 8, 88, 'Свободно'),
(4410, 9, 88, 'Свободно'),
(4411, 10, 88, 'Свободно'),
(4412, 11, 88, 'Свободно'),
(4413, 12, 88, 'Свободно'),
(4414, 13, 88, 'Свободно'),
(4415, 14, 88, 'Свободно'),
(4416, 15, 88, 'Свободно'),
(4417, 16, 88, 'Свободно'),
(4418, 17, 88, 'Свободно'),
(4419, 18, 88, 'Свободно'),
(4420, 19, 88, 'Свободно'),
(4421, 20, 88, 'Свободно'),
(4422, 1, 89, 'Свободно'),
(4423, 2, 89, 'Свободно'),
(4424, 3, 89, 'Свободно'),
(4425, 4, 89, 'Свободно'),
(4426, 5, 89, 'Свободно'),
(4427, 6, 89, 'Свободно'),
(4428, 7, 89, 'Свободно'),
(4429, 8, 89, 'Свободно'),
(4430, 9, 89, 'Свободно'),
(4431, 10, 89, 'Свободно'),
(4432, 11, 89, 'Свободно'),
(4433, 12, 89, 'Свободно'),
(4434, 13, 89, 'Свободно'),
(4435, 14, 89, 'Свободно'),
(4436, 15, 89, 'Свободно'),
(4437, 16, 89, 'Свободно'),
(4438, 17, 89, 'Свободно'),
(4439, 18, 89, 'Свободно'),
(4440, 19, 89, 'Свободно'),
(4441, 20, 89, 'Свободно'),
(4442, 1, 90, 'Свободно'),
(4443, 2, 90, 'Свободно'),
(4444, 3, 90, 'Свободно'),
(4445, 4, 90, 'Свободно'),
(4446, 5, 90, 'Свободно'),
(4447, 6, 90, 'Свободно'),
(4448, 7, 90, 'Свободно'),
(4449, 8, 90, 'Свободно'),
(4450, 9, 90, 'Свободно'),
(4451, 10, 90, 'Свободно'),
(4452, 11, 90, 'Свободно'),
(4453, 12, 90, 'Свободно'),
(4454, 13, 90, 'Свободно'),
(4455, 14, 90, 'Свободно'),
(4456, 15, 90, 'Свободно'),
(4457, 16, 90, 'Свободно'),
(4458, 17, 90, 'Свободно'),
(4459, 18, 90, 'Свободно'),
(4460, 19, 90, 'Свободно'),
(4461, 20, 90, 'Свободно'),
(4462, 1, 91, 'Свободно'),
(4463, 2, 91, 'Свободно'),
(4464, 3, 91, 'Свободно'),
(4465, 4, 91, 'Свободно'),
(4466, 5, 91, 'Свободно'),
(4467, 6, 91, 'Свободно'),
(4468, 7, 91, 'Свободно'),
(4469, 8, 91, 'Свободно'),
(4470, 9, 91, 'Свободно'),
(4471, 10, 91, 'Свободно'),
(4472, 11, 91, 'Свободно'),
(4473, 12, 91, 'Свободно'),
(4474, 13, 91, 'Свободно'),
(4475, 14, 91, 'Свободно'),
(4476, 15, 91, 'Свободно'),
(4477, 16, 91, 'Свободно'),
(4478, 17, 91, 'Свободно'),
(4479, 18, 91, 'Свободно'),
(4480, 19, 91, 'Свободно'),
(4481, 20, 91, 'Свободно'),
(4482, 1, 92, 'Свободно'),
(4483, 2, 92, 'Свободно'),
(4484, 3, 92, 'Свободно'),
(4485, 4, 92, 'Свободно'),
(4486, 5, 92, 'Свободно'),
(4487, 6, 92, 'Свободно'),
(4488, 7, 92, 'Свободно'),
(4489, 8, 92, 'Свободно'),
(4490, 9, 92, 'Свободно'),
(4491, 10, 92, 'Свободно'),
(4492, 11, 92, 'Свободно'),
(4493, 12, 92, 'Свободно'),
(4494, 13, 92, 'Свободно'),
(4495, 14, 92, 'Свободно'),
(4496, 15, 92, 'Свободно'),
(4497, 16, 92, 'Свободно'),
(4498, 17, 92, 'Свободно'),
(4499, 18, 92, 'Свободно'),
(4500, 19, 92, 'Свободно'),
(4501, 20, 92, 'Свободно'),
(4702, 1, 106, 'Свободно'),
(4703, 2, 106, 'Свободно'),
(4704, 3, 106, 'Свободно'),
(4705, 4, 106, 'Свободно'),
(4706, 5, 106, 'Свободно'),
(4707, 6, 106, 'Свободно'),
(4708, 7, 106, 'Свободно'),
(4709, 8, 106, 'Свободно'),
(4710, 9, 106, 'Свободно'),
(4711, 10, 106, 'Свободно'),
(4712, 11, 106, 'Свободно'),
(4713, 12, 106, 'Свободно'),
(4714, 13, 106, 'Свободно'),
(4715, 14, 106, 'Свободно'),
(4716, 15, 106, 'Свободно'),
(4717, 16, 106, 'Свободно'),
(4718, 17, 106, 'Свободно'),
(4719, 18, 106, 'Свободно'),
(4720, 19, 106, 'Свободно'),
(4721, 20, 106, 'Свободно'),
(4722, 1, 107, 'Свободно'),
(4723, 2, 107, 'Свободно'),
(4724, 3, 107, 'Свободно'),
(4725, 4, 107, 'Свободно'),
(4726, 5, 107, 'Свободно'),
(4727, 6, 107, 'Свободно'),
(4728, 7, 107, 'Свободно'),
(4729, 8, 107, 'Свободно'),
(4730, 9, 107, 'Свободно'),
(4731, 10, 107, 'Свободно'),
(4732, 11, 107, 'Свободно'),
(4733, 12, 107, 'Свободно'),
(4734, 13, 107, 'Свободно'),
(4735, 14, 107, 'Свободно'),
(4736, 15, 107, 'Свободно'),
(4737, 16, 107, 'Свободно'),
(4738, 17, 107, 'Свободно'),
(4739, 18, 107, 'Свободно'),
(4740, 19, 107, 'Свободно'),
(4741, 20, 107, 'Свободно'),
(4742, 1, 108, 'Свободно'),
(4743, 2, 108, 'Свободно'),
(4744, 3, 108, 'Свободно'),
(4745, 4, 108, 'Свободно'),
(4746, 5, 108, 'Свободно'),
(4747, 6, 108, 'Свободно'),
(4748, 7, 108, 'Свободно'),
(4749, 8, 108, 'Свободно'),
(4750, 9, 108, 'Свободно'),
(4751, 10, 108, 'Свободно'),
(4752, 11, 108, 'Свободно'),
(4753, 12, 108, 'Свободно'),
(4754, 13, 108, 'Свободно'),
(4755, 14, 108, 'Свободно'),
(4756, 15, 108, 'Свободно'),
(4757, 16, 108, 'Свободно'),
(4758, 17, 108, 'Свободно'),
(4759, 18, 108, 'Свободно'),
(4760, 19, 108, 'Свободно'),
(4761, 20, 108, 'Свободно'),
(4762, 1, 109, 'Свободно'),
(4763, 2, 109, 'Свободно'),
(4764, 3, 109, 'Свободно'),
(4765, 4, 109, 'Свободно'),
(4766, 5, 109, 'Свободно'),
(4767, 6, 109, 'Свободно'),
(4768, 7, 109, 'Свободно'),
(4769, 8, 109, 'Свободно'),
(4770, 9, 109, 'Свободно'),
(4771, 10, 109, 'Свободно'),
(4772, 11, 109, 'Свободно'),
(4773, 12, 109, 'Свободно'),
(4774, 13, 109, 'Свободно'),
(4775, 14, 109, 'Свободно'),
(4776, 15, 109, 'Свободно'),
(4777, 16, 109, 'Свободно'),
(4778, 17, 109, 'Свободно'),
(4779, 18, 109, 'Свободно'),
(4780, 19, 109, 'Свободно'),
(4781, 20, 109, 'Свободно'),
(4782, 1, 110, 'Свободно'),
(4783, 2, 110, 'Свободно'),
(4784, 3, 110, 'Свободно'),
(4785, 4, 110, 'Свободно'),
(4786, 5, 110, 'Свободно'),
(4787, 6, 110, 'Свободно'),
(4788, 7, 110, 'Свободно'),
(4789, 8, 110, 'Свободно'),
(4790, 9, 110, 'Свободно'),
(4791, 10, 110, 'Свободно'),
(4792, 11, 110, 'Свободно'),
(4793, 12, 110, 'Свободно'),
(4794, 13, 110, 'Свободно'),
(4795, 14, 110, 'Свободно'),
(4796, 15, 110, 'Свободно'),
(4797, 16, 110, 'Свободно'),
(4798, 17, 110, 'Свободно'),
(4799, 18, 110, 'Свободно'),
(4800, 19, 110, 'Свободно'),
(4801, 20, 110, 'Свободно'),
(4802, 1, 111, 'Свободно'),
(4803, 2, 111, 'Свободно'),
(4804, 3, 111, 'Свободно'),
(4805, 4, 111, 'Свободно'),
(4806, 5, 111, 'Свободно'),
(4807, 6, 111, 'Свободно'),
(4808, 7, 111, 'Свободно'),
(4809, 8, 111, 'Свободно'),
(4810, 9, 111, 'Свободно'),
(4811, 10, 111, 'Свободно'),
(4812, 11, 111, 'Свободно'),
(4813, 12, 111, 'Свободно'),
(4814, 13, 111, 'Свободно'),
(4815, 14, 111, 'Свободно'),
(4816, 15, 111, 'Свободно'),
(4817, 16, 111, 'Свободно'),
(4818, 17, 111, 'Свободно'),
(4819, 18, 111, 'Свободно'),
(4820, 19, 111, 'Свободно'),
(4821, 20, 111, 'Свободно'),
(4822, 1, 112, 'Свободно'),
(4823, 2, 112, 'Свободно'),
(4824, 3, 112, 'Свободно'),
(4825, 4, 112, 'Свободно'),
(4826, 5, 112, 'Свободно'),
(4827, 6, 112, 'Свободно'),
(4828, 7, 112, 'Свободно'),
(4829, 8, 112, 'Свободно'),
(4830, 9, 112, 'Свободно'),
(4831, 10, 112, 'Свободно'),
(4832, 11, 112, 'Свободно'),
(4833, 12, 112, 'Свободно'),
(4834, 13, 112, 'Свободно'),
(4835, 14, 112, 'Свободно'),
(4836, 15, 112, 'Свободно'),
(4837, 16, 112, 'Свободно'),
(4838, 17, 112, 'Свободно'),
(4839, 18, 112, 'Свободно'),
(4840, 19, 112, 'Свободно'),
(4841, 20, 112, 'Свободно'),
(4842, 1, 113, 'Свободно'),
(4843, 2, 113, 'Свободно'),
(4844, 3, 113, 'Свободно'),
(4845, 4, 113, 'Свободно'),
(4846, 5, 113, 'Свободно'),
(4847, 6, 113, 'Свободно'),
(4848, 7, 113, 'Свободно'),
(4849, 8, 113, 'Свободно'),
(4850, 9, 113, 'Свободно'),
(4851, 10, 113, 'Свободно'),
(4852, 11, 113, 'Свободно'),
(4853, 12, 113, 'Свободно'),
(4854, 13, 113, 'Свободно'),
(4855, 14, 113, 'Свободно'),
(4856, 15, 113, 'Свободно'),
(4857, 16, 113, 'Свободно'),
(4858, 17, 113, 'Свободно'),
(4859, 18, 113, 'Свободно'),
(4860, 19, 113, 'Свободно'),
(4861, 20, 113, 'Свободно'),
(4862, 1, 114, 'Свободно'),
(4863, 2, 114, 'Свободно'),
(4864, 3, 114, 'Свободно'),
(4865, 4, 114, 'Свободно'),
(4866, 5, 114, 'Свободно'),
(4867, 6, 114, 'Свободно'),
(4868, 7, 114, 'Свободно'),
(4869, 8, 114, 'Свободно'),
(4870, 9, 114, 'Свободно'),
(4871, 10, 114, 'Свободно'),
(4872, 11, 114, 'Свободно'),
(4873, 12, 114, 'Свободно'),
(4874, 13, 114, 'Свободно'),
(4875, 14, 114, 'Свободно'),
(4876, 15, 114, 'Свободно'),
(4877, 16, 114, 'Свободно'),
(4878, 17, 114, 'Свободно'),
(4879, 18, 114, 'Свободно'),
(4880, 19, 114, 'Свободно'),
(4881, 20, 114, 'Свободно'),
(4882, 1, 115, 'Свободно'),
(4883, 2, 115, 'Свободно'),
(4884, 3, 115, 'Свободно'),
(4885, 4, 115, 'Свободно'),
(4886, 5, 115, 'Свободно'),
(4887, 6, 115, 'Свободно'),
(4888, 7, 115, 'Свободно'),
(4889, 8, 115, 'Свободно'),
(4890, 9, 115, 'Свободно'),
(4891, 10, 115, 'Свободно'),
(4892, 11, 115, 'Свободно'),
(4893, 12, 115, 'Свободно'),
(4894, 13, 115, 'Свободно'),
(4895, 14, 115, 'Свободно'),
(4896, 15, 115, 'Свободно'),
(4897, 16, 115, 'Свободно'),
(4898, 17, 115, 'Свободно'),
(4899, 18, 115, 'Свободно'),
(4900, 19, 115, 'Свободно'),
(4901, 20, 115, 'Свободно');

-- --------------------------------------------------------

--
-- Table structure for table `tblissuedbookdetails`
--

CREATE TABLE `tblissuedbookdetails` (
  `id` int NOT NULL,
  `BookId` int DEFAULT NULL,
  `StudentID` varchar(150) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ReturnDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `RetrunStatus` int DEFAULT NULL,
  `fine` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblissuedbookdetails`
--

INSERT INTO `tblissuedbookdetails` (`id`, `BookId`, `StudentID`, `IssuesDate`, `ReturnDate`, `RetrunStatus`, `fine`) VALUES
(1, 1, 'SID002', '2017-07-15 06:09:47', '2017-07-15 11:15:20', 1, 0),
(2, 1, 'SID002', '2017-07-15 06:12:27', '2017-07-15 11:15:23', 1, 5),
(3, 3, 'SID002', '2017-07-15 06:13:40', NULL, 0, NULL),
(4, 3, 'SID002', '2017-07-15 06:23:23', '2017-07-15 11:22:29', 1, 2),
(5, 1, 'SID009', '2017-07-15 10:59:26', NULL, 0, NULL),
(6, 3, 'SID011', '2017-07-15 18:02:55', NULL, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `documents_fk_1` (`LocationID`);

--
-- Indexes for table `document_authors`
--
ALTER TABLE `document_authors`
  ADD PRIMARY KEY (`DocumentID`,`AuthorID`),
  ADD KEY `AuthorID` (`AuthorID`);

--
-- Indexes for table `document_categories`
--
ALTER TABLE `document_categories`
  ADD PRIMARY KEY (`DocumentID`,`CategoryID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_employees_1` (`DepID`);

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_employees_2` (`emID`),
  ADD KEY `FK_employees_3` (`docId`),
  ADD KEY `FK_employees_4` (`opID`);

--
-- Indexes for table `racks`
--
ALTER TABLE `racks`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RackNumber` (`RackNumber`);

--
-- Indexes for table `shelves`
--
ALTER TABLE `shelves`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_RACKS` (`RackID`);

--
-- Indexes for table `storagecells`
--
ALTER TABLE `storagecells`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_SHELVES` (`ShelfID`);

--
-- Indexes for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `operations`
--
ALTER TABLE `operations`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `racks`
--
ALTER TABLE `racks`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `shelves`
--
ALTER TABLE `shelves`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `storagecells`
--
ALTER TABLE `storagecells`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4902;

--
-- AUTO_INCREMENT for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_fk_1` FOREIGN KEY (`LocationID`) REFERENCES `storagecells` (`ID`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `document_authors`
--
ALTER TABLE `document_authors`
  ADD CONSTRAINT `document_authors_ibfk_1` FOREIGN KEY (`DocumentID`) REFERENCES `documents` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `document_authors_ibfk_2` FOREIGN KEY (`AuthorID`) REFERENCES `authors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `document_categories`
--
ALTER TABLE `document_categories`
  ADD CONSTRAINT `document_categories_ibfk_1` FOREIGN KEY (`DocumentID`) REFERENCES `documents` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `document_categories_ibfk_2` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `FK_employees_1` FOREIGN KEY (`DepID`) REFERENCES `departments` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `operations`
--
ALTER TABLE `operations`
  ADD CONSTRAINT `FK_employees_2` FOREIGN KEY (`emID`) REFERENCES `employees` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_employees_3` FOREIGN KEY (`docId`) REFERENCES `documents` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_employees_4` FOREIGN KEY (`opID`) REFERENCES `admin` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `shelves`
--
ALTER TABLE `shelves`
  ADD CONSTRAINT `FK_RACKS` FOREIGN KEY (`RackID`) REFERENCES `racks` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `storagecells`
--
ALTER TABLE `storagecells`
  ADD CONSTRAINT `FK_SHELVES` FOREIGN KEY (`ShelfID`) REFERENCES `shelves` (`ID`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
