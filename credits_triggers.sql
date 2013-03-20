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