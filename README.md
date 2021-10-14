# customer_register
 Laravel Customer Register

Steps to execute the applications
1. installing the XAMPP package
2. PHP 7.2.5 or later for the current version of Laravel.
3. Creating a new project
    composer create-project --prefer-dist laravel/laravel customer_register
    
    Start Apache server and mysql using XAMPP control panel
    
    Update .env file for database connectivity
    
4. Run the scripts using

        php artisan serve  
        
        Some of the Api end points are 
        http://localhost:8000/api/customer (GET)
        
        http://127.0.0.1:8000/api/customer/ (POST)
        
        http://127.0.0.1:8000/api/customer/{customerid} (PUT)
        
        http://127.0.0.1:8000/api/customer/{customerid} (DELETE)
        
        http://127.0.0.1:8000/api/contacts/{customerid} (GET) - All the contacts for a customer
        
        
    
