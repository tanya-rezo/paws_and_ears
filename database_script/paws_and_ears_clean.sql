SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- База данных: `paws_and_ears`
-- --------------------------------------------------------
-- Структура таблицы `brand`
CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
-- Структура таблицы `category`
CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `url_name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `pet_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы `category`
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
-- Структура таблицы `client`
CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
-- Структура таблицы `manufacturer_country`
CREATE TABLE `manufacturer_country` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
-- Структура таблицы `order_status`
CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы `order_status`
INSERT INTO `order_status` (`id`, `name`, `message`) VALUES
(1, 'Оформлен', 'Ваш заказ принят. В ближайшее время с Вами свяжется оператор для подтверждения заказа.'),
(2, 'Подтверждён', 'Ваш заказ подтвержден. Мы приступили к его сборке на складе.'),
(3, 'Собран на складе', 'Ваш заказ собран на складе. В ближайшее время мы передадим его в доставку.'),
(4, 'Передан в доставку', 'Ваш заказ передан в службу доставки. Ожидайте звонка курьера.'),
(5, 'Завершён', 'Ваш заказ завершён. Спасибо, что выбрали нас!'),
(6, 'Отменён', 'Ваш заказ отменён.');
-- --------------------------------------------------------
-- Структура таблицы `pet_type`
CREATE TABLE `pet_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sale_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы `pet_type`
INSERT INTO `pet_type` (`id`, `name`, `sale_name`) VALUES
(1, 'Для кошек', 'Акции для кошек'),
(2, 'Для собак', 'Акции для собак');
-- --------------------------------------------------------
-- Структура таблицы `placed_order`
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
-- Структура таблицы `placed_order_item`
CREATE TABLE `placed_order_item` (
  `placed_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cost_per_item` decimal(11,0) NOT NULL,
  `discount_per_item` decimal(11,0) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
-- Структура таблицы `product`
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
-- --------------------------------------------------------
-- Структура таблицы `role`
CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы `role`
INSERT INTO `role` (`id`, `name`, `description`) VALUES
(1, 'Администратор', 'Неограниченный доступ ко всем данным в административной панели.'),
(2, 'Менеджер склада', 'Доступ ко всем данным в административной панели, кроме раздела Пользователи.'),
(3, 'Менеджер по продажам', 'Доступ ко всем данным в административной панели, кроме раздела Пользователи.'),
(4, 'Оператор', 'Доступ только к разделам Заказы и Клиенты в административной панели.');
-- --------------------------------------------------------
-- Структура таблицы `user`
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы `user`
INSERT INTO `user` (`id`, `login`, `password`, `role_id`) VALUES
(1, 'admin', '$2y$10$P.vWu8TB5l9z8R0laTjRCORjoq91VLz2Zlj2dmxmpxCB7MxCuc/j2', 1);
-- --------------------------------------------------------
-- Индексы сохранённых таблиц

-- Индексы таблицы `brand`
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

-- Индексы таблицы `category`
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_type_id` (`pet_type_id`);

-- Индексы таблицы `client`
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

-- Индексы таблицы `manufacturer_country`
ALTER TABLE `manufacturer_country`
  ADD PRIMARY KEY (`id`);

-- Индексы таблицы `order_status`
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

-- Индексы таблицы `pet_type`
ALTER TABLE `pet_type`
  ADD PRIMARY KEY (`id`);

-- Индексы таблицы `placed_order`
ALTER TABLE `placed_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `order_status_id` (`order_status_id`) USING BTREE;

-- Индексы таблицы `placed_order_item`
ALTER TABLE `placed_order_item`
  ADD PRIMARY KEY (`product_id`,`placed_order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `placed_order_id` (`placed_order_id`);

-- Индексы таблицы `product`
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `manufacturer_country_id` (`manufacturer_country_id`);

-- Индексы таблицы `role`
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

-- Индексы таблицы `user`
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

-- --------------------------------------------------------
-- AUTO_INCREMENT для сохранённых таблиц

-- AUTO_INCREMENT для таблицы `brand`
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT для таблицы `category`
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

-- AUTO_INCREMENT для таблицы `client`
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT для таблицы `manufacturer_country`
ALTER TABLE `manufacturer_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT для таблицы `order_status`
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

-- AUTO_INCREMENT для таблицы `pet_type`
ALTER TABLE `pet_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- AUTO_INCREMENT для таблицы `placed_order`
ALTER TABLE `placed_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT для таблицы `product`
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT для таблицы `role`
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

-- AUTO_INCREMENT для таблицы `user`
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- --------------------------------------------------------
-- Ограничения внешнего ключа сохраненных таблиц

-- Ограничения внешнего ключа таблицы `category`
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`pet_type_id`) REFERENCES `pet_type` (`id`);

-- Ограничения внешнего ключа таблицы `placed_order`
ALTER TABLE `placed_order`
  ADD CONSTRAINT `placed_order_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `placed_order_ibfk_2` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`id`);

-- Ограничения внешнего ключа таблицы `placed_order_item`
ALTER TABLE `placed_order_item`
  ADD CONSTRAINT `placed_order_item_ibfk_1` FOREIGN KEY (`placed_order_id`) REFERENCES `placed_order` (`id`),
  ADD CONSTRAINT `placed_order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

-- Ограничения внешнего ключа таблицы `product`
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`manufacturer_country_id`) REFERENCES `manufacturer_country` (`id`);

-- Ограничения внешнего ключа таблицы `user`
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;