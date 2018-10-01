# Test project FarmLab

1. User
    + LabMemberController
        * CRUD on farm lab team members
    + VetController
        * CRUD on vets

2. Practice
    + PracticeController
        * CRUD on practices
            - Practice admin is created as a part of practice creation.

3. LabResult
    + LabResultController
        * CRUD on lab results

4. File
    + FileController
        * CRUD on file


# User

- User can be of type:
    1. farmlab admin
    
    2. farmlab team member
        - FL members should be notified when they are registered by the admin done (use php artisan queue:listen)
        
    3. practice admin
        - practice admins should be notified when they are registered by the admin
        - practice admins should be notified when new results for their practice are uploaded
        
    4. practice vet
        - practice vets should be notified when they are registered by the practice admin
        - practice vets should be notified when new results for their practice are uploaded

- The welcome email should consist of the login details for the user. Email and password (password reset link).

> php artisan make:auth - done


