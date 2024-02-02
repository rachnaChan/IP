-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.28-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table library.books: ~9 rows (approximately)
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`id`, `isbn`, `file_name`, `file_path`, `author`, `title`, `image`, `release_year`, `description`, `created_at`, `updated_at`, `user_id`, `categories_type`) VALUES
	(1, '978-0-307-35214-9', '1706063712_Quiet_The_Power_of_Introverts_in_a_World_That_Can\'t_Stop_Talking.pdf', 'uploads/1706063712_Quiet_The_Power_of_Introverts_in_a_World_That_Can\'t_Stop_Talking.pdf', 'Susan Cain', 'Quiet: The Power of Introverts in a World That Can\'t Stop Talking', 'uploads/1706063712_quite.jpg', 2012, 'In Quiet, Susan Cain argues that we dramatically undervalue introverts and shows how much we lose in doing so. She charts the rise of the Extrovert Ideal throughout the twentieth century and explores how deeply it has come to permeate our culture. She also introduces us to successful introverts—from a witty, high-octane public speaker who recharges in solitude after his talks, to a record-breaking salesman who quietly taps into the power of questions. Passionately argued, impeccably researched, and filled with indelible stories of real people, Quiet has the power to permanently change how we see introverts and, equally important, how they see themselves.', '2024-01-24 02:35:12', '2024-01-24 02:35:12', 1, 'GIC'),
	(3, '9780061120084', '1706155780_01_PM_Introduction.pdf', 'uploads/1706155780_01_PM_Introduction.pdf', 'Harper Lee', 'To Kill a Mockingbird', 'uploads/1706156051_kill.jpg', 1969, 'Set in the racially charged Deep South, this classic novel follows young Scout Finch as her father, attorney Atticus Finch, defends an innocent black man accused of raping a white woman. The story explores themes of morality, compassion, and justice.', '2024-01-24 02:40:44', '2024-01-25 04:14:11', 1, 'AMS'),
	(4, '9780451524935', '1706155841_02_PM_Project_phases.pdf', 'uploads/1706155841_02_PM_Project_phases.pdf', 'George Orwel', '1984', 'uploads/1706156102_1984.jpg', 1949, 'This Jazz Age classic unravels the American Dream through the eyes of narrator Nick Carraway, who becomes entangled with the mysterious and wealthy Jay Gatsby. The novel explores themes of love, wealth, and societal expectations.', '2024-01-24 02:42:50', '2024-01-25 04:15:02', 1, 'GTR'),
	(5, '9780316769480', '1706064225_0024-course-material-training.pdf', 'uploads/1706064225_0024-course-material-training.pdf', 'J.D. Salinger', 'The Catcher in the Rye', 'uploads/1706156146_catcher.jpg', 1951, 'Narrated by the unforgettable Holden Caulfield, this novel offers a poignant exploration of teenage angst and the search for authenticity in a world that often feels phony.', '2024-01-24 02:43:45', '2024-01-25 04:15:46', 1, 'GIM'),
	(6, '9780544003415', '1706064303_0024-course-material-training.pdf', 'uploads/1706064303_0024-course-material-training.pdf', 'J.R.R. Tolkien', 'The Lord of the Rings', 'uploads/1706156194_ring.jpg', 1954, 'Tolkien\'s epic fantasy trilogy follows the quest to destroy the One Ring and defeat the dark lord Sauron. Filled with rich world-building and memorable characters, it has become a cornerstone of fantasy literature.', '2024-01-24 02:45:03', '2024-01-25 04:16:34', 1, 'GIC'),
	(7, '9780141439518', '1706064354_0024-course-material-training.pdf', 'uploads/1706064354_0024-course-material-training.pdf', 'Jane Austen', 'Pride and Prejudice', 'uploads/1706156245_pride.jpg', 1813, 'Austen\'s classic explores the complexities of love and social expectations in early 19th-century England. The spirited Elizabeth Bennet navigates societal norms while wrestling with her feelings for the enigmatic Mr. Darcy.', '2024-01-24 02:45:54', '2024-01-25 04:17:25', 1, 'GCA'),
	(8, '9780061120091', '1706064410_0024-course-material-training.pdf', 'uploads/1706064410_0024-course-material-training.pdf', 'Gabriel Garcia Marquez', 'One Hundred Years of Solitude', 'uploads/1706156309_solitude.jpg', 1967, 'Marquez\'s magical realism weaves a multi-generational tale in the fictional town of Macondo. The novel explores the rise and fall of the Buendía family, blending history with myth and fantasy.', '2024-01-24 02:46:50', '2024-01-25 04:18:29', 1, 'OAC'),
	(9, '9780345391803', '1706064469_0024-course-material-training.pdf', 'uploads/1706064469_0024-course-material-training.pdf', 'Douglas Adams', 'The Hitchhiker\'s Guide to the Galaxy', 'uploads/1706156347_hitch.jpg', 1979, 'Adams\' comedic science fiction series follows the misadventures of Arthur Dent, an unwitting Earthman, as he travels through space with an eclectic group of characters, including Ford Prefect and Zaphod Beeblebrox.', '2024-01-24 02:47:49', '2024-01-25 04:19:07', 1, 'GGG'),
	(10, '9780307387899', '1706064525_0024-course-material-training.pdf', 'uploads/1706064525_0024-course-material-training.pdf', 'Cormac McCarthy', 'The Road', 'uploads/1706156381_road.jpg', 2006, 'Adams\' comedic science fiction series follows the misadventures of Arthur Dent, an unwitting Earthman, as he travels through space with an eclectic group of characters, including Ford Prefect and Zaphod Beeblebrox.', '2024-01-24 02:48:45', '2024-01-25 04:19:41', 1, 'GEE');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;

-- Dumping data for table library.events: ~3 rows (approximately)
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` (`id`, `image`, `title`, `created_at`, `updated_at`, `user_event_id`, `start_date`, `end_date`, `description`) VALUES
	(1, 'uploads/1706063311_Green-Event.jpg', 'Blossoming Hope: A Community\'s Effort for a Greener Tomorrow', '2024-01-24 09:30:13', '2024-01-24 09:30:14', 1, '2023-11-11', '2024-01-24', 'In a small town nestled between rolling hills, residents recently rallied around a shared vision of environmental rejuvenation. Organizing a tree-planting initiative titled "Blossoming Hope," the community came together to sow the seeds of positive change. Armed with shovels and a determination to make a difference, families and neighbors united to transform vacant spaces into thriving green havens. The event not only symbolized the town\'s commitment to sustainable living but also fostered a sense of unity and shared responsibility for the planet. As the first buds of newly planted trees began to emerge, so did a renewed sense of optimism for a greener tomorrow in this tight-knit community.'),
	(2, 'uploads/1706063404_event_party.jpg', 'Midnight Revelry: A Night to Remember', '2024-01-24 09:30:15', '2024-01-24 09:30:15', 1, '2023-11-15', '2024-02-24', 'Under the twinkling stars and the glow of string lights, a vibrant night party unfolded, casting a magical ambiance over the venue. With pulsating music setting the rhythm, the dance floor became a lively haven for energetic moves and infectious laughter. Neon decorations illuminated the night, creating an electric atmosphere as friends, and strangers alike, mingled and celebrated. The night was punctuated with delicious bites, signature cocktails, and a sense of freedom that only the cover of darkness can provide. As the DJ spun tunes that echoed through the night, attendees reveled in the moment, creating memories that would linger long after the last song faded away. "Midnight Revelry" proved to be a night to remember, where the hours slipped away unnoticed, leaving behind a trail of joy and camaraderie.'),
	(3, 'uploads/1706063538_book_event.png', 'Whispers of Imagination: A Journey Through Pages', '2024-01-25 10:02:53', '2024-01-25 10:02:54', 1, '2023-11-30', '2024-02-12', 'In the quiet corner of a cozy library, a book eagerly awaited its turn to transport readers into a world of enchantment. Titled "Whispers of Imagination," this literary gem unfolded a tapestry of captivating stories and profound wisdom. As readers delved into its pages, they found themselves carried away on a journey where imagination knew no bounds. The characters came to life, and the vivid landscapes painted by the author\'s words became a playground for the mind. With each turn of the page, a symphony of emotions and ideas danced in harmony, leaving an indelible mark on the reader\'s soul. "Whispers of Imagination" proved to be more than a mere book; it was a gateway to realms unexplored, inviting readers to embark on a timeless voyage of discovery and introspection.');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;

-- Dumping data for table library.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping data for table library.migrations: ~8 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(2, '2019_08_19_000000_create_failed_jobs_table', 1),
	(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(4, '2023_12_16_033741_create_table_roles', 1),
	(5, '2023_12_16_044013_create_table_users', 1),
	(6, '2023_12_17_041937_create_table_rooms', 1),
	(7, '2023_12_17_042112_create_table_books', 1),
	(8, '2023_12_17_042148_create_table_events', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping data for table library.password_reset_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;

-- Dumping data for table library.personal_access_tokens: ~2 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
	(1, 'App\\Models\\User', 1, 'my-token', 'e871bcf421236a0eea0c8986626304794d3a1de6b5b63efeb8c3bc77db6567c0', '["*"]', '2024-01-24 02:48:45', NULL, '2024-01-24 02:24:36', '2024-01-24 02:48:45'),
	(5, 'App\\Models\\User', 1, 'my-token', 'c55967c7d7a1c0f1a6f5b92e224dcda0c6cf73e28104091dae2e65537f3b40ce', '["*"]', '2024-01-25 12:54:18', NULL, '2024-01-25 12:53:10', '2024-01-25 12:54:18');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping data for table library.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `role_name`) VALUES
	(1, 'Admin'),
	(2, 'Staff');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping data for table library.rooms: ~3 rows (approximately)
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` (`id`, `title`, `image`, `description`, `created_at`, `updated_at`, `user_room_id`) VALUES
	(1, 'Room 01', NULL, 'wish to be an integral part of your life!!', '2024-01-24 02:23:08', '2024-01-24 02:23:08', 1),
	(2, 'Room 02', NULL, 'wish to be an integral part of your life!!', '2024-01-24 02:23:08', '2024-01-24 02:23:08', 1),
	(3, 'Room 03', NULL, 'wish to be an integral part of your life!!', '2024-01-24 02:23:08', '2024-01-24 02:23:08', 1);
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;

-- Dumping data for table library.users: ~5 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `first_name`, `last_name`, `gender`, `image`, `dob`, `phone_number`, `bio`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
	(1, 'rachnac', 'rachnac@gmail.com', NULL, '$2y$12$af7X.YMmzww/JsKu2kq1PuvC1VcXwk0h6aGz3ziRzkujrPTBdohuS', 'chan', 'rachna', 'female', 'uploads/ku0f28pZOlmr2isbspOon2ttMDfiVCtNVxBJqdec.jpg', '2002-01-01', '000000', 'wish to be an integral part of your life!!', NULL, '2024-01-24 02:23:07', '2024-01-24 02:25:20', 1),
	(2, 'zaponh', 'zaponh@gmail.com', NULL, '$2y$12$wKZeOlP9qicEC4rSd4b.TuFZeDFtZbEef6hbZlve79W4vci90l.Ya', 'hong', 'zapon', 'female', 'uploads/KvgZr0gdGahREgzSUZIRJB7KYP44YuC4Gj9Go2ir.jpg', '2001-01-01', '000000', 'wish to be an integral part of your life!!', NULL, '2024-01-24 02:23:07', '2024-01-24 02:25:43', 2),
	(3, 'erekal', 'erekal@gmail.com', NULL, '$2y$12$agbgcypZRldnXNxquCzjXeVRD1ik0bsh/TqtjLGVe0xd7eYjsx2Ue', 'lengly', 'ereka', 'female', 'uploads/fpXzJmH1uyfYzZkc0Mxp31BnVu8OmGY7QW27vUtS.jpg', '2002-01-01', '000000', 'wish to be an integral part of your life!!', NULL, '2024-01-24 02:23:08', '2024-01-24 02:26:05', 1),
	(4, 'pocvenh', 'pocvenhl@gmail.com', NULL, '$2y$12$hZybPfDMUFKrwsqxcxgcD.dnPrWm3O7HovGqmSI4XQ1ZYbmccFgre', 'ly', 'pocvenh', 'male', 'uploads/l6qtr0hrdxLFahWtfbeoUdPB5ljIr2Qu0fmLilKq.jpg', '2002-01-01', '000000', 'wish to be an integral part of your life!!', NULL, '2024-01-24 02:23:08', '2024-01-24 02:26:19', 2),
	(5, 'sidanakp', 'sidanakp@gmail.com', NULL, '$2y$12$UFQ5m372xM5BP97GJ0ZwmOrgX9cyOGMt.dudIcvr5kSwfwriUWkRe', 'pov', 'sidanak', 'female', 'uploads/oTaDVolIvomW43oKIcQbjn1YIzPokSDYJUL6bEqA.jpg', '2002-01-01', '000000', 'wish to be an integral part of your life!!', NULL, '2024-01-24 02:23:08', '2024-01-24 02:26:29', 2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
