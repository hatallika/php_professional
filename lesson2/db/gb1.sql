-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Окт 18 2021 г., 00:24
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gb1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `quantity` int UNSIGNED NOT NULL DEFAULT '1',
  `fixed_price` decimal(10,0) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `session_id`, `quantity`, `fixed_price`) VALUES
(65, 1, 'm9ga0rqd2odm3e68jshgrkld1c1cur31', 2, '150'),
(66, 2, 'm9ga0rqd2odm3e68jshgrkld1c1cur31', 2, '200'),
(67, 3, 'm9ga0rqd2odm3e68jshgrkld1c1cur31', 2, '100'),
(68, 2, 'u8uvad3cbdlib621oavh20stv59hnlmj', 3, '200'),
(69, 1, 'v25th8588lteko8uh1bmsohv6sjoi2ln', 3, '100'),
(70, 2, 'v25th8588lteko8uh1bmsohv6sjoi2ln', 3, '150'),
(71, 2, 'kv7i357p4lpmdm38gtklrdeha48o7r9j', 1, '150'),
(72, 3, 'kv7i357p4lpmdm38gtklrdeha48o7r9j', 2, '100'),
(73, 1, 'at6vnkp5ns4so76o75lk19dktg7dsagd', 3, '200'),
(74, 3, 'at6vnkp5ns4so76o75lk19dktg7dsagd', 2, '250'),
(75, 1, 'khiopfrkurn10duv9g558vpi6q8ip7i8', 4, '200');

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `feedback` text NOT NULL,
  `product_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `feedback`, `product_id`) VALUES
(333, 'Сергей', 'Отличный магазин!', 0),
(335, 'Марта Бэкк', 'Привет', 0),
(343, 'Светлана', 'Очень вкусный кофе', 3),
(366, 'Наталья', 'Вкусная Пицца', 1),
(369, 'Светлана', 'Рекомендую!', 2),
(374, 'Светлана', 'Привет', 0),
(380, 'Наталья', 'Очень вкусная!', 1),
(404, 'Сергей', 'Еще одну пиццу, пожалуйста!', 1),
(407, 'Сергей', 'Классный магазин!', 0),
(408, 'Сергей+', 'А я люблю с грибами!', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` int UNSIGNED NOT NULL,
  `views` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `name`, `size`, `views`) VALUES
(22, '01.jpg', 111456, 3),
(23, '02.jpg', 70076, 10),
(24, '03.jpg', 70215, 0),
(25, '04.jpg', 61733, 0),
(26, '05.jpg', 160617, 0),
(27, '06.jpg', 89871, 0),
(28, '07.jpg', 99418, 0),
(30, '08.jpg', 103775, 0),
(31, '09.jpg', 81022, 6),
(32, '10.jpg', 97127, 0),
(33, '11.jpg', 98579, 0),
(35, '12.jpg', 139286, 0),
(36, '13.jpg', 113016, 20),
(37, '14.jpg', 151814, 0),
(38, '15.jpg', 112488, 4),
(48, '37ab2e826a9cda48b13ec2daa6852a10.jpg', 43825, 1),
(49, '117494b0ac53a9d09eabd8c59da47819.jpg', 133560, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `likes` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `text`, `likes`) VALUES
(1, 'В Ростовской области стартовал финал конкурса \"Учитель года России\"', 'Финал всероссийского конкурса \"Учитель года России\" стартовал в Ростовской области, сообщает правительство региона.\r\n\"Губернатор Ростовской области Василий Голубев поприветствовал участников финала всероссийского конкурса \"Учитель года России\" 2021 года\", - говорится в сообщении.\r\nПроведение в Ростове-на-Дону главного для педагогов профессионального конкурса страны стало возможно благодаря победе ростовского учителя Михаила Гурова в минувшем году.', 0),
(2, 'Звезда советского кино пожаловалась на низкую пенсию', 'МОСКВА, 26 сентября/ Радио Sputnik.Советскую и российскую актрису Елену Проклову не устраивает размер пенсии. Несмотря на все регалии, артистка получает 18 тысяч рублей, передает Life.\r\nВ разговоре с порталом Day.ru Проклова отметила, что о накоплениях на старость надо было думать раньше. Сейчас актриса надеется, что поддержки от государства ей хватит.', 1),
(5, 'Путин определил глав профильных комиссий \"Единой России\"', 'МОСКВА, 27 сен — РИА Новости. Президент Владимир Путин поздравил \"пятерку\" списка \"Единой России\" с убедительной победой на выборах в Госдуму и распределил между ними внутрипартийные должности.\r\n\"Хочу <...> поблагодарить именно как лидеров предвыборного списка партии за достойный результат избирательной кампании\", — сказал глава государства на встрече, добавив, что это отражает высокий уровень доверия и к самой партии, и к ее конкретным делам.', 0),
(6, 'Организатор восхождения на Эльбрус написал явку с повинной', 'МОСКВА, 27 сен — РИА Новости. Организатор восхождения на Эльбрус, во время которого погибли альпинисты, написал явку с повинной и дал признательные показания, сообщил СК.\r\nСледствие будет ходатайствовать о его аресте.\r\nУчения МЧС в Приэльбрусье - РИА Новости, 1920, 26.09.2021\r\nВчера, 17:31\r\nТела трех альпинистов спустили с Эльбруса на высоту 5100 метров\r\nНа прошлой неделе на Эльбрусе на высоте 5,4 тысячи метров группа из 19 альпинистов из-за ухудшения погодных условий попросила о помощи. Спасти удалось только 14 из них, 11 пострадавших доставили в республиканскую клиническую больницу в Нальчике, семерых позже выписали.', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int UNSIGNED NOT NULL,
  `cart_session_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `status` enum('processing','complete','cancel','waiting') NOT NULL DEFAULT 'processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `cart_session_id`, `name`, `phone`, `user_id`, `status`) VALUES
(30, 'm9ga0rqd2odm3e68jshgrkld1c1cur31', 'Сергей', '222243454543', 1, 'waiting'),
(31, 'u8uvad3cbdlib621oavh20stv59hnlmj', 'Сергей', '3242424242424', 1, 'processing'),
(32, 'v25th8588lteko8uh1bmsohv6sjoi2ln', 'Светлана', '232323232', 2, 'cancel'),
(33, 'kv7i357p4lpmdm38gtklrdeha48o7r9j', 'Гость Сергей', '3433423432', NULL, 'complete');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `likes` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Товары';

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `likes`) VALUES
(1, 'Пицца', 'С сыром и грибами', '200.00', 'pizza.jpg', 10),
(2, 'Чай', 'Цейлонский чай', '70.00', 'tea.png', 6),
(3, 'Кофе', 'Кофе молотый', '250.00', 'coffee.png', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `hash`) VALUES
(1, 'admin', '$2y$10$DXOQvi165r4Oct..djxupuxzhwwTkxURsBUgj05uEfzTFziMhEXuK', '26755861561635e832b1ce6.97478761'),
(2, 'user', '$2y$10$uVZXli9r1hxsmxv5qGdcNuPcKNmF3tFNVxzHFyJFgkdpcozuFTXf.', '89412248615a1d955e2887.37449076');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=409;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
