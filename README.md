DidIBuySell
==============

This is a simple crontab website scraper. My current online stock broker does not send me an email when my stock sells (I know, but their fees are so minimal)

I have this script running as a cron job every 15 minutes, Monday-Friday, from 6am to 6pm Eastern Time. Whenever it notices that my brokers account name bought or sold any of my specified stocks, it send me an email. Pretty simple.

To use it you only need to change:
* Which stocks it is watching.
* The name StockWatch.com uses for your broker (after one of your orders goes through refresh the stockwatch.com page for that specific stock to determine your brokers name)
* The email address you want the notification to be sent to.

Enjoy

Contributing
------------

Feel free to fork and send [pull requests](http://help.github.com/fork-a-repo/).  Contributions welcome.

Credit
------------

Huge props to the stockwatch.com website.

License
-------

This script is open source software released under the GNU GENERAL PUBLIC LICENSE V3.