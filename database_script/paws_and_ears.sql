-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 01 2022 г., 20:33
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
  `url_name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `pet_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `url_name`, `display_name`, `full_name`, `pet_type_id`) VALUES
(1, 'cat-feed', 'Корм', 'Корм для кошек', 1),
(2, 'cat-bowls', 'Миски', 'Миски для кошек', 1),
(3, 'cat-beds-and-houses', 'Лежанки и домики', 'Лежанки и домики для кошек', 1),
(4, 'cat-care-products', 'Средства для ухода', 'Средства для ухода за кошками', 1),
(5, 'cat-ammunition', 'Амуниция', 'Амуниция для кошек', 1),
(6, 'cat-toilets', 'Туалеты', 'Туалеты для кошек', 1),
(7, 'cat-toys', 'Игрушки', 'Игрушки для кошек', 1),
(8, 'dog-feed', 'Корм', 'Корм для собак', 2),
(9, 'dog-bowls', 'Миски', 'Миски для собак', 2),
(10, 'dog-beds-and-houses', 'Лежанки и домики', 'Лежанки и домики для собак', 2),
(11, 'dog-care-products', 'Средства для ухода', 'Средства для ухода за собаками', 2),
(12, 'dog-clothes-and-footwear', 'Одежда и обувь', 'Одежда и обувь для собак', 2),
(13, 'dog-ammunition', 'Амуниция', 'Амуниция для собак', 2),
(14, 'dog-toys', 'Игрушки', 'Игрушки для собак', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Структура таблицы `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_status`
--

INSERT INTO `order_status` (`id`, `name`, `message`) VALUES
(1, 'Оформлен', 'Ваш заказ принят. В ближайшее время с Вами свяжется оператор для подтверждения заказа.'),
(2, 'Подтверждён', ''),
(3, 'Собран на складе', ''),
(4, 'Передан в доставку', ''),
(5, 'Завершён', ''),
(6, 'Отменён', '');

-- --------------------------------------------------------

--
-- Структура таблицы `pet_type`
--

CREATE TABLE `pet_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sale_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pet_type`
--

INSERT INTO `pet_type` (`id`, `name`, `sale_name`) VALUES
(1, 'Для кошек', 'Акции для кошек'),
(2, 'Для собак', 'Акции для собак');

-- --------------------------------------------------------

--
-- Структура таблицы `placed_order`
--

CREATE TABLE `placed_order` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `client_id` int(11) NOT NULL,
  `total_cost` decimal(11,0) NOT NULL,
  `total_discount` decimal(11,0) NOT NULL,
  `total_product_count` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_status_id` int(11) NOT NULL DEFAULT '1',
  `guid` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `placed_order_item`
--

CREATE TABLE `placed_order_item` (
  `placed_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cost_per_item` decimal(11,0) NOT NULL,
  `discount_per_item` decimal(11,0) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `manufacturer_country_id` int(11) NOT NULL,
  `is_sale` bit(1) NOT NULL DEFAULT b'0',
  `sale_price` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `image`, `description`, `category_id`, `brand_id`, `manufacturer_country_id`, `is_sale`, `sale_price`) VALUES
(1, 'Мягкая мышь 12,5 см', '249', 'id_1.png', 'Игрушка для кошек Мышь от бренда Rurri надолго займёт вашего питомца и отвлечёт от нежелательных игр с предметами интерьера.\r\nПреимущества:\r\nС добавлением кошачьей мяты, которая привлекает своим ароматом, настраивает на игры и устраняет нервозность.\r\nИзготовлена из качественных, надежных материалов, которые безопасны для вашего питомца.\r\nРегулярно играя со своим питомцем вы помогаете ему улучшить зрение и скорость реакции, стимулируете его больше бегать и преследовать, развивая инстинкты хищника.', 7, 2, 3, b'1', '199'),
(2, 'Мышка натуральный мех 7,5 см 2 шт', '199', 'id_2.png', 'Игрушка Petmax серые мышки для котов всех пород. Они произведены из натурального меха и нетоксичных материалов, не травмирующих ротовую полость. Комплектация состоит из двух изделий по 7,5 сантиметров. Регулярные игры улучшают ощущение осязаемости, зрение и скорость реакции. Развлечение стимулирует питомца бегать и преследовать, развивая инстинкты хищника.', 7, 1, 3, b'1', '99'),
(3, 'Рыба Скумбрия с валерианой и кошачьей мятой 19,5 см', '210', 'id_3.png', 'Игрушка для кошек Рыба Скумбрия с валерианой и кошачьей мятой. Мягкая и лёгкая: вашему пушистому охотнику будет легко переносить её с места на место и приятно запускать когти в неё.\r\nПреимущества:\r\nМягкая игрушка идеальна для захвата зубами и запускания когтей.\r\nКошачья мята и валериана действуют на кошку расслабляюще: снимают нервозность и располагают к играм.\r\nРеалистичный вид рыбки.', 7, 1, 1, b'1', '110'),
(4, 'Мышка с перьями разноцветная 2 шт', '99', 'id_4.png', 'Игрушка PETMAX имеет вид разноцветных мышек с перьями из натурального меха (2 шт. цвета в ассортименте) - полезное и активное развлечение питомца. Избавит от стресса, скуки и предотвратят трудности с поведением. Отсутствуют опасные материалы, вызывающие аллергию. Комфортный размер 5 сантиметров рекомендован для взрослых и молодых животных. Игры развивают ловкость, физическую стойкость и силу.', 7, 1, 3, b'0', '0'),
(5, 'Мышка с электронным чипом 15 см', '255', 'id_5.png', 'Игрушка для кошек мышка с электронным чипом 15 см разрабатывается брендом GiGwi. Оригинальный дизайн в сочетании со звуковыми эффектами вдохновит питомца на активные игры. Качественный прочный материал не нанесет вреда для зубов. Развлечения с этой мышкой наполнят жизнь любимца позитивными эмоциями. Теперь подарить радость животному – это просто!', 7, 2, 1, b'0', '0'),
(6, 'Мяч мягкий 3,5 см 2 шт', '119', 'id_6.png', 'Игрушка для кошек PETMAX мяч мягкий (набор 2 шт.) обеспечит вашему питомцу необходимый уровень активности. \r\n\r\nПреимущества:\r\nМяч займет на долгое время и котёнка и взрослую активную кошку. \r\nМягкий материал мяча не повредит зубы питомца.\r\nПри этом мяч обладает достаточной прочностью и прослужит долгое время.', 7, 1, 3, b'1', '59'),
(7, 'Мячик с хвостиком и с пером гремящий, 4 см 2 шт', '119', 'id_7.png', 'Игрушка для кошек Мячик с хвостиком и с пером гремящий, 4 см (2шт)\r\nПреимущества:\r\nБезопасные материалы изготовления.\r\nФорма игрушки заинтересует активного питомца и надолго привлечет его внимание. Кошки очень любят играть с игрушками, похожими на настоящую добычу.\r\nОбеспечит кошке необходимый уровень активности и поможет не заскучать в Ваше отсутствие.', 7, 2, 1, b'0', '0'),
(8, 'Дразнилка с пером цветная Ирис 45 см', '99', 'id_8.png', 'Игрушка-дразнилка с пером для кошек от бренда Pet Hobby. Изготовлена с заботой о вашем неповторимом питомце. Игрушка займет всё внимание вашего питомца и надолго отвлечет от игр с предметами интерьера.\r\n\r\nПреимущества:\r\nИзготовлена из надежных материалов.\r\nПерья птиц разбудят в вашем питомце инстинкт охотника.\r\nУдобная и прочная палочка-держалка.\r\nРазноцветный яркий окрас перьев сразу заинтересует вашего питомца.', 7, 2, 1, b'0', '50'),
(9, 'Дразнилка Страус 60 см', '199', 'id_9.png', 'Игрушка для кошек Дразнилка Страус 60 см\r\n\r\nПреимущества:\r\nИгрушка изготовлена из перьев страуса.\r\nРекомендуется для совместных игр хозяина с питомцем.\r\nДлина игрушки: 60 см. \r\nС бубенчиком.', 7, 2, 1, b'1', '99'),
(10, 'Мяч теннисный 6 см', '139', 'id_10.png', 'Заботливые и внимательные хозяева знают, что чем больше игрушек у их питомца с раннего возраста, тем взрослый любимец будет наиболее развит и умен. Благодаря яркому цвету игрушка, несомненно, сможет привлечь внимание вашего любимца и ее будет труднее потерять на улице. Кроме того, прочный мяч долго прослужит в качестве отличного инструмента для развития вашей собаки, как физического и умственного, так и эмоционального. ', 14, 1, 3, b'1', '70'),
(11, 'Тренировочный снаряд для животных Puller 28 см', '999', 'id_11.png', 'Незаменимую роль ПУЛЛЕР (Puller) сыграет в здоровье Вашей собаки. ПУЛЛЕР (Puller) в обязательном порядке состоит из двух предметов – в этом заключается основной смысл снаряда и принципиальное отличие от всего остального. Способен дать необходимую нагрузку и при этом владелец собаки не будет тратить больше времени на выгул. Всего 3 простых упражнения, в течении 20 минут дадут собаке нагрузку равную 5 км бега в интенсивном режиме или 2-х часовое занятие с инструктором на площадке.', 14, 2, 4, b'1', '599'),
(12, 'Канат 2 узла, 42 см', '512', 'id_12.png', 'Игрушка Канат для собак от бренда Pet Hobby. Изготовлена с заботой о вашем неповторимом питомце.\r\n\r\nПреимущества:\r\nИзготовлена из натурального хлопка.\r\nСобаки обожают играть с веревочными игрушками, так как их можно грызть, трепать и носить в зубах.\r\nТакие игрушки отлично массируют десны и удаляют зубной налет во время игры.\r\nИгрушка станет другом Вашему питомцу и развлечет его в Ваше отсутствие.\r\nПодходит для собак всех пород.', 14, 2, 1, b'1', '312'),
(13, 'Летающий диск синий', '199', 'id_13.png', '', 14, 1, 2, b'1', '99'),
(14, 'Диван для собак 80х60х17 см', '2999', 'id_14.png', 'Диван 80х60х17 см для собак.\r\n\r\nПреимущества:\r\nДиван, верх сшит из мебельной ткани, нижняя часть выполнена из водонепроницаемой ткани, внутри экологически чистый холофайбер ХАРД, пласт высотой 8 см. \r\nУдобные валики, хорошо держит форму. \r\nЧехлы съемные, деликатная стирка. \r\nДиван подарит комфорт и долговечное использование вашему питомцу', 10, 2, 1, b'1', '1000'),
(15, 'Дом-когтеточка 60х40х70 см серая', '4999', 'id_15.png', 'Дом-когтеточка 60х40х70 см серая - это игровой комплекс, который предоставит вашему питомцу отличное место для отдыха и сна. Идеален для домов с двумя и более питомцами. \r\n\r\nПреимущества:\r\nДомик для кошек, который создаст вашей кошке все возможности для развлечения, удовольствия и игр.\r\nПокрытие полок-лежанок из искусственного меха.\r\nПодвесная игрушка.\r\nКогтеточки из сизаля на всех столбиках.\r\nВерхний уровень - открытая лежанка с мягкой подушкой.\r\nКогтеточка станет уютным укрытием для Вашей кошки.\r\nДомик на уровне пола подойдет даже пожилым питомцам.', 3, 1, 3, b'1', '2999'),
(16, 'Дождевик с мембраной и резиновой молнией', '1857', 'id_16.png', 'Дождевик для собак от бренда RUNGO - простой и эффективный способ сделать прогулку с собакой комфортной в любую непогоду. Дождевик RUNGO защитит Вашего питомца от сырости, загрязнений и переохлаждения.\r\n\r\nРазмеры:\r\nДлина спины: 37 см\r\nОбхват шеи: 39 см\r\nОбхват груди: 62 см\r\n\r\nПороды: Стаффорд Терьер\r\nПол: мальчик\r\nПреимущества:\r\nДышащая ткань.\r\nЭффективная защита от дождя, ветра и холода.\r\nУдобные крепления позволяют легко надевать и снимать дождевик.\r\nЗастежка-молния на спине, комбинезон полностью закрывает тело животного, защищая его от намокания и замерзания.\r\nУтягивающие резинки надежно фиксируют костюм на питомце.\r\nВозможность машинной стирки обеспечивает простой уход за изделием.\r\nНепромокаемое и ветроустойчивое покрытие.\r\nСветоотражающие элементы для безопасности', 12, 2, 1, b'1', '857');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `name`, `description`) VALUES
(1, 'Администратор', 'Неограниченный доступ ко всем данным в панели администратора.'),
(2, 'Менеджер склада', 'Доступ ко всем данным в панели администратора, кроме раздела Пользователи.'),
(3, 'Менеджер по продажам', 'Доступ ко всем данным в панели администратора, кроме раздела Пользователи.'),
(4, 'Оператор колл-центра', 'Доступ только к разделам Заказы и Клиенты в панели администратора.');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `role_id`) VALUES
(1, 'admin', 'admin', 1);

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
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `manufacturer_country`
--
ALTER TABLE `manufacturer_country`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pet_type`
--
ALTER TABLE `pet_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `placed_order`
--
ALTER TABLE `placed_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `order_status_id` (`order_status_id`) USING BTREE;

--
-- Индексы таблицы `placed_order_item`
--
ALTER TABLE `placed_order_item`
  ADD PRIMARY KEY (`product_id`,`placed_order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `placed_order_id` (`placed_order_id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `manufacturer_country_id` (`manufacturer_country_id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `manufacturer_country`
--
ALTER TABLE `manufacturer_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `pet_type`
--
ALTER TABLE `pet_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `placed_order`
--
ALTER TABLE `placed_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`pet_type_id`) REFERENCES `pet_type` (`id`);

--
-- Ограничения внешнего ключа таблицы `placed_order`
--
ALTER TABLE `placed_order`
  ADD CONSTRAINT `placed_order_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `placed_order_ibfk_2` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`id`);

--
-- Ограничения внешнего ключа таблицы `placed_order_item`
--
ALTER TABLE `placed_order_item`
  ADD CONSTRAINT `placed_order_item_ibfk_1` FOREIGN KEY (`placed_order_id`) REFERENCES `placed_order` (`id`),
  ADD CONSTRAINT `placed_order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`manufacturer_country_id`) REFERENCES `manufacturer_country` (`id`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
