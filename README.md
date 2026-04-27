# PHP JSON DB Manager 🗄️

![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-%23777BB4?style=flat-square&logo=php)
![License](https://img.shields.io/github/license/RanaAhmar/php-json-db-manager?style=flat-square)
![Size](https://img.shields.io/badge/Size-%3C10KB-brightgreen?style=flat-square)
![Dependencies](https://img.shields.io/badge/Dependencies-0-success?style=flat-square)

**A lightweight, zero-dependency PHP class to use JSON files as a robust NoSQL database.**

Need a simple database but don't want the overhead of setting up MySQL/PostgreSQL? `php-json-db-manager` turns any simple JSON file into a fully queryable NoSQL database with strict error handling, built-in lock mechanisms for concurrency, and a fluent query interface.

## 🌟 Key Features

- **Zero Configuration**: Just point it to a `.json` file and start querying.
- **Fluent API**: Chainable methods for intuitive data manipulation (`where()`, `insert()`, `update()`, etc.).
- **Concurrency Safe**: Utilizes `flock()` under the hood to ensure safe read/writes during simultaneous requests.
- **Incredibly Fast**: Entirely loaded into memory for lightning-fast reads on small to medium datasets.

## 📚 Table of Contents

- [Installation](#-installation)
- [Quick Start](#-quick-start)
- [Query API](#-query-api)
- [License](#-license)

## 📦 Installation

Include via Composer (if published) or drop the class directly into your project.

```bash
composer require ranaahmar/php-json-db-manager
```
*(Or simply copy `src/JsonDB.php` into your `/lib` folder).*

## 🚀 Quick Start

```php
require 'vendor/autoload.php';
// Or include directly: require 'src/JsonDB.php';

use Ahmar\Database\JsonDB;

// Initialize it (will create 'users.json' if it does not exist)
$db = new JsonDB('users.json');

// 1. Insert Data
$db->insert([
    'id' => 1,
    'name' => 'Ahmar Hussain',
    'role' => 'admin'
]);

// 2. Fetch Data
$users = $db->all();
echo json_encode($users);
```

## 🔍 Query API

### `find(string $key, $value)`
Retrieve items where a specific key matches a value.
```php
$admins = $db->find('role', 'admin');
```

### `update(string $key, $value, array $newData)`
Finds records matching `$key = $value` and merges `$newData` into those records.
```php
$db->update('id', 1, [
    'role' => 'superadmin'
]);
```

### `delete(string $key, $value)`
Deletes records that match the criteria.
```php
$db->delete('id', 1);
```

### `truncate()`
Wipes the entire database back to an empty array.
```php
$db->truncate();
```

## 🤝 Contributing
Contributions, issues, and feature requests are welcome!

## 📄 License
This project is MIT licensed. See `LICENSE`.









---

## 🚀 Discover More from Stackaura

If you found this tool useful, check out our other high-performance web utilities and follow **Ahmar Hussain** for more open-source excellence.

### 🌟 Featured Projects
- **[Stackaura Hub](https://github.com/RanaAhmar/stackaura-hub)** - The central index for all 100 repositories.
- **[Free LLM APIs](https://github.com/RanaAhmar/free-llm-apis)** - A curated list of zero-cost AI endpoints.
- **[Awesome MCP Servers](https://github.com/RanaAhmar/awesome-mcp-servers)** - The ultimate collection of Model Context Protocol implementations.
- **[System Design Cheatsheet](https://github.com/RanaAhmar/system-design-cheatsheet)** - Master complex architectures in minutes.
- **[Next.js SaaS Starter](https://github.com/RanaAhmar/nextjs-saas-starter)** - The fastest way to launch your next product.

### 🔗 Stay Connected
- **Website:** [stackaura.com](https://www.stackaura.com/)
- **LinkedIn:** [Ahmar Hussain](https://www.linkedin.com/in/ahmar204/)
- **Facebook:** [Ahmar Hussain](https://www.facebook.com/Ahmar204)
- **GitHub:** [@RanaAhmar](https://github.com/RanaAhmar)

---








---
### 🌟 Part of the [Stackaura](https://github.com/RanaAhmar) Ecosystem
*Empowering developers with automated tools and high-performance solutions.*

**Explore more:**
- 🚀 [All Projects](https://github.com/RanaAhmar?tab=repositories)
- 🛠️ [Daily Coding Tips](https://github.com/RanaAhmar/daily-coding-tips)
- 📊 [Profile Dashboard](https://github.com/RanaAhmar/RanaAhmar)

*If you find this project useful, please consider giving it a star! ⭐*


---
### 🌟 Part of the [Stackaura](https://github.com/RanaAhmar) Ecosystem
*Empowering developers with automated tools and high-performance solutions.*

**Explore more:**
- 🚀 [All Projects](https://github.com/RanaAhmar?tab=repositories)
- 🛠️ [Daily Coding Tips](https://github.com/RanaAhmar/daily-coding-tips)
- 📊 [Profile Dashboard](https://github.com/RanaAhmar/RanaAhmar)

*If you find this project useful, please consider giving it a star! ⭐*
