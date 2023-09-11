## Description:

The goal of this project was to create a Foods of the world application using Laravel. We seed
food, tags, categories and ingredients into the database and then go to the api/v1/foods route 
in order to get all the foods.
### Required parameters
- language: 2 letter string to choose the language 

### Optional parameters
- per_page: number of foods per page
- page: current page
- category: get food by their category id, this can also be NULL to get all foods which dont have a category id or !NULL to get all foods which have a category id
- tags: get food by tag id or list of tag ids
- diff_time: UNIX timestamp, get all foods that were created after the time diff_time. Also includes food that was modified or deleted.
- with: includes the information we want to return along with the food(tags,category,ingredients)

## How to run

1. Build and run Docker image using:
```docker-compose up -d```
2. Connect to the database using the docker information and run:
```php artisan migrate```
3. Start seeding using:
```php artisan db:seed```
4. Run the application using:
```php artisan serve```
