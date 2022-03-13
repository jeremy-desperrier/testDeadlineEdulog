# testDeadlineEdulog
composer install
Create file .env.local
  Add the line for the database connexion
php bin/console d:d:c
php bin/console d:m:m
symfony serve

api routes:
# get all deadlines not done until next friday
  /api/nextdeadlines
# get all deadlines not done
  /api/alldeadlines
# set the deadline at done
  /api/validate/{idDeadline}
