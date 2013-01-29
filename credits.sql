UPDATE muu_users users SET Posts = (SELECT COUNT(1) FROM muu_blog blog WHERE blog.ID_User = users.ID_User AND blog.Situation != 'Deleted'),
 Bookmarks = (SELECT COUNT(1) FROM muu_bookmarks bookmarks WHERE bookmarks.ID_User = users.ID_User AND bookmarks.Situation != 'Deleted'),
 Codes = (SELECT COUNT(1) FROM muu_codes codes WHERE codes.ID_User = users.ID_User AND codes.Situation != 'Deleted');

UPDATE muu_users SET Credits = 3*Posts + 2*Codes + Bookmarks, Recommendation = 50 + 5*Posts + 3*Codes + Bookmarks;