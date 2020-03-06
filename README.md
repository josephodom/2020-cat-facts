# Cat Facts Laravel App

A simple app written in Laravel that retrieves facts about cats from an awesome free API endpoint!

## Installation

You'll notice that there are only a few files in this repo. I only included the files that differentiate this repo from a standard Laravel 7.0.4 installation.

### Controllers

There is a single controller: `CatFacts`. It contains two public methods & a private method.

### Routes

There are two routes. Both are on `/`. One is `GET`, one is `POST`.

The `GET` route displays a form for requesting a given number of cat facts.

The `POST` route grabs your requested number of facts & outputs a PDF listing them out. Or, if there's an issue, outputs a PDF that describes the error.

Both routes are defined in `routes/web.php`.

### Views

There are two views.

`catfacts.template` is a basic HTML template for catfacts pages that pulls in the catfacts CSS & yields `content`.

`catfacts.form` contains the HTML for the cat fact request form, and accepts a variable called `$limit` so the form can request a limited number of cat facts, or defaults to 20 if no limit is given.

### Assets

A single CSS file was added called `public/css/catfacts.css`. It isn't very long!

### Models

No models! No database anything!

### .env

I didn't change the `.env` from the example at all.