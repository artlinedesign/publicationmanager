<?php

class DatabaseCreator {



	static function createCustomDatabase() {



			global $wpdb;
		  	$version = get_option( 'my_plugin_version', '1.0' );
			$charset_collate = $wpdb->get_charset_collate();
			$table_name = $wpdb->prefix . 'publicationmanager_authors';


			$sql = "CREATE TABLE $table_name (
				id int(11) NOT NULL,
		  	firstname varchar(255) NOT NULL,
		  	lastname varchar(255) NOT NULL
			) $charset_collate;";


			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

			if ( version_compare( $version, '2.0' ) < 0 ) {
				$sql = "CREATE TABLE $table_name (
					id int(11) NOT NULL,
					firstname varchar(255) NOT NULL,
					lastname varchar(255) NOT NULL
				) $charset_collate;";
				dbDelta( $sql );

			  	update_option( 'my_plugin_version', '2.0' );

			}



			// 2

			global $wpdb;
				$version = get_option( 'my_plugin_version', '1.0' );
			$charset_collate = $wpdb->get_charset_collate();
			$table_name = $wpdb->prefix . 'publicationmanager_books';


			$sql = "CREATE TABLE $table_name (
				id int(11) NOT NULL,
		  auflage varchar(255) NOT NULL,
		  verlag_id int(11) NOT NULL,
		  author_id int(11) NOT NULL,
		  thumbnail_url varchar(255) NOT NULL,
		  titel int(11) NOT NULL
			) $charset_collate;";


			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

			if ( version_compare( $version, '2.0' ) < 0 ) {
				$sql = "CREATE TABLE $table_name (
					id int(11) NOT NULL,
				auflage varchar(255) NOT NULL,
				verlag_id int(11) NOT NULL,
				author_id int(11) NOT NULL,
				thumbnail_url varchar(255) NOT NULL,
				titel int(11) NOT NULL
				) $charset_collate;";
				dbDelta( $sql );

					update_option( 'my_plugin_version', '2.0' );

			}



			// 3

			global $wpdb;
				$version = get_option( 'my_plugin_version', '1.0' );
			$charset_collate = $wpdb->get_charset_collate();
			$table_name = $wpdb->prefix . 'publicationmanager_publications';


			$sql = "CREATE TABLE $table_name (
				id int(11) NOT NULL,
		  author_id int(11) NOT NULL,
		  verlag_id int(11) NOT NULL,
		  seiten int(11) NOT NULL,
		  titel varchar(255) NOT NULL,
		  thumbnail_url varchar(255) NOT NULL,
		  datum datetime NOT NULL
			) $charset_collate;";


			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

			if ( version_compare( $version, '2.0' ) < 0 ) {
				$sql = "CREATE TABLE $table_name (
					id int(11) NOT NULL,
			  author_id int(11) NOT NULL,
			  verlag_id int(11) NOT NULL,
			  seiten int(11) NOT NULL,
			  titel varchar(255) NOT NULL,
			  thumbnail_url varchar(255) NOT NULL,
			  datum datetime NOT NULL
				) $charset_collate;";
				dbDelta( $sql );

					update_option( 'my_plugin_version', '2.0' );

			}


			// 4

			global $wpdb;
				$version = get_option( 'my_plugin_version', '1.0' );
			$charset_collate = $wpdb->get_charset_collate();
			$table_name = $wpdb->prefix . 'publicationmanager_verlage';


			$sql = "CREATE TABLE $table_name (
				id int(11) NOT NULL,
		  	name varchar(255) NOT NULL
			) $charset_collate;";


			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

			if ( version_compare( $version, '2.0' ) < 0 ) {
				$sql = "CREATE TABLE $table_name (
					id int(11) NOT NULL,
					name varchar(255) NOT NULL
				) $charset_collate;";
				dbDelta( $sql );

					update_option( 'my_plugin_version', '2.0' );

			}
		}
	}

 ?>
