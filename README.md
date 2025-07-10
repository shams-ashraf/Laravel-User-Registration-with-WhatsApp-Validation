# Laravel User Registration with WhatsApp Validation

![Laravel](https://img.shields.io/badge/Laravel-10.x-red) ![PHP](https://img.shields.io/badge/PHP-8.1+-blue) ![License](https://img.shields.io/badge/license-MIT-green)

A modern Laravel application for user registration with seamless WhatsApp number validation via RapidAPI. This project includes email notifications for new users, rate-limited API routes, and a robust authentication system. Perfect for developers looking to integrate WhatsApp validation and email services into their Laravel projects.

## 🌟 Features
- **User Registration**: Collects user details like full name, username, WhatsApp number, phone number, address, email, and password.
- **WhatsApp Validation**: Validates WhatsApp numbers using the RapidAPI WhatsApp Number Validator API.
- **Email Notifications**: Sends welcome emails to new users with Laravel's Mailable system.
- **API Rate Limiting**: Limits API requests to 60 per minute per user or IP for security.
- **Secure Authentication**: Built with Laravel's authentication middleware and session management.
- **Clean Code Structure**: Organized service providers, middleware, and services for scalability.

## 📋 Prerequisites
- PHP >= 8.1
- Laravel >= 10.x
- Composer
- MySQL or any supported database
- RapidAPI account for WhatsApp Number Validator API
- Configured mail server (e.g., SMTP, Mailgun, or SendGrid)
  
🛠️ Usage

User Registration: Access the registration form via the web routes (routes/web.php) to create a new user. The WhatsApp number is validated using the RapidAPI service.
Email Notifications: New users receive a welcome email via the NewUserRegistered or MyTestEmail Mailable classes.
API Access: API routes (routes/api.php) are protected with a rate limit of 60 requests per minute.
WhatsApp Validation: The WhatsAppValidator service (app/Services/WhatsAppValidator.php) handles phone number validation.
