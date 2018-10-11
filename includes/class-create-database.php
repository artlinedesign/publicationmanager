<?php

class DatabaseCreator {



	static function createCustomDatabase() {



			global $wpdb;
		  	$version = get_option( 'my_plugin_version', '1.0' );
			$charset_collate = $wpdb->get_charset_collate();
			$table_name = $wpdb->prefix . 'publicationmanager_authors';


			//Authors

			$sql = "CREATE TABLE $table_name (
				ID int(11) NOT NULL AUTO_INCREMENT,
				title varchar(255),
		  	firstname varchar(255) NOT NULL,
		  	lastname varchar(255) NOT NULL,
		  	PRIMARY KEY (ID)
			) $charset_collate;";


			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

			if ( version_compare( $version, '2.0' ) < 0 ) {
				$sql = "CREATE TABLE $table_name (
					ID int(11) NOT NULL AUTO_INCREMENT,
					firstname varchar(255) NOT NULL,
					lastname varchar(255) NOT NULL,
					PRIMARY KEY (ID)
				) $charset_collate;";
				dbDelta( $sql );

			  	update_option( 'my_plugin_version', '2.0' );

			}



			//Books

				$version = get_option( 'my_plugin_version', '1.0' );
			$charset_collate = $wpdb->get_charset_collate();
			$table_name = $wpdb->prefix . 'publicationmanager_books';


			$sql = "CREATE TABLE $table_name (
				ID int(11) NOT NULL AUTO_INCREMENT,
		  edition varchar(255) NOT NULL,
		  verlag_id int(11) NOT NULL,
		  author_id int(11) NOT NULL,
		  thumbnail_url varchar(255) NOT NULL,
		  url varchar(255) NOT NULL,
		  title varchar(255) NOT NULL,
		  PRIMARY KEY (ID)
			) $charset_collate;";


			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

			if ( version_compare( $version, '2.0' ) < 0 ) {
				$sql = "CREATE TABLE $table_name (
					ID int(11) NOT NULL AUTO_INCREMENT,
				edition varchar(255) NOT NULL,
				verlag_id int(11) NOT NULL,
				author_id int(11) NOT NULL,
				thumbnail_url varchar(255) NOT NULL,
				url varchar(255) NOT NULL,
				title varchar(255) NOT NULL,
				PRIMARY KEY (ID)
				) $charset_collate;";
				dbDelta( $sql );

					update_option( 'my_plugin_version', '2.0' );

			}



			//Publications

				$version = get_option( 'my_plugin_version', '1.0' );
			$charset_collate = $wpdb->get_charset_collate();
			$table_name = $wpdb->prefix . 'publicationmanager_publications';


			$sql = "CREATE TABLE $table_name (
				ID int(11) NOT NULL AUTO_INCREMENT,
		  author_id int(11) NOT NULL,
		  verlag_id int(11) NOT NULL,
		  sites int(11) NOT NULL,
		  title varchar(255) NOT NULL,
		  thumbnail_url varchar(255) NOT NULL,
		  url varchar(255) NOT NULL,
		  date datetime NOT NULL,
		  PRIMARY KEY (ID)
			) $charset_collate;";


			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

			if ( version_compare( $version, '2.0' ) < 0 ) {
				$sql = "CREATE TABLE $table_name (
					ID int(11) NOT NULL AUTO_INCREMENT,
			  author_id int(11) NOT NULL,
			  verlag_id int(11) NOT NULL,
			  sites int(11) NOT NULL,
			  title varchar(255) NOT NULL,
			  thumbnail_url varchar(255) NOT NULL,
			  url varchar(255) NOT NULL,
			  date datetime NOT NULL,
			  PRIMARY KEY (ID)
				) $charset_collate;";
				dbDelta( $sql );

					update_option( 'my_plugin_version', '2.0' );

			}


			//Verläge
				$version = get_option( 'my_plugin_version', '1.0' );
			$charset_collate = $wpdb->get_charset_collate();
			$table_name = $wpdb->prefix . 'publicationmanager_verlage';


			$sql = "CREATE TABLE $table_name (
				ID int(11) NOT NULL AUTO_INCREMENT,
		  	name varchar(255) NOT NULL,
		  	PRIMARY KEY (ID)
			) $charset_collate;";


			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

			if ( version_compare( $version, '2.0' ) < 0 ) {
				$sql = "CREATE TABLE $table_name (
					ID int(11) NOT NULL AUTO_INCREMENT,
					name varchar(255) NOT NULL,
					PRIMARY KEY (ID)
				) $charset_collate;";
				dbDelta( $sql );

					update_option( 'my_plugin_version', '2.0' );

			}


        //Beiträge

        $version = get_option( 'my_plugin_version', '1.0' );
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'publicationmanager_articles';


        $sql = "CREATE TABLE $table_name (
				ID int(11) NOT NULL AUTO_INCREMENT,
		  author_id int(11) NOT NULL,
		  verlag_id int(11) NOT NULL,
		  title varchar(255) NOT NULL,
		  thumbnail_url varchar(255) NOT NULL,
		  url varchar(255) NOT NULL,
		  date datetime NOT NULL,
		  PRIMARY KEY (ID)
			) $charset_collate;";


        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        if ( version_compare( $version, '2.0' ) < 0 ) {
            $sql = "CREATE TABLE $table_name (
					ID int(11) NOT NULL AUTO_INCREMENT,
			  author_id int(11) NOT NULL,
			  verlag_id int(11) NOT NULL,
			  title varchar(255) NOT NULL,
			  thumbnail_url varchar(255) NOT NULL,
			  url varchar(255) NOT NULL,
			  date datetime NOT NULL,
			  PRIMARY KEY (ID)
				) $charset_collate;";
            dbDelta( $sql );

            update_option( 'my_plugin_version', '2.0' );

        }


		}
	}

 ?>
