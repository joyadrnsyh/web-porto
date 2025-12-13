---
description: Steps to deploy the web-porto project to Hostinger
---

1. **Prepare Database**:

   - Log in to your Hostinger hPanel.
   - Go to **Databases** > **MySQL Databases**.
   - Create a new database name, user, and password. Note these down.
   - Click **Enter phpMyAdmin**.
   - Select your new database.
   - Click **Import** and upload the `database.sql` file from your project root.

2. **Upload Files**:

   - Go to **File Manager** in hPanel.
   - Navigate to `public_html`.
   - Upload all files and folders from your `web-porto` directory (excluding `.git`, `data`, and `db_dump.txt` if not needed).
   - Ensure `index.php`, `config.php`, `assets/`, `views/`, etc., are in the root of `public_html` (or a subdirectory if you prefer).

3. **Configure Connection**:

   - Edit the `config.php` file in Hostinger's File Manager.
   - Update the default values in the `define` lines, OR set Environment Variables in Hostinger (if available):
     ```php
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'u123456789_yournamedb'); // Example from Hostinger
     define('DB_USER', 'u123456789_yournameuser');
     define('DB_PASS', 'yourpassword');
     ```

4. **Verify**:
   - Visit your website URL.
   - If images are broken, log in to the admin panel and run the path fixer tools or manually check `BASE_URL` in `config.php`.
