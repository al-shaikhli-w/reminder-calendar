
# Web Architecture Plan: Reminder Calendar with Laravel
[![Laravel Forge Site Deployment Status](https://img.shields.io/endpoint?url=https%3A%2F%2Fforge.laravel.com%2Fsite-badges%2F111e8296-f885-4bdf-b11c-df7e07cd6c4e%3Fdate%3D1%26label%3D1%26commit%3D1&style=plastic)](https://forge.laravel.com/servers/869973/sites/2564905)

---

## **1. Architecture Overview**

The application will consist of the following main components:

### **Frontend**:
- User interface for managing reminders (creating, updating, deleting, and viewing).
- Technologies: Blade Templates, TailwindCSS (or Bootstrap), JavaScript (with AJAX).

### **Backend**:
- Laravel framework for handling business logic and APIs.
- Features: User authentication, appointment management, email reminders.

### **Database**:
- MySQL to store user data, reminders, and configurations.

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
    - **Home Page**: Introduction to the app with links to the calendar and user authentication.
    - **Calendar Page**: Displays a list of reminders and a form for creating/editing them.
    - **Auth Pages**: Login and registration pages.

2. **Components**:
    - **Reminder Form**: Inputs for date, title, reminder time (dropdown).
    - **Reminder List**: Dynamically loaded via AJAX.
    - **Navigation Bar**: Links for "Home", "Calendar", "Login/Logout".

3. **Technologies**:
    - Blade templates for rendering server-side views.
    - TailwindCSS/Bootstrap for styling.
    - JavaScript for interactivity and AJAX.

---

### **Backend (Laravel)**

1. **Features**:
    - **Authentication**: User registration, login, and logout using Laravel Breeze or Jetstream.
    - **Reminder Management**:
        - CRUD operations for reminders (Create, Read, Update, Delete).
        - Validations for inputs (e.g., dates in the future, valid email format).
    - **Email Reminders**:
        - Scheduled tasks for checking reminders and sending emails.

2. **Architecture**:
    - **Routes**:
        - `web.php` for web-based routes (Blade views).
        - `api.php` for AJAX-based endpoints.
    - **Controllers**:
        - `AuthController` for user authentication.
        - `ReminderController` for managing reminders.
    - **Models**:
        - `User`: For user data.
        - `Reminder`: For storing reminders.

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

#### `reminders` Table:
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
    - `User` has many `Reminders` (1:n).

---

### **Email System**

1. **Mailable Class**:
    - Create a `ReminderMailable` class to define the email content.
    - Customize the subject, body, and formatting.

2. **Scheduler**:
    - Use Laravel's Task Scheduling to run a script daily to check for reminders and send emails.

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

3. **Register the Task**:
    - Add the command to `Kernel.php`:
   ```php
   protected function schedule(Schedule $schedule)
   {
       $schedule->command('reminders:send')->daily();
   }
   ```

---

### **API Endpoints**

#### **Reminder Management**:
1. **Get All Reminders**:
    - **URL**: `/api/reminders`
    - **Method**: `GET`
    - **Response**:
      ```json
      [
        {
          "id": 1,
          "title": "Anniversary",
          "reminder_date": "2024-12-25",
          "reminder_timeframe": "1 week"
        }
      ]
      ```

2. **Create Reminder**:
    - **URL**: `/api/reminders`
    - **Method**: `POST`
    - **Request**:
      ```json
      {
        "title": "Anniversary",
        "reminder_date": "2024-12-25",
        "reminder_timeframe": "1 week"
      }
      ```
    - **Response**:
      ```json
      { "message": "Reminder created successfully!" }
      ```

3. **Delete Reminder**:
    - **URL**: `/api/reminders/{id}`
    - **Method**: `DELETE`
    - **Response**:
      ```json
      { "message": "Reminder deleted successfully!" }
      ```

---

### **Project File Structure**

```plaintext
reminder-app/
├── app/
│   ├── Console/Commands/SendReminderEmails.php  # Scheduler Command
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── ReminderController.php          # Reminder logic
│   │   │   └── AuthController.php              # Auth logic
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   │   ├── User.php                            # User model
│   │   └── Reminder.php                        # Reminder model
│   ├── Mail/
│   │   └── ReminderMailable.php                # Email template logic
├── config/
│   ├── app.php
│   ├── mail.php                                # Email configuration
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000000_create_users_table.php
│   │   └── 2024_01_01_000001_create_reminders_table.php
│   ├── seeders/
├── resources/
│   ├── views/
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   └── register.blade.php
│   │   └── calendar.blade.php
├── routes/
│   ├── web.php                                 # Web routes
│   ├── api.php                                 # API routes
├── public/
│   ├── css/
│   ├── js/
└── tests/                                      # Test cases
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

### **Next Steps**
Would you like a sample implementation for one of the components (e.g., migration, controller, or email)?
