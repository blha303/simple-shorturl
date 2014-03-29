simple-shorturl
===============

So I had this crazy idea: what if I made a short-url service, using PHP, using directory index files and Location header setting, without a database? Well, I must be some kind of sadist, I thought. Then I went and did it.

Currently this is using a [flat-file](http://l.blha303.biz/list.txt) to store info, because I was lazy and didn't stick to my original challenge. In the future, I hope to have it using grep to search for directories containing the desired url.
