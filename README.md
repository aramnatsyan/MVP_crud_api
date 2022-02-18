# MVP_crud_api

This is Simple MVP GRUD application for posts, comments and vote posts.

--------------------------------------------------------------------------------------------------------------------------------
Steps

1. Create DB 
    engine ->MariaDB
    name -> crud_api
    encoding -> utf8_general_ci	
    
2. run migrations

3. enjoy) 


----------------------------------------------------------------------------------------------------------------------------------
PostsController

    1. for getting posts use index endpoint ( http://postcrud.loc/api/posts __  request type is GET )
        ![image](https://user-images.githubusercontent.com/65552097/154542013-4b4a1caf-708a-4cb6-bdbb-b4ef02a03d3e.png)
    
    2. for generating posts use store endpoint ( http://postcrud.loc/api/posts __ request type is POST)
    
    3. for deleting posts use destroy endpoint  ( http://postcrud.loc/api/posts/delete/{id}  __ request type is DELETE)
        ![image](https://user-images.githubusercontent.com/65552097/154533696-d0670b26-72b0-44d7-a036-ef142ce62821.png)
        
    4.for updating use update endpoint ( http://postcrud.loc/api/posts/update/{id}  __ request type is PUT)
         ![image](https://user-images.githubusercontent.com/65552097/154537545-709b14fa-e045-49e9-bd4e-5bd24624176b.png)
         
    5. for voting posts, endpoint  ( http://postcrud.loc/api/posts/vote/{id}  __ request type is GET) 
        ![image](https://user-images.githubusercontent.com/65552097/154749937-ee5c0343-1d99-42f1-b57a-7a846f2f6b82.png)


---------------------------------------------------------------------------------------------------------------------------------
PostCommentsController

    1. for getting comments use index endpoint ( http://postcrud.loc/api/comments __  request type is GET )
        ![image](https://user-images.githubusercontent.com/65552097/154753584-683d5f15-3b79-43ab-ad69-8ae0cf02aadf.png)
    
    2. for generating comments use store endpoint ( http://postcrud.loc/api/comments __ request type is POST)
        ![image](https://user-images.githubusercontent.com/65552097/154754582-cb0accd4-e933-4c98-93a2-e1028f688d90.png)
    
    3. for deleting comment use destroy endpoint  ( http://postcrud.loc/api/comment/delete/{id}  __ request type is DELETE)
         ![image](https://user-images.githubusercontent.com/65552097/154757214-4d071330-e7ea-49ab-a9b3-b022640f176e.png)

    4.for updating use update endpoint ( http://postcrud.loc/api/comment/update/{id}  __ request type is PUT)
        ![image](https://user-images.githubusercontent.com/65552097/154755934-e1792836-c7a8-40cc-a5ad-9cd709f78e32.png)


---------------------------------------------------------------------------------------------------------------------------------
Job 
    
    You can find jobs in "scheduled" action in Kernel class.
---------------------------------------------------------------------------------------------------------------------------------

