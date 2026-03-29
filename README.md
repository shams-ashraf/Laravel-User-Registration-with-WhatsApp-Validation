# 🔐 Laravel User Registration with WhatsApp Validation

A scalable backend system built with Laravel for secure user registration, featuring WhatsApp number validation using an external API, email notifications, and rate-limited API endpoints.

---

## ✨ Features

- Secure user authentication and registration system  
- WhatsApp number validation using RapidAPI  
- Automated email notifications for new users  
- API rate limiting for enhanced security (60 requests/min)  
- Clean and modular architecture using services and middleware  
- RESTful API structure for scalability  

---

## 🧠 Technical Highlights

- External API integration (WhatsApp validation via RapidAPI)  
- Laravel Mail system for email handling  
- Middleware-based request control and validation  
- Service layer abstraction for better maintainability  
- Error handling and validation for API responses  

---

## ⚙️ Tech Stack

- Laravel (PHP)  
- MySQL (or any supported database)  
- RapidAPI (WhatsApp Number Validator API)  
- Blade (Frontend templating)  

---

## 📂 Project Structure
├── app/
├── routes/
├── database/
├── resources/
├── config/
├── public/

---

## 🚀 Getting Started

### 1. Clone the repository
git clone https://github.com/shams-ashraf/Laravel-User-Registration-with-WhatsApp-Validation.git

cd Laravel-User-Registration-with-WhatsApp-Validation


### 2. Install dependencies

composer install


### 3. Setup environment

cp .env.example .env
php artisan key:generate


### 4. Configure
- Database connection  
- Mail server (SMTP / Mailgun / etc)  
- RapidAPI key  

---

### 5. Run the application

php artisan serve


---

## 🔌 API Usage

- Registration via web routes  
- API routes protected with rate limiting  
- WhatsApp validation handled through service layer  

---

## 💡 What I Learned

This project helped me build production-like backend systems, integrate external APIs, and design scalable architectures using Laravel.
