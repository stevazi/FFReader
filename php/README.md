FFReader
========

An API based reader for Forumfree


Description of the various file:

*api.html
  It is a simple test point, if you want see the reader in action simply write the forum/blog url into the first text field (eg: top.blogfree.net or http://top.blogfree.net)
  If you want use the debugger write the complete url into the second text field (eg: http://top.blofree.net/api.php or http://supporto.forumfree.net/api.php), it will show you
  the returned JSON into a fancier way.
  
*api-home.php
  This is the homepage viewer of the website: you must send to him the website using the GET method, and it will print the sections block (using an unsorted list, with others
  unsorted list nested for the subsections) and the articles block (using an unsorted list) when they are neeeded (so if the website don't have any articles it wil not print the
  articles block). It also create link to the other page reader, so you can quickly navigate into the website.
  
You can also try this reader at http://php-isamurai.rhcloud.com/api.html