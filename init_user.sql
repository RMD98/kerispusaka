-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.28 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table dkppp.action_logs
CREATE TABLE IF NOT EXISTS `action_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.action_logs: ~14 rows (approximately)
DELETE FROM `action_logs`;
/*!40000 ALTER TABLE `action_logs` DISABLE KEYS */;
INSERT INTO `action_logs` (`id`, `user_id`, `method`, `url`, `ip_address`, `status`, `keterangan`, `metadata`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'GET', 'http://localhost:8000', '127.0.0.1', '302', 'Request logged', '{"input": [], "headers": {"host": ["localhost:8000"], "accept": ["text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8"], "sec-gpc": ["1"], "sec-ch-ua": ["\\"Brave\\";v=\\"137\\", \\"Chromium\\";v=\\"137\\", \\"Not/A)Brand\\";v=\\"24\\""], "connection": ["keep-alive"], "user-agent": ["Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36"], "cache-control": ["max-age=0"], "sec-fetch-dest": ["document"], "sec-fetch-mode": ["navigate"], "sec-fetch-site": ["none"], "sec-fetch-user": ["?1"], "accept-encoding": ["gzip, deflate, br, zstd"], "accept-language": ["en-US,en;q=0.5"], "sec-ch-ua-mobile": ["?0"], "sec-ch-ua-platform": ["\\"Windows\\""], "upgrade-insecure-requests": ["1"]}}', '2025-06-07 10:37:54', '2025-06-07 10:37:54'),
	(2, NULL, 'GET', 'http://localhost:8000/login', '127.0.0.1', '200', 'Request logged', '{"input": [], "headers": {"host": ["localhost:8000"], "accept": ["text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8"], "cookie": ["XSRF-TOKEN=eyJpdiI6ImFDYkNLMEN3anN3RkFieSsxVFFnOGc9PSIsInZhbHVlIjoiY1VzY3RzbXBEL3B6WWlCWVhlMFhmdUVTenFqUzZQYVI1RUw2KzRyNGJjR1ZmeVdKWUNSZ1VEZ25IdHE3bFhNRHArSzVXOTNCcWprM0tEemV2c2xQODUyM2ppaGZSd1h4QndMNkg4bHlSaElObkpGSlNCYjlPdStjc3pheG9UMlMiLCJtYWMiOiIyNGQyYTU4MjRlMjY3NGNmZWQ5MTNiMTIzMjM2MmQwMjU0NDE2ZjYxMzBlMjQyYmY0YWM5MjQ1MjYyZDc2ZDE5IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6InNDWkg5NGJBamY5MG00SU5KSXZxZHc9PSIsInZhbHVlIjoiS3A0MzZlYjRSNXA3TmEyV1lUZkMwVHZhSGNJT1FsVDh0Yi9GNVo1bGxCMDNYUTJFcXpob0plejR5YTVBR3pDUXV4UllnemdESUw4RXlWbHhqWTF3b2lsMEEzU0c3ZUFPY3ppbWg5Ym5hWHlsbUU4blQ0RTlSNkNaWnFpbEFMTWciLCJtYWMiOiI5Y2RiMTZmNzY0NTU4MmRjMTQyNjFkNjBjOGFiODJmMjU5MDYwZTJkZWUzOGUzNjI5YTBkYTQ1Y2MwNjk5YTRhIiwidGFnIjoiIn0%3D"], "sec-gpc": ["1"], "sec-ch-ua": ["\\"Brave\\";v=\\"137\\", \\"Chromium\\";v=\\"137\\", \\"Not/A)Brand\\";v=\\"24\\""], "connection": ["keep-alive"], "user-agent": ["Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36"], "cache-control": ["max-age=0"], "sec-fetch-dest": ["document"], "sec-fetch-mode": ["navigate"], "sec-fetch-site": ["none"], "sec-fetch-user": ["?1"], "accept-encoding": ["gzip, deflate, br, zstd"], "accept-language": ["en-US,en;q=0.5"], "sec-ch-ua-mobile": ["?0"], "sec-ch-ua-platform": ["\\"Windows\\""], "upgrade-insecure-requests": ["1"]}}', '2025-06-07 10:37:55', '2025-06-07 10:37:55'),
	(3, NULL, 'POST', 'http://localhost:8000/login', '127.0.0.1', '302', 'Request logged', '{"input": {"_token": "967XlIY7F8gWx94PQoBIBluKxoGQDLGgLKJ5rqMI", "password": "admin", "user_name": "admin"}, "headers": {"host": ["localhost:8000"], "accept": ["text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8"], "cookie": ["XSRF-TOKEN=eyJpdiI6IlJGamloZ2RESTB0TGpoVG9wbG5iYmc9PSIsInZhbHVlIjoiV0loWndkMG1KV2psc1ZtMlh1U1YvaDlxdkFYbGJpc0t1TTczM3NKQzVkb21DNjZmbjdaWWhMWHZ4aFdnSTZmTFp2MFVXaHpaSHc4SlpRNld2R0F6ZU5rV1k0RmZJYjl0NzhoQnU1UWJIZDFQR0UrUHpQdHREYy93cDVCS3pOMGQiLCJtYWMiOiI2MmE2OWJmMmQwMmExNWQ0ZTIzZjA1NGU4YTMxNmJhYWIwZjZmM2E5MTk1YWFlMDQwYTI5OWM1N2JkNzdmYzllIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IjV4RkRPN29OamxvakZqZDUyRndFMEE9PSIsInZhbHVlIjoiTGNoNERsZDFjWVhJWDJWZzVJRzVBckdBenhYdXNLRTJteFJNRTJ4cWpsYmVYd3U3WXB5YkVxY0YwaUxSMk00ejNxSFVVck5jSEF4eGplTlJBVjRKdHNlREN5UHhiZFdxZzdXQjlHRXptMmVUU2JJc0FWMjV4K1A2M3d0VVNRWnAiLCJtYWMiOiIzYzg1M2RkNGUwODQ2Y2E5OWRjMWNjZmE5MTU4NjFlZjQ3ZGRhMDgxNTRlM2VhOWMyODAzYzM3ZjExYmE1YTNmIiwidGFnIjoiIn0%3D"], "origin": ["http://localhost:8000"], "referer": ["http://localhost:8000/login"], "sec-gpc": ["1"], "sec-ch-ua": ["\\"Brave\\";v=\\"137\\", \\"Chromium\\";v=\\"137\\", \\"Not/A)Brand\\";v=\\"24\\""], "connection": ["keep-alive"], "user-agent": ["Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36"], "content-type": ["application/x-www-form-urlencoded"], "cache-control": ["max-age=0"], "content-length": ["78"], "sec-fetch-dest": ["document"], "sec-fetch-mode": ["navigate"], "sec-fetch-site": ["same-origin"], "sec-fetch-user": ["?1"], "accept-encoding": ["gzip, deflate, br, zstd"], "accept-language": ["en-US,en;q=0.5"], "sec-ch-ua-mobile": ["?0"], "sec-ch-ua-platform": ["\\"Windows\\""], "upgrade-insecure-requests": ["1"]}}', '2025-06-07 10:38:16', '2025-06-07 10:38:16'),
	(4, NULL, 'GET', 'http://localhost:8000/login', '127.0.0.1', '200', 'Request logged', '{"input": [], "headers": {"host": ["localhost:8000"], "accept": ["text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8"], "cookie": ["XSRF-TOKEN=eyJpdiI6ImpNV3BldUtJeEJ1aG9JUlFVcEJzeUE9PSIsInZhbHVlIjoib1ZWS29PZHVlemptOENFQVl1dmcvWS9TOHdnamhBeXFqMWZaK0tSZlUva0NhVktmR0Fta1Nyb2srdVEvQWF5MkdFMTBycTMra2NYbGE0T0lLNG02VmlUZ3VWY01ybnNyYTNodlhaR0NCUXlwSFQrSXlNcEZ2MEd1RnVaajRFNTMiLCJtYWMiOiIwN2UxOWE2NGE4ZWE0OGVmNmJjN2E4OGE3NjA3OTJiMWQ5NDU0YzdmNzIzNWFhODVlZmVjNjM4YzgyNzYzMjY1IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6Ik9KbEhDQjB5L0ppSklqMiszOEYxUVE9PSIsInZhbHVlIjoiQTlzWDVXM3ZhYTIzY25rK3FiVi9MaDRHMGpMSDFBbmVIUytEWTVDd2FnV1h6UVVtdjhQbUV5YlFhZ0ZBbWFVdWJIU3N0OFBpanBpVzRUUlVwSCt2OG90b3VONWQycmhKK0FuY3crL29BRDlhUkdRUllTcUFWa3BMaVZ4Qk9WRWsiLCJtYWMiOiJjOWZhNmRkNzBmODA5YTFlMDg5Y2U5OWEyOTdmZGM1NGZlMTliYjM0NzE2NWUzNWIzMGM5YTA3YjYyYjE0MTIzIiwidGFnIjoiIn0%3D"], "referer": ["http://localhost:8000/login"], "sec-gpc": ["1"], "sec-ch-ua": ["\\"Brave\\";v=\\"137\\", \\"Chromium\\";v=\\"137\\", \\"Not/A)Brand\\";v=\\"24\\""], "connection": ["keep-alive"], "user-agent": ["Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36"], "cache-control": ["max-age=0"], "sec-fetch-dest": ["document"], "sec-fetch-mode": ["navigate"], "sec-fetch-site": ["same-origin"], "sec-fetch-user": ["?1"], "accept-encoding": ["gzip, deflate, br, zstd"], "accept-language": ["en-US,en;q=0.5"], "sec-ch-ua-mobile": ["?0"], "sec-ch-ua-platform": ["\\"Windows\\""], "upgrade-insecure-requests": ["1"]}}', '2025-06-07 10:38:16', '2025-06-07 10:38:16'),
	(5, '1', 'POST', 'http://localhost:8000/login', '127.0.0.1', '302', 'Request logged', '{"input": {"_token": "967XlIY7F8gWx94PQoBIBluKxoGQDLGgLKJ5rqMI", "password": "password", "user_name": "admin"}, "headers": {"host": ["localhost:8000"], "accept": ["text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8"], "cookie": ["XSRF-TOKEN=eyJpdiI6ImJkbEo5K2pETExzTG0wZWV4QlZhV1E9PSIsInZhbHVlIjoicXZLV3ZzSkdjek5zeU10aTNlZytqNWRKcXBiRFNJRTdkb0xYVWwzMkxweEdQZWhOamwxbWl4MUhtRzNLSDBtV3ZRa1M5anpwYTVQT2pNcVEvaHdsaDJaQ3dHWGJ3TGxJejB1OStUYmZZSHZoMWNWWEhvQk5rWDVOQzMvaDk0UVUiLCJtYWMiOiI3YzY3ZGI2YTE4ZTM1MTJkMWYzM2M3NzU5MjU5MjExY2YyZDFiMThhNDBiMTc0NWJiNWRjOTU5Yzg4ZTlkY2U4IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IjRDWFppVXRWNXdEWVByRXZTYzhSUFE9PSIsInZhbHVlIjoiTzhVWDBsYmNvdGVpdGNoRkhINWhBckc3a2phT3NmWElTanF6SkxCaEs3ZXEwOUlkUFVTdWdYZFRhd0xtZ01hTEdQTk05M2Y4elhHOG52Kzh2all5dnFYNUdEbnBkVU9pZnVWRExqK0JMZ0p1Q2ptNXJ2RjRibXFSVUp2eW0rNVkiLCJtYWMiOiIwYjVlNjBhZDMwMTY0YjI4M2I0ODIyYjhhODI4OTI1NjczMDFjNjkzODFiNzFkNjdjZGMyOTYxN2ZhOTA0MjQxIiwidGFnIjoiIn0%3D"], "origin": ["http://localhost:8000"], "referer": ["http://localhost:8000/login"], "sec-gpc": ["1"], "sec-ch-ua": ["\\"Brave\\";v=\\"137\\", \\"Chromium\\";v=\\"137\\", \\"Not/A)Brand\\";v=\\"24\\""], "connection": ["keep-alive"], "user-agent": ["Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36"], "content-type": ["application/x-www-form-urlencoded"], "cache-control": ["max-age=0"], "content-length": ["81"], "sec-fetch-dest": ["document"], "sec-fetch-mode": ["navigate"], "sec-fetch-site": ["same-origin"], "sec-fetch-user": ["?1"], "accept-encoding": ["gzip, deflate, br, zstd"], "accept-language": ["en-US,en;q=0.5"], "sec-ch-ua-mobile": ["?0"], "sec-ch-ua-platform": ["\\"Windows\\""], "upgrade-insecure-requests": ["1"]}}', '2025-06-07 10:38:38', '2025-06-07 10:38:38'),
	(6, '1', 'GET', 'http://localhost:8000', '127.0.0.1', '200', 'Request logged', '{"input": [], "headers": {"host": ["localhost:8000"], "accept": ["text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8"], "cookie": ["XSRF-TOKEN=eyJpdiI6IklBbEovRUo2VVVNM0xmQ0VYNUxwbUE9PSIsInZhbHVlIjoidUtUNGtNdFlhNDZLVEZZS1lzdlJvdUNPWDNrbWdJdjVRK0VSSUNPQUpnRWE4Zm9Odk9xNHZWbW1SZ0VxdVA2VzV6VnFvYi82QUtqeG1qdHg0Z3EwU3pGL0Ntc3A3UkRtOXYrWkhNZ2ordnNueVAxVnFJRXVMZGlkOWpJZ1kvL1kiLCJtYWMiOiJjMDA1NGYwYjljYjNjZGM5NjAzOTM2MDk0MzNkMTNhM2M4Mzc5ZjAyNThkODVkZmY3MTRiOWVmZTFiYTU2ODE4IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6InpKdG5vZ1h1ZHVqVUZKeG5hNjZBZVE9PSIsInZhbHVlIjoiMG9tMkYyc3R2MTVTZVJzbnJCVjdBVGx5KzNpR29TY0RzSHErWmF6d3ZmdmpUWmovL1JIQTFzQitaaDIzNHNWNFZCOXdhY3FzcnF1YUlqcGIzbmNJSWxaSHJUZFJJQnUzazJmM0dkTWJmNG1KVExWRFpBWkYrY1pGRHVTTE5ySTciLCJtYWMiOiJjODAzNzY5MDNjMzY1MWI1NDk2YmZhODFjMjRjOTk1ODY1ZjFlODU4ZjA0NDBkODg5MGJkN2FmYzFjMTUzMTViIiwidGFnIjoiIn0%3D"], "referer": ["http://localhost:8000/login"], "sec-gpc": ["1"], "sec-ch-ua": ["\\"Brave\\";v=\\"137\\", \\"Chromium\\";v=\\"137\\", \\"Not/A)Brand\\";v=\\"24\\""], "connection": ["keep-alive"], "user-agent": ["Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36"], "cache-control": ["max-age=0"], "sec-fetch-dest": ["document"], "sec-fetch-mode": ["navigate"], "sec-fetch-site": ["same-origin"], "sec-fetch-user": ["?1"], "accept-encoding": ["gzip, deflate, br, zstd"], "accept-language": ["en-US,en;q=0.5"], "sec-ch-ua-mobile": ["?0"], "sec-ch-ua-platform": ["\\"Windows\\""], "upgrade-insecure-requests": ["1"]}}', '2025-06-07 10:38:39', '2025-06-07 10:38:39'),
	(7, '1', 'GET', 'http://localhost:8000/staff', '127.0.0.1', '200', 'Request logged', '{"input": [], "headers": {"host": ["localhost:8000"], "accept": ["text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8"], "cookie": ["XSRF-TOKEN=eyJpdiI6IlZxeUVnQjZEOG9iMUVSblBlSTRrQnc9PSIsInZhbHVlIjoicWlUZnNMSHR6Y2NFNjNXRWNsUjNONGVjNkhxREY5VTNnQ01LUHlTM2dFbmZBVDA4VWRpaTZUTVUyM1cxcUVLeVZ0RWdGME14dGxVOFI5WWlVYzBzYjNVOVU3OVVKVWpGZ0dMRFRyQjMzL2NzRldyaVVjVndPSDBaOS90L0RwbUoiLCJtYWMiOiJiYjU5MWM0NzJmNjc2NTBhOTAyYmU2YTc3NjUyODk0ZjBiNGFjM2U3MmZhZjEwNThiM2Q3MDdlOTkxNmFhMmRlIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6InpDK3VMZUlKOWlCaWdwVnNMZlRobnc9PSIsInZhbHVlIjoiOEw5SVdobWZKM3B6czJZUzBjK3llenQ1dWlKUDBwdmFmNmJmSzFtQlZMQWFLcHZ5Z2NMQUhNUG9rdElIRkQwN0FFd21iRkwxdjd4VzVWU1E5dmdQV25CaWxOYWNmT1R5cmRlayswWHo2SEcvcDE5RW1RVTFCOHNCMWVZVGovcDYiLCJtYWMiOiIwNTIwMzFhZGRmYjA4ZTY0M2M3ZGE2YTk2OTZmMWJlOWZkZmI0ZDZjZTBjYmU4NzA1NDk5MWFmMWU5ODEwZGU3IiwidGFnIjoiIn0%3D"], "referer": ["http://localhost:8000/"], "sec-gpc": ["1"], "sec-ch-ua": ["\\"Brave\\";v=\\"137\\", \\"Chromium\\";v=\\"137\\", \\"Not/A)Brand\\";v=\\"24\\""], "connection": ["keep-alive"], "user-agent": ["Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36"], "sec-fetch-dest": ["document"], "sec-fetch-mode": ["navigate"], "sec-fetch-site": ["same-origin"], "sec-fetch-user": ["?1"], "accept-encoding": ["gzip, deflate, br, zstd"], "accept-language": ["en-US,en;q=0.5"], "sec-ch-ua-mobile": ["?0"], "sec-ch-ua-platform": ["\\"Windows\\""], "upgrade-insecure-requests": ["1"]}}', '2025-06-07 10:39:12', '2025-06-07 10:39:12'),
	(8, '1', 'GET', 'http://localhost:8000/add_staff', '127.0.0.1', '200', 'Request logged', '{"input": [], "headers": {"host": ["localhost:8000"], "accept": ["text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8"], "cookie": ["XSRF-TOKEN=eyJpdiI6IjJ2dk0zSHg1V3ZxRXpLdVdHdlN3K0E9PSIsInZhbHVlIjoiL1F1UmQ2dldDNFR6dGdiSWVaODhtejBla2VZY252NXgrRVoxVHozdkhWaStUZklkOVBhYkNVNzd6dEhGbk5pMlZmQnYyWTRwRXFXZGdRT1grdmNZMTRzV3hnY2RBR2RiRnRpMVZTenkvVXo0NWIrT3B3c1M4QXgycWc5NVZ6blIiLCJtYWMiOiJiZmQ1NjRjY2JmM2EyNTg5OWQxYzU0NWM0NjVkZGMyY2U0ZmE3NTEzZGVkYTFiZjE0MDU3NmI2MDUxNzhhYjIwIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IkdNRVE2bnhHd1VEVzZhaGZwTVN3bEE9PSIsInZhbHVlIjoiUVZ6cjZQOGozd1FNUzgzV2xiTFhTaU44T3NtMHFRTnlFRS9ITmRZUzVYMHl0bENZUElBTnVCU29hcTluTjRQUmVnbytKaVdjdG5SYXZ5WFhGbmw2RnUxb1ZrOEIzc3NIV2t6UERVZUVEaDBydUY3d2FUaU5MSGk5Y0tRNU53czQiLCJtYWMiOiI2YTdlY2QzMWI1MzY4YTczM2E3MDk2YWQyOGU0ZmFhMjliMWMyMjBhNjY0ZmE3OTY4ODgyMDRhNmUwODk5YTcyIiwidGFnIjoiIn0%3D"], "referer": ["http://localhost:8000/staff"], "sec-gpc": ["1"], "sec-ch-ua": ["\\"Brave\\";v=\\"137\\", \\"Chromium\\";v=\\"137\\", \\"Not/A)Brand\\";v=\\"24\\""], "connection": ["keep-alive"], "user-agent": ["Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36"], "sec-fetch-dest": ["document"], "sec-fetch-mode": ["navigate"], "sec-fetch-site": ["same-origin"], "sec-fetch-user": ["?1"], "accept-encoding": ["gzip, deflate, br, zstd"], "accept-language": ["en-US,en;q=0.5"], "sec-ch-ua-mobile": ["?0"], "sec-ch-ua-platform": ["\\"Windows\\""], "upgrade-insecure-requests": ["1"]}}', '2025-06-07 10:39:15', '2025-06-07 10:39:15'),
	(9, '1', 'POST', 'http://localhost:8000/add_staff', '127.0.0.1', '302', 'Request logged', '{"input": {"name": "Charity Wilder", "email": "lajixuxym@mailinator.com", "phone": "089896361811", "_token": "OLqdRKSdVss4ejUxxZkYsiwLCR8N8Z8O1ywzkt4B", "address": "Quidem odit sint non", "jabatan": "dokter", "password": "password", "username": "zinuqiveqo"}, "headers": {"host": ["localhost:8000"], "accept": ["text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8"], "cookie": ["XSRF-TOKEN=eyJpdiI6InhQcHlRRGlxTnVaM1h6WTZVTk1pMFE9PSIsInZhbHVlIjoiVDNhRHAwL2ZKYTZjcnMvaEdMTFlGS2VzMGdld29Md3B1MEpUWG03VWUrTUlEL2VkRmUwTnFhWmhONWlwTFQ1MmhyRlRsd21veGVsb2RtUDNCVERrTnJSLy9IWlQzckxXNytmRlRBYmR5R3hoSzBEeENuSlFsd2dTWW1PdUdnN2wiLCJtYWMiOiIwNTU1ZTYwMjFmOTFkZWMyZjlkN2ZiZWNlY2UxOThmYmE4YWVmMGYxOGI0NDJkYTczYmI2OGQwZmM0YmIzYjk5IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IkQxZm5XQ294WmltUlJvckNuMEhXd2c9PSIsInZhbHVlIjoieEgrQ3NsdHFzbzdlb3BoMFpVOEJlTlEwMldRcDh4Y2tTZ3BsRG1MR2JHODZCMzlycmdxL0szOFp6Y0IvWmllMURNZUsrdE40ckUrUmRDUlZsaXQySTJKemM4ZGhjMU9yKzJuT2RYMEpzemI1ZCtNQnV3TFowV3U0aVdDazdSNTYiLCJtYWMiOiJlNGMwMjgxN2JiN2YxMTUwYmVlYzQ2N2M4YmZmMTcxMjA1NTE2MjBiNDc5ZDQ5MjBiZGY1N2JjYWQ5ZWJmMDk3IiwidGFnIjoiIn0%3D"], "origin": ["http://localhost:8000"], "referer": ["http://localhost:8000/add_staff"], "sec-gpc": ["1"], "sec-ch-ua": ["\\"Brave\\";v=\\"137\\", \\"Chromium\\";v=\\"137\\", \\"Not/A)Brand\\";v=\\"24\\""], "connection": ["keep-alive"], "user-agent": ["Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36"], "content-type": ["application/x-www-form-urlencoded"], "cache-control": ["max-age=0"], "content-length": ["201"], "sec-fetch-dest": ["document"], "sec-fetch-mode": ["navigate"], "sec-fetch-site": ["same-origin"], "sec-fetch-user": ["?1"], "accept-encoding": ["gzip, deflate, br, zstd"], "accept-language": ["en-US,en;q=0.5"], "sec-ch-ua-mobile": ["?0"], "sec-ch-ua-platform": ["\\"Windows\\""], "upgrade-insecure-requests": ["1"]}}', '2025-06-07 10:39:19', '2025-06-07 10:39:19'),
	(10, '1', 'GET', 'http://localhost:8000/staff', '127.0.0.1', '200', 'Request logged', '{"input": [], "headers": {"host": ["localhost:8000"], "accept": ["text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8"], "cookie": ["XSRF-TOKEN=eyJpdiI6Im8zMFlqbk10UmhRNndiemEzUWQ5MlE9PSIsInZhbHVlIjoiTVJDM09qQzNQVk1xSjJvQjRzK3lvK0RMMzZKYTdOcUVtK0V3S2ZPN1VKMzd1NTh1c2RXbUFBeXhkRXVGb0RhNXJJRGhHakJuclBpM3B1N3JHc2V3bXVoVERrWVdUTXJrQW9GTW9OcTZVb0lEN1pvdit2SXVXQmx3WXpxVlU4aEciLCJtYWMiOiJkMmYyMWE4ZWIxYmEyMmVjNjVmN2NiMjJjODBhNWQ0ZmZjOWIxOWYyZjJmNmU4MDM1YjFkNmVjY2Y5M2Q4ZjUzIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IjY0SHIzM0xodHRGMVFISzFTK1llVGc9PSIsInZhbHVlIjoiMCsvdmQ1ZkFkbHNUSVpKOWsrNElEOGVtcG5IQzh4UWF1TDV5QkMrbFYybHViWnJVOXNkQzdIbUJLYjBmZjJiVE85UStpWm1qcjZqVzNCWm9YV3k0N0VLajRSTldTSnNDMmlpSTN3a3Y5bW96VEthckhyRndDQ1lrYmgrNzdCYTIiLCJtYWMiOiIxYWUzMzM3M2VjZWZhNWQ3NDI1Njg2YTA1MzI3ZTlkYWQzYmFhNjJhOWI3MGRjNTM5NTRhZTQwOGI0ZGMwNWQ3IiwidGFnIjoiIn0%3D"], "referer": ["http://localhost:8000/add_staff"], "sec-gpc": ["1"], "sec-ch-ua": ["\\"Brave\\";v=\\"137\\", \\"Chromium\\";v=\\"137\\", \\"Not/A)Brand\\";v=\\"24\\""], "connection": ["keep-alive"], "user-agent": ["Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36"], "cache-control": ["max-age=0"], "sec-fetch-dest": ["document"], "sec-fetch-mode": ["navigate"], "sec-fetch-site": ["same-origin"], "sec-fetch-user": ["?1"], "accept-encoding": ["gzip, deflate, br, zstd"], "accept-language": ["en-US,en;q=0.5"], "sec-ch-ua-mobile": ["?0"], "sec-ch-ua-platform": ["\\"Windows\\""], "upgrade-insecure-requests": ["1"]}}', '2025-06-07 10:39:20', '2025-06-07 10:39:20'),
	(11, NULL, 'GET', 'http://localhost:8000/staff', '127.0.0.1', '302', 'Request logged', '{"input": [], "headers": {"host": ["localhost:8000"], "accept": ["text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8"], "referer": ["http://localhost:8000/add_staff"], "sec-gpc": ["1"], "sec-ch-ua": ["\\"Brave\\";v=\\"137\\", \\"Chromium\\";v=\\"137\\", \\"Not/A)Brand\\";v=\\"24\\""], "connection": ["keep-alive"], "user-agent": ["Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36"], "cache-control": ["max-age=0"], "sec-fetch-dest": ["document"], "sec-fetch-mode": ["navigate"], "sec-fetch-site": ["same-origin"], "sec-fetch-user": ["?1"], "accept-encoding": ["gzip, deflate, br, zstd"], "accept-language": ["en-US,en;q=0.5"], "sec-ch-ua-mobile": ["?0"], "sec-ch-ua-platform": ["\\"Windows\\""], "upgrade-insecure-requests": ["1"]}}', '2025-06-07 13:14:26', '2025-06-07 13:14:26'),
	(12, NULL, 'GET', 'http://localhost:8000/login', '127.0.0.1', '200', 'Request logged', '{"input": [], "headers": {"host": ["localhost:8000"], "accept": ["text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8"], "cookie": ["XSRF-TOKEN=eyJpdiI6Im1UQ29xdDJ2eDd1cmswZWwycndOTlE9PSIsInZhbHVlIjoiUFBkOXVZRzRpYTlvTmd5Z3EzL3pQU3YwQTNiMkxERnRjL1NzVnFIcXprYU9LREdOYmc2L21YVlRxV2hnNUwwYUJLTUNOdFhWclF5VTVjc1ZGeW9FZGthZzNXMDNHVE5qcEdXRS9BVjlGSmdENGJBVVcwUzhEZTc2dzNTSi9XNjIiLCJtYWMiOiJiZmU3ZjM3OWJkMjVjNjJmYjBiZWQxMzcxOWU2MzM1MzMxMWMxNTA2NzYzNWJjNTdmMGM2ODMzN2IxMTBlYWYyIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlNrU3VrZWJuM0I4MVp3REdMb0lRTVE9PSIsInZhbHVlIjoiRFIxMkZTNXJVNEtaUnFQUlVMR1lVTk9VeWxNTGVGTGZwTTNvaUdLc0lHWHdjYklwd0pUUWx4WHZGNEZBbnZ4OExUSkhwTjE4aHdUTXJ4Z0k2Y21IU0x3QWkvdURBZFJETFVzVVpGWFRPaTF1WHoxN0Y0ZmtDZjNNcGtxQ3dHaEQiLCJtYWMiOiJjODI4MTZlN2NkMTlhN2Q2ZGE2YzZmZDgzMzQ0OWQxMjJjOGU3ZDA1MTg0NzNkNjQyMWE1NzFjZjkwN2Y4NzJhIiwidGFnIjoiIn0%3D"], "referer": ["http://localhost:8000/add_staff"], "sec-gpc": ["1"], "sec-ch-ua": ["\\"Brave\\";v=\\"137\\", \\"Chromium\\";v=\\"137\\", \\"Not/A)Brand\\";v=\\"24\\""], "connection": ["keep-alive"], "user-agent": ["Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36"], "cache-control": ["max-age=0"], "sec-fetch-dest": ["document"], "sec-fetch-mode": ["navigate"], "sec-fetch-site": ["same-origin"], "sec-fetch-user": ["?1"], "accept-encoding": ["gzip, deflate, br, zstd"], "accept-language": ["en-US,en;q=0.5"], "sec-ch-ua-mobile": ["?0"], "sec-ch-ua-platform": ["\\"Windows\\""], "upgrade-insecure-requests": ["1"]}}', '2025-06-07 13:14:27', '2025-06-07 13:14:27'),
	(13, '1', 'POST', 'http://localhost:8000/login', '127.0.0.1', '302', 'Request logged', '{"input": {"_token": "2N4lOkwCBbQCDaCgyOkdrBFgAfUBAijp5U3SFl91", "user_name": "admin"}, "headers": {"host": ["localhost:8000"], "accept": ["text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8"], "cookie": ["XSRF-TOKEN=eyJpdiI6IjF5OUt0aG5YSkJEL1FsN2V2V3gzTlE9PSIsInZhbHVlIjoicnFhclRqaEdYNHhmOVQ1b2Q2RHJVdy92Z2gySjhzUHh0clhQTWlMWWFIWitxU1Z3dy9QS2R4UG9ESFRPN2tDcnVmaHUrYkU0djMyNzlDVG5oTURBRFVUQnp6YXUwT1RHWkpjdld4b25kWU9kd0lnR1JzRGlXWHhtekdFaEJkazgiLCJtYWMiOiJmOTdkMTI5MGExZjk5MmIzY2IzZDhlNDdmYzliNzk3ZTZlODlkYTY5YTI0YTAwM2Q2NjU1NDZjY2ZlOWIxYzY4IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6Ilp2eEEyTWVSNHI2UGc2WHFPdks5Ync9PSIsInZhbHVlIjoiZHFzWXNxVEF0a3cvNEQ0WSt5Q0Y2V2hYL09acGVrUzB6aXVhRklQd2xmRnZFVGlCYW9JMEJicTVmcFJZRHdFa3lZNUx1QWQzNDBCc3dVZktTd2tXMThHamxtYXhLMGV0Y2d2TWd4Q1Z6NGZkNnRYSTlwTWU3cmo1VTNsdDdwZFQiLCJtYWMiOiIxNjU1YTEyMmU3NzQ4NTcwOTYzYWZjNzI2ZTg5MjI2NWUzY2EzNjIxMjAwMjZjNzA0YjA1ZTY5ZTVkMTlkMDYxIiwidGFnIjoiIn0%3D"], "origin": ["http://localhost:8000"], "referer": ["http://localhost:8000/login"], "sec-gpc": ["1"], "sec-ch-ua": ["\\"Brave\\";v=\\"137\\", \\"Chromium\\";v=\\"137\\", \\"Not/A)Brand\\";v=\\"24\\""], "connection": ["keep-alive"], "user-agent": ["Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36"], "content-type": ["application/x-www-form-urlencoded"], "cache-control": ["max-age=0"], "content-length": ["81"], "sec-fetch-dest": ["document"], "sec-fetch-mode": ["navigate"], "sec-fetch-site": ["same-origin"], "sec-fetch-user": ["?1"], "accept-encoding": ["gzip, deflate, br, zstd"], "accept-language": ["en-US,en;q=0.5"], "sec-ch-ua-mobile": ["?0"], "sec-ch-ua-platform": ["\\"Windows\\""], "upgrade-insecure-requests": ["1"]}}', '2025-06-07 13:14:38', '2025-06-07 13:14:38'),
	(14, '1', 'GET', 'http://localhost:8000/staff', '127.0.0.1', '200', 'Request logged', '{"input": [], "headers": {"host": ["localhost:8000"], "accept": ["text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8"], "cookie": ["XSRF-TOKEN=eyJpdiI6IktSWG9VZm0rMVVvMjIrVTh4WlVqSnc9PSIsInZhbHVlIjoicHhZbUhIZXdseDFqWldHRUdnNkVocno1WHdnWXRWc1BicnhpczV4cXJBZ0lQMXJmN0U2dVlBMXd3QTkvZDVXL3NpOUZkYnZ4STIrcmxod2lyR2xhdXJCekJHVjl3K1BESzFSWVJSSGk3M3pmeEFLUVNKbThFU3M0YmNHcmI3WkIiLCJtYWMiOiI3ZWM3N2M1NmUxYzA3YzkwZjU1YWMxNzAzMzA3NDIyMTU5YTYwMmMwYTM2Mjg5YjI0NDVhOTdjZTdhMzcwM2ZkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6Imt5YzBWcTY3djVpYjQzeHJjZzdpNnc9PSIsInZhbHVlIjoiOHRsSmZlVW81N2FpaEJQSVFBWlJicDg2bndMcUZxY1hoMlU0bkZjd0c0SHpnV3dZM2duUWs1QzBlSmhONi9CQ0hiMi9tbVQvUXV4bEF4K0lQUjQ0aFJPclhsd3pOSG56NkIzY0xNZDBEcmdxdEw4cmt6akk4UnBvQ3hJVDdnMFAiLCJtYWMiOiIxN2JiNGMxMWEwODdhNWE5Y2MyMGFlYTUzY2I0Njk3OGEyODU5MzFjZmY5OGJmZjk2ZmU4MmNlY2QwODAyYzAxIiwidGFnIjoiIn0%3D"], "referer": ["http://localhost:8000/login"], "sec-gpc": ["1"], "sec-ch-ua": ["\\"Brave\\";v=\\"137\\", \\"Chromium\\";v=\\"137\\", \\"Not/A)Brand\\";v=\\"24\\""], "connection": ["keep-alive"], "user-agent": ["Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36"], "cache-control": ["max-age=0"], "sec-fetch-dest": ["document"], "sec-fetch-mode": ["navigate"], "sec-fetch-site": ["same-origin"], "sec-fetch-user": ["?1"], "accept-encoding": ["gzip, deflate, br, zstd"], "accept-language": ["en-US,en;q=0.5"], "sec-ch-ua-mobile": ["?0"], "sec-ch-ua-platform": ["\\"Windows\\""], "upgrade-insecure-requests": ["1"]}}', '2025-06-07 13:14:39', '2025-06-07 13:14:39'),
	(15, '1', 'GET', 'http://localhost:8000/staff', '127.0.0.1', '200', 'Request logged', '{"input": [], "headers": {"host": ["localhost:8000"], "accept": ["text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8"], "cookie": ["XSRF-TOKEN=eyJpdiI6IllEcmFZUmlVNWIvcjMxcU51T1lXMnc9PSIsInZhbHVlIjoiUjlCQktpbHVLOG1mQ0Y3ekZxUzFCMVdCU290Y1h3dEF1MnRBRmxuMnVJNzRDRklqY1U1RldMd0hrbllibFhJQlJ6WTlOMlEvQk5HNkI2Ykx0R09nVmcyMmJEWXF5bjFsQmF0RTM0YTR2MktNUTlCTG4yY2JLTGFSZnZDUnpVUngiLCJtYWMiOiI2MDg3ODM1ZTdiMTEzMWI4YWMxZjQyYWIyY2RhZGMxOTg2YWM3YjUxODdlNmQ3MDFhMzQ3YzE4MTY1ZWRjNDZiIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImU5VnhzQUttT3kyc1B1M21TRVcyYUE9PSIsInZhbHVlIjoiTDNNNldWdnNOeXNPYmFhN2IvWkhtRmdEZU9paUQwYmZVVzUwalJQMHplSXF0R1hKNEhsdWtoOTY5Tk9XWnFYZGhIenc5WHEwY2hRL2xHSzlOSFZmTmFLMFgzK0VhM3NMU1Z1Y0hlYklYakhVd3dkUldpVmFZbmdhMUJkVnJxL2kiLCJtYWMiOiJmY2M0NTg0NDhmZDU4ZmQ2ZDg3NzA1MmJlNmFhM2UyZWNiMmM2MzQ0OTdiMzUzYzUzMTdhMTk1NTMwNmI1ZWU2IiwidGFnIjoiIn0%3D"], "referer": ["http://localhost:8000/login"], "sec-gpc": ["1"], "sec-ch-ua": ["\\"Brave\\";v=\\"137\\", \\"Chromium\\";v=\\"137\\", \\"Not/A)Brand\\";v=\\"24\\""], "connection": ["keep-alive"], "user-agent": ["Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36"], "cache-control": ["max-age=0"], "sec-fetch-dest": ["document"], "sec-fetch-mode": ["navigate"], "sec-fetch-site": ["same-origin"], "sec-fetch-user": ["?1"], "accept-encoding": ["gzip, deflate, br, zstd"], "accept-language": ["en-US,en;q=0.5"], "sec-ch-ua-mobile": ["?0"], "sec-ch-ua-platform": ["\\"Windows\\""], "upgrade-insecure-requests": ["1"]}}', '2025-06-07 13:18:49', '2025-06-07 13:18:49');
/*!40000 ALTER TABLE `action_logs` ENABLE KEYS */;

-- Dumping structure for table dkppp.betina
CREATE TABLE IF NOT EXISTS `betina` (
  `id_betina` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_peternak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_sapi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ear_tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_betina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.betina: ~2 rows (approximately)
DELETE FROM `betina`;
/*!40000 ALTER TABLE `betina` DISABLE KEYS */;
INSERT INTO `betina` (`id_betina`, `id_peternak`, `nama`, `jenis_sapi`, `ear_tag`, `tanggal_lahir`, `created_at`, `updated_at`) VALUES
	('BETINA-2025-0001', 'PETERNAK-2025-0001', 'Porro et eveniet ve', 'Sit molestiae molest', NULL, '2017-08-11', NULL, NULL),
	('BETINA-2025-0002', 'PETERNAK-2025-0002', 'Sint in ipsa recus', 'Qui ut voluptate dol', NULL, '2019-06-01', NULL, NULL);
/*!40000 ALTER TABLE `betina` ENABLE KEYS */;

-- Dumping structure for table dkppp.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table dkppp.ib
CREATE TABLE IF NOT EXISTS `ib` (
  `id_ib` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kejadian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_staff` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Belum Ada Tindakan',
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_ib`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.ib: ~3 rows (approximately)
DELETE FROM `ib`;
/*!40000 ALTER TABLE `ib` DISABLE KEYS */;
INSERT INTO `ib` (`id_ib`, `id_kejadian`, `id_staff`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
	('IB-2025-0001', 'KEJADIAN-2025-0001', 'STAFF-2025-0001', 'Belum Ada Tindakan', NULL, '2025-03-29 00:00:00', '2025-07-08 23:31:18'),
	('IB-2025-0002', 'KEJADIAN-2025-0003', 'STAFF-2025-0002', 'Belum Ada Tindakan', NULL, '2024-11-29 00:00:00', NULL);
/*!40000 ALTER TABLE `ib` ENABLE KEYS */;

-- Dumping structure for table dkppp.kebuntingan
CREATE TABLE IF NOT EXISTS `kebuntingan` (
  `id_kebuntingan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kejadian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_staff` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Belum Ada Tindakan',
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kebuntingan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.kebuntingan: ~0 rows (approximately)
DELETE FROM `kebuntingan`;
/*!40000 ALTER TABLE `kebuntingan` DISABLE KEYS */;
/*!40000 ALTER TABLE `kebuntingan` ENABLE KEYS */;

-- Dumping structure for table dkppp.kejadian
CREATE TABLE IF NOT EXISTS `kejadian` (
  `id_kejadian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_betina` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pejantan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Belum Ada Tindakan',
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kejadian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.kejadian: ~0 rows (approximately)
DELETE FROM `kejadian`;
/*!40000 ALTER TABLE `kejadian` DISABLE KEYS */;
INSERT INTO `kejadian` (`id_kejadian`, `id_betina`, `id_pejantan`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
	('KEJADIAN-2025-0001', 'BETINA-2025-0001', 'JANTAN-2025-0001', 'Belum Ada Tindakan', NULL, '2021-02-06 00:00:00', '2025-07-08 23:31:18'),
	('KEJADIAN-2025-0002', 'BETINA-2025-0002', 'JANTAN-2025-0001', 'Belum Ada Tindakan', NULL, '2024-11-29 00:00:00', NULL),
	('KEJADIAN-2025-0003', 'BETINA-2025-0002', 'JANTAN-2025-0001', 'Belum Ada Tindakan', NULL, '2024-12-02 00:00:00', '2025-07-08 23:08:51');
/*!40000 ALTER TABLE `kejadian` ENABLE KEYS */;

-- Dumping structure for table dkppp.log
CREATE TABLE IF NOT EXISTS `log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_log` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.log: ~0 rows (approximately)
DELETE FROM `log`;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;

-- Dumping structure for table dkppp.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.migrations: ~14 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2025_05_22_033033_create_staff', 1),
	(6, '2025_05_22_033749_create_peternak', 1),
	(7, '2025_05_22_033833_create_pejantan', 1),
	(8, '2025_05_22_033841_create_betina', 1),
	(9, '2025_05_22_033851_create_kejadian', 1),
	(10, '2025_05_22_033858_create_ib', 1),
	(11, '2025_05_22_033905_create_pkb', 1),
	(12, '2025_05_22_033920_create_kebuntingan', 1),
	(13, '2025_06_05_163802_create_log', 1),
	(14, '2025_06_07_091143_create_action_logs_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table dkppp.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;

-- Dumping structure for table dkppp.pejantan
CREATE TABLE IF NOT EXISTS `pejantan` (
  `id_pejantan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_peternak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_sapi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ear_tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pejantan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.pejantan: ~0 rows (approximately)
DELETE FROM `pejantan`;
/*!40000 ALTER TABLE `pejantan` DISABLE KEYS */;
INSERT INTO `pejantan` (`id_pejantan`, `id_peternak`, `nama`, `jenis_sapi`, `ear_tag`, `tanggal_lahir`, `created_at`, `updated_at`) VALUES
	('JANTAN-2025-0001', 'PETERNAK-2025-0001', 'Minus pariatur Sit', 'Fugiat fugiat id du', NULL, '1995-04-21', NULL, NULL);
/*!40000 ALTER TABLE `pejantan` ENABLE KEYS */;

-- Dumping structure for table dkppp.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table dkppp.peternak
CREATE TABLE IF NOT EXISTS `peternak` (
  `id_peternak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_peternak`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.peternak: ~13 rows (approximately)
DELETE FROM `peternak`;
/*!40000 ALTER TABLE `peternak` DISABLE KEYS */;
INSERT INTO `peternak` (`id_peternak`, `nama`, `alamat`, `email`, `no_hp`, `created_at`, `updated_at`) VALUES
	('PETERNAK-2025-0001', 'Lael Brock', 'Laborum commodo sequ', 'xydu@mailinator.com', '085680919239', NULL, NULL),
	('PETERNAK-2025-0002', 'Jada Clemons', 'Reiciendis tempor es', 'sihunun@mailinator.com', '085127944918', NULL, NULL),
	('PETERNAK-2025-0003', 'Fikri', 'Banjar', 'fikri@gmail.com', '082316861194', NULL, NULL),
	('PETERNAK-2025-0004', 'Suyanto', 'Purwaharja', 'suyanto@gmail.com', '082316715975', NULL, NULL),
	('PETERNAK-2025-0005', 'Yana', 'Langensari', 'yana@gmail.com', '081914585816', NULL, NULL),
	('PETERNAK-2025-0006', 'Sutono', 'Langensari', 'sutono@gmail.com', '082216883127', NULL, NULL),
	('PETERNAK-2025-0007', 'Enceng', 'Balokang', 'enceng@gmail.com', '081221355001', NULL, NULL),
	('PETERNAK-2025-0008', 'Agustinus', 'Dobo', 'agustinus@gmail.com', '085314445725', NULL, NULL),
	('PETERNAK-2025-0009', 'Parno', 'Kujangsari', 'parno@gmail.com', '081312572230', NULL, NULL),
	('PETERNAK-2025-0010', 'Mumu', 'Banjar', 'mumu@gmail.com', '082320301889', NULL, NULL),
	('PETERNAK-2025-0011', 'Semin', 'Mekarharja', 'semin@gmail.com', '082127937279', NULL, NULL),
	('PETERNAK-2025-0012', 'Sohidin', 'Langensari', 'sohidin@gmail.com', '085294979030', NULL, NULL),
	('PETERNAK-2025-0013', 'Salman', 'Rejasari', 'salman@gmail.com', '085223895205', NULL, NULL);
/*!40000 ALTER TABLE `peternak` ENABLE KEYS */;

-- Dumping structure for table dkppp.pkb
CREATE TABLE IF NOT EXISTS `pkb` (
  `id_pkb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kejadian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_staff` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Belum Ada Tindakan',
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pkb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.pkb: ~2 rows (approximately)
DELETE FROM `pkb`;
/*!40000 ALTER TABLE `pkb` DISABLE KEYS */;
INSERT INTO `pkb` (`id_pkb`, `id_kejadian`, `id_staff`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
	('PKB-2025-0001', 'KEJADIAN-2025-0001', 'STAFF-2025-0001', 'Belum Ada Tindakan', NULL, '2024-11-30 00:00:00', NULL),
	('PKB-2025-0002', 'KEJADIAN-2025-0001', 'STAFF-2025-0001', 'Belum Ada Tindakan', NULL, '2024-11-30 00:00:00', NULL);
/*!40000 ALTER TABLE `pkb` ENABLE KEYS */;

-- Dumping structure for table dkppp.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `id_staff` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_staff`),
  UNIQUE KEY `staff_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.staff: ~2 rows (approximately)
DELETE FROM `staff`;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` (`id_staff`, `nama`, `email`, `no_hp`, `jabatan`, `alamat`, `created_at`, `updated_at`) VALUES
	('STAFF-2025-0001', 'Charity Wilder 2', 'lajixuxym@mailinator.com', '089896361811', 'dokter', 'Quidem odit sint non', NULL, NULL),
	('STAFF-2025-0002', 'Carl Williamson 2', 'vusenawe@mailinator.com', '088205496491', 'petugas', 'Aut cillum optio bl', NULL, NULL),
	('STAFF-2025-0003', 'Toto', 'toto@gmail.com', '085223963608', 'petugas', 'Banjar', NULL, NULL);
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;

-- Dumping structure for table dkppp.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_id_user_unique` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.users: ~17 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `user_name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `id_user`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@admin.com', NULL, '$2y$12$kJtgRxyMnwUkscpdS/U9ZeFhRwZ1SsvFizJ9DqskBk3jb9N76haae', 'super admin', NULL, 'admin', NULL, NULL),
	(2, 'zinuqiveqo', 'lajixuxym@mailinator.com', NULL, '$2y$12$8lnH6r6C3gBYGXzb61Q1XeHYlH8fTd0IwNY08fTLWT58nAbGDNanC', 'dokter', NULL, 'STAFF-2025-0001', NULL, NULL),
	(3, 'labymiv', 'xydu@mailinator.com', NULL, '$2y$12$f72Zxn/OX7ve63HVZaPHb.K6YDvppjdpd3aDrxoFZgLfuPEV0kkp.', 'peternak', NULL, 'PETERNAK-2025-0001', NULL, NULL),
	(4, 'bonusumeko', 'vusenawe@mailinator.com', NULL, '$2y$12$fPDOoYkaUCq.ZC2Wy/CCC.SUqcJA08TiUdv8IPYHTCYunmpN/3p4S', 'petugas', NULL, 'STAFF-2025-0002', NULL, NULL),
	(5, 'cudofycyk', 'sihunun@mailinator.com', NULL, '$2y$12$5sL7AP1xCtExT4Dfp8dG5OvvoHsg2HNvArkr76ivC.SGb0CIPVabi', 'peternak', NULL, 'PETERNAK-2025-0002', NULL, NULL),
	(6, 'Fikri', 'fikri@gmail.com', NULL, '$2y$12$Nq/wZAMWTTT1ASkOfD9hW.DNmbmnKFQKsbNYXxCSuTuKNQ0ZT1SSS', 'peternak', NULL, 'PETERNAK-2025-0003', NULL, NULL),
	(7, 'toto', 'toto@gmail.com', NULL, '$2y$12$9DAwpJ1b29VhNiwe8D73fu.1b.3Ox1igFvExKgc5NV.wcu08FJR5y', 'petugas', NULL, 'STAFF-2025-0003', NULL, NULL),
	(8, 'suyanto', 'suyanto@gmail.com', NULL, '$2y$12$4hT7DTKr27hWFqqjQfXR4O0MKC8coSbBAqmoUIdPBQK7bS7njmlxu', 'peternak', NULL, 'PETERNAK-2025-0004', NULL, NULL),
	(9, 'yana', 'yana@gmail.com', NULL, '$2y$12$cY/py7HNj7plaTKLm1/jc.N7K/XtyAirOUw6bF62JUgHZx0.RYvUe', 'peternak', NULL, 'PETERNAK-2025-0005', NULL, NULL),
	(10, 'sutono', 'sutono@gmail.com', NULL, '$2y$12$BqpT1shdEKFWdK9WtEhK9euCddqLu08fpvzEd6lhDTpnyYP729h3G', 'peternak', NULL, 'PETERNAK-2025-0006', NULL, NULL),
	(11, 'enceng', 'enceng@gmail.com', NULL, '$2y$12$WjYip5gXRe3EXK/HtPMTJeOAU7v8JgV5n1.rDiVgh9sc1UlTB3DNO', 'peternak', NULL, 'PETERNAK-2025-0007', NULL, NULL),
	(12, 'agustinus', 'agustinus@gmail.com', NULL, '$2y$12$RVlpH3gh7ROBldp53lla/OfcZLRvv.Non/DbT8aI1cs9tsUXfZmqK', 'peternak', NULL, 'PETERNAK-2025-0008', NULL, NULL),
	(13, 'parno', 'parno@gmail.com', NULL, '$2y$12$60MBuuFORu/wLPeJNM62R.853qrBqtDWI5DgfKxhbJNALwyJnnK9W', 'peternak', NULL, 'PETERNAK-2025-0009', NULL, NULL),
	(14, 'mumu', 'mumu@gmail.com', NULL, '$2y$12$n/AZttbi09uqqkTdtyMXK.HBY7S4M2BVvb4OSMfARQqmUCPKgQp3W', 'peternak', NULL, 'PETERNAK-2025-0010', NULL, NULL),
	(15, 'semin', 'semin@gmail.com', NULL, '$2y$12$S3mem3tQHzGOVjZ7d9DjteCdfeOG1UtBEJnciXWslaNlhIc7AGYHO', 'peternak', NULL, 'PETERNAK-2025-0011', NULL, NULL),
	(16, 'sohidin', 'sohidin@gmail.com', NULL, '$2y$12$fcfmjlpWfO9YnW/SP3WDweZG33FgVXmqKKTxoKwcgLdPY/bp0mZpC', 'peternak', NULL, 'PETERNAK-2025-0012', NULL, NULL),
	(17, 'salman', 'salman@gmail.com', NULL, '$2y$12$RoL6f.e0JUic.rTDldSnY.hyzgPgeJCW0upLSOl7bRjq/h1V9bSo2', 'peternak', NULL, 'PETERNAK-2025-0013', NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
