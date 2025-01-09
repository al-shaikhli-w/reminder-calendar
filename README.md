# Web Architecture Plan: Reminder Calendar with Laravel


## **1. Architecture Overview**

The application will consist of the following main components:

### **Frontend**:
- User interface for managing reminders (creating, updating, deleting, and viewing) Reminder Calendar.
- Technologies: Blade Templates, TailwindCSS and custom components, JavaScript (with AJAX).

### **Backend**:
- Laravel framework for handling business logic and APIs.
- Features: User authentication, appointment management, email reminders.

### **Database**:
- MySQL to store user data, reminders date, and configurations.

### **Email System**:
- Laravel's built-in **Mailables** for sending reminder emails.
- Scheduled tasks using Laravel Scheduler to automate email reminders.

---

## **2. System Architecture Overview**

```plaintext
User Interface (Browser) 
       |
       v
Routes & Controllers (Laravel)
       |
       v
Models <-> Database (Eloquent ORM)
       |
       v
Scheduler <-> Email Service (Mailables)
```

---

## **3. Detailed Planning**

### **Frontend (Blade Templates + JavaScript)**

1. **Page Structure**:
    - **Login Page**: Form for user login.
    - **Registration Page**: Form for user registration.
    - **Home Page**: Main page with reminders form to add new reminders or edit them and display all your reminders. 

2. **Authentication**:
    - **Login**: Form for user login with email and password.
    - **Registration**: Form for user registration with name, email, and password.

3. **Components**:
    - **Reminder Form**: Inputs for date, title, reminder time (dropdown).
    - **Reminder List**: Dynamically loaded via AJAX.
    - **Navigation Bar**: Links for "Login/Logout".
    - **appointment Component**: Display the appointment date and time and the title.
    - **appointment Modal**: Display the appointment details in a modal when the user try to edit theme.
    - **text-input Component**: Display the input field.
    - **input-error Component**: Display the error message.
    - **button Component**: Display the button.
    - **Logo Component**: Display the logout logo.
4. **layouts**:
    - **app.blade.php**: Main layout file with navigation bar.
    - **guest.blade.php**: Layout for guest users.
    - **auth.blade.php**: Layout for authenticated users.
5. **mails**:
    - **mail-send.blade.php**: Email template for reminder notifications.
    - **send-test-mail.blade.php**: Email template for testing email functionality.

6. **Technologies**:
    - Blade templates for rendering server-side views.
    - TailwindCSS for styling.
    - JavaScript for interactivity and AJAX.

---

### **Backend (Laravel)**

1. **Features**:
    - **Authentication**: User registration, login, and logout using Laravel.
    - **Reminder Management**:
        - CRUD operations for reminders (Create, Read, Update, Delete).
        - Validations for inputs (e.g., dates in the future, valid email format).
    - **Email Reminders**:
        - Scheduled tasks for checking reminders and sending emails with job task.

2. **Architecture**:
    - **Routes**:
        - `web.php` for web-based routes (Blade views).
        - `api.php` for AJAX-based endpoints.
    - **Controllers**:
        - `AuthController` for user authentication.
        - `ReminderController` for managing reminders.
    - **Models**:
        - `User`: For user data.
        - `Appointment`: For Store the Appointment.
    - **jobs**:
        - `SendReminderEmails`: For sending reminder emails.

---

### **Database Design**

1. **Tables**:

#### `users` Table:
| Field         | Type        | Description              |
|---------------|-------------|--------------------------|
| id            | BIGINT (PK) | User ID                 |
| name          | VARCHAR(255)| User's full name        |
| email         | VARCHAR(255)| Unique email address    |
| password      | VARCHAR(255)| Hashed password         |
| created_at    | TIMESTAMP   | Created timestamp       |
| updated_at    | TIMESTAMP   | Last updated timestamp  |

#### `appointment` Table:
| Field          | Type        | Description                         |
|----------------|-------------|-------------------------------------|
| id             | BIGINT (PK) | Reminder ID                        |
| user_id        | BIGINT (FK) | Foreign key to `users` table       |
| title          | VARCHAR(255)| Reminder title                     |
| appointment_date    | DATE        | Date of the event                  |
| reminder_time  | ENUM        | "1 day", "2 days", "1 week", etc.  |
| email          | VARCHAR(255)| Email to send the reminder         |
| created_at     | TIMESTAMP   | Created timestamp                  |
| updated_at     | TIMESTAMP   | Last updated timestamp             |

2. **Database Relationships**:
    - `User` has many `appointment` (1:n).

---

### **Email System**

1. **Mailable Class**:
    - Create a `MailSend` class to define the email content to remind the user about the Appointment.
    - Customize the subject, body, and formatting.

2. **Scheduler**:
    - Use Laravel's Task (Jobs) Scheduling to run a script daily to check for reminders and send emails.

**Command for scheduling:**
```bash
php artisan make:command SendReminderEmails
```

**Example Task Logic in the Command:**
```php
public function handle()
{
    $reminders = Reminder::where('reminder_date', Carbon::today())->get();
    
    foreach ($reminders as $reminder) {
        Mail::to($reminder->email)->send(new ReminderMailable($reminder));
    }
}
```


---

### **Project File Structure**

```plaintext
reminder-calendar/
├── app/
│   ├── Console/
│   │   └── Commands/
│   │       └── SendReminderEmails.php  # Scheduler Command
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AppointmentController.php  # Appointment logic
│   │   │   └── AuthController.php         # Auth logic
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Jobs/
│   │   └── SendReminderEmail.php          # Job for sending reminder emails
│   ├── Mail/
│   │   └── ReminderMail.php               # Email template logic
│   ├── Models/
│   │   ├── Appointment.php                # Appointment model
│   │   └── User.php                       # User model
├── config/
│   ├── app.php
│   ├── mail.php                           # Email configuration
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000000_create_users_table.php
│   │   └── 2024_01_01_000001_create_appointments_table.php
│   ├── seeders/
├── resources/
│   ├── views/
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   └── register.blade.php
│   │   ├── mail/
│   │   │   ├── mail-send.blade.php
│   │   │   └── send-test-mail.blade.php
│   │   └── calendar.blade.php
├── routes/
│   ├── web.php                             # Web routes
│   ├── api.php                             # API routes
├── public/
│   ├── css/
│   ├── js/
└── tests/                                  # Test cases
```

---

### **Deployment Plan**

1. **Local Development**:
    - Set up Laravel with `composer create-project laravel/laravel`.
    - Create `.env` for database and email credentials.
    - Run migrations with `php artisan migrate`.

2. **Deployment**:
    - Use a cloud provider (e.g., AWS, DigitalOcean, Laravel Forge).
    - Set up a web server with PHP, MySQL, and SSL.
    - Deploy the app and configure `cron` for scheduling.

---