# discgolf-foursomes-generator
A web-based foursomes/threesomes random generator for disc golf leagues (or regular golf leagues) coded in PHP. No database required.

After years of "flipping discs" and using a deck of playing cards to determine what the foursomes (and threesomes) were going to be at our Sunday afternoon league outings, I decided to see if I could develop a mobile-friendly web application that would allow us to select players as they showed up and let the programming randomly assign players to groups.

In this little app, the players are entered and selected from a plain TXT file that is managed by someone in the league. When new players join the league, they're added to the players.txt file via the manage.php script.  If players show up just to play as a guest or as a visitor, there's a button at the top that allows them to be added for that day's session only.  Here's a demo that has the players.txt file set at read-only:

http://edge.byethost18.com/demo/

All you have to do is download the files in this collection, place them in a directory on a server, make the players.txt file writeable by the server and you're in business. If you uncomment the first line in the manage.php file, you can turn on a very basic user authorization function that will challenge anyone who tries to manipulate the players list. The default username is "disc" and the default password is "golf".

The username and password can be changed by editing the userauth.php script.

Managing the players list is done by clicking the hyperlinked asterisk at the bottom left of the foursomes.php screen.

As a bonus, a doubles team randomizer is included. If there happens to be an odd number of players, the odd man out typically plays what is called "Cali", meaning that he/she plays as an individual, but is alloted an additional throw per hole without penalty. See https://www.discgolfscene.com/post/328840/cali-rules

I'm sure a better programmer could churn out some much cleaner code, but hey! . . . it works and we've been using it with great success. It sure beats the heck out of flipping discs and picking cards from a deck.

After watching the PGA Championship this weekend and noticing that they sent groups out in threesomes, I started working on a version that allows you to choose whether you want the groups in foursomes/threesomes or threesomes/twosomes:

http://edge.byethost18.com/demo3

When completed, it will simply be a tweak of the manage.php file and a dozen or so lines of code in the foursomes.php file.

We are trying to raise money to replace the 15+ year old baskets at the disc golf course in our local park. If you like this little web app and you'd like to show your appreciation, you can help us by kicking in a small contribution toward our goal.

Please consider a PayPal donation.

[![](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=weltong01%40gmail%2ecom&lc=US&item_name=EDGE%20New%20Basket%20Fund&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHostedGuest)

