-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 23 2016 г., 14:31
-- Версия сервера: 5.5.50
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `student_list`
--

-- --------------------------------------------------------

--
-- Структура таблицы `fields`
--

CREATE TABLE IF NOT EXISTS `fields` (
  `id` tinyint(4) NOT NULL,
  `name` text NOT NULL,
  `descr` text NOT NULL,
  `type` text NOT NULL,
  `checkErr` text NOT NULL,
  `value1` text NOT NULL,
  `value2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `fields`
--

INSERT INTO `fields` (`id`, `name`, `descr`, `type`, `checkErr`, `value1`, `value2`) VALUES
(0, 'name', 'Имя', 'text', 'checkLong,checkRus', '', ''),
(1, 'surname', 'Фамилия', 'text', 'checkLong,checkRus', '', ''),
(2, 'sex', 'Пол', 'radio', '', 'М,М', 'Ж,Ж'),
(3, 'groupnum', 'Номер группы', 'text', 'checkLong2to5', '', ''),
(4, 'email', 'Email', 'text', 'checkEmail', '', ''),
(5, 'egepoints', 'Сумма ЕГЭ', 'text', 'checkPoints', '', ''),
(6, 'birthyear', 'Год рождения', 'text', 'checkYear', '', ''),
(7, 'local', 'Проживание', 'radio', '', 'Местный,Местный', 'Приезжий,Приезжий');

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `sex` text NOT NULL,
  `groupnum` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `egepoints` smallint(6) NOT NULL,
  `birthyear` text NOT NULL,
  `local` text NOT NULL,
  `cookpass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`name`, `surname`, `sex`, `groupnum`, `email`, `egepoints`, `birthyear`, `local`, `cookpass`) VALUES
('Даниил', 'Боготовский', 'М', '3326', 'danilbog@yandex.ru', 266, '1996', 'Приезжий', '$2y$10$HShWVlhOHvf17zHpSCuUXe1PycNkP2EOI2hj/DAUGhVg.Wvfxd2Nq'),
('Бобер', 'Правильный', 'Ж', '727ВЫ', 'ololoshka221@mail.ru', 231, '1994', 'Местный', '$2y$10$mYe2kCoIc59pNAJ9n1sc2eFSl/mKjsqkiHg6cd.dreDCmj08ZDPB.'),
('Булька', 'Ашовыц', 'М', '32аxe', 'kddadks@gmail.com', 254, '1986', 'Местный', '$2y$10$Yb0lsUafwhxxIJBpG0jGTOt0.NYexmg4oAmKM24QvCnqhc0QvrwYK'),
('Зинаида', 'Ивановна', 'М', '46СОВ', 'zenit19e5@yandex.ru', 239, '1976', 'Местный', '0'),
('Екатерина', 'Салихова', 'Ж', '193Д', 'pogf534@yandex.ru', 173, '1978', 'Приезжий', '10'),
('Мария', 'Воробьёва', 'Ж', '137ВА', 'triceos552123@yandex.ru', 84, '1971', 'Местный', '11'),
('Женек', 'Соковиков', 'М', '118Ж', 'borsh32@yandex.ru', 300, '1989', 'Местный', '12'),
('Денис', 'Фарносов', 'М', '120МИ', 'chepushila228@yandex.ru', 219, '1975', 'Местный', '13'),
('Николай', 'Колчин', 'М', '115Ц', 'goest2@gmail.com', 276, '1995', 'Местный', '14'),
('Антон', 'Смирнов', 'М', '51А', 'dsg22ss@gmail.com', 86, '1979', 'Местный', '15'),
('Вероника', 'Воскобойникова', 'Ж', '109О', 'kaks@gmail.com', 290, '1990', 'Местный', '16'),
('Настя', 'Калич', 'Ж', '63А', 'geogregorgezor@gmail.com', 205, '1973', 'Приезжий', '17'),
('Настя', 'Прохорова', 'Ж', '198А', 'croquetboys@yandex.ru', 229, '1976', 'Местный', '18'),
('Вадим', 'Усачев', 'М', '79З', 'z0rde@yandex.ru', 125, '1993', 'Местный', '19'),
('Антон', 'Фрейд', 'Ж', '75Р', 'djboy23sxd@yandex.ru', 128, '1990', 'Местный', '20'),
('Борис', 'Калыгин', 'М', '111В', 'ascfg@yandex.ru', 205, '1998', 'Местный', '21'),
('Евгений', 'Гущин', 'М', '54Е', 'polisdwa999@yandex.ru', 131, '1989', 'Местный', '22'),
('Никита', 'Третьяков', 'М', '110И', '0catisdead0@yandex.ru', 152, '1998', 'Местный', '23'),
('Александр', 'Новых', 'М', '193Д', 'bbbbbboyz@gmail.com', 139, '1971', 'Приезжий', '24'),
('Екатерина', 'Власова', 'Ж', '137ВА', 'iduppss@gmail.com', 233, '1973', 'Местный', '25'),
('Мария', 'Шестаков', 'Ж', '118Ж', 'stormysos911@yandex.ru', 260, '1986', 'Местный', '26'),
('Женек', 'Прищепкин', 'М', '120МИ', 'hitlerwasright@yandex.ru', 227, '1987', 'Местный', '27'),
('Костя', 'Блинов', 'М', '115Ц', 'girlswanttohavefun@yandex.ru', 290, '1982', 'Местный', '28'),
('Николай', 'Быков', 'М', '51А', 'suicidewave@yandex.ru', 285, '1997', 'Местный', '29'),
('Кекел', 'Ашовыц', 'М', '552ы', 'pSx@gmail.com', 238, '1998', 'Местный', '3'),
('Антон', 'Яковлев', 'М', '109О', 'fuckthosesemails@yandex.ru', 246, '1981', 'Местный', '30'),
('Вероника', 'Антонов', 'Ж', '63А', '5343what@yandex.ru', 219, '1981', 'Приезжий', '31'),
('Настя', 'Василенко', 'Ж', '198А', 'xd@gmail.com', 94, '1980', 'Местный', '32'),
('Татьяна', 'Левандовская', 'Ж', '79З', 'abcdefg@gmail.com', 166, '1984', 'Местный', '33'),
('Вадим', 'Киселев', 'М', '75Р', 'alphabetboy123@gmail.com', 199, '1982', 'Местный', '34'),
('Антон', 'Горбачёв', 'М', '111В', 'tryleft645@gmail.com', 179, '1982', 'Местный', '35'),
('Борис', 'Морис', 'М', '54Е', 'udbdf32@gmail.com', 292, '1976', 'Местный', '36'),
('Евгений', 'Комаров', 'М', '110И', 'pfgje6y5@gmail.com', 146, '1987', 'Местный', '37'),
('Диана', 'Эскендаровна', 'Ж', '193Д', 'kuzenbolen@gmail.com', 130, '1989', 'Приезжий', '38'),
('Михаил', 'Козюлин', 'М', '137ВА', 'tusapke64s@gmail.com', 205, '1994', 'Местный', '39'),
('Екатерина', 'Антипова', 'Ж', '118Ж', 'tusapke65s@gmail.com', 121, '1993', 'Местный', '40'),
('Мария', 'Комарова', 'Ж', '120МИ', '88005553535@gmail.com', 201, '1997', 'Местный', '41'),
('Олег', 'Прищепкин', 'М', '115Ц', 'jhbtr9900@yandex.ru', 115, '1984', 'Местный', '42'),
('Костя', 'Аверьянов', 'М', '51А', 'slamjam0000@yandex.ru', 176, '1971', 'Местный', '43'),
('Николай', 'Зайцев', 'М', '109О', 'believehl3@yandex.ru', 227, '1997', 'Местный', '44'),
('Антон', 'Сентебов', 'М', '63А', 'gabenewel@yandex.ru', 259, '1972', 'Приезжий', '45'),
('Вероника', 'Смарева', 'Ж', '198А', 'hello@yandex.ru', 102, '1983', 'Местный', '46'),
('Настя', 'Заркова', 'Ж', '79З', 'world@yandex.ru', 163, '1990', 'Местный', '47'),
('Настя', 'Левкина', 'Ж', '75Р', 'dreamaboutcheese1984@yandex.ru', 168, '1977', 'Местный', '48'),
('Иван', 'Бадаев', 'М', '111В', 'aaaab0@yandex.ru', 155, '1991', 'Местный', '49'),
('Антон', 'Панов', 'М', '42И', 'gird23@yandex.ru', 97, '1992', 'Местный', '5'),
('Софья', 'Егорова', 'Ж', '54Е', 'aaaac1@yandex.ru', 194, '1971', 'Местный', '50'),
('Борис', 'Казаков', 'М', '110И', 'aaaaa0@yandex.ru', 293, '1982', 'Местный', '51'),
('Светлана', 'Омельченко', 'Ж', '193Д', 'nsppsndde@yandex.ru', 130, '1976', 'Приезжий', '52'),
('Никита', 'Вишняков', 'М', '137ВА', 'tojtuuj@yandex.ru', 290, '1989', 'Местный', '53'),
('Александр', 'Кудин', 'М', '118Ж', 'ramp@gmail.com', 293, '1978', 'Местный', '54'),
('Екатерина', 'Кононова', 'Ж', '120МИ', 'jeeezas988@yandex.ru', 285, '1972', 'Местный', '55'),
('Мария', 'Галкина', 'Ж', '115Ц', 'itsover985@yandex.ru', 106, '1994', 'Местный', '56'),
('Никита', 'Сухов', 'М', '11В', 'odyssey52@mail.ru', 210, '1996', 'Местный', '57'),
('Борис', 'Кайль', 'М', '75Р', 'bjfe4@gmail.com', 254, '1971', 'Местный', '6'),
('Евгений', 'Феденев', 'М', '111В', 'evgen.fed2334@gmail.com', 283, '1980', 'Местный', '7'),
('Никита', 'Зарезнов', 'М', '54Е', 'qwerty@gmail.com', 92, '1986', 'Местный', '8'),
('Александр', 'Морозов', 'М', '110И', 'mmdx764@yandex.ru', 234, '1986', 'Местный', '9');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`cookpass`),
  ADD UNIQUE KEY `email` (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
