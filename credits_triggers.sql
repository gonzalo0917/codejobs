DELIMITER %%

-- Update

UPDATE muu_users users SET
 Posts = (SELECT COUNT(*) FROM muu_blog blog WHERE blog.Situation <> 'Deleted' AND blog.Situation <> 'Draft' AND blog.ID_User = users.ID_User),
 Codes = (SELECT COUNT(*) FROM muu_codes codes WHERE codes.Situation <> 'Deleted' AND codes.Situation <> 'Draft' AND codes.ID_User = users.ID_User),
 Bookmarks = (SELECT COUNT(*) FROM muu_bookmarks bookmarks WHERE bookmarks.Situation <> 'Deleted' AND bookmarks.Situation <> 'Draft' AND bookmarks.ID_User = users.ID_User)
%%

UPDATE muu_users SET Credits = 3*Posts + 2*Codes + Bookmarks, Recommendation = 50 + 5*Posts + 3*Codes + Bookmarks
%%
-- muu_blog

DROP TRIGGER IF EXISTS blog_insert;
CREATE TRIGGER blog_insert AFTER INSERT ON muu_blog
	FOR EACH ROW BEGIN
		IF NEW.Situation <> 'Deleted' AND NEW.Situation <> 'Draft' THEN
			UPDATE muu_users SET Posts = Posts + 1, Credits = Credits + 3, Recommendation = Recommendation + 5
			WHERE ID_User = NEW.ID_User;
		END IF;
	END;
%%

DROP TRIGGER IF EXISTS blog_update;
CREATE TRIGGER blog_update AFTER UPDATE ON muu_blog
	FOR EACH ROW BEGIN
		IF (OLD.Situation <> 'Deleted' AND OLD.Situation <> 'Draft') AND (NEW.Situation = 'Deleted' OR NEW.Situation = 'Draft') THEN
			UPDATE muu_users SET Posts = Posts - 1, Credits = Credits - 3, Recommendation = Recommendation - 5
			WHERE ID_User = OLD.ID_User;
		ELSE
			IF (OLD.Situation = 'Deleted' OR OLD.Situation = 'Draft') AND (NEW.Situation <> 'Deleted' AND NEW.Situation <> 'Draft') THEN
				UPDATE muu_users SET Posts = Posts + 1, Credits = Credits + 3, Recommendation = Recommendation + 5
				WHERE ID_User = OLD.ID_User;
			END IF;
		END IF;
	END;
%%

DROP TRIGGER IF EXISTS blog_delete;
CREATE TRIGGER blog_delete BEFORE DELETE ON muu_blog
	FOR EACH ROW BEGIN
		IF OLD.Situation <> 'Deleted' AND OLD.Situation <> 'Draft' THEN
			UPDATE muu_users SET Posts = Posts - 1, Credits = Credits - 3, Recommendation = Recommendation - 5
			WHERE ID_User = OLD.ID_User;
		END IF;
	END;
%%

-- muu_codes

DROP TRIGGER IF EXISTS codes_insert;
CREATE TRIGGER codes_insert AFTER INSERT ON muu_codes
	FOR EACH ROW BEGIN
		IF NEW.Situation <> 'Deleted' AND NEW.Situation <> 'Draft' THEN
			UPDATE muu_users SET Codes = Codes + 1, Credits = Credits + 2, Recommendation = Recommendation + 3
			WHERE ID_User = NEW.ID_User;
		END IF;
	END;
%%

DROP TRIGGER IF EXISTS codes_update;
CREATE TRIGGER codes_update AFTER UPDATE ON muu_codes
	FOR EACH ROW BEGIN
		IF (OLD.Situation <> 'Deleted' AND OLD.Situation <> 'Draft') AND (NEW.Situation = 'Deleted' OR NEW.Situation = 'Draft') THEN
			UPDATE muu_users SET Codes = Codes - 1, Credits = Credits - 2, Recommendation = Recommendation - 3
			WHERE ID_User = OLD.ID_User;
		ELSE
			IF (OLD.Situation = 'Deleted' OR OLD.Situation = 'Draft') AND (NEW.Situation <> 'Deleted' AND NEW.Situation <> 'Draft') THEN
				UPDATE muu_users SET Codes = Codes + 1, Credits = Credits + 2, Recommendation = Recommendation + 3
				WHERE ID_User = OLD.ID_User;
			END IF;
		END IF;
	END;
%%

DROP TRIGGER IF EXISTS codes_delete;
CREATE TRIGGER codes_delete BEFORE DELETE ON muu_codes
	FOR EACH ROW BEGIN
		IF OLD.Situation <> 'Deleted' AND OLD.Situation <> 'Draft' THEN
			UPDATE muu_users SET Codes = Codes - 1, Credits = Credits - 2, Recommendation = Recommendation - 3
			WHERE ID_User = OLD.ID_User;
		END IF;
	END;
%%

-- muu_bookmarks

DROP TRIGGER IF EXISTS bookmarks_insert;
CREATE TRIGGER bookmarks_insert AFTER INSERT ON muu_bookmarks
	FOR EACH ROW BEGIN
		IF NEW.Situation <> 'Deleted' AND NEW.Situation <> 'Draft' THEN
			UPDATE muu_users SET Bookmarks = Bookmarks + 1, Credits = Credits + 1, Recommendation = Recommendation + 1
			WHERE ID_User = NEW.ID_User;
		END IF;
	END;
%%

DROP TRIGGER IF EXISTS bookmarks_update;
CREATE TRIGGER bookmarks_update AFTER UPDATE ON muu_bookmarks
	FOR EACH ROW BEGIN
		IF (OLD.Situation <> 'Deleted' AND OLD.Situation <> 'Draft') AND (NEW.Situation = 'Deleted' OR NEW.Situation = 'Draft') THEN
			UPDATE muu_users SET Bookmarks = Bookmarks - 1, Credits = Credits - 1, Recommendation = Recommendation - 1
			WHERE ID_User = OLD.ID_User;
		ELSE
			IF (OLD.Situation = 'Deleted' OR OLD.Situation = 'Draft') AND (NEW.Situation <> 'Deleted' AND NEW.Situation <> 'Draft') THEN
				UPDATE muu_users SET Bookmarks = Bookmarks + 1, Credits = Credits + 1, Recommendation = Recommendation + 1
				WHERE ID_User = OLD.ID_User;
			END IF;
		END IF;
	END;
%%

DROP TRIGGER IF EXISTS bookmarks_delete;
CREATE TRIGGER bookmarks_delete BEFORE DELETE ON muu_bookmarks
	FOR EACH ROW BEGIN
		IF OLD.Situation <> 'Deleted' AND OLD.Situation <> 'Draft' THEN
			UPDATE muu_users SET Bookmarks = Bookmarks - 1, Credits = Credits - 1, Recommendation = Recommendation - 1
			WHERE ID_User = OLD.ID_User;
		END IF;
	END;
%%