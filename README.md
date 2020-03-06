# Cat Facts Laravel App

A simple app written in Laravel that retrieves facts about cats from an awesome free API endpoint!

## Installation

You'll notice that there are only a few files in this repo. I only included the files that differentiate this repo from a standard Laravel 7.0.4 installation.

### Controllers

There is a single controller: `CatFacts`. It contains three public methods & a private method.

### Routes

There are three routes.

`GET:/` displays a form for requesting a given number of cat facts.

`POST:/` route grabs your requested number of facts & outputs a PDF listing them out. Or, if there's an issue, outputs a PDF that describes the error.

`GET:/past` grabs all of your past PDFs & paginates them. It also orders them by fact count, descending.

Both routes are defined in `routes/web.php`.

### Views

There are three views.

`catfacts.template` is a basic HTML template for catfacts pages that pulls in the catfacts CSS & yields `content`.

`catfacts.form` contains the HTML for the cat fact request form, and accepts a variable called `$limit` so the form can request a limited number of cat facts, or defaults to 20 if no limit is given.

`catfacts.past` displays the past-requested PDFs & paginates them.

### Assets

A single CSS file was added called `public/css/catfacts.css`. It isn't very long!

### Models

There is a single model `Pdf` for saving PDF requests in the database.

Initially I opted to just save them on disk & sort through them by filename, but I figured it would be a better test of my Laravel experience to save them in the DB.

### .env

I only changed the `.env` from the example to connect it to my local database.