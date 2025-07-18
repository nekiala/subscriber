# Subscriber

## About This application

This is a simple subscription platform (only RESTful APIs with MySQL) in which users can subscribe to a website (there can be multiple websites in the system). Whenever a new post is published on a particular website, all it's subscribers shall receive an email with the post title and description in it. (no authentication of any kind is required)

### Configure your app
1. Set up your preferred database
2. Run php artisan php migrate --seed

### Create a post
* Method: POST
* Endpoint: /create-post
* Body: {title: string, description: string, website: integer}

### Subscribe a user
* Method: POST
* Endpoint: /subscribe
* Body: {name: string, email: string, website: integer}


### Notify users about a post

* Run command: **php artisan notify**
