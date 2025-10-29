# TicketApp - Twig PHP Implementation

A complete, production-ready ticket management system built with PHP, Twig templating engine, and modern web technologies. Features user authentication, full CRUD operations, and a beautiful responsive interface.

## Live Demo

**Live Application:** [Live App](https://ticket-app-twig-hng.onrender.com/)  
**Demo Credentials:**
- Email: `demo@ticketapp.com`
- Password: `password`

## Related Repositories

| Framework       | Repo Link                                                                                 |
| --------------- | ----------------------------------------------------------------------------------------- |
| Root Repo    | [hng-stage2-ticketapp-root](https://github.com/Goodluckodalonu/hng-stage2-ticketapp-root) |
| Vue Version  | [hng-stage2-ticketapp-vue](https://github.com/Goodluckodalonu/hng-stage2-ticketapp-vue)   |
| React | [hng-stage2-ticketapp-react](https://github.com/Goodluckodalonu/hng-stage2-ticketapp-react) |


## Features

### Authentication & Security
- **User Registration & Login** - Secure account creation and authentication
- **Session Management** - Persistent login sessions with proper security
- **User Isolation** - Each user can only access their own tickets and data
- **Protected Routes** - Automatic redirect to login for unauthorized access
- **Form Validation** - Client and server-side validation

### Ticket Management (Full CRUD)
- **Create Tickets** - Add new tickets with title, status, and description
- **Read Tickets** - View all tickets in a beautiful card-based layout
- **Update Tickets** - Edit existing tickets with inline form
- **Delete Tickets** - Remove tickets with confirmation dialog
- **Real-time Validation** - Form validation with user-friendly error messages

### Dashboard & Analytics
- **Summary Statistics** - Total, Open, In Progress, and Closed ticket counts
- **Visual Indicators** - Color-coded status badges and statistics
- **Personalized Welcome** - User-specific dashboard with name greeting

### User Experience
- **Responsive Design** - Works perfectly on desktop, tablet, and mobile
- **Toast Notifications** - Real-time feedback for all user actions
- **Wave Background** - Beautiful SVG wave design in hero section
- **Modern UI/UX** - Clean, intuitive interface with smooth animations
- **Accessibility** - Semantic HTML and proper focus states

## Technology Stack

- **Backend**: PHP 8.0+, Custom MVC Architecture
- **Templating**: Twig 3.0+ for secure, maintainable templates
- **Frontend**: Vanilla JavaScript, HTML5, CSS3
- **Styling**: CSS Grid, Flexbox, CSS Custom Properties
- **Icons**: Font Awesome 6.4.0
- **Data Storage**: JSON files (easily upgradable to database)
- **Authentication**: Session-based with security best practices

## Project Structure

```
ticketapp-twig/
├── index.php                 # Main application router
├── .htaccess                # URL rewriting rules
├── composer.json            # PHP dependencies
├── README.md               # This file
│
├── config/                 # Configuration files
│   ├── config.php         # Application configuration
│   └── helpers.php        # Utility functions
│
├── controllers/            # PHP controllers (MVC)
│   ├── BaseController.php # Base controller class
│   ├── AuthController.php # Authentication logic
│   ├── DashboardController.php # Dashboard logic
│   └── TicketController.php # Ticket CRUD operations
│
├── templates/              # Twig templates
│   ├── base.twig          # Base template layout
│   ├── landing.twig       # Landing page
│   ├── login.twig         # Login form
│   ├── signup.twig        # Registration form
│   ├── dashboard.twig     # Dashboard with statistics
│   ├── tickets.twig       # Ticket management interface
│   └── components/        # Reusable components
│       ├── header.twig    # Navigation header
│       ├── footer.twig    # Site footer
│       └── toast.twig     # Notification component
│
├── public/                 # Publicly accessible assets
│   ├── css/
│   │   └── style.css      # Main stylesheet
│   └── js/
│       └── app.js         # Client-side JavaScript
│
├── data/                   # Data storage (JSON files)
│   ├── users.json         # User accounts
│   └── tickets.json       # Ticket data
│
└── vendor/                 # Composer dependencies (auto-generated)
    └── twig/twig/         # Twig templating engine
```

## Quick Starts

### Prerequisites
- PHP 7.4 or higher
- Composer (for dependency management)
- Web server (Apache/Nginx) or PHP built-in server

### Installation

1. **Clone or download the project**
   ```bash
   git clone https://github.com/Goodluckodalonu/hng-stage2-ticketapp-twig
   cd hng-stage2-ticketapp-twig
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Set up permissions**
   ```bash
   chmod 755 data/
   chmod 666 data/users.json data/tickets.json
   ```

4. **Start the development server**
   ```bash
   php -S localhost:8000
   ```

5. **Open your browser**
   Navigate to `http://localhost:8000`

### First-Time Setup

1. **Visit the landing page** at `http://localhost:8000`
2. **Click "Get Started"** to create your first account
3. **Login** with your credentials
4. **Start creating tickets** in the Tickets section

## Usage Guide

### Creating an Account
1. Click "Get Started" on the landing page
2. Fill in your name, email, and password
3. Confirm your password
4. Click "Sign Up" to create your account

### Managing Tickets
1. **Create a Ticket**:
   - Navigate to "Tickets" from the header
   - Fill out the form with title (required), status (required), and description(optional)
   - Click "Create Ticket"

2. **Edit a Ticket**:
   - Click the "Edit" button on any ticket card
   - Modify the details in the pre-populated form
   - Click "Update Ticket"

3. **Delete a Ticket**:
   - Click the "Delete" button on any ticket card
   - Confirm deletion in the dialog
   - Ticket will be permanently removed

### Viewing Statistics
- Visit the "Dashboard" to see real-time ticket statistics
- Monitor Open, In Progress, and Closed tickets
- Track your productivity with visual indicators

## Configuration

### Environment Setup
The application uses JSON files for data storage by default. For production, consider upgrading to a database:

**MySQL/MariaDB Configuration:**
```php
// In config/config.php
define('DB_HOST', 'localhost');
define('DB_NAME', 'ticketapp');
define('DB_USER', 'username');
define('DB_PASS', 'password');
```

### Security Settings
```php
// Session security (auto-configured)
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true,      // Enable in production
    'httponly' => true,
    'samesite' => 'Strict'
]);
```

## Deployment

### Option 1: Traditional Web Hosting
1. Upload files to your web server via FTP/SFTP
2. Ensure PHP 7.4+ is installed
3. Set proper file permissions
4. Configure your web server (Apache/Nginx)

Deployment on Render(recommended)

Follow these steps to deploy your PHP + Twig app on Render:

1️⃣ Prerequisites

You have a Render account.

Your code is pushed to a GitHub repository.

A valid Dockerfile exists in the root of your project.

2️⃣ Setup on Render

Go to Render Dashboard

Click “New +” → “Web Service”.

Connect your GitHub repository.

Choose the following options:

Branch: main

Environment: Docker

Region: Oregon (US West)

Instance Type: Free (for testing)

Render will automatically detect your Dockerfile and start building your app.

Once the build is complete, Render will deploy and give you a live URL like:

https://your-app-name.onrender.com

3️⃣ Updating Your App

After making changes locally:

git add .
git commit -m "Update app"
git push origin main


Render will automatically rebuild and redeploy your app.

4️⃣ Troubleshooting

View logs under the Logs tab in the Render dashboard.

If you encounter permission issues, make sure to update your Dockerfile to include:

RUN chmod -R 777 /var/www/html/data


To redeploy manually, click Manual Deploy → Deploy Latest Commit on Render.

### Option 4: Shared Hosting (cPanel)
1. Create a new database (if using MySQL)
2. Upload all files to public_html
3. Update configuration in config/config.php
4. Set proper permissions on data/ directory

## Data Storage

### Current Implementation (JSON Files)
- **Users**: Stored in `data/users.json`
- **Tickets**: Stored in `data/tickets.json` with user isolation

### Sample Data Structure
```json
// users.json
[
  {
    "id": 123456789,
    "name": "John Doe",
    "email": "john@example.com",
    "password": "hashed_password",
    "createdAt": "2024-01-01T00:00:00.000Z"
  }
]

// tickets.json
[
  {
    "id": 987654321,
    "title": "Login Issue",
    "status": "open",
    "description": "Cannot log into the system",
    "userId": 123456789,
    "createdAt": "2024-01-01T00:00:00.000Z",
    "updatedAt": "2024-01-01T00:00:00.000Z"
  }
]
```

## Security Features

- **Input Validation**: All form inputs are validated client and server-side
- **XSS Protection**: Twig auto-escaping prevents cross-site scripting
- **CSRF Protection**: Session-based token validation
- **Data Isolation**: Users cannot access other users' data
- **Session Security**: Secure cookie settings and session management
- **Password Security**: Plain text storage (upgrade to hashing for production)

## Customization

### Styling
Edit `public/css/style.css` to customize the appearance:
```css
:root {
    --primary: #your-color;    /* Main brand color */
    --success: #your-color;    /* Open tickets */
    --warning: #your-color;    /* In progress tickets */
    --danger: #your-color;     /* Delete actions */
}
```

### Business Logic
Modify controllers in the `controllers/` directory:
- `AuthController.php` - Authentication logic
- `TicketController.php` - Ticket operations
- `DashboardController.php` - Statistics and reporting

### Templates
Update Twig templates in the `templates/` directory while maintaining the base structure.

## Troubleshooting

### Common Issues

1. **"Class not found" errors**
   ```bash
   composer install
   composer dump-autoload
   ```

2. **Permission errors**
   ```bash
   chmod 755 data/
   chmod 666 data/*.json
   ```

3. **JSON file errors**
   ```bash
   # Reset corrupted files
   echo '[]' > data/users.json
   echo '[]' > data/tickets.json
   ```

4. **Session errors**
   - Check `session.save_path` in php.ini
   - Ensure writable session directory

### Debug Mode
Enable debug mode in `config/config.php`:
```php
define('DEBUG_MODE', true);
```

## Performance Optimization

- Enable OPcache for PHP
- Use CDN for static assets
- Implement database indexing (if using SQL)
- Enable Gzip compression
- Use PHP 8.0+ for JIT compilation benefits

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Development Setup
```bash
# Install development dependencies
composer require --dev phpunit/phpunit

# Run tests
./vendor/bin/phpunit tests/
```

## License

This project is hng task-based and open source code. licensed under the MIT License.

## Acknowledgments
- **Contributors** who help improve this project
