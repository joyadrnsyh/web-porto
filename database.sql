CREATE DATABASE IF NOT EXISTS `web_porto`;
USE `web_porto`;

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL, -- Stored as comma-separated string
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed Data (Optional)
INSERT INTO `projects` (`title`, `slug`, `description`, `image`, `tags`, `link`) VALUES
('E-Commerce Dashboard', 'e-commerce-dashboard', 'A comprehensive dashboard for managing online stores, featuring real-time analytics, order management, and inventory tracking.', 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2426&auto=format&fit=crop', 'React, Node.js, Tailwind', '#'),
('Modern Portfolio v1', 'modern-portfolio-v1', 'A sleek, minimalist portfolio website designed for creative professionals to showcase their work.', 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?q=80&w=2555&auto=format&fit=crop', 'HTML, CSS, JavaScript', '#');
