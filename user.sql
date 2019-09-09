ALTER TABLE "users"
	DROP CONSTRAINT "users_username_unique" CASCADE 
GO
ALTER TABLE "users"
	DROP CONSTRAINT "users_email_unique" CASCADE 
GO
ALTER TABLE "roles"
	DROP CONSTRAINT "roles_name_unique" CASCADE 
GO
ALTER TABLE "pages"
	DROP CONSTRAINT "pages_name_unique" CASCADE 
GO
DROP TABLE "users"
GO
DROP TABLE "user_roles"
GO
DROP TABLE "roles"
GO
DROP TABLE "role_pages"
GO
DROP TABLE "pages"
GO

CREATE TABLE "pages"  ( 
	"id"        	bigserial NOT NULL,
	"name"      	varchar(255) NOT NULL,
	"model"     	varchar(255) NOT NULL,
	"controller"	varchar(255) NOT NULL,
	"view"      	varchar(255) NOT NULL,
	"note"      	text NULL,
	"created_at"	timestamp(0) NULL,
	"updated_at"	timestamp(0) NULL,
	"routename" 	varchar(255) NULL,
	"position"  	varchar(255) NULL,
	"icons"     	varchar(255) NULL,
	"pagelink"  	varchar(255) NULL,
	"status"    	integer NULL,
	"parent_id" 	integer NULL,
	PRIMARY KEY("id")
)
GO
ALTER TABLE "pages" OWNER TO "postgres"
GO
CREATE TABLE "role_pages"  ( 
	"id"        	bigserial NOT NULL,
	"role_id"   	integer NOT NULL,
	"page_id"   	integer NOT NULL,
	"created_at"	timestamp(0) NULL,
	"updated_at"	timestamp(0) NULL,
	PRIMARY KEY("id")
)
GO
ALTER TABLE "role_pages" OWNER TO "postgres"
GO
CREATE TABLE "roles"  ( 
	"id"        	bigserial NOT NULL,
	"name"      	varchar(255) NOT NULL,
	"note"      	text NULL,
	"created_at"	timestamp(0) NULL,
	"updated_at"	timestamp(0) NULL,
	PRIMARY KEY("id")
)
GO
ALTER TABLE "roles" OWNER TO "postgres"
GO
CREATE TABLE "user_roles"  ( 
	"id"        	bigserial NOT NULL,
	"user_id"   	integer NOT NULL,
	"role_id"   	integer NOT NULL,
	"created_at"	timestamp(0) NULL,
	"updated_at"	timestamp(0) NULL,
	PRIMARY KEY("id")
)
GO
ALTER TABLE "user_roles" OWNER TO "postgres"
GO
CREATE TABLE "users"  ( 
	"id"               	bigserial NOT NULL,
	"name"             	varchar(255) NOT NULL,
	"role_id"          	integer NULL,
	"username"         	varchar(255) NOT NULL,
	"email"            	varchar(255) NOT NULL,
	"email_verified_at"	timestamp(0) NULL,
	"expired_date"     	timestamp(0) NULL,
	"password"         	varchar(255) NOT NULL,
	"remember_token"   	varchar(100) NULL,
	"created_at"       	timestamp(0) NULL,
	"updated_at"       	timestamp(0) NULL,
	"status"           	integer NULL,
	"is_expired"       	integer NULL,
	"photo"            	text NULL,
	PRIMARY KEY("id")
)
GO
ALTER TABLE "users" OWNER TO "postgres"
GO

INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(17, 'Userrole', 'Userrole', 'API\UserRoleController', 'Userroles', NULL, '2019-08-01 02:26:49.0', '2019-08-30 02:57:25.0', 'userroles', '(null)', NULL, NULL, 2, NULL)
GO
INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(15, 'Content', 'Content', 'API\ContentController', 'Contents', NULL, '2019-07-27 20:54:01.0', '2019-08-30 02:57:45.0', 'contents', NULL, 'fas fa-book-reader', NULL, 2, NULL)
GO
INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(12, 'Role', 'Role', 'API\RoleController', 'Roles', NULL, '2019-07-27 19:47:19.0', '2019-09-04 03:51:22.0', 'roles', '(null)', 'fas fa-user-shield', NULL, 1, 36)
GO
INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(6, 'Page', 'Page', 'API\pagecontroller', 'Pages', 'pages', '2019-07-25 15:48:48.0', '2019-09-04 03:52:31.0', 'pages', '(null)', 'fas fa-user-tag', NULL, 1, 36)
GO
INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(13, 'Rolepages', 'Rolepage', 'API\RoleController', 'RolePages', NULL, '2019-07-27 19:50:36.0', '2019-08-30 03:03:21.0', 'rolepages', '(null)', 'fas fa-archway', NULL, 2, NULL)
GO
INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(36, 'Setting', 'Setting', 'Setting', 'Setting', NULL, '2019-08-30 07:03:04.0', '2019-09-04 03:54:34.0', 'Setting', NULL, 'fas fa-user-cog', NULL, 5, NULL)
GO
INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(29, 'Kfa Performance', 'Kf', 'KF', 'Contents', 'KF', '2019-08-22 06:59:00.0', '2019-09-06 02:49:15.0', 'contents', NULL, 'fas fa-clipboard-list', '/views/DahsboardExecutiveMarketingKF2/KFAPerformance', 5, NULL)
GO
INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(28, 'Marketing Star', 'Kf', 'KF', 'Contents', 'KF', '2019-08-22 06:57:58.0', '2019-09-06 02:49:58.0', 'contents', NULL, 'fas fa-cubes', '/views/DahsboardExecutiveMarketingKF2/MarketingStar', 5, NULL)
GO
INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(30, 'Page Level', 'Pagelevel', 'API\PageLevelController', 'PageLevel', 'untuk mengatur posisi menu', '2019-08-29 03:48:54.0', '2019-08-30 02:56:56.0', 'pagelevel', NULL, NULL, NULL, 1, NULL)
GO
INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(37, 'My Dashboard', 'My Dashboard', 'My Dasboard', 'My Dashboard', NULL, '2019-08-30 07:10:38.0', '2019-09-06 02:51:05.0', 'mydashboard', NULL, 'fab fa-earlybirds', NULL, 5, NULL)
GO
INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(27, 'Detail Informasi', 'Kf', 'KF', 'Contents', 'KF', '2019-08-22 06:56:45.0', '2019-09-06 02:51:37.0', 'contents', NULL, 'fas fa-bezier-curve', '/views/DahsboardExecutiveMarketingKF2/DetailInformasi', 5, NULL)
GO
INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(26, 'Overview Executive Markerting', 'Kf', 'KF', 'Contents', 'KF', '2019-08-22 06:55:14.0', '2019-09-06 02:52:22.0', 'contents', NULL, 'fas fa-ethernet', '/views/DahsboardExecutiveMarketingKF2/OverviewExecutiveMarkerting', 5, NULL)
GO
INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(22, 'General Overview', 'Adbrief', 'adbrief', 'Contents', 'adbrief', '2019-08-22 03:27:22.0', '2019-09-06 02:53:08.0', 'contents', NULL, 'fas fa-fire-alt', '/views/VASCorporateYKPANTAM-asoff/01_GENERAL_OVERVIEW', 3, 38)
GO
INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(23, 'Transaction Overview', 'Adbrief', 'adbrief', 'Contents', 'adbrief', '2019-08-22 03:27:22.0', '2019-09-06 02:53:55.0', 'contents', NULL, 'fab fa-freebsd', '/views/VASCorporateYKPANTAM-asoff/02_TRANSACTION_OVERVIEW2', 3, 38)
GO
INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(38, 'Adbrief', 'Adbrief', 'adbrief', 'adbrief', NULL, '2019-08-30 07:11:35.0', '2019-09-03 09:22:47.0', 'adbrief', NULL, 'fas fa-layer-group', NULL, 5, 37)
GO
INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(25, 'Diagnotis Detail', 'Adbrief', 'adbrief', 'Contents', 'adbrief', '2019-08-22 03:27:22.0', '2019-09-06 02:54:22.0', 'contents', NULL, 'fab fa-fly', '/views/VASCorporateYKPANTAM-asoff/04_BRANCH_DIAGNOSTIC_DETAILS', 3, 38)
GO
INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(4, 'User', 'User', 'API\UserController', 'Users', 'untuk users', '2019-07-25 15:47:54.0', '2019-09-04 03:48:28.0', 'users', '(null)', 'fas fa-chalkboard-teacher', NULL, 1, 36)
GO
INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(14, 'Developer', 'Developer', 'DeveloperController', 'Developer', NULL, '2019-07-27 20:01:50.0', '2019-09-04 03:49:52.0', 'developer', '(null)', 'fas fa-user-ninja', NULL, 4, 36)
GO
INSERT INTO "pages"("id", "name", "model", "controller", "view", "note", "created_at", "updated_at", "routename", "position", "icons", "pagelink", "status", "parent_id")
  VALUES(21, 'How To Read', 'Adbrief', 'adbrief', 'Contents', 'adbrief', '2019-08-22 03:27:22.0', '2019-09-06 02:56:20.0', 'contents', NULL, 'fab fa-hubspot', '/views/VASCorporateYKPANTAM-asoff/HowToRead', 5, NULL)
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(10, 1, 6, '2019-07-26 06:40:41.0', '2019-07-26 06:40:41.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(11, 1, 4, '2019-07-26 06:40:50.0', '2019-07-26 06:40:50.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(14, 1, 11, '2019-07-27 19:58:49.0', '2019-07-27 19:58:49.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(15, 1, 12, '2019-07-27 19:59:02.0', '2019-07-27 19:59:02.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(16, 1, 14, '2019-07-27 20:02:14.0', '2019-07-27 20:02:14.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(19, 2, 15, '2019-07-28 14:46:57.0', '2019-07-28 14:46:57.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(25, 1, 13, NULL, NULL)
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(26, 1, 17, '2019-08-01 02:27:13.0', '2019-08-01 02:27:13.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(29, 2, 21, '2019-08-22 03:32:25.0', '2019-08-22 03:32:25.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(30, 2, 23, '2019-08-22 04:18:13.0', '2019-08-22 04:18:13.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(31, 2, 22, '2019-08-22 04:18:22.0', '2019-08-22 04:18:22.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(32, 2, 25, '2019-08-22 04:18:29.0', '2019-08-22 04:18:29.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(33, 3, 26, '2019-08-22 06:59:30.0', '2019-08-22 06:59:30.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(34, 3, 27, '2019-08-22 07:00:48.0', '2019-08-22 07:00:48.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(35, 3, 28, '2019-08-22 07:01:01.0', '2019-08-22 07:01:01.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(36, 3, 29, '2019-08-22 07:01:09.0', '2019-08-22 07:01:09.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(37, 3, 15, '2019-08-22 07:04:20.0', '2019-08-22 07:04:20.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(39, 1, 30, '2019-08-30 04:22:04.0', '2019-08-30 04:22:04.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(40, 1, 36, '2019-08-30 07:19:30.0', '2019-08-30 07:19:30.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(41, 2, 37, '2019-08-30 07:19:49.0', '2019-08-30 07:19:49.0')
GO
INSERT INTO "role_pages"("id", "role_id", "page_id", "created_at", "updated_at")
  VALUES(42, 2, 38, '2019-09-04 04:30:31.0', '2019-09-04 04:30:31.0')
GO
INSERT INTO "roles"("id", "name", "note", "created_at", "updated_at")
  VALUES(1, 'admin', NULL, '2019-07-25 15:48:17.0', '2019-07-25 15:48:17.0')
GO
INSERT INTO "roles"("id", "name", "note", "created_at", "updated_at")
  VALUES(2, 'Adbrief', 'user', '2019-07-28 00:00:00.0', '2019-08-22 04:17:55.0')
GO
INSERT INTO "roles"("id", "name", "note", "created_at", "updated_at")
  VALUES(3, 'KF', 'KF', '2019-08-22 06:59:14.0', '2019-08-22 06:59:14.0')
GO
INSERT INTO "user_roles"("id", "user_id", "role_id", "created_at", "updated_at")
  VALUES(1, 1, 1, NULL, NULL)
GO
INSERT INTO "user_roles"("id", "user_id", "role_id", "created_at", "updated_at")
  VALUES(5, 1, 2, '2019-08-01 03:11:09.0', '2019-08-01 03:11:09.0')
GO
INSERT INTO "user_roles"("id", "user_id", "role_id", "created_at", "updated_at")
  VALUES(18, 5, 1, '2019-08-05 22:09:28.0', '2019-08-05 22:09:28.0')
GO
INSERT INTO "user_roles"("id", "user_id", "role_id", "created_at", "updated_at")
  VALUES(19, 5, 2, '2019-08-05 22:09:49.0', '2019-08-05 22:09:49.0')
GO
INSERT INTO "user_roles"("id", "user_id", "role_id", "created_at", "updated_at")
  VALUES(20, 2, 3, '2019-08-22 07:01:41.0', '2019-08-22 07:01:41.0')
GO
INSERT INTO "user_roles"("id", "user_id", "role_id", "created_at", "updated_at")
  VALUES(21, 1, 3, '2019-08-22 07:07:16.0', '2019-08-22 07:07:16.0')
GO
INSERT INTO "user_roles"("id", "user_id", "role_id", "created_at", "updated_at")
  VALUES(22, 7, 1, '2019-08-27 09:15:00.0', '2019-08-27 09:15:00.0')
GO
INSERT INTO "users"("id", "name", "role_id", "username", "email", "email_verified_at", "expired_date", "password", "remember_token", "created_at", "updated_at", "status", "is_expired", "photo")
  VALUES(4, 'danu', 1, 'danu', 'danu@gmail.com', NULL, '2019-07-05 07:07:00.0', '$2y$10$L7NtcosQyInkC6adhQdDy.HWj9UV9rC8f4mZ9tgGwM5HIdem6aF1a', NULL, '2019-07-31 07:10:21.0', '2019-07-31 07:11:27.0', 1, 1, NULL)
GO
INSERT INTO "users"("id", "name", "role_id", "username", "email", "email_verified_at", "expired_date", "password", "remember_token", "created_at", "updated_at", "status", "is_expired", "photo")
  VALUES(6, 'test1', NULL, 'test1', 'test1@gmail.com', NULL, NULL, '$2y$10$8Kkw9BhrHbJ4lgGPv19Noecs/D14fqOcfrQfoT6VN/1obt8TehoQG', NULL, '2019-08-26 08:13:23.0', '2019-08-26 08:13:23.0', 1, 2, NULL)
GO
INSERT INTO "users"("id", "name", "role_id", "username", "email", "email_verified_at", "expired_date", "password", "remember_token", "created_at", "updated_at", "status", "is_expired", "photo")
  VALUES(5, 'superadmin', 1, 'superadminn', 'superadmin@gmail.com', NULL, NULL, '$2y$10$o.OhYFKo94TLcNAyG0UgzOkt/m8qbtbqJqb1.kpchd8faIQ.lmY5.', NULL, '2019-08-05 21:52:06.0', '2019-08-22 07:57:19.0', 1, 2, NULL)
GO
INSERT INTO "users"("id", "name", "role_id", "username", "email", "email_verified_at", "expired_date", "password", "remember_token", "created_at", "updated_at", "status", "is_expired", "photo")
  VALUES(7, 'test2', 1, 'test2', 'test2@gmail.com', NULL, NULL, '$2y$10$l9RzCukkg.LYZdCQzEHpTeYX5XfFZHdsPiyT//YLlBSZu3HyrYV4K', NULL, '2019-08-26 08:13:55.0', '2019-08-27 09:15:01.0', 1, 2, NULL)
GO
INSERT INTO "users"("id", "name", "role_id", "username", "email", "email_verified_at", "expired_date", "password", "remember_token", "created_at", "updated_at", "status", "is_expired", "photo")
  VALUES(1, 'rodhiyanto', 2, 'rodhi', 'rodhi.rodhiyanto@gmail.com', NULL, '2019-12-31 07:31:00.0', '$2y$10$meM0kWXfdE6yMVzFbzh4dOeay9NoS/3YIVYrw2McgGitsJOZtfmsO', NULL, '2019-07-25 15:44:04.0', '2019-09-06 03:01:55.0', 1, NULL, '1567588707.png')
GO
INSERT INTO "users"("id", "name", "role_id", "username", "email", "email_verified_at", "expired_date", "password", "remember_token", "created_at", "updated_at", "status", "is_expired", "photo")
  VALUES(2, 'erwin', 3, 'erwin', 'erwin@gmail.com', NULL, NULL, '$2y$10$hOnDEulIFFGTZ6D5FV5PKeI4JFiwV/8cdzTaJplKtNnPrBrYRubSm', NULL, '2019-07-27 19:37:28.0', '2019-08-22 07:01:41.0', 1, 0, NULL)
GO
ALTER TABLE "pages"
	ADD CONSTRAINT "pages_name_unique"
	UNIQUE ("name")
GO
ALTER TABLE "roles"
	ADD CONSTRAINT "roles_name_unique"
	UNIQUE ("name")
GO
ALTER TABLE "users"
	ADD CONSTRAINT "users_username_unique"
	UNIQUE ("username")
GO
ALTER TABLE "users"
	ADD CONSTRAINT "users_email_unique"
	UNIQUE ("email")
GO
