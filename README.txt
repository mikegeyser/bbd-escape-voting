Raspberry Pi setup steps

	1.	Install NOOBS (Raspbian)
	2.	Provide internet access via Ethernet
	3.	Clone from “https://nishai28@bitbucket.org/nishai28/Escape.git” onto Desktop
	4.	cd /home/pi/Desktop/Escape in Terminal
	5.	sudo bash lamp.sh 
	6.	When prompted to enter password for MySQL root user enter ‘password' (Without quotes), and then re-enter it when asked to.
	7.	When prompted to save current IPV4 rules, choose Yes, and again when prompted to save current IPV6 rules.
	8.	Edit name.txt, to contain the Track Name for that Pi (It must not contain anything else)
	9.	sudo bash setSSID.sh
	10.sudo bash accessPoint.sh
	11.sudo bash move.sh
	12.Plug camera module into its port on the Pi
	13.sudo raspi-config                 
		Select ‘Interfacing options’. Select ‘Camera’ and enable. Select ‘Finish’ and reboot.
	14. Enter ‘localhost/cgi-bin/createDB.sh’ in the browser address bar, and hit return. It should display ‘Database created’ if successful.
	15. sudo bash startAP.sh (This starts the access point. To stop it,
		hit ^C and sudo bash stopAP.sh)

PHP Scripts

	•	commentsList.php  
		•	timeslot - integer

	•	currentPresenter.php, presenterList.php, winners.php - no parameters needed

	•	deletePresenter.php
		•	timeslot - integer

	•	insertPresenter.php
		•	handle, name, topic  - string (no quotation marks in URL)
		•	start, end - timestamp (eg …&start=2017-06-29 00:00:00)

	•	newComment.php 
		•	cookie - 0 if a cookie doesn’t exist, 1 if it does
		•	rating, timeslot - integers
		•	comment - string

	•	tweetImage.php
		•	consumerKey, consumerSecret, accessToken, accessTokenSecret - get from Twitter apps page for BBD Twitter account
		•	message - string

	•	tweetWinner.php
		•	consumerKey, consumerSecret, accessToken, accessTokenSecret - get from Twitter apps page for BBD Twitter account

	•	updatePresenter.php
		•	timeslot = integer
		•	handle, name, topic  - string (no quotation marks in URL)
		•	start, end - timestamp (eg …&start=2017-06-29 00:00:00)