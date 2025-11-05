# TODO: Implement New Register and Login Forms

## 1. Update register.blade.php ✅
- Replace current content with the provided HTML, adapted to Blade syntax.
- Use @csrf, route('register'), @error, old() for validation and repopulation.
- Ensure conditional fields (citizen/foreigner) work with JavaScript.

## 2. Update login.blade.php ✅
- Replace current content with the new Bootstrap design HTML.
- Adapt to Blade: use @csrf, route('login'), @error, old(), session status.
- Keep Bootstrap CSS/JS links.

## 3. Modify RegisteredUserController.php ✅
- Update store() method validation to handle new fields.
- Store basic user data in users table.
- Store additional/conditional data in bio_data table.
- Handle file uploads for ID/passport files.

## 4. Update bioData.php model ✅
- Add new fillable fields for conditional data: passport_no, visa_no, id_front, id_back, passport_upload, visa_upload, etc.

## 5. Create new migration for additional user fields ✅
- Add fields like dob, country, address, city, emergency_name, emergency_phone, relation, security_question, security_answer to users table.

## 6. Create new migration for additional bio_data fields ✅
- Add fields for citizen/foreigner conditionals: id_front, id_back, passport_no, visa_no, visa_upload, etc.

## 7. Followup Steps ✅
- Run php artisan migrate to apply new migrations.
- Test forms for validation and submission.
- Ensure file uploads work and are stored securely.
- Verify conditional fields show/hide correctly.
- Test login functionality.
