-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 05 2025 г., 08:51
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cleversurv_main_bd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lamentation`
--

CREATE TABLE `lamentation` (
  `ID` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Status` varchar(20) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `SurveyID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `SessionID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `publicactivesurveys`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `publicactivesurveys` (
`Title` varchar(255)
,`Description` text
,`StartDate` datetime
,`EndDate` datetime
);

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `ID` int(11) NOT NULL,
  `Text` text NOT NULL,
  `Type` varchar(50) NOT NULL,
  `IsRequired` tinyint(1) DEFAULT NULL,
  `QuestionOrder` int(11) NOT NULL,
  `SurveyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `response`
--

CREATE TABLE `response` (
  `ID` int(11) NOT NULL,
  `SubmissionDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UserID` int(11) DEFAULT NULL,
  `SurveyID` int(11) NOT NULL,
  `QuestionID` int(11) NOT NULL,
  `SessionID` varchar(255) DEFAULT NULL,
  `Duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `surveys`
--

CREATE TABLE `surveys` (
  `ID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL,
  `StartDate` datetime DEFAULT NULL,
  `EndDate` datetime DEFAULT NULL,
  `IsAnonymus` tinyint(1) DEFAULT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Email` varchar(320) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` varchar(50) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID`, `Email`, `Password`, `Role`) VALUES
(1, 'asdad@w52', '$2y$10$SY2fb5vzFxQxHnsSlAv3M.1YrCIBDBApqGuv4ned0lM2OAfWOVt0i', 'user'),
(2, 'firstAdmin@yandex.ru', '$2y$10$MEEjXArtfv5gTuGem8MH0OrSIYi1monx.MMMsHGvOqplD6fRadd.C', 'admin'),
(3, 'lalal@gmail.com', '$2y$10$toHMmOcbEvgBGniRxi6zBOjHGtqu8K60H74j906PEnSk22fvKzTm.', 'user'),
(4, 'alreadyUsedEmail@yandex.ru', '$2y$10$WUrCKmmNMCeCWP3VtlP7SuFVagHtZ4a6gYQxlBS0c348dQQTyFA5O', 'user'),
(5, 'Homer@yandex.ru', '$2y$10$5uk6OJiicQlfFh8A4zsYb.9888WN1ufVL5LTxwUmApuMmydXQ9W9e', 'user'),
(6, 'firstafafafafn@yandex.ru', '$2y$10$4/dmDjT969wWCC0JxnCeTuhkp2soJBGa32ac/ImKAauVnz3kMAFWG', 'user'),
(7, 'firin@yandex.ru', '$2y$10$zy8.bmdF.dqHvn2PL5Nt6uBEQAZfJYblyjlbnn5SyQIV670uKM0uG', 'user');

-- --------------------------------------------------------

--
-- Структура для представления `publicactivesurveys`
--
DROP TABLE IF EXISTS `publicactivesurveys`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `publicactivesurveys`  AS SELECT `surveys`.`Title` AS `Title`, `surveys`.`Description` AS `Description`, `surveys`.`StartDate` AS `StartDate`, `surveys`.`EndDate` AS `EndDate` FROM `surveys` WHERE `surveys`.`Status` = 'active' ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lamentation`
--
ALTER TABLE `lamentation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SurveyID` (`SurveyID`),
  ADD KEY `UserID` (`UserID`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SurveyID` (`SurveyID`);

--
-- Индексы таблицы `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `SurveyID` (`SurveyID`),
  ADD KEY `QuestionID` (`QuestionID`);

--
-- Индексы таблицы `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lamentation`
--
ALTER TABLE `lamentation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `response`
--
ALTER TABLE `response`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `surveys`
--
ALTER TABLE `surveys`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `lamentation`
--
ALTER TABLE `lamentation`
  ADD CONSTRAINT `lamentation_ibfk_1` FOREIGN KEY (`SurveyID`) REFERENCES `surveys` (`ID`),
  ADD CONSTRAINT `lamentation_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);

--
-- Ограничения внешнего ключа таблицы `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`SurveyID`) REFERENCES `surveys` (`ID`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `response`
--
ALTER TABLE `response`
  ADD CONSTRAINT `response_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `response_ibfk_2` FOREIGN KEY (`SurveyID`) REFERENCES `surveys` (`ID`),
  ADD CONSTRAINT `response_ibfk_3` FOREIGN KEY (`QuestionID`) REFERENCES `questions` (`ID`);

--
-- Ограничения внешнего ключа таблицы `surveys`
--
ALTER TABLE `surveys`
  ADD CONSTRAINT `surveys_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
