# Actualizamos la cantidad de posts para cada usuario
UPDATE muu_users users SET Posts = (SELECT COUNT(*) FROM muu_blog blog WHERE blog.ID_User=users.ID_User AND (blog.Situation='Active' OR blog.Situation='Pending'));

# Actualizamos la cantidad de marcadores para cada usuario
UPDATE muu_users users SET Bookmarks = (SELECT COUNT(*) FROM muu_bookmarks bookmarks WHERE bookmarks.ID_User=users.ID_User AND (bookmarks.Situation='Active' OR bookmarks.Situation='Pending'));

# Actualizamos la cantidad de códigos para cada usuario
UPDATE muu_users users SET Codes = (SELECT COUNT(*) FROM muu_codes codes WHERE codes.ID_User=users.ID_User AND (codes.Situation='Active' OR codes.Situation='Pending'));

# Actualizamos los créditos para cada usuario
UPDATE muu_users SET Credits = 3*Posts + 2*Codes + Bookmarks;

# Actualizamos las recomendaciones para cada usuario, asumiendo que desde un inicio se le dan 50 recomendaciones
UPDATE muu_users SET Recommendation = 50 + 5*Posts + 3*Codes + Bookmarks;