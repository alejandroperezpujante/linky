# linky

A modern web application for managing and sharing links, built with Laravel.

---

## Table of Contents

- [About](#about)
- [Features](#features)
- [Project Structure](#project-structure)
- [Getting Started](#getting-started)
- [Testing](#testing)
- [Contributing](#contributing)
- [License](#license)

---

## About

**linky** is a Laravel-based web application designed to help users manage, organize, and share links efficiently. It provides user authentication, link management, and a user-friendly dashboard.

---

## Features

- User registration, login, and profile management
- Create, edit, and delete links
- Toggle link status (active/inactive)
- Dashboard for managing your links
- Responsive UI with Blade templates
- Database migrations and seeders for easy setup

## Getting Started

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js & npm

### Installation

1. Clone the repository:
   ```bash
   git clone <repo-url>
   cd linky
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install JS dependencies:
   ```bash
   npm install
   ```

4. Copy `.env.example` to `.env` and set your environment variables.

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

7. Start the development server:
   ```bash
   php artisan serve
   ```

---

## Testing

Run the test suite with:

```bash
php artisan test
```

---

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request. For major changes, open an issue first to discuss what you would like to change.

---

## License

This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).
