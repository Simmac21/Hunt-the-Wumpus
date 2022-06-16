# Hunt-the-Wumpus

This program is based on the iconic "Hunt the Wumpus" game for the TI-99 home computer from the 1980s.
The user clicks a square and either discovers or does not locate a Wumpus in this version of the game.
The primary responsibility is to develop and maintain database tables that track all Wumpus locations and all users who have played the game, as well as their win and loss records.

The Database tables

The database table for players is with 4 columns: email address (primary key), wins (default 0), losses (default 0), and date last played (can be null).
Also created a database table for Wumpuses, with at least 5 Wumpuses' locations indicated by integer row and column.

The result.php File

The following is what the result.php file does:

    1. Determined whether the user discovered a Wumpus using a SELECT query.
    2. If they won, they were shown a success or failure message with an image.
    3. Presented them with a form to complete and submit their email address. This form will take you to save.php.
    
The save.php File

It performs the following functions:

    1. It creates a new row if the email address does not exist in the user table.
    2. Updates the number of wins/losses and date for the user, and tells the user that their game has been recorded, and shows their wins and losses to date.
    3. Shows the top 10 players' data in descending order of number of wins. It shows each user's email address, wins, losses, and the last time they played.
    4. Provides a "play again" button or link that returns the user to the index page.

