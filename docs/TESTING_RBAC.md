# Testing Guide - RBAC Login System

## 🎯 Test Accounts

### 1. **Super Admin**
- Email: `superadmin@jasatirta.com`
- Password: `password`
- Expected Redirect: `/admin/dashboard`
- Role: `super-admin`

### 2. **Admin**
- Email: `admin@jasatirta.com`
- Password: `password`
- Expected Redirect: `/admin/dashboard`
- Role: `admin`

### 3. **Instructor**
- Email: `sarah.wijaya@jtlc.com`
- Password: `password`
- Expected Redirect: `/instructor/dashboard`
- Role: `instructor`

### 4. **User/Participant**
- Email: `user@jasatirta.com`
- Password: `password`
- Expected Redirect: `/user/dashboard`
- Role: `user`

### 5. **Participant**
- Email: `budi.santoso@participant.com`
- Password: `password`
- Expected Redirect: `/user/dashboard`
- Role: `participant`

## 📋 Test Scenarios

### Test 1: Admin Login
1. Navigate to `/login`
2. Enter credentials:
   - Email: `admin@jasatirta.com`
   - Password: `password`
3. Click "Login"
4. **Expected Result**: Redirect to `/admin/dashboard`
5. **Verify**: Can access admin features (Trainings, Schedules, Instructors, etc.)
6. **Verify**: Cannot access `/user/dashboard` (should redirect back to admin dashboard)

### Test 2: User Login
1. Navigate to `/login`
2. Enter credentials:
   - Email: `user@jasatirta.com`
   - Password: `password`
3. Click "Login"
4. **Expected Result**: Redirect to `/user/dashboard`
5. **Verify**: Can see user dashboard with courses, achievements
6. **Verify**: Cannot access `/admin/dashboard` (should redirect back to user dashboard with error message)

### Test 3: Instructor Login
1. Navigate to `/login`
2. Enter credentials:
   - Email: `sarah.wijaya@jtlc.com`
   - Password: `password`
3. Click "Login"
4. **Expected Result**: Redirect to `/instructor/dashboard`
5. **Verify**: Can access instructor features
6. **Verify**: Cannot access `/admin/dashboard` or `/user/dashboard`

### Test 4: New User Registration
1. Navigate to `/register`
2. Fill form:
   - First Name: `Test`
   - Last Name: `User`
   - Email: `testuser@example.com`
   - Phone: `081234567890`
   - Password: `password123`
   - Confirm Password: `password123`
3. Click "Register"
4. **Expected Result**: Auto-assigned role `user`
5. **Expected Result**: Redirect to `/user/dashboard`

### Test 5: Access Control
1. Login as User (`user@jasatirta.com`)
2. Try to access `/admin/trainings`
3. **Expected Result**: Redirect to `/user/dashboard` with error message "Anda tidak memiliki akses ke halaman tersebut."

### Test 6: Direct Dashboard Access
1. Login as Admin
2. Navigate to `/dashboard`
3. **Expected Result**: Auto-redirect to `/admin/dashboard`

### Test 7: Multiple Role Check
1. Login as different users
2. Check sidebar menu items differ based on role:
   - **Admin**: Pelatihan, Jadwal, Pengajar, Peserta, Kategori, Pesan, Laporan
   - **User**: Dashboard, Kursus Saya, Katalog, Jadwal Kelas, Sertifikat, Pencapaian, Forum
   - **Instructor**: Dashboard, Kursus Saya, Jadwal Mengajar, Siswa

## 🔍 Manual Verification Steps

### Check User Role in Database
```sql
SELECT u.email, r.name as role 
FROM users u 
JOIN model_has_roles mr ON u.id = mr.model_id 
JOIN roles r ON mr.role_id = r.id;
```

### Check Permissions
```sql
SELECT r.name as role, p.name as permission 
FROM roles r 
LEFT JOIN role_has_permissions rp ON r.id = rp.role_id 
LEFT JOIN permissions p ON rp.permission_id = p.id 
ORDER BY r.name;
```

### Laravel Tinker Testing
```bash
php artisan tinker
```

```php
// Check user roles
$user = User::where('email', 'admin@jasatirta.com')->first();
$user->roles->pluck('name'); // Should return ['admin']

// Check if user has role
$user->hasRole('admin'); // Should return true

// Check permissions
$user->getAllPermissions()->pluck('name');

// Get all users with specific role
User::role('admin')->get();
```

## 🐛 Troubleshooting

### Issue: "Call to undefined method createToken"
- **Cause**: Sanctum trait issue (only affects API login, not web)
- **Solution**: Already handled in code - web login doesn't use tokens

### Issue: Redirect loop
- **Cause**: Middleware misconfiguration
- **Solution**: Check `bootstrap/app.php` middleware alias

### Issue: "Role does not exist"
- **Cause**: Roles not seeded
- **Solution**: Run `php artisan db:seed --class=RoleSeeder`

### Issue: User has no role after registration
- **Cause**: Missing assignRole in RegisteredUserController
- **Solution**: Already fixed - auto-assigns 'user' role

### Issue: Cannot access any page
- **Cause**: Missing role assignment
- **Solution**: Manually assign role via tinker:
```php
$user = User::find(1);
$user->assignRole('admin');
```

## ✅ Expected Outcomes

After successful implementation:

- ✅ Different users see different dashboards
- ✅ Sidebar menus are role-specific
- ✅ Protected routes return 403 or redirect with error
- ✅ New registrations auto-assigned 'user' role
- ✅ Login redirects based on user role
- ✅ No manual role switching needed

## 📊 Roles & Permissions Summary

| Role | Dashboard | Can Access Admin Panel | Can Teach | Can Enroll Courses |
|------|-----------|------------------------|-----------|-------------------|
| super-admin | `/admin/dashboard` | ✅ Yes (Full) | ❌ No | ❌ No |
| admin | `/admin/dashboard` | ✅ Yes (Full) | ❌ No | ❌ No |
| instructor | `/instructor/dashboard` | ❌ No | ✅ Yes | ✅ Yes (Own) |
| participant | `/user/dashboard` | ❌ No | ❌ No | ✅ Yes |
| user | `/user/dashboard` | ❌ No | ❌ No | ✅ Yes |

## 🚀 Next Steps

1. Run the application: `php artisan serve`
2. Test each login scenario above
3. Verify role-based redirects work correctly
4. Check access control on protected routes
5. Test new user registration flow
6. Verify sidebar menus show correct items per role

## 📝 Notes

- All test accounts use password: `password`
- Database has been seeded with 30+ users across different roles
- Roles created: super-admin, admin, instructor, participant, user, corporate, student
- Permissions fully configured for each role
