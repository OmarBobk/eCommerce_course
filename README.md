###Github Token
- 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

## Documentation


<h4>Section 1: Prepareing Files</h4> 
- First Of all install UI Package:
  - composer require laravel/ui
  - php artisan ui bootstrap --auth
  - npm install && npm run dev

- Create SSL Certificate.
  - sudo mkdir -p ssl // in the root directory
  - make localhost directory inside ssl dir.
  - sudo nano server_rootCA.csr.cnf
    - https://gist.github.com/mindscms/c1acc036b738f197592d99286d6d2c5b 
  - sudo nano v3.ext
    - https://gist.github.com/mindscms/8df4f780b3289317fc345693a54c6e24

  - SSL Commands:
    - https://gist.github.com/mindscms/528c30e941d28d1b45058f8c0bbf6280
    
  - add this code to the /opt/lampp/etc/extra/httpd-vhosts
    - "<VirtualHost 127.0.1.5:443>
      ServerAdmin admin@dev.test
      DocumentRoot "/opt/lampp/htdocs/laravel/dev.test/public"
      ServerName dev.test
      SSLEngine on
      SSLCertificateFile /home/bobk/ssl/dev.test/server.crt
      SSLCertificateKeyFile /home/bobk/ssl/dev.test/server.key
      </VirtualHost>"
  - Import the file.pem from ../ssl/dev.test in chrome
  



- Download Interface and Dashboard Files.
  - Interface Template: https://bootstrapious.com/p/boutique-bootstrap-e-commerce-template
  - Copy and paste the [css, icons, img, js, vendor] directories from the template into the "/public/frontend/"
  - Copy and paste the [cart, checkout, detail, index, shop] files from the template into the "/resources/views/frontend" and turn the extension of files into blade.php
  - Dashboard: https://startbootstrap.com/theme/sb-admin-2
  - Refactor The Index page. 

- Apply Interface
  - Create /app/Http/Controllers/Frontend/FrontendController


<h4>Section 2: Rules & Authintications</h4>
<ul>
    <li>6- Install Rules Package: 
        <ul>
            <li>Edit Auth::routes(); To Auth::routes(['verify' => true]);</li>
            <li>Add MustVerifyEmail Interface to User Model</li>
            <li>Edit User Migration as needed</li>
            <li>Install <a href="https://github.com/mindscms/entrust">Rule Package</a></li>
            <li>Create Entrust Seeder: Users and Roles and attach the User into the role</li>
        </ul>
    </li>
    <li>7- Set The Authinticate settings 1: 
        <ul>
            <li>Cutomize the resources/views/auth files as needed</li>
            <li>Edit create and validator method in app/Http/Controllers/Auth/RegisterController to match the user migration</li>
            <li>In the same create method don't forget to attachRole on the created user statement</li>
        </ul>
    </li>
    <li>8- Set The Authintication Settings 2:
        <ul>
            <li>Make Login Proccess use username instead of email by:
                <ul>
                    <li>Add username method in LoginController and return 'username'</li>
                    <li>Add redirectTo method and redirect the user into his allowed route</li>
                    <li>Edit app header so login and register words toggled to Welcome msg when logged in</li>
                </ul>
            </li>        
        </ul>
    </li>
    <li>9- Set The Authintication Settings 3:
        <ul>
            <li>Customize views/backend/login and forgot-password views as needed.</li>
            <li>Add Logout proccess</li>
            <li>Create New Roles Middleware</li>
            <li>Scafold the admin/index route with role and roles middleware</li>
            <li>Turn backend.index into admin.index</li>
        </ul>
    </li>
    <li>10- Permissions 1:
        <ul>
            <li>Create Products Categories Model And Controller</li>
            <li>Create new Resources Route for Products Categories</li>
            <li>Create Permissions seeder For Products Categories: Create, Index, Delete, Update, Show</li>
        </ul>
    </li>
</ul>
