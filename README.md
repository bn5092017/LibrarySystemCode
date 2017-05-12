librarySystemCode
=================

A Symfony project created on April 3, 2017, 1:53 pm.
====================================================

This online library information management system is designed to keep a record of staff and customer details, and details of the books in the library, and to track which books are on loan to which customers.  Staff members will be able to update user records, loan records and the catalogue of library materials.
=====================================================


File directory structure
========================
LibrarySystemCode
  .idea
  app
    config
      config.yml
      routing.yml
      security.yml
      services.yml
    DoctrineMigrations
    Resources
      views
        base.html.twig
        books
          edit.html.twig
          index.html.twig
          new.html.twig
          oneBook.html.twig
          search.html.twig
          searchResults.html.twig
        loans
          edit.html.twig
          index.html.twig
          new.html.twig
        main
          about.html.twig
          homepage.html.twig
          sitemap.html.twig
        security
          adminHome.html.twig
          login.html.twig
        user
          edit.html.twig
          index.html.twig
          myLoans.html.twig
          new.html.twig  
          show.html.twig
      src
        AppBundle
          Controller
            AuthenticationController.php
            BookController.php
            LoansController.php
            MainController.php
            UserController.php
          Doctrine
            PasswordListener.php
          Entity
            Books.php
            Loans.php
            User.php
          Form
            BooksType.php
            EditLoans.php
            LoansType.php
            LoginForm.php
            SearchType.php
            UserType.php
          Repository
            BooksRepository.php
            LoansRepository.php
            UserRepository.php
          Security
            LoginFormAuthenticator.php
          Tests
        tests
        var
        vendor
        web
          bundles
          css
            basic.css
          images

