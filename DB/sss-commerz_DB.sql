

CREATE TABLE `payment_information` (
  `id` int(11) NOT NULL,
  `user_identification` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_mobile` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `amount` float DEFAULT NULL,
  `ssl_payment_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'provided by ssl after successful payment',
  `card_type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=unpaid; 1=paid',
  `payment_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `payment_setup` (
  `id` int(11) NOT NULL,
  `store_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `store_password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `api_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `payment_setup` (`id`, `store_id`, `store_password`, `currency`, `api_address`) VALUES
(1, 'XXXXXXX', 'XXXXX@XX', 'BDT', 'https://sandbox.sslcommerz.com/gwprocess/v3/api.php');

ALTER TABLE `payment_information`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `payment_setup`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `payment_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

ALTER TABLE `payment_setup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
