# User Profile System Documentation

## Overview
Sistem profil pengguna yang lengkap untuk Jasa Tirta Learning Center yang memungkinkan peserta untuk mengelola informasi pribadi mereka, mengubah password, dan mengatur preferensi pembelajaran.

## Features

### 1. **Profile Management**
- **Personal Information**: Nama, email, telepon, lokasi, bio
- **Avatar Upload**: Upload dan ubah foto profil
- **Student ID**: ID unik untuk setiap peserta
- **Learning Statistics**: Statistik pembelajaran (kursus diikuti, selesai, sertifikat, jam belajar)

### 2. **Security Management**
- **Password Update**: Ubah password dengan validasi password saat ini
- **Security Status**: Status keamanan akun
- **Two-Factor Authentication**: Placeholder untuk 2FA (belum diimplementasi)
- **Login History**: Placeholder untuk riwayat login (belum diimplementasi)

### 3. **Learning Preferences**
- **Notifications**: 
  - Email notifications
  - Course reminders
  - Weekly progress reports
  - Marketing emails
- **Learning Settings**:
  - Preferred learning time (morning/afternoon/evening/flexible)
  - Difficulty level (beginner/intermediate/advanced/expert)
  - Language interface (Indonesian/English)
- **Learning Goals**: Target pembelajaran dengan metrics

### 4. **Recent Activity**
- **Recent Courses**: Kursus terbaru yang diikuti dengan progress
- **Progress Tracking**: Visual progress bar untuk setiap kursus
- **Status Badges**: Status kursus (selesai, berlangsung, belum dimulai)

## File Structure

```
resources/views/pages/user/profile/
├── index.blade.php                 # Main profile page
├── _header.blade.php              # Profile header component
├── _profile-card.blade.php        # Profile card with avatar and stats
├── _personal-info.blade.php       # Personal information management
├── _security.blade.php            # Security and password management
└── _learning-preferences.blade.php # Learning preferences and settings

app/Http/Controllers/User/
└── ProfileController.php          # Profile management controller

tests/Feature/User/
└── ProfileTest.php               # Comprehensive tests for profile functionality
```

## Routes

### Profile Routes
- `GET /user/profile` - Show profile page
- `PUT /user/profile` - Update profile information
- `PUT /user/profile/password` - Update password
- `PUT /user/profile/preferences` - Update learning preferences
- `POST /user/profile/avatar` - Upload avatar image

## API Endpoints

### Update Profile Information
```php
PUT /user/profile
{
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "+62 812-3456-7890",
    "location": "Jakarta, Indonesia",
    "bio": "Learning enthusiast"
}
```

### Update Password
```php
PUT /user/profile/password
{
    "current_password": "old_password",
    "password": "new_password",
    "password_confirmation": "new_password"
}
```

### Update Preferences
```php
PUT /user/profile/preferences
{
    "email_notifications": true,
    "course_reminders": true,
    "weekly_progress": false,
    "marketing_emails": false,
    "preferred_learning_time": "morning",
    "difficulty_level": "intermediate",
    "language": "id"
}
```

### Upload Avatar
```php
POST /user/profile/avatar
{
    "avatar": [file]
}
```

## Frontend Features

### Interactive Elements
- **Alpine.js Integration**: Real-time interactivity
- **Form Validation**: Client-side dan server-side validation
- **Progress Bars**: Visual learning progress
- **Toggle Switches**: Modern toggle switches untuk preferences
- **Modal-like Editing**: Inline editing dengan cancel/save options

### Responsive Design
- **Mobile-First**: Optimized untuk mobile devices
- **Grid Layout**: Responsive grid untuk desktop dan tablet
- **Touch-Friendly**: Button dan control yang mudah digunakan di touch devices

### Visual Elements
- **Color-Coded Stats**: Different colors untuk berbagai metrics
- **Status Badges**: Visual status indicators
- **Progress Visualization**: Progress bars dengan warna yang sesuai level
- **Icon Integration**: Heroicons untuk consistent iconography

## Security Features

### Validation
- **Email Uniqueness**: Prevent duplicate email addresses
- **Password Strength**: Enforce strong password requirements
- **File Upload Security**: Validate image files untuk avatar upload
- **CSRF Protection**: Built-in CSRF protection
- **Authentication Guards**: Middleware protection untuk semua routes

### Data Protection
- **Password Hashing**: Secure password storage dengan bcrypt
- **File Storage**: Secure avatar storage dalam public disk
- **Input Sanitization**: Proper input sanitization dan validation

## Testing

### Test Coverage
- **Profile Page Access**: Authentication testing
- **Profile Updates**: CRUD operations testing
- **Password Changes**: Security testing
- **Preferences Management**: Settings persistence testing
- **Avatar Upload**: File handling testing
- **Validation Testing**: Input validation dan error handling

### Test Files
- `ProfileTest.php`: Comprehensive feature tests covering semua functionality

## Future Enhancements

### Planned Features
1. **Two-Factor Authentication**: Complete 2FA implementation
2. **Login History**: Detailed login tracking dan notifications
3. **Learning Analytics**: Advanced learning analytics dan insights
4. **Social Features**: Profile sharing dan social connections
5. **Achievements System**: Gamification dengan badges dan achievements
6. **Dark Mode**: Theme switching support
7. **Export Data**: GDPR-compliant data export functionality

### Technical Improvements
1. **Real-time Notifications**: WebSocket integration
2. **Advanced Avatar Editing**: Crop dan resize functionality
3. **Preferences Database**: Dedicated preferences table
4. **Activity Logging**: Comprehensive audit trail
5. **API Versioning**: RESTful API dengan versioning

## Usage Instructions

### For Users
1. **Accessing Profile**: Click "Profil Saya" dalam sidebar
2. **Editing Information**: Click "Edit" button pada section yang ingin diubah
3. **Uploading Avatar**: Click camera icon pada profile picture
4. **Changing Password**: Navigate ke Security section dan click "Ubah Password"
5. **Setting Preferences**: Adjust toggles dan dropdowns di Learning Preferences section

### For Developers
1. **Extending Functionality**: Add new methods ke `ProfileController`
2. **Adding Preferences**: Update validation rules dan database structure
3. **Customizing UI**: Modify blade templates dalam `profile/` directory
4. **Adding Tests**: Extend `ProfileTest` dengan new test cases

## Database Considerations

### Current Implementation
- Uses existing `users` table for basic information
- Preferences stored temporarily (requires database enhancement)
- Avatar paths stored in `users.avatar` column

### Recommended Enhancements
```sql
-- Add preferences table
CREATE TABLE user_preferences (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NOT NULL,
    email_notifications BOOLEAN DEFAULT TRUE,
    course_reminders BOOLEAN DEFAULT TRUE,
    weekly_progress BOOLEAN DEFAULT FALSE,
    marketing_emails BOOLEAN DEFAULT FALSE,
    preferred_learning_time ENUM('morning', 'afternoon', 'evening', 'flexible') DEFAULT 'flexible',
    difficulty_level ENUM('beginner', 'intermediate', 'advanced', 'expert') DEFAULT 'beginner',
    language VARCHAR(2) DEFAULT 'id',
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Add missing columns to users table
ALTER TABLE users ADD COLUMN phone VARCHAR(20) NULL;
ALTER TABLE users ADD COLUMN location VARCHAR(100) NULL;
ALTER TABLE users ADD COLUMN bio TEXT NULL;
ALTER TABLE users ADD COLUMN avatar VARCHAR(255) NULL;
```

## Conclusion

Sistem profil pengguna ini menyediakan foundation yang solid untuk user management dalam Jasa Tirta Learning Center. Dengan design yang responsive, security yang baik, dan extensive testing, sistem ini ready untuk production use dan mudah untuk di-extend dengan fitur tambahan di masa depan.