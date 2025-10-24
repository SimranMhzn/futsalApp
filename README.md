# ⚽ Futsal Booking System

A web-based futsal booking and management platform built with **Laravel**, featuring role-based access for **Users**, **Futsal Owners**, and **Admins**.  
Users can easily browse futsals, check available futsals, make bookings, and explore futsal blogs — while futsal owners can manage their profiles and bookings.

---

## 🚀 Features

### 👥 Authentication & Roles
- Separate login and registration for:
  - **Users**
  - **Futsal Owners**
  - **Admins**
- Role-based dashboard redirects and route protection

### 🏟️ Futsal Management
- Futsal owners can register and manage futsal details (name, location, facilities, photos)
- Admins can manage all futsals
- Users can view all registered futsals and book available slots

### 📅 Booking System
- Real-time availability check
- Date restrictions (cannot book past dates)
- Interactive time slot selection (disabled “Book Now” until date/time is chosen)

### 📰 Blog Section
- Admins and futsal owners can post futsal-related blogs
- Users can read detailed futsal blogs

### 👤 Profile Management
- Separate profile pages for Users and Futsal Owners
- Profile update with real-time password validation and image upload

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-------------|
| Backend | Laravel 10+ |
| Frontend | Blade Templates + TailwindCSS + Alpine.js |
| Database | MySQL |
| Authentication | Laravel Auth Guards |
| Deployment | PHP 8.2+, Composer, Nginx/Apache |

---

## ⚙️ Installation

1. Clone the Repository
git clone https://github.com/SimranMhzn/futsalApp
cd futsal-booking-system
2. Install Dependencies
composer install
npm install && npm run dev
3. Environment Setup
cp .env.example .env
php artisan key:generate
Then configure your database credentials inside .env:

env
DB_DATABASE=futsal_db
DB_USERNAME=root
DB_PASSWORD=
4. Run Migrations & Seeders
php artisan migrate --seed
5. Run the Application
php artisan serve
