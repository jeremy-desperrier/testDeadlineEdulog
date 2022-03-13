# testDeadlineEdulog
Create file .envlocal
  Add the line for the database connexion

api routes:
# get all deadlines not done until next friday
  /api/nextdeadlines
# get all deadlines not done
  /api/alldeadlines
# set the deadline at done
  /api/validate/{idDeadline}
    {idDeadline} int required
