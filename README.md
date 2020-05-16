# full-stack-sample
 Sample full-stack project

To run the project (NodeJS required) enter 'node start' in a terminal inside the project directory.

The project serves @ localhost:3000

The project uses a custom build system found in start.js

The view folder contains the markup and Vue layer (view.js). I often use Pug as a markup pre-processor so I used it in this project as well.

Also in the view folder is controller.js which acts as a client-side controller. This performs the interaction with the model API and returns the results to the Vue layer.

The model api can be found in /public/model/buyer/index.php. I used a simplistic approach for creating API endpoints: GET retrieves data by ID or searches by Name, POST can either create or update data depending on whether or not ID is defined in the input, and DELETE will perform data deletion @ ID. Because I wanted the project to be portable, I used a json flat-file as a data-source so there aren't any database queries. However, I have experience with large complex queries in MS-SQL as well as My-SQL.
