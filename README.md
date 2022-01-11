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
</ul>
