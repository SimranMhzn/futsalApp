<img width="1920" height="937" alt="image" src="https://github.com/user-attachments/assets/fcfbfddd-f1ee-45dd-bdeb-0ddef261a8ca" /># ⚽ Futsal Booking System

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

## Snapshots
1. Login page
    1.1. User <img width="1920" height="937" alt="image" src="https://github.com/user-attachments/assets/b82b83b5-3a87-4c22-a562-2641e733da26" />
    1.2. Futsal Owner <img width="1920" height="937" alt="image" src="https://github.com/user-attachments/assets/5b5469aa-ed84-47c9-8a6b-44e4cf30cdb5" />
    1.3. Admin <img width="1920" height="937" alt="image" src="https://github.com/user-attachments/assets/1c8c3970-b6b8-4010-9034-90a842ceb07b" />
2. Register page
   2.1. Register as user <img width="1920" height="1057" alt="image" src="https://github.com/user-attachments/assets/4cb12e01-6c1d-45f0-b201-ff05e4d606f0" />
   2.2. Register as futsal <img width="1920" height="2082" alt="image" src="https://github.com/user-attachments/assets/08a78a4a-526a-4412-927a-45a9ec2365b4" />
3. Admin futsal authentication
   <img width="1920" height="1003" alt="image" src="https://github.com/user-attachments/assets/e54ecc37-876c-4686-b708-c4500d49cf6b" />
   <img width="1920" height="1393" alt="image" src="https://github.com/user-attachments/assets/3addd3fa-e0ca-4146-8520-da5de1b60781" />
4. User futsal booking
   <img width="1920" height="1487" alt="image" src="https://github.com/user-attachments/assets/11de4952-1237-4b53-829e-20f47cc00ef2" />
   <img width="1920" height="1404" alt="image" src="https://github.com/user-attachments/assets/89ccf192-2f79-4845-8c64-3eace838d6a4" />
   <img width="1920" height="1003" alt="image" src="https://github.com/user-attachments/assets/76317411-c0eb-415c-86c9-6c58cb57925d" />
   <img width="1920" height="1003" alt="image" src="https://github.com/user-attachments/assets/b2c53018-5173-4168-b61e-d9bf5805135f" />
5. Guest views 
    <img width="1920" height="2861" alt="image" src="https://github.com/user-attachments/assets/328b71c2-aa10-44c9-b8fa-1808e5472d56" />
6. Profile
   <img width="1920" height="1003" alt="image" src="https://github.com/user-attachments/assets/782d18f6-f250-421a-a827-7f8b5780d77a" />
   <img width="1920" height="1417" alt="image" src="https://github.com/user-attachments/assets/002fd7a1-48da-4f51-ae36-a7f08e867e6c" />


