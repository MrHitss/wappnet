# Contacts Management Tool

## Requirements

- PHP >= 8.0
- Composer
- SQLite (or any other database supported by Laravel)

## Installation Steps

1. **Clone the repository**

   ```bash
   git clone https://github.com/MrHitss/wappnet
   cd wappnet
   ```
   
2. **Install Dependencies**

   ```bash
   composer install
   ```

3. **Create .env file**

   ```bash
   cp .env.example .env
   ```
   
4. **Generate Application Key**

   ```bash
   php artisan key:generate
   ```

5. **Run Migration**

   ```bash
   php artisan migrate
   ```
   
6. **Run the Seeders**

   ```bash
   php artisan db:seed
   ```

7. **Run the Project**

   ```bash
   php artisan serve
   ```

## Test the Application

### Step 1: Generate the Key
```bash
php artisan key:generate --env=testing
```

### Step 2: Run the TestCases
```bash
php artisan test
```
   
## References (Screenshots)
<img width="500" alt="Screenshot 2024-10-24 at 7 45 01 PM" src="https://github.com/user-attachments/assets/7ee9ffdc-5975-4e04-a0c3-2169591c0f7b">
<img width="500" alt="Screenshot 2024-10-24 at 7 44 48 PM" src="https://github.com/user-attachments/assets/df712d38-f53a-4e66-b79e-ed769a9c8704">
<img width="500" alt="Screenshot 2024-10-24 at 7 44 41 PM" src="https://github.com/user-attachments/assets/2e82e0a8-b278-4c52-8775-7f021b7672c9">
<img width="500" alt="Screenshot 2024-10-24 at 7 44 37 PM" src="https://github.com/user-attachments/assets/1ce1ed76-3ef8-4dad-806a-42b9b68d4f50">
<img width="500" alt="Screenshot 2024-10-24 at 7 44 31 PM" src="https://github.com/user-attachments/assets/2bcc0e9a-de68-4b0f-a2e9-45725ad58026">

Thank you for checking out the Contact Managemet project!

