-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 10 2021 г., 18:09
-- Версия сервера: 5.6.41
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `paws_and_ears`
--

-- --------------------------------------------------------

--
-- Структура таблицы `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'Petmax'),
(2, 'Rurri');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pet_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `pet_type_id`) VALUES
(1, 'Корм', 1),
(2, 'Миски', 1),
(3, 'Лежанки и домики', 1),
(4, 'Средства для ухода', 1),
(5, 'Амуниция', 1),
(6, 'Туалеты', 1),
(7, 'Игрушки', 1),
(8, 'Корм', 2),
(9, 'Миски', 2),
(10, 'Лежанки и домики', 2),
(11, 'Средства для ухода', 2),
(12, 'Одежда и обувь', 2),
(13, 'Амуниция', 2),
(14, 'Игрушки', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `manufacturer_country`
--

CREATE TABLE `manufacturer_country` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `manufacturer_country`
--

INSERT INTO `manufacturer_country` (`id`, `name`) VALUES
(1, 'Россия'),
(2, 'Италия'),
(3, 'Китай'),
(4, 'Франция'),
(5, 'Германия'),
(6, 'США');

-- --------------------------------------------------------

--
-- Структура таблицы `pet_type`
--

CREATE TABLE `pet_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pet_type`
--

INSERT INTO `pet_type` (`id`, `name`) VALUES
(1, 'Для кошек'),
(2, 'Для собак');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(11,0) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `manufacturer_country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `image`, `description`, `category_id`, `brand_id`, `manufacturer_country_id`) VALUES
(1, 'Мягкая мышь 12,5см', '249', 'cat_toy_mouse.png', 'Игрушка для кошек Мышь от бренда Rurri надолго займёт вашего питомца и отвлечёт от нежелательных игр с предметами интерьера.\r\nПреимущества:\r\nС добавлением кошачьей мяты, которая привлекает своим ароматом, настраивает на игры и устраняет нервозность.\r\nИзготовлена из качественных, надежных материалов, которые безопасны для вашего питомца.\r\nРегулярно играя со своим питомцем вы помогаете ему улучшить зрение и скорость реакции, стимулируете его больше бегать и преследовать, развивая инстинкты хищника.', 7, 2, 3),
(2, 'Мышка натуральный мех 7,5 см 2шт', '199', 'cat_toy_mouse2.png', 'Игрушка Petmax серые мышки для котов всех пород. Они произведены из натурального меха и нетоксичных материалов, не травмирующих ротовую полость. Комплектация состоит из двух изделий по 7,5 сантиметров. Регулярные игры улучшают ощущение осязаемости, зрение и скорость реакции. Развлечение стимулирует питомца бегать и преследовать, развивая инстинкты хищника.', 7, 1, 3),
(3, 'Рыба Скумбрия с валерианой и кошачьей мятой 19,5 см', '210', 'cat_toy_fish.png', 'Игрушка для кошек Рыба Скумбрия с валерианой и кошачьей мятой. Мягкая и лёгкая: вашему пушистому охотнику будет легко переносить её с места на место и приятно запускать когти в неё.\r\n\r\nПреимущества:\r\nМягкая игрушка идеальна для захвата зубами и запускания когтей.\r\nКошачья мята и валериана действуют на кошку расслабляюще: снимают нервозность и располагают к играм.\r\nРеалистичный вид рыбки.', 7, 1, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_type_id` (`pet_type_id`);

--
-- Индексы таблицы `manufacturer_country`
--
ALTER TABLE `manufacturer_country`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pet_type`
--
ALTER TABLE `pet_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `manufacturer_country_id` (`manufacturer_country_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `manufacturer_country`
--
ALTER TABLE `manufacturer_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `pet_type`
--
ALTER TABLE `pet_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`pet_type_id`) REFERENCES `pet_type` (`id`);

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`manufacturer_country_id`) REFERENCES `manufacturer_country` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
