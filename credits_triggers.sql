DELIMITER %%
DROP TRIGGER IF EXISTS blog_insert;
CREATE TRIGGER blog_insert AFTER INSERT ON muu_blog
	FOR EACH ROW BEGIN
		IF NEW.Situation <> 'Deleted' AND NEW.Situation <> 'Draft' THEN
			UPDATE muu_users SET Posts = Posts + 1, Credits = Credits + 3, Recommendation = Recommendation + 5
			WHERE ID_User = NEW.ID_User;
		END IF;
	END;
%%

