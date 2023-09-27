# LibraryApp
 An app to keep track of books. Made specifically for an internship.
 Built on Laravel using blade templates, alpine and tailwind.

 # How it works
 This website is meant for "library" admins only. hence the only page that's functional is the dashboard.
 Once you reach the dashboard you can create,read,update and delete books with as many authors as you want (BelongsToMany Relationship).
 You can also view the authors list or, if you click the author's name it will show you all the books he/she has written.
 The books page comes with a search bar that queries based on the authors name or the books title.
 
## Steps to setup the project

1) After cloning the repository, cd into LibraryApp and run php artisan migrate (Make sure to copy .env.example)
2) Seed the database (php artisan db:seed)
3) Inside the terminal write npm install
4) then npm run dev
5) and finally php artisan serve

### Admin Credentials

They're located in the DatabaseSeeder file but if your lazy: admin@example.com => Admin1
