### Github Token
- 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

## Documentation


#### Section 1: Prepareing Files 
- First Of all install UI Package:
  - composer require laravel/ui
  - php artisan ui bootstrap --auth
  - npm install && npm run dev

- Create SSL Certificate.
  - sudo mkdir -p ssl // in the root directory
  - make localhost directory inside ssl dir.
  - sudo nano [server_rootCA.csr.cnf](https://gist.github.com/mindscms/c1acc036b738f197592d99286d6d2c5b) 
  - sudo nano [v3.ext](https://gist.github.com/mindscms/8df4f780b3289317fc345693a54c6e24)

  - SSL [Commands](https://gist.github.com/mindscms/528c30e941d28d1b45058f8c0bbf6280)
    
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
  - Interface Template: [template](https://bootstrapious.com/p/boutique-bootstrap-e-commerce-template)
  - Copy and paste the [css, icons, img, js, vendor] directories from the template into the "/public/frontend/"
  - Copy and paste the [cart, checkout, detail, index, shop] files from the template into the "/resources/views/frontend" and turn the extension of files into blade.php
  - [Dashboard](https://startbootstrap.com/theme/sb-admin-2)
  - Refactor The Index page. 

- Apply Interface
  - Create /app/Http/Controllers/Frontend/FrontendController


### End of Section 1
<br>
<br>
<br>

#### Section 2: Rules & Authintications

####Section 2: Rules & Authintications
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
    <li>11- Permissions 2:
        <ul>
            <li>Make The products categories migration</li>
            <li>Create Products Categories Seeder data and migrate the db</li>
        </ul>
    </li>
    <li>12- Permission 3:
        <ul>
            <li>Create Products Categories Views</li>
            <li>Add 2 new methods:[appeardChildren, assigned_children] to Permission Model.</li>
            <li>Install Redis</li>
            <li>Edit .env File</li>
            <li>Create ViewServiceProvider and cache Permission Tree inside admin_side_menu and don't forget to make available to all admin views using view composer method.</li>
            <li>Add the new provider to config/app.php providers array.</li>
        </ul>
    </li>
    <li>13- Permission 4:
        <ul>
            <li>Edit config/database.php redis conifg</li>
            <li>composer require predis/predis</li>
            <li>Set up the admin sidebar</li>
            <li>Create app/Helper/GeneralHelper.php file</li>
            <li>Add the file inside composer.json in autoload in files and don't forget to dump autoload.</li>
        </ul>
    </li>
    <li>14- Permission 5:
        <ul>
            <li>Set up the sidebar Menu.</li>
            <li>Create new getParentShowOf, getParentOf, getParentIdOf helper funcs.</li>
            <li>Start using it inside the sidebar.</li>
            <li>Finishig the Sidebar menu.</li>
            <li>Fix EntrustSeeder.php</li>
            <li>Run some test in web.php testing route.</li>
        </ul>
    </li>
    <li>15- Creating Tables:
        <ul>
            <li>Create 2 Product and Tag Model, Seeder, Migration</li>
            <li>Create Migration taggables table.</li>
            <li>Create Media Model and migration</li>
            <li>init Product, Tag, Taggable, Media tables.</li>
            <li>Add parent, children, tree, products:hasMany method to ProductCategory Model.</li>
            <li>Add category:BelongsTo, tags:MorphToMany, media:MorphMany, method to Product Model.</li>
            <li>Add products:MorphToMany method to Tag Model.</li>
        </ul>
    </li>
    <li>16- Update Permissions:
        <ul>
            <li>Create 2 Product and Tag Model, Seeder, Migration</li>
            <li>Create Tags and Products Controllers, Seeders, Views and Resources Routes.</li>
            <li>Add Tags and Producs to the permissions seeder.</li>
        </ul>
    </li>
</ul>

#### End of Section 2
<br>
<br>
<br>

#### Section 3: Bulding Dashboard.
<ul>
    <li>17- Products Sections 1: 
        <ul>
            <li>Set up product_categories.index view.</li>
            <li>Install nicolaslopezj/searchable and Debbugar packages.</li>
            <li>setup paginate to use bootstrap by adding Illuminate\Pagination\Paginator::useBoostrap(); to boot() method inside AppServiceProvider class.</li>
        </ul>
    </li>
    <li>18- Products Sections 2: 
        <ul>
            <li>Working on product_categories.create view.</li>
            <li>Create app/Http/Requests/Backend/ProductCategoryRequest.php
                <ul>
                    <li>make the authorize method return true.</li>
                    <li>Make the switch statement to validate the request on POST, PUT and PATCH</li>
                    <li>Edit the param in the ProductCategoriesController store method to  ProductCategoryRequest</li>
                </ul>
            </li>
            <li>composer require intervention/image</li>
            <li>composer require intervention/imagecache and add its provider and alias.</li>
            <li>Add the flash msg html structure to admin layout.</li>
        </ul>
    </li>
</ul>
