SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS data_categories;
CREATE TABLE IF NOT EXISTS data_categories (
  id int(12) NOT NULL AUTO_INCREMENT,
  id_parent varchar(12) NOT NULL DEFAULT 'root',
  title varchar(250) DEFAULT NULL,
  url_safe varchar(250) DEFAULT NULL,
  description text,
  enabled varchar(24) NOT NULL DEFAULT 'yes',
  meta_shares int(12) NOT NULL DEFAULT '0',
  meta_clicks int(12) NOT NULL DEFAULT '0',
  meta_views int(12) NOT NULL DEFAULT '0',
  date_added datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

INSERT INTO data_categories (id, id_parent, title, url_safe, description, enabled, meta_shares, meta_clicks, meta_views, date_added) VALUES(1, 'root', 'Clothing', 'clothing', 'A huge range of deals on clothing', 'yes', 0, 0, 0, '2014-07-28 19:11:42');
INSERT INTO data_categories (id, id_parent, title, url_safe, description, enabled, meta_shares, meta_clicks, meta_views, date_added) VALUES(2, 'root', 'Technology', 'technology', 'A huge range of deals on technology', 'yes', 0, 0, 0, '2014-07-28 19:11:42');
INSERT INTO data_categories (id, id_parent, title, url_safe, description, enabled, meta_shares, meta_clicks, meta_views, date_added) VALUES(3, '2', 'Gadgets', 'gadgets', 'A huge range of deals on gadgets', 'yes', 0, 0, 0, '2014-07-28 19:11:42');
INSERT INTO data_categories (id, id_parent, title, url_safe, description, enabled, meta_shares, meta_clicks, meta_views, date_added) VALUES(4, '2', 'Computers', 'computers', 'A huge range of deals on computers', 'yes', 0, 0, 0, '2014-07-28 19:11:42');
INSERT INTO data_categories (id, id_parent, title, url_safe, description, enabled, meta_shares, meta_clicks, meta_views, date_added) VALUES(5, '1', 'Menswear', 'menswear', 'A huge range of deals on menswear', 'yes', 0, 0, 0, '2014-07-28 19:11:42');
INSERT INTO data_categories (id, id_parent, title, url_safe, description, enabled, meta_shares, meta_clicks, meta_views, date_added) VALUES(6, '1', 'Ladies', 'ladies', 'A huge range of deals on ladies clothing', 'yes', 0, 0, 0, '2014-07-28 19:11:42');
INSERT INTO data_categories (id, id_parent, title, url_safe, description, enabled, meta_shares, meta_clicks, meta_views, date_added) VALUES(7, 'root', 'Entertainment', 'entertainment', 'A huge range of deals on entertainment', 'yes', 0, 0, 0, '2014-07-28 19:11:42');
INSERT INTO data_categories (id, id_parent, title, url_safe, description, enabled, meta_shares, meta_clicks, meta_views, date_added) VALUES(8, '2', 'Movies', 'movies', 'A huge range of deals on movies', 'yes', 0, 0, 0, '2014-07-28 19:11:42');
INSERT INTO data_categories (id, id_parent, title, url_safe, description, enabled, meta_shares, meta_clicks, meta_views, date_added) VALUES(9, 'root', 'Books', 'books', '', 'yes', 0, 0, 0, '2014-08-22 21:02:43');
INSERT INTO data_categories (id, id_parent, title, url_safe, description, enabled, meta_shares, meta_clicks, meta_views, date_added) VALUES(10, '6', 'Accessories', 'accessories', 'A large variety of ladies accessories', 'yes', 0, 0, 0, '2014-08-22 21:04:44');
INSERT INTO data_categories (id, id_parent, title, url_safe, description, enabled, meta_shares, meta_clicks, meta_views, date_added) VALUES(11, '9', 'Sci-fi', 'sci-fi', 'Great Science Fiction Books', 'yes', 0, 0, 0, '2014-08-22 21:07:03');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
