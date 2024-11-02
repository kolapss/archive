-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2024 at 10:18 PM
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
  `id` int NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'Kumar Pandule', 'kumarpandule@gmail.com', 'admin', 'e6e061838856bf47e1de730719fb2609', '2021-06-28 16:06:08');

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
(4302, 1, 83, 'Свободно'),
(4303, 2, 83, 'Свободно'),
(4304, 3, 83, 'Свободно'),
(4305, 4, 83, 'Свободно'),
(4306, 5, 83, 'Свободно'),
(4307, 6, 83, 'Свободно'),
(4308, 7, 83, 'Свободно'),
(4309, 8, 83, 'Свободно'),
(4310, 9, 83, 'Свободно'),
(4311, 10, 83, 'Свободно'),
(4312, 11, 83, 'Свободно'),
(4313, 12, 83, 'Свободно'),
(4314, 13, 83, 'Свободно'),
(4315, 14, 83, 'Свободно'),
(4316, 15, 83, 'Свободно'),
(4317, 16, 83, 'Свободно'),
(4318, 17, 83, 'Свободно'),
(4319, 18, 83, 'Свободно'),
(4320, 19, 83, 'Свободно'),
(4321, 20, 83, 'Свободно'),
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
-- Table structure for table `tblauthors`
--

CREATE TABLE `tblauthors` (
  `id` int NOT NULL,
  `AuthorName` varchar(159) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblauthors`
--

INSERT INTO `tblauthors` (`id`, `AuthorName`, `creationDate`, `UpdationDate`) VALUES
(1, 'Kumar Pandule', '2017-07-08 12:49:09', '2021-06-28 16:03:28'),
(2, 'Kumar', '2017-07-08 14:30:23', '2021-06-28 16:03:35'),
(3, 'Rahul', '2017-07-08 14:35:08', '2021-06-28 16:03:43'),
(4, 'HC Verma', '2017-07-08 14:35:21', NULL),
(5, 'R.D. Sharma ', '2017-07-08 14:35:36', NULL),
(9, 'fwdfrwer', '2017-07-08 15:22:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblbooks`
--

CREATE TABLE `tblbooks` (
  `id` int NOT NULL,
  `BookName` varchar(255) DEFAULT NULL,
  `CatId` int DEFAULT NULL,
  `AuthorId` int DEFAULT NULL,
  `ISBNNumber` int DEFAULT NULL,
  `BookPrice` int DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooks`
--

INSERT INTO `tblbooks` (`id`, `BookName`, `CatId`, `AuthorId`, `ISBNNumber`, `BookPrice`, `RegDate`, `UpdationDate`) VALUES
(1, 'PHP And MySql programming', 5, 1, 222333, 20, '2017-07-08 20:04:55', '2017-07-15 05:54:41');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int NOT NULL,
  `CategoryName` varchar(150) DEFAULT NULL,
  `Status` int DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(4, 'Romantic', 1, '2017-07-04 18:35:25', '2017-07-06 16:00:42'),
(5, 'Technology', 1, '2017-07-04 18:35:39', '2017-07-08 17:13:03'),
(6, 'Science', 1, '2017-07-04 18:35:55', '0000-00-00 00:00:00'),
(7, 'Management', 0, '2017-07-04 18:36:16', '0000-00-00 00:00:00');

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

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `id` int NOT NULL,
  `StudentId` varchar(100) DEFAULT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Status` int DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`id`, `StudentId`, `FullName`, `EmailId`, `MobileNumber`, `Password`, `Status`, `RegDate`, `UpdationDate`) VALUES
(1, 'SID002', 'Anuj kumar', 'anuj.lpu1@gmail.com', '9865472555', 'f925916e2754e5e03f75dd58a5733251', 1, '2017-07-11 15:37:05', '2017-07-15 18:26:21'),
(4, 'SID005', 'sdfsd', 'csfsd@dfsfks.com', '8569710025', '92228410fc8b872914e023160cf4ae8f', 0, '2017-07-11 15:41:27', '2024-11-02 21:13:13'),
(8, 'SID009', 'test', 'test@gmail.com', '2359874527', 'f925916e2754e5e03f75dd58a5733251', 1, '2017-07-11 15:58:28', '2017-07-15 13:42:44'),
(9, 'SID010', 'Amit', 'amit@gmail.com', '8585856224', 'f925916e2754e5e03f75dd58a5733251', 1, '2017-07-15 13:40:30', NULL),
(10, 'SID011', 'Sarita Pandey', 'sarita@gmail.com', '4672423754', 'f925916e2754e5e03f75dd58a5733251', 1, '2017-07-15 18:00:59', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tblauthors`
--
ALTER TABLE `tblauthors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooks`
--
ALTER TABLE `tblbooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `StudentId` (`StudentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `tblauthors`
--
ALTER TABLE `tblauthors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblbooks`
--
ALTER TABLE `tblbooks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shelves`
--
ALTER TABLE `shelves`
  ADD CONSTRAINT `FK_RACKS` FOREIGN KEY (`RackID`) REFERENCES `racks` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `storagecells`
--
ALTER TABLE `storagecells`
  ADD CONSTRAINT `FK_SHELVES` FOREIGN KEY (`ShelfID`) REFERENCES `shelves` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
